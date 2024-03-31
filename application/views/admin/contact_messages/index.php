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
							<?= $this->lang->line('contact_messages') ?>
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
									<th><?= $this->lang->line('message') ?></th>
									<th><?= $this->lang->line('is_read') ?></th>
									<th><?= $this->lang->line('date') ?></th>
									<th><?= $this->lang->line('view') ?></th>
									<th><?= $this->lang->line('delete') ?></th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($contact_messages as $row) : ?>
									<tr>
										<td><?= $row->name ?></td>
										<td><?= $row->email ?></td>
										<td><?= $row->mobile_number ?></td>
										<td><?= mb_substr($row->message, 0, 10, 'utf-8') ?> ...</td>
										<td><?= ($row->is_read == 1) ? '<div class="badge bg-success">' . $this->lang->line('yes') . '</div>' : '<div class="badge bg-danger text-white">' . $this->lang->line('no') . '</div>' ?></td>
										<td><?= generateDate($row->date) ?></td>
										<td><a class="btn btn-sm btn-dark" href="<?= base_url('admin/contact/messages/view/' . $row->id) ?>"><i
													class="bi bi-search"></i></a></td>
										<td><a class="btn btn-sm btn-dark" href="<?= base_url('admin/contact/messages/delete/' . $row->id) ?>"
											   onclick="if(confirm('<?= $this->lang->line('contact_message_delete_confirm') ?>')){return true;}else{return false;}"><i
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
