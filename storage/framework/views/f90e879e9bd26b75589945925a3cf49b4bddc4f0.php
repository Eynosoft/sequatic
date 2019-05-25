<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="content-wrap">
        <div class="container">
            <div class="content-box panel-list-choose">
                <div class="heading clearfix">
                    <h2>Choose Panel Type</h2>
                </div>
                <div class="row">
                     <?php if($panels && count($panels) > 0): ?>
                        <?php $__currentLoopData = $panels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $panel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6">
                            <div class="choose-panel">
                                <a href="<?php echo e(url('/inquiry/create/panel-details/'.$panel->id)); ?>">
                                    <img src="<?php echo e(asset('public/images')); ?>/<?php echo e($panel->image_path); ?>" alt="panel" class="img-responsive"/>
                                </a>
                                <p><?php echo e($panel->panel_title); ?></p>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                    <?php endif; ?>
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
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>