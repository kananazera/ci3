<div class="container" data-aos="zoom-in-up">

	<h3 class="text-center mb-3">
		<?= $this->lang->line('contact') ?>
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

	<div class="text-center mb-3">
		<strong>
			<?= $this->lang->line('contact_info') ?>
		</strong>
	</div>

	<div class="row">

		<div class="col-12 col-md-6 mb-3 mb-md-0">
			<div class="container mb-3" data-aos="zoom-in-up">
				<div class="justify-content-center">
					<div class="border rounded p-4">
						<div class="mb-2">
							<strong><?= $this->lang->line('email') ?></strong>: <a class="link-dark"
																				   href="mailto:<?= $this->config->item('admin_email') ?>"><?= $this->config->item('admin_email') ?></a>
						</div>
						<div>
							<strong><?= $this->lang->line('mobile_number') ?></strong>: <a class="link-dark"
																						   href="tel:<?= $this->config->item('admin_mobile_number') ?>"><?= $this->config->item('admin_mobile_number') ?></a>
						</div>
					</div>
				</div>
			</div>

			<div class="container" data-aos="zoom-in-up">
				<div class="justify-content-center">
					<div class="border rounded p-4">
						<a target="_blank" class="link-dark mx-1" href="<?= $this->config->item('facebook_url') ?>"><i
								class="socials bi bi-facebook"></i></a>
						<a target="_blank" class="link-dark mx-1" href="<?= $this->config->item('instagram_url') ?>"><i
								class="socials bi bi-instagram"></i></a>
						<a target="_blank" class="link-dark mx-1" href="<?= $this->config->item('twitter_url') ?>"><i
								class="socials bi bi-twitter"></i></a>
						<a target="_blank" class="link-dark mx-1" href="<?= $this->config->item('linkedin_url') ?>"><i
								class="socials bi bi-linkedin"></i></a>
						<a target="_blank" class="link-dark mx-1" href="<?= $this->config->item('youtube_url') ?>"><i
								class="socials bi bi-youtube"></i></a>
						<a target="_blank" class="link-dark mx-1" href="<?= $this->config->item('whatsapp_url') ?>"><i
								class="socials bi bi-whatsapp"></i></a>
					</div>
				</div>
			</div>
		</div>

		<div class="col-12 col-md-6">
			<div class="container" data-aos="zoom-in-up">
				<div class="justify-content-center">
					<div class="border rounded p-4">

						<?= form_open('contact') ?>

						<div class="mb-3">
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-person"></i></span>
								<input type="text" name="name" placeholder="<?= $this->lang->line('name') ?>"
									   value="<?= $this->session->has_userdata('auth_user') ? $this->session->userdata('auth_user')->name : set_value('name') ?>"
									   class="<?php if (form_error('name')) { ?> is-invalid <?php } ?> form-control"
									   required>
							</div>
							<?php if (form_error('name')) { ?>
								<div class="badge text-danger"><?= form_error('name') ?></div>
							<?php } ?>
						</div>

						<div class="mb-3">
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-envelope"></i></span>
								<input type="email" name="email" placeholder="<?= $this->lang->line('email') ?>"
									   value="<?= $this->session->has_userdata('auth_user') ? $this->session->userdata('auth_user')->email : set_value('email') ?>"
									   class="<?php if (form_error('email')) { ?> is-invalid <?php } ?> form-control"
									   required>
							</div>
							<?php if (form_error('email')) { ?>
								<div class="badge text-danger"><?= form_error('email') ?></div>
							<?php } ?>
						</div>

						<div class="mb-3">
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-phone"></i></span>
								<input type="text" id="mobile_number" maxlength="15" name="mobile_number"
									   placeholder="<?= $this->lang->line('mobile_number') ?>"
									   value="<?= $this->session->has_userdata('auth_user') ? $this->session->userdata('auth_user')->mobile_number : set_value('mobile_number') ?>"
									   class="<?php if (form_error('mobile_number')) { ?> is-invalid <?php } ?> form-control"
									   required>
							</div>
							<?php if (form_error('mobile_number')) { ?>
								<div class="badge text-danger"><?= form_error('mobile_number') ?></div>
							<?php } ?>
						</div>

						<div class="mb-3">
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-chat-dots"></i></span>
								<textarea rows="5" name="message" placeholder="<?= $this->lang->line('message') ?>"
										  class="<?php if (form_error('message')) { ?> is-invalid <?php } ?> form-control"
										  required><?= set_value('message') ?></textarea>
							</div>
							<?php if (form_error('message')) { ?>
								<div class="badge text-danger"><?= form_error('message') ?></div>
							<?php } ?>
						</div>

						<div class="d-grid gap-2 mb-3">
							<button type="submit" class="btn btn-dark"><?= $this->lang->line('send') ?></button>
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
