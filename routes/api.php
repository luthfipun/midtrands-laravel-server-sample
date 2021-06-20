<?php

use App\Http\Controllers\back\WebHookController;
use App\Http\Controllers\mobile\AppController;
use App\Http\Controllers\TestController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('test', [TestController::class, 'test']);

//webhook midtrands
Route::post('webhook/transaction', [WebHookController::class, 'index']);

//mobile API
Route::get('products', [AppController::class, 'products']);
Route::get('transaction', [AppController::class, 'transaction']);
Route::get('transaction/{id}', [AppController::class, 'transaction_detail']);
Route::post('order', [AppController::class, 'orders']);
