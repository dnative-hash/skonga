
<div class="mb-3">
    <label class="form-label" for="<?php echo e($name); ?>"><?php echo e($label); ?><?php if($required ?? true): ?><span class="text-danger"> *</span><?php endif; ?></label>
    <input class="form-control <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="<?php echo e($name); ?>" name="<?php echo e($name); ?>" type="<?php echo e($type ?? 'text'); ?>" value="<?php echo e(old($name, $value ?? '')); ?>" <?php if($required ?? true): ?> required <?php endif; ?>>
    <?php if(isset($hint)): ?><div class="form-text"><?php echo e($hint); ?></div><?php endif; ?>
    <?php $__errorArgs = [$name];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
</div>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/_field.blade.php ENDPATH**/ ?>