<?php $__env->startSection('title', __('family.title')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <h3 class="page-title mb-1"><?php echo e(__('family.title')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('family.intro')); ?></p>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card">
            <div class="card-body d-flex justify-content-between align-items-center flex-wrap gap-2">
                <div>
                    <h5 class="mb-1"><?php echo e($row['student']->fullName()); ?></h5>
                    <div class="text-muted fs-13"><?php echo e($row['student']->admission_number); ?></div>
                    <div class="mt-2">
                        <?php if($row['owed']->isEmpty()): ?>
                            <span class="badge bg-success"><?php echo e(__('family.nothing_owed')); ?></span>
                        <?php else: ?>
                            <?php $__currentLoopData = $row['owed']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency => $minor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <span class="badge bg-warning text-dark"><?php echo e(__('family.owed')); ?>: <?php echo e(\App\Support\Money::of($minor, $currency)->format()); ?></span>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
                <a href="<?php echo e(route('family.children.show', $row['student']->id)); ?>" class="btn btn-primary"><?php echo e(__('family.open')); ?></a>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card"><div class="card-body text-muted"><?php echo e(__('family.no_children')); ?></div></div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/family/index.blade.php ENDPATH**/ ?>