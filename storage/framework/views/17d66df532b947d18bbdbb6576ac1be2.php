<?php $__env->startSection('title', __('students.import.title')); ?>

<?php $__env->startSection('page'); ?>
    <?php ($result = session('import_result')); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('students.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('students.import.back')); ?></a>
        <h3 class="page-title mt-2 mb-1"><?php echo e(__('students.import.title')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('students.import.hint')); ?></p>
    </div>

    <?php if($result): ?>
        <div class="alert alert-success" role="status">
            <strong><?php echo e(__('students.import.done')); ?></strong>
            <?php echo e(__('students.import.summary', ['created' => $result['created'], 'placed' => $result['placed'], 'guardians' => $result['guardians']])); ?>

        </div>
    <?php endif; ?>

    <?php if(session('import_problems')): ?>
        <div class="alert alert-danger" role="alert">
            <strong><?php echo e(__('students.import.refused', ['count' => session('import_total')])); ?></strong>
            <ul class="mb-0 mt-2">
                <?php $__currentLoopData = session('import_problems'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $problem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($problem); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <?php if(session('import_total') > count(session('import_problems'))): ?>
                <div class="mt-2"><?php echo e(__('students.import.and_more', ['count' => session('import_total') - count(session('import_problems'))])); ?></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger" role="alert"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
    <?php endif; ?>

    <?php if($year === null): ?>
        <div class="alert alert-warning"><?php echo e(__('students.import.no_year')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.import.step1')); ?></h5></div>
        <div class="card-body">
            <p><?php echo e(__('students.import.step1_text')); ?></p>
            <a href="<?php echo e(route('students.import.template')); ?>" class="btn btn-outline-primary"><i class="ti ti-download me-1"></i><?php echo e(__('students.import.template')); ?></a>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.import.step2')); ?></h5></div>
        <div class="card-body">
            <form method="POST" action="<?php echo e(route('students.import.store')); ?>" enctype="multipart/form-data" class="d-flex flex-wrap gap-2 align-items-end">
                <?php echo csrf_field(); ?>
                <div>
                    <label class="form-label" for="file"><?php echo e(__('students.import.file')); ?></label>
                    <input type="file" id="file" name="file" accept=".csv,text/csv,text/plain" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary"><i class="ti ti-upload me-1"></i><?php echo e(__('students.import.upload')); ?></button>
            </form>
            <small class="text-muted d-block mt-2"><?php echo e(__('students.import.rules', ['max' => $max])); ?></small>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.import.columns')); ?></h5></div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table mb-0">
                    <tbody>
                        <?php $__currentLoopData = $columns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $column): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="fw-semibold"><code><?php echo e($column); ?></code><?php if(in_array($column, $required, true)): ?><span class="text-danger ms-1">*</span><?php endif; ?></td>
                                <td><?php echo e(__('students.import.col.'.($column === 'admission_number' && $auto ? 'admission_number_auto' : $column))); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.import.classes_in_school')); ?></h5></div>
        <div class="card-body">
            <?php if($classes->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('students.import.no_classes')); ?></p>
            <?php else: ?>
                <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span class="badge bg-light text-dark me-1"><?php echo e($class->name); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/import.blade.php ENDPATH**/ ?>