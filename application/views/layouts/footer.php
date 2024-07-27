<div id="mobile-nav" class="d-block d-md-none">
	<ul class="nav bg-dark justify-content-center fixed-bottom">
		<li class="nav-item">
			<a class="nav-link link-light m-1" href="<?= base_url('products') ?>"><i
						class="mobile-icons bi bi-laptop"></i></a>
		</li>
		<li class="nav-item">
			<a class="nav-link link-light m-1" href="<?= base_url('pages') ?>"><i
						class="mobile-icons bi bi-list-ul"></i></a>
		</li>
		<li class="nav-item">
			<a class="nav-link link-light m-1" href="<?= base_url() ?>"><i
						class="mobile-icons bi bi-house"></i></a>
		</li>
		<li class="nav-item">
			<a class="nav-link link-light m-1" href="<?= base_url('contact') ?>"><i
						class="mobile-icons bi bi-envelope"></i></a>
		</li>
		<li class="nav-item">
			<a class="nav-link link-light m-1" href="<?= base_url('profile') ?>"><i
						class="mobile-icons bi bi-person"></i></a>
		</li>
	</ul>
</div>

<footer class="mt-5 py-3 px-5 d-none d-md-block">
	<div class="row">

		<div class="col-12 col-md-3 mb-4">
			<div class="mb-3">
				<a href="<?= base_url() ?>">
					<img id="logo-footer" class="img-fluid" src="<?= base_url('assets/img/logo.png') ?>" alt="">
				</a>
			</div>

			<div class="mb-3"><?= $this->lang->line('footer_slogan') ?></div>
		</div>

		<div class="col-12 col-md-3 mb-4">
			<h4 class="mb-4"><?= $this->config->item('app_name') ?></h4>
			<ul>
				<li class="mb-2"><a class="link-light" href="<?= base_url('privacy-policy') ?>"><i
								class="bi bi-shield-check"></i> <?= $this->lang->line('privacy_policy') ?></a></li>
				<li class="mb-2"><a class="link-light" href="<?= base_url('terms-and-conditions') ?>"><i
								class="bi bi-activity"></i> <?= $this->lang->line('terms_and_conditions') ?></a></li>
				<li class="mb-2"><a class="link-light" href="<?= base_url('categories') ?>"><i
								class="bi bi-bookmarks"></i> <?= $this->lang->line('categories') ?></a></li>
				<li class="mb-2"><a class="link-light" href="<?= base_url('products') ?>"><i
								class="bi bi-laptop"></i> <?= $this->lang->line('products') ?></a></li>
				<li class="mb-2"><a class="link-light" href="<?= base_url('blog') ?>"><i
								class="bi bi-book"></i> <?= $this->lang->line('blog') ?></a></li>
				<li class="mb-2"><a class="link-light" href="<?= base_url('contact') ?>"><i
								class="bi bi-envelope"></i> <?= $this->lang->line('contact') ?></a></li>
			</ul>
		</div>

		<?php foreach ($footer_pages as $item) { ?>
			<div class="col-12 col-md-3 mb-4">
				<h4 class="mb-4"><?= $item->title ?></h4>

				<ul>
					<?php foreach ($this->PageModel->getPagesByPageId($item->id, $this->session->userdata('lang')) as $item) { ?>
						<li class="mb-2"><a class="link-light" href="<?= base_url('page/' . $item->slug) ?>"><i
										class="bi bi-link"></i> <?= $item->title ?></a></li>
					<?php } ?>
				</ul>
			</div>
		<?php } ?>

	</div>

	<hr>

	<div class="row mx-5">
		<div class="col-12 col-md-6">
			Ⓒ <?= $this->config->item('app_name') ?> <?= date('Y') ?>
		</div>

		<div class="col-12 col-md-6 text-end">
			<a target="_blank" class="link-light mx-1" href="<?= $this->config->item('facebook_url') ?>"><i
						class="socials bi bi-facebook"></i></a>
			<a target="_blank" class="link-light mx-1" href="<?= $this->config->item('instagram_url') ?>"><i
						class="socials bi bi-instagram"></i></a>
			<a target="_blank" class="link-light mx-1" href="<?= $this->config->item('twitter_url') ?>"><i
						class="socials bi bi-twitter"></i></a>
			<a target="_blank" class="link-light mx-1" href="<?= $this->config->item('linkedin_url') ?>"><i
						class="socials bi bi-linkedin"></i></a>
			<a target="_blank" class="link-light mx-1" href="<?= $this->config->item('youtube_url') ?>"><i
						class="socials bi bi-youtube"></i></a>
			<a target="_blank" class="link-light mx-1" href="<?= $this->config->item('whatsapp_url') ?>"><i
						class="socials bi bi-whatsapp"></i></a>
		</div>
	</div>
</footer>

<button onclick="goToTopFunction()" id="go-to-top" class="btn">
	<i class="bi bi-arrow-up-square"></i>
</button>

<script>
	var goToTopButton = document.getElementById("go-to-top");

	window.onscroll = function () {
		scrollFunction()
	};

	function scrollFunction() {
		if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
			goToTopButton.style.display = "block";
		} else {
			goToTopButton.style.display = "none";
		}
	}

	function goToTopFunction() {
		document.body.scrollTop = 0;
		document.documentElement.scrollTop = 0;
	}
</script>

<script>
	$(document).ready(function () {
		$('#toggle-lang').mouseover(function () {
			$('#dropdown-menu-lang').show();
		})
		$('#toggle-lang').mouseout(function () {
			$('#dropdown-menu-lang').hide();
		})
		$('#dropdown-menu-lang').mouseover(function () {
			$('#dropdown-menu-lang').show();
		})
		$('#dropdown-menu-lang').mouseout(function () {
			$('#dropdown-menu-lang').hide();
		})

		$('#toggle-user').mouseover(function () {
			$('#dropdown-menu-user').show();
		})
		$('#toggle-user').mouseout(function () {
			$('#dropdown-menu-user').hide();
		})
		$('#dropdown-menu-user').mouseover(function () {
			$('#dropdown-menu-user').show();
		})
		$('#dropdown-menu-user').mouseout(function () {
			$('#dropdown-menu-user').hide();
		})

		$('#toggle-auth').mouseover(function () {
			$('#dropdown-menu-auth').show();
		})
		$('#toggle-auth').mouseout(function () {
			$('#dropdown-menu-auth').hide();
		})
		$('#dropdown-menu-auth').mouseover(function () {
			$('#dropdown-menu-auth').show();
		})
		$('#dropdown-menu-auth').mouseout(function () {
			$('#dropdown-menu-auth').hide();
		})
	});
</script>

<script>
	$(document).ready(function () {
		<?php foreach ($navigation_pages as $item)  { ?>
		$('#toggle-<?= $item->id ?>').mouseover(function () {
			$('#dropdown-menu-<?= $item->id ?>').show();
		})
		$('#toggle-<?= $item->id ?>').mouseout(function () {
			$('#dropdown-menu-<?= $item->id ?>').hide();
		})
		$('#dropdown-menu-<?= $item->id ?>').mouseover(function () {
			$('#dropdown-menu-<?= $item->id ?>').show();
		})
		$('#dropdown-menu-<?= $item->id ?>').mouseout(function () {
			$('#dropdown-menu-<?= $item->id ?>').hide();
		})
		<?php } ?>
	});
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/aos.min.js') ?>"></script>
<script>
	AOS.init();
</script>
</body>
</html>
