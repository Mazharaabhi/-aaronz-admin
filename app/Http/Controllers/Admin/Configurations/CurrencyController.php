<?php

namespace App\Http\Controllers\Admin\Configurations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Company\Paytab;
use App\Models\Currency;
use Illuminate\Support\Facades\Auth;
use Yajra\Datatables\Datatables;
use App\Models\User;
use Validator;

class CurrencyController extends Controller
{
    //TODO: Loading paytabs config index view
    public function index(Request $request)
    {
        $add_permission = CheckPermission(config('const.ADD'), config('const.CURRENCY'));
        $edit_permission = CheckPermission(config('const.EDIT'), config('const.CURRENCY'));
        $status_permission = CheckPermission(config('const.STATUS'), config('const.CURRENCY'));
        if($request->ajax())
        {
            $currencies = Currency::orderBy('id', 'ASC')->get();
            return Datatables::of($currencies)
            ->addIndexColumn()
            ->addColumn('status', function($currencies) use ($status_permission){
                // if($status_permission == 1)
                // {
                    if($currencies->active == 1)
                {
                    return '
                    <input type="hidden" name="id" value="'.$currencies->id.'">
                    <input type="hidden" name="active" value="'.$currencies->active.'">
                    <a id="status" class="btn btn-icon btn-light btn-hover-success btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Active">
                    <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Unlock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <mask fill="white">
                                <use xlink:href="#path-1"/>
                            </mask>
                            <g/>
                            <path d="M15.6274517,4.55882251 L14.4693753,6.2959371 C13.9280401,5.51296885 13.0239252,5 12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L14,10 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C13.4280904,3 14.7163444,3.59871093 15.6274517,4.55882251 Z" fill="#000000"/>
                        </g>
                    </svg></span>
                    </a>
                    ';
                }
                else
                {
                    return '
                    <input type="hidden" name="id" value="'.$currencies->id.'">
                    <input type="hidden" name="active" value="'.$currencies->active.'">
                    <a id="status" class="btn btn-icon btn-light btn-hover-danger btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Not Active">
                    <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Lock.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <mask fill="white">
                            <use xlink:href="#path-1"/>
                        </mask>
                        <g/>
                        <path d="M7,10 L7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 L17,10 L18,10 C19.1045695,10 20,10.8954305 20,12 L20,18 C20,19.1045695 19.1045695,20 18,20 L6,20 C4.8954305,20 4,19.1045695 4,18 L4,12 C4,10.8954305 4.8954305,10 6,10 L7,10 Z M12,5 C10.3431458,5 9,6.34314575 9,8 L9,10 L15,10 L15,8 C15,6.34314575 13.6568542,5 12,5 Z" fill="#000000"/>
                    </g>
                    </svg></span>
                    </a>
                    ';
                }
                // }
            })
            ->addColumn('action', function ($currencies) use($edit_permission){
                //  if($edit_permission == 1)
                //  {
                    return '
                    <input type="hidden" name="id" value="'.$currencies->id.'">
                    <input type="hidden" name="from_currency" value="'.$currencies->from_currency.'">
                    <input type="hidden" name="to_currency" value="'.$currencies->to_currency.'">
                    <input type="hidden" name="symbol" value="'.$currencies->symbol.'">
                    <input type="hidden" name="rate" value="'.$currencies->rate.'">
                     <a id="edit" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
                     <span class="svg-icon svg-icon-md svg-icon-primary">
                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path d="M12.2674799,18.2323597 L12.0084872,5.45852451 C12.0004303,5.06114792 12.1504154,4.6768183 12.4255037,4.38993949 L15.0030167,1.70195304 L17.5910752,4.40093695 C17.8599071,4.6812911 18.0095067,5.05499603 18.0083938,5.44341307 L17.9718262,18.2062508 C17.9694575,19.0329966 17.2985816,19.701953 16.4718324,19.701953 L13.7671717,19.701953 C12.9505952,19.701953 12.2840328,19.0487684 12.2674799,18.2323597 Z" fill="#000000" fill-rule="nonzero" transform="translate(14.701953, 10.701953) rotate(-135.000000) translate(-14.701953, -10.701953)"></path>
                            <path d="M12.9,2 C13.4522847,2 13.9,2.44771525 13.9,3 C13.9,3.55228475 13.4522847,4 12.9,4 L6,4 C4.8954305,4 4,4.8954305 4,6 L4,18 C4,19.1045695 4.8954305,20 6,20 L18,20 C19.1045695,20 20,19.1045695 20,18 L20,13 C20,12.4477153 20.4477153,12 21,12 C21.5522847,12 22,12.4477153 22,13 L22,18 C22,20.209139 20.209139,22 18,22 L6,22 C3.790861,22 2,20.209139 2,18 L2,6 C2,3.790861 3.790861,2 6,2 L12.9,2 Z" fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                        </g>
                        </svg>
                    </span>
                    </a>
                    ';
                //  }
            })
            ->rawColumns(['action', 'status'])
            ->editColumn('id', 'ID: {{$id}}')
            ->make(true);
        }

        $paytabs_count = Paytab::where('company_id', admin_company_id())->count();
         //TODO: Getting last company cart number to create cart_id
        return view('admin.configurations.currency.index', compact('paytabs_count', 'add_permission'));
    }

    //TODO: Creating paytabs record here
    public function create(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'from_currency' => 'required',
            'to_currency' => 'required|min:3|max:3',
            'symbol' => 'required',
            'rate' => 'required',
        ]);
        if($validator->fails()) return 'Cyber';

        //TODO: Checking cart id is unique or not
        $checkFromCurrency = Currency::where('from_currency', $request->from_currency)->first();
        if(!is_null($checkFromCurrency)) return 'currency';

        $currencies = $request->except('_token');
        $currencies['create_by'] = Auth::user()->id;
        Currency::create($currencies);

        return 'true';
    }

    public function update(Request $request)
    {
        // TODO: Validating the rquest params for better security
        $validator = Validator::make($request->all(), [
            'from_currency' => 'required',
            'to_currency' => 'required|min:3|max:3',
            'symbol' => 'required',
            'rate' => 'required',
            'id' => 'required'
        ]);
        if($validator->fails()) return 'Cyber';

        //TODO: Checking cart id is unique or not
        $checkFromCurrency = Currency::where('from_currency', $request->from_currency)->first();
        if(!is_null($checkFromCurrency)){
            if($checkFromCurrency->id != $request->id) return 'currency';
        }

        $currencies = $request->except('_token', 'id');
        $currencies['modify_by'] = Auth::user()->id;
        Currency::find($request->id)->update($currencies);

        return 'true';
    }

    //TODO: Change status of paytabs account
    public function status(Request $request)
    {
        if($request->active == 1)
        {
            $active = 0;
        }
        else
        {
            $active = 1;
        }
        Currency::where('id' , $request->id)->update(['active' => $active, 'modify_by' => Auth::user()->id]);
    }
}
