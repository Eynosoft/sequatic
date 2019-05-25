@extends('layouts.home')

@section('content')
<div class="main-content">
    <div class="content-wrap">
        <div class="container">
            <div class="content-box panel-list-choose">
                <div class="heading clearfix">
                    <h2>Choose Panel Type</h2>
                </div>
                <div class="row">
                     @if($panels && count($panels) > 0)
                        @foreach($panels as $panel)
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="choose-panel">
                                <a href="{{url('/inquiry/create/panel-details/'.$panel->id)}}">
                                    <img src="{{asset('public/images')}}/{{$panel->image_path}}" alt="panel" class="img-responsive"/>
                                </a>
                                <p>{{$panel->panel_title}}</p>
                            </div>
                        </div>
                        @endforeach
                    @else
                    @endif
                </div>

<!--                <div class="row m-t-15">
                    <div class="col-lg-12 col-sm-12 col-xs-12">
                        <div class="form-group text-center">
                            <a class="btn btn-primary btn-lg btn-rounded" href="quotation-form.php">Submit</a>
                            <a class="btn btn-lg btn-rounded gray-btn" href="admin/general-inquiry.php">Back</a>
                        </div>
                    </div>
                </div>-->
            </div> 
        </div> 
    </div> 

</div>
@endsection