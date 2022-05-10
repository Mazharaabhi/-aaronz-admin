<?php

namespace App\Http\Controllers\Website\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //TODO: Loading Main Web Home Page
    public function index(){
        return view('website.home.index');
    }

}
