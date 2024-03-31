<div class="container-fluid" data-aos="zoom-in-up">
	<div class="pt-4">
		<div class="container-fluid">
			<div class="row justify-content-center">

				<div class="col-12 col-md-2 mb-3 mb-md-0" data-aos="zoom-in-up">
					<?php $this->load->view('admin/layouts/side') ?>
				</div>

				<div class="col-12 col-md-10" data-aos="zoom-in-up">

					<div class="border rounded p-4 mb-3">
						<div class="row">
							<div class="col-6">
								<?= form_open('admin/products/comments') ?>
								<div class="input-group">
									<input type="search" name="search" class="form-control"
										   placeholder="<?= $this->lang->line('search') ?>"
										   value="<?= set_value('search') ?>">
									<button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
								</div>
								<?= form_close() ?>
							</div>
						</div>
					</div>

					<div class="border rounded p-4">

						<h3 class="text-center mb-3">
							<?= $this->lang->line('comments') ?>
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

						<div class="table-responsive">
							<table class="table">
								<thead>
								<tr>
									<th><?= $this->lang->line('user') ?></th>
									<th><?= $this->lang->line('product') ?></th>
									<th><?= $this->lang->line('date') ?></th>
									<th><?= $this->lang->line('is_active') ?></th>
									<th><?= $this->lang->line('view') ?></th>
									<th><?= $this->lang->line('delete') ?></th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($comments as $row) : ?>
									<tr>
										<td><?= $this->UserModel->show($row->user_id)->name ?></td>
										<td><?= $this->ProductModel->show($row->product_id)->title ?></td>
										<td><?= generateDate($row->date) ?></td>
										<td><?= ($row->is_active == 1) ? '<div class="badge bg-success">' . $this->lang->line('yes') . '</div>' : '<div class="badge bg-danger text-white">' . $this->lang->line('no') . '</div>' ?></td>
										<td><a class="btn btn-sm btn-dark"
											   href="<?= base_url('admin/products/comments/view/' . $row->id) ?>"><i
													class="bi bi-search"></i></a></td>
										<td><a class="btn btn-sm btn-dark"
											   href="<?= base_url('admin/products/comments/delete/' . $row->id) ?>"
											   onclick="if(confirm('<?= $this->lang->line('delete_comment_confirm') ?>')){return true;}else{return false;}"><i
													class="bi bi-trash"></i></a></td>
									</tr>
								<?php endforeach ?>
								</tbody>
							</table>
						</div>

						<div class="mt-3">
							<?= $this->pagination->create_links() ?>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
