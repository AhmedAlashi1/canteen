<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDay extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'date',
        'day',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
