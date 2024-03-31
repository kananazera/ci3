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
							<?= $this->lang->line('view') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/orders') ?>"
							   class="btn btn-dark"><?= $this->lang->line('back') ?></a>
						</div>

						<div class="row">
							<div class="col-12 col-md-3 mb-3 mb-md-0">
								<div class="badge text-dark mb-1"><?= $this->lang->line('user') ?></div>
								<div class="mb-3"><?= ($order->user_id == null) ? $this->lang->line('guest_user') : $this->UserModel->show($order->user_id)->email ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('order_status') ?></div>
								<div class="mb-3"><?= $this->OrderStatusModel->show($order->status_id)->name ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('date') ?></div>
								<div class="mb-3"><?= generateDate($order->date) ?></div>
							</div>

							<div class="col-12 col-md-4 mb-3 mb-md-0">
								<div class="badge text-dark mb-1"><?= $this->lang->line('user_note') ?></div>
								<div class="mb-3"><?= $order->user_note ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('admin_note') ?></div>
								<div class="mb-3"><?= $order->admin_note ?></div>
							</div>

							<div class="col-12 col-md-5">
								<div class="badge text-dark mb-1"><?= $this->lang->line('products') ?></div>
								<div><?= $order->data ?></div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
