@extends('LayoutUser')
@section('title')    
  Shopping Cart
@endsection
@section('content')


            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li class="active">Shopping Cart</li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Li's Breadcrumb Area End Here -->
            <!--Shopping Cart Area Strat-->
            <div class="Shopping-cart-area pt-60 pb-60">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-remove">remove</th>
                                                <th class="li-product-thumbnail">images</th>
                                                <th class="cart-product-name">Product</th>
                                                <th class="li-product-price">Unit Price</th>
                                                <th class="li-product-quantity">Quantity</th>
                                                <th class="li-product-subtotal">Total</th>
                                            </tr>
                                        </thead>

                                        <tbody id="shopping_cart_load">
                                            
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="coupon-all">
                                            <form action="{{route('shopping-cart.store_coupon')}}" method="post" id="form_coupon">
                                                <div class="coupon">
                                                    <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                                    <input class="button" name="apply_coupon" id="apply_coupon" value="Apply coupon" type="submit">
                                                </div>
                                            </form>

                                            <div class="coupon-all cou disable">
                                                <form action="{{route('delete-coupon.store')}}" method="post" id="form_coupon_remove">
                                                    <input class="button" name="update_cart" value="Delete Coupon" type="submit">
                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5 ml-auto">
                                        <div class="cart-page-total" id="shoppingtotal">
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <!--Shopping Cart Area End-->
<style type="text/css">
    .qtycart{
        border: 0px;
    }
    .qtycart:hover{
        border: 2px solid #eceff8;
    }.disable{
        display: none;
    }
</style>
@endsection
@section('script')
<script type="text/javascript">
    function shopping_cart(){
        $.ajax({
            type: 'get',
            url: '{{ route('shopping-cart.create') }}',
            dataType: 'json',
            success:function(response){
                $('#shopping_cart_load').html(response.data);
                $('#shoppingtotal').html(response.output_total_shopping);
            }
        });
    }
    
    $(document).ready(function(){
        shopping_cart();
        @if (Session::get('coupon'))
            $('#form_coupon').addClass('disable');
            $('.cou').removeClass('disable');
        @endif
        // Add Coupon
        $(document).on('submit','#form_coupon',function(e){
            e.preventDefault();
            var coupon_code = $('#coupon_code').val();
            var action = $(this).attr('action');

            $.ajax({
                type: 'post',
                url: action,
                data: {coupon_code:coupon_code},
                success:function(response){
                    if (response.message) {
                        shopping_cart();
                        $('.cou').removeClass('disable');
                        $('#form_coupon').addClass('disable');
                        toastr.success(response.message,'Notification',{timeOut: 7000});
                    }else if(response.error_login){
                        toastr.error(response.error_login, '<a style="color: #fff" href="'+response.url+'">Click Me Go Login</a>',{timeOut: 10000});
                        $('#coupon_code').val('');
                    }else{
                        toastr.error(response.error,'Notification',{timeOut: 7000});
                        $('#coupon_code').val('');
                    }

                }
            });
        });
        // Delete Coupon
        $(document).on('submit','#form_coupon_remove',function(e){
            e.preventDefault();
            var action = $(this).attr('action');

            $.ajax({
                type: 'post',
                url: action,
                success:function(response){
                    shopping_cart();
                    $('.cou').addClass('disable');
                    $('#form_coupon').removeClass('disable');
                    $('#coupon_code').val('');
                    toastr.success(response.message,'Notification',{timeOut: 7000});
                }
            });
        });
        // Update Qty
        $(document).on('change','.qtycart',function(e){
            e.preventDefault();
            var url_up = $(this).data('href_submit');
            var qty_updatecart = $(this).val();

            $.ajax({
                type:'put',
                url: url_up,
                data: {qty_updatecart:qty_updatecart},
                dataType: 'json',
                success:function(response){
                    shopping_cart();
                    load_cart();
                    toastr.success(response.message,'Notification',{timeOut: 7000});
                }
            });
        })
        // Delete Cart
        $(document).on('click','.remove_shopping',function(e){
            var href_rowid = $(this).data('href_rowid');

            $.ajax({
                type: 'get',
                url: href_rowid,
                success:function(response){
                    shopping_cart();
                    load_cart();
                }
            });
        });
    });
</script>
@endsection