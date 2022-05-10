<?php
use App\Models\Notification;
use App\Models\Admin\Paylinks\Transaction;
use App\Models\Admin\Paylinks\Trash;
use App\Models\Admin\Email\EmailCategory;
use App\Models\Admin\Email\EmailContent;
use App\Models\Admin\Email\EmailSetting;
use App\Models\Admin\Email\TemplateBanner;
use App\Mail\DynamicEmail;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Admin\Email\BrandedEmail;
use App\Models\Admin\Services\Service;
use App\Models\Admin\Settings\Size;
use App\Models\Administrator\Privileg;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Models\Cms\Navbar;
use App\Models\Cms\HeaderFooter;
use App\Models\Locations\LocationCountry;
use App\Models\Properties\PropertyCategory;
use App\Models\Services\ServiceCategory;

function get_property_sizes(){
    return Size::orderBy('size', 'asc')->get();
}

function get_locations(){
    return LocationCountry::with(['location_states' => function($query){
        $query->with(['location_areas' => function($query){
            $query->with(['locations' => function($query){
                $query->with(['buildings' => function($query){
                    $query->where(['lang_id' => 1, 'status' => 1]);
                }])->where(['lang_id' => 1, 'status' => 1]);
            }])->where(['lang_id' => 1, 'status' => 1]);
        }])->where(['lang_id' => 1, 'status' => 1]);
    }])->where(['lang_id' => 1, 'is_default' => 1])->first();
}


function get_header_footer_content()
{
    return HeaderFooter::where('lang_id', 1)->first();
}

function get_navbars()
{
    return Navbar::orderBy('sort', 'asc')->where(['lang_id' => 1, 'status' => 1])->get();
}

function get_Buy_Categories(){
    return PropertyCategory::where(['lang_id' => 1, 'property_type_id' => 1 ])->get();
}

function get_Rent_Categories()
{
    return PropertyCategory::where(['lang_id' => 1, 'property_type_id' => 3 ])->get();
}

function get_Service_Categories()
{
    return ServiceCategory::where(['lang_id' => 1, 'service_category_id' => 0 ])->get();
}



if(!function_exists('admin_company_id'))
{
    function admin_company_id()
    {
        if(Auth::user()->role_id == 1)
        {
            $company_id = Auth::user()->id;
        }
        else
        {
            $company_id = Auth::user()->company_id;
        }
        return $company_id;
    }

}

if(!function_exists('company_id'))
{
    function company_id()
    {
        if(session()->get('company')->user_role == 2)
        {
            $company_id = session()->get('company')->id;
        }
        else
        {
            $company_id = session()->get('company')->company_id;
        }
        return $company_id;
    }

}

if(!function_exists('CheckUseRole'))
{
    function CheckUseRole()
    {
        if(Auth::user()->role_id == 0)
        {
            $id = 1;
        }
        else
        {
            $id = Auth::user()->role_id;
        }

        return $id;
    }

}

if(!function_exists('CheckCompanyRole'))
{
    function CheckCompanyRole()
    {
        if(session()->get('company')->user_role == 2)
        {
            $id = 6;
        }
        else
        {
            $id = session()->get('company')->role_id;
        }

        return $id;
    }

}

if(!function_exists('CheckPermission'))
{
    function CheckPermission($name, $id)
    {
        $permission = Privileg::where([$name => 1, 'operation_id' => $id, 'role_id' => CheckUseRole()])->first();

        if(is_null($permission))
        {
            return 0;
        }
        else
        {
            return 1;
        }

    }

}

if(!function_exists('CheckCompanyPermission'))
{
    function CheckCompanyPermission($name, $id)
    {
        $permission = Privileg::where([$name => 1, 'operation_id' => $id, 'role_id' => CheckCompanyRole()])->first();

        if(is_null($permission))
        {
            return 0;
        }
        else
        {
            return 1;
        }

    }

}



//TODO: Function For Sending Admin's Email
if(!function_exists('AdminSendEmail'))
{
    function AdminSendEmail($id, $cat_id, $varMap, $email)
    {
        //TODO: Getting Email Template Data here
        $settings = EmailSetting::where('company_id', $id)->first();
        //TODO: Email Category data
        $email_cat = EmailCategory::where('id', $cat_id)->first();
        $subject = $email_cat->email_subject;
        //TODO: Email Template Content
        $checkIfEmailTemplate = EmailContent::where(['company_id' => $id, 'email_category_id' => $email_cat->id])->first();
        if(is_null($checkIfEmailTemplate)){
            return 'email_template';
        }
        else
        {
            if($checkIfEmailTemplate->content == "") return 'email_template';
        }



        $brand = BrandedEmail::where('company_id', $id)->first();

        if(!is_null($brand))
        {
            $brand_name = $brand->title;
            $brand_email = $brand->email;
        }
        else
        {
            $brand_name = config('app.name');
            $brand_email = 'xyz@gmail.com';
        }

        $details = [
            'settings' => $settings,
            'content' => strtr($checkIfEmailTemplate->content,$varMap)
        ];


        Mail::send('emails.dynamic_email', $details, function($message) use ($brand_name, $subject, $email, $brand_email) {
            $message->to($email)->subject($subject);
            $message->from($brand_email, $brand_name);
         });
        // Mail::to($email)->send(new DynamicEmail($details, $subject));

    }
}
if(!function_exists('AttachMentPdf'))
{
    function AttachMentPdf($id, $cat_id, $varMap, $email, $pdf)
    {
        //TODO: Getting Email Template Data here
        $settings = EmailSetting::where('company_id', $id)->first();
        //TODO: Email Category data
        $email_cat = EmailCategory::where('id', $cat_id)->first();
        $subject = $email_cat->email_subject;
        //TODO: Email Template Content
        $checkIfEmailTemplate = EmailContent::where(['company_id' => $id, 'email_category_id' => $email_cat->id])->first();
        if(is_null($checkIfEmailTemplate)){
            return 'email_template';
        }
        else
        {
            if($checkIfEmailTemplate->content == "") return 'email_template';
        }



        $brand = BrandedEmail::where('company_id', $id)->first();

        if(!is_null($brand))
        {
            $brand_name = $brand->title;
            $brand_email = $brand->email;
        }
        else
        {
            $brand_name = config('app.name');
            $brand_email = 'xyz@gmail.com';
        }

        $details = [
            'settings' => $settings,
            'content' => strtr($checkIfEmailTemplate->content,$varMap)
        ];


        Mail::send('emails.dynamic_email', $details, function($message) use ($brand_name, $subject, $email, $brand_email, $pdf) {
            $message->to($email)->subject($subject);
            $message->from($brand_email, $brand_name);
            $message->attachData($pdf->output(), "invoice.pdf");
         });
        // Mail::to($email)->send(new DynamicEmail($details, $subject));

    }
}

//TODO: Function For Sending Company's Emails
if(!function_exists('CompanySendEmail'))
{
    function CompanySendEmail($company_id, $cat_id, $varMap, $email)
    {
        //TODO: Sending Email to Company And User
        $user_detail = User::where('id', $company_id)->first();
        // TODO: IF COMPANY NOT HAS BRANDED EMAIL OR PAY PAGE PACKAGES THEN GET THE DEFAULT SUPER ADMIN'S EMAIL SETTINGS
        if($user_detail->branded_pay_page == 0)
        {
            $settings = EmailSetting::where('company_id', 1)->first();
        }
        else
        {
        //TODO: IF COMPANY HAS BRANDED EMAIL OR PAY PAGE PACKAGES THEN GET THE COMPANY'S EMAIL SETTINGS
            $settings = EmailSetting::where('company_id', $user_detail->id)->first();
        }

        //TODO: IF COMPANY HAS BRANDED EMAIL OR PAY PAGE PACKAGES BUT NOT HAVE CONFIGURED THE SETTINGS THEN GET SUPER ADMIN'S EMAIL SETTINGS
        if(is_null($settings))
        {
            $settings = EmailSetting::where('company_id', 1)->first();
        }

        $banner = TemplateBanner::all();
        //TODO: Email Category data
        $email_cat = EmailCategory::where('id', $cat_id)->first();
        $subject = $email_cat->email_subject;
        // TODO: IF COMPANY NOT HAS BRANDED EMAIL OR PAY PAGE PACKAGES THEN GET THE DEFAULT SUPER ADMIN'S EMAIL CONTENT
        if($user_detail->branded_pay_page == 0)
        {
            $checkIfEmailTemplate = EmailContent::where(['company_id' => 1, 'email_category_id' => $email_cat->id])->first();
        }
        else
        {
        //TODO: IF COMPANY HAS BRANDED EMAIL OR PAY PAGE PACKAGES THEN GET THE COMPANY'S EMAIL CONTENT
            $checkIfEmailTemplate = EmailContent::where(['company_id' => $user_detail->id, 'email_category_id' => $email_cat->id])->first();
        }

        //TODO: IF COMPANY HAS BRANDED EMAIL OR PAY PAGE PACKAGES BUT NOT HAVE CONFIGURED THE CONTENT THEN GET SUPER ADMIN'S EMAIL CONTENT
        if(is_null($checkIfEmailTemplate)){
            $checkIfEmailTemplate = EmailContent::where(['company_id' => 1, 'email_category_id' => $email_cat->id])->first();
        }
        else
        {
        //TODO: IF COMPANY HAS BRANDED EMAIL OR PAY PAGE PACKAGES BUT NOT HAVE CONFIGURED THE CONTENT THEN GET SUPER ADMIN'S EMAIL CONTENT
            if($checkIfEmailTemplate->content == "")
            {
            $checkIfEmailTemplate = EmailContent::where(['company_id' => 1, 'email_category_id' => $email_cat->id])->first();
            }
        }
        $brand = BrandedEmail::where('company_id', $company_id)->first();

        if(!is_null($brand))
        {
            $brand_name = $brand->title;
            $brand_email = $brand->email;
        }
        else
        {
            $brand_name = config('app.name');
            $brand_email = $brand_email = 'xyz@gmail.com';

        }

        $details = [
            'settings' => $settings,
            'content' => strtr($checkIfEmailTemplate->content,$varMap)
        ];


        Mail::send('emails.dynamic_email', $details, function($message) use ($brand_name, $subject, $email, $brand_email) {
            $message->to($email)->subject($subject);
            $message->from($brand_email, $brand_name);
         });
    }
}

//TODO: For Creating Callback Link
if(!function_exists('CallbackLink'))
{
    function CallbackLink($id)
    {
      return url('/api/payment-callback') .'/'. base64_encode($id);
    }
}

//TODO: For Creating Return Callback Link
if(!function_exists('ReturnCallbackLink'))
{
    function ReturnCallbackLink($id)
    {
      return url('/api/callback') .'/'.  base64_encode($id);
    }
}

//TODO: Function For Saving ThirdParty Responses To Trash
if(!function_exists('SaveTrash'))
{
    //TODO: Save Response To Trash
    function SaveTrash($company_id, $tran_ref, $data, $error)
    {
        //Saving Data To Trash
        $trash = new Trash;
        $trash->company_id = $company_id;
        $trash->tran_ref = isset($tran_ref) ? $tran_ref : '';
        $trash->content = isset($data) ? $data : '';
        $trash->error = isset($error) ? $error : '';
        $trash->save();
    }
}
//FOR Changing the sattus of notification
if(!function_exists('change_noti_status'))
{
    function change_noti_status($noti_id)
    {
        Notification::where('id', $noti_id)->update(['is_read' => 1]);
    }
}


?>
