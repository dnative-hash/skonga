<?php $__env->startSection('title', __('idcard.title')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <a href="<?php echo e(route('students.index')); ?>" class="text-muted"><i class="ti ti-arrow-left me-1"></i><?php echo e(__('menu.student_list')); ?></a>
        <h3 class="page-title mt-2 mb-1"><?php echo e(__('idcard.title')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('idcard.hint')); ?></p>
    </div>

    <?php if($year === null): ?>
        <div class="alert alert-warning"><?php echo e(__('idcard.no_year')); ?></div>
    <?php endif; ?>

    <div class="card">
        <div class="card-body">
            <form method="GET" action="<?php echo e(route('students.id-cards')); ?>" class="d-flex flex-wrap gap-2 align-items-end">
                <div>
                    <label class="form-label" for="class"><?php echo e(__('idcard.choose_class')); ?></label>
                    <select class="form-select" id="class" name="class" onchange="this.form.submit()">
                        <option value=""><?php echo e(__('idcard.pick')); ?></option>
                        <option value="all" <?php if($selected === 'all'): echo 'selected'; endif; ?>><?php echo e(__('idcard.all_classes')); ?></option>
                        <?php $__currentLoopData = $classes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $class): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($class->id); ?>" <?php if($selected === (string) $class->id): echo 'selected'; endif; ?>><?php echo e($class->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <noscript><button class="btn btn-outline-primary"><?php echo e(__('idcard.show')); ?></button></noscript>
            </form>
        </div>
    </div>

    <?php if($selected !== ''): ?>
        <div class="card">
            <div class="card-body">
                <?php if($students->isEmpty()): ?>
                    <p class="text-muted mb-0"><?php echo e(__('idcard.none')); ?></p>
                <?php else: ?>
                    <form method="POST" action="<?php echo e(route('students.id-cards.print')); ?>" target="_blank" id="idcard-form">
                        <?php echo csrf_field(); ?>
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="checkbox" id="all" checked>
                                <label class="form-check-label" for="all"><?php echo e(__('idcard.select_all')); ?> (<span id="count"><?php echo e($students->count()); ?></span>)</label>
                            </div>
                            <button type="submit" class="btn btn-primary"><i class="ti ti-printer me-1"></i><?php echo e(__('idcard.print_selected')); ?></button>
                        </div>
                        <?php if($students->count() >= $max): ?>
                            <div class="alert alert-info"><?php echo e(__('idcard.max_note', ['max' => $max])); ?></div>
                        <?php endif; ?>
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead><tr><th style="width:40px"></th><th><?php echo e(__('students.fields.admission_number')); ?></th><th><?php echo e(__('idcard.name')); ?></th><th><?php echo e(__('students.fields.class')); ?></th></tr></thead>
                                <tbody>
                                    <?php $__currentLoopData = $students; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php ($placement = $placements[$student->id] ?? null); ?>
                                        <tr>
                                            <td><input class="form-check-input js-pick" type="checkbox" name="ids[]" value="<?php echo e($student->id); ?>" checked aria-label="<?php echo e($student->fullName()); ?>"></td>
                                            <td><?php echo e($student->admission_number); ?></td>
                                            <td><?php echo e($student->fullName()); ?></td>
                                            <td><?php echo e($placement ? $placement->schoolClass->name.($placement->stream ? ' '.$placement->stream->name : '') : '—'); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-scripts'); ?>
    <script>
        (function () {
            var all = document.getElementById('all');
            if (!all) return;
            var picks = Array.prototype.slice.call(document.querySelectorAll('.js-pick'));
            function count() { document.getElementById('count').textContent = picks.filter(function (p) { return p.checked; }).length; }
            all.addEventListener('change', function () { picks.forEach(function (p) { p.checked = all.checked; }); count(); });
            picks.forEach(function (p) { p.addEventListener('change', function () { all.checked = picks.every(function (x) { return x.checked; }); count(); }); });
        })();
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/students/id-cards.blade.php ENDPATH**/ ?>