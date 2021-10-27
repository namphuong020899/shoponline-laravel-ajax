@extends('LayoutUser')
@section('title')    
  All Wishlist
@endsection
@section('content')
            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{ route('home') }}">Home</a></li>
                            <li class="active">Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!--Wishlist Area Strat-->
            <div class="wishlist-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <form action="#">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove">remove</th>
                                                <th class="li-product-thumbnail">images</th>
                                                <th class="cart-product-name">Product</th>
                                                <th class="li-product-price">Unit Price</th>
                                                <th class="li-product-stock-status">Stock Status</th>
                                                <th class="li-product-add-cart">add to cart</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($all_wish) > 0)
                                        	@foreach ($all_wish as $row)
                                            <tr>
                                                <td class="li-product-remove">
                                                	<a href="{{ route('wishlist.edit',$row->id_wishlist) }}"><i class="fa fa-times"></i></a>
                                                </td>
                                                <td class="li-product-thumbnail">
                                                	<a href="{{route('detail.show',[$row->product_slug])}}">
                                                		<img src="{{ asset('uploads/product/'.$row->product_image) }}" alt="{{$row->product_content}}" width="150px" height="150px">
                                                	</a>
                                                </td>
                                                <td class="li-product-name">
                                                	<a href="{{route('detail.show',[$row->product_slug])}}">{{$row->product_name}}</a>
                                                </td>
                                                <td class="li-product-price">
                                                	<span class="amount">
                                                		@if ($row->promotion_price != 0)
                                                			{{number_format($row->promotion_price)}}
                                            			@else
                                            				{{number_format($row->product_price)}}
                                                		@endif
                                                	</span>
                                                </td>
                                                <td class="li-product-stock-status">
                                                	@if ($row->product_quantity != 0)
                                                		<span class="in-stock">in stock</span>
                                            		@else
                                            			<span class="out-stock">out stock</span>
                                                	@endif
                                                </td>
                                                <td class="li-product-add-cart">
                                                	@if ($row->product_quantity != 0)
                                                		<a style="cursor: pointer;" class="{{ $row->product_quantity != 0 ? '' : 'disabled' }} add_cart" data-href="{{ route('shopping-cart.show',$row->product_id) }}">Add to cart</a>
                                                	@else
                                                		<a href="#" class="{{ $row->product_quantity != 0 ? '' : 'disabled' }}">add to cart</a>
                                                	@endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @else
                                            <tr>
                                                <td colspan="6" style="color: #a8acaf;font-size: 23px;   font-weight: bold;">Wishlist Not Found</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--Wishlist Area End-->
@endsection