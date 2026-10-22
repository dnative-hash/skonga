<?php $__env->startSection('title', $guardian->name); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('guardians.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('students.guardians.list.back')); ?></a>
        <h3 class="page-title mt-2 mb-1"><?php echo e($guardian->name); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('students.guardians.show.intro')); ?></p>
    </div>

    <div class="row g-3">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.guardians.form.personal')); ?></h5></div>
                <div class="card-body">
                    <div class="d-flex justify-content-between border-bottom pb-3 mb-3">
                        <span class="text-muted"><?php echo e(__('students.fields.phone')); ?></span>
                        <span class="fw-semibold text-dark"><?php echo e($guardian->phone); ?></span>
                    </div>
                    <div class="d-flex justify-content-between border-bottom pb-3 mb-3">
                        <span class="text-muted"><?php echo e(__('students.fields.email')); ?></span>
                        <span class="fw-semibold text-dark"><?php echo e($guardian->email); ?></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span class="text-muted"><?php echo e(__('students.guardians.list.joined')); ?></span>
                        <span class="fw-semibold text-dark"><?php echo e($guardian->created_at->toFormattedDateString()); ?></span>
                    </div>
                </div>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $guardian)): ?>
                    <div class="card-footer d-flex gap-2">
                        <a href="<?php echo e(route('guardians.index', ['edit' => $guardian->id])); ?>" class="btn btn-primary"><i class="ti ti-edit me-1"></i><?php echo e(__('students.guardians.list.edit')); ?></a>
                        <?php if($guardian->students->isEmpty()): ?>
                            <form method="POST" action="<?php echo e(route('guardians.destroy', $guardian)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger"><i class="ti ti-trash me-1"></i><?php echo e(__('students.guardians.list.delete')); ?></button>
                            </form>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <div class="col-lg-8">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('managePortal', $guardian)): ?>
                <div class="card">
                    <div class="card-header"><h5 class="mb-0"><?php echo e(__('family.access.title')); ?></h5></div>
                    <div class="card-body">
                        <?php $__errorArgs = ['portal'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <p class="text-muted"><?php echo e(__('family.access.hint')); ?></p>
                        <?php if($guardian->hasPortalAccess()): ?>
                            <p class="mb-3"><span class="badge bg-success"><?php echo e(__('family.access.has')); ?></span></p>
                            <form method="POST" action="<?php echo e(route('guardians.portal.destroy', $guardian)); ?>">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-outline-danger"><?php echo e(__('family.access.revoke')); ?></button>
                            </form>
                        <?php elseif(blank($guardian->email)): ?>
                            <p class="text-danger mb-0"><?php echo e(__('family.errors.no_email')); ?></p>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('guardians.portal.store', $guardian)); ?>">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="btn btn-primary"><?php echo e(__('family.access.give')); ?></button>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.guardians.list.children')); ?></h5></div>
                <div class="card-body">
                    <?php if($students->isEmpty()): ?>
                        <p class="text-muted mb-0"><?php echo e(__('students.guardians.show.no_children')); ?></p>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th><?php echo e(__('students.fields.name')); ?></th>
                                        <th><?php echo e(__('students.fields.class')); ?></th>
                                        <th><?php echo e(__('students.fields.relationship')); ?></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php ($placement = $placements[$child->id] ?? null); ?>
                                        <tr>
                                            <td class="fw-medium"><a href="<?php echo e(route('students.show', $child)); ?>"><?php echo e($child->fullName()); ?></a></td>
                                            <td>
                                                <?php if($placement): ?>
                                                    <?php echo e($placement->schoolClass->name); ?><?php if($placement->stream): ?> – <?php echo e($placement->stream->name); ?><?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-muted"><?php echo e(__('students.guardians.show.not_placed')); ?></span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?php echo e(__('students.relationships.'.$child->pivot->relationship)); ?></td>
                                            <td class="text-end">
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $guardian)): ?>
                                                    <form method="POST" action="<?php echo e(route('guardians.students.destroy', [$guardian, $child])); ?>">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button type="submit" class="btn btn-sm btn-outline-danger"><i class="ti ti-trash me-1"></i><?php echo e(__('students.guardians.list.unlink')); ?></button>
                                                    </form>
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

            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Guardian::class)): ?>
                <div class="card">
                    <div class="card-header"><h5 class="mb-0"><?php echo e(__('students.guardians.show.add_child')); ?></h5></div>
                    <div class="card-body">
                        <?php if($candidates->isEmpty()): ?>
                            <p class="text-muted mb-0"><?php echo e(__('students.guardians.show.no_candidates')); ?></p>
                        <?php else: ?>
                            <form method="POST" action="<?php echo e(route('guardians.students.store', $guardian)); ?>" class="row g-3 align-items-end">
                                <?php echo csrf_field(); ?>
                                <div class="col-md-5">
                                    <label class="form-label" for="student_id"><?php echo e(__('students.guardians.show.pupil')); ?></label>
                                    <select id="student_id" name="student_id" class="form-select <?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <option value=""><?php echo e(__('students.guardians.show.choose_pupil')); ?></option>
                                        <?php $__currentLoopData = $candidates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $candidate): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($candidate->id); ?>" <?php if(old('student_id') == $candidate->id): echo 'selected'; endif; ?>><?php echo e($candidate->fullName()); ?> (<?php echo e($candidate->admission_number); ?>)</option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                    <?php $__errorArgs = ['student_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" for="relationship"><?php echo e(__('students.fields.relationship')); ?></label>
                                    <select id="relationship" name="relationship" class="form-select <?php $__errorArgs = ['relationship'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" required>
                                        <?php $__currentLoopData = ['father', 'mother', 'guardian', 'other']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $relationship): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($relationship); ?>" <?php if(old('relationship', 'guardian') === $relationship): echo 'selected'; endif; ?>><?php echo e(__('students.relationships.'.$relationship)); ?></option>
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
                                <div class="col-md-2">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="is_primary" name="is_primary" value="1" <?php if(old('is_primary')): echo 'checked'; endif; ?>>
                                        <label class="form-check-label" for="is_primary"><?php echo e(__('students.fields.is_primary')); ?></label>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary w-100"><i class="ti ti-link me-1"></i><?php echo e(__('students.guardians.show.link')); ?></button>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/guardians/show.blade.php ENDPATH**/ ?>