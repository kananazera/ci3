<div class="container-fluid" data-aos="zoom-in-up">
	<div class="pt-4">
		<div class="container-fluid">

			<div class="row justify-content-center">

				<div class="col-12 col-md-2 mb-3 mb-md-0" data-aos="zoom-in-up">
					<?php $this->load->view('admin/layouts/side') ?>
				</div>

				<div class="col-12 col-md-10" data-aos="zoom-in-up">
					<div class="border rounded p-4">

						<h3 class="text-center mb-3">
							<?= $this->lang->line('create_user') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/users') ?>"
							   class="btn btn-dark"><i class="bi bi-list"></i> <?= $this->lang->line('users') ?></a>
						</div>

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

						<?= form_open('admin/users/create') ?>

						<div class="row">
							<div class="col-12 col-md-6 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="name" class="mb-1"><?= $this->lang->line('name') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-person"></i></span>
										<input type="text" id="name" name="name" value="<?= set_value('name') ?>"
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
										<input type="email" id="email" name="email" value="<?= set_value('email') ?>"
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
											   class="<?php if (form_error('password')) { ?> is-invalid <?php } ?> form-control"
											   required>
									</div>
									<?php if (form_error('password')) { ?>
										<div class="badge text-danger"><?= form_error('password') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<div class="input-group">
										<input type="checkbox" id="is_active" name="is_active"
											   class="form-check-input rounded" checked>
										<label for="is_active" class="mx-2"><?= $this->lang->line('is_active') ?></label>
									</div>
								</div>
							</div>

							<div class="col-12 col-md-6 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="mobile_number"
										   class="mb-2"><?= $this->lang->line('mobile_number') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-phone"></i></span>
										<input type="text" id="mobile_number" name="mobile_number" maxlength="15"
											   value="<?= set_value('mobile_number') ?>"
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
											   value="<?= set_value('birthday') ?>"
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
												value="1" <?= (set_value('gender') == 1) ? 'selected' : '' ?>><?= $this->lang->line('male') ?></option>
											<option
												value="2" <?= (set_value('gender') == 2) ? 'selected' : '' ?>><?= $this->lang->line('female') ?></option>
										</select>
									</div>
									<?php if (form_error('gender')) { ?>
										<div class="badge text-danger"><?= form_error('gender') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<div class="input-group">
										<input type="checkbox" id="email_verified" name="email_verified"
											   class="form-check-input rounded">
										<label for="email_verified" class="mx-2"><?= $this->lang->line('email_verified') ?></label>
									</div>
								</div>
							</div>

						</div>

						<div class="d-grid gap-2 mb-3">
							<button type="submit" class="btn btn-dark"><?= $this->lang->line('create') ?></button>
						</div>

						<?= form_close() ?>

					</div>

				</div>

			</div>
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
