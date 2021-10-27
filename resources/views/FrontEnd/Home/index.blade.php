@extends('LayoutUser')
@section('title')    
  Home
@endsection
@section('content')

            <!-- Begin Slider With Banner Area -->
            <div class="slider-with-banner">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                           <!--Category Menu Start-->
                           <div class="category-menu">
                              <div class="category-heading">
                                 <h2 class="categories-toggle"><span>categories</span></h2>
                              </div>
                              <div id="cate-toggle" class="category-menu-list">
                                 <ul>
                                    @foreach($category_in as $cate_in)
                                    @if (count($cate_in->category) > 0)
                                    <li class="right-menu">
                                       <a href="{{route('danh-muc.show',[$cate_in->slug_category_product])}}">{{$cate_in->category_name}}</a>
                                       <ul class="cat-mega-menu" style="">
                                          <li class="right-menu cat-mega-title">
                                             <a href="shop-left-sidebar.html">Products</a>
                                             <ul style="text-transform: capitalize;">
                                                @foreach ($cate_in->category as $value)
                                                    <li><a href="{{route('detail.show',[$value->product_slug])}}">{{$value->product_name}}</a></li>
                                                @endforeach
                                             </ul>
                                          </li>
                                          <li class="right-menu cat-mega-title">
                                             <a href="shop-left-sidebar.html">Brand</a>
                                             <ul style="text-transform: capitalize;">
                                                @foreach ($cate_in->category as $value_1)
                                                    <li><a href="#">{{$value_1->brandproduct->brand_name}}</a></li>
                                                @endforeach
                                             </ul>
                                          </li>
                                          <li class="right-menu cat-mega-title">
                                             <a href="shop-left-sidebar.html">category</a>
                                             <ul style="text-transform: capitalize;">
                                                @foreach ($cate_in->category as $value_2)
                                                    <li><a href="{{route('danh-muc.show',[$value_2->pro_cate->slug_category_product])}}">{{$value_2->pro_cate->category_name}}</a></li>
                                                @endforeach
                                             </ul>
                                          </li>
                                       </ul>
                                    </li>
                                    @else
                                    <li><a href="{{route('danh-muc.show',[$cate_in->slug_category_product])}}">{{$cate_in->category_name}}</a></li>
                                    @endif
                                    @endforeach
                                    {{-- <li><a href="#">Cameras</a></li> --}}
                                    @if (count($category_in) == 8)
                                    @foreach ($category_next as $row)
                                    @if (count($row->category) > 0)
                                    <li class="rx-child right-menu">
                                       <a href="{{route('danh-muc.show',[$row->slug_category_product])}}">{{$row->category_name}}</a>
                                       <ul class="cat-mega-menu" style="">
                                          <li class="right-menu cat-mega-title">
                                             <a href="shop-left-sidebar.html">Products</a>
                                             <ul style="text-transform: capitalize;">
                                                @foreach ($row->category as $value)
                                                    <li><a href="{{route('detail.show',[$value->product_slug])}}">{{$value->product_name}}</a></li>
                                                @endforeach
                                             </ul>
                                          </li>
                                          <li class="right-menu cat-mega-title">
                                             <a href="shop-left-sidebar.html">Brand</a>
                                             <ul style="text-transform: capitalize;">
                                                @foreach ($row->category as $value_1)
                                                    <li><a href="#">{{$value_1->brandproduct->brand_name}}</a></li>
                                                @endforeach
                                             </ul>
                                          </li>
                                          <li class="right-menu cat-mega-title">
                                             <a href="shop-left-sidebar.html">category</a>
                                             <ul style="text-transform: capitalize;">
                                                @foreach ($row->category as $value_2)
                                                    <li><a href="{{route('danh-muc.show',[$value_2->pro_cate->slug_category_product])}}">{{$value_2->pro_cate->category_name}}</a></li>
                                                @endforeach
                                             </ul>
                                          </li>
                                       </ul>
                                    </li>
                                    @else
                                    <li class="rx-child"><a href="{{route('danh-muc.show',[$row->slug_category_product])}}">{{$row->category_name}}</a></li>
                                    @endif
                                    @endforeach
                                    <li class="rx-parent">
                                       <a class="rx-default">More Categories</a>
                                       <a class="rx-show">Less Categories</a>
                                    </li>
                                    @endif

                                 </ul>
                              </div>
                           </div>
                           <!--Category Menu End-->
                        </div>
                        <!-- Begin Slider Area -->
                        <div class="col-lg-9">
                            <div class="slider-area pt-sm-30 pt-xs-30">
                                <div class="slider-active owl-carousel">
                                    <!-- Begin Single Slide Area -->
                                    @foreach($bannes as $banner)
                                    <div class="single-slide align-center-left animation-style-01">
                                    	<img class="bg-1" src="{{asset('uploads/slider/'.$banner->slider_image)}}" height="475px">
                                        <div class="slider-progress"></div>
                                        <div class="slider-content">
                                            <h5>Sale Offer <span>-20% Off</span> This Week</h5>
                                            <h2>{{$banner->slider_name}}</h2>
                                            <h3>Starting at <span>{!!$banner->slider_desc!!}</span></h3>
                                            <div class="default-btn slide-btn">
                                                <a class="links" href="{{$banner->slider_links}}" target="_blank">Shopping Now</a>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    <!-- Single Slide Area End Here -->
                                </div>
                            </div>
                        </div>
                        <!-- Slider Area End Here -->
                        <!-- Begin Li Banner Area -->
                        <!-- Li Banner Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Slider With Banner Area End Here -->
            <!-- Begin Static Top Area -->
            <div class="li-static-banner pt-20 pt-sm-30 pt-xs-30">
               <div class="container">
                  <div class="row">
                     <!-- Begin Single Banner Area -->
                     <div class="col-lg-4 col-md-4">
                        <div class="single-banner pb-xs-30">
                           <a href="#">
                           <img src="{{ asset('frontend/images/banner/1_3.jpg') }} " alt="Li's Static Banner">
                           </a>
                        </div>
                     </div>
                     <!-- Single Banner Area End Here -->
                     <!-- Begin Single Banner Area -->
                     <div class="col-lg-4 col-md-4">
                        <div class="single-banner pb-xs-30">
                           <a href="#">
                           <img src="{{ asset('frontend/images/banner/1_4.jpg') }} " alt="Li's Static Banner">
                           </a>
                        </div>
                     </div>
                     <!-- Single Banner Area End Here -->
                     <!-- Begin Single Banner Area -->
                     <div class="col-lg-4 col-md-4">
                        <div class="single-banner">
                           <a href="#">
                           <img src="{{ asset('frontend/images/banner/1_5.jpg') }} " alt="Li's Static Banner">
                           </a>
                        </div>
                     </div>
                     <!-- Single Banner Area End Here -->
                  </div>
               </div>
            </div>
            <!-- Static Top Area End Here -->
            <!-- Begin Li's Special Product Area -->
            @if (count($product_sales)>0)
            <section class="product-area li-laptop-product Special-product pt-60 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Hot Deals Products</span>
                                </h2>
                            </div>
                            <div class="row">
                                <div class="special-product-active owl-carousel">
                                    @foreach($product_sales as $pro_sale)
                                    @php
                                        $hour_now = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('H:m');
                                        $day_now = Carbon\Carbon::now('Asia/Ho_Chi_Minh')->format('Y/m/d');
                                    @endphp
                                    @if ($pro_sale->product_date_sale > $day_now)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('detail.show',[$pro_sale->product_slug])}}">
                                                    <img src="{{asset('uploads/product/'.$pro_sale->product_image)}}" alt="{{$pro_sale->product_content}}" width="285px" height="285px">
                                                </a>
                                                @if ($pro_sale->product_date_sale >= $startOfWeek && $pro_sale->product_date_sale <= $endOfWeek && $pro_sale->promotion_price == 0)
                                                    <span class="sticker">New</span>
                                                @elseif ($pro_sale->product_date_sale >= $startOfWeek && $pro_sale->product_date_sale <= $endOfWeek && $pro_sale->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @elseif($pro_sale->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @else
                                                    <span></span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="shop-left-sidebar.html">{{$pro_sale->brandproduct->brand_name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            @php
                                                                $rating_avg = App\Review::where('review_id_product',$pro_sale->product_id)->avg('rating');
                                                            @endphp
                                                            <ul class="rating">
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
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="{{route('detail.show',[$pro_sale->product_slug])}}">{{$pro_sale->product_name}}</a></h4>
                                                    <div class="price-box">
                                                        @if($pro_sale->promotion_price !=0)
                                                            {{number_format($pro_sale->promotion_price,0,',','.')}} VNĐ
                                                        @else
                                                            {{number_format($pro_sale->product_price,0,',','.')}} VNĐ
                                                        @endif
                                                        </span>
                                                        @if($pro_sale->promotion_price !=0)
                                                            <span class="old-price">    {{number_format($pro_sale->product_price,0,',','.')}}
                                                            </span>
                                                        @endif
                                                        @if($pro_sale->promotion_price !=0)
                                                             <span class="discount-percentage">-{{number_format(100-($pro_sale->promotion_price/$pro_sale->product_price)*100)}}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="countersection">
                                                        <div class="li-countdown" data-countdown="{{$pro_sale->product_date_sale}} {{$pro_sale->product_hour_sale}}"></div>
                                                    </div>

                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active">
                                                            <a style="cursor: pointer;" class="{{ $pro_sale->product_quantity != 0 ? '' : 'disabled' }} add_cart" data-href="{{ route('shopping-cart.show',$pro_sale->product_id) }}">Add to cart</a>
                                                        </li>
                                                        <li>
                                                            @if (Auth::user())
                                                                <a class="links-details wish-check" data-id="{{$pro_sale->product_id}}" href="#">
                                                                    <?php $pro_wish = App\Wishlist::where('id_user',Auth::id())->where('id_product',$pro_sale->product_id)->first(); ?>
                                                                    @if ($pro_wish && $pro_wish->wish_status ==0)
                                                                        <i style="color: red;" class="fa fa-heart"></i>
                                                                    @else
                                                                        <i class="fa fa-heart-o"></i>
                                                                    @endif
                                                                    
                                                                </a>
                                                            @else
                                                                <a class="links-details" href="{{ route('login.index') }}">
                                                                    <i class="fa fa-heart-o"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" 
                                                        data-target="#quickview_product{{$pro_sale->product_id}}"
                                                        ><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @else
                                    @if ($pro_sale->product_hour_sale >= $hour_now)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('detail.show',[$pro_sale->product_slug])}}">
                                                    <img src="{{asset('uploads/product/'.$pro_sale->product_image)}}" alt="{{$pro_sale->product_content}}" width="285px" height="285px">
                                                </a>
                                                @if ($pro_sale->product_date_sale >= $startOfWeek && $pro_sale->product_date_sale <= $endOfWeek && $pro_sale->promotion_price == 0)
                                                    <span class="sticker">New</span>
                                                @elseif ($pro_sale->product_date_sale >= $startOfWeek && $pro_sale->product_date_sale <= $endOfWeek && $pro_sale->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @elseif($pro_sale->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @else
                                                    <span></span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="shop-left-sidebar.html">{{$pro_sale->brandproduct->brand_name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            @php
                                                                $rating_avg = App\Review::where('review_id_product',$pro_sale->product_id)->avg('rating');
                                                            @endphp
                                                            <ul class="rating">
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
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="{{route('detail.show',[$pro_sale->product_slug])}}">{{$pro_sale->product_name}}</a></h4>
                                                    <div class="price-box">
                                                        @if($pro_sale->promotion_price !=0)
                                                            {{number_format($pro_sale->promotion_price,0,',','.')}} VNĐ
                                                        @else
                                                            {{number_format($pro_sale->product_price,0,',','.')}} VNĐ
                                                        @endif
                                                        </span>
                                                        @if($pro_sale->promotion_price !=0)
                                                            <span class="old-price">    {{number_format($pro_sale->product_price,0,',','.')}}
                                                            </span>
                                                        @endif
                                                        @if($pro_sale->promotion_price !=0)
                                                             <span class="discount-percentage">-{{number_format(100-($pro_sale->promotion_price/$pro_sale->product_price)*100)}}%</span>
                                                        @endif
                                                    </div>
                                                    <div class="countersection">
                                                        <div class="li-countdown" data-countdown="{{$pro_sale->product_date_sale}} {{$pro_sale->product_hour_sale}}"></div>
                                                    </div>

                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active">
                                                            <a style="cursor: pointer;" class="{{ $pro_sale->product_quantity != 0 ? '' : 'disabled' }} add_cart" data-href="{{ route('shopping-cart.show',$pro_sale->product_id) }}">Add to cart</a>
                                                        </li>
                                                        <li>
                                                            @if (Auth::user())
                                                                <a class="links-details wish-check" data-id="{{$pro_sale->product_id}}" href="#">
                                                                    <?php $pro_wish = App\Wishlist::where('id_user',Auth::id())->where('id_product',$pro_sale->product_id)->first(); ?>
                                                                    @if ($pro_wish && $pro_wish->wish_status ==0)
                                                                        <i style="color: red;" class="fa fa-heart"></i>
                                                                    @else
                                                                        <i class="fa fa-heart-o"></i>
                                                                    @endif
                                                                    
                                                                </a>
                                                            @else
                                                                <a class="links-details" href="{{ route('login.index') }}">
                                                                    <i class="fa fa-heart-o"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" 
                                                        data-target="#quickview_product{{$pro_sale->product_id}}"
                                                        ><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
            @endif
            <!-- Li's Special Product Area End Here -->
            @if (count($product_sales)>0)
            <!-- Begin Li's Static Banner Area -->
            <div class="li-static-banner li-static-banner-4 text-center pt-20">
                <div class="container">
                    <div class="row">
                        <!-- Begin Single Banner Area -->
                        <div class="col-lg-6">
                            <div class="single-banner pb-sm-30 pb-xs-30">
                                <a href="#">
                                    <img src="{{asset('frontend/images/banner/2_3.jpg')}}" alt="Li's Static Banner">
                                </a>
                            </div>
                        </div>
                        <!-- Single Banner Area End Here -->
                        <!-- Begin Single Banner Area -->
                        <div class="col-lg-6">
                            <div class="single-banner">
                                <a href="#">
                                    <img src="{{asset('frontend/images/banner/2_4.jpg')}}" alt="Li's Static Banner">
                                </a>
                            </div>
                        </div>
                        <!-- Single Banner Area End Here -->
                    </div>
                </div>
            </div>
            @endif
            <!-- Li's Static Banner Area End Here -->
            <!-- Begin Li's Laptop Product Area -->
            <section class="product-area li-laptop-product pt-60 pb-45 pt-sm-50 pt-xs-60">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2 style="text-transform: capitalize;">
                                    <span>Buy A Lot</span>
                                </h2>
{{--                                 <ul class="li-sub-category-list">
                                    <li class="active"><a href="shop-left-sidebar.html">Prime Video</a></li>
                                    <li><a href="shop-left-sidebar.html">Computers</a></li>
                                    <li><a href="shop-left-sidebar.html">Electronics</a></li>
                                </ul> --}}
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach($products as $product)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('detail.show',[$product->product_slug])}}">
                                                    <img src="{{asset('uploads/product/'.$product->product_image)}}" alt="{{$product->product_content}}" width="216px" height="216px">
                                                </a>
                                                @if ($product->product_date_sale >= $startOfWeek && $product->product_date_sale <= $endOfWeek && $product->promotion_price == 0)
                                                    <span class="sticker">New</span>
                                                @elseif ($product->product_date_sale >= $startOfWeek && $product->product_date_sale <= $endOfWeek && $product->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @elseif($product->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @else
                                                    <span></span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="product-details.html">{{$product->brandproduct->brand_name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            @php
                                                                $rating_avg = App\Review::where('review_id_product',$product->product_id)->avg('rating');
                                                            @endphp
                                                            <ul class="rating">
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
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="{{route('detail.show',[$product->product_slug])}}">{{$product->product_name}}</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">
                                                        @if($product->promotion_price !=0)
                                                            {{number_format($product->promotion_price,0,',','.')}} VNĐ
                                                        @else
                                                            {{number_format($product->product_price,0,',','.')}} VNĐ
                                                        @endif
                                                        </span>
                                                        @if($product->promotion_price !=0)
                                                            <span class="old-price">    {{number_format($product->product_price,0,',','.')}}
                                                            </span>
                                                        @endif
                                                        @if($product->promotion_price !=0)
                                                             <span class="discount-percentage">-{{number_format(100-($product->promotion_price/$product->product_price)*100)}}%</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active">
                                                            <a style="cursor: pointer;" class="{{ $product->product_quantity != 0 ? '' : 'disabled' }} add_cart" data-href="{{ route('shopping-cart.show',$product->product_id) }}">Add to cart</a>
                                                        </li>
                                                        <li>
                                                            @if (Auth::user())
                                                                <a class="links-details wish-check" data-id="{{$product->product_id}}" href="#">
                                                                    <?php $pro_wish = App\Wishlist::where('id_user',Auth::id())->where('id_product',$product->product_id)->first(); ?>
                                                                    @if ($pro_wish && $pro_wish->wish_status ==0)
                                                                        <i style="color: red;" class="fa fa-heart"></i>
                                                                    @else
                                                                        <i class="fa fa-heart-o"></i>
                                                                    @endif
                                                                    
                                                                </a>
                                                            @else
                                                                <a class="links-details" href="{{ route('login.index') }}">
                                                                    <i class="fa fa-heart-o"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal" data-target="#quickview_product{{$product->product_id}}" href="#"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
            <!-- Li's Laptop Product Area End Here -->
            <!-- Begin Li's TV & Audio Product Area -->
            <section class="product-area li-laptop-product li-tv-audio-product pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>Views</span>
                                </h2>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                    @foreach($product_all as $pro_all)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('detail.show',[$pro_all->product_slug])}}">
                                                    <img src="{{asset('uploads/product/'.$pro_all->product_image)}}" alt="{{$pro_all->product_content}}" width="216px" height="216px">
                                                </a>
                                                @if ($pro_all->product_date_sale >= $startOfWeek && $pro_all->product_date_sale <= $endOfWeek && $pro_all->promotion_price == 0)
                                                    <span class="sticker">New</span>
                                                @elseif ($pro_all->product_date_sale >= $startOfWeek && $pro_all->product_date_sale <= $endOfWeek && $pro_all->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @elseif($pro_all->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @else
                                                    <span></span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="product-details.html">{{$pro_all->brandproduct->brand_name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            @php
                                                                $rating_avg = App\Review::where('review_id_product',$pro_all->product_id)->avg('rating');
                                                            @endphp
                                                            <ul class="rating">
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
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="{{route('detail.show',[$pro_all->product_slug])}}">{{$pro_all->product_name}}</a></h4>
                                                    <div class="price-box">
                                                        <span class="new-price">
                                                        @if($pro_all->promotion_price !=0)
                                                            {{number_format($pro_all->promotion_price,0,',','.')}} VNĐ
                                                        @else
                                                            {{number_format($pro_all->product_price,0,',','.')}} VNĐ
                                                        @endif
                                                        </span>
                                                        @if($pro_all->promotion_price !=0)
                                                            <span class="old-price">    {{number_format($pro_all->product_price,0,',','.')}}
                                                            </span>
                                                        @endif
                                                        @if($pro_all->promotion_price !=0)
                                                             <span class="discount-percentage">-{{number_format(100-($pro_all->promotion_price/$pro_all->product_price)*100)}}%</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active">
                                                            <a style="cursor: pointer;" class="{{ $pro_all->product_quantity != 0 ? '' : 'disabled' }} add_cart" data-href="{{ route('shopping-cart.show',$pro_all->product_id) }}">Add to cart</a>
                                                        </li>
                                                        <li>
                                                            @if (Auth::user())
                                                                <a class="links-details wish-check" data-id="{{$pro_all->product_id}}" href="#">
                                                                    <?php $pro_wish = App\Wishlist::where('id_user',Auth::id())->where('id_product',$pro_all->product_id)->first(); ?>
                                                                    @if ($pro_wish && $pro_wish->wish_status ==0)
                                                                        <i style="color: red;" class="fa fa-heart"></i>
                                                                    @else
                                                                        <i class="fa fa-heart-o"></i>
                                                                    @endif
                                                                    
                                                                </a>
                                                            @else
                                                                <a class="links-details" href="{{ route('login.index') }}">
                                                                    <i class="fa fa-heart-o"></i>
                                                                </a>
                                                            @endif
                                                        </li>
                                                        <li><a class="quick-view" data-toggle="modal" data-target="#quickview_product{{$pro_all->product_id}}" href="#"><i class="fa fa-eye"></i></a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
            <!-- Li's TV & Audio Product Area End Here -->
            <!-- Begin Li's Static Home Area -->
            <div class="li-static-home">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Li's Static Home Image Area -->
                            <div class="li-static-home-image"></div>
                            <!-- Li's Static Home Image Area End Here -->
                            <!-- Begin Li's Static Home Content Area -->
                            <div class="li-static-home-content">
                                <p>Sale Offer<span>-20% Off</span>This Week</p>
                                <h2>{{$bannes_new->slider_name}}</h2>
                                <p class="schedule">
                                    Starting at
                                    <span>{!! $bannes_new->slider_desc !!}</span>
                                </p>
                                <div class="default-btn">
                                    <a href="{{$bannes_new->slider_links}}" target="_blank" class="links">Shopping Now</a>
                                </div>
                            </div>
                            <!-- Li's Static Home Content Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Li's Static Home Area End Here -->
            <!-- Begin Group Featured Product Area -->
            <div class="group-featured-product pt-60 pb-40 pb-xs-25">
                <div class="container">
                    <div class="row">
                        <!-- Begin Featured Product Area -->
                        @foreach($category_rand as $cate_rand)
                        <?php 
                            $product_rand = App\Products::where('product_status',1)->where('category_id',$cate_rand->category_id)->orderBy(DB::raw('RAND()'))->take(2)->get();
                        ?>
                        @if (count($cate_rand->category) > 0)
                        <div class="col-lg-4">
                            <div class="featured-product">
                                <div class="li-section-title">
                                    <h2 style="text-transform: capitalize;">
                                        <span>{{$cate_rand->category_name}}</span>
                                    </h2>
                                </div>
                                <div class="featured-product-active-2 owl-carousel">
                                    <div class="featured-product-bundle">
                                        @foreach ($product_rand as $pro_rand)
                                        <div class="row">
                                            <div class="group-featured-pro-wrapper">
                                                <div class="product-img">
                                                    <a href="{{route('detail.show',[$pro_rand->product_slug])}}">
                                                        <img alt="" src="{{asset('uploads/product/'.$pro_rand->product_image)}}" width="90px" height="90px">
                                                    </a>
                                                </div>
                                                <div class="featured-pro-content">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer" style="text-transform: capitalize;">
                                                            <a href="#">{{$pro_rand->brandproduct->brand_name}}</a>
                                                        </h5>
                                                    </div>
                                                        <div class="rating-box">
                                                            @php
                                                                $rating_avg = App\Review::where('review_id_product',$pro_rand->product_id)->avg('rating');
                                                            @endphp
                                                            <ul class="rating">
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
                                                            </ul>
                                                        </div>
                                                    <h4 style="text-transform: capitalize;"><a class="featured-product-name" href="{{route('detail.show',[$pro_rand->product_slug])}}">{{$pro_rand->product_name}}</a></h4>
                                                    <div class="featured-price-box">
                                                        @if ($pro_rand->promotion_price > 0)
                                                            <span class="new-price">{{number_format($pro_rand->promotion_price,0,',','.')}} VNĐ</span>
                                                        @else
                                                            <span class="new-price">{{number_format($pro_rand->product_price,0,',','.')}} VNĐ</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                        @else
                        <div class="col-lg-4">
                            <div class="featured-product">
                                <div class="li-section-title">
                                    <h2 style="text-transform: capitalize;">
                                        <span>{{$cate_rand->category_name}}</span>
                                    </h2>
                                </div>
                                <div class="featured-product-active-2 owl-carousel freestyle">
                                    <p>Product Not Found</p>
                                </div>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        <!-- Featured Product Area End Here -->
                    </div>
                </div>
            </div>
            <style type="text/css">
                .freestyle p{
                    line-height: 1.42857;
                    padding: 8px;
                    vertical-align: top;
                }
            </style>
            <!-- Group Featured Product Area End Here -->


@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
@endsection
