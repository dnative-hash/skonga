<?php $__env->startSection('title', __('students.create.title')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('students.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('menu.student_list')); ?></a>
        <h3 class="page-title mt-2"><?php echo e(__('students.create.title')); ?></h3>
    </div>
    <div class="card"><div class="card-body"><?php echo $__env->make('students._form', ['student' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div></div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/create.blade.php ENDPATH**/ ?>