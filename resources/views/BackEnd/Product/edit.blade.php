@extends('LayoutBackEnd')
@section('title')    
  Product Edit
@endsection
@section('content') 
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-10">
            <h2>Data Tables</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a>Product</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>Edit Product</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>      
	<div class="wrapper wrapper-content animated fadeInRight">
        <form action="{{ route('product.update',$products->product_id) }}" method="post" enctype="multipart/form-data" role="form" id="form">
        @method('PUT')
    	@csrf
		<div class="row">
		    <div class="col-lg-6">
		        <div class="ibox" id="ibox2">
		            <div class="ibox-title">
		                <h5>Add Product <small>Add name, sulg, desc, price, promotion, view.</small></h5>
		                <div class="ibox-tools">
		                    <a class="collapse-link">
		                        <i class="fa fa-chevron-up"></i>
		                    </a>
		                </div>
		            </div>
		            <div class="ibox-content">
	                    <div class="hr-line-dashed"></div>
	                    <div class="form-group row {{$errors->has('product_name') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Name <sup class="text-danger">*</sup></label>
	                        <div class="col-sm-10">
	                        	<input type="text" class="form-control" name="product_name" id="slug_name" onkeyup="ChangeToSlug();" value="{{$products->product_name}}"> 
	                        	@if ($errors->has('product_name'))
	                        		<span class="help-block text-danger">{{ $errors->first('product_name') }}</span>
	                        	@endif
	                        </div>
	                    </div>
	                    <div class="form-group row {{$errors->has('product_slug') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Slug <sup class="text-danger">*</sup></label>
	                        <div class="col-sm-10">
	                        	<input type="text" class="form-control" name="product_slug" id="slug" value="{{$products->product_slug}}"> 
	                        	@if ($errors->has('product_slug'))
	                        		<span class="help-block text-danger">{{ $errors->first('product_slug') }}</span>
	                        	@endif
	                        </div>
	                    </div>
	                    <div class="form-group {{$errors->has('product_desc') ? 'has-error' : ''}}">
	                    	<label class="font-normal">Desc <sup class="text-danger">*</sup></label>
	                    	<textarea  rows="5" name="product_desc" required="">{{$products->product_desc}}</textarea>
	                    </div>
	                    <div class="form-group row {{$errors->has('product_price') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Price <sup class="text-danger">*</sup></label>
	                        <div class="col-sm-10 input-group">
	                        	<input type="text" class="form-control" data-mask="99,999,999" name="product_price" id="change_price" onkeyup="ChangeToPrice();" value="{{$products->product_price}}">
	                        	<input type="hidden" class="form-control" name="product_price_hidden" value="{{$products->product_price}}" id="pirce_hidden">
                                <span class="input-group-addon">
                                    <span>VNĐ</span>
                                </span>

	                        </div>
	                        @if ($errors->has('product_price'))
	                        <label class="col-sm-2 col-form-label"></label>
	                        <div class="col-sm-10">
                        		<span class="help-block text-danger">{{ $errors->first('product_price') }}</span>
                        	</div>
                        	@endif
	                    </div>
	                    <div class="form-group row {{$errors->has('promotion_price') || Session::get('message_err') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Promotion</label>
	                        <div class="col-sm-10 input-group">
	                        	<input type="mumber" class="form-control" data-mask="99,999,999" name="promotion_price" id="promotion_price" onkeyup="ChangeToPrice();" value="{{$products->promotion_price}}"> 
	                        	<input type="hidden" class="form-control" name="promotion_price_hidden" id="promotion_price_hidden" value="{{$products->promotion_price}}">
	                        	<span class="input-group-addon">
                                    <span>VNĐ</span>
                                </span>
	                        	@if ($errors->has('promotion_price'))
                        			<span class="help-block text-danger">{{ $errors->first('promotion_price') }}</span> 
	                        	@endif
	                        </div>
	                        @if (Session::get('message_err'))
	                        <label class="col-sm-2 col-form-label"></label>
	                        <div class="col-sm-10">
                        		<span class="help-block text-danger">{{ Session::get('message_err') }}</span>
                        	</div>
                        	@endif
	                    </div>
	                    <div class="form-group row {{$errors->has('product_quantity') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Quantity <sup class="text-danger">*</sup></label>
	                        <div class="col-sm-10">
	                        	<input type="number" class="form-control" name="product_quantity" min="1" value="{{$products->product_quantity}}"  oninput="this.value = Math.abs(this.value)"> 
	                        	@if ($errors->has('product_quantity'))
	                        		<span class="help-block text-danger">{{ $errors->first('product_quantity') }}</span>
	                        	@endif
	                        </div>
	                    </div>
	                    <div class="form-group row {{$errors->has('product_view') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">View</label>
	                        <div class="col-sm-10">
	                        	<input type="number" class="form-control" name="product_view" min="0" value="0"  oninput="this.value = Math.abs(this.value)" value="{{$products->product_view}}"> 
	                        	@if ($errors->has('product_view'))
	                        		<span class="help-block text-danger">{{ $errors->first('product_view') }}</span>
	                        	@endif
	                        </div>
	                    </div>
	                    <div class="hr-line-dashed"></div>
	                    <div class="form-group row">
	                        <div class="col-sm-4 col-sm-offset-2">
	                            <a href="{{ route('product.index') }}" class="btn btn-white btn-lg">Back</a>
	                        </div>
	                    </div>
		            </div>
		        </div>
		    </div>
		    <div class="col-lg-6">
		        <div class="ibox ">
		            <div class="ibox-title">
		                <h5>Add Product <small>Add date, hour, content, category, brand, status, image.</small></h5>
		                <div class="ibox-tools">
		                    <a class="collapse-link">
		                        <i class="fa fa-chevron-up"></i>
		                    </a>
		                </div>
		            </div>
		            <div class="ibox-content">
	                    <div class="hr-line-dashed"></div>
	                    <div id="data_3" class="form-group row {{$errors->has('product_date_sale') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Date Sale</label>
	                        <div class="col-sm-10 input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="product_date_sale" value="{{$products->product_date_sale}}">
	                        	@if ($errors->has('product_date_sale'))
	                        		<span class="help-block text-danger">{{ $errors->first('product_date_sale') }}</span>
	                        	@endif
	                        </div>
	                    </div>
	                    <div class="form-group row {{$errors->has('product_hour_sale') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Hour Sale</label>
	                        <div class="col-sm-10 input-group clockpicker" data-autoclose="true">
                                <input type="text" class="form-control" value="{{$products->product_hour_sale}}" name="product_hour_sale">
                                <span class="input-group-addon">
                                    <span class="fa fa-clock-o"></span>
                                </span>
	                        	@if ($errors->has('product_hour_sale'))
	                        		<span class="help-block text-danger">{{ $errors->first('product_hour_sale') }}</span>
	                        	@endif
	                        </div>
	                    </div>
	                    <div class="form-group {{$errors->has('product_content') ? 'has-error' : ''}}">
	                    	<label class="font-normal">Content <sup class="text-danger">*</sup></label>
	                    	<textarea rows="5" name="product_content" required="">{{$products->product_content}}</textarea>
	                    </div>
	                    <div class="form-group row {{$errors->has('category_id') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Category</label>
	                        <div class="col-sm-10">
                                <select class="chosen-select" name="category_id">
                                	@foreach ($categorys as $category)
                                	<option {{ $products->category_id == $category->category_id ? 'selected' : '' }}  style="text-transform: capitalize;" value="{{$category->category_id}}">{{$category->category_name}}</option>
                                	@endforeach
                                </select>
	                        </div>
	                    </div>
	                    <div class="form-group row {{$errors->has('brand_id') ? 'has-error' : ''}}"><label class="col-sm-2 col-form-label">Brand</label>
	                        <div class="col-sm-10">
	                        	<select class="chosen-select" name="brand_id">
	                        		@foreach ($brands as $brand)
                                    <option {{ $products->brand_id == $brand->brand_id ? 'selected' : '' }} style="text-transform: capitalize;" value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                    @endforeach
                                </select> 
	                        </div>
	                    </div>
	                    <div class="form-group row"><label class="col-sm-2 col-form-label">Status <sup class="text-danger">*</sup></label>
	                        <div class="col-sm-10">
	                        	<select class="chosen-select" name="product_status">
                                    <option value="">--- Choose ---</option>
                                    <option {{ $products->product_status == 1 ? 'selected' : '' }} value="1">Product New</option>
                                    <option {{ $products->product_status == 2 ? 'selected' : '' }} value="2">Product Hidden</option>
                                </select> 
	                        	@if ($errors->has('product_status'))
	                        		<span class="help-block text-danger">{{ $errors->first('product_status') }}</span>
	                        	@endif
	                        </div>
	                    </div>
	                    <div class="form-group row"><label class="col-sm-2 col-form-label">Image</label>
	                        <div class="col-sm-10">
	                        	<input type="file" class="form-control file_image" name="product_image" accept="image/*" multiple="" id="product_image" onchange="ImagesFileAsURL()">

	                        	@if ($errors->has('product_image'))
	                        		<span class="help-block text-danger">{{ $errors->first('product_image') }}</span>
	                        	@endif
	                        </div>
	                    </div>
	                    <div class="hr-line-dashed"></div>
	                    
	                    <div class="form-group row">
	                        <div class="col-sm-4 col-sm-offset-2">
	                            <button class="btn btn-primary btn-lg ladda-button" data-style="expand-right" type="submit">Save changes</button>
	                        </div>
	                    </div>
		            </div>
		        </div>
		    </div>
		</div>
		</form>
	</div>
	<div class="wrapper wrapper-content animated">
		<div class="row">
		    <div class="col-lg-12"> 
		    	<div id="displayImg" class="displayImg">
		    		<img src="{{ asset('uploads/product/'.$products->product_image) }}" alt="{{$products->product_image}}" width="100%" height="200px">
		    	</div>
		    </div>
		</div>
	</div>
<style type="text/css">
	.chosen-single{
		text-transform: capitalize;
	}
	.displayImg img{
		width: 100%;
		height: 300px;
		margin-bottom: 2%;
    	margin-top: -5%;
	}
/*	.chosen-single span{
		text-align: center;
	}*/
</style>
@endsection

@section('script')    
<script src="{{asset('backend/ckeditor/ckeditor.js')}}"></script>
<script src="{{asset('backend/ckeditor/ckfinder/ckfinder.js')}}"></script>
<script>
     $(document).ready(function(){
     	CKEDITOR.config.autoParagraph = false;
     	CKEDITOR.replace( 'product_desc' );
    	CKEDITOR.replace( 'product_content' );
        $("#form").validate({
            rules: {
                product_slug: {
                     required: true,
                },
                 product_name: {
                     required: true,
                },
                 product_quantity: {
                     required: true,
                     number: true
                },
                product_desc: {
                     required: true,
                },
                product_content: {
                     required: true,
                }
            }
         });
    });
</script>
@endsection