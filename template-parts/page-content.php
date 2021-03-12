<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

<article <?php post_class(); ?> id="<?php echo 'post-' . get_the_ID(); ?>">
	<div class="my-content">
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div class="pagination">' . esc_html__( 'Pages:', 'my_theme' ),
				'after'  => '</div>',
			)
		);
		?>
	</div>
</article>
