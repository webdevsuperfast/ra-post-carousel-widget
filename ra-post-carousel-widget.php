<?php
/*
Plugin Name: Post Carousel Widget
Plugin URI: https://github.com/webdevsuperfast/ra-post-carousel-widget
GitHub Plugin URI: webdevsuperfast/ra-post-carousel-widget
Description: Post Carousel Widget is a WordPress widget that uses the powerful SiteOrigin Widgets API.
Version: 	1.0
Author: 	Rotsen Mark Acob
Author URI: https://rotsenacob.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: ra-post-carousel-widget
Domain Path: /languages
*/

defined( 'ABSPATH' ) or die( esc_html_e( 'With great power comes great responsibility.', 'ra-post-carousel-widget' ) );

define( 'RACW_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

class RAPC_Widget {
	public function __construct() {
		// Add widgets folder to SiteOrigin Widgets
		add_filter( 'siteorigin_widgets_widget_folders', array( $this, 'rapc_widget_folders' ) );
	}

	public function rapc_widget_folders( $folders ) {
		$folders[] = plugin_dir_path( __FILE__ ) . 'widgets/';

		return $folders;
	}
}

new RAPC_Widget();
