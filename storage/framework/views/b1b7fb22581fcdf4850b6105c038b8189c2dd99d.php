<?php $__env->startSection('content'); ?>
    <div class="auth-wrapper d-flex no-block justify-content-center align-items-center bg-dark">
        <div class="auth-box bg-dark border-top border-secondary">
            <div id="loginform">
                <div class="text-center p-t-20 p-b-20">
                    <span class="db"><img src="<?php echo e(asset('admin/assets/images/logo.png')); ?>" alt="logo" /></span>
                </div>
                <!-- Form -->
                <form class="form-horizontal m-t-20" id="loginform" action="<?php echo e(route('login')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row p-b-30">
                        <div class="col-12">
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-success text-white" id="basic-addon1"><i
                                            class="ti-user"></i></span>
                                </div>
                                <input type="email" id="email" name="email"
                                    class="form-control form-control-lg <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Email" value="<?php echo e(old('email')); ?>" aria-label="Username"
                                    aria-describedby="basic-addon1" required="" autocomplete="email" autofocus>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text bg-warning text-white" id="basic-addon2"><i
                                            class="ti-pencil"></i></span>
                                </div>
                                <input type="password" id="password" name="password"
                                    class="form-control form-control-lg <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Password" autocomplete="current-password" aria-label="Password"
                                    aria-describedby="basic-addon1" required="">
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row border-top border-secondary">
                        <div class="col-12">
                            <div class="form-group">
                                <div class="p-t-20 justify-content-between">
                                    <button class="btn btn-info" id="to-recover" type="button"><i
                                            class="fa fa-lock m-r-5"></i> Lost password?</button>
                                    <a href="<?php echo e(route('register')); ?>" class="btn btn-warning"><?php echo e(__('Register')); ?></a>
                                    <button class="btn btn-success float-right" type="submit"><?php echo e(__('Login')); ?></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div id="recoverform">
                <div class="text-center">
                    <span class="text-white">Enter your e-mail address below and we will send you instructions how to
                        recover a password.</span>
                </div>
                <div class="row m-t-20">
                    <!-- Form -->
                    <form class="col-12" action="">
                        <!-- email -->
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-danger text-white" id="basic-addon1"><i
                                        class="ti-email"></i></span>
                            </div>
                            <input type="text" class="form-control form-control-lg" placeholder="Email Address"
                                aria-label="Username" aria-describedby="basic-addon1">
                        </div>
                        <!-- pwd -->
                        <div class="row m-t-20 p-t-20 border-top border-secondary">
                            <div class="col-12">
                                <a class="btn btn-success" href="#" id="to-login" name="action">Back To
                                    Login</a>
                                <button class="btn btn-info float-right" type="button" name="action">Recover</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\projeksaya\resources\views/auth/login.blade.php ENDPATH**/ ?>