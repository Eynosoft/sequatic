
@include('backend::layouts.include.head')

<main class="main-content">
   
@include('backend::layouts.include.header')
  
@yield('content')
</div> 
</div>

@include('backend::layouts.include.footer')
@include('flash::message')
</body>
</html>