<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

<header class="my-header" role="banner" itemscope itemtype="http://schema.org/WPHeader">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-auto d-md-block d-lg-none">
				<button class="my-header__bars my-icon my-icon_bars" data-my-toggle="movebar"></button>
			</div>
			<div class="col-auto">
				<a class="my-header__logo my-img" href="<?php echo esc_url( Helpers\Pages::get_home_url() ); ?>">
					<img data-src="<?php echo esc_url( get_theme_file_uri( 'assets/images/logo.svg' ) ); ?>" alt="<?php echo esc_attr__( 'Logo', TEXTDOMAIN ); ?>">
				</a>
			</div>
			<div class="col _my-text-right">
				<div class="row align-items-center">
					<?php if ( has_nav_menu( 'my_header_menu' ) ) : ?>
						<div class="col d-none d-lg-block">
							<nav class="my-header__menu">
								<?php
								wp_nav_menu(
									array(
										'theme_location' => 'my_header_menu',
										'walker'         => new Walkers\Header_Menu(),
										'menu_class'     => '_my-ul-clean _my-ul-inline',
										'container'      => false,
									)
								)
								?>
							</nav>
						</div>
					<?php endif; ?>
					<div class="col col-lg-auto d-none d-sm-block">
						<?php get_search_form( array( 'inputClassName' => 'my-header__input' ) ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>
