<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Cms\InstagramFeed;
use Illuminate\Http\Request;

class InstagramFeedController extends Controller
{
     /**Get Property tenancy contract */
     public function get_instagram_feeds(Request $request)
     {
         try{
             $instagram_feeds = InstagramFeed::orderBy('id', 'DESC')->get();
             return response()->json(['code' => 200, 'message' => 'Instagram Feeds', 'response' => $instagram_feeds]);
         }catch(\Exception $ex)
         {
             return response()->json(['code' => 500, 'message' => 'Internal Server Error', 'response' => $ex->getMessage()]);
         }
     }
}
