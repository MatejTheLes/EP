<?php $__env->startSection('content'); ?>
    <div class="row">

        <div class="col-md-12" >


            <?php if($userid == 1): ?>
                <?php if($city == '' || $address = ''): ?>
                    <div class="alert alert-info" role="alert">
                        Do not forget to set your shipping address so we can know where to ship your orders!
                    </div>
                <?php endif; ?>
                    <?php if($phone == ''): ?>
                        <div class="alert alert-info" role="alert">
                            Do not forget to set your phone number!
                        </div>
                    <?php endif; ?>
                <h1>User Profile</h1>
                <hr>
                <h2> My account details</h2>
                <button type="button" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.change')); ?>"> Change</a></button>
                <hr>
                <h2>My orders</h2>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <div class="card card-default">
                    <div class="card-body">
                        <ul class="list-group">
                            <?php $__currentLoopData = $order->cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="list-group-item"><?php echo e($item['naslov']); ?>

                                <p>x<?php echo e($item['qty']); ?></p>


                            </li>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                    <p><?php echo e(($order['created_at'])); ?></p>
                    <?php if(($order['status']) == 0): ?>
                        <p> Status: Pending</p>
                    <?php elseif(($order['status']) == 2): ?>
                         <p style="color:green"> Status: Processed successfully</p>
                    <?php else: ?>
                         <p style="color: red"> Status: Order Declined</p>
                    <?php endif; ?>
                    <div class="card-footer">
                        <strong> <?php echo e($order->cart->totalPrice); ?>€ </strong>
                    </div>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>





                <?php elseif($userid == 2): ?>
                <hr>
                <h2> My account details</h2>
                <button type="button" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.change')); ?>"> Change</a></button>
                <button type="button" class="btn btn-warning" style="width: 200px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.getCreateCustomer')); ?>">Create Customer</a></button>
                <button type="button" class="btn btn-warning" style="width: 200px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('product.getCreateProduct')); ?>">Create Product</a></button>
                <hr>

                <h2>Stranke</h2>
                <?php $__currentLoopData = $stranke; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stranka): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card card-default">
                        <div class="card-body">
                            <ul class="list-group">
                                <li>Customer name: <?php echo e($stranka['name']); ?></li>
                                <li>Customer E-mail: <?php echo e($stranka['email']); ?></li>
                                <li>Role: <?php echo e($stranka['vloga']); ?></li>
                                <button type="button" class="btn btn-success" style="width: 200px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.changeSales', ['id' => $stranka['id'], 'vloga' => $stranka['vloga']])); ?>">Update credentials</a></button>
                                <button type="button" class="btn btn-danger" style="width: 200px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.delete', ['id' => $stranka['id']])); ?>">Delete Account</a></button>

                            </ul>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>




                <h2>All orders</h2>

                <hr>
                <?php $__currentLoopData = $narocila->chunk(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $narociloChunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="row">

                    <?php $__currentLoopData = $narociloChunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $narocilo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-sm-6 col-md-4">

                            <div class="card card-default">

                                <div class="card-body">
                                    <ul class="list-group">
                                        <?php $__currentLoopData = $narocilo->cart->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li class="list-group-item"><?php echo e($item['naslov']); ?>

                                                <p>x<?php echo e($item['qty']); ?></p>


                                            </li>

                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <p><?php echo e(($narocilo['created_at'])); ?></p>
                                <?php if(($narocilo['status']) == 0): ?>
                                    <p> Status: Pending</p>
                                <?php elseif(($narocilo['status']) == 2): ?>
                                    <p style="color:green"> Status: Processed successfully</p>
                                <?php else: ?>
                                    <p style="color: red"> Status: Order Declined</p>
                                <?php endif; ?>
                                <div class="card-footer">
                                    <strong> <?php echo e($narocilo->cart->totalPrice); ?>€ </strong>
                                    <br>
                                    <button type="button" class="btn btn-success"><a style="color: white; text-decoration: none;" href="<?php echo e(route('order.confirm', ['id' => $narocilo['id']])); ?>"> Confirm Purchase</a></button>
                                    <button type="button" class="btn btn-danger"><a style="color: white; text-decoration: none;" href="<?php echo e(route('order.decline', ['id' => $narocilo['id']])); ?>"> Decline Purchase</a></button>

                                </div>

                            </div>
                        </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                <?php elseif($userid == 3): ?>



                <h1>Admin Dashboard</h1>
                <hr>
                <h2> My account details</h2>
                <button type="button" class="btn btn-secondary"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.change')); ?>"> Change</a></button>
                <hr>
                <button type="button" class="btn btn-warning" style="width: 200px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.getCreateSales')); ?>">Create Salesman</a></button>

                <h2>Prodajalci</h2>
                <?php $__currentLoopData = $prodajalci; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prodajalec): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card card-default">
                        <div class="card-body">
                            <ul class="list-group">
                                <li>Salesman name: <?php echo e($prodajalec['name']); ?></li>
                                <li>Salesman mail: <?php echo e($prodajalec['email']); ?></li>
                                <li>Role: <?php echo e($prodajalec['vloga']); ?></li>
                                <button type="button" class="btn btn-success" style="width: 200px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.changeSales', ['id' => $prodajalec['id'], 'vloga' =>$prodajalec['vloga']])); ?>">Update credentials</a></button>
                                <button type="button" class="btn btn-danger" style="width: 200px"><a style="color: white; text-decoration: none;" href="<?php echo e(route('user.delete', ['id' => $prodajalec['id']])); ?>">Delete Account</a></button>

                            </ul>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                <?php endif; ?>
        </div>
    </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ep/Projects/EP/webstore/resources/views/user/profile.blade.php ENDPATH**/ ?>