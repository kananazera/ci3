<div class="container" data-aos="zoom-in-up">

	<h3 class="text-center mb-3">
		<?= $this->lang->line('blog') ?>
	</h3>

	<div class="mb-3">
		<div class="row justify-content-center">
			<div class="col-12 col-md-5 mb-4">
				<?= form_open('blog') ?>
				<div class="input-group">
					<input type="search" name="search" class="form-control"
						   placeholder="<?= $this->lang->line('search') ?>"
						   value="<?= set_value('search') ?>">
					<button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
				</div>
			</div>
		</div>
		<?= form_close() ?>
	</div>

	<div class="row">
		<?php foreach ($blog as $item) : ?>
			<div class="col-12 col-md-3 mb-4">
				<?php
				$data['blog'] = $item;
				$this->view('blog/blog', $data);
				?>
			</div>
		<?php endforeach ?>

		<?php if (empty($blog)) : ?>
			<div class="text-center my-5">
				<h3><?= $this->lang->line('blog_not_found') ?></h3>
			</div>
		<?php endif ?>
	</div>
</div>

<div class="mt-3">
	<?= $this->pagination->create_links() ?>
</div>
