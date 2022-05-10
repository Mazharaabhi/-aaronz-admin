<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Locations\LocationCountry;
use App\Models\Locations\LocationState;
use App\Models\Properties\Icon;
use App\Models\Admin\SellWithUsContact;
use App\Models\Admin\Settings\Language;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellWithUsController extends Controller
{
    //TODO: For Loading states Index Page
    public function index(Request $request)
    {
        if($request->ajax())
        {
            $sell_with_us = SellWithUsContact::orderBy('id', 'DESC')->get();
            return Datatables::of($sell_with_us)
            ->addIndexColumn()
            ->addColumn('action', function ($sell_with_us){
                    return '
                     <a href="'.route('sell-with-us.edit', ['id' => $sell_with_us->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                     <span class="svg-icon svg-icon-md svg-icon-primary">
                     <svg xmlns="http://www.w3.org/2000/svg" width="579.787" height="388.504" viewBox="0 0 579.787 388.504">
                     <g id="Layer_2" data-name="Layer 2" transform="translate(0 0.017)">
                       <g id="Layer_1" data-name="Layer 1">
                         <path id="Path_254" data-name="Path 254" d="M278.59,0C360.36.27,421,24.62,475.53,66c41,31.09,75,68.66,102.53,112,1.54,2.4,2.37,7,1.12,9.19C539.37,256.92,488.21,316,417,355.33c-50.27,27.74-104.19,38.87-161.4,30.36-47.8-7.12-89.56-28.31-127.74-57C76.39,290,35.2,242,1.05,187.74c-1.31-2.08-1.44-6.44-.13-8.41,45.33-67.82,102.14-122.74,177.82-156C214.44,7.7,251.87-.44,278.59,0Zm11.48,315c65.38,0,120.65-54.21,120.7-118.38,0-68-53.24-123.18-119.1-123.21-68.11,0-122.91,53.67-122.88,120.4A121.39,121.39,0,0,0,290.07,315Z"/>
                         <path id="Path_255" data-name="Path 255" d="M290.15,121.5c41.19,0,72.52,31.83,72.5,73.62,0,40.43-32.17,71.83-73.49,71.82-40.92,0-72.13-32.08-72.09-74C217.11,153,249.38,121.49,290.15,121.5Z"/>
                       </g>
                     </g>
                   </svg>
                    </span>
                    </a>
                    <input type="hidden" name="id" value="'.$sell_with_us->id.'">';
            })
            ->rawColumns(['action'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
          return view('admin.inquires.index');
    }
      //View Inquires / SEll With Us//
     public function edit($id){
        $inquery = SellWithUsContact::where('id',$id)->first();
        return view('admin.inquires.edit', compact('inquery'));
    }

}
