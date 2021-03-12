<?php
/**
 * Template Name:      Sample
 * Template Post Type: post, page
 */

namespace My_Theme;

esc_html__( 'Sample', 'my_theme' );

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="my-section" role="main" itemscope itemprop="mainContentOfPage">
	<div class="container">
		<?php Templates::get_part( 'breadcrumbs' ); ?>
		<h1 class="my-section__title"><?php echo esc_html( Posts::get_title() ); ?></h1>

		<div class="row justify-content-center">
			<div class="col-lg-10">
				<?php
				while ( have_posts() ) :
					the_post();
					Templates::get_content( 'page' );

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
