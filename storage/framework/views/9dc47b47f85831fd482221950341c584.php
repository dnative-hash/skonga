<?php $__env->startSection('title', __('menu.academic_years')); ?>

<?php $__env->startSection('page'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('menu.academic_years')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('academics.years.intro')); ?></p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\AcademicYear::class)): ?>
            <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-target="#year-modal" data-bs-toggle="modal">
                <i class="ti ti-circle-plus me-1"></i><?php echo e(__('academics.years.add')); ?>

            </button>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($years->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('academics.years.empty')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th><?php echo e(__('academics.years.name')); ?></th>
                                <th><?php echo e(__('academics.starts_on')); ?></th>
                                <th><?php echo e(__('academics.ends_on')); ?></th>
                                <th><?php echo e(__('academics.years.terms')); ?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td>
                                        <a href="<?php echo e(route('academics.years.show', $year)); ?>" class="fw-medium"><?php echo e($year->name); ?></a>
                                        <?php if($year->is_current): ?><span class="badge bg-success ms-2"><?php echo e(__('academics.years.current')); ?></span><?php endif; ?>
                                    </td>
                                    <td><?php echo e($year->starts_on->toFormattedDateString()); ?></td>
                                    <td><?php echo e($year->ends_on->toFormattedDateString()); ?></td>
                                    <td><?php echo e($year->terms_count); ?></td>
                                    <td class="text-end">
                                        <a href="<?php echo e(route('academics.years.show', $year)); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(__('academics.open')); ?></a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $year)): ?>
                                            <a href="<?php echo e(route('academics.years.edit', $year)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.edit')); ?></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $year)): ?>
                                            <?php echo $__env->make('academics._delete', ['action' => route('academics.years.destroy', $year)], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\AcademicYear::class)): ?>
        <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'year-modal','title' => ''.e(__('academics.years.add')).'','action' => ''.e(route('academics.years.store')).'','size' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'year-modal','title' => ''.e(__('academics.years.add')).'','action' => ''.e(route('academics.years.store')).'','size' => 'modal-lg']); ?>
            <?php echo $__env->make('academics.years._fields', ['year' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/years/index.blade.php ENDPATH**/ ?>