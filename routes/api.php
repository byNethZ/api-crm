<?php

use App\Http\Controllers\AprobedEmailController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FoodbankController;
use App\Http\Controllers\FotographyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromosController;
use App\Http\Controllers\StatesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
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
    //get
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/info', [UserController::class, 'info']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    //Post
    Route::post('/validateToken', [UserController::class, 'validateToken']);
    Route::post('/logout', [UserController::class, 'logout']);
    Route::post('/user', [UserController::class, 'store']);
    //Delete
    Route::delete('/delete-user/{id}', [UserController::class, 'delete']);
    //Put
    Route::put('/users/{id}', [UserController::class, 'update']);
    Route::put('/edit-user/{id}', [UserController::class, 'update']);
    Route::put('/password/{id}', [UserController::class, 'resetPass']);

    //CATALOGUES Routes
    //Get
    Route::get('/catalogos', [CatalogueController::class, 'show']);

    //CUSTOMER Routes
    //Get
    Route::get('/customersByVendor', [CustomerController::class, 'show']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customer/{id}', [CustomerController::class, 'showCustomer']);
    Route::get('/customersByStatus/{status}', [CustomerController::class, 'getCustomerByStatus']);
    Route::get('/customers/industry/{industry}', [CustomerController::class, 'getCustomersByIndustry']);
    //Post
    Route::post('/customer', [CustomerController::class, 'store']);
    //Delete
    Route::delete('/delete-customer/{id}', [CustomerController::class, 'destroy']);
    //Put
    Route::put('/customer/{id}', [CustomerController::class, 'update']);
    Route::put('/customerStatus/{id}/{status}', [CustomerController::class, 'updateStatus']);
    Route::put('/interests/{id}', [CustomerController::class, 'updateInterests']);

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
    Route::get('/vendor/{id}', [VendorController::class, 'show']);

    //PROMOS Routes
    //Get
    Route::get('/promos', [PromosController::class, 'index']);
    Route::get('/ruleta', [PromosController::class, 'indexRuleta']);

    //LINK Routes
    //Post
    Route::post('/create-checklist', [AprobedEmailController::class, 'create']);
    //Delete
    Route::delete('/delete-link/{id}', [AprobedEmailController::class, 'delete']);
    //Edit (Put/Patch)
    Route::post('/change-link/{id}', [AprobedEmailController::class, 'changeStatus']);

    //PHOTOGRAPHY Routes
    //Delete
    Route::delete('/contract-fotography/{id}', [FotographyController::class, 'destroy']);

    //DASHBOARD Routes
    //Get
    Route::get('/dashboard/sales', [DashboardController::class, 'salesDashboard']);
    Route::get('/dashboard/sales/{id}', [DashboardController::class, 'salesDashboardByVendor']);
    Route::get('/dashboard/customers/vendors', [DashboardController::class, 'customersByVendor']);

});

//Public routes
//checklist routes
Route::post('/generate-checklist', [AprobedEmailController::class, 'generate']);
Route::post('/create-checklist', [AprobedEmailController::class, 'create']);
Route::get('/checklist/{id}', [AprobedEmailController::class, 'store']);
Route::post('/checklist/{id}', [AprobedEmailController::class, 'update']);
Route::get('/all-checklist/{id}', [AprobedEmailController::class, 'show']);

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
