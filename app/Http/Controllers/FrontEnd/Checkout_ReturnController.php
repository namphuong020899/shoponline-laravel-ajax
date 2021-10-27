<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Session;
use Cart;
use Mail;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\Coupon;
use App\Order;
use App\OrderDetail;
use Auth;

class Checkout_ReturnController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->vnp_ResponseCode == "00" || $request->vnp_ResponseCode == "07") {

            $user_dh =  User::find(Auth::id());

            $order_customer = Session::get('order_customer');
        

            foreach ($order_customer as $key => $data_cus) {
                $customer = new Customer();
                $customer->customer_name = $data_cus['name_order'];
                $customer->customer_email = $data_cus['email_order'];
                $customer->customer_phone = $data_cus['phone_number_order'];
                $customer->customer_address = $data_cus['address_order'];
                $customer->customer_note = $data_cus['note_order'];
                $customer->customer_payment = 'ATM';
                
                $customer->save();
                $customer_id = $customer->customer_id;
            }

            $checkout_code = substr(md5(microtime()),rand(0,26),5);


            $order = new Order;
            $order->customer_order_id = $customer_id;
            $order->users_id   = Auth::id();
            $order->order_status = 1;
            $order->order_pay = 'ATM';
            $order->order_code = $checkout_code;

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order->created_at = now();
            $order->save();

            foreach(Cart::content() as $key => $cart){
                $order_details = new OrderDetail;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart->id;
                // $order_details->product_name = $cart->name;
                $order_details->product_price = $cart->price;
                $order_details->product_sales_quantity = $cart->qty;
                if (Session::get('coupon')) {
                    foreach (Session::get('coupon') as $key => $cou) {
                        $order_details->product_coupon =  $cou['coupon_code'];
                    }
                }else{
                    $order_details->product_coupon =  'no';
                }
                
                $order_details->product_feeship = Session::get('fee');
                $order_details->save();
            }

            if (Session::get('coupon')) {
                foreach(Session::get('coupon') as $key => $coun){
                    $coupon_qty = Coupon::where('coupon_code',$coun['coupon_code'])->first();
                    $coupon_qty->coupon_used = ','.Auth::id();
                    $coupon_qty->coupon_qty--;
                    $coupon_qty->save(); 
                }
            }

            //send mail xac nhan dat hang
            $now = Carbon::now('Asia/Ho_Chi_Minh');
            $to_email =  env('MAIL_USERNAME');
            $title_mail = 'Xác Nhận Đơn Hàng'. ' ' .$now;
            $data['email'][] = $customer->customer_email;


            $shipping_array = array('name' =>$customer->customer_name,
                                    'address' =>$customer->customer_address,
                                    'phone_number' =>$customer->customer_phone
                                     );


            Mail::send('Mail.mail_oder', 
                [
                    'shipping_array' => $shipping_array
                ],
                function($message) use ($title_mail, $data, $to_email){
                        $message->to($data['email'])->subject($title_mail);
                        $message->from($to_email, $title_mail);
            });

            Session::forget('fee');
            Session::forget('cart');
            Session::forget('coupon');
            Session::forget('total_order');
            Session::forget('order_customer');

            if ($request->vnp_ResponseCode == "07") {

                return redirect()->route('home')->with('message','Đặt hàng thành công. Giao dịch bị nghi ngờ (liên quan tới lừa đảo, giao dịch bất thường)');
            }else{

                return redirect()->route('home')->with('message','Đặt hàng thành công');
            }
            
        }else if ($request->vnp_ResponseCode == "09") {
            return redirect()->route('checkout.index')->with('message','Thẻ/Tài khoản của khách hàng chưa đăng ký dịch vụ InternetBanking tại ngân hàng');
        }else if ($request->vnp_ResponseCode == "10") {
            return redirect()->route('checkout.index')->with('message','Khách hàng xác thực thông tin thẻ/tài khoản không đúng quá 3 lần');
        }else if ($request->vnp_ResponseCode == "11") {
            return redirect()->route('checkout.index')->with('message','Đã hết hạn chờ thanh toán. Xin quý khách vui lòng thực hiện lại giao dịch');
        }else if ($request->vnp_ResponseCode == "12") {
            return redirect()->route('checkout.index')->with('message','Thẻ/Tài khoản của khách hàng bị khóa');
        }else if ($request->vnp_ResponseCode == "13") {
            return redirect()->route('home')->with('message','Quý khách nhập sai mật khẩu xác thực giao dịch (OTP). Xin quý khách vui lòng thực hiện lại giao dịch');
        }else if ($request->vnp_ResponseCode == "24") {
            return redirect()->route('checkout.index')->with('message','Giao dịch không thành công do: Khách hàng hủy giao dịch');
        }else if ($request->vnp_ResponseCode == "51") {
            return redirect()->route('checkout.index')->with('message','Tài khoản của quý khách không đủ số dư để thực hiện giao dịch');
        }else if ($request->vnp_ResponseCode == "65") {
            return redirect()->route('checkout.index')->with('message','Tài khoản của Quý khách đã vượt quá hạn mức giao dịch trong ngày');
        }else if ($request->vnp_ResponseCode == "75") {
            return redirect()->route('checkout.index')->with('message','Ngân hàng thanh toán đang bảo trì');
        }else if ($request->vnp_ResponseCode == "79") {
            return redirect()->route('checkout.index')->with('message','KH nhập sai mật khẩu thanh toán quá số lần quy định. Xin quý khách vui lòng thực hiện lại giao dịch');
        }else if ($request->vnp_ResponseCode == "99") {
            return redirect()->route('checkout.index')->with('message','Các lỗi khác (lỗi còn lại, không có trong danh sách mã lỗi đã liệt kê)');
        }
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
