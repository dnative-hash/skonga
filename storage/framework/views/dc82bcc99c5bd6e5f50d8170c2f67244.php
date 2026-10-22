<?php $__env->startSection('title', $article->title.' - '.__('help.title')); ?>

<?php $__env->startPush('styles'); ?>
<style>
	.help-body h2 { font-size: 1.25rem; margin: 1.75rem 0 .75rem; scroll-margin-top: 90px; }
	.help-body h3 { font-size: 1.05rem; margin: 1.25rem 0 .5rem; }
	.help-body ol, .help-body ul { padding-left: 1.4rem; }
	.help-body li { margin-bottom: .35rem; }
	.help-body blockquote { border-left: 4px solid #ff9f43; background: rgba(255, 159, 67, .08); padding: .6rem 1rem; margin: 1rem 0; border-radius: 0 6px 6px 0; }
	.help-body blockquote p { margin: 0; }
	.help-body table { width: 100%; margin: 1rem 0; }
	.help-body th, .help-body td { border: 1px solid rgba(128, 128, 128, .25); padding: .4rem .6rem; }
	.help-body code { background: rgba(128, 128, 128, .15); padding: .1rem .35rem; border-radius: 4px; }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('page'); ?>
<div>
	<div class="page-header">
		<div class="add-item d-flex">
			<div class="page-title">
				<h4 class="fw-bold"><?php echo e($article->title); ?></h4>
				<h6>
					<a href="<?php echo e(route('help.index')); ?>"><?php echo e(__('help.title')); ?></a> /
					<?php echo e(__('help.categories.'.$article->category.'.title')); ?>

				</h6>
			</div>
		</div>
		<div class="page-btn">
			<form method="GET" action="<?php echo e(route('help.index')); ?>" class="d-flex gap-2">
				<input type="search" name="q" class="form-control" placeholder="<?php echo e(__('help.search_placeholder')); ?>" aria-label="<?php echo e(__('help.search_placeholder')); ?>" minlength="2">
			</form>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-3 order-lg-2 mb-3">
			<?php if($rendered['toc'] !== []): ?>
				<div class="card">
					<div class="card-header"><h6 class="mb-0"><?php echo e(__('help.on_this_page')); ?></h6></div>
					<div class="card-body">
						<ul class="list-unstyled mb-0">
							<?php $__currentLoopData = $rendered['toc']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<li class="py-1"><a href="#<?php echo e($item['id']); ?>"><?php echo e($item['title']); ?></a></li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</ul>
					</div>
				</div>
			<?php endif; ?>
			<div class="card">
				<div class="card-header"><h6 class="mb-0"><?php echo e(__('help.categories.'.$article->category.'.title')); ?></h6></div>
				<div class="card-body">
					<ul class="list-unstyled mb-0">
						<?php $__currentLoopData = $siblings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $other): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<li class="py-1">
								<?php if($other->slug === $article->slug): ?>
									<strong><?php echo e($other->title); ?></strong>
								<?php else: ?>
									<a href="<?php echo e(route('help.show', [$other->category, $other->slug])); ?>"><?php echo e($other->title); ?></a>
								<?php endif; ?>
							</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="col-lg-9 order-lg-1">
			<div class="card">
				<div class="card-body">
					<p class="text-muted fs-16"><?php echo e($article->summary); ?></p>
					<div class="help-body"><?php echo $rendered['html']; ?></div>
				</div>
			</div>

			<div class="d-flex justify-content-between">
				<?php if($previous): ?>
					<a href="<?php echo e(route('help.show', [$previous->category, $previous->slug])); ?>" class="btn btn-white"><i class="ti ti-arrow-left me-1"></i><?php echo e($previous->title); ?></a>
				<?php else: ?> <span></span> <?php endif; ?>
				<?php if($next): ?>
					<a href="<?php echo e(route('help.show', [$next->category, $next->slug])); ?>" class="btn btn-white"><?php echo e($next->title); ?><i class="ti ti-arrow-right ms-1"></i></a>
				<?php endif; ?>
			</div>

			<?php echo $__env->make('help.partials.contact', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/help/show.blade.php ENDPATH**/ ?>