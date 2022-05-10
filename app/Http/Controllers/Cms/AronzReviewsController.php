<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Properties\Icon;
use App\Models\Admin\Settings\Language;
use Yajra\Datatables\Datatables;
use App\Models\Cms\Slider;
use App\Models\Cms\AronzReview;
use Illuminate\Support\Facades\Auth;
class AronzReviewsController extends Controller
{
    //TODO: For Loading Aminites Index Page
    public function index(Request $request)
    {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404</h1></center>';
        }
        if($request->ajax())
        {
            $reviews = AronzReview::where('lang_id',1)->orderBy('id', 'DESC')->get();
            return Datatables::of($reviews)
            ->addIndexColumn()
           ->addColumn('action', function ($reviews){
                    return '
                     <a href="'.route('cms.aronz-reviews.edit', ['id' => $reviews->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                    <input type="hidden" name="id" value="'.$reviews->id.'">
                   <a id="delete_aronz_review" data-id="'.$reviews->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                   <span class="svg-icon svg-icon-md svg-icon-danger">
                   <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                       <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                           <rect x="0" y="0" width="24" height="24"></rect>
                           <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                           <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                       </g>
                   </svg>
                   </span>
                   </a>';
            })
            ->addColumn('status', function($reviews){
                if($reviews->status == 1)
                    {
                        return '
                        <input type="hidden" name="id" value="'.$reviews->id.'">
                        <input type="hidden" name="status" value="'.$reviews->status.'">
                        <a id="change_status" data-id="'.$reviews->id.'" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
                        <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Unlock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <mask fill="white">
                                    <use xlink:href="#path-1"/>
                                </mask>
                                <g/>
                                <path d="M15.6274517,4.55882251 L14.4693753,6.2959371 C13.9280401,5.51296885 13.0239252,5 12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L14,10 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C13.4280904,3 14.7163444,3.59871093 15.6274517,4.55882251 Z" fill="#000000"/>
                            </g>
                        </svg></span>
                        </a>
                        ';
                    }
                    else
                    {
                        return '
                        <input type="hidden" name="id" value="'.$reviews->id.'">
                        <input type="hidden" name="status" value="'.$reviews->status.'">
                        <a id="change_status" data-id="'.$reviews->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Not Active">
                        <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <mask fill="white">
                                <use xlink:href="#path-1"/>
                            </mask>
                            <g/>
                            <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
                        </g>
                        </svg></span>
                        </a>
                        ';
                    }
                })
            ->rawColumns(['action','status' ,'icon'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }
        return view('cms.aronz-reviews.index');
    }

    //loading create view
    public function create(){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404</h1></center>';
        }
        $languages = Language::where('status',1)->get();
        return view('cms.aronz-reviews.create',compact('languages'));
    }

    //creating new amenity here
    public function create_process(Request $request){
       // return $request->all();
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
         $languages = explode (",",$request->languages);
         $company_names = explode (",",$request->company_names);
         $designations = explode (",",$request->designations);
         $titles = explode (",",$request->titles);
        //creating new rank instance here
        $review = new AronzReview;
        $review->company_name = $request->company_name_eng;
        $review->title = $request->title_eng;
        $review->designation = $request->designation_eng;
        $review->review = $request->descriptions[0];
        $review->lang_id = 1;
        $review->parent_id = 0;
        $review->save();
        $parent_id = $review->id;
        AronzReview::where('id',$review->id)->update(['parent_id'=>$parent_id]);
        for($i=1; $i <count($languages) ; $i++)
        {
            $review = new AronzReview;
            $review->company_name = $company_names[$i];
            $review->designation = $designations[$i];
            $review->review = $request->descriptions[$i] != '' ? $request->descriptions[$i] : '';
            $review->title = $titles[$i];
            $review->lang_id = $languages[$i];
            $review->parent_id = $parent_id;
            $review->save();
        }
         return 'true';
     }

      //loading edit amenity view
     public function edit($id){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $review = AronzReview::where('id',$id)->first();
        $languages = Language::where('status',1)->get();

        for($i = 1; $i < count($languages) ; $i++)
        {
            $checkLanguageNews = AronzReview::where(['parent_id' => $id, 'lang_id' => $languages[$i]['id']])->first();
            if(is_null($checkLanguageNews))
            {
                $review = new AronzReview;
                $review->company_name = $review->company_name;
                $review->title = $review->title;
                $review->designation = $review->designation;
                $review->review = $review->review;
                $review->lang_id = $languages[$i];
                $review->parent_id = $review->id;
                $review->save();
            }
        }
        $storedData = AronzReview::where(['parent_id'=>$id])->get();
        return view('cms.aronz-reviews.edit', compact('storedData','review','languages'));
    }
      //editing new rank here
      public function edit_process(Request $request){
        // return $request->all();
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
         $languages = explode (",",$request->languages);
         $company_names = explode (",",$request->company_names);
         $designations = explode (",",$request->designations);
         $titles = explode (",",$request->titles);
        //creating new rank instance here
        $review = AronzReview::find($request->id);
        $review->company_name = $request->company_name_eng;
        $review->title = $request->title_eng;
        $review->designation = $request->designation_eng;
        $review->review = $request->descriptions[0];
        $review->update();
        for($i=1; $i <count($languages) ; $i++)
        {
            $review = AronzReview::where(['lang_id'=>$languages[$i],'parent_id'=>$request->id])->first();
            $review->company_name = $company_names[$i];
            $review->title = $titles[$i];
            $review->designation = $designations[$i];
            $review->review = $request->descriptions[$i] != '' ? $request->descriptions[$i] : '';
            $review->lang_id = $languages[$i];
            $review->parent_id = $request->id;
            $review->update();
        }
         return 'true';
    }
     //TODO:for changing status
     public function change_status(Request $request){
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        $ctype = AronzReview::where('id', $request->id)->first();

        if ($ctype->status == 1) {
            AronzReview::where('parent_id', $request->id)->update(['status' => 0]);
        } else {
            AronzReview::where('parent_id', $request->id)->update(['status' => 1]);
        }

        echo $ctype->status;
    }
     //TODO:for delete Slider
     public function delete(Request $request)
     {
        if(Auth::user()->user_role !=1){
            return '<center class="mt-20px"><h1>404 </h1></center>';
        }
        AronzReview::where('parent_id', $request->id)->delete();

     }
}
