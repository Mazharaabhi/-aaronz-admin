<?php

namespace App\Http\Controllers\Admin\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Accounts\Withdrawal;
use Yajra\Datatables\Datatables;
use Carbon\Carbon;
use App\Models\Admin\Accounts\Journal;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Admin\Accounts\TransferableAmount;
use App\Models\Admin\Accounts\ProfitAccount;
use PDF as MPDF;

class WithdrawalRequestController extends Controller
{
    //TODO: Loading Bank Accounts index view
    public function index(Request $request, $row_id = null, $noti_id = null)
    {
        if(!empty($noti_id))
        {
            change_noti_status($noti_id);
        }

        $edit_status = CheckPermission(config('const.STATUS'), config('const.WITHDRAWALREQUEST'));

        if($request->ajax())
        {
            $withdrawal_requests = Withdrawal::join('users', 'users.id', '=', 'withdrawals.company_id')->orderBy('withdrawals.id', 'DESC')
            ->get([
                'withdrawals.id as id',
                'withdrawals.company_id as company_id',
                'withdrawals.amount',
                'withdrawals.reason',
                'withdrawals.admin_charges',
                'withdrawals.created_at',
                'withdrawals.status',
                'users.company_name',
                'users.withdraw_limit',
            ]);
            return Datatables::of($withdrawal_requests)
            ->addIndexColumn()
            ->editColumn('id', 'ID: {{$id}}')
            ->addColumn('last_approval_date', function($withdrawal_requests) {
                if($withdrawal_requests->withdraw_limit <= 0)
                {
                    $date = $withdrawal_requests->created_at->addDays(1)->format('d F Y');
                    $real_date = $withdrawal_requests->created_at->addDays(1);
                }
                else
                {
                    $date = $withdrawal_requests->created_at->addDays($withdrawal_requests->withdraw_limit)->format('d F Y');
                    $real_date = $withdrawal_requests->created_at->addDays($withdrawal_requests->withdraw_limit);
                }
                if(Carbon::now() > $real_date && $withdrawal_requests->status == 0)
                {
                    //TODO: Approving the request and sending the notification if super admin not approving the request
                    $this->DoApproveRequest($withdrawal_requests->id ,$withdrawal_requests->amount,$withdrawal_requests->company_id,1,$withdrawal_requests->reason,$withdrawal_requests->admin_charges);
                }
                return $date;
            })
            ->addColumn('request_on', function($withdrawal_requests) {
                $date = $withdrawal_requests->created_at->format('d F Y H:i:s');
                return $date;
            })
            ->addColumn('status', function($withdrawal_requests) {
                    if($withdrawal_requests->status == 0)
                    {
                        return '<label class="label label-lg label-light-warning label-inline">Pending</label>';
                    }
                    elseif($withdrawal_requests->status == 1)
                    {
                        return '<label class="label label-lg label-light-success label-inline">Completed</label>';
                    }
                    else
                    {
                        return '<label class="label label-lg label-light-danger label-inline">Rejected</label>';
                    }
            })
            ->addColumn('action', function ($withdrawal_requests) use($edit_status) {
                if($edit_status == 1)
                {
                    if($withdrawal_requests->status == 0)
                {
                    return '
                    <input type="hidden" name="id" value="'.$withdrawal_requests->id.'">
                    <input type="hidden" name="company_id" value="'.$withdrawal_requests->company_id.'">
                    <input type="hidden" name="amount" value="'.$withdrawal_requests->amount.'">
                    <input type="hidden" name="admin_charges" value="'.$withdrawal_requests->admin_charges.'">
                    <input type="hidden" name="status" value="'.$withdrawal_requests->status.'">
                    <input type="hidden" name="reason" value="'.$withdrawal_requests->reason.'">
                    <input type="hidden" name="row_'.$withdrawal_requests->id.'" id="row_'.$withdrawal_requests->id.'" value="'.$withdrawal_requests->id.'">
                    <button class="btn btn-info btn-sm" id="change_status">Change Status</button>
                   ';
                }
                else
                {
                    return '
                    <input type="hidden" name="id" value="'.$withdrawal_requests->id.'">
                    <input type="hidden" name="bank_name" value="'.$withdrawal_requests->company_name.'">
                    <input type="hidden" name="status" value="'.$withdrawal_requests->status.'">
                    <input type="hidden" name="reason" value="'.$withdrawal_requests->reason.'">
                    <input type="hidden" name="row_'.$withdrawal_requests->id.'" id="row_'.$withdrawal_requests->id.'" value="'.$withdrawal_requests->id.'">
                   ';
                }
                }

            })
            ->rawColumns(['status', 'action', 'last_approval_date', 'request_on'])
            ->make(true);
        }

        $id = 'row_'.$row_id;
        return view('admin.companies.withdrawal-requests.index', compact('id'));
    }

    //TODO: For Update Withdraw Request Status
    public function update_status(Request $request)
    {
        $this->DoApproveRequest($request->withdrawal_id,$request->amount,$request->company_id,$request->status,$request->reason,$request->admin_charges);
        return 'true';
    }

    //TODO: For Updating the satatus of withdrawal request
    public function DoApproveRequest($withdrawal_id,$amount,$company_id,$status,$reason,$admin_charges)
    {
        //TODO: Updating the withdrawal request
        $withdrawal = Withdrawal::find($withdrawal_id);
        $withdrawal->status = $status;
        $withdrawal->reason = $reason;
        $withdrawal->modify_by = Auth::user()->id;
        $withdrawal->update();

        //TODO: Journal Entery
        if($status == 1)
        {
            $journal = New Journal;
            $journal->company_id = $company_id;
            $journal->withdrawal_id = $withdrawal_id;
            $journal->type = "Payout";
            $journal->dr = $amount;
            $journal->save();

        }
        $company = User::where('id', $company_id)->first();

        //TODO: Creating Notification
        $noti = new Notification;
        $noti->to = $company_id;
        $noti->from = admin_company_id();
        $noti->row_id = $withdrawal_id;
        $noti->link = '/portal/accounts/withdrawal';
        if($status == 1)
        {
            $noti->type = 'Your Withdrawal Approved By Admin';
            //Transfer From Pending Email FOr Company
            $token = array(
            'Name' => $company->company_name,
            'WithdrawalAmount' => $amount,
            'ClickHere' => '<a href="'.route('portal.accounts.withdrawal.index').'">click here</a> to view details.',
            );
            $pattern = '[%s]';
            foreach($token as $key=>$val){
                $varMap[sprintf($pattern,$key)] = $val;
            }

            // Tranfer Amount to Profile Account For Admin
            $pa = new ProfitAccount;
            $pa->company_id = $company_id;
            $pa->withdrawal_fee = $admin_charges;
            $pa->gross_profit = $admin_charges;
            $pa->net_profit = $admin_charges;
            $pa->save();

            //Creating journal Enter For Super Admin
            $journal = new Journal;
            $journal->company_id = 1;
            $journal->from_company = $company_id;
            $journal->type = "Withdrawal Fee Received";
            $journal->narration = $company->company_name . ' has paid withdrawal Fee'. $admin_charges;
            $journal->cr = $admin_charges;
            $journal->save();

            AdminSendEmail(1, 17, $varMap, $company->email);

            //TODO: Sending Email To Admin
            $user = User::where('id', admin_company_id())->first();

            $data['user'] = $user;
            $data['company'] = $company;
            $data['amount'] = $amount;
            $data['invoice_no'] = $withdrawal_id;
            //Calculating Tax
            $tax = $amount * 5 / 100;
            $data['tax'] = $tax;
            $data['total'] = $amount - $tax;

            Mail::send('emails.pdf', $data, function($message) use ($company) {
                $message->to($company->email, 'MyridePay')->subject('Luxury Car Rental Payment Withdrawal');
            });

//             $pdf = MPDF::loadView('emails.pdf', $data);


// //             // return $pdf->stream('document.pdf');


//             $token = array(
//                 'Name' => $user->name,
//                 'CompanyName' => $company->company_name,
//                 );
//                 $pattern = '[%s]';
//                 foreach($token as $key=>$val){
//                     $varMap[sprintf($pattern,$key)] = $val;
//                 }

//             AttachMentPdf(1, 24, $varMap, 'hamzaashraf160@gmail.com', $pdf);
        }
        else if($status == 2)
        {
            $noti->type = 'Your Withdrawal Rejected By Admin';

            //Updating The Transferable
            $oldTransferable = TransferableAmount::where('company_id', $company_id)->first();
            TransferableAmount::where('company_id', $company_id)->update([
                'transferable_amount' => ($oldTransferable->transferable_amount + $amount + $admin_charges)
            ]);
            //Transfer From Pending Email FOr Company
            $token = array(
                'Name' => $company->company_name,
                'WithdrawalAmount' => $amount,
                'WithdrawalStatus' => 'Rejected',
                'ClickHere' => '<a href="'.route('portal.accounts.withdrawal.index').'">click here</a> to view details.',
                );
                $pattern = '[%s]';
                foreach($token as $key=>$val){
                    $varMap[sprintf($pattern,$key)] = $val;
                }
                AdminSendEmail(1, 16, $varMap, $company->email);

        }
        $noti->save();
    }

}
