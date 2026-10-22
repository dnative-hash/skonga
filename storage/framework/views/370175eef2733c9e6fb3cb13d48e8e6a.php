
<?php ($editing = isset($exam)); ?>
<?php ($frozen = $editing && ($hasMarks ?? false)); ?>
<?php $__errorArgs = ['exam'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<?php if($frozen): ?><div class="alert alert-info"><?php echo e(__('exams.exams.has_marks')); ?></div><?php endif; ?>
<div class="row">
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('exams.exams.name'), 'value' => $exam->name ?? '', 'hint' => __('exams.exams.name_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'max_mark', 'type' => 'number', 'label' => __('exams.exams.max_mark'), 'value' => $exam->max_mark ?? 100, 'hint' => __('exams.exams.max_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    <div class="col-md-6 mb-3">
        <label class="form-label" for="term_id"><?php echo e(__('exams.exams.term')); ?><span class="text-danger"> *</span></label>
        <select class="form-select <?php $__errorArgs = ['term_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="term_id" name="term_id" required <?php if($frozen): echo 'disabled'; endif; ?>>
            <option value=""><?php echo e(__('exams.choose')); ?></option>
            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <optgroup label="<?php echo e($year->name); ?>">
                    <?php $__currentLoopData = $year->terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($term->id); ?>" <?php if((string) old('term_id', $exam->term_id ?? '') === (string) $term->id): echo 'selected'; endif; ?>><?php echo e($year->name); ?> – <?php echo e($term->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </optgroup>
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
        <label class="form-label" for="grading_scale_id"><?php echo e(__('exams.exams.scale')); ?><span class="text-danger"> *</span></label>
        <select class="form-select <?php $__errorArgs = ['grading_scale_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="grading_scale_id" name="grading_scale_id" required <?php if($frozen): echo 'disabled'; endif; ?>>
            <option value=""><?php echo e(__('exams.choose')); ?></option>
            <?php $__currentLoopData = $scales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($scale->id); ?>" <?php if((string) old('grading_scale_id', $exam->grading_scale_id ?? '') === (string) $scale->id): echo 'selected'; endif; ?>><?php echo e($scale->name); ?></option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
        <div class="form-text"><?php echo e(__('exams.exams.scale_hint')); ?></div>
        <?php $__errorArgs = ['grading_scale_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
    </div>
</div>
<?php if($frozen): ?>
    
    <input type="hidden" name="term_id" value="<?php echo e($exam->term_id); ?>">
    <input type="hidden" name="grading_scale_id" value="<?php echo e($exam->grading_scale_id); ?>">
<?php endif; ?>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/exams/exams/_fields.blade.php ENDPATH**/ ?>