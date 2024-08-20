<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    function index(){
        return view('admins.index');
    }

    function edit(){
        $admin = Auth::user();
        return view('admins.edit', compact('admin'));
    }

    function editProfile(Request $request){
        $request->validate([
            'name' => 'required',
            'old_password' => 'required_with:password',
            'password' => 'nullable|min:8|confirmed',
        ]);
        /** @var User $admin */
        $admin = Auth::user();

        $data = [
            'name' => $request->name,
        ];


        if($request->has('password')){
            $data['password'] = $request->password;
        }

        $admin->update($data);

        if($request->hasFile('image')){
            if($admin->image){
                $admin->image()->delete();
                file::delete(public_path('images/'.$admin->image->path));
            }
            $img_name = rand().time().'.'.$request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(public_path('images'),$img_name);
            $admin->image()->create([
                'path' => $img_name,
            ]);
        }


        return redirect()->back()->with('msg', 'Updated Successflly');
    }
    public function checkPassword(Request $request){
        // return dd($request->all());
        return Hash::check($request->password, Auth::user()->password);
    }

    public function orders(){
        if(request()->has('id')){
            $id = request()->id;
            Auth::user()->notifications->find($id)->markAsRead();
            return request()->id;
        }

        return Order::all();

    }


}
