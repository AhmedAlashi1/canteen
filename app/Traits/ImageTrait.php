<?php

namespace App\Traits;

use Illuminate\Http\Request;

trait ImageTrait {


    public function uploadImage($folder,$image){
        $image->store('/',$folder);
        $filename = $image->hashName();
        $path = 'images/' . $filename;
        return $path;
    }

}
