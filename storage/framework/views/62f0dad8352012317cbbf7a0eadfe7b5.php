<div class="sidebar" id="sidebar">
    <div class="sidebar-logo">
        <a href="<?php echo e(route('dashboard')); ?>" class="logo logo-normal"><img src="<?php echo e(asset('img/somaplus-logo.svg')); ?>" alt="<?php echo e(config('app.name')); ?>"></a>
        <a href="<?php echo e(route('dashboard')); ?>" class="logo logo-white"><img src="<?php echo e(asset('img/somaplus-logo-white.svg')); ?>" alt="<?php echo e(config('app.name')); ?>"></a>
        <a href="<?php echo e(route('dashboard')); ?>" class="logo-small"><img src="<?php echo e(asset('assets/img/logo-small.svg')); ?>" alt="<?php echo e(config('app.name')); ?>"></a>
        <a href="<?php echo e(route('dashboard')); ?>" class="logo-small-white"><img src="<?php echo e(asset('assets/img/logo-small-white.svg')); ?>" alt="<?php echo e(config('app.name')); ?>"></a>
        <a id="toggle_btn" href="javascript:void(0);"><i data-feather="chevrons-left" class="feather-16"></i></a>
    </div>

    <div class="sidebar-header p-3 pb-0 pt-2">
        <div class="text-center rounded bg-light p-2 mb-4 sidebar-profile d-flex align-items-center">
            <div class="avatar avatar-md online">
                <span class="avatar avatar-md bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"><?php echo e(mb_strtoupper(mb_substr($currentUser->name, 0, 1))); ?></span>
            </div>
            <div class="text-start sidebar-profile-info ms-2">
                <h6 class="fs-14 fw-bold mb-1"><?php echo e($currentSchool?->name ?? config('app.name')); ?></h6>
                <p class="fs-12"><?php echo e($currentUser->name); ?></p>
            </div>
        </div>
    </div>

    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <?php $__currentLoopData = $menu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li class="submenu-open">
                        <h6 class="submenu-hdr"><?php echo e($section['label']); ?></h6>
                        <ul>
                            <?php $__currentLoopData = $section['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($item['children'] === []): ?>
                                    <li><a href="<?php echo e($item['url']); ?>" class="<?php echo e($item['active'] ? 'active' : ''); ?>"><i class="<?php echo e($item['icon']); ?> fs-16 me-2"></i><span><?php echo e($item['label']); ?></span></a></li>
                                <?php else: ?>
                                    <li class="submenu">
                                        <a href="javascript:void(0);" class="<?php echo e($item['active'] ? 'subdrop active' : ''); ?>"><i class="<?php echo e($item['icon']); ?> fs-16 me-2"></i><span><?php echo e($item['label']); ?></span><span class="menu-arrow"></span></a>
                                        <ul style="<?php echo e($item['active'] ? 'display: block;' : ''); ?>">
                                            <?php $__currentLoopData = $item['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li><a href="<?php echo e($child['url']); ?>" class="<?php echo e($child['active'] ? 'active' : ''); ?>"><?php echo e($child['label']); ?></a></li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                    </li>
                                <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/partials/sidebar.blade.php ENDPATH**/ ?>