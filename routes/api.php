<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Paylinks\GeneratePayamentLinkController;
use App\Http\Controllers\Api\Invoices\InvoiceController;
use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Dashboard\DashboardController;
use App\Http\Controllers\Api\PropertyController;
use App\Http\Controllers\Api\Companies\CompaniesController;
use App\Http\Controllers\Api\Agents\AgentsController;
use App\Http\Controllers\Api\PageDetailsController;
use App\Http\Controllers\Api\SliderController;
use App\Http\Controllers\Api\SellWithUsConctroller;
use App\Http\Controllers\Api\InstagramFeedController;
use App\Http\Controllers\Api\JoinAaronzLifeController;
use App\Http\Controllers\Api\LifeStyleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
//TODO: Route for payment confirmation
Route::post('/payment-callback/{string}' ,[GeneratePayamentLinkController::class, 'callback']);
Route::post('/callback/{string}' ,[GeneratePayamentLinkController::class, 'return_callback']);

//TODO: MyridePay Mobile App Api
/**Auth Apis */
Route::post('login', [AuthController::class, 'login']);
Route::post('customer-signup', [AuthController::class, 'customer_signup']);
Route::post('company-signup', [AuthController::class, 'company_signup']);
Route::post('resend-signup-verification-code', [AuthController::class, 'resend_signup_verification_code']);
Route::post('verify-signup-verification-code', [AuthController::class, 'verify_signup_verification_code']);
Route::post('reset-password', [AuthController::class, 'reset_password']);
Route::post('resend-verification-code', [AuthController::class, 'resend_verification_code']);
Route::post('verify-verification-code', [AuthController::class, 'verify_verification_code']);
/**Misc. Apis */
Route::get('get-nationalities', [AuthController::class, 'get_nationalities']);

Route::group(['prefix' => '/'], function(){
    /*** Property Related Apis ***/
Route::get('get-home-data', [PropertyController::class, 'get_home_data']);
Route::post('get-detail-page-properties', [PropertyController::class, 'get_detail_page_data']);
Route::post('signature-page-properties', [PropertyController::class, 'get_signature_page']);

Route::get('get-property-types', [PropertyController::class, 'get_property_type']);
Route::get('get-property-category/{id}', [PropertyController::class, 'get_property_category']);
Route::get('get-locations', [PropertyController::class, 'get_locations']);
Route::get('get-properties', [PropertyController::class, 'get_properties']);
Route::post('get-rent-properties', [PropertyController::class, 'get_rent_properties']);
Route::post('get-sale-properties', [PropertyController::class, 'get_sale_properties']);
Route::post('get-agent-properties', [PropertyController::class, 'get_agent_properties']);
Route::post('get-developer-properties', [PropertyController::class, 'get_developer_properties']);
Route::get('get-property-leads', [PropertyController::class, 'get_property_leads']);
Route::get('get-assigned-property-leads', [PropertyController::class, 'get_assigned_property_leads']);
Route::post('get-latest-properties', [PropertyController::class, 'get_latest_properties']);
Route::post('get-featured-properties', [PropertyController::class, 'get_featured_properties']);
Route::get('get-developers', [PropertyController::class, 'get_developers']);
Route::get('get-developer-details/{id}', [PropertyController::class, 'get_developer_details']);
Route::get('get-property-detail/{id}', [PropertyController::class, 'get_property_detail']);
Route::get('fields-quick-search', [PropertyController::class, 'fields_quick_search']);
Route::get('off-plan-properties', [PropertyController::class, 'get_offplan_properties']);
Route::post('advance-search', [PropertyController::class, 'advance_search']);
Route::post('offplan-advance-search', [PropertyController::class, 'offplan_advance_search']);
Route::post('search-properties', [PropertyController::class, 'search_properties']);
Route::get('property-tenancy-contracts', [PropertyController::class, 'property_tenancy_contract']);
Route::get('get-home-menu', [PropertyController::class, 'home_page_menu']);
Route::get('get-page-detail/{id}', [PropertyController::class, 'get_page_detail']);
Route::get('get-all-pages', [PropertyController::class, 'get_all_pages']);
Route::post('send-lead', [PropertyController::class, 'send_lead']);        //->middleware('auth:api');  => Removed bcz there is no login on website
    //***ROUTE TO SEND EMAIL FOR JOIN AARONZ LIFE***//
Route::post('enquire-now', [PropertyController::class, 'enquire_now_detail_page']);
Route::post('send-mortgage-lead', [PropertyController::class, 'send_mortgage_lead']);        //->middleware('auth:api');  => Removed bcz there is no login on website
//Make Favourite Un Favourite Property
Route::post('add-remove-favourite-property', [PropertyController::class, 'add_remove_favourite_property']);
Route::post('check-favourite-property', [PropertyController::class, 'check_favourite_property']);
Route::get('get-favourite-properties', [PropertyController::class, 'get_favourite_properties']);
//SERVICES LEAD START HERE//
Route::post('send-service-lead', [PropertyController::class, 'send_service_lead']);
Route::get('get-services', [PropertyController::class, 'get_service']);
Route::get('get-service-leads', [PropertyController::class, 'get_service_leads']);

//INSTAGRAM FEEDS ROUTES//
Route::get('get-instagram-feeds', [InstagramFeedController::class, 'get_instagram_feeds']);

//Company  and agent Routs
Route::get('get-companies', [CompaniesController::class, 'index']);

Route::get('get-slider', [SliderController::class, 'index']);
Route::get('get-agents', [AgentsController::class, 'index']);
Route::get('agent-profile/{id}', [AgentsController::class, 'profile']);

//LIFESTYLE ROUTE//
Route::get('get-lifestyles',[LifeStyleController::class,'get_life_styles']);
Route::get('get-lifestyle-details/{id}', [LifeStyleController::class, 'get_life_style_details']);
Route::get('get-news',[LifeStyleController::class,'get_news']);
Route::get('get-area-properties/{id}', [LifeStyleController::class, 'get_area_properties']);
Route::get('get-news-details/{id}', [LifeStyleController::class, 'get_blog_details']);



///SELL WITH US ROUTE//
Route::post('sell-with-us', [SellWithUsConctroller::class, 'sell_with_us']);

//PAGES ROUTES START HERE//
Route::post('page-details', [PageDetailsController::class, 'page_details']);

//***ROUTE TO SEND EMAIL FOR JOIN AARONZ LIFE***//
Route::post('join-aaronz-life', [JoinAaronzLifeController::class, 'join_aaronz_life']);


});



/**Lead Reated Apis */
// Route::group(['prefix' => '/', 'middleware' => 'auth:api'], function(){
//         /**Property Related Apis */
//     Route::get('get-property-types', [PropertyController::class, 'get_property_type']);
//     Route::get('get-property-category/{id}', [PropertyController::class, 'get_property_category']);
//     Route::get('get-locations', [PropertyController::class, 'get_locations']);
//     Route::get('get-properties', [PropertyController::class, 'get_properties']);
//     Route::get('get-property-leads', [PropertyController::class, 'get_property_leads']);
//     Route::get('get-assigned-property-leads', [PropertyController::class, 'get_assigned_property_leads']);
//     Route::get('get-latest-properties', [PropertyController::class, 'get_latest_properties']);
//     Route::get('get-featured-properties', [PropertyController::class, 'get_featured_properties']);
//     Route::get('get-developers', [PropertyController::class, 'get_developers']);
//     Route::get('get-property-detail/{id}', [PropertyController::class, 'get_property_detail']);
//     Route::get('fields-quick-search', [PropertyController::class, 'fields_quick_search']);
//     Route::post('quick-search', [PropertyController::class, 'quick_search']);
//     Route::post('search-properties', [PropertyController::class, 'search_properties']);
//     Route::get('property-tenancy-contracts', [PropertyController::class, 'property_tenancy_contract']);
//     Route::post('send-lead', [PropertyController::class, 'send_lead']);
//     //Make Favourite Un Favourite Property
//     Route::post('add-remove-favourite-property', [PropertyController::class, 'add_remove_favourite_property']);
//     Route::post('check-favourite-property', [PropertyController::class, 'check_favourite_property']);
//     Route::get('get-favourite-properties', [PropertyController::class, 'get_favourite_properties']);
//     //SERVICES LEAD START HERE//
//     Route::post('send-service-lead', [PropertyController::class, 'send_service_lead']);
//     Route::get('get-services', [PropertyController::class, 'get_service']);
//     Route::get('get-service-leads', [PropertyController::class, 'get_service_leads']);
//     //Company Routs
//     Route::get('get-companies', [CompaniesController::class, 'index']);
//     Route::get('get-agents', [AgentsController::class, 'index']);
//     Route::get('agent-profile/{id}', [AgentsController::class, 'profile']);



//     //TODO: Logout Route
//     Route::get('logout', [AuthController::class, 'logout']);
// });

//TODO: Route works if a api does not exist
Route::fallback(function()
{
    return response()->json(['status' => 404, 'message' => 'The request route is not exits.']);
});
