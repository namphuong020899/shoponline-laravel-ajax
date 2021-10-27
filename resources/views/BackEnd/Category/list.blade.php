@extends('LayoutBackEnd')
@section('title')    
  Category
@endsection
@section('content') 

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5>Category</h5>
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
                    <form>
                    @csrf
                    <div class="table-responsive">
                        <table id="load_table" class="table table-striped table-bordered table-hover dataTables-example" >
	                        <thead>
		                        <tr style="text-transform: capitalize;">
		                            <th>ID</th>
		                            <th>Name</th>
                                    <th>desc</th>
		                            <th>Status</th>
		                            <th>Action</th>
		                        </tr>
	                        </thead>
                            <tbody id="sorting_orderby">
                                
                            </tbody>
	                        <tfoot>
		                        <tr style="text-transform: capitalize;">
		                            <th>ID</th>
		                            <th>Name</th>
		                            <th>desc</th>
                                    <th>Status</th>
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

    {{-- Add & Edit --}}
    <div class="modal inmodal" id="Modal_sample" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button style="margin-top: -5%" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <span id="image_show"></span>
                    <h4 class="modal-title">Edit</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <form id="sample_form" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div id="message_err"></div>
                        <div class="hr-line-dashed"></div>
                        <input type="hidden" class="form-control" name="category_id" id="category_id">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Name <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="category_name" id="slug_name" onkeyup="ChangeToSlug();"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Slug <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="slug_category_product" id="slug"> 
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Desc </label>
                            <div class="col-sm-10">
                                <textarea data-provide="markdown"  rows="5" name="category_desc" id="category_desc"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Status <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <select class="form-control" name="category_status" id="category_status">
                                    <option value="">-----Choose--------</option>
                                    <option value="1">Show</option>
                                    <option value="2">Hidden</option>
                                </select>
                            </div>
                        </div>
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <input type="hidden" name="action" id="action" />
                        <button type="submit" name="action_button" id="action_button" class="ladda-button btn btn-primary" data-style="expand-right">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Delete --}}
    <div class="modal inmodal" id="Modal_delete" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button style="margin-top: -10%; margin-right: -5%;" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Delete</h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <input type="hidden" name="hidden_id" id="hidden_id">
                <div class="modal-body">
                    <p>Are you sure delete "<span id="body"></span>"?</p>
                </div>
                <form method="POST" id="delete_form">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">No</button>
                        <button type="submit" class="ladda-button btn btn-danger" data-style="expand-right" id="del_button">Yes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@section('script')   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // Load Data Category  
            $('#load_table').DataTable({
                destroy: true,
           		processing : true,
                serverSide : true,
                pageLength: 10,
                responsive: true,
                order:[],
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'CategoryFile'},
                    {extend: 'pdf', title: 'CategoryFile'},

                    {extend: 'print',
                        customize: function (win){
                            $(win.document.body).addClass('white-bg');
                            $(win.document.body).css('font-size', '10px');

                            $(win.document.body).find('table')
                                .addClass('compact')
                                .css('font-size', 'inherit');
                        }
                    }
                ],
                ajax:{
                	url: "{{ route('category.index') }}",
                },
                columns: [
                	{
                		data: 'category_sorting'
                	},
                	{
                		data: 'category_name',
                        className: 'edit_write'
                	},
                    {
                        data: 'category_desc',
                    },
                    {
                        data: null,
                        render: function(data, type, full, meta){
                            if (data.category_status == 1) {
                                return '<div class="switch">\
                                            <div class="onoffswitch">\
                                                <input type="checkbox" checked class="onoffswitch-checkbox click" id="example'+data.category_id+'" value="'+data.category_id+'">\
                                                <label class="onoffswitch-label" for="example'+data.category_id+'">\
                                                    <span class="onoffswitch-inner"></span>\
                                                    <span class="onoffswitch-switch"></span>\
                                                </label>\
                                            </div>\
                                        </div>'
                            }else{
                                return '<div class="switch">\
                                            <div class="onoffswitch">\
                                                <input type="checkbox" class="onoffswitch-checkbox click" id="example'+data.category_id+'" value="'+data.category_id+'">\
                                                <label class="onoffswitch-label" for="example'+data.category_id+'">\
                                                    <span class="onoffswitch-inner"></span>\
                                                    <span class="onoffswitch-switch"></span>\
                                                </label>\
                                            </div>\
                                        </div>'
                            }
                        },
                        orderable: false
                    },
                	{
                		data: 'action',
                		orderable: false
                	},
                ],
                createdRow: function (row, data, index) {
                    $(row).attr("id",data['category_id']);
                }
            });
            // Status
            $(document).on('click','.click', function(e){
                e.preventDefault();
                var checked = $(this).is(':checked');
                var id = $(this).val();
                var action = 'category';
                var statusss = '';

                if (checked == true) {
                    statusss = 1;
                }else{
                    statusss = 2;
                }
                $.ajax({
                    type: 'post',
                    url: '{{ route('status.store') }}',
                    data: {statusss:statusss,id:id,action:action},
                    success:function(response){
                        toastr.success(response.message,'Notification');
                        $('#load_table').DataTable().ajax.reload();
                    }
                });
            });
            // Show Add
            $('#add_category').click(function(){
                $('#sample_form')[0].reset();
                $("#category_desc").text("");
                $('#message_err').text("");
                $('#message_err').removeClass("alert alert-danger");
                $('.modal-title').text("Add New Category");
                $('#action').val("Add");
                $('#Modal_sample').modal('show');
            });
            // Edit
            $(document).on('click','#edit', function(e){
                e.preventDefault();
                $('#sample_form')[0].reset();
                $('#message_err').text("");
                $('#message_err').removeClass("alert alert-danger");
                var category_id = $(this).data('category_id');

                $('#Modal_sample').modal('show');
                $.ajax({
                    type: "get",
                    url: "category/"+category_id+"/edit",
                    dataType: "json",
                    success:function(response){
                        if (response.status == 404) {
                            toastr.error(response.message,'Notification');
                        }else{
                            $('#category_id').val(category_id);
                            $('#slug_name').val(response.category.category_name);
                            $('#slug').val(response.category.slug_category_product);
                            $('#category_desc').text(response.category.category_desc);
                            $('#category_status').val(response.category.category_status);
                            $('#image_show').html('');
                            $('.modal-title').text("Edit Category");
                            $('#action').val("Edit");
                        }
                    }
                });
            });
            // Add & Update 
            $(document).on('submit','#sample_form', function(e){
                e.preventDefault();
                var category_id = $('#category_id').val();
                var action_url = '';
                var action_type= '';

                if($('#action').val() == 'Add')
                {
                    action_url = "{{ route('category.store') }}";
                    action_type = "POST";
                }

                if($('#action').val() == 'Edit')
                {
                    action_url = "category/"+category_id;
                    action_type = "PUT";
                }
                
                $.ajax({
                    type: action_type,
                    url: action_url,
                    data: {
                        category_name:          $('#slug_name').val(),
                        slug_category_product:  $('#slug').val(),
                        category_desc:          $('#category_desc').val(),
                        category_status:        $('#category_status').val(),
                    },
                    dataType:"json",
                    success:function(response){
                        if (response.status == 400) {
                            $('#message_err').html('');
                            $('#message_err').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values){
                                $('#message_err').append('\
                                    <li style="list-style-type: none;">'+err_values+'</li>')
                            });
                        }else{
                            setTimeout(function() {
                                toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 4000
                                };
                                toastr.success(response.message,'Notification');
                                $('#sample_form')[0].reset();
                                $('#Modal_sample').modal('hide');
                                $('#load_table').DataTable().ajax.reload();
                            }, 2000);
                        }
                    }
                });
            });
            // Show Delete
            $(document).on('click','.delete', function(){
                var category_id = $(this).data('category_id');
                $('#Modal_delete').modal('show');

                $.ajax({
                    type: "get",
                    url: "category/"+category_id+"/edit",
                    dataType: "json",
                    success:function(response){
                        if (response.status == 404) {
                            toastr.error(response.message,'Notification');
                        }else{
                            $('#hidden_id').val(category_id);
                            $('#body').html('');
                            $('#body').append(''+response.category.category_name+'');
                        }
                    }
                });
            });
            // Delete
            $(document).on('submit','#delete_form', function(e){
                e.preventDefault();
                var category_id = $('#hidden_id').val();

                $.ajax({
                    type: "delete",
                    url: "category/"+category_id,
                    dataType: "json",
                    beforeSend:function(){
                        $('#del_button').attr('disabled', true);
                    },
                    success:function(response){
                        if (response.status == 404) {
                            toastr.error(response.message,'Notification');
                        }else{
                            setTimeout(function(){
                                toastr.success(response.message,'Notification');
                                $('#Modal_delete').modal('hide');
                                $('#load_table').DataTable().ajax.reload();
                            }, 2000);
                        }
                    }
                });
            });
            // Sorting
            $('#sorting_orderby').sortable({
                palceholder: 'ui-state-highlight',
                update: function(event, ui){
                    var category_id_array = new Array();
                    $('#sorting_orderby tr').each(function(){
                        category_id_array.push($(this).attr('id'));
                    });

                    $.ajax({
                        type: 'post',
                        url: '{{ route('sorting.store') }}',
                        data: {category_id_array:category_id_array},
                        success:function(data){
                            $('#load_table').DataTable().ajax.reload();
                            setTimeout(function() {
                                toastr.options = {
                                closeButton: true,
                                progressBar: true,
                                showMethod: 'slideDown',
                                timeOut: 4000
                                };
                                toastr.success(data.message,'Notification');
                            }, 2000);
                        }
                    });
                }
            });


        });
    </script>
@endsection