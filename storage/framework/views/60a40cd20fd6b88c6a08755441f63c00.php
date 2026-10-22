<?php $__env->startSection('title', __('menu.invoices')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <h3 class="page-title mb-1"><?php echo e(__('menu.invoices')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('fees.invoices.intro')); ?></p>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('fees.invoices.index')); ?>" method="GET">
                <div class="row align-items-end">
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="term_id"><?php echo e(__('fees.structures.term')); ?></label>
                        <select class="form-select <?php $__errorArgs = ['term_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="term_id" name="term_id">
                            <option value=""><?php echo e(__('fees.invoices.all')); ?></option>
                            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($term->id); ?>" <?php if($termId === $term->id): echo 'selected'; endif; ?>><?php echo e($term->academicYear->name); ?> – <?php echo e($term->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['term_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="school_class_id"><?php echo e(__('fees.structures.class')); ?></label>
                        <select class="form-select <?php $__errorArgs = ['school_class_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="school_class_id" name="school_class_id">
                            <option value=""><?php echo e(__('fees.invoices.all')); ?></option>
                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($class->id); ?>" <?php if($classId === $class->id): echo 'selected'; endif; ?>><?php echo e($class->name); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <?php $__errorArgs = ['school_class_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>
                    <div class="col-md-3 mb-3"><button type="submit" class="btn btn-primary w-100"><?php echo e(__('fees.invoices.show_button')); ?></button></div>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($invoices->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('fees.invoices.empty')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead><tr>
                            <th><?php echo e(__('fees.invoices.number')); ?></th><th><?php echo e(__('fees.invoices.student')); ?></th><th><?php echo e(__('fees.structures.term')); ?></th><th><?php echo e(__('fees.structures.class')); ?></th><th class="text-end"><?php echo e(__('fees.structures.total')); ?></th><th class="text-end"><?php echo e(__('fees.payments.balance')); ?></th><th><?php echo e(__('fees.payments.status')); ?></th><th></th>
                        </tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($invoice->reference()); ?></td>
                                    <td><?php echo e($invoice->student->fullName()); ?><div class="text-muted fs-13"><?php echo e($invoice->student->admission_number); ?></div></td>
                                    <td><?php echo e($invoice->term->name); ?></td>
                                    <td><?php echo e($invoice->schoolClass->name); ?></td>
                                    <?php ($b = App\Domain\Fees\InvoiceBalance::fromLoaded($invoice)); ?>
                                    <td class="text-end"><?php echo e($invoice->totalMoney()->format()); ?></td>
                                    <td class="text-end"><?php echo e($b->balanceMoney()->format()); ?></td>
                                    <td><?php echo e(__('fees.payments.statuses.'.$b->status())); ?></td>
                                    <td class="text-end"><a href="<?php echo e(route('fees.invoices.show', $invoice)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.open')); ?></a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if($invoices->count() === 200): ?>
                    <p class="text-muted fs-13 mt-3 mb-0"><?php echo e(__('fees.invoices.limited')); ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/invoices/index.blade.php ENDPATH**/ ?>