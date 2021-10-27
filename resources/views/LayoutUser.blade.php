<!doctype html>
<html class="no-js" lang="{{ app()->getLocale() }}">
    
<!-- index-431:41-->
<head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Rampoa || @yield('title')</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{asset('frontend/images/favicon.png')}}">
        <meta name="csrf-token" content="{{ csrf_token() }}">​
        <!-- Material Design Iconic Font-V2.2.0 -->
        <link rel="stylesheet" href="{{asset('frontend/css/material-design-iconic-font.min.css')}}">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
        <!-- Font Awesome Stars-->
        <link rel="stylesheet" href="{{asset('frontend/css/fontawesome-stars.css')}}">
        <!-- Meanmenu CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/meanmenu.css')}}">
        <!-- owl carousel CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.min.css')}}">
        <!-- Slick Carousel CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/slick.css')}}">
        <!-- Animate CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
        <!-- Jquery-ui CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/jquery-ui.min.css')}}">
        <!-- Venobox CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/venobox.css')}}">
        <!-- Nice Select CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/nice-select.css')}}">
        <!-- Three Select CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/three-select.css')}}">
        <!-- Magnific Popup CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
        <!-- Bootstrap V4.1.3 Fremwork CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
        <!-- Helper CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/helper.css')}}">
        <!-- Main Style CSS -->
        <link rel="stylesheet" href="{{asset('frontend/style.css')}}">
        <!-- Responsive CSS -->
        <link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">
        <!-- Modernizr js -->
        <script src="{{asset('frontend/js/vendor/modernizr-2.8.3.min.js')}}"></script>
        <!-- Notification -->
        <link href="{{ asset('frontend/login/toastr.css') }}" rel="stylesheet">
        @yield('style')
    </head>
    <body>
    <!--[if lt IE 8]>
        <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
        <!-- Begin Body Wrapper -->
        <div class="body-wrapper">
            <!-- Begin Header Area -->
            <header >
                <!-- Begin Header Top Area -->
                <div class="header-top" style="margin-top: -1.3%;">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Top Left Area -->
                            <div class="col-lg-3 col-md-4">
                                <div class="header-top-left">
                                    <ul class="phone-wrap">
                                        <li><span>Telephone Enquiry:</span><a href="#">(+123) 123 321 345</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Left Area End Here -->
                            <!-- Begin Header Top Right Area -->
                            <div class="col-lg-9 col-md-8">
                                <div class="header-top-right">
                                    
                                    <ul class="ht-menu">
                                        @if(Auth::user())
                                        <!-- Begin Setting Area -->
                                        <li>
                                            <div class="ht-setting-trigger"><span>Setting</span></div>
                                            <div class="setting ht-setting">
                                                <ul class="ht-setting-list">
                                                    <li><a href="#" data-toggle="modal" data-target="#exampleModal">My Account</a></li>
                                                    <li><a href="{{route('history.index')}}">History Order</a></li>
                                                    
                                                    @if(Cart::count() != 0)
                                                    <li><a href="{{route('show-checkout.index')}}">Checkout</a></li>
                                                    @endif
                                                    <li><a href="{{ route('logout.index') }}">Log out</a></li>
                                                    @if(Session::get('user_level_login') == 2)
                                                    <li><a href="{{route('dashboard.index')}}">Go Admin</a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                        </li>
                                        @else
                                        <li>
                                            <div class="ht-setting-trigger"><span>Setting</span></div>
                                            <div class="setting ht-setting">
                                                <ul class="ht-setting-list">
                                                    <li><a href="{{route('login.index')}}">Log in</a></li>
                                                    <li><a href="{{route('sign-up.index')}}">Sign up</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Setting Area End Here -->
                                        @endif
                                        <!-- Begin Currency Area -->
                                        <li>
                                            <span class="currency-selector-wrapper">Currency :</span>
                                            <div class="ht-currency-trigger"><span>VNĐ</span></div>
                                            <div class="currency ht-currency">
                                                <ul class="ht-setting-list">
                                                    <li class="active"><a href="#">VNĐ</a></li>
                                                    <li><a href="#">USD $</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Currency Area End Here -->
                                        <!-- Begin Language Area -->
                                        <li>
                                            <span class="language-selector-wrapper">Language :</span>
                                            <div class="ht-language-trigger"><span>English</span></div>
                                            <div class="language ht-language">
                                                <ul class="ht-setting-list">
                                                    <li class="active"><a href="#"><img src="{{asset('frontend/images/menu/flag-icon/1.jpg')}}" alt="">English</a></li>
                                                    <li><a href="#"><img src="{{asset('frontend/images/menu/flag-icon/2.jpg')}}" alt="">Français</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Language Area End Here -->
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Top Area End Here -->
                <!-- Begin Header Middle Area -->
                <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Logo Area -->
                            <div class="col-lg-3">
                                <div class="logo pb-sm-30 pb-xs-30">
                                    <a href="{{route('home')}}">
                                        <img src="{{asset('frontend/images/menu/logo/1.png')}}" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- Header Logo Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                                <!-- Begin Header Middle Searchbox Area -->
                                <form action="{{route('search.index')}}" method="GET" class="hm-searchbox">
<!--                                     <select class="nice-select select-search-category">
                                        <option value="0">All</option>                         
                                    </select> -->
                                    <input type="text" name="search" placeholder="Enter your search key ...">
                                    <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                                <!-- Header Middle Searchbox Area End Here -->
                                <!-- Begin Header Middle Right Area -->
                                <div class="header-middle-right">
                                    <ul class="hm-menu">
                                        <!-- Begin Header Middle Wishlist Area -->
                                        <li class="hm-wishlist">
                                            <a href="{{ route('wishlist.index') }}">
                                                <span class="cart-item-count wishlist-item-count" id="total_wish">
                                                </span>
                                                <i class="fa fa-heart-o"></i>
                                            </a>
                                        </li>
                                        <!-- Header Middle Wishlist Area End Here -->
                                        <!-- Begin Header Mini Cart Area -->
                                        <?php $content = Cart::content(); ?>
                                        <li class="hm-minicart">
                                            <div class="hm-minicart-trigger">
                                                <span class="item-icon"></span>
                                                <span class="item-text" id="load_count_cart">
                                                </span>
                                            </div>
                                            <span></span>
                                            <div class="minicart">
                                                <ul class="minicart-product-list" id="load_product_cart">

                                                </ul>
                                                <p class="minicart-total">SUBTOTAL: 
                                                    <span id="load_sub_cart"></span>
                                                </p>
                                                <div class="minicart-button">
                                                    <a href="{{route('shopping-cart.index')}}" class="li-button li-button-dark li-button-fullwidth li-button-sm">
                                                        <span>View Full Cart</span>
                                                    </a>
<!--                                                     <a href="checkout.html" class="li-button li-button-fullwidth li-button-sm">
                                                        <span>Checkout</span>
                                                    </a> -->
                                                </div>
                                            </div>
                                        </li>
                                        <!-- Header Mini Cart Area End Here -->
                                    </ul>
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Middle Area End Here -->
                <!-- Begin Header Bottom Area -->
                <div class="header-bottom header-sticky stick d-none d-lg-block d-xl-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                               <!-- Begin Header Bottom Menu Area -->
                               <div class="hb-menu">
                                   <nav>
                                       <ul>
                                           <li><a href="{{route('home')}}"><span  >home</span></a></li>
                                           <li class="megamenu-holder"><a href="{{$url_canonical}}">top products</a>
                                               <ul class="megamenu hb-megamenu" style="text-transform: capitalize;">
                                                    <li><a href="">buy a lot</a>
                                                        <ul>
                                                            @foreach ($product_order as $element)
                                                            <li><a href="{{route('detail.show',[$element->product_slug])}}">{{$element->product_name}}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li><a href="#">View</a>
                                                       <ul>
                                                        @foreach($product_views as $pro_view)
                                                           <li><a href="{{route('detail.show',[$pro_view->product_slug])}}">{{$pro_view->product_name}}</a></li>
                                                        @endforeach
                                                       </ul>
                                                       
                                                   </li>
                                                   <li><a href="#">wishlist</a>
                                                       <ul id="list_wish"></ul>
                                                   </li>
                                               </ul>
                                           </li>
                                           <li class="dropdown-holder"><a href="blog-left-sidebar.html">Brand</a>
                                               <ul class="hb-dropdown">
                                                @foreach($brand_in as $br_in)
                                                   <li class="{{ count($br_in->brand)>0 ? 'sub-dropdown-holder' : '' }}" style="text-transform: capitalize;">
                                                        <a href="#">{{$br_in->brand_name}}</a>
                                                        @if (count($br_in->brand) > 0)
                                                           <ul class="hb-dropdown hb-sub-dropdown">
                                                            @foreach ($br_in->brand as $row)
                                                               <li><a href="{{route('detail.show',[$row->product_slug])}}">{{$row->product_name}}</a></li>
                                                            @endforeach
                                                           </ul>
                                                        @endif
                                                   </li>
                                                @endforeach
                                               </ul>
                                           </li>
                                           <span class="megamenu-static-holder"></span>
                                           <li><a href="{{route('about.index')}}">about</a></li>
                                           <li><a href="{{route('contact.index')}}">contact</a></li>

                                       </ul>
                                   </nav>
                               </div>
                               <!-- Header Bottom Menu Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Bottom Area End Here -->
                <!-- Begin Mobile Menu Area -->
                <div class="mobile-menu-area mobile-menu-area-4 d-lg-none d-xl-none col-12">
                    <div class="container"> 
                        <div class="row">
                            <div class="mobile-menu">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Area End Here -->
            </header>
            <!-- Header Area End Here -->
            @yield('content')

            <!-- Begin Footer Area -->
            <div class="footer">
                <!-- Begin Footer Static Top Area -->
                <div class="footer-static-top">
                    <div class="container">
                        <!-- Begin Footer Shipping Area -->
                        <div class="footer-shipping pt-60 pb-25">
                            <div class="row">
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{asset('frontend/images/shipping-icon/1.png')}}" alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Free Delivery</h2>
                                            <p>And free returns. See checkout for delivery dates.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{asset('frontend/images/shipping-icon/2.png')}}" alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Safe Payment</h2>
                                            <p>Pay with the world's most popular and secure payment methods.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{asset('frontend/images/shipping-icon/3.png')}}" alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>Shop with Confidence</h2>
                                            <p>Our Buyer Protection covers your purchasefrom click to delivery.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                                <!-- Begin Li's Shipping Inner Box Area -->
                                <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                                    <div class="li-shipping-inner-box">
                                        <div class="shipping-icon">
                                            <img src="{{asset('frontend/images/shipping-icon/4.png')}}" alt="Shipping Icon">
                                        </div>
                                        <div class="shipping-text">
                                            <h2>24/7 Help Center</h2>
                                            <p>Have a question? Call a Specialist or chat online.</p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Li's Shipping Inner Box Area End Here -->
                            </div>
                        </div>
                        <!-- Footer Shipping Area End Here -->
                    </div>
                </div>
                <!-- Footer Static Top Area End Here -->
                <!-- Begin Footer Static Middle Area -->
                <div class="footer-static-middle">
                    <div class="container">
                        <div class="footer-logo-wrap pt-50 pb-35">
                            <div class="row">
                                <!-- Begin Footer Logo Area -->
                                <div class="col-lg-4 col-md-6">
                                    <div class="footer-logo">
                                        <img src="{{asset('frontend/images/menu/logo/1.png')}}" alt="Footer Logo">
                                        <p class="info">
                                            We are a team of designers and developers that create high quality HTML Template & Woocommerce, Shopify Theme.
                                        </p>
                                    </div>
                                    <ul class="des">
                                        <li>
                                            <span>Address: </span>
                                            6688Princess Road, London, Greater London BAS 23JK, UK
                                        </li>
                                        <li>
                                            <span>Phone: </span>
                                            <a href="#">(+123) 123 321 345</a>
                                        </li>
                                        <li>
                                            <span>Email: </span>
                                            <a href="mailto://info@yourdomain.com">info@yourdomain.com</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Footer Logo Area End Here -->
                                <!-- Begin Footer Block Area -->
                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <div class="footer-block">
                                        <h3 class="footer-block-title">Product</h3>
                                        <ul>
                                            <li><a href="#">Prices drop</a></li>
                                            <li><a href="#">New products</a></li>
                                            <li><a href="#">Best sales</a></li>
                                            <li><a href="#">Contact us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Footer Block Area End Here -->
                                <!-- Begin Footer Block Area -->
                                <div class="col-lg-2 col-md-3 col-sm-6">
                                    <div class="footer-block">
                                        <h3 class="footer-block-title">Our company</h3>
                                        <ul>
                                            <li><a href="#">Delivery</a></li>
                                            <li><a href="#">Legal Notice</a></li>
                                            <li><a href="#">About us</a></li>
                                            <li><a href="#">Contact us</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- Footer Block Area End Here -->
                                <!-- Begin Footer Block Area -->
                                <div class="col-lg-4">
                                    <div class="footer-block">
                                        <h3 class="footer-block-title">Follow Us</h3>
                                        <ul class="social-link">
                                            <li class="twitter">
                                                <a href="https://twitter.com/" data-toggle="tooltip" target="_blank" title="Twitter">
                                                    <i class="fa fa-twitter"></i>
                                                </a>
                                            </li>
                                            <li class="rss">
                                                <a href="https://rss.com/" data-toggle="tooltip" target="_blank" title="RSS">
                                                    <i class="fa fa-rss"></i>
                                                </a>
                                            </li>
                                            <li class="google-plus">
                                                <a href="https://www.plus.google.com/discover" data-toggle="tooltip" target="_blank" title="Google +">
                                                    <i class="fa fa-google-plus"></i>
                                                </a>
                                            </li>
                                            <li class="facebook">
                                                <a href="https://www.facebook.com/" data-toggle="tooltip" target="_blank" title="Facebook">
                                                    <i class="fa fa-facebook"></i>
                                                </a>
                                            </li>
                                            <li class="youtube">
                                                <a href="https://www.youtube.com/" data-toggle="tooltip" target="_blank" title="Youtube">
                                                    <i class="fa fa-youtube"></i>
                                                </a>
                                            </li>
                                            <li class="instagram">
                                                <a href="https://www.instagram.com/" data-toggle="tooltip" target="_blank" title="Instagram">
                                                    <i class="fa fa-instagram"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- Begin Footer Newsletter Area -->
                                    <div class="footer-newsletter">
                                        <h4>Sign up to newsletter</h4>
                                        <form action="#" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="footer-subscribe-form validate" target="_blank" novalidate>
                                           <div id="mc_embed_signup_scroll">
                                              <div id="mc-form" class="mc-form subscribe-form form-group" >
                                                <input id="mc-email" type="email" autocomplete="off" placeholder="Enter your email" />
                                                <button  class="btn" id="mc-submit">Subscribe</button>
                                              </div>
                                           </div>
                                        </form>
                                    </div>
                                    <!-- Footer Newsletter Area End Here -->
                                </div>
                                <!-- Footer Block Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Static Middle Area End Here -->
                <!-- Begin Footer Static Bottom Area -->
                <div class="footer-static-bottom pt-55 pb-55">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Begin Footer Links Area -->
                                <div class="footer-links">
                                    <ul>
                                        <li><a href="#">Online Shopping</a></li>
                                        <li><a href="#">Promotions</a></li>
                                        <li><a href="#">My Orders</a></li>
                                        <li><a href="#">Help</a></li>
                                        <li><a href="#">Customer Service</a></li>
                                        <li><a href="#">Support</a></li>
                                        <li><a href="#">Most Populars</a></li>
                                        <li><a href="#">New Arrivals</a></li>
                                        <li><a href="#">Special Products</a></li>
                                        <li><a href="#">Manufacturers</a></li>
                                        <li><a href="#">Our Stores</a></li>
                                        <li><a href="#">Shipping</a></li>
                                        <li><a href="#">Payments</a></li>
                                        <li><a href="#">Warantee</a></li>
                                        <li><a href="#">Refunds</a></li>
                                        <li><a href="#">Checkout</a></li>
                                        <li><a href="#">Discount</a></li>
                                        <li><a href="#">Refunds</a></li>
                                        <li><a href="#">Policy Shipping</a></li>
                                    </ul>
                                </div>
                                <!-- Footer Links Area End Here -->
                                <!-- Begin Footer Payment Area -->
                                <div class="copyright text-center">
                                    <a href="#">
                                        <img src="{{asset('frontend/images/payment/1.png')}}" alt="">
                                    </a>
                                </div>
                                <!-- Footer Payment Area End Here -->
                                <!-- Begin Copyright Area -->
                                <div class="copyright text-center pt-25">
                                    <span><a href="https://www.templatespoint.net" target="_blank">Templates Point</a></span>
                                </div>
                                <!-- Copyright Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Footer Static Bottom Area End Here -->
            </div>
            <!-- Footer Area End Here -->

            <!-- Begin Quick View | Modal Area -->
            @foreach ($product_modal as $pro_show)
            @php
                $gallery_show = App\Gallery::where('gallery_product_id',$pro_show->product_id)->get();
            @endphp
            <div class="modal fade modal-wrapper" id="quickview_product{{$pro_show->product_id}}" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-inner-area row">
                                <div class="col-lg-5 col-md-6 col-sm-6">
                                   <!-- Product Details Left -->
                                    <div class="product-details-left">
                                        <div class="product-details-images slider-navigation-1">
                                            @foreach ($gallery_show as $img_gall)
                                            <div class="lg-image">
                                                <img src="{{ asset('uploads/gallery/'.$img_gall->gallery_image) }}" alt="{{$img_gall->gallery_name}}" width="335px" height="335px">
                                            </div>
                                            @endforeach
                                        </div>
                                        <div class="product-details-thumbs slider-thumbs-1">    
                                            @foreach ($gallery_show as $img_gall)                                    
                                            <div class="sm-image">
                                                <img src="{{ asset('uploads/gallery/'.$img_gall->gallery_image) }}" alt="{{$img_gall->gallery_name}}" width="77px" height="77px">
                                            </div>
                                            @endforeach

                                        </div>
                                    </div>
                                    <!--// Product Details Left -->
                                </div>

                                <div class="col-lg-7 col-md-6 col-sm-6">
                                    <div class="product-details-view-content pt-60">
                                        <div class="product-info">
                                            <h2>{{$pro_show->product_name}}</h2>
                                            <span class="product-details-ref">Reference: <span style="text-transform: capitalize;">{{$pro_show->brandproduct->brand_name}}</span></span>
                                            <div class="rating-box pt-20">
                                                @php
                                                    $rating_avg = App\Review::where('review_id_product',$pro_show->product_id)->avg('rating');
                                                @endphp
                                                <ul class="rating rating-with-review-item">
                                                    @if (round($rating_avg) > 0)
                                                    @for ($i = 0; $i < round($rating_avg); $i++)
                                                        <li><i class="fa fa-star-o"></i></li>
                                                    @endfor
                                                    @for ($j = round($rating_avg); $j < 5; $j++)
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    @endfor
                                                    @else
                                                        <li style="font-size: 12px;color: #a8acaf;">No Rating</li>
                                                    @endif
                                                    <li class="review-item"><a href="#">Read Review</a></li>
                                                    <li class="review-item"><a href="#">Write Review</a></li>
                                                </ul>
                                            </div>
                                            <div class="price-box pt-20">
                                                <span class="new-price new-price-2">
                                                    @if($pro_show->promotion_price !=0)
                                                        {{number_format($pro_show->promotion_price,0,',','.')}} VNĐ
                                                    @else
                                                        {{number_format($pro_show->product_price,0,',','.')}} VNĐ
                                                    @endif
                                                </span>
                                            </div>
                                            <div class="product-desc">
                                                <p>
                                                    <span>{!!substr($pro_show->product_desc,0,220)!!}</span>
                                                </p>
                                            </div>
                                            <div class="single-add-to-cart">
                                                <form class="cart-quantity" method="POST" id="show_form_add_cart{{$pro_show->product_id}}">
                                                    <input type="hidden" id="show_product_id_hidden{{$pro_show->product_id}}" name="show_product_id_hidden" value="{{$pro_show->product_id}}">
                                                    <div class="quantity">
                                                        <label>Quantity</label>
                                                        <div class="cart-plus-minus {{ $pro_show->product_quantity != 0 ? '' : 'disabled-div' }}">
                                                            <input class="cart-plus-minus-box" value="{{ $pro_show->product_quantity != 0 ? '1' : '0' }}" type="number" id="cartqty_show{{$pro_show->product_id}}" name="qty_price" oninput="validity.valid||(value='');">
                                                            <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                            <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                        </div>
                                                    </div>
                                                    <button class="add-to-cart" {{ $pro_show->product_quantity != 0 ? '' : 'disabled' }} type="submit">Add to cart</button>
                                                </form>
                                            </div>
                                            <div class="product-additional-info pt-25">
                                                @if (Auth::user())
                                                    <a class="wishlist-btn wish-check-2" data-wish_id="{{$pro_show->product_id}}" href="#">
                                                        <?php $pro_wish = App\Wishlist::where('id_user',Auth::id())->where('id_product',$pro_show->product_id)->first(); ?>
                                                        @if ($pro_wish && $pro_wish->wish_status ==0)
                                                            <i style="color: red;" class="fa fa-heart"></i>Add to wishlist
                                                        @else
                                                            <i class="fa fa-heart-o"></i>Add to wishlist
                                                        @endif

                                                    </a>
                                                @else
                                                    <a class="wishlist-btn" href="{{ route('login.index') }}">
                                                        <i class="fa fa-heart-o"></i>Add to wishlist
                                                    </a>
                                                @endif
                                                <div class="product-social-sharing pt-25">
                                                    <ul>
                                                        <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                        <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                        <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                        <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                                    </ul>
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
            @endforeach
            <!-- Quick View | Modal Area End Here -->

            {{-- Update Profile --}}
            @if(Auth::user())
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('sign-up.update',Auth::id())}}" method="post">
                        @method('PUT')
                        @csrf
                        <div class="modal-body">
                            <div class="div-avatar">
                                @if ($update_user->social_id != '')
                                <img src="{{$update_user->image_user}}" alt="Avatar" class="avatar">
                                @else
                                <img src="{{ asset('uploads/profile/'.$update_user->image_user) }}" alt="Avatar" class="avatar">
                                @endif
                                
                            </div>
                            <style type="text/css">
                                .div-avatar{
                                    text-align: center;
                                }
                                .avatar {
                                    vertical-align: middle;
                                    width: 23%;
                                    height: 100px;
                                    border-radius: 50%;
                                    border: 1px solid #f8f9f9;
                                }
                                .hover:hover{
                                    color: #fff;
                                }
                            </style>
                            
                                
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Name:</label>
                                <input type="text" class="form-control" id="recipient-name" name="name" value="{{$update_user->name}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">SĐT:</label>
                                <input type="tel" class="form-control" id="recipient-name" name="phone" value="{{$update_user->phone}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Email:</label>
                                <input type="email" class="form-control" id="recipient-name" name="email" value="{{$update_user->email}}">
                            </div>
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Password:</label>
                                <input type="text" class="form-control" id="recipient-name" name="password">
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Address:</label>
                                <textarea class="form-control" id="message-text" name="address">{{$update_user->address}}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-warning hover">Send Update</button>
                        </div>
                  </form>
                </div>
              </div>
            </div>
            @endif

            <style type="text/css">
                a.disabled {
                  pointer-events: none;
                  cursor: default;
                  background: #F9E575;
                  border-color: #F9E575;
                }
                .disabled-div {
                  pointer-events: none;
                }
            </style>
        </div>
        <?php Session::forget('url_shopping'); ?>
        <!-- Body Wrapper End Here -->
        <!-- jQuery-V1.12.4 -->
        <script src="{{asset('frontend/js/vendor/jquery-1.12.4.min.js')}}"></script>
        <!-- Popper js -->
        <script src="{{asset('frontend/js/vendor/popper.min.js')}}"></script>
        <!-- Bootstrap V4.1.3 Fremwork js -->
        <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
        <!-- Ajax Mail js -->
        <script src="{{asset('frontend/js/ajax-mail.js')}}"></script>
        <!-- Meanmenu js -->
        <script src="{{asset('frontend/js/jquery.meanmenu.min.js')}}"></script>
        <!-- Wow.min js -->
        <script src="{{asset('frontend/js/wow.min.js')}}"></script>
        <!-- Slick Carousel js -->
        <script src="{{asset('frontend/js/slick.min.js')}}"></script>
        <!-- Owl Carousel-2 js -->
        <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
        <!-- Magnific popup js -->
        <script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
        <!-- Isotope js -->
        <script src="{{asset('frontend/js/isotope.pkgd.min.js')}}"></script>
        <!-- Imagesloaded js -->
        <script src="{{asset('frontend/js/imagesloaded.pkgd.min.js')}}"></script>
        <!-- Mixitup js -->
        <script src="{{asset('frontend/js/jquery.mixitup.min.js')}}"></script>
        <!-- Countdown -->
        <script src="{{asset('frontend/js/jquery.countdown.min.js')}}"></script>
        <!-- Counterup -->
        <script src="{{asset('frontend/js/jquery.counterup.min.js')}}"></script>
        <!-- Waypoints -->
        <script src="{{asset('frontend/js/waypoints.min.js')}}"></script>
        <!-- Barrating -->
        <script src="{{asset('frontend/js/jquery.barrating.min.js')}}"></script>
        <!-- Jquery-ui -->
        <script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
        <!-- Venobox -->
        <script src="{{asset('frontend/js/venobox.min.js')}}"></script>
        <!-- Nice Select js -->
        <script src="{{asset('frontend/js/jquery.nice-select.min.js')}}"></script>
        <!-- ScrollUp js -->
        <script src="{{asset('frontend/js/scrollUp.min.js')}}"></script>
        <!-- Main/Activator js -->
        <script src="{{asset('frontend/js/main.js')}}"></script>

        <!-- Data Countdown -->
        <script type="text/javascript">
            $('[data-countdown]').each(function() {
              var $this = $(this), finalDate = $(this).data('countdown');
              $this.countdown(finalDate, function(event) {
                $this.html(event.strftime('%D days %H:%M:%S'));
              });
            });
            // Load Cart
            function load_cart(){
                $.ajax({
                    type: 'get',
                    url: '{{ route('about.create') }}',
                    dataType: 'json',
                    success:function(response){
                        $('#load_count_cart').html(response.output_count);
                        $('#load_sub_cart').html(response.output_sub);
                        $('#load_product_cart').html(response.output);
                    }
                });
            }
        </script>
        
        <script type="text/javascript">
            $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                // Add Cart Show
                @foreach ($product_modal as $pro_show)
                $(document).on('submit','#show_form_add_cart{{$pro_show->product_id}}',function(e){
                    e.preventDefault();
                    var product_id_hidden = $('#show_product_id_hidden{{$pro_show->product_id}}').val();
                    var qty_price = $('#cartqty_show{{$pro_show->product_id}}').val();

                    $.ajax({
                        type: 'post',
                        url: '{{ route('shopping-cart.store') }}',
                        data:{product_id_hidden:product_id_hidden,qty_price:qty_price},
                        dataType: 'json',
                        success:function(response){
                            load_cart();
                            $('#cartqty_show{{$pro_show->product_id}}').val(1);
                            toastr.success(response.message, 'Notification',{timeOut: 7000});
                        }
                    });
                });
                @endforeach
                load_cart();
                // Add Cart Ajax
                $(document).on('click','.add_cart',function(e){
                    e.preventDefault();
                    var url_show = $(this).data('href');

                    $.ajax({
                        type: 'get',
                        url: url_show,
                        dataType: 'json',
                        success:function(response){
                            load_cart();
                            toastr.success(response.message,'Notification',{timeOut: 7000});
                        }
                    });
                });
                // Delete Cart Ajax
                $(document).on('click','.remove_cart_rowId',function(e){
                    var href_rowid = $(this).data('href_rowid');

                    $.ajax({
                        type: 'get',
                        url: href_rowid,
                        success:function(response){
                            load_cart();
                        }
                    });
                });
                @if (Auth::user())
                AutoWish();
                function AutoWish() {
                    $.ajax({
                        url : '{{route('search.store')}}',
                        method: 'POST',
                        success:function(response){
                            $('#total_wish').text(response.data);
                            $('#list_wish').html(response.output);
                        }
                    });
                }
                @endif
                // Wishlist
                $(document).on('click','.wish-check',function(e){
                    e.preventDefault();
                    var id = $(this).data('id');
                    
                    $.ajax({
                        type: 'post',
                        url: '{{ route('wishlist.store') }}',
                        data: {id:id},
                        success:function(response){
                            // location.reload();
                            if (response.action == 'add') {
                                $('a[data-id='+id+']').html(`<i style="color: red;" class="fa fa-heart"></i>`);
                                $('a[data-wish_id='+id+']').html(`<i style="color: red;" class="fa fa-heart"></i>Add to wishlist`);
                                AutoWish();
                            }else{
                                $('a[data-id='+id+']').html(`<i class="fa fa-heart-o"></i>`);
                                $('a[data-wish_id='+id+']').html(`<i class="fa fa-heart-o"></i>Add to wishlist`);
                                AutoWish();
                            }
                        }
                    });
                });
                $(document).on('click','.wish-check-2',function(e){
                    e.preventDefault();
                    var id = $(this).data('wish_id');
                    
                    $.ajax({
                        type: 'post',
                        url: '{{ route('wishlist.store') }}',
                        data: {id:id},
                        success:function(response){
                            if (response.action == 'add') {
                                $('a[data-wish_id='+id+']').html(`<i style="color: red;" class="fa fa-heart"></i>Add to wishlist`);
                                $('a[data-id='+id+']').html(`<i style="color: red;" class="fa fa-heart"></i>`);
                                AutoWish();
                            }else{
                                $('a[data-wish_id='+id+']').html(`<i class="fa fa-heart-o"></i>Add to wishlist`);
                                $('a[data-id='+id+']').html(`<i class="fa fa-heart-o"></i>`);
                                AutoWish();
                            }
                        }
                    });
                });
                // Change city
                $('.choose').on('change',function(){
                    var action = $(this).attr('id');
                    var ma_id = $(this).val();
                    var _token = $('input[name="_token"]').val();
                    var result = '';
                   

                    if(action=='city'){
                        result = 'province';
                    }else{
                        result = 'wards';
                    }

                    $.ajax({
                        url : '{{route('show-checkout.store')}}',
                        method: 'POST',
                        data:{action:action,ma_id:ma_id,_token:_token},
                        success:function(data){
                           $('#'+result).html(data);     
                        }
                    });
                    
                });

            });
          
        </script>
        
        @yield('script')
        <!-- plugin facebook -->
        <div id="fb-root"></div>
        <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v10.0" nonce="3Gf0BF4H"></script>
        <script type="text/javascript">
            jQuery(document).ready(function($) {
                 $('.share').click(function() {
                     var NWin = window.open($(this).prop('href'), '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=300,width=600');
                     if (window.focus)
                 {
                 NWin.focus();
                 }
                 return false;
                 });
            });
        </script>
        <!-- Load Facebook SDK for JavaScript -->
        <div id="fb-root"></div>
        <script>
          window.fbAsyncInit = function() {
            FB.init({
              xfbml            : true,
              version          : 'v10.0'
            });
          };

          (function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
        </script>

        <!-- Notification -->
        <script src="{{asset('frontend/login/toastr.min.js') }}"></script>

        <script type="text/javascript">
        @if(session('thongbao'))
  
            toastr.success('{{ session('thongbao') }}', 'Notification',{timeOut: 7000});

        @endif 
        @if(session('message'))
  
            toastr.success('{{ session('message') }}', 'Notification',{timeOut: 7000});

        @endif 
        @if(session('message_err'))
  
            toastr.error('{{ session('message_err') }}', 'Notification',{timeOut: 7000});

        @endif 
        @if(session('message_login'))
  
            toastr.error('{{ session('message_login') }}', '<a style="color: #fff" href="{{route('login.index')}}">Click Me Đăng Nhập</a>',{timeOut: 7000});

        @endif 
        @if($errors->any()) 
          @foreach($errors->all() as $err)
            
            toastr.error('{{$err}}', 'Notification',{timeOut: 7000});
          @endforeach
        @endif
        </script>
    </body>

<!-- index-431:47-->
</html>
