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
							<div class="col-12 col-md-6 mb-4 mb-md-0">
								<?= form_open('admin/users') ?>
								<div class="input-group">
									<input type="search" name="search" class="form-control"
										   placeholder="<?= $this->lang->line('search') ?>"
										   value="<?= set_value('search') ?>">
									<button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
								</div>
								<?= form_close() ?>
							</div>

							<div class="col-12 col-md-6 text-center text-md-end ">
								<a href="<?= base_url('admin/users/create') ?>"
								   class="btn btn-dark"><i
										class="bi bi-plus-circle"></i> <?= $this->lang->line('create_user') ?></a>
							</div>
						</div>

					</div>

					<div class="border rounded p-4">

						<h3 class="text-center mb-3">
							<?= $this->lang->line('users') ?>
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
									<th><?= $this->lang->line('name') ?></th>
									<th><?= $this->lang->line('email') ?></th>
									<th><?= $this->lang->line('mobile_number') ?></th>
									<th><?= $this->lang->line('birthday') ?></th>
									<th><?= $this->lang->line('gender') ?></th>
									<th><?= $this->lang->line('registration_date') ?></th>
									<th><?= $this->lang->line('email_verified') ?></th>
									<th><?= $this->lang->line('is_active') ?></th>
									<th><?= $this->lang->line('edit') ?></th>
									<th><?= $this->lang->line('delete') ?></th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($users as $row) : ?>
									<tr>
										<td><?= $row->name ?></td>
										<td><?= $row->email ?></td>
										<td><?= $row->mobile_number ?></td>
										<td><?= ($row->birthday) ? generateDate($row->birthday, 'birthday') : '' ?></td>
										<td><?= ($row->gender == 1) ? $this->lang->line('male') : (($row->gender == 2) ? $this->lang->line('female') : '') ?></td>
										<td><?= generateDate($row->registration_date) ?></td>
										<td><?= ($row->email_verified == null) ? '<div class="badge bg-danger">' . $this->lang->line('no') . '</div>' : generateDate($row->email_verified) ?></td>
										<td><?= ($row->is_active == 1) ? '<div class="badge bg-success">' . $this->lang->line('yes') . '</div>' : '<div class="badge bg-danger text-white">' . $this->lang->line('no') . '</div>' ?></td>
										<td><a class="btn btn-sm btn-dark" href="<?= base_url('admin/users/edit/' . $row->id) ?>"><i
													class="bi bi-pencil"></i></a></td>
										<td><a class="btn btn-sm btn-dark" href="<?= base_url('admin/users/delete/' . $row->id) ?>"
											   onclick="if(confirm('<?= $this->lang->line('user_delete_confirm') ?>')){return true;}else{return false;}"><i
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
