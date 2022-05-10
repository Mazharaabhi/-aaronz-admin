<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Portal;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Settings\Language;
class PortalsController extends Controller
{
    //TODO: For Loading IMPORT PORTAL Index Page
    public function index(Request $request)
    {
        $portals = Portal::where('portal_type',0)->get();
        return view('portals.index',compact('portals'));
    }

    //loading Create IMPORT PORTAL
    public function create(){
        return view('portals.create');
    }

    //creating new Import Portal here
    public function create_process(Request $request){
         $CheckDeveloperName = Portal::where(['name'=>$request->title,'portal_type'=>0])->first();
         if(!is_null($CheckDeveloperName)){
             return 'title';
         }
         $portal = new Portal;
         if($request->hasFile('image'))
         {
            $portal->image = $request->file('image')->store('PortalLogoImage', 'public');
         }
         $portal->name = $request->title;
         $portal->description = $request->description;
         $portal->time_duration = $request->time_duration;
         $portal->xml_link = $request->xml_link;
         $portal->save();
         return 'true';
     }

      //loading edit Import portal view
    public function edit($id){
        $portal = Portal::where('id',$id)->first();
        return view('portals.edit', compact('portal'));
    }

      //editing Import portal here
      public function edit_process(Request $request){

        $CheckDeveloperName = Portal::where(['name'=>$request->title,'portal_type'=>0])->first();
        if(!is_null($CheckDeveloperName)){
            if($CheckDeveloperName->id != $request->id){
            return 'title';
            }
        }
        //updating Import portal here
        $portal = Portal::find($request->id);
        if($request->hasFile('image'))
        {
            $portal->image = $request->file('image')->store('PortalLogoImage', 'public');
        }
        $portal->name = $request->title;
        $portal->description = $request->description;
        $portal->time_duration = $request->time_duration;
        $portal->xml_link = $request->xml_link;
        $portal->update();
        return 'true';
    }
    //TODO:for changing status
    public function change_status(Request $request){
        $ctype = Portal::where('id', $request->id)->first();

        if ($ctype->status == 1) {
            Portal::where('id', $request->id)->update(['status' => 0]);
        } else {
            Portal::where('id', $request->id)->update(['status' => 1]);
        }

        echo $ctype->status;
    }

     //TODO:for delete Portal
     public function delete(Request $request)
     {
        Portal::where('id', $request->id)->delete();

     }

     //TODO: For Loading Export PORTAL Index Page
    public function index_export(Request $request)
    {
        $portals = Portal::where('portal_type',1)->orderBy('id','DESC')->get();
        return view('export-portals.index',compact('portals'));
    }

    //loading Create Export PORTAL
    public function create_export(){
        return view('export-portals.create');
    }

    //creating new Export Portal here
    public function create_export_process(Request $request){
         $CheckDeveloperName = Portal::where(['name'=>$request->title,'portal_type'=>1])->first();
         if(!is_null($CheckDeveloperName)){
             return 'title';
         }
         $portal = new Portal;
         if($request->hasFile('image'))
         {
            $portal->image = $request->file('image')->store('PortalLogoImage', 'public');
         }
         $portal->name = $request->title;
         $portal->description = $request->description;
         $portal->xml_link = $request->xml_link;
         $portal->portal_type = 1;
         $portal->save();
         return 'true';
     }

      //loading edit Export portal view
    public function edit_export($id){
        $portal = Portal::where('id',$id)->first();
        return view('export-portals.edit', compact('portal'));
    }

      //editing Export portal here
      public function edit_export_process(Request $request){

        $CheckDeveloperName = Portal::where(['name'=>$request->title,'portal_type'=>1])->first();
        if(!is_null($CheckDeveloperName)){
            if($CheckDeveloperName->id != $request->id){
            return 'title';
            }
        }
        //updating Export portal here
        $portal = Portal::find($request->id);
        if($request->hasFile('image'))
        {
            $portal->image = $request->file('image')->store('PortalLogoImage', 'public');
    }
        $portal->name = $request->title;
        $portal->description = $request->description;
        $portal->xml_link = $request->xml_link;
        $portal->update();
        return 'true';
    }
}
