<?php
/**
 * Block Name:        My Contacts
 * Block Description: Description
 * Block Category:    my_blocks
 * Block Icon:        phone
 * Block Keywords:    contacts
 * Block Post Types:  post, page
 */

namespace My_Theme;

esc_html__( 'My Contacts', 'my_theme' );
esc_html__( 'Fill out a block of contact information: add a map, phone numbers, address, mail and more. Ideal for creating a Contact page, as well as placing it at the bottom of other pages.', 'my_theme' );

defined( 'ABSPATH' ) || exit;
?>

<div class="my-block my-block-contacts <?php echo isset( $args['className'] ) ? esc_attr( $args['className'] ) : ''; ?>">
	<div class="container">
		<div class="row">
			<?php
			while ( have_rows( 'my_cols' ) ) :
				the_row();

				if ( get_row_layout() === 'my_data' ) :
					?>
					<div class="col-4">
						<?php
						while ( have_rows( 'my_data' ) ) :
							the_row();

							if ( get_row_layout() === 'my_title' ) :
								$title_tag = get_sub_field( 'my_title_size' );
								echo '<' . esc_html( $title_tag ) . ' class="my-block-contacts__data my-block__title">' . esc_html( get_sub_field( 'my_title_text' ) ) . '</' . esc_html( $title_tag ) . '>';

							elseif ( get_row_layout() === 'my_address' ) :
								$address_link = get_sub_field( 'my_address_link' );
								echo '<div class="my-block-contacts__data my-block-contacts__address">' . ( esc_html( $address_link ) ? '<a href="' . esc_attr( $address_link ) . '" target="_blank">' : '' ) . esc_html( get_sub_field( 'my_address_text' ) ) . ( esc_html( $address_link ) ? '</a>' : '' ) . '</div>';

							elseif ( get_row_layout() === 'my_tel' ) :
								$tel_num = get_sub_field( 'my_tel_num' );
								echo '<div class="my-block-contacts__data my-block-contacts__tel"><a href="' . esc_attr( General::tel_to_url( $tel_num ) ) . '"><span>' . esc_html( get_sub_field( 'my_tel_desc' ) ) . '</span>' . esc_html( $tel_num ) . '</a></div>';

							elseif ( get_row_layout() === 'my_email' ) :
								$email_link = get_sub_field( 'my_email_link' );
								echo '<div class="my-block-contacts__data my-block-contacts__email"><a href="mailto:' . esc_attr( $email_link ) . '"><span>' . esc_html( get_sub_field( 'my_tel_desc' ) ) . '</span>' . esc_html( $email_link ) . '</a></div>';

							elseif ( get_row_layout() === 'my_custom' ) :
								echo get_sub_field( 'my_custom' ); // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped

							endif;
						endwhile;
						?>
					</div>
					<?php

				elseif ( get_row_layout() === 'my_map' ) :
					?>
					<div class="my-block-contacts__map col-8">
						<?php echo get_sub_field( 'my_map_iframe' ); // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					</div>
					<?php
				endif;
			endwhile;
			?>
		</div>
	</div>
</div>
