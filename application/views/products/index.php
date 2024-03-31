<div class="container-fluid" data-aos="zoom-in-up">

	<h3 class="text-center mb-3">
		<?= $this->lang->line('products') ?>
	</h3>

	<div class="row">

		<div class="col-12 col-md-2 mb-3 mb-md-0">
			<?php $this->view('products/filter'); ?>
		</div>

		<div class="col-12 col-md-10">
			<div class="mb-3">
				<div class="row">
					<div class="col-12 col-md-6 mb-3 mb-md-0">
						<?= form_open('products') ?>
						<div class="input-group">
							<input type="search" name="search" class="form-control"
								   placeholder="<?= $this->lang->line('search') ?>"
								   value="<?= set_value('search') ?>">
							<button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
						</div>
						<?= form_close() ?>
					</div>

					<div class="col-12 col-md-6 text-end">
						<h3>sort</h3>
					</div>
				</div>
			</div>

			<div class="row">
				<?php foreach ($products as $product) : ?>
					<div class="col-12 col-md-3 mb-4">
						<?php
						$data['product'] = $product;
						$this->view('products/product', $data);
						?>
					</div>
				<?php endforeach ?>

				<?php if (empty($products)) : ?>
					<div class="text-center my-5">
						<h3><?= $this->lang->line('product_not_found') ?></h3>
					</div>
				<?php endif ?>
			</div>
		</div>

	</div>

	<div class="mt-3">
		<?= $this->pagination->create_links() ?>
	</div>

</div>
