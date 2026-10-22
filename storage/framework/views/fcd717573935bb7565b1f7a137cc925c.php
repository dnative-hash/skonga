<?php $__env->startSection('title', __('menu.attendance_summary')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <h3 class="page-title mb-1"><?php echo e(__('menu.attendance_summary')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('attendance.summary_intro')); ?></p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('attendance.summary')); ?>" method="GET">
                <div class="row align-items-end">
                    <?php echo $__env->make('attendance._filter', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="from"><?php echo e(__('attendance.from')); ?></label>
                        <input class="form-control" id="from" name="from" type="date" value="<?php echo e($from); ?>" required>
                    </div>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="to"><?php echo e(__('attendance.to')); ?></label>
                        <input class="form-control <?php $__errorArgs = ['to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="to" name="to" type="date" value="<?php echo e($to); ?>" required>
                        <?php $__errorArgs = ['to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-12 mb-3"><button type="submit" class="btn btn-primary"><?php echo e(__('attendance.show')); ?></button></div>
                </div>
            </form>
        </div>
    </div>

    <?php if($class !== null): ?>
        <div class="card">
            <div class="card-body">
                <?php if($rows === []): ?>
                    <p class="text-muted mb-0"><?php echo e(__('attendance.summary_empty')); ?></p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('attendance.student')); ?></th>
                                    <?php $__currentLoopData = App\Models\AttendanceRecord::STATUSES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <th class="text-end"><?php echo e(__('attendance.statuses.'.$status)); ?></th>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <th class="text-end"><?php echo e(__('attendance.rate')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="fw-medium"><?php echo e($row->student->fullName()); ?></td>
                                        <?php $__currentLoopData = App\Models\AttendanceRecord::STATUSES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <td class="text-end"><?php echo e($row->{$status}); ?></td>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <td class="text-end"><?php echo e($row->rate() === null ? '–' : $row->rate().'%'); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-muted fs-13 mt-3 mb-0"><?php echo e(__('attendance.rate_hint')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/attendance/summary.blade.php ENDPATH**/ ?>