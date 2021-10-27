<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['namespace'=>'BackEnd'],function(){

	Route::resource('login', 'LoginController',['only' => ['index', 'store','show']])->middleware('CheckUser');

	Route::get('google', 'LoginController@redirectToProvider');
	Route::get('google/callback', 'LoginController@handleProviderCallback');
	Route::get('facebook', 'LoginController@redirectToProvider_facebook');
	Route::get('facebook/callback', 'LoginController@handleProviderCallback_facebook');
	Route::get('github', 'LoginController@redirectToProvider_github');
	Route::get('github/callback', 'LoginController@handleProviderCallback_github');

	Route::resource('logout', 'LogoutController',['only' => ['index']]);
	Route::middleware('CheckLogin')->group(function(){
		Route::resource('dashboard', 'HomeController');
		Route::group(['prefix'=>'dashboard'],function(){
			Route::post('table', 'HomeController@store_table')->name('store.table');
			Route::post('total', 'HomeController@store_total')->name('store.total');
		});
		Route::resource('account', 'AccountController');
		Route::resource('remove', 'RemoveAllController');

		Route::resource('product', 'ProductController');
		Route::resource('product-gallery','GalleryController');
		Route::resource('slider','SliderController');
		Route::resource('brand','BrandController');
		Route::resource('category','CategoryController');
		Route::resource('coupon','CouponController');
		Route::resource('delivery','DeliveryController');
		Route::resource('order','OrderController');
		Route::resource('youtube','YoutubeController')->only('index');
		Route::resource('contacts','ContactController');

		Route::resource('sorting', 'SortingController')->only('store');

		// Status All
		Route::resource('status','StatusController')->only('store');
	});

});

// User
Route::group(['namespace'=>'FrontEnd'],function(){

	Route::resource('/', 'HomeController')->names(['index' => 'home']);
	
	Route::resource('update-user', 'HomeController');

	Route::resource('about', 'AboutController');
	Route::resource('contact', 'ContactController');
	Route::resource('danh-muc', 'HomeController');
	Route::resource('detail', 'DetailController');
	Route::resource('search', 'SearchController');
	Route::resource('shopping-cart', 'ShoppingController');
	Route::post('shopping-cart/coupon', 'ShoppingController@store_Coupon')->name('shopping-cart.store_coupon');

	Route::resource('history', 'HistoryController')->middleware('CheckLogin');
	Route::resource('checkout', 'CheckoutController');
	Route::resource('show-checkout', 'ShowCheckoutController');
	Route::resource('vnpay', 'CheckoutController');
	Route::resource('vnpay-return', 'Checkout_ReturnController')->names(['index' => 'vnpayreturn']);
	Route::resource('fee', 'FeeController');
	Route::resource('delete-coupon', 'AboutController');

	// SignIn & SignUp
	Route::resource('sign-up', 'RegisterController');
	Route::resource('wishlist', 'WishController');

	//quen mat khau
	// Route::get('/quen-mat-khau','ResetController@quen_mat_khau');
	// Route::post('/recover-pass','ResetController@recover_pass');
	// Route::get('update-new-pass',['as'=>'updatenewpass','uses'=>'ResetController@getupdate_new_pass']);
	// Route::post('update-new-pass',['as'=>'updatenewpass','uses'=>'ResetController@postupdate_new_pass']);
});

