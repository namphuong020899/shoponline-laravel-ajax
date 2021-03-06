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
            $title_mail = 'X??c Nh???n ????n H??ng'. ' ' .$now;
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

                return redirect()->route('home')->with('message','?????t h??ng th??nh c??ng. Giao d???ch b??? nghi ng??? (li??n quan t???i l???a ?????o, giao d???ch b???t th?????ng)');
            }else{

                return redirect()->route('home')->with('message','?????t h??ng th??nh c??ng');
            }
            
        }else if ($request->vnp_ResponseCode == "09") {
            return redirect()->route('checkout.index')->with('message','Th???/T??i kho???n c???a kh??ch h??ng ch??a ????ng k?? d???ch v??? InternetBanking t???i ng??n h??ng');
        }else if ($request->vnp_ResponseCode == "10") {
            return redirect()->route('checkout.index')->with('message','Kh??ch h??ng x??c th???c th??ng tin th???/t??i kho???n kh??ng ????ng qu?? 3 l???n');
        }else if ($request->vnp_ResponseCode == "11") {
            return redirect()->route('checkout.index')->with('message','???? h???t h???n ch??? thanh to??n. Xin qu?? kh??ch vui l??ng th???c hi???n l???i giao d???ch');
        }else if ($request->vnp_ResponseCode == "12") {
            return redirect()->route('checkout.index')->with('message','Th???/T??i kho???n c???a kh??ch h??ng b??? kh??a');
        }else if ($request->vnp_ResponseCode == "13") {
            return redirect()->route('home')->with('message','Qu?? kh??ch nh???p sai m???t kh???u x??c th???c giao d???ch (OTP). Xin qu?? kh??ch vui l??ng th???c hi???n l???i giao d???ch');
        }else if ($request->vnp_ResponseCode == "24") {
            return redirect()->route('checkout.index')->with('message','Giao d???ch kh??ng th??nh c??ng do: Kh??ch h??ng h???y giao d???ch');
        }else if ($request->vnp_ResponseCode == "51") {
            return redirect()->route('checkout.index')->with('message','T??i kho???n c???a qu?? kh??ch kh??ng ????? s??? d?? ????? th???c hi???n giao d???ch');
        }else if ($request->vnp_ResponseCode == "65") {
            return redirect()->route('checkout.index')->with('message','T??i kho???n c???a Qu?? kh??ch ???? v?????t qu?? h???n m???c giao d???ch trong ng??y');
        }else if ($request->vnp_ResponseCode == "75") {
            return redirect()->route('checkout.index')->with('message','Ng??n h??ng thanh to??n ??ang b???o tr??');
        }else if ($request->vnp_ResponseCode == "79") {
            return redirect()->route('checkout.index')->with('message','KH nh???p sai m???t kh???u thanh to??n qu?? s??? l???n quy ?????nh. Xin qu?? kh??ch vui l??ng th???c hi???n l???i giao d???ch');
        }else if ($request->vnp_ResponseCode == "99") {
            return redirect()->route('checkout.index')->with('message','C??c l???i kh??c (l???i c??n l???i, kh??ng c?? trong danh s??ch m?? l???i ???? li???t k??)');
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
