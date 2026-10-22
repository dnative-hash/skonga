<?php $__env->startSection('title', __('dashboard.teacher.title')); ?>

<?php $__env->startSection('page'); ?>
    <?php
        $attendance = $figures['attendance'];
        $barColours = ['present' => 'bg-success', 'absent' => 'bg-danger', 'late' => 'bg-warning', 'excused' => 'bg-info'];
    ?>

    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4><?php echo e(__('dashboard.teacher.title')); ?></h4>
                <h6><?php echo e(__('dashboard.teacher.subtitle')); ?></h6>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-4 d-flex">
            <div class="card flex-fill overflow-hidden">
                <div style="height:84px;background:linear-gradient(135deg,#FE9F43,#092C4C)"></div>
                <div class="card-body pt-0 text-center">
                    <span class="avatar avatar-xxl rounded-circle border border-3 border-white bg-light text-dark fw-semibold fs-24" style="margin-top:-40px;width:80px;height:80px"><?php echo e(\Illuminate\Support\Str::upper(mb_substr($user->name, 0, 1))); ?></span>
                    <h5 class="mt-2 mb-1"><?php echo e($user->name); ?></h5>
                    <p class="fs-13 mb-0"><?php echo e($school->name); ?></p>
                    <p class="fs-13 text-muted mb-3"><?php echo e(implode(', ', $roles)); ?></p>
                    <div class="row g-2">
                        <div class="col-6">
                            <div class="border rounded p-2 text-center">
                                <p class="fs-12 text-muted mb-1"><?php echo e(__('dashboard.teacher.students')); ?></p>
                                <h6 class="fw-bold mb-0"><?php echo e(number_format($figures['students'])); ?></h6>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="border rounded p-2 text-center">
                                <p class="fs-12 text-muted mb-1"><?php echo e(__('dashboard.teacher.classes')); ?></p>
                                <h6 class="fw-bold mb-0"><?php echo e(number_format($figures['classes'])); ?></h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-md-6 d-flex flex-column">
            <div class="card bg-primary border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-white"><?php echo e(__('dashboard.teacher.marks_entered')); ?></p>
                        <h4 class="text-white mb-0"><?php echo e(number_format($figures['marks_entered'])); ?></h4>
                    </div>
                    <span class="avatar avatar-lg" style="background:rgba(255,255,255,.2)"><i class="ti ti-file-pencil text-white fs-24"></i></span>
                </div>
            </div>
            <div class="card bg-teal border-0">
                <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                        <p class="mb-1 text-white"><?php echo e(__('dashboard.teacher.open_exams')); ?></p>
                        <h4 class="text-white mb-0"><?php echo e(number_format($figures['open_exams'])); ?></h4>
                    </div>
                    <span class="avatar avatar-lg" style="background:rgba(255,255,255,.2)"><i class="ti ti-clipboard-check text-white fs-24"></i></span>
                </div>
            </div>
        </div>

        <?php if($attendance !== null): ?>
            <div class="col-xl-4 col-md-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title mb-0"><?php echo e(__('dashboard.attendance_today')); ?></h5>
                        <a href="<?php echo e(route('attendance.index')); ?>" class="btn btn-sm btn-light"><?php echo e(__('menu.take_attendance')); ?></a>
                    </div>
                    <div class="card-body">
                        <?php if($attendance['total'] === 0): ?>
                            <p class="text-muted mb-0"><?php echo e(__('dashboard.attendance_none')); ?></p>
                        <?php else: ?>
                            <?php $__currentLoopData = $attendance['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-dark"><?php echo e(__('attendance.statuses.'.$row['status'])); ?></span>
                                        <span class="fw-semibold text-dark"><?php echo e($row['count']); ?> (<?php echo e($row['percent']); ?>%)</span>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar <?php echo e($barColours[$row['status']]); ?>" style="width: <?php echo e($row['percent']); ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <div class="row">
        <div class="col-xl-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0"><?php echo e(__('dashboard.teacher.exams')); ?></h5>
                    <a href="<?php echo e(route('exams.index')); ?>" class="btn btn-sm btn-light"><?php echo e(__('dashboard.view_all')); ?></a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th><?php echo e(__('dashboard.teacher.exam')); ?></th>
                                    <th><?php echo e(__('dashboard.teacher.term')); ?></th>
                                    <th><?php echo e(__('dashboard.teacher.max_mark')); ?></th>
                                    <th><?php echo e(__('dashboard.teacher.your_marks')); ?></th>
                                    <th><?php echo e(__('dashboard.teacher.status')); ?></th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__empty_1 = true; $__currentLoopData = $figures['exams']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td><?php echo e($exam->name); ?></td>
                                        <td><?php echo e($exam->term->name); ?></td>
                                        <td><?php echo e($exam->max_mark); ?></td>
                                        <td><?php echo e($exam->getAttribute('my_marks_count')); ?></td>
                                        <td>
                                            <?php if($exam->isLocked()): ?>
                                                <span class="badge badge-danger badge-xs"><i class="ti ti-point-filled me-1"></i><?php echo e(__('dashboard.teacher.locked')); ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-success badge-xs"><i class="ti ti-point-filled me-1"></i><?php echo e(__('dashboard.teacher.open')); ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-end">
                                            <?php if(! $exam->isLocked() && $user->can('enterMarks', $exam)): ?>
                                                <a href="<?php echo e(route('exams.marks.index', $exam)); ?>" class="btn btn-sm btn-light"><?php echo e(__('dashboard.teacher.enter_marks')); ?></a>
                                            <?php elseif($exam->isLocked() && $user->can('results.view')): ?>
                                                <a href="<?php echo e(route('exams.results.index', $exam)); ?>" class="btn btn-sm btn-light"><?php echo e(__('dashboard.teacher.results')); ?></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr><td colspan="6" class="text-muted"><?php echo e(__('dashboard.teacher.no_exams')); ?></td></tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/dashboard/teacher.blade.php ENDPATH**/ ?>