<?php $__env->startPush('head'); ?>
    <script src="<?php echo e(asset('assets/js/theme-script.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('styles'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome/css/fontawesome.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/fontawesome/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/edu-widgets.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('css/somaplus-app.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div id="global-loader"><div class="whirly-loader"></div></div>

    <div class="main-wrapper">
        <?php echo $__env->make('partials.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php echo $__env->make('partials.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

        <div class="page-wrapper">
            <div class="content">
                <?php if($currentSchool?->isReadOnly()): ?>
                    <div class="alert alert-warning" role="alert"><?php echo e(__('tenancy.read_only')); ?></div>
                <?php endif; ?>

                <?php if(session('status')): ?>
                    <div class="alert alert-success" role="status"><?php echo e(session('status')); ?></div>
                <?php endif; ?>
                <?php $__errorArgs = ['delete'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="alert alert-danger" role="alert"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                <?php echo $__env->yieldContent('page'); ?>
            </div>
            <?php echo $__env->make('partials.footer', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        </div>
    </div>
    <?php echo $__env->yieldPushContent('modals'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-scripts'); ?>
    <script>
        // A form in a pop-up that was refused opens its pop-up again, with what was typed.
        (function () {
            var wanted = document.body.dataset.openModal;
            if (!wanted || !window.bootstrap) { return; }

            var modal = document.getElementById(wanted);
            if (modal) { new window.bootstrap.Modal(modal).show(); }
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="<?php echo e(asset('assets/js/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/plugins/simplebar/simplebar.min.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('vendor'); ?>
    <script src="<?php echo e(asset('assets/plugins/flatpickr/flatpickr.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/datatable.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/script.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('page-scripts'); ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.base', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/layouts/app.blade.php ENDPATH**/ ?>