<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\Wishlist;
use Auth;
use Session;
use DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
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
                $product_search = Products::where('product_status',1)
                                        ->where('product_name','LIKE','%'.request()->search.'%')
                                        ->orWhere('product_price','LIKE','%'.request()->search.'%')
                                        ->orWhere('promotion_price','LIKE','%'.request()->search.'%')
                                        ->orderBy($pro_change,$sorting)
                                        ->take(30)
                                        ->get();

            }else{
                $product_search = Products::where('product_status',1)
                                    ->where('product_name','LIKE','%'.request()->search.'%')
                                    ->orWhere('product_price','LIKE','%'.request()->search.'%')
                                    ->orWhere('promotion_price','LIKE','%'.request()->search.'%')
                                    ->take(30)
                                    ->get();
            }
            return view('FrontEnd.Search.change',compact('product_search'));

        }
        $request_search = request()->search;

        $product_search = Products::where('product_status',1)->where('product_name','LIKE','%'.$request_search.'%')
                                    ->orWhere('product_price','LIKE','%'.$request_search.'%')
                                    ->orWhere('promotion_price','LIKE','%'.$request_search.'%')
                                    ->take(30)
                                    ->get();

        return view('FrontEnd.Search.search',compact('product_search','request_search'));
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
        if (Auth::user()) {
            $count_wish = Wishlist::where('id_user',Auth::id())->where('wish_status',0)->count();
            $wishlist = Wishlist::join('product','product.product_id','wishlist.id_product')->where('id_user',Auth::id())->where('wish_status',0)->take(8)->orderBy(DB::raw('RAND()'))->get();
            $output = '';
            foreach ($wishlist as $key => $value) {
                $output .=' 
                    <li>
                        <a href="'.route('detail.show',$value->product_slug).'">'.$value->product_name.'</a>
                    </li>  
                ';
            }

        }else{
            $count_wish = 0;
            $output .='<li></li>';
        }

        return response()->json([
            'data'=>$count_wish,
            'output'=>$output
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
