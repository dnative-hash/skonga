<?php $__env->startSection('title', __('menu.fee_reminders')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <h3 class="page-title mb-1"><?php echo e(__('menu.fee_reminders')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('communication.intro')); ?></p>
    </div>

    <?php if (! ($smsActive)): ?>
        <div class="alert alert-warning">
            <?php echo e(__('communication.sms_off')); ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings.manage')): ?><a href="<?php echo e(route('settings.integrations.index')); ?>"><?php echo e(__('menu.integrations')); ?></a><?php endif; ?>
        </div>
    <?php endif; ?>

    <?php $__errorArgs = ['invoices'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <?php $__errorArgs = ['invoices.*'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('communication.reminders.index')); ?>" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="term_id"><?php echo e(__('fees.structures.term')); ?></label>
                        <select class="form-select" id="term_id" name="term_id">
                            <option value=""><?php echo e(__('fees.invoices.all')); ?></option>
                            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($term->id); ?>" <?php if($termId === $term->id): echo 'selected'; endif; ?>><?php echo e($term->academicYear->name); ?> – <?php echo e($term->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="school_class_id"><?php echo e(__('fees.structures.class')); ?></label>
                        <select class="form-select" id="school_class_id" name="school_class_id">
                            <option value=""><?php echo e(__('fees.invoices.all')); ?></option>
                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($class->id); ?>" <?php if($classId === $class->id): echo 'selected'; endif; ?>><?php echo e($class->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3"><button type="submit" class="btn btn-outline-primary"><?php echo e(__('fees.invoices.show_button')); ?></button></div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($rows->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('communication.none')); ?></p>
            <?php else: ?>
                <form action="<?php echo e(route('communication.reminders.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="table-responsive">
                        <table class="table align-middle mb-3">
                            <thead><tr>
                                <th style="width: 40px"><input type="checkbox" class="form-check-input js-all" aria-label="<?php echo e(__('communication.select_all')); ?>"></th>
                                <th><?php echo e(__('fees.invoices.student')); ?></th><th><?php echo e(__('fees.invoices.number')); ?></th><th class="text-end"><?php echo e(__('fees.payments.balance')); ?></th><th><?php echo e(__('communication.guardians')); ?></th><th><?php echo e(__('communication.last')); ?></th>
                            </tr></thead>
                            <tbody>
                                <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><input type="checkbox" class="form-check-input js-row" name="invoices[]" value="<?php echo e($row['invoice']->id); ?>" <?php if($row['reachable'] === 0): echo 'disabled'; endif; ?> <?php if(in_array($row['invoice']->id, array_map('intval', (array) old('invoices', [])))): echo 'checked'; endif; ?>></td>
                                        <td><?php echo e($row['invoice']->student->fullName()); ?></td>
                                        <td><?php echo e($row['invoice']->reference()); ?></td>
                                        <td class="text-end"><?php echo e($row['balance']->format()); ?></td>
                                        <td><?php if($row['reachable'] > 0): ?><?php echo e(trans_choice('communication.reachable', $row['reachable'], ['count' => $row['reachable']])); ?><?php else: ?><span class="text-danger"><?php echo e(__('communication.no_phone')); ?></span><?php endif; ?></td>
                                        <td><?php if($row['last']): ?><?php echo e(__('communication.statuses.'.$row['last']->status)); ?> · <?php echo e($row['last']->day->toDateString()); ?><?php endif; ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <?php if($truncated): ?><p class="text-muted fs-13"><?php echo e(__('communication.limited')); ?></p><?php endif; ?>

                    <div class="row align-items-end">
                        <div class="col-md-4 mb-3">
                            <label class="form-label" for="locale"><?php echo e(__('communication.language')); ?></label>
                            <select class="form-select" id="locale" name="locale">
                                <?php $__currentLoopData = config('app.available_locales'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($code); ?>" <?php if(old('locale', 'sw') === $code): echo 'selected'; endif; ?>><?php echo e(__('communication.languages.'.$code)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3"><button type="submit" class="btn btn-primary" <?php if(! $smsActive): echo 'disabled'; endif; ?>><?php echo e(__('communication.send')); ?></button></div>
                    </div>
                    <p class="text-muted fs-13 mb-0"><?php echo e(__('communication.send_hint')); ?></p>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3"><?php echo e(__('communication.history')); ?></h5>
            <?php if($history->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('communication.history_none')); ?></p>
            <?php else: ?>
                <div class="table-responsive"><table class="table align-middle mb-0">
                    <thead><tr><th><?php echo e(__('integrations.notices.received')); ?></th><th><?php echo e(__('fees.invoices.number')); ?></th><th><?php echo e(__('fees.payments.status')); ?></th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $message): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($message->created_at->format('Y-m-d H:i')); ?></td>
                                <td><?php echo e($message->invoice->reference()); ?></td>
                                <td><?php echo e(__('communication.statuses.'.$message->status)); ?><?php if($message->error): ?> <span class="text-muted fs-13">· <?php echo e(__('communication.reasons.'.$message->error) !== 'communication.reasons.'.$message->error ? __('communication.reasons.'.$message->error) : $message->error); ?></span><?php endif; ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table></div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-scripts'); ?>
<script>
    (function () {
        var all = document.querySelector('.js-all');
        if (!all) { return; }
        all.addEventListener('change', function () {
            document.querySelectorAll('.js-row:not(:disabled)').forEach(function (box) { box.checked = all.checked; });
        });
    })();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/communication/reminders.blade.php ENDPATH**/ ?>