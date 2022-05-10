<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms\LifeStyle;
use App\Models\Cms\NewsCategory;
use App\Models\Cms\News;
use App\Models\Locations\LocationArea;
use App\Models\Properties\Property;
use App\Models\Cms\Page;

class LifeStyleController extends Controller
{
     //**GET LIFESTYLES**//
     public function get_life_styles(){
        try{

            $lifestyles = LifeStyle::get();

            $lifestyle_page = Page::where('slug','/life-style-in-dubai')->first();

            $lifestyles = ['lifestyle_page' => $lifestyle_page,'lifestyles' => $lifestyles];

            return response()->json(['code' => 200, 'message' => 'lifestyles', 'response' => $lifestyles]);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
    //**GET LIFESTYLE DETAILS**//
    public function get_life_style_details($id){
        try{
               $lifestyle = LifeStyle::where('slug','/life-style-in-dubai/'.$id)->first();

               $loc_areas = explode(',', $lifestyle->areas);

              //**GETTING PROPERTIES START HERE */

              $lifestyle_areas = LocationArea::whereIn('id',$loc_areas)->where('status',1)->get();

              $lifestyle_areas = ['lifestyle_details' => $lifestyle , 'lifestyle_areas' =>$lifestyle_areas];

              //******* GETTING PROPERTIES START HERE  *******/

            return response()->json(['code' => 200, 'message' => 'Lifestyle & Areas', 'response' => $lifestyle_areas]);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
     //**GET LIFESTYLE PROPERTIES**//
     public function get_area_properties($id){
        try{
               $area_properties = Property::where('location_area_id',$id)->where(['status' => 2,'lang_id' => 1])->with('area')->with('agent')->with('images')->orderBy('id', 'DESC')->get(
                  [
                    'title','id','size_sqft','size_sqmtr','project_name','price','agent_id','features','amenities'
                  ]);
            return response()->json(['code' => 200, 'message' => 'Area Properties', 'response' => $area_properties]);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

    ///**GETTING NEWS POSTS HERE */
     public function get_news(){
        try{
            $news = News::with('categories:id,name')->where('lang_id',1)->orderBy('id','DESC')->get();
            $blog_page = Page::where('slug','/blogs')->first();
            return response()->json(['code' => 200, 'message' => 'New Posts', 'response' => $news ,'blog_page' => $blog_page]);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }

     //**GET LIFESTYLE PROPERTIES**//
     public function get_blog_details($id){
        try{

            $news = News::with('categories:id,name')->where('id',$id)->first();

            return response()->json(['code' => 200, 'message' => 'Blog Details', 'response' => $news]);
        }catch(\Exception $ex)
        {
            return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
        }
    }
}

