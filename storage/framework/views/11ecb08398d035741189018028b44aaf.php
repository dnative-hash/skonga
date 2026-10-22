
<form method="POST" action="<?php echo e($user ? route('settings.users.update', $user->id) : route('settings.users.store')); ?>">
    <?php echo csrf_field(); ?>
    <?php if($user): ?>
        <?php echo method_field('PUT'); ?>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('custom_roles.users.name'), 'value' => $user?->name ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php echo $__env->make('academics._field', ['name' => 'email', 'label' => __('custom_roles.users.email'), 'type' => 'email', 'value' => $user?->email ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

            <div class="mb-3">
                <label class="form-label" for="role"><?php echo e(__('custom_roles.users.role')); ?><span class="text-danger"> *</span></label>
                <select class="form-select <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="role" name="role" required>
                    <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($role->name); ?>" <?php if(old('role', $user?->getRoleNames()->first() ?? 'teacher') === $role->name): echo 'selected'; endif; ?>><?php echo e(App\Domain\Settings\RoleCatalog::label($role->name)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['role'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="mb-0">
                <label class="form-label" for="password"><?php echo e(__('custom_roles.users.password')); ?><?php if (! ($user)): ?><span class="text-danger"> *</span><?php endif; ?></label>
                <input class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="password" name="password" type="password" autocomplete="new-password" <?php if (! ($user)): ?> required <?php endif; ?>>
                <div class="form-text"><?php echo e($user ? __('custom_roles.users.password_keep') : __('custom_roles.users.password_hint')); ?></div>
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i><?php echo e(__('custom_roles.save')); ?></button>
    <a href="<?php echo e(route('settings.users.index')); ?>" class="btn btn-outline-secondary"><?php echo e(__('custom_roles.cancel')); ?></a>
</form>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/settings/users/_form.blade.php ENDPATH**/ ?>