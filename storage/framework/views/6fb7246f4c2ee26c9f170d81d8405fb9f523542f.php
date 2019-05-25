<?php $__env->startSection('content'); ?>
<main class="main-content ">
    <section class="admin-general-information">
        <div class="container">
            <div class="quote_icon">
                <ul class="list-inline">
                    <li class="blue-color">
                        <a href=".congratulation-won" data-toggle="modal">
                            <i class="fa fa-trophy" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="pink-color">
                        <a href=".reject" data-toggle="modal">
                            <i class="fa fa-trash-o" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="red-color">
                        <a href="" data-toggle="tooltip" data-placement="top" title="copy">
                            <i class="fa fa-clipboard" aria-hidden="true"></i>
                        </a>
                    </li>
                    <li class="green-color">
                        <a href="javascript:void(0)" data-toggle="tooltip" title="edit" onclick="makeEditable(this);"  data-placement="top" title="edit">
                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> 
                        </a>
                    </li >
                    <li class="yellow-color">
                        <a href=".transfer-sales" data-toggle="modal">
                            <span dat>  <i class="fa fa-exchange" aria-hidden="true"></i> 
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="javascript:void(0)" onclick="getInquireForm(<?php echo e($inquiry->id); ?>)" aria-controls="inquiry-info" role="tab" data-toggle="tab" data-target="#inquiry-info">
<!--                            <span class="icon icon-info"></span>-->
                        <span> INQUIRY INFORMATION</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="javascript:void(0)" onclick="getEmailSection()" aria-controls="email" role="tab" data-toggle="tab" data-target="#email">
<!--                            <span class="icon icon-email"></span>-->
                        <span>  EMAIL</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="javascript:void(0)" onclick="getPanelsSection()" aria-controls="panels" role="tab" data-toggle="tab" data-target="#panels">
<!--                            <span class="icon icon-panels"></span>-->
                        <span>PANELS</span>
                    </a>
                </li>
                <li role="presentation">
                    <a href="javascript:void(0)" onclick="loadFolderSection(<?php echo e($inquiry->id); ?>);" aria-controls="folder" role="tab" data-toggle="tab" data-target="#folder">
<!--                            <span class="icon icon-folder"></span>-->
                        <span> FOLDER</span>
                    </a>
                </li>
            </ul>

            <div class="info-main-box mt-0 clearfix ">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane m-t-20 active" id="inquiry-info"></div>
                        <div role="tabpanel" class="tab-pane" id="email"></div>
                        <div role="tabpanel" class="tab-pane " id="panels"></div>
                        <div role="tabpanel" class="tab-pane" id="folder"></div>
                    </div>
                </div>
            </div>
        </div>
 </section>

 <script>
    $('select.selectpicker').on('change', function () {
    $('#country_id').valid();
     });
 </script>
    <?php echo $__env->make('flash::message', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<script type="text/javascript">
        $(document).ready(function () {
             getInquireForm(<?php echo e($inquiry->id); ?>);
              $('[data-toggle="tooltip"]').tooltip();
         });
    
function loadFolderSection(id){
    var url = '<?php echo e(url("admin/directory/load-file-section")); ?>/'+id;
    $.ajax({
        url: url,
        type: 'get',
        data: '',
        dataType: 'json',
        success: function (res) {
            $('#folder').html(res.html);
        },
        beforeSend:function(){
            $('#folder').html('Loading...');
        }
    });
}

    function getInquireForm(id){
      var url = '<?php echo e(url("admin/inquiry/get-inquiry-form")); ?>/'+id;
         $.ajax({
         url: url,
         data: '',
         success: function (res) {
            $('#inquiry-info').html('');
            $('#inquiry-info').html(res);
            $('.country_selectpicker').selectpicker();
            $('.load_value_selectpicker').selectpicker();
            $(".datetimepicker2").datetimepicker({
            format: "MM-DD-YY",
                // autoclose: true,
                //todayBtn: true,
                //pickerPosition: "bottom-left"
           });
        },beforeSend:function(){
            $('#inquiry-info').html('Loading...');
        }
    });
 } 
    function getPanelsSection(){
        var url = '<?php echo e(url("admin/inquiry/get-panels-section")); ?>';
          $.ajax({
            url: url,
            type: 'get',
            data: '',
            dataType: 'json',
            success: function (res) {
               $('#panels').html(res.html);
            },
           beforeSend:function(){
           $('#panels').html('Loading...');
         }
    });
 }

    function getEmailSection(){
        var url = '<?php echo e(url("admin/inquiry/get-email-section")); ?>';
           $.ajax({
                url: url,
                type: 'get',
                data: '',
                dataType: 'json',
                success: function (res) {
                    $('#email').html(res.html);
                },
                    beforeSend:function(){
                     $('#email').html('Loading...');
                }
            });
}
</script>  

    <div class="modal fade modal-style transfer-sales" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <h3 class="heading">Inquiry has been transferred to Sales Manager</h3>
                    <div class="text-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade modal-style reject" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <h3 class="heading">Client has been Rejected Initial Proposal Quote !</h3>
                    <p>(Re-Negatiate Condition)</p>
                    <div  class="text-center">
                     <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>

   <div class="modal fade modal-style congratulation-won" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                    <div class="modal-body">
                    <h3 class="heading">congratulations!!!</h3>
                    <h4 class="text-center"> You have Won The Project</h4>
                    <p>(Inquiry has been transferred to Account Department)</p>
                    <div class="text-center">
                         <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
         </div>
    </div>

<!--modal-add-new-folder-->

<!--modal-compose-email-message-->
    <div aria-hidden="true" aria-labelledby="myModalLabel" data-easein="expandIn" role="dialog" tabindex="-1" id="myModal" class="modal fade modal-style" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
                    <h3 class="modal-title compose-heading">Compose</h3>
                </div>
                <div class="modal-body">
                    <form role="form" class="form-horizontal">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>To</label>

                                <input type="text" placeholder="" id="inputEmail1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Cc / Bcc</label>

                                <input type="text" placeholder="" id="cc" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Subject</label>

                                <input type="text" placeholder="" id="inputPassword1" class="form-control">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label>Message</label>
                                <textarea rows="10" cols="30" class="form-control" id="" name=""></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class=" col-lg-12 text-center">
                                <span class="file-attachment text-center">
                                    <span class="btn btn-default btn-file">
                                        <i class="fa fa-plus" aria-hidden="true"></i> Attachment 
                                        <input type="file">
                                    </span>
                                </span>
                                <button class="btn btn-send" type="submit">Send</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin::layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>