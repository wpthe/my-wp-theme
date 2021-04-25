<?php

namespace My_Theme;

defined( 'ABSPATH' ) || exit;

final class Setup {

	use Abstracts\Singable;

	public function __construct() {
		$this->die_if_has_instance();

		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );
		add_filter( 'block_categories', array( $this, 'block_categories' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'wp_default_scripts', array( $this, 'remove_jquery_migrate' ) );
		$this->clean_head();
	}

	public function setup(): void {
		load_theme_textdomain( TEXTDOMAIN, get_theme_file_path( 'languages' ) );

		new Admin();
		new Customizer();
		new Integrations();
		new Posts();
		new Pages();

		add_theme_support( 'title-tag' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );
		add_theme_support( 'customize-selective-refresh-widgets' );

		register_nav_menus(
			array(
				'my_header_menu' => esc_html__( 'Header Menu', TEXTDOMAIN ),
			)
		);

		add_image_size( 'my_card', 370, 0, false );
		add_image_size( 'my_card_retina', 720, 0, false );
	}

	public function enqueue_assets(): void {
		wp_enqueue_style( 'my_google_font', '//fonts.googleapis.com/css2?family=Jost&display=swap', false, null ); // @codingStandardsIgnoreLine WordPress.WP.EnqueuedResourceParameters.MissingVersion

		Helpers\General::enqueue_style( 'my_theme_main', 'main' );
		Helpers\General::enqueue_script( 'my_theme_main', 'main', array( 'jquery' ) );
		wp_localize_script(
			'my_theme_main',
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
				'msgOffline'         => esc_html__( 'Please, check your Internet connection and try again.', TEXTDOMAIN ),
			)
		);

		if ( is_admin_bar_showing() ) {
			Helpers\General::enqueue_style( 'my_theme_admin_bar', 'admin-bar' );
		}

		if ( is_singular() ) {
			Helpers\General::enqueue_style( 'my_theme_single', 'single' );
		}

		if ( Helpers\Pages::is_template( 'template-sample' ) ) {
			Helpers\General::enqueue_style( 'my_theme_template_sample', 'template-sample' );
		}
	}

	public function block_categories( array $categories ): array {
		return array_merge(
			array(
				array(
					'slug'  => 'my_blocks',
					'title' => esc_html__( 'My Blocks', TEXTDOMAIN ),
				),
			),
			$categories
		);
	}

	public function widgets_init(): void {
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
					'name' => esc_html__( 'Sidebar catalog', TEXTDOMAIN ),
				),
				$config
			)
		);
	}

	public function remove_jquery_migrate( \WP_Scripts $scripts ): void {
		if ( Customizer\Addition_General::get_setting( 'remove_jquery_migrate' ) && ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];

			if ( $script->deps ) {
				$script->deps = array_diff( $script->deps, array( 'jquery-migrate' ) );
			}
		}
	}

	private function clean_head(): void {
		if ( Customizer\Addition_General::get_setting( 'clean_head' ) ) {
			remove_action( 'wp_head', 'rsd_link' );
			remove_action( 'wp_head', 'wlwmanifest_link' );
			remove_action( 'wp_head', 'start_post_rel_link' );
			remove_action( 'wp_head', 'index_rel_link' );
			remove_action( 'wp_head', 'adjacent_posts_rel_link' );
			remove_action( 'wp_head', 'wp_shortlink_wp_head' );
			remove_action( 'wp_head', 'rest_output_link_wp_head' );
			remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
			remove_action( 'wp_head', 'wp_generator' );
			remove_action( 'wp_head', 'print_emoji_detection_script' );
			remove_action( 'template_redirect', 'rest_output_link_header' );
			remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
			remove_action( 'wp_print_styles', 'print_emoji_styles' );
			remove_action( 'admin_print_styles', 'print_emoji_styles' );
		}
	}
}
