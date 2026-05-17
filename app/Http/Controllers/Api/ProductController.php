<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Product::where('is_active', true);

        if ($request->has('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        if ($request->has('min_price')) {
            $query->where('price', '>=', (float) $request->min_price);
        }

        if ($request->has('max_price')) {
            $query->where('price', '<=', (float) $request->max_price);
        }

        $sortField = $request->get('sort_by', 'created_at');
        $sortDir   = $request->get('sort_dir', 'desc');
        $query->orderBy($sortField, $sortDir);

        $perPage  = $request->get('per_page', 15);
        $products = $query->paginate($perPage);

        return response()->json($products);
    }

    public function show(string $id): JsonResponse
    {
        $product = Product::with('category')->findOrFail($id);

        return response()->json($product);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name'              => 'required|string|max:255',
            'description'       => 'nullable|string',
            'short_description' => 'nullable|string',
            'price'             => 'required|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'cost_price'        => 'nullable|numeric|min:0',
            'sku'               => 'nullable|string|unique:products,sku',
            'stock'             => 'required|integer|min:0',
            'category_id'       => 'required|string',
            'images'            => 'nullable|array',
            'attributes'        => 'nullable|array',
            'variants'          => 'nullable|array',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
            'tags'              => 'nullable|array',
        ]);

        $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(6);

        $product = Product::create($validated);

        return response()->json($product, 201);
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name'              => 'sometimes|string|max:255',
            'description'       => 'nullable|string',
            'short_description' => 'nullable|string',
            'price'             => 'sometimes|numeric|min:0',
            'sale_price'        => 'nullable|numeric|min:0',
            'cost_price'        => 'nullable|numeric|min:0',
            'sku'               => 'nullable|string',
            'stock'             => 'sometimes|integer|min:0',
            'category_id'       => 'sometimes|string',
            'images'            => 'nullable|array',
            'attributes'        => 'nullable|array',
            'variants'          => 'nullable|array',
            'is_active'         => 'boolean',
            'is_featured'       => 'boolean',
            'tags'              => 'nullable|array',
        ]);

        if (isset($validated['name'])) {
            $validated['slug'] = Str::slug($validated['name']) . '-' . Str::random(6);
        }

        $product->update($validated);

        return response()->json($product->fresh());
    }

    public function destroy(string $id): JsonResponse
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json(['message' => 'Product deleted']);
    }

    public function featured(): JsonResponse
    {
        $products = Product::where('is_active', true)
            ->where('is_featured', true)
            ->limit(10)
            ->get();

        return response()->json($products);
    }
}
