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
							<?= $this->lang->line('edit_user') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/users') ?>"
							   class="btn btn-dark"><i
									class="bi bi-list"></i> <?= $this->lang->line('users') ?></a>
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

						<?php $data['user'] = $user; ?>

						<div class="row">
							<div class="col-12 col-md-8 mb-3 mb-md-0">
								<?php $this->load->view('admin/users/information', $data); ?>
							</div>

							<div class="col-12 col-md-4">
								<?php $this->load->view('admin/users/photo', $data); ?>
							</div>
						</div>

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
