<?php

namespace App\Http\Controllers\Admin\DeveloperSection;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company\Paytab;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Models\User;
use App\Models\Admin\Paylinks\Trash;
use Validator;

class PaytabJsonController extends Controller
{
    //TODO: Loading paytabs config index view
    public function index(Request $request)
    {   
        if($request->ajax())
        {
            $jsons = Trash::has('companies')->with('companies')->where('content', '!=', '')->orderBy('id', 'DESC')->get();
            return Datatables::of($jsons)
            ->addIndexColumn()
            ->addColumn('company_name', function($jsons){
                if($jsons->companies->company_name != "")
                {
                    return $jsons->companies->company_name;
                }
                else 
                {
                    return $jsons->companies->name;;
                }
            })
            ->addColumn('action', function ($jsons) {
                return '
            <textarea id="json" class="d-none">'.$jsons->content.'</textarea>
            <input type="hidden" name="tran_ref" value="'.$jsons->tran_ref.'">
            <a id="view" class="btn btn-icon btn-primary btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="View Response" aria-describedby="ui-tooltip-0">
            <span class="svg-icon svg-icon-md svg-icon-primary">
            <i class="fa fa-eye" aria-hidden="true"></i>
            </span>
            </a>
            <a id="send_email" class="btn btn-icon btn-warning btn-hover-light btn-sm" data-toggle="tooltip" data-theme="dark" title="Share Response With Email">
                <span class="svg-icon svg-icon-md svg-icon-primary">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                </span>
            </a>
            ';
            })
            ->editColumn('id', 'ID: {{$id}}')
            ->rawColumns(['company_name', 'action'])
            ->make(true);
        }
        return view('admin.developer-section.paytabs-json.index');
    }

    //TODO: Send Email along with payment link
    public function send_email(Request $request)
    {
  
        //replace template var with value
        $token = array(
            'Name'  => Auth::user()->name,
            'CompanyName' => Auth::user()->company_name,
            'TranRef' => $request->tran_ref,
            'PaytabApiResponse' => $request->html,
        );
        $pattern = '[%s]';
        foreach($token as $key=>$val){
            $varMap[sprintf($pattern,$key)] = $val;
        }

        CompanySendEmail(Auth::user()->id, 13, $varMap, $request->email);
        return 'true';
    }

}
