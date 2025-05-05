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
}

