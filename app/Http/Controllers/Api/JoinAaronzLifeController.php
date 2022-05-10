<?php

namespace App\Http\Controllers\Api;
use niklasravnsborg\LaravelPdf\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class JoinAaronzLifeController extends Controller
{
    public function join_aaronz_life(Request $request){
      //  return $request->all();
        try{
            $validator = Validator::make($request->all(),[
               'file' => 'required',
               'description' => 'required'
           ]);

           if($validator->fails()){
               return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
           }
         // return $request->all();
            $data["description"] = $request->description;
            $data["name"] = $request->name;
            $data["email"] = $request->email;
            $data["mobile"] = $request->mobile;
            $data["title"] = 'Join Aaronz Life';

         $file =$request->file('file')->store('PropertyFloorPlans', 's3');
         $url = Storage::disk('s3')->url($file);
         $emails = ['career@aaronz.co'];
           // $emails = ['meharmani212@gmail.com'];
            Mail::send('emails.aaronz-life', $data, function($message)use($data, $url,$emails) {
            $message->to($emails)
                    ->subject($data["title"]);
                $message->attach($url);
       });
           return response()->json(['code' => 200, 'message' => 'Your Request has been sent Successfully!', 'response' =>'Success']);
       }catch(\Exception $ex)
       {
           return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
       }
    }
}
