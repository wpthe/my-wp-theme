<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

<aside class="my-sidebar">
	<div class="my-sidebar__inner">
		<?php
		if ( is_archive() ) :
			dynamic_sidebar( 'my_sidebar_archive' );
		endif;
		?>
	</div>
</aside>
