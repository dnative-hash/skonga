<?php $__env->startSection('title', $class->name); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('academics.classes.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('menu.classes')); ?></a>
        <h3 class="page-title mt-2"><?php echo e($class->name); ?></h3>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3"><?php echo e(__('academics.classes.streams')); ?></h5>
            <?php if($streams->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('academics.streams.empty')); ?></p>
            <?php else: ?>
                <ul class="list-group">
                    <?php $__currentLoopData = $streams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stream): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <span class="fw-medium"><?php echo e($stream->name); ?></span>
                            <span>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $stream)): ?>
                                    <a href="<?php echo e(route('academics.streams.edit', $stream)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.edit')); ?></a>
                                <?php endif; ?>
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $stream)): ?>
                                    <?php echo $__env->make('academics._delete', ['action' => route('academics.streams.destroy', $stream)], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php endif; ?>
                            </span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Stream::class)): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-3"><?php echo e(__('academics.streams.add')); ?></h5>
                <form action="<?php echo e(route('academics.streams.store', $class)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('academics.streams.name'), 'hint' => __('academics.streams.name_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('academics.save')); ?></button>
                </form>
            </div>
        </div>
    <?php endif; ?>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $class)): ?>
        <a href="<?php echo e(route('academics.classes.edit', $class)); ?>" class="btn btn-outline-secondary"><?php echo e(__('academics.classes.edit')); ?></a>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/academics/classes/show.blade.php ENDPATH**/ ?>