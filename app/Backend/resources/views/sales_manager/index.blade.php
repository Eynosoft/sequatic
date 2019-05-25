<?php 
    use App\common\helpers\User;
?>
@extends('backend::layouts.app')
@section('content')
<div class="admin_content admin-general-information">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="admin_main_heading">{{User::getRoleName()}} Dashboard</h2>
            </div>
        </div>
        <div class="row main_info_box" id="load-general-inquiry-statics">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 xs-full">
                <div class="box_cnt">
                    <div class="count" id="total_salesrep"><i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i></div>
                    <div>Total Sales Manager</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 xs-full">
                <div class="box_cnt">
                    <div class="count" id="total_deactive"><i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i></div>
                    <div>Total Deactivate Sales Manager</div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 xs-full">
                <div class="box_cnt">
                    <div class="count" id="total_active"><i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i></div>
                    <div>Total Activate Sales Manager</div>
                </div>
            </div>
        </div>
        <section class="section_padding">
            <div class="panel panel-default">
                <div class=" col-lg-12 search_bar">
                       <div class="row search_section">
                            <div class="col-lg-3">
                                <div class="heading text-center">
                                    <h3>Sales Manager User List</h3>
                                </div>
                            </div>
                            <div class=" col-lg-9 col-md-12">
                                <form name="searchform" id="searchform">
                                <div class="col-lg-4 col-md-4 col-sm-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Name" name="keyword" >
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-6">
                                    <div class="form-group">
                                        <select class="selectpicker form-control "  title="Country" name="country">
                                            <option>India</option>
                                        </select>
                                        {{csrf_field()}}
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 ">
                                    <button class="search_btn"  onclick="loadSalesManager(); return false;">Search</button>
                                    <button type="button" class="search_btn color-green" onclick="loadAddModal();"><i class="fa fa-plus"></i>Add Sales Manager</button>
                                </div>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body table-data-load" style="padding:0px" id="load-general-inquiry">
                    <i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom">
                        
                    </i>
                
                </div>
            </div>
        </section>
    </div>
</div> 
<!--Transfer to sales manager-modal-->
<div aria-hidden="true" aria-labelledby="myModalLabel" data-backdrop="static" data-easein="expandIn" role="dialog" tabindex="-1" id="addSales-rep" class="modal fade modal-style">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h3 class="modal-title compose-heading">Add Sales Manager</h3>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal" name="salesrep_form" action="{{url("backend/sales-manager/create")}}" id="salesrep_form" method="post">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" placeholder="Name" name="first_name"  class="form-control">
                            </div>
                        </div>
                         <div class="col-lg-12">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" placeholder="Name" name="last_name"  class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" placeholder="Email" name="email" class="form-control">
                            </div>
                        </div>
                        
                         <div class="col-lg-12">
                            <div class="form-group">
                                <label>Phone</label>
                                <input type="text" class="form-control" data-masked-input="999-999-9999" maxlength="12" name="mobile" placeholder="Phone Number">
                            </div>
                        </div>
                        
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Country</label>
                                <select class="form-control "  id="country_id" name="country_id">
                                     <option value="">Select Country</option>
                                    @if(isset($country) && count($country) > 0)
                                        @foreach($country as $count)
                                            <option value="{{$count->id}}">{{$count->country_name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        {{csrf_field()}}
                        <div class="form-group">
                            <div class=" col-lg-12 text-center">
                                <button class="btn blue-btn" id="form-button" type="submit">Submit <i class="fa fa-spinner fa-pulse fa-1 form-loader" style="display:none"></i></button>
                                <button class="btn btn-gray" type="reset">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

{!! JsValidator::formRequest('App\Backend\Http\Requests\addUserRequest','#salesrep_form') !!}

   <!--Transfer to sales manager-modal-->
<div aria-hidden="true" aria-labelledby="myModalLabel" data-backdrop="static" data-easein="expandIn" role="dialog" tabindex="-1" id="editSales-rep" class="modal fade modal-style">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">x</button>
                    <h3 class="modal-title compose-heading">Edit Sales Manager</h3>
                </div>
                <div class="modal-body" id="editSalesData"> 
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<script type="text/javascript">
    $(document).ready(function () {
        loadSalesManager();
        loadSalesManagerStatics();
        $(".datetimepicker").datetimepicker({
            format: "MM-DD-YYYY",
            // autoclose: true,
            //todayBtn: true,
            //pickerPosition: "bottom-left"
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
    
   
    $('select.selectpicker').on('change', function(){
        $('#country_id').valid();
    });

    function loadSalesManager(url) {
        //$('#load-general-inquiry').html(loader);
        if (url == 'undefined' || url == '' || url == null) {
            url = '{{url("backend/load-sales-manager")}}';
        }
        $.ajax({
            url: url,
            type: 'post',
            data: $('#searchform').serialize(),
            dataType: 'json',
            success: function (res) {
                $('#load-general-inquiry').html('');
                $('#load-general-inquiry').html(res.html);
            }
        });
    };
    function loadSalesManagerStatics() {
        var url = '{{url("backend/load-sales-manager-statics")}}';
        $.ajax({
            url: url,
            type: 'post',
            data: {'_token':'{{csrf_token()}}'},
            dataType: 'json',
            success: function (res) {
                $('#total_salesrep').html(res.total_salesrep);
                $('#total_deactive').html(res.total_deactive);
                $('#total_active').html(res.total_active);
            }
        });
    };
    
    function loadAddModal() {
        
        $('#salesrep_form')[0].reset();
        var validator = $( "#salesrep_form" ).validate();
        validator.resetForm();
        $('.has-error').removeClass('has-error');
        $('#addSales-rep').modal('show');
    };
    
    $('#salesrep_form').on('submit',function(){
        if($(this).valid()){
            console.log('yes');
            var res = create();
            return false;
        }else{
            console.log('errors');
        }
    });
    
    function create() {
         $(".form-loader").show();
         $('#form-button').prop('disabled', true);
        var url = '{{url("backend/sales-manager/create")}}';
        $.ajax({
            url: url,
            type: 'post',
            data: $('#salesrep_form').serialize(),
            dataType: 'json',
            success: function (res) {
                if(res.success){
                    $('#addSales-rep').modal('hide');
                    swal('Success!',res.message,'success');
                     loadSalesManager();
                     loadSalesManagerStatics();
                }else{
                     swal('Success!',res.message,'success');
                     swal('Error!',res.message,'error');
                }
            },
            error: function (data) {
                    var obj = jQuery.parseJSON(data.responseText);
                    for (var x in obj) {
                        var errors = obj[x].length
                        $('#' +x+'-error' ).html(obj[x]);
                        $('#' +x+'-error' ).css("color", '#b30000');
                        $('#' +x+'-error' ).parent('.form-group').removeClass('has-success').addClass('has-error');
                    }
                },
                complete: function(){
                     $('#form-button').prop('disabled', false);
                     $(".form-loader").hide();
                }
        });
    };
    
    
    function update() {
         $(".form-loader").show();
         $('#edit-form-button').prop('disabled', true);
        var url = '{{url("backend/sales-manager/update")}}';
        $.ajax({
            url: url,
            type: 'post',
            data: $('#editsalesrep_form').serialize(),
            dataType: 'json',
            success: function (res) {
                if(res.success){
                    $('#editSales-rep').modal('hide');
                    swal('Success!',res.message,'success');
                     loadSalesManager();
                }else{
                     swal('Success!',res.message,'success');
                     swal('Error!',res.message,'error');
                }
            },
            error: function (data) {
                    var obj = jQuery.parseJSON(data.responseText);
                    for (var x in obj) {
                        var errors = obj[x].length
                        $('#' +x+'-error' ).html(obj[x]);
                        $('#' +x+'-error' ).css("color", '#b30000');
                        $('#' +x+'-error' ).parent('.form-group').removeClass('has-success').addClass('has-error');
                    }
                },
                complete: function(){
                     $('#edit-form-button').prop('disabled', false);
                     $(".form-loader").hide();
                }
        });
    };
    
    function loadSalesRepEdit(id) {
       
        url = '{{url("backend/sales-manager/edit")}}/'+id;
        $.ajax({
            url: url,
            type: 'get',
            //data: $('#searchform').serialize(),
            dataType: 'json',
            success: function (res) {
                $('#editSalesData').html('');
                $('#editSalesData').html(res.html);
                $('#editSales-rep').modal('show');
            }
        });
    };
    
    
</script>
@endsection
