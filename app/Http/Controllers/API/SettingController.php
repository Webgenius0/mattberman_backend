<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    //
    public function privacyView()
    {
        $pagePrivacy = request()->root().'/api/privacy-policy-show';
        return response()->json([
            'success' => true,
            'data' => [
                'pageLink' => $pagePrivacy,
            ],
            'message' => 'Privacy policy link retrieved successfully',
        ], 200);
    }

    public function TermsView()
    {
        $pageTerms = request()->root().'/api/terms-conditions-show';

        return response()->json([
            'success' => true,
            'data' => [
                'pageLink' => $pageTerms,
            ],
            'message' => 'Terms and conditions link retrieved successfully',
        ], 200);
    }

    public function privacyShow(Request $request ){
        $page = Setting::where('status',1)->first();
        return view('backend.layouts.settings.privacyview',compact('page'));
    }
    public function TermsShow(Request $request ){
        $page = Setting::where('status',2)->first();    
        return view('backend.layouts.settings.termsview',compact('page'));
    }


    public function admin_profile_update(Request $request ){

    $id = auth()->user()->id;
        $driver = User::where("id",'=',$id)->first();

        if ($driver->image != null) {
            if (File::exists(asset('upload/'.$driver->image))) {
                File::delete(asset('upload/'.$driver->image));
            }
        }

        if ( $request->file('image') != null) {
            $Image = $request->file('image');
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = rand(10,9999).'image.'.$extension;
            $Image->move( public_path( 'upload/'), $imageName);
        }
        else{
            $imageName = '';
        }
        $driver->name = $request->name;
        $driver->phone = $request->phone;
        $driver->bio = $request->bio;
        $driver->image = $imageName;
        $driver->save();


        return response()->json([
            'success' => true,
            'message' => 'Successfully update.',
        ], 200);

        // return redirect()->back()->with('t-success','Data updated.');
    }

    public function getProfileData(Request $request){
        
        $id = auth()->user()->id;
        $driverProfile = User::where('id',$id)->first();
        // $domain = request()->root().'/public/upload/';

        if ($driverProfile->image != null) {
            $domain = request()->root().'/public/upload/';
        }else{
            $domain = '';
        }

        $data = [
            'id' => $driverProfile->id,
            'name'=> $driverProfile->name,
            'email' => $driverProfile->email,
            'phone'=> $driverProfile->phone,
            'bio'=> $driverProfile->bio,
            'image'=> $domain . $driverProfile->image,
        ];

        return response()->json([
            'success' => true,
            'data'=> $data,
            'message' => 'Successful get data.',
        ], 200);

    }

}
