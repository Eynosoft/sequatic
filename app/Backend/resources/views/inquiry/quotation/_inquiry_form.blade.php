    <form id="general-inquiry-edit-form" name="general-inquiry-edit-form" method="post"  onsubmit="updateInquerydata(this); return false;" >
        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Quote No:</label>
                    <input type="text" class="form-control" id="quote_no" readonly value="abcd">    
                </div>
            </div>

            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Date Of Inquiry:</label>
                    <div class='input-group date'>
                        <input type='text' class="form-control datetimepicker2" id="date_of_inquiry" readonly value="{{$inquiry->created_at->format('m-d-Y')}}" />
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
                    <select class="selectpicker form-control load_value_selectpicker" name="lead_value" disabled=" disabled" readonly>
                        <option value="">Select</option>
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
                    <div class="input-group date " data-provide="datepicker" >
                        <input type='text' class="form-control datetimepicker2" id="last_change_date" readonly value="{{$inquiry->updated_at->format('m-d-Y')}}" />
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
                    <input type="text" name="mobile" class="form-control" data-masked-input="999-999-9999" maxlength="12" readonly value="{{$inquiry->mobile}}">    
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
                    <label>Company Name:</label>
                    <input type="text" name="company_name" class="form-control" readonly value="{{$inquiry->company_name}}">    
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Website:</label>
                    <input type="text"  name="website" class="form-control" readonly value="{{$inquiry->website}}">    
                </div>
            </div>

            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Address:</label>
                    <textarea class="form-control" rows="10" name="address" readonly >{{$inquiry->address}}</textarea> 
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>City:</label>
                    <input type="text" class="form-control" name="city" readonly value="{{ $inquiry->city}}">    
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
                    <label>Zip:</label>
                    <input type="text" class="form-control" name="zipcode" data-masked-input="999999" maxlength="6" readonly value="{{$inquiry->zipcode}}">    
                </div>
            </div>

            <div class="col-sm-6 col-xs-12">
                <div class="form-group">
                    <label>Country:</label>
                    <select class="form-control country_selectpicker" name="country_id" readonly disabled="" id="country_id" value="{{old('country_id')}}">
                        <option value="">Select a country</option> 
                        @if($countries)
                        @foreach($countries as $country)
                        <option value="{{$country->id}}" {{ $inquiry->country_id == $country->id ? 'selected="selected"' : '' }}>{{$country->country_name}}</option>
                        @endforeach
                        @endif  
                    </select>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                   <label>Project Name</label>
                   <input type="text" class="form-control" name="project_name" value="{{ $inquiry->project_name}}" readonly  placeholder="Project Name">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12">
                <div class="form-group">
                    <label>Comment:</label>
                    <input type="text" class="form-control" readonly name="comment"  value="{{ $inquiry->comment}}">    
                </div>
            </div>
        </div>
        
        <div class="text-center m-t-20">
            <!--<button class="blue-btn">Update</button>-->
            <input type="submit" id="edit-inquiry" class="btn blue-btn" value="Update" style="display: none;"/>
        </div>
        
    </form>

{!! JsValidator::formRequest('App\Http\Requests\generalInquiryRequest','#general-inquiry-edit-form') !!}
<script>
  function makeEditable(el){
    $('#general-inquiry-edit-form :input').prop('disabled', false);
          $('#general-inquiry-edit-form :input').prop('readonly', false);
          $('#quote_no').prop('disabled',true);
          $('#date_of_inquiry').prop('disabled',true);
          $('#last_change_date').prop('disabled',true);
          $('#edit-inquiry').show();
          //el.remove();
          $('.selectpicker').selectpicker('refresh');
       }

    
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
                getInquireForm({{$inquiry->id}})
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