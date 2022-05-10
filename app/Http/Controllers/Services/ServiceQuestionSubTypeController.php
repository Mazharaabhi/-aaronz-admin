<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Settings\Language;
use App\Models\Cms\Navbar;
use Yajra\Datatables\Datatables;
use App\Models\Services\ServiceCategory;
use App\Models\Services\ServiceQuestion;
use App\Models\Services\ServiceQuestionOption;
class ServiceQuestionSubTypeController extends Controller
{
    //TODO: For Loading View Index Page
    public function index(Request $request)
    {

       $views= ServiceQuestion::join('service_categories','service_questions.service_sub_category_id','=','service_categories.id')
            ->join('service_question_options','service_questions.id','=','service_question_options.question_id')
            ->orderBy('service_questions.id', 'ASC')
            ->where(['service_categories.lang_id'=>1,'service_questions.lang_id'=>1,'service_question_options.lang_id'=>1])
            ->select('service_questions.*','service_categories.name as category_name','service_question_options.title as value')->get();
        if($request->ajax())
        {
         return Datatables::of($views)
         ->addIndexColumn()
         ->addColumn('status', function($views) {
             if($views->status == 1)
                 {
                     return '
                     <input type="hidden" name="id" value="'.$views->id.'">
                     <input type="hidden" name="active" value="'.$views->status.'">
                     <a id="change_status" data-id="'.$views->id.'" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
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
                     <input type="hidden" name="id" value="'.$views->id.'">
                     <input type="hidden" name="status" value="'.$views->status.'">
                     <a id="change_status" data-id="'.$views->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Not Active">
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
         ->addColumn('action', function ($views) {

                 return '
                 <input type="hidden" name="status" value="'.$views->status.'">
                 <a href="'.route("manage-services.question-sub-type.edit", ["id" => $views->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                 <input type="hidden" name="id" value="'.$views->id.'">
                    <a id="delete_language" data-id="'.$views->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                    <span class="svg-icon svg-icon-md svg-icon-danger">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                            <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                        </g>
                    </svg>
                    </span>
                    </a>
                ';

         })
         ->rawColumns(['status', 'action'])
         ->editColumn('id', 'ID: {{$id}}')
         ->make(true);
        }
        return view('services.question-sub-types.index', compact('views'));
    }

    //loading create view
    public function create(){
        $languages = Language::where('status',1)->get();
        $categories = ServiceCategory::where(['level' => 1 ,'lang_id'=>1,'status'=>1,'is_sub_type'=> 1])->get();
        return view('services.question-sub-types.create',compact('languages', 'categories'));
    }
    //TODO: for getting categories
    public function get_categories(Request $request)
    {
        $services = ServiceCategory::where(['service_category_id'=> $request->service_category_id, 'lang_id' => 1])->get();
        $options = '<option value="">--select a category--</option>';
        foreach($services as $item)
        {
            $options .= '<option value="'.$item->id.'">'.$item->name.'</option>';
        }

        return $options;
    }
    //creating new Service Sub Category here
    public function create_process(Request $request){
         //return $request->all();
         //checking for unique rank name
         $CheckCategoryName = ServiceQuestion::where(['service_sub_category_id' => $request->service_subCat_id,'service_category_id' => $request->service_id])->first();
         if(!is_null($CheckCategoryName)){
             return 'title';
         }
         //creating new Service Sub Category here
         $category = new ServiceQuestion;
         $category->name = $request->title_english[0];
         $category->service_category_id = $request->service_id;
         $category->service_sub_category_id	 =$request->service_subCat_id;
         $category->is_service_question = 2;
         $category->lang_id = 1;
         $category->parent_id = 0;
         $category->save();
         $parent_id =$category->id;
         //UPDATING PARENT ID
         ServiceQuestion::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
         //CREATEING OTHER Sub Categoris RECORDS
         for($i=1; $i <count($request->languages) ; $i++ )
         {
            $service_question = new ServiceQuestion;
            $service_question->name = isset($request->title_english[$i]) ? $request->title_english[$i] : '';
            $service_question->service_category_id = $request->service_id;
            $service_question->service_sub_category_id=$request->service_subCat_id;
            $service_question->is_service_question = 2;
            $service_question->lang_id=$request->languages[$i];
            $service_question->parent_id=$parent_id;
            $service_question->save();
         }
            $serviceOption= new ServiceQuestionOption;
            $serviceOption->title=isset($request['option_english'][0]) ? $request['option_english'][0] : '';
            $serviceOption->question_id = $parent_id;
            $serviceOption->lang_id=1;
            $serviceOption->parent_id=0;
            $serviceOption->save();
            $option_parent_id= $serviceOption->id;
            ServiceQuestionOption::where('id',$option_parent_id)->update(['parent_id'=>$option_parent_id]);
            for($j=1; $j < count($request->languages) ; $j++)
            {
                $serviceOption= new ServiceQuestionOption;
                $serviceOption->title=isset($request['option_english'][$j]) ? $request['option_english'][$j] : '';
                $serviceOption->question_id = $parent_id;
                $serviceOption->lang_id=$request->languages[$j];
                $serviceOption->parent_id=$option_parent_id;
                $serviceOption->save();
            }
         return 'true';
     }

      //loading edit View view
    public function edit($id){
        $categories = ServiceCategory::where(['level' => 1 ,'lang_id'=>1,'status'=>1,'is_sub_type'=> 1])->get();
        $all_categories = ServiceCategory::where(['lang_id'=>1,'status'=>1])->get();
        $languages = Language::where('status',1)->get();
        $view = ServiceQuestion::where('id',$id)->first();
        for($i = 1; $i < count($languages) ; $i++)
        {
            $checkLanguageQuestions = ServiceQuestion::where(['parent_id' => $id, 'lang_id' => $languages[$i]['id']])->first();
            if(is_null($checkLanguageQuestions))
            {
                $nav = new ServiceQuestion;
                $nav->name = '';
                $nav->service_category_id = $view->service_category_id;
                $nav->lang_id=$languages[$i]['id'];
                $nav->parent_id=$id;
                $nav->save();
            }
        }
        $storedData = ServiceQuestion::with('QuestionOptions')->where(['parent_id'=>$id])->get();
        $optionsData = ServiceQuestionOption::where(['question_id'=>$id])->get();
        return view('services.question-sub-types.edit', compact('view','languages','storedData', 'categories','all_categories','optionsData'));
    }

      //editing new Service Question here
      public function edit_process(Request $request){
        $cat_id = explode (",",$request->languages_names);
        $titles = explode (",",$request->titles);
        $options = explode (",",$request->options);
        //checking for unique View name
        $CheckCategoryName = ServiceQuestion::where(['name' => $request->title_english,'service_sub_category_id' => $request->service_sub_category_id])->first();
        $CheckOptionVal = ServiceQuestionOption::where(['title' => $request->option_english,'question_id' => $request->id])->first();

        if(!is_null($CheckCategoryName)){
            if($CheckCategoryName->id != $request->id){
            return 'title';
            }
        }
        if(!is_null($CheckOptionVal)){
            if($CheckOptionVal->question_id != $request->id){
            return 'option';
            }
        }
        //Upadating new ServiceQuestion here
        $service_Question = ServiceQuestion::find($request->id);
        $service_Question->name = $request->title_english;
        $service_Question->service_category_id = $request->service_category_id;
        $service_Question->service_sub_category_id = $request->service_sub_category_id;
        $service_Question->update();
        for($i=1; $i <count($cat_id) ; $i++ )
        {
            $ser_q = ServiceQuestion::where(['lang_id'=>$cat_id[$i],'parent_id'=>$request->id])->first();
            $ser_q->name = $titles[$i];
            $ser_q->service_category_id = $request->service_category_id;
            $ser_q->service_sub_category_id = $request->service_sub_category_id;
            $ser_q->lang_id=$cat_id[$i];
            $ser_q->parent_id=$request->id;
            $ser_q->update();
        }
            $serviceOption= ServiceQuestionOption::where(['question_id'=>$request->id,'lang_id'=>1])->first();
            $serviceOption->title=$request->option_english;
            $serviceOption->update();
        for($i=1; $i <count($cat_id) ; $i++ )
            {
               $ser_option= ServiceQuestionOption::where(['lang_id'=>$cat_id[$i],'question_id'=>$request->id])->first();
               $ser_option->title=$options[$i];
               $ser_option->update();
            }
        return 'true';
    }

    //TODO: Change status of View
    public function change_status(Request $request)
    {
        $view = ServiceQuestion::where('id', $request->id)->first();
        $active='';
        if($view->status == 1)
        {
            $active = 0;
        }
        else
        {
            $active = 1;
        }
        ServiceQuestion::where('parent_id' , $request->id)->update(['status' => $active]);

        return $active;
    }
      //TODO:To delete Question sub types and options
      public function delete(Request $request)
      {
         ServiceQuestion::where('parent_id', $request->id)->delete();
         ServiceQuestionOption::where('question_id', $request->id)->delete();

      }



}
