@extends('LayoutUser')
@section('title')    
  {{$detail->product_name}}
@endsection
@section('content')

            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{route('home')}}">Trang Chủ</a></li>
                            <li class="active">{{$detail->product_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- content-wraper start -->
            <div class="content-wraper">
                <div class="container">
                    <div class="row single-product-area">
                        <div class="col-lg-5 col-md-6">
                           <!-- Product Details Left -->
                            <div class="product-details-left">
                                <div class="product-details-images slider-navigation-1">
                                	@foreach($gallery as $gal)
                                    <div class="lg-image">
                                        <img src="{{asset('uploads/gallery/'.$gal->gallery_image)}}" alt="{{$gal->gallery_name}}" width="390px" height="320px">
                                    </div>
                                    @endforeach
                                </div>
                                <div class="product-details-thumbs slider-thumbs-1">
                                	@foreach($gallery as $gal)
                                    <div class="sm-image"><img src="{{asset('uploads/gallery/'.$gal->gallery_image)}}" alt="{{$gal->gallery_name}}" width="77px" height="77px"></div>
                                    @endforeach
                                </div>
                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6">
                            <div class="product-details-view-content sp-normal-content pt-60">
                                <div class="product-info">
                                    <h2>{{$detail->product_name}}</h2>
                                    <span class="product-details-ref" style="text-transform: capitalize;">Reference: {{$detail->brandproduct->brand_name}}</span>
                                    <div class="rating-box pt-20">
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
                                            <li><a href="#">{{number_format($rating_avg,1)}}/5 Ratings</a></li>
                                            <li class="review-item"><a data-toggle="tab" href="#reviews">Read Review</a></li>
                                        </ul>
                                    </div>
                                    <div class="price-box pt-20">
                                        <span class="new-price new-price-2">
                        	            @if($detail->promotion_price !=0)
                                            {{number_format($detail->promotion_price,0,',','.')}} VNĐ
                                        @else
                                            {{number_format($detail->product_price,0,',','.')}} VNĐ
                                        @endif
                                        </span>
                                    </div>
                                    <div class="product-desc">
                                        <p>
                                            <span>{!!substr($detail->product_content,0,200)!!}</span>
                                        </p>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form method="POST" class="cart-quantity" id="submit_form_add_cart">
                                            <input type="hidden" id="product_id_hidden" name="product_id_hidden" value="{{$detail->product_id}}">
                                            <div class="quantity">
                                                <label>Quantity</label>
                                                <div class="cart-plus-minus {{ $detail->product_quantity != 0 ? '' : 'disabled-div' }}">
                                                    <input class="cart-plus-minus-box" id="cartqty" min="1" value="{{ $detail->product_quantity != 0 ? '1' : '0' }}" type="number" name="qty_price" oninput="validity.valid||(value='');">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" {{ $detail->product_quantity != 0 ? '' : 'disabled' }} type="submit">Add to cart</button>
                                        </form>
                                    </div>
                                    <div class="product-additional-info">
                                        <div class="product-social-sharing">
                                            <ul>
                                                <li class="facebook"><a target="_bank" href="https://www.facebook.com/sharer/sharer.php?u={{$url_canonical}}&amp;src=sdkpreparse"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                <li class="twitter"><a target="_bank" href="http://twitter.com/share?url={{$url_canonical}}"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                <li class="google-plus"><a target="_bank" href="https://plus.google.com/share?url={{$url_canonical}}"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                <li class="instagram"><a target="_bank" href="http://pinterest.com/pin/create/button/?url={{$url_canonical}}&description={{$detail->product_content}}&media={{$detail->product_image}}"><i class="fa fa-pinterest"></i>Pinterest</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
            <!-- content-wraper end -->
            <!-- Begin Product Area -->
            <div class="product-area pt-40">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="li-product-tab">
                                <ul class="nav li-product-menu">
                                   <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                                   <li><a data-toggle="tab" href="#product-details"><span>Comment</span></a></li>
                                   <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                                </ul>               
                            </div>
                            <!-- Begin Li's Tab Menu Content Area -->
                        </div>
                    </div>
                    <div class="tab-content">
                        <div id="description" class="tab-pane active show" role="tabpanel">
                            <div class="product-description">
                                <span>{!!$detail->product_desc!!}</span>
                            </div>
                        </div>
                        <div id="product-details" class="tab-pane" role="tabpanel">
                            <div class="product-details-manufacturer">
                                <div class="fb-comments" data-href="{{$url_canonical}}" data-width="750" data-numposts="10" data-lazy="false"></div>
                            </div>
                        </div>
                        <div id="reviews" class="tab-pane" role="tabpanel">
                            <div class="product-reviews">
                                <div class="product-details-comment-block">
                                    <div class="comment-review">
                                        <span>Grade</span>
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
                                    <div class="comment-author-infos pt-25">
                                        @foreach ($rating as $row)
                                        @php
                                            $nameuser = App\User::where('id',$row->review_id_user)->first();
                                        @endphp
                                        <span>{{$nameuser->name}}</span>
                                        <span style="font-style: italic;color: #adadad;font-weight: 400;font-size: 12px;">{{($row->created_at)->format('d-m-Y')}}</span>
                                        <p>{{$row->comment}}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Area End Here -->
            <!-- Begin Li's Laptop Product Area -->
            <section class="product-area li-laptop-product pt-30 pb-50">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                            <div class="li-section-title">
                                <h2>
                                    <span>other products in the same category:</span>
                                </h2>
                            </div>
                            <div class="row">
                                <div class="product-active owl-carousel">
                                	@foreach($porduct_dub as $pro_dub)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{route('detail.show',[$pro_dub->product_slug])}}">
                                                    <img src="{{asset('uploads/product/'.$pro_dub->product_image)}}" alt="{{$pro_dub->product_desc}}" width="216px" height="216px">
                                                </a>
                                                @if ($pro_dub->product_date_sale >= $startOfWeek && $pro_dub->product_date_sale <= $endOfWeek && $pro_dub->promotion_price == 0)
                                                    <span class="sticker">New</span>
                                                @elseif ($pro_dub->product_date_sale >= $startOfWeek && $pro_dub->product_date_sale <= $endOfWeek && $pro_dub->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @elseif($pro_dub->promotion_price != 0)
                                                    <span class="sticker">Sale</span>
                                                @else
                                                    <span></span>
                                                @endif
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="">{{$pro_dub->brandproduct->category_name}}</a>
                                                        </h5>
                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <h4><a class="product_name" href="{{route('detail.show',[$pro_dub->product_slug])}}">{{$pro_dub->product_name}}</a></h4>
                                                    <div class="price-box">
                                                        @if($pro_dub->promotion_price !=0)
                                                            {{number_format($pro_dub->promotion_price,0,',','.')}} VNĐ
                                                        @else
                                                            {{number_format($pro_dub->product_price,0,',','.')}} VNĐ
                                                        @endif
                                                        </span>
                                                        @if($pro_dub->promotion_price !=0)
                                                            <span class="old-price">    {{number_format($pro_dub->product_price,0,',','.')}}
                                                            </span>
                                                        @endif
                                                        @if($pro_dub->promotion_price !=0)
                                                             <span class="discount-percentage">-{{number_format(100-($pro_dub->promotion_price/$pro_dub->product_price)*100)}}%</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        <li class="add-cart active">
                                                            <a style="cursor: pointer;" class="{{ $pro_dub->product_quantity != 0 ? '' : 'disabled' }} add_cart" data-href="{{ route('shopping-cart.show',$pro_dub->product_id) }}">Add to cart</a>
                                                        </li>
                                                        <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#quickview_product{{$pro_dub->product_id}}"><i class="fa fa-eye"></i></a></li>
                                                        <li>
                                                            @if (Auth::user())
                                                                <a class="links-details wish-check" data-id="{{$pro_dub->product_id}}" href="#">
                                                                    <?php $pro_wish = App\Wishlist::where('id_user',Auth::id())->where('id_product',$pro_dub->product_id)->first(); ?>
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

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('submit','#submit_form_add_cart',function(e){
            e.preventDefault();
            var product_id_hidden = $('#product_id_hidden').val();
            var qty_price = $('#cartqty').val();

            $.ajax({
                type: 'post',
                url: '{{ route('shopping-cart.store') }}',
                data:{product_id_hidden:product_id_hidden,qty_price:qty_price},
                dataType: 'json',
                success:function(response){
                    load_cart();
                    toastr.success(response.message, 'Notification',{timeOut: 7000});
                }
            });
        });
    });
</script>
@endsection