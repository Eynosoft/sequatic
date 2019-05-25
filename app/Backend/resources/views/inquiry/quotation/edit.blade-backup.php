@extends('backend::layouts.app')

@section('content')
<section class="admin-general-information">
    <div class="container">
        <div class="heading">
            <h2>{{$inquiry->inquiry_type}} Inquiry Information</h2>
        </div>
        <div class="info-main-box clearfix">
            <form id="general-inquiry-edit-form" name="general-inquiry-edit-form" method="post" action="{{url('/backend/inquiry/update')}}">
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
                                <label>Project Name:</label>
                                <input type="text" class="form-control" readonly value="abcd">    
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Date Of Inquiry:</label>
                                <div class='input-group date'>
                                    <input type='text' class="form-control" readonly value="{{$inquiry->created_at->format('d-m-Y')}}" />
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
                                    <input type='text' class="form-control" readonly value="{{$inquiry->updated_at->format('d-m-Y')}}" />
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
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Phone:</label>
                                <input type="text" name="phone" class="form-control" readonly value="{{$inquiry->phone}}">    
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Mobile:</label>
                                <input type="text" name="mobile" class="form-control" readonly value="{{$inquiry->mobile}}">    
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

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Other:</label>
                                <input type="text"  class="form-control" readonly value="1234567890">    
                            </div>
                        </div>
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
                                <input type="text" class="form-control" name="zipcode" readonly value="{{$inquiry->zipcode}}">    
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
                <div class="inquairy-btn-left">
                    <a href="{{url('/backend')}}" class="btn"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
                </div>

                <div class="inquairy-btn-right">
                    <input type="submit" id="edit-inquiry" class="btn blue-btn" value="Update" style="display: none;"/>
<!--                    <a href=".transfer-sales" data-toggle="modal" class="btn blue-btn "> Transfer Sales Manager</a>
                    <a href=".inquiry-solve" data-toggle="modal" class="btn blue-btn"> Mark as Solved</a>
                    <a href="../customer/choose-panel-type.php" class="btn blue-btn"> Convert to Quote</a>-->
                </div>

            </div>
            </form>
            <!-- forder section -->
                <div class="folder_section" id="load-file-section">
<!--                    @if($inquiry->inquiry_type == 'Quotation')
                    <script>
                    $(document).ready(function(){
                        setTimeout(function(){
                            loadFolderSection({{$inquiry->id}});
                        },1);
                    });
                    </script>
                    @endif-->
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
        loadFolderSection({{$inquiry->id}});
        $(".datetimepicker").datetimepicker({
            format: "YY-MM-DD",
            // autoclose: true,
            //todayBtn: true,
            //pickerPosition: "bottom-left"
        });

    });

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
<div class="modal fade modal-style create-folder" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">Create New Folder </h3>
                <form id="create-directory-form" name="create-directory-form" onsubmit="createDirectory(this,{{$inquiry->id}}); return false;">
                    <div class="form-group">
                        <label>Folder Name :</label>
                        <input type="text" class="form-control" name="directory_name">
                        <input type="hidden" name="inquiry_id" value="{{$inquiry->id}}">
                        {{csrf_field()}}
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-secondary blue-btn">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
{!! JsValidator::formRequest('App\Backend\Http\Requests\createDirectoryRequest','#create-directory-form') !!}
<script>
    
function showCreateModal(){
    
    $("#create-directory-form").data('validator').resetForm();
    $("#create-directory-form")[0].reset();
    $("#create-directory-form").find('.has-success').removeClass('has-success');
    $("#create-directory-form").find('.has-error').removeClass('has-error');
    $('.create-folder').modal('show');
}    
    
function loadFolderSection(id){
   
    var url = '{{url("backend/directory/load-file-section")}}/'+id;
   
    $.ajax({
        url: url,
        type: 'get',
        data: '',
        dataType: 'json',
        success: function (res) {
            $('#load-file-section').html('');
            $('#load-file-section').html(res.html);
        }
    });

} 
function createDirectory(form,id){
    if($(form).valid()) {
    // do your ajax stuff here
    var url = '{{url("backend/directory/create")}}';
    $.ajax({
        url: url,
        type: 'post',
        data: $('#create-directory-form').serialize(),
        dataType: 'json',
        success: function (res) {
            $('.create-folder').modal('hide');
            if(res.success){
                setTimeout(function(){
                    swal('Success!',res.message,'success');
                },1);
                loadFolderSection(id);  
            }else{
                setTimeout(function(){
                    swal('Error!',res.message,'error');
                },1);
            }
        }
    });
} else{
    console.log('still errors');
    return false;
}
}
</script>
@endsection

