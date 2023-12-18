<?php

namespace App\Http\Controllers\Admin\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(){
        return view('admin.user.create');
    }
    public function store(UserRequest $request){
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
                    'make_as_default' => isset($address['make_as_default']) ? '1' : '0',
                ]);
            }
        }
        return redirect()->route('admin.dashboard')->with('success','User Created successfully !!');
    }
}
