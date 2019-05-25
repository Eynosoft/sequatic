<?php $__env->startSection('content'); ?>
<section class="form-box">
    <div class="form-wrap">
        <div class="container">
            <div class="form-cnt">
                <div class="heading clearfix">
                    <h2>Inquiry Form</h2>
                </div>
                <form role="form" action="<?php echo e(url('inquiry/create')); ?>" method="post" id="general-inquiry-form">
                    <div class="setup-content">
                        <div class="form-first">
                            <div class="form-group">
                                <input type="radio" onchange="changeAction(this);" name="inquiry_type" value="General" checked>General Inquiry
                                <input type="radio" onchange="changeAction(this);" name="inquiry_type" value="Quotation">Quotation Inquiry 
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label for="name">First Name</label>
                                        <input type="text" class="form-control" name="first_name" value="<?php echo e(old('first_name')); ?>" placeholder="First Name">
<!--                                        <?php if($errors->has('first_name')): ?>
                                            <span class="has-error"><?php echo e($errors->first('first_name')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control"name="last_name" value="<?php echo e(old('last_name')); ?>" placeholder="Last Name">
<!--                                        <?php if($errors->has('last_name')): ?>
                                            <span class="has-error"><?php echo e($errors->first('last_name')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="text" class="form-control" name="email" value="<?php echo e(old('email')); ?>"  placeholder="Email">
<!--                                        <?php if($errors->has('email')): ?>
                                            <span class="has-error"><?php echo e($errors->first('email')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Email(2):</label>
                                         <input type="text" name="alternet_email" class="form-control"  value="<?php echo e(old('alternet_email')); ?>" placeholder="Email(2)">
                                        <!--<input type="text" class="form-control" name="confirm_email" value="<?php echo e(old('confirm_email')); ?>"  placeholder="Confirm Email">-->
<!--                                        <?php if($errors->has('confirm_email')): ?>
                                            <span class="has-error"><?php echo e($errors->first('confirm_email')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" class="form-control"  data-masked-input="999-999-9999" maxlength="12" name="phone" value="<?php echo e(old('phone')); ?>"  placeholder="Phone">
<!--                                        <?php if($errors->has('phone')): ?>
                                            <span class="has-error"><?php echo e($errors->first('phone')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Mobile</label>
                                        <input type="text" class="form-control" data-masked-input="999-999-9999" maxlength="12" name="mobile" value="<?php echo e(old('mobile')); ?>"  placeholder="Mobile">
<!--                                        <?php if($errors->has('mobile')): ?>
                                            <span class="has-error"><?php echo e($errors->first('mobile')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Fax</label>
                                        <input type="text" class="form-control" name="fax" data-masked-input="999-999-9999" maxlength="12"  value="<?php echo e(old('fax')); ?>"  placeholder="Fax">
                                        
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Website</label>
                                        <input type="text" class="form-control" name="website" value="<?php echo e(old('website')); ?>"  placeholder="Website">
<!--                                        <?php if($errors->has('website')): ?>
                                            <span class="has-error"><?php echo e($errors->first('website')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Company Name</label>
                                        <input type="text" class="form-control" name="company_name" value="<?php echo e(old('company_name')); ?>"  placeholder="Company Name">
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Project Name</label>
                                        <input type="text" class="form-control" name="project_name" value="<?php echo e(old('project_name')); ?>"  placeholder="Project Name">
                                    </div>
                                </div>
                           </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Select a country</label>
                                        <select class="form-control selectpicker" name="country_id" id="country_id" value="<?php echo e(old('country_id')); ?>">
                                            <option value="">Select a country</option> 
                                            <?php if($countries): ?>
                                                <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($country->id); ?>" <?php echo e(old('country_id') == $country->id ? 'selected="selected"' : ''); ?>><?php echo e($country->country_name); ?></option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </select>
<!--                                        <?php if($errors->has('country_id')): ?>
                                            <span class="has-error"><?php echo e($errors->first('country_id')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>State</label>
                                        <input type="text" class="form-control" name="state" value="<?php echo e(old('state')); ?>"  placeholder="State">
<!--                                        <?php if($errors->has('state')): ?>
                                            <span class="has-error"><?php echo e($errors->first('state')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input type="text" class="form-control" name="address" value="<?php echo e(old('address')); ?>"  placeholder="Address">
<!--                                        <?php if($errors->has('address')): ?>
                                            <span class="has-error"><?php echo e($errors->first('address')); ?></span>
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                                <div class="col-lg-6 col-sm-6 col-xs-12">
                                    <div class="form-group">
                                        <label>Zipcode</label>
                                        <input type="text" class="form-control" name="zipcode"  data-masked-input="999999" maxlength="6" value="<?php echo e(old('zipcode')); ?>"  placeholder="Zipcode">
<!--                                        <?php if($errors->has('zipcode')): ?>
                                            <span class="has-error"><?php echo e($errors->first('zipcode')); ?></span>
                                            
                                        <?php endif; ?>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <label>Comment</label>
                                        <textarea type="text" class="form-control" rows="4" name="comment" placeholder="Comment"> <?php echo e(old('comment')); ?> </textarea>
                                        <!--<input type="hidden" class="form-control" name="inquiry_type" value="general">-->
                                        <?php echo e(csrf_field()); ?>

                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-sm-12 col-xs-12">
                                    <div class="form-group text-center">
                                        <!--<a class="btn btn-primary btn-lg btn-rounded" type="button" href="choose-panel-type.php" >Submit</a>-->
                                        <input type="submit" id="submitButton" class="btn btn-primary btn-lg btn-rounded" value="Submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div> 
        </div> 
    </div>
</section>
<?php echo JsValidator::formRequest('App\Http\Requests\generalInquiryRequest','#general-inquiry-form'); ?>

<script>
$('select.selectpicker').on('change', function(){
   $('#country_id').valid();
});

function changeAction(el){
     if($(el).is(':checked')) {
        if($(el).val() == 'General'){
            $('#general-inquiry-form').attr('action',"<?php echo e(url('inquiry/create')); ?>");
            $('#submitButton').val('Submit');
        }else{
            $('#general-inquiry-form').attr('action',"<?php echo e(url('inquiry/choose-panel')); ?>");
            $('#submitButton').val('Next');
        }
     }
    
}
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>