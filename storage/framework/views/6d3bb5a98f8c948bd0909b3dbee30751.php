
<div class="table-responsive">
    <table class="table align-middle mb-0">
        <thead><tr>
            <th><?php echo e(__('exams.scales.min')); ?></th><th><?php echo e(__('exams.scales.grade')); ?></th><th><?php echo e(__('exams.scales.points')); ?></th><th><?php echo e(__('exams.scales.remark')); ?></th>
        </tr></thead>
        <tbody>
            <?php $__currentLoopData = $bands->sortByDesc(fn ($band) => (float) $band->min_mark); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $band): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><?php echo e(rtrim(rtrim($band->min_mark, '0'), '.')); ?>%</td>
                    <td class="fw-medium"><?php echo e($band->grade); ?></td>
                    <td><?php echo e($band->points); ?></td>
                    <td><?php echo e($band->remark); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>
</div>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/exams/scales/_bands.blade.php ENDPATH**/ ?>