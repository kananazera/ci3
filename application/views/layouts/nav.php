<nav id="nav-top" class="fixed-top sticky-top navbar navbar-expand-lg mb-5">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= base_url() ?>">
			<img id="logo-nav" class="img-fluid" src="<?= base_url('assets/img/logo.png') ?>" alt="">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<?php foreach ($navigation_pages as $item) { ?>
					<li class="nav-item dropdown">
						<a id="toggle-<?= $item->id ?>" class="nav-link dropdown-toggle" href="#" role="button"
						   data-bs-toggle="dropdown"
						   aria-expanded="false">
							<?= $item->title ?>
						</a>
						<ul id="dropdown-menu-<?= $item->id ?>" class="dropdown-menu dropdown-menu-dark">
							<?php foreach ($this->PageModel->getPagesByPageId($item->id, $this->session->userdata('lang')) as $item) { ?>
								<li><a class="dropdown-item"
									   href="<?= base_url('page/' . $item->slug) ?>"><?= $item->title ?></a></li>
							<?php } ?>
						</ul>
					</li>
				<?php } ?>
			</ul>

			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<?php if ($this->session->has_userdata('authenticated')) : ?>

					<li class="nav-item dropdown">
						<a id="toggle-user" class="nav-link dropdown-toggle" href="#" role="button"
						   data-bs-toggle="dropdown"
						   aria-expanded="false">
							<i class="bi bi-person"></i> <?= $this->session->userdata('auth_user')->name ?>
						</a>
						<ul id="dropdown-menu-user" class="dropdown-menu dropdown-menu-dark">

							<?php if ($this->session->userdata('auth_user')->is_admin == 1) : ?>
							<li><a class="dropdown-item"
								   href="<?= base_url('admin') ?>"><i
											class="bi bi-person-gear"></i> <?= $this->lang->line('control_panel') ?></a>
							</li>
							<li>
								<?php endif ?>

							<li><a class="dropdown-item"
								   href="<?= base_url('profile') ?>"><i
											class="bi bi-people"></i> <?= $this->lang->line('profile') ?></a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item"
								   href="<?= base_url('logout') ?>"><i
											class="bi bi-box-arrow-left"></i> <?= $this->lang->line('logout') ?></a>
							</li>
							<li>
						</ul>
					</li>

				<?php else: ?>

					<li class="nav-item dropdown">
						<a id="toggle-auth" class="nav-link dropdown-toggle" href="#" role="button"
						   data-bs-toggle="dropdown"
						   aria-expanded="false">
							<i class="bi bi-person"></i> <?= $this->lang->line('authorization') ?>
						</a>
						<ul id="dropdown-menu-auth" class="dropdown-menu dropdown-menu-dark">
							<li><a class="dropdown-item"
								   href="<?= base_url('login') ?>"><?= $this->lang->line('login') ?></a></li>
							<li><a class="dropdown-item"
								   href="<?= base_url('register') ?>"><?= $this->lang->line('register') ?></a></li>
						</ul>
					</li>

				<?php endif ?>

				<li class="nav-item dropdown">
					<a id="toggle-lang" class="nav-link dropdown-toggle" href="#" role="button"
					   data-bs-toggle="dropdown"
					   aria-expanded="false">
						<img class="flag"
							 src="<?= base_url('assets/img') ?>/<?= $this->session->userdata('lang') ?>.png"
							 alt="<?= $this->session->userdata('lang') ?>"> <?= $this->config->item('languages')[$this->session->userdata('lang')] ?>
					</a>
					<ul id="dropdown-menu-lang" class="dropdown-menu dropdown-menu-dark">
						<?php foreach ($this->config->item('languages') as $key => $value) : ?>
							<li><a class="dropdown-item" href="<?= base_url('lang/' . $key) ?>">
									<img class="flag" src="<?= base_url('assets/img') ?>/<?= $key ?>.png"
										 alt="<?= $key ?>"> <?= $value ?></a></li>
						<?php endforeach ?>
					</ul>
				</li>

				<li class="nav-item">
					<a class="nav-link position-relative me-3" href="#" data-bs-toggle="offcanvas"
					   data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
								class="bi bi-bell"></i>
						<span class="position-absolute top-0 badge rounded-pill bg-secondary">0</span>
					</a>
				</li>

				<li class="nav-item">
					<a class="nav-link position-relative me-3" href="#" data-bs-toggle="offcanvas"
					   data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i
								class="bi bi-cart"></i> <?= $this->lang->line('cart') ?>
						<span class="position-absolute top-0 badge rounded-pill bg-secondary">0</span>
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
