<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

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

}
