<div class="card">
	<a class="link-dark" href="<?= base_url('blog/view/' . $blog->slug) ?>">
		<?php if ($blog->image) : ?>
			<img
				src="<?= base_url('uploads/blog/image/' . $blog->image) ?>"
				class="card-img-top blog-image" alt="">
		<?php else: ?>
			<img src="<?= base_url('assets/img/no-image.png') ?>" class="card-img-top product-image" alt="">
		<?php endif ?>
		<div class="card-body text-center">
			<p class="card-text blog-title">
				<strong>
					<?= mb_substr($blog->title, 0, 45, 'utf-8') ?> <?= (strlen($blog->title) > 45) ? '...' : '' ?>
				</strong>
			</p>
		</div>
	</a>
</div>
