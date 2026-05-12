<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'city',
        'total_amount',
        'discount_amount',
        'final_amount',
        'status',
        'payment_method',
        'order_note',
        'admin_note',
    ];

    /**
     * Relationship with user.
     */
    public function user()
    {
        return $this->belongsTo(\App\Models\User::class)->nullable();
    }

    /**
     * Relationship with order items.
     */
    public function orderItems()
    {
        return $this->hasMany(\App\Models\OrderItem::class);
    }
}