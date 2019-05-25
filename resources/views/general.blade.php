<?php 
    use App\common\helpers\User;
?>

    @extends(User::checkLogin() ? 'backend::layouts.app' : 'layouts.home')
@section('content')
<section class="form-box">
    <div class="form-wrap">
        <div class="container">
            <div class="form-cnt">
                <div class="heading clearfix">
                    <h2>General Inquiry Form</h2>
                </div>
                <form role="form" action="{{url('inquiry/create')}}" method="post" id="general-inquiry-form">
                    <div class="setup-content">
                        <div class="form-first">
<!--                            <div class="form-group">
                                <input type="radio" onchange="changeAction(this);" name="inquiry_type" value="General" checked>General Inquiry
                                <input type="radio" onchange="changeAction(this);" name="inquiry_type" value="Quotation">Quotation Inquiry 
                            </div>-->
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="First Name">
<!--                                        @if($errors->has('first_name'))
                                            <span class="has-error">{{ $errors->first('first_name') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control"name="last_name" value="{{old('last_name')}}" placeholder="Last Name">
<!--                                        @if($errors->has('last_name'))
                                            <span class="has-error">{{ $errors->first('last_name') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="{{old('email')}}"  placeholder="Email">
<!--                                        @if($errors->has('email'))
                                            <span class="has-error">{{ $errors->first('email') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Email(2):</label>
                                         <input type="text" name="alternet_email" class="form-control"  value="{{old('alternet_email')}}" placeholder="Email(2)">
                                        <!--<input type="text" class="form-control" name="confirm_email" value="{{old('confirm_email')}}"  placeholder="Confirm Email">-->
<!--                                        @if($errors->has('confirm_email'))
                                            <span class="has-error">{{ $errors->first('confirm_email') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control"  data-masked-input="999-999-9999" maxlength="12" name="phone" value="{{old('phone')}}"  placeholder="Phone">
<!--                                        @if($errors->has('phone'))
                                            <span class="has-error">{{ $errors->first('phone') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" data-masked-input="999-999-9999" maxlength="12" name="mobile" value="{{old('mobile')}}"  placeholder="Mobile">
<!--                                        @if($errors->has('mobile'))
                                            <span class="has-error">{{ $errors->first('mobile') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input type="text" class="form-control" name="fax" data-masked-input="999-999-9999" maxlength="12"  value="{{old('fax')}}"  placeholder="Fax">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" name="website" value="{{old('website')}}"  placeholder="Website">
<!--                                        @if($errors->has('website'))
                                            <span class="has-error">{{ $errors->first('website') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" name="company_name" value="{{old('company_name')}}"  placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Project Name</label>
                                        <input type="text" class="form-control" name="project_name" value="{{old('project_name')}}"  placeholder="Project Name">
                                    </div>
                                </div>
                           </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Select a country</label>
                                        <select class="form-control selectpicker" name="country_id" id="country_id" value="{{old('country_id')}}">
                                            <option value="">Select a country</option> 
                                            @if($countries)
                                                @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{ old('country_id') == $country->id ? 'selected="selected"' : '' }}>{{$country->country_name}}</option>
                                                @endforeach
                                            @endif
                                        </select>
<!--                                        @if($errors->has('country_id'))
                                            <span class="has-error">{{ $errors->first('country_id') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" class="form-control" name="state" value="{{old('state')}}"  placeholder="State">
<!--                                        @if($errors->has('state'))
                                            <span class="has-error">{{ $errors->first('state') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="{{old('address')}}"  placeholder="Address">
<!--                                        @if($errors->has('address'))
                                            <span class="has-error">{{ $errors->first('address') }}</span>
                                        @endif-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Zipcode</label>
                                        <input type="text" class="form-control" name="zipcode"  data-masked-input="999999" maxlength="6" value="{{old('zipcode')}}"  placeholder="Zipcode">
<!--                                        @if($errors->has('zipcode'))
                                            <span class="has-error">{{ $errors->first('zipcode') }}</span>
                                            
                                        @endif-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea type="text" class="form-control" rows="4" name="comment" placeholder="Comment"> {{old('comment')}} </textarea>
                                        <!--<input type="hidden" class="form-control" name="inquiry_type" value="general">-->
                                        {{csrf_field()}}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group text-center">
                                        <!--<a class="btn btn-primary btn-lg btn-rounded" type="button" href="choose-panel-type.php" >Submit</a>-->
                                        <input type="submit" id="submitButton" class="btn btn-primary btn-lg btn-rounded" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div> 
        </div> 
    </div>
</section>
{!! JsValidator::formRequest('App\Http\Requests\generalInquiryRequest','#general-inquiry-form') !!}
<script>
$('select.selectpicker').on('change', function(){
   $('#country_id').valid();
});
</script>
@endsection