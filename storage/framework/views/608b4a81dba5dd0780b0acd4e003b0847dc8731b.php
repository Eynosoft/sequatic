<?php $__env->startSection('content'); ?>
      <div class="admin-login">
            <div class="logo">
                <img src="<?php echo e(asset('')); ?>public/images/logo.png" class="center-block">
            </div>
            <!--            <div class="heading">
                            <h3>Sales Representative</h3>
                        </div>-->
            <div class="main-box">
                <form action ="<?php echo e(url('/admin/login')); ?>" method="post" id="login-form">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group <?php echo e($errors->has('email') ? 'has-error' : ''); ?>">
                                <input type="text" class="form-control" name="email" id="email" value="<?php echo e(old('email')); ?>" placeholder="Email" aria-invalid="<?php echo e($errors->has('email') ? 'true' : ''); ?>" aria-describedby="<?php echo e($errors->has('email') ? 'email-error' : ''); ?>">
                                <!--<?php if($errors->has('email')): ?>-->
                                <span id="email-error" class="help-block error-help-block"><?php echo e($errors->first('email')); ?></span>
                                    
                                <!--<?php endif; ?>-->
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group <?php echo e($errors->has('password') ? 'has-error' : ''); ?>">
                                <input type="password" class="form-control" name="password" value="<?php echo e(old('password')); ?>" autocomplete="new-password" id="password" placeholder="Password">
                                <?php if($errors->has('password')): ?>
                                <span class="help-block error-help-block"><?php echo e($errors->first('password')); ?></span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-6">
                            <div class="forget-pas">
                                <a href="forgot.php">Forgot Password ?</a>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6 ">
                            <div class="chekbox">
                                <input type="checkbox" class="chk" value=""><span>Remember Me</span>
                            </div>
                        </div>
                    </div>
                    <div class="sub_btn ">
                        <input type="submit" class="btn" value="Login"> 
                    </div>
                </form>
            </div>
        </div>
<?php echo JsValidator::formRequest('App\Admin\Http\Requests\loginRequest','#login-form'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin::layouts.login', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>