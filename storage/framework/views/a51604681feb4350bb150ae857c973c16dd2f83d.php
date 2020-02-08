
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo e(route('product.index')); ?>">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('product.shoppingCart')); ?>"> <i class="fas fa-cart-plus"></i>Shopping cart
                    <span class="badge"> <?php echo e(Session::has('cart') ? Session::get('cart')->totalQty: ''); ?></span>
                </a>
            </li>



            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    User Management <i class="fas fa-user"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">


                    <?php if(Auth::check()): ?>
                        <a class="dropdown-item" href="<?php echo e(route('user.profile')); ?>">Account overview</a>

                        <a class="dropdown-item" href="<?php echo e(route('logout')); ?>"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><?php echo e(__('Logout')); ?></a>
                        <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                            <?php echo csrf_field(); ?>
                        </form>

                    <?php else: ?>
                        <a class="dropdown-item" href="<?php echo e(route('register')); ?>">Sign up</a>
                        <a class="dropdown-item" href="<?php echo e(route('login')); ?>">Sign in</a>
                    <?php endif; ?>




                </div>
            </li>
        </ul>

    </div>
</nav>

<?php /**PATH /home/ep/Projects/EP/webstore/resources/views/partials/header.blade.php ENDPATH**/ ?>