<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Slider;
use App\Products;
use App\Coupon;
use App\CategoryProduct;
use App\User;
use App\Wishlist;
use App\Gallery;
use Auth;
use DB;
use Session;
use Carbon\Carbon;


class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $find = CategoryProduct::Where('category_id', request()->id_cate)->first();
            if(request()->change != ''){
                $sort = request()->change;

                if($sort=='price-low-high'){
                    $sorting = 'ASC';
                    $pro_change = 'product_price';

                }elseif ($sort=='price-high-low') {
                    $sorting = 'DESC';
                    $pro_change = 'product_price';

                }elseif ($sort=='name-za') {
                    $sorting = 'DESC';
                    $pro_change = 'product_name';

                }elseif ($sort=='name-az') {
                    $sorting = 'ASC';
                    $pro_change = 'product_name';
                }
                $product_cate = Products::where('product_status',1)
                                        ->where('category_id',$find->category_id)
                                        ->orderBy($pro_change,$sorting)
                                        ->paginate(6)
                                        ->appends(request()->query());

            }else{
                $product_cate = Products::where('product_status',1)
                                        ->where('category_id',$find->category_id)
                                        ->orderBy('product_id','ASC')
                                        ->paginate(6);
            }
            return view('FrontEnd.Category.changeCate',compact('product_cate'));

        }
        $nowSale = date('Y/m/d');

        $bannes = Slider::where('slider_status',1)->orderBy('slider_sorting','ASC')->get();
        $bannes_new = Slider::where('slider_status',1)->orderBy(DB::raw('RAND()'))->first();

        $products = Products::where('product_status',1)->where('product_sold','!=',0)->orderBy(DB::raw('RAND()'))->get();

        $product_all = Products::where('product_status',1)->orderBy('product_view','DESC')->get();
        $product_sales = Products::where('product_status',1)->where('promotion_price','!=',0)->where('product_date_sale','>=' ,$nowSale)->orderBy(DB::raw('RAND()'))->get();

        $category_rand = CategoryProduct::where('category_status',1)->inRandomOrder()->take(3)->get();

        $category_in = CategoryProduct::where('category_status',1)->orderBy('category_sorting','ASC')->take(8)->get();
        $category_next = CategoryProduct::where('category_status',1)->skip(8)->take(count($category_in))->orderBy('category_sorting','ASC')->get();


        return view('FrontEnd.Home.index')->with(compact('bannes','products','product_all','product_sales','bannes_new','category_rand','category_in','category_next'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(Auth::user()) {
            $update_user = User::where('id',Auth::id())->first();

            $update_user->full_name = $request->name;
            $update_user->phone = $request->phone;
            $update_user->email = $request->email;
            $update_user->address = $request->address;
            if ($request->password) {
                $update_user->password = $request->password;
            }
            $update_user->save();

            return redirect()->back()->with('thongbao','Cập nhật thành công');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category_find = CategoryProduct::where('slug_category_product', $id)->orWhere('category_id', $id)->first();
        $product_cate = Products::where('product_status',1)->where('category_id',$category_find->category_id)->orderBy('product_id','ASC')->paginate(6);
        $product_cate_count = Products::where('product_status',1)->where('category_id',$category_find->category_id)->get();


        return view('FrontEnd.Category.category',compact('category_find','product_cate','product_cate_count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

           
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
