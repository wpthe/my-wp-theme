<?php

namespace My_Theme;

use My_Core\Customize\Settings_Code_Fields;

defined( 'ABSPATH' ) || exit;
?>

	</div>
	<?php Templates::get_part( 'footer-content' ); ?>
</div>
<div class="my-notify"></div>

<?php
wp_footer();
echo Settings_Code_Fields::get_mod( 'body' ); // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped
?>
</body>
</html>
