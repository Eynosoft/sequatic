<?php $__env->startSection('content'); ?>
<link href="<?php echo e(asset('public/css/error.css')); ?>" rel="stylesheet" type="text/css" />
<main class="main_content admin_content error">
    <section class="error-section">
        <div class="container"> 
            <div class="row bg-clr">
                <div class="col-sm-4 col-sm-offset-4">
                    <img src="<?php echo e(asset('public/images/error.png')); ?>" alt="" class="img-responsive">
                </div>
                <div class="col-sm-12">
                    <p>THE LINK YOU FOLLOWED IS PROBABLY BROKEN OR THE PAGE HAS BEEN REMOVED.</p>                            
                    <a href="<?php echo e(url('')); ?>"><h2>RETURN TO THE HOME PAGE</h2></a>
                </div>
            </div>                     
        </div>
    </section>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>