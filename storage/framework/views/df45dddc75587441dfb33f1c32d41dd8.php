
<?php ($ticked = old('permissions', $chosen)); ?>
<?php if($errors->any()): ?>
    <div class="alert alert-danger" role="alert"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
<?php endif; ?>

<div class="row">
    <div class="col-md-6 mb-3">
        <label class="form-label" for="name"><?php echo e(__('custom_roles.name')); ?><span class="text-danger"> *</span></label>
        <input class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="name" name="name" maxlength="60" value="<?php echo e(old('name', $role?->name)); ?>" required>
    </div>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="copy"><?php echo e(__('custom_roles.copy_from')); ?></label>
        <select class="form-select" id="copy">
            <option value=""><?php echo e(__('custom_roles.copy_none')); ?></option>
            <?php $__currentLoopData = $copyFrom; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $source): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($source->id); ?>" data-permissions='<?php echo json_encode($source->permissions->pluck('name')->values(), 15, 512) ?>'><?php echo e(App\Domain\Settings\RoleCatalog::label($source->name)); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>
</div>

<p class="fw-semibold mb-1"><?php echo e(__('custom_roles.pick')); ?></p>
<p class="text-muted fs-13"><?php echo e(__('custom_roles.pick_hint')); ?></p>

<div class="row">
    <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $area => $permissions): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-md-6 mb-3">
            <div class="border rounded p-3 h-100">
                <div class="fw-semibold mb-2"><?php echo e(__('custom_roles.area.'.$area)); ?></div>
                <?php $__currentLoopData = $permissions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permission): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($parts = explode('.', $permission, 2)); ?>
                    <?php ($id = 'perm-'.str_replace('.', '-', $permission)); ?>
                    <div class="form-check mb-1">
                        <input class="form-check-input js-permission" type="checkbox" name="permissions[]" value="<?php echo e($permission); ?>" id="<?php echo e($id); ?>" data-implies='<?php echo json_encode($implies[$permission] ?? [], 15, 512) ?>' <?php if(in_array($permission, $ticked, true)): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="<?php echo e($id); ?>"><?php echo e(__('custom_roles.perm.'.$parts[0].'.'.$parts[1])); ?></label>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<p class="text-muted fs-13 mb-0"><i class="ti ti-lock me-1"></i><?php echo e(__('custom_roles.excluded')); ?></p>

<?php $__env->startPush('page-scripts'); ?>
    <script>
        (function () {
            var boxes = Array.prototype.slice.call(document.querySelectorAll('.js-permission'));
            var byValue = {};
            boxes.forEach(function (b) { byValue[b.value] = b; });

            // A ticked permission keeps the ones it needs ticked (and locked); the server does the same.
            function settle() {
                var needed = {};
                boxes.forEach(function (b) { if (b.checked) JSON.parse(b.getAttribute('data-implies')).forEach(function (n) { needed[n] = true; }); });
                boxes.forEach(function (b) {
                    if (needed[b.value]) { b.checked = true; }
                    b.setAttribute('data-locked', needed[b.value] ? '1' : '');
                });
                // repeat once so a chain (a needs b needs c) is complete
                boxes.forEach(function (b) { if (b.checked) JSON.parse(b.getAttribute('data-implies')).forEach(function (n) { if (byValue[n]) byValue[n].checked = true; }); });
            }
            boxes.forEach(function (b) {
                b.addEventListener('click', function (e) {
                    if (!b.checked && b.getAttribute('data-locked') === '1') { b.checked = true; e.preventDefault(); return; }
                    settle();
                });
            });
            var copy = document.getElementById('copy');
            if (copy) {
                copy.addEventListener('change', function () {
                    var o = this.options[this.selectedIndex];
                    if (!o.value) return;
                    var names = JSON.parse(o.getAttribute('data-permissions'));
                    boxes.forEach(function (b) { b.checked = names.indexOf(b.value) !== -1; });
                    settle();
                });
            }
            settle();
        })();
    </script>
<?php $__env->stopPush(); ?>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/settings/roles/_fields.blade.php ENDPATH**/ ?>