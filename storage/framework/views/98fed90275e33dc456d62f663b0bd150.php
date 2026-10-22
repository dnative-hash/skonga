<div class="header">
    <div class="main-header">
        <div class="header-left active">
            <a class="logo logo-normal" href="<?php echo e(route('dashboard')); ?>"><img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('img/somaplus-logo.svg')); ?>"></a>
            <a class="logo logo-white" href="<?php echo e(route('dashboard')); ?>"><img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('img/somaplus-logo-white.svg')); ?>"></a>
            <a class="logo-small" href="<?php echo e(route('dashboard')); ?>"><img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('assets/img/logo-small.svg')); ?>"></a>
            <a class="logo-small-white" href="<?php echo e(route('dashboard')); ?>"><img alt="<?php echo e(config('app.name')); ?>" src="<?php echo e(asset('assets/img/logo-small-white.svg')); ?>"></a>
        </div>

        <a class="mobile_btn" href="#sidebar" id="mobile_btn">
            <span class="bar-icon">
                <span></span>
                <span></span>
                <span></span>
            </span>
        </a>

        <ul class="nav user-menu">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\Student::class)): ?>
                <li class="nav-item nav-searchinputs">
                    <div class="top-nav-search">
                        <a class="responsive-search" href="javascript:void(0);"><i class="fa fa-search"></i></a>
                        <form action="<?php echo e(route('students.search')); ?>" method="POST" class="dropdown">
                            <?php echo csrf_field(); ?>
                            <div class="searchinputs input-group dropdown-toggle" data-bs-auto-close="outside" data-bs-toggle="dropdown" id="navbarSearch">
                                <input type="search" name="term" placeholder="<?php echo e(__('layout.search')); ?>" aria-label="<?php echo e(__('layout.search')); ?>" minlength="2" maxlength="100" required autocomplete="off">
                                <div class="search-addon">
                                    <button type="submit" class="btn p-0 border-0 bg-transparent" aria-label="<?php echo e(__('layout.search')); ?>">
                                        <span><i class="ti ti-search"></i></span>
                                    </button>
                                </div>
                            </div>
                            <div aria-labelledby="navbarSearch" class="dropdown-menu search-dropdown">
                                <div class="search-info">
                                    <h6><span><i class="feather-16" data-feather="search"></i></span><?php echo e(__('layout.search_hint')); ?></h6>
                                </div>
                                <div class="search-info">
                                    <h6><span><i class="feather-16" data-feather="help-circle"></i></span><?php echo e(__('layout.help')); ?></h6>
                                    <p class="mb-0"><a href="<?php echo e(route('help.show', ['category' => 'students', 'slug' => 'add-and-find'])); ?>"><?php echo e(__('layout.search_help')); ?></a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>
            <?php endif; ?>

            <?php if($quickActions !== []): ?>
                <li class="nav-item dropdown link-nav">
                    <a href="javascript:void(0);" class="btn btn-primary btn-md d-inline-flex align-items-center" data-bs-toggle="dropdown">
                        <i class="ti ti-circle-plus me-1"></i><?php echo e(__('layout.add_new')); ?>

                    </a>
                    <div class="dropdown-menu dropdown-xl dropdown-menu-center">
                        <div class="row g-2">
                            <?php $__currentLoopData = $quickActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-md-2">
                                    <a href="<?php echo e($action['url']); ?>" class="link-item">
                                        <span class="link-icon"><i class="<?php echo e($action['icon']); ?>"></i></span>
                                        <p><?php echo e($action['label']); ?></p>
                                    </a>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </li>
            <?php endif; ?>

            <li class="nav-item dropdown has-arrow flag-nav nav-item-box">
                <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);" role="button" title="<?php echo e(__('layout.language')); ?>">
                    <img alt="<?php echo e(__('layout.language')); ?>" class="img-fluid" src="<?php echo e(asset(app()->getLocale() === 'sw' ? 'assets/img/flags/tz.svg' : 'assets/img/flags/us-flag.svg')); ?>">
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <?php $__currentLoopData = ['en' => ['English', 'assets/img/flags/english.svg'], 'sw' => ['Kiswahili', 'assets/img/flags/tz.svg']]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => [$name, $flag]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <form action="<?php echo e(route('locale.update')); ?>" method="POST">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="locale" value="<?php echo e($code); ?>">
                            <button type="submit" class="dropdown-item <?php echo e(app()->getLocale() === $code ? 'active' : ''); ?>">
                                <img alt="" height="16" src="<?php echo e(asset($flag)); ?>"> <?php echo e($name); ?>

                            </button>
                        </form>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </li>

            <li class="nav-item nav-item-box">
                <a href="<?php echo e(route('help.index')); ?>" title="<?php echo e(__('layout.help')); ?>"><i class="ti ti-help-circle"></i></a>
            </li>

            <li class="nav-item nav-item-box">
                <a href="javascript:void(0);" id="btnFullscreen" title="<?php echo e(__('layout.fullscreen')); ?>"><i class="ti ti-maximize"></i></a>
            </li>

            <li class="nav-item dropdown nav-item-box">
                <a href="javascript:void(0);" class="dropdown-toggle nav-link" data-bs-toggle="dropdown" title="<?php echo e(__('layout.notifications')); ?>">
                    <i class="ti ti-bell"></i>
                    <?php if($alerts !== []): ?>
                        <span class="badge rounded-pill"><?php echo e(count($alerts)); ?></span>
                    <?php endif; ?>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <h5 class="notification-title"><?php echo e(__('layout.notifications')); ?></h5>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <?php $__empty_1 = true; $__currentLoopData = $alerts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $alert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <li class="notification-message">
                                    <div class="media d-flex p-2">
                                        <span class="avatar flex-shrink-0 bg-<?php echo e($alert['tone']); ?>-transparent text-<?php echo e($alert['tone']); ?>"><i class="<?php echo e($alert['icon']); ?> fs-18"></i></span>
                                        <div class="flex-grow-1 ms-2">
                                            <p class="noti-details mb-0">
                                                <span class="noti-title"><?php echo e($alert['title']); ?></span> <?php echo e($alert['message']); ?>

                                            </p>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <li class="p-3 text-center text-muted"><?php echo e(__('layout.no_notifications')); ?></li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </li>

            <?php if($settingsUrl !== null): ?>
                <li class="nav-item nav-item-box">
                    <a href="<?php echo e($settingsUrl); ?>" title="<?php echo e(__('layout.settings')); ?>"><i class="ti ti-settings"></i></a>
                </li>
            <?php endif; ?>

            <li class="nav-item dropdown has-arrow main-drop profile-nav">
                <a href="javascript:void(0);" class="nav-link userset" data-bs-toggle="dropdown">
                    <span class="user-info p-0">
                        <span class="avatar avatar-md bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"><?php echo e(mb_strtoupper(mb_substr($currentUser->name, 0, 1))); ?></span>
                    </span>
                </a>
                <div class="dropdown-menu menu-drop-user">
                    <div class="profileset d-flex align-items-center">
                        <span class="user-img me-2">
                            <span class="avatar avatar-md bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center"><?php echo e(mb_strtoupper(mb_substr($currentUser->name, 0, 1))); ?></span>
                        </span>
                        <div>
                            <h6 class="fw-medium"><?php echo e($currentUser->name); ?></h6>
                            <p><?php echo e($roleLabel); ?><?php if($currentSchool): ?> &middot; <?php echo e($currentSchool->name); ?><?php endif; ?></p>
                        </div>
                    </div>
                    <?php if($settingsUrl !== null): ?>
                        <a class="dropdown-item" href="<?php echo e($settingsUrl); ?>"><i class="ti ti-settings-2 me-2"></i><?php echo e(__('layout.settings')); ?></a>
                    <?php endif; ?>
                    <a class="dropdown-item" href="<?php echo e(route('help.index')); ?>"><i class="ti ti-help-circle me-2"></i><?php echo e(__('layout.help')); ?></a>
                    <hr class="my-2">
                    <form action="<?php echo e(route('logout')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="dropdown-item logout w-100 text-start"><i class="ti ti-logout me-2"></i><?php echo e(__('layout.logout')); ?></button>
                    </form>
                </div>
            </li>
        </ul>

        <div class="dropdown mobile-user-menu">
            <a aria-expanded="false" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-ellipsis-v"></i></a>
            <div class="dropdown-menu dropdown-menu-right">
                <?php $__currentLoopData = $quickActions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $action): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a class="dropdown-item" href="<?php echo e($action['url']); ?>"><?php echo e($action['label']); ?></a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="dropdown-item"><?php echo e(__('layout.logout')); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/partials/header.blade.php ENDPATH**/ ?>