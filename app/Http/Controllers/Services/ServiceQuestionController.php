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
class ServiceQuestionController extends Controller
{
    //TODO: For Loading Service Question Index Page
    public function index(Request $request)
    {
        $categories = ServiceCategory::where(['level' => 1 ,'lang_id'=>1,'status'=>1])->get();
        $views = ServiceQuestion::with('ServiceSubCategory')->with(['ServiceCategory' => function($query){
            $query->where(['lang_id'=>1 , 'status'=> 1]);
        }])->orderBy('id', 'ASC')->where(['lang_id' => 1,'is_service_question'=>1])->get();
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
                 <a href="'.route("manage-services.question.edit", ["id" => $views->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
        return view('services.questions.index', compact('views','categories'));
    }

    //loading create view
    public function create(){
        $languages = Language::where('status',1)->get();
        $categories = ServiceCategory::where(['level' => 1 ,'lang_id'=>1,'status'=>1])->get();
        return view('services.questions.create',compact('languages', 'categories'));
    }

    //creating new Service Service Question here
    public function create_process(Request $request){
         $lang_ids = $request->languages;
         $titles = $request->title_english;
         //checking for unique Service Question name
         $CheckCategoryName = ServiceQuestion::where(['name' => $request->title_english[0],'service_category_id' => $request->service_id])->first();
         if(!is_null($CheckCategoryName)){
             return 'title';
         }
         //creating new Service Service Question here
         $category = new ServiceQuestion;
         $category->name = $request->title_english[0];
         $category->service_category_id = $request->service_id;
         $category->service_sub_category_id = $request->service_sub_category_id;
         $category->question_type = $request->question_type;
         $category->lang_id = 1;
         $category->parent_id = 0;
         $category->save();
         $parent_id =$category->id;
         //UPDATING PARENT ID
         ServiceQuestion::where('id',$parent_id)->update(['parent_id'=>$parent_id]);
         //CREATEING OTHER Service Question RECORDS
         for($i=1; $i <count($lang_ids) ; $i++ )
         {
             $cat = new ServiceQuestion;
             $cat->name = isset($titles[$i]) ? $titles[$i] : '';
             $cat->service_category_id = $request->service_id;
             $cat->service_sub_category_id = $request->service_sub_category_id;
             $cat->question_type = $request->question_type;
             $cat->lang_id=$lang_ids[$i];
             $cat->parent_id=$parent_id;
             $cat->save();
         }
         if(isset($request->option_title_1)){
         for($i=0; $i <count($request->option_title_1) ; $i++)
         {
                $serviceOption= new ServiceQuestionOption;
                $serviceOption->title=isset($request['option_title_1'][$i]) ? $request['option_title_1'][$i] : '';
                $serviceOption->question_id = $parent_id;
                $serviceOption->lang_id=1;
                $serviceOption->parent_id=0;
                $serviceOption->save();
                $option_parent_id= $serviceOption->id;
                ServiceQuestionOption::where('id',$option_parent_id)->update(['parent_id'=>$option_parent_id]);
            for($j=1; $j < count($lang_ids) ; $j++)
            {
                $serviceOption= new ServiceQuestionOption;
                $serviceOption->title=isset($request['option_title_'.($lang_ids[$j])][$i]) ? $request['option_title_'.($lang_ids[$j])][$i] : '';
                $serviceOption->question_id = $parent_id;
                $serviceOption->lang_id=$lang_ids[$j];
                $serviceOption->parent_id=$option_parent_id;
                $serviceOption->save();
            }
        }
      }

         return 'true';
     }
      //loading edit Service Question view
    public function edit($id){
        $categories = ServiceCategory::where(['level' => 1 ,'lang_id'=>1,'status'=>1])->get();
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
                $nav->service_sub_category_id = $view->service_sub_category_id;
                $nav->question_type = $view->question_type;
                $nav->lang_id=$languages[$i]['id'];
                $nav->parent_id=$id;
                $nav->save();
            }
        }
        $storedData = ServiceQuestion::with(['QuestionOptions' => function($query){
            $query->where('lang_id',1);
        }])->where(['parent_id'=>$id])->get();
        return view('services.questions.edit', compact('view','languages','storedData', 'categories'));
    }

      //editing new Service Question here
      public function edit_process(Request $request){
        $cat_id = explode (",",$request->languages_names);
        $titles = explode (",",$request->titles);
        //checking for unique Service Question name
        $CheckCategoryName = ServiceQuestion::where(['name' => $request->title_english,'service_category_id' => $request->service_category_id])->first();

        if(!is_null($CheckCategoryName)){
            if($CheckCategoryName->id != $request->id){
            return 'title';
            }
        }
        //Upadating new Service Question here
        $category = ServiceQuestion::find($request->id);
        $category->name = $request->title_english;
        $category->service_category_id = $request->service_category_id;
        $category->service_sub_category_id = $request->service_sub_category_id;
        $category->question_type = $request->question_type;
        $category->update();
        for($i=1; $i <count($cat_id) ; $i++ )
        {
            $cat = ServiceQuestion::where(['lang_id'=>$cat_id[$i],'parent_id'=>$request->id])->first();
            $cat->name = $titles[$i];
            $cat->lang_id=$cat_id[$i];
            $cat->service_category_id = $request->service_category_id;
            $cat->service_sub_category_id = $request->service_sub_category_id;
            $cat->question_type = $request->question_type;
            $cat->parent_id=$request->id;
            $cat->update();
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
      //TODO:for add Option values for Service Question
      public function add_option(Request $request)
      {
         $serviceOption= new ServiceQuestionOption;
         $serviceOption->title=$request->options[0];
         $serviceOption->question_id = $request->question_id;
         $serviceOption->lang_id=1;
         $serviceOption->parent_id=0;
         $serviceOption->save();
         $option_parent_id= $serviceOption->id;
         ServiceQuestionOption::where('id',$option_parent_id)->update(['parent_id'=>$option_parent_id]);
         for($j=1; $j < count($request->languages) ; $j++)
             {
                 $serviceOpt= new ServiceQuestionOption;
                 $serviceOpt->title=isset($request->options[$j]) ? $request->options[$j]: '';
                 $serviceOpt->question_id = $request->question_id;
                 $serviceOpt->lang_id=$request->languages[$j];
                 $serviceOpt->parent_id=$option_parent_id;
                 $serviceOpt->save();
             }
             $html='';
                  $html .='<tr id="option_'.$serviceOption->id.'">';
                  $html .='<td class="justify-content-center">'.$serviceOption->id.'</td>
                     <td class="justify-content-center">
                         '.$serviceOption->title.'
                     </td>
                     <td class="text-center justify-content-center">
                     <input type="hidden" name="id" value="'.$serviceOption->id.'">
                     <a href="javascript:;" data-id="'.$serviceOption->id.'" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                         <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                     </a>
                     <a href="javascript:;" data-id="'.$serviceOption->id.'" id="remove" class="btn btn-sm btn-icon btn-secondary">
                         <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                     </a>
                     </td>
                 </tr>';
                 return $html;
       }
     //TODO:for Option Edit
     public function option_edit(Request $request)
     {
       $option= ServiceQuestionOption::where('parent_id', $request->id)->get();
        return $option;
     }
      //TODO:for Option option update process
      public function option_update_process(Request $request)
      {
        //Upadating new Service Question here
        $option = ServiceQuestionOption::find($request->update_row_id);
        $option->title = $request->options[0];
        $option->update();
        for($i=1; $i <count($request->languages) ; $i++ )
        {
            $option = ServiceQuestionOption::where(['lang_id'=>$request->languages[$i],'parent_id'=>$request->update_row_id])->first();
            $option->title = $request->options[$i];
            $option->lang_id=$request->languages[$i];
            $option->parent_id=$request->update_row_id;
            $option->update();
        }

        $storedData = ServiceQuestion::with(['QuestionOptions' => function($query){
            $query->where('lang_id',1);
        }])->where(['parent_id'=>$request->question_parent_id])->get();
        $html='';
         foreach ($storedData[0]->QuestionOptions as $option){
             $html .='<tr id="option_'.$option->id.'">';
             $html .='<td class="justify-content-center">'.$option->id.'</td>
                <td class="justify-content-center">
                    '.$option->title.'
                </td>
                <td class="text-center justify-content-center">
                <input type="hidden" name="id" value="'.$option->id.'">
                <a href="javascript:;" data-id="'.$option->id.'" id="row-to-update" class="btn btn-sm btn-icon btn-secondary">
                    <i class="fa fa-pencil-alt text-primary" style="padding-top: 7px !important"></i>
                </a>
                <a href="javascript:;" data-id="'.$option->id.'" id="remove" class="btn btn-sm btn-icon btn-secondary">
                    <i class="far fa-trash-alt" style="padding-top: 7px !important;color:red"></i> <span class="sr-only">Remove</span>
                </a>
                </td>
            </tr>';
           }
         return $html;
      }
     //TODO:for Option delete
     public function option_delete(Request $request)
     {
        ServiceQuestionOption::where('id', $request->id)->delete();
        return 'true';
     }
      //TODO:To delete Question and options
      public function delete(Request $request)
      {
         ServiceQuestion::where('parent_id', $request->id)->delete();
         ServiceQuestionOption::where('question_id', $request->id)->delete();

      }
      //SEARCH//
      public function search_questions(Request $request){
          $html='';
        if(isset($request->category_id) && isset($request->sub_category_id)){
            $views = ServiceQuestion::with('ServiceSubCategory')->with(['ServiceCategory' => function($query){
                $query->where(['lang_id'=>1 , 'status'=> 1]);
            }])->orderBy('id', 'ASC')->where(['lang_id' => 1,'is_service_question'=>1,
            'service_category_id'=>$request->category_id,
            'service_sub_category_id'=>$request->sub_category_id
            ])->get();
           // return $views;
            $html .='<thead>
                    <tr>
                        <th width="5%">Id</th>
                        <th>Title</th>
                        <th>Service Sub Category</th>
                        <th>Service Category</th>
                        <th>Status</th>
                        <th class="text-center" width="10%">Action</th>
                    </tr>
                </thead><tbody>';
        if(count($views) > 0){
            foreach($views as $view)
            {

                $html .= '<tr>
                    <td>'.$view->id.'</td>
                    <td>'.$view->name.'</td>
                    <td>'.$view->ServiceSubCategory->name.'</td>
                    <td>'.$view->ServiceCategory->name.'</td>';
                    if($view->status == 1)
                    {
                        $html .='<td>
                        <input type="hidden" name="id" value="'.$view->id.'">
                        <input type="hidden" name="active" value="'.$view->status.'">
                        <a id="change_status" data-id="'.$view->id.'" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
                        <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Unlock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <mask fill="white">
                                    <use xlink:href="#path-1"/>
                                </mask>
                                <g/>
                                <path d="M15.6274517,4.55882251 L14.4693753,6.2959371 C13.9280401,5.51296885 13.0239252,5 12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L14,10 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C13.4280904,3 14.7163444,3.59871093 15.6274517,4.55882251 Z" fill="#000000"/>
                            </g>
                        </svg></span>
                        </a></td>
                        ';
                    }
                    else
                    {
                        $html .='<td>
                        <input type="hidden" name="id" value="'.$view->id.'">
                        <input type="hidden" name="status" value="'.$view->status.'">
                        <a id="change_status" data-id="'.$view->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Not Active">
                        <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <mask fill="white">
                                <use xlink:href="#path-1"/>
                            </mask>
                            <g/>
                            <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
                        </g>
                        </svg></span>
                        </a></td>
                        ';
                    }
                    $html .='<td>
                        <input type="hidden" name="status" value="'.$view->status.'">
                        <a href="'.route("manage-services.question.edit", ["id" => $view->id]).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
                        <input type="hidden" name="id" value="'.$view->id.'">
                        <a id="delete_language" data-id="'.$view->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
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
                    </td>
                </tr>';
            }
          }else{
            $html .='<tr><td colspan="4" style="padding-left:400px">No Record Found</td></tr>';
          }
            $html .='</tbody';
        }
        return $html;
      }



}
