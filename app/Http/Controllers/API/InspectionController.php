<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
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

            'carrier' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'date' => 'nullable|string|max:255',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'tractor_category' => 'nullable|string',
            'truck_on' => 'nullable',
            'odometer_reading' => 'nullable|string|max:255',
            'trailer_category' => 'nullable|string|max:255',
            'trailer_no' => 'nullable',
            'remark' => 'nullable',
            'signature_image' => 'nullable',
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
            'user_id' => Auth::user()->id,
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
        if ($inspection->save()) {

        // For testing purposes, return the OTP in the response
        return response()->json([
            'status'    => true,
            'message'   => 'Inspection creation completed.',
            'code'      => '200',
        ], 200);
        } else {
            return response()->json([
                'status'=> false,
                'message'=> 'Inspection creation failed',
                'code'=> '422',
            ], 422);
        }
    }


    public function update(Request $request , $id)
    {
        $validator = Validator::make($request->all(), [
            'carrier' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'date' => 'nullable|string|max:255',
            'start_time' => 'nullable',
            'end_time' => 'nullable',
            'tractor_category' => 'nullable|string',
            'truck_on' => 'nullable',
            'odometer_reading' => 'nullable|string|max:255',
            'trailer_category' => 'nullable|string|max:255',
            'trailer_no' => 'nullable',
            'remark' => 'nullable',
            'signature_image' => 'nullable',
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
            $driver->user_id = Auth::user()->id;
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


    public function showAllInspections(Request $request){

        $email = Auth::user()->email;
        $allInspections = Inspection::where('email',$email)->get();
        $driverName = User::where('email', $email)->pluck('name','id')->first();

        $data = [
            'inspection'=> $allInspections,
            'driver'=> $driverName,
        ];

        return response()->json(
            [
                'data' => $data,
                'message' => 'Driver name and inspection retrieved successfully',
                 'code' => 200,
            ],
            200);
        // return view('backend.layouts.driver.inspection', compact('allInspections','driverName'));
    }



    public function pdf_inspection(Request $request , $id){
        
        $inspection = Inspection::where('id',$id)->with('user')->first();

        $tractorCategory = explode(',', $inspection->tractor_category);

        $tailorCategory = explode(',', $inspection->trailer_category);

        $data = [
            'inspection' => $inspection,
            'tractorCategory' => $tractorCategory,
            'tailorCategory' => $tailorCategory,
        ];

        
        $pdf = Pdf::loadView('backend.layouts.driver.pdfInspection', $data);

        $fileName = 'inspection_' . time() . '.pdf';

        $pdfPath = public_path('upload/' . $fileName);
        $pdf->save($pdfPath);
        $pdfPath = asset('upload/' . $fileName);

        return response()->json([
                    'status'=> true,
                    'message'=> 'PDF generated successfully',
                    'data' => [
                        'link' => $pdfPath,
                        ],
                    'code'=> '200',
                    ],200); 

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
