
<?php ($editing = isset($student)); ?>
<form action="<?php echo e($editing ? route('students.update', $student) : route('students.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="row">
        <div class="col-md-4">
            <?php if($admissionAuto ?? false): ?>
                <div class="mb-3">
                    <label class="form-label" for="admission_number_shown"><?php echo e(__('students.fields.admission_number')); ?></label>
                    <input class="form-control" id="admission_number_shown" value="<?php echo e($editing ? $student->admission_number : $admissionNext); ?>" readonly>
                    <div class="form-text"><?php echo e($editing ? __('admission.auto_locked') : __('admission.auto_notice')); ?></div>
                </div>
            <?php else: ?>
                <?php echo $__env->make('academics._field', ['name' => 'admission_number', 'label' => __('students.fields.admission_number'), 'value' => $student->admission_number ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <?php endif; ?>
        </div>
        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'first_name', 'label' => __('students.fields.first_name'), 'value' => $student->first_name ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'middle_name', 'label' => __('students.fields.middle_name'), 'value' => $student->middle_name ?? '', 'required' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'last_name', 'label' => __('students.fields.last_name'), 'value' => $student->last_name ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
        <div class="col-md-4 mb-3">
            <label class="form-label" for="gender"><?php echo e(__('students.fields.gender')); ?><span class="text-danger"> *</span></label>
            <select class="form-select <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="gender" name="gender" required>
                <option value=""><?php echo e(__('students.fields.choose')); ?></option>
                <?php $__currentLoopData = ['male', 'female']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gender): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($gender); ?>" <?php if(old('gender', $student->gender ?? '') === $gender): echo 'selected'; endif; ?>><?php echo e(__('students.fields.'.$gender)); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <?php $__errorArgs = ['gender'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'date_of_birth', 'type' => 'date', 'label' => __('students.fields.date_of_birth'), 'value' => isset($student) ? $student->date_of_birth->toDateString() : ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'admitted_on', 'type' => 'date', 'label' => __('students.fields.admitted_on'), 'value' => isset($student) ? $student->admitted_on->toDateString() : now()->toDateString()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    </div>
    <?php if (! ($editing)): ?>
        <h5 class="mt-2"><?php echo e(__('students.create.placement')); ?></h5>
        <p class="text-muted"><?php echo e(__('students.create.placement_hint')); ?></p>
        <?php echo $__env->make('students._placement', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
    <button type="submit" class="btn btn-primary"><?php echo e(__('students.save')); ?></button>
</form>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/_form.blade.php ENDPATH**/ ?>