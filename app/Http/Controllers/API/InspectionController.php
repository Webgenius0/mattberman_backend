<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Inspection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class InspectionController extends Controller
{
    //
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'carrier' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'tractor_category' => 'required|string',
            'truck_on' => 'required',
            'odometer_reading' => 'required|string|max:255',
            'trailer_category' => 'required|string|max:255',
            'trailer_no' => 'required',
            'remark' => 'required',
            'signature_image' => 'required',

        ]);

        if ($validator->fails()) {

            return response()->json([
                'status'    => false,
                'message'   => 'Validation errors',
                'errors'    => $validator->errors(),
                'code'      => '422',
            ], 422);

        }

        $signatureImage = $request->file('signature_image');
        $extension = $request->file('signature_image')->getClientOriginalExtension();
        $file = rand(10,9999).'inspection_image.'.$extension;
        $filePath = $signatureImage->move( public_path( 'upload/'), $file);

        // Create the user but set is_verified to false
        $inspection = Inspection::create([

            'email'       => Auth::user()->email,
            'carrier'=> $request->input('carrier'),
            'address'=> $request->input('address'),
            'date'=> $request->input('date'),
            'start_time'=> $request->input('start_time'),
            'end_time'=> $request->input('end_time'),
            'tractor_category'=> $request->input('tractor_category'),
            'truck_no'=> $request->input('truck_on'),
            'odometer_reading'=> $request->input('odometer_reading'),
            'trailer_category'=> $request->input('trailer_category'),
            'trailer_no'=> $request->input('trailer_no'),
            'remark'=> $request->input('remark'),
            'signature_image'=> $filePath,
            
        ]);

        // For testing purposes, return the OTP in the response
        return response()->json([

            'status'    => true,
            'message'   => 'Inspection creation completed.',
            'code'      => '200',

        ], 200);
    }


    public function update(Request $request , $id)
    {

        $validator = Validator::make($request->all(), [
            'carrier' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'date' => 'required|string|max:255',
            'start_time' => 'required',
            'end_time' => 'required',
            'tractor_category' => 'required|string',
            'truck_on' => 'required',
            'odometer_reading' => 'required|string|max:255',
            'trailer_category' => 'required|string|max:255',
            'trailer_no' => 'required',
            'remark' => 'required',
            'signature_image' => 'required',
        ]);


        if ($validator->fails()) {
            return response()->json([
                'status'    => false,
                'message'   => 'Validation errors',
                'errors'    => $validator->errors(),
                'code'      => '422',
            ], 422);
        }


        $driver = Inspection::find($id);
        if($driver && File::exists($driver->signature_image)){
            File::delete($driver->signature_image);
        }


        $signatureImage = $request->file('signature_image');
        $extension = $signatureImage->getClientOriginalExtension();
        $file = rand(10,9999).'inspection_image.'.$extension;
        $filePath = $signatureImage->move( public_path( 'upload/'), $file);


            $driver->email       = Auth::user()->email;
            $driver->carrier = $request->input('carrier');
            $driver->address = $request->input('address');
            $driver->date = $request->input('date');
            $driver->start_time = $request->input('start_time');
            $driver->end_time = $request->input('end_time');
            $driver->tractor_category = $request->input('tractor_category');
            $driver->truck_no = $request->input('truck_on');
            $driver->odometer_reading = $request->input('odometer_reading');
            $driver->trailer_category = $request->input('trailer_category');
            $driver->trailer_no = $request->input('trailer_no');
            $driver->remark = $request->input('remark');
            $driver->signature_image = $filePath;
            $driver->save();

        // For testing purposes, return the OTP in the response
        return response()->json([
            'status'    => true,
            'message'   => 'Inspection updatation completed.',
            'code'      => '200',
        ], 200);

    }

    public function destroy($id)
    {
        try{
            $driver = Inspection::find($id);

            $driver->delete();
            return response()->json([
                'status'=> true,
                'message'=> 'Your Inspection deleted successfully',
                'code'=> '200',
                ],200); 
        }
        catch(\Exception $e){
            return response()->json([
                'status'=> false,
                    'message'=> 'Error to delete',
                    'code'=> '502',
                    ],502);
                }
       
    }
}
