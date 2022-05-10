<?php

namespace App\Http\Controllers\Website\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Illuminate\Support\Facades\Auth;
use Session;
class AuthController extends Controller
{
    //TODO: User Sign Up
    public function signup(Request $request)
    {
        {
            try{
                // return $request->all();
                $checkEmail = User::where(['email' => $request->email])->first();

                if(!is_null($checkEmail)) return 'email';

                //Check Unique Phone
                $checkPhone = User::where(['phone' => $request->phone])->first();

                if(!is_null($checkPhone)) return 'Phone';

                //Creating 4 Digit Verification Code
                $code = mt_rand(1000,9999);

                $CompanyData = $request->except('name', 'phone', 'termsConditions', '_token');
                $CompanyData['name'] = $request->username;
                $CompanyData['phone'] = $request->phone;
                // return $CompanyData;
                User::create($CompanyData);
                //Updating the verification code
                User::where(['phone' => $request->phone])->update(['verification_code' => $code]);
                //Sending Verification Code Into Customer's Phone
                $this->send_verification_code($code, $request->phone);
                return $request->phone;

            }catch(\Exception $ex){
                return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
            }

        }
    }


     //Send Verification Message Code
     public function send_verification_code($code, $number)
     {
        $message = "Your Verification Code is " . $code;
        send_message(1, $number, $message);
        return 'true';
     }

     //Verify Signup Verification Code
    public function verify_signup_verification_code(Request $request)
    {
        try{
            $code = $request->vc_1 . $request->vc_2 . $request->vc_3 . $request->vc_4;
            //Getting Verification Code From Database
            $verification_code = User::where(['phone' => $request->verification_phone])->pluck('verification_code')->first();

            //Comparing the DB Verification Code with Requested Code
            if($code == $verification_code)
            {
                User::where(['phone' => $request->verification_phone])->update(['verification_code' => 0, 'is_verified' => 1]);
                // return response()->json(['status' => 200, 'message' => "Code Verified Successfully!"]);
                return 'true';
            }
            else
            {
                return 'false';
            }
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }

    }


    //Resending Signup Verification Code
    public function resend_signup_verification_code(Request $request)
    {
        try{

            //Creating 4 Digit Verification Code
            $code = mt_rand(1000,9999);
            //Updating the verification code
            User::where(['phone' => $request->phone])->update(['verification_code' => $code]);
            //Sending Message to User
            return $this->send_verification_code($code, $request->phone);
        }catch(\Exception $ex){
            return response()->json(['status' => 500, 'message' => "Internal Server Error", 'response' => $ex->getMessage()]);
        }
    }

    public function login(Request $request){

        try
        {
        $data = ['email' => $request->login_email, 'password' => $request->login_password];

        if(Auth::attempt($data)){
            $user = Auth::user();
            //TODO: CHEKCING IF USER IS ACTIVE OR NOT
            if($user->is_active == 1)
            {
                return 'true';
            }
            else
            {
                return 'deactive';
            }

        }else{
            return 'false';
        }
        }catch(\Exception $ex)
        {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }

    }

    // TODO: Forgot password code sending here
    public function forgot_password(Request $request)
    {
        // TODO: Applying Validator here
        $validator = Validator::make($request->all(),
        [
            'phone' => 'required|min:9',
        ]);

        if($validator->fails()) return 'Cyber';

        // TODO: Getting the user by number if found
        $user = User::where(['phone' => $request->phone])->first();
        if(is_null($user)) return 'false';

        // TODO: Sedning Code To User
        $code = rand(10000,50000);
        User::find($user->id)->update(['remember_token' => $code]);

        //Sending Message To User
        $message = "Myride Verification Code: " . $code;
        $result = send_message(+971 . $request->phone, $message);
        return "true";
    }

    // TODO: For Reset Password
    public function reset_password(Request $request)
    {
        // TODO: Applying Validator here
        $validator = Validator::make($request->all(),
        [
            'phone' => 'required|min:9',
            'password' => 'required',
        ]);

        if($validator->fails()) return 'Cyber';

        // TODO: Updating the user password
        $user = User::where(['phone' => $request->phone])->update(['password' => $request->password, 'remember_token' => '']);
        return 'true';
    }

     //TODO: Admin Logout
     public function logout(Request $request)
     {
         //TODO: Destroying the Auth session here
         Session::flush();
         return redirect('/');
     }
}
