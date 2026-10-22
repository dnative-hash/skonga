<?php $__env->startSection('title', __('fees.structures.add')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('fees.structures.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('menu.fee_structures')); ?></a>
        <h3 class="page-title mt-2"><?php echo e(__('fees.structures.add')); ?></h3>
    </div>
    <div class="card"><div class="card-body"><?php echo $__env->make('fees.structures._form', ['structure' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/structures/create.blade.php ENDPATH**/ ?>