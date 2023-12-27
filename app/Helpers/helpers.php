<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\UserImages;

class UploadImageHelper {

    // use static before method name , bcz call these methods on the class itself, without needing to create an instance of the class
    public static function uploadImage($request, $img, $userId)
    {
        if ($request->$img) {
            $images = $request->file($img);
            
            foreach ($images as $file) {
                $imageName = time() . '_' . $file->getClientOriginalName();
                $userFolder = 'public/images/' . $userId;
                
                Storage::putFileAs($userFolder, $file, $imageName);
        
                UserImages::create([
                    'user_id' => $userId,
                    'image' => $imageName
                ]);
            }
        }
    }

    public static function deleteExistingImage($oldImg , $userId)
    {
        if($oldImg){
            $imagePath = 'storage/images/' . '/' . $userId . '/' . $oldImg;
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }   
    }
}
?>