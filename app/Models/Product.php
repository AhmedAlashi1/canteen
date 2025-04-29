<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'cat_id',
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'image',
        'status',
        'school_id',
        'price',
        'type',
        'supplier_id',
        'quantity',
    ];

    protected $casts = [
        'price' => 'float',
        'quantity' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    public function sizes()
    {
        return $this->hasMany(ProductSize::class);
    }
    //images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
