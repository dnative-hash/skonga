
<?php ($editing = isset($year)); ?>
<form action="<?php echo e($editing ? route('academics.years.update', $year) : route('academics.years.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="row">
        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('academics.years.name'), 'value' => $year->name ?? '', 'hint' => __('academics.years.name_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'starts_on', 'label' => __('academics.starts_on'), 'type' => 'date', 'value' => isset($year) ? $year->starts_on->toDateString() : ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'ends_on', 'label' => __('academics.ends_on'), 'type' => 'date', 'value' => isset($year) ? $year->ends_on->toDateString() : ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    </div>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_current" id="is_current" value="1" <?php if(old('is_current', $year->is_current ?? false)): echo 'checked'; endif; ?>>
        <label class="form-check-label" for="is_current"><?php echo e(__('academics.years.is_current')); ?></label>
        <div class="form-text"><?php echo e(__('academics.years.is_current_hint')); ?></div>
    </div>
    <button type="submit" class="btn btn-primary"><?php echo e(__('academics.save')); ?></button>
</form>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/years/_form.blade.php ENDPATH**/ ?>