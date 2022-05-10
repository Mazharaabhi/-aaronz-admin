<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\Page;
use Illuminate\Support\Facades\Validator;

class PageDetailsController extends Controller
{
    /**Send Lead Here */
    public function page_details(Request $request)
    {

        try{
            $validator = Validator::make($request->all(),[
                'slug' => 'required',
            ]);

            if($validator->fails()){
                return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
            }

            $page = Page::where('slug',$request->slug)->first();
            if($page){
               return response()->json(['code' => 200, 'message' => 'Success!', 'response' => $page]);
            }else{
               return response()->json(['code' => 404, 'message' => 'Error,Something Went Wrong.', 'response' => $page]);
            }

        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
}
