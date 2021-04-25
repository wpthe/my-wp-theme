<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

	</div>
	<?php Helpers\Pages::get_template_part( 'footer-content' ); ?>
</div>
<div class="my-notify"></div>

<?php
wp_footer();
echo Customizer\Addition_Code_Fields::get_setting( 'body' ); // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped
?>
</body>
</html>
