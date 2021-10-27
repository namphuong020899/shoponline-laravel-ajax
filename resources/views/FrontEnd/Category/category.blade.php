@extends('LayoutUser')
@section('title')    
  {{$category_find->category_name}}
@endsection
@section('content')
<style type="text/css">
    .product-short .nice-select .list {
        border-radius: 0px;
        width: 100%;
        z-index: 99;
        height: 164px;
    }
</style>
            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{route('home')}}">Trang Chủ</a></li>
                            <li class="active" style="text-transform: capitalize;">{{$category_find->category_name}}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!-- Begin Li's Content Wraper Area -->
            <div class="content-wraper pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- Begin Li's Banner Area -->
                            <div class="single-banner shop-page-banner">
                                <a href="#">
                                    <img src="{{asset('frontend/images/bg-banner/2.jpg')}}" alt="Li's Static Banner">
                                </a>
                            </div>
                            <!-- Li's Banner Area End Here -->
                            <!-- shop-top-bar start -->
                            <div class="shop-top-bar mt-30">
                                <div class="shop-bar-inner">
                                    <div class="product-view-mode">
                                        <!-- shop-item-filter-list start -->
                                        <ul class="nav shop-item-filter-list" role="tablist">
                                            <li class="active" role="presentation"><a aria-selected="true" class="active show" data-toggle="tab" role="tab" aria-controls="grid-view" href="#grid-view"><i class="fa fa-th"></i></a></li>
                                            <li role="presentation"><a data-toggle="tab" role="tab" aria-controls="list-view" href="#list-view"><i class="fa fa-th-list"></i></a></li>
                                        </ul>
                                        <!-- shop-item-filter-list end -->
                                    </div>
                                    <div class="toolbar-amount">
                                        <span>Showing {{$product_cate_count->count()}} to {{$product_cate->count()}} of {{$product_cate_count->count()}}</span>
                                    </div>
                                </div>
                                <!-- product-select-box start -->
                                <div class="product-select-box">
                                    <div class="product-short">
                                        <p>Sort By:</p>
                                        <input type="hidden" name="hidden_cate" id="hidden_cate" value="{{$category_find->category_id}}">
                                        <select class="nice-select" id="sort" name="sort">
                                            <option value="">Relevance</option>
                                            <option value="name-az">Name (A - Z)</option>
                                            <option value="name-za">Name (Z - A)</option>
                                            <option value="price-low-high">Price (Low &gt; High)</option>
                                            <option value="price-high-low">Price (High &gt; Low)</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- product-select-box end -->
                            </div>
                            <!-- shop-top-bar end -->
                            <!-- shop-products-wrapper start -->
                            @if ($product_cate_count->count() > 0)
                            <div class="shop-products-wrapper">
                                <div class="tab-content">
                                    <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                        <div class="product-area shop-product-area">
                                            <div class="row" id="productData">
                                                
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
                                                                        @if (Auth::user() )
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
                                                

                                            </div>
                                        </div>
                                    </div>
                                    <div id="list-view" class="tab-pane product-list-view fade" role="tabpanel">
                                        <div class="row">
                                            <div class="col">
                                            	@foreach($product_cate as $pro_cate)
                                                <div class="row product-layout-list">
                                                    <div class="col-lg-3 col-md-5 ">
                                                        <div class="product-image">
                                                            <a href="{{route('detail.show',[$pro_cate->product_slug])}}">
                                                                <img src="{{asset('uploads/product/'.$pro_cate->product_image)}}" alt="{{$pro_cate->product_content}}" width="214px" height="214px">
                                                            </a>
			                                                @if($pro_cate->product_status == 1 && $pro_cate->promotion_price == 0 )
			                                                <span class="sticker">New</span>
			                                                @elseif($pro_cate->product_status == 2 && $pro_cate->promotion_price == 0)
			                                                <span></span>
			                                                @elseif($pro_cate->promotion_price < $pro_cate->product_price)
			                                                <span class="sticker">Sale</span>
			                                                @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-7">
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
                                                                    <span class="new-price">
			                                                        @if($pro_cate->promotion_price !=0)
			                                                            {{number_format($pro_cate->promotion_price,0,',','.')}} VNĐ
			                                                        @else
			                                                            {{number_format($pro_cate->product_price,0,',','.')}} VNĐ
			                                                        @endif
                                                                    </span>                                         @if($pro_cate->promotion_price !=0)
			                                                            <span class="old-price">    {{number_format($pro_cate->product_price,0,',','.')}}
			                                                            </span>
			                                                        @endif
			                                                        @if($pro_cate->promotion_price !=0)
			                                                             <span class="discount-percentage">-{{number_format(100-($pro_cate->promotion_price/$pro_cate->product_price)*100)}}%</span>
			                                                        @endif
                                                                </div>
                                                                <p>{!!substr($pro_cate->product_desc,0,250)!!} ...</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <div class="shop-add-action mb-xs-30">
                                                            <ul class="add-actions-link">
                                                                <li class="add-cart">
                                                                    <a style="cursor: pointer;" class="{{ $pro_cate->product_quantity != 0 ? '' : 'disabled' }} add_cart" data-href="{{ route('shopping-cart.show',$pro_cate->product_id) }}">Add to cart</a>
                                                                </li>
                                                                <li class="wishlist">
                                                                    @if (Auth::user())
                                                                        <a class="wish-check-2" data-wish_id="{{$pro_cate->product_id}}" href="#">
                                                                            <?php $pro_wish = App\Wishlist::where('id_user',Auth::id())->where('id_product',$pro_cate->product_id)->first(); ?>
                                                                            @if ($pro_wish && $pro_wish->wish_status ==0)
                                                                                <i style="color: red;" class="fa fa-heart"></i>Add to wishlist
                                                                            @else
                                                                                <i class="fa fa-heart-o"></i>Add to wishlist
                                                                            @endif
                                                                            
                                                                        </a>
                                                                    @else
                                                                        <a href="{{ route('login.index') }}">
                                                                            <i class="fa fa-heart-o"></i>Add to wishlist
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                                <li><a class="quick-view" data-toggle="modal" data-target="#quickview_product{{$pro_cate->product_id}}" href="#"><i class="fa fa-eye"></i>Quick view</a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    {!! $product_cate->render('FrontEnd.Paginatoin.paginatoin')  !!}

                                </div>
                            </div>
                            @else
                            <div class="shop-products-wrapper">
                                <h4 style="text-align: center;margin-top: 4%;color: #898989;">
                                    Product Not Found
                                </h4>
                            </div>
                            @endif
                            <!-- shop-products-wrapper end -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Content Wraper Area End Here -->

@endsection
@section('script')
<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change','#sort',function(e){
            e.preventDefault();
            var change = $(this).val();
            var id_cate = $('#hidden_cate').val();
            
            $.ajax({
                type: 'get',
                url: '{{ route('danh-muc.index') }}',
                data: {change:change,id_cate:id_cate},
                dataType: 'html',
                success:function(response){
                    // console.log(response);
                    $('#productData').html(response);
                }
            });

        });
    });
</script>
@endsection