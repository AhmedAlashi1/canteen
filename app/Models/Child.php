<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    use HasFactory;

    protected $fillable = [
        'school_id',
        'user_id',
        'name',
        'level',
        'student_number',
        'image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function school()
    {
        return $this->belongsTo(School::class);
    }

    public static $rulesApi = [
        'school_id' => 'required|exists:schools,id',
        'name' => 'required|string|max:255',
        'level' => 'required|string|max:255',
        'student_number' => 'required|string|max:255',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ];


}
