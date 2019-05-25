@extends('backend::layouts.login')

@section('content')
      <div class="admin-login">
            <div class="logo">
                <img src="{{asset('')}}public/images/logo.png" class="center-block">
            </div>
            <div class="main-box">
                <form action ="{{url('/backend/forgot-password-submit')}}" method="post" id="forgot-form">
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
                        <div class="col-sm-6 col-xs-6">
                            <div class="forget-pas">
                                <a href="{{url('/backend/login')}}">Login </a>
                            </div>
                        </div>
                    </div>
                    <div class="sub_btn ">
                        <input type="submit" class="btn" value="Send link"> 
                    </div>
                </form>
            </div>
        </div>
@include('flash::message')
{!! JsValidator::formRequest('App\Backend\Http\Requests\forgotRequest','#forgot-form') !!}
@endsection