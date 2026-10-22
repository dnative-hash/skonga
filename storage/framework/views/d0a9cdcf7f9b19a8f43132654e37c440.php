
<?php ($editing = isset($structure)); ?>
<?php ($currency = app(App\Tenancy\TenantContext::class)->current()?->currency ?? App\Support\Money::DEFAULT_CURRENCY); ?>
<?php ($existing = $editing ? $structure->items->values() : collect()); ?>
<form action="<?php echo e($editing ? route('fees.structures.update', $structure) : route('fees.structures.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('fees.structures.name'), 'value' => $structure->name ?? '', 'hint' => __('fees.structures.name_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <div class="row">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="term_id"><?php echo e(__('fees.structures.term')); ?><span class="text-danger"> *</span></label>
            <select class="form-select <?php $__errorArgs = ['term_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="term_id" name="term_id" required>
                <option value=""><?php echo e(__('fees.choose')); ?></option>
                <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($term->id); ?>" <?php if((int) old('term_id', $structure->term_id ?? 0) === $term->id): echo 'selected'; endif; ?>><?php echo e($term->academicYear->name); ?> – <?php echo e($term->name); ?></option>
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
        <div class="col-md-6 mb-3">
            <label class="form-label" for="school_class_id"><?php echo e(__('fees.structures.class')); ?><span class="text-danger"> *</span></label>
            <select class="form-select <?php $__errorArgs = ['school_class_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="school_class_id" name="school_class_id" required>
                <option value=""><?php echo e(__('fees.choose')); ?></option>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($class->id); ?>" <?php if((int) old('school_class_id', $structure->school_class_id ?? 0) === $class->id): echo 'selected'; endif; ?>><?php echo e($class->name); ?></option>
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
    </div>
    <?php $__errorArgs = ['items'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    <div class="table-responsive">
        <table class="table align-middle">
            <thead><tr><th><?php echo e(__('fees.structures.item')); ?></th><th style="width: 220px"><?php echo e(__('fees.structures.amount')); ?> (<?php echo e($currency); ?>)</th></tr></thead>
            <tbody>
                <?php for($i = 0; $i < 8; $i++): ?>
                    <?php ($item = $existing->get($i)); ?>
                    <tr>
                        <td><input class="form-control form-control-sm" type="text" maxlength="100" name="items[<?php echo e($i); ?>][name]" value="<?php echo e(old("items.{$i}.name", $item->name ?? '')); ?>"></td>
                        <td><input class="form-control form-control-sm" type="text" inputmode="decimal" maxlength="14" autocomplete="off" name="items[<?php echo e($i); ?>][amount]" value="<?php echo e(old("items.{$i}.amount", $item ? App\Support\Money::toInput($item->amount, $currency) : '')); ?>"></td>
                    </tr>
                <?php endfor; ?>
            </tbody>
        </table>
    </div>
    <p class="text-muted fs-13"><?php echo e(__('fees.structures.rule')); ?></p>
    <button type="submit" class="btn btn-primary"><?php echo e(__('fees.save')); ?></button>
</form>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/structures/_form.blade.php ENDPATH**/ ?>