<?php
/*
Plugin Name: Amazed Blog SiteOrigin Widgets
Plugin URI: https://amazed.blog/amazed-blog-so-widgets
GitLab Plugin URI: https://gitlab.com/webdevsuperfast/amazed-blog-so-widgets
Description: Amazed Blog SiteOrigin Widgets is a WordPress widgets collection curated for Amazed Blog.
Version: 	1.0.26
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



		// Widget CSS
		wp_register_style( 'rawb-css', plugin_dir_url( __FILE__ ) . 'public/css/widget.css' );
		wp_enqueue_style( 'rawb-css' );

		// Owl Carousel JS
		wp_register_script( 'rawb-owl-carousel-js', plugin_dir_url( __FILE__ ) . 'public/js/owl.carousel.min.js', array( 'jquery' ), null, true );

		// Widget JS
		wp_register_script( 'rawb-widgets-js', plugin_dir_url( __FILE__ ) . 'public/js/widget.min.js', array( 'jquery' ), null, true );
	}

	public function absw_widget_folders( $folders ) {
		$folders[] = plugin_dir_path( __FILE__ ) . 'widgets/';

		return $folders;
	}

	public function absw_filter_active_widgets( $active ) {
		$active['amazed-blog-posts'] = true;
		$active['amazed-blog-categories'] = true;
//rawb-image-carousel
$active['rawb-image-carousel'] = true;
		return $active;
	}
}




// Get an array of registered images
function rawb_thumb_sizes() {
	global $_wp_additional_image_sizes;
 
    $sizes = array(
		'full' => __( 'Full', 'ra-widgets-bundle' )
	);

	$get_intermediate_image_sizes = get_intermediate_image_sizes();

	
	
	foreach( $get_intermediate_image_sizes as $_size ) {
		if ( in_array( $_size, array( 'thumbnail', 'medium', 'large' ) ) ) {
			$sizes[ $_size ] = ucwords( $_size ); // strtouppercase
		}
	}

	return $sizes;
}
new ABSW_Widgets();
