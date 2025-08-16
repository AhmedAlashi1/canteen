<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;

class School extends Model implements AuthenticatableContract
{
    use Authenticatable;
    use HasFactory;

    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'address',
        'levels',
        'phone1',
        'phone2',
        'email',
        'location',
        'image',
        'status',
        'city_id',
        'region_id',
        'password',
        'website_url',
        'instagram_url',

    ];
    protected $casts = [
        'status' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }

}
