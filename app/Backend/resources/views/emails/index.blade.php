@extends('backend::layouts.app')

@section('content')
<div class="admin_content admin-general-information">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="trash_heading">Global Mail Inbox</h2>
            </div>
        </div>

        <section class="section_padding">

            <div class="panel panel-default">
                <div class=" col-lg-12 text-right search_bar">
                    <div class="row search_section">
                        <!--                        <div class="col-lg-7">
                                                    <div class="heading text-center">
                                                        <h3>Trash Inquiry</h3>
                                                    </div>
                                                </div>-->
                        <div class="pull-right col-lg-4">
                            <form name="searchform" id="searchform">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 xs-full">
                                    <div class="form-group">
                                        <div class='input-group date datetimepicker'>
                                            <input type='text' name="created_at" class="form-control" placeholder="Date" />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-6 xs-full">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control" placeholder="keyword">
                                        {{csrf_field()}}
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-4 col-sm-2 col-xs-2 xs-full text-center">
                                    <button class="search_btn" onclick="loadEmails();
                                            return false;">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="info-main-box mt-0 clearfix">
                    <div class="panel-body" style="padding:0px">
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
                                                <a href="javascript:void(0)" onclick="loadEmails();"><i class="fa fa-inbox"></i> Inbox     
                                                    <span class="label label-danger pull-right" id="unread-count" style="display:none">0</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-envelope-o"></i> Sent Mail</a>
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
                </div>
            </div>
        </section>
    </div>
</div> 

<!--modal-compose-email-message-->
<div aria-hidden="true" aria-labelledby="myModalLabel" data-backdrop="static" data-easein="expandIn" role="dialog" tabindex="-1" id="myModal" class="modal fade modal-style" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h3 class="modal-title compose-heading">Compose</h3>
            </div>
            <div class="modal-body">
                <form role="form" class="clearfix" id="compose-form">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>To</label>
                                <input type="text" placeholder="" name="email_to" id="inputEmail" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6"">
                            <div class="form-group">
                                <label>Cc</label>
                                <input type="text" placeholder="" name="email_cc" id="cc" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6"">
                            <div class="form-group">
                                <label>Bcc</label>
                                <input type="text" placeholder="" name="email_bcc" id="bcc" class="form-control">
                            </div>
                        </div>

                        <div class="col-sm-6"">
                            <div class="form-group">
                                <label>Subject</label>
                                <input type="text" placeholder=""  name="subject" id="bcc" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="10" cols="30" class="form-control" name="email_body" id="" name=""></textarea>
                                <input type="hidden" id="attachments" name="attachments">
                                {{csrf_field()}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group" id="attachments-all">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-lg-12 text-center">
                            <div class="form-group">
                                <span class="file-attachment text-center">
                                    <span class="btn btn-default btn-file" id="show-all-files" onclick="showFiles();">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Attachment 

                                    </span>
                                </span>
                                <input class="btn btn-send" type="submit" value="Send">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
{!! JsValidator::formRequest('App\Backend\Http\Requests\globalSendMailRequest','#compose-form') !!}





<!--modal-select file-->
<div aria-hidden="true" aria-labelledby="myModalLabel" data-easein="expandIn" data-backdrop="static" role="dialog" tabindex="-1" id="myModalAttachment" class="modal fade modal-style" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h3 class="modal-title compose-heading">Choose files</h3>
            </div>
            <div class="modal-body" id="load-files">

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<script type="text/javascript">
    $(document).ready(function () {
        loader = '<i class="fa fa-spinner fa-pulse fa-1 fa-fw loader margin-bottom"></i>';
        loadEmails();

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
                            loadEmails();
                        }else{
                            swal('Error!','Something went wrong, Please try again later.','error');
                        }
                    }
            });
            }
            
    function loadEmails(url) {
        $('#load-emails').html(loader);
        if (url == 'undefined' || url == '' || url == null) {
            url = '{{url("backend/emails/load-emails")}}';
        }
        $.ajax({
            url: url,
            type: 'post',
            data: $('#searchform').serialize(),
            dataType: 'json',
            success: function (res) {
                $('#load-emails').html('');
                $('#load-emails').html(res.html);
                getUnreadCount();
            }
        });
    }
    ;

    function syncEmails() {
        $('#load-emails').html(loader);
        var url = '{{url("backend/emails/sync-emails")}}';
        $.ajax({
            url: url,
            type: 'get',
            data: {},
            dataType: 'json',
            success: function (res) {
                loadEmails();
            }
        });
    }
    ;

    function getUnreadCount() {
        var url = '{{url("backend/emails/get-unread-count")}}';
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
    ;

    function showFiles() {
        var url = '{{url("backend/emails/show-files/64")}}';
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
    ;
    function showComposeModel() {
        $('#attachments-all').html('');
        $('#compose-form')[0].reset();
        $('#myModal').modal('show');
    }

    $('#compose-form').on('submit', function () {
        var onclick = $('#show-all-files').attr('onclick');
        $('#show-all-files').removeAttr('onclick');
        $('.btn-send').val('wait..');
        $('.btn-send').attr('disabled', true);
        if ($(this).valid()) {
            // do your ajax stuff here
            var url = '{{url("backend/emails/global-send-mail")}}';
            var val = [];
            var str = '';
            $('#attachments-all a').each(function (i) {
                val[i] = $(this).attr('href');
            });
            $('#attachments').val(val);
            $.ajax({
                url: url,
                type: 'post',
                data: $('#compose-form').serialize(),
                dataType: 'json',
                success: function (res) {
                    $('#myModal').modal('hide');
                    if (res.success) {
                        setTimeout(function () {
                            swal('Success!', res.message, 'success');
                        }, 1);
                    } else {
                        setTimeout(function () {
                            swal('Error!', res.message, 'error');
                        }, 1);
                    }
                },
                complete: function (data) {
                    $('#show-all-files').attr('onclick', onclick);
                    $('.btn-send').val('Send');
                    $('.btn-send').attr('disabled', false);
                }
            });
            return false;
        } else {
            console.log('still errors');
            $('#show-all-files').attr('onclick', onclick);
            $('.btn-send').val('Send');
            $('.btn-send').attr('disabled', false);
            return false;
        }
        return false;
    });
</script>
@endsection

