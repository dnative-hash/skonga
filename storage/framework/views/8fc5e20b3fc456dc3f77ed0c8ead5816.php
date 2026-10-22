<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'id',
    'title',
    'action',
    'method' => 'POST',
    'submit' => null,
    'size' => '',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'id',
    'title',
    'action',
    'method' => 'POST',
    'submit' => null,
    'size' => '',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>


<div aria-hidden="true" class="modal fade" id="<?php echo e($id); ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered <?php echo e($size); ?>">
        <div class="modal-content">
            <div class="modal-header">
                <div class="page-title"><h4><?php echo e($title); ?></h4></div>
                <button aria-label="<?php echo e(__('app.close')); ?>" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" type="button">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?php echo e($action); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <?php if($method !== 'POST'): ?>
                    <input name="_method" type="hidden" value="<?php echo e($method); ?>">
                <?php endif; ?>
                <input name="form" type="hidden" value="<?php echo e($id); ?>">
                <div class="modal-body">
                    <?php echo e($slot); ?>

                </div>
                <div class="modal-footer">
                    <button class="btn me-2 btn-secondary" data-bs-dismiss="modal" type="button"><?php echo e(__('app.cancel')); ?></button>
                    <button class="btn btn-primary" type="submit"><?php echo e($submit ?? __('app.save')); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/components/form-modal.blade.php ENDPATH**/ ?>