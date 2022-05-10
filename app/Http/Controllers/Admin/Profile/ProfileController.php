<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\CommonModel\Country;
class ProfileController extends Controller
{
    //TODO: Loading user's profile view page
    public function index()
    {
        $user = User::with('countries')->with('states')->where('id', Auth::user()->id)->first();

        return view('admin.profile.index', compact('user'));
    }

     //TODO: Loading Company's Profile View
     public function update_profile_view(Request $request)
     {
         $company = User::with('countries')->with('states')->where('id', Auth::user()->id)->first();
         $countries = Country::all();
         return view('admin.profile.profile', compact('company', 'countries'));
     }

     //TODO: Update User's Profile Here
     public function update(Request $request)
     {
        //  return $request->all();
         //TODO: Checking if the email is dubplicate or not
         $CheckEmail = User::where(['email' => $request->email])->first();

         if(!is_null($CheckEmail))
         {
                 if($CheckEmail->id != Auth::user()->id) return 'email';
         }

         //TODO: Update User's Profile
         $profile = $request->except('_token');
         if($request->hasFile('avatar')){
             $profile['avatar'] = $request->file('avatar')->store('UserImages', 'public');
         }
        //  return $profile;
        //  return auth()->user()->id;
         User::where(['id' => auth()->user()->id])->update($profile);

         return 'true';
     }

    //TODO: Loading change password view page
    public function change_password()
    {
        return view('admin.profile.change-password');
    }

    //TODO: Reset Password Process
    public function update_password(Request $request)
    {
        //TODO: Applying Validation to request params
        $validator = Validator::make($request->all(), [
            'current_password' => 'required|min:6',
            'new_password' => 'required|min:6',
        ]);

        if($validator->fails()) return 'Cyber';

        //TODO: Checking the current password is correct or not
        $check_current_password = Hash::check($request->current_password, Auth::user()->password);

        if(!$check_current_password) return 'current_password';

        //Updating the password here and updating the remeber token here
        $user = User::find(Auth::user()->id);
        $user->password = $request->new_password;
        $user->update();

        return 'true';
    }
}
