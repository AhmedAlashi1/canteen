<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    protected $fillable = ['child_id', 'user_id', 'type', 'items'];

    protected $casts = [
        'items' => 'array',
    ];
}
