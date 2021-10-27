@extends('LayoutUser')
@section('title')    
  Checkout
@endsection
@section('content')


            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li class="active">Checkout</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!--Checkout Area Strat-->
            <div class="checkout-area pt-60 pb-30">
                <div class="container">
   <!--                  @if(!Session::get('coupon'))
                    <div class="row">
                        <div class="col-12">
                            <div class="coupon-accordion">
                                
                                <h3>Have a coupon? <span id="showcoupon">Click here to enter your code</span></h3>
                                <div id="checkout_coupon" class="coupon-checkout-content">
                                    <div class="coupon-info">
                                         <form action="{{route('shopping-cart.store')}}" method="post">
                                            @csrf
                                            <p class="checkout-coupon">
                                                <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                                <input value="Apply Coupon" type="submit">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    @endif -->
                    <form action="@if(Session::get('pay')==1) {{route('checkout.store')}} @else {{route('vnpay.store')}} @endif" method="POST" id="@if(Session::get('pay')==2) create_form @endif">
                    @csrf 
                    <div class="row">
                        <div class="col-lg-6 col-12">

                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Last Name <span class="required">*</span></label>
                                                <input placeholder="" type="text" name="full_name" value="{{$user_dh->name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Phone <span class="required">*</span></label>
                                                <input type="tel" required="" name="phone" value="{{$user_dh->phone}}">
                                            </div>
                                        </div>
                                        @if(Session::get('pay') ==2 )
                                        <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Chọn ngân hàng <span class="required">*</span></label>  
                                                <select class="nice-select wide city_fee choose" name="bank_code" id="bank_code" required="">
                                                    <option value="">--- Choose --- </option>
                                                    <option value="NCB"> Ngan hang NCB</option>
                                                    <option value="AGRIBANK"> Ngan hang Agribank</option>
                                                    <option value="SCB"> Ngan hang SCB</option>
                                                    <option value="SACOMBANK">Ngan hang SacomBank</option>
                                                    <option value="EXIMBANK"> Ngan hang EximBank</option>
                                                    <option value="MSBANK"> Ngan hang MSBANK</option>
                                                    <option value="NAMABANK"> Ngan hang NamABank</option>
                                                    <option value="VNMART"> Vi dien tu VnMart</option>
                                                    <option value="VIETINBANK">Ngan hang Vietinbank</option>
                                                    <option value="VIETCOMBANK"> Ngan hang VCB</option>
                                                    <option value="HDBANK">Ngan hang HDBank</option>
                                                    <option value="DONGABANK"> Ngan hang Dong A</option>
                                                    <option value="TPBANK"> Ngân hàng TPBank</option>
                                                    <option value="OJB"> Ngân hàng OceanBank</option>
                                                    <option value="BIDV"> Ngân hàng BIDV</option>
                                                    <option value="TECHCOMBANK"> Ngân hàng Techcombank</option>
                                                    <option value="VPBANK"> Ngan hang VPBank</option>
                                                    <option value="MBBANK"> Ngan hang MBBank</option>
                                                    <option value="ACB"> Ngan hang ACB</option>
                                                    <option value="OCB"> Ngan hang OCB</option>
                                                    <option value="IVB"> Ngan hang IVB</option>
                                                    <option value="VISA"> Thanh toan qua VISA/MASTER</option>
                                                </select>

                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-12">
                                            <div class="checkout-form-list">
                                                <label>Address <span class="required">*</span></label>
                                                <textarea placeholder="Street address" type="text" name="address" rows="5" required="">{{$user_dh->address}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="different-address">
                                        <div class="order-notes">
                                            <div class="checkout-form-list">
                                                <label>Order Notes</label>
                                                <textarea id="checkout-mess" name="note" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                        <div class="col-lg-6 col-12">
                            <div class="your-order">
                                <h3>Your order</h3>
                                <div class="your-order-table table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="cart-product-name">Product</th>
                                                <th class="cart-product-total">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach(Cart::content() as $cten)
                                            <tr class="cart_item">
                                              <td class="cart-product-name"> {{$cten->name}}<strong class="product-quantity"> × {{$cten->qty}}</strong></td>
                                              <td class="cart-product-total"><span class="amount">{{number_format(($cten->qty*$cten->price)).' '.'vnđ'}}</span></td>  
                                            </tr>

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            @if(Session::get('coupon'))
                                            <tr class="cart-subtotal">
                                                <th>coupon</th>
                                                <td>
                                                    <span class="amount">
                                                    @foreach(Session::get('coupon') as $key => $coun)
                                                        @if($coun['coupon_condition']==2)
                                                            {{$coun['coupon_number']}} %
                                                        @else
                                                            {{number_format($coun['coupon_number']).' '.'vnđ'}}
                                                        @endif
                                                    @endforeach 
                                                    </span>
                                                </td>
                                            </tr>
                                            @endif
                                            <tr class="cart-subtotal">
                                                <th>shipping fee</th>
                                                <td><span class="amount">{{number_format(Session::get('fee')).' '.'vnđ'}}</span></td>
                                            </tr>
                                            <tr class="cart-subtotal">
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">{{number_format(Session::get('total_order')).' '.'vnđ'}}</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">
                                                {{number_format(Session::get('total_order')+Session::get('fee')).' '.'vnđ'}}
                                                </span></strong></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="payment-method">
                                    <div class="payment-accordion">
                                        <div id="accordion">
                                          <div class="card">
                                            <div class="card-header" id="#payment-1">
                                              <h5 class="panel-title">
                                                <a class="" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  Direct Bank Transfer.
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapseOne" class="collapse show" data-parent="#accordion">
                                              <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                              </div>
                                            </div>
                                          </div>
                                          <div class="card">
                                            <div class="card-header" id="#payment-2">
                                              <h5 class="panel-title">
                                                <a class="collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                  Cheque Payment
                                                </a>
                                              </h5>
                                            </div>
                                            <div id="collapseTwo" class="collapse" data-parent="#accordion">
                                              <div class="card-body">
                                                <p>Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order won’t be shipped until the funds have cleared in our account.</p>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="order-button-payment">
                                            @if(Session::get('total_order') != 0)
                                            <input value="Place order" type="submit" id="btnPopup">
                                            @else
                                            <input value="Place order" type="submit" disabled="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
            <!--Checkout Area End-->


@if(Session::get('pay')==2)
    <!-- checkout-area end -->
    <link href="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.css" rel="stylesheet"/>
    <script src="https://sandbox.vnpayment.vn/paymentv2/lib/vnpay/vnpay.js"></script>
    <script type="text/javascript">
        $("#btnPopup").click(function () {
            var postData = $("#create_form").serialize();
            var submitUrl = $("#create_form").attr("action");
            $.ajax({
                type: "POST",
                url: submitUrl,
                data: postData,
                dataType: 'JSON',
                success: function (x) {
                    if (x.code === '00') {
                        if (window.vnpay) {
                            vnpay.open({width: 768, height: 600, url: x.data});
                        } else {
                            location.href = x.data;
                        }
                        return false;
                    } else {
                        alert(x.Message);
                    }
                }
            });
            return false;
        });
    </script>
@endif

@endsection