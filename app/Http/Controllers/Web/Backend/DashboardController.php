<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\User;
use App\Models\Setting;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function index(){
        return view('backend.layouts.index');
    }

    public function showAllDrivers(Request $request){
        
        if ($request->ajax()) {
            $data = User::where('status','0')->get();

            return DataTables::of($data)
            ->addIndexColumn()
          
            ->addColumn('action', function ($data) {
                $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                $html .= '<a href="' . route('inspection.details', $data->email) . '" class="btn btn-sm btn-primary"><i class="">Inspection</i></a>';
                $html .= '</div>';
                return $html;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('backend.layouts.driver.index');
    }

    public function showAllInspections(Request $request , $email){

        $allInspections = Inspection::where('email',$email)->get();
        $driverName = User::where('email', $email)->first();
        return view('backend.layouts.driver.inspection', compact('allInspections','driverName'));
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
        return $pdf->download('Inspection.pdf');

    }

    public function privacy(){
        $page = Setting::where('status' , 1)->first();
        return view('backend.layouts.settings.privacy', compact('page'));
    }

    public function privacystore(Request $request ){

        $validator = Validator::make($request->all(), [
            'title'=> 'string|required',
            'body'=> 'required|string',
            'status' => 'required',
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }

            // $domain = request()->root().'/'.Str::slug($request->title);
            $privacy = Setting::updateOrCreate(
                ['status'=> 1],
                ['body'=> $request->body,'status'=> $request->status, 'title' => $request->title],
                );

                if($privacy){
                    return redirect()->back()->with('success','Privacy policy successfully updated');
                }else{
                    return redirect()->back()->with('error','Privacy policy update process failed');
                } 
        }


        public function term_condition(){
            $page = Setting::where('status' , 2)->first();
            return view('backend.layouts.settings.term&condition', compact('page'));
        }
    
        public function term_conditionstore(Request $request ){
    
            $validator = Validator::make($request->all(), [
                'title'=> 'string|required',
                'body'=> 'required|string',
                'status' => 'required',
                ]);
    
                if($validator->fails()){
                    return redirect()->back()->withErrors($validator)->withInput();
                }
    
                $privacy = Setting::updateOrCreate(
                    ['status'=> 2],
                    ['body'=> $request->body,'status'=> $request->status, 'title' => $request->title],
                    );
    
                    if($privacy){
                        return redirect()->back()->with('success','Privacy policy successfully updated');
                    }else{
                        return redirect()->back()->with('error','Privacy policy update process failed');
                    } 
            }

}
