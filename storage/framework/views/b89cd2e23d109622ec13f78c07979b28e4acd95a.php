<?php $__env->startSection('title'); ?>
    Amazing Book Store
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <?php if(Session::has('cart')): ?>
        <div class = "row">
            <div class="col-sm-6 col-md-6">
                <ul class="list-group-item">
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item">
                            <span class="badge"><?php echo e($product['qty']); ?> x </span>
                            <strong><?php echo e($product['naslov']); ?></strong>
                            <span class="label label-success"><?php echo e($product['price']); ?> €</span>


                                    <li><a href="<?php echo e(route('product.reduceByOne', ['id' => $product['id']])); ?>" >Remove one</a>   l   <a href="<?php echo e(route('product.remove', ['id' => $product['id']])); ?>" >Remove all</a>  </li>




                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>

        <div class = "row">
            <div class="col-sm-6 col-md-6">
                <strong>Total: <?php echo e($totalPrice); ?> €</strong>
            </div>
        </div>
        <hr>
        <div class = "row">
            <div class="col-sm-6 col-md-6">
                <a type="button" class="btn btn-success" href="<?php echo e(route('checkout')); ?>"> Checkout</a>
            </div>
        </div>
    <?php else: ?>
        <div class = "row">
            <div class="col-sm-6 col-md-6">
                <h2>No items in cart</h2>
            </div>
        </div>

    <?php endif; ?>
<?php $__env->stopSection(); ?>

















<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ep/Projects/EP/webstore/resources/views/shop/shopping-cart.blade.php ENDPATH**/ ?>