<div class="container" data-aos="zoom-in-up">

	<h3 class="text-center mb-3">
		<?= $this->lang->line('categories') ?>
	</h3>

	<div class="row">

		<?php foreach ($categories as $category) : ?>
			<div class="col-12 col-md-3 mb-3 mb-md-0" data-aos="zoom-in-up">
				<div class="justify-content-center">
					<?php if ($category->image == null) : ?>
					<div>
						<img class="img-fluid border rounded" src="<?= base_url('assets/img/no-image.png') ?>" alt="">
					</div>
					<?php else: ?>
					<div>
						<img class="img-fluid border rounded"
							 src="<?= base_url('uploads/category/image/' . $category->image) ?>" alt="">
					</div>
					<?php endif ?>
					<div class="text-center">
						<?=$category->name?>
					</div>
				</div>
			</div>
		<?php endforeach ?>

	</div>

</div>
