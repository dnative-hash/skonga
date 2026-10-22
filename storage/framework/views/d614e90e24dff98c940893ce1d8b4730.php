
<form action="<?php echo e($action); ?>" method="POST" class="d-inline" onsubmit="return confirm(<?php echo \Illuminate\Support\Js::from(__('academics.confirm_delete'))->toHtml() ?>)">
    <?php echo csrf_field(); ?>
    <?php echo method_field('DELETE'); ?>
    <button type="submit" class="btn btn-sm btn-outline-danger"><?php echo e(__('academics.delete')); ?></button>
</form>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/_delete.blade.php ENDPATH**/ ?>