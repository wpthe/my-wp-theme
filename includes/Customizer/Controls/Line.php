<?php

namespace My_Theme\Customizer\Controls;

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Line extends \WP_Customize_Control {

		public $type = 'my_line';

		public function render_content() {
			?>
			<div class="my-line"></div>
			<?php

		}
	}
}
