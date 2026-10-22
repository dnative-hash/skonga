
<?php ($editing = isset($class)); ?>
<form action="<?php echo e($editing ? route('academics.classes.update', $class) : route('academics.classes.store')); ?>" method="POST">
    <?php echo csrf_field(); ?>
    <?php if($editing): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <?php echo $__env->make('academics.classes._fields', ['class' => $class], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <button type="submit" class="btn btn-primary"><?php echo e(__('academics.save')); ?></button>
</form>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/classes/_form.blade.php ENDPATH**/ ?>