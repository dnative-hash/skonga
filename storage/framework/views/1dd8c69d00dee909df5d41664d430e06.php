<?php $__env->startSection('title', __('menu.fee_structures')); ?>

<?php $__env->startSection('page'); ?>
    <?php ($currency = app(App\Tenancy\TenantContext::class)->current()?->currency ?? App\Support\Money::DEFAULT_CURRENCY); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('menu.fee_structures')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('fees.structures.intro')); ?></p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\FeeStructure::class)): ?>
            <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-target="#structure-modal" data-bs-toggle="modal">
                <i class="ti ti-circle-plus me-1"></i><?php echo e(__('fees.structures.add')); ?>

            </button>
        <?php endif; ?>
    </div>
    <div class="card">
        <div class="card-body">
            <?php if($structures->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('fees.structures.empty')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead><tr>
                            <th><?php echo e(__('fees.structures.name')); ?></th><th><?php echo e(__('fees.structures.term')); ?></th><th><?php echo e(__('fees.structures.class')); ?></th><th><?php echo e(__('fees.structures.total')); ?></th><th><?php echo e(__('fees.structures.invoices')); ?></th><th></th>
                        </tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $structures; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $structure): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($structure->name); ?></td>
                                    <td><?php echo e($structure->term->academicYear->name); ?> – <?php echo e($structure->term->name); ?></td>
                                    <td><?php echo e($structure->schoolClass->name); ?></td>
                                    <td><?php echo e(App\Support\Money::of($structure->total(), $currency)->format()); ?></td>
                                    <td><?php echo e($structure->invoices_count); ?></td>
                                    <td class="text-end"><a href="<?php echo e(route('fees.structures.show', $structure)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.open')); ?></a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\FeeStructure::class)): ?>
        <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'structure-modal','title' => ''.e(__('fees.structures.add')).'','action' => ''.e(route('fees.structures.store')).'','size' => 'modal-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'structure-modal','title' => ''.e(__('fees.structures.add')).'','action' => ''.e(route('fees.structures.store')).'','size' => 'modal-xl']); ?>
            <?php echo $__env->make('fees.structures._fields', ['structure' => null, 'terms' => $terms, 'classes' => $classes], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
         <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldf85e6552b95df616d59caebcbf2473d)): ?>
<?php $attributes = $__attributesOriginaldf85e6552b95df616d59caebcbf2473d; ?>
<?php unset($__attributesOriginaldf85e6552b95df616d59caebcbf2473d); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldf85e6552b95df616d59caebcbf2473d)): ?>
<?php $component = $__componentOriginaldf85e6552b95df616d59caebcbf2473d; ?>
<?php unset($__componentOriginaldf85e6552b95df616d59caebcbf2473d); ?>
<?php endif; ?>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/fees/structures/index.blade.php ENDPATH**/ ?>