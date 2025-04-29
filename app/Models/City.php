<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'image',
        'status',
        'code',
        'country_code',
    ];

    public function regions()
    {
        return $this->hasMany(Region::class);
    }

}
