<div class="container" data-aos="zoom-in-up">

	<h3 class="text-center mb-3">
		<?= $this->lang->line('pages') ?>
	</h3>

	<ul>
		<?php foreach ($pages as $page) : ?>
			<li class="mb-2">
				<a class="link-dark" href="<?= base_url($page->slug) ?>"><i
						class="bi bi-arrow-right-short"></i> <?= $page->title ?></a>
			</li>
		<?php endforeach ?>
	</ul>

</div>
