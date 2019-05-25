@extends('backend::layouts.app')

@section('content')

<section class="admin-general-information ">  
    <div class="container">
        <div class="heading">
            <h2>General Inquiry Information</h2>
        </div>
        <div class="info-main-box clearfix  p-35">
            <form id="general-inquiry-edit-form" name="general-inquiry-edit-form" method="post" onsubmit="updateInquerydata(this); return false;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="head_ic clearfix">
                    <div class="heading">
                        <h3>Inquiry Form</h3>
                    </div>
                    <div class="icon">
                        <a href="javascript:void(0)" data-toggle="tooltip" title="edit" onclick="makeEditable(this);">  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Project ID:</label>
                                <input type="text" class="form-control" readonly value="{{$inquiry->id}}">    
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Date Of Inquiry:</label>
                                <div class='input-group date'>
                                    <input type='text' class="form-control datetimepicker1" readonly value="{{$inquiry->created_at->format('m-d-Y')}}" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>   
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Lead Value:</label>
                                <select class="selectpicker form-control" name="lead_value" disabled=" disabled" readonly>
                                    <option>Select</option>
                                    <option value="Hot" {{($inquiry->lead_value == 'Hot') ? 'Selected':''}}>Hot</option>
                                    <option value="Warm" {{($inquiry->lead_value == 'Warm') ? 'Selected':''}}>Warm</option>
                                    <option value="Medium" {{($inquiry->lead_value == 'Medium') ? 'Selected':''}}>Medium</option>
                                    <option value="Cold" {{($inquiry->lead_value == 'Cold') ? 'Selected':''}}>Cold</option>
                                </select>   
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Last Change Date:</label>
                                <div class='input-group date'>
                                    <input type='text' class="form-control datetimepicker1" readonly value="{{$inquiry->updated_at->format('m-d-Y')}}" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" name="first_name" class="form-control" readonly value="{{$inquiry->first_name}}">    
                                <input type="hidden" name="id" class="form-control" readonly value="{{$inquiry->id}}">    
                                <input type="hidden" name="inquiry_type" class="form-control" readonly value="{{$inquiry->inquiry_type}}">    
                                {{csrf_field()}}
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" class="form-control" readonly value="{{$inquiry->last_name}}">    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="text" name="email" class="form-control" readonly value="{{$inquiry->email}}">    
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Email(2):</label>
                                 <input type="text" name="alternet_email" class="form-control" readonly value="{{$inquiry->alternet_email}}">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Phone:</label>
                                <input type="text" name="phone" class="form-control" data-masked-input="999-999-9999" maxlength="12" readonly value="{{$inquiry->phone}}">    
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Mobile:</label>
                                <input type="text" name="mobile" class="form-control" data-masked-input="999-999-9999" maxlength="12"  readonly value="{{$inquiry->mobile}}">    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Fax:</label>
                                <input type="text" name="fax" class="form-control" readonly value="{{$inquiry->fax}}">    
                            </div>
                        </div>

<!--                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Other:</label>
                                <input type="text"  class="form-control" readonly value="1234567890">    
                            </div>
                        </div>-->
                    </div>



                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Company Name:</label>
                                <input type="text" name="company_name" class="form-control" readonly value="{{$inquiry->company_name}}">    
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Website:</label>
                                <input type="text"  name="website" class="form-control" readonly value="{{$inquiry->website}}">    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Address:</label>
                                <textarea class="form-control" rows="10" name="address" readonly >{{$inquiry->address}}</textarea> 
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Zip:</label>
                                <input type="text" class="form-control" name="zipcode" data-masked-input="999999" maxlength="5" readonly value="{{$inquiry->zipcode}}">    
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Country:</label>
                                <select class="form-control selectpicker" name="country_id" readonly disabled="" id="country_id" value="{{old('country_id')}}">
                                 <option value="">Select a country</option> 
                                    @if($countries)
                                        @foreach($countries as $country)
                                        <option value="{{$country->id}}" {{ $inquiry->country_id == $country->id ? 'selected="selected"' : '' }}>{{$country->country_name}}</option>
                                        @endforeach
                                    @endif  
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>State:</label>
                                <input type="text" class="form-control" readonly name="state" value="{{ $inquiry->state}}">    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Comment:</label>
                                <input type="text" class="form-control" readonly name="comment"  value="{{ $inquiry->comment}}">    
                            </div>
                        </div>
                    </div>   
            </div>

            <div class="main-box-btn p-t-20 clearfix">
<!--                <div class="inquairy-btn-left">
                    <a href="{{url('/backend')}}" class="btn"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
                </div>-->

                <div class="inquairy-btn-right">
                    <input type="submit" id="edit-inquiry" class="btn blue-btn" value="Update" style="display: none;"/>
                    <a href=".transfer-sales" data-toggle="modal" class="btn blue-btn "> Transfer Sales Manager</a>
                    <a href=".inquiry-solve" data-toggle="modal" class="btn blue-btn"> Mark as Solved</a>
                    <a href="../customer/choose-panel-type.php" class="btn blue-btn"> Convert to Quote</a>
                </div>

            </div>
            </form>
           <!--email box-->
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
    </div>
    
</section>
{!! JsValidator::formRequest('App\Http\Requests\generalInquiryRequest','#general-inquiry-edit-form') !!}
<script>
$('select.selectpicker').on('change', function(){
   $('#country_id').valid();
});
</script>
@include('flash::message')
<script type="text/javascript">
    $(document).ready(function () {
        $(".datetimepicker1").datetimepicker({
            format: "MM-DD-YYYY",
            // autoclose: true,
            //todayBtn: true,
            //pickerPosition: "bottom-left"
        });
        getEmailSection();
    });
    
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

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    function makeEditable(el){

        $('#general-inquiry-edit-form :input').prop('disabled',false);
        $('#general-inquiry-edit-form :input').prop('readonly',false);
        $('#edit-inquiry').show();
        //el.remove();
        $('.selectpicker').selectpicker('refresh');
    }
    
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
</script>  

<div class="modal fade modal-style transfer-sales" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">Inquiry has been transferred to Sales Manager</h3>
<!--                <p>General Inquiry is Successfully Transfered to Sales Manager</p>-->
                <div class="text-center">
                    <a href="dashboard.php" class="btn btn-secondary blue-btn">OK</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-style inquiry-solve" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">Inquiry has been solved</h3>
                <div class="text-center">
                    <a href="dashboard.php" class="btn btn-secondary blue-btn">OK</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</a
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

</div>
<script>
function updateInquerydata(form){
  if($(form).valid()) {
var url = '{{url("backend/inquiry/update")}}';
   $.ajax({
        url: url,
        type: 'post',
        data: $('#general-inquiry-edit-form').serialize(),
        dataType: 'json',
        success: function (res) {
          if(res.success){
                setTimeout(function(){
                    swal('Success!',res.message,'success');
                },1);
            }else{
                setTimeout(function(){
                    swal('Error!',res.message,'error');
                },1);
            }
        },
    });
  }else{
    console.log('still errors');
    return false;
  }
}
</script>
@endsection

