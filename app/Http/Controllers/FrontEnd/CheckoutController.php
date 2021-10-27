<?php

namespace App\Http\Controllers\FrontEnd;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Session;
use Cart;
use Mail;
use Carbon\Carbon;
use App\User;
use App\Customer;
use App\Coupon;
use App\Order;
use App\OrderDetail;


class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user() && Cart::content()->count() != 0) {
            $user_dh =  User::find(Auth::id());

            return view('FrontEnd.Cart.checkout_cart')->with(compact('user_dh'));
        }else{
            return redirect()->route('home');
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
        if (Session::get('pay') == 1) {

            $data = $request->all();
            $user_dh =  User::find(Auth::id());

            $customer = new Customer();
            $customer->customer_name = $data['full_name'];
            $customer->customer_email = $user_dh->email;
            $customer->customer_phone = $data['phone'];
            $customer->customer_address = $data['address'];
            $customer->customer_note = $data['note'];
            $customer->customer_payment = 'COD';
            
            $customer->save();
            $customer_id = $customer->customer_id;

            $checkout_code = substr(md5(microtime()),rand(0,26),5);


            $order = new Order;
            $order->customer_order_id = $customer_id;
            $order->users_id   = Auth::id();
            $order->order_status = 1;
            $order->order_pay = 'COD';
            $order->order_code = $checkout_code;

            date_default_timezone_set('Asia/Ho_Chi_Minh');
            $order->created_at = now();
            $order->save();

            if(Session::get('cart')==true){
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
            
            return redirect()->route('home')->with('message','Đặt hàng thành công');

        }else if (Session::get('pay') == 2){
            $user_dh =  User::find(Auth::id());

            // dd($user_dh);
            $vnp_TxnRef = substr(md5(microtime()),rand(0,26),5); 
            $vnp_OrderInfo = "TT Web Shop";
            $vnp_OrderType = "billpayment";
            foreach(Cart::content() as $key => $cart){
                if (Session::get('coupon')) {
                    foreach(Session::get('coupon') as $key => $coun){
                        if($coun['coupon_condition']==2){
                            $total_coupon = (Session::get('total_order')*$coun['coupon_number'])/100;
                            $total_pre = Session::get('total_order')-$total_coupon;
                            $totalPrice = $total_pre;
                        }else{
                            $total_coupon = Session::get('total_order')-$coun['coupon_number'];
                            $totalPrice = $total_coupon;
                        }
                    }
                    $vnp_Amount = ($totalPrice+Session::get('fee')) * 100;    
                }else{
                    $vnp_Amount = (Session::get('total_order')+Session::get('fee')) * 100;
                }
            }
            $vnp_Locale = config('app.locale');
            $vnp_BankCode = $request->bank_code;
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            $order_session = Session::get('order_customer');
            $name_order = $request->full_name;
            $email_order = $user_dh->email;
            $address_order = $request->address;
            $phone_number_order = $request->phone;
            $note_order = $request->note;
            $code_order = $vnp_TxnRef;
            $BankCode_order = $vnp_BankCode;

            
            $count_order[] = array(
                'name_order' => $name_order, 
                'email_order' => $email_order, 
                'address_order' => $address_order, 
                'phone_number_order' => $phone_number_order, 
                'note_order' => $note_order, 
                'code_order' => $code_order, 
                'BankCode_order' => $BankCode_order, 
            );
            Session::put('order_customer',$count_order);

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => env('VNP_TMN_CODE'),
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => route('vnpayreturn'),
                "vnp_TxnRef" => $vnp_TxnRef,
                "vnp_ExpireDate"=>time().rand(0,100),
            );

            // dd($inputData);

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }
            // dd($hashdata);

            $vnp_Url = env('VNP_URL') . "?" . $query;
            if (env('VNP_HASH_SECRET')) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, env('VNP_HASH_SECRET'));
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }

            return redirect()->to($vnp_Url);

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
