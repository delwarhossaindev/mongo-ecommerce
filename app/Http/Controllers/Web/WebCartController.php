<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WebCartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $this->syncCartCount($cart);
        return view('cart.index', compact('cart'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        if (!$product->is_active || $product->stock < $request->quantity) {
            return back()->with('error', 'পণ্যটি পর্যাপ্ত স্টকে নেই।');
        }

        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);
        $cart->addItem([
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->effective_price,
            'quantity'   => $request->quantity,
            'sku'        => $product->sku,
            'images'     => $product->images,
        ]);

        $this->syncCartCount($cart);
        return back()->with('success', '"' . $product->name . '" কার্টে যোগ হয়েছে।');
    }

    public function update(Request $request, $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->updateItemQuantity($productId, $request->quantity);
            $this->syncCartCount($cart);
        }

        return back()->with('success', 'কার্ট আপডেট হয়েছে।');
    }

    public function remove($productId)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->removeItem($productId);
            $this->syncCartCount($cart);
        }

        return back()->with('success', 'পণ্যটি কার্ট থেকে সরানো হয়েছে।');
    }

    public function clear()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->clear();
        }

        session()->forget('cart_count');
        return back()->with('success', 'কার্ট খালি করা হয়েছে।');
    }

    private function syncCartCount(?Cart $cart): void
    {
        $count = $cart ? collect($cart->items ?? [])->sum('quantity') : 0;
        session(['cart_count' => $count]);
    }
}
