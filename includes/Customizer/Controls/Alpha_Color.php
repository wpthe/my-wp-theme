<?php

namespace My_Theme\Customizer\Controls;

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Alpha_Color extends \WP_Customize_Control {

		public $type = 'my_alpha_color';
		public $palette;
		public $show_opacity;

		public function render_content() {
			if ( is_array( $this->palette ) ) {
				$palette = implode( '|', $this->palette );
			} else {
				$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
			}

			$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';

			?>
			<label>
				<?php if ( isset( $this->label ) && '' !== $this->label ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( isset( $this->description ) && '' !== $this->description ) { ?>
					<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>
			</label>
			<input class="alpha-color-control" type="text" data-show-opacity="<?php echo esc_attr( $show_opacity ); ?>" data-palette="<?php echo esc_attr( $palette ); ?>" data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>" <?php $this->link(); ?> />
			<?php

		}
	}
}
