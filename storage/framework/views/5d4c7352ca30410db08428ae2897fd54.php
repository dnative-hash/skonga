<?php $__env->startSection('title', __('help.title')); ?>

<?php $__env->startSection('page'); ?>
<div>
	<div class="page-header">
		<div class="add-item d-flex">
			<div class="page-title">
				<h4 class="fw-bold"><?php echo e(__('help.title')); ?></h4>
				<h6><?php echo e(__('help.subtitle')); ?></h6>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-body">
			<form method="GET" action="<?php echo e(route('help.index')); ?>" class="d-flex gap-2">
				<input type="search" name="q" value="<?php echo e($term); ?>" class="form-control form-control-lg" placeholder="<?php echo e(__('help.search_placeholder')); ?>" aria-label="<?php echo e(__('help.search_placeholder')); ?>" minlength="2" autofocus>
				<button type="submit" class="btn btn-primary"><i class="ti ti-search me-1"></i><?php echo e(__('help.search')); ?></button>
			</form>
		</div>
	</div>

	<?php if($results !== null): ?>
		<h5 class="mb-3"><?php echo e(__('help.results_for', ['term' => $term])); ?></h5>
		<?php $__empty_1 = true; $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
			<?php ($article = $hit['article']); ?>
			<div class="card mb-2">
				<div class="card-body py-3">
					<a href="<?php echo e(route('help.show', [$article->category, $article->slug])); ?>" class="fw-bold fs-16"><?php echo e($article->title); ?></a>
					<span class="badge bg-light text-dark ms-2"><?php echo e(__('help.categories.'.$article->category.'.title')); ?></span>
					<p class="mb-0 text-muted"><?php echo e($hit['snippet']); ?></p>
				</div>
			</div>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
			<div class="card"><div class="card-body text-center text-muted py-5">
				<p class="mb-1"><?php echo e(__('help.nothing', ['term' => $term])); ?></p>
				<small><?php echo e(__('help.try_again')); ?></small>
			</div></div>
		<?php endif; ?>
		<p class="mt-3"><a href="<?php echo e(route('help.index')); ?>"><?php echo e(__('help.browse_all')); ?></a></p>
	<?php elseif(mb_strlen($term) === 1): ?>
		<p class="text-muted"><?php echo e(__('help.too_short')); ?></p>
	<?php endif; ?>

	<?php if($results === null): ?>
		<div class="row">
			<?php $__currentLoopData = $help->categories(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<?php ($articles = $help->inCategory($category)); ?>
				<?php if($articles === []) continue; ?>
				<div class="col-xl-4 col-md-6 d-flex">
					<div class="card flex-fill">
						<div class="card-header d-flex align-items-center">
							<span class="avatar avatar-md bg-primary-transparent text-primary me-2"><i class="<?php echo e(config('help.categories.'.$category)); ?> fs-20"></i></span>
							<div>
								<h5 class="mb-0"><?php echo e(__('help.categories.'.$category.'.title')); ?></h5>
								<small class="text-muted"><?php echo e(__('help.categories.'.$category.'.description')); ?></small>
							</div>
						</div>
						<div class="card-body">
							<ul class="list-unstyled mb-0">
								<?php $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class="py-1">
										<a href="<?php echo e(route('help.show', [$category, $article->slug])); ?>"><?php echo e($article->title); ?></a>
									</li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
						</div>
					</div>
				</div>
			<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
		</div>
	<?php endif; ?>

	<?php echo $__env->make('help.partials.contact', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\user\Downloads\Personal Projects\Clients\SomaPlus\resources\views/help/index.blade.php ENDPATH**/ ?>