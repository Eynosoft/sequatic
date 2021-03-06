<?php 
    use App\common\helpers\User;
?>


<?php $__env->startSection('content'); ?>
<div class="admin_content admin-general-information">
    <div class="container-fluid"> 
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="admin_main_heading"><?php echo e(User::getRoleName()); ?> Dashboard</h2>
            </div>
        </div>

        <div class="row main_info_box" id="load-general-inquiry-statics">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="box_cnt">
                    <div class="count" id="total_recieved"><i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i></div>
                    <div>Inquiry Received</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="box_cnt">
                    <div class="count" id="total_pending"><i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i></div>
                    <div>Inquiry Pending</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="box_cnt">
                    <div class="count" id="total_solved"><i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i></div>
                    <div>Inquiry Solved</div>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="box_cnt">
                    <div class="count" id="total_trash"><i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i></div>
                    <div>Inquiry Trash</div>
                </div>
            </div>
        </div>

        <section class="section_padding">

            <div class="panel panel-default">
                <div class=" col-lg-12 text-right search_bar">
                    <div class="row search_section">
                        <div class="col-lg-7">
                            <div class="heading text-center">
                                <h3>General Inquiry</h3>
                            </div>
                        </div>
                        <div class="pull-right col-lg-5">
                            <form name="searchform" id="searchform">
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <div class='input-group date datetimepicker'>
                                            <input type='text' name="created_at" class="form-control" placeholder="Date" />
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <input type="text" name="keyword" class="form-control" placeholder="keyword">
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3">
                                    <div class="form-group">
                                        <select class="selectpicker form-control" name="lead_value">
                                            <option value="">All</option>
                                            <option value="Hot">Hot</option>
                                            <option value="Warm">Warm</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Cold">Cold</option>
                                        </select>
                                        <?php echo e(csrf_field()); ?>

                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-3 col-sm-3 text-center">
                                    <button class="search_btn" onclick="loadGeneralInquiry(); return false;">Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body table-data-load" style="padding:0px" id="load-general-inquiry">
                    <i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom">
                        
                    </i>
                
                </div>
            </div>
        </section>
    </div>
</div> 

<div class="modal fade modal-style transfer-sales" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">Inquiry has been transferred to Sales Manager</h3>
                <p>General Inquiry is Successfully Transfered to Sales Manager</p>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>

<div class="modal fade modal-style trash-bin" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <h3 class="heading">inquiry has been transferred to trash bin! </h3>
                <div class="text-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        loader = '<i class="fa fa-spinner fa-pulse fa-1 fa-fw margin-bottom"></i>';
        loadGeneralInquiry();
        loadGeneralInquiryStatics();

        $(".datetimepicker").datetimepicker({
            format: "DD-MM-YYYY",
            // autoclose: true,
            //todayBtn: true,
            //pickerPosition: "bottom-left"
        });
        $('[data-toggle="tooltip"]').tooltip();
    });
    function loadGeneralInquiry(url) {
        //$('#load-general-inquiry').html(loader);
        if (url == 'undefined' || url == '' || url == null) {
            url = '<?php echo e(url("admin/load-general-inquiry")); ?>';
        }
        $.ajax({
            url: url,
            type: 'post',
            data: $('#searchform').serialize(),
            dataType: 'json',
            success: function (res) {
                $('#load-general-inquiry').html('');
                $('#load-general-inquiry').html(res.html);
            }
        });
    };
    function loadGeneralInquiryStatics() {
        $('.count').html(loader);
        var url = '<?php echo e(url("admin/load-general-inquiry-statics")); ?>';
        $.ajax({
            url: url,
            type: 'post',
            data: {'_token':'<?php echo e(csrf_token()); ?>'},
            dataType: 'json',
            success: function (res) {
                $('#total_recieved').html(res.total_recieved);
                $('#total_pending').html(res.total_pending);
                $('#total_solved').html(res.total_solved);
                $('#total_trash').html(res.total_trash);
            }
        });
    };
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>