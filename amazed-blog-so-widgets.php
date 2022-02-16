<?php
/*
Plugin Name: Amazed Blog SiteOrigin Widgets
Plugin URI: https://amazed.blog
Description: Amazed Blog SiteOrigin Widgets is a WordPress widgets collection curated for Amazed Blog.
Version: 	1.0
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
		// Add widgets folder to SiteOrigin Widgets
		add_filter( 'siteorigin_widgets_widget_folders', array( $this, 'absw_widget_folders' ) );

		// Activate Widget
		add_filter( 'siteorigin_widgets_active_widgets', array( $this, 'absw_filter_active_widgets' ) );
	}

	public function absw_widget_folders( $folders ) {
		$folders[] = plugin_dir_path( __FILE__ ) . 'widgets/';

		return $folders;
	}

	public function absw_filter_active_widgets( $active ) {
		$active[] = 'amazed-blog-posts';
		$active[] = 'amazed-blog-categories';

		return $active;
	}
}

new ABSW_Widgets();
