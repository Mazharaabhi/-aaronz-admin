<?php

namespace App\Http\Controllers\Admin\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Accounts\Journal;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class JournalController extends Controller
{
    //TODO: Loading Jornal Entries index view
    public function index(Request $request, $row_id = null, $noti_id = null)
    {
        if(!empty($noti_id))
        {
            change_noti_status($noti_id);
        }
        if($request->ajax())
        {
            $journals = Journal::where('company_id', Auth::user()->id)->orderBy('id', 'DESC')->get();
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
        return view('admin.accounts.journal.index');
    }


}
