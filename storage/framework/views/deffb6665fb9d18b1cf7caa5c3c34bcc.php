
<input type="hidden" name="idempotency_key" value="<?php echo e(old('idempotency_key', $key)); ?>">
<?php $__errorArgs = ['idempotency_key'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<div class="row">
    <?php if($withControlNumber ?? false): ?>
        <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'control_number', 'label' => __('fees.invoices.control_number'), 'value' => '', 'hint' => __('fees.payments.control_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    <?php endif; ?>
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'amount', 'label' => __('fees.structures.amount'), 'value' => ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="method"><?php echo e(__('fees.payments.method')); ?><span class="text-danger"> *</span></label>
        <select class="form-select <?php $__errorArgs = ['method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="method" name="method" required>
            <?php $__currentLoopData = App\Models\Payment::METHODS; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $method): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($method); ?>" <?php if(old('method') === $method): echo 'selected'; endif; ?>><?php echo e(__('fees.payments.methods.'.$method)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <?php $__errorArgs = ['method'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'paid_on', 'type' => 'date', 'label' => __('fees.payments.date'), 'value' => now()->toDateString()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'reference', 'label' => __('fees.payments.reference'), 'value' => '', 'required' => false, 'hint' => __('fees.payments.reference_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
</div>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/payments/_fields.blade.php ENDPATH**/ ?>