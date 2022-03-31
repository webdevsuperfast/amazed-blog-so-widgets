<?php
/*
Plugin Name: Amazed Blog SiteOrigin Widgets
Plugin URI: https://amazed.blog/amazed-blog-so-widgets
GitLab Plugin URI: https://gitlab.com/webdevsuperfast/amazed-blog-so-widgets
Description: Amazed Blog SiteOrigin Widgets is a WordPress widgets collection curated for Amazed Blog.
Version: 	1.0.34
Author: 	Amazed Blog
Author URI: https://amazed.blog
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: amazed-blog-so-widgets
Domain Path: /languages
*/

defined( 'ABSPATH' ) or die( esc_html_e( 'With great power comes great responsibility.', 'amazed-blog-so-widgets' ) );

class ABSW_Widgets {
	public function __construct() {
		// Require the plugin updater
		require_once plugin_dir_path( __FILE__ ) . 'includes/updater.php';

		// Enqueue scripts and styles
		add_action( 'wp_enqueue_scripts', array( $this, 'absw_enqueue_scripts' ) );

		// Add widgets folder to SiteOrigin Widgets
		add_filter( 'siteorigin_widgets_widget_folders', array( $this, 'absw_widget_folders' ) );

		// Activate widgets by default
		add_filter( 'siteorigin_widgets_active_widgets', array( $this, 'absw_filter_active_widgets' ) );
	}

	public function absw_enqueue_scripts() {
		wp_enqueue_style( 'absw-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.min.css' );
		wp_enqueue_style( 'absw-swiper-css', plugin_dir_url( __FILE__ ) . 'assets/js/main.min.css' );

		wp_register_script( 'absw-js', plugin_dir_url( __FILE__ ) . 'assets/js/main.min.js', array(), '1.0.0', true );

		wp_enqueue_script( 'absw-js' );
	}

	public function absw_widget_folders( $folders ) {
		$folders[] = plugin_dir_path( __FILE__ ) . 'widgets/';

		return $folders;
	}

	public function absw_filter_active_widgets( $active ) {
		$active['amazed-blog-posts'] = true;
		$active['amazed-blog-categories'] = true;
		$active['amazed-blog-image-carousel'] = true;
		
		return $active;
	}
}

new ABSW_Widgets();
