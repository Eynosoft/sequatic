<?php $__env->startSection('content'); ?>
<div class="main-content">
    <div class="content-wrap">
        <div class="container">
            <div class="content-box quotation-form">

                <div class="panel-body">
                    <div class="panel-top-heading text-center">
                        <h3><?php echo e($panel->panel_title); ?></h3>
                    </div>

                    <div class="row panel-image-section">
                        <div class="col-sm-12 text-center">
                            <div class="panel_image">
                                <?php if(array_key_exists(1,$panelImages)): ?>
                                <img src="<?php echo e(asset('public/images/'.$panelImages[0]['image_path'])); ?>" alt="image"  class="img-responsive center-block"/>
                                <?php endif; ?>
                            </div>
                            <div class="name">
                                <?php echo e($panel->description); ?>

                            </div>
                        </div>
                    </div>

                    <form action="<?php echo e(url('inquiry/submit-quote-inquiry')); ?>" method="post">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-box">
                                <div class="form-wrap p-15">
                                    <div class="row">
                                        <?php if($panelFields && count($panelFields) > 0 && $masterFields && count($masterFields) > 0): ?>
                                        <?php $__currentLoopData = $masterFields; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = json_decode($panelFields['panel_fields']); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $pfield): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if(($mfield['id'] == $pfield) && $mfield['field_name'] == 'viewing_length'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo e(($errors->has('viewing_length') ? 'has-error' : '')); ?>">
                                                <label for="grantor">Acrylic panel viewing length</label>
                                                <p class="feild_info">( All dimensions must be given inches )</p>
                                                <input type="text" name="viewing_length" value="<?php echo e(old('viewing_length')); ?>" class="form-control"  placeholder="Acrylic panel viewing length">
                                                <?php if($errors->has('viewing_length')): ?>
                                                    <span id="viewing_length-error" class="help-block error-help-block"><?php echo e($errors->first('viewing_length')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if(($mfield['id'] == $pfield) && $mfield['field_name'] == 'viewing_arc_length'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo e(($errors->has('viewing_arc_length') ? 'has-error' : '')); ?>">
                                                <label for="grantor"> Acrylic Viewing Arc Length</label>
                                                <p class="feild_info">( All dimensions must be given inches )</p>
                                                <input type="text" name="viewing_arc_length" value="<?php echo e(old('viewing_arc_length')); ?>" class="form-control" placeholder="Acrylic Viewing Arc Length">
                                                <?php if($errors->has('viewing_arc_length')): ?>
                                                    <span id="viewing_arc_length-error" class="help-block error-help-block"><?php echo e($errors->first('viewing_arc_length')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                         <?php endif; ?>
                                        <?php if(($mfield['id'] == $pfield) && $mfield['field_name'] == 'interior_radius'): ?>
                                        <div class="col-sm-12">
                                                <div class="form-group <?php echo e(($errors->has('interior_radius') ? 'has-error' : '')); ?>">
                                                    <label for="grantor">Interior Radius</label>
                                                    <input type="text" name="interior_radius" value="<?php echo e(old('interior_radius')); ?>" class="form-control" placeholder="Interior Radius">
                                                    <?php if($errors->has('interior_radius')): ?>
                                                        <span id="interior_radius-error" class="help-block error-help-block"><?php echo e($errors->first('interior_radius')); ?></span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php endif; ?>
                                        <?php if(($mfield['id'] == $pfield) && $mfield['field_name'] == 'exterior_radius'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo e(($errors->has('exterior_radius') ? 'has-error' : '')); ?>">
                                                <label for="grantor">Exterior Radius</label>
                                                <input type="text" name="exterior_radius" value="<?php echo e(old('exterior_radius')); ?>" class="form-control" placeholder="Exterior Radius">
                                                <?php if($errors->has('exterior_radius')): ?>
                                                    <span id="exterior_radius-error" class="help-block error-help-block"><?php echo e($errors->first('exterior_radius')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        
                                        <?php endif; ?>
                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'viewing_width'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo e(($errors->has('viewing_width') ? 'has-error' : '')); ?>">
                                                <label for="grantor">Acrylic panel viewing width</label>
                                                <p class="feild_info">( All dimensions must be given inches )</p>
                                                <input type="text" name="viewing_width" value="<?php echo e(old('viewing_width')); ?>" class="form-control" placeholder="Acrylic panel viewing width">
                                                <?php if($errors->has('viewing_width')): ?>
                                                    <span id="viewing_width-error" class="help-block error-help-block"><?php echo e($errors->first('viewing_width')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'viewing_width_1'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo e(($errors->has('viewing_width_1') ? 'has-error' : '')); ?>">
                                                <label for="grantor">Acrylic panel viewing width #1</label>
                                                <input type="text" name="viewing_width_1" value="<?php echo e(old('viewing_width_1')); ?>" class="form-control" placeholder="Acrylic panel viewing width #1">
                                                <?php if($errors->has('viewing_width_1')): ?>
                                                    <span id="viewing_width_1-error" class="help-block error-help-block"><?php echo e($errors->first('viewing_width_1')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'viewing_width_2'): ?>

                                        <div class="col-sm-12 ">
                                            <div class="form-group <?php echo e(($errors->has('viewing_width_2') ? 'has-error' : '')); ?>">
                                                <label for="grantor">Acrylic panel viewing width #2</label>
                                                <input type="text" name="viewing_width_2" value="<?php echo e(old('viewing_width_2')); ?>" class="form-control" placeholder="Acrylic panel viewing width #2">
                                                <?php if($errors->has('viewing_width_2')): ?>
                                                    <span id="viewing_width_2-error" class="help-block error-help-block"><?php echo e($errors->first('viewing_width_2')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>


                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'viewing_height'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo e(($errors->has('viewing_height') ? 'has-error' : '')); ?>">
                                                <label for="grantor">Acrylic panel viewing height</label>
                                                <p class="feild_info">( All dimensions must be given inches )</p>
                                                <input type="text" name="viewing_height" value="<?php echo e(old('viewing_height')); ?>" class="form-control"   placeholder="Acrylic panel viewing height">
                                                <?php if($errors->has('viewing_height')): ?>
                                                    <span id="viewing_height-error" class="help-block error-help-block"><?php echo e($errors->first('viewing_height')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'engineering_stamp'): ?>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="grantor">Engineering PE stamp</label>
                                                <div class="radio-box">
                                                    <input type="radio" <?php echo e((old('engineering_stamp')=="1") ? "checked" : ''); ?> value="1" name="engineering_stamp"><span>Yes</span>
                                                    <input type="radio" <?php echo e((old('engineering_stamp')=="1") ? "" : 'checked'); ?> name="engineering_stamp" value="0"><span>No</span>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'wind_mitigation'): ?>
                                        <div class="col-sm-6">
                                            <div class="m-b-5 form-group ">
                                                <label for="grantor">Wind mitigation</label>
                                                <div class="radio-box">
                                                    <input type="radio" name="wind_mitigation"  <?php echo e((old('wind_mitigation')=="1") ? "checked" : ''); ?> value="1" onclick="showcontent02();"><span>Yes</span>
                                                    <?php if(old('wind_mitigation')=="1"): ?>
                                                        <script>
                                                            $(document).ready(function(){
                                                                showcontent02();
                                                            })
                                                        </script>
                                                    <?php endif; ?>
                                                    <input type="radio" name="wind_mitigation"  <?php echo e((old('wind_mitigation')=="1") ? "" : 'checked'); ?> value="0" onclick="hidecontent02();"><span>No</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div id="wind-info" class="col-sm-12" style="display:none;">


                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label>MPH of wind</label>
                                                        <select class="selectpicker form-control" id="foo" data-size="5">

                                                        </select>   
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="grantor">Building height</label>
                                                        <select class="selectpicker form-control" id="foo01" data-size="5">

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="grantor">Story of building panel is located on</label>
                                                        <select class="selectpicker form-control" id="foo02" data-size="5">

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="grantor">Upload pdf</label>
                                                        <input type="file" name="img[]" class="file">
                                                        <div class="input-group col-xs-12">
                                                            <input type="text" class="form-control input-lg" disabled placeholder="Upload pdf">
                                                            <span class="input-group-btn">
                                                                <button class="browse btn  upload-btn" type="button" data-toggle="tooltip" title="upload pdf"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'visible_diameter'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group <?php echo e(($errors->has('visible_diameter') ? 'has-error' : '')); ?>">
                                                <label for="grantor">Visible diameter of panel </label>
                                                <p class="feild_info">( All dimensions must be given inches )</p>
                                                <input type="text" name="visible_diameter" value="<?php echo e(old('visible_diameter')); ?>" class="form-control" placeholder="Visible diameter of panel  ">
                                                <?php if($errors->has('visible_diameter')): ?>
                                                    <span id="visible_diameter-error" class="help-block error-help-block"><?php echo e($errors->first('visible_diameter')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'waterline_height'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group  <?php echo e(($errors->has('waterline_height') ? 'has-error' : '')); ?>">
                                                <label for="grantor">Dry side sill waterline height</label>
                                                <p class="feild_info">( All dimensions must be given inches )</p>
                                                <input type="text" value="<?php echo e(old('waterline_height')); ?>" name="waterline_height" class="form-control"  placeholder="Dry side sill waterline height">
                                                <?php if($errors->has('waterline_height')): ?>
                                                    <span id="waterline_height-error" class="help-block error-help-block"><?php echo e($errors->first('waterline_height')); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php if($mfield['id'] == $pfield && $mfield['field_name'] == 'manufacture_quantity'): ?>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="grantor" class="manuf_quantity">Manufacture quantity</label>
                                                <select class="selectpicker form-control"  id="foo03" data-size="5" name="manufacture_quantity">

                                                </select>   
                                            </div>
                                        </div>
                                        <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endif; ?>  
                                    </div>
                                </div>
                            </div> 
                        </div>

                        <div class="col-sm-6 panel-image-section">
                            <?php if(array_key_exists(1,$panelImages)): ?>
                            <div class="col-sm-12 text-center">
                                <div class="panel_image">
                                    <img src="<?php echo e(asset('public/images/'.$panelImages[1]['image_path'])); ?>" alt="image"  class="img-responsive center-block" /> 
                                </div>

                                <div class="name">
                                    plan view
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if(array_key_exists(2,$panelImages)): ?>
                            <div class="col-sm-12 text-center">
                                <div class="panel_image">
                                    <img src="<?php echo e(asset('public/images/'.$panelImages[2]['image_path'])); ?>" alt="image" class="img-responsive center-block" /> 
                                </div>

                                <div class="name">
                                    elevation
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if(array_key_exists(3,$panelImages)): ?>
                            <div class="col-sm-12 text-center">
                                <div class="panel_image">
                                    <img src="<?php echo e(asset('public/images/'.$panelImages[3]['image_path'])); ?>" alt="image" class="img-responsive center-block" /> 
                                </div>

                                <div class="name">
                                    section
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="form-group btn-form text-center">
                                <?php echo e(csrf_field()); ?>

                                <input type="hidden" name="panel_id" value="<?php echo e($panel->id); ?>" >
                                <button class="btn btn-primary btn-lg btn-rounded sure-alert"  type="submit" >Submit</button>
                                <!--<a class="btn btn-lg btn-rounded gray-btn" href="../customer/choose-panel-type.php">Back</a>-->
                            </div>
                        </div>
                    </div>
                </form>  
                </div>
            </div>
        </div>
    </div>
</div>
<!--                                        <div class="row">
                                                                                <div class="col-sm-12">
                                                                                    <div class="form-group">
                                                                                        <label for="grantor">Installation </label>
                                                                                        <div class="radio-box ">
                                                                                            <input type="radio" name="inst" onclick="showcontent01();" value="yes"><span>Yes</span>
                                                                                            <input type="radio" name="inst" onclick="hidecontent01();" value="no"><span>No</span>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div id="inst_info" style="display:none;">
                                                                                        <div class="form-group">
                                                                                            <label>Installation option</label>
                                                                                            <select class="selectpicker form-control" >
                                                                                                <option>No rebate waterproofing with standard cure </option>
                                                                                                <option>Rebate waterproofing with standard cure</option>
                                                                                                <option>No rebate waterproofing with rapid cure</option>
                                                                                                <option>Rebate waterproofing with rapid cure silicone</option>
                                                                                            </select>
                                                                                            <a href="http://acrylicpools.com/swimming-pool-windows/installation/" class="inst-description">Installation package description</a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>-->

<script>

    $(document).ready(function () {
        var elm = document.getElementById('foo'),
                df = document.createDocumentFragment();
        for (var i = 1; i <= 200; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.appendChild(document.createTextNode(i));
            df.appendChild(option);
        }
        elm.appendChild(df);

    });

    (function () {
        var elm = document.getElementById('foo01'),
                df = document.createDocumentFragment();
        for (var i = 1; i <= 200; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.appendChild(document.createTextNode(i));
            df.appendChild(option);
        }
        elm.appendChild(df);
    }());

    (function () {
        var elm = document.getElementById('foo02'),
                df = document.createDocumentFragment();
        for (var i = 1; i <= 200; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.appendChild(document.createTextNode(i));
            df.appendChild(option);
        }
        elm.appendChild(df);
    }());

    (function () {
        var elm = document.getElementById('foo03'),
                df = document.createDocumentFragment();
        for (var i = 1; i <= 100; i++) {
            var option = document.createElement('option');
            option.value = i;
            option.appendChild(document.createTextNode(i));
            df.appendChild(option);
        }
        elm.appendChild(df);
    }());


    function showcontent01() {
        document.getElementById("inst_info").style.display = "block";
    }
    function hidecontent01() {
        document.getElementById("inst_info").style.display = "none";
        document.getElementById("wind-info").style.display = "none";
    }

    function showcontent02() {
        document.getElementById("wind-info").style.display = "block";
    }
    function hidecontent02() {
        document.getElementById("wind-info").style.display = "none";
    }

    $(document).ready(function () {
        $('.browse').click(function () {

            var file = $(this).parent().parent().parent().find('.file');
            file.trigger('click');
        });
        $(document).on('change', '.file', function () {
            $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
        });
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>