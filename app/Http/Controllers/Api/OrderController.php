<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $orders = Order::where('user_id', $request->user()->id)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return response()->json($orders);
    }

    public function show(Request $request, string $id): JsonResponse
    {
        $order = Order::where('user_id', $request->user()->id)->findOrFail($id);

        return response()->json($order);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'shipping_address'         => 'required|array',
            'shipping_address.name'    => 'required|string',
            'shipping_address.phone'   => 'required|string',
            'shipping_address.address' => 'required|string',
            'shipping_address.city'    => 'required|string',
            'shipping_address.country' => 'required|string',
            'billing_address'          => 'nullable|array',
            'payment_method'           => 'required|in:sslcommerz,cod',
            'notes'                    => 'nullable|string',
        ]);

        $cart = Cart::where('user_id', $request->user()->id)->first();

        if (!$cart || empty($cart->items)) {
            return response()->json(['message' => 'Your cart is empty'], 422);
        }

        foreach ($cart->items as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || $product->stock < $item['quantity']) {
                return response()->json([
                    'message' => "Insufficient stock for product: {$item['name']}",
                ], 422);
            }
        }

        $subtotal     = $cart->subtotal;
        $shippingCost = $subtotal > 1000 ? 0 : 60;
        $total        = $subtotal - $cart->discount + $shippingCost;

        $order = Order::create([
            'user_id'          => $request->user()->id,
            'items'            => $cart->items,
            'shipping_address' => $validated['shipping_address'],
            'billing_address'  => $validated['billing_address'] ?? $validated['shipping_address'],
            'subtotal'         => $subtotal,
            'shipping_cost'    => $shippingCost,
            'discount'         => $cart->discount,
            'total'            => $total,
            'payment_method'   => $validated['payment_method'],
            'notes'            => $validated['notes'] ?? null,
        ]);

        foreach ($cart->items as $item) {
            Product::where('id', $item['product_id'])
                ->decrement('stock', $item['quantity']);
        }

        $cart->clear();

        return response()->json([
            'message' => 'Order placed successfully',
            'order'   => $order,
        ], 201);
    }

    public function cancel(Request $request, string $id): JsonResponse
    {
        $order = Order::where('user_id', $request->user()->id)->findOrFail($id);

        if (!in_array($order->status, [Order::STATUS_PENDING, Order::STATUS_PROCESSING])) {
            return response()->json(['message' => 'Order cannot be cancelled at this stage'], 422);
        }

        foreach ($order->items as $item) {
            Product::where('id', $item['product_id'])
                ->increment('stock', $item['quantity']);
        }

        $order->update(['status' => Order::STATUS_CANCELLED]);

        return response()->json(['message' => 'Order cancelled', 'order' => $order->fresh()]);
    }

    public function adminIndex(Request $request): JsonResponse
    {
        $query = Order::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(20);

        return response()->json($orders);
    }

    public function adminUpdateStatus(Request $request, string $id): JsonResponse
    {
        $order = Order::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled,refunded',
        ]);

        $order->update($validated);

        return response()->json(['message' => 'Order status updated', 'order' => $order->fresh()]);
    }
}
