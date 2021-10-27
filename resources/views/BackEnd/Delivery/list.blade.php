@extends('LayoutBackEnd')
@section('title')    
  Transport Fee
@endsection
@section('content') 
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-title">
                        <h5>List Transport Fee</h5>
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
                            <div class="table-responsive">
                                <table id="sample_data" class="table table-striped table-bordered table-hover">
                                    <thead>
                                        <tr style="text-transform: capitalize;">
                                            <th>ID</th>
                                            <th>city</th>
                                            <th>District</th>
                                            <th>wards</th>
                                            <th>fee ship</th>
                                        </tr>
                                    </thead>
                                    <tbody id="load_delivery">
                                    </tbody>
                                    <tfoot>
                                        <tr style="text-transform: capitalize;">
                                            <th>ID</th>
                                            <th>city</th>
                                            <th>District</th>
                                            <th>wards</th>
                                            <th>fee ship</th>
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
    {{-- Add --}}
    <div class="modal inmodal" id="Modal_sample" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button style="margin-top: -5%" type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title"></h4>
                    <small class="font-bold">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                </div>
                <form id="add_delivery" method="POST">
                    <div class="modal-body">
                        <div id="message_err"></div>
                        <div class="hr-line-dashed"></div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">City <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <select class="form-control choose" name="city" id="city">
                                    <option value="">Select City</option>
                                    @foreach ($citys as $row)
                                        <option value="{{ $row->matp }}">{{ $row->name_city }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Province <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <select class="form-control choose" name="province" id="province">
                                    <option value="">Select Province</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Wards <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10">
                                <select class="form-control" name="wards" id="wards">
                                    <option value="">Select Wards</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Fee Ship <sup class="text-danger">*</sup></label>
                            <div class="col-sm-10 input-group">
                                <input type="text" data-mask="999,999" class="form-control" id="slug_name" onkeyup="ChangeToSlug();">
                                <input type="hidden" class="form-control" name="fee_ship" id="slug">
                                <span class="input-group-addon">
                                    <span>VNĐ</span>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="submit" name="action_button" id="action_button" class="ladda-button btn btn-primary" data-style="expand-right">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style type="text/css">
        .hiddenColumn{
            display: none;
        }
    </style>
@endsection

@section('script')   
    <script type="text/javascript">
        $(document).ready(function(){
            // Load Data
            $('#sample_data').DataTable({
                destroy: true,
                processing: true,
                serverSide: true,
                pageLength: 10,
                responsive: true,
                order:[],
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    {extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel', title: 'SliderFile'},
                    {extend: 'pdf', title: 'SliderFile'},

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
                    url: '{{ route('delivery.index') }}',
                    type:"get",
                },
                createdRow:function(row, data, rowIndex)
                {
                    if (data[0] == 1) { 
                        $('td', row).css('background-color', '#f6ffed');
                        $('td', row).css('color', '#52c41a');
                        $('td', row).css('border-color', '#b7eb8f');
                    }
                    $.each($('td', row), function(colIndex){
                        if(colIndex == 1)
                        {
                            $(this).attr('data-name', 'fee_matp');
                            $(this).attr('class', 'fee_matp');
                            $(this).attr('data-type', 'text');
                            $(this).attr('data-pk', data[5]);
                        }
                        if(colIndex == 2)
                        {
                            $(this).attr('data-name', 'fee_maqh');
                            $(this).attr('class', 'fee_maqh');
                            $(this).attr('data-type', 'text');
                            $(this).attr('data-pk', data[5]);
                        }
                        if(colIndex == 3)
                        {
                            $(this).attr('data-name', 'fee_xaid');
                            $(this).attr('class', 'fee_xaid');
                            $(this).attr('data-type', 'text');
                            $(this).attr('data-pk', data[5]);
                        }
                        if(colIndex == 4)
                        {
                            $(this).attr('data-name', 'fee_feeship');
                            $(this).attr('class', 'fee_feeship');
                            $(this).attr('name', 'fee_feeship');
                            $(this).attr('data-type', 'number');
                            $(this).attr('contenteditable', 'true');
                            $(this).attr('data-pk', data[5]);
                        }
                        if (colIndex == 5) {
                            $(this).attr('style', 'display: none');  
                        }
                    });
                }
            });
            // Change
            $('.choose').on('change',function(){
                var action = $(this).attr("id");
                var ma_id = $(this).val();
                var result = '';

                if(action=='city'){
                    result = 'province';
                }else{
                    result = 'wards';
                }
                $.ajax({
                    url : 'delivery/'+action,
                    method: 'get',
                    dataType: 'json',
                    data:{action:action,ma_id:ma_id},
                    success:function(response){
                       // $('#'+result).html(data);    
                        if (action == 'city') {
                            $.each(response.output, function(key, row){
                                $('#province').append('<option value="'+row.maqh+'">'+row.name_quanhuyen+'</option>');
                            });

                       }
                       if (action == 'province') {
                            $.each(response.output, function(key, row){
                                $('#wards').append('<option value="'+row.xaid+'">'+row.name_xaphuong+'</option>');
                            });
                       }  
                    }
                });
            });
            // Show Add
            $('#add_delivery').click(function(){
                $('#Modal_sample').modal('show');
                $('.modal-title').text('Add Transport Fee');
            });
            // Add
            $(document).on('submit','#add_delivery', function(e){
                e.preventDefault();

                $.ajax({
                    type: 'post',
                    url: '{{ route('delivery.store') }}',
                    data: {
                        city:$('#city').val(),
                        province:$('#province').val(),
                        wards:$('#wards').val(),
                        fee_ship:$('#slug').val(),
                    },
                    dataType: 'json',
                    success:function(response){
                        if (response.status == 400) {
                            $('#message_err').html('');
                            $('#message_err').addClass('alert alert-danger');
                            $.each(response.errors, function(key, err_values){
                                $('#message_err').append('\
                                    <li style="list-style-type: none;">'+err_values+'</li>')
                            });
                        }else{
                            $('#sample_data').DataTable().ajax.reload();
                            setTimeout(function() {
                                    toastr.options = {
                                    closeButton: true,
                                    progressBar: true,
                                    showMethod: 'slideDown',
                                    timeOut: 4000
                                };
                                toastr.success(response.message,'Notification');
                                $('#message_err').html('');
                                $('#city').val('');
                                $('#province').val('');
                                $('#wards').val('');
                                $('#slug_name').val('');
                                $('#message_err').removeClass('alert alert-danger');  
                                $('#Modal_sample').modal('hide');  
                            }, 2000);
                        }
                    }
                });
            });
            // Update
            $(document).on('blur','.fee_feeship',function(){

                var feeship_id = $(this).data('pk');

                $.ajax({
                    type: 'put',
                    url : 'delivery/'+feeship_id,
                    data:{
                        fee_value:$(this).text()
                    },
                    success:function(response){
                        if (response.status == 404) {
                            toastr.error(response.message,'Notification');
                        }else if (response.status == 400) {
                            $.each(response.errors, function(key, err_values){
                                toastr.error(err_values,'Notification');
                            });
                            $('#sample_data').DataTable().ajax.reload();
                        } else{
                            $('#sample_data').DataTable().ajax.reload();
                            setTimeout(function() {
                                    toastr.options = {
                                    closeButton: true,
                                    progressBar: true,
                                    showMethod: 'slideDown',
                                    timeOut: 4000
                                };
                                toastr.success(response.message,'Notification');
                            }, 2000);
                        }
                    }
                });

            });


        });
    </script>

@endsection