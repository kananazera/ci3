<footer class="mt-5 bg-dark text-white py-3 px-5">

	<div class="row">
		<div class="col-12 col-md-4 mb-4 mb-md-0">
			<div class="mb-3">
				<a href="#">
					<img id="logo-footer" class="img-fluid" src="<?= base_url('assets/img/logo-light.png') ?>" alt="">
				</a>
			</div>
			<div><?= $this->lang->line('footer_slogan') ?></div>
		</div>

		<div class="col-12 col-md-4 mb-4 mb-md-0 justify-content-md-center d-flex">
			<ul>
				<li class="mb-2"><a href="<?= base_url('categories') ?>"><i
							class="bi bi-arrow-right-short"></i> <?= $this->lang->line('categories') ?></a></li>
				<li class="mb-2"><a href="<?= base_url('products') ?>"><i
							class="bi bi-arrow-right-short"></i> <?= $this->lang->line('products') ?></a></li>
				<li class="mb-2"><a href="<?= base_url('about') ?>"><i
							class="bi bi-arrow-right-short"></i> <?= $this->lang->line('about') ?></a></li>
				<li class="mb-2"><a href="<?= base_url('contact') ?>"><i
							class="bi bi-arrow-right-short"></i> <?= $this->lang->line('contact') ?></a></li>
				<li class="mb-2"><a href="<?= base_url('privacy-policy') ?>"><i
							class="bi bi-arrow-right-short"></i> <?= $this->lang->line('privacy_policy') ?></a></li>
				<li><a href="<?= base_url('terms-and-conditions') ?>"><i
							class="bi bi-arrow-right-short"></i> <?= $this->lang->line('terms_and_conditions') ?></a>
				</li>
			</ul>
		</div>

		<div class="col-12 col-md-4 text-center text-md-end">
			<div class="mb-3">
				<a target="_blank" class="mx-1" href="facebook_url"><i class="bi bi-facebook"></i></a>
				<a target="_blank" class="mx-1" href="instagram_url"><i class="bi bi-instagram"></i></a>
				<a target="_blank" class="mx-1" href="twitter_url"><i class="bi bi-twitter"></i></a>
				<a target="_blank" class="mx-1" href="linkedin_url"><i class="bi bi-linkedin"></i></a>
				<a target="_blank" class="mx-1" href="youtube_url"><i class="bi bi-youtube"></i></a>
				<a target="_blank" class="mx-1" href="whatsapp_url"><i class="bi bi-whatsapp"></i></a>
			</div>
			<div>Ⓒ <?= $this->config->item('app_name') ?> <?= date('Y') ?></div>
		</div>
	</div>

</footer>

<button onclick="goToTopFunction()" id="go-to-top"><i class="bi bi-arrow-up-square"></i></button>

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
