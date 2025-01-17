<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inspection;
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
        return view('backend.layouts.driver.inspection', compact('allInspections'));
    }

}
