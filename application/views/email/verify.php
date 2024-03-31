<?php $this->load->view('email/layouts/header'); ?>

<div class="center">
	<div class="mb-5">
		<strong><?= $this->lang->line('verify_email_info') ?></strong>
	</div>
	<div class="mb-5">
		<a id="button" href="<?= $link ?>"><?= $this->lang->line('verify_email') ?></a>
	</div>
</div>

<?php $this->load->view('email/layouts/footer'); ?>
