<?php

namespace App\Http\Controllers\Admin\Email;

use App\Http\Controllers\Controller;
use App\Models\Admin\Email\EmailCategory;
use App\Models\Admin\Email\EmailSetting;
use App\Models\Admin\Email\TemplateBanner;
use App\Models\Admin\Email\TemplateCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailSettingController extends Controller
{
    //TODO: Loading Admin Email Template Setting View
    public function index()
    {
        $edit_permission = CheckPermission(config('const.EDIT'), config('const.EMAILSETTINGS'));
        $settings = EmailSetting::where('company_id', admin_company_id())->first();
        $banner = TemplateBanner::all();
        return view('admin.email.email-setting.index', compact('settings', 'banner', 'edit_permission'));
    }

    //TODO: Updating Emiail Template Data here
    public function update(Request $request)
    {
        // return $request->all();
        //TODO: Creating Email Settings Array For Update Email Settings
        $settings = $request->except('id', '_token', 'banner_image_width', 'banner_image_height', 'banner', 'header_logo', 'footer_logo');
        if($request->hasFile('header_logo'))
        {
            $settings['header_logo'] = $request->file('header_logo')->store('EmailTemplateImages', 'public');
        }
        if($request->hasFile('footer_logo'))
        {
            $settings['footer_logo'] = $request->file('footer_logo')->store('EmailTemplateImages', 'public');
        }

        $settings['banner_width'] = $request->banner_image_width;
        $settings['banner_height'] = $request->banner_image_height;
        if($request->hasFile('banner'))
        {
            $settings['banner'] = $request->file('banner')->store('EmailTemplateImages');
        }

        //Updating Email Settings Here
         //Checking if template exits or not
         if(isset($request->id))
         {
            $settings['modify_by'] = Auth::user()->id;
            EmailSetting::where('id',$request->id)->update($settings);
         }
         else
         {   $settings['company_id'] = admin_company_id();
             $settings['create_by'] = Auth::user()->id;
             EmailSetting::create($settings);
         }



        return 'true';
    }
}
