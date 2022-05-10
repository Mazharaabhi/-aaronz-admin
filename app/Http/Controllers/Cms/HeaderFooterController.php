<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\NewsCategory;
use App\Models\Cms\HeaderFooter;
use App\Models\Properties\Icon;
use App\Models\Admin\Settings\Language;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HeaderFooterController extends Controller
{
    //TODO: For Loading Aminites Index Page
    public function index(Request $request)
    {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $header_footer = HeaderFooter::orderBy('id', 'DESC')->where(['lang_id' => 1])->get();
        if($request->ajax())
        {
            return Datatables::of($header_footer)
            ->addIndexColumn()
            ->addColumn('header_logo', function($header_footer) {
                if($header_footer->header_logo != "")
                {
                    return '<img loading="lazy" src="'.$header_footer->header_logo.'" height="50px" width="50px"/>';
                }
                else
                {
                    return '-----';
                }
            })
            ->addColumn('footer_logo', function($header_footer) {
                if($header_footer->footer_logo != "")
                {
                    return '<img loading="lazy" src="'.$header_footer->header_logo.'" height="50px" width="50px"/>';
                }
                else
                {
                    return '-----';
                }
            })
            ->addColumn('action', function ($header_footer){
                    return '
                     <a href="'.route('cms.header-footer.edit', ['id' => $header_footer->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                     <span class="svg-icon svg-icon-md svg-icon-primary">
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        </g>
                        </svg>
                    </span>
                    </a>
                    <input type="hidden" name="id" value="'.$header_footer->id.'">
                    ';
            })
            ->rawColumns(['action', 'header_logo', 'footer_logo'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        return view('cms.header-footer.index', compact('header_footer'));
    }

    //loading create view
    public function create(){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404</h1></center>';
        }
        $icons = Icon::all();
        $languages = Language::where('status',1)->get();
        $news_categories = NewsCategory::where(['status' => 1, 'lang_id' => 1])->get();
        return view('cms.header-footer.create',compact('languages', 'icons', 'news_categories'));
    }

    //creating new amenity here
    public function create_process(Request $request){
        return $request->all();
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
         $languages_id = explode (",",$request->languages_names);
         $titles = explode (",",$request->titles);
         $descriptions = explode (",",$request->descriptions);
         $follow_up_descriptions = explode (",",$request->follow_up_descriptions);
         $news_letter_descriptions = explode (",",$request->news_letter_descriptions);
         $header_titles = explode (",",$request->header_titles);
        // return $header_titles;
         $header_short_titles = explode (",",$request->header_short_titles);

         //creating new rank instance here
         $amenity = new HeaderFooter;
         $amenity->favicon = $request->file('favicon')->store('HeaderFooterImages', 'public');
         $amenity->header_logo = $request->file('header_logo')->store('HeaderFooterImages', 'public');
         $amenity->footer_logo = $request->file('footer_logo')->store('HeaderFooterImages', 'public');
         $amenity->address = $request->title_english;
         $amenity->header_title = $request->header_title;
         $amenity->header_short_title = $request->header_short_title;
         $amenity->copy_rights = $request->copy_rights;
         $amenity->email = $request->email;
         $amenity->phone = $request->phone;
         $amenity->fb = $request->fb;
         $amenity->twitter = $request->twitter;
         $amenity->google = $request->google;
         $amenity->youtube = $request->youtube;
         $amenity->description = $request->desc_english;
         $amenity->follow_up_desc = $request->follow_up_desc_english;
         $amenity->news_letter_desc = $request->news_letter_desc_english;
         $amenity->lang_id = 1;
         $amenity->parent_id = 0;
         $amenity->save();
         $parent_id =$amenity->id;
         //UPDATING PARENT ID
         HeaderFooter::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
         //CREATEING OTHER LANGUAGES RECORDS
         for($i=1; $i <count($languages_id) ; $i++ )
         {
             $ame = new HeaderFooter;
             $ame->favicon = $request->file('favicon')->store('HeaderFooterImages', 'public');
             $ame->header_logo = $request->file('header_logo')->store('HeaderFooterImages', 'public');
             $ame->footer_logo = $request->file('footer_logo')->store('HeaderFooterImages', 'public');
             $ame->copy_rights = $request->copy_rights;
             $ame->fb = $request->fb;
             $ame->twitter = $request->twitter;
             $ame->google = $request->google;
             $ame->youtube = $request->youtube;
             $ame->email = $request->email;
             $ame->phone = $request->phone;
             $ame->address = $titles[$i];
             $ame->description = $descriptions[$i];
             $ame->follow_up_desc = $follow_up_descriptions[$i];
             $ame->news_letter_desc = $news_letter_descriptions[$i];
             $ame->header_title = $header_titles[$i];
             $ame->header_short_title = $header_short_titles[$i];
             $ame->lang_id=$languages_id[$i];
             $ame->parent_id=$parent_id;
             $ame->save();
         }
         return 'true';
     }

      //loading edit amenity view
    public function edit($id){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $languages = Language::where('status',1)->get();
        $rank = HeaderFooter::where('id',$id)->first();
        for($i = 1; $i < count($languages) ; $i++)
        {
            $checkLanguageHeaderFooter = HeaderFooter::where(['parent_id' => $id, 'lang_id' => $languages[$i]['id']])->first();
            if(is_null($checkLanguageHeaderFooter))
            {
                $nav = new HeaderFooter;
                $nav->address = $rank->address;
                $nav->favicon = $rank->favicon;
                $nav->header_logo = $rank->header_logo;
                $nav->footer_logo = $rank->footer_logo;
                $nav->header_title = $rank->header_title;
                $nav->header_short_title = $rank->header_short_title;
                $nav->copy_rights = $rank->copy_rights;
                $nav->follow_up_desc = $rank->follow_up_desc;
                $nav->news_letter_desc = $rank->news_letter_desc;
                $nav->email = $rank->email;
                $nav->phone = $rank->phone;
                $nav->fb = $rank->fb;
                $nav->twitter = $rank->twitter;
                $nav->google = $rank->google;
                $nav->youtube = $rank->youtube;
                $nav->description = $rank->description;
                $nav->lang_id=$languages[$i]['id'];
                $nav->parent_id=$id;
                $nav->save();
            }
        }
        $news_categories = NewsCategory::where(['status' => 1, 'lang_id' => 1])->get();
        $storedData = HeaderFooter::where(['parent_id'=>$id])->get();
        return view('cms.header-footer.edit', compact('rank','languages','storedData', 'news_categories'));
    }

      //editing new rank here
      public function edit_process(Request $request){
        //return $request->all();
        // return $request->id;
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $languages_id = explode (",",$request->languages_names);
        $titles = explode (",",$request->titles);
        $descriptions = explode (",",$request->descriptions);
        $follow_up_descriptions = explode (",",$request->follow_up_descriptions);
        $news_letter_descriptions = explode (",",$request->news_letter_descriptions);
        //creating new rank instance here
        $amenity = HeaderFooter::find($request->id);
        if($request->hasFile('header_logo')){
            $file=$request->file('header_logo')->store('HeaderFooterImages', 's3');
                $url = Storage::disk('s3')->url($file);
            $amenity->header_logo =  $url;
        }
        if($request->hasFile('footer_logo')){
            $file=$request->file('footer_logo')->store('HeaderFooterImages', 's3');
                $url = Storage::disk('s3')->url($file);
            $amenity->footer_logo =  $url;
        }
        if($request->hasFile('favicon')){
            $file=$request->file('favicon')->store('HeaderFooterImages', 's3');
                $url = Storage::disk('s3')->url($file);
            $amenity->favicon =  $url;
        }if($request->hasFile('meta_image')){
            $file=$request->file('meta_image')->store('MetaImages', 's3');
                $url = Storage::disk('s3')->url($file);
            $amenity->bg_image =  $url;
        }
        $amenity->address = $request->title_english;
        $amenity->email = $request->email;
        $amenity->meta_title = $request->meta_title;
        $amenity->meta_descriptions = $request->meta_descriptions;
        $amenity->phone = $request->phone;
        $amenity->follow_up_desc = $request->follow_up_desc;
        $amenity->news_letter_desc = $request->news_letter_desc;
        $amenity->fb = $request->fb;
        $amenity->instagram = $request->instagram;
        $amenity->linkedin = $request->linkedin;
        $amenity->follow_up_desc = $request->follow_up_desc_english;
        $amenity->news_letter_desc = $request->news_letter_desc_english;
        $amenity->twitter = $request->twitter;
        $amenity->google = $request->google;
        $amenity->youtube = $request->youtube;
        $amenity->description = $request->desc_english;
        $amenity->update();
        for($i=1; $i <count($languages_id); $i++)
        {
            $ame = HeaderFooter::where(['lang_id'=>$languages_id[$i],'parent_id'=>$request->id])->first();
            $ame->address = $titles[$i];
            $ame->description = $descriptions[$i];
            $ame->follow_up_desc = $follow_up_descriptions[$i];
            $ame->news_letter_desc = $news_letter_descriptions[$i];
            if($request->hasFile('header_logo')){
                $file=$request->file('header_logo')->store('HeaderFooterImages', 's3');
                    $url = Storage::disk('s3')->url($file);
                $ame->header_logo =  $url;
            }
            if($request->hasFile('footer_logo')){
                $file=$request->file('footer_logo')->store('HeaderFooterImages', 's3');
                    $url = Storage::disk('s3')->url($file);
                $ame->footer_logo =  $url;
            }
            if($request->hasFile('meta_image')){
                $file=$request->file('meta_image')->store('MetaImages', 's3');
                    $url = Storage::disk('s3')->url($file);
                $ame->bg_image =  $url;
            }
            if($request->hasFile('favicon')){
                $file=$request->file('favicon')->store('HeaderFooterImages', 's3');
                    $url = Storage::disk('s3')->url($file);
                $ame->favicon =  $url;
            }
            $ame->email = $request->email;
            $ame->phone = $request->phone;
            $ame->fb = $request->fb;
            $ame->instagram = $request->instagram;
            $ame->linkedin = $request->linkedin;
            $ame->twitter = $request->twitter;
            $ame->google = $request->google;
            $ame->youtube = $request->youtube;
            $ame->update();
        }
        return 'true';
    }
    //TODO:for changing status
    public function change_status(Request $request){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $ctype = HeaderFooter::where('id', $request->id)->first();

        if ($ctype->status == 1) {
            HeaderFooter::where('parent_id', $request->id)->update(['status' => 0]);
        } else {
            HeaderFooter::where('parent_id', $request->id)->update(['status' => 1]);
        }

        echo $ctype->status;
    }

     //TODO:for delete HeaderFooter
     public function delete(Request $request)
     {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
          HeaderFooter::where('parent_id', $request->id)->delete();

     }
}
