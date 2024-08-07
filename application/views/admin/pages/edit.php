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
							<?= $this->lang->line('edit_page') ?>
						</h3>

						<div class="mb-3 text-end">
							<a href="<?= base_url('admin/pages') ?>"
							   class="btn btn-dark"><i
										class="bi bi-list"></i> <?= $this->lang->line('pages') ?></a>
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

						<?= form_open('admin/pages/edit/' . $page->id) ?>

						<div class="row">
							<div class="col-12 col-md-5 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="title" class="mb-1"><?= $this->lang->line('title') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-chat-square-text"></i></span>
										<input type="text" id="title" name="title"
											   value="<?= set_value('title', $page->title) ?>"
											   class="<?php if (form_error('title')) { ?> is-invalid <?php } ?> form-control"
											   required>
									</div>
									<?php if (form_error('title')) { ?>
										<div class="badge text-danger"><?= form_error('title') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3">
									<label for="lang" class="mb-1"><?= $this->lang->line('lang') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-globe2"></i></span>
										<select <?= $page->type == 'default' ? 'disabled' : '' ?> name="lang" id="lang"
																								  class="<?php if (form_error('lang')) { ?> is-invalid <?php } ?> form-select"
																								  required>
											<option value=""><?= $this->lang->line('select') ?></option>
											<?php foreach ($this->config->item('languages') as $key => $value) : ?>
												<option
														value="<?= $key ?>" <?= ($page->lang == $key) ? 'selected' : '' ?>><?= $value ?></option>
											<?php endforeach ?>
										</select>
									</div>
									<?php if (form_error('lang')) { ?>
										<div class="badge text-danger"><?= form_error('lang') ?></div>
									<?php } ?>
								</div>
							</div>

							<div class="col-12 col-md-7 mb-3 mb-md-0">
								<div class="mb-3">
									<label for="page_id" class="mb-1"><?= $this->lang->line('main_page') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-bookmark"></i></span>
										<select <?= $page->type == 'default' ? 'disabled' : '' ?> name="page_id"
																								  id="page_id"
																								  class="<?php if (form_error('page_id')) { ?> is-invalid <?php } ?> form-select">
											<option value=""><?= $this->lang->line('select') ?></option>

											<?php foreach ($main_pages as $row) { ?>
												<option value="<?= $row->id ?>" <?= ($page->page_id == $row->id) ? 'selected' : '' ?>>
													<?= $row->title ?> - (<?= $row->lang ?>)
												</option>
											<?php } ?>

										</select>
									</div>
									<?php if (form_error('type')) { ?>
										<div class="badge text-danger"><?= form_error('type') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3" id="type-area">
									<label for="type" class="mb-1"><?= $this->lang->line('page_type') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-hash"></i></span>
										<select name="type" id="type"
												class="<?php if (form_error('type')) { ?> is-invalid <?php } ?> form-select">
											<option value=""><?= $this->lang->line('select') ?></option>
											<option value="navigation" <?= ($page->type == 'navigation') ? 'selected' : '' ?>>
												Navigation
											</option>
											<option value="footer" <?= ($page->type == 'footer') ? 'selected' : '' ?>>
												Footer
											</option>
										</select>
									</div>
									<?php if (form_error('type')) { ?>
										<div class="badge text-danger"><?= form_error('type') ?></div>
									<?php } ?>
								</div>

								<div class="mb-3" id="slug-area">
									<label for="slug" class="mb-1"><?= $this->lang->line('slug') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-link"></i></span>
										<input type="text" id="slug" name="slug" value="<?= $page->slug ?>"
											   class="<?php if (form_error('slug')) { ?> is-invalid <?php } ?> form-control">
									</div>
									<?php if (form_error('slug')) { ?>
										<div class="badge text-danger"><?= form_error('slug') ?></div>
									<?php } ?>
									<div class="badge text-danger mb-3">
										<?= $this->lang->line('slug_info') ?>
									</div>
								</div>

								<div class="mb-3">
									<div class="input-group">
										<input type="checkbox" id="is_active" name="is_active"
											   class="form-check-input rounded" <?= ($page->is_active == 1) ? 'checked' : '' ?>>
										<label for="is_active"
											   class="mx-2"><?= $this->lang->line('is_active') ?></label>
									</div>
								</div>
							</div>

							<div class="col-12 mb-3 mb-md-0" id="content-area">
								<div class="mb-3">
									<label for="content" class="mb-1"><?= $this->lang->line('content') ?></label>
									<div class="input-group">
										<span class="input-group-text"><i class="bi bi-body-text"></i></span>
										<textarea rows="15" id="content" name="content"
												  class="<?php if (form_error('content')) { ?> is-invalid <?php } ?> form-control"><?= set_value('content') ?></textarea>
									</div>
									<?php if (form_error('content')) { ?>
										<div class="badge text-danger"><?= form_error('content') ?></div>
									<?php } ?>
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

<script>
	document.addEventListener("DOMContentLoaded", function () {
		var selectElement = document.getElementById("page_id");
		var content = document.getElementById("content-area");
		var slug = document.getElementById("slug-area");
		var type = document.getElementById("type-area");

		<?php if($page->page_id == null) { ?>
			slug.style.display = "none";
			content.style.display = "none";
			type.style.display = "block";
		<?php } else { ?>
			slug.style.display = "block";
			content.style.display = "block";
			type.style.display = "none";
		<?php } ?>

		selectElement.addEventListener("change", function () {
			if (selectElement.value != "") {
				slug.style.display = "block";
				content.style.display = "block";
				type.style.display = "none";
			} else {
				slug.style.display = "none";
				content.style.display = "none";
				type.style.display = "block";
			}
		});
	});
</script>
