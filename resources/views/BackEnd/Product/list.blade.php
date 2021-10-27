@extends('LayoutBackEnd')
@section('title')    
  Products
@endsection
@section('content') 

        <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-lg-10">
                <h2>Tables Product</h2>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item">
                        <a>Product</a>
                    </li>
                    <li class="breadcrumb-item active">
                        <strong>List Product</strong>
                    </li>
                </ol>
            </div>
            <div class="col-lg-2">

            </div>
        </div>       
        <div class="wrapper wrapper-content animated fadeInRight">
            <div class="row">
                <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>Product</h5>
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

                        <div class="table-responsive">
                    <table id="data_load" class="table table-striped table-bordered table-hover dataTables-example" >
                    <thead>
                    <tr style="text-transform: capitalize;">
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>Name</th>
                        <th>gallery</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>price</th>
                        <th>view</th>
                        <th>date sale</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </thead>

                    <tfoot>
                    <tr style="text-transform: capitalize;">
                        <th><input type="checkbox" id="checkAll_footer"><button id="deleteAllcheck" class="ladda-button btn btn-danger none" data-style="expand-right">Delete</button></th>
                        <th>Name</th>
                        <th>gallery</th>
                        <th>Image</th>
                        <th>Quantity</th>
                        <th>price</th>
                        <th>view</th>
                        <th>date sale</th>
                        <th>status</th>
                        <th>Action</th>
                    </tr>
                    </tfoot>
                    </table>
                        </div>

                    </div>
                </div>
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
                    <input type="hidden" name="hidden_id_product" id="hidden_id_product">
                    <div class="modal-body">
                        <p>Are you sure delete "<span id="body_product"></span>"?</p>
                    </div>
                    <form method="POST" id="delete_product">
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">No</button>
                        <button type="submit" class="ladda-button btn btn-danger" data-style="expand-right">Yes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
@section('script')    
<script type="text/javascript">
$(document).ready(function(){
    // Load data
    $('#data_load').DataTable({
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
            {extend: 'excel', title: 'productFile'},
            {extend: 'pdf', title: 'productFile'},

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
            url: "{{ route('product.index') }}",
        },
        columns: [
            {
                data: null,
                className: 'tdcheckbox',
                render: function(data, type, full, meta){
                    return '<input type="checkbox" name="ids" id="ids" class="checkboxclass" value="'+data.product_id+'">';
                },
                orderable: false
            },
            {data: 'product_name'},
            {data: 'gallery_td'},
            {
                data: null,
                render: function(data, type, full, meta){
                    return "<img src=uploads/product/" + data.product_image + " width='80px' height='80px' class='img-thumbnail' />";
                },
                orderable: false
            },
            {data: 'product_quantity'},
            {data: 'price_td'},
            {data: 'product_view'},
            {data: 'product_date_sale'},
            {
                data: null,
                render: function(data, type, full, meta){
                    if (data.product_status == 1) {
                        return '<div class="switch">\
                                    <div class="onoffswitch">\
                                        <input type="checkbox" checked class="onoffswitch-checkbox click" id="example'+data.product_id+'" value="'+data.product_id+'">\
                                        <label class="onoffswitch-label" for="example'+data.product_id+'">\
                                            <span class="onoffswitch-inner"></span>\
                                            <span class="onoffswitch-switch"></span>\
                                        </label>\
                                    </div>\
                                </div>'
                    }else{
                        return '<div class="switch">\
                                    <div class="onoffswitch">\
                                        <input type="checkbox" class="onoffswitch-checkbox click" id="example'+data.product_id+'" value="'+data.product_id+'">\
                                        <label class="onoffswitch-label" for="example'+data.product_id+'">\
                                            <span class="onoffswitch-inner"></span>\
                                            <span class="onoffswitch-switch"></span>\
                                        </label>\
                                    </div>\
                                </div>'
                    }
                },
            },
            {
                data: 'action',
                orderable: false
            },
        ]

    });
    // Status
    $(document).on('click','.click', function(e){
        e.preventDefault();
        var checked = $(this).is(':checked');
        var id = $(this).val();
        var action = 'product';
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
                $('#data_load').DataTable().ajax.reload();
            }
        });
    });
    // Show Delete
    $(document).on('click','.delete', function(e){
        e.preventDefault();
        var id = $(this).data('id_product');
        $('#Modal_delete').modal('show');

        $.ajax({
            type: "get",
            url: "product/"+id+"/edit",
            dataType: "json",
            success:function(response){
                if (response.status == 404) {
                    toastr.error(response.message,'Notification');
                }else{
                    $('#hidden_id_product').val(response.product.product_id);
                    $('#body_product').html('');
                    $('#body_product').append(''+response.product.product_name+'');
                }
            }
        });
    });
    // Delete
    $(document).on('submit','#delete_product', function(e){
        e.preventDefault();
        var product_id = $('#hidden_id_product').val();
        let Editform = new FormData($('#delete_product')[0]);
        $.ajax({
            type: "delete",
            url: "product/"+product_id,
            data: Editform,
            contentType: false,
            processData: false,
            dataType: "json",
            success:function(response){
                if (response.status == 404) {
                    toastr.error(response.message,'Notification');
                }else{
                    $('#data_load').DataTable().ajax.reload();
                    setTimeout(function() {
                        toastr.options = {
                        closeButton: true,
                        progressBar: true,
                        showMethod: 'slideDown',
                        timeOut: 4000
                        };
                        toastr.success(response.message,'Notification');
                        $('#Modal_delete').modal('hide');
                    }, 2000);
                }
            }
        });
    });
    // Delete All
    $(document).on('click','#deleteAllcheck', function(e){
        e.preventDefault();
        var allids = [];
        var action = 'product';
        $('input:checkbox[name=ids]:checked').each(function(){
            allids.push($(this).val());
        });

        $.ajax({
            type: 'post',
            url: '{{ route('remove.store') }}',
            data: {allids:allids,action:action},
            success:function(response){
                if (response.status == 200) {
                    $('#data_load').DataTable().ajax.reload();
                    $('#deleteAllcheck').addClass('none');
                    setTimeout(function() {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            showMethod: 'slideDown',
                            timeOut: 4000
                        };
                        toastr.success(response.message,'Notification');
                    }, 2000);
                }else{
                    setTimeout(function() {
                        toastr.options = {
                            closeButton: true,
                            progressBar: true,
                            showMethod: 'slideDown',
                            timeOut: 4000
                        };
                        toastr.error(response.message,'Notification');
                    }, 2000);
                    $('#deleteAllcheck').addClass('none');
                }
            }
        });
    });

});
</script>
@endsection