@extends('backend::layouts.app')
@section('content')
<div class="main-content">
    <div class="content-wrap">
        <div class="container">
            <div class="content-box quotation-form">
                <div class="panel-body">
                    <div class="heading">
                        <h3>MY PROFILE</h3>
                    </div>
                    <div class="form-box">
                        <div class="form-wrap p-15">
                            <form id="update-info-form" method="post" action="{{url('/backend/my-profile/update-profile')}}">
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="grantor">First Name</label>
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name" value="{{isset($user) ? $user->first_name:''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="grantor">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" value="{{isset($user) ? $user->last_name:''}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="grantor">Email</label>
                                            <input type="text" class="form-control" name="email" placeholder="Email" value="{{isset($user) ? $user->email:''}}">
                                             {{csrf_field()}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group btn-form text-center">
                                            <button class="btn btn-primary btn-lg btn-rounded" id="update-info-button"  type="submit" >Submit <i class="fa fa-spinner fa-pulse update-info-loader" aria-hidden="true" style="display: none;"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {!! JsValidator::formRequest('App\Backend\Http\Requests\profileRequest','#update-info-form') !!}
                            <div class="heading">
                                <h3>  CHANGE PASSWORD</h3>
                            </div>
                            <form id="change-password-form" method="post" action="{{url('/backend/my-profile/change-password')}}">
                                <div class="row">
                                    <div class=" col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="grantor">Old Password</label>
                                            <input type="password" name="current_password" id="current_password" class="form-control" value="" placeholder="Old Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="grantor">New Password</label>
                                            <input type="password" name="password" class="form-control"   placeholder="New Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class=" col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="grantor">Confirm Password</label>
                                            <input type="password" name="confirm_password" class="form-control"  placeholder="Confirm Password">
                                            {{csrf_field()}}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group btn-form text-center">
                                            <button class="btn btn-primary btn-lg btn-rounded" id="change-password-button" type="submit" >Submit <i class="fa fa-spinner fa-pulse change-password-loader" aria-hidden="true" style="display: none;"></i></button>
                                            <a class="btn btn-lg btn-rounded gray-btn" href="dashboard.php">Back</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            {!! JsValidator::formRequest('App\Backend\Http\Requests\passwordRequest','#change-password-form') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function(){
   $('#update-info-form').submit(function(){
      if($(this).valid()){
         $('.update-info-loader').show();
         $('#update-info-button').attr('disabled',true);
         updateProfile();
      } 
      return false;
   }); 
});

function updateProfile(){
var url = '{{url("backend/my-profile/update-profile")}}';
    $.ajax({
        url: url,
        type: 'post',
        data:  $('#update-info-form').serialize(),
        dataType: 'json',
        success: function (res) {
            if (res.success){
                $('#update-info-form')[0].reset();
                swal('Success!', res.message, 'success');
            } else{
                swal('Error!', res.message, 'error');
            }
        },
        error: function(res){
            swal('Error!', 'Something went wrong, Please try again later.', 'error');
        },
        complete: function (){
            $('#update-info-button').attr('disabled',false);
            $('.update-info-loader').hide();
        } 
    });
}




$(document).ready(function(){
   $('#change-password-form').submit(function(){
      if($(this).valid()){
          $('.change-password-loader').show();
          $('#change-password-button').attr('disabled',true);
         changePassword(this);
      } 
      return false;
   }); 
});

function changePassword(){
var url = '{{url("backend/my-profile/change-password")}}';
    $.ajax({
        url: url,
        type: 'post',
        data:  $('#change-password-form').serialize(),
        dataType: 'json',
        beforeSend:function(){
        $('#panels').html('Loading...');
        },
        success: function (res) {
            if (res.success){
                $('#change-password-form')[0].reset();
                swal('Success!', res.message, 'success');
            } else{
                swal('Error!', res.message, 'error');
            }
        },
        error: function(res){
            swal('Error!', 'Something went wrong, Please try again later.', 'error');
        },
        complete: function (){
            $('#change-password-button').attr('disabled',false);
            $('.change-password-loader').hide();
        } 
    });
}

</script>
@endsection
