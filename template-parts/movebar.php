<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

<aside class="my-movebar" tabindex="-1" role="complementary">
	<button class="my-movebar__close my-icon my-icon_close" data-my-toggle="movebar"></button>
	<?php get_search_form( array( 'className' => 'my-movebar__search d-sm-none' ) ); ?>
	<nav class="my-movebar__menu">
		<?php
		wp_nav_menu(
			array(
				'theme_location' => 'my_header_menu',
				'walker'         => new Walkers\Header_Menu(),
				'menu_class'     => '_my-ul-clean',
				'container'      => false,
			)
		)
		?>
	</nav>
</aside>
<div class="my-movebar__backdrop"></div>
