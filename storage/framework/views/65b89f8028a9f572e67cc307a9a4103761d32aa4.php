
<div class="table-responsive">
    <table class="table table-striped table-responsive table-bordered admin_table" style="margin:0px">
        <thead>
            <tr>
                <th>Quote No.</th>
                <th>Inquiry Date</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Company Name</th>
                <th>Last Contact Date</th>
                <th style="width:200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($inquiryDetail) && count($inquiryDetail) > 0): ?>
            <?php $__currentLoopData = $inquiryDetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php ?>
            <tr class="">
                <td><?php echo e($inq->quote_id); ?></td>
                <td><?php echo e($inq->inquiry->created_at->format('d/m/Y')); ?></td>
                <td><?php echo e($inq->inquiry->first_name); ?> <?php echo e($inq->inquiry->last_name); ?></td>
                <td><?php echo e($inq->inquiry->email); ?></td>
                <td><?php echo e($inq->inquiry->mobile); ?></td>
                <td><?php echo e($inq->inquiry->company_name); ?></td>
                <td>15/02/2017</td>

                <td>
                    <ul class="list-inline">
                        <li>
                            <a href="<?php echo e(url('/admin/inquiry/edit').'/'.$inq->inquiry->id); ?>">
                                <div class="action_icon">
                                    <button type="button" class="btn btn-xs" data-toggle="tooltip" title="View More">
                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                    </button> 
                                </div>
                            </a>
                        </li>

                        <li>
                            <div class="select">
                                <div class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="dropdown-toggle">Action<b class="caret"></b></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#" onclick="createCloneInquiry(<?php echo e($inq->quote_id); ?>)">Clone</a></li>

                                    </ul>
                                </div>
                            </div>
                        </li>
                    </ul>
                </td>   
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
            <tr>
                <td colspan="11">
                    <div class="alert alert-info">No records found.</div>
                </td>
            </tr>
            <?php endif; ?>
        </tbody> 
    </table>
</div>
<div class="panel-footer clearfix text-right admin_pagination">
    <div class="dataTables_paginate paging_bootstrap">
        <?php echo $inquiryDetail->render('admin::pagination.bootstrap-4'); ?>

    </div>
</div>
<script type="text/javascript">
            $().ready(function () {
                $(".pagination li a").on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    var pageLink = $this.attr('href');
                    loadQuoteDetail(pageLink);
                });
            });
            function createCloneInquiry(id) {
            swal({
            title: 'Are you sure?',
                    text: "You want to create clone of this inquiry!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'No',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
            }).then(function () {
            processClone(id);
            }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
            swal('Cancelled', 'Your record is safe :)', 'error')
            }
            })
            }
            function processClone(id){

                var url = '<?php echo e(url("admin/inquiry-detail/clone-quote")); ?>';
                    $.ajax({
                        url: url,
                        type: 'post',
                        data: {'id':id,'_token':'<?php echo e(csrf_token()); ?>'},
                        dataType: 'json',
                        success: function (res) {
                        if (res.success){
                        swal('Success!', res.message, 'success');
                        } else{
                        swal('Error!', res.message, 'error');
                        }
                            var pageLink = '<?php echo e($inquiryDetail->url($inquiryDetail->currentPage())); ?>';
                                loadQuoteDetail(pageLink);
                        }
                    });
            }
    
</script>
