<?php

namespace App\Http\Controllers\Admin\Leads;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Models\Admin\Leads\Lead;
use App\Models\Admin\Leads\LeadLog;
use App\Models\Admin\Leads\AssignedLead;
use App\Models\Administrator\UserRole;
use App\Models\Properties\Property;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
class LeadController extends Controller
{
    public function index()
    {
        //TODO: Passing Data to yajra Datatables
        if (auth()->user()->role_id == 1) {
            $leads = Lead::with(['assigned_to' => function ($query) {
                $query->with('user');
            }])->orderBy('id', 'desc')->get();
        } else {
            $leads = Lead::whereHas('assigned_to' ,function (Builder $query) {
                $query->where('assigned_to', auth()->user()->id);
            })->with(['assigned_to' => function($q){
                $q->with('user');
            }])->orderBy('id', 'desc')->get();
        }
       // return $leads;
        if (request()->ajax()) {
            return Datatables::of($leads)
      ->addIndexColumn()
         ->addColumn('type', function ($leads) {
             if ($leads->type == 1) {
                 return 'Property';
             }
             elseif ($leads->type == 2) {
                return 'Contact Us';
            } elseif ($leads->type == 3) {
                return 'Mortgage';
            }
         })
      ->addIndexColumn()
      ->addColumn('date', function ($leads) {
          return Carbon::parse($leads->created_at)->format('d-M-Y');
      })
      ->addColumn('assign_lead', function ($leads) {

          if ($leads->status == 0) {
              $html = '
            <input type="hidden" name="lead_id" value="'.$leads->id.'"/>
            <input type="hidden" name="status" value="'.$leads->status.'"/>
            <select id="lead_for" name="lead_for" class="mb-1">
                <option value="">---select Lead For---</option>
                <option value="3">Agent</option>
            </select>
            <select id="company_id" name="company_id" class="">
            <option value="">---select Company---</option>
            </select>
            ';
          } else {
              $assigned_lead = AssignedLead::where('lead_id', $leads->id)->first();

              if ($assigned_lead != "") {
                  $company = User::with('companies')->where('id', $assigned_lead->assigned_to)->first();
                  $role = UserRole::where('id', $company->role_id)->first();
                  $html = '<p style="margin:0px"><b>'.$role->name.'</b></p><p style="margin:0px"><a href="'.route('manage-leads.edit', $leads->id).'">';

                  if ($company->role_id == 3) {
                      $html .= $company->name .' | '. 'Aaronz Property'.' ';
                  } else {
                      $html .= $company->name;
                  }

            $html .= '</a> <i class="fa fa-edit text-primary" id="show_hide" style="cursor:pointer"></i></p>';
            $companies = User::with('companies')->where(['role_id' => $leads->assigned_to->user->role_id, 'is_active' => 1, 'is_verified' => 1])->get();
            $html .= '
            <input type="hidden" name="lead_id" value="'.$leads->id.'"/>
            <input type="hidden" name="status" value="'.$leads->status.'"/>
            <div class="d-none" id="select_divs" data-id="0">
                <select id="lead_for" name="lead_for" class="mb-1">
                <option value="">---select Lead For---</option>
                <option value="3" '.($leads->assigned_to->user->role_id == 3 ? "selected" : "").'>Agent</option>
                </select>
                <select id="company_id" name="company_id" class="">
                <option value="">---select Company---</option>';
                  if ($companies->count()) {
                      foreach ($companies as $item) {
                          if ($leads->assigned_to->user->role_id == 3) {
                              $html .= '<option value="'.$item->id.'" '.($leads->assigned_to->user->id == $item->id ? "selected" : "").'>'.$item->name.' | '.$item->companies->company_name.'</option>';
                          } else {
                              $html .= '<option value="'.$item->id.'" '.($leads->assigned_to->user->id == $item->id ? "selected" : "").'>'.$item->company_name.'</option>';
                          }
                      }
                  }
                  $html .= '</select>
                </div>
            ';
              } else {
                  $html = '
                    <input type="hidden" name="lead_id" value="'.$leads->id.'"/>
                    <input type="hidden" name="status" value="'.$leads->status.'"/>
                    <select id="lead_for" name="lead_for" class="mb-1">
                        <option value="">---select Lead For---</option>
                        <option value="3">Agent</option>
                    </select>
                    <select id="company_id" name="company_id" class="">
                    <option value="">---select Company---</option>
                    </select>
                    ';
              }


          }
          return $html;

      })
         ->addColumn('status', function ($leads) {
             if ($leads->status == 0) {
                 return 'New';
             } elseif ($leads->status == 1) {
                 return 'In Progress';
             } elseif ($leads->status == 2) {
                 return 'Completed';
             } elseif ($leads->status == 3) {
                 return 'On Hold';
             } elseif ($leads->status == 4) {
                 return 'Cancelled';
             } elseif ($leads->status == 5){
                return 'Tenancy Contract';
             }elseif ($leads->status == 6){
                return 'Sale Contract';
             }

         })
      ->addColumn('action', function ($leads) {
          return '
              <input type="hidden" name="status" value="'.$leads->status.'">
              <a href="'.route('manage-leads.edit', $leads->id).'" class="btn btn-icon btn-light btn-hover-primary btn-sm mx-1" data-toggle="tooltip" data-theme="dark" title="Edit">
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
              <input type="hidden" name="id" value="'.$leads->id.'">
                 <a id="delete_language" data-id="'.$leads->id.'" class="btn btn-icon btn-light btn-hover-danger btn-sm" data-toggle="tooltip" data-theme="dark" title="Delete">
                 <span class="svg-icon svg-icon-md svg-icon-danger">
                 <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                     <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                         <rect x="0" y="0" width="24" height="24"></rect>
                         <path d="M6,8 L6,20.5 C6,21.3284271 6.67157288,22 7.5,22 L16.5,22 C17.3284271,22 18,21.3284271 18,20.5 L18,8 L6,8 Z" fill="#000000" fill-rule="nonzero"></path>
                         <path d="M14,4.5 L14,4 C14,3.44771525 13.5522847,3 13,3 L11,3 C10.4477153,3 10,3.44771525 10,4 L10,4.5 L5.5,4.5 C5.22385763,4.5 5,4.72385763 5,5 L5,5.5 C5,5.77614237 5.22385763,6 5.5,6 L18.5,6 C18.7761424,6 19,5.77614237 19,5.5 L19,5 C19,4.72385763 18.7761424,4.5 18.5,4.5 L14,4.5 Z" fill="#000000" opacity="0.3"></path>
                     </g>
                 </svg>
                 </span>
                 </a>
             ';
      })
      ->rawColumns(['status', 'action', 'sort', 'type', 'assign_lead', 'date'])
      ->editColumn('id', 'ID: {{$id}}')
      ->make(true);
        }
        return view('admin.leads.index');
    }

    public function get_companies(Request $request)
    {
        $companies = User::with('companies')->where(['role_id' => $request->role_id, 'is_active' => 1])->get();
        $option = '<option value="">--select company---</option>';

        if ($companies->count()) {
            foreach ($companies as $item) {
                if ($request->role_id == 3) {
                    $option .= '<option value="'.$item->id.'">'.$item->name.'</option>';
                } else {
                    $option .= '<option value="'.$item->id.'">'.$item->company_name.'</option>';
                }
            }
        }

        return $option;
    }

    public function assign_lead(Request $request)
    {
        /**Assign Lead */
        $checkLeadAssigned = AssignedLead::where(['assigned_to' => $request->company_id, 'lead_id' => $request->lead_id])->first();
        $lead_data = Lead::where('id', $request->lead_id)->first();
        $company_data = User::where('id', $request->company_id)->first();
        if (!is_null($checkLeadAssigned) && $request->company_id != $checkLeadAssigned->id) {
            /**Create New Assigned Lead */
            $new_lead = AssignedLead::find($checkLeadAssigned->id);
            $new_lead->assigned_by = auth()->user()->id;
            $new_lead->assigned_to = $request->company_id;
            $new_lead->update();

            /**Updating Lead Status */
            Lead::where('id', $request->lead_id)->update(['status' => 1]);

            /**Saving Lead Logs */
            $this->save_lead_log($request->lead_id, auth()->user()->id, 'assigned a new lead');
           // $this->send_email($new_lead->name, $company_data->email);
        } else {
            $lead = new AssignedLead;
            $lead->assigned_by = auth()->user()->id;
            $lead->assigned_to = $request->company_id;
            $lead->lead_id = $request->lead_id;
            $lead->save();

            /**Updating Lead Status */
            Lead::where('id', $request->lead_id)->update(['status' => 1, 'user_id' => $request->company_id]);

            /**Saving Lead Logs */
            $this->save_lead_log($request->lead_id, auth()->user()->id, 'assigned a new lead');
           // $this->send_email($lead_data->name, $company_data->email);
        }

        return 'true';
    }


    protected function send_email($name, $email)
    {
        $token = array(
            'Name' => $name,
            'ClickHere' => '<a href="'.route('manage-leads.index').'">click here</a>'
        );
        $pattern = '[%s]';
        foreach ($token as $key=>$val) {
            $varMap[sprintf($pattern, $key)] = $val;
        }

        AdminSendEmail(1, 26, $varMap, $email);
    }

    protected function save_lead_log($lead_id, $user_id, $description)
    {
        $lead_log = new LeadLog;
        $lead_log->lead_id = $lead_id;
        $lead_log->user_id = $user_id;
        $lead_log->description = $description;
        $lead_log->save();
    }

    public function add_comment(Request $request)
    {
        $lead_log = new LeadLog;
        $lead_log->lead_id = $request->lead_id;
        $lead_log->user_id = auth()->user()->id;
        $lead_log->description = $request->description;
        $lead_log->save();

        return 'true';
    }

    public function update_lead(Request $request)
    {
        $lead = Lead::find($request->id);
        $lead->name = $request->name;
        $lead->email = $request->email;
        $lead->phone = $request->phone;
        $lead->save();

        return 'true';
    }

    public function edit(Request $request, $id)
    {

        $lead = Lead::with('requester')->with(['assigned_to' => function ($query) {
            $query->with(['user' => function ($query) {
                $query->with('role', 'companies');
            }]);
        }])->with(['logs' => function ($query) {
            return $query->with('user')->orderBy('id', 'desc');
        }])->where('id', $id)->first();
       // return $lead;
        $property = Property::with('developer', 'agent', 'state', 'type', 'category','images')->where('id', $lead->property_id)->first();
        //  return $property;
        return view('admin.leads.edit', compact('lead', 'property'));
    }


    /**Update Lead Status */
    public function update_lead_status(Request $request)
    {
        Lead::where('id', $request->lead_id)->update(['status' => $request->status]);
        return 'true';
    }
}
