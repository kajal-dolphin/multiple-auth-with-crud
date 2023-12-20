<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    public function create(){
        return view('admin.user.create');
    }
    public function store(UserRequest $request){
        dd($request->all());
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
    
            if($request->photo)
            {
                $imageName = time() . '.' . $request->photo->extension();
            
                $userFolder = public_path('images') . '/' . $user->id;
                if (!file_exists($userFolder)) {
                    mkdir($userFolder, 0777, true);
                }
        
                $request->photo->move($userFolder, $imageName);
    
                User::where('id',$user->id)->update([
                    'image' => $imageName,
                ]);
            }
    
            if($request->multiple_addresses){
                foreach($request->multiple_addresses as $address){
                    Address::create([
                        'user_id' => $user->id,
                        'address' => $address['address'],
                        'is_default' => isset($address['is_default']) ? '1' : '0',
                    ]);
                }
            }

            return redirect()->route('admin.dashboard')->with('success','User Created Successfully !!');

        } catch (\Throwable $e) {
            return back()->with('error','Something Went Wrong !!');
        }
       
    }

    public function show($id){
        try {
            $user = User::where('id',$id)->with('address')->first();
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
            $user = User::where('id',$id)->with('address')->first();
            $userData = array(
                'data' => $user,
            );
            $html = View('admin.user.edit',$userData)->render();
            return response()->json([
                'html' => $html,
                'success' => true,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'html' => $html,
                'success' => false,
            ]);
        }
    }

    public function update(Request $request){
        try {
            $user = User::where('id',$request->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if($request->photo)
            {
                $imageName = time() . '.' . $request->photo->extension();
            
                $userFolder = public_path('images') . '/' . $request->id;
                if (!file_exists($userFolder)) {
                    mkdir($userFolder, 0777, true);
                }
        
                $request->photo->move($userFolder, $imageName);
    
                User::where('id',$request->user_id)->update([
                    'image' => $imageName,
                ]);

                if($request->old_img){
                    $imagePath = public_path('images') . '/' . $request->id . '/' . $request->old_img;
                    if (file_exists($imagePath)) {
                        unlink($imagePath);
                    }
                }   
            }
            if($request->multiple_addresses){
                $address = Address::where('user_id',$request->id)->delete();
                foreach($request->multiple_addresses as $address){
                    Address::create([
                        'user_id' => $request->id,
                        'address' => $address['address'],
                        'is_default' => isset($address['is_default']) ? '1' : '0',
                    ]);
                }
            }
            
            return response()->json([
                'success' => true,
                'messages' => 'User Updated Successfully'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'messages' => 'User Updation failed'
            ]);
        }
    }

    public function delete($id){
        try {
            $user = User::where('id',$id)->first();
            User::where('id',$id)->delete();
            Address::where('user_id',$id)->delete();

            $imagePath = public_path('images') . '/' . $id . '/' . $user->image;

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
}
