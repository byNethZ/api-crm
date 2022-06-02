<?php

use App\Http\Controllers\AprobedEmailController;
use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PromosController;
use App\Http\Controllers\UserController;
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
Route::post('/users/update/{id}', [UserController::class, 'update']);

Route::group(['middleware' => ["auth:sanctum"]], function(){

    //getting routes
    Route::get('/users', [UserController::class, 'index']);
    Route::get('/info', [UserController::class, 'info']);
    Route::get('/catalogos', [CatalogueController::class, 'show']);
    Route::get('/customersByVendor', [CustomerController::class, 'show']);
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customer/{id}', [CustomerController::class, 'showCustomer']);
    Route::get('/products', [ProductController::class, 'index']);

    //create routes
    Route::post('/validateToken', [UserController::class, 'validateToken']);
    Route::post('/logout', [UserController::class, 'logout']);

    //delete routes
    Route::delete('/delete-link/{id}', [AprobedEmailController::class, 'delete']);
    Route::delete('/delete-customer/{id}', [CustomerController::class, 'destroy']);

    //edit routes
    Route::post('/change-link/{id}', [AprobedEmailController::class, 'changeStatus']);
});



Route::post('/generate-checklist', [AprobedEmailController::class, 'generate']);
Route::post('/create-checklist', [AprobedEmailController::class, 'create']);
Route::get('/checklist/{id}', [AprobedEmailController::class, 'store']);
Route::post('/checklist/{id}', [AprobedEmailController::class, 'update']);
Route::get('/all-checklist/{id}', [AprobedEmailController::class, 'show']);

Route::post('/promo-gift', [PromosController::class, 'save']);
