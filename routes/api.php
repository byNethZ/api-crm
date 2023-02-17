<?php

use App\Http\Controllers\AprobedEmailController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodbankController;
use App\Http\Controllers\FotographyController;
use App\Http\Controllers\GoalsController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromosController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

/* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); */

Route::post('/login', [UserController::class, 'login']);


//Rutas de sistema
Route::group(['middleware' => ["auth:sanctum"]], function(){

    //USER Routes
    //CRUD
    Route::post('/users', [UserController::class, 'store']);
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/users/{id}', [UserController::class, 'show']);
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::delete('/users/{id}', [UserController::class, 'delete']);
    //get
    Route::get('/info', [UserController::class, 'info']);
    //Post
    Route::post('/validateToken', [UserController::class, 'validateToken']);
    Route::post('/logout', [UserController::class, 'logout']);
    //Put
    Route::put('/password/{id}', [UserController::class, 'resetPass']);
    //Delete

    //CATALOGUES Routes
    //Get
    Route::get('/catalogos', [CatalogueController::class, 'show']);

    //CUSTOMER Routes
    //CRUD
    Route::post('/customers', [CustomerController::class, 'store']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    Route::put('/customers/{id}', [CustomerController::class, 'update']);
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);
    //Get
    Route::get('/customersByVendor/{customerID}', [CustomerController::class, 'indexByVendor']);
    // Route::get('/customers/status/{status}', [CustomerController::class, 'getCustomerByStatus']);
    // Route::get('/customers/industry/{industry}', [CustomerController::class, 'getCustomersByIndustry']);
    //future link replaces status and industry routes
    Route::get('/customers/{property}/{idProperty}/{vendorID}', [CustomerController::class, 'getCustomersByProperty']);
    Route::get('/prospects', [CustomerController::class, 'getAllProspects']);
    //Post
    //Delete
    //Put
    Route::put('/customerStatus/{id}/{status}', [CustomerController::class, 'updateStatus']);
    Route::put('/change-vendor/{id}/{status}', [CustomerController::class, 'changeVendor']);
    Route::put('/interests/{id}', [CustomerController::class, 'updateInterests']);
    Route::put('/customers/rejected/{id}', [CustomerController::class, 'prospectRejected']);
    //files
    Route::post('/customerImage/{id}', [CustomerController::class, 'uploadImage']);



    //CUSTOMER_TYPES Routes
    //Get
    Route::get('/types', [CustomerTypeController::class, 'index']);
    Route::get('/types/{id}', [CustomerTypeController::class, 'show']);

    //DEPARTAMENTS Routes
    //Get
    Route::get('/departaments', [UserController::class, 'indexDepartament']);
    Route::get('/publicDepartaments', [UserController::class, 'publicDepartament']);

    //PRODUCTS Routes
    //Get
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/categories', [ProductController::class, 'indexCategories']);
    Route::get('/product/{id}', [ProductController::class, 'show']);

    //VENDORS Routes
    //Get
    Route::get('/vendors', [VendorController::class, 'index']);
    Route::get('/marketingvendors', [VendorController::class, 'vendorsAndMarketing']);
    Route::get('/vendor/{id}', [VendorController::class, 'show']);

    //PROMOS Routes
    //Get
    Route::get('/promos', [PromosController::class, 'index']);
    Route::get('/ruleta', [PromosController::class, 'indexRuleta']);
    Route::put('/ruleta/{id}', [PromosController::class, 'setDelivered']);

    //LINK / Checklists Routes
    //GET
    Route::get('/checklists/{status}', [AprobedEmailController::class, 'index']);
    //Post
    Route::post('/checklists', [AprobedEmailController::class, 'create']);
    //Delete
    Route::delete('/checklists/{id}', [AprobedEmailController::class, 'delete']);
    //Edit (Put/Patch)
    Route::put('/checklists/status/{id}', [AprobedEmailController::class, 'changeStatus']);
    Route::put('/checklists/{id}', [AprobedEmailController::class, 'update']);

    //PHOTOGRAPHY Routes
    //Delete
    //Route::delete('/contract-fotography/{id}', [FotographyController::class, 'destroy']);
    Route::delete('/photography/{id}', [FotographyController::class, 'destroy']);

    //WEBSITES
    //CRUD
    Route::post('/websites', [WebsiteController::class, 'store']);
    Route::get('/websites', [WebsiteController::class, 'index']);
    Route::put('/websites/{id}', [WebsiteController::class, 'update']);
    Route::delete('/websites/{id}', [WebsiteController::class, 'destroy']);
    //Get
    //Post
    //Delete
    //Update

    //DASHBOARD Routes
    //Get
    Route::get('/dashboard/sales', [DashboardController::class, 'salesDashboard']);
    Route::get('/dashboard/sales/{id}', [DashboardController::class, 'salesDashboardByVendor']);
    Route::get('/dashboard/customers/vendors', [DashboardController::class, 'customersByVendor']);
    Route::get('/dashboard/customers/current', [DashboardController::class, 'customersCurrentDay']);

    //Comments
    //post
    Route::get('/comments/{id}', [CommentsController::class, 'index']);
    Route::post('/comments', [CommentsController::class, 'store']);

    //Goals
    //CRUD
    Route::post('/goals', [GoalsController::class, 'store']);
    //Route::get('/goals', [GoalsController::class, 'index']);
    Route::get('/goals/{id}', [GoalsController::class, 'index']);
    Route::put('/goals/{id}', [GoalsController::class, 'update']);

    //Notificationes
    //Activate Notifications by WhatsAppChannel
    Route::post('/notifications/{id}', [UserController::class, 'sendActivateSystem']);

    //Panel
    //Send reports
    Route::get('/reports/{id}/{mode}', [PanelController::class, 'sendReports']);

    //Pruebas
    //terminal
    Route::get('/terminal', [PanelController::class, 'terminal']);
    Route::get('/checkemail/{id}', [PanelController::class, 'checkemail']);
    Route::get('/checkmessage/{id}', [PanelController::class, 'checkMessage']);

});

//Public routes
//checklist routes
//CRUD
//Route::get('/checklists/all/{id}', [AprobedEmailController::class, 'index']);
Route::get('/checklist/{id}', [AprobedEmailController::class, 'show']);
Route::post('/checklist/{id}', [AprobedEmailController::class, 'approve']);
//get
//Route::get('/checklistStatus/{id}/{aprobed}', [AprobedEmailController::class, 'showByStatus']);
//post
Route::post('/generate-checklist', [AprobedEmailController::class, 'generate']);

//promos for customer ruleta
Route::post('/promo-gift', [PromosController::class, 'save']);
Route::post('/ruleta', [PromosController::class, 'saveRuleta']);

//states
Route::get('/states/{country}', [StatesController::class, 'statesByCountry']);
Route::get('/states', [StatesController::class, 'index']);

//customer
Route::get('/customerToken/{token}', [CustomerController::class, 'getDataByToken']);
Route::post('/customerToken/{token}', [CustomerController::class, 'savePreferences']);

//fotography
Route::post('/contract-fotography', [FotographyController::class, 'store']);
Route::get('/contract-fotography', [FotographyController::class, 'index']);

//foodbank
Route::post('/foodbank', [FoodbankController::class, 'sendEmail']);
