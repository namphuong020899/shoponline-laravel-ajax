<?php

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



// Route::prefix('Version_1')->group(function(){
// 	Route::apiResource('login', 'Api\Version_1\LoginController');
// 	Route::apiResource('logout', 'Api\Version_1\LogoutController');

// 	Route::apiResource('dashboard', 'Api\Version_1\HomeController');
// 	Route::apiResource('account', 'Api\Version_1\AccountController');

// });
