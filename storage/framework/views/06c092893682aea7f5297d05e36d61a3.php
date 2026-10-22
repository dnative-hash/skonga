<?php $__env->startSection('title', __('academics.classes.edit')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('academics.classes.show', $class)); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e($class->name); ?></a>
        <h3 class="page-title mt-2"><?php echo e(__('academics.classes.edit')); ?></h3>
    </div>
    <div class="card"><div class="card-body"><?php echo $__env->make('academics.classes._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/classes/edit.blade.php ENDPATH**/ ?>