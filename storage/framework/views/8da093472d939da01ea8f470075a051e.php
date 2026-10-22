<?php $__env->startSection('title', __('custom_roles.title')); ?>

<?php $__env->startSection('page'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3 gap-2">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('custom_roles.title')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('custom_roles.intro')); ?></p>
        </div>
        <button type="button" class="btn btn-primary" data-bs-target="#role-modal" data-bs-toggle="modal">
            <i class="ti ti-circle-plus me-1"></i><?php echo e(__('custom_roles.add')); ?>

        </button>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger" role="alert"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div><?php echo e($error); ?></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead>
                        <tr>
                            <th><?php echo e(__('custom_roles.name')); ?></th>
                            <th><?php echo e(__('custom_roles.type')); ?></th>
                            <th><?php echo e(__('custom_roles.people')); ?></th>
                            <th><?php echo e(__('custom_roles.permissions')); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $roles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $role): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($default = App\Domain\Settings\RoleCatalog::isDefault($role->name)); ?>
                            <tr>
                                <td class="fw-medium"><?php echo e(App\Domain\Settings\RoleCatalog::label($role->name)); ?></td>
                                <td><span class="badge <?php echo e($default ? 'bg-light text-dark' : 'bg-success'); ?>"><?php echo e($default ? __('custom_roles.default') : __('custom_roles.custom')); ?></span></td>
                                <td><?php echo e($holders[$role->id] ?? 0); ?></td>
                                <td><?php echo e(__('custom_roles.permissions_count', ['count' => $role->permissions->count()])); ?></td>
                                <td class="text-end">
                                    <?php if (! ($default)): ?>
                                        <a href="<?php echo e(route('settings.roles.edit', $role->id)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('custom_roles.edit')); ?></a>
                                        <form action="<?php echo e(route('settings.roles.destroy', $role->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm(<?php echo \Illuminate\Support\Js::from(__('custom_roles.confirm_delete'))->toHtml() ?>)">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger"><?php echo e(__('custom_roles.delete')); ?></button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted fs-13"><?php echo e(__('custom_roles.default_locked')); ?></div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('settings.manage')): ?>
        <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'role-modal','title' => ''.e(__('custom_roles.add')).'','action' => ''.e(route('settings.roles.store')).'','size' => 'modal-xl']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'role-modal','title' => ''.e(__('custom_roles.add')).'','action' => ''.e(route('settings.roles.store')).'','size' => 'modal-xl']); ?>
            <?php echo $__env->make('settings.roles._fields', ['role' => null, 'groups' => $groups, 'implies' => $implies, 'copyFrom' => $copyFrom, 'chosen' => []], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/settings/roles/index.blade.php ENDPATH**/ ?>