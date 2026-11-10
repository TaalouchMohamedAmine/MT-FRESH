<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Order extends Model
{
    public const STATUSES = ['new', 'preparing', 'delivered', 'cancelled'];

    protected $fillable = [
        'public_id', 'order_number', 'customer_name', 'phone', 'fulfillment_type', 'address', 'notes', 'status',
        'payment_method', 'locale', 'currency', 'subtotal', 'delivery_fee', 'total',
    ];

    protected function casts(): array
    {
        return [
            'subtotal' => 'decimal:3',
            'delivery_fee' => 'decimal:3',
            'total' => 'decimal:3',
        ];
    }

    protected static function booted(): void
    {
        static::creating(function (Order $order): void {
            $order->public_id ??= (string) Str::uuid();
        });
    }

    public function getRouteKeyName(): string
    {
        return 'public_id';
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }
}
