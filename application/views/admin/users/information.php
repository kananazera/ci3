<?= form_open('admin/users/edit/' . $user->id) ?>

	<div class="row">
		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<div class="mb-3">
				<label for="name" class="mb-1"><?= $this->lang->line('name') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-person"></i></span>
					<input type="text" id="name" name="name"
						   value="<?= set_value('name', $user->name) ?>"
						   class="<?php if (form_error('name')) { ?> is-invalid <?php } ?> form-control"
						   required>
				</div>
				<?php if (form_error('name')) { ?>
					<div class="badge text-danger"><?= form_error('name') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="email" class="mb-1"><?= $this->lang->line('email') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-envelope"></i></span>
					<input type="email" id="email" name="email"
						   value="<?= set_value('email', $user->email) ?>"
						   class="<?php if (form_error('email')) { ?> is-invalid <?php } ?> form-control"
						   required>
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
						   class="<?php if (form_error('password')) { ?> is-invalid <?php } ?> form-control">
				</div>
				<?php if (form_error('password')) { ?>
					<div class="badge text-danger"><?= form_error('password') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<div class="input-group">
					<input type="checkbox" id="is_active" name="is_active"
						   class="form-check-input rounded" <?= ($user->is_active == 1) ? 'checked' : '' ?>>
					<label for="is_active"
						   class="mx-2"><?= $this->lang->line('is_active') ?></label>
				</div>
			</div>
		</div>

		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<div class="mb-3">
				<label for="mobile_number"
					   class="mb-1"><?= $this->lang->line('mobile_number') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-phone"></i></span>
					<input type="text" id="mobile_number" name="mobile_number" maxlength="15"
						   value="<?= set_value('mobile_number', $user->mobile_number) ?>"
						   class="<?php if (form_error('mobile_number')) { ?> is-invalid <?php } ?> form-control">
				</div>
				<?php if (form_error('mobile_number')) { ?>
					<div class="badge text-danger"><?= form_error('mobile_number') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="birthday" class="mb-1"><?= $this->lang->line('birthday') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-calendar"></i></span>
					<input type="date" id="birthday" name="birthday"
						   value="<?= set_value('birthday', $user->birthday) ?>"
						   class="<?php if (form_error('birthday')) { ?> is-invalid <?php } ?> form-control">
				</div>
				<?php if (form_error('birthday')) { ?>
					<div class="badge text-danger"><?= form_error('birthday') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="gender" class="mb-1"><?= $this->lang->line('gender') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-gender-male"></i></span>
					<select name="gender" id="gender"
							class="<?php if (form_error('gender')) { ?> is-invalid <?php } ?> form-select">
						<option value=""><?= $this->lang->line('select') ?></option>
						<option
							value="1" <?= (set_value('gender', $user->gender) == 1) ? 'selected' : '' ?>><?= $this->lang->line('male') ?></option>
						<option
							value="2" <?= (set_value('gender', $user->gender) == 2) ? 'selected' : '' ?>><?= $this->lang->line('female') ?></option>
					</select>
				</div>
				<?php if (form_error('gender')) { ?>
					<div class="badge text-danger"><?= form_error('gender') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<div class="input-group">
					<input type="checkbox" id="email_verified" name="email_verified"
						   class="form-check-input rounded" <?= ($user->email_verified != null) ? 'checked' : '' ?>>
					<label for="email_verified"
						   class="mx-2"><?= $this->lang->line('email_verified') ?></label>
				</div>
			</div>
		</div>
	</div>

	<div class="d-grid gap-2 mb-3">
		<button type="submit" class="btn btn-dark"><?= $this->lang->line('edit') ?></button>
	</div>

<?= form_close() ?>
