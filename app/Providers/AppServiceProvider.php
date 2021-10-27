<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\User;
use App\Products;
use App\Brand;
use App\CategoryProduct;
use App\Wishlist;
use Cache;
use Session;
use Auth;
use DB;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*',function($view){

            $startOfWeek = Carbon::now('Asia/Ho_Chi_Minh')->startOfWeek()->format('Y/m/d');
            $endOfWeek = Carbon::now('Asia/Ho_Chi_Minh')->endOfWeek()->format('Y/m/d');
            $url_canonical = Request()->url();

            $brand_in = Brand::where('brand_status',1)->orderBy('brand_sorting','ASC')->get();
            $product_modal = Products::where('product_status',1)->get();
            $product_views = Products::where('product_status',1)->orderBy('product_view','DESC')->take(8)->orderBy(DB::raw('RAND()'))->get();

            $product_order = Products::where('product_sold','>',0)->orderBy('product_sold','DESC')->take(8)->orderBy(DB::raw('RAND()'))->get();
            $now_date = Carbon::now('Asia/Ho_Chi_Minh');

            if (Auth::user()) {
                if (Auth::user()->id) {
                    $update_user = User::where('id',Auth::user()->id)->first();
                    $user_login = User::where('id',Auth::user()->id)->first();
                }else{
                    $update_user = User::where('id',Auth::id())->first();
                    $user_login = User::where('id',Auth::id())->first();
                }
                if ($user_login->updated_at != $now_date) {
                    $user_login->updated_at = $now_date;
                    $user_login->save();
                }
                $view->with(compact('url_canonical','product_modal','product_views','product_order','brand_in','startOfWeek','endOfWeek','update_user'));
            }

            $view->with(compact('url_canonical','product_modal','product_views','product_order','brand_in','startOfWeek','endOfWeek'));
        });
    }
}
