<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Accounts\Journal;
use App\Models\Admin\Accounts\ProfitAccount;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class ProfitController extends Controller
{
    //Loadin Profile Account index view
    public function index(Request $request)
    {
        if($request->ajax())
        {
            if(isset($request->company_id))
            {
                $profit = ProfitAccount::with('companies')->where('company_id', $request->company_id)->where('company_id', '!=', Auth::user()->id)->get();
            }
            else
            {
            $profit = ProfitAccount::with('companies')->where('company_id', '!=', Auth::user()->id)->get();
            }
            $tbody = '';

            if(count($profit) > 0)
            {

                foreach($profit as $jr)
                {
                    $tbody .= '
                    <tr>
                    <td>'.$jr->created_at->format('d/M/Y').'</td>
                    <th>'.$jr->companies->company_name.'</th>
                    <td>'.$jr->fixed_cost.'</td>
                    <td>'.$jr->service_fee.'</td>
                    <td>'.$jr->withdrawal_fee.'</td>
                    <td>'.$jr->tax.'</td>
                    <th>'.($jr->fixed_cost + $jr->service_fee + $jr->withdrawal_fee).'</th>
                    <th>'.(($jr->fixed_cost + $jr->service_fee + $jr->withdrawal_fee) - $jr->tax).'</th>
                    </tr>
                    ';
                }
            }
            else
            {
                $tbody .= '<tr><td colspan="7" class="text-center">No data available in table</td></tr>';
            }

            return $tbody;
        }
        $companies = User::where('user_role', 2)->get();
        return view('admin.accounts.profit-account.index', compact('companies'));
    }
}
