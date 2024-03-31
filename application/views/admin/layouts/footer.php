<footer class="mt-5 bg-dark text-white py-3 px-5 text-end">
	Ⓒ <?= $this->config->item('app_name') ?> <?= date('Y') ?>
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
