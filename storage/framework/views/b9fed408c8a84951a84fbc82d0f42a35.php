<?php $__env->startSection('title', __('students.guardians.edit.title')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('guardians.show', $guardian)); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('students.guardians.list.back')); ?></a>
        <h3 class="page-title mt-2 mb-1"><?php echo e(__('students.guardians.edit.title')); ?></h3>
        <p class="text-muted mb-0"><?php echo e($guardian->name); ?></p>
    </div>

    <form method="POST" action="<?php echo e(route('guardians.update', $guardian)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="card">
            <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.guardians.form.personal')); ?></h5></div>
            <div class="card-body">
                <?php echo $__env->make('students.guardians._form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
            <div class="card-footer d-flex gap-2">
                <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i><?php echo e(__('students.guardians.form.save')); ?></button>
                <a href="<?php echo e(route('guardians.show', $guardian)); ?>" class="btn btn-outline-secondary"><?php echo e(__('students.guardians.form.cancel')); ?></a>
            </div>
        </div>
    </form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/guardians/edit.blade.php ENDPATH**/ ?>