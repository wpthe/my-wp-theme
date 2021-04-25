<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

<footer class="my-page__footer my-footer">
	<div class="container">
		<p><?php echo esc_html( sprintf( __( '© %s My Theme. All rights reserved.', TEXTDOMAIN ), gmdate( 'Y' ) ) ); ?></p>
	</div>
</footer>
