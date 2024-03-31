<?= form_open_multipart('user/photo') ?>

	<div class="mb-3">
		<label for="photo" class="mb-1"><?= $this->lang->line('photo') ?></label>
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

	<div class="justify-content-center border rounded d-flex mb-3">
		<?php if ($user->photo) { ?>
			<img class="img-fluid p-1 rounded"
				 src="<?= base_url('uploads/user/photo/') . $user->photo ?>" alt="">
		<?php } else { ?>
			<img class="img-fluid p-1 rounded" src="<?= base_url('assets/img/no-user-photo.jpg') ?>" alt="">
		<?php } ?>
	</div>

	<div class="d-grid gap-2 mb-3">
		<button type="submit" class="btn btn-dark"><?= $this->lang->line('upload') ?></button>
	</div>

<?= form_close() ?>

<?php if ($user->photo) { ?>
	<div class="d-grid gap-2">
		<a href="<?= base_url('admin/users/photo/delete/' . $user->id) ?>" class="btn btn-danger"
		   onclick="if(confirm('<?= $this->lang->line('user_photo_delete_confirm') ?>')){return true;}else{return false;}"><?= $this->lang->line('user_photo_delete') ?></a>
	</div>
<?php } ?>
