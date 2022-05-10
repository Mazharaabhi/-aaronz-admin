<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Admin\SellWithUsContact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
class SellWithUsConctroller extends Controller
{
    public function sell_with_us(Request $request){
        try{
            $validator = Validator::make($request->all(),[
                'name' => 'required|min:3',
                'email' => 'required|email',
                'phone' => 'required',
                'message' => 'required',
                // 'type' => 'required',
            ]);
            if($validator->fails()){
                return response()->json(['code' => 400, 'message' => 'Request Errors', 'response' => $validator->errors()]);
            }
              $sell_with_us = new SellWithUsContact;
              $sell_with_us->name = $request->name;
              $sell_with_us->phone = $request->phone;
              $sell_with_us->email = $request->email;
              $sell_with_us->company = $request->company;
              $sell_with_us->message = $request->message;
              $sell_with_us->community = $request->community;
              $sell_with_us->property_type = $request->property_type;
              $sell_with_us->bedrooms = $request->bedrooms;
              $sell_with_us->type = $request->type;
              $sell_with_us->nationality = $request->nationality;
              $sell_with_us->nature = $request->nature;
              $sell_with_us->expected_amount = $request->expected_amount;
              $sell_with_us->save();

            if($request->is_contact_us == 0){
                $data["name"] = $request->name;
                $data["phone"] = $request->phone;
                $data["email"] = $request->email;
                $data["company"] = $request->company;
                $data["description"] = $request->message;
                $data["community"] = $request->community;
                $data["property_type"] = $request->property_type;
                $data["bedrooms"] = $request->bedrooms;
                $data["type"] = $request->type;
                $data["nationality"] = $request->nationality;
                $data["nature"] = $request->nature;
                $data["expected_amount"] = $request->expected_amount;
                $data["title"] = 'Sell With Us';
                  //return $data;
                $emails = ['career@aaronz.co'];
                Mail::send('emails.sell-with-us', $data, function($message)use($data,$emails) {
                   $message->to($emails)->subject($data["title"]);
              });
            }else{
                $data["name"] = $request->name;
                $data["phone"] = $request->phone;
                $data["email"] = $request->email;
                $data["description"] = $request->message;
                $data["title"] = 'Contact Us';
                  //return $data;
                $emails = ['career@aaronz.co'];
                Mail::send('emails.contact-us', $data, function($message)use($data,$emails) {
                   $message->to($emails)->subject($data["title"]);
              });
            }
              return response()->json(['code' => 200, 'message' => 'Your Request has been sent Successfully!', 'response' => $sell_with_us]);
            }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
}
