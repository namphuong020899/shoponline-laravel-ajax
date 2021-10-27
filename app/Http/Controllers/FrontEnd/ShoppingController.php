<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Products;
use App\Coupon;
use Carbon\Carbon;
use Session;
use Cart;
use Auth;

class ShoppingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Session::put('url_shopping',request()->url());

        return view('FrontEnd.Cart.shopping_cart');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $output = '';
        $output_total_shopping = '';
        $total = 0;
        if (Cart::content()->count() > 0) {
            foreach (Cart::content() as $cten) {
                $output .='  
                    <tr>
                        <td class="li-product-remove">
                            <a data-href_rowid="'.route('shopping-cart.edit',[$cten->rowId]).'" class="remove_shopping"><i class="fa fa-times"></i></a>
                        </td>
                        <td class="li-product-thumbnail"><a href="#">
                            <img src="'.url('uploads/product/'.$cten->options->image).'" alt="'.$cten->name.'" width="150px" height="150px"></a>
                        </td>
                        <td class="li-product-name">
                            <a href="'.route('detail.show',[$cten->options->slug]).'">'.$cten->name.'</a>
                        </td>
                        <td class="li-product-price">
                            <span class="amount">'.number_format($cten->price).' '.'vnđ'.'</span>
                        </td>
                        <td class="quantity">
                            <input style="background: #fff;text-align: center; width: 90px" class="cart-plus-minus-box qtycart" min="0" name="qty_updatecart" value="'.$cten->qty.'" type="number" oninput="this.value = Math.abs(this.value)" data-href_submit="'.route('shopping-cart.update',$cten->rowId).'">
                        </td>
                        <td class="product-subtotal">
                            <span class="amount">'.number_format(($cten->qty*$cten->price)).' '.'vnđ'.'</span>
                        </td>
                    </tr>';
                $subtotal = $cten->price*$cten->qty;
                $total+=$subtotal;
                Session::put('total_order',$total);
            }
        }else{
            $output = '  
                <tr>
                    <td colspan="6" style="color: #a8acaf;font-size: 23px;font-weight: bold;">Cart Not Found</td>
                </tr>';
        }
        $output_total_shopping .='  
            <h2>Cart totals</h2>
            <ul>
                <li>Subtotal <span>'.Cart::subtotal().' '.'vnđ'.'</span></li>';
                
                if(Session::get('coupon')){
                    $output_total_shopping .='  
                    <li>Coupon 
                        <span>';
                        foreach(Session::get('coupon') as $key => $coun){
                            if($coun['coupon_condition']==2){
                                $output_total_shopping .=''.$coun['coupon_number'].' % ';
                            }else{
                                $output_total_shopping .=''.number_format($coun['coupon_number']).' '.'vnđ'.' ';
                            }
                        }
                        $output_total_shopping .='  
                        </span>
                    </li>';
                }
                $output_total_shopping .='  
                <li>Tax<span>'.Cart::tax().' '.'vnđ'.'</span></li>
                <li>Total <span>';
                    if(Session::get('coupon')){
                        foreach(Session::get('coupon') as $key => $coun){
                            if($coun['coupon_condition']==2){
                                $total_coupon = (Session::get('total_order')*$coun['coupon_number'])/100;
                                $total_pre = Session::get('total_order')-$total_coupon;
                                $totalPrice = $total_pre;
                                Session::put('total_order',$totalPrice);

                                if(Cart::content()->count() != 0){
                                    $output_total_shopping .=' '.number_format(Session::get('total_order')).' '.'vnđ'.' ';
                                }
                                else{
                                    Session::put('total_order',0);
                                    $output_total_shopping .=' '.number_format(Session::get('total_order')).' '.'vnđ'.' ';
                                }
                            }else{
                                $total_coupon = Session::get('total_order')-$coun['coupon_number'];
                                $totalPrice = $total_coupon;
                                Session::put('total_order',$totalPrice);

                                if(Cart::content()->count() != 0){
                                    $output_total_shopping .=' '.number_format(Session::get('total_order')).' '.'vnđ'.' ';
                                }
                                else{
                                    Session::put('total_order',0);
                                    $output_total_shopping .=' '.number_format(Session::get('total_order')).' '.'vnđ'.' ';
                                }
                            }
                        }
                    }else{
                        if(Cart::content()->count() != 0){
                            $output_total_shopping .=' '.number_format(Session::get('total_order')).' '.'vnđ'.' ';
                        }
                        else{
                            Session::put('total_order',0);
                            $output_total_shopping .=' '.number_format(Session::get('total_order')).' '.'vnđ'.' ';
                        }
                    }
                    $output_total_shopping .='  
                    </span>
                </li>
            </ul>';
            if(Auth::user()){
                $output_total_shopping .='<a href="'.route('show-checkout.index').'">Proceed to checkout</a>';
            }else{
                $output_total_shopping .='<a href="'.route('login.index').'">Proceed to checkout</a>';
            }

        return response()->json([
            'data'=>$output,
            'output_total_shopping'=>$output_total_shopping,
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
            $product_id = $request->product_id_hidden;
            
            if ($request->qty_price == '') {
                $quantity = 1;
            }else{
                $quantity = $request->qty_price;
            }
            $product_info = Products::where('product_id',$product_id)->first();

            if ($product_info->promotion_price != 0) {
                $price = $product_info->promotion_price;
            }else{
                $price = $product_info->product_price;
            }
            $data['id'] = $product_info->product_id;
            $data['qty'] = $quantity;
            $data['name'] = $product_info->product_name;
            $data['price'] = $price;
            $data['weight'] = $price;
            $data['options']['image'] = $product_info->product_image;
            $data['options']['slug'] = $product_info->product_slug;
            Cart::add($data);
            // Cart::destroy();

            return response()->json([
                'message'=>'Add Cart Successfully'
            ]);
        }
        
    }

    public function store_Coupon(Request $request){
        if ($request->ajax()) {
            $data = $request->all();
            $today =  Carbon::now('Asia/Ho_Chi_Minh')->format('d-m-Y');
            $today_d =  Carbon::now('Asia/Ho_Chi_Minh')->format('d');
            $today_m =  Carbon::now('Asia/Ho_Chi_Minh')->format('m');
            $today_y =  Carbon::now('Asia/Ho_Chi_Minh')->format('Y');
            if (Auth::user()) {
                $date_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
                if ($date_coupon) {
                    $create = date_create($date_coupon->coupon_date_end);
                    $day = date_format($create,'d');
                    $month = date_format($create,'m');
                    $year = date_format($create,'Y');

                    if ($month > $today_m && $year >= $today_y) {
                        $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->where('coupon_used', 'LIKE', '%'.Auth::id().'%')->first();
                    }else if($month == $today_m && $year == $today_y){
                        if ($day >= $today_d) {
                            $used_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->where('coupon_used', 'LIKE', '%'.Auth::id().'%')->first();
                        }else{
                            return response()->json(['error'=>'The discount code is incorrect or has expired']);
                        }
                    }else{
                        return response()->json(['error'=>'The discount code is incorrect or has expired']);
                    }



                }else{
                    return response()->json(['error'=>'The discount code is incorrect or has expired']);
                }
            }else{
                return response()->json([
                    'url'=>route('login.index'),
                    'error_login'=>'Please login to use discount code!'
                ]);
            }
            
            if ($used_coupon) {
                return response()->json(['error'=>'Discount code already used, please enter another code']);
            }else{
                $date_coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
                $create_date = date_create($date_coupon->coupon_date_end);
                $day = date_format($create_date,'d');
                $month = date_format($create_date,'m');
                $year = date_format($create_date,'Y');
                if ($month > $today_m && $year >= $today_y) {
                    $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
                }else if($month == $today_m && $year == $today_y){
                    if ($day >= $today_d) {
                        $coupon = Coupon::where('coupon_code', $data['coupon_code'])->where('coupon_status',1)->first();
                    }else{
                        return response()->json(['error'=>'The discount code is incorrect or has expired']);
                    }
                }else{
                    return response()->json(['error'=>'The discount code is incorrect or has expired']);
                }
                
                if ($coupon) {
                    $coupon_count = $coupon->count();
                    if ($coupon_count>0) {
                        $coupon_session = Session::get('coupon');
                        if ($coupon_session==true) {
                            $is_avaiable = 0;
                            if ($is_avaiable==0) {
                                $coun[] = array(
                                    'coupon_code' => $coupon->coupon_code, 
                                    'coupon_condition' => $coupon->coupon_condition, 
                                    'coupon_number' => $coupon->coupon_sale_number, 
                                );
                                Session::put('coupon',$coun);
                            }
                        }else{
                            $coun[] = array(
                                    'coupon_code' => $coupon->coupon_code, 
                                    'coupon_condition' => $coupon->coupon_condition, 
                                    'coupon_number' => $coupon->coupon_sale_number, 
                                );
                            Session::put('coupon',$coun);
                        }
                        Session::save();

                        return response()->json(['message'=>'Add Coupon Successfully']);

                    }
                }else{
                    return response()->json(['error'=>'The discount code is incorrect or has expired']);
                }
            }
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $product_id = $id;
        $quantity = 1;
        $product_info = Products::where('product_id',$product_id)->first();

        if ($product_info->promotion_price != 0) {
            $price = $product_info->promotion_price;
        }else{
            $price = $product_info->product_price;
        }
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $price;
        $data['weight'] = $price;
        $data['options']['image'] = $product_info->product_image;
        $data['options']['slug'] = $product_info->product_slug;
        Cart::add($data);
        // Cart::destroy();
        
        return response()->json([
            'status'=>200,
            'message'=>'Add Cart Successfully'
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Cart::update($id, 0);
        // Cart::remove($id);
        if (Cart::content()->count() == 0) {
            Session::forget('coupon');
        }
        
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
        $qty = $request->qty_updatecart;
        Cart::update($id, $qty);

        return response()->json([
            'message'=>'Update Qty Successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
