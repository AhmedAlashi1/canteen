<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = ['child_id', 'user_id', 'type', 'items','product_id', 'quantity','product_size_id'];

    protected $casts = [
        'items' => 'array',
    ];

    public function child()
    {
        return $this->belongsTo(Child::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
