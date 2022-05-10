<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Validator;
use App\Mail\ForgotPasswordMail;
use Illuminate\Support\Facades\Mail;
use App\Models\Admin\Company\Paytab;

class AuthController extends Controller
{
    //TODO: Loading admin login page view here
    public function index()
    {
        return view('admin.auth.index');
    }

    //TODO: Admin Login Process
    public function login(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if($validator->fails()) return 'Cyber';

        //TODO: Creating data array for Attempting Auth
        $data = ['email' => $request->email, 'password' => $request->password];

        //TODO: Using Auth Attemp for checking the request data for login is valid or not
         if (Auth::attempt($data)) {
            return 'Authorized';
         }
         else
         {
            'Unauthorized';
         }
    }



    // TODO: Loading forgot password view here
    public function forgot_password()
    {
        return view('admin.auth.forgot-password');
    }

    // TODO: Forgot Password Process
    public function forgot_password_process(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'email' => 'email|required'
        ]);

        if($validator->fails()) return 'Cyber';

        // TODO: Check if email is exits in admins which having user_role 1
        $CheckEmail = User::where(['email' => $request->email, 'user_role' => 1])->first();

        // TODO: If record not found return false
        if(is_null($CheckEmail)) return 'false';

        //TODO: MD5 Encoding the user email
        $EncodedEmail = md5($request->email . date('Y-m-d H:i:s'));

        //TODO:  Getting User and updating it
        $user = User::find($CheckEmail->id);
        $user->remember_token = $EncodedEmail;
        $user->save();

        $url = route('admin.auth.reset-password', ['token' => $EncodedEmail]);

        //replace template var with value
        $token = array(
            'Name'  => $CheckEmail->name,
            'ClickHere' => '<a href="'.$url.'"><button  class="btn btn-danger">Reset Password</button></a>',
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }
        //TODO: Sending Email Here
        AdminSendEmail(1, 12, $varMap, $request->email);

        return 'true';
    }

    //TODO: Loading reset password view
    public function reset_password($token)
    {
        // TODO: Checking the request token is used or not by user
        $user = User::where('remember_token', $token)->first();

        if(!is_null($user)){
        return view('admin.auth.reset-password', compact('user'));
        }

        return view('admin.errors.400');
    }

    //TODO: Reset Password Process
    public function reset_password_process(Request $request)
    {
        //TODO: Applying Validation to request params
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:6'
        ]);

        if($validator->fails()) return 'Cyber';

        //Updating the password here and updating the remeber token here
        $user = User::find($request->id);
        $user->remember_token = '';
        $user->password = $request->password;
        $user->update();

        return 'true';
    }

    //TODO: Admin Logout
    public function logout(Request $request)
    {
        //TODO: Destroying the Auth session here
        Session::flush();
        $request->session()->pull('admin_application_mode');
        return redirect('/saportal');
    }
}
