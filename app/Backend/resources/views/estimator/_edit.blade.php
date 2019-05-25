
<form role="form" class="form-horizontal" name="editsalesrep_form" action="{{url("backend/sales-rep/update")}}" id="editsalesrep_form" method="post">
    <div class="col-lg-12">
        <div class="form-group">
            <label>First Name</label>
            <input type="text" placeholder="Name" name="first_name"  class="form-control" value="{{$salesrep->first_name}}">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label>Last Name</label>
            <input type="text" placeholder="Name" name="last_name"  class="form-control" value="{{$salesrep->last_name}}">
        </div>
    </div>
    <div class="col-lg-12">
        <div class="form-group">
            <label>Email</label>
            <input type="text" placeholder="Email" name="email" class="form-control" value="{{$salesrep->email}}">
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label>Phone</label>
            <input type="text" class="form-control" name="mobile" data-masked-input="999-999-9999" maxlength="12" placeholder="Phone Number" value="{{$salesrep->mobile}}">
        </div>
    </div>

    <div class="col-lg-12">
        <div class="form-group">
            <label>Country</label>
            <select class="form-control "  id="country_id" name="country_id">
                <option value="">Select Country</option>
                @if(isset($country) && count($country) > 0)
                @foreach($country as $count)
                <option value="{{$count->id}}" {{($salesrep->country_id == $count->id) ? 'selected':''}}>{{$count->country_name}}</option>
                @endforeach
                @endif
            </select>
        </div>
    </div>
    <input type="hidden" name="id" value="{{$salesrep->id}}">
    {{csrf_field()}}
    <div class="form-group">
        <div class=" col-lg-12 text-center">
            <button class="btn blue-btn" id="edit-form-button" type="submit">Submit <i class="fa fa-spinner fa-pulse fa-1 form-loader" style="display:none"></i></button>
            <button class="btn btn-gray" type="reset">Close</button>
        </div>
    </div>
</form>

<script>
    $('#editsalesrep_form').on('submit',function(){
        if($(this).valid()){
            console.log('yes');
            var res = update();
            return false;
        }else{
            console.log('update errors');
        }
    });
</script>
{!! JsValidator::formRequest('App\Backend\Http\Requests\editUserRequest','#editsalesrep_form') !!}