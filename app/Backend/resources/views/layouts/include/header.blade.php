<?php 
    use App\common\helpers\User;
?>
<header class="admin_header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="javascript:void(0);"><img class="img-responsive" src="{{asset('public/images/logo.png')}}" /></a> 
            </div>
            <!--device-lg-->
           
                <ul class="nav navbar-nav navbar-right">
                    
                    <li class="hidden-xs hidden-sm hidden-md">
                        <a href="{{url('/backend')}}"  >Home</a>
                    </li>
                    @if(User::getRoleName() == 'Admin')
                    <li class="dropdown user_dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span>Manage User</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="hidden-xs hidden-sm hidden-md">
                                <a href="{{url('/backend/salesrep')}}">Sales Rep</a>
                            </li>
                           <li class="hidden-xs hidden-sm hidden-md">
                                <a href="{{url('/backend/sales-manager')}}">Sales Manager</a>
                            </li>
                            <li class="hidden-xs hidden-sm hidden-md">
                                <a href="{{url('/backend/estimator')}}">Estimator</a>
                            </li>
                        </ul>
                    </li>
                     @endif
                     
                    
                    <li class="dropdown user_dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span>Manage Inquiry</span>
                        </a>
                        <ul class="dropdown-menu">
                             @if(User::getRoleName() != 'Estimator')
                            <li class="hidden-xs hidden-sm hidden-md">
                                <a href="{{url('inquiry/quotation')}}">Add Inquiry</a>
                            </li>
                            @endif
                            
                            <li class="hidden-xs hidden-sm hidden-md">
                                <a href="{{url('/backend/inquiry/quotation')}}">Quote Inquiry</a>
                            </li>
                            
                            @if(User::getRoleName() != 'Estimator')
                            <li class="hidden-xs hidden-sm hidden-md">
                                <a href="{{url('/backend')}}">General Inquiry</a>
                            </li>
                            @endif
                        </ul>
                    </li>
                    
                    
                    
                    
                    @if(User::getRoleName() == 'Admin')
                     <li class="hidden-xs hidden-sm hidden-md">
                        <a href="{{url('/backend/emails/global-inbox')}}">Global Inbox</a>
                    </li>
                    @endif
                    <li class="hidden-xs hidden-sm hidden-md">
                        <a href="#">Help</a>
                    </li>
                     @if(User::getRoleName() != 'Estimator')
                    <li class="icon">
                        <a href="{{url('/backend/inquiry/trash')}}">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </li>
                    @endif
                    <li class="dropdown icon">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-bell-o" aria-hidden="true"></i></a>
                        <ul class="dropdown-menu">
                            <div class="heading">
                                <h3>Notification</h3>
                            </div>
                            <li>
                                <div class="content">
                                    <h2>Notification01</h2>
                                    <span>16-02-2017 @ 14:02</span>
                                    <p>There are many variations of passages of Lorem Ipsum available, 
                                        but the majority have suffered  </p>
                                </div>
                                <a href="javascript;void()">read more</a>
                            </li>
                            <li>
                                <div class="content">
                                    <h2>Notification01</h2>
                                    <span>16-02-2017 @ 14:02</span>
                                    <p>There are many variations of passages of Lorem Ipsum available, 
                                        but the majority have suffered  </p>
                                </div>
                                <a href="javascript;void()">read more</a>
                            </li>
                            <div class="view-more">
                                <a href="javascript:void(0)">
                                    View More
                                </a>
                            </div>
                        </ul>
                    </li>
                    <li class="dropdown icon user_dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                            <span>{{User::getFullName()}}({{User::getRoleName()}})</span> <i class="fa fa-cog" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{url('/backend/my-profile')}}">My Profile</a></li>
                            <li>
<!--                            <a href="javascript:void(0)">Sign Out</a>-->
                                <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Sign Out
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                            </li>
                        </ul>
                    </li>
                    <!--toggle-->
                    
                    <li class="hidden-lg toggle">
                        <span  onclick="openNav()" class="toggle-icon">
                            <i class="fa fa-bars" aria-hidden="true"></i>
                        </span>
                        <div id="mySidenav" class="sidenav">
                            <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                            <a href="#">Home</a>
                            <a href="#">Add-Inquiry</a>
                            <a href="quote-inquiry-dashboard.php">Quote Inquiry</a>
                            <a href="dashboard.php">General Inquiry</a>
                            <a href="#">Help</a>
                        </div>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
   
    </nav>
</header>