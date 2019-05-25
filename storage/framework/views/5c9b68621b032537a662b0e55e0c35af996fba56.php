<?php $__env->startSection('content'); ?>
<div class="admin_content admin-general-information">
    <div class="container-fluid"> 
<!--        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <h2 class="admin_main_heading">Sales Representative Dashboard</h2>
            </div>
        </div>-->
        <section class="section_padding">

            <div class="panel panel-default">
                <div class=" col-lg-12 text-right search_bar">
                    <div class="row search_section">
                        <div class="col-lg-7">
                            <div class="heading text-center">
                                <h3>Quote Proposal Versions</h3>
                            </div>
                        </div>
                        <div class="pull-right col-lg-5">
                            
                            <form name="searchform" id="searchform">
                                <?php echo e(csrf_field()); ?>

                            </form>

                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <div class="panel-body table-data-load" style="padding:0px" id="load-quote-detail">
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
        loadQuoteDetail();
        /*
        $(".datetimepicker").datetimepicker({
            format: "DD-MM-YYYY",
            // autoclose: true,
            //todayBtn: true,
            //pickerPosition: "bottom-left"
        });*/
        $('[data-toggle="tooltip"]').tooltip();
    });
    function loadQuoteDetail(url) {
        if (url == 'undefined' || url == '' || url == null) {
            url = '<?php echo e(url("admin/inquiry-detail/load-quote-detail")); ?>'+'/<?php echo e($id); ?>';
        }
        $.ajax({
            url: url,
            type: 'post',
            data: $('#searchform').serialize(),
            dataType: 'json',
            success: function (res) {
                
                $('#load-quote-detail').html('');
                $('#load-quote-detail').html(res.html);
            }
        });
    };
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>