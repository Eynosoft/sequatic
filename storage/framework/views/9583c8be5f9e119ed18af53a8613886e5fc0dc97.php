
<footer class="footer">
    <div class="container02">
        <p>Copyright &copy; 2017.</p>
    </div>
</footer>
</main>




<div class="modal fade" id="success-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h3>Your Quote request Submitted Successfully</h3>
                <h5>Saels Rep. Will assist you shortly</h5>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
        </div>
    </div>
</div>

<script src="<?php echo e(asset('public/js/bootstrap.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/bootstrap-select.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/moment.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/bootstrap-datetimepicker.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/sweetalert-dev.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/velocity.min.js')); ?>"></script>
<script src="<?php echo e(asset('public/js/velocity.ui.min.js')); ?>"></script>
 <script src="<?php echo e(asset('public/js/jquery.masked-input.min.js')); ?>"></script>
<!--<script>

        document.querySelector('.sure-alert').onclick = function () {
        swal({
        title: "Do You Want to add another Panel?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                cancelButtonText: "Yes",
                confirmButtonText: 'No',
                closeOnConfirm: false,
                closeOnCancel: false
        },
                function (isConfirm) {
                if (isConfirm) {
                swal("Your Quote request Submitted Successfully!", "", "success");
                } else {

                window.location.href = "public/choose-panel-type.php";
                }
                });
        };
</script>-->

<script type="text/javascript">
$(document).ready(function () {
    $('.selectpicker').selectpicker();
});
$(document).ready(function () {
    function reposition() {
        var modal = $(this),
                dialog = modal.find('.modal-dialog');
        modal.css('display', 'block');
        dialog.css("margin-top", Math.max(0, ($(window).height() - dialog.height()) / 3));
    }
    $('.modal').on('show.bs.modal', reposition);
    $(window).on('resize', function () {
        $('.modal:visible').each(reposition);
    });
});

$(document).ready(function () {
    function setheight() {
        var windowheight = $(window).height() - 110;
        $('.admin_content').css('min-height', windowheight);
    }
    setheight();
    $(window).resize(function () {
        setheight();
    });
});

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});

function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}


</script>  