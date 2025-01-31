<?php

namespace App\Http\Controllers\Web\Backend;

use App\Models\Advertisemen;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class AdvertisementController extends Controller
{
    //
    public function adds_create(Request $request){
            return view("backend.layouts.adds.create");
    }

    public function adds_store(Request $request){
        $add = new Advertisemen;

        if ( $request->file('photo') != null) {
            $Image = $request->file('photo');
            $extension = $request->file('photo')->getClientOriginalExtension();
            $imageName = rand(10,9999).'photo.'.$extension;
            $Image->move( public_path( 'upload/'), $imageName);
        }
        else{
            $imageName = '';
        }
        
        $add->image = $imageName;
        $add->details = $request->url;
        $add->save();

        return view("backend.layouts.adds.index", compact("add"));
    }

    public function showAlladvertisement(Request $request)
{
    if ($request->ajax()) {
        $data = Advertisemen::get();  

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('image', function ($data) {
                $path = asset('upload/' . $data->image);
                $img = '<img src="' . $path . '" width="120px" alt="Advertisement Image"/>';
                return $img;
            })
          
            ->addColumn('action', function ($data) {
                $html = '<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">';
                $html .= '<form method="POST" action="' . route('advertisement.destroy', $data->id) . '" style="display:inline;">';
                $html .= csrf_field();  
                $html .= '<button type="submit" class="btn btn-danger btn-sm text-white" title="Delete" onclick="return confirm(\'Are you sure?\')">';
                $html .= '<i class="bx bxs-trash"></i> Delete';
                $html .= '</button>';
                $html .= '</form>';
                $html .= '</div>';
                return $html;
            })
            
            ->rawColumns(['action', 'image'])
            ->make(true);
    }
    return view('backend.layouts.adds.index');
}




    public function deleteAdvertisement($id)
    {
        
        try {
            $advertisement = Advertisemen::findOrFail($id);
            $advertisement->delete();
            return redirect()->route('show.all.advertisement');
            
        } catch (\Exception $e) {
            return redirect()->back()->with("t-error","Advertisement not deleted.");
        }
    }
    

}
