
@foreach($product_cate as $pro_cate)
<div class="col-lg-3 col-md-4 col-sm-6 mt-40">
    <!-- single-product-wrap start -->
    <div class="single-product-wrap">
        <div class="product-image">
            <a href="{{route('detail.show',[$pro_cate->product_slug])}}">
                <img src="{{asset('uploads/product/'.$pro_cate->product_image)}}" alt="{{$pro_cate->product_content}}" width="270px" height="270px">
            </a>
        @if ($pro_cate->product_date_sale >= $startOfWeek && $pro_cate->product_date_sale <= $endOfWeek && $pro_cate->promotion_price == 0)
            <span class="sticker">New</span>
        @elseif ($pro_cate->product_date_sale >= $startOfWeek && $pro_cate->product_date_sale <= $endOfWeek && $pro_cate->promotion_price != 0)
            <span class="sticker">Sale</span>
        @elseif($pro_cate->promotion_price != 0)
            <span class="sticker">Sale</span>
        @else
            <span></span>
        @endif
        </div>
        <div class="product_desc">
            <div class="product_desc_info">
                <div class="product-review">
                    <h5 class="manufacturer">
                        <a href="#">{{$pro_cate->brandproduct->brand_name}}</a>
                    </h5>
                    <div class="rating-box">
                        @php
                            $rating_avg = App\Review::where('review_id_product',$pro_cate->product_id)->avg('rating');
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
                <h4><a class="product_name" href="single-product.html">{{$pro_cate->product_name}}</a></h4>
                <div class="price-box">
                    @if($pro_cate->promotion_price !=0)
                        {{number_format($pro_cate->promotion_price,0,',','.')}} VNĐ
                    @else
                        {{number_format($pro_cate->product_price,0,',','.')}} VNĐ
                    @endif
                    </span>
                    @if($pro_cate->promotion_price !=0)
                        <span class="old-price">    {{number_format($pro_cate->product_price,0,',','.')}}
                        </span>
                    @endif
                    @if($pro_cate->promotion_price !=0)
                         <span class="discount-percentage">-{{number_format(100-($pro_cate->promotion_price/$pro_cate->product_price)*100)}}%</span>
                    @endif
                </div>
            </div>
            <div class="add-actions">
                <ul class="add-actions-link">
                    <li class="add-cart active">
                        <a style="cursor: pointer;" class="{{ $pro_cate->product_quantity != 0 ? '' : 'disabled' }} add_cart" data-href="{{ route('shopping-cart.show',$pro_cate->product_id) }}">Add to cart</a>
                    </li>
                    <li><a href="#" title="quick view" class="quick-view-btn" data-toggle="modal" data-target="#quickview_product{{$pro_cate->product_id}}"><i class="fa fa-eye"></i></a></li>
                    <li>
                        @if (Auth::user())
                            <a class="links-details wish-check" data-id="{{$pro_cate->product_id}}" href="#">
                                <?php $pro_wish = App\Wishlist::where('id_user',Auth::id())->where('id_product',$pro_cate->product_id)->first(); ?>
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