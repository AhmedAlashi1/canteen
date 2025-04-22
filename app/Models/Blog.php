<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [ 'image', 'title_en','content_en' , 'title_ar','content_ar','by','is_default','blog_type_id'
        ,'date','desc_en','desc_ar','short_link','title_html_ar','title_html_en','desc_html_ar','desc_html_en','key_url'];

    public function blog_type()
    {
        return $this->belongsTo('App\Models\Blog_Type', 'blog_type_id');
    }

}
