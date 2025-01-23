<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    //
    public function admin_profile(){
        $admin = User::where("status","=","1")->first();
        return view("backend.layouts.settings.profile", compact("admin"));
    }

    public function admin_profile_update(Request $request){
        $admin = User::where("status",operator: "=","1")->first();

        if ($admin->image != null) {
            if (File::exists(asset('upload/'.$admin->image))) {
                File::delete(asset('upload/'.$admin->image));
            }
        }

        $Image = $request->file('photo');
        $extension = $request->file('photo')->getClientOriginalExtension();
        $imageName = rand(10,9999).'photo.'.$extension;
        $Image->move( public_path( 'upload/'), $imageName);

        $admin->name = $request->name;
        $admin->image = $imageName;
        $admin->save();

        return redirect()->back()->with('t-success','Data updated.');
    }


    public function password(){
        return view('backend.layouts.settings.changePassword');
    }


    public function changePassword(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'oldPass' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

        $success = $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);
        if ($success) {
        return redirect()->back()->with('t-success', 'password-updated');
        } else {
            return redirect()->back()->with('t-error', 'An error to update password, try again');
        }
    }
    
}
