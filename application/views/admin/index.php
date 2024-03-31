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
							<?= $this->lang->line('control_panel') ?>
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

						<div class="row justify-content-center">
							<div class="col-6 col-md-4 mb-3">
								<div class="p-3 border border-danger rounded text-center">
									<h2><?= $this->UserModel->count() ?></h2>
									<div class="badge bg-danger"><?= $this->lang->line('user') ?></div>
								</div>
							</div>

							<div class="col-6 col-md-4 mb-3">
								<div class="p-3 border border-primary rounded text-center">
									<h2><?= $this->PageModel->count() ?></h2>
									<div class="badge bg-primary"><?= $this->lang->line('page') ?></div>
								</div>
							</div>

							<div class="col-6 col-md-4 mb-3">
								<div class="p-3 border border-success rounded text-center">
									<h2><?= $this->CategoryModel->count() ?></h2>
									<div class="badge bg-success"><?= $this->lang->line('category') ?></div>
								</div>
							</div>

							<div class="col-6 col-md-4 mb-3">
								<div class="p-3 border border-warning rounded text-center">
									<h2><?= $this->ProductModel->count() ?></h2>
									<div class="badge bg-warning"><?= $this->lang->line('product') ?></div>
								</div>
							</div>

							<div class="col-6 col-md-4 mb-3">
								<div class="p-3 border border-secondary rounded text-center">
									<h2><?= $this->ContactMessageModel->count() ?></h2>
									<div class="badge bg-secondary"><?= $this->lang->line('contact_message') ?></div>
								</div>
							</div>

							<div class="col-6 col-md-4 mb-3">
								<div class="p-3 border border-info rounded text-center">
									<h2><?= $this->OrderModel->count() ?></h2>
									<div class="badge bg-info"><?= $this->lang->line('order') ?></div>
								</div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
