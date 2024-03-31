<link rel="stylesheet" href="<?= base_url('assets/css/owl.carousel.min.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/owl.theme.default.min.css') ?>">

<div class="container" data-aos="zoom-in-up">

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

	<div class="mb-5">
		<h3><?= $this->lang->line('last_products') ?></h3>
		<div class="owl-carousel owl-theme">
			<?php foreach ($last_products as $product) : ?>
				<div class="item">
					<?php $data['product'] = $product;
					$this->view('products/product', $data); ?>
				</div>
			<?php endforeach ?>
		</div>
	</div>

	<div class="mb-5">
		<h3><?= $this->lang->line('discount_products') ?></h3>
		<div class="owl-carousel owl-theme">
			<?php foreach ($discount_products as $product) : ?>
				<div class="item">
					<?php $data['product'] = $product;
					$this->view('products/product', $data); ?>
				</div>
			<?php endforeach ?>
		</div>
	</div>

	<div class="mb-5">
		<h3><?= $this->lang->line('blog') ?></h3>
		<div class="owl-carousel owl-theme">
			<?php foreach ($last_blog as $blog) : ?>
				<div class="item">
					<?php $data['blog'] = $blog;
					$this->view('blog/blog', $data); ?>
				</div>
			<?php endforeach ?>
		</div>
	</div>

</div>

<script src="<?= base_url('assets/js/jquery.min.js') ?>"></script>
<script src="<?= base_url('assets/js/owl.carousel.js') ?>"></script>

<script>
	$(document).ready(function () {
		$('.owl-carousel').owlCarousel({
			loop: true,
			autoplay: true,
			margin: 20,
			responsiveClass: true,
			responsive: {
				0: {
					items: 1,
				},
				600: {
					items: 3,
				},
				1000: {
					items: 4,
				}
			}
		})
	})
</script>
