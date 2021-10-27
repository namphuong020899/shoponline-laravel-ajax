@extends('LayoutUser')
@section('title')    
  History Cart
@endsection
@section('style')    
    <link rel="stylesheet" href="{{ asset('frontend/dist/starrr.css') }}">
@endsection
@section('content')


            <!-- Begin Li's Breadcrumb Area -->
            <div class="breadcrumb-area">
                <div class="container">
                    <div class="breadcrumb-content">
                        <ul>
                            <li><a href="{{route('home')}}">Home</a></li>
                            <li class="active">History Cart</li>
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
                            <form action="#">
                                <div class="table-content table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="li-product-thumbnail">images</th>
                                                <th class="cart-product-name">Product</th>
                                                <th class="li-product-price">Unit Price</th>
                                                <th class="li-product-quantity">Quantity</th>
                                            </tr>
                                        </thead>

                                        <tbody id="load_history">

                                        </tbody>
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-wrapper" id="review_order" >
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <h3 class="review-page-title">Write Your Review</h3>
                            <div class="modal-inner-area row">
                                <div class="col-lg-6">
                                   <div class="li-review-product">
                                       <span id="show_image"></span>
                                       <div class="li-review-product-desc">
                                           <p class="li-product-name">Today is a good day Framed poster</p>
                                           <p id="show_desc"></p>                                           
                                       </div>
                                   </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="li-review-content">
                                        <!-- Begin Feedback Area -->
                                        <div class="feedback-area">
                                            <div class="feedback">
                                                <h3 class="feedback-title">Our Feedback</h3>
                                                <input type="hidden" id="hidden_id" value="">
                                                <input type="hidden" id="hidden_pro_id" value="">
                                                <input type="hidden" id="hidden_star_id" name="star_count">
                                                <form method="post" id="write_form">
                                                    <p class="your-opinion">
                                                        <label>Your Rating</label>
                                                        <span>
                                                            <div class='starrr' id='star1' ></div>
                                                        </span>
                                                    </p>
                                                    <p class="feedback-form">
                                                        <label for="feedback">Your Review</label>
                                                        <textarea name="text_review" id="text_review" cols="45" rows="8" aria-required="true"></textarea>
                                                    </p>
                                                    <div class="feedback-input single-add-to-cart">
                                                        <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-dark dark_hover">Submit</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Feedback Area End Here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <!--Shopping Cart Area End-->

@endsection
@section('script')
<script src="{{ asset('frontend/dist/starrr.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){
        // Load Data
        load_data();
        // Strar
        $('#star1').starrr({
          change: function(e, value){
            if (value) {
                $('.your-choice-was').show();
                $('.choice').text(value);
                $('#hidden_star_id').val(value);
            } else {
                $('.your-choice-was').hide();
            }
          }
        });
        // Show Review
        $(document).on('click','.show-review',function(e){
            e.preventDefault();
            var id = $(this).data('id');
            $('#review_order').modal('show');
            $('#text_review').val('');
            $('#hidden_star_id').val('');

            $.ajax({
                type: 'get',
                url: 'history/'+id,
                dataType: 'json',
                success:function(response){
                    if (response.status == 200) {
                        $('#hidden_id').val(id);
                        $('#hidden_pro_id').val(response.data.product_id);
                        $('#show_image').html('\
                            <img src="uploads/product/'+response.product.product_image+'" alt="'+response.product.product_content+'" width="302px" height="302px">');
                        $('#show_desc').html('<span>'+response.desc+'</span>');
                    }else{
                         toastr.error(response.message, 'Notification',{timeOut: 7000});
                    }
                }
            });
        });
        // Add Review
        $(document).on('submit','#write_form',function(e){
            e.preventDefault();
            var id_pro = $('#hidden_pro_id').val();
            var id_detail = $('#hidden_id').val();
            var text_review = $('#text_review').val();
            var star_count = $('#hidden_star_id').val();

            $.ajax({
                type: 'post',
                url: '{{ route('history.store') }}',
                data: {
                    id_pro:id_pro,
                    id_detail:id_detail,
                    text_review:text_review,
                    star_count:star_count
                },
                success:function(response){
                    if (response.status == 200) {
                        load_data();
                        $('#review_order').modal('hide');
                        setTimeout(function(){
                            toastr.success(response.message,'Notification');
                        }, 2000);
                    }else{
                        $.each(response.errors, function(key, err_values){
                             toastr.error(err_values, 'Notification',{timeOut: 7000});
                        });
                        $('#hidden_star_id').val('');
                    }
                }
            });
        });
    });
    function load_data(){
        $.ajax({
            type: 'get',
            url: '{{ route('history.create') }}',
            dataType: 'json',
            success:function(response){
                $('#load_history').html(response.output);
            }
        });
    }
</script>
@endsection
