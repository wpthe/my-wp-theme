<?php

namespace My_Theme\Customizer\Controls;

defined( 'ABSPATH' ) || exit;

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Radio_Image extends \WP_Customize_Control {

		public $type       = 'my_radio_image';
		public $item_width = 100;

		public function render_content() {
			?>
			<div class="my-radio-image">
				<?php if ( ! empty( $this->label ) ) { ?>
					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<?php } ?>
				<?php if ( ! empty( $this->description ) ) { ?>
					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
				<?php } ?>

				<div class="my-radio-image__items my-radio-image__items_width_<?php echo esc_html( $this->item_width ); ?>">
					<?php foreach ( $this->choices as $key => $value ) { ?>

						<label class="my-radio-image__item">
							<input
								type="radio"
								name="<?php echo esc_attr( $this->id ); ?>"
								value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>

							<img src="<?php echo esc_attr( $value['preview'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>"/>
						</label>

					<?php } ?>
				</div>
			</div>
			<?php
		}
	}
}
