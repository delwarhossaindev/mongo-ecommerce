<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    const STATUS_PENDING    = 'pending';
    const STATUS_PROCESSING = 'processing';
    const STATUS_SHIPPED    = 'shipped';
    const STATUS_DELIVERED  = 'delivered';
    const STATUS_CANCELLED  = 'cancelled';
    const STATUS_REFUNDED   = 'refunded';

    const PAYMENT_PENDING  = 'pending';
    const PAYMENT_PAID     = 'paid';
    const PAYMENT_FAILED   = 'failed';
    const PAYMENT_REFUNDED = 'refunded';

    protected $fillable = [
        'order_number',
        'user_id',
        'items',
        'shipping_address',
        'billing_address',
        'subtotal',
        'shipping_cost',
        'discount',
        'tax',
        'total',
        'status',
        'payment_status',
        'payment_method',
        'payment_data',
        'notes',
        'shipped_at',
        'delivered_at',
    ];

    protected $casts = [
        'items'            => 'array',
        'shipping_address' => 'array',
        'billing_address'  => 'array',
        'payment_data'     => 'array',
        'subtotal'         => 'float',
        'shipping_cost'    => 'float',
        'discount'         => 'float',
        'tax'              => 'float',
        'total'            => 'float',
        'shipped_at'       => 'datetime',
        'delivered_at'     => 'datetime',
    ];

    protected $attributes = [
        'status'         => self::STATUS_PENDING,
        'payment_status' => self::PAYMENT_PENDING,
        'shipping_cost'  => 0,
        'discount'       => 0,
        'tax'            => 0,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->order_number = 'ORD-' . strtoupper(uniqid());
        });
    }
}
