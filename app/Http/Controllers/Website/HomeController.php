<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Admin\Leads\Lead;
use Illuminate\Http\Request;
use App\Models\Cms\Navbar;
use App\Models\Cms\News;
use App\Models\Cms\Slider;
use App\Models\Properties\PropertyCategory;
use App\Models\Properties\Property;
use App\Models\Locations\LocationState;
use App\Models\Locations\LocationArea;
use App\Models\Properties\Developer;
use App\Models\Properties\View;

class HomeController extends Controller
{
    //TODO: Loading Main Web Home Page
    public function index()
    {
        return 'Website Coming Soon';
        $sliders = Slider::all();
        $developers = Developer::where(['lang_id' => 1, 'status' => 1])->get();
        $views = View::where(['lang_id' => 1, 'status' => 1])->get();
        $news = News::with('categories', 'company')->where('lang_id', 1)->limit(3)->get();
        $featuredProperties = Property::with('images','developer', 'category', 'agent')->where(['lang_id' => 1, 'is_featured' => 1, 'status' => 2])->get();
        $states = LocationArea::withCount('properties')->with('location_states')->where(['lang_id' => 1, 'location_country_id' => 1, 'is_show' => 1,'status' => 1])->get();
        return view('website.home.index',compact('states', 'sliders', 'developers', 'news', 'featuredProperties', 'views'));
    }

    //Contact Us
    public function contact(){
        $header_footer = get_header_footer_content();
        return view('contact', compact('header_footer'));
    }

    /**Saving Contact Us Page */
    public function save_contact(Request $request){
         // return $request->all();
         $request->validate([
            'form_name' => 'required|min:3',
            'form_email' => 'required|email',
            'form_phone' => 'required',
            'form_subject' => 'required',
            'form_message' => 'required|min:10',
        ]);
        Lead::create([
            'name' => $request->form_name,
            'email' => $request->form_email,
            'phone' => $request->form_phone,
            'subject' => $request->form_subject,
            'description' => $request->form_message,
            'status' => 0,
            'type' => 2
        ]);

        return 'true';
    }

}
