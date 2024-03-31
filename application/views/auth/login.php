<div class="container" data-aos="zoom-in-up">
	<div class="row justify-content-center">
		<div class="col-12 col-md-5 border rounded p-4">

			<h3 class="text-center mb-3">
				<?= $this->lang->line('login') ?>
			</h3>

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

			<?= form_open('login') ?>

			<div class="mb-3">
				<label for="email" class="mb-2"><?= $this->lang->line('email') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-envelope"></i></span>
					<input type="text" id="email" name="email" value="<?= set_value('email') ?>"
						   class="<?php if (form_error('email')) { ?> is-invalid <?php } ?> form-control" required>
				</div>
				<?php if (form_error('email')) { ?>
					<div class="badge text-danger"><?= form_error('email') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="password" class="mb-2"><?= $this->lang->line('password') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-key"></i></span>
					<input type="password" id="password" name="password"
						   class="<?php if (form_error('password')) { ?> is-invalid <?php } ?> form-control" required>
				</div>
				<?php if (form_error('password')) { ?>
					<div class="badge text-danger"><?= form_error('password') ?></div>
				<?php } ?>
			</div>

			<div class="d-grid gap-2 mb-3">
				<button type="submit" class="btn btn-dark"><?= $this->lang->line('login') ?></button>
			</div>

			<ul>
				<li><a class="link-dark" href="<?= base_url('forgot-password') ?>"><?= $this->lang->line('forgot_password') ?></a>
			</ul>

			<?= form_close() ?>

		</div>
	</div>
</div>
