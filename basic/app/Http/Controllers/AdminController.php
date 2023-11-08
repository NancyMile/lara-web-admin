<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
     /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout successfully',
            'alert-type' => 'success'
        );
        return redirect('/login')->with($notification);
    }

    //user profile
    public function profile()
    {
        //find logged user
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile',compact('adminData'));
    }

    //edit profile
    public  function edit()
    {
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit',compact('editData'));
    }

    public function store(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name =$request->name;
        $data->email =$request->email;
        $data->username =$request->username;

        if($request->file('profile_image'))
        {
            $file = $request->file('profile_image');

            @unlink(public_path('upload/admin_images/'.$data->profile_image));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data->profile_image = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile updated successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    //change password view
    public function changePassword()
    {
        return view('admin.admin_change_password');
    }

    //update password
    public function updatePassword(Request $request)
    {
        $validateData = $request->validate([
            'oldPassword' => 'required',
            'newPassword' => 'required',
            'confirmPassword' => 'required|same:newPassword'
        ]);

        /** the the current user pass and check that it matches
         *  with the old pass then chance bcrypt the new pass and save
         */
        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->oldPassword,$hashedPassword))
        {
            $user = User::find(Auth::id());
            $user->password = bcrypt($request->newPassword);
            $user->save();

            session()->flash('message','Password Updated');
            return redirect()->back();
        }else
        {
            session()->flash('message','Old Password no matching.');
            return redirect()->back();
        }
    }
}
