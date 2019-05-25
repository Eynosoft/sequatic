<header class="admin_header">
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="javascript:void(0);"><img class="img-responsive" src="<?php echo e(asset('/images/logo.png')); ?>" /></a> 
            </div>

            <!--device-lg-->
           

                <ul class="nav navbar-nav navbar-right">
                    
                    <li class="hidden-xs hidden-sm hidden-md">
                        <a href="<?php echo e(url('/admin')); ?>"  >Home</a>
                    </li>

                    <li class="hidden-xs hidden-sm hidden-md">
                        <a href="#">Add Inquiry</a>
                    </li>

                    <li class="hidden-xs hidden-sm hidden-md">
                        <a href="<?php echo e(url('/admin/inquiry/quotation')); ?>">Quote Inquiry</a>
                    </li>

                    <li class="hidden-xs hidden-sm hidden-md">
                        <a href="<?php echo e(url('/admin')); ?>">General Inquiry</a>
                    </li>
                    
                    <li class="hidden-xs hidden-sm hidden-md">
                        <a href="#">Help</a>
                    </li>


                    <li class="icon">
                        <a href="<?php echo e(url('/admin/inquiry/trash')); ?>">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </li>

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
                            <span>John Doe (Sales rep)</span> <i class="fa fa-cog" aria-hidden="true"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:void(0)">My Profile</a></li>
                            <li>
<!--                            <a href="javascript:void(0)">Sign Out</a>-->
                                <a href="<?php echo e(route('logout')); ?>"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Sign Out
                                        </a>

                                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

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