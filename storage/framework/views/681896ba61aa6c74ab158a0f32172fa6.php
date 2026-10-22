<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>" data-layout-mode="light_mode">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', config('app.name')); ?></title>
    <?php echo $__env->yieldPushContent('head'); ?>
    <link rel="shortcut icon" type="image/svg+xml" href="<?php echo e(asset('assets/img/favicon.svg')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/bootstrap.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/animate.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/plugins/tabler-icons/tabler-icons.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/style.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/somaplus.css')); ?>">
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="<?php echo $__env->yieldContent('body_class'); ?>" data-open-modal="<?php echo e(old('form') ?? request('add')); ?>">
    <?php echo $__env->yieldContent('content'); ?>

    <script src="<?php echo e(asset('assets/js/bootstrap.bundle.min.js')); ?>"></script>
    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/layouts/base.blade.php ENDPATH**/ ?>