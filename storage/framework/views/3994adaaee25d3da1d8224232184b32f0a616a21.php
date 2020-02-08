<?php $__env->startSection('title'); ?>
    Amazing Book Store
<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create Sales Account</div>

                    <div class="card-body">
                        <form action="<?php echo e(route('user.createSales')); ?>" method="post">
                            <?php echo csrf_field(); ?>


                            <div class="alert alert-info" role="alert">
                                Here you can create a new sales account!
                            </div>
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger" role="alert"><?php echo e($errors->first()); ?></div>
                            <?php endif; ?>

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">Sales Name</label>

                                <div class="col-md-6">
                                    <input id="sales_name" type="text" class="form-control" name="sales_name" autocomplete="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="mail" class="col-md-4 col-form-label text-md-right">Sales Email</label>

                                <div class="col-md-6">
                                    <input id="sales_email" type="text" class="form-control" name="sales_email" autocomplete="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="mail" class="col-md-4 col-form-label text-md-right">Sales Password</label>

                                <div class="col-md-6">
                                    <input id="sales_password" type="password" class="form-control" name="sales_password" autocomplete="">
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Create Account
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ep/Projects/EP/webstore/resources/views/auth/create-sales.blade.php ENDPATH**/ ?>