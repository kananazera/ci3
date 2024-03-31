<div class="accordion" id="accordion">
	<div class="accordion-item">
		<h2 class="accordion-header">
			<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
					data-bs-target="#flush-order" aria-expanded="false" aria-controls="flush-order">
				<i class="bi bi-list-ul mx-1"></i> <?= $this->lang->line('order') ?>
			</button>
		</h2>
		<div id="flush-order" class="accordion-collapse collapse" data-bs-parent="#accordion">
			<div class="accordion-body">
				<ul>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/orders') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('orders') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/orders/statuses') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('order_statuses') ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header">
			<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
					data-bs-target="#flush-category" aria-expanded="false" aria-controls="flush-category">
				<i class="bi bi-bookmarks mx-1"></i> <?= $this->lang->line('category') ?>
			</button>
		</h2>
		<div id="flush-category" class="accordion-collapse collapse" data-bs-parent="#accordion">
			<div class="accordion-body">
				<ul>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/categories') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('categories') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/categories/create') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('create_category') ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header">
			<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
					data-bs-target="#flush-product" aria-expanded="false" aria-controls="flush-product">
				<i class="bi bi-cast mx-1"></i> <?= $this->lang->line('product') ?>
			</button>
		</h2>
		<div id="flush-product" class="accordion-collapse collapse" data-bs-parent="#accordion">
			<div class="accordion-body">
				<ul>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/products') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('products') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/products/create') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('create_product') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/products/properties') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('properties') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/products/currencies') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('currencies') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/products/comments') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('comments') ?></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header">
			<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
					data-bs-target="#flush-page" aria-expanded="false" aria-controls="flush-page">
				<i class="bi bi-file-earmark mx-1"></i> <?= $this->lang->line('page') ?>
			</button>
		</h2>
		<div id="flush-page" class="accordion-collapse collapse" data-bs-parent="#accordion">
			<div class="accordion-body">
				<ul>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/pages') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('pages') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/pages/create') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('create_page') ?></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header">
			<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
					data-bs-target="#flush-user" aria-expanded="false" aria-controls="flush-user">
				<i class="bi bi-people mx-1"></i> <?= $this->lang->line('user') ?>
			</button>
		</h2>
		<div id="flush-user" class="accordion-collapse collapse" data-bs-parent="#accordion">
			<div class="accordion-body">
				<ul>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/users') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('users') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/users/create') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('create_user') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/contact/messages') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('contact_messages') ?></a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header">
			<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
					data-bs-target="#flush-location" aria-expanded="false" aria-controls="flush-location">
				<i class="bi bi-geo mx-1"></i> <?= $this->lang->line('location') ?>
			</button>
		</h2>
		<div id="flush-location" class="accordion-collapse collapse" data-bs-parent="#accordion">
			<div class="accordion-body">
				<ul>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/countries') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('countries') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/countries/create') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('create_country') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/cities') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('cities') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/cities/create') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('create_city') ?></a></li>
				</ul>
			</div>
		</div>
	</div>

	<div class="accordion-item">
		<h2 class="accordion-header">
			<button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
					data-bs-target="#flush-blog" aria-expanded="false" aria-controls="flush-blog">
				<i class="bi bi-book mx-1"></i> <?= $this->lang->line('blog') ?>
			</button>
		</h2>
		<div id="flush-blog" class="accordion-collapse collapse" data-bs-parent="#accordion">
			<div class="accordion-body">
				<ul>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/blog') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('blog') ?></a></li>
					<li class="mb-1"><a class="link-dark" href="<?= base_url('admin/blog/create') ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $this->lang->line('create_blog') ?></a></li>
				</ul>
			</div>
		</div>
	</div>
</div>
