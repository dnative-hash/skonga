<?php $__env->startSection('title', __('menu.exam_list')); ?>

<?php $__env->startSection('page'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('menu.exam_list')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('exams.exams.intro')); ?></p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Exam::class)): ?>
            <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-target="#exam-modal" data-bs-toggle="modal">
                <i class="ti ti-circle-plus me-1"></i><?php echo e(__('exams.exams.add')); ?>

            </button>
        <?php endif; ?>
    </div>
    <div class="card">
        <div class="card-body">
            <?php if($exams->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('exams.exams.empty')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead><tr>
                            <th><?php echo e(__('exams.exams.name')); ?></th><th><?php echo e(__('exams.exams.term')); ?></th><th><?php echo e(__('exams.exams.max_mark')); ?></th><th><?php echo e(__('exams.exams.scale')); ?></th><th></th>
                        </tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $exams; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $exam): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($exam->name); ?><?php if($exam->isLocked()): ?> <span class="badge bg-secondary ms-1"><?php echo e(__('exams.exams.locked')); ?></span><?php endif; ?></td>
                                    <td><?php echo e($exam->academicYear->name); ?> – <?php echo e($exam->term->name); ?></td>
                                    <td><?php echo e($exam->max_mark); ?></td>
                                    <td><?php echo e($exam->gradingScale->name); ?></td>
                                    <td class="text-end"><a href="<?php echo e(route('exams.show', $exam)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.open')); ?></a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Exam::class)): ?>
        <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'exam-modal','title' => ''.e(__('exams.exams.add')).'','action' => ''.e(route('exams.store')).'','size' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'exam-modal','title' => ''.e(__('exams.exams.add')).'','action' => ''.e(route('exams.store')).'','size' => 'modal-lg']); ?>
            <?php echo $__env->make('exams.exams._fields', ['exam' => null, 'years' => $years, 'scales' => $scales], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/exams/exams/index.blade.php ENDPATH**/ ?>