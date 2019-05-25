@extends('backend::layouts.login')

@section('content')
      <div class="admin-login">
            <div class="logo">
                <img src="{{asset('')}}public/images/logo.png" class="center-block">
            </div>
            <div class="main-box">
                <form action ="{{url('/backend/reset-password')}}" method="post" id="reset-form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                <input type="password" class="form-control" name="password" id="password" value="{{old('password')}}" placeholder="Password" aria-invalid="{{$errors->has('password') ? 'true' : ''}}" aria-describedby="{{$errors->has('password') ? 'email-error' : ''}}">
                                <!--@if($errors->has('email'))-->
                                <span id="password-error" class="help-block error-help-block">{{ $errors->first('password') }}</span>
                                    
                                <!--@endif-->
                            </div>
                             <div class="form-group {{$errors->has('confirm_password') ? 'has-error' : ''}}">
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" value="{{old('confirm_password')}}" placeholder="Confirm Password" aria-invalid="{{$errors->has('confirm_password') ? 'true' : ''}}" aria-describedby="{{$errors->has('confirm_password') ? 'email-error' : ''}}">
                                <!--@if($errors->has('email'))-->
                                <span id="confirm_password-error" class="help-block error-help-block">{{ $errors->first('confirm_password') }}</span>
                                    
                                <!--@endif-->
                            </div>
                            <input type="hidden" name="reset_token" value="{{$token}}"> 
                            {{csrf_field()}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <div class="forget-pas">
                                <a href="{{url('/backend/login')}}">Login </a>
                            </div>
                        </div>
                    </div>
                    <div class="sub_btn ">
                        <input type="submit" class="btn" value="Change Password" name="submit"> 
                    </div>
                </form>
            </div>
        </div>
@include('flash::message')
{!! JsValidator::formRequest('App\Backend\Http\Requests\resetPasswordRequest','#reset-form') !!}
@endsection