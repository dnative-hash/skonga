<?php $__env->startSection('title', __('admission.title')); ?>

<?php
    // The values the page was saved with, for the live preview. The array is built here because
    // @json() splits its argument on commas, so an array literal inside it would not compile.
    $saved = [
        'prefix' => $setting->prefix,
        'year_format' => $setting->year_format,
        'separator' => $setting->separator === '' ? 'none' : $setting->separator,
        'digits' => $setting->digits,
    ];
?>

<?php $__env->startPush('styles'); ?>
    <style>
        .adm-mode{display:block;border:2px solid #E6EAED;border-radius:12px;padding:1rem 1.25rem;cursor:pointer;height:100%;transition:border-color .15s,box-shadow .15s}
        .adm-mode:hover{border-color:#FE9F43}
        .adm-mode input{position:absolute;opacity:0;pointer-events:none}
        .adm-mode:has(input:checked){border-color:#FE9F43;box-shadow:0 0 0 3px rgba(254,159,67,.18)}
        .adm-mode:has(input:focus-visible){outline:2px solid #FE9F43;outline-offset:2px}
        .adm-preview{background:#1f2937;color:#fff;border-radius:12px;padding:1.25rem 1.5rem}
        .adm-preview .num{font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;font-size:2rem;letter-spacing:.04em;word-break:break-all}
        .adm-preview .ex{font-family:ui-monospace,SFMono-Regular,Menlo,Consolas,monospace;opacity:.75}
    </style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page'); ?>
    <?php ($manual = old('mode', $setting->mode) !== 'auto'); ?>
    <div class="mb-3">
        <h3 class="page-title mb-1"><?php echo e(__('admission.title')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('admission.intro')); ?></p>
    </div>

    <form method="POST" action="<?php echo e(route('settings.admission.update')); ?>" id="admission-form">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <?php if($errors->any()): ?>
            <div class="alert alert-danger" role="alert"><ul class="mb-0"><?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><li><?php echo e($error); ?></li><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></ul></div>
        <?php endif; ?>

        <div class="row g-3 mb-3">
            <?php $__currentLoopData = ['manual', 'auto']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mode): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 position-relative">
                    <label class="adm-mode">
                        <input type="radio" name="mode" value="<?php echo e($mode); ?>" <?php if(old('mode', $setting->mode) === $mode): echo 'checked'; endif; ?>>
                        <span class="d-block fw-semibold mb-1"><i class="ti <?php echo e($mode === 'auto' ? 'ti-wand' : 'ti-pencil'); ?> me-1"></i><?php echo e(__('admission.mode.'.$mode)); ?></span>
                        <span class="d-block text-muted fs-13"><?php echo e(__('admission.mode.'.$mode.'_hint')); ?></span>
                    </label>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="card" id="adm-builder">
            <div class="card-header"><h5 class="mb-0"><?php echo e(__('admission.format')); ?></h5></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="prefix"><?php echo e(__('admission.prefix')); ?></label>
                        <input class="form-control <?php $__errorArgs = ['prefix'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="prefix" name="prefix" maxlength="10" value="<?php echo e(old('prefix', $setting->prefix)); ?>" autocomplete="off" placeholder="SCH">
                        <div class="form-text"><?php echo e(__('admission.prefix_hint')); ?></div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="year_format"><?php echo e(__('admission.year')); ?></label>
                        <select class="form-select" id="year_format" name="year_format">
                            <?php $__currentLoopData = ['YYYY', 'YY', 'none']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option); ?>" <?php if(old('year_format', $setting->year_format) === $option): echo 'selected'; endif; ?>><?php echo e(__('admission.years.'.$option)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="separator"><?php echo e(__('admission.separator')); ?></label>
                        <select class="form-select" id="separator" name="separator">
                            <?php $__currentLoopData = ['-', '/', '.', '_', 'none']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option); ?>" <?php if(old('separator', $setting->separator === '' ? 'none' : $setting->separator) === $option): echo 'selected'; endif; ?>><?php echo e(__('admission.separators.'.$option)); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label class="form-label" for="digits"><?php echo e(__('admission.digits')); ?></label>
                        <select class="form-select" id="digits" name="digits">
                            <?php $__currentLoopData = range(2, 8); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($option); ?>" <?php if((int) old('digits', $setting->digits) === $option): echo 'selected'; endif; ?>><?php echo e($option); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                        <div class="form-text"><?php echo e(__('admission.digits_hint')); ?></div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <label class="form-label" for="start_at"><?php echo e(__('admission.start_at')); ?></label>
                        <input class="form-control <?php $__errorArgs = ['start_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" id="start_at" name="start_at" type="number" min="1" value="<?php echo e(old('start_at')); ?>" placeholder="1">
                        <div class="form-text"><?php echo e(__('admission.start_at_hint')); ?></div>
                    </div>
                </div>

                <div class="adm-preview mt-2">
                    <div class="small text-uppercase opacity-75"><?php echo e(__('admission.preview_next')); ?></div>
                    <div class="num" id="adm-next" aria-live="polite"><?php echo e($next); ?></div>
                    <div class="small mt-2 opacity-75"><?php echo e(__('admission.preview_examples')); ?>: <span class="ex" id="adm-examples"></span></div>
                    <div class="small mt-1 opacity-75" id="adm-year-note"><?php echo e(__('admission.year_note')); ?></div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary"><i class="ti ti-device-floppy me-1"></i><?php echo e(__('admission.save')); ?></button>
    </form>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-scripts'); ?>
    <script>
        (function () {
            var form = document.getElementById('admission-form');
            var year = <?php echo e($year); ?>;
            var peek = <?php echo json_encode($next, 15, 512) ?>;
            var saved = <?php echo json_encode($saved, 15, 512) ?>;

            function value(name) { return form.elements[name].value; }
            function render(seq) {
                var parts = [], prefix = value('prefix').trim().toUpperCase(), yf = value('year_format');
                if (prefix) parts.push(prefix);
                if (yf === 'YYYY') parts.push(String(year));
                if (yf === 'YY') parts.push(String(year).slice(-2));
                var s = String(seq); while (s.length < parseInt(value('digits'), 10)) s = '0' + s;
                parts.push(s);
                return parts.join(value('separator') === 'none' ? '' : value('separator'));
            }
            function refresh() {
                var auto = form.elements['mode'].value === 'auto';
                document.getElementById('adm-builder').style.display = auto ? '' : 'none';
                var start = parseInt(value('start_at'), 10);
                var unchanged = ['prefix', 'year_format', 'separator', 'digits'].every(function (k) { return String(saved[k]) === String(value(k)).trim().toUpperCase() || String(saved[k]) === String(value(k)); });
                var first = start > 1 ? start : 1;
                document.getElementById('adm-next').textContent = (unchanged && !(start > 1)) ? peek : render(first);
                document.getElementById('adm-examples').textContent = [first, first + 1, first + 2].map(render).join(' · ');
                document.getElementById('adm-year-note').style.display = value('year_format') === 'none' ? 'none' : '';
            }
            form.addEventListener('input', refresh);
            form.addEventListener('change', refresh);
            refresh();
        })();
    </script>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/settings/admission.blade.php ENDPATH**/ ?>