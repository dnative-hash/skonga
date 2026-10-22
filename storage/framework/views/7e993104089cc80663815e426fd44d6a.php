<?php $__env->startSection('title', __('menu.classes')); ?>

<?php $__env->startSection('page'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('menu.classes')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('academics.classes.intro')); ?></p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\SchoolClass::class)): ?>
            <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-target="#class-modal" data-bs-toggle="modal">
                <i class="ti ti-circle-plus me-1"></i><?php echo e(__('academics.classes.add')); ?>

            </button>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-body">
            <?php if($classes->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('academics.classes.empty')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th><?php echo e(__('academics.classes.name')); ?></th>
                                <th><?php echo e(__('academics.classes.streams')); ?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a href="<?php echo e(route('academics.classes.show', $class)); ?>" class="fw-medium"><?php echo e($class->name); ?></a></td>
                                    <td><?php echo e($class->streams_count); ?></td>
                                    <td class="text-end">
                                        <a href="<?php echo e(route('academics.classes.show', $class)); ?>" class="btn btn-sm btn-outline-primary"><?php echo e(__('academics.open')); ?></a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $class)): ?>
                                            <a href="<?php echo e(route('academics.classes.edit', $class)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.edit')); ?></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $class)): ?>
                                            <?php echo $__env->make('academics._delete', ['action' => route('academics.classes.destroy', $class)], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\SchoolClass::class)): ?>
        <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'class-modal','title' => ''.e(__('academics.classes.add')).'','action' => ''.e(route('academics.classes.store')).'','size' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'class-modal','title' => ''.e(__('academics.classes.add')).'','action' => ''.e(route('academics.classes.store')).'','size' => 'modal-lg']); ?>
            <?php echo $__env->make('academics.classes._fields', ['class' => null], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/classes/index.blade.php ENDPATH**/ ?>