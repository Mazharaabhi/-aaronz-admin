<?php

namespace App\Http\Controllers\Admin\Email;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin\Email\TemplateBanner;
use App\Models\Admin\Email\EmailSetting;
use App\Models\Admin\Email\EmailCategory;
use App\Models\Admin\Email\EmailContent;
use App\Mail\DynamicEmail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class EmailTemplateController extends Controller
{
    //TODO: Loading Email Template View
    public function index()
    {
        $edit_permission = CheckPermission(config('const.EDIT'), config('const.EMAILTEMPLATE'));

        $settings = EmailSetting::where('company_id', admin_company_id())->first();
        $banner = TemplateBanner::all();
        $email_categories = EmailCategory::all();
        return view('admin.email.email-template.index', compact('settings', 'banner', 'email_categories', 'edit_permission'));
    }

    //TODO: FOr Multitasking
    public function get_template(Request $request)
    {
        //TODO: Getting Email Template Tages
        $tags = EmailCategory::where('id', $request->email_category_id)->first();

        //TODO: Checking if email template content is exist or not
        $checkIfEmailTemplate = EmailContent::where(['company_id' => admin_company_id(), 'email_category_id' => $request->email_category_id])->first();
        $html = '';
        if(!is_null($checkIfEmailTemplate))
        {
            $html = $checkIfEmailTemplate->content;
        }
        else
        {
            $contentData = [];
            $contentData['email_category_id'] = $request->email_category_id;
            $contentData['company_id'] = admin_company_id();
            $contentData['create_by'] = Auth::user()->id;
            EmailContent::create($contentData);
        }
        $data = ['tags' => $tags->tags, 'content' => $html];
        return json_encode($data);
    }

    //TODO: Updating Email Template Here
    public function update(Request $request)
    {
        EmailContent::where(['company_id' => Auth::user()->id, 'email_category_id' => $request->email_category_id])->update(['modify_by' => Auth::user()->id,'content' => $request->content]);
        return 'true';
    }
}
