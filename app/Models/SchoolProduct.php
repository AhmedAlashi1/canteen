<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'school_id',
        'price',
        'quantity',
        'supplier_id',
    ];

    // العلاقة مع المنتجات
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // العلاقة مع المدارس
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    // العلاقة مع الموردين (اختياري)
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
