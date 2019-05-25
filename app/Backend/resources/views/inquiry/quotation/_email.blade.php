<div class="mail-option">
    @if(!empty($email_type) && $email_type == 'recieved')
    <div class="chk-all">
        <input type="checkbox" name="check-all" class="mail-checkbox mail-group-checkbox all-mails"/>
        <!--        <div class="btn-group">
                    <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                        All
                        <i class="fa fa-angle-down "></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="#"> None</a></li>
                        <li><a href="#"> Read</a></li>
                        <li><a href="#"> Unread</a></li>
                    </ul>
                </div>-->
    </div>

    <div class="btn-group">
        <a data-original-title="Refresh" onclick="syncEmails();" data-placement="top" data-toggle="dropdown" href="javascript:void(0)" class="btn mini tooltips">
            <i class=" fa fa-refresh"></i>
        </a>
    </div>
    <div class="btn-group">
        <a data-toggle="dropdown" href="#" class="btn mini blue">
            Move to
            <i class="fa fa-angle-down "></i>
        </a>
        <ul class="dropdown-menu">
            @if(!empty($move_to) && count($move_to) > 0)
            @foreach($move_to as $iid)  
            <li><a href="javascript:void(0);" onclick="moveToInquiry('{{$iid->id}}')"> {{$iid->inquiry_number}} </a></li>
            @endforeach
            @else
            <li><a href="javascript:void(0);" onclick="moveToInquiry('global')">Global Inbox </a></li>
            @endif
        </ul>
    </div>
    @endif
    {!! $emails->render('backend::pagination.email') !!}
</div>
<div class="clearfix"></div>
<div class="">
    <table class="table table-inbox table-hover">
        <tbody>
            @if(isset($emails) && count($emails) > 0)
            @foreach($emails as $mail)
            <tr class="{{($mail->is_read != 1) ? 'unread':''}}" id="email_{{$mail->id}}">
                @if(!empty($email_type) && $email_type == 'recieved')
                <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox my-mails" name="email-ids" value="{{$mail->id}}">
                </td>
                @endif
                <td class="view-message  dont-show" onclick="showDetail({{$mail->id}},{{$mail->is_read}});">{{$mail->from_name}}</td>
                <td class="view-message " onclick="showDetail({{$mail->id}},{{$mail->is_read}});">{{$mail->email_subject}}</td>
                <td class="view-message  inbox-small-cells" onclick="showDetail({{$mail->id}},{{$mail->is_read}});">{!!($mail->has_attachment) ? '<i class="fa fa-paperclip"></i>' : ''; !!}</td>
                <td class="view-message  text-right" onclick="showDetail({{$mail->id}},{{$mail->is_read}});"> 
                    @if(\Carbon\Carbon::parse($mail->date_time)->format('Y-m-d') == \Carbon\Carbon::now()->format('Y-m-d'))
                    {{\Carbon\Carbon::parse($mail->date_time)->format('h:i A')}}
                    @else
                    {{\Carbon\Carbon::parse($mail->date_time)->format('M d')}}
                    @endif
                </td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="5" style="text-align: center;">No emails found.</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>
<!--modal-compose-email-message-->
<div aria-hidden="true" aria-labelledby="myModalLabel" data-backdrop="static" data-easein="expandIn" role="dialog" tabindex="-1" id="myModal" class="modal fade modal-style" style="display: none;">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                <h3 class="modal-title compose-heading">Compose Email</h3>
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
                        <div class="col-sm-6">
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
                                <input type="hidden" id="inquiry_id" name="inquiry_id" value="{{$quote_id}}">
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
                                @if(!empty($inquiry_type) && $inquiry_type !== 'General')
                                <span class="file-attachment text-center">
                                    <span class="btn btn-default btn-file" id="show-all-files" onclick="showFiles();">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Attachment 

                                    </span>
                                </span>
                                @endif
                                <input class="btn btn-send" type="submit" value="Send">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

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
{!! JsValidator::formRequest('App\Backend\Http\Requests\globalSendMailRequest','#compose-form') !!}
<script>

            $(".my-mails").change(function(){
                var a = $('.my-mails');
                if (a.length == a.filter(":checked").length){
                    $('.all-mails').prop('checked', true);
                } else{
                    $('.all-mails').removeAttr('checked');
                }
            });
            $(".all-mails").change(function(){
                if ($(this).is(':checked')){
                    $('.my-mails').each(function(){
                        $(this).prop('checked', true);
                    });
                } else{
                    var a = $('.my-mails');
                    $('.my-mails').each(function(){
                        $(this).removeAttr('checked');
                    });
                }
            });

            function showDetail(id, status) {
            var url = '{{url("backend/emails/show-email-detail/")}}';
                    $.ajax({
                    url: url,
                            type: 'post',
                            data: {'id':id, '_token':'{{csrf_token()}}'},
                            dataType: 'json',
                            success: function (res) {
                            $('#show-mail-body').html(res.html);
                                    if (status != 1){
                            markAsRead(id);
                            }
                            }
                    });
            }

            function markAsRead(id) {
            var url = '{{url("backend/emails/mark-as-read/")}}';
                    $.ajax({
                    url: url,
                            type: 'post',
                            data: {'id':id, '_token':'{{csrf_token()}}'},
                            dataType: 'json',
                            success: function (res) {
                            $('#email_' + id).removeClass('unread');
                                    getUnreadCount();
                            }
                    });
            }

            function syncEmails() {
            $('#load-emails').html(loader);
                    var url = '{{url("backend/emails/sync-emails")}}';
                    $.ajax({
                    url: url,
                            type: 'get',
                            data: {},
                            dataType: 'json',
                            success: function (res) {
                            getEmailSection();
                            }
                    });
            };
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