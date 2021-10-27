<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use App\Order;
use App\OrderDetail;
use App\Review;
use Auth;
use Validator;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $review_order = Order::where('users_id',Auth::id())
                            ->where('order_status',3)
                            ->get();

        return view('FrontEnd.Cart.history_cart',compact('review_order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (request()->ajax()) {
            $output = '';
            $review_order = Order::where('users_id',Auth::id())
            ->where('order_status',3)
            ->orderBy('order_id','desc')
            ->get();
            if (count($review_order) > 0) {
                foreach ($review_order as $row) {
                    $orderdetail = OrderDetail::where('order_code',$row->order_code)->get();

                    foreach ($orderdetail as $row_2) {
                        $output .='  
                        <tr>
                            <td class="li-product-thumbnail">
                                <a href="'.route('detail.show',[$row_2->product_order->product_slug]).'">
                                    <img src="'. asset('uploads/product/'.$row_2->product_order->product_image) .'" alt="'.$row_2->product_order->product_content.'" width="150px" height="150px">
                                </a>
                            </td>
                            <td class="li-product-name">
                                <a href="'.route('detail.show',[$row_2->product_order->product_slug]).'">'.$row_2->product_order->product_name.'</a>
                            </td>
                            <td class="li-product-price">
                                <span class="amount">'. number_format($row_2->product_price) .'</span>
                            </td>
                            <td class="quantity">'.$row_2->product_sales_quantity.'</td>';
                            if ($row_2->order_detail_review == ''){
                                $output .='
                                <td class="review">
                                    <a href="#" data-toggle="modal" class="show-review" data-id="'.$row_2->order_details_id .'">
                                        <h5>Write Review</h5>
                                    </a>
                                </td>';
                            }
                            $output .='
                        </tr>';
                    }
                }
            }else{
                $output .='  
                    <tr>
                        <td colspan="4" style="color: #a8acaf;font-size: 23px;   font-weight: bold;">History Not Found</td>
                    </tr>';
            }

            return response()->json([
                'status'=>200,
                'output'=>$output
            ]);
        }
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
            $validator = Validator::make($request->all(),[
                'text_review'=>'required',
                'star_count'=>'required',
            ]);
            if ($validator->fails()) {
                return response()->json([
                    'status'=>400,
                    'errors'=>$validator->messages(),
                ]);
            }else{
                $review = new Review();
                $review->rating = $request->star_count;
                $review->comment = $request->text_review;
                $review->review_detail_id = $request->id_detail;
                $review->review_id_product = $request->id_pro;
                $review->review_id_user = Auth::id();
                $review->save();

                $order_de = OrderDetail::where('order_details_id',$request->id_detail)->first();
                $order_de->order_detail_review = true;
                $order_de->save();

                return response()->json([
                    'status'=>200,
                    'message'=>'Successfully'
                ]);
            }
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
        $review = OrderDetail::findOrfail($id);
        if ($review) {
            $product = Products::where('product_id',$review->product_id)->first();
            $desc = substr($product->product_desc,0,100);
            return response()->json([
                'status'=>200,
                'data'=>$review,
                'product'=>$product,
                'desc'=>$desc,
            ]);
        }else{
            return response()->json([
                'status'=>404,
                'message'=>'Not Found'
            ]);
        }
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
