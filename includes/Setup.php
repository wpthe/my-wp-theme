<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

final class Setup {

	public function __construct() {
		add_action( 'after_setup_theme', array( $this, 'after_setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_filter( 'block_categories', array( $this, 'block_categories' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
	}

	public function after_setup() {
		load_theme_textdomain( 'my_theme', get_theme_file_path( 'languages' ) );

		if ( ! class_exists( 'My_Core\Setup' ) ) {
			add_action(
				'admin_notices',
				function () {
					?>
					<div class="notice notice-error">
						<p><?php echo __( '<b>Warning!</b> The My Custom Theme require the My Custom Theme Core plugin.', 'my_theme' ); // @codingStandardsIgnoreLine WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
					</div>
					<?php
				}
			);

			return;
		}

		new Posts();
		new Ajax();

		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );

		register_nav_menus(
			array(
				'my_header_menu' => esc_html__( 'Header Menu', 'my_theme' ),
			)
		);

		add_image_size( 'my_card', 370, 0, false );
		add_image_size( 'my_card_retina', 720, 0, false );
	}

	public function enqueue_assets() {
		wp_enqueue_style( 'my_google_font', '//fonts.googleapis.com/css2?family=Jost&display=swap', false, null ); // @codingStandardsIgnoreLine WordPress.WP.EnqueuedResourceParameters.MissingVersion

		Utils::enqueue_style( 'my_theme_main', 'main' );
		Utils::enqueue_script( 'my_theme_main', 'main', array( 'jquery' ) );
		wp_localize_script(
			'my_main',
			'myMain',
			array(
				'ajaxUrl'            => admin_url( 'admin-ajax.php' ),
				'restUrl'            => rest_url( 'wp/v2' ),
				'screen'             => array(
					'xx' => array(
						'min' => 1680,
					),
					'lg' => array(
						'max' => 1199,
						'min' => 992,
					),
					'md' => array(
						'max' => 991,
						'min' => 768,
					),
					'sm' => array(
						'max' => 767,
						'min' => 576,
					),
					'xs' => array(
						'max' => 575,
						'min' => 0,
					),
				),
				'transitionDuration' => 200,
				'msgOffline'         => esc_html__( 'Please, check your Internet connection and try again.', 'my_theme' ),
			)
		);

		if ( is_admin_bar_showing() ) {
			Utils::enqueue_style( 'my_theme_admin_bar', 'admin-bar' );
		}

		if ( is_singular() ) {
			Utils::enqueue_style( 'my_theme_single', 'single' );
		}

		if ( Templates::is( 'template-sample' ) ) {
			Utils::enqueue_style( 'my_theme_template_sample', 'template-sample' );
		}
	}

	public function block_categories( array $categories ): array {
		return array_merge(
			array(
				array(
					'slug'  => 'my_blocks',
					'title' => esc_html__( 'My Blocks', 'my_theme' ),
				),
			),
			$categories
		);
	}

	public function widgets_init() {
		$config = array(
			'before_widget' => '<div class="my-sidebar__widget %1$s %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3>',
			'after_title'   => '</h3>',
		);

		register_sidebar(
			array_merge(
				array(
					'id'   => 'my_sidebar_archive',
					'name' => esc_html__( 'Sidebar catalog', 'my_theme' ),
				),
				$config
			)
		);
	}
}
