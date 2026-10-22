<?php $__env->startSection('title', $invoice->reference()); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3 d-print-none">
        <a href="<?php echo e(route('fees.invoices.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('menu.invoices')); ?></a>
        <div class="d-flex justify-content-between align-items-start mt-2">
            <h3 class="page-title mb-0"><?php echo e($invoice->reference()); ?></h3>
            <button type="button" class="btn btn-sm btn-outline-secondary" onclick="window.print()"><?php echo e(__('fees.invoices.print')); ?></button>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4"><?php echo e(__('fees.invoices.student')); ?></dt><dd class="col-sm-8"><?php echo e($invoice->student->fullName()); ?> (<?php echo e($invoice->student->admission_number); ?>)</dd>
                <dt class="col-sm-4"><?php echo e(__('fees.structures.term')); ?></dt><dd class="col-sm-8"><?php echo e($invoice->term->academicYear->name); ?> – <?php echo e($invoice->term->name); ?></dd>
                <dt class="col-sm-4"><?php echo e(__('fees.structures.class')); ?></dt><dd class="col-sm-8"><?php echo e($invoice->schoolClass->name); ?></dd>
                <dt class="col-sm-4"><?php echo e(__('fees.invoices.issued_on')); ?></dt><dd class="col-sm-8"><?php echo e($invoice->issued_on->toDateString()); ?></dd>
                <dt class="col-sm-4"><?php echo e(__('fees.invoices.control_number')); ?></dt><dd class="col-sm-8"><?php echo e($invoice->control_number ?? '–'); ?></dd>
            </dl>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th><?php echo e(__('fees.structures.item')); ?></th><th class="text-end"><?php echo e(__('fees.structures.amount')); ?></th></tr></thead>
                    <tbody>
                        <?php $__currentLoopData = $invoice->lines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr><td><?php echo e($line->name); ?></td><td class="text-end"><?php echo e(App\Support\Money::of($line->amount, $invoice->currency)->format()); ?></td></tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr class="fw-bold"><td><?php echo e(__('fees.structures.total')); ?></td><td class="text-end"><?php echo e($invoice->totalMoney()->format()); ?></td></tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <dl class="row mb-0">
                <dt class="col-sm-4"><?php echo e(__('fees.payments.paid')); ?></dt><dd class="col-sm-8"><?php echo e($balance->paidMoney()->format()); ?></dd>
                <dt class="col-sm-4"><?php echo e(__('fees.payments.balance')); ?></dt><dd class="col-sm-8 fw-bold"><?php echo e($balance->balanceMoney()->format()); ?></dd>
                <dt class="col-sm-4"><?php echo e(__('fees.payments.status')); ?></dt><dd class="col-sm-8"><?php echo e(__('fees.payments.statuses.'.$balance->status())); ?></dd>
            </dl>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3"><?php echo e(__('fees.payments.title')); ?></h5>
            <?php $__errorArgs = ['reason'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            <?php if($invoice->payments->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('fees.payments.empty')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead><tr>
                            <th><?php echo e(__('fees.payments.date')); ?></th><th><?php echo e(__('fees.payments.method')); ?></th><th><?php echo e(__('fees.payments.reference')); ?></th><th class="text-end"><?php echo e(__('fees.structures.amount')); ?></th><th><?php echo e(__('fees.receipts.receipt')); ?></th><th></th>
                        </tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $invoice->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo \Illuminate\Support\Arr::toCssClasses(['text-decoration-line-through text-muted' => $payment->reversal]); ?>">
                                    <td><?php echo e($payment->paid_on->toDateString()); ?></td>
                                    <td><?php echo e(__('fees.payments.methods.'.$payment->method)); ?></td>
                                    <td><?php echo e($payment->reference); ?></td>
                                    <td class="text-end"><?php echo e($payment->money()->format()); ?></td>
                                    <td><a href="<?php echo e(route('fees.receipts.show', $payment->receipt)); ?>"><?php echo e($payment->receipt->reference()); ?></a><?php if($payment->reversal): ?> <span class="badge bg-secondary ms-1"><?php echo e(__('fees.payments.reversed_badge')); ?></span><?php endif; ?></td>
                                    <td class="text-end d-print-none">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('reverse', $payment)): ?>
                                            <?php if (! ($payment->reversal)): ?>
                                                <form action="<?php echo e(route('fees.payments.reverse', $payment)); ?>" method="POST" class="d-flex gap-1 justify-content-end" onsubmit="return confirm(<?php echo \Illuminate\Support\Js::from(__('fees.payments.confirm_reverse'))->toHtml() ?>)">
                                                    <?php echo csrf_field(); ?>
                                                    <input class="form-control form-control-sm" style="max-width: 180px" type="text" name="reason" maxlength="250" required placeholder="<?php echo e(__('fees.payments.reason')); ?>">
                                                    <button type="submit" class="btn btn-sm btn-outline-danger"><?php echo e(__('fees.payments.reverse')); ?></button>
                                                </form>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Payment::class)): ?>
        <?php if($balance->balance() > 0): ?>
            <div class="card d-print-none">
                <div class="card-body d-flex flex-wrap justify-content-between align-items-center gap-2">
                    <h5 class="mb-0"><?php echo e(__('fees.payments.record')); ?></h5>
                    <button type="button" class="btn btn-primary" data-bs-target="#invoice-payment-modal" data-bs-toggle="modal">
                        <i class="ti ti-circle-plus me-1"></i><?php echo e(__('fees.payments.record_button')); ?>

                    </button>
                </div>
            </div>

            <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'invoice-payment-modal','title' => ''.e(__('fees.payments.record')).'','action' => ''.e(route('fees.invoices.payments.store', $invoice)).'','size' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'invoice-payment-modal','title' => ''.e(__('fees.payments.record')).'','action' => ''.e(route('fees.invoices.payments.store', $invoice)).'','size' => 'modal-lg']); ?>
                <?php echo $__env->make('fees.payments._fields', ['key' => $key], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
             <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf85e6552b95df616d59caebcbf2473d)): ?>
<?php $attributes = $__attributesOriginaldf85e6552b95df616d59caebcbf2473d; ?>
<?php unset($__attributesOriginaldf85e6552b95df616d59caebcbf2473d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf85e6552b95df616d59caebcbf2473d)): ?>
<?php $component = $__componentOriginaldf85e6552b95df616d59caebcbf2473d; ?>
<?php unset($__componentOriginaldf85e6552b95df616d59caebcbf2473d); ?>
<?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Payment::class)): ?>
        <?php if($mobileMoney && $invoice->currency === 'TZS' && $balance->balance() >= 100): ?>
            <div class="card d-print-none">
                <div class="card-body">
                    <h5 class="mb-1"><?php echo e(__('integrations.azampay.request')); ?></h5>
                    <p class="text-muted"><?php echo e(__('integrations.azampay.request_hint')); ?></p>
                    <form action="<?php echo e(route('fees.invoices.mobile-money', $invoice)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="idempotency_key" value="<?php echo e($key); ?>">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label"><?php echo e(__('integrations.azampay.phone')); ?></label>
                                <input class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" inputmode="tel" name="phone" maxlength="20" autocomplete="off" placeholder="07XXXXXXXX" value="<?php echo e(old('phone')); ?>" required>
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label"><?php echo e(__('integrations.azampay.network')); ?></label>
                                <select class="form-select <?php $__errorArgs = ['provider'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="provider" required>
                                    <?php $__currentLoopData = config('azampay.providers'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $network): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($network); ?>" <?php if(old('provider') === $network): echo 'selected'; endif; ?>><?php echo e($network); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['provider'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="col-md-3 mb-3">
                                <label class="form-label"><?php echo e(__('fees.structures.amount')); ?></label>
                                <input class="form-control <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" inputmode="numeric" name="amount" maxlength="14" autocomplete="off" value="<?php echo e(old('amount', intdiv($balance->balance(), 100))); ?>" required>
                                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('integrations.azampay.send')); ?></button>
                    </form>

                    <?php if($requests->isNotEmpty()): ?>
                        <div class="table-responsive mt-3">
                            <table class="table align-middle mb-0">
                                <thead><tr><th><?php echo e(__('integrations.notices.received')); ?></th><th><?php echo e(__('integrations.azampay.network')); ?></th><th class="text-end"><?php echo e(__('fees.structures.amount')); ?></th><th><?php echo e(__('fees.payments.status')); ?></th></tr></thead>
                                <tbody>
                                    <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($row->created_at->format('Y-m-d H:i')); ?></td>
                                            <td><?php echo e($row->provider); ?></td>
                                            <td class="text-end"><?php echo e(App\Support\Money::of($row->amount, $row->currency)->format()); ?></td>
                                            <td><?php echo e(__('integrations.azampay.statuses.'.$row->displayStatus())); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $invoice)): ?>
        <div class="card d-print-none">
            <div class="card-body">
                <h5 class="mb-1"><?php echo e(__('fees.invoices.control_number')); ?></h5>
                <p class="text-muted"><?php echo e(__('fees.invoices.control_hint')); ?></p>
                <form action="<?php echo e(route('fees.invoices.control-number', $invoice)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="row align-items-end">
                        <div class="col-md-6 mb-3">
                            <input class="form-control <?php $__errorArgs = ['control_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" type="text" inputmode="numeric" maxlength="30" autocomplete="off" name="control_number" value="<?php echo e(old('control_number', $invoice->control_number)); ?>">
                            <?php $__errorArgs = ['control_number'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="col-md-3 mb-3"><button type="submit" class="btn btn-primary"><?php echo e(__('fees.save')); ?></button></div>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/invoices/show.blade.php ENDPATH**/ ?>