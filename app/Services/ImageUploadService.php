<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageUploadService
{
    public function uploadImage(Request $request, $fieldName = 'image', $directory = 'public/courses')
    {
        if ($request->hasFile($fieldName)) {
            $path = $request->file($fieldName)->store($directory);
            return Storage::url($path);
        }

        return null;
    }
}