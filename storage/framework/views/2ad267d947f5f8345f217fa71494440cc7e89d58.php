
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
                <th>Lead Value</th>
                <th>Request Country</th>
               
                <th>Last Contact Date</th>
                <th style="width:200px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if(!empty($inquiries) && count($inquiries) > 0): ?>
            <?php $__currentLoopData = $inquiries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            
            <tr class="">
                <td><?php echo e($inq->id); ?></td>
                <td><?php echo e($inq->created_at->format('d/m/Y')); ?></td>
                <td><?php echo e($inq->first_name); ?> <?php echo e($inq->last_name); ?></td>
                <td><?php echo e($inq->email); ?></td>
                <td><?php echo e($inq->mobile); ?></td>
                <td><?php echo e($inq->company_name); ?></td>
                <td><?php echo e($inq->lead_value ? $inq->lead_value : '-'); ?></td>
                <td><?php echo e($inq->country['country_name']); ?></td>
                
                <td>15/02/2017</td>

                <td>
                    <ul class="list-inline">
                        <li>
                            <a href="<?php echo e(url('/admin/inquiry/edit').'/'.$inq->id); ?>">
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
                                        <li><a href="#" onclick="toggleInquiryStatus(<?php echo e($inq->id); ?>, 'deleted', 'trash')">Trash(Junk)</a></li>
                                        
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
        <?php echo $inquiries->render('admin::pagination.bootstrap-4'); ?>

    </div>
</div>


<script type="text/javascript">
            $().ready(function () {
                $(".pagination li a").on('click', function (e) {
                    e.preventDefault();
                    var $this = $(this);
                    var pageLink = $this.attr('href');
                    loadQuoteInquiry(pageLink);
                });
            });
            function toggleInquiryStatus(id, status, type) {
            swal({
            title: 'Are you sure?',
                    text: "You want to move this inquiry to trash!",
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'No, cancel!',
                    confirmButtonClass: 'btn btn-success',
                    cancelButtonClass: 'btn btn-danger',
                    buttonsStyling: false
            }).then(function () {
            processToggelStatus(id, status, type);
            }, function (dismiss) {
            // dismiss can be 'cancel', 'overlay',
            // 'close', and 'timer'
            if (dismiss === 'cancel') {
            swal('Cancelled', 'Your record is safe :)', 'error')
            }
            })
            }
    function processToggelStatus(id, status, type){

    var url = '<?php echo e(url("admin/inquiry/toggle-status")); ?>';
            $.ajax({
                url: url,
                type: 'post',
                data: {'id':id, 'status':status, 'type':type, '_token':'<?php echo e(csrf_token()); ?>'},
                dataType: 'json',
                success: function (res) {
                if (res.success){
                swal('Success!', res.message, 'success');
                } else{
                swal('Error!', res.message, 'error');
                }
                var pageLink = '<?php echo e($inquiries->url($inquiries->currentPage())); ?>';
                        loadQuoteInquiry(pageLink);
                        //loadGeneralInquiryStatics();
                }
            });
    }
</script>
