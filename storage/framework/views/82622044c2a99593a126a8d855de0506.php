<?php $__env->startSection('title', __('auth.title')); ?>
<?php $__env->startSection('body_class', 'account-page'); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome/css/all.min.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div id="global-loader"><div class="whirly-loader"></div></div>

    <div class="main-wrapper">
        <div class="account-content">
            <div class="login-wrapper bg-img">
                <div class="login-content authent-content">
                    <form action="<?php echo e(route('login.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="login-userset">
                            <div class="login-logo logo-normal"><img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('img/somaplus-logo.svg')); ?>"></div>
                            <a class="login-logo logo-white" href="<?php echo e(route('login')); ?>"><img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('img/somaplus-logo-white.svg')); ?>"></a>

                            <div class="login-userheading">
                                <h3><?php echo e(__('auth.title')); ?></h3>
                                <h4 class="fs-16"><?php echo e($school ? __('auth.subtitle_school', ['school' => $school->name]) : __('auth.subtitle_platform')); ?></h4>
                            </div>

                            <?php if(session('status')): ?>
                                <div class="alert alert-success" role="status"><?php echo e(session('status')); ?></div>
                            <?php endif; ?>

                            <div class="mb-3">
                                <label class="form-label" for="email"><?php echo e(__('auth.email')); ?><span class="text-danger"> *</span></label>
                                <div class="input-group">
                                    <input class="form-control border-end-0 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="email" name="email" type="email" value="<?php echo e(old('email')); ?>" placeholder="<?php echo e(__('auth.email_placeholder')); ?>" autocomplete="username" required autofocus>
                                    <span class="input-group-text border-start-0"><i class="ti ti-mail"></i></span>
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="mb-3">
                                <label class="form-label" for="password"><?php echo e(__('auth.password')); ?><span class="text-danger"> *</span></label>
                                <div class="pass-group">
                                    <input class="pass-input form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" type="password" placeholder="<?php echo e(__('auth.password_placeholder')); ?>" autocomplete="current-password" required>
                                    <span class="ti toggle-password ti-eye-off text-gray-9"></span>
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-login authentication-check d-flex align-items-center justify-content-between">
                                <div class="custom-control custom-checkbox">
                                    <label class="checkboxs ps-4 mb-0 pb-0 line-height-1 fs-16 text-gray-6">
                                        <input class="form-control" name="remember" type="checkbox" value="1" <?php echo e(old('remember') ? 'checked' : ''); ?>>
                                        <span class="checkmarks"></span><?php echo e(__('auth.remember')); ?>

                                    </label>
                                </div>
                                <div class="text-end">
                                    <a class="text-orange fs-16 fw-medium" href="<?php echo e(route('password.request')); ?>"><?php echo e(__('auth.forgot')); ?></a>
                                </div>
                            </div>

                            <div class="form-login">
                                <button class="btn btn-primary w-100" type="submit"><?php echo e(__('auth.submit')); ?></button>
                            </div>

                            <div class="my-4 d-flex justify-content-center align-items-center copyright-text">
                                <p>&copy; <?php echo e(now()->year); ?> <?php echo e(config('app.name')); ?></p>
                            </div>
                        </div>
                    </form>

                    <form action="<?php echo e(route('locale.update')); ?>" method="POST" class="d-flex justify-content-center gap-2 mt-2">
                        <?php echo csrf_field(); ?>
                        <?php $__currentLoopData = ['en' => 'English', 'sw' => 'Kiswahili']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <button type="submit" name="locale" value="<?php echo e($code); ?>" class="btn btn-sm <?php echo e(app()->getLocale() === $code ? 'btn-primary' : 'btn-outline-white'); ?>"><?php echo e($name); ?></button>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/auth/login.blade.php ENDPATH**/ ?>