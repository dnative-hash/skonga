<?php $__env->startSection('title', __('menu.grading_scales')); ?>

<?php $__env->startSection('page'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('menu.grading_scales')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('exams.scales.intro')); ?></p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\GradingScale::class)): ?>
            <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-target="#scale-modal" data-bs-toggle="modal">
                <i class="ti ti-circle-plus me-1"></i><?php echo e(__('exams.scales.add')); ?>

            </button>
        <?php endif; ?>
    </div>

    <?php $__empty_1 = true; $__currentLoopData = $scales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
                    <div>
                        <h5 class="mb-1"><?php echo e($scale->name); ?></h5>
                        <span class="text-muted fs-13"><?php echo e(trans_choice('exams.scales.used_by', $scale->exams_count, ['count' => $scale->exams_count])); ?></span>
                    </div>
                    <div>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $scale)): ?>
                            <a href="<?php echo e(route('grading-scales.edit', $scale)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('exams.edit')); ?></a>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\GradingScale::class)): ?>
                            <form action="<?php echo e(route('grading-scales.copy', $scale)); ?>" method="POST" class="d-inline"><?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-sm btn-outline-secondary"><?php echo e(__('exams.scales.copy')); ?></button>
                            </form>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $scale)): ?>
                            <?php if($scale->exams_count === 0): ?>
                                <?php echo $__env->make('academics._delete', ['action' => route('grading-scales.destroy', $scale)], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <?php echo $__env->make('exams.scales._bands', ['bands' => $scale->bands], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card"><div class="card-body text-muted"><?php echo e(__('exams.scales.empty')); ?></div></div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\GradingScale::class)): ?>
        <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'scale-modal','title' => ''.e(__('exams.scales.add')).'','action' => ''.e(route('grading-scales.store')).'','size' => 'modal-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'scale-modal','title' => ''.e(__('exams.scales.add')).'','action' => ''.e(route('grading-scales.store')).'','size' => 'modal-xl']); ?>
            <?php echo $__env->make('exams.scales._fields', ['scale' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/exams/scales/index.blade.php ENDPATH**/ ?>