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

	<h1>home page</h1>

</div>
