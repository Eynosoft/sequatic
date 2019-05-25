<!DOCTYPE HTML>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <title>Seaquatic Aquarums</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
        <link href="<?php echo e(asset('public/')); ?>/css/bootstrap-select.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/')); ?>/css/custom.css" rel="stylesheet" type="text/css">
        <link href="<?php echo e(asset('public/')); ?>/css/sweet-alert.css" rel="stylesheet" type="text/css">
        
        <script src="<?php echo e(asset('public/')); ?>/js/jquery.min.js"></script>
        <script type="text/javascript" src="<?php echo e(asset('public/')); ?>/js/jsvalidation.js"></script>
    </head>

    <body>
        <main class="main-content">

            <header>
                <nav class="navbar navbar-default">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                            <a class="navbar-brand" href="javascript:void(0);"><img class="img-responsive" src="<?php echo e(asset('public/')); ?>/images/logo.png" /></a> 
                        </div>

                        <!--                        <div id="navbar" class="navbar-collapse collapse main-nav">
                                                    <ul class="nav navbar-nav navbar-right">
                                                        <li><a href="javascript:void(0);">Home</a></li>
                                                    </ul>
                        
                                                </div>-->
                        <!--/.nav-collapse --> 
                    </div>
                </nav>
            </header>
            
            <?php echo $__env->yieldContent('content'); ?>
            
            <footer class="footer">
                <div class="container02">
                    <p>Copyright &copy; 2017.</p>
                </div>
            </footer>
        </main>

        <script src="<?php echo e(asset('public/')); ?>/js/bootstrap.min.js"></script>
        <script src="<?php echo e(asset('public/')); ?>/js/bootstrap-select.min.js"></script>
        <script src="<?php echo e(asset('public/')); ?>/js/sweet-alert.min.js"></script>
        <script src="<?php echo e(asset('public/')); ?>/js/jquery.masked-input.min.js"></script>
        
        <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    </body>
</html>
