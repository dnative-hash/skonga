<?php $__env->startSection('title', __('menu.payments')); ?>

<?php $__env->startSection('page'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('menu.payments')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('fees.payments.intro')); ?></p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Payment::class)): ?>
            <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-target="#payment-modal" data-bs-toggle="modal">
                <i class="ti ti-circle-plus me-1"></i><?php echo e(__('fees.payments.record_by_control')); ?>

            </button>
        <?php endif; ?>
    </div>
    <div class="card">
        <div class="card-body">
            <?php if($payments->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('fees.payments.none')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead><tr>
                            <th><?php echo e(__('fees.receipts.receipt')); ?></th><th><?php echo e(__('fees.payments.date')); ?></th><th><?php echo e(__('fees.invoices.student')); ?></th><th><?php echo e(__('fees.invoices.number')); ?></th><th><?php echo e(__('fees.payments.method')); ?></th><th class="text-end"><?php echo e(__('fees.structures.amount')); ?></th><th></th>
                        </tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo \Illuminate\Support\Arr::toCssClasses(['text-decoration-line-through text-muted' => $payment->reversal]); ?>">
                                    <td class="fw-medium"><?php echo e($payment->receipt->reference()); ?></td>
                                    <td><?php echo e($payment->paid_on->toDateString()); ?></td>
                                    <td><?php echo e($payment->invoice->student->fullName()); ?></td>
                                    <td><?php echo e($payment->invoice->reference()); ?></td>
                                    <td><?php echo e(__('fees.payments.methods.'.$payment->method)); ?></td>
                                    <td class="text-end"><?php echo e($payment->money()->format()); ?></td>
                                    <td class="text-end"><a href="<?php echo e(route('fees.receipts.show', $payment->receipt)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.open')); ?></a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if($payments->count() === 200): ?>
                    <p class="text-muted fs-13 mt-3 mb-0"><?php echo e(__('fees.payments.limited')); ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Payment::class)): ?>
        <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'payment-modal','title' => ''.e(__('fees.payments.record_by_control')).'','action' => ''.e(route('fees.payments.store')).'','size' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'payment-modal','title' => ''.e(__('fees.payments.record_by_control')).'','action' => ''.e(route('fees.payments.store')).'','size' => 'modal-lg']); ?>
            <?php echo $__env->make('fees.payments._fields', ['key' => $paymentKey, 'withControlNumber' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/payments/index.blade.php ENDPATH**/ ?>