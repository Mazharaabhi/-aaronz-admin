<?php

namespace App\Http\Controllers\Admin\Contracts;

use App\Http\Controllers\Controller;
use App\Models\Admin\Leads\Lead;
use App\Models\Admin\Settings\DocumentType;
use Illuminate\Http\Request;
use App\Models\User;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Models\CommonModel\Country;
use App\Models\Properties\Property;
use App\Models\TenancyCheque;
use App\Models\TenancyContract;
use App\Models\TenancyImage;
use DateInterval;
use DatePeriod;
use DateTime;

class PropertyContractController extends Controller
{

    //TODO: Loading manage customer index view
    public function index(Request $request)
    {
        $leads = Lead::with('tenancy')->where(['status' => 5])->orWhere(['status' => 5])->orderBy('id', 'DESC')->get();
        if($request->ajax())
        {
            return Datatables::of($leads)
            ->addIndexColumn()
            ->addColumn('action', function ($leads){
                    if(is_null($leads->tenancy))
                    {
                        return '<a href="'.route('property-contracts.create', $leads->id).'" class="btn btn-success btn-sm">Create Contract</a>';
                    }else{
                        return '<a href="'.route('property-contracts.create', $leads->id).'" class="btn btn-success btn-sm">Edit Contract</a>';
                    }
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('admin.contracts.property-contracts.index');
    }


    public function create($id){
        $lead = Lead::with(['tenancy' => function($query){
            $query->with('cheques', 'tenant_images', 'tenant_images');
        }])->with('requester')->where('id', $id)->first();

        $document_types = DocumentType::where(['status' => 1])->get();
        $property = Property::with('developer', 'agent', 'state', 'type', 'category','images')->where('id',$lead->property_id)->first();
        if(!is_null($lead->tenancy)){
            return view('admin.contracts.property-contracts.edit', compact('lead', 'property', 'document_types'));
        }else{
            return view('admin.contracts.property-contracts.create', compact('lead', 'property', 'document_types'));
        }

    }

    //For Create Process
    public function create_tenancy_contract(Request $request)
    {
        $amount = explode(',', $request->amount);
        $due_date = explode(',', $request->due_date);
         return $request->all();
        /**Creating Tenancy Contract */
        $tc = new TenancyContract;
        $tc->lead_id = $request->lead_id;
        $tc->user_id = $request->user_id;
        $tc->company_id = $request->assigned_to;
        $tc->start_date = $request->start_date;
        $tc->end_date = $request->end_date;
        $tc->check_date = $request->check_date;
        $tc->check_no = $request->check_no;
        $tc->total_amount = $request->total_amount;
        $tc->save();
        $tenancy_contract_id = $tc->id;

        /**Creating Tenanchy Checks */
        if(count($amount) > 0){
            foreach($amount as $key => $item){
                $tchq = new TenancyCheque;
                $tchq->tenancy_contract_id = $tenancy_contract_id;
                $tchq->amount = $item;
                $tchq->due_date = $due_date[$key];
                $tchq->status = 0;
                $tchq->save();
            }
        }

        /**Creating Tenancy Documents */
        if(count($request->document_type_ids) > 0){
            foreach($request->document_type_ids as $key => $item){
                $ti = new TenancyImage;
                $ti->tenancy_contract_id = $tenancy_contract_id;
                $ti->document_type_id = $request->document_type_ids[$key];
                $ti->filename = $request->file_names[$key];
                $ti->image = $request->document_files[$key]->store('TenancyDocuments', 'public');
                $ti->type = 0;
                $ti->save();
            }
        }

        // /**Creating Tenancy Documents */
        // if(count($request->document_type_idse) > 0){
        //     foreach($request->document_type_idse as $key => $item){
        //         $ti = new TenancyImage;
        //         $ti->tenancy_contract_id = $tenancy_contract_id;
        //         $ti->document_type_id = $request->document_type_idse[$key];
        //         $ti->filename = $request->file_namese[$key];
        //         $ti->image = $request->document_filese[$key]->store('TenancyOwnerDocuments', 'public');
        //         $ti->type = 1;
        //         $ti->save();
        //     }
        // }

        return 'true';
    }

    //TODO: Edit Customer Controller
    public function edit($id)
    {
        $customer = User::where('id', $id)->first();
        $countries = Country::all();
        return view('admin.customers.manage-customers.edit', compact('customer', 'countries'));
    }

    //TODO: Update Customer
    public function update(Request $request)
    {
       $checkEmail = User::where(['email' => $request->email])->where('id', '!=', $request->id)->first();

       if(!is_null($checkEmail)) return 'email';

       $checkPhone = User::where(['phone' => $request->phone])->where('id', '!=', $request->id)->first();

       if(!is_null($checkPhone)) return 'phone';

       $user = $request->except('_token');
       User::find($request->id)->update($user);

    }

    /**Getting Checks Here */
    public function get_checks(Request $request){
        $check_amount = $request->total_amount / $request->divideByNo;
        return $this->getDatesFromRange($request->check_generate_date, $request->end_date, $request->check_nos, $check_amount, $request->total_amount);
    }

    public function getDatesFromRange($start, $end, $check_nos, $check_amount, $total_amount, $format = 'Y-m-d') {
        $array = array();
        if($check_nos == 12){
            $interval = new DateInterval('P1M');
        }elseif($check_nos == 6){
            $interval = new DateInterval('P2M');
        }elseif($check_nos == 4){
            $interval = new DateInterval('P3M');
        }elseif($check_nos == 3){
            $interval = new DateInterval('P4M');
        }elseif($check_nos == 2){
            $interval = new DateInterval('P6M');
        }elseif($check_nos == 1){
            $interval = new DateInterval('P12M');
        }

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);
        // return $period;
        foreach($period as $key => $date) {
            if($key < $check_nos){
                $array[] = $date->format($format);
            }
        }

        $html = '<h3>Check Vouchers</h3>
            <table class="table table-stripped table-bordered">
                <thead>
                    <tr class="bg-primary">
                        <th>Check#</th>
                        <th>Amount</th>
                        <th>Due Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>';
                foreach($period as $key => $date) {
                    if($key < $check_nos){
                        $html .= '<tr>
                            <input type="hidden" name="amount[]" value="'.number_format((float)$check_amount, 2, '.', '').'">
                            <input type="hidden" name="due_data[]" value="'.$date->format($format).'">
                            <td>'.++$key.'</td>
                            <td>'
                            .number_format((float)$check_amount, 2, '.', '').'</td>
                            <td>'.$date->format($format).'</td>
                            <td>Pending</td>
                        </tr>';
                    }
                }
        $html .= '</tbody>
            <tfooer>
                <tr>
                    <th colspan="2">Total Amount Due: AED '.$total_amount.'</th>
                    <th colspan="2">Total Amount Paid 0</th>
                </tr>
            </tfooer>
        </table>';

        return $html;
    }
}
