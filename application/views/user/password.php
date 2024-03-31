<div class="container" data-aos="zoom-in-up">
	<div class="justify-content-center">
		<div class="border rounded p-4">

			<h3 class="text-center mb-3">
				<?= $this->lang->line('password') ?>
			</h3>

			<?= form_open('user/password') ?>

			<div class="mb-3">
				<label for="current_password" class="mb-2"><?= $this->lang->line('current_password') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-key"></i></span>
					<input type="password" id="current_password" name="current_password"
						   class="<?php if (form_error('current_password')) { ?> is-invalid <?php } ?> form-control"
						   required>
				</div>
				<?php if (form_error('current_password')) { ?>
					<div class="badge text-danger"><?= form_error('current_password') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="password" class="mb-2"><?= $this->lang->line('new_password') ?></label>
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
					   class="mb-2"><?= $this->lang->line('password_conformation') ?></label>
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

			<div class="d-grid gap-2 mb-3">
				<button type="submit" class="btn btn-dark"><?= $this->lang->line('change') ?></button>
			</div>

			<?= form_close() ?>

		</div>
	</div>
</div>
