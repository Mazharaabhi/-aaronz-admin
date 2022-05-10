<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\Slider;

class SliderController extends Controller
{
    public function index(Request $request){
        try{

            $sliders = Slider::orderBy('id', 'DESC')->get();
            return response()->json(['code' => 200, 'message' => 'Slider', 'response' => $sliders]);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
}
