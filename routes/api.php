<?php

use App\Http\Controllers\AprobedEmailController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerTypeController;
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

    //GET ROUTES
    //user
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/info', [UserController::class, 'info']);
    Route::get('/user/{id}', [UserController::class, 'show']);
    //catalogues
    Route::get('/catalogos', [CatalogueController::class, 'show']);
    //customers
    Route::get('/customersByVendor', [CustomerController::class, 'show']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customer/{id}', [CustomerController::class, 'showCustomer']);
    //customer_types
    Route::get('/types', [CustomerTypeController::class, 'index']);
    //departament
    Route::get('/departaments', [UserController::class, 'indexDepartament']);

    //products
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/product/{id}', [ProductController::class, 'show']);
    //vendors
    Route::get('/vendors', [VendorController::class, 'index']);
    Route::get('/vendor/{id}', [VendorController::class, 'show']);
    //promos
    Route::get('/promos', [PromosController::class, 'index']);


    //CREATE ROUTES
    //users
    Route::post('/validateToken', [UserController::class, 'validateToken']);
    Route::post('/logout', [UserController::class, 'logout']);
    //customer
    Route::post('/customer', [CustomerController::class, 'store']);


    //DELETE ROUTES
    //links
    Route::delete('/delete-link/{id}', [AprobedEmailController::class, 'delete']);
    //customes
    Route::delete('/delete-customer/{id}', [CustomerController::class, 'destroy']);
    //User
    Route::delete('/delete-user/{id}', [UserController::class, 'delete']);


    //EDIT ROUTES
    //links
    Route::post('/change-link/{id}', [AprobedEmailController::class, 'changeStatus']);
    //user
    Route::put('/users/{id}', [UserController::class, 'update']);
    //customer
    Route::put('/customer/{id}', [CustomerController::class, 'update']);
});


//checklist routes
Route::post('/generate-checklist', [AprobedEmailController::class, 'generate']);
Route::post('/create-checklist', [AprobedEmailController::class, 'create']);
Route::get('/checklist/{id}', [AprobedEmailController::class, 'store']);
Route::post('/checklist/{id}', [AprobedEmailController::class, 'update']);
Route::get('/all-checklist/{id}', [AprobedEmailController::class, 'show']);

//promos for customer ruleta
Route::post('/promo-gift', [PromosController::class, 'save']);

//states
Route::get('/states/{country}', [StatesController::class, 'statesByCountry']);
Route::get('/states', [StatesController::class, 'index']);
