<?php
namespace App\Http\Controllers\Admin\SMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
class SMSPackageController extends Controller
{
    //TODO: Loading Admin SMS API Index View
    public function index()
    {
        $sms = User::where('id', Auth::user()->id)->first();
        return view('admin.profile.sms-api.index', compact('sms'));
    }

    //TODO: Updating SMS Api Key here
    public function update(Request $request)
    {
        User::where('id', Auth::user()->id)->update($request->except('_token'));
        return 'true';
    } 
}
