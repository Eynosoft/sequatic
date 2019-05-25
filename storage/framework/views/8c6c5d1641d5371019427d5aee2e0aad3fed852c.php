<?php $__env->startSection('content'); ?>

<section class="admin-general-information ">  
    <div class="container">
        <div class="heading">
            <h2>General Inquiry Information</h2>
        </div>
        <div class="info-main-box clearfix  p-35">
            <form id="general-inquiry-edit-form" name="general-inquiry-edit-form" method="post" onsubmit="updateInquerydata(this); return false;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="head_ic clearfix">
                    <div class="heading">
                        <h3>Inquiry Form</h3>
                    </div>
                    <div class="icon">
                        <a href="javascript:void(0)" data-toggle="tooltip" title="edit" onclick="makeEditable(this);">  <i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                    </div>
                </div>
                
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Project ID:</label>
                                <input type="text" class="form-control" readonly value="<?php echo e($inquiry->id); ?>">    
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Date Of Inquiry:</label>
                                <div class='input-group date'>
                                    <input type='text' class="form-control datetimepicker1" readonly value="<?php echo e($inquiry->created_at->format('m-d-Y')); ?>" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>   
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Lead Value:</label>
                                <select class="selectpicker form-control" name="lead_value" disabled=" disabled" readonly>
                                    <option>Select</option>
                                    <option value="Hot" <?php echo e(($inquiry->lead_value == 'Hot') ? 'Selected':''); ?>>Hot</option>
                                    <option value="Warm" <?php echo e(($inquiry->lead_value == 'Warm') ? 'Selected':''); ?>>Warm</option>
                                    <option value="Medium" <?php echo e(($inquiry->lead_value == 'Medium') ? 'Selected':''); ?>>Medium</option>
                                    <option value="Cold" <?php echo e(($inquiry->lead_value == 'Cold') ? 'Selected':''); ?>>Cold</option>
                                </select>   
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Last Change Date:</label>
                                <div class='input-group date'>
                                    <input type='text' class="form-control datetimepicker1" readonly value="<?php echo e($inquiry->updated_at->format('m-d-Y')); ?>" />
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar" aria-hidden="true"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>First Name:</label>
                                <input type="text" name="first_name" class="form-control" readonly value="<?php echo e($inquiry->first_name); ?>">    
                                <input type="hidden" name="id" class="form-control" readonly value="<?php echo e($inquiry->id); ?>">    
                                <input type="hidden" name="inquiry_type" class="form-control" readonly value="<?php echo e($inquiry->inquiry_type); ?>">    
                                <?php echo e(csrf_field()); ?>

                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Last Name:</label>
                                <input type="text" name="last_name" class="form-control" readonly value="<?php echo e($inquiry->last_name); ?>">    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Email:</label>
                                <input type="text" name="email" class="form-control" readonly value="<?php echo e($inquiry->email); ?>">    
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Email(2):</label>
                                 <input type="text" name="alternet_email" class="form-control" readonly value="<?php echo e($inquiry->alternet_email); ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Phone:</label>
                                <input type="text" name="phone" class="form-control" data-masked-input="999-999-9999" maxlength="12" readonly value="<?php echo e($inquiry->phone); ?>">    
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Mobile:</label>
                                <input type="text" name="mobile" class="form-control" data-masked-input="999-999-9999" maxlength="12"  readonly value="<?php echo e($inquiry->mobile); ?>">    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Fax:</label>
                                <input type="text" name="fax" class="form-control" readonly value="<?php echo e($inquiry->fax); ?>">    
                            </div>
                        </div>

<!--                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Other:</label>
                                <input type="text"  class="form-control" readonly value="1234567890">    
                            </div>
                        </div>-->
                    </div>



                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Company Name:</label>
                                <input type="text" name="company_name" class="form-control" readonly value="<?php echo e($inquiry->company_name); ?>">    
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Website:</label>
                                <input type="text"  name="website" class="form-control" readonly value="<?php echo e($inquiry->website); ?>">    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Address:</label>
                                <textarea class="form-control" rows="10" name="address" readonly ><?php echo e($inquiry->address); ?></textarea> 
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Zip:</label>
                                <input type="text" class="form-control" name="zipcode" data-masked-input="999999" maxlength="5" readonly value="<?php echo e($inquiry->zipcode); ?>">    
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Country:</label>
                                <select class="form-control selectpicker" name="country_id" readonly disabled="" id="country_id" value="<?php echo e(old('country_id')); ?>">
                                 <option value="">Select a country</option> 
                                    <?php if($countries): ?>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($country->id); ?>" <?php echo e($inquiry->country_id == $country->id ? 'selected="selected"' : ''); ?>><?php echo e($country->country_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>  
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>State:</label>
                                <input type="text" class="form-control" readonly name="state" value="<?php echo e($inquiry->state); ?>">    
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="form-group">
                                <label>Comment:</label>
                                <input type="text" class="form-control" readonly name="comment"  value="<?php echo e($inquiry->comment); ?>">    
                            </div>
                        </div>
                    </div>   
            </div>

            <div class="main-box-btn p-t-20 clearfix">
<!--                <div class="inquairy-btn-left">
                    <a href="<?php echo e(url('/admin')); ?>" class="btn"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
                </div>-->

                <div class="inquairy-btn-right">
                    <input type="submit" id="edit-inquiry" class="btn blue-btn" value="Update" style="display: none;"/>
<!--                    <a href=".transfer-sales" data-toggle="modal" class="btn blue-btn "> Transfer Sales Manager</a>
                    <a href=".inquiry-solve" data-toggle="modal" class="btn blue-btn"> Mark as Solved</a>
                    <a href="../customer/choose-panel-type.php" class="btn blue-btn"> Convert to Quote</a>-->
                </div>

            </div>
            </form>
            <div class="Email-box">
                        <div class="content-heading">
                            <h3>Email:</h3>
                        </div>
                        <div class="image">

                            <div class="mail-box">
                                <aside class="sm-side">

                                    <div class="inbox-body">
                                        <a href="#myModal" data-toggle="modal" title="Compose" class="btn btn-compose">
                                            Compose
                                        </a>
                                        <!-- Modal -->
                                        <!-- /.modal -->
                                    </div>
                                    <ul class="inbox-nav inbox-divider">
                                        <li class="active">
                                            <a href="#"><i class="fa fa-inbox"></i> Inbox <span class="label label-danger pull-right">2</span></a>

                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-envelope-o"></i> Sent Mail</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class="fa fa-bookmark-o"></i> Important</a>
                                        </li>
                                        <li>
                                            <a href="#"><i class=" fa fa-external-link"></i> Drafts <span class="label label-info pull-right">30</span></a>
                                        </li>
                                        <li>
                                            <a href="#"><i class=" fa fa-trash-o"></i> Trash</a>
                                        </li>
                                    </ul>


                                </aside>
                                <aside class="lg-side">
                                    <div class="inbox-head">
                                        <h3>Inbox</h3>
                                    </div>
                                    <div class="inbox-body">
                                        <div class="mail-option">
                                            <div class="chk-all">
                                                <input type="checkbox" class="mail-checkbox mail-group-checkbox">
                                                <div class="btn-group">
                                                    <a data-toggle="dropdown" href="#" class="btn mini all" aria-expanded="false">
                                                        All
                                                        <i class="fa fa-angle-down "></i>
                                                    </a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#"> None</a></li>
                                                        <li><a href="#"> Read</a></li>
                                                        <li><a href="#"> Unread</a></li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="btn-group">
                                                <a data-original-title="Refresh" data-placement="top" data-toggle="dropdown" href="#" class="btn mini tooltips">
                                                    <i class=" fa fa-refresh"></i>
                                                </a>
                                            </div>
                                            <div class="btn-group hidden-phone">
                                                <a data-toggle="dropdown" href="#" class="btn mini blue" aria-expanded="false">
                                                    More
                                                    <i class="fa fa-angle-down "></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                                </ul>
                                            </div>
                                            <div class="btn-group">
                                                <a data-toggle="dropdown" href="#" class="btn mini blue">
                                                    Move to
                                                    <i class="fa fa-angle-down "></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#"><i class="fa fa-pencil"></i> Mark as Read</a></li>
                                                    <li><a href="#"><i class="fa fa-ban"></i> Spam</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#"><i class="fa fa-trash-o"></i> Delete</a></li>
                                                </ul>
                                            </div>

                                            <ul class="list-unstyled inbox-pagination">
                                                <li><span>1-50 of 234</span></li>
                                                <li>
                                                    <a class="np-btn" href="#"><i class="fa fa-angle-left  pagination-left"></i></a>
                                                </li>
                                                <li>
                                                    <a class="np-btn" href="#"><i class="fa fa-angle-right pagination-right"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="">
                                            <table class="table table-inbox table-hover">
                                                <tbody>
                                                    <tr class="unread">
                                                        <td class="inbox-small-cells">
                                                            <input type="checkbox" class="mail-checkbox">
                                                        </td>
                                                        <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                                        <td class="view-message  dont-show">PHPClass</td>
                                                        <td class="view-message ">Added a new class: Login Class Fast Site</td>
                                                        <td class="view-message  inbox-small-cells"><i class="fa fa-paperclip"></i></td>
                                                        <td class="view-message  text-right">9:27 AM</td>
                                                    </tr>
                                                    <tr class="unread">
                                                        <td class="inbox-small-cells">
                                                            <input type="checkbox" class="mail-checkbox">
                                                        </td>
                                                        <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                                        <td class="view-message dont-show">Google Webmaster </td>
                                                        <td class="view-message">Improve the search presence of WebSite</td>
                                                        <td class="view-message inbox-small-cells"></td>
                                                        <td class="view-message text-right">March 15</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td class="inbox-small-cells">
                                                            <input type="checkbox" class="mail-checkbox">
                                                        </td>
                                                        <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                                        <td class="view-message dont-show">Nishant kumar</td>
                                                        <td class="view-message">Last Chance: Upgrade to Pro for </td>
                                                        <td class="view-message inbox-small-cells"></td>
                                                        <td class="view-message text-right">March 15</td>
                                                    </tr>
                                                    <tr class="">
                                                        <td class="inbox-small-cells">
                                                            <input type="checkbox" class="mail-checkbox">
                                                        </td>
                                                        <td class="inbox-small-cells"><i class="fa fa-star"></i></td>
                                                        <td class="view-message dont-show">Nishant kumar T.D.S</td>
                                                        <td class="view-message">Boost Your Website Traffic</td>
                                                        <td class="view-message inbox-small-cells"></td>
                                                        <td class="view-message text-right">April 01</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </aside>
                            </div>
                        </div>


                    </div>
            <div class="main-box-btn p-t-20 clearfix">
                        <div class="inquairy-btn-left">
                            <a href="<?php echo e(url('/admin')); ?>" class="btn"> <i class="fa fa-long-arrow-left" aria-hidden="true"></i> Back</a>
                        </div>

                        <div class="inquairy-btn-right">
                            <a href=".transfer-sales" data-toggle="modal" class="btn blue-btn "> Transfer Sales Manager</a>
                            <a href=".inquiry-solve" data-toggle="modal" class="btn blue-btn"> Mark as Solved</a>
                            <a href="../customer/choose-panel-type.php" class="btn blue-btn"> Convert to Quote</a>
                        </div>

                    </div>
        </div>
    </div>
    
</section>
<?php echo JsValidator::formRequest('App\Http\Requests\generalInquiryRequest','#general-inquiry-edit-form'); ?>

<script>
$('select.selectpicker').on('change', function(){
   $('#country_id').valid();
});
</script>
<?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $(".datetimepicker1").datetimepicker({
            format: "MM-DD-YYYY",
            // autoclose: true,
            //todayBtn: true,
            //pickerPosition: "bottom-left"
        });

    });

    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
    function makeEditable(el){

        $('#general-inquiry-edit-form :input').prop('disabled',false);
        $('#general-inquiry-edit-form :input').prop('readonly',false);
        $('#edit-inquiry').show();
        //el.remove();
        $('.selectpicker').selectpicker('refresh');
    }
</script>  

<div class="modal fade modal-style transfer-sales" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">Inquiry has been transferred to Sales Manager</h3>
<!--                <p>General Inquiry is Successfully Transfered to Sales Manager</p>-->
                <div class="text-center">
                    <a href="dashboard.php" class="btn btn-secondary blue-btn">OK</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</a>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-style inquiry-solve" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">Inquiry has been solved</h3>
                <div class="text-center">
                    <a href="dashboard.php" class="btn btn-secondary blue-btn">OK</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</a
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

</div>
<script>
function updateInquerydata(form){
  if($(form).valid()) {
var url = '<?php echo e(url("admin/inquiry/update")); ?>';
   $.ajax({
        url: url,
        type: 'post',
        data: $('#general-inquiry-edit-form').serialize(),
        dataType: 'json',
        success: function (res) {
          if(res.success){
                setTimeout(function(){
                    swal('Success!',res.message,'success');
                },1);
            }else{
                setTimeout(function(){
                    swal('Error!',res.message,'error');
                },1);
            }
        },
    });
  }else{
    console.log('still errors');
    return false;
  }
}
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>