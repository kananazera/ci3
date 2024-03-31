<div class="container" data-aos="zoom-in-up">
	<div class="justify-content-center">
		<div class="border rounded p-4">

			<?php if ($this->config->item('send_email_verification_link') == true && $this->session->userdata('auth_user')->email_verified == null) : ?>
				<div class="text-center alert alert-danger">
					<?=$this->lang->line('email_not_verified')?>
				</div>
				<div class="text-center mb-3">
					<a class="link-dark" href="<?=base_url('email/verify/resend')?>"><?=$this->lang->line('verify_email_resend')?></a>
				</div>
			<?php endif ?>

			<h3 class="text-center mb-3">
				<?= $this->lang->line('information') ?>
			</h3>

			<?= form_open('user/information') ?>

			<div class="mb-3">
				<label for="name" class="mb-2"><?= $this->lang->line('name') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-person"></i></span>
					<input type="text" id="name" name="name"
						   value="<?= set_value('name', $this->session->userdata('auth_user')->name) ?>"
						   class="<?php if (form_error('name')) { ?> is-invalid <?php } ?> form-control" required>
				</div>
				<?php if (form_error('name')) { ?>
					<div class="badge text-danger"><?= form_error('name') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="email" class="mb-2"><?= $this->lang->line('email') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-envelope"></i></span>
					<input type="email" id="email" name="email"
						   value="<?= set_value('email', $this->session->userdata('auth_user')->email) ?>"
						   class="<?php if (form_error('email')) { ?> is-invalid <?php } ?> form-control">
				</div>
				<?php if (form_error('email')) { ?>
					<div class="badge text-danger"><?= form_error('email') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="mobile_number" class="mb-2"><?= $this->lang->line('mobile_number') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-phone"></i></span>
					<input type="text" id="mobile_number" name="mobile_number" maxlength="15"
						   value="<?= set_value('mobile_number', $this->session->userdata('auth_user')->mobile_number) ?>"
						   class="<?php if (form_error('mobile_number')) { ?> is-invalid <?php } ?> form-control">
				</div>
				<?php if (form_error('mobile_number')) { ?>
					<div class="badge text-danger"><?= form_error('mobile_number') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="birthday" class="mb-2"><?= $this->lang->line('birthday') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-calendar"></i></span>
					<input type="date" id="birthday" name="birthday"
						   value="<?= set_value('birthday', $this->session->userdata('auth_user')->birthday) ?>"
						   class="<?php if (form_error('birthday')) { ?> is-invalid <?php } ?> form-control">
				</div>
				<?php if (form_error('birthday')) { ?>
					<div class="badge text-danger"><?= form_error('birthday') ?></div>
				<?php } ?>
			</div>

			<div class="mb-3">
				<label for="gender" class="mb-2"><?= $this->lang->line('gender') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-gender-male"></i></span>
					<select name="gender" id="gender"
							class="<?php if (form_error('gender')) { ?> is-invalid <?php } ?> form-select">
						<option value=""><?= $this->lang->line('select') ?></option>
						<option
							value="1" <?= ($this->session->userdata('auth_user')->gender == 1) ? 'selected' : '' ?>><?= $this->lang->line('male') ?></option>
						<option
							value="2" <?= ($this->session->userdata('auth_user')->gender == 2) ? 'selected' : '' ?>><?= $this->lang->line('female') ?></option>
					</select>
				</div>
				<?php if (form_error('gender')) { ?>
					<div class="badge text-danger"><?= form_error('gender') ?></div>
				<?php } ?>
			</div>

			<div class="d-grid gap-2 mb-3">
				<button type="submit" class="btn btn-dark"><?= $this->lang->line('update') ?></button>
			</div>

			<?= form_close() ?>

		</div>
	</div>
</div>

<script>
	let mobile = document.querySelector('#mobile_number')
	mobile.addEventListener('keyup', (e) => {
		let val = e.target.value;
		e.target.value = val
			.replace(/\D/g, '')
			.replace(/(\d{1,3})(\d{1,3})(\d{1,2})(\d{1,2})?/g, function (txt, a, b, c, d) {
				if (d) {
					return `(${a}) ${b}-${c}-${d}`
				} else if (c) {
					return `(${a}) ${b}-${c}`
				} else if (b) {
					return `(${a}) ${b}`
				} else if (a) {
					return `(${a})`
				}
			});
	})
</script>
