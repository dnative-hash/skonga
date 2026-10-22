<?php $__env->startSection('title', __('menu.student_list')); ?>

<?php $__env->startSection('page'); ?>
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('menu.student_list')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('students.list.intro')); ?></p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Student::class)): ?>
            <div class="mt-2 mt-md-0 d-flex gap-2">
                <button type="button" class="btn btn-outline-primary" data-bs-target="#student-modal" data-bs-toggle="modal">
                    <i class="ti ti-circle-plus me-1"></i><?php echo e(__('students.create.title')); ?>

                </button>
                <a href="<?php echo e(route('students.import')); ?>" class="btn btn-outline-primary"><i class="ti ti-upload me-1"></i><?php echo e(__('students.list.import')); ?></a>
            </div>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-body">
            <form action="<?php echo e(route('students.search')); ?>" method="POST" class="d-flex gap-2 mb-1">
                <?php echo csrf_field(); ?>
                <input type="search" name="term" value="<?php echo e($term); ?>" class="form-control <?php $__errorArgs = ['term'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="<?php echo e(__('students.list.search_placeholder')); ?>" aria-label="<?php echo e(__('students.list.search_placeholder')); ?>" minlength="2" maxlength="100" required autocomplete="off">
                <button type="submit" class="btn btn-primary"><i class="ti ti-search me-1"></i><?php echo e(__('students.list.search')); ?></button>
            </form>
            <div class="form-text mb-3"><?php echo e(__('students.list.search_hint')); ?></div>
            <?php $__errorArgs = ['term'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mb-2"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

            <?php if($term === null): ?>
                <form action="<?php echo e(route('students.index')); ?>" method="GET" class="d-flex flex-wrap gap-2">
                    <select name="status" class="form-select w-auto" aria-label="<?php echo e(__('students.fields.status')); ?>">
                        <option value="active" <?php if(! $left): echo 'selected'; endif; ?>><?php echo e(__('students.list.active')); ?></option>
                        <option value="left" <?php if($left): echo 'selected'; endif; ?>><?php echo e(__('students.list.left')); ?></option>
                    </select>
                    <select name="class" class="form-select w-auto" aria-label="<?php echo e(__('students.fields.class')); ?>">
                        <option value=""><?php echo e(__('students.list.all_classes')); ?></option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>" <?php if($classId === $class->id): echo 'selected'; endif; ?>><?php echo e($class->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <button type="submit" class="btn btn-outline-secondary"><?php echo e(__('students.list.filter')); ?></button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php if($year === null): ?>
        <div class="alert alert-warning"><?php echo e(__('students.list.no_year')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <?php if($term !== null): ?>
                <h5 class="mb-3"><?php echo e(__('students.list.results_for', ['term' => $term])); ?></h5>
            <?php endif; ?>
            <?php if($students->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e($left ? __('students.list.empty_left') : __('students.list.empty')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead>
                            <tr>
                                <th><?php echo e(__('students.fields.admission_number')); ?></th>
                                <th><?php echo e(__('students.fields.name')); ?></th>
                                <th><?php echo e(__('students.fields.gender')); ?></th>
                                <th><?php echo e(__('students.fields.class')); ?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php ($placement = $placements[$student->id] ?? null); ?>
                                <tr>
                                    <td><?php echo e($student->admission_number); ?></td>
                                    <td class="fw-medium"><a href="<?php echo e(route('students.show', $student)); ?>"><?php echo e($student->fullName()); ?></a></td>
                                    <td><?php echo e(__('students.fields.'.$student->gender)); ?></td>
                                    <td>
                                        <?php if($placement): ?>
                                            <?php echo e($placement->schoolClass->name); ?><?php if($placement->stream): ?> – <?php echo e($placement->stream->name); ?><?php endif; ?>
                                        <?php elseif($year): ?>
                                            <span class="text-muted"><?php echo e(__('students.list.not_placed')); ?></span>
                                        <?php endif; ?>
                                        <?php if (! ($student->isActive())): ?> <span class="badge bg-secondary ms-1"><?php echo e(__('students.list.left')); ?></span> <?php endif; ?>
                                    </td>
                                    <td class="text-end"><a href="<?php echo e(route('students.show', $student)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('academics.open')); ?></a></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
                <?php if($students instanceof Illuminate\Contracts\Pagination\Paginator): ?>
                    <div class="mt-3"><?php echo e($students->links()); ?></div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Student::class)): ?>
        <?php if (isset($component)) { $__componentOriginaldf85e6552b95df616d59caebcbf2473d = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldf85e6552b95df616d59caebcbf2473d = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.form-modal','data' => ['id' => 'student-modal','title' => ''.e(__('students.create.title')).'','action' => ''.e(route('students.store')).'','size' => 'modal-lg']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('form-modal'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => 'student-modal','title' => ''.e(__('students.create.title')).'','action' => ''.e(route('students.store')).'','size' => 'modal-lg']); ?>
            <?php echo $__env->make('students._fields', [
                'student' => null,
                'years' => $years,
                'classes' => $classes,
                'streams' => $streams,
                'currentYearId' => $currentYearId,
                'admissionAuto' => $admissionAuto,
                'admissionNext' => $admissionNext,
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/index.blade.php ENDPATH**/ ?>