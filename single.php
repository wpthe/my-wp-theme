<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="my-section" role="main" itemscope itemprop="mainContentOfPage">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<?php Templates::get_part( 'breadcrumbs' ); ?>
				<h1 class="my-section__title"><?php echo esc_html( Posts::get_title() ); ?></h1>
				<?php
				while ( have_posts() ) :
					the_post();
					Templates::get_content( get_post_type() );

					the_post_navigation(
						array(
							'prev_text' => '<span class="nav-subtitle">' . esc_html__( 'Previous:', 'my_theme' ) . '</span> <span class="nav-title">%title</span>',
							'next_text' => '<span class="nav-subtitle">' . esc_html__( 'Next:', 'my_theme' ) . '</span> <span class="nav-title">%title</span>',
						)
					);

					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;
				endwhile;
				?>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
