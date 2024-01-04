<?php

namespace App\Http\Controllers\Admin\User;

use App\Helpers\UploadImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Http\Requests\Admin\UserUpdateRequest;
use App\Models\Address;
use App\Models\User;
use App\Models\UserImages;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Traits\UploadImageTrait;


class UserController extends Controller
{
    use UploadImageTrait;
    public function create(){
        return view('admin.user.create');
    }
    public function store(UserRequest $request){
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),

            ]);

            UploadImageHelper::uploadImage($request, 'photo',$user->id);

            // if ($request->photo) {
            //     $images = $request->file('photo');
                
            //     foreach ($images as $file) {
            //         $imageName = time() . '_' . $file->getClientOriginalName();
            //         $userFolder = 'public/images/' . $user->id;
                    
            //         Storage::putFileAs($userFolder, $file, $imageName);
            
            //         UserImages::create([
            //             'user_id' => $user->id,
            //             'image' => $imageName
            //         ]);
            //     }
            // }
            
            // $this->uploadImage($request, 'photo',$userId = $user->id);
    
            if ($request->multiple_addresses) {
                $userAddresses = [];
                foreach ($request->multiple_addresses as $key => $address) {
                    $userAddresses[] = [
                        'user_id'    => $user->id,
                        'address'    => $address['address'],
                        'is_default' => isset($request->is_default) && $request->is_default == $key ? '1' : 0,
                    ];
                }
                Address::insert($userAddresses);
            }
            
            return redirect()->route('admin.dashboard')->with('success','User Created Successfully !!');

        } catch (\Throwable $e) {
            return back()->with('error','Something Went Wrong !!');
        }
       
    }

    public function show($id){
        try {
            $user = User::where('id',$id)->with('addresses')->first();
            $userData = array(
                'data' => $user,
            );
            $html = View('admin.user.show', $userData)->render();
            return response()->json([
                'success' => true,
                'html' => $html,
                'message' => 'See User Detail'
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => true,
                'message' => 'Something Went Wrong'
            ], 200);
        }
    }

    public function edit($id){
        try {
            $data = User::where('id',$id)->with('addresses','images')->first();
            return view('admin.user.edit',compact('data'));
            // $userData = array(
            //     'data' => $user,
            // );
            // $html = View('admin.user.edit',$userData)->render();
            // return response()->json([
            //     'html' => $html,
            //     'success' => true,
            // ]);
        } catch (\Throwable $e) {
            return back()->with('error','Something Went Wrong !!');
        }
    }

    public function update(UserUpdateRequest $request){
        try {
            $validatedData = $request->validated();
            $user = User::find($request->id);
            $user->update($validatedData);

            // $this->uploadImage($request, 'photo',$userId = $user->id);
            // $this->deleteExistingImage($request->old_img, $request->id);
            // UploadImageHelper::uploadImage($request, 'photo',$request->id);
            // UploadImageHelper::deleteExistingImage($request->old_img, $request->id);

            UploadImageHelper::uploadImage($request, 'photo',$user->id);

            if ($request->multiple_addresses) {
                foreach ($request->multiple_addresses as $key => $address) {
                    $updateData = [
                        'user_id' => $user->id,
                        'address' => $address['address'],
                        'is_default' => isset($request->is_default) && $request->is_default == $key ? '1' : 0,
                    ];
            
                    $addressId = $address['address_id'] ?? null;
            
                    Address::updateOrCreate(['id' => $addressId], $updateData);
                }  
            }
             
            return redirect()->route('admin.dashboard')->with('success','User Updated Successfully !!');

        } catch (\Throwable $e) {
            return back()->with('error','Something Went Wrong !!');
        }
    }

    public function delete($id){
        try {
            $user = User::where('id',$id)->first();
            User::where('id',$id)->delete();
            Address::where('user_id',$id)->delete();

            $imagePath = 'storage/images/' . '/' . $id . '/' . $user->image;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            return response()->json([
                'success' => true,
                'message' => "User Deleted Successfullly !!"
            ],200);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => "Something Went Wrong !!"
            ],200);
        }
    }

    public function deleteImage($id){
        try {
            $img = UserImages::find($id);
            $deleteImg = UserImages::find($id)->delete();

            $imagePath = 'storage/images/' . '/' . $img->user_id . '/' . $img->image;

            if (file_exists($imagePath)) {
                unlink($imagePath);
            }

            return response()->json([
                'success' => true,
                'message' => "Image Deleted Successfullly !!"
            ],200);

        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => "Something Went Wrong !!"
            ],200);
        }
    }

    public function cloneColumn(Request $request){
        try {
            $html = View('admin.user.clone-column',['rowIndex' => $request->rowIndex ])->render();
            return response()->json([
                'html' => $html,
                'success' => true,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function getUserData($id)
    {
        try {
            $userDetail = User::where('id',$id)->with('addresses','images')->first();
            return view('admin.user.show-user-detail',compact('userDetail'));
        } catch (\Throwable $e) {
            return back()->with('error','Something Went Wrong !!');
        }
    }
}
