<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

<div class="my-cards__item <?php echo isset( $args['className'] ) ? esc_attr( $args['className'] ) : ''; ?>">
	<article <?php post_class( 'my-card' ); ?> id="post-<?php the_ID(); ?>">

		<?php if ( has_post_thumbnail() ) : ?>
			<a class="my-card__img my-img" href="<?php echo esc_url( get_permalink() ); ?>" data-my-img-loaded-class="my-card__img_loaded">
				<img data-src="<?php the_post_thumbnail_url( 'my_card' ); ?>" data-retina="<?php the_post_thumbnail_url( 'my_card_retina' ); ?>" alt="<?php echo esc_attr( __( 'Cover photo for', 'my_theme' ) . ': "' . get_the_title() . '"' ); ?>">
			</a>
		<?php endif; ?>

		<div class="my-card__body">

			<?php if ( has_category() ) : ?>
				<div class="my-card__categories"><?php the_category( ', ' ); ?></div>
			<?php endif; ?>

			<?php the_title( '<h3 class="my-card__title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' ); ?>

			<div class="my-card__content">
				<?php the_excerpt(); ?>
			</div>

			<?php if ( has_tag() ) : ?>
				<div class="my-card__tags"><?php the_tags( '', '' ); ?></div>
			<?php endif; ?>

			<div class="my-card__meta">
				<ul class="_my-ul-clean _my-ul-inline">
					<li class="my-card__date"><span><?php echo get_the_date(); ?></span></li>
					<li class="my-card__author"><?php the_author_posts_link(); ?></li>
				</ul>
			</div>
		</div>

	</article>
</div>
