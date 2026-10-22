<?php $__env->startSection('title', __('custom_roles.users.title')); ?>

<?php $__env->startSection('page'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3 gap-2">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('custom_roles.users.title')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('custom_roles.users.intro')); ?></p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-target="#user-modal" data-bs-toggle="modal">
            <i class="ti ti-circle-plus me-1"></i><?php echo e(__('custom_roles.users.add')); ?>

        </button>
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead><tr><th><?php echo e(__('custom_roles.users.name')); ?></th><th><?php echo e(__('custom_roles.users.email')); ?></th><th><?php echo e(__('custom_roles.users.role')); ?></th><th></th></tr></thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-medium"><?php echo e($user->name); ?></td>
                                <td><?php echo e($user->email); ?></td>
                                <td><?php $__currentLoopData = $user->getRoleNames(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span class="badge bg-light text-dark"><?php echo e(App\Domain\Settings\RoleCatalog::label($name)); ?></span> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></td>
                                <td class="text-end"><a href="<?php echo e(route('settings.users.edit', $user->id)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('custom_roles.users.edit')); ?></a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="4" class="text-muted"><?php echo e(__('custom_roles.users.empty')); ?></td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'user-modal','title' => ''.e(__('custom_roles.users.add')).'','action' => ''.e(route('settings.users.store')).'','size' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'user-modal','title' => ''.e(__('custom_roles.users.add')).'','action' => ''.e(route('settings.users.store')).'','size' => 'modal-lg']); ?>
        <?php echo $__env->make('settings.users._fields', ['user' => null, 'roles' => $roles], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/settings/users/index.blade.php ENDPATH**/ ?>