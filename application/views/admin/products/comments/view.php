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
							<?= $this->lang->line('comment') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/products/comments') ?>"
							   class="btn btn-dark"><?= $this->lang->line('back') ?></a>
						</div>

						<div class="row">
							<div class="col-12 col-md-6 mb-3 mb-md-0">
								<div class="badge text-dark mb-1"><?= $this->lang->line('user') ?></div>
								<div class="mb-3"><?= $this->UserModel->show($comment->user_id)->name ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('product') ?></div>
								<div class="mb-3"><?= $this->ProductModel->show($comment->product_id)->title ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('date') ?></div>
								<div class="mb-3"><?= generateDate($comment->date) ?></div>

								<div class="badge text-dark mb-1"><?= $this->lang->line('is_active') ?></div>
								<div class="mb-3">
									<?= ($comment->is_active == 1)
										? '<div class="badge bg-success">' . $this->lang->line('yes') . '</div>'
										: '<div class="badge bg-danger text-white">' . $this->lang->line('no') . '</div>' ?>
								</div>
								<?php if ($comment->is_active == 0) : ?>
									<a class="btn btn-sm btn-dark"
									   href="<?= base_url('admin/products/comments/approve/' . $comment->id) ?>"><i
											class="bi bi-check2"
											onclick="if(confirm('<?= $this->lang->line('approve_comment_confirm') ?>')){return true;}else{return false;}"></i> <?= $this->lang->line('approve') ?>
									</a>
								<?php endif ?>
							</div>

							<div class="col-12 col-md-6">
								<div class="badge text-dark mb-1"><?= $this->lang->line('comment') ?></div>
								<div><?= $comment->comment ?></div>
							</div>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
