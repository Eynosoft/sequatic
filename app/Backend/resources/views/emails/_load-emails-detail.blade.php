<?php
 use App\common\helpers\Utility;
?>
@if(isset($email))
<div class="content-heading">
    <h3 message-subject>{{$email->email_subject}}</h3>
</div>
<div class="details">
    <p id="message-body">{!! ($email->email_html_body) ? $email->email_html_body : $email->email_text_body !!}</p>
    @if($email->has_attachment && count(json_decode($email->attachments)) > 0) 
        @foreach(json_decode($email->attachments) as $file)
            @if($email->email_type == 'sent')
                 <a href="{{url('public/'.$file)}}" target="_blank">{{Utility::getFileName($file)}}</a>
            @else
                <a href="{{url('public/attachments/'.$file)}}" target="_blank">{{$file}}</a>
            @endif
        @endforeach
    @endif
     @if($email->email_type !== 'sent')
    <div class="btn_box">
        <a  class="btn blue-btn"  href="#myModal" data-toggle="modal">Reply</a>
        <a class="btn blue-btn" href="#myModal" data-toggle="modal">Reply To</a>
        <a class="btn blue-btn" href="#myModal" data-toggle="modal">Forword</a>
    </div>
     @endif
</div>
 @endif
   
