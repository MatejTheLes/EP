<?php $__env->startSection('title'); ?>
    Amazing Book Store
<?php $__env->stopSection(); ?>




<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Change your credentials</div>

                    <div class="card-body">
                        <form action="<?php echo e(route('user.update')); ?>" method="post">
                            <?php echo csrf_field(); ?>
                            <div class="alert alert-info" role="alert">
                                Here you can update your credentials! Both fields are necessary; if you do not wish to update either of them just type the current email or password.
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Password</label>

                                <div class="col-md-6">
                                    <input id="new_password" type="password" class="form-control" name="new_password" autocomplete="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">New Email</label>

                                <div class="col-md-6">
                                    <input id="new_email" type="text" class="form-control" name="new_email" autocomplete="">
                                </div>
                            </div>

                            <?php if($vloga == 1): ?>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">New Address</label>

                                    <div class="col-md-6">
                                        <input id="new_address" type="text" class="form-control" name="new_address" autocomplete="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">New City</label>

                                    <div class="col-md-6">
                                        <input id="new_city" type="text" class="form-control" name="new_city" autocomplete="">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">New Phone Number</label>

                                    <div class="col-md-6">
                                        <input id="new_phone" type="text" class="form-control" name="new_phone" autocomplete="">
                                    </div>
                                </div>
                            <?php endif; ?>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Credentials
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

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ep/Projects/EP/webstore/resources/views/auth/change-credentials.blade.php ENDPATH**/ ?>