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
							<?= $this->lang->line('order_status') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/orders') ?>"
							   class="btn btn-dark"><i
									class="bi bi-list"></i> <?= $this->lang->line('orders') ?></a>
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

						<?= form_open('admin/orders/edit/' . $order->id) ?>

						<div class="row">
							<div class="col-12 col-md-5 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="status_id" class="mb-1"><?= $this->lang->line('order_status') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-award"></i></span>
										<select id="status_id" name="status_id" value="<?= set_value('status_id') ?>"
												class="<?php if (form_error('status_id')) { ?> is-invalid <?php } ?> form-select"
												required>
											<?php foreach ($order_statuses as $row) : ?>
												<option
													value="<?= $row->id ?>" <?= ($order->status_id == $row->id) ? 'selected' : '' ?>><?= $row->name ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<?php if (form_error('status_id')) { ?>
										<div class="badge text-danger"><?= form_error('status_id') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<label for="admin_note" class="mb-1"><?= $this->lang->line('admin_note') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-bounding-box-circles"></i></span>
										<input type="text" id="admin_note" name="admin_note"
											   value="<?= set_value('admin_note', $order->admin_note) ?>"
											   class="<?php if (form_error('admin_note')) { ?> is-invalid <?php } ?> form-control"
											   required>
									</div>
									<?php if (form_error('admin_note')) { ?>
										<div class="badge text-danger"><?= form_error('admin_note') ?></div>
									<?php } ?>
								</div>
							</div>
						</div>

					</div>

					<div class="d-grid gap-2 mb-3">
						<button type="submit" class="btn btn-dark"><?= $this->lang->line('edit') ?></button>
					</div>

					<?= form_close() ?>

				</div>

			</div>

		</div>
	</div>
</div>
