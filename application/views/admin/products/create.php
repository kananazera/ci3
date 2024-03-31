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
							<?= $this->lang->line('create_product') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/products') ?>"
							   class="btn btn-dark"><i
									class="bi bi-list"></i> <?= $this->lang->line('products') ?></a>
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

						<?= form_open_multipart('admin/products/create') ?>

						<div class="badge text-danger mb-3">
							<?= $this->lang->line('slug_info') ?>
						</div>

						<div class="row">
							<div class="col-12 col-md-4 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="category_id" class="mb-1"><?= $this->lang->line('category') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-bookmarks"></i></span>
										<select name="category_id" id="category_id"
												class="<?php if (form_error('category_id')) { ?> is-invalid <?php } ?> form-select">
											<option value=""><?= $this->lang->line('select') ?></option>
											<?php foreach ($categories as $row) : ?>
												<option
													value="<?= $row->id ?>" <?= (set_value('category_id') == $row->id) ? 'selected' : '' ?>><?= $row->name ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<?php if (form_error('category_id')) { ?>
										<div class="badge text-danger"><?= form_error('category_id') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<label for="slug" class="mb-1"><?= $this->lang->line('slug') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-link"></i></span>
										<input type="text" id="slug" name="slug" value="<?= set_value('slug') ?>"
											   class="<?php if (form_error('slug')) { ?> is-invalid <?php } ?> form-control">
									</div>
									<?php if (form_error('slug')) { ?>
										<div class="badge text-danger"><?= form_error('slug') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<div class="input-group">
										<input type="checkbox" id="is_active" name="is_active"
											   class="form-check-input rounded" checked>
										<label for="is_active"
											   class="mx-2"><?= $this->lang->line('is_active') ?></label>
									</div>
								</div>
							</div>

							<div class="col-12 col-md-4 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="title" class="mb-1"><?= $this->lang->line('title') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-app-indicator"></i></span>
										<input type="text" id="title" name="title" value="<?= set_value('title') ?>"
											   class="<?php if (form_error('title')) { ?> is-invalid <?php } ?> form-control"
											   required>
									</div>
									<?php if (form_error('title')) { ?>
										<div class="badge text-danger"><?= form_error('title') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<label for="quantity" class="mb-1"><?= $this->lang->line('quantity') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-bounding-box-circles"></i></span>
										<input type="number" id="quantity" name="quantity"
											   value="<?= set_value('quantity') ?>"
											   class="<?php if (form_error('quantity')) { ?> is-invalid <?php } ?> form-control"
											   required>
									</div>
									<?php if (form_error('quantity')) { ?>
										<div class="badge text-danger"><?= form_error('quantity') ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="col-12 col-md-4">
								<div class="mb-3">
									<label for="price" class="mb-1"><?= $this->lang->line('price') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-cash"></i></span>
										<input type="number" id="price" name="price" step="0.01" value="<?= set_value('price') ?>"
											   class="<?php if (form_error('price')) { ?> is-invalid <?php } ?> form-control"
											   required>
									</div>
									<?php if (form_error('price')) { ?>
										<div class="badge text-danger"><?= form_error('price') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<label for="discount_rate" class="mb-1"><?= $this->lang->line('discount_rate') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-percent"></i></span>
										<input type="number" id="discount_rate" name="discount_rate" value="<?= set_value('discount_rate') ?>"
											   class="<?php if (form_error('discount_rate')) { ?> is-invalid <?php } ?> form-control">
									</div>
									<?php if (form_error('discount_rate')) { ?>
										<div class="badge text-danger"><?= form_error('discount_rate') ?></div>
									<?php } ?>
								</div>
							</div>
						</div>

						<div class="mb-3">
							<label for="description"
								   class="mb-1"><?= $this->lang->line('description') ?></label>
							<div class="input-group">
								<span class="input-group-text"><i class="bi bi-chat-right-text"></i></span>
								<textarea rows="10" id="description" name="description"
										  class="<?php if (form_error('description')) { ?> is-invalid <?php } ?> form-control"
										  required><?= set_value('description') ?></textarea>
							</div>
							<?php if (form_error('description')) { ?>
								<div class="badge text-danger"><?= form_error('description') ?></div>
							<?php } ?>
						</div>

						<div class="d-grid gap-2 mb-3">
							<button type="submit" class="btn btn-dark"><?= $this->lang->line('create') ?></button>
						</div>

						<?= form_close() ?>

					</div>

				</div>

			</div>
		</div>
	</div>
</div>
