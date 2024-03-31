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
							<?= $this->lang->line('create_property') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/products/properties') ?>"
							   class="btn btn-dark"><i
									class="bi bi-list"></i> <?= $this->lang->line('properties') ?></a>
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

						<?= form_open('admin/products/properties/create') ?>

						<div class="row">
							<div class="col-12 col-md-5 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="name" class="mb-1"><?= $this->lang->line('property') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-bounding-box-circles"></i></span>
										<input type="text" id="name" name="name" value="<?= set_value('name') ?>"
											   class="<?php if (form_error('name')) { ?> is-invalid <?php } ?> form-control"
											   required>
									</div>
									<?php if (form_error('name')) { ?>
										<div class="badge text-danger"><?= form_error('name') ?></div>
									<?php } ?>
								</div>
								<div class="d-grid gap-2 mb-3">
									<button type="submit" class="btn btn-dark"><?= $this->lang->line('create') ?></button>
								</div>
							</div>
						</div>

						<?= form_close() ?>

					</div>

				</div>

			</div>
		</div>
	</div>
</div>
