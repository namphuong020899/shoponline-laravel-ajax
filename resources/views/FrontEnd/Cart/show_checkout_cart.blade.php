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
<!--                     @if(!Session::get('coupon'))
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
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <form action="{{route('fee.store')}}" method="post">
                                @csrf 
                                <div class="checkbox-form">
                                    <h3>Billing Details</h3>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Chọn thành phố <span class="required">*</span></label>
                                                <select class="nice-select wide city_fee choose" name="city" id="city" required="">
                                                    <option value="">--Chọn tỉnh thành phố--</option>
                                                    @foreach($city as $key => $ci)
                                                    <option value="{{$ci->matp}}">{{$ci->name_city}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Chọn quận huyện <span class="required">*</span></label>
                                                <select class="three-select wide province_fee choose" name="province" id="province" required="">
                                                    <option value="">--Chọn quận huyện--</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Chọn xã phường <span class="required">*</span></label>
                                                <select class="three-select wide wards_fee" name="wards" id="wards" required="">
                                                    <option value="">--Chọn xã phường--</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="country-select clearfix">
                                                <label>Payment <span class="required">*</span></label>
                                                <select class="nice-select wide" name="payment" required="">
                                                    <option value="1">Thanh toán trực tiếp</option>
                                                    <option value="2">Thanh toán online</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-12"></div>
                                        <div class="col-md-6">
                                            <a href="{{route('shopping-cart.index')}}" class="li-button li-button-white li-button-fullwidth li-button-sm">< Trở về</a>
                                        </div>
                                        <div class="col-md-6">
                                            @if(Session::get('total_order') != 0)
                                            <input style="cursor: pointer;" value="Tiếp tục >" class="li-button li-button-dark li-button-fullwidth li-button-sm" type="submit" name="calculate_order">
                                            @else
                                            <input style="cursor: pointer;" value="Tiếp tục >" class="li-button li-button-dark li-button-fullwidth li-button-sm" type="submit" name="calculate_order" disabled="">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
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
                                            @php
                                                $total = 0;
                                            @endphp
                                            @foreach(Cart::content() as $cten)
                                            <tr class="cart_item">
                                              <td class="cart-product-name"> {{$cten->name}}<strong class="product-quantity"> × {{$cten->qty}}</strong></td>
                                              <td class="cart-product-total"><span class="amount">{{number_format(($cten->qty*$cten->price)).' '.'vnđ'}}</span></td>  
                                            </tr>
                                            @if(!Session::get('total_order'))
                                                @php
                                                    $subtotal = $cten->price*$cten->qty;
                                                    $total+=$subtotal;
                                                    Session::put('total_order',$total);
                                                @endphp
                                            @endif
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
                                                <th>Cart Subtotal</th>
                                                <td><span class="amount">{{Cart::subtotal().' '.'vnđ'}}</span></td>
                                            </tr>
                                            <tr class="order-total">
                                                <th>Order Total</th>
                                                <td><strong><span class="amount">{{number_format(Session::get('total_order')).' '.'vnđ'}}
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Checkout Area End-->


@endsection