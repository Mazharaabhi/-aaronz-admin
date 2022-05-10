<?php

namespace App\Http\Controllers;
use App\Models\WaterMarkImages;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\isEmpty;

class WaterMarkSettingsController extends Controller
{
    public function index(){

        if(WaterMarkImages::exists()){
           $logoimg = WaterMarkImages::find(1);
        } else {
            $logoimg = '';
         }
        return view('admin.settings.watermark.index')->with(['logoimg' => $logoimg]);
    }

    public function imageFileUpload(Request $request){
       // return $request->all();
        $input['file'] =  $request->file('file')->store('WaterMarks', 's3');
        $url = Storage::disk('s3')->url($input['file']);
        $logoimg = WaterMarkImages::find(1);

        if(WaterMarkImages::exists()){

        $logoimg->where('id',1)
        ->update(['file_name' => $url,'width' =>  $request->width]);
          return $url;
            }else{

            $imgFile = new WaterMarkImages;
            $imgFile->file_name = $url;
            $imgFile->width = $request->width;
            $imgFile->save();
            return $url;
        }
    }
    public function position(Request $request){
        $pos =  $request->get('position');
        $logoimg = WaterMarkImages::find(1);
        if(WaterMarkImages::exists()){
            $logoimg->where('id',1)
            ->update(['position' => $pos]);
              return $pos;
        }

    }
    public function logo_width(Request $request){
        $logo_width =  $request->get('logo_width');
        $logoimg = WaterMarkImages::find(1);
        if(WaterMarkImages::exists()){
            $logoimg->where('id',1)
            ->update(['width' => $logo_width]);
              return $logo_width;
        }

    }
    public function opacity(Request $request){
       // return $request->all();
        $opas =  $request->get('opacity');
        $logoimg = WaterMarkImages::find(1);
        if(WaterMarkImages::exists()){
            $logoimg->where('id',1)
            ->update(['opacity' => $opas]);
              return $opas;
        }

    }

}
