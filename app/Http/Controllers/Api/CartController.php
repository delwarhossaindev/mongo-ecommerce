<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private function getOrCreateCart(Request $request): Cart
    {
        return Cart::firstOrCreate(
            ['user_id' => $request->user()->id],
            ['items' => [], 'discount' => 0]
        );
    }

    public function index(Request $request): JsonResponse
    {
        $cart = $this->getOrCreateCart($request);

        return response()->json([
            'items'    => $cart->items ?? [],
            'subtotal' => $cart->subtotal,
            'discount' => $cart->discount,
            'total'    => $cart->total,
        ]);
    }

    public function addItem(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity'   => 'required|integer|min:1',
            'variant'    => 'nullable|array',
        ]);

        $product = Product::findOrFail($validated['product_id']);

        if ($product->stock < $validated['quantity']) {
            return response()->json(['message' => 'Insufficient stock'], 422);
        }

        $cart = $this->getOrCreateCart($request);
        $cart->addItem([
            'product_id' => $product->id,
            'name'       => $product->name,
            'price'      => $product->effective_price,
            'quantity'   => $validated['quantity'],
            'image'      => $product->images[0] ?? null,
            'variant'    => $validated['variant'] ?? null,
        ]);

        return response()->json([
            'message'  => 'Item added to cart',
            'items'    => $cart->items,
            'subtotal' => $cart->subtotal,
            'total'    => $cart->total,
        ]);
    }

    public function updateItem(Request $request, int $productId): JsonResponse
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($productId);

        if ($product->stock < $validated['quantity']) {
            return response()->json(['message' => 'Insufficient stock'], 422);
        }

        $cart = $this->getOrCreateCart($request);
        $cart->updateItemQuantity($productId, $validated['quantity']);

        return response()->json([
            'message'  => 'Cart updated',
            'items'    => $cart->items,
            'subtotal' => $cart->subtotal,
            'total'    => $cart->total,
        ]);
    }

    public function removeItem(Request $request, int $productId): JsonResponse
    {
        $cart = $this->getOrCreateCart($request);
        $cart->removeItem($productId);

        return response()->json([
            'message'  => 'Item removed from cart',
            'items'    => $cart->items,
            'subtotal' => $cart->subtotal,
            'total'    => $cart->total,
        ]);
    }

    public function clear(Request $request): JsonResponse
    {
        $cart = $this->getOrCreateCart($request);
        $cart->clear();

        return response()->json(['message' => 'Cart cleared']);
    }
}
