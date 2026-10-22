<?php $__env->startSection('title', __('menu.integrations')); ?>

<?php $__env->startSection('page'); ?>
    <div class="mb-3">
        <h3 class="page-title mb-1"><?php echo e(__('menu.integrations')); ?></h3>
        <p class="text-muted mb-0"><?php echo e(__('integrations.intro')); ?></p>
    </div>

    <?php $__currentLoopData = $generated; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="alert alert-warning" role="alert">
            <div class="fw-medium mb-1"><?php echo e(__('integrations.generated_title')); ?></div>
            <code class="user-select-all"><?php echo e($value); ?></code>
            <div class="small mt-1"><?php echo e(__('integrations.generated_hint')); ?></div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <?php $__empty_1 = true; $__currentLoopData = $channels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $channel => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-1"><?php echo e(__('integrations.channels.'.$channel.'.title')); ?></h5>
                <p class="text-muted"><?php echo e(__('integrations.channels.'.$channel.'.hint')); ?></p>

                <form method="POST" action="<?php echo e(route('settings.integrations.update', $channel)); ?>" class="js-integration">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <?php $__errorArgs = ['driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="alert alert-danger"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

                    <div class="form-check form-switch mb-3">
                        <input type="hidden" name="enabled" value="0">
                        <input class="form-check-input" type="checkbox" role="switch" id="enabled-<?php echo e($channel); ?>" name="enabled" value="1" <?php if(old('enabled', $info['enabled'])): echo 'checked'; endif; ?>>
                        <label class="form-check-label" for="enabled-<?php echo e($channel); ?>"><?php echo e(__('integrations.enabled')); ?></label>
                    </div>

                    <div class="mb-3">
                        <label class="form-label" for="driver-<?php echo e($channel); ?>"><?php echo e(__('integrations.provider')); ?></label>
                        <select class="form-select js-driver" id="driver-<?php echo e($channel); ?>" name="driver">
                            <option value=""></option>
                            <?php $__currentLoopData = $info['drivers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($key); ?>" <?php if(old('driver', $info['driver']) === $key): echo 'selected'; endif; ?>><?php echo e(__($driver['label'])); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <?php $__currentLoopData = $info['drivers']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $driver): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="js-driver-fields row" data-driver="<?php echo e($key); ?>" style="display: none;">
                            <?php $__currentLoopData = $driver['fields']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $field): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $name = $field['name'];
                                    $isSecret = $field['secret'] ?? false;
                                    $value = $driver['values'][$name] ?? ($field['default'] ?? '');
                                ?>
                                <div class="col-md-8 mb-3">
                                    <label class="form-label"><?php echo e(__($field['label'])); ?><?php if($field['required'] ?? false): ?><span class="text-danger ms-1">*</span><?php endif; ?></label>
                                    <?php if($field['type'] === 'select'): ?>
                                        <select class="form-select" name="config[<?php echo e($name); ?>]" disabled>
                                            <?php $__currentLoopData = $field['options']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $optionValue => $optionLabel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($optionValue); ?>" <?php if((string) old("config.{$name}", $value) === (string) $optionValue): echo 'selected'; endif; ?>><?php echo e(__($optionLabel)); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                    <?php elseif($field['type'] === 'textarea'): ?>
                                        <textarea class="form-control font-monospace fs-13 <?php $__errorArgs = ["config.{$name}"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="config[<?php echo e($name); ?>]" rows="5" disabled autocomplete="off"
                                            <?php if($isSecret): ?> placeholder="<?php echo e(in_array($name, $driver['savedSecrets'], true) ? __('integrations.secret_saved') : ''); ?>"><?php else: ?>><?php echo e(old("config.{$name}", $value)); ?><?php endif; ?></textarea>
                                    <?php else: ?>
                                        <input class="form-control <?php $__errorArgs = ["config.{$name}"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="config[<?php echo e($name); ?>]" disabled autocomplete="off"
                                            type="<?php echo e($isSecret || $field['type'] === 'password' ? 'password' : 'text'); ?>"
                                            <?php if($isSecret): ?> value="" autocomplete="new-password" placeholder="<?php echo e(in_array($name, $driver['savedSecrets'], true) ? __('integrations.secret_saved') : (($field['generate'] ?? false) ? __('integrations.secret_generate') : '')); ?>"
                                            <?php else: ?> value="<?php echo e(old("config.{$name}", $value)); ?>" <?php endif; ?>>
                                    <?php endif; ?>
                                    <?php $__errorArgs = ["config.{$name}"];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="text-danger fs-13 mt-1"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($channel === 'payments' && $webhookUrl): ?>
                        <div class="alert alert-info js-driver-note" data-driver="signed_webhook" style="display: none;">
                            <div class="fw-medium mb-1"><?php echo e(__('integrations.webhook.title')); ?></div>
                            <code class="user-select-all"><?php echo e($webhookUrl); ?></code>
                            <div class="small mt-2"><?php echo e(__('integrations.webhook.how')); ?></div>
                            <pre class="small mb-0 mt-2"><?php echo e(__('integrations.webhook.example')); ?></pre>
                        </div>
                    <?php endif; ?>

                    <?php if($channel === 'payments' && $gepgUrl): ?>
                        <div class="alert alert-info js-driver-note" data-driver="gepg" style="display: none;">
                            <div class="fw-medium mb-1"><?php echo e(__('integrations.gepg.title')); ?></div>
                            <code class="user-select-all"><?php echo e($gepgUrl); ?></code>
                            <div class="small mt-2"><?php echo e(__('integrations.gepg.how')); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($channel === 'payments' && $selcomUrl): ?>
                        <div class="alert alert-info js-driver-note" data-driver="selcom" style="display: none;">
                            <div class="fw-medium mb-1"><?php echo e(__('integrations.selcom.title')); ?></div>
                            <?php $__currentLoopData = ['lookup', 'validation', 'notification']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $step): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div><code class="user-select-all"><?php echo e(str_replace('STEP', $step, $selcomUrl)); ?></code></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <div class="small mt-2"><?php echo e(__('integrations.selcom.how')); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if($channel === 'payments' && $azampayUrl): ?>
                        <div class="alert alert-info js-driver-note" data-driver="azampay" style="display: none;">
                            <div class="fw-medium mb-1"><?php echo e(__('integrations.azampay.title')); ?></div>
                            <code class="user-select-all"><?php echo e($azampayUrl); ?></code>
                            <div class="small mt-2"><?php echo e(__('integrations.azampay.how')); ?></div>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary"><?php echo e(__('integrations.save')); ?></button>
                </form>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="card"><div class="card-body text-muted"><?php echo e(__('integrations.none')); ?></div></div>
    <?php endif; ?>

    <?php if(isset($channels['payments'])): ?>
        <div class="card">
            <div class="card-body">
                <h5 class="mb-1"><?php echo e(__('integrations.notices.title')); ?></h5>
                <p class="text-muted"><?php echo e(__('integrations.notices.hint')); ?></p>
                <?php if($notifications->isEmpty()): ?>
                    <p class="text-muted mb-0"><?php echo e(__('integrations.notices.none')); ?></p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table align-middle mb-0">
                            <thead><tr>
                                <th><?php echo e(__('integrations.notices.received')); ?></th><th><?php echo e(__('fees.invoices.control_number')); ?></th><th><?php echo e(__('integrations.notices.reference')); ?></th><th class="text-end"><?php echo e(__('fees.structures.amount')); ?></th><th><?php echo e(__('fees.payments.status')); ?></th>
                            </tr></thead>
                            <tbody>
                                <?php $__currentLoopData = $notifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $notice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($notice->received_at->format('Y-m-d H:i')); ?></td>
                                        <td><?php echo e($notice->control_number); ?></td>
                                        <td><?php echo e($notice->provider_reference); ?></td>
                                        <td class="text-end"><?php if($notice->amount !== null && $notice->currency !== null): ?><?php echo e(App\Support\Money::of($notice->amount, $notice->currency)->format()); ?><?php endif; ?></td>
                                        <td><?php echo e(__('integrations.notices.statuses.'.$notice->status)); ?><?php if($notice->reason): ?> <span class="text-muted fs-13">· <?php echo e(__('integrations.notices.reasons.'.$notice->reason)); ?></span><?php endif; ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('page-scripts'); ?>
<script>
    document.querySelectorAll('.js-integration').forEach(function (form) {
        var select = form.querySelector('.js-driver');

        function sync() {
            form.querySelectorAll('.js-driver-fields').forEach(function (block) {
                var active = block.dataset.driver === select.value;
                block.style.display = active ? '' : 'none';
                // Only the chosen provider's fields are sent.
                block.querySelectorAll('input, select').forEach(function (input) { input.disabled = !active; });
            });
            form.querySelectorAll('.js-driver-note').forEach(function (note) {
                note.style.display = note.dataset.driver === select.value ? '' : 'none';
            });
        }

        select.addEventListener('change', sync);
        sync();
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/settings/integrations.blade.php ENDPATH**/ ?>