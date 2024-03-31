<div class="product-slide-container">

	<?php $i = 1;
	foreach ($images as $image) : ?>
		<div class="product-slide-items mb-3">
			<div
				class="product-slide-number-of-image badge bg-dark border-start border-top rounded-start rounded-top"><?= $i ?>
				- <?= count($images) ?></div>
			<img class="img-fluid border rounded"
				 src="<?= base_url('uploads/product/image/' . $image->image) ?>">
		</div>
		<?php $i++; endforeach ?>

	<a class="product-slide-prev" onclick="plusSlides(-1)">❮</a>
	<a class="product-slide-next" onclick="plusSlides(1)">❯</a>

	<div class="row justify-content-center">
		<?php $i = 1;
		foreach ($images as $image) : ?>
			<div class="col-4 col-md-2">
				<div class="mb-3">
					<img class="product-slide-cursor product-slide-demo card-img-top border rounded"
						 src="<?= base_url('uploads/product/image/' . $image->image) ?>"
						 onclick="currentSlide(<?= $i ?>)"
						 alt="">
				</div>
			</div>
			<?php $i++; endforeach ?>
	</div>
</div>

<script>
	let slideIndex = 1;
	showSlides(slideIndex);

	function plusSlides(n) {
		showSlides(slideIndex += n);
	}

	function currentSlide(n) {
		showSlides(slideIndex = n);
	}

	function showSlides(n) {
		let i;
		let slides = document.getElementsByClassName("product-slide-items");
		let dots = document.getElementsByClassName("product-slide-demo");
		if (n > slides.length) {
			slideIndex = 1
		}
		if (n < 1) {
			slideIndex = slides.length
		}
		for (i = 0; i < slides.length; i++) {
			slides[i].style.display = "none";
		}
		for (i = 0; i < dots.length; i++) {
			dots[i].className = dots[i].className.replace(" product-slide-active", "");
		}
		slides[slideIndex - 1].style.display = "block";
		dots[slideIndex - 1].className += " product-slide-active";
	}
</script>
