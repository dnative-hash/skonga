
<div class="row">
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('academics.classes.name'), 'value' => $class->name ?? '', 'hint' => __('academics.classes.name_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'sort_order', 'label' => __('academics.classes.sort_order'), 'type' => 'number', 'value' => $class->sort_order ?? 0, 'required' => false, 'hint' => __('academics.classes.sort_order_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
</div>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/classes/_fields.blade.php ENDPATH**/ ?>