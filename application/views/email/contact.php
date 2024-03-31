<?php $this->load->view('email/layouts/header'); ?>

<div class="mb-2">
	<?= $this->lang->line('name') ?>: <strong><?= $name ?></strong>
</div>
<div class="mb-2">
	<?= $this->lang->line('email') ?>: <strong><?= $email ?></strong>
</div>
<div class="mb-2">
	<?= $this->lang->line('mobile_number') ?>: <strong><?= $mobile_number ?></strong>
</div>
<div class="mb-2">
	IP: <strong><?= $ip ?></strong>
</div>
<div class="mb-2">
	User agent: <strong><?= $user_agent ?></strong>
</div>
<div class="mb-2">
	<?= $this->lang->line('message') ?>: <strong><?= $message ?></strong>
</div>

<?php $this->load->view('email/layouts/footer'); ?>
