<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'items',
        'coupon_code',
        'discount',
    ];

    protected $casts = [
        'items'    => 'array',
        'discount' => 'float',
    ];

    protected $attributes = [
        'discount' => 0,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSubtotalAttribute(): float
    {
        return collect($this->items ?? [])->sum(fn($item) => $item['price'] * $item['quantity']);
    }

    public function getTotalAttribute(): float
    {
        return $this->subtotal - ($this->discount ?? 0);
    }

    public function addItem(array $item): void
    {
        $items    = collect($this->items ?? []);
        $existing = $items->search(fn($i) => $i['product_id'] === $item['product_id']);

        if ($existing !== false) {
            $items[$existing]['quantity'] += $item['quantity'];
        } else {
            $items->push($item);
        }

        $this->items = $items->values()->toArray();
        $this->save();
    }

    public function removeItem(int $productId): void
    {
        $this->items = collect($this->items ?? [])
            ->filter(fn($i) => $i['product_id'] !== $productId)
            ->values()
            ->toArray();
        $this->save();
    }

    public function updateItemQuantity(int $productId, int $quantity): void
    {
        $this->items = collect($this->items ?? [])->map(function ($item) use ($productId, $quantity) {
            if ($item['product_id'] === $productId) {
                $item['quantity'] = $quantity;
            }
            return $item;
        })->toArray();
        $this->save();
    }

    public function clear(): void
    {
        $this->items    = [];
        $this->discount = 0;
        $this->save();
    }
}
