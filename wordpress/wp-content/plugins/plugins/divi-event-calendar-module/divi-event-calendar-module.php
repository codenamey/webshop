<?php
/*
Plugin Name: Divi Events Calendar
Requires Plugins: the-events-calendar
Description: Easily integrate The Events Calendar plugin into Divi using our custom event modules to display beautiful highly-customizable grids, calendars, lists, and single event pages with incredible options and features for selecting, displaying, and styling events in the Visual Builder.
Version:     2.8.28
Author:      Pee-Aye Creative
Author URI:  https://peeayecreative.com
Update URI:  https://peeayecreative.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: decm-divi-event-calendar-module
Domain Path: /languages

Divi Event Calendar Module is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Divi Event Calendar Module is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Divi Event Calendar Module. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
*/

add_action("init", "divicalendarmodule_init");

function divicalendarmodule_init() {
   load_plugin_textdomain("decm-divi-event-calendar-module", false, "divi-event-calendar-module/languages/");
}
function tribe_register_pro_1() {

	//remove action if we run this hook through common
	remove_action( 'plugins_loaded', 'tribe_register_pro_1', 50 );

	// if we do not have a dependency checker then shut down
	if ( ! class_exists( 'Tribe__Abstract_Plugin_Register' ) ) {

		add_action( 'admin_notices', 'tribe_show_fail_message_1' );
		add_action( 'network_admin_notices', 'tribe_show_fail_message' );

		//prevent loading of PRO
		remove_action( 'tribe_common_loaded', 'tribe_events_calendar_pro_init' );

		return;
	}

	// tribe_init_events_pro_autoloading();

	// new Tribe__Events__Pro__Plugin_Register();

}
add_action( 'tribe_common_loaded', 'tribe_register_pro_1', 5 );
// add action if Event Tickets or the Events Calendar is not active
add_action( 'plugins_loaded', 'tribe_register_pro_1', 50 );

function tribe_show_fail_message_1() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	//$error_message = '<p style="font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Oxygen-Sans,Ubuntu,Cantarell,\'Helvetica Neue\',sans-serif;font-size: 13px;line-height: 1.5;color:#444;font-weight: 700;">' . esc_html__( 'Divi Events Calendar requires The Events Calendar to be installed and active. You can download ', 'decm-divi-event-calendar-module' ) . '<a target="_blank" href="' . esc_url( 'https://wordpress.org/plugins/the-events-calendar/' ) . '">The Events Calendar</a>' . esc_html__( ' here.', 'the-events-calendar' ) . '</p><script>parent.document.getElementById("message").style.borderLeftColor="blue";parent.document.getElementById("message").getElementsByTagName("p")[0].style.display="none";</script>';
	 
	$url = 'plugin-install.php?tab=plugin-information&plugin=the-events-calendar&TB_iframe=true';

	echo '<div class="error"><p style="font-family:-apple-system,BlinkMacSystemFont,\'Segoe UI\',Roboto,Oxygen-Sans,Ubuntu,Cantarell,\'Helvetica Neue\',sans-serif;font-size: 13px;line-height: 1.5;color:#444;font-weight: 700;">'
	. sprintf(
		'%1s <a href="%2s" title="%3s" target="_blank">%4s</a>%5s.',
		esc_html__( 'Divi Events Calendar requires The Events Calendar to be installed and active. You can download ', 'decm-divi-event-calendar-module' ),
		esc_url( $url ),
		esc_html__( 'The Events Calendar', 'decm-divi-event-calendar-module' ),
		esc_html__( 'The Events Calendar', 'decm-divi-event-calendar-module' ),
		esc_html__( ' here', 'decm-divi-event-calendar-module' )
		) .
	'</p></div>';
}
  //register_activation_hook( __FILE__, 'div_event_calendar_activate' );
  function divi_event_calendar_view_documentation_links( $links_array, $plugin_file_name, $plugin_data, $status ) {
    if ( strpos( $plugin_file_name, basename(__FILE__) ) ) {
 
        // You can still use `array_unshift()` to add links at the beginning.
        $links_array[] = '<a href="https://www.peeayecreative.com/docs/divi-events-calendar/" target="_blank">View Documentation</a>';
      
    }
  
    return $links_array;
}
 
add_filter( 'plugin_row_meta', 'divi_event_calendar_view_documentation_links', 10, 4 );


//   add_action( 'update_option_active_sitewide_plugins', 'pluginprefix_deactivate_self', 10, 2 );
//   add_action( 'update_option_active_plugins', 'pluginprefix_deactivate_self', 10, 2 );
//   /**
//    *  Deactivate ourself if Addthis is deactivated.
//    * 
//    *  @param mixed $old_value The old option value.
//    *  @param mixed $value     The new option value.
//    */
//   function pluginprefix_deactivate_self( $plugin, $network_deactivating ) {
// 	  // The parameter/argument is the plugin basename for the parent plugin
// 	  // In this case, we are watching the AddThis plugin
// 	  // Note, this code will not work if the folder uploaded is a different slug (e.g., uploaded manually with custom folder name)
// 	  _wps_deactivate_self( 'the-events-calendar/the-events-calendar.php');
	
//   }
  
//   if ( !function_exists( '_wps_deactivate_self' ) ) {
// 	  /**
// 	   *  Deactivate ourself if parent plugin is deactivated.
// 	   * 
// 	   *  @param string $plugin_basename Plugin basename of the parent plugin.
// 	   */
// 	  function _wps_deactivate_self( $plugin_basename ) {
// 		  // Check if parent plugin is active
// 		  if ( !is_plugin_active( $plugin_basename ) ) {
// 			  // Parent is not active, so let's deactivate
// 			// WPCS: XSS ok.
// 			  deactivate_plugins( plugin_basename( __FILE__ ) );
			 
// 		  }
// 	  }
//   }


  define( 'EVENT_FILE', __FILE__ );
  define( 'EVENT_DIR', 	plugin_dir_url(EVENT_FILE) );

if ( ! function_exists( 'decm_initialize_extension' ) ):
/**
 * Creates the extension's main class instance.
 *
 * @since 2.0.0
 */


function decm_initialize_extension() {	 
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/DiviEventCalendarModule.php';

	//  if(!isset($_GET['et_fb']) || ! wp_verify_nonce( sanitize_key(wp_unslash( $_GET['et_fb']))))
	//  {

	// //	wp_enqueue_script('jquery_enquec', 'https://code.jquery.com/jquery-3.6.0.min.js', array(), null, false); 	 
	// 	wp_enqueue_script('main_1', 'https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.3.1/main.min.js', array(), null, false);
	// 	wp_enqueue_script('main_3', 'https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.js', array(), null, false);
	// 	wp_enqueue_script('main_6', plugin_dir_url(__dir__).'divi-event-calendar-module/includes/packages/main_6.js', array(), null, false);
	// 	wp_enqueue_script('main_7', plugin_dir_url(__dir__).'divi-event-calendar-module/includes/packages/main_7.js', array(), null, false);
	// 	//wp_enqueue_script( 'filter-multiple', plugin_dir_url(__dir__).'divi-event-calendar-module/includes/modules/EventDisplay/filter-multi-select-bundle.min.js', array(), null, false);
	// 	wp_enqueue_script( 'Jquery-slim', 'https://code.jquery.com/jquery-3.2.1.slim.min.js', array(), null, false);	
	// 	if(get_locale()!="en_US"){
	// 		wp_enqueue_script('main_8', plugins_url().'/divi-event-calendar-module/includes/packages/core/locales-all.js', array(), null, false);
	// 	}

	// }

//	wp_register_script( 'loadmore', plugins_url().'/divi-event-calendar-module/includes/modules/EventDisplay/loadmore.js');
   
}


add_action( 'divi_extensions_init', 'decm_initialize_extension' );
 
 
add_action("wp_ajax_fetch_Events", "fetchEvents");
add_action("wp_ajax_nopriv_fetch_Events", "fetchEvents");
// function smpl_load_icon_assets( $assets_list, $assets_args ) {
// 	if ( ! isset( $assets_list['et_icons_all'] ) ) {
// 		$assets_list['et_icons_all'] = array(
// 			'css' => "{$assets_args['assets_prefix']}/css/icons_all.css",
// 		);
// 	}
// 	return $assets_list;
// }
// add_filter( 'et_global_assets_list', 'smpl_load_icon_assets', 10, 2 );
// add_filter( 'et_late_global_assets_list', 'smpl_load_icon_assets', 10, 2 );

function fetchEvents( $atts, $conditional_tags = array(), $current_page = array() ){
	global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content,$wpdb;
			$post_type = get_post_type();
			$query_args['paged'] = $paged;
//	require_once plugin_dir_path( __FILE__ ) .'check_function.php';
	// global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
	// 		$post_type = get_post_type();
	// 		print_r($wp_qu ery);
	$_GET['event_tax']="";
	$search_search_criteria = isset($_REQUEST['search_search_criteria']) ? sanitize_text_field( wp_unslash( $_REQUEST['search_search_criteria']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended , WordPress.Security.NonceVerification.Recommended
$categories = isset($_GET['categories']) ? sanitize_text_field( wp_unslash( $_GET['categories'] ) ) : sanitize_text_field( wp_unslash( $_GET['categories'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended , WordPress.Security.NonceVerification.Recommended , WordPress.Security.NonceVerification.Recommended
$included_organizer = isset($_GET['included_organizer']) ? sanitize_text_field( wp_unslash( $_GET['included_organizer'] ) ) : sanitize_text_field( wp_unslash( $_GET['included_organizer'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended ,WordPress.Security.NonceVerification.Recommended ,WordPress.Security.NonceVerification.Recommended
$included_organizer_check = isset($_GET['included_organizer_check']) ? sanitize_text_field( wp_unslash( $_GET['included_organizer_check'] ) ) : sanitize_text_field( wp_unslash( $_GET['included_organizer_check'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended ,WordPress.Security.NonceVerification.Recommended , WordPress.Security.NonceVerification.Recommended
$included_venue = isset($_GET['included_venue']) ? sanitize_text_field( wp_unslash( $_GET['included_venue'] ) ) : sanitize_text_field( wp_unslash( $_GET['included_venue'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended	,WordPress.Security.NonceVerification.Recommended , WordPress.Security.NonceVerification.Recommended
$included_venue_check = isset($_GET['included_venue_check']) ? sanitize_text_field( wp_unslash( $_GET['included_venue_check'] ) ) : sanitize_text_field( wp_unslash( $_GET['included_venue_check'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended ,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended

$included_series = isset($_GET['included_series']) ? sanitize_text_field( wp_unslash( $_GET['included_series'] ) ) : sanitize_text_field( wp_unslash( $_GET['included_series'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$included_series_check = isset($_GET['included_series_check']) ? sanitize_text_field( wp_unslash( $_GET['included_series_check'] ) ) : sanitize_text_field( wp_unslash( $_GET['included_series_check'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,	WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$event_tax = isset($_GET['event_tax']) ? sanitize_text_field( wp_unslash( $_GET['event_tax']) ) : sanitize_text_field( wp_unslash( $_GET['event_tax'] ) );         //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended,	WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$dateformat = isset($_GET['dateformat']) ? sanitize_text_field( wp_unslash( $_GET['dateformat']) ) : sanitize_text_field( wp_unslash( $_GET['dateformat'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$event_time_format = isset($_GET['event_time_format']) ? sanitize_text_field( wp_unslash( $_GET['event_time_format']) ) : sanitize_text_field( wp_unslash( $_GET['event_time_format'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended,	WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$timeformat = isset($_GET['timeformat']) ? sanitize_text_field( wp_unslash( $_GET['timeformat']) ) : sanitize_text_field( wp_unslash( $_GET['timeformat'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended, WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$show_title=isset($_GET['show_title']) ? sanitize_text_field( wp_unslash( $_GET['show_title']) ) : sanitize_text_field( wp_unslash( $_GET['show_title'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$show_excerpt=isset($_GET['show_excerpt']) ? sanitize_text_field( wp_unslash( $_GET['show_excerpt']) ) : sanitize_text_field( wp_unslash( $_GET['show_excerpt'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended,	WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$show_icon_label=isset($_GET['show_icon_label']) ? sanitize_text_field( wp_unslash( $_GET['show_icon_label']) ) : sanitize_text_field( wp_unslash( $_GET['show_icon_label'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended	,WordPress.Security.NonceVerification.Recommended
$stack_label_icon=isset($_GET['stack_label_icon']) ? sanitize_text_field( wp_unslash( $_GET['stack_label_icon']) ) : sanitize_text_field( wp_unslash( $_GET['stack_label_icon'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended,WordPress.Security.NonceVerification.Recommended
$show_colon=isset($_GET['show_colon']) ? sanitize_text_field( wp_unslash( $_GET['show_colon']) ) : sanitize_text_field( wp_unslash( $_GET['show_colon'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended	 , WordPress.Security.NonceVerification.Recommended ,WordPress.Security.NonceVerification.Recommended
$show_date=isset($_GET['show_date']) ? sanitize_text_field( wp_unslash( $_GET['show_date']) ) : sanitize_text_field( wp_unslash( $_GET['show_date'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$timezone=isset($_GET['timezone']) ? sanitize_text_field( wp_unslash( $_GET['timezone']) ) : sanitize_text_field( wp_unslash( $_GET['timezone'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_time_zone_on_calendar=isset($_GET['show_time_zone_on_calendar']) ? sanitize_text_field( wp_unslash( $_GET['show_time_zone_on_calendar']) ) : sanitize_text_field( wp_unslash( $_GET['show_time_zone_on_calendar'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_time_zone_abb_on_calender=isset($_GET['show_time_zone_abb_on_calender']) ? sanitize_text_field( wp_unslash( $_GET['show_time_zone_abb_on_calender']) ) : sanitize_text_field( wp_unslash( $_GET['show_time_zone_abb_on_calender'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_rsvp=isset($_GET['show_rsvp']) ? sanitize_text_field( wp_unslash( $_GET['show_rsvp']) ) : sanitize_text_field( wp_unslash( $_GET['show_rsvp'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_event_venue=isset($_GET['show_event_venue']) ? sanitize_text_field( wp_unslash( $_GET['show_event_venue']) ) : sanitize_text_field( wp_unslash( $_GET['show_event_venue'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended

$timezone_abb=isset($_GET['timezone_abb']) ? sanitize_text_field( wp_unslash( $_GET['timezone_abb']) ) : sanitize_text_field( wp_unslash( $_GET['timezone_abb'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended

$venue=isset($_GET['venue']) ? sanitize_text_field( wp_unslash( $_GET['venue']) ) : sanitize_text_field( wp_unslash( $_GET['venue'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$location=isset($_GET['location']) ? sanitize_text_field( wp_unslash( $_GET['location']) ) : sanitize_text_field( wp_unslash( $_GET['location'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,	WordPress.Security.NonceVerification.Recommended
$street=isset($_GET['street']) ? sanitize_text_field( wp_unslash( $_GET['street']) ) : sanitize_text_field( wp_unslash( $_GET['street'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$locality=isset($_GET['locality']) ? sanitize_text_field( wp_unslash( $_GET['locality']) ) : sanitize_text_field( wp_unslash( $_GET['locality'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$state=isset($_GET['state']) ? sanitize_text_field( wp_unslash( $_GET['state']) ) : sanitize_text_field( wp_unslash( $_GET['state'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$postal=isset($_GET['postal']) ? sanitize_text_field( wp_unslash( $_GET['postal']) ) : sanitize_text_field( wp_unslash( $_GET['postal'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,	WordPress.Security.NonceVerification.Recommended
$country=isset($_GET['country']) ? sanitize_text_field( wp_unslash( $_GET['country']) ) : sanitize_text_field( wp_unslash( $_GET['country'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended


$street_comma=isset($_GET['street_comma']) ? sanitize_text_field( wp_unslash( $_GET['street_comma']) ) : sanitize_text_field( wp_unslash( $_GET['street_comma'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,	WordPress.Security.NonceVerification.Recommended
$locality_comma=isset($_GET['locality_comma']) ? sanitize_text_field( wp_unslash( $_GET['locality_comma']) ) : sanitize_text_field( wp_unslash( $_GET['locality_comma'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$state_comma=isset($_GET['state_comma']) ? sanitize_text_field( wp_unslash( $_GET['state_comma']) ) : sanitize_text_field( wp_unslash( $_GET['state_comma'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$postal_comma=isset($_GET['postal_comma']) ? sanitize_text_field( wp_unslash( $_GET['postal_comma']) ) : sanitize_text_field( wp_unslash( $_GET['postal_comma'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$country_comma=isset($_GET['country_comma']) ? sanitize_text_field( wp_unslash( $_GET['country_comma']) ) : sanitize_text_field( wp_unslash( $_GET['country_comma'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_postal_code_before_locality=isset($_GET['show_postal_code_before_locality']) ? sanitize_text_field( wp_unslash( $_GET['show_postal_code_before_locality']) ) : sanitize_text_field( wp_unslash( $_GET['show_postal_code_before_locality'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended

$organizer=isset($_GET['organizer']) ? sanitize_text_field( wp_unslash( $_GET['organizer']) ) : sanitize_text_field( wp_unslash( $_GET['organizer'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended
$show_time=isset($_GET['show_time']) ? sanitize_text_field( wp_unslash( $_GET['show_time']) ) : sanitize_text_field( wp_unslash($_GET['show_time'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_end_time=isset($_GET['show_end_time']) ? sanitize_text_field( wp_unslash( $_GET['show_end_time']) ) : sanitize_text_field( wp_unslash($_GET['show_end_time'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended

//$show_end_time=isset($_GET['show_end_time']) ? sanitize_text_field( wp_unslash( $_GET['show_end_time']) ) : sanitize_text_field( wp_unslash($_GET['show_end_time'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_price=isset($_GET['show_price']) ? sanitize_text_field( wp_unslash( $_GET['show_price']) ) : sanitize_text_field( wp_unslash($_GET['show_price']) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
// $show_RSVP=isset($_GET['show_RSVP']) ? sanitize_text_field( wp_unslash( $_GET['show_RSVP']) ) : sanitize_text_field( wp_unslash($_GET['show_RSVP']) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_image=isset($_GET['show_image']) ? sanitize_text_field( wp_unslash( $_GET['show_image']) ) : sanitize_text_field( wp_unslash( $_GET['show_image'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_image_tablet=isset($_GET['show_image_tablet']) ? sanitize_text_field( wp_unslash( $_GET['show_image_tablet']) ) : sanitize_text_field( wp_unslash( $_GET['show_image_tablet'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_image_phone=isset($_GET['show_image_phone']) ? sanitize_text_field( wp_unslash( $_GET['show_image_phone']) ) : sanitize_text_field( wp_unslash( $_GET['show_image_phone'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$categslug=isset($_GET['categslug']) ? sanitize_text_field( wp_unslash( $_GET['categslug']) ) : sanitize_text_field( wp_unslash( $_GET['categslug'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$categId=isset($_GET['categId']) ? sanitize_text_field( wp_unslash( $_GET['categId']) ) : sanitize_text_field( wp_unslash( $_GET['categId'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$event_selection=isset($_GET['event_selection']) ? sanitize_text_field( wp_unslash( $_GET['event_selection']) ) : sanitize_text_field( wp_unslash( $_GET['event_selection'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_tooltip_category=isset($_GET['show_tooltip_category']) ? sanitize_text_field( wp_unslash( $_GET['show_tooltip_category']) ) : sanitize_text_field( wp_unslash( $_GET['show_tooltip_category'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$hide_comma_tag=isset($_GET['hide_comma_tag']) ? sanitize_text_field( wp_unslash( $_GET['hide_comma_tag']) ) : sanitize_text_field( wp_unslash( $_GET['hide_comma_tag'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$show_tag=isset($_GET['show_tag']) ? sanitize_text_field( wp_unslash( $_GET['show_tag']) ) : sanitize_text_field( wp_unslash( $_GET['show_tag'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,	WordPress.Security.NonceVerification.Recommended
$limit_event_title_length=isset($_GET['limit_event_title_length']) ? sanitize_text_field( wp_unslash( $_GET['limit_event_title_length']) ) : sanitize_text_field( wp_unslash( $_GET['limit_event_title_length'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,	WordPress.Security.NonceVerification.Recommended
$event_title_length=isset($_GET['event_title_length']) ? sanitize_text_field( wp_unslash( $_GET['event_title_length']) ) : sanitize_text_field( wp_unslash( $_GET['event_title_length'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,	WordPress.Security.NonceVerification.Recommended
$show_postponed_canceled_event=isset($_GET['show_postponed_canceled_event']) ? sanitize_text_field( wp_unslash( $_GET['show_postponed_canceled_event']) ) : sanitize_text_field( wp_unslash( $_GET['show_postponed_canceled_event'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$show_recurring_event=isset($_GET['show_recurring_event']) ? sanitize_text_field( wp_unslash( $_GET['show_recurring_event']) ) : sanitize_text_field( wp_unslash( $_GET['show_recurring_event'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_tooltip_weburl=isset($_GET['show_tooltip_weburl']) ? sanitize_text_field( wp_unslash( $_GET['show_tooltip_weburl']) ) : sanitize_text_field( wp_unslash( $_GET['show_tooltip_weburl'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$calendar_start=isset($_GET['start']) ? sanitize_text_field( wp_unslash( $_GET['start']) ) : sanitize_text_field( wp_unslash( $_GET['start'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$calendar_end=isset($_GET['end']) ? sanitize_text_field( wp_unslash( $_GET['end']) ) : sanitize_text_field( wp_unslash( $_GET['end'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$limit_event=isset($_GET['limit_event']) ? sanitize_text_field( wp_unslash( $_GET['limit_event']) ) : sanitize_text_field( wp_unslash( $_GET['limit_event'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_start_date=isset($_GET['event_start_date']) ? sanitize_text_field( wp_unslash( $_GET['event_start_date']) ) : sanitize_text_field( wp_unslash( $_GET['event_start_date'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_end_date=isset($_GET['event_end_date']) ? sanitize_text_field( wp_unslash( $_GET['event_end_date']) ) : sanitize_text_field( wp_unslash( $_GET['event_end_date'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$single_event_page_link=isset($_GET['single_event_page_link']) ? sanitize_text_field( wp_unslash( $_GET['single_event_page_link']) ) : sanitize_text_field( wp_unslash( $_GET['single_event_page_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$disable_event_title_link=isset($_GET['disable_event_title_link']) ? sanitize_text_field( wp_unslash( $_GET['disable_event_title_link']) ) : sanitize_text_field( wp_unslash( $_GET['disable_event_title_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$disable_event_image_link=isset($_GET['disable_event_image_link']) ? sanitize_text_field( wp_unslash( $_GET['disable_event_image_link']) ) : sanitize_text_field( wp_unslash( $_GET['disable_event_image_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$disable_event_calendar_title_link=isset($_GET['disable_event_calendar_title_link']) ? sanitize_text_field( wp_unslash( $_GET['disable_event_calendar_title_link']) ) : sanitize_text_field( wp_unslash( $_GET['disable_event_calendar_title_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$custom_event_link_url=isset($_GET['custom_event_link_url']) ? sanitize_text_field( wp_unslash( $_GET['custom_event_link_url']) ) : sanitize_text_field( wp_unslash( $_GET['custom_event_link_url'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$custom_event_link_target=isset($_GET['custom_event_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_event_link_target']) ) : sanitize_text_field( wp_unslash( $_GET['custom_event_link_target'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$website_link=isset($_GET['website_link']) ? sanitize_text_field( wp_unslash( $_GET['website_link']) ) : sanitize_text_field( wp_unslash( $_GET['website_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$custom_website_link_text=isset($_GET['custom_website_link_text']) ? sanitize_text_field( wp_unslash( $_GET['custom_website_link_text']) ) : sanitize_text_field( wp_unslash( $_GET['custom_website_link_text'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,  WordPress.Security.NonceVerification.Recommended
$custom_website_link_target=isset($_GET['custom_website_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_website_link_target']) ) : sanitize_text_field( wp_unslash( $_GET['custom_website_link_target'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$enable_category_link=isset($_GET['enable_category_link']) ? sanitize_text_field( wp_unslash( $_GET['enable_category_link']) ) : sanitize_text_field( wp_unslash( $_GET['enable_category_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended

$enable_organizer_link=isset($_GET['enable_organizer_link']) ? sanitize_text_field( wp_unslash( $_GET['enable_organizer_link']) ) : sanitize_text_field( wp_unslash( $_GET['enable_organizer_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$enable_venue_link=isset($_GET['enable_venue_link']) ? sanitize_text_field( wp_unslash( $_GET['enable_venue_link']) ) : sanitize_text_field( wp_unslash( $_GET['enable_venue_link'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$custom_category_link_target=isset($_GET['custom_category_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_category_link_target']) ) : sanitize_text_field( wp_unslash( $_GET['custom_category_link_target'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended

$custom_organizer_link_target=isset($_GET['custom_organizer_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_organizer_link_target']) ) : sanitize_text_field( wp_unslash( $_GET['custom_organizer_link_target'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$custom_venue_link_target=isset($_GET['custom_venue_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_venue_link_target']) ) : sanitize_text_field( wp_unslash( $_GET['custom_venue_link_target'] ) ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$organizer_id=isset($_GET['organizer_id']) ? sanitize_text_field( wp_unslash( $_GET['organizer_id']) ) : sanitize_text_field( wp_unslash( $_GET['organizer_id'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$venue_id=isset($_GET['venue_id']) ? sanitize_text_field( wp_unslash( $_GET['venue_id']) ) : sanitize_text_field( wp_unslash( $_GET['venue_id'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$show_hybrid_event = isset($_GET['show_hybrid_event']) ? sanitize_text_field( wp_unslash( $_GET['show_hybrid_event'] ) ) : sanitize_text_field( wp_unslash( $_GET['show_hybrid_event'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$show_virtual_event = isset($_GET['show_virtual_event']) ? sanitize_text_field( wp_unslash( $_GET['show_virtual_event'] ) ) : sanitize_text_field( wp_unslash( $_GET['show_virtual_event'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$button_classes = isset($_GET['button_classes']) ? sanitize_text_field( wp_unslash( $_GET['button_classes'] ) ) : sanitize_text_field( wp_unslash( $_GET['button_classes'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended

$custom_icon = isset($_GET['custom_icon']) ? sanitize_text_field( wp_unslash( $_GET['custom_icon'] ) ) : sanitize_text_field( wp_unslash( $_GET['custom_icon'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$custom_icon_tablet = isset($_GET['custom_icon_tablet']) ? sanitize_text_field( wp_unslash( $_GET['custom_icon_tablet'] ) ) : sanitize_text_field( wp_unslash( $_GET['custom_icon_tablet'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$custom_icon_phone = isset($_GET['custom_icon_phone']) ? sanitize_text_field( wp_unslash( $_GET['custom_icon_phone'] ) ) : sanitize_text_field( wp_unslash( $_GET['custom_icon_phone'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$view_more_text = isset($_GET['view_more_text']) ? sanitize_text_field( wp_unslash( $_GET['view_more_text'] ) ) : sanitize_text_field( wp_unslash( $_GET['view_more_text'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$hide_past_event = isset($_GET['hide_past_event']) ? sanitize_text_field( wp_unslash( $_GET['hide_past_event'] ) ) : sanitize_text_field( wp_unslash( $_GET['hide_past_event'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$enable_tag_links = isset($_GET['enable_tag_links']) ? sanitize_text_field( wp_unslash( $_GET['enable_tag_links'] ) ) : sanitize_text_field( wp_unslash( $_GET['enable_tag_links'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$custom_tag_link_target = isset($_GET['custom_tag_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_tag_link_target'] ) ) : sanitize_text_field( wp_unslash( $_GET['custom_tag_link_target'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$hide_comma_cat = isset($_GET['hide_comma_cat']) ? sanitize_text_field( wp_unslash( $_GET['hide_comma_cat'] ) ) : sanitize_text_field( wp_unslash( $_GET['hide_comma_cat'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$category_detail_label = isset($_GET['category_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['category_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['category_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
$event_series_label = isset($_GET['event_series_label']) ? sanitize_text_field( wp_unslash( $_GET['event_series_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['event_series_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_series_name = isset($_GET['event_series_name']) ? sanitize_text_field( wp_unslash( $_GET['event_series_name'] ) ) : sanitize_text_field( wp_unslash( $_GET['event_series_name'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$custom_series_link_target = isset($_GET['custom_series_link_target']) ? sanitize_text_field( wp_unslash( $_GET['custom_series_link_target'] ) ) : sanitize_text_field( wp_unslash( $_GET['custom_series_link_target'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$enable_series_link = isset($_GET['enable_series_link']) ? sanitize_text_field( wp_unslash( $_GET['enable_series_link'] ) ) : sanitize_text_field( wp_unslash( $_GET['enable_series_link'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$time_detail_label = isset($_GET['time_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['time_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['time_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$date_detail_label = isset($_GET['date_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['date_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['date_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$venue_detail_label = isset($_GET['venue_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['venue_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['venue_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$location_detail_label = isset($_GET['location_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['location_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['location_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$organizer_detail_label = isset($_GET['organizer_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['organizer_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['organizer_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$price_detail_label = isset($_GET['price_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['price_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['price_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$rsvp_detail_label = isset($_GET['rsvp_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['rsvp_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['rsvp_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$tag_detail_label = isset($_GET['tag_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['tag_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['tag_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$website_detail_label = isset($_GET['website_detail_label']) ? sanitize_text_field( wp_unslash( $_GET['website_detail_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['website_detail_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$module_class = isset($_GET['module_class']) ? sanitize_text_field( wp_unslash( $_GET['module_class'] ) ) : sanitize_text_field( wp_unslash( $_GET['module_class'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$price_ticket_label = isset($_GET['price_ticket_label']) ? sanitize_text_field( wp_unslash( $_GET['price_ticket_label'] ) ) : sanitize_text_field( wp_unslash( $_GET['price_ticket_label'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_tooltip_ticket = isset($_GET['show_tooltip_ticket']) ? sanitize_text_field( wp_unslash( $_GET['show_tooltip_ticket'] ) ) : sanitize_text_field( wp_unslash( $_GET['show_tooltip_ticket'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_rsvp_feed_respond = isset($_GET['show_rsvp_feed_respond']) ? sanitize_text_field( wp_unslash( $_GET['show_rsvp_feed_respond'] ) ) : sanitize_text_field( wp_unslash( $_GET['show_rsvp_feed_respond'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_rsvp_feed_left = isset($_GET['show_rsvp_feed_left']) ? sanitize_text_field( wp_unslash( $_GET['show_rsvp_feed_left'] ) ) : sanitize_text_field( wp_unslash( $_GET['show_rsvp_feed_left'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_ticket_feed_respond = isset($_GET['show_ticket_feed_respond']) ? sanitize_text_field( wp_unslash( $_GET['show_ticket_feed_respond'] ) ) : sanitize_text_field( wp_unslash( $_GET['show_ticket_feed_respond'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_ticket_feed_left = isset($_GET['show_ticket_feed_left']) ? sanitize_text_field( wp_unslash( $_GET['show_ticket_feed_left'] ) ) : sanitize_text_field( wp_unslash( $_GET['show_ticket_feed_left'] ) );    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended

$time_custom_label = __('Time','decm-divi-event-calendar-module');
if(!empty($time_detail_label)){
	$time_custom_label =  __($time_detail_label,'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}

$date_custom_label = __('Date','decm-divi-event-calendar-module');
if(!empty($date_detail_label)){
	$date_custom_label =  __($date_detail_label,'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}

$venue_custom_label = __('Venue','decm-divi-event-calendar-module');
if(!empty($venue_detail_label)){
	$venue_custom_label =  __($venue_detail_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}

$tag_custom_label = __('Tags','decm-divi-event-calendar-module');
if(!empty($tag_detail_label)){
$tag_custom_label =  __($tag_detail_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}

$category_custom_label = __('Category','decm-divi-event-calendar-module');
if(!empty($category_detail_label)){
		$category_custom_label =  __($category_detail_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}

$website_custom_label = __('Website','decm-divi-event-calendar-module');
if(!empty($website_detail_label)){
		$website_custom_label =  __($website_detail_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}


$price_custom_label = __('Price','decm-divi-event-calendar-module');
	if(!empty($price_detail_label)){
			$price_custom_label =  __($price_detail_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
	}

	$ticket_custom_label = __('Ticket','decm-divi-event-calendar-module');
	if(!empty($price_ticket_label)){
			$ticket_custom_label =  __($price_ticket_label,'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
	}

			

$rsvp_custom_label = __('RSVP','decm-divi-event-calendar-module');
	if(!empty($rsvp_detail_label)){
			$rsvp_custom_label =  __($rsvp_detail_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
	}

$organizer_custom_label = __('Organizer','decm-divi-event-calendar-module');
if(!empty($organizer_detail_label)){
		$organizer_custom_label =  __($organizer_detail_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}

$location_custom_label = __('Location','decm-divi-event-calendar-module');
if(!empty($location_detail_label)){
	$location_custom_label =  __($location_detail_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
}

$series_custom_label = __('Event Series','decm-divi-event-calendar-module');
		if(!empty($event_series_label)){
		   $series_custom_label =  __($event_series_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
		}

$show_one_month_ahead = 1;
// print_r($button_classes);
$event_end_date -= $show_one_month_ahead;
$venue_page_id=tribe_get_venue_id();
$orgnizer_page_id=tribe_get_organizer_id();
//print_r($orgnizer_page_id);
if ( $categories ) {
	if ( strpos( $categories, "," ) !== false ) {
		$categories = explode( ",", $categories );
		$categories  = array_map( 'trim',$categories );
	} else {
		$categories = array( trim( $categories ) );
	}

	$event_tax = array(
		'relation' => 'OR',
	);

	foreach ( $categories  as $cat ) {
		$event_tax[] = array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $cat,
			);
			
	}
}
//print_r($cat);
if($event_selection=="show_dynamic_content"){
	if($categslug==""){
		if ($venue_page_id ) {
			unset( $args['tax_query'] );
			$args['meta_query'] = array( $atts['meta_date'],[ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query ,	WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				'relation' => 'AND',
				[
				  'key' => '_EventVenueID',
				  'value' => $venue_page_id,
				  'compare' => '=',
				]
				]);
		  }
		  if ( $orgnizer_page_id ) {
			unset( $args['tax_query'] );
			$args['meta_query'] = array( $atts['meta_date'],[ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query, WordPress.Security.EscapeOutput.OutputNotEscaped ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query ,	WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			  'relation' => 'AND',
			  [
				'key' => '_EventOrganizerID',
				'value' => $orgnizer_page_id,
				'compare' => '=',
			  ]
			]);
		  }
		}
	if($categslug){
	unset($event_tax);
	$event_tax[] = array(
		'taxonomy' => 'tribe_events_cat',
		'field' => 'term_id',
		'terms' => $categId,
	);
}
}
$meta_query_status="";
if($show_postponed_canceled_event=='off'){
	$meta_query_status = array('relation' => 'OR',
		array(
			'key' => '_tribe_events_status',
			'value' => 'postponed',
			'compare' => '=',
			'type' => 'Text'
		),
			array(
				'key' => '_tribe_events_status',
				'value' => 'canceled',
				'compare' => '=',
				'type' => 'Text'
			)
		);
	}

		$filter_event_status = array(
		
			'post_type' => 'tribe_events',
			'meta_query' => array($meta_query_status), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
		  );
		  $filter_event_status = tribe_get_events($filter_event_status);
	

		  $filter_event_status = $show_postponed_canceled_event=='off'? wp_list_pluck($filter_event_status, 'ID'):array(0);

		  if($show_hybrid_event=='off' && $show_virtual_event=='off'){
			$meta_query_status_virtual = array(
				'relation' => 'OR',
			  array(
				'key' => '_tribe_virtual_events_type',
				'value' => 'virtual',
				'compare' => '=',
				'type' => 'Text'
			  ),
		  
			  array(
				  'key' => '_tribe_virtual_events_type',
				  'value' => 'hybrid',
				  'compare' => '=',
				  'type' => 'Text'
		
				)
			  );
		  } 
	
		  if($show_hybrid_event=='on' && $show_virtual_event=='off'){
			$meta_query_status_virtual =
			 
			  array(
				'key' => '_tribe_virtual_events_type',
				'value' => 'virtual',
				'compare' => '=',
				'type' => 'Text'
			
		  
			  );
		  }
		  if($show_hybrid_event=='off' && $show_virtual_event=='on'){
			$meta_query_status_virtual =
			
				array(
				  'key' => '_tribe_virtual_events_type',
				  'value' => 'hybrid',
				  'compare' => '=',
				  'type' => 'Text'	
			  );
		  } 

		    if($show_hybrid_event=='on'  && $show_virtual_event=='on'){
		     $meta_query_status_virtual = "";
	      }


		//  $meta_query_status_virtual=array_merge($meta_query_status_virtual,$meta_query_status_hybrid);
		  $filter_event_status_virtual = array(
			'posts_per_page' => -1,
			'post_type' => 'tribe_events',
			'meta_query' =>array($meta_query_status_virtual), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
		  );
		  $filter_event_status_virtual = tribe_get_events($filter_event_status_virtual);
		  $filter_event_status_virtual = $show_virtual_event=='off' || $show_hybrid_event=='off'?wp_list_pluck($filter_event_status_virtual, 'ID'):array(0);
		  $filter_event_status=array_merge($filter_event_status,$filter_event_status_virtual);
//	print_r(is_singular( Tribe__Events__Main::ORGANIZER_POST_TYPE ));
		  $event_data = array();
		  $meta_date_compare = '>=';
		  $meta_date_date = current_time( 'Y-m-d H:i:s');
		  $meta_date = array(
			array(
				'key' => '_EventStartDate',
				'value' => $meta_date_date,
				'compare' => $meta_date_compare,
				'type' => 'DATETIME'
			)
		);

		$included_venue=explode(",",$included_venue);
		$included_organizer=explode(",",$included_organizer);
		$included_series=explode(",",$included_series);
		$get_start_dateEvent=gmdate("y-m-d H:i:s",strtotime("last day of this month"."+".$event_end_date." month"));
		if(function_exists('tribe_is_event_series')) {
			// Remove empty elements from the array
			$included_series = array_filter($included_series, function($value) {
				return !empty($value);
			});
		
			if($event_selection == "custom_event" && implode(",", $included_series) != "") {
				global $wpdb;
		
				$decm_series_args = array(
					'posts_per_page' => -1,
					'post_status' => 'publish',
					'post_type' => 'tribe_event_series',
				);
		
				$decm_series_events_table = (new TEC\Events_Pro\Custom_Tables\V1\Tables\Series_Relationships)->table_name(true);
				
				// Check if the $included_series array contains elements
				if (!empty($included_series)) {
					$decm_check_query_sizeof = count($included_series) == 1 ? "LIKE" : "IN";
					$decm_series_update = $wpdb->get_results("SELECT event_post_id FROM $decm_series_events_table WHERE series_post_id $decm_check_query_sizeof (" . implode(",", $included_series) . ")");  // phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared , WordPress.DB.PreparedSQL.InterpolatedNotPrepared , WordPress.DB.DirectDatabaseQuery.DirectQuery , WordPress.DB.DirectDatabaseQuery.NoCaching
					$decm_series_update = array_column($decm_series_update, 'event_post_id');
					// print_r($decm_series_update);
				}
			}
		}
		
		
$args = array(  
	'posts_per_page' => -1,
	'tax_query'=> $event_tax, //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	'included_categories' =>$categslug=="" && $event_selection=="show_dynamic_content"?$categories:$categslug,
	'hide_subsequent_recurrences'=>$show_recurring_event=="on"?false:true,
//	'post__not_in'		=>$show_postponed_canceled_event=='off'?$filter_event_status:($show_virtual_event=='off'?$filter_event_status:($show_virtual_event=='off'?$filter_event_status:"")),
    'post__in'=>$event_selection=="custom_event"&&$included_series_check!=""?$decm_series_update:"",	
    'post__not_in'		=> $show_postponed_canceled_event=='off'?$filter_event_status:($show_virtual_event=='off' &&  $show_hybrid_event=='off'?$filter_event_status:$filter_event_status), //phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
	 'start_date'   =>$limit_event=="on"?gmdate("Y-m-d H:i:s",strtotime("first day of this month-".$event_start_date." month")):"",
	 'end_date'   => $limit_event=="on"?gmdate('Y-m-d H:i:s', strtotime($get_start_dateEvent. ' +1 month')):"",
	 //'organizer'=>$atts['included_organizer_check']!=""?$atts['included_organizer']:"",
	//  'venue'=>$atts['included_venue_check']==""?"":$atts['included_venue'],
	  'organizer'=>$event_selection=="show_dynamic_content" &&tribe_has_organizer(get_the_id())==true&& $organizer_id!=""?$organizer_id:(($event_selection=='custom_event' && $included_organizer_check !="")?$included_organizer:""),
	  'venue'=>$event_selection=="show_dynamic_content" &&tribe_has_venue(get_the_id())==true&& $venue_id!=""?$venue_id:(($event_selection=='custom_event' && $included_venue_check !="")?$included_venue:""),
	  //  'venue'=>$show_dynamic_content=="on" && $venue_id!=""?$venue_id:"",
	// 'venue'=>$venue_id,
	 // 'eventDisplay' => 'list',
	// 'ends_after' => 'now',
	//  'end_date'  =>  strstr($calendar_end, 'T', true),
	// 'lazyFatcheing'=>true,
	//'meta_query' => array($atts['meta_date'] ),
);
if($event_selection=="featured_events"){
	$args['featured']="true";
}
else{}
if($hide_past_event=="on"){
	$args['meta_query']=array($meta_date ); //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
}
	else{}

$events=tribe_get_events($args);
//calendar start=30-7-2021 and event start date 10-8-2021
// calendar end 4-7-2021 and event end date 6-8-2021
// Loop through the events, displaying the title and content for each
//print_r($show_icon_label);
// $janii=get_divi_event_calendar_paramenter();
//print_r($janii['show_icon_label']);
$decm_image_class_phone="";
$decm_image_class_tablet="";
$decm_image_class="";
if ($show_image == "on") {}
if (($show_image_tablet == "off" || ($show_image_tablet == "" && $show_image == "off"))){
$decm_image_class_tablet="decm_image_class_tablet";
}
if (($show_image_phone == "off" || ($show_image_phone == "" && $show_image == "off"))) {
	$decm_image_class_phone="decm_image_class_phone";
}
$show_colon= $show_colon=="on"?":":"";

$showicon_series = ($show_icon_label==="label_icon" || $show_icon_label==="icon") && $event_series_name == "on" ? 'diem-events-series-relationship-single-marker__icon':"";
$showlabel_series = ($show_icon_label==="label_icon" || $show_icon_label ==="label") && $event_series_name == "on" ? '<span class=decm-detail-label>'.$series_custom_label.$show_colon."</span>":"";
$showicon_organizer= ($show_icon_label==="label_icon" || $show_icon_label==="icon") && $organizer=="on"?"organizer-decm-icon":"";
$showlabel_organizer = ($show_icon_label==="label_icon" || $show_icon_label ==="label")&& $organizer=="on" ?'<span class=decm-detail-label>'.$organizer_custom_label.$show_colon." </span>":"";
$showicon_venue= ($show_icon_label==="label_icon" || $show_icon_label==="icon")&&$venue=="on" ?"venue-decm-icon":"";
$showlabel_venue = ($show_icon_label==="label_icon" || $show_icon_label ==="label")&&$venue=="on" ?'<span class=decm-detail-label>'.$venue_custom_label.$show_colon." </span>":"";
$showicon_location= ($show_icon_label==="label_icon" || $show_icon_label==="icon") ?"event-location-decm-icon":"";
$showlabel_location = ($show_icon_label==="label_icon" || $show_icon_label ==="label") ?'<span class=decm-detail-label>'.$location_custom_label.$show_colon." </span>":"";
$showicon_category= ($show_icon_label==="label_icon" || $show_icon_label==="icon") ?"categories-decm-icon":"";
$showlabel_category = ($show_icon_label==="label_icon" || $show_icon_label ==="label") ?'<span class=decm-detail-label>'.$category_custom_label.$show_colon." </span>":"";
$showicon_tag= ($show_icon_label==="label_icon" || $show_icon_label==="icon") ?"categories-decm-icon":"";
$showlabel_tag = ($show_icon_label==="label_icon" || $show_icon_label ==="label") ?'<span class=decm-detail-label>'.$tag_custom_label.$show_colon." </span>":"";
$showicon_price= ($show_icon_label==="label_icon" || $show_icon_label==="icon")  ?"price-decm-icon":"";
$showlabel_price = ($show_icon_label==="label_icon" || $show_icon_label==="label") ?'<span class=ecs-detail-label>'.$price_custom_label.$show_colon." </span>":"";
$showlabel_rsvp = ($show_icon_label==="label_icon" || $show_icon_label==="label") ?'<span class=ecs-detail-label>'.$rsvp_custom_label.$show_colon." </span>":"";
$dec_country_comma=$country_comma == "on" && $location == "on"?", ":" ";
$dec_locality_comma=$locality_comma == "on" && $location == "on"?", ":" ";
$dec_postal_code_comma=$postal_comma == "on" && $location == "on"?", ":" ";
$dec_street_comma=$street_comma == "on" && $location == "on"?", ":" ";
$dec_state_comma=$state_comma == "on" && $location == "on"?", ":" ";
$showicon_ticket= ($show_icon_label==="label_icon" || $show_icon_label==="icon")  ?"price-decm-icon":"";
$showicon_rsvp = ($show_icon_label==="label_icon" || $show_icon_label==="icon")  ?"price-decm-icon":"";
$showlabel_ticket = ($show_icon_label==="label_icon" || $show_icon_label==="label") ?'<span class=ecs-detail-label>'.$ticket_custom_label.$show_colon." </span>":"";

foreach ( $events as $event ) {
	$e = array();
	$category_names = array();
	$category_list = get_the_terms( $event->ID, 'tribe_events_cat' );
	if ( is_array( $category_list ) ) {
		foreach ( (array) $category_list as $category ) {
			/**
			 * Show Categories of every events
			 *
			 * @author bojana
			 */
			$categories_link =$show_tooltip_category=="on"? $enable_category_link=="on" ?'<a href="'.esc_attr(get_category_link( $category->term_id )).'" target="'.$custom_category_link_target.'" >'.esc_attr($category->name).'</a>' : esc_attr($category->name):"";
			$category_names[] = $categories_link;
		}
	}


	$tag_names = array();
	$tag_slugs = array();
    $tag_list =  get_the_terms( $event->ID, 'post_tag' );
			//	$featured_class = ( get_post_meta( $event_post->ID , '_tribe_featured', true ) ? ' ecs-featured-event ' : '' );
				//print_r($featured_class);
	if ( is_array( $tag_list ) ) {
					foreach ( (array) $tag_list as $tag ) {
						$tag_slugs[] = ' ' . $tag->slug . '_ecs_tag';
						/**
						 * Show Categories of every events
						 *
						 * @author bojana
						 */

						$tag_enable_link = $enable_tag_links == 'on' ? '<a href="'.get_term_link( $tag->term_id ).'" target="'.$custom_tag_link_target.'" >'.esc_attr($tag->name).'</a>' : '<span>'.esc_attr($tag->name).'</span>';
						$tag_names[] = '<span class= "decm_tag ecs_tag_'.esc_attr($tag->slug).'" >'.$tag_enable_link.'</span>';
					}
    }

  $link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_event_website_link($event->ID) ?? '', $result);
  $result=tribe_get_event_website_link($event->ID)!=null?$result['href'][0]:tribe_get_event_link($event->ID);
 // print_r(($single_event_page_link=="default"?tribe_get_event_link($event->ID):$custom_event_link_url=="")?tribe_get_event_link($event->ID):$single_event_page_link=="redirect_link"?$result: $custom_event_link_url);
//print_r(tribe_get_event_categories( $event->ID, array('echo' => '','before' => '','sep'=> ', ','after'=> '','label'=> '','label_before' => '','label_after' => '','wrap_before' => '<div class ="event_category_style">','wrap_after' => '</div>',) ));
$organizers = tribe_get_organizer_ids($event->ID);
$orgName = array();
foreach ($organizers as $key => $organizerId) {
	$link_organizer = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_organizer_link($organizerId) ?? '', $result_organizer);
	$result_organizer =  isset($result_organizer['href'][0]) ? sanitize_text_field( wp_unslash($result_organizer['href'][0]) ) : sanitize_text_field( wp_unslash("") );
  $orgName[$key] = $orgName[$key] = $enable_organizer_link=="on"?'<a href="'.$result_organizer.'" target="'.$custom_organizer_link_target.'">'.tribe_get_organizer($organizerId).'</a>':tribe_get_organizer($organizerId);
} 

$orgNames	= implode(', ', $orgName); 
// print_r($orgNames);

		$url = $event->guid;	
		preg_match("/&?p=([^&]+)/", $url, $matches);
		//  $series_id = $matches[1]; 
		if(!empty($matches[1])){
			$series_id = $matches[1]; 
		}else{
			$series_id = $event->ID;
		}

		if( function_exists("tec_event_series") && !empty(tec_event_series(  $series_id ))) {
				$enable_series_links = $enable_series_link == 'on' ? '<a href="'.esc_url(tec_event_series( $series_id )->guid).'" class="diec-events-series-relationship-single-marker__title tribe-common-cta--alt" target="'.esc_attr($custom_series_link_target).'"><span class="diec_series_marker__title">'.esc_html(tec_event_series( $series_id )->post_title).'</span></a>': '<span class="diec_series_marker__title">'.esc_html(tec_event_series( $series_id )->post_title).'</span>';
			$e['show_calendar_series_name'] = $event_series_name =='on'? '<div class="tooltip_event_series"><span class="'.$showicon_series.'"><span class="decm_series_name">'.$showlabel_series." ".$enable_series_links.'</span></span></div>':"";
			
		 }else{
			$e['show_calendar_series_name'] = "";
		}
$event_virtual_type = esc_html(tribe_get_event_meta($event->ID, '_tribe_virtual_events_type', true));
$e['custom_event_link_url']=$single_event_page_link=="default" || ($single_event_page_link=="replace_link" &&$custom_event_link_url=="")?tribe_get_event_link($event->ID):(($single_event_page_link=="redirect_link")?$result: $custom_event_link_url);
$e["category_data"] = get_the_terms($event->ID,'tribe_events_cat');
$e['event_virtual'] = $event_virtual_type === "virtual" ? '<div class="ecs_event_type_virtual">
        <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--virtual tribe-events-virtual-virtual-event__icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 16" style="font-size: 5px !important;margin: 0px !important;width: 24px;height: 12px;">
            <g fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)">
                <path d="M18 10.7333333c2.16-2.09999997 2.16-5.44444441 0-7.46666663M21.12 13.7666667c3.84-3.7333334 3.84-9.80000003 0-13.53333337M6 10.7333333C3.84 8.63333333 3.84 5.28888889 6 3.26666667M2.88 13.7666667C-.96 10.0333333-.96 3.96666667 2.88.23333333" class="tribe-common-c-svgicon__svg-stroke"></path>
                <ellipse cx="12" cy="7" rx="2.4" ry="2.33333333" class="tribe-common-c-svgicon__svg-stroke"></ellipse>
            </g>
        </svg>
        <span class="ecs_event_type_'.esc_attr($event_virtual_type).'" style="display:inline;font-size:15px">'.esc_html__('Virtual Event', 'decm-divi-event-calendar-module').'</span>
    </div>'
    : "";
$e['event_hybrid'] = $event_virtual_type === "hybrid"?'
<div class="ecs_event_type_hybrid"><svg class="tribe-common-c-svgicon tribe-common-c-svgicon--hybrid tribe-events-virtual-hybrid-event__icon-svg" viewBox="0 0 15 13" fill="none" style="width: 24px;height: 12px;" xmlns="http://www.w3.org/2000/svg">
<circle cx="3.661" cy="9.515" r="2.121" transform="rotate(-45 3.661 9.515)" stroke="#0F0F30" stroke-width="1.103"></circle><circle cx="7.54" cy="3.515" r="2.121" transform="rotate(-45 7.54 3.515)" stroke="#0F0F30" stroke-width="1.103"></circle>
<path d="M4.54 7.929l1.964-2.828" stroke="#0F0F30"></path><circle r="2.121" transform="scale(-1 1) rotate(-45 5.769 18.558)" stroke="#0F0F30" stroke-width="1.103"></circle>
<path d="M10.554 7.929L8.59 5.1" stroke="#0F0F30"></path></svg> <span  class="ecs_event_type_'.esc_attr($event_virtual_type).'" style="display:inline;font-size:15px">'.__('Hybrid Event','decm-divi-event-calendar-module').' </span></div>':"";

 // $e["tooltip_category"]=$show_tooltip_category=="on"?$enable_category_link=="on"?tribe_get_event_categories( $event->ID, array('echo' => '','before' => '','sep'=> ', ','after'=> '','label'=> '','label_before' => '','label_after' => '','wrap_before' => '<div class ="event_category_style">','wrap_after' => '</div>',) ):'<div class ="event_category_style">'.$category->name.' </div>':"";
  $cats_comma_hide = $hide_comma_cat == 'off' ? implode(", ", $category_names): implode(" ", $category_names);
  $e["tooltip_category"]= $show_tooltip_category=="on" && $category_names!=null?'<div class ="event_category_style '.$showicon_category.'">'.$showlabel_category.$cats_comma_hide.'</div>':"";
//   $e['joshi']= implode(", ", $category_names)

  $tags_comma_hide = $hide_comma_tag == 'off' ? implode(", ", $tag_names): implode(" ", $tag_names);
  $e["show_tag"] = $show_tag=="on" && $tag_names!=null?'<div class ="event_category_style '.$showicon_tag.'">'.$showlabel_tag.$tags_comma_hide.'</div>':"";
  $e['view_more_button']='<p class="ecs-showdetail et_pb_button_wrapper "><a class="'.$button_classes." ".$module_class.' " href="' .esc_url($e['custom_event_link_url']). '" rel="bookmark" target="'.$custom_event_link_target.'" data-icon="'.$custom_icon.'" data-icon-tablet="'.$custom_icon_tablet.'" data-icon-phone="'.$custom_icon_phone.'">' .$view_more_text.'</a></p>';
  $e['custom_website_link_text']=$custom_website_link_text==""?__("View Events Website",'decm-divi-event-calendar-module'):$custom_website_link_text;
//   $e["title"]='<a class="'.$disable_event_calendar_title_link.'" href="'.$e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.$event->post_title .'</a>';
//   $e["tooltip_title"]=$show_title=="on"?'<div class="event_title_style '.$disable_event_title_link.'"><h3 class="title_text"> <a calss="'.$disable_event_title_link.'" href="' . $e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.$event->post_title.'</a></h3></div>':"";

$limit_event = $limit_event_title_length == 'on'  ? wp_html_excerpt($event->post_title, $event_title_length, ' ...' ) : $event->post_title;
 
$e["title"]='<a class="'.$disable_event_calendar_title_link.'" href="'.$e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.apply_filters('tribe_get_event_cm_title',$limit_event,$event).'</a>';
$e["show_time_zone_on_calendar"] = $show_time_zone_on_calendar=="on" ? $show_time_zone_abb_on_calender == "off" ? " ".Tribe__Events__Timezones::get_event_timezone_string($event->ID ):" ".Tribe__Events__Timezones::get_event_timezone_abbr( $event->ID ):" ";
  
//   $e["show_rsvp"] = ( tribe_events_has_tickets($event->ID))  ? '<a style="text-decoration: underline; color: #2EA3F2; font-size: 14px;" href="'. tribe_get_event_link($event->ID).'#rsvp-now">RSVP</a>' : ""; 
// if ( is_plugin_active( 'event-tickets/event-tickets.php' ) ) {
// 	$e["show_rsvp"] = ($show_rsvp =="on" && tribe_events_has_tickets($event->ID))  ? '<a style="text-decoration: underline; color: #2EA3F2; font-size: 14px;" href="'. tribe_get_event_link($event->ID).'#rsvp-now">RSVP</a>' : "";
// }else{
// 	$e["show_rsvp"] = "";
// }	
 
  $e["show_event_venue"]=$show_event_venue=="on"? tribe_get_venue($event->ID) : " ";
 
  $e["tooltip_title"]=$show_title=="on"?'<div class="event_title_style '.$disable_event_title_link.'"><h3 class="title_text"> <a calss="'.$disable_event_title_link.'" href="' .esc_url($e['custom_event_link_url']).'" target="'.$custom_event_link_target.'">'.apply_filters('tribe_get_event_cm_title',$event->post_title,$event).'</a></h3></div>':"";
  $e["start"] =tribe_get_start_time( $event->ID,"H:i")!=""? tribe_get_start_date($event->ID,false,'Y-m-d')."T".tribe_get_start_time( $event->ID,"H:i"):tribe_get_start_date($event->ID,false,'Y-m-d');
  $e["end"] = tribe_get_end_time( $event->ID,"H:i")!=""?tribe_get_end_date( $event->ID,false,'Y-m-d')."T".tribe_get_end_time( $event->ID,"H:i"): gmdate('Y-m-d', strtotime( tribe_get_end_date($event->ID,false,'Y-m-d') . " +1 days"));
  $e['dateTimeSeparator']=tribe_get_option( 'dateTimeSeparator', ' @ ' );
  $e['timeRangeSeparator']=(tribe_get_start_date($event->ID,null,get_option( 'date_format' ))!= tribe_get_end_date($event->ID,null,get_option( 'date_format' )))&&$show_date!="off" ?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";
  $e['timeRangeSeparatorEnd']=$show_end_time==="on" &&(tribe_get_start_time( $event->ID,"H:i")!=tribe_get_end_time( $event->ID,"H:i"))?tribe_get_option( 'timeRangeSeparator', '-' ):"";
  $e['allDayEvent']=__('All Day Event','decm-divi-event-calendar-module');
  $e['calallday']=__('all-day','decm-divi-event-calendar-module');

  if(tribe_get_event_meta($event->ID,'_tribe_events_status', true) == 'postponed'){
	$e['event_stutus_tag']=tribe_get_event_meta($event->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.esc_attr(tribe_get_event_meta($event->ID,'_tribe_events_status', true)).'" style="display:inline">'.__('postponed','decm-divi-event-calendar-module').' </span>':"";
  }

  elseif(tribe_get_event_meta($event->ID,'_tribe_events_status', true) == 'canceled'){
	  $e['event_stutus_tag']=tribe_get_event_meta($event->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.esc_attr(tribe_get_event_meta($event->ID,'_tribe_events_status', true)).'" style="display:inline">'.__('canceled','decm-divi-event-calendar-module').' </span>':"";
  }
  else{
	$e['event_stutus_tag']="";
  }
 // $e['event_stutus_tag']=tribe_get_event_meta($event->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event->ID,'_tribe_events_status', true).'" style="display:inline">'.tribe_get_event_meta($event->ID,'_tribe_events_status', true).' </span>':"";
  $e['link_venue'] = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_venue_link($event->ID) ?? '', $result_venue);
  $e['result_venue'] =  isset($result_venue['href'][0]) ? sanitize_text_field( wp_unslash($result_venue['href'][0]) ) : sanitize_text_field( wp_unslash("") );
  $e["venue"]=$venue=="on" && tribe_get_venue($event->ID)!=null ?$enable_venue_link=="on"?'<div class="event_venue_style '.$showicon_venue.'">'.$showlabel_venue.'<span> <a href="'.$e['result_venue'].'" target="'.$custom_venue_link_target.'">'.tribe_get_venue($event->ID).'</a> </span></div>':'<div class="event_venue_style '.$showicon_venue.'">'.$showlabel_venue.'<span> '.tribe_get_venue($event->ID).' </span></div>':"";
  $e["street"]=$street=="on"&& $location=="on" && tribe_get_address($event->ID)!=null?tribe_get_address($event->ID).$dec_street_comma:"";
  $e["locality"]=$locality=="on"&& $location=="on" && tribe_get_city($event->ID)!=null?" ".tribe_get_city($event->ID).$dec_locality_comma:""; 
  $e["state"]=$state=="on"&& $location=="on" && tribe_get_province($event->ID)!=null?tribe_get_province($event->ID).$dec_state_comma:(($state=="on" && $location == "on" &&tribe_get_region($event->ID)!=null)?tribe_get_region($event->ID).$dec_state_comma:"");
 
  //$e["state"]=$atts['show_tooltip_state']=="on" && $atts['show_tooltip_location']=="on" &&tribe_get_province($event_post->ID)!=null?tribe_get_province($event_post->ID).$dec_state_comma:(($atts['show_tooltip_state']=="on" && $atts['show_tooltip_location'] == "on" &&tribe_get_region($event_post)!=null)?tribe_get_region($event_post).$dec_state_comma:""); 
  
  $e["postal"]=$show_postal_code_before_locality=='off'&&$postal=="on"&& $location=="on" && tribe_get_zip($event->ID)!=null?tribe_get_zip($event->ID).$dec_postal_code_comma:""; 
  $e["postal_before"]=$show_postal_code_before_locality=='on'&&$postal=="on"&& $location=="on" && tribe_get_zip($event->ID)!=null?tribe_get_zip($event->ID).$dec_postal_code_comma:""; 
  $e["country"]=$country=="on" && $location=="on" && tribe_get_country($event->ID)!=null?tribe_get_country($event->ID).$dec_country_comma:""; 
  $e['showicon_location']= ($show_icon_label==="label_icon" || $show_icon_label==="icon")&&tribe_get_address($event->ID)!=null && $location=="on"?"event-location-decm-icon":"";
  $e['showlabel_location'] = ($show_icon_label==="label_icon" || $show_icon_label ==="label") &&tribe_get_address($event->ID)!=null && $location=="on"?'<span class=decm-detail-label>'.$location_custom_label.$show_colon." </span>":"";
  $e["organizer"]=$organizer=="on" && tribe_get_organizer_link($event->ID)!=null?'<div class="event_organizer_style '.$showicon_organizer.'">'.$showlabel_organizer.'<span>'. $orgNames.'</span></div>':""; 
 //$e['gg'] = tribe_get_organizer_link($event->ID);
  $e["event_start_date"] = tribe_get_start_date( $event->ID,null,get_option('date_format'));
  $e["event_end_date"]=tribe_get_start_date($event->ID,null,get_option( 'date_format' ))!= tribe_get_end_date($event->ID,null,get_option( 'date_format' ))?"-".tribe_get_end_date( $event->ID,null,get_option('date_format')):"" ;
//   $e["post_event_excerpt"] =$show_excerpt=="on"?'<div class="event_excerpt_style"><span>'.$event->post_excerpt.'</span></div>':"";
$e["post_event_excerpt"] = ($show_excerpt == "on" && !empty($event->post_excerpt)) ? '<div class="event_excerpt_style"><span>' . $event->post_excerpt . '</span></div>' : "";
 
$e["event_start_time"]=tribe_get_start_time( $event->ID,$event_time_format);
  $e["event_end_time"]=tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' ))?esc_html(tribe_get_end_time( $event->ID,$event_time_format)):"" ;
  $e['featured_class'] = ( get_post_meta( $event->ID , '_tribe_featured', true ) ? ' decm-featured-event ' : '' );
  $e['tooltip_website_url']=$show_tooltip_weburl=="on" && tribe_get_event_website_link($event->ID)!=null?($website_link=='custom_text' || $website_link=='default_text') ?'<a href="'.esc_url($result).'" target="'.esc_attr($custom_website_link_target).'">'.esc_attr($e['custom_website_link_text']).'</a>':'<a href="'.esc_url($result).'" target="'.esc_attr($custom_website_link_target).'">'.esc_url(tribe_get_event_website_url($event->ID)).'</a>':"";
  //$atts['website_link']=='custom_text'?'<a href="'.tribe_get_event_meta($event->ID, '_EventURL', true ).'" target="'.$custom_website_link_target.'">'.$custom_website_link_text.'</a>':tribe_get_event_website_link($event_post); 
  $e['showicon_weburl']= ($show_icon_label==="label_icon" || $show_icon_label==="icon") && $e['tooltip_website_url']!=""?"weburl-decm-icon":"";
  $e['showlabel_weburl'] = ($show_icon_label==="label_icon" || $show_icon_label ==="label") && $e['tooltip_website_url']!=""?'<span class=decm-detail-label>'.$website_custom_label.$show_colon." </span>":"";
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' )))
  { 
  $e["start_date"]=$show_date=="on"?$dateformat == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$dateformat):"";
  
  $e["end_date"]= $show_date=="on"?$dateformat == ""? tribe_get_end_date( $event->ID,null,get_option('date_format')):tribe_get_end_date( $event->ID,null,$dateformat):"";
  $e["start_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on"?$timeformat == ""?" ".esc_html(tribe_get_start_time( $event->ID,get_option('time_format'))) :" ".esc_html(tribe_get_start_time($event->ID,$timeformat)):""):"";
  $e["end_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on"&& $show_end_time=="on"?$timeformat == ""?" ".esc_html(tribe_get_end_time( $event->ID,get_option('time_format'))):" ".esc_html(tribe_get_end_time($event->ID,$timeformat)):""):__('All Day Event','decm-divi-event-calendar-module') ;
  $e["time_zone"]=!empty($timezone == 'off')|| tribe_event_is_all_day($event->ID)?"":(($timezone_abb == 'off')?Tribe__Events__Timezones::get_event_timezone_string($event->ID ):Tribe__Events__Timezones::get_event_timezone_abbr($event->ID )); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
 
}
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))== tribe_get_end_time($event->ID,get_option( 'time_format' )))
  {
	$e["start_date"]=$show_date=="on"?$dateformat == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$dateformat):"";
	$e["end_date"]= "";
	$e["start_time"]= "";
	$e["end_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on" && $show_end_time=="on"?$timeformat == ""?" ".esc_html(tribe_get_end_time( $event->ID,get_option('time_format'))):" ".esc_html(tribe_get_end_time($event->ID,$timeformat)):""):__('All Day Event','decm-divi-event-calendar-module');
	$e["time_zone"]=!empty($timezone == 'off')|| tribe_event_is_all_day($event->ID)?"":(($timezone_abb == 'off')?Tribe__Events__Timezones::get_event_timezone_string($event->ID ):Tribe__Events__Timezones::get_event_timezone_abbr($event->ID )); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
  }
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' )))
{
	$e["start_date"]=$show_date=="on"?$dateformat == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$dateformat):"";
	$e["end_date"]= "";
	$e["start_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on"? $timeformat == ""?" ".esc_html(tribe_get_start_time( $event->ID,get_option('time_format'))) :" ".esc_html(tribe_get_start_time($event->ID,$timeformat)):""):"";
	$e["end_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on" && $show_end_time=="on"?$timeformat == ""? esc_html(tribe_get_end_time( $event->ID,get_option('time_format'))):esc_html(tribe_get_end_time($event->ID,$timeformat)):""):__('All Day Event','decm-divi-event-calendar-module') ;
	$e["time_zone"]=!empty($timezone == 'off')|| tribe_event_is_all_day($event->ID)?"":Tribe__Events__Timezones::get_event_timezone_string($event->ID ); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
	}
	if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))== tribe_get_end_time($event->ID,get_option( 'time_format' )))
	{
		$e["start_date"]=$show_date=="on"?$dateformat == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$dateformat):"";
		$e["end_date"]= $show_date=="on"?$dateformat == ""? tribe_get_end_date( $event->ID,null,get_option('date_format')):tribe_get_end_date( $event->ID,null,$dateformat):"";
		$e["start_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on"? $timeformat == ""?" ".esc_html(tribe_get_start_time( $event->ID,get_option('time_format'))) :" ".esc_html(tribe_get_start_time($event->ID,$timeformat)):""):"";
		$e["end_time"]=!tribe_event_is_all_day($event->ID)?($show_time=="on" && $show_end_time=="on"?$timeformat == ""?" ".esc_html(tribe_get_end_time( $event->ID,get_option('time_format'))):" ".esc_html(tribe_get_end_time($event->ID,$timeformat)):""):__('All Day Event','decm-divi-event-calendar-module') ;
		$e["time_zone"]=!empty($timezone == 'off')|| tribe_event_is_all_day($event->ID)?"":(($timezone_abb == 'off')?Tribe__Events__Timezones::get_event_timezone_string($event->ID ):Tribe__Events__Timezones::get_event_timezone_abbr($event->ID )); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
		}
		$e['showicon_date']= ($show_icon_label==="label_icon" || $show_icon_label==="icon")&&$e["start_date"]!=""?" eventDate-decm-icon ":"";
		$e['showlabel_date'] = ($show_icon_label==="label_icon" || $show_icon_label ==="label")&&$e["start_date"]!="" ?'<span class=decm-detail-label>'.$date_custom_label.$show_colon." </span>":"";
		$e['showicon_time']= ($show_icon_label==="label_icon" || $show_icon_label==="icon")&&(tribe_get_start_time($event->ID)!=""||tribe_event_is_all_day($event->ID)) ?"eventTime-decm-icon":"";
		$e['showlabel_time'] = ($show_icon_label==="label_icon" || $show_icon_label ==="label")&&(tribe_get_start_time($event->ID)!=""||tribe_event_is_all_day($event->ID)) ?'<span class=decm-detail-label>'.$time_custom_label.$show_colon." </span>":"";
		
		$ticket__label = '';
		$event__price = '';
		$e["show_ticket"]= '';
		if (is_plugin_active('event-tickets/event-tickets.php')) {

			$get_event_link = tribe_get_event_link($event->ID);
			$event_link = $get_event_link . '#tribe-tickets__tickets-form';

			if (tribe_get_cost($event->ID, true) != null) {
				
				$Tickets_data = Tribe__Tickets__Tickets::get_ticket_counts($event->ID);
			
				if($Tickets_data['tickets']['available'] > 0){
					$available_tickets = $Tickets_data['tickets']['available'];
					$isPrice__free = tribe_get_cost($event->ID, true);
					$raw__price = explode('–', $isPrice__free);
					$priceArray = array_map('trim', $raw__price);
					$is__price_exists = array_key_exists(1, $priceArray);

					// print_r($is__price_exists);

					$is__price__onFirstIndex = array_key_exists(0, $priceArray);
				
					if ($is__price_exists) {
						$event__price = $priceArray[1];					
					}elseif($is__price__onFirstIndex){
						$event__price = $priceArray[0];
					}else {
						$event__price = "Free";					
					}
					
					if ($Tickets_data['tickets']['count'] > 0) {


						if ($available_tickets == 0) {
							$ticket__label =  __('- Sold Out', 'decm-divi-event-calendar-module');                            
						}else{
							if($available_tickets == -1) {
								$Place_left =  __('Unlimited', 'decm-divi-event-calendar-module');                                
							}elseif($available_tickets > 1 ){
								$Place_left  =	esc_html($available_tickets).' '.__('Places Left', 'decm-divi-event-calendar-module');
							 }else{
								 $Place_left  =	esc_html($available_tickets).' '.__('Place Left', 'decm-divi-event-calendar-module');
							 }
							
							 $Purchase_Now = $show_ticket_feed_respond == 'on' ? ' '.'<a href="' . esc_url($event_link) . '" class="price_link_ticket price_link_custom__a" >'.__('Purchase Now', 'decm-divi-event-calendar-module').'</a> '  : '';
							 $spaceRespond = $show_ticket_feed_respond == 'on' && $show_ticket_feed_left == 'on' ? ' - ' : ' ';	
							 $show_ticket_feed_lefts = $show_ticket_feed_left == 'on'  ? esc_html($Place_left) :'';
							 $ticket__label = $Purchase_Now.esc_html($spaceRespond) . ' ' . esc_html($show_ticket_feed_lefts);
						}
					}
	
						// $event_output .= apply_filters('decm_event_price_tag_start', '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">', $atts, $event_post) .
						// 	apply_filters('decm_event_price', $showlabel . $stacklabel . " " . '<span class="decm_price">' . $event__price, $atts, $event_post, $excerptLength) .
						// 	' <span class="ticket-label ">'.$ticket__label.'</span>' .
						// 	apply_filters('decm_event_price_tag_end', '</span></span>', $atts, $event_post);
					
						$e["show_ticket"] = $show_tooltip_ticket=="on" ? 
						// '<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>' .tribe_get_cost($event->ID,null,false). ' - ' .$ticket__label. '</span></div>' : 
						'<div class="event_price_style '.$showicon_ticket.'">'.$showlabel_ticket.'<span>'. esc_html($event__price) . $ticket__label .'</span></div>':"";
				}	
			}else{
				$e["show_ticket"]= '';
			}
		}


	//	$e["currency"]=  $atts['show_tooltip_price']=="off" && tribe_get_cost($event->ID,null,false)!=null ?tribe_get_cost($event->ID,null,false)=="Free"?'<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,null,false).'</span></div>':'<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,true).'</span></div>':"Null";

  $available_rsvp = 0;
  $unlimited_rsvp = false;
  $rsvp__label = '';
  $respond_now_label ='';
  $e["show_rsvp"] = '';

  if (is_plugin_active('event-tickets/event-tickets.php')) {
	// $event_link = tribe_get_event_link($event->ID);

	$get_event_link = tribe_get_event_link($event->ID);
	$event_link = $get_event_link . '#rsvp-now';

	$rsvp_data = Tribe__Tickets__Tickets::get_ticket_counts($event->ID);

	if (isset($rsvp_data['rsvp'])) {
		$available_rsvp = isset($rsvp_data['rsvp']['stock']) ? $rsvp_data['rsvp']['stock'] : 0;
		$unlimited_rsvp = isset($rsvp_data['rsvp']['unlimited']) ? $rsvp_data['rsvp']['unlimited'] : false;
	}
	if (isset($rsvp_data['rsvp']['count']) && $rsvp_data['rsvp']['count'] > 0) {
		
		if ($available_rsvp == 0) {
			$rsvp__label =  __('Currently Full', 'decm-divi-event-calendar-module');                            
		} elseif ($available_rsvp == -1 && $unlimited_rsvp) {
			$rsvp__label =  __('Unlimited', 'decm-divi-event-calendar-module');                                
		} else {

			if($available_rsvp > 1 ){
			   $Place_left  =	esc_html($available_rsvp) . ' ' .__('Places Left', 'decm-divi-event-calendar-module');
			}else{
				$Place_left  =	esc_html($available_rsvp) . ' ' .__('Place Left', 'decm-divi-event-calendar-module');
			}
				
			$spaceRespond = $show_rsvp_feed_respond == 'on' && $show_rsvp_feed_left == 'on' ? ' - ' : ' ';
			$Purchase_Now = $show_rsvp_feed_respond == 'on' ? '<a class="show_rsvp_feed_custom"  href="' . esc_url($event_link). '" >' . __('Respond Now', 'decm-divi-event-calendar-module') . '</a>' : '';
			$show_rsvp_feed_lefts = $show_rsvp_feed_left == 'on'  ? esc_html($Place_left) :'';
			$rsvp__label =  $Purchase_Now.esc_html($spaceRespond).esc_html($show_rsvp_feed_lefts);
		}
		
		$e["show_rsvp"]= $show_rsvp == "on"   ?
		'<div class="event_price_style event_rsvp_style '.$showicon_rsvp.'">'.$showlabel_rsvp.'<span>' . $rsvp__label . '</span></div>': "";

	}
	
	}else{
		$e["show_rsvp"] = '';
	}
		
  $e["currency"]=$show_price=="on" && tribe_get_cost($event->ID,null,false)!=null ?tribe_get_cost($event->ID,null,false)=="Free"?'<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,null,false).'</span></div>':'<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,true).'</span></div>':"";
		// $e["rsvp"]=$show_RSVP=="on" && tribe_get_cost($event->ID,null,false)!=null ?tribe_get_cost($event->ID,null,false)=="Free"?'<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,null,false).'</span></div>':'<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,true).'</span></div>':"";
  $e['feature_image']=$show_image=="on"?'<div class="feature_img '.$decm_image_class_tablet." ".$decm_image_class_phone.'"><a class="'.$disable_event_image_link.'"  href="' . $e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.get_the_post_thumbnail( $event->ID).'</a></div>':"";
  $e['feature_image_calendar']='<div class="ecs_calendar_thumbnail"><a class="'.$disable_event_image_link.'"  href="' . $e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.get_the_post_thumbnail( $event->ID,array(125,250,'class' => ' ecs_calendar_thumbnail_inner')).'</a></div>';
  $e["html"] = '<div class="tooltip_main">'.$e['feature_image'].'<div class="event_detail_style">'.$e['event_stutus_tag'].$e['event_virtual'].$e['event_hybrid'].$e['tooltip_title'].$e['show_calendar_series_name'].'<div class="tooltip_event_time"><div class="ecs_tooltip_date'.$e['showicon_date'].' ">'.$e['showlabel_date'].'<span>'.esc_html($e["start_date"]).esc_html($e['timeRangeSeparator']).' '.esc_html($e["end_date"]).' </span></div><div class="ecs_tooltip_time '.$e['showicon_time'].'">'.$e['showlabel_time'].'<span>' .esc_html($e["start_time"]).esc_html($e['timeRangeSeparatorEnd']).' '.esc_html($e["end_time"]).' '.esc_attr($e['time_zone']).'</span></div></div>'.$e["venue"].'<div class="event_address_style '.$e['showicon_location'].'">'.$e['showlabel_location'].'<span>'.$e["street"].$e["postal_before"].$e["locality"].$e["state"].$e["postal"].$e["country"].'</span></div>'.$e["organizer"].$e['currency'].'<div class="event_price_style"><span>'.$e["show_ticket"].'</span></div>'.'<div class="rsvp"><span>'.$e["show_rsvp"].'</span></div>'.trim($e["tooltip_category"],":").trim($e["show_tag"],":").'<div class="event_website_url_style '.$e['showicon_weburl'].'">'.$e['showlabel_weburl'].$e['tooltip_website_url'].'</div>'.$e["post_event_excerpt"].'</div>'; 
 // $eve_price = isset($e['price']) ? $e['price'] : '';
 // $post_event_permalink = isset($e["post_event_permalink"]) ? $e["post_event_permalink"] : '';


//   $e["html"] = '
// <div class="tooltip_main">
//     <div class="feature_img">'.$e["feature_image"].'</div>
//     <div class="event_detail_style">
//         <div class="event_title_style">
//             <h3 class="title_text">
//                 <a href="'.$post_event_permalink.'">'.$e['event_stutus_tag'].$e['event_virtual'].$e['event_hybrid'].$e["tooltip_title"].'</a>
//             </h3>
//         </div>
//         '.$e['show_calendar_series_name'].'
//         <div class="tooltip_event_time">
//             <div class="ecs_tooltip_date'.$e['showicon_date'].' ">'.$e['showlabel_date'].'<span>'.$e["start_date"].$e['timeRangeSeparator'].' '.$e["end_date"].' </span></div>
//             <div class="ecs_tooltip_time '.$e['showicon_time'].'">'.$e['showlabel_time'].'<span>' .$e["start_time"].$e['timeRangeSeparatorEnd'].' '.$e["end_time"].' '.esc_attr($e['time_zone']).'</span></div>
//         </div>
//         '.$e["venue"].'
//         <div class="event_address_style '.$e['showicon_location'].'">'.$e['showlabel_location'].'<span>'.$e["street"].$e["postal_before"].$e["locality"].$e["state"].$e["postal"].$e["country"].'</span></div>
//         '.$e["organizer"].'
//         <div class="event_price_style"><span>'.$e["currency"].$eve_price.'</span></div>'.trim($e["tooltip_category"],":").trim($e["show_tag"],":").'<div class="event_website_url_style '.$e['showicon_weburl'].'">'.$e['showlabel_weburl'].$e['tooltip_website_url'].'</div>'.$e["post_event_excerpt"];
        
// 		if (!empty($e["show_rsvp"])) {
// 			$html .= '<div class="rsvp" style="padding-top: 10px;"><span>' . $e["show_rsvp"] . '</span></div>';
// 		}
// 		$html .= '</div>'; 
// 		$html .= '</div>';
  array_push($event_data, $e);
	// }
	// else{}
}

echo json_encode($event_data); //phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode
     exit;
}


endif;

add_action('wp_ajax_load_event_posts', 'load_event_posts');
add_action('wp_ajax_nopriv_load_event_posts', 'load_event_posts');
function load_event_posts() {	
require_once 'includes/modules/EventDisplay/EventAjax.php';

$show_atts=isset($_REQUEST['atts']) ? sanitize_text_field( wp_unslash( $_REQUEST['atts']) ) : sanitize_text_field( wp_unslash( $_REQUEST['atts'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_categId=isset($_REQUEST['categId']) ? sanitize_text_field( wp_unslash( $_REQUEST['categId']) ) : "";     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$att= stripslashes($show_atts);
$atts=json_decode($att);
$show_atts=isset($_REQUEST['atts']) ? sanitize_text_field( wp_unslash( $_REQUEST['atts']) ) : sanitize_text_field( wp_unslash( $_REQUEST['atts'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$categId=$show_categId;
$venue_page_id = isset($_REQUEST['venue_page_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['venue_page_id']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_id_realted = isset($_REQUEST['event_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_id']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
//$event_id = get_the_ID();
    $term_id_tag = isset($_REQUEST['term_id_tag']) ? sanitize_text_field( wp_unslash( $_REQUEST['term_id_tag']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$organizer_page_id = isset($_REQUEST['organizer_page_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['organizer_page_id']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$show_categslug=isset($_REQUEST['categslug']) ? sanitize_text_field( wp_unslash( $_REQUEST['categslug']) ) : "";     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$categslug=$show_categslug;
$term_id = isset($_REQUEST['term_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['term_id']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , 	WordPress.Security.NonceVerification.Recommended
$eventfeed_current_page=isset($_REQUEST['eventfeed_current_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_page']) ) : sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_page'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$current_page= !isset($eventfeed_current_page) ? 1 : $eventfeed_current_page;

$eventfeed_current_pagination_page=isset($_REQUEST['eventfeed_current_pagination_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page']) ) : sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$eventfeed_current_pagination_page=!isset($eventfeed_current_pagination_page) ? 1 : $eventfeed_current_pagination_page;

$filter_category = isset($_REQUEST['filter_event_category']) ? sanitize_text_field( wp_unslash( $_REQUEST['filter_event_category']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification  , WordPress.Security.NonceVerification.Recommended
$filter_organizer = isset($_REQUEST['event_filter_organizer']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_organizer']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$filter_tag=isset($_REQUEST['event_filter_tag']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_tag']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$filter_venue=isset($_REQUEST['event_filter_venue']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_venue']) ) : "";   //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$filter_search = isset($_REQUEST['event_filter_search']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_search']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$filter_time = isset($_REQUEST['event_filter_time']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_time']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$filter_day = isset($_REQUEST['event_filter_day']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_day']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$filter_month = isset($_REQUEST['event_filter_month']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_month']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$filter_year = isset($_REQUEST['event_filter_year']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_year']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$maxCost = isset($_REQUEST['event_maxCost']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_maxCost']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$minCost = isset($_REQUEST['event_minCost']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_minCost']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_startDate = isset($_REQUEST['event_startDate']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_startDate']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_endDate = isset($_REQUEST['event_endDate']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_endDate']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_filter_city = isset($_REQUEST['event_filter_city']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_city']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_filter_country = isset($_REQUEST['event_filter_country']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_country']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_filter_state = isset($_REQUEST['event_filter_state']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_state']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_filter_address = isset($_REQUEST['event_filter_address']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_address']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_filter_future_past = isset($_REQUEST['event_filter_future_past']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_future_past']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_filter_order = isset($_REQUEST['event_filter_order']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_order']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$event_filter_status = isset($_REQUEST['event_filter_status']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_status']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$module_class_check = "events-display-module"; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
$event_filter_recurring = isset($_REQUEST['event_filter_recurring']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_recurring']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
$search_search_criteria = isset($_REQUEST['search_search_criteria']) ? sanitize_text_field( wp_unslash( $_REQUEST['search_search_criteria']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
echo et_core_esc_previously(eventfeed_ajax_fetch_events($atts, //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ,WordPress.Security.EscapeOutput.OutputNotEscaped ,WordPress.Security.EscapeOutput.OutputNotEscaped ,WordPress.Security.EscapeOutput.OutputNotEscaped ,WordPress.Security.EscapeOutput.OutputNotEscaped
$eventfeed_current_pagination_page, 
$current_page,
$categId,
$categslug,
$venue_page_id,
    $event_id_realted,
$organizer_page_id,
$term_id_tag,
$term_id,
$filter_category, 
$filter_organizer, 
$filter_tag,
$filter_venue,
$filter_search,
$filter_time,
$filter_day,
$filter_month,
$filter_year,
$maxCost,
$minCost,
$event_startDate,
$event_endDate,
$event_filter_country, 
$event_filter_city,
$event_filter_state,
$event_filter_address,
$event_filter_order,
$event_filter_status,
$module_class_check,
$event_filter_recurring,
$search_search_criteria,
$event_filter_future_past
));
//echo et_core_esc_previously(decm_events_calender_gets( $atts,$event_filter, $render_slug, $conditional_tags = array(), $current_page = array() ));

die();
  }

add_action('wp_ajax_filters_event_posts', 'filters_event_posts');
add_action('wp_ajax_nopriv_filters_event_posts', 'filters_event_posts');
function filters_event_posts() {	
require_once 'includes/modules/EventDisplay/EventAjax.php';
$show_atts=isset($_REQUEST['atts']) ? sanitize_text_field( wp_unslash( $_REQUEST['atts']) ) : sanitize_text_field( wp_unslash( $_REQUEST['atts'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
//$show_categId=isset($_REQUEST['categId']) ? sanitize_text_field( wp_unslash( $_REQUEST['categId']) ) : sanitize_text_field( wp_unslash( $_REQUEST['categId'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended
$att= stripslashes($show_atts);
$atts=json_decode($att);
$show_atts=isset($_REQUEST['atts']) ? sanitize_text_field( wp_unslash( $_REQUEST['atts']) ) : sanitize_text_field( wp_unslash( $_REQUEST['atts'] ) );     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification,WordPress.Security.NonceVerification.Recommended

$categId = isset($_REQUEST['categId']) ? sanitize_text_field( wp_unslash( $_REQUEST['categId']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$venue_page_id = isset($_REQUEST['venue_page_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['venue_page_id']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
    $event_id_realted = isset($_REQUEST['event_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_id']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
//    $event_id = get_the_ID();

$term_id_tag = isset($_REQUEST['term_id_tag']) ? sanitize_text_field( wp_unslash( $_REQUEST['term_id_tag']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$organizer_page_id = isset($_REQUEST['organizer_page_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['organizer_page_id']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$categslug = isset($_REQUEST['categslug']) ? sanitize_text_field( wp_unslash( $_REQUEST['categslug']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$term_id = isset($_REQUEST['term_id']) ? sanitize_text_field( wp_unslash( $_REQUEST['term_id']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended

$current_page = isset($_REQUEST['eventfeed_current_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_page']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended

$eventfeed_current_pagination_page = isset($_REQUEST['eventfeed_current_pagination_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended

$eventfeed_current_pagination_page = isset($_REQUEST['eventfeed_current_pagination_page']) ? sanitize_text_field( wp_unslash( $_REQUEST['eventfeed_current_pagination_page']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_category = isset($_REQUEST['filter_event_category']) ? sanitize_text_field( wp_unslash( $_REQUEST['filter_event_category']) ) : "";     //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_organizer = isset($_REQUEST['event_filter_organizer']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_organizer']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_tag=isset($_REQUEST['event_filter_tag']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_tag']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_venue=isset($_REQUEST['event_filter_venue']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_venue']) ) : "";   //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_search = isset($_REQUEST['event_filter_search']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_search']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_time = isset($_REQUEST['event_filter_time']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_time']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_day = isset($_REQUEST['event_filter_day']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_day']) ) : "";    //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_month = isset($_REQUEST['event_filter_month']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_month']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$filter_year = isset($_REQUEST['event_filter_year']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_year']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$maxCost = isset($_REQUEST['event_maxCost']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_maxCost']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$minCost = isset($_REQUEST['event_minCost']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_minCost']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_startDate = isset($_REQUEST['event_startDate']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_startDate']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_endDate = isset($_REQUEST['event_endDate']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_endDate']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_filter_city = isset($_REQUEST['event_filter_city']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_city']) ) : "";  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_filter_country = isset($_REQUEST['event_filter_country']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_country']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_filter_state = isset($_REQUEST['event_filter_state']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_state']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_filter_address = isset($_REQUEST['event_filter_address']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_address']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_filter_future_past = isset($_REQUEST['event_filter_future_past']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_future_past']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_filter_order = isset($_REQUEST['event_filter_order']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_order']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$event_filter_status = isset($_REQUEST['event_filter_status']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_status']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$module_class_check = "filters-event-module";  //phpcs:ignore WordPress.Security.NonceVerification.Recommended
$event_filter_recurring = isset($_REQUEST['event_filter_recurring']) ? sanitize_text_field( wp_unslash( $_REQUEST['event_filter_recurring']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification, WordPress.Security.NonceVerification.Recommended
$search_search_criteria = isset($_REQUEST['search_search_criteria']) ? sanitize_text_field( wp_unslash( $_REQUEST['search_search_criteria']) ) : ""; //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
echo et_core_esc_previously(eventfeed_ajax_fetch_events( //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ,WordPress.Security.EscapeOutput.OutputNotEscaped ,WordPress.Security.EscapeOutput.OutputNotEscaped ,WordPress.Security.EscapeOutput.OutputNotEscaped
	$atts, 
$eventfeed_current_pagination_page, 
$current_page,
$categId,
$categslug,
$venue_page_id,
    $event_id_realted,
$organizer_page_id,
$term_id_tag,
$term_id,
$filter_category, 
$filter_organizer, 
$filter_tag,
$filter_venue,
$filter_search, 
$filter_time,
$filter_day,
$filter_month,
$filter_year,
$maxCost,
$minCost,
$event_startDate,
$event_endDate,
$event_filter_country, 
$event_filter_city,
$event_filter_state,
$event_filter_address,
$event_filter_order, 
$event_filter_status,
$module_class_check,
$event_filter_recurring,
$search_search_criteria,
$event_filter_future_past
));
//echo et_core_esc_previously(decm_events_calender_gets( $atts,$event_filter, $render_slug, $conditional_tags = array(), $current_page = array() ));

die();
  }

function more_info_button_custom_box() {
	$screens = ['tribe_events'];
	foreach ( $screens as $screen ) {
		add_meta_box(
			'more_info_button_id',                 // Unique ID
			'More Info Button Text',      // Box title
			'more_info_button_custom_box_html',  // Content callback, must be of type callable
			$screen                            // Post type
		);
	}
}
add_action( 'add_meta_boxes', 'more_info_button_custom_box' );

function more_info_button_custom_box_html( $post ) {
	$value = get_post_meta( $post->ID, '_more_info_button_meta_key', true );?>
	<!-- <label for="wporg_field" class="">More Info Button Text : </label> -->
	<input type="text" name="wporg_field" id="wporg_field" class="postbox" value='<?php echo esc_attr($value)  ?>'> <?php //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
}

function more_info_button_save_postdata( $post_id ) {
	if ( array_key_exists( 'wporg_field', $_POST ) ) { //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Missing
		update_post_meta($post_id, '_more_info_button_meta_key', sanitize_text_field($_POST['wporg_field'])); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,	WordPress.Security.NonceVerification.Missing
	}
}
add_action( 'save_post', 'more_info_button_save_postdata' );


/*
 * Translate the link in the event calendar
 * from divi-event-calendar-module/divi-event-calendar-module.php
 * the-events-calendar/src/functions/template-tags/link.php
 * */
function falang_tribe_get_event_link( $link, $post_id, $full_link, $url ) {
	if ( is_plugin_active( 'falang/falang.php' ) ) {
	if (isset($_REQUEST['locale'])){ //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
	  //locale on page don't have the right format
	  $locale = str_replace("-","_",sanitize_text_field($_REQUEST['locale'])); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification ,WordPress.Security.NonceVerification.Recommended
	  $language = Falang()->get_model()->get_language_by_locale($locale); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
	  $has_lang_in_link = strpos($link,'/'.$language->slug.'/');
	  if (isset($language) && !$has_lang_in_link){
		$post = get_post($post_id);
		$link = str_replace('event',$language->slug.'/event',$link);
	  }
	}
   }
	return $link;
  }
  
  add_filter('tribe_get_event_link','falang_tribe_get_event_link',10,4);
  
  /*
   * Translate the Title in the event calendar
   * from divi-event-calendar-module/divi-event-calendar-module.php 574
   * $e["title"]='<a class="'.$disable_event_calendar_title_link.'" href="'.$e['custom_event_link_url'].'" target="'.$custom_event_link_target.'">'.$event->post_title .'</a>';
   * use apply_filter
   * */
  function falang_tribe_get_event_cm_title( $title, $event ) {
	if ( is_plugin_active( 'falang/falang.php' ) ) {
	if (isset($_REQUEST['locale'])){  //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
	  //locale on page don't have the right format
	  $locale = str_replace("-","_", sanitize_text_field($_REQUEST['locale'])); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification , WordPress.Security.NonceVerification.Recommended
	  $language = Falang()->get_model()->get_language_by_locale($locale); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
	  if (isset($language) && $event){
		$falang_post = new \Falang\Core\Post();
		$title = $falang_post->translate_post_field($event, 'post_title', $language); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
	  }
	}
  }
	return $title;
  }
  
  add_filter('tribe_get_event_cm_title','falang_tribe_get_event_cm_title',10,2);

// LICENSE MANAGER CODE BEGINS HERE
 if(!defined('WOO_SLT_DEC_PATH_DEC'))
 define('WOO_SLT_DEC_PATH_DEC',   plugin_dir_path(__FILE__));
 if(!defined('WOO_SLT_DEC_URL_DEC'))
 define('WOO_SLT_DEC_URL_DEC',    plugins_url('', __FILE__));
 if(!defined('WOO_SLT_DEC_APP_API_URL_DEC'))
 define('WOO_SLT_DEC_APP_API_URL_DEC',      'https://www.peeayecreative.com/product/divi-events-calendar/');
 
 if(!defined('WOO_SLT_DEC_VERSION_DEC'))
 define('WOO_SLT_DEC_VERSION_DEC', '2.8.28');
 if(!defined('WOO_SLT_DEC_DB_VERSION_DEC'))
 define('WOO_SLT_DEC_DB_VERSION_DEC', '2.8.28'); 
 
 if(!defined('WOO_SLT_DEC_PRODUCT_ID_DEC'))
 define('WOO_SLT_DEC_PRODUCT_ID_DEC',           'PA-DEC');
 if(!defined('WOO_SLT_DEC_INSTANCE_DEC'))
 define('WOO_SLT_DEC_INSTANCE_DEC',             str_replace(array ("https://" , "http://"), "", network_site_url()));
 
 
 if(!class_exists('WOO_SLT_DEC'))
 include_once(WOO_SLT_DEC_PATH_DEC . '/license/class.wooslt.php');
 if(!class_exists('WOO_SLT_DEC_licence'))
 include_once(WOO_SLT_DEC_PATH_DEC . '/license/class.licence.php');
 if(!class_exists('WOO_SLT_DEC_options_interface'))
 include_once(WOO_SLT_DEC_PATH_DEC . '/license/class.options.php');
 if(!class_exists('WOO_SLT_DEC_CodeAutoUpdate'))
 include_once(WOO_SLT_DEC_PATH_DEC . '/license/class.updater.php');
 
 function WOO_SLT_DEC_DEC_activated() 
	 {
 
	 }
 
 function WOO_SLT_DEC_DEC_deactivated() 
	 {
 
	 }
 
 global $WOO_SLT_DEC;
 $WOO_SLT_DEC = new WOO_SLT_DEC()
 
 ?>