
<?php echo $__env->make('admin::layouts.include.head', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<main class="main-content">
   
<?php echo $__env->make('admin::layouts.include.header', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
  
<?php echo $__env->yieldContent('content'); ?>

</div> 

</div>


<?php echo $__env->make('admin::layouts.include.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

</body>
</html>