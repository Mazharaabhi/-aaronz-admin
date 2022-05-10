<?php

use Illuminate\Support\Facades\Route;
//Using Admin side Routes here
use App\Http\Controllers\Admin\Auth\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Profile\ProfileController as AdminProfileController;
use App\Http\Controllers\Admin\Paylinks\GeneratePayamentLinkController;
use App\Http\Controllers\Admin\Paylinks\TransactionController;
use App\Http\Controllers\Admin\Customers\CustomerController;
use App\Http\Controllers\Admin\Companies\CompanyController as AdminCompanyController;
use App\Http\Controllers\Admin\Companies\CompanyBanksController as AdminCompanyBanksController;
use App\Http\Controllers\Admin\Companies\CompanyCustomersController;
use App\Http\Controllers\Admin\Companies\CompanyTransactionController  as AdminCompanyTransactionController;
use App\Http\Controllers\Admin\Cms\NavbarController as AdminNavbarController;
use App\Http\Controllers\Admin\Services\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\Email\EmailCategoryController;
use App\Http\Controllers\Admin\Email\EmailSettingController as AdminEmailSettingController;
use App\Http\Controllers\Admin\Email\EmailTemplateController as AdminEmailTemplateController;
use App\Http\Controllers\Admin\Email\BrandedEmailController as AdminBrandedEmailController;
use App\Http\Controllers\Admin\Configurations\PaytabConfigController as AdminPaytabConfigController;
use App\Http\Controllers\Admin\Invoices\InvoiceController as AdminInvoiceController;
use App\Http\Controllers\Admin\Bank\BanksController as AdminBanksController;
use App\Http\Controllers\Admin\Notification\NotificationController as AdminNotificationController;
use App\Http\Controllers\Admin\Companies\WithdrawalRequestController;
use App\Http\Controllers\Admin\Companies\PackageController;
use App\Http\Controllers\Admin\SMS\SMSPackageController as AdminSMSPackageController;
use App\Http\Controllers\Admin\Configurations\CurrencyController as AdminCurrencyController;
use App\Http\Controllers\Admin\DeveloperSection\PaytabJsonController as AdminPaytabJsonController;
use App\Http\Controllers\Admin\DeveloperSection\ErrorsController;
use App\Http\Controllers\Admin\Accounts\JournalController as AdminJournalController;
use App\Http\Controllers\Admin\Accounts\SuperJournalController;
use App\Http\Controllers\Admin\Accounts\ProfitController;
use App\Http\Controllers\Admin\Accounts\LiabilityControllController;
use App\Http\Controllers\Admin\Administrator\UserRoleController as AdminUserRoleController;
use App\Http\Controllers\Admin\Administrator\RolePermissionController as AdminRolePermissionController;
use App\Http\Controllers\Admin\Administrator\UserController as AdminUserController;
use App\Http\Controllers\Admin\Sales\SaleController as AdminSaleController;
use App\Http\Controllers\Admin\LifeAtAaronzController;
/**Con
 * tratcs
 */
use App\Http\Controllers\Admin\Contracts\PropertyContractController;
//Loading CMS Controllers
use App\Http\Controllers\Cms\NavbarController;
use App\Http\Controllers\Cms\SliderController;
use App\Http\Controllers\Cms\NewsCategoryController;
use App\Http\Controllers\Cms\NewsController;
use App\Http\Controllers\Cms\HeaderFooterController;
use App\Http\Controllers\Cms\AronzStorySellWithUsController as AronzStory;
use App\Http\Controllers\Cms\AronzReviewsController as AronzReviews;
use App\Http\Controllers\Cms\PagesController;
use App\Http\Controllers\Cms\InstagramFeedController;
use App\Http\Controllers\Cms\LifeStyleController;
use App\Http\Controllers\Properties\OffPlanPropertiesController;
//Loading Manage Companies Routes Here
use App\Http\Controllers\PropertyManagers\PropertyManagerController as PropertyManagerController;
//Loading Services Controllers
use App\Http\Controllers\Services\ServiceCategoryController;
use App\Http\Controllers\Services\ListServiceController;
use App\Http\Controllers\Services\ServiceSubCategoryController;
use App\Http\Controllers\Services\ServiceQuestionController;
use App\Http\Controllers\Services\ServiceQuestionSubTypeController;
//Loading Manage Agents Controllers
use App\Http\Controllers\Agents\AgentController;

// SELL WITH US CONTROLLER
use App\Http\Controllers\Admin\SellWithUsController;

//Loading Properties Controllers
use App\Http\Controllers\Properties\PropertyController;
use App\Http\Controllers\Properties\PropertyParameterController;
use App\Http\Controllers\Properties\PropertyCategoryController;
use App\Http\Controllers\Properties\PropertySubCategoryController;
use App\Http\Controllers\Properties\PropertyTypeController;
use App\Http\Controllers\Properties\PropertySubTypeController;
use App\Http\Controllers\Properties\DeveloperController;
use App\Http\Controllers\Properties\PaymentMethodController;
use App\Http\Controllers\Properties\AmenityController;
use App\Http\Controllers\Properties\FeatureController;
use App\Http\Controllers\Properties\GallaryController;
use App\Http\Controllers\Properties\ViewController;
use App\Http\Controllers\Admin\PortalsController;

//Loading Locations Controllers
use App\Http\Controllers\Locations\CountryController;
use App\Http\Controllers\Locations\StateController;
use App\Http\Controllers\Locations\AreaController;
use App\Http\Controllers\Locations\LocationController;
use App\Http\Controllers\Locations\BuildingController;
use App\Http\Controllers\Locations\SubLocationController;

//Loading Locations Controllers
use App\Http\Controllers\Admin\Settings\DocumentTypeController;
use App\Http\Controllers\Admin\Settings\LanguageController;
use App\Http\Controllers\Admin\Settings\UnitController;
use App\Http\Controllers\Admin\Settings\PriceController;
use App\Http\Controllers\Admin\Settings\SizeController;

//loading Leads Controller ServicesLeadController
use App\Http\Controllers\Admin\Leads\LeadController as AdminLeadController;
use App\Http\Controllers\Admin\Leads\ServicesLeadController;
//Website Controller
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProfileController;
use App\Http\Controllers\Website\PropertyController as WebPropertyController;
use App\Http\Controllers\Website\Auth\AuthController;
use App\Http\Controllers\Website\LeadController;
use App\Http\Controllers\Website\ServiceController as WebServiceController;

use GuzzleHttp\Psr7\Request;

//watermark route
use App\Http\Controllers\WaterMarkSettingsController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/signup', [AuthController::class, 'signup'])->name('auth.signup');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');
Route::post('/verify_code', [AuthController::class, 'verify_signup_verification_code'])->name('auth.veirfy_code');
Route::post('/resend_verification_code', [AuthController::class, 'resend_signup_verification_code'])->name('auth.resend_verification_code');
Route::resource('leads', LeadController::class);

//*****ROUTES TO GENERATE XML LINK */
Route::get('/saportal/manage-properties/feed-for-Offerpal.com', [PropertyController::class, 'property_Offerpal_xml_file'])->name('properties.Offerpal.xml.file');
Route::get('/saportal/manage-properties/feed-for-dubizzle.com', [PropertyController::class, 'property_xml_file'])->name('properties.xml.file');
Route::get('/saportal/manage-properties/feed-for-bayut.com', [PropertyController::class, 'property_bayut_xml_file'])->name('properties.bayut.xml.file');
Route::get('/saportal/manage-properties/jamesedition.com', [PropertyController::class, 'property_jamesedition_xml_file'])->name('properties.jamesedition.xml.file');


Route::group(['prefix' => '/'], function () {
    /**Home Routes */
    Route::get('/', [HomeController::class, 'index'])->name('website.index');
    Route::get('/contact', [HomeController::class, 'contact']);
    Route::post('/save-contact', [HomeController::class, 'save_contact'])->name('save_contact');

    /**Customer Profile Routes */
    Route::resource('profile', ProfileController::class);
    Route::get('/buy/properties-for-sale.html', [WebPropertyController::class, 'get_sale_properties'])->name('list-buy-properties');
    Route::get('/rent/properties-for-rent.html', [WebPropertyController::class, 'get_rent_properties'])->name('list-rent-properties');
    Route::get('/buy/property/{slug}', [WebPropertyController::class, 'get_single_sale_properties'])->name('list-single-buy-properties');
    Route::get('/rent/property/{slug}', [WebPropertyController::class, 'get_single_rent_properties'])->name('list-single-rents-properties');

    /**Coumunites Property Route*/
    Route::get('properties/{city}.html', [WebPropertyController::class, 'properties_by_city'])->name('property-by-city');
    Route::get('properties/{city}/{area}.html', [WebPropertyController::class, 'properties_by_city_area'])->name('property-by-city-area');
    Route::get('properties/{city}/{area}/{location}.html', [WebPropertyController::class, 'properties_by_city_area_location'])->name('property-by-city-area-location');
    Route::get('properties/{city}/{area}/{location}/{building}.html', [WebPropertyController::class, 'properties_by_city_area_location_building'])->name('property-by-city-area-location-building');

    /**Search Property Rouute */
    Route::get('search', [WebPropertyController::class, 'search'])->name('search');
    Route::get('search-locations', [WebPropertyController::class, 'search_locations'])->name('search-locations');
    Route::post('get-property-categories', [WebPropertyController::class, 'get_property_categories'])->name('get-property-categories');

    /**Properties Property Category */
    Route::get('properties/{city}.html', [WebPropertyController::class, 'properties_by_city'])->name('property-by-city');

    /**Add Favourite Property */
    Route::post('add-property-to-favourite', [WebPropertyController::class, 'add_property_to_favourite'])->name('add-property-to-favourite');

    /**Add Property Reviews */
    Route::post('submit-property-review', [WebPropertyController::class, 'submit_property_review'])->name('submit-property-review');
    Route::get('get-property-review', [WebPropertyController::class, 'get_property_review'])->name('get-property-review');
    /**Add MOrtgage Request */
    Route::post('submit-mortgage-request', [WebPropertyController::class, 'submit_mortgage_request'])->name('submit-mortgage-request');

    /**Service Routes */
    Route::get('services', [WebServiceController::class, 'services'])->name('services');
    Route::get('service/{service}.html', [WebServiceController::class, 'index'])->name('services.index');
    Route::get('service/{service}/adds.html', [WebServiceController::class, 'get_services_adds'])->name('services.get_services_adds');
    Route::get('service/service-add/{id}', [WebServiceController::class, 'request_services_adds'])->name('services.request_services_adds');
    Route::get('get-service-sub-categories', [WebServiceController::class, 'get_service_sub_categories'])->name('services.get-service-sub-categories');
    Route::post('service-request-lead', [WebServiceController::class, 'service_request_lead'])->name('service.service-request-lead');

});



//TODO: Group Route For Localization
Route::group(['prefix' => '/saportal'], function () {
    //Public Routes.......................
    //TODO: Route for Loading admin login page
    Route::get('/', [AdminAuthController::class, 'index'])->name('admin.auth.index');
    //TODO: Route for processing login form
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.auth.login');
    //TODO: Route for loading forgot password view
    Route::get('forgot-password', [AdminAuthController::class, 'forgot_password'])->name('admin.auth.forgot-password');
    //TODO: Route for processing forgot password form
    Route::put('forgot-password', [AdminAuthController::class, 'forgot_password_process'])->name('admin.auth.forgot-password-process');
    //TODO: Route for loading reset password view
    Route::get('reset-password/{token}', [AdminAuthController::class, 'reset_password'])->name('admin.auth.reset-password');
    //TODO: Route for processing reset password form
    Route::put('reset-password', [AdminAuthController::class, 'reset_password_process'])->name('admin.auth.reset-password-process');

    //Private Routes.......................
    //TODO: Creating built-in middleware to protect the private routes
    Route::group(['middleware' => 'auth:web'], function () {
        //TODO: Route for loading Admin Dashboard
        Route::get('dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        Route::get('get_properties', [DashboardController::class, 'get_properties'])->name('admin.dashboard.get_properties');
        Route::get('admin_get_properties', [DashboardController::class, 'admin_get_properties'])->name('admin.dashboard.admin_get_properties');
        Route::get('admin_get_services', [DashboardController::class, 'admin_get_services'])->name('admin.dashboard.admin_get_services');
        Route::post('change_property_status', [DashboardController::class, 'change_property_status'])->name('admin.dashboard.change_property_status');
        Route::post('change_service_status', [DashboardController::class, 'change_service_status'])->name('admin.dashboard.change_service_status');
        Route::get('get-companies-data', [DashboardController::class, 'companies_data'])->name('admin.dashboard.get-companies-data');
        Route::post('change_is_verified', [DashboardController::class, 'change_is_verified'])->name('admin.dashboard.change_is_verified');
        Route::post('change_is_featured', [DashboardController::class, 'change_is_featured'])->name('admin.dashboard.change_is_featured');
        Route::post('change_is_signatured', [DashboardController::class, 'change_is_signatured'])->name('admin.dashboard.change_is_signatured');
        Route::post('change_is_boost', [DashboardController::class, 'change_is_boost'])->name('admin.dashboard.change_is_boost');

        //TODO: Route for loading Admin Dashboard
        Route::get('/change-application-mode', [DashboardController::class, 'change_application_mode'])->name('admin.dashboard.change-applicatoin-mode');
        //TODO: Route for logout user
        Route::get('logout', [AdminAuthController::class, 'logout'])->name('admin.auth.logout');
        //TODO: Route for Cms
        Route::group(['prefix' => 'cms'], function(){
            Route::group(['prefix' => 'navbar-menu'], function(){
                Route::get('/', [NavbarController::class, 'index'])->name('cms.navbar-menu.index');
                Route::get('/create', [NavbarController::class, 'create'])->name('cms.navbar-menu.create');
                Route::post('/create-process', [NavbarController::class, 'create_process'])->name('cms.navbar-menu.create-process');
                Route::get('/edit/{id}', [NavbarController::class, 'edit'])->name('cms.navbar-menu.edit');
                Route::post('/edit', [NavbarController::class, 'edit_process'])->name('cms.navbar-menu.update-process');
                Route::post('/change-status', [NavbarController::class, 'change_status'])->name('cms.navbar-menu.status');
                Route::post('/sort', [NavbarController::class, 'sort'])->name('cms.navbar-menu.sort');
                Route::post('/delete', [NavbarController::class, 'delete'])->name('cms.navbar-menu.delete');
            });

            //TODO: Route for sliders
            Route::group(['prefix' => 'sliders'], function(){
                //TODO: Routes for List Property
                   Route::get('/', [SliderController::class, 'index'])->name('cms.sliders.index');
                   Route::get('/create', [SliderController::class, 'create'])->name('cms.sliders.create');
                   Route::post('/create-process', [SliderController::class, 'create_process'])->name('cms.sliders.create-process');
                   Route::get('/edit/{id}', [SliderController::class, 'edit'])->name('cms.sliders.edit');
                   Route::post('/edit', [SliderController::class, 'edit_process'])->name('cms.sliders.edit-process');
                   Route::post('/change-status', [SliderController::class, 'change_status'])->name('cms.sliders.status');
                   Route::post('/delete', [SliderController::class, 'delete'])->name('cms.sliders.delete');
            });

             //TODO: Route for Instagram Feed
             Route::group(['prefix' => 'instagram-feed'], function(){
                   Route::get('/', [InstagramFeedController::class, 'index'])->name('cms.instagram-feed.index');
                   Route::get('/create', [InstagramFeedController::class, 'create'])->name('cms.instagram-feed.create');
                   Route::post('/create-process', [InstagramFeedController::class, 'create_process'])->name('cms.instagram-feed.create-process');
                   Route::get('/edit/{id}', [InstagramFeedController::class, 'edit'])->name('cms.instagram-feed.edit');
                   Route::post('/edit', [InstagramFeedController::class, 'edit_process'])->name('cms.instagram-feed.edit-process');
                   Route::post('/change-status', [InstagramFeedController::class, 'change_status'])->name('cms.instagram-feed.status');
                   Route::post('/delete', [InstagramFeedController::class, 'delete'])->name('cms.instagram-feed.delete');
            });

            //TODO: Route for lifeStyle
            Route::group(['prefix' => 'life-styles'], function(){
                Route::get('/', [LifeStyleController::class, 'index'])->name('cms.life-styles.index');
                Route::get('/create', [LifeStyleController::class, 'create'])->name('cms.life-styles.create');
                Route::post('/create-process', [LifeStyleController::class, 'create_process'])->name('cms.life-styles.create-process');
                Route::get('/edit/{id}', [LifeStyleController::class, 'edit'])->name('cms.life-styles.edit');
                Route::post('/edit', [LifeStyleController::class, 'edit_process'])->name('cms.life-styles.edit-process');
                Route::post('/change-status', [LifeStyleController::class, 'change_status'])->name('cms.life-styles.status');
                Route::post('/delete', [LifeStyleController::class, 'delete'])->name('cms.life-styles.delete');
         });

            //TODO: Route for aronz-stories
            Route::group(['prefix' => 'aronz-stories-sell-with-us'], function(){
                //TODO: Routes for List aronz-stories
                   Route::get('/', [AronzStory::class, 'index'])->name('cms.aronz-story.index');
                   Route::get('/create', [AronzStory::class, 'create'])->name('cms.aronz-story.create');
                   Route::post('/create-process', [AronzStory::class, 'create_process'])->name('cms.aronz-story.create-process');
                   Route::get('/edit/{id}', [AronzStory::class, 'edit'])->name('cms.aronz-story.edit');
                   Route::post('/edit', [AronzStory::class, 'edit_process'])->name('cms.aronz-story.edit-process');
                   Route::post('/change-status', [AronzStory::class, 'change_status'])->name('cms.aronz-story.status');
                   Route::post('/delete', [AronzStory::class, 'delete'])->name('cms.aronz-story.delete');
            });

            //TODO: Route for Aronz Reviews
            Route::group(['prefix' => 'aronz-reviews'], function(){
                //TODO: Routes for List Reviews
                   Route::get('/', [AronzReviews::class, 'index'])->name('cms.aronz-reviews.index');
                   Route::get('/create', [AronzReviews::class, 'create'])->name('cms.aronz-reviews.create');
                   Route::post('/create-process', [AronzReviews::class, 'create_process'])->name('cms.aronz-reviews.create-process');
                   Route::get('/edit/{id}', [AronzReviews::class, 'edit'])->name('cms.aronz-reviews.edit');
                   Route::post('/edit', [AronzReviews::class, 'edit_process'])->name('cms.aronz-reviews.edit-process');
                   Route::post('/change-status', [AronzReviews::class, 'change_status'])->name('cms.aronz-reviews.status');
                   Route::post('/delete', [AronzReviews::class, 'delete'])->name('cms.aronz-reviews.delete');
            });

             //TODO: Route for Life at Aaronz
             Route::group(['prefix' => 'life-at-aaronz'], function(){
                //TODO: Routes for List Aaronz
                   Route::get('/', [LifeAtAaronzController::class, 'index'])->name('cms.life-at-aaronz.index');
                   Route::get('/create', [LifeAtAaronzController::class, 'create'])->name('cms.life-at-aaronz.create');
                   Route::post('/create-process', [LifeAtAaronzController::class, 'create_process'])->name('cms.life-at-aaronz.create-process');
                   Route::get('/edit/{id}', [LifeAtAaronzController::class, 'edit'])->name('cms.life-at-aaronz.edit');
                   Route::post('/edit', [LifeAtAaronzController::class, 'edit_process'])->name('cms.life-at-aaronz.edit-process');
                   Route::post('/change-status', [LifeAtAaronzController::class, 'change_status'])->name('cms.life-at-aaronz.status');
                   Route::post('/sort-order', [LifeAtAaronzController::class, 'change_sort_order'])->name('cms-life-at-aaronz.sort.order');
                   Route::post('/delete', [LifeAtAaronzController::class, 'delete'])->name('cms.life-at-aaronz.delete');
            });

            //TODO: Route for Pages
            Route::group(['prefix' => 'pages'], function(){
                //TODO: Routes for List Reviews
                   Route::get('/', [PagesController::class, 'index'])->name('cms.pages.index');
                   Route::get('/create', [PagesController::class, 'create'])->name('cms.pages.create');
                   Route::post('/create-process', [PagesController::class, 'create_process'])->name('cms.pages.create-process');
                   Route::get('/edit/{id}', [PagesController::class, 'edit'])->name('cms.pages.edit');
                   Route::post('/edit', [PagesController::class, 'edit_process'])->name('cms.pages.edit-process');
                   Route::post('/change-status', [PagesController::class, 'change_status'])->name('cms.pages.status');
                   Route::post('/delete', [PagesController::class, 'delete'])->name('cms.pages.delete');
            });

             //TODO: Route for SEll With Us.
             Route::group(['prefix' => 'sell-with-us'], function(){
                //TODO: Routes for List Reviews
                   Route::get('/', [SellWithUsController::class, 'index'])->name('sell-with-us.index');
                   Route::get('/create', [SellWithUsController::class, 'create'])->name('sell-with-us.create');
                   Route::post('/create-process', [SellWithUsController::class, 'create_process'])->name('sell-with-us.create-process');
                   Route::get('/edit/{id}', [SellWithUsController::class, 'edit'])->name('sell-with-us.edit');
                   Route::post('/edit', [SellWithUsController::class, 'edit_process'])->name('sell-with-us.edit-process');
                   Route::post('/change-status', [SellWithUsController::class, 'change_status'])->name('sell-with-us.status');
                   Route::post('/delete', [SellWithUsController::class, 'delete'])->name('sell-with-us.delete');
            });
            //TODO: Route for news-categories
            Route::group(['prefix' => 'news-categories'], function(){
                //TODO: Routes for List Property
                   Route::get('/', [NewsCategoryController::class, 'index'])->name('cms.news-categories.index');
                   Route::get('/create', [NewsCategoryController::class, 'create'])->name('cms.news-categories.create');
                   Route::post('/create-process', [NewsCategoryController::class, 'create_process'])->name('cms.news-categories.create-process');
                   Route::get('/edit/{id}', [NewsCategoryController::class, 'edit'])->name('cms.news-categories.edit');
                   Route::post('/edit', [NewsCategoryController::class, 'edit_process'])->name('cms.news-categories.edit-process');
                   Route::post('/change-status', [NewsCategoryController::class, 'change_status'])->name('cms.news-categories.status');
                   Route::post('/delete', [NewsCategoryController::class, 'delete'])->name('cms.news-categories.delete');
            });

            //TODO: Route for news
            Route::group(['prefix' => 'news'], function(){
                //TODO: Routes for List Property
                   Route::get('/', [NewsController::class, 'index'])->name('cms.news.index');
                   Route::get('/create', [NewsController::class, 'create'])->name('cms.news.create');
                   Route::post('/create-process', [NewsController::class, 'create_process'])->name('cms.news.create-process');
                   Route::get('/edit/{id}', [NewsController::class, 'edit'])->name('cms.news.edit');
                   Route::post('/edit', [NewsController::class, 'edit_process'])->name('cms.news.edit-process');
                   Route::post('/change-status', [NewsController::class, 'change_status'])->name('cms.news.status');
                   Route::post('/delete', [NewsController::class, 'delete'])->name('cms.news.delete');
            });

            //TODO: Route for header-footer
            Route::group(['prefix' => 'header-footer'], function(){
                //TODO: Routes for List Property
                   Route::get('/', [HeaderFooterController::class, 'index'])->name('cms.header-footer.index');
                   Route::get('/create', [HeaderFooterController::class, 'create'])->name('cms.header-footer.create');
                   Route::post('/create-process', [HeaderFooterController::class, 'create_process'])->name('cms.header-footer.create-process');
                   Route::get('/edit/{id}', [HeaderFooterController::class, 'edit'])->name('cms.header-footer.edit');
                   Route::post('/edit', [HeaderFooterController::class, 'edit_process'])->name('cms.header-footer.edit-process');
                   Route::post('/change-status', [HeaderFooterController::class, 'change_status'])->name('cms.header-footer.status');
                   Route::post('/delete', [HeaderFooterController::class, 'delete'])->name('cms.header-footer.delete');
            });

        });

        Route::group(['prefix' => 'contracts'], function(){
            Route::group(['prefix' => 'property-contracts'], function(){
                Route::get('/' ,[PropertyContractController::class, 'index'])->name('property-contracts.index');
                Route::get('/create/{id}' ,[PropertyContractController::class, 'create'])->name('property-contracts.create');
                Route::get('/get-checks' ,[PropertyContractController::class, 'get_checks'])->name('property-contracts.get-checks');
                Route::post('/create-tenancy-contract' ,[PropertyContractController::class, 'create_tenancy_contract'])->name('property-contracts.create-tenancy-contract');
                Route::post('/add-comment' ,[PropertyContractController::class, 'add_comment'])->name('property-contracts.add-comment');
                Route::post('/update-lead' ,[PropertyContractController::class, 'update_lead'])->name('property-contracts.update-lead');
                Route::get('/edit/{id}' ,[PropertyContractController::class, 'edit'])->name('property-contracts.edit');
            });
        });

        Route::group(['prefix' => 'manage-leads'], function(){
            Route::get('/' ,[AdminLeadController::class, 'index'])->name('manage-leads.index');
            Route::get('/get-companies' ,[AdminLeadController::class, 'get_companies'])->name('manage-leads.get-companies');
            Route::post('/assign-lead' ,[AdminLeadController::class, 'assign_lead'])->name('manage-leads.assign-lead');
            Route::post('/add-comment' ,[AdminLeadController::class, 'add_comment'])->name('manage-leads.add-comment');
            Route::post('/update-lead' ,[AdminLeadController::class, 'update_lead'])->name('manage-leads.update-lead');
            Route::post('/update-lead-status' ,[AdminLeadController::class, 'update_lead_status'])->name('manage-leads.update-lead-status');
            Route::get('/edit/{id}' ,[AdminLeadController::class, 'edit'])->name('manage-leads.edit');
        });
        Route::group(['prefix' => 'manage-service-leads'], function(){
            Route::get('/' ,[ServicesLeadController::class, 'index'])->name('manage-service-leads.index');
            Route::get('/get-companies' ,[ServicesLeadController::class, 'get_companies'])->name('manage-service-leads.get-companies');
            Route::post('/assign-lead' ,[ServicesLeadController::class, 'assign_lead'])->name('manage-service-leads.assign-lead');
            Route::post('/add-comment' ,[ServicesLeadController::class, 'add_comment'])->name('manage-service-leads.add-comment');
            Route::post('/update-lead' ,[ServicesLeadController::class, 'update_lead'])->name('manage-service-leads.update-lead');
            Route::post('/update-lead-status' ,[ServicesLeadController::class, 'update_lead_status'])->name('manage-service-leads.update-lead-status');
            Route::get('/edit/{id}' ,[ServicesLeadController::class, 'edit'])->name('manage-service-leads.edit');
        });
        //TODO:: Property Manager Routes
        Route::group(['prefix' => 'property-managers', 'middleware' => 'permission:'.config('const.MANAGECOMPANY')  . ','. config('const.VIEW')], function () {
            Route::get('/' ,[PropertyManagerController::class, 'index'])->name('property-manager.index');
            Route::get('create' ,[PropertyManagerController::class, 'create'])->name('property-manager.create')->middleware(['middleware' => 'permission:'.config('const.MANAGECOMPANY')  . ','. config('const.ADD')]);
            Route::post('check-unique-bank-numbers' ,[PropertyManagerController::class, 'check_unique_bank_numbers'])->name('property-manager.check-unique-bank-numbers');
            Route::post('create' ,[PropertyManagerController::class, 'create_process'])->name('property-manager.create-process');
            Route::post('create-bank' ,[PropertyManagerController::class, 'create_bank'])->name('property-manager.create-bank');
            Route::get('edit/{id}/{row_id?}/{noti_id?}' ,[PropertyManagerController::class, 'edit'])->name('property-manager.edit');
            Route::post('update' ,[PropertyManagerController::class, 'update'])->name('property-manager.update-process');
            Route::post('is_active' ,[PropertyManagerController::class, 'is_active'])->name('property-manager.is_active');
            Route::post('delete' ,[PropertyManagerController::class, 'delete'])->name('property-manager.delete');
            Route::post('delete-bank' ,[PropertyManagerController::class, 'delete_bank'])->name('property-manager.delete-bank');
            Route::post('update-bank' ,[PropertyManagerController::class, 'update_bank'])->name('property-manager.update-bank');
            Route::get('get-package' ,[PropertyManagerController::class, 'get_package'])->name('property-manager.get-package');
            Route::post('send-email' ,[PropertyManagerController::class, 'send_email'])->name('property-manager.send-email');
        });
        //TODO: Route for Manae Agent
        Route::group(['prefix' => 'manage-agents'], function(){
            Route::get('/', [AgentController::class, 'index'])->name('manage-agents.index');
            Route::get('/create', [AgentController::class, 'create'])->name('manage-agents.create');
            Route::post('/create-process', [AgentController::class, 'create_process'])->name('manage-agents.create-process');
            Route::get('/edit/{id}', [AgentController::class, 'edit'])->name('manage-agents.edit');
            Route::post('/edit', [AgentController::class, 'edit_process'])->name('manage-agents.update-process');
            Route::post('/is-active', [AgentController::class, 'is_active'])->name('manage-agents.is_active');
            Route::post('/send-email', [AgentController::class, 'send_email'])->name('manage-agents.send-email');
            Route::post('/sort', [AgentController::class, 'sort'])->name('manage-agents.sort');
            Route::post('/delete', [AgentController::class, 'delete'])->name('manage-agents.delete');
            Route::post('/get-areas', [AgentController::class, 'get_areas'])->name('get.areas');
            Route::post('/sort-order', [AgentController::class, 'agent_sort_order'])->name('manage-agents.sort_order');
        });
        //TODO: Route for Property Services
        Route::group(['prefix'=> 'property-services'], function(){
            //TODO: Route For List Service
            Route::group(['prefix' => 'list-service'], function(){
                Route::get('/', [ListServiceController::class, 'index'])->name('manage-services.list-service.index');
                Route::get('/create', [ListServiceController::class, 'create'])->name('manage-services.list-service.create');
                Route::post('/create-process', [ListServiceController::class, 'create_process'])->name('manage-services.list-service.create-process');
                Route::get('/edit/{id}', [ListServiceController::class, 'edit'])->name('manage-services.list-service.edit');
                Route::post('/edit', [ListServiceController::class, 'edit_process'])->name('manage-services.list-service.edit-process');
                Route::post('/change-status', [ListServiceController::class, 'change_status'])->name('manage-services.list-service.status');
                Route::post('/change-live_status', [ListServiceController::class, 'change_live_status'])->name('manage-services.list-service.live_status');
                Route::post('/get-sub-services', [ListServiceController::class, 'get_sub_services'])->name('manage-services.list-service.get_sub_services');
                Route::post('/delete', [ListServiceController::class, 'delete'])->name('manage-services.list-service.delete');
            });
            //TODO: Route For Service Categories
            Route::group(['prefix' => 'categories'], function(){
                Route::get('/', [ServiceCategoryController::class, 'index'])->name('manage-services.categories.index');
                Route::get('/create', [ServiceCategoryController::class, 'create'])->name('manage-services.categories.create');
                Route::post('/create-process', [ServiceCategoryController::class, 'create_process'])->name('manage-services.categories.create-process');
                Route::get('/edit/{id}', [ServiceCategoryController::class, 'edit'])->name('manage-services.categories.edit');
                Route::post('/edit', [ServiceCategoryController::class, 'edit_process'])->name('manage-services.categories.edit-process');
                Route::post('/change-status', [ServiceCategoryController::class, 'change_status'])->name('manage-services.categories.status');
                Route::post('/delete', [ServiceCategoryController::class, 'delete'])->name('manage-services.categories.delete');
            });
             //TODO: Route For Service Categories
             Route::group(['prefix' => 'sub-categories'], function(){
                Route::get('/', [ServiceSubCategoryController::class, 'index'])->name('manage-services.sub-category.index');
                Route::get('/create', [ServiceSubCategoryController::class, 'create'])->name('manage-services.sub-category.create');
                Route::post('/create-process', [ServiceSubCategoryController::class, 'create_process'])->name('manage-services.sub-category.create-process');
                Route::get('/edit/{id}', [ServiceSubCategoryController::class, 'edit'])->name('manage-services.sub-category.edit');
                Route::post('/edit', [ServiceSubCategoryController::class, 'edit_process'])->name('manage-services.sub-category.edit-process');
                Route::post('/change-status', [ServiceSubCategoryController::class, 'change_status'])->name('manage-services.sub-category.status');
                Route::post('/delete', [ServiceSubCategoryController::class, 'delete'])->name('manage-services.sub-category.delete');
                Route::get('/view-questionnaire/{id}', [ServiceSubCategoryController::class, 'view_questionnaire'])->name('manage-services.sub-category.view_questionnaire');
                Route::get('/get-questionnaire', [ServiceSubCategoryController::class, 'get_questionnaire'])->name('manage-services.sub-category.get_questionnaire');
            });
            //TODO: Route For Service Questions
            Route::group(['prefix' => 'questions'], function(){
                Route::get('/', [ServiceQuestionController::class, 'index'])->name('manage-services.question.index');
                Route::get('/create', [ServiceQuestionController::class, 'create'])->name('manage-services.question.create');
                Route::post('/create-process', [ServiceQuestionController::class, 'create_process'])->name('manage-services.question.create-process');
                Route::get('/edit/{id}', [ServiceQuestionController::class, 'edit'])->name('manage-services.question.edit');
                Route::post('/edit', [ServiceQuestionController::class, 'edit_process'])->name('manage-services.question.edit-process');
                Route::post('/change-status', [ServiceQuestionController::class, 'change_status'])->name('manage-services.question.status');
                Route::post('/delete', [ServiceQuestionController::class, 'delete'])->name('manage-services.question.delete');
                Route::post('/option-delete', [ServiceQuestionController::class, 'option_delete'])->name('manage-services.option.delete');
                Route::post('/option-add', [ServiceQuestionController::class, 'add_option'])->name('manage-services.option.add');
                Route::post('/option-edit', [ServiceQuestionController::class, 'option_edit'])->name('manage-services.option.edit');
                Route::post('/option-update-process', [ServiceQuestionController::class, 'option_update_process'])->name('manage-services.option.update-process');
                Route::post('/search-questions', [ServiceQuestionController::class, 'search_questions'])->name('search-category-questions');
            });
             //TODO: Route For Service Questions
             Route::group(['prefix' => 'questions-sub-types'], function(){
                Route::get('/', [ServiceQuestionSubTypeController::class, 'index'])->name('manage-services.question-sub-type.index');
                Route::get('/create', [ServiceQuestionSubTypeController::class, 'create'])->name('manage-services.question-sub-type.create');
                Route::get('/get-categories', [ServiceQuestionSubTypeController::class, 'get_categories'])->name('manage-properties.question-sub-type.get-categories');
                Route::post('/create-process', [ServiceQuestionSubTypeController::class, 'create_process'])->name('manage-services.question-sub-type.create-process');
                Route::get('/edit/{id}', [ServiceQuestionSubTypeController::class, 'edit'])->name('manage-services.question-sub-type.edit');
                Route::post('/edit', [ServiceQuestionSubTypeController::class, 'edit_process'])->name('manage-services.question-sub-type.edit-process');
                Route::post('/change-status', [ServiceQuestionSubTypeController::class, 'change_status'])->name('manage-services.question-sub-type.status');
                Route::post('/delete', [ServiceQuestionSubTypeController::class, 'delete'])->name('manage-services.question-sub-type.delete');
            });
        });
        //TODO: Route for Propeties
        Route::group(['prefix' => 'manage-properties'], function(){
            //TODO: Routes for List Property
                Route::get('/', [PropertyController::class, 'index'])->name('manage-properties.property.index');

                Route::get('/import-xml', [PropertyController::class, 'create_process_xml_file'])->name('properties.import.xml.file');
//                Route::get('/import-xml', function (){
//                        dispatch(new \App\Jobs\SynicPropspaceProperties())->delay(now()->addSecond(5));
//                    })->name('properties.import.xml.file');
                Route::post('/quicksearch', [PropertyController::class, 'quick_search'])->name('manage-properties.property.quicksearch');
                Route::post('/advance-search', [PropertyController::class, 'advance_search'])->name('manage-properties.property.advance-search');
                Route::get('/create', [PropertyController::class, 'create'])->name('manage-properties.property.create');
                Route::post('/create-process', [PropertyController::class, 'create_process'])->name('manage-properties.property.create-process');
                Route::get('/edit/{id}', [PropertyController::class, 'edit'])->name('manage-properties.property.edit');
                Route::post('/edit', [PropertyController::class, 'edit_process'])->name('manage-properties.property.edit-process');
                Route::post('/change-status', [PropertyController::class, 'change_status'])->name('manage-properties.property.status');
                Route::post('/property-sort-order', [PropertyController::class, 'property_sort_order'])->name('manage-properties.property.sort_order');
                Route::post('/delete', [PropertyController::class, 'delete'])->name('manage-properties.property.delete');
                Route::post('/get-category-data', [PropertyController::class, 'get_category_data'])->name('get.category-data');
                Route::post('/get-categories-data', [PropertyController::class, 'get_categories_data'])->name('get.categories-data');
                Route::post('/get-location-text', [PropertyController::class, 'get_location_text'])->name('get.location-text');
                Route::get('/fetch-amenities', [PropertyController::class, 'fetch_amenities'])->name('property.fetch-amenities');
                Route::get('/fetch-features', [PropertyController::class, 'fetch_features'])->name('property.fetch-features');
                Route::post('/delete-property-image', [PropertyController::class, 'delete_property_image'])->name('manage-properties.property.delete-property-image');
                Route::post('/change-lat-lng', [PropertyController::class, 'change_lat_lng'])->name('change-lat-lng');
                Route::get('properties-debug', [PropertyController::class, 'debug_poprties'])->name('properties.debuging');

                Route::group(['prefix' => 'off-plan-properties'], function(){
                    Route::get('/', [OffPlanPropertiesController::class, 'index'])->name('offplan.property.index');
                    Route::get('/create', [OffPlanPropertiesController::class, 'create'])->name('offplan.property.create');
                    Route::post('/create-process', [OffPlanPropertiesController::class, 'create_process'])->name('offplan.property.create-process');
                    Route::get('/edit/{id}', [OffPlanPropertiesController::class, 'edit'])->name('offplan.property.edit');
                    Route::post('/edit', [OffPlanPropertiesController::class, 'edit_process'])->name('offplan.property.edit-process');
                    Route::post('/change-status', [OffPlanPropertiesController::class, 'change_status'])->name('offplan.property.status');
                    Route::post('/property-sort-order', [OffPlanPropertiesController::class, 'property_sort_order'])->name('offplan.property.sort_order');
                    Route::post('/delete', [OffPlanPropertiesController::class, 'delete'])->name('offplan.property.delete');
                    Route::post('/delete-property-image', [OffPlanPropertiesController::class, 'delete_property_image'])->name('offplan.property.delete-property-image');

                  });


            //TODO: Route for Developers
            Route::group(['prefix' => 'property-parameters'], function(){
                Route::get('get-property-categories', [PropertyParameterController::class, 'get_property_categories'])->name('manage-properties.property-parameters.get-property-categories');
                Route::post('create-property-categories', [PropertyParameterController::class, 'create_property_categories'])->name('manage-properties.property-parameters.create-property-categories');
                Route::get('get-property-parent-categories', [PropertyParameterController::class, 'get_property_parent_categories'])->name('manage-properties.property-parameters.get-property-parent-categories');
                Route::get('get-property-status', [PropertyParameterController::class, 'get_property_status'])->name('manage-properties.property-parameters.get-property-status');
                Route::post('create-property-status', [PropertyParameterController::class, 'create_property_status'])->name('manage-properties.property-parameters.create-property-status');
                Route::get('get-property-views', [PropertyParameterController::class, 'get_property_views'])->name('manage-properties.property-parameters.get-property-views');
                Route::post('create-property-views', [PropertyParameterController::class, 'create_property_views'])->name('manage-properties.property-parameters.create-property-views');
                Route::get('get-property-developers', [PropertyParameterController::class, 'get_property_developers'])->name('manage-properties.property-parameters.get-property-developers');
                Route::post('create-property-developers', [PropertyParameterController::class, 'create_property_developers'])->name('manage-properties.property-parameters.create-property-developers');
                Route::get('get-property-agents', [PropertyParameterController::class, 'get_property_agents'])->name('manage-properties.property-parameters.get-property-agents');
                Route::post('create-property-agents', [PropertyParameterController::class, 'create_property_agents'])->name('manage-properties.property-parameters.create-property-agents');
                Route::get('get-property-states', [PropertyParameterController::class, 'get_property_states'])->name('manage-properties.property-parameters.get-property-states');
                Route::post('create-property-states', [PropertyParameterController::class, 'create_property_states'])->name('manage-properties.property-parameters.create-property-states');
                Route::get('get-property-areas', [PropertyParameterController::class, 'get_property_areas'])->name('manage-properties.property-parameters.get-property-areas');
                Route::post('create-property-areas', [PropertyParameterController::class, 'create_property_areas'])->name('manage-properties.property-parameters.create-property-areas');
                Route::get('get-property-locations', [PropertyParameterController::class, 'get_property_locations'])->name('manage-properties.property-parameters.get-property-locations');
                Route::post('create-property-locations', [PropertyParameterController::class, 'create_property_locations'])->name('manage-properties.property-parameters.create-property-locations');
            });

            //TODO: Route for Developers
            Route::group(['prefix' => 'developers'], function(){
                Route::get('/', [DeveloperController::class, 'index'])->name('manage-properties.developers.index');
                Route::get('/create', [DeveloperController::class, 'create'])->name('manage-properties.developers.create');
                Route::post('/create-process', [DeveloperController::class, 'create_process'])->name('manage-properties.developers.create-process');
                Route::get('/edit/{id}', [DeveloperController::class, 'edit'])->name('manage-properties.developers.edit');
                Route::post('/edit', [DeveloperController::class, 'edit_process'])->name('manage-properties.developers.edit-process');
                Route::post('/change-status', [DeveloperController::class, 'change_status'])->name('manage-properties.developers.status');
                Route::post('/delete', [DeveloperController::class, 'delete'])->name('manage-properties.developers.delete');
            });
            //TODO: Route for Developers

            //TODO: Route for Developers
            Route::group(['prefix' => 'portals'], function(){
                Route::get('/', [PortalsController::class, 'index'])->name('manage-properties.portals.index');
                Route::get('/create', [PortalsController::class, 'create'])->name('manage-properties.portals.create');
                Route::post('/create-process', [PortalsController::class, 'create_process'])->name('manage-properties.portals.create-process');
                Route::get('/edit/{id}', [PortalsController::class, 'edit'])->name('manage-properties.portals.edit');
                Route::post('/edit', [PortalsController::class, 'edit_process'])->name('manage-properties.portals.edit-process');
                Route::post('/change-status', [PortalsController::class, 'change_status'])->name('manage-properties.portals.status');
                Route::post('/delete', [PortalsController::class, 'delete'])->name('manage-properties.portals.delete');
                //EXPORT ROUTES START HERE//
                Route::get('index-export', [PortalsController::class, 'index_export'])->name('manage-properties.export.portals.index');
                Route::get('/create-export', [PortalsController::class, 'create_export'])->name('manage-properties.export.portals.create');
                Route::post('/create-export-process', [PortalsController::class, 'create_export_process'])->name('manage-properties.export.portals.create-process');
                Route::get('/edit-export/{id}', [PortalsController::class, 'edit_export'])->name('manage-properties.export.portals.edit');
                Route::post('/edit-export', [PortalsController::class, 'edit_export_process'])->name('manage-properties.export.portals.edit-process');
            });
            //TODO: Route for Developers

            Route::group(['prefix' => 'payment-methods'], function(){
                //TODO: Routes for List Property
                   Route::get('/', [PaymentMethodController::class, 'index'])->name('manage-properties.payment-methods.index');
                   Route::get('/create', [PaymentMethodController::class, 'create'])->name('manage-properties.payment-methods.create');
                   Route::post('/create-process', [PaymentMethodController::class, 'create_process'])->name('manage-properties.payment-methods.create-process');
                   Route::get('/edit/{id}', [PaymentMethodController::class, 'edit'])->name('manage-properties.payment-methods.edit');
                   Route::post('/edit', [PaymentMethodController::class, 'edit_process'])->name('manage-properties.payment-methods.edit-process');
                   Route::post('/change-status', [PaymentMethodController::class, 'change_status'])->name('manage-properties.payment-methods.status');
                   Route::post('/delete', [PaymentMethodController::class, 'delete'])->name('manage-properties.payment-methods.delete');
               });
         //TODO: Route for Property Settings
            Route::group(['prefix' => 'property-settings'], function(){
                //TODO: Routes for Categories
                Route::group(['prefix' => 'categories'], function () {
                    Route::get('/', [PropertyCategoryController::class, 'index'])->name('manage-properties.property-settings.categories.index');
                    Route::get('/create', [PropertyCategoryController::class, 'create'])->name('manage-properties.property-settings.categories.create');
                    Route::post('/create-process', [PropertyCategoryController::class, 'create_process'])->name('manage-properties.property-settings.categories.create-process');
                    Route::get('/edit/{id}', [PropertyCategoryController::class, 'edit'])->name('manage-properties.property-settings.categories.edit');
                    Route::post('/edit', [PropertyCategoryController::class, 'edit_process'])->name('manage-properties.property-settings.categories.edit-process');
                    Route::post('/change-status', [PropertyCategoryController::class, 'change_status'])->name('manage-properties.property-settings.categories.status');
                    Route::post('/delete', [PropertyCategoryController::class, 'delete'])->name('manage-properties.property-settings.categories.delete');
                });
                //TODO: Routes for Sub Categories
                Route::group(['prefix' => 'sub-categories'], function () {
                    Route::get('/', [PropertySubCategoryController::class, 'index'])->name('manage-properties.property-settings.sub-categories.index');
                    Route::get('/create', [PropertySubCategoryController::class, 'create'])->name('manage-properties.property-settings.sub-categories.create');
                    Route::post('/create-process', [PropertySubCategoryController::class, 'create_process'])->name('manage-properties.property-settings.sub-categories.create-process');
                    Route::get('/edit/{id}', [PropertySubCategoryController::class, 'edit'])->name('manage-properties.property-settings.sub-categories.edit');
                    Route::post('/edit', [PropertySubCategoryController::class, 'edit_process'])->name('manage-properties.property-settings.sub-categories.edit-process');
                    Route::post('/change-status', [PropertySubCategoryController::class, 'change_status'])->name('manage-properties.property-settings.sub-categories.status');
                    Route::get('/get-categories', [PropertySubCategoryController::class, 'get_categories'])->name('manage-properties.property-settings.sub-categories.get-categories');
                    Route::post('/delete', [PropertySubCategoryController::class, 'delete'])->name('manage-properties.property-settings.sub-categories.delete');
                });
                //TODO: Routes for Categories
                Route::group(['prefix' => 'types'], function () {
                    Route::get('/', [PropertyTypeController::class, 'index'])->name('manage-properties.property-settings.types.index');
                    Route::get('/create', [PropertyTypeController::class, 'create'])->name('manage-properties.property-settings.types.create');
                    Route::post('/create-process', [PropertyTypeController::class, 'create_process'])->name('manage-properties.property-settings.types.create-process');
                    Route::get('/edit/{id}', [PropertyTypeController::class, 'edit'])->name('manage-properties.property-settings.types.edit');
                    Route::post('/edit', [PropertyTypeController::class, 'edit_process'])->name('manage-properties.property-settings.types.edit-process');
                    Route::post('/change-status', [PropertyTypeController::class, 'change_status'])->name('manage-properties.property-settings.types.status');
                    Route::post('/delete', [PropertyTypeController::class, 'delete'])->name('manage-properties.property-settings.types.delete');
                });
                //TODO: Routes for Sub Categories
                Route::group(['prefix' => 'property-status'], function () {
                    Route::get('/', [PropertySubTypeController::class, 'index'])->name('manage-properties.property-settings.property-status.index');
                    Route::get('/create', [PropertySubTypeController::class, 'create'])->name('manage-properties.property-settings.property-status.create');
                    Route::post('/create-process', [PropertySubTypeController::class, 'create_process'])->name('manage-properties.property-settings.property-status.create-process');
                    Route::get('/edit/{id}', [PropertySubTypeController::class, 'edit'])->name('manage-properties.property-settings.property-status.edit');
                    Route::post('/edit', [PropertySubTypeController::class, 'edit_process'])->name('manage-properties.property-settings.property-status.edit-process');
                    Route::post('/change-status', [PropertySubTypeController::class, 'change_status'])->name('manage-properties.property-settings.property-status.status');
                    Route::get('/get-types', [PropertySubTypeController::class, 'get_types'])->name('manage-properties.property-settings.property-status.get-types');
                    Route::post('/delete', [PropertySubTypeController::class, 'delete'])->name('manage-properties.property-settings.property-status.delete');
                });
                //TODO: Routes for Amenities
                Route::group(['prefix' => 'amenities'], function(){
                    Route::get('/', [AmenityController::class, 'index'])->name('manage-properties.property-settings.amenities.index');
                    Route::get('/create', [AmenityController::class, 'create'])->name('manage-properties.property-settings.amenities.create');
                    Route::post('/create-process', [AmenityController::class, 'create_process'])->name('manage-properties.property-settings.amenities.create-process');
                    Route::get('/edit/{id}', [AmenityController::class, 'edit'])->name('manage-properties.property-settings.amenities.edit');
                    Route::post('/edit', [AmenityController::class, 'edit_process'])->name('manage-properties.property-settings.amenities.edit-process');
                    Route::post('/change-status', [AmenityController::class, 'change_status'])->name('manage-properties.property-settings.amenities.status');
                    Route::post('/delete', [AmenityController::class, 'delete'])->name('manage-properties.property-settings.amenities.delete');
                });
                //TODO: Routes for Features
                Route::group(['prefix' => 'features'], function () {
                    Route::get('/', [FeatureController::class, 'index'])->name('manage-properties.property-settings.features.index');
                    Route::get('/create', [FeatureController::class, 'create'])->name('manage-properties.property-settings.features.create');
                    Route::post('/create-feature', [FeatureController::class, 'create_process'])->name('manage-properties.property-settings.features.create-process');
                    Route::get('/edit/{id}', [FeatureController::class, 'edit'])->name('manage-properties.property-settings.features.edit');
                    Route::post('/edit', [FeatureController::class, 'edit_process'])->name('manage-properties.property-settings.features.edit-process');
                    Route::post('/change-status', [FeatureController::class, 'change_status'])->name('manage-properties.property-settings.features.status');
                    Route::post('/delete', [FeatureController::class, 'delete'])->name('manage-properties.property-settings.features.delete');
                });
                //TODO: Routes for Views
                Route::group(['prefix' => 'views'], function () {
                    Route::get('/', [ViewController::class, 'index'])->name('manage-properties.property-settings.views.index');
                    Route::get('/create', [ViewController::class, 'create'])->name('manage-properties.property-settings.views.create');
                    Route::post('/create-process', [ViewController::class, 'create_process'])->name('manage-properties.property-settings.views.create-process');
                    Route::get('/edit/{id}', [ViewController::class, 'edit'])->name('manage-properties.property-settings.views.edit');
                    Route::post('/edit', [ViewController::class, 'edit_process'])->name('manage-properties.property-settings.views.edit-process');
                    Route::post('/change-status', [ViewController::class, 'change_status'])->name('manage-properties.property-settings.views.status');
                    Route::post('/delete', [ViewController::class, 'delete'])->name('manage-properties.property-settings.views.delete');
                });
                //TODO: Routes for Gallaries
                Route::group(['prefix' => 'gallaries'], function () {
                    Route::get('/', [GallaryController::class, 'index'])->name('manage-properties.property-settings.gallaries.index');
                    Route::get('/create', [GallaryController::class, 'create'])->name('manage-properties.property-settings.gallaries.create');
                    Route::post('/create-language', [GallaryController::class, 'create_process'])->name('manage-properties.property-settings.gallaries.create-process');
                    Route::get('/edit/{id}', [GallaryController::class, 'edit'])->name('manage-properties.property-settings.gallaries.edit');
                    Route::post('/edit', [GallaryController::class, 'edit_process'])->name('manage-properties.property-settings.gallaries.edit-process');
                    Route::post('/change-status', [GallaryController::class, 'change_status'])->name('manage-properties.property-settings.gallaries.status');
                    Route::post('/delete', [GallaryController::class, 'delete'])->name('manage-properties.property-settings.gallaries.delete');
                });
            });
        });
        Route::group(['prefix' => 'locations'], function () {
            //TODO: Routes for Countries
            Route::group(['prefix' => 'countries'], function () {
                Route::get('/', [CountryController::class, 'index'])->name('locations.countries.index');
                Route::get('/create', [CountryController::class, 'create'])->name('locations.countries.create');
                Route::post('/create-language', [CountryController::class, 'create_process'])->name('locations.countries.create-process');
                Route::get('/edit/{id}', [CountryController::class, 'edit'])->name('locations.countries.edit');
                Route::post('/edit', [CountryController::class, 'edit_process'])->name('locations.countries.edit-process');
                Route::post('/change-status', [CountryController::class, 'change_status'])->name('locations.countries.status');
                Route::post('/make-default', [CountryController::class, 'make_default'])->name('locations.countries.default');
                Route::post('/delete', [CountryController::class, 'delete'])->name('locations.countries.delete');
            });
            //TODO: Routes for States/Cities
            Route::group(['prefix' => 'states'], function () {
                Route::get('/', [StateController::class, 'index'])->name('locations.states.index');
                Route::get('/create', [StateController::class, 'create'])->name('locations.states.create');
                Route::post('/create-language', [StateController::class, 'create_process'])->name('locations.states.create-process');
                Route::get('/edit/{id}', [StateController::class, 'edit'])->name('locations.states.edit');
                Route::post('/edit', [StateController::class, 'edit_process'])->name('locations.states.edit-process');
                Route::post('/change-status', [StateController::class, 'change_status'])->name('locations.states.status');
                Route::post('/delete', [StateController::class, 'delete'])->name('locations.states.delete');
            });
            //TODO: Routes for locations
            Route::group(['prefix' => 'areas'], function () {
                Route::get('/', [AreaController::class, 'index'])->name('location.areas.index');
                Route::get('/create', [AreaController::class, 'create'])->name('location.areas.create');
                Route::post('/create-language', [AreaController::class, 'create_process'])->name('location.areas.create-process');
                Route::get('/edit/{id}', [AreaController::class, 'edit'])->name('location.areas.edit');
                Route::post('/edit', [AreaController::class, 'edit_process'])->name('location.areas.edit-process');
                Route::post('/change-status', [AreaController::class, 'change_status'])->name('location.areas.status');
                Route::post('/is-show', [AreaController::class, 'is_show'])->name('location.areas.is_show');
                Route::get('/get-state', [AreaController::class, 'get_state'])->name('location.areas.get-state');
                Route::post('/delete', [AreaController::class, 'delete'])->name('location.areas.delete');
            });
            //TODO: Routes for locations
            Route::group(['prefix' => 'locations'], function () {
                Route::get('/', [LocationController::class, 'index'])->name('locations.locations.index');
                Route::get('/create', [LocationController::class, 'create'])->name('locations.locations.create');
                Route::post('/create-language', [LocationController::class, 'create_process'])->name('locations.locations.create-process');
                Route::get('/edit/{id}', [LocationController::class, 'edit'])->name('locations.locations.edit');
                Route::post('/edit', [LocationController::class, 'edit_process'])->name('locations.locations.edit-process');
                Route::post('/change-status', [LocationController::class, 'change_status'])->name('locations.locations.status');
                Route::get('/get-state', [LocationController::class, 'get_state'])->name('locations.locations.get-state');
                Route::get('/get-area', [LocationController::class, 'get_area'])->name('locations.locations.get-area');
                Route::post('/delete', [LocationController::class, 'delete'])->name('locations.locations.delete');
            });
            //TODO: Routes for locations
            Route::group(['prefix' => 'buildings'], function () {
                Route::get('/', [BuildingController::class, 'index'])->name('locations.buildings.index');
                Route::get('/create', [BuildingController::class, 'create'])->name('locations.buildings.create');
                Route::post('/create-language', [BuildingController::class, 'create_process'])->name('locations.buildings.create-process');
                Route::get('/edit/{id}', [BuildingController::class, 'edit'])->name('locations.buildings.edit');
                Route::post('/edit', [BuildingController::class, 'edit_process'])->name('locations.buildings.edit-process');
                Route::post('/change-status', [BuildingController::class, 'change_status'])->name('locations.buildings.status');
                Route::get('/get-state', [BuildingController::class, 'get_state'])->name('locations.buildings.get-state');
                Route::get('/get-area', [BuildingController::class, 'get_area'])->name('locations.buildings.get-area');
                Route::get('/get-location', [BuildingController::class, 'get_location'])->name('locations.buildings.get-location');
                Route::post('/delete', [BuildingController::class, 'delete'])->name('locations.buildings.delete');
            });
            //TODO: Routes for locations
            Route::group(['prefix' => 'sub-locations'], function () {
                Route::get('/', [SubLocationController::class, 'index'])->name('locations.sub-locations.index');
                Route::get('/create', [SubLocationController::class, 'create'])->name('locations.sub-locations.create');
                Route::post('/create-language', [SubLocationController::class, 'create_process'])->name('locations.sub-locations.create-process');
                Route::get('/edit/{id}', [SubLocationController::class, 'edit'])->name('locations.sub-locations.edit');
                Route::post('/edit', [SubLocationController::class, 'edit_process'])->name('locations.sub-locations.edit-process');
                Route::post('/change-status', [SubLocationController::class, 'change_status'])->name('locations.sub-locations.status');
                Route::get('/get-state', [SubLocationController::class, 'get_state'])->name('locations.locations.get-state');
                Route::get('/get-location', [SubLocationController::class, 'get_location'])->name('locations.locations.get-location');
                Route::post('/delete', [SubLocationController::class, 'delete'])->name('locations.sub-locations.delete');
            });
        });
        //TODO:Route for Loading Roles and Permissions
        Route::group(['prefix' => 'administrator'], function(){
            //TODO: Route for User Role
            Route::group(['prefix' => 'user-role', 'middleware' => 'permission:'.config('const.USERROLE')  . ','. config('const.VIEW')], function(){
                Route::get('/', [AdminUserRoleController::class, 'index'])->name('admin.administrator.user-role.index');
                Route::post('/create', [AdminUserRoleController::class, 'create'])->name('admin.administrator.user-role.create');
                Route::post('/edit', [AdminUserRoleController::class, 'edit'])->name('admin.administrator.user-role.edit');
                Route::post('/delete', [AdminUserRoleController::class, 'delete'])->name('admin.administrator.user-role.delete');
            });
            //TODO: Route for User Role
            Route::group(['prefix' => 'role-permission', 'middleware' => 'permission:'.config('const.ROLEPERMISSION') . ','. config('const.VIEW')], function(){
                Route::get('/', [AdminRolePermissionController::class, 'index'])->name('admin.administrator.role-permission.index');
                Route::get('/edit/{id}', [AdminRolePermissionController::class, 'edit'])->name('admin.administrator.role-permission.edit')->middleware(['permission:'.config('const.ROLEPERMISSION') . ','. config('const.EDIT')]);
                Route::post('/update', [AdminRolePermissionController::class, 'update'])->name('admin.administrator.role-permission.update');
            });
            //TODO: Route for User Role
            Route::group(['prefix' => 'manage-users' , 'middleware' => 'permission:'.config('const.MANAGEUSER') . ','. config('const.VIEW')], function(){
                Route::get('/', [AdminUserController::class, 'index'])->name('admin.administrator.manage-users.index');
                Route::get('/create', [AdminUserController::class, 'create'])->name('admin.administrator.manage-users.create')->middleware(['middleware' => 'permission:'.config('const.MANAGEUSER') . ','. config('const.ADD')]);
                Route::post('/create', [AdminUserController::class, 'create_process'])->name('admin.administrator.manage-users.create-process');
                Route::get('/edit/{id}', [AdminUserController::class, 'edit'])->name('admin.administrator.manage-users.edit')->middleware(['middleware' => 'permission:'.config('const.MANAGEUSER') . ','. config('const.EDIT')]);
                Route::post('/update', [AdminUserController::class, 'update'])->name('admin.administrator.manage-users.update');
                Route::post('/send-email', [AdminUserController::class, 'send_email'])->name('admin.administrator.manage-users.send-email');
            });
        });
        //TODO:: Profile Group Routes
        Route::group(['prefix' => 'profile' ], function () {
            //TODO: Route for loading profile view
            Route::get('/' ,[AdminProfileController::class, 'index'])->name('admin.profile.index');
            Route::get('update' ,[AdminProfileController::class, 'update_profile_view'])->name('admin.profile.update-profile-view');
            Route::post('update' ,[AdminProfileController::class, 'update'])->name('admin.profile.update');
            //TODO: Route for loading change-password view
            Route::get('change-password' ,[AdminProfileController::class, 'change_password'])->name('admin.profile.change-password');
            Route::post('update-password' ,[AdminProfileController::class, 'update_password'])->name('admin.profile.update-password');

            //TODO:: Admin Banks Group Routes
            Route::group(['prefix' => 'bank-details'], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/' ,[AdminBanksController::class, 'index'])->name('admin.bank-details.index');
                Route::post('create' ,[AdminBanksController::class, 'create'])->name('admin.bank-details.create');
                Route::post('update' ,[AdminBanksController::class, 'update'])->name('admin.bank-details.update');
                Route::post('status' ,[AdminBanksController::class, 'status'])->name('admin.bank-details.status');
                Route::post('delete' ,[AdminBanksController::class, 'delete'])->name('admin.bank-details.delete');
            });

            //TODO:: Admin Banks Group Routes
            Route::group(['prefix' => 'sms-api'], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/' ,[AdminSMSPackageController::class, 'index'])->name('admin.sms-api.index');
                Route::post('update' ,[AdminSMSPackageController::class, 'update'])->name('admin.sms-api.update');
            });
        });
        //TODO:: Companies's Group Routes
        Route::group(['prefix' => 'companies'], function () {
            //For Companies Customers
                Route::get('companies-customers', [CompanyCustomersController::class, 'index'])->name('admin.companies-customers.index')->middleware(['middleware' => 'permission:'.config('const.COMPANYCUSTOMER')  . ','. config('const.VIEW')]);

            //For Comapnies Transationcs
                Route::get('/companies-transactions', [AdminCompanyTransactionController::class, 'index'])->name('admin.companies.companies-transactions.index')->middleware(['middleware' => 'permission:'.config('const.COMPANYTRANSACTION')  . ','. config('const.VIEW')]);

            // //TODO:: Withdrawal Requests Routes
            Route::group(['prefix' => 'withdrawal-requests'], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/{row_id?}/{noti_id?}' ,[WithdrawalRequestController::class, 'index'])->name('admin.companies.withdrawal-requests.index')->middleware(['middleware' => 'permission:'.config('const.WITHDRAWALREQUEST')  . ','. config('const.VIEW')]);
                Route::post('/update-status' ,[WithdrawalRequestController::class, 'update_status'])->name('admin.companies.withdrawal-requests.update-status');
            });
            //TODO:: Generate Pay Link Routes
            Route::group(['prefix' => 'manage-companies', 'middleware' => 'permission:'.config('const.MANAGECOMPANY')  . ','. config('const.VIEW')], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/' ,[AdminCompanyController::class, 'index'])->name('admin.companies.manage-companies.index');
                Route::get('create' ,[AdminCompanyController::class, 'create'])->name('admin.companies.manage-companies.create')->middleware(['middleware' => 'permission:'.config('const.MANAGECOMPANY')  . ','. config('const.ADD')]);
                Route::post('check-unique-bank-numbers' ,[AdminCompanyController::class, 'check_unique_bank_numbers'])->name('admin.companies.manage-companies.check-unique-bank-numbers');
                Route::post('create' ,[AdminCompanyController::class, 'create_process'])->name('admin.companies.manage-companies.create-process');
                Route::post('create-bank' ,[AdminCompanyController::class, 'create_bank'])->name('admin.companies.manage-companies.create-bank');
                Route::get('edit/{id}/{row_id?}/{noti_id?}' ,[AdminCompanyController::class, 'edit'])->name('admin.companies.manage-companies.edit')->middleware(['middleware' => 'permission:'.config('const.MANAGECOMPANY')  . ','. config('const.EDIT')]);
                Route::post('update' ,[AdminCompanyController::class, 'update'])->name('admin.companies.manage-companies.update-process');
                Route::post('is_active' ,[AdminCompanyController::class, 'is_active'])->name('admin.companies.manage-companies.is_active');
                Route::post('delete' ,[AdminCompanyController::class, 'delete'])->name('admin.companies.manage-companies.delete');
                Route::post('delete-bank' ,[AdminCompanyController::class, 'delete_bank'])->name('admin.companies.manage-companies.delete-bank');
                Route::post('update-bank' ,[AdminCompanyController::class, 'update_bank'])->name('admin.companies.manage-companies.update-bank');
                Route::get('get-package' ,[AdminCompanyController::class, 'get_package'])->name('admin.companies.manage-companies.get-package');
                Route::post('send-email' ,[AdminCompanyController::class, 'send_email'])->name('admin.companies.manage-companies.send-email');
                Route::post('/get-states', [AdminCompanyController::class, 'get_states'])->name('get.states');
            });
            //TODO:: Property Manager Routes
            Route::group(['prefix' => 'property-managers', 'middleware' => 'permission:'.config('const.MANAGECOMPANY')  . ','. config('const.VIEW')], function () {
                Route::get('/' ,[PropertyManagerController::class, 'index'])->name('property-manager.index');
                Route::get('create' ,[PropertyManagerController::class, 'create'])->name('property-manager.create')->middleware(['middleware' => 'permission:'.config('const.MANAGECOMPANY')  . ','. config('const.ADD')]);
                Route::post('check-unique-bank-numbers' ,[PropertyManagerController::class, 'check_unique_bank_numbers'])->name('property-manager.check-unique-bank-numbers');
                Route::post('create' ,[PropertyManagerController::class, 'create_process'])->name('property-manager.create-process');
                Route::post('create-bank' ,[PropertyManagerController::class, 'create_bank'])->name('property-manager.create-bank');
                Route::get('edit/{id}/{row_id?}/{noti_id?}' ,[PropertyManagerController::class, 'edit'])->name('property-manager.edit');
                Route::post('update' ,[PropertyManagerController::class, 'update'])->name('property-manager.update-process');
                Route::post('is_active' ,[PropertyManagerController::class, 'is_active'])->name('property-manager.is_active');
                Route::post('delete' ,[PropertyManagerController::class, 'delete'])->name('property-manager.delete');
                Route::post('delete-bank' ,[PropertyManagerController::class, 'delete_bank'])->name('property-manager.delete-bank');
                Route::post('update-bank' ,[PropertyManagerController::class, 'update_bank'])->name('property-manager.update-bank');
                Route::get('get-package' ,[PropertyManagerController::class, 'get_package'])->name('property-manager.get-package');
                Route::post('send-email' ,[PropertyManagerController::class, 'send_email'])->name('property-manager.send-email');
            });
            // //TODO:: Company Banks Group Routes
            Route::group(['prefix' => 'packages', 'middleware' => 'permission:'.config('const.PACKAGES')  . ','. config('const.VIEW')], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/' ,[PackageController::class, 'index'])->name('admin.companies.packages.index');
                Route::post('create' ,[PackageController::class, 'create'])->name('admin.companies.packages.create');
                Route::post('update' ,[PackageController::class, 'update'])->name('admin.companies.packages.update');
                Route::post('status' ,[PackageController::class, 'status'])->name('admin.companies.packages.status');
            });
        });

        //TODO: Routes for Accounts
        Route::group(['prefix' => 'invoices'], function(){
            //TODO: Routes for invoices
            Route::group(['prefix' => 'invoice', 'middleware' => 'permission:'.config('const.INVOICES')  . ','. config('const.VIEW')], function(){
                Route::get('/', [AdminInvoiceController::class, 'index'])->name('admin.invoices.invoice.index');
                Route::get('create', [AdminInvoiceController::class, 'create'])->name('admin.invoices.invoice.create')->middleware(['middleware' => 'permission:'.config('const.INVOICES')  . ','. config('const.ADD')]);
                Route::post('create', [AdminInvoiceController::class, 'create_invoice'])->name('admin.invoices.invoice.create-invoice');
                Route::post('charge-payment' ,[AdminInvoiceController::class, 'charge_payment'])->name('admin.invoices.invoice.charge-payment');
                Route::post('voided-payment' ,[AdminInvoiceController::class, 'voided_payment'])->name('admin.invoices.invoice.voided-payment');
                Route::post('refund-payment' ,[AdminInvoiceController::class, 'refund_payment'])->name('admin.invoices.invoice.refund-payment');
                Route::post('capture-payment' ,[AdminInvoiceController::class, 'capture_payment'])->name('admin.invoices.invoice.capture-payment');
                Route::post('send-email' ,[AdminInvoiceController::class, 'send_email'])->name('admin.invoices.invoice.send-email');
                Route::post('send-message' ,[AdminInvoiceController::class, 'send_message'])->name('admin.invoices.invoice.send-message');
                Route::post('delete' ,[AdminInvoiceController::class, 'delete'])->name('admin.invoices.invoice.delete');
                Route::get('inoivce-details' ,[AdminInvoiceController::class, 'inoivce_details'])->name('admin.invoices.invoice.inoivce-details');
            });
        });

        Route::group(['prefix' => 'sales'], function(){
            Route::get('/sales-staff', [AdminSaleController::class, 'index'])->name('admin.sales.sales-staff.index')->middleware(['middleware' => 'permission:'.config('const.SALESTAFF')  . ','. config('const.VIEW')]);
        });

        //TODO:: Genrate Paylinks Link + Customer Section's Group Routes
        Route::group(['prefix' => 'pay-links'], function () {
            //TODO:: Generate Pay Link Routes
            Route::group(['prefix' => 'generate-payment-link'], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/' ,[GeneratePayamentLinkController::class, 'index'])->name('admin.paylinks.generate-payment-link.index');
                Route::get('create' ,[GeneratePayamentLinkController::class, 'create'])->name('admin.paylinks.generate-payment-link.create');
                Route::post('create' ,[GeneratePayamentLinkController::class, 'create_payment_link'])->name('admin.paylinks.generate-payment-link.create-payment-link');
                Route::post('charge-payment' ,[GeneratePayamentLinkController::class, 'charge_payment'])->name('admin.paylinks.generate-payment-link.charge-payment');
                Route::post('send-email' ,[GeneratePayamentLinkController::class, 'send_email'])->name('admin.paylinks.generate-payment-link.send-email');
                Route::post('send-message' ,[GeneratePayamentLinkController::class, 'send_message'])->name('admin.paylinks.generate-payment-link.send-message');
                Route::post('update' ,[GeneratePayamentLinkController::class, 'update'])->name('admin.paylinks.generate-payment-link.update');
                Route::post('delete' ,[GeneratePayamentLinkController::class, 'delete'])->name('admin.paylinks.generate-payment-link.delete');
                Route::post('sort' ,[GeneratePayamentLinkController::class, 'sort'])->name('admin.paylinks.generate-payment-link.sort');
            });
            //TODO:: Transaction Routes
            Route::group(['prefix' => 'transactions', 'middleware' => 'permission:'.config('const.TRANSACTIONS')  . ','. config('const.VIEW')], function () {
                //TODO: Route For Transtoins index view
                Route::get('/' ,[TransactionController::class, 'index'])->name('admin.paylinks.transactions.index');
            });
        });
        //TODO:: Customer's Group Routes
        Route::group(['prefix' => 'customers'], function () {
            //TODO:: Manage Customer Routes
            Route::group(['prefix' => 'manage-customer'], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/' ,[CustomerController::class, 'index'])->name('admin.customers.manage-customer.index');
                Route::get('/create' ,[CustomerController::class, 'create'])->name('admin.customers.manage-customer.create');
                Route::post('/create' ,[CustomerController::class, 'create_process'])->name('admin.customers.manage-customer.create-process');
                Route::get('edit/{id}' ,[CustomerController::class, 'edit'])->name('admin.customers.manage-customer.edit');
                Route::post('update' ,[CustomerController::class, 'update'])->name('admin.customers.manage-customer.update');
            });
        });
        //TODO:: Configuration Section Group Routes
        Route::group(['prefix' => 'settings'], function () {
            //TODO:: Navbar Menu's Group Routes
            Route::group(['prefix' => 'paytabs-config', 'middleware' => 'permission:'.config('const.MYRIDEPAYACCOUNT')  . ','. config('const.VIEW')], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/' ,[AdminPaytabConfigController::class, 'index'])->name('admin.configurations.paytabs-config.index');
                Route::post('create' ,[AdminPaytabConfigController::class, 'create'])->name('admin.configurations.paytabs-config.create');
                Route::post('update' ,[AdminPaytabConfigController::class, 'update'])->name('admin.configurations.paytabs-config.update');
                Route::post('status' ,[AdminPaytabConfigController::class, 'status'])->name('admin.configurations.paytabs-config.status');
            });

            //TODO:: Navbar Menu's Group Routes
            // Route::group(['prefix' => 'currency', 'middleware' => 'permission:'.config('const.CURRENCY')  . ','. config('const.VIEW')], function () {
                Route::group(['prefix' => 'currency'], function () {
                //TODO: Route for loading Manage Navbar index view
                Route::get('/' ,[AdminCurrencyController::class, 'index'])->name('admin.settings.currency.index');
                Route::post('create' ,[AdminCurrencyController::class, 'create'])->name('admin.settings.currency.create');
                Route::post('update' ,[AdminCurrencyController::class, 'update'])->name('admin.settings.currency.update');
                Route::post('status' ,[AdminCurrencyController::class, 'status'])->name('admin.settings.currency.status');
            });
            //================watermark settings Route============================
            Route::group(['prefix' => 'watermark'], function () {
            Route::get('/', [WaterMarkSettingsController::class, 'index'])->name('admin.settings.watermark.index');
            Route::post('/imageFileUpload', [WaterMarkSettingsController::class, 'imageFileUpload'])->name('admin.settings.watermark.imageFileUpload');
            Route::post('/position', [WaterMarkSettingsController::class, 'position'])->name('admin.settings.watermark.position');
            Route::post('/opacity', [WaterMarkSettingsController::class, 'opacity'])->name('admin.settings.watermark.opacity');
            Route::post('/logo-width', [WaterMarkSettingsController::class, 'logo_width'])->name('admin.settings.watermark.logo-width');
        });
        //==================================================================
            //TODO: Unit Module Routes
            Route::group(['prefix' => 'document-types'], function () {
                Route::get('/', [DocumentTypeController::class,'index'])->name('admin.settings.document-types.index');
                Route::get('/create', [DocumentTypeController::class,'create'])->name('admin.settings.document-types.create');
                Route::post('/create-language', [DocumentTypeController::class,'create_process'])->name('admin.settings.document-types.create-process');
                Route::get('/edit/{id}', [DocumentTypeController::class,'edit'])->name('admin.settings.document-types.edit');
                Route::post('/edit', [DocumentTypeController::class,'edit_process'])->name('admin.settings.document-types.edit-process');
                Route::post('/make-default', [DocumentTypeController::class,'make_default'])->name('admin.settings.document-types.make-default');
                Route::post('/delete', [DocumentTypeController::class,'delete'])->name('admin.settings.document-types.delete');
                Route::post('/change-status', [DocumentTypeController::class,'change_status'])->name('admin.settings.document-types.status');
            });
            //TODO: Language Module Routes
            Route::group(['prefix' => 'languages'], function () {
                Route::get('/', [LanguageController::class,'index'])->name('admin.settings.languages.index');
                Route::get('/create', [LanguageController::class,'create'])->name('admin.settings.languages.create');
                Route::post('/create-language', [LanguageController::class,'create_process'])->name('admin.settings.languages.create-process');
                Route::get('/edit/{id}', [LanguageController::class,'edit'])->name('admin.settings.languages.edit');
                Route::post('/edit', [LanguageController::class,'edit_process'])->name('admin.settings.languages.edit-process');
                Route::post('/delete', [LanguageController::class,'delete'])->name('admin.settings.languages.delete');
                Route::post('/change-status', [LanguageController::class,'change_status'])->name('admin.settings.languages.status');
            });
            //TODO: Unit Module Routes
            Route::group(['prefix' => 'units'], function () {
                Route::get('/', [UnitController::class,'index'])->name('admin.settings.units.index');
                Route::get('/create', [UnitController::class,'create'])->name('admin.settings.units.create');
                Route::post('/create-language', [UnitController::class,'create_process'])->name('admin.settings.units.create-process');
                Route::get('/edit/{id}', [UnitController::class,'edit'])->name('admin.settings.units.edit');
                Route::post('/edit', [UnitController::class,'edit_process'])->name('admin.settings.units.edit-process');
                Route::post('/make-default', [UnitController::class,'make_default'])->name('admin.settings.units.make-default');
                Route::post('/delete', [UnitController::class,'delete'])->name('admin.settings.units.delete');
                Route::post('/change-status', [UnitController::class,'change_status'])->name('admin.settings.units.status');
            });
            //TODO: Price Module Routes
            Route::group(['prefix' => 'prices'], function () {
                Route::get('/', [PriceController::class,'index'])->name('admin.settings.prices.index');
                Route::get('/create', [PriceController::class,'create'])->name('admin.settings.prices.create');
                Route::post('/create-language', [PriceController::class,'create_process'])->name('admin.settings.prices.create-process');
                Route::get('/edit/{id}', [PriceController::class,'edit'])->name('admin.settings.prices.edit');
                Route::post('/edit', [PriceController::class,'edit_process'])->name('admin.settings.prices.edit-process');
                Route::post('/make-default', [PriceController::class,'make_default'])->name('admin.settings.prices.make-default');
                Route::post('/delete', [PriceController::class,'delete'])->name('admin.settings.prices.delete');
                Route::post('/change-status', [PriceController::class,'change_status'])->name('admin.settings.prices.status');
            });
            //TODO: Size Module Routes
            Route::group(['prefix' => 'sizes'], function () {
                Route::get('/', [SizeController::class,'index'])->name('admin.settings.sizes.index');
                Route::get('/create', [SizeController::class,'create'])->name('admin.settings.sizes.create');
                Route::post('/create-language', [SizeController::class,'create_process'])->name('admin.settings.sizes.create-process');
                Route::get('/edit/{id}', [SizeController::class,'edit'])->name('admin.settings.sizes.edit');
                Route::post('/edit', [SizeController::class,'edit_process'])->name('admin.settings.sizes.edit-process');
                Route::post('/make-default', [SizeController::class,'make_default'])->name('admin.settings.sizes.make-default');
                Route::post('/delete', [SizeController::class,'delete'])->name('admin.settings.sizes.delete');
                Route::post('/change-status', [SizeController::class,'change_status'])->name('admin.settings.sizes.status');
            });
        });
        //TODO: Routes for email
        Route::group(['prefix' => 'email'], function(){
        //TODO:: Email Catgory Routes
        Route::group(['prefix' => 'branded-email', 'middleware' => 'permission:'.config('const.BRANDEDEMAIL')  . ','. config('const.VIEW')], function () {
            Route::get('/' ,[AdminBrandedEmailController::class, 'index'])->name('admin.email.branded-email.index');
            Route::post('create' ,[AdminBrandedEmailController::class, 'create'])->name('admin.email.branded-email.create');
            Route::post('update' ,[AdminBrandedEmailController::class, 'update'])->name('admin.email.branded-email.update');
        });

        //TODO:: Email Catgory Routes
        Route::group(['prefix' => 'email-category', 'middleware' => 'permission:'.config('const.EMAILCATEGORY')  . ','. config('const.VIEW')], function () {
            Route::get('/' ,[EmailCategoryController::class, 'index'])->name('admin.email.email-category.index');
            Route::post('create' ,[EmailCategoryController::class, 'create'])->name('admin.email.email-category.create');
            Route::post('update' ,[EmailCategoryController::class, 'update'])->name('admin.email.email-category.update');
            Route::post('is_active' ,[EmailCategoryController::class, 'is_active'])->name('admin.email.email-category.is_active');
            Route::post('delete' ,[EmailCategoryController::class, 'delete'])->name('admin.email.email-category.delete');
        });

        //TODO:: Email Settings Routes
        Route::group(['prefix' => 'email-settings', 'middleware' => 'permission:'.config('const.EMAILSETTINGS')  . ','. config('const.VIEW')], function () {
            Route::get('/' ,[AdminEmailSettingController::class, 'index'])->name('admin.email.email-setting.index');
            Route::post('update' ,[AdminEmailSettingController::class, 'update'])->name('admin.email.email-setting.update');
        });
        //TODO:: Email Template Content Routes
        Route::group(['prefix' => 'email-template', 'middleware' => 'permission:'.config('const.EMAILTEMPLATE')  . ','. config('const.VIEW')], function () {
            Route::get('/' ,[AdminEmailTemplateController::class, 'index'])->name('admin.email.email-template.index');
            Route::post('/get-template' ,[AdminEmailTemplateController::class, 'get_template'])->name('admin.email.email-template.get-template');
            Route::post('update' ,[AdminEmailTemplateController::class, 'update'])->name('admin.email.email-template.update');
        });
        });
        //TODO: Notification Moduel Routes
        Route::group(['prefix' => 'notifications'], function(){
            Route::get('get-notifications', [AdminNotificationController::class, 'get_notifications'])->name('admin.notifications.get-notifications');
        });
        //TODO: Routes for Accounts
        Route::group(['prefix' => 'accounts'], function(){
            //TODO: Routes for profit Account
            Route::group(['prefix' => 'profit-account' , 'middleware' => 'permission:'.config('const.PROFITACCOUNT')  . ','. config('const.VIEW')], function(){
                Route::get('/', [ProfitController::class, 'index'])->name('admin.accounts.profit-account.index');
            });
            //TODO: Routes for profit Account
            Route::group(['prefix' => 'liabilites', 'middleware' => 'permission:'.config('const.LIABILITIES')  . ','. config('const.VIEW')], function(){
                Route::get('/', [LiabilityControllController::class, 'index'])->name('admin.accounts.liabilites.index');
            });
            //TODO: Routes for journal
            Route::group(['prefix' => 'journal-entries', 'middleware' => 'permission:'.config('const.JOURNALENTRIES')  . ','. config('const.VIEW')], function(){
                Route::get('/{row_id?}/{noti_id?}', [AdminJournalController::class, 'index'])->name('admin.accounts.journal-entries.index');
                Route::get('/super-journal', [AdminJournalController::class, 'super_journal'])->name('admin.accounts.journal-entries.super-journal');
            });

            Route::group(['prefix' => 'super-journal', 'middleware' => 'permission:'.config('const.SUPERJOURNAL')  . ','. config('const.VIEW')], function(){
                Route::get('/', [SuperJournalController::class, 'index'])->name('admin.accounts.super-journal-entries.index');
            });


        });
        //TODO: Routes For Developer Section
        Route::group(['prefix' => 'developer-section'], function(){
            //Routes for paytab json
                Route::get('/', [AdminPaytabJsonController::class, 'index', 'middleware' => 'permission:'.config('const.PAYTABSJSON')  . ','. config('const.VIEW')])->name('admin.developer-section.index');
                Route::post('/send-email', [AdminPaytabJsonController::class, 'send_email'])->name('admin.developer-section.send-email');
            //Routes for paytab json
            Route::group(['prefix' => 'errors'], function(){
                Route::get('/', [ErrorsController::class, 'index', 'middleware' => 'permission:'.config('const.ERROR')  . ','. config('const.VIEW')])->name('admin.developer-section.errors.index');
                Route::post('/send-email', [ErrorsController::class, 'send_email'])->name('admin.developer-section.erros.send-email');
            });
        });
    });
});
// Admin side routing Ends from here

