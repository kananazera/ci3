<div class="card">
	<a class="link-dark" href="<?= base_url('product/' . $product->slug) ?>">
		<?php if ($this->ProductImageModel->getMainImage($product->id)) : ?>
			<img
				src="<?= base_url('uploads/product/image/' . $this->ProductImageModel->getMainImage($product->id)->image) ?>"
				class="card-img-top product-image" alt="">
		<?php else: ?>
			<img src="<?= base_url('assets/img/no-image.png') ?>" class="card-img-top product-image" alt="">
		<?php endif ?>
		<div class="card-body text-center">
			<p class="card-text product-title"><?= mb_substr($product->title, 0, 60, 'utf-8') ?> <?= (strlen($product->title) > 60) ? '...' : '' ?></p>
			<p class="card-text text-center">
				<?= ($product->discount_rate != 0) ? '<del>' . $product->price . '</del>' . ' ' . generatePrice($product->price, $product->discount_rate) : $product->price ?> <?= $this->CurrencyModel->show($this->config->item('currency_id'))->symbol ?>
			</p>
		</div>
	</a>
	<a href="" class="btn btn-dark"><i
			class="bi bi-cart-plus"></i> <?= $this->lang->line('add_to_cart') ?></a>
</div>
