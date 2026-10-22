
<?php ($editing = isset($scale)); ?>
<?php ($existing = $editing ? $scale->bands->values() : collect()); ?>
<?php echo $__env->make('academics._field', ['name' => 'name', 'label' => __('exams.scales.name'), 'value' => $scale->name ?? ''], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php $__errorArgs = ['bands'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
<div class="table-responsive">
    <table class="table align-middle">
        <thead>
            <tr>
                <th><?php echo e(__('exams.scales.min')); ?></th>
                <th><?php echo e(__('exams.scales.grade')); ?></th>
                <th><?php echo e(__('exams.scales.points')); ?></th>
                <th><?php echo e(__('exams.scales.remark')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i < 10; $i++): ?>
                <?php ($band = $existing->get($i)); ?>
                <tr>
                    <td><input class="form-control form-control-sm" type="text" inputmode="decimal" maxlength="8" name="bands[<?php echo e($i); ?>][min_mark]" value="<?php echo e(old("bands.{$i}.min_mark", $band ? rtrim(rtrim($band->min_mark, '0'), '.') : '')); ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" maxlength="5" name="bands[<?php echo e($i); ?>][grade]" value="<?php echo e(old("bands.{$i}.grade", $band->grade ?? '')); ?>"></td>
                    <td><input class="form-control form-control-sm" type="number" min="0" max="20" name="bands[<?php echo e($i); ?>][points]" value="<?php echo e(old("bands.{$i}.points", $band->points ?? '')); ?>"></td>
                    <td><input class="form-control form-control-sm" type="text" maxlength="100" name="bands[<?php echo e($i); ?>][remark]" value="<?php echo e(old("bands.{$i}.remark", $band->remark ?? '')); ?>"></td>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</div>
<p class="text-muted fs-13"><?php echo e(__('exams.scales.rule')); ?></p>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/exams/scales/_fields.blade.php ENDPATH**/ ?>