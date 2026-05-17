<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'short_description',
        'price',
        'sale_price',
        'cost_price',
        'sku',
        'stock',
        'category_id',
        'images',
        'attributes',
        'variants',
        'is_active',
        'is_featured',
        'rating',
        'review_count',
        'tags',
    ];

    protected $casts = [
        'price'        => 'float',
        'sale_price'   => 'float',
        'cost_price'   => 'float',
        'stock'        => 'integer',
        'is_active'    => 'boolean',
        'is_featured'  => 'boolean',
        'rating'       => 'float',
        'review_count' => 'integer',
        'images'       => 'array',
        'attributes'   => 'array',
        'variants'     => 'array',
        'tags'         => 'array',
    ];

    protected $attributes = [
        'is_active'    => true,
        'is_featured'  => false,
        'rating'       => 0,
        'review_count' => 0,
        'stock'        => 0,
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getEffectivePriceAttribute(): float
    {
        return $this->sale_price > 0 ? $this->sale_price : $this->price;
    }
}
