
<div class="row">
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('academics.subjects.name'), 'value' => $subject->name ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
    <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'code', 'label' => __('academics.subjects.code'), 'value' => $subject->code ?? '', 'required' => false, 'hint' => __('academics.subjects.code_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
</div>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/subjects/_fields.blade.php ENDPATH**/ ?>