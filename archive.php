<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

global $wp_query;

get_header();

$card_class = 'col-12 col-lg-6';
?>

<main class="my-section" role="main" itemscope itemprop="mainContentOfPage">
	<div class="container">
		<div class="row">
			<div class="col-4"><?php get_sidebar(); ?></div>
			<div class="col-8">
				<?php Templates::get_part( 'breadcrumbs' ); ?>
				<h1 class="my-section__title"><?php echo esc_html( Posts::get_title() ); ?></h1>

				<div class="my-cards" <?php echo Ajax\Load_Cards::get_attrs( $wp_query, $card_class); // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped ?>>
					<div class="my-cards__row row">
						<div class="my-cards__sizer"></div>
						<?php
						while ( have_posts() ) :
							the_post();
							Templates::get_card( get_post_type(), '', array( 'className' => $card_class ) );
						endwhile;
						?>
					</div>

					<?php if ( $wp_query->max_num_pages > 1 ) : ?>
						<div class="my-cards__controls">

							<?php if ( $wp_query->get( 'paged' ) < $wp_query->max_num_pages ) : ?>
							<div class="my-cards__load _my-text-center">
								<button type="button" class="my-cards__load-btn my-btn my-btn_sm"><?php echo esc_html__( 'Load more', 'my_theme' ); ?></button>
							</div>
							<?php endif; ?>

							<div class="my-cards__pagination _my-text-center">
								<?php
								the_posts_pagination(
									array(
										'prev_text' => '< ' . esc_html__( 'Backward', 'my_theme' ),
										'next_text' => esc_html__( 'Forward', 'my_theme' ) . ' >',
									)
								);
								?>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</main>

<?php
get_footer();
