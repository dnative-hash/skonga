<?php $__env->startSection('title', $year->name); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('academics.years.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('menu.academic_years')); ?></a>
        <h3 class="page-title mt-2 mb-1">
            <?php echo e($year->name); ?>

            <?php if($year->is_current): ?><span class="badge bg-success ms-2"><?php echo e(__('academics.years.current')); ?></span><?php endif; ?>
        </h3>
        <p class="text-muted mb-0"><?php echo e($year->starts_on->toFormattedDateString()); ?> – <?php echo e($year->ends_on->toFormattedDateString()); ?></p>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3"><?php echo e(__('academics.years.terms')); ?></h5>
            <?php if($terms->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('academics.terms.empty')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th><?php echo e(__('academics.terms.name')); ?></th>
                                <th><?php echo e(__('academics.starts_on')); ?></th>
                                <th><?php echo e(__('academics.ends_on')); ?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $terms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $term): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($term->name); ?></td>
                                    <td><?php echo e($term->starts_on->toFormattedDateString()); ?></td>
                                    <td><?php echo e($term->ends_on->toFormattedDateString()); ?></td>
                                    <td class="text-end">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $term)): ?>
                                            <a href="<?php echo e(route('academics.terms.edit', $term)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.edit')); ?></a>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $term)): ?>
                                            <?php echo $__env->make('academics._delete', ['action' => route('academics.terms.destroy', $term)], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Term::class)): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3"><?php echo e(__('academics.terms.add')); ?></h5>
                <form action="<?php echo e(route('academics.terms.store', $year)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('academics.terms.name'), 'hint' => __('academics.terms.name_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'starts_on', 'label' => __('academics.starts_on'), 'type' => 'date'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                        <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'ends_on', 'label' => __('academics.ends_on'), 'type' => 'date'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('academics.save')); ?></button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $year)): ?>
        <a href="<?php echo e(route('academics.years.edit', $year)); ?>" class="btn btn-outline-secondary"><?php echo e(__('academics.years.edit')); ?></a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/years/show.blade.php ENDPATH**/ ?>