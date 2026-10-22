<?php $__env->startSection('title', __('custom_roles.edit')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('settings.roles.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('custom_roles.title')); ?></a>
        <h3 class="page-title mt-2 mb-0"><?php echo e(__('custom_roles.edit')); ?></h3>
    </div>

    <?php echo $__env->make('settings.roles._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/settings/roles/edit.blade.php ENDPATH**/ ?>