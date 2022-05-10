<?php

namespace App\Http\Controllers\Api\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class CompaniesController extends Controller
{
    public function index(){
        try {
        $companies = User::where('role_id', '=' , 2)->pluck('avatar');
        if (is_null($companies)) {
            return response()->json(['status' => 400, 'message' => 'No Company Found']);
        }
        return response()->json(['status' => 200, 'message' => 'Success','response'=>$companies]);
        } catch (\Exception $ex) {
            return response()->json(['status' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

}
