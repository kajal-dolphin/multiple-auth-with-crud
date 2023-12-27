<?php

namespace App\Traits;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

trait UploadImageTrait
{
    public function uploadImage($request, $img, $userId)
    {
        if ($request->hasFile($img)) {

            $imageName = time() . '.' . $request->$img->extension();
        
            $userFolder = 'public/images/' . $userId;
        
            Storage::putFileAs($userFolder, $request->file($img), $imageName);
        
            $user['image'] = User::where('id', $userId)->update([
                'image' => $imageName,
            ]);
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