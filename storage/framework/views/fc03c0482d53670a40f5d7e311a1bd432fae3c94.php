<?php $__env->startSection('title'); ?>
    Amazing Book Store
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="alert alert-success" role="alert">
        Your order totaling <?php echo e($total); ?>€ has been successfully processed!
        Thank you for shopping with us!
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ep/Projects/EP/webstore/resources/views/shop/checkout.blade.php ENDPATH**/ ?>