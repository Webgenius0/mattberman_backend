<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\User;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

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
                // $html .='<a href="" onclick="showDriverData(' .
                //         $data->email .
                //         ')" type="button"
                //                 class="btn btn-primary btn-sm text-white" title="Inspection" readonly>
                //                 <i class="">Inspections</i>
                //             </a>';
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
        // if ($request->ajax()) {
        //     $data = User::where('status','0')->get();

        //     return DataTables::of($data)
        //     ->addIndexColumn()
          
        //     // ->addColumn('action', function ($data) {
        //     //     $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
        //     //     $html .= '<a href="' . route('inspection.details', $data->email) . '" class="btn btn-sm btn-primary"><i class="">Inspection</i></a>';
        //         // $html .='<a href="" onclick="showDriverData(' .
        //         //         $data->email .
        //         //         ')" type="button"
        //         //                 class="btn btn-primary btn-sm text-white" title="Inspection" readonly>
        //         //                 <i class="">Inspections</i>
        //         //             </a>';
        //     //     $html .= '</div>';
        //     //     return $html;
        //     // })
        //     // ->rawColumns(['action'])
            
        //     ->make(true);
        // }
        return view('backend.layouts.driver.inspection', compact('allInspections','driverName'));
    }

    public function pdf_inspection(Request $request , $id){
        
        $inspection = Inspection::where('id',$id)->with('user')->first();


        // dd($inspection->user->name);

        $tractorCategory = explode(',', $inspection->tractor_category);

        $tailorCategory = explode(',', $inspection->trailer_category);

        $data = [
            'inspection' => $inspection,
            'tractorCategory' => $tractorCategory,
            'tailorCategory' => $tailorCategory,
        ];

        $pdf = Pdf::loadView('backend.layouts.driver.pdfInspection', $data);
        return $pdf->download('Inspection.pdf');

        // return view('', compact(''));

    }

}
