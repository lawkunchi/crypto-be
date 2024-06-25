<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function uploadImage(Request $request, $fieldName = 'image', $directory = 'courses')
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->file($fieldName);
            $imageName = time().'.'.$file->extension();  
            $file->move(public_path($directory), $imageName);
            $path =  config('app.url').'/'.$directory.'/'.$imageName;
            return $path;
        }
        return null;
    }
}