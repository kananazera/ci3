<div class="container" data-aos="zoom-in-up">

	<div class="row">

		<div class="col-12 col-md-8 mb-3 mb-md-0">
			<h3 class="text-center mb-3">
				<?= $blog_view->title ?>
			</h3>

			<?php if ($blog_view->image) : ?>
				<img
					src="<?= base_url('uploads/blog/image/' . $blog_view->image) ?>"
					class="card-img-top border rounded" alt="">
			<?php else: ?>
				<img src="<?= base_url('assets/img/no-image.png') ?>" class="card-img-top" alt="">
			<?php endif ?>

			<div class="my-3">
				<strong>
					<?= generateDate($blog_view->date) ?>
				</strong>
			</div>

			<div class="mt-3">
				<?= $blog_view->content ?>
			</div>

			<div class="mt-3 text-end">
				<?= $this->lang->line('views') ?>: <strong><?= $blog_view->views ?></strong>
			</div>

		</div>

		<div class="col-12 col-md-4">
			<?php $this->view('blog/random', $blog_random); ?>
		</div>

	</div>

</div>
