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
								<?= form_open('admin/products/properties/values/create/' . $product->id) ?>
								<div class="input-group">
									<select name="property_id" class="form-select" required>
										<option value=""><?= $this->lang->line('select_property') ?></option>
										<?php foreach ($properties as $property) : ?>
											<option value="<?= $property->id ?>"><?= $property->name ?></option>
										<?php endforeach ?>
									</select>
									<input type="text" name="value" class="form-control"
										   placeholder="<?= $this->lang->line('value') ?>"
										   value="<?= set_value('value') ?>" required>
									<button class="btn btn-dark" type="submit"><i class="bi bi-plus"></i></button>
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
							<?= $this->lang->line('property_values') ?>
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

						<div class="table-responsive">
							<table class="table">
								<thead>
								<tr>
									<th><?= $this->lang->line('property') ?></th>
									<th><?= $this->lang->line('value') ?></th>
									<th><?= $this->lang->line('delete') ?></th>
								</tr>
								</thead>
								<tbody>
								<?php foreach ($property_values as $row) : ?>
									<tr>
										<td><?= $this->PropertyModel->show($row->property_id)->name ?></td>
										<td><?= $row->value ?></td>
										<td><a class="btn btn-sm btn-danger" href="<?= base_url('admin/products/properties/values/delete/' . $row->id .'/' . $product->id) ?>"><i
													class="bi bi-trash"></i></a></td>
									</tr>
								<?php endforeach ?>
								</tbody>
							</table>
						</div>

					</div>
				</div>

			</div>
		</div>
	</div>
</div>
