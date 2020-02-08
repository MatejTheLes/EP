<?php $__env->startSection('title'); ?>
    Amazing Book Store
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php $__currentLoopData = $books->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bookChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="row" >
            <?php $__currentLoopData = $bookChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-sm-6 col-md-4">
                <div class="img-thumbnail">
                    <img src="https://www.mobileread.com/forums/attachment.php?attachmentid=111264&d=1378642555" alt="..." class="img-fluid">
                    <div class="caption">
                        <h3><?php echo e($book['NASLOV']); ?></h3>
                        <h5><?php echo e($book['IMEAVTOR']); ?></h5>
                        <p class="description"><?php echo e($book['OPISKNJIGE']); ?></p>
                        <div class="clearfix">
                            <div class="pull-left price"><?php echo e($book['CENA']); ?>€</div>

                            <a href="<?php echo e(route('product.addToCart', ['id' => $book['ID']])); ?>" class="btn btn-success pull-right" role="button">Add to Cart</a>
                            <?php if($vloga == 2): ?>
                                <button type="button" class="btn btn-danger small" style="height: 45px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('product.deleteItem', ['id' => $book['ID']])); ?>" class="btn btn-alert pull-right" role="button">Delete Item</a></button>
                                <button type="button" class="btn btn-warning" style="height: 45px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('product.getEditProduct', ['id' => $book['ID']])); ?>">Edit Item</a></button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ep/Projects/EP/webstore/resources/views/shop/index.blade.php ENDPATH**/ ?>