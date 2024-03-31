<div class="container" data-aos="zoom-in-up">
	<div class="row justify-content-center">
		<div class="col-12 col-md-5 border rounded p-4">

			<h3 class="text-center mb-3">
				<?= $this->lang->line('reset_password') ?>
			</h3>

			<?php if ($token) { ?>

				<?= form_open('password/reset') ?>
				<?= form_hidden('token', $token->token) ?>
				<?= form_hidden('email', $token->email) ?>

				<div class="mb-3">
					<label class="mb-1"><?= $this->lang->line('email') ?></label>
					<div class="input-group">
						<span class="input-group-text"><i class="bi bi-envelope"></i></span>
						<input value="<?= $token->email ?>" class="form-control" disabled>
					</div>
					<?php if (form_error('email')) { ?>
						<div class="badge text-danger"><?= form_error('email') ?></div>
					<?php } ?>
				</div>

				<div class="mb-3">
					<label for="password" class="mb-1"><?= $this->lang->line('new_password') ?></label>
					<div class="input-group">
						<span class="input-group-text"><i class="bi bi-key"></i></span>
						<input type="password" id="password" name="password"
							   class="<?php if (form_error('password')) { ?> is-invalid <?php } ?> form-control"
							   required>
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

				<div class="d-grid gap-2 mb-3">
					<button type="submit" class="btn btn-dark"><?= $this->lang->line('change_password') ?></button>
				</div>

				<?= form_close() ?>

			<?php } else { ?>

				<div class="text-center alert alert-danger">
					<?= $this->lang->line('reset_password_error') ?>
				</div>

			<?php } ?>

		</div>
	</div>
</div>
