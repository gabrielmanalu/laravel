<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function destroy(Request $request)    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Logout Successfully',
            'alert-type' => 'success'
        );

        return redirect('/login')->with($notification);
    } // End Method

    public function profile(){
        $id = Auth::user()->id;
        $adminData = User::find($id);
        return view('admin.admin_profile_view', compact('adminData'));
    }

    public function editProfile(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_profile_edit', compact('editData'));
    }

    public function storeProfile(Request $request){
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->username = $request->username;

        if($request->file('profile_image')) {
            $file = $request->file('profile_image');

            @unlink(public_path('upload/admin_images/'.$data->profile_image));

            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['profile_image'] = $filename;
        }
        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.profile')->with($notification);
    }

    public function changePassword(){
        $id = Auth::user()->id;
        $editData = User::find($id);
        return view('admin.admin_change_password', compact('editData'));
    }

    public function updatePassword(Request $request){
        $valideData = $request->validate([
            'old_password' => 'required',
            'new_password' => 'required',
            'confirm_password' => 'required|same:new_password'
        ]);

        $hashedPassword = Auth::user()->password;

        $notification = array(
            'message' => 'Use Another Password',
            'alert-type' => 'error'
        );

        if (Hash::check($request->old_password, $hashedPassword)) {

            if (Hash::check($request->new_password, $hashedPassword)){
                return redirect()->back()->with($notification);
            }
            else {
                $users = User::find(Auth::id());
                $users->password = bcrypt($request->new_password);
                $users->save();

                session()->flash('message', 'Password Updated Successfully');
                return redirect()->back();
            }
        } else {
            session()->flash('message', 'Password is wrong');
            return redirect()->back();

        }
    }
}
