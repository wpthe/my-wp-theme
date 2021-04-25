<?php

namespace My_Theme\Customizer\Controls;

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Notice extends \WP_Customize_Control {

		public $type = 'my_notice';

		public function render_content() {
			$allowed_html = array(
				'a'      => array(
					'href'   => array(),
					'title'  => array(),
					'class'  => array(),
					'target' => array(),
				),
				'b'      => array(),
				'br'     => array(),
				'em'     => array(),
				'strong' => array(),
				'i'      => array(
					'class' => array(),
				),
				'span'   => array(
					'class' => array(),
				),
				'code'   => array(),
			);

			?>
			<div class="my-notice">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="my-notice__title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="my-notice__description customize-control-description">
							<?php
							echo wp_kses(
								$this->description,
								$allowed_html
							);
							?>
						</span>
				<?php } ?>
			</div>
			<?php
		}
	}
}
