<?php $__env->startSection('title', __('menu.take_attendance')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <h3 class="page-title mb-1"><?php echo e(__('menu.take_attendance')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('attendance.intro')); ?></p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('attendance.index')); ?>" method="GET">
                <div class="row align-items-end">
                    <?php echo $__env->make('attendance._filter', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <div class="col-md-2 mb-3">
                        <label class="form-label" for="date"><?php echo e(__('attendance.date')); ?></label>
                        <input class="form-control <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="date" name="date" type="date" value="<?php echo e($date); ?>" max="<?php echo e(now()->toDateString()); ?>" required>
                        <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-2 mb-3"><button type="submit" class="btn btn-primary w-100"><?php echo e(__('attendance.show')); ?></button></div>
                </div>
            </form>
        </div>
    </div>

    <?php if($class !== null): ?>
        <?php if($year === null): ?>
            <div class="alert alert-warning"><?php echo e(__('attendance.errors.no_year')); ?></div>
        <?php elseif($students->isEmpty()): ?>
            <div class="card"><div class="card-body text-muted"><?php echo e(__('attendance.empty')); ?></div></div>
        <?php else: ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-3"><?php echo e($class->name); ?><?php if($stream): ?> – <?php echo e($stream->name); ?><?php endif; ?> · <?php echo e($date); ?></h5>
                    <?php $__errorArgs = ['rows'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    <form action="<?php echo e(route('attendance.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="school_class_id" value="<?php echo e($class->id); ?>">
                        <input type="hidden" name="stream_id" value="<?php echo e($stream?->id); ?>">
                        <input type="hidden" name="date" value="<?php echo e($date); ?>">
                        <div class="table-responsive">
                            <table class="table align-middle mb-3">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('attendance.student')); ?></th>
                                        <th><?php echo e(__('attendance.status')); ?></th>
                                        <th><?php echo e(__('attendance.note')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php ($record = $records[$student->id] ?? null); ?>
                                        <?php ($current = old("rows.{$student->id}.status", $record?->status ?? 'present')); ?>
                                        <tr>
                                            <td class="fw-medium"><?php echo e($student->fullName()); ?><div class="text-muted fs-13"><?php echo e($student->admission_number); ?></div></td>
                                            <td class="text-nowrap">
                                                <?php $__currentLoopData = App\Models\AttendanceRecord::STATUSES; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <div class="form-check form-check-inline">
                                                        <input class="form-check-input" type="radio" name="rows[<?php echo e($student->id); ?>][status]" id="s<?php echo e($student->id); ?><?php echo e($status); ?>" value="<?php echo e($status); ?>" <?php if($current === $status): echo 'checked'; endif; ?>>
                                                        <label class="form-check-label" for="s<?php echo e($student->id); ?><?php echo e($status); ?>"><?php echo e(__('attendance.statuses.'.$status)); ?></label>
                                                    </div>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td><input class="form-control form-control-sm" type="text" maxlength="255" name="rows[<?php echo e($student->id); ?>][note]" value="<?php echo e(old("rows.{$student->id}.note", $record?->note)); ?>"></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('attendance.save')); ?></button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/attendance/index.blade.php ENDPATH**/ ?>