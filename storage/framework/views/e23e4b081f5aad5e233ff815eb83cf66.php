<?php $__env->startSection('title', __('fees.payments.record')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('fees.payments.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('menu.payments')); ?></a>
        <h3 class="page-title mt-2"><?php echo e(__('fees.payments.record_by_control')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('fees.payments.record_by_control_hint')); ?></p>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('fees.payments.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php echo $__env->make('fees.payments._fields', ['key' => $key, 'withControlNumber' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <button type="submit" class="btn btn-primary"><?php echo e(__('fees.payments.record_button')); ?></button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/payments/create.blade.php ENDPATH**/ ?>