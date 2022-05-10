<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Nationality;
use App\Models\DataCountry;
use App\Models\Locations\LocationState;
use App\Models\Locations\Location;
class AuthController extends Controller
{
    //TODO: Company Login Api
      public function login(Request $request){

        try
        {
        //Validating Request from Server Side
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:6',
            // 'role_id' => 'required'
        ]);

        //Returning Respone
        if($validator->fails())
        {
            return response()->json(['data' => $validator->Messages()]);
        }

        $data = $request->all();

        if(Auth::attempt($data)){
            $user = Auth::user();
            //TODO: CHEKCING IF USER IS ACTIVE OR NOT
            if($user->is_active == 1)
            {
                $user->token_name = 'Bearer';
                $user->token = $user->createToken('authToken')->accessToken;
                if($user->role_id == 1){
                    $user->user_type ='Super Admin';
                }elseif($user->role_id == 2){
                    $user->user_type ='Property Manager/Owner';
                }elseif($user->role_id == 3){
                    $user->user_type ='Agent';
                }elseif($user->role_id == 5){
                    $user->user_type ='Service Provider';
                }else{
                    $user->user_type ='Customer';
                }
                return response()->json(['status' => 200, 'message' => 'Login Successfully!', 'response' => $user]);
            }
            else
            {
                return response()->json(['status' => 400, 'message' => 'Your account is deactive. Please contect with support!']);
            }

        }else{
            return response()->json(['status' => 400, 'message' => 'Invalid Email or Password']);
        }
        }catch(\Exception $ex)
        {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }

    }

    //TODO: Sign Up For Company
    public function company_signup(Request $request)
    {
        try{
            //Validating Request from Server Side
            // $validator = Validator::make($request->all(), [
            //     'company_name' => 'required',
            //     'email' => 'required|email',
            //     'phone' => 'required',
            //     'whatsapp' => 'required',
            //     'password' => 'required|min:6',
            //     'role_id' => 'required'
            // ]);

            // //Returning Respone
            // if($validator->fails())
            // {
            //     return response()->json(['data' => $validator->Messages()]);
            // }

            //Check Unique Email
            $checkEmail = User::where(['email' => $request->email, 'role_id' => $request->role_id])->first();

            if(!is_null($checkEmail)) return response()->json(['status' => 400, 'message' => 'This email is already taken.']);

            //Check Unique Phone
            $checkPhone = User::where(['phone' => $request->phone])->first();

            if(!is_null($checkPhone)) return response()->json(['status' => 400, 'message' => 'This Phone number is already exist.']);

            //Creating 4 Digit Verification Code
            $code = mt_rand(1000,9999);

            $CompanyData = $request->except('image', 'whatsapp');
            if($request->hasFile('image'))
            {
                $CompanyData['avatar'] = $request->file('image')->store('UserImages', 'public');
            }
            $CompanyData['mobile'] = $request->whatsapp;
            $CompanyData['role_id'] = $request->role_id;
            $company = User::create($CompanyData);
            $company['token_name'] = 'Bearer';
            $company['token'] = $company->createToken('authToken')->accessToken;
            //Sending Verification Code Into Customer's Phone
            $this->send_verification_code($code, $request->phone);
            return response()->json(['status' => 200, 'message' => 'Company Registered Successfully!', 'response' => $company]);

        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }

    }

    //TODO: Sign Up For Company
    public function customer_signup(Request $request)
    {
        try{
            //Validating Request from Server Side
            // $validator = Validator::make($request->all(), [
            //     'name' => 'required',
            //     'email' => 'required|email',
            //     'phone' => 'required',
            //     'whatsapp' => 'required',
            //     'password' => 'required|min:6',
            //     'nationality' => 'required',
            //     'state_id' => 'required',
            //     'area_id' => 'required',
            //     'country' => 'required',
            //     'residance_number' => 'required',
            //     'residance' => 'required',
            //     'age' => 'required',
            //     'password' => 'required'
            // ]);

            // //Returning Respone
            // if($validator->fails())
            // {
            //     return response()->json(['data' => $validator->Messages()]);
            // }

            //Check Unique Email
            $checkEmail = User::where(['email' => $request->email, 'role_id' => 7])->first();

            if(!is_null($checkEmail)) return response()->json(['status' => 400, 'message' => 'This email is already taken.']);

            //Check Unique Phone
            $checkPhone = User::where(['phone' => $request->phone])->first();

            if(!is_null($checkPhone)) return response()->json(['status' => 400, 'message' => 'This Phone number is already exist.']);

            //Creating 4 Digit Verification Code
            $code = mt_rand(1000,9999);

            $CompanyData = $request->except('image', 'whatsapp', 'state_id');
            if($request->hasFile('image'))
            {
                $CompanyData['image'] = $request->file('image')->store('UserImages', 'public');
            }
            $CompanyData['mobile'] = $request->whatsapp;
            $CompanyData['role_id'] = $request->role_id;
            $CompanyData['state_id'] = $request->state;
            $CompanyData['role_id'] = 7;
            $CompanyData['is_verified'] = 0;
            $CompanyData['verification_code'] = $code;
            $company = User::create($CompanyData);
            $company['token_name'] = 'Bearer';
            $company['token'] = $company->createToken('authToken')->accessToken;

            //Sending Verification Code Into Customer's Phone
            $this->send_verification_code($code, $request->phone);
            return response()->json(['status' => 200, 'message' => 'Customer Registered Successfully!', 'response' => $company]);

        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }

    }

    //Resending Signup Verification Code
    public function resend_signup_verification_code(Request $request)
    {
        try{
            //Validating Request from Server Side
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
            ]);

            //Returning Respone
            if($validator->fails())
            {
                return response()->json(['data' => $validator->Messages()]);
            }

            //Creating 4 Digit Verification Code
            $code = mt_rand(1000,9999);
            //Updating the verification code
            User::where(['phone' => $request->phone])->update(['verification_code' => $code]);
            //Sending Message to User
            $this->send_verification_code($code, $request->phone);
            return response()->json(['status' => 200, 'message' => 'Verfication Code Sent Successfully!']);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }
    }

    //Verify Signup Verification Code
    public function verify_signup_verification_code(Request $request)
    {
        try{
            //Validating Request from Server Side
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'code' => 'required',
            ]);

            //Returning Respone
            if($validator->fails())
            {
                return response()->json(['data' => $validator->Messages()]);
            }
            //Getting Verification Code From Database
            $verification_code = User::where(['phone' => $request->phone])->pluck('verification_code')->first();

            //Comparing the DB Verification Code with Requested Code
            if($request->code == $verification_code)
            {
                User::where(['phone' => $request->phone])->update(['verification_code' => 0, 'is_verified' => 1]);
                return response()->json(['status' => 200, 'message' => "Code Verified Successfully!"]);
            }
            else
            {
                return response()->json(['status' => 400, 'message' => "This code doesn't match with our records."]);
            }
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }

    }

    //Send Verification Message Code
    public function send_verification_code($code, $number)
    {
        $message = "Your Verification Code is " . $code;
        send_message(1, $number, $message);
    }

    // TODO: Reset Password Process
    public function reset_password(Request $request)
    {
        try
        {
            //Validating Request from Server Side
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
            ]);

            //Returning Respone
            if($validator->fails())
            {
                return response()->json(['data' => $validator->Messages()]);
            }

            // TODO: Check if phone is exits in Portals which having
            $checkPhone = User::where(['phone' => $request->phone])->first();

            // TODO: If record not found return false
            if(is_null($checkPhone)) return response()->json(['status' => 400, 'message' => "This phone number doesn't macth to our records."]);

            //Creating 4 Digit Verification Code
            $code = mt_rand(1000,9999);

            //TODO:  Getting User and updating it
            $user = User::find($checkPhone->id);
            $user->remember_token = $code;
            $user->save();

            //Sending Verification Code Into Customer's Phone
            $this->send_verification_code($code, $request->phone);

            return response()->json(['status' => 200, 'message' => 'A 4 digit code has sent to your phone number.']);
        }catch(\Exception $ex)
        {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    //Resending Verification Code
    public function resend_verification_code(Request $request)
    {
        try{
            //Validating Request from Server Side
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
            ]);

            //Returning Respone
            if($validator->fails())
            {
                return response()->json(['data' => $validator->Messages()]);
            }

            //Creating 4 Digit Verification Code
            $code = mt_rand(1000,9999);
            //Updating the verification code
            User::where(['phone' => $request->phone])->update(['remember_token' => $code]);
            //Sending Message to User
            $this->send_verification_code($code, $request->phone);
            return response()->json(['status' => 200, 'message' => 'Verfication Code Sent Successfully!']);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }
    }

    //Verify Verification Code
    public function verify_verification_code(Request $request)
    {
        try{
            //Validating Request from Server Side
            $validator = Validator::make($request->all(), [
                'phone' => 'required',
                'code' => 'required',
            ]);

            //Returning Respone
            if($validator->fails())
            {
                return response()->json(['data' => $validator->Messages()]);
            }
            //Getting Verification Code From Database
            $verification_code = User::where(['phone' => $request->phone])->pluck('remember_token')->first();

            //Comparing the DB Verification Code with Requested Code
            if($request->code == $verification_code)
            {
                User::where(['phone' => $request->phone])->update(['remember_token' => 0, 'is_verified' => 1]);
                return response()->json(['status' => 200, 'message' => "Code Verified Successfully!"]);
            }
            else
            {
                return response()->json(['status' => 400, 'message' => "This code doesn't match with our records."]);
            }
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }

    }

    //TODO: Get Nationalities
    public function get_countries()
    {
        try{
            $countries = DataCountry::select('id', 'name')->get();
            return response()->json(['status' => 200, 'message' => "All Countries", "response" => $countries]);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Get Nationalities
    public function get_nationalities()
    {
        try{
            $nationalities = Nationality::select('id', 'name')->get();
            return response()->json(['status' => 200, 'message' => "All Nationalities", "response" => $nationalities]);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Get States
    public function get_states()
    {
        try{
            $states = LocationState::where(['lang_id' => 1, 'status' => 1])->select('id', 'name')->get();
            return response()->json(['status' => 200, 'message' => "All City States", "response" => $states]);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }
    }

    //TODO: Get Areas
    public function get_areas($id)
    {
        try{
            $states = Location::where(['lang_id' => 1, 'status' => 1, 'location_state_id' => $id, 'location_id' => 0])->select('id', 'name', 'lat', 'lng')->get();
            return response()->json(['status' => 200, 'message' => "All Areas", "response" => $states]);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }
    }


    //TODO: Logout Company
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json(['status' => 200, 'message' => 'Logout successfully!']);
    }
}
