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

<footer class="mt-5 bg-dark text-white py-3 px-5 d-none d-md-block">

	<div class="row">
		<div class="col-12 col-md-3 mb-4 mb-md-0">
			<div class="mb-3">
				<a href="<?=base_url()?>">
					<img id="logo-footer" class="img-fluid" src="<?= base_url('assets/img/logo.png') ?>" alt="">
				</a>
			</div>
			<div class="mb-3"><?= $this->lang->line('footer_slogan') ?></div>
			<div>Ⓒ <?= $this->config->item('app_name') ?> <?= date('Y') ?></div>
		</div>

		<div class="col-12 col-md-3 mb-4 mb-md-0 justify-content-md-center d-flex">
			<ul>
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

		<div class="col-12 col-md-3 mb-4 mb-md-0 justify-content-md-center d-flex">
			<ul>
				<?php foreach ($pages as $page) : ?>
					<li class="mb-2">
						<a class="link-light" href="<?= base_url($page->slug) ?>"><i
								class="bi bi-arrow-right-short"></i> <?= $page->title ?></a>
					</li>
				<?php endforeach ?>
			</ul>
		</div>

		<div class="col-12 col-md-3 text-center text-md-end">
			<div class="mb-3">
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
	</div>

</footer>

<button onclick="goToTopFunction()" id="go-to-top" class="btn btn-dark">
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
		crossorigin="anonymous"></script>
<script src="<?= base_url('assets/js/aos.min.js') ?>"></script>
<script>
	AOS.init();
</script>
</body>
</html>
