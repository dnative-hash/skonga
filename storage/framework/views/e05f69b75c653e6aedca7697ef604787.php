<?php $__env->startSection('title', __('menu.guardians')); ?>

<?php $__env->startSection('page'); ?>
    <?php
        // The pop-up opens on its own when the form was refused, when the page was opened
        // to change one guardian (the button on the page of a guardian) or to add one
        // (the entry of the menu).
        $editing = null;
        if (! $errors->any() && request()->filled('edit')) {
            $editing = \App\Models\Guardian::query()->whereKey((int) request('edit'))->first();
        }
        $adding = request()->filled('add') && $editing === null;
    ?>

    <div class="d-flex flex-wrap justify-content-between align-items-start mb-3">
        <div>
            <h3 class="page-title mb-1"><?php echo e(__('menu.guardians')); ?></h3>
            <p class="text-muted mb-0"><?php echo e(__('students.guardians.list.intro')); ?></p>
        </div>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Guardian::class)): ?>
            <button type="button" class="btn btn-primary mt-2 mt-md-0" data-bs-target="#guardian-modal" data-bs-toggle="modal">
                <i class="ti ti-circle-plus me-1"></i><?php echo e(__('students.guardians.list.add')); ?>

            </button>
        <?php endif; ?>
    </div>

    <div class="card">
        <div class="card-header d-flex align-items-center justify-content-between flex-wrap row-gap-3">
            <div class="search-set">
                <div class="search-input">
                    <span class="btn-searchset"><i class="ti ti-search fs-14 feather-search"></i></span>
                </div>
            </div>
            <div class="d-flex align-items-center flex-wrap gap-2"></div>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="datatable table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php echo e(__('students.fields.name')); ?></th>
                            <th><?php echo e(__('students.guardians.list.children')); ?></th>
                            <th><?php echo e(__('students.fields.phone')); ?></th>
                            <th><?php echo e(__('students.fields.email')); ?></th>
                            <th><?php echo e(__('students.guardians.list.joined')); ?></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $guardians; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $guardian): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="text-muted"><?php echo e($loop->iteration); ?></td>
                                <td class="fw-medium">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="avatar avatar-md bg-light text-dark fw-semibold"><?php echo e(mb_strtoupper(mb_substr($guardian->name, 0, 1))); ?></span>
                                        <a href="<?php echo e(route('guardians.show', $guardian)); ?>"><?php echo e($guardian->name); ?></a>
                                    </div>
                                </td>
                                <td>
                                    <?php if($guardian->students->isEmpty()): ?>
                                        <span class="text-muted"><?php echo e(__('students.guardians.list.no_children')); ?></span>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $guardian->students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php ($placement = $placements[$child->id] ?? null); ?>
                                            <div>
                                                <a href="<?php echo e(route('students.show', $child)); ?>"><?php echo e($child->fullName()); ?></a>
                                                <?php if($placement): ?>
                                                    <span class="text-muted fs-12"><?php echo e($placement->schoolClass->name); ?><?php if($placement->stream): ?> – <?php echo e($placement->stream->name); ?><?php endif; ?></span>
                                                <?php endif; ?>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($guardian->phone); ?></td>
                                <td><?php echo e($guardian->email); ?></td>
                                <td class="text-muted"><?php echo e($guardian->created_at->toFormattedDateString()); ?></td>
                                <td class="text-end">
                                    <div class="d-flex gap-2 justify-content-end">
                                        <a href="<?php echo e(route('guardians.show', $guardian)); ?>" class="btn btn-sm btn-outline-secondary" title="<?php echo e(__('academics.open')); ?>"><i class="ti ti-eye"></i></a>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $guardian)): ?>
                                            <button type="button" class="btn btn-sm btn-outline-secondary" title="<?php echo e(__('students.guardians.list.edit')); ?>"
                                                data-bs-target="#guardian-modal" data-bs-toggle="modal"
                                                data-guardian-action="<?php echo e(route('guardians.update', $guardian)); ?>"
                                                data-guardian-title="<?php echo e(__('students.guardians.list.edit')); ?>"
                                                data-guardian-submit="<?php echo e(__('students.guardians.form.save')); ?>"
                                                data-guardian-name="<?php echo e($guardian->name); ?>"
                                                data-guardian-phone="<?php echo e($guardian->phone); ?>"
                                                data-guardian-email="<?php echo e($guardian->email); ?>">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4"><?php echo e(__('students.guardians.list.empty')); ?></td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Guardian::class)): ?>
        <div aria-hidden="true" class="modal fade" id="guardian-modal" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="page-title"><h4 data-guardian-heading><?php echo e(__('students.guardians.list.add')); ?></h4></div>
                        <button aria-label="<?php echo e(__('students.guardians.form.close')); ?>" class="close bg-danger text-white fs-16" data-bs-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form action="<?php echo e(route('guardians.store')); ?>" method="POST"
                        data-guardian-form
                        data-guardian-open="<?php echo e(($errors->any() || $editing !== null || $adding) ? '1' : '0'); ?>"
                        data-guardian-old-name="<?php echo e(old('name')); ?>"
                        data-guardian-old-phone="<?php echo e(old('phone')); ?>"
                        data-guardian-old-email="<?php echo e(old('email')); ?>"
                        data-guardian-add-action="<?php echo e(route('guardians.store')); ?>"
                        data-guardian-add-title="<?php echo e(__('students.guardians.list.add')); ?>"
                        data-guardian-add-submit="<?php echo e(__('students.guardians.list.add')); ?>"
                        data-guardian-edit-action="<?php echo e($editing ? route('guardians.update', $editing) : ''); ?>"
                        data-guardian-edit-title="<?php echo e(__('students.guardians.list.edit')); ?>"
                        data-guardian-edit-submit="<?php echo e(__('students.guardians.form.save')); ?>"
                        data-guardian-edit-name="<?php echo e($editing?->name); ?>"
                        data-guardian-edit-phone="<?php echo e($editing?->phone); ?>"
                        data-guardian-edit-email="<?php echo e($editing?->email); ?>">
                        <?php echo csrf_field(); ?>
                        <input name="_method" type="hidden" value="">
                        <div class="modal-body">
                            <?php if($errors->any()): ?>
                                <div class="alert alert-danger" role="alert"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
                            <?php endif; ?>
                            <div class="row">
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="guardian-name"><?php echo e(__('students.fields.name')); ?><span class="text-danger ms-1">*</span></label>
                                    <input type="text" id="guardian-name" name="name" value="<?php echo e(old('name')); ?>" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="150" required>
                                </div>
                                <div class="col-12 mb-3">
                                    <label class="form-label" for="guardian-phone"><?php echo e(__('students.fields.phone')); ?><span class="text-danger ms-1">*</span></label>
                                    <input type="tel" id="guardian-phone" name="phone" value="<?php echo e(old('phone')); ?>" class="form-control <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="30" required>
                                </div>
                                <div class="col-12">
                                    <label class="form-label" for="guardian-email"><?php echo e(__('students.fields.email')); ?></label>
                                    <input type="email" id="guardian-email" name="email" value="<?php echo e(old('email')); ?>" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" maxlength="150">
                                    <div class="form-text"><?php echo e(__('students.guardians.form.only_what_is_needed')); ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn me-2 btn-secondary" data-bs-dismiss="modal" type="button"><?php echo e(__('students.guardians.form.cancel')); ?></button>
                            <button class="btn btn-primary" data-guardian-submit type="submit"><?php echo e(__('students.guardians.list.add')); ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php $__env->startPush('page-scripts'); ?>
        <script>
            // The add and edit form of a guardian is a pop-up, as in the template: the page is
            // not loaded again, the form of the pop-up is filled with the row that opened it.
            (function () {
                var modal = document.getElementById('guardian-modal');
                if (!modal) { return; }

                var form = modal.querySelector('[data-guardian-form]');
                var method = form.querySelector('input[name="_method"]');
                var heading = modal.querySelector('[data-guardian-heading]');
                var submit = modal.querySelector('[data-guardian-submit]');
                var name = modal.querySelector('#guardian-name');
                var phone = modal.querySelector('#guardian-phone');
                var email = modal.querySelector('#guardian-email');

                function fill(action, title, label, guardianName, guardianPhone, guardianEmail) {
                    form.action = action;
                    method.value = action === form.getAttribute('data-guardian-add-action') ? '' : 'PUT';
                    heading.textContent = title;
                    submit.textContent = label;
                    name.value = guardianName || '';
                    phone.value = guardianPhone || '';
                    email.value = guardianEmail || '';
                }

                modal.addEventListener('show.bs.modal', function (event) {
                    var trigger = event.relatedTarget;
                    var action = trigger && trigger.getAttribute('data-guardian-action');

                    if (action) {
                        fill(
                            action,
                            trigger.getAttribute('data-guardian-title'),
                            trigger.getAttribute('data-guardian-submit'),
                            trigger.getAttribute('data-guardian-name'),
                            trigger.getAttribute('data-guardian-phone'),
                            trigger.getAttribute('data-guardian-email')
                        );
                    } else {
                        fill(
                            form.getAttribute('data-guardian-add-action'),
                            form.getAttribute('data-guardian-add-title'),
                            form.getAttribute('data-guardian-add-submit'),
                            form.getAttribute('data-guardian-old-name'),
                            form.getAttribute('data-guardian-old-phone'),
                            form.getAttribute('data-guardian-old-email')
                        );
                    }
                });

                // The page was opened to change a guardian, to add one, or the form was refused:
                // the pop-up opens on its own, filled with what is known.
                if (form.getAttribute('data-guardian-open') === '1' && window.bootstrap) {
                    var editAction = form.getAttribute('data-guardian-edit-action');
                    if (editAction) {
                        fill(
                            editAction,
                            form.getAttribute('data-guardian-edit-title'),
                            form.getAttribute('data-guardian-edit-submit'),
                            form.getAttribute('data-guardian-edit-name'),
                            form.getAttribute('data-guardian-edit-phone'),
                            form.getAttribute('data-guardian-edit-email')
                        );
                    }

                    new window.bootstrap.Modal(modal).show();
                }
            })();
        </script>
    <?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/guardians/index.blade.php ENDPATH**/ ?>