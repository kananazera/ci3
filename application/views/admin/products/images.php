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
								<?= form_open_multipart('admin/products/images/' . $product->id) ?>
								<div class="row">
									<div class="col-12 col-md-8 mb-md-0">
										<label for="images"
											   class="mb-0"><?= $this->lang->line('product_images') ?></label>
										<div class="input-group">
											<span class="input-group-text"><i class="bi bi-image"></i></span>
											<input type="file" id="images" name="images[]"
												   class="<?php if (form_error('images')) { ?> is-invalid <?php } ?> form-control"
												   multiple required>
										</div>
										<?php if (form_error('images')) { ?>
											<div class="badge text-danger"><?= form_error('images') ?></div>
										<?php } ?>
									</div>

									<div class="col-12 col-md-4 mt-3 mt-md-4">
										<div class="d-grid gap-2 mb-3">
											<button type="submit"
													class="btn btn-dark"><?= $this->lang->line('upload') ?></button>
										</div>
									</div>
								</div>
								<?= form_close() ?>
							</div>

							<div class="col-12 col-md-6 text-center text-md-end ">
								<a href="<?= base_url('admin/products') ?>"
								   class="btn btn-dark"><i
										class="bi bi-list"></i> <?= $this->lang->line('products') ?></a>
							</div>
						</div>

					</div>

					<div class="border rounded p-4">

						<h3 class="text-center mb-3">
							<?= $this->lang->line('product_images') ?>
						</h3>

						<h4 class="text-center text-primary my-4">
							<?= $product->title ?>
						</h4>

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
							<?php foreach ($images as $row) : ?>
								<div class="col-6 col-md-3 mb-4">
									<img class="img-fluid rounded border product-img"
										 src="<?= base_url('uploads/product/image/') . $row->image ?>"
										 alt="">
									<div class="row">
										<div class="col-6">
											<div class="d-grid gap-2">
												<a class="btn btn-danger"
												   href="<?= base_url('admin/products/images/delete/' . $row->id . '/' . $product->id) ?>"
												   onclick="if(confirm('<?= $this->lang->line('product_image_delete_confirm') ?>')){return true;}else{return false;}"><i class="bi bi-trash"></i> <?= $this->lang->line('delete') ?></a>
											</div>
										</div>
										<?php if ($row->main == 0) : ?>
											<div class="col-6">
												<div class="d-grid gap-2">
													<a class="btn btn-dark"
													   href="<?= base_url('admin/products/images/main/' . $row->id . '/' . $product->id) ?>"><i class="bi bi-arrow-right-circle"></i> <?= $this->lang->line('main') ?></a>
												</div>
											</div>
										<?php else: ?>
											<div class="col-6">
												<div class="d-grid gap-2">
													<div class="btn btn-success">
														<i class="bi bi-check2-circle"></i> <?= $this->lang->line('main') ?>
													</div>
												</div>
											</div>
										<?php endif ?>
									</div>
								</div>
							<?php endforeach ?>
						</div>

						<div class="text-center text-danger">
							<?= (empty($images)) ? $this->lang->line('no_image_uploaded_product') : '' ?>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
