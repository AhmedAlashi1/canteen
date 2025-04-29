<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'city_id',
        'region_id',
        'block',
        'street_name',
        'building_no',
        'user_id',
        'is_default',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    //$rulesApi
    public static $rulesApi = [
        'location' => 'required|string|max:255',
        'city_id' => 'required|exists:cities,id',
        'region_id' => 'required|exists:regions,id',
        'block' => 'required|string|max:255',
        'street_name' => 'required|string|max:255',
        'building_no' => 'required|string|max:255',
        'is_default' => 'boolean',
    ];

}
