@extends('LayoutBackEnd')
@section('title')    
  Gallery
@endsection
@section('content') 

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Tables Product</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Product</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a>List Product</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>List Gallery</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>

        <div class="wrapper-content" style="margin-bottom: -5%;">
            <div class="row">
                <div class="col-lg-12">                       
                <div class="ibox ">
                    <div class="ibox-content">
{{--                         <form action="{{route('product-gallery.update',[$pro_id])}}" method="POST" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="row">
                          <div class="col-md-8">
                            <div class="custom-file">
                                <input type="file" id="file" name="file[]" class="custom-file-input" accept="image/*" multiple="">
                                <label for="logo" class="custom-file-label">Choose file...</label>
                            </div> 
                            <span id="error_gallery"></span>
                          </div>
                          <div class="col-md-4">
                            <button type="submit" name="upload_image" class="ladda-button btn btn-primary btn-lg btn-block" data-style="expand-right"><i class="fa fa-cloud-upload"></i> Upload Image</button>
                          </div>
                        </div>
                        </form> --}}
                        <form action="{{route('product-gallery.update',[$pro_id])}}" class="dropzone" id="dropzoneForm" style="border: 1px dashed #1ab394;">
                          @method('PUT')
                          @csrf
                            <div class="fallback">
                                <input name="file" type="file" multiple />
                            </div>
                        </form> 
                        <div align="center" style="margin-top: 1%;">
                          <button type="button" class="btn btn-info" id="submit-all">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div> 
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Gallery</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-product">
                                <li><a href="#" class="dropdown-item">Config option 1</a>
                                </li>
                                <li><a href="#" class="dropdown-item">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <input type="hidden" name="pro_id" class="pro_id" value="{{$pro_id}}">
                        <form>
                        @csrf
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example">
                            <thead>
                            <tr style="text-transform: capitalize;">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="gallery_load">

                            </tbody>
                            <tfoot>
                            <tr style="text-transform: capitalize;">
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                            </table>
                        </div>
                        </form>

                    </div>
                </div>
            </div>
            </div>
        </div>
@endsection
@section('css') 
    <link href="{{ asset('backend/css/plugins/dropzone/basic.css') }}" rel="stylesheet">
    <link href="{{ asset('backend/css/plugins/dropzone/dropzone.css') }}" rel="stylesheet">
@endsection
@section('script')    
    <script src="{{ asset('backend/js/plugins/dropzone/dropzone.js') }}"></script>
    <script>
      $(document).ready(function() {
        load_gallery();

        // Update Name
        $(document).on('blur','.edit_gallery_name',function(){
          var gal_id = $(this).data('gal_id');
          var gal_text = $(this).text();
          var _token = $('input[name="_token"]').val();
          $.ajax({
            url : '{{route('product-gallery.store')}}',
            method: 'POST',
            data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
            success:function(data){
              load_gallery();
              toastr.success('Update Successfully','Notification');
            }

          });
        });
        // Delete 
        $(document).on('click','.delete-gallery',function(){
          var del_id = $(this).data('gal_id');
          var _token = $('input[name="_token"]').val();
          if (confirm('Bạn chắc chắn muốn xóa?')) {
            $.ajax({
              url : '{{route('product-gallery.store')}}',
              method: 'POST',
              data:{del_id:del_id,_token:_token},
              success:function(data){
                load_gallery();
                toastr.success('Delete Successfully','Notification');
              }

            });
          }
        });
        // Update Image
        $(document).on('change','.file_image',function(){
          var up_id = $(this).data('gal_id');
          var image = document.getElementById('file-'+up_id).files[0];
          var form_data = new FormData();
          form_data.append("file",document.getElementById('file-'+up_id).files[0]);
          form_data.append("up_id",up_id);

          $.ajax({
            url : '{{route('product-gallery.store')}}',
            method: 'POST',
            data:form_data,
            contentType:false,
            cache:false,
            processData:false,
            success:function(data){
              load_gallery();
              toastr.success('Update Successfully','Notification');
            }

          });
        });

      });
      function load_gallery(){
        var pro_id = $('.pro_id').val();

        $.ajax({
          url : '{{route('product-gallery.create')}}',
          method: 'get',
          data:{pro_id:pro_id,},
          dataType: 'json',
          success:function(response){
            $('#gallery_load').html(response.data);
          }

        });
      }
      Dropzone.options.dropzoneForm = {
        paramName: "file", // The name that will be used to transfer the file
        maxFilesize: 2, // MB
        dictDefaultMessage: "<strong>Drop files here or click to upload. </strong></br> (This is just a demo dropzone. Selected files are not actually uploaded.)",
        autoProcessQueue : false,
        acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
        init:function(){
          var submitButton = document.querySelector("#submit-all");
          myDropzone = this;

          submitButton.addEventListener('click', function(){
            myDropzone.processQueue();
          });

          this.on("complete", function(){
            if(this.getQueuedFiles().length == 0 && this.getUploadingFiles().length == 0)
            {
              var _this = this;
              _this.removeAllFiles();
            }
            load_gallery();
          });

        }

      };
    </script>
@endsection