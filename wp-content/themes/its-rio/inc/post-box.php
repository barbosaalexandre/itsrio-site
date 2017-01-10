<?php global $titles; ?>	
<div class="list-item-wrapper column small-12 medium-6 large-4 end">
	<div <?php post_class( 'list-item' ); ?>>
		<div class="info">
			<h3><a href="<?= get_permalink() ?>"><?= the_title(); ?></a></h3>
			<div class="line"></div>
			<p class="excerpt">
				<?= limit_excerpt(get_the_excerpt(), 100); ?>
				<?php if(get_the_excerpt() != ''): ?>
					<a href="<?= get_permalink() ?>"><b>Saiba Mais</b></a>
				<?php endif; ?>
			</p>
		</div>
		<!-- <div class="img" style="background-image: url('<?= get_thumbnail_url_card( $post->ID ); ?>')"> -->
		<div class="img" <?= get_thumbnail_style($post->ID,'card'); ?> >
			<div class="color-hover"></div>
		</div>
		<?php $cat_classes = ''; include(ROOT. 'inc/categories.php') ?>
		<a href="<?= get_permalink() ?>" class="post-link"></a>
	</div>
</div>