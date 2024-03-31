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
							<?= $this->lang->line('contact_message') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/contact/messages') ?>"
							   class="btn btn-dark"><?= $this->lang->line('back') ?></a>
						</div>

						<div class="row">
							<div class="col-12 col-md-6 mb-3 mb-md-0">
								<div class="badge text-dark mb-1"><?= $this->lang->line('name') ?></div>
								<div class="mb-3"><?= $contact_message->name ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('email') ?></div>
								<div class="mb-3"><?= $contact_message->email ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('mobile_number') ?></div>
								<div class="mb-3"><?= $contact_message->mobile_number ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('date') ?></div>
								<div class="mb-3"><?= generateDate($contact_message->date) ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('is_read') ?></div>
								<div
									class="mb-3"><?= ($contact_message->is_read == 1) ? '<div class="badge bg-success">' . $this->lang->line('yes') . '</div>' : '<div class="badge bg-danger text-white">' . $this->lang->line('no') . '</div>' ?></div>

								<div class="badge text-dark mb-1">IP</div>
								<div class="mb-3"><?= $contact_message->ip ?></div>

								<div class="badge text-dark mb-1">User agent</div>
								<div><?= $contact_message->user_agent ?></div>
							</div>

							<div class="col-12 col-md-6">
								<div class="badge text-dark mb-1"><?= $this->lang->line('message') ?></div>
								<div><?= $contact_message->message ?></div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
