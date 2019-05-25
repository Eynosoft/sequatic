@extends('backend::layouts.login')

@section('content')
      <div class="admin-login">
            <div class="logo">
                <img src="{{asset('')}}public/images/logo.png" class="center-block">
            </div>
            <!--            <div class="heading">
                            <h3>Sales Representative</h3>
                        </div>-->
            <div class="main-box">
                <form action ="{{url('/backend/login')}}" method="post" id="login-form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                                <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}" placeholder="Email" aria-invalid="{{$errors->has('email') ? 'true' : ''}}" aria-describedby="{{$errors->has('email') ? 'email-error' : ''}}">
                                <!--@if($errors->has('email'))-->
                                <span id="email-error" class="help-block error-help-block">{{ $errors->first('email') }}</span>
                                    
                                <!--@endif-->
                                {{csrf_field()}}
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                                <input type="password" class="form-control" name="password" value="{{old('password')}}" autocomplete="new-password" id="password" placeholder="Password">
                                @if($errors->has('password'))
                                <span class="help-block error-help-block">{{ $errors->first('password') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <div class="forget-pas">
                                <a href="{{asset('/backend/forgot-password')}}">Forgot Password ?</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6 ">
                            <div class="chekbox">
                                <input type="checkbox" class="chk" name="remember"><span>Remember Me</span>
                            </div>
                        </div>
                    </div>
                    <div class="sub_btn ">
                        <input type="submit" class="btn" value="Login"> 
                    </div>
                </form>
            </div>
        </div>
@include('flash::message')
{!! JsValidator::formRequest('App\Backend\Http\Requests\loginRequest','#login-form') !!}
@endsection