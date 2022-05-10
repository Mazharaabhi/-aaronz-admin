<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Accounts\Journal;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SuperJournalController extends Controller
{
    //TODO: Loading Jornal Entries index view
    public function index(Request $request)
    {
        if($request->ajax())
        {
            if(isset($request->company_id))
            {
                $journals = Journal::where('company_id', $request->company_id)->where('company_id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
            }
            else
            {
            $journals = Journal::where('company_id', '!=', Auth::user()->id)->orderBy('id', 'DESC')->get();
            }
            $tbody = '';

            if(count($journals) > 0)
            {
                $tbody .= '<tr>
                <th colspan="5">Previous Balance</th>
                <th class="text-center">0</th>
                </tr>';

                foreach($journals as $jr)
                {
                    $tbody .= '
                    <tr>
                    <td>'.$jr->created_at->format('d/M/Y').'</td>
                    <th>'.$jr->type.'</th>
                    <td>'.$jr->narration.'</td>
                    <td>'.$jr->cr.'</td>
                    <td>'.$jr->dr.'</td>
                    <td>'.($jr->cr - $jr->dr).'</td>
                    </tr>
                    ';
                }
            }
            else
            {
                $tbody .= '<tr><td colspan="6" class="text-center">No data available in table</td></tr>';
            }

            return $tbody;
        }
        $companies = User::where('user_role', 2)->get();
        return view('admin.accounts.super-journal.index', compact('companies'));
    }
}
