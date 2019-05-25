
<div class="mail-option">
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
            @endif
        </ul>
    </div>
    {!! $emails->render('backend::pagination.email') !!}
</div>
<div class="clearfix"></div>
<div class="">
    <table class="table table-inbox table-hover">
        <tbody>
            @if(isset($emails) && count($emails) > 0)
            @foreach($emails as $mail)
            <tr class="{{($mail->is_read != 1) ? 'unread':''}}" id="email_{{$mail->id}}">
                <td class="inbox-small-cells">
                    <input type="checkbox" class="mail-checkbox my-mails" name="email-ids" value="{{$mail->id}}">
                </td>
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


<script type="text/javascript">
    $().ready(function () {
    $(".inbox-pagination li a").on('click', function (e) {
    e.preventDefault();
            var $this = $(this);
            var pageLink = $this.attr('href');
            if (pageLink){
    loadEmails(pageLink);
    }
    return false;
    });
    });
    
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


</script>
