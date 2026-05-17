<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebOrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function checkout()
    {
        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || empty($cart->items)) {
            return redirect()->route('cart.index')->with('error', 'কার্ট খালি আছে।');
        }

        return view('orders.checkout', compact('cart'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_name'    => 'required|string|max:255',
            'shipping_phone'   => 'required|string|max:20',
            'shipping_address' => 'required|string|max:500',
            'shipping_city'    => 'required|string|max:100',
            'shipping_state'   => 'required|string|max:100',
            'payment_method'   => 'required|in:cod,sslcommerz',
        ]);

        $cart = Cart::where('user_id', Auth::id())->first();

        if (!$cart || empty($cart->items)) {
            return redirect()->route('cart.index')->with('error', 'কার্ট খালি আছে।');
        }

        $shippingAddress = [
            'name'    => $request->shipping_name,
            'phone'   => $request->shipping_phone,
            'email'   => $request->shipping_email,
            'address' => $request->shipping_address,
            'city'    => $request->shipping_city,
            'state'   => $request->shipping_state,
            'zip'     => $request->shipping_zip,
            'country' => $request->shipping_country ?? 'Bangladesh',
        ];

        $order = Order::create([
            'user_id'          => Auth::id(),
            'items'            => $cart->items,
            'shipping_address' => $shippingAddress,
            'billing_address'  => $shippingAddress,
            'subtotal'         => $cart->subtotal,
            'discount'         => $cart->discount,
            'total'            => $cart->total,
            'payment_method'   => $request->payment_method,
            'notes'            => $request->notes,
        ]);

        $cart->clear();
        session()->forget('cart_count');

        if ($request->payment_method === 'sslcommerz') {
            return redirect()->route('orders.show', $order->id)
                ->with('success', 'অর্ডার তৈরি হয়েছে। শীঘ্রই পেমেন্ট লিংক পাবেন।');
        }

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'অর্ডার সফলভাবে দেওয়া হয়েছে! অর্ডার নম্বর: ' . $order->order_number);
    }

    public function index()
    {
        $orders = Order::where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);
        return view('orders.show', compact('order'));
    }

    public function cancel($id)
    {
        $order = Order::where('user_id', Auth::id())->findOrFail($id);

        if ($order->status !== Order::STATUS_PENDING) {
            return back()->with('error', 'শুধু অপেক্ষমাণ অর্ডার বাতিল করা যায়।');
        }

        $order->update(['status' => Order::STATUS_CANCELLED]);
        return back()->with('success', 'অর্ডারটি বাতিল করা হয়েছে।');
    }
}
