<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

get_header();
?>

<main class="my-section" role="main" itemscope itemprop="mainContentOfPage">
	<div class="container">
		<?php Helpers\Pages::get_template_part( 'breadcrumbs' ); ?>
		<h1 class="my-section__title"><?php echo esc_html( Helpers\Pages::get_title() ); ?></h1>
	</div>
</main>

<?php
get_footer();
