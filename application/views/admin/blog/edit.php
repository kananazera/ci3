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
							<?= $this->lang->line('edit_blog') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/blog') ?>"
							   class="btn btn-dark"><i
									class="bi bi-list"></i> <?= $this->lang->line('blog') ?></a>
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

						<?= form_open_multipart('admin/blog/edit/' . $blog->id) ?>

						<div class="badge text-danger mb-3">
							<?= $this->lang->line('slug_info') ?>
						</div>

						<div class="row">
							<div class="col-12 col-md-5 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="slug" class="mb-1"><?= $this->lang->line('slug') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-link"></i></span>
										<input type="text" id="slug" name="slug"
											   value="<?= set_value('slug', $blog->slug) ?>"
											   class="<?php if (form_error('slug')) { ?> is-invalid <?php } ?> form-control">
									</div>
									<?php if (form_error('slug')) { ?>
										<div class="badge text-danger"><?= form_error('slug') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<label for="title" class="mb-1"><?= $this->lang->line('title') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-bounding-box-circles"></i></span>
										<input type="text" id="title" name="title"
											   value="<?= set_value('title', $blog->title) ?>"
											   class="<?php if (form_error('title')) { ?> is-invalid <?php } ?> form-control"
											   required>
									</div>
									<?php if (form_error('title')) { ?>
										<div class="badge text-danger"><?= form_error('title') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<div class="input-group">
										<input type="checkbox" id="is_active" name="is_active"
											   class="form-check-input rounded" <?= ($blog->is_active == 1) ? 'checked' : '' ?>>
										<label for="is_active"
											   class="mx-2"><?= $this->lang->line('is_active') ?></label>
									</div>
								</div>
							</div>

							<div class="col-12 col-md-7 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="content" class="mb-1"><?= $this->lang->line('content') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-bounding-box-circles"></i></span>
										<textarea rows="10" id="content" name="content"
												  class="<?php if (form_error('content')) { ?> is-invalid <?php } ?> form-control"
												  required><?= set_value('content', $blog->content) ?></textarea>
									</div>
									<?php if (form_error('content')) { ?>
										<div class="badge text-danger"><?= form_error('content') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<label for="image" class="mb-1"><?= $this->lang->line('image') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-image"></i></span>
										<input type="file" id="image" name="image"
											   class="<?php if (form_error('image')) { ?> is-invalid <?php } ?> form-control">
									</div>
									<?php if (form_error('image')) { ?>
										<div class="badge text-danger"><?= form_error('image') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<?php if ($blog->image) : ?>
										<div class="text-center">
											<img class="img-fluid blog-img border rounded mb-2"
												 src="<?= base_url('uploads/blog/image/' . $blog->image) ?>"
												 alt="">
											<div>
												<a class="btn btn-danger"
												   href="<?= base_url('admin/blog/image/delete/' . $blog->id) ?>"
												   onclick="if(confirm('<?= $this->lang->line('blog_image_delete_confirm') ?>')){return true;}else{return false;}"><?= $this->lang->line('delete') ?></a>
											</div>
										</div>
									<?php else: ?>
										<div class="badge bg-danger">
											<?= $this->lang->line('no_image') ?>
										</div>
									<?php endif ?>
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
</div>
