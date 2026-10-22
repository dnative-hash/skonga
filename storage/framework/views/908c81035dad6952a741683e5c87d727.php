<?php $__env->startSection('title', __('menu.add_guardian')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('guardians.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('students.guardians.list.back')); ?></a>
        <h3 class="page-title mt-2 mb-1"><?php echo e(__('menu.add_guardian')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('students.guardians.create.intro')); ?></p>
    </div>

    <form method="POST" action="<?php echo e(route('guardians.store')); ?>">
        <?php echo csrf_field(); ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.guardians.form.personal')); ?></h5></div>
            <div class="card-body">
                <?php echo $__env->make('students.guardians._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="card-footer d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i><?php echo e(__('students.guardians.form.save')); ?></button>
                <a href="<?php echo e(route('guardians.index')); ?>" class="btn btn-outline-secondary"><?php echo e(__('students.guardians.form.cancel')); ?></a>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/guardians/create.blade.php ENDPATH**/ ?>