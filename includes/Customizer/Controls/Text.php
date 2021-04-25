<?php

namespace My_Theme\Customizer\Controls;

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Text extends \WP_Customize_Control {

		public $type = 'my_text';

		public function render_content() {
			?>
			<div>
				<?php if ( isset( $this->label ) && '' !== $this->label ) { ?>
					<span class="customize-control-title"><?php echo $this->label; // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<?php } ?>
				<?php if ( isset( $this->description ) && '' !== $this->description ) { ?>
					<span class="description customize-control-description"><?php echo $this->description; // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped ?></span>
				<?php } ?>
			</div>
			<?php
		}
	}
}
