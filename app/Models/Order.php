<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'child_id',
        'status',
        'total',
        'coupon_id',
        'payment_status',
        'discount',
        'payment_id',
        'transaction_id',
        'address_id',
        'type',
        'shipping_fees',
    ];

    // علاقات مقترحة (اختياري حسب استخدامك)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function child()
    {
        return $this->belongsTo(Child::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }
    public function payment()
    {
        return $this->belongsTo(PaymentMethod::class, 'payment_id');
    }

    public function orderProducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderDays()
    {
        return $this->hasMany(OrderDay::class);
    }

    //apiRo
    public static $rulesApiStore =  [
        'address_id' => 'required|exists:addresses,id',
        'payment_id' => 'required|exists:payment_methods,id',
        'coupon' => 'nullable|string',
        'items' => 'required|array|min:1',
        'items.*.product_id' => 'required|exists:products,id',
        'items.*.product_size_id' => 'nullable|exists:product_sizes,id',
        'items.*.quantity' => 'required|integer|min:1',
    ];

}

