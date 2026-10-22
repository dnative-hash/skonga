<?php $__env->startSection('title', __('menu.dashboard')); ?>

<?php
    $figures = $summary['figures'] ?? null;
    $fees = $figures['fees'] ?? null;
    $attendance = $figures['attendance'] ?? null;
    $attendanceTrend = $figures['attendance_trend'] ?? null;
    $students = $figures['students'] ?? null;
    $people = $figures['people'] ?? null;
    $classBreakdown = $figures['class_breakdown'] ?? null;
    $recentStudents = $figures['recent_students'] ?? null;
    $recentPayments = $figures['recent_payments'] ?? null;
    $topStudents = $figures['top_students'] ?? null;

    // One coloured tile per figure the person may see, in the template's order.
    $tiles = [];
    if ($students !== null) {
        $tiles[] = ['bg-primary', 'ti-school', __('dashboard.students'), number_format($students['active']), $students['new_this_month'] > 0 ? __('dashboard.new_this_month', ['count' => $students['new_this_month']]) : null];
    }
    if (($figures['guardians'] ?? null) !== null) {
        $tiles[] = ['bg-teal', 'ti-users-group', __('dashboard.guardians'), number_format($figures['guardians']), null];
    }
    if ($people !== null) {
        $tiles[] = ['bg-secondary', 'ti-user-check', __('dashboard.teachers'), number_format($people['teachers']), __('dashboard.teacher_accounts')];
    }
    if (($figures['classes'] ?? null) !== null) {
        $tiles[] = ['bg-info', 'ti-books', __('dashboard.classes'), number_format($figures['classes']), null];
    }
    if ($fees !== null) {
        $tiles[] = ['bg-purple', 'ti-coin', __('dashboard.fees_invoiced'), $fees['invoiced']->format(), $fees['year']];
        $tiles[] = ['bg-info', 'ti-cash', __('dashboard.fees_collected'), $fees['collected']->format(), $fees['year']];
        $tiles[] = ['bg-danger', 'ti-wallet', __('dashboard.fees_outstanding'), $fees['outstanding']->format(), $fees['year']];
    }

    $barColours = ['present' => 'bg-success', 'absent' => 'bg-danger', 'late' => 'bg-warning', 'excused' => 'bg-info'];

    // The people of the school, for the doughnut of the template.
    $peopleSeries = $people !== null ? [$people['students'], $people['teachers'], $people['staff']] : [];
    $peopleLabels = [__('dashboard.people_students'), __('dashboard.people_teachers'), __('dashboard.people_staff')];
?>

<?php $__env->startSection('page'); ?>
    <div class="page-header">
        <div class="add-item d-flex">
            <div class="page-title">
                <h4><?php echo e(__('dashboard.welcome', ['name' => $user->name])); ?></h4>
                <h6><?php echo e($summary['scope'] === 'school' ? $summary['school'] : __('dashboard.platform')); ?></h6>
            </div>
        </div>
    </div>

    <?php if($summary['scope'] === 'platform'): ?>
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card bg-primary border-0">
                    <div class="card-body d-flex align-items-center justify-content-between">
                        <div>
                            <p class="mb-1 text-white"><?php echo e(__('dashboard.schools')); ?></p>
                            <h3 class="mb-0 text-white"><?php echo e($summary['schools']); ?></h3>
                        </div>
                        <span class="avatar avatar-lg" style="background:rgba(255,255,255,.2)"><i class="ti ti-building text-white fs-24"></i></span>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
        <?php if($tiles !== []): ?>
            <div class="row">
                <?php $__currentLoopData = $tiles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$colour, $icon, $label, $value, $hint]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-4 col-md-6">
                        <div class="card <?php echo e($colour); ?> border-0">
                            <div class="card-body d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="mb-1 text-white"><?php echo e($label); ?></p>
                                    <h4 class="text-white mb-1"><?php echo e($value); ?></h4>
                                    <?php if($hint !== null): ?>
                                        <span class="fs-12 text-white opacity-75"><?php echo e($hint); ?></span>
                                    <?php endif; ?>
                                </div>
                                <span class="avatar avatar-lg" style="background:rgba(255,255,255,.2)"><i class="ti <?php echo e($icon); ?> text-white fs-24"></i></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php if($fees !== null || $attendance !== null): ?>
            <div class="row">
                <?php if($fees !== null): ?>
                    <div class="col-xl-8 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                <h5 class="card-title mb-0"><?php echo e(__('dashboard.fees_chart')); ?></h5>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="fs-13"><i class="ti ti-point-filled text-teal"></i><?php echo e(__('dashboard.invoiced')); ?>: <b><?php echo e($fees['invoiced']->format()); ?></b></span>
                                    <span class="fs-13"><i class="ti ti-point-filled text-orange"></i><?php echo e(__('dashboard.collected')); ?>: <b><?php echo e($fees['collected']->format()); ?></b></span>
                                </div>
                            </div>
                            <div class="card-body"><div id="feesChart"></div></div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($attendance !== null): ?>
                    <div class="col-xl-4 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0"><?php echo e(__('dashboard.attendance_today')); ?></h5>
                                <a href="<?php echo e(route('attendance.summary')); ?>" class="btn btn-sm btn-light"><?php echo e(__('dashboard.view_all')); ?></a>
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
        <?php endif; ?>

        <?php if($people !== null || $attendanceTrend !== null): ?>
            <div class="row">
                <?php if($people !== null): ?>
                    <div class="col-xl-4 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title mb-0"><?php echo e(__('dashboard.people')); ?></h5>
                            </div>
                            <div class="card-body">
                                <div id="peopleChart"></div>
                                <div class="d-flex justify-content-around mt-3">
                                    <div class="text-center">
                                        <p class="fs-13 mb-1"><?php echo e(__('dashboard.people_students')); ?></p>
                                        <h6 class="fw-bold mb-0"><?php echo e(number_format($people['students'])); ?></h6>
                                    </div>
                                    <div class="text-center">
                                        <p class="fs-13 mb-1"><?php echo e(__('dashboard.people_teachers')); ?></p>
                                        <h6 class="fw-bold mb-0"><?php echo e(number_format($people['teachers'])); ?></h6>
                                    </div>
                                    <div class="text-center">
                                        <p class="fs-13 mb-1"><?php echo e(__('dashboard.people_staff')); ?></p>
                                        <h6 class="fw-bold mb-0"><?php echo e(number_format($people['staff'])); ?></h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($attendanceTrend !== null): ?>
                    <div class="col-xl-8 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-2">
                                <h5 class="card-title mb-0"><?php echo e(__('dashboard.attendance_trend')); ?></h5>
                                <div class="d-flex align-items-center gap-3">
                                    <span class="fs-13"><i class="ti ti-point-filled text-success"></i><?php echo e(__('attendance.statuses.present')); ?></span>
                                    <span class="fs-13"><i class="ti ti-point-filled text-orange"></i><?php echo e(__('attendance.statuses.absent')); ?></span>
                                </div>
                            </div>
                            <div class="card-body"><div id="attendanceChart"></div></div>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <div class="row">
            <?php if($topStudents !== null): ?>
                <div class="col-xl-4 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0"><?php echo e(__('dashboard.top_students')); ?></h5>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\Exam::class)): ?>
                                <a href="<?php echo e(route('exams.index')); ?>" class="btn btn-sm btn-light"><?php echo e(__('dashboard.view_all')); ?></a>
                            <?php endif; ?>
                        </div>
                        <div class="card-body">
                            <?php if($topStudents['exam'] !== null): ?>
                                <p class="fs-13 text-muted mb-3"><?php echo e($topStudents['exam']->name); ?></p>
                            <?php endif; ?>

                            <?php $__empty_1 = true; $__currentLoopData = $topStudents['rows']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="d-flex align-items-center justify-content-between <?php echo e($loop->last ? '' : 'border-bottom pb-3 mb-3'); ?>">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="avatar avatar-md bg-light text-dark fw-semibold"><?php echo e(\Illuminate\Support\Str::upper(mb_substr($row['student']->first_name, 0, 1).mb_substr($row['student']->last_name, 0, 1))); ?></span>
                                        <div>
                                            <h6 class="fs-14 mb-0"><?php echo e($row['student']->fullName()); ?></h6>
                                            <span class="fs-12 text-muted"><?php echo e($row['class']); ?></span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="fs-12 text-muted"><?php echo e(__('dashboard.average')); ?></span>
                                        <h6 class="fs-14 fw-bold mb-0"><?php echo e(\App\Domain\Exams\Score::format($row['average'])); ?></h6>
                                        <?php if($row['position'] !== null): ?>
                                            <span class="badge badge-soft-primary"><?php echo e(__('dashboard.position', ['position' => $row['position']])); ?></span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-muted mb-0"><?php echo e(__('dashboard.no_results')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($classBreakdown !== null): ?>
                <div class="col-xl-4 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0"><?php echo e(__('dashboard.students_by_class')); ?></h5>
                            <a href="<?php echo e(route('students.index')); ?>" class="btn btn-sm btn-light"><?php echo e(__('dashboard.view_all')); ?></a>
                        </div>
                        <div class="card-body">
                            <?php $__empty_1 = true; $__currentLoopData = $classBreakdown; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="mb-3">
                                    <div class="d-flex justify-content-between mb-2">
                                        <span class="text-dark"><?php echo e($class['name']); ?></span>
                                        <span class="fw-semibold text-dark"><?php echo e($class['count']); ?></span>
                                    </div>
                                    <div class="progress progress-xs">
                                        <div class="progress-bar bg-primary" style="width: <?php echo e($class['share']); ?>%"></div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-muted mb-0"><?php echo e(__('dashboard.no_class_breakdown')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <?php if($recentStudents !== null): ?>
                <div class="col-xl-4 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0"><?php echo e(__('dashboard.new_admissions')); ?></h5>
                            <a href="<?php echo e(route('students.index')); ?>" class="btn btn-sm btn-light"><?php echo e(__('dashboard.view_all')); ?></a>
                        </div>
                        <div class="card-body">
                            <?php $__empty_1 = true; $__currentLoopData = $recentStudents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="d-flex align-items-center justify-content-between <?php echo e($loop->last ? '' : 'border-bottom pb-3 mb-3'); ?>">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="avatar avatar-md bg-light text-dark fw-semibold"><?php echo e(\Illuminate\Support\Str::upper(mb_substr($student->first_name, 0, 1).mb_substr($student->last_name, 0, 1))); ?></span>
                                        <div>
                                            <h6 class="fs-14 mb-0"><a href="<?php echo e(route('students.show', $student)); ?>"><?php echo e($student->fullName()); ?></a></h6>
                                            <span class="fs-12 text-muted"><?php echo e($student->admission_number); ?></span>
                                        </div>
                                    </div>
                                    <span class="fs-12 text-muted"><?php echo e($student->admitted_on->toFormattedDateString()); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-muted mb-0"><?php echo e(__('dashboard.no_students')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="row">
            <div class="col-xl-4 col-md-6 d-flex">
                <div class="card flex-fill">
                    <div class="card-header"><h5 class="card-title mb-0"><?php echo e(__('dashboard.your_school')); ?></h5></div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between border-bottom pb-3 mb-3">
                            <span class="text-muted"><?php echo e(__('dashboard.plan')); ?></span>
                            <span class="fw-semibold text-dark"><?php echo e($summary['plan'] ?? __('dashboard.no_plan')); ?></span>
                        </div>
                        <div class="d-flex justify-content-between border-bottom pb-3 mb-3">
                            <span class="text-muted"><?php echo e(__('dashboard.subscription')); ?></span>
                            <span class="badge <?php echo e(['active' => 'bg-success', 'grace' => 'bg-warning', 'read_only' => 'bg-danger'][$summary['status']]); ?>"><?php echo e(__('dashboard.status.'.$summary['status'])); ?></span>
                        </div>
                        <?php if($summary['status'] === 'grace' && $summary['grace_ends_at']): ?>
                            <p class="text-muted fs-13 mb-3"><?php echo e(__('dashboard.grace_ends', ['date' => $summary['grace_ends_at']->toFormattedDateString()])); ?></p>
                        <?php endif; ?>
                        <div class="d-flex justify-content-between border-bottom pb-3 mb-3">
                            <span class="text-muted"><?php echo e(__('dashboard.academic_year')); ?></span>
                            <span class="fw-semibold text-dark"><?php echo e($summary['academic_year'] ?? __('dashboard.no_year')); ?><?php if($summary['term']): ?> · <?php echo e($summary['term']); ?><?php endif; ?></span>
                        </div>
                        <div class="d-flex justify-content-between">
                            <span class="text-muted"><?php echo e(__('dashboard.your_roles')); ?></span>
                            <span class="fw-semibold text-dark text-end"><?php echo e($summary['roles'] === [] ? __('dashboard.no_role') : implode(', ', $summary['roles'])); ?></span>
                        </div>
                    </div>
                </div>
            </div>

            <?php if($recentPayments !== null): ?>
                <div class="col-xl-4 col-md-6 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header d-flex align-items-center justify-content-between">
                            <h5 class="card-title mb-0"><?php echo e(__('dashboard.recent_payments')); ?></h5>
                            <a href="<?php echo e(route('fees.payments.index')); ?>" class="btn btn-sm btn-light"><?php echo e(__('dashboard.view_all')); ?></a>
                        </div>
                        <div class="card-body">
                            <?php $__empty_1 = true; $__currentLoopData = $recentPayments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="d-flex align-items-center justify-content-between <?php echo e($loop->last ? '' : 'border-bottom pb-3 mb-3'); ?>">
                                    <div>
                                        <h6 class="fs-14 mb-0"><?php echo e($payment->invoice->student->fullName()); ?></h6>
                                        <span class="fs-12 text-muted"><?php echo e($payment->paid_on->toFormattedDateString()); ?></span>
                                    </div>
                                    <span class="fw-semibold text-dark"><?php echo e($payment->money()->format()); ?></span>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <p class="text-muted mb-0"><?php echo e(__('dashboard.no_payments')); ?></p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php if(($summary['figures']['fees'] ?? null) !== null || ($summary['figures']['people'] ?? null) !== null || ($summary['figures']['attendance_trend'] ?? null) !== null): ?>
    <?php $__env->startPush('vendor'); ?>
        <script src="<?php echo e(asset('assets/plugins/apexchart/apexcharts.min.js')); ?>"></script>
    <?php $__env->stopPush(); ?>

    <?php $__env->startPush('page-scripts'); ?>
        <script>
            (function () {
                <?php if(($summary['figures']['fees'] ?? null) !== null): ?>
                    var chart = <?php echo json_encode($summary['figures']['fees']['chart'], 15, 512) ?>;
                    var currency = <?php echo json_encode($summary['figures']['fees']['currency'], 15, 512) ?>;

                    function short(value) {
                        if (value >= 1000000) { return currency + ' ' + (Math.round(value / 100000) / 10) + 'M'; }
                        if (value >= 1000) { return currency + ' ' + (Math.round(value / 100) / 10) + 'k'; }
                        return currency + ' ' + value;
                    }

                    new ApexCharts(document.querySelector('#feesChart'), {
                        series: [
                            { name: <?php echo json_encode(__('dashboard.invoiced'), 15, 512) ?>, data: chart.invoiced },
                            { name: <?php echo json_encode(__('dashboard.collected'), 15, 512) ?>, data: chart.collected }
                        ],
                        chart: { type: 'bar', height: 280, toolbar: { show: false } },
                        colors: ['#0E9384', '#FE9F43'],
                        plotOptions: { bar: { columnWidth: '45%', borderRadius: 4 } },
                        xaxis: { categories: chart.labels },
                        yaxis: { labels: { formatter: short } },
                        legend: { show: false },
                        grid: { borderColor: '#E6EAED', strokeDashArray: 3 },
                        fill: { opacity: 1 },
                        dataLabels: { enabled: false }
                    }).render();
                <?php endif; ?>

                <?php if(($summary['figures']['people'] ?? null) !== null): ?>
                    new ApexCharts(document.querySelector('#peopleChart'), {
                        series: <?php echo json_encode($peopleSeries, 15, 512) ?>,
                        labels: <?php echo json_encode($peopleLabels, 15, 512) ?>,
                        colors: ['#FE9F43', '#092C4C', '#0E9384'],
                        chart: { type: 'donut', height: 250 },
                        legend: { show: false },
                        dataLabels: { enabled: true, formatter: function (value) { return Math.round(value) + '%'; } },
                        plotOptions: { pie: { donut: { size: '62%' } } },
                        stroke: { width: 2 }
                    }).render();
                <?php endif; ?>

                <?php if(($summary['figures']['attendance_trend'] ?? null) !== null): ?>
                    new ApexCharts(document.querySelector('#attendanceChart'), {
                        series: [
                            { name: <?php echo json_encode(__('attendance.statuses.present'), 15, 512) ?>, data: <?php echo json_encode($summary['figures']['attendance_trend']['present'], 15, 512) ?> },
                            { name: <?php echo json_encode(__('attendance.statuses.absent'), 15, 512) ?>, data: <?php echo json_encode($summary['figures']['attendance_trend']['absent'], 15, 512) ?> }
                        ],
                        chart: { type: 'area', height: 290, toolbar: { show: false } },
                        colors: ['#03C95A', '#FE9F43'],
                        stroke: { curve: 'smooth', width: 2 },
                        dataLabels: { enabled: false },
                        legend: { show: false },
                        xaxis: { categories: <?php echo json_encode($summary['figures']['attendance_trend']['labels'], 15, 512) ?> },
                        grid: { borderColor: '#E6EAED', strokeDashArray: 3 },
                        fill: { type: 'gradient', gradient: { opacityFrom: .35, opacityTo: .02 } }
                    }).render();
                <?php endif; ?>
            })();
        </script>
    <?php $__env->stopPush(); ?>
<?php endif; ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/dashboard.blade.php ENDPATH**/ ?>