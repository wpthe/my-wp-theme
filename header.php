<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;
?>

<html <?php language_attributes(); ?> class="_my-no-js" <?php echo is_admin_bar_showing() ? 'style="margin-top: 0 !important"' : ''; ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<script>document.documentElement.className = document.documentElement.className.replace( '_my-no-js', '' );</script>
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no">

	<?php
	wp_head();
	echo Customizer\Addition_Code_Fields::get_setting( 'head' ); // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
</head>
<body <?php body_class( 'my-page' ); ?> itemscope itemtype="http://schema.org/WebPage">
<?php
wp_body_open();
Helpers\Pages::get_template_part( 'load-icon' );
?>

<svg class="my-page__load-icon" style="z-index: 999999; position: fixed; top: 50%; left: 50%; -webkit-transform: translate(-50%, -50%); -o-transform: translate(-50%, -50%); transform: translate(-50%, -50%); width: 54px" viewBox="0 0 32 32"><use xlink:href="#my-load-icon"></svg>
<div class="my-page__load-overlay" style="z-index: 999998; position: fixed; background: #fff; top: 0; right: 0; bottom: 0; left: 0;"></div>

<?php Helpers\Pages::get_template_part( 'movebar' ); ?>
<div class="my-page__wrapper my-movebar__coupled">
	<div class="my-page__body">
		<?php
		Helpers\Pages::get_template_part( 'header-content' );
