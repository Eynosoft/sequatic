<div class="folder_section">
    <div class="bottom-border clearfix">
        <div class="heading-left">
            <h3>
                Folder :
            </h3>
        </div>
        <div class=" button-right">
            <a href="javascript:void(0)" onclick="showCreateModal();" class="btn btn-xs" >
                <i class="fa fa-plus" aria-hidden="true"></i>   Add New Folder
            </a> 
        </div>
    </div>
    
    <div class="folder-box">
        <?php if($directory && count($directory) > 0): ?>
        <ul class="list-inline">
            <?php $__currentLoopData = $directory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dir): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
                <a href="<?php echo e(url('/admin/inquiry/media')); ?>/<?php echo e($dir->id); ?>">
                    <i class="fa fa-folder" aria-hidden="true"></i>
                    <p title="<?php echo e($dir->directory_name); ?>"><?php echo e(substr($dir->directory_name,0,5)); ?></p>
                </a>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
        <?php else: ?>
            <span>No folders found</span>
        <?php endif; ?>
    </div>
</div>

<div class="modal fade modal-style create_folder" id="form_model" data-easein="expandIn" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
              
                <h3 class="heading">Create New Folder </h3>
                <form id="create-directory-form" name="create-directory-form" onsubmit="createDirectory(this,<?php echo e($inquiry->id); ?>); return false;">
                      
                    <div class="form-group">
                        <label>Folder Name :</label>
                        <input type="text" class="form-control" name="directory_name">
                        <input type="hidden" name="inquiry_id" value="<?php echo e($inquiry->id); ?>">
                        <?php echo e(csrf_field()); ?>

                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-secondary blue-btn">Submit</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>
<?php echo JsValidator::formRequest('App\Admin\Http\Requests\createDirectoryRequest','#create-directory-form'); ?>

<script>
    function showCreateModal(){
//    $("#create-directory-form").data('validator').resetForm();
//    $("#create-directory-form")[0].reset();
//    $("#create-directory-form").find('.has-success').removeClass('has-success');
//    $("#create-directory-form").find('.has-error').removeClass('has-error');
    $('#form_model').modal('show');
} 

function createDirectory(form,id){
    if($(form).valid()) {
    // do your ajax stuff here
    var url = '<?php echo e(url("admin/directory/create")); ?>';
    $.ajax({
        url: url,
        type: 'post',
        data: $('#create-directory-form').serialize(),
        dataType: 'json',
        success: function (res) {
            $('#form_model').modal('hide');
            if(res.success){
                swal('Success!',res.message,'success');
                setTimeout(function(){
                    loadFolderSection(id);  
                },1000);
            }else{
                setTimeout(function(){
                    swal('Error!',res.message,'error');
                },1);
            }
            $('#form_model').modal('hide');
        }
    });
} else{
    console.log('still errors');
    return false;
}
}
</script>