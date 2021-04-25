<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

<form class="my-search my-form <?php echo isset( $args['className'] ) ? esc_attr( $args['className'] ) : ''; ?>" role="search" method="get" action="<?php echo esc_attr( Helpers\Pages::get_home_url() ); ?>">
	<label>
		<span class="sr-only"><?php echo esc_html__( 'Search field', TEXTDOMAIN ); ?></span>
		<input class="my-search__input my-form__input <?php echo isset( $args['inputClassName'] ) ? esc_attr( $args['inputClassName'] ) : ''; ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" type="search" placeholder="<?php echo esc_attr__( 'Search', TEXTDOMAIN ); ?>">
	</label>
</form>
