<div class="container-fluid" data-aos="zoom-in-up">

	<div class="row">

		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<?php if ($this->session->flashdata('success')) : ?>
				<div class="text-center alert alert-success">
					<?= $this->session->flashdata('success') ?>
				</div>
			<?php endif ?>

			<?php if ($this->session->flashdata('error')) : ?>
				<div class="text-center alert alert-danger">
					<?= $this->session->flashdata('error') ?>
				</div>
			<?php endif ?>

			<div class="border rounded p-3">
				<?php
				$data['images'] = $images;
				$this->view('products/images', $data); ?>
			</div>
		</div>

		<div class="col-12 col-md-6">
			<div class="border rounded p-3">
				<h3 class="text-center mb-3">
					<?= $product->title ?>
				</h3>

				<div class="mb-3">
					<?= $this->lang->line('category') ?>: <a class="link-dark"
						href="<?= base_url('') ?>"><?= $this->CategoryModel->show($product->category_id)->name ?></a>
				</div>

				<div class="mb-3">
					<?= ($product->quantity == 0) ? '<div class="text-danger"><i class="bi bi-exclamation-octagon"></i> ' . $this->lang->line('not_available') . '</div>' : '<div class="text-success"><i class="bi bi-shield-check"></i> ' . $this->lang->line('is_available') . '</div>' ?>
				</div>

				<div class="mb-3">
					<del><?= $product->price ?></del> <?= generatePrice($product->price, $product->discount_rate) ?> <?= $this->CurrencyModel->show($this->config->item('currency_id'))->symbol ?>
				</div>

				<div class="mb-3 text-center">
					<a href="" class="btn btn-dark"><i
							class="bi bi-cart-plus"></i> <?= $this->lang->line('add_to_cart') ?>
					</a>
				</div>
			</div>

			<h3 class="text-center my-3">
				<?= $this->lang->line('properties') ?>
			</h3>

			<div class="border rounded p-3">
				<div class="row">
					<?php foreach ($properties as $property) : ?>
						<div class="col-6">
							<strong><?= $this->PropertyModel->show($property->property_id)->name ?></strong></div>
						<div class="col-6 mb-2"><?= $property->value ?></div>
					<?php endforeach ?>
				</div>
			</div>

		</div>

	</div>

	<div class="mt-5">

		<nav class="justify-content-center d-flex">
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<button class="link-dark nav-link active" id="nav-comments-tab" data-bs-toggle="tab"
						data-bs-target="#nav-comments"
						type="button" role="tab" aria-controls="nav-comments" aria-selected="false">
					<h3><?= $this->lang->line('comments') ?></h3>
				</button>
				<button class="link-dark nav-link" id="nav-description-tab" data-bs-toggle="tab"
						data-bs-target="#nav-description" type="button" role="tab" aria-controls="nav-description"
						aria-selected="true">
					<h3><?= $this->lang->line('description') ?></h3>
				</button>
			</div>
		</nav>

		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade p-3" id="nav-description" role="tabpanel"
				 aria-labelledby="nav-description-tab" tabindex="0">
				<?= $product->description ?>
			</div>
			<div class="tab-pane fade show active p-3" id="nav-comments" role="tabpanel"
				 aria-labelledby="nav-comments-tab"
				 tabindex="0">
				<?php
				$data['comments'] = $comments;
				$data['product'] = $product;
				$this->view('products/comments', $data); ?>
			</div>
		</div>

	</div>

</div>
