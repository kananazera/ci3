<nav class="fixed-top sticky-top navbar navbar-expand-lg">
	<div class="container-fluid">
		<a class="navbar-brand" href="<?= base_url('admin') ?>">
			<img id="logo-nav" class="img-fluid" src="<?= base_url('assets/img/logo.png') ?>" alt="">
		</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav ms-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a target="_blank" class="nav-link" href="<?= base_url() ?>"><i
							class="bi bi-view-list"></i> <?= $this->lang->line('view_site') ?>
					</a>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
					   aria-expanded="false">
						<img class="flag" src="<?=base_url('assets/img')?>/<?= $this->session->userdata('lang') ?>.png" alt="<?= $this->session->userdata('lang') ?>"> <?= $this->config->item('languages')[$this->session->userdata('lang')] ?>
					</a>
					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
						<?php foreach ($this->config->item('languages') as $key => $value) : ?>
							<li><a class="dropdown-item" href="<?= base_url('lang/' . $key) ?>">
									<img class="flag" src="<?=base_url('assets/img')?>/<?= $key ?>.png" alt="<?= $key ?>"> <?= $value ?></a></li>
						<?php endforeach ?>
					</ul>
				</li>

				<li class="nav-item dropdown">
					<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
					   aria-expanded="false">
						<i class="bi bi-person"></i> <?= $this->session->userdata('auth_user')->name ?>
					</a>
					<ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
						<li><a class="dropdown-item"
							   href="<?= base_url('profile') ?>"><i class="bi bi-people"></i> <?= $this->lang->line('profile') ?></a></li>
						<li>
							<hr class="dropdown-divider">
						</li>
						<li><a class="dropdown-item"
							   href="<?= base_url('logout') ?>"><i class="bi bi-box-arrow-left"></i> <?= $this->lang->line('logout') ?></a></li>
						<li>
					</ul>
				</li>

			</ul>
		</div>
	</div>
</nav>
