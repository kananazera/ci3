<div class="container" data-aos="zoom-in-up">
	<div class="justify-content-center">
		<div class="border rounded p-4">

			<h3 class="text-center mb-3">
				<?= $this->lang->line('photo') ?>
			</h3>

			<div class="justify-content-center border rounded d-flex mb-3">
				<?php if ($this->session->userdata('auth_user')->photo) { ?>
					<img class="img-fluid p-1 rounded"
						 src="<?= base_url('uploads/user/photo/') . $this->session->userdata('auth_user')->photo ?>" alt="">
				<?php } else { ?>
					<img class="img-fluid p-1 rounded" src="<?= base_url('assets/img/no-user-photo.jpg') ?>" alt="">
				<?php } ?>
			</div>

			<?= form_open_multipart('user/photo') ?>

			<div class="mb-3">
				<label for="photo" class="mb-2"><?= $this->lang->line('photo') ?></label>
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-image"></i></span>
					<input type="file" id="photo" name="photo"
						   class="<?php if (form_error('photo')) { ?> is-invalid <?php } ?> form-control"
						   required>
				</div>
				<?php if (form_error('photo')) { ?>
					<div class="badge text-danger"><?= form_error('photo') ?></div>
				<?php } ?>
			</div>

			<div class="d-grid gap-2 mb-3">
				<button type="submit" class="btn btn-dark"><?= $this->lang->line('upload') ?></button>
			</div>

			<?= form_close() ?>

		</div>
	</div>
</div>
