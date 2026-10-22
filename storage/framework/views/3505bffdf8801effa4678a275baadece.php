<?php $__env->startSection('title', __('menu.collections_report')); ?>

<?php
    $money = fn (int $minor, string $currency) => App\Support\Money::of($minor, $currency)->format();
    $currencies = array_values(array_unique(array_merge(array_keys($report['collected']), array_keys($report['outstanding']), array_keys($report['reversed']))));
?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <h3 class="page-title mb-1"><?php echo e(__('menu.collections_report')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('fees.report.intro')); ?></p>
    </div>

    <div class="card">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('fees.reports.collections')); ?>" class="row align-items-end">
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="from"><?php echo e(__('fees.report.from')); ?></label>
                    <input class="form-control <?php $__errorArgs = ['from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date" id="from" name="from" value="<?php echo e($from->toDateString()); ?>">
                    <?php $__errorArgs = ['from'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-3 mb-3">
                    <label class="form-label" for="to"><?php echo e(__('fees.report.to')); ?></label>
                    <input class="form-control <?php $__errorArgs = ['to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="date" id="to" name="to" value="<?php echo e($to->toDateString()); ?>">
                    <?php $__errorArgs = ['to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="col-md-3 mb-3"><button type="submit" class="btn btn-primary"><?php echo e(__('fees.invoices.show_button')); ?></button></div>
            </form>
        </div>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $currencies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $currency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php $row = $report['collected'][$currency] ?? ['total' => 0, 'count' => 0, 'methods' => [], 'sources' => []]; ?>
        <div class="row">
            <div class="col-md-4"><div class="card"><div class="card-body">
                <div class="text-muted"><?php echo e(__('fees.report.collected')); ?> (<?php echo e($currency); ?>)</div>
                <h3 class="mb-0"><?php echo e($money($row['total'], $currency)); ?></h3>
                <div class="text-muted fs-13"><?php echo e(trans_choice('fees.report.payments_count', $row['count'], ['count' => $row['count']])); ?></div>
            </div></div></div>
            <div class="col-md-4"><div class="card"><div class="card-body">
                <div class="text-muted"><?php echo e(__('fees.report.outstanding')); ?> (<?php echo e($currency); ?>)</div>
                <h3 class="mb-0"><?php echo e($money($report['outstanding'][$currency]['total'] ?? 0, $currency)); ?></h3>
                <div class="text-muted fs-13"><?php echo e(trans_choice('fees.report.invoices_count', $report['outstanding'][$currency]['invoices'] ?? 0, ['count' => $report['outstanding'][$currency]['invoices'] ?? 0])); ?></div>
            </div></div></div>
            <div class="col-md-4"><div class="card"><div class="card-body">
                <div class="text-muted"><?php echo e(__('fees.report.reversed')); ?> (<?php echo e($currency); ?>)</div>
                <h3 class="mb-0"><?php echo e($money($report['reversed'][$currency]['total'] ?? 0, $currency)); ?></h3>
                <div class="text-muted fs-13"><?php echo e(trans_choice('fees.report.payments_count', $report['reversed'][$currency]['count'] ?? 0, ['count' => $report['reversed'][$currency]['count'] ?? 0])); ?></div>
            </div></div></div>
        </div>

        <div class="row">
            <div class="col-md-6"><div class="card"><div class="card-body">
                <h5 class="mb-3"><?php echo e(__('fees.report.by_method')); ?></h5>
                <table class="table mb-0"><tbody>
                    <?php $__currentLoopData = App\Models\Payment::METHODS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr><td><?php echo e(__('fees.payments.methods.'.$method)); ?></td><td class="text-end"><?php echo e($money($row['methods'][$method] ?? 0, $currency)); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody></table>
            </div></div></div>
            <div class="col-md-6"><div class="card"><div class="card-body">
                <h5 class="mb-3"><?php echo e(__('fees.report.by_source')); ?></h5>
                <table class="table mb-0"><tbody>
                    <?php $__currentLoopData = ['manual', 'integration']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr><td><?php echo e(__('fees.report.sources.'.$source)); ?></td><td class="text-end"><?php echo e($money($row['sources'][$source] ?? 0, $currency)); ?></td></tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody></table>
            </div></div></div>
        </div>

        <?php if($report['days'] !== []): ?>
            <div class="card"><div class="card-body">
                <h5 class="mb-3"><?php echo e(__('fees.report.by_day')); ?> (<?php echo e($currency); ?>)</h5>
                <div class="table-responsive"><table class="table align-middle mb-0">
                    <thead><tr><th><?php echo e(__('fees.payments.date')); ?></th><th class="text-end"><?php echo e(__('fees.report.collected')); ?></th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $report['days']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day => $perCurrency): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(isset($perCurrency[$currency])): ?>
                                <tr><td><?php echo e($day); ?></td><td class="text-end"><?php echo e($money($perCurrency[$currency], $currency)); ?></td></tr>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table></div>
            </div></div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card"><div class="card-body text-muted"><?php echo e(__('fees.report.none')); ?></div></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-1"><?php echo e(__('fees.report.exceptions')); ?></h5>
            <p class="text-muted"><?php echo e(__('fees.report.exceptions_hint')); ?></p>
            <?php if($report['notices'] === []): ?>
                <p class="text-muted mb-0"><?php echo e(__('fees.report.exceptions_none')); ?></p>
            <?php else: ?>
                <p class="mb-2">
                    <?php $__currentLoopData = $report['notice_counts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $count): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="badge bg-warning text-dark me-1"><?php echo e(__('integrations.notices.statuses.'.$status)); ?>: <?php echo e($count); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </p>
                <div class="table-responsive"><table class="table align-middle mb-0">
                    <thead><tr><th><?php echo e(__('integrations.notices.received')); ?></th><th><?php echo e(__('fees.invoices.control_number')); ?></th><th><?php echo e(__('integrations.notices.reference')); ?></th><th class="text-end"><?php echo e(__('fees.structures.amount')); ?></th><th><?php echo e(__('fees.payments.status')); ?></th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $report['notices']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($notice->received_at->format('Y-m-d H:i')); ?></td>
                                <td><?php echo e($notice->control_number); ?></td>
                                <td><?php echo e($notice->provider_reference); ?></td>
                                <td class="text-end"><?php if($notice->amount !== null && $notice->currency !== null): ?><?php echo e($money($notice->amount, $notice->currency)); ?><?php endif; ?></td>
                                <td><?php echo e(__('integrations.notices.statuses.'.$notice->status)); ?><?php if($notice->reason): ?> <span class="text-muted fs-13">· <?php echo e(__('integrations.notices.reasons.'.$notice->reason)); ?></span><?php endif; ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table></div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/reports/collections.blade.php ENDPATH**/ ?>