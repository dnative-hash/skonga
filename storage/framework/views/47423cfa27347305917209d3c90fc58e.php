<?php $__env->startSection('title', $student->fullName()); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('students.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('menu.student_list')); ?></a>
        <div class="d-flex justify-content-between align-items-start mt-2">
            <h3 class="page-title mb-0"><?php echo e($student->fullName()); ?></h3>
            <div class="d-flex gap-2">
                <?php if($student->isActive()): ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('printIdCard', App\Models\Student::class)): ?>
                        <a href="<?php echo e(route('students.id-card', $student)); ?>" target="_blank" class="btn btn-sm btn-outline-primary"><i class="ti ti-id-badge-2 me-1"></i><?php echo e(__('idcard.button')); ?></a>
                    <?php endif; ?>
                <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $student)): ?>
                    <a href="<?php echo e(route('students.edit', $student)); ?>" class="btn btn-sm btn-outline-secondary"><?php echo e(__('students.edit')); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (! ($student->isActive())): ?>
        <div class="alert alert-warning">
            <?php echo e(__('students.show.left_notice', ['date' => $student->left_on?->toDateString()])); ?>

            <?php if($student->left_reason): ?> <br><?php echo e($student->left_reason); ?> <?php endif; ?>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3"><?php echo e(__('students.show.details')); ?></h5>
            <dl class="row mb-0">
                <dt class="col-sm-4"><?php echo e(__('students.fields.admission_number')); ?></dt><dd class="col-sm-8"><?php echo e($student->admission_number); ?></dd>
                <dt class="col-sm-4"><?php echo e(__('students.fields.gender')); ?></dt><dd class="col-sm-8"><?php echo e(__('students.fields.'.$student->gender)); ?></dd>
                <dt class="col-sm-4"><?php echo e(__('students.fields.date_of_birth')); ?></dt><dd class="col-sm-8"><?php echo e($student->date_of_birth->toDateString()); ?></dd>
                <dt class="col-sm-4"><?php echo e(__('students.fields.admitted_on')); ?></dt><dd class="col-sm-8"><?php echo e($student->admitted_on->toDateString()); ?></dd>
            </dl>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewReport', $student)): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-1"><?php echo e(__('students.show.reports')); ?></h5>
                <?php $__empty_1 = true; $__currentLoopData = $reportTerms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $reportTerm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <a class="btn btn-sm btn-outline-secondary me-1 mt-2" href="<?php echo e(route('students.report', [$student, $reportTerm])); ?>"><?php echo e($reportTerm->academicYear->name); ?> – <?php echo e($reportTerm->name); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-muted mb-0"><?php echo e(__('students.show.no_reports')); ?></p>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-1"><?php echo e(__('students.show.history')); ?></h5>
            <p class="text-muted"><?php echo e(__('students.show.history_hint')); ?></p>
            <?php if($history->isEmpty()): ?>
                <p class="text-muted mb-0"><?php echo e(__('students.show.no_history')); ?></p>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table align-middle mb-0">
                        <thead><tr>
                            <th><?php echo e(__('students.fields.year')); ?></th><th><?php echo e(__('students.fields.class')); ?></th><th><?php echo e(__('students.fields.stream')); ?></th><th><?php echo e(__('students.fields.since')); ?></th>
                        </tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $history; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($row->academicYear->name); ?></td>
                                    <td><?php echo e($row->schoolClass->name); ?></td>
                                    <td><?php echo e($row->stream?->name); ?></td>
                                    <td><?php echo e($row->enrolled_on->toDateString()); ?></td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $student)): ?>
        <?php if($student->isActive()): ?>
            <div class="card">
                <div class="card-body">
                    <h5 class="mb-1"><?php echo e(__('students.show.place')); ?></h5>
                    <p class="text-muted"><?php echo e(__('students.show.place_hint')); ?></p>
                    <form action="<?php echo e(route('students.enrollments.store', $student)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo $__env->make('students._placement', ['required' => true], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php echo $__env->make('academics._field', ['name' => 'enrolled_on', 'type' => 'date', 'label' => __('students.fields.since'), 'value' => now()->toDateString()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('students.save')); ?></button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <h5 class="mb-3"><?php echo e(__('students.show.guardians')); ?></h5>
            <?php if($guardians->isEmpty()): ?>
                <p class="text-muted"><?php echo e(__('students.show.no_guardians')); ?></p>
            <?php else: ?>
                <div class="table-responsive mb-3">
                    <table class="table align-middle mb-0">
                        <thead><tr>
                            <th><?php echo e(__('students.fields.name')); ?></th><th><?php echo e(__('students.fields.relationship')); ?></th><th><?php echo e(__('students.fields.phone')); ?></th><th><?php echo e(__('students.fields.email')); ?></th><th></th>
                        </tr></thead>
                        <tbody>
                            <?php $__currentLoopData = $guardians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guardian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($guardian->name); ?><?php if($guardian->pivot->is_primary): ?> <span class="badge bg-primary ms-1"><?php echo e(__('students.fields.is_primary')); ?></span><?php endif; ?></td>
                                    <td><?php echo e(__('students.relationships.'.$guardian->pivot->relationship)); ?></td>
                                    <td><?php echo e($guardian->phone); ?></td>
                                    <td><?php echo e($guardian->email); ?></td>
                                    <td class="text-end">
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $student)): ?>
                                            <form action="<?php echo e(route('students.guardians.destroy', [$student, $guardian])); ?>" method="POST" class="d-inline" onsubmit="return confirm(<?php echo \Illuminate\Support\Js::from(__('students.confirm_remove'))->toHtml() ?>)">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-outline-danger"><?php echo e(__('students.remove')); ?></button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $student)): ?>
                <h6 class="mt-3"><?php echo e(__('students.show.add_guardian')); ?></h6>
                <form action="<?php echo e(route('students.guardians.store', $student)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('students.fields.name'), 'value' => ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                        <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'phone', 'type' => 'tel', 'label' => __('students.fields.phone'), 'value' => '', 'hint' => __('students.fields.phone_hint')], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                        <div class="col-md-6"><?php echo $__env->make('academics._field', ['name' => 'email', 'type' => 'email', 'label' => __('students.fields.email'), 'value' => '', 'required' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label" for="relationship"><?php echo e(__('students.fields.relationship')); ?><span class="text-danger"> *</span></label>
                            <select class="form-select <?php $__errorArgs = ['relationship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="relationship" name="relationship" required>
                                <?php $__currentLoopData = ['father', 'mother', 'guardian', 'other']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kind): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kind); ?>" <?php if(old('relationship') === $kind): echo 'selected'; endif; ?>><?php echo e(__('students.relationships.'.$kind)); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['relationship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>
                    <div class="form-check mb-3">
                        <input type="hidden" name="is_primary" value="0">
                        <input class="form-check-input" type="checkbox" id="is_primary" name="is_primary" value="1" <?php if(old('is_primary')): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="is_primary"><?php echo e(__('students.fields.is_primary')); ?></label>
                    </div>
                    <button type="submit" class="btn btn-primary"><?php echo e(__('students.save')); ?></button>
                </form>
            <?php endif; ?>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $student)): ?>
        <div class="card">
            <div class="card-body">
                <?php if($student->isActive()): ?>
                    <h5 class="mb-1"><?php echo e(__('students.show.leave')); ?></h5>
                    <p class="text-muted"><?php echo e(__('students.show.leave_hint')); ?></p>
                    <form action="<?php echo e(route('students.leave', $student)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <div class="row">
                            <div class="col-md-4"><?php echo $__env->make('academics._field', ['name' => 'left_on', 'type' => 'date', 'label' => __('students.fields.left_on'), 'value' => now()->toDateString()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                            <div class="col-md-8"><?php echo $__env->make('academics._field', ['name' => 'left_reason', 'label' => __('students.fields.left_reason'), 'value' => '', 'required' => false], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></div>
                        </div>
                        <button type="submit" class="btn btn-outline-danger"><?php echo e(__('students.show.leave')); ?></button>
                    </form>
                <?php else: ?>
                    <form action="<?php echo e(route('students.reinstate', $student)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="btn btn-primary"><?php echo e(__('students.show.reinstate')); ?></button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/show.blade.php ENDPATH**/ ?>