<div class="container" data-aos="zoom-in-up">
	<div class="row justify-content-center">
		<div class="col-12 col-md-5 border rounded p-4">

			<h3 class="text-center mb-3">
				<?= $this->lang->line('register') ?>
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

			<?= form_open('register') ?>

			<div class="mb-3">
				<label for="name" class="mb-1"><?= $this->lang->line('name') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-person"></i></span>
					<input type="text" id="name" name="name" value="<?= set_value('name') ?>"
						   class="<?php if (form_error('name')) { ?> is-invalid <?php } ?> form-control" required>
				</div>
				<?php if (form_error('name')) { ?>
					<div class="badge text-danger"><?= form_error('name') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="email" class="mb-1"><?= $this->lang->line('email') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-envelope"></i></span>
					<input type="email" id="email" name="email" value="<?= set_value('email') ?>"
						   class="<?php if (form_error('email')) { ?> is-invalid <?php } ?> form-control" required>
				</div>
				<?php if (form_error('email')) { ?>
					<div class="badge text-danger"><?= form_error('email') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="password" class="mb-1"><?= $this->lang->line('password') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-key"></i></span>
					<input type="password" id="password" name="password"
						   class="<?php if (form_error('password')) { ?> is-invalid <?php } ?> form-control" required>
				</div>
				<?php if (form_error('password')) { ?>
					<div class="badge text-danger"><?= form_error('password') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="password_confirmation"
					   class="mb-1"><?= $this->lang->line('password_conformation') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-key"></i></span>
					<input type="password" id="password_confirmation" name="password_confirmation"
						   class="<?php if (form_error('password_confirmation')) { ?> is-invalid <?php } ?> form-control"
						   required>
				</div>
				<?php if (form_error('password_confirmation')) { ?>
					<div class="badge text-danger"><?= form_error('password_confirmation') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<input type="checkbox" id="read_and_accept_rules" name="read_and_accept_rules"
					   class="form-check-input rounded" required>
				<label for="read_and_accept_rules"><?= $this->lang->line('read_and_accept_rules') ?></label>
			</div>

			<div class="d-grid gap-2 mb-3">
				<button type="submit" class="btn btn-dark"><?= $this->lang->line('register') ?></button>
			</div>

			<ul>
				<li><a class="link-dark" target="_blank"
					   href="<?= base_url('privacy-policy') ?>"><?= $this->lang->line('privacy_policy') ?></a>
				<li><a class="link-dark" target="_blank"
					   href="<?= base_url('terms-and-conditions') ?>"><?= $this->lang->line('terms_and_conditions') ?></a>
				</li>
			</ul>

			<?= form_close() ?>

		</div>
	</div>
</div>
