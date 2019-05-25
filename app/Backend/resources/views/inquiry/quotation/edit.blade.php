@extends('backend::layouts.app')

@section('content')
<main class="main-content ">
    <section class="admin-general-information">
        <div class="container">
            <div class="quote_icon">
                <ul class="list-inline">
                    <li class="blue-color">
                        <a href="javascript:void(0)" onclick="toggleInquiryStatus({{$inquiry->id}}, 'Won', 'quotation'); return false;">
                            <i class="fa fa-trophy" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="pink-color">
                        <a href="javascript:void(0)" onclick="toggleInquiryStatus({{$inquiry->id}}, 'Lost', 'quotation'); return false;">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="green-color">
                        <a href="javascript:void(0)" data-toggle="tooltip" title="edit" onclick="makeEditable(this);"  data-placement="top" title="edit">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                        </a>
                    </li >
                    <li class="yellow-color">
                        <a href="#transfer-sales" data-toggle="modal">
                            <span dat>  <i class="fa fa-exchange" aria-hidden="true"></i> 
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="javascript:void(0)" onclick="getInquireForm({{$inquiry->id}})" aria-controls="inquiry-info" role="tab" data-toggle="tab" data-target="#inquiry-info">
<!--                            <span class="icon icon-info"></span>-->
                        <span> QUOTATION INQUIRY INFORMATION</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="javascript:void(0)" onclick="getEmailSection()" aria-controls="email" role="tab" data-toggle="tab" data-target="#email">
<!--                            <span class="icon icon-email"></span>-->
                        <span>  EMAIL</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="javascript:void(0)" onclick="getPanelsSection()" aria-controls="panels" role="tab" data-toggle="tab" data-target="#panels">
<!--                            <span class="icon icon-panels"></span>-->
                        <span>PANELS</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="javascript:void(0)" onclick="loadFolderSection({{$inquiry->id}});" aria-controls="folder" role="tab" data-toggle="tab" data-target="#folder">
<!--                            <span class="icon icon-folder"></span>-->
                        <span> FOLDER</span>
                    </a>
                </li>
            </ul>

            <div class="info-main-box mt-0 clearfix ">
                
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane m-t-20 active" id="inquiry-info"></div>
                        <div role="tabpanel" class="tab-pane" id="email">
                            <div class="Email-box">
                                <div class="content-heading">
                                    <h3>Email:</h3>
                                </div>
                                <div class="image">
                                    <div class="mail-box">
                                        <aside class="sm-side">
                                            <div class="inbox-body">
                                                <a href="" onclick="showComposeModel();
                                                                return false;" data-toggle="modal"  title="Compose" class="btn btn-compose">
                                                    Compose
                                                </a>
                                                <!-- Modal -->
                                                <!-- /.modal -->
                                            </div>
                                            <ul class="inbox-nav inbox-divider">
                                                <li class="active">
                                                    <a href="javascript:void(0)" onclick="getEmailSection();"><i class="fa fa-inbox"></i> Inbox     
                                                        <span class="label label-danger pull-right" id="unread-count" style="display:none">0</span>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" onclick="getEmailSection('sent');"><i class="fa fa-envelope-o"></i> Sent Mail</a>
                                                </li>
                                                <li>
                                                    <a href="#"><i class=" fa fa-trash-o"></i> Trash</a>
                                                </li>
                                            </ul>

                                        </aside>
                                        <aside class="lg-side">
                                            <div class="inbox-head">
                                                <h3>Inbox</h3>
                                            </div>
                                            <div class="inbox-body" id="load-emails">
                                            </div>
                                        </aside>
                                    </div>
                                    <div class="text_box" id="show-mail-body">

                                    </div>
                                </div>
                            </div>

                        </div>
                        <div role="tabpanel" class="tab-pane " id="panels"></div>
                        <div role="tabpanel" class="tab-pane" id="folder"></div>
                    </div>
                </div>
            </div>
        
    </section>

    <script>
                $('select.selectpicker').on('change', function () {
        $('#country_id').valid();
        });</script>
    @include('flash::message')

    <script type="text/javascript">
                $(document).ready(function () {
                getInquireForm('{{$inquiry-> id}}');
                $('[data-toggle="tooltip"]').tooltip();
        });
        
        function moveToInquiry(id) {
            var str = "";
                    $('.my-mails:checked').each(function() {
            str += $(this).val() + ',';
            });
            str = str.substr(0, str.length - 1); //Remove the trailing comma

            console.log(str);
            if(str == ''){
                swal('Info!','Please select atleast 1 email.','info');
                return false;
            }
            var url = '{{url("backend/emails/move-inquiry-emails")}}';
            $.ajax({
            url: url,
                    type: 'post',
                    data: {'id':id, '_token':'{{csrf_token()}}', 'email_ids':str},
            dataType: 'json',
                    success: function (res) {
                        if (res.success){
                            swal('Success!','Emails moved successfully.','success');
                            getEmailSection();
                        }else{
                            swal('Error!','Something went wrong, Please try again later.','error');
                        }
                    }
            });
            }
        function loadFolderSection(id){
        var url = '{{url("backend/directory/load-file-section")}}/' + id;
                $.ajax({
                url: url,
                        type: 'get',
                        data: '',
                        dataType: 'json',
                        success: function (res) {
                        $('#folder').html(res.html);
                        },
                        beforeSend:function(){
                        $('#folder').html('Loading...');
                        }
                });
        }

        function getInquireForm(id){
        var url = '{{url("backend/inquiry/get-inquiry-form")}}/' + id;
                $.ajax({
                url: url,
                        data: '',
                        success: function (res) {
                        $('#inquiry-info').html('');
                                $('#inquiry-info').html(res);
                                $('.country_selectpicker').selectpicker();
                                $('.load_value_selectpicker').selectpicker();
                                $(".datetimepicker2").datetimepicker({
                        format: "MM-DD-YYYY",
                                // autoclose: true,
                                //todayBtn: true,
                                //pickerPosition: "bottom-left"
                        });
                        }, beforeSend:function(){
                $('#inquiry-info').html('Loading...');
                }
                });
        }
        function getPanelsSection(){
        var url = '{{url("backend/inquiry/get-panels-section/".$quote_id."/".$version_id)}}';
                $.ajax({
                url: url,
                        type: 'get',
                        data: '',
                        dataType: 'json',
                        success: function (res) {
                        $('#panels').html(res.html);
                        },
                        beforeSend:function(){
                        $('#panels').html('Loading...');
                        }
                });
        }

        function getEmailSection(type){
        loader = '<i class="fa fa-spinner fa-pulse fa-1 fa-fw loader margin-bottom"></i>';
        var url = '{{url("backend/inquiry/get-email-section/".$quote_id)}}';
        if(type == 'sent'){
            url +='/'+type;
        }
                $.ajax({
                url: url,
                        type: 'get',
                        data: '',
                        dataType: 'json',
                        success: function (res) {
                        //$('#email').html(res.html);
                        $('#load-emails').html('');
                        $('#load-emails').html(res.html);
                        getUnreadCount();
                        },
                        beforeSend:function(){
                        $('#show-mail-body').html('');
                        
                        $('#load-emails').html(loader);
                        }
                });
        }

        function toggleInquiryStatus(id, status, type) {
        swal({
        title: 'Are you sure?',
                text: "{{(" + status + ") ? 'You want to update status!' : ''}}",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, do it!',
                cancelButtonText: 'No, cancel!',
                confirmButtonClass: 'blue-btn',
                cancelButtonClass: 'gray-btn',
                buttonsStyling: false
        }).then(function () {
        processToggelStatus(id, status, type);
        }, function (dismiss) {
        // dismiss can be 'cancel', 'overlay',
        // 'close', and 'timer'
        if (dismiss === 'cancel') {
        swal('Cancelled', 'Your record is safe :)', 'error')
        }
        })
        }
        function processToggelStatus(id, status, type){

        var url = '{{url("backend/inquiry/toggle-status")}}';
                $.ajax({
                url: url,
                        type: 'post',
                        data: {'id':id, 'status':status, 'type':type, '_token':'{{csrf_token()}}'},
                        dataType: 'json',
                        success: function (res) {
                        if (res.success){
                        swal('Success!', res.message, 'success');
                        } else{
                        swal('Error!', res.message, 'error');
                        }
                        }
                });
        }
        
        function getUnreadCount() {
        var url = '{{url("backend/emails/get-unread-count/".$quote_id)}}';
        $.ajax({
            url: url,
            type: 'get',
            data: {},
            dataType: 'json',
            success: function (res) {
                if (res.success) {
                    $('#unread-count').html(res.count).show();
                }
            }
        });
    }
    function showFiles() {
        var url = '{{url("backend/emails/show-files/".$quote_id)}}';
        $.ajax({
            url: url,
            type: 'get',
            data: {},
            dataType: 'json',
            success: function (res) {
                $('#load-files').html(res.html);
                $('#myModalAttachment').modal('show');
            }
        });
    }
    </script>  

    <div class="modal fade modal-style " id="transfer-sales" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <h3 class="heading">Inquiry has been transferred to Sales Manager</h3>
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-style " id="reject" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <h3 class="heading">Client has been Rejected Initial Proposal Quote !</h3>
                    <p>(Re-Negatiate Condition)</p>
                    <div  class="text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-style" id="congratulation-won" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <h3 class="heading">congratulations!!!</h3>
                    <h4 class="text-center"> You have Won The Project</h4>
                    <p>(Inquiry has been transferred to Account Department)</p>
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <!--modal-add-new-folder-->

    <!--modal-compose-email-message-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" data-easein="expandIn" role="dialog" tabindex="-1" id="myModal" class="modal fade modal-style" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h3 class="modal-title compose-heading">Compose</h3>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>To</label>

                                <input type="text" placeholder="" id="inputEmail1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Cc / Bcc</label>

                                <input type="text" placeholder="" id="cc" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Subject</label>

                                <input type="text" placeholder="" id="inputPassword1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class=" col-lg-12 text-center">
                                <span class="file-attachment text-center">
                                    <span class="btn btn-default btn-file">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Attachment 
                                        <input type="file">
                                    </span>
                                </span>
                                <button class="btn btn-send" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
    @endsection
