<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Cart;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('FrontEnd.About.about');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $output = '';
        $output_count = '';
        $output_sub = '';

        $output_sub .='   '.Cart::subtotal().' '.'vnđ'.'  ';
        $output_count .='  
            <span>'.Cart::subtotal().' '.'vnđ'.'</span>
            <span class="cart-item-count">'.Cart::content()->count().'</span>
        ';
        foreach (Cart::content() as $cten) {
            $output .='  
                <li>
                    <a href="single-product.html" class="minicart-product-image">
                        <img src="'.url('uploads/product/'.$cten->options->image).'" alt="'.$cten->name.'" width="48px" height="48px">
                    </a>
                    <div class="minicart-product-details">
                        <h6><a href="'.route('detail.show',[$cten->options->slug]).'">'.$cten->name.'</a></h6>
                        <span>'.number_format($cten->price).' '.'vnđ'.' x '.$cten->qty.'</span>
                    </div>
                    <button class="close">
                        <a data-href_rowid="'.route('shopping-cart.edit',$cten->rowId).'" class="remove_cart_rowId"><i class="fa fa-close"></i></a>
                    </button>
                </li>
            ';
        }

        return response()->json([
            'output_count'=>$output_count,
            'output_sub'=>$output_sub,
            'output'=>$output,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            Session::forget('coupon');

            return response()->json(['message'=>'Xóa mã giảm giá thành công!']);
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
