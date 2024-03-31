<div class="p-3">
	<div class="text-center mb-3">
		<strong><?= $this->lang->line('other_blog') ?></strong>
	</div>
	<div class="row">
		<?php foreach ($blog_random as $item) : ?>
			<div class="col-12 p-3">
				<?php $data['blog'] = $item;
				$this->view('blog/blog', $data); ?>
			</div>
		<?php endforeach ?>
	</div>
</div>
