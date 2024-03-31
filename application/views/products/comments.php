<?php if ($this->session->has_userdata('authenticated')) : ?>
	<?= form_open('product/comment/write/' . $product->id) ?>
	<div class="row">
		<div class="col-12 col-6">
			<div class="mb-3">
				<div class="input-group">
					<span class="input-group-text"><i class="bi bi-chat"></i></span>
					<textarea rows="2" placeholder="<?= $this->lang->line('comment') ?>" name="comment"
							  class="<?php if (form_error('comment')) { ?> is-invalid <?php } ?> form-control"
							  required></textarea>
					<button type="submit" class="btn btn-dark"><?= $this->lang->line('send') ?></button>
				</div>
				<?php if (form_error('comment')) { ?>
					<div class="badge text-danger"><?= form_error('comment') ?></div>
				<?php } ?>
			</div>
		</div>
	</div>
	<?= form_close() ?>
<?php else: ?>
	<div class="mb-2">
		<?= $this->lang->line('comment_info') ?>
	</div>
	<div>
		<a class="link-dark" target="_blank"
		   href="<?= base_url('login') ?>"><?= $this->lang->line('login') ?></a> <?= $this->lang->line('or') ?>
		<a class="link-dark" target="_blank" href="<?= base_url('register') ?>"><?= $this->lang->line('register') ?></a>
	</div>
<?php endif ?>

<?php foreach ($comments as $comment) : ?>
	<div class="border rounded mb-2 px-3 py-2">

		<div class="row">
			<div class="col-6">
				<div class="badge text-dark">
					<?= $this->UserModel->show($comment->user_id)->name ?>
				</div>
			</div>
			<?php if ($comment->user_id == $this->session->userdata('auth_user')->id) : ?>
				<div class="col-6 text-end">
					<a class="link-dark"
					   href="<?= base_url('product/comment/delete/' . $comment->id . '/' . $product->id) ?>">
						<i class="mobile-icons bi bi-trash"></i>
					</a>
				</div>
			<?php endif ?>
		</div>

		<div class="mb-2">
			<div class="badge text-dark">
				<?= generateDate($comment->date) ?>
			</div>
		</div>

		<div>
			<?= $comment->comment ?>
		</div>
	</div>
<?php endforeach ?>

<div class="mt-3">
	<?= $this->pagination->create_links() ?>
</div>
