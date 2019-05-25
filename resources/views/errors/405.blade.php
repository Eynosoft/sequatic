@extends('layouts.home')
@section('content')
<link href="{{asset('public/css/error.css')}}" rel="stylesheet" type="text/css" />
<main class="main_content admin_content error">
    <section class="error-section">
        <div class="container"> 
            <div class="row bg-clr">
                <div class="col-sm-4 col-sm-offset-4">
                    <img src="{{asset('public/images/error.png')}}" alt="" class="img-responsive">
                </div>
                <div class="col-sm-12">
                    <p>THE LINK YOU FOLLOWED IS PROBABLY BROKEN OR THE PAGE HAS BEEN REMOVED.</p>                            
                    <a href="{{url('')}}"><h2>RETURN TO THE HOME PAGE</h2></a>
                </div>
            </div>                     
        </div>
    </section>
</main>
@endsection