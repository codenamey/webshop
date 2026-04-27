<?php
// Avoid direct calls to this file
if ( !defined( 'ABSPATH' ) ) {
	header( 'Status: 403 Forbidden' );
	header( 'HTTP/1.1 403 Forbidden' );
	exit();
}


/**
 * set 'time' setting to false to hide time in event date
 *
 * @author bojana
 * @param array $setting
 *
 * @return array
 */
function tribe_events_event_schedule_details_formatting_hidetime($settings)
{
	 $settings['time'] = false;
	 return $settings;
	 
}

//echo get_locale();

function get_event_categories() {
	$event_posts = tribe_get_events();
	$event_posts = apply_filters( 'decm_events_posts_fetch', $event_posts, '' );
	/**
	 * Show Categories of every events
	 *
	 * @author bojana
	 */
	$categories = new stdClass();
	$categories->total_count = 0;
	$categories->object = array();
	if ( $posts or apply_filters( 'decm_events_posts', false, $atts ) ) {
		foreach( (array) $event_posts as $post_index => $event_post ) {
			setup_postdata( $event_post->ID );
			
			if ( apply_filters( 'decm_remove_events', false, $atts, $event_post ) )
				continue;
			
			$category_list = get_the_terms( $event_post, 'tribe_events_cat' );
			
			
			if ( is_array( $category_list ) ) {
				foreach ( (array) $category_list as $category ) {
					/**
					 * Show Categories of every events
					 *
					 * @author bojana
					 */
					$category->id = $category->term_id;
					$category->name = $category->name;
					$categories->object[] = $category;
				}
			}
		}
	}

	$categories->total_count = count($categories->object);
	
	return $categories;
}

global $gl_decm_dateFormatStr;

function setDateFormat($attr) {
	global $gl_decm_dateFormatStr;
	$gl_decm_dateFormatStr = $attr;
}
function getDateFormat($attr) {
	global $gl_decm_dateFormatStr;

	return $gl_decm_dateFormatStr;
}


class DECM_EventDisplay extends ET_Builder_Module {

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 */
	
	//public $slug       = 'decm_event_display';
	//public $child_slug = 'decm_event_display_child';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Feed', 'decm-divi-event-calendar-module' );
		$this->plural    = esc_html__( 'Events Feed', 'decm-divi-event-calendar-module' );
		// $this->name       = esc_html__( 'Accordion', 'decm-divi-event-calendar-module' );
		// $this->plural     = esc_html__( 'Accordions', 'decm-divi-event-calendar-module' );
		 $this->slug       = 'decm_event_display';

	}
	// public function getcalss(){
	// 	return self::_get_index(array(self::INDEX_MODULE_ORDER, "decm_event_display"))+1;
	// }

	public function get_settings_modal_toggles() {
	  return array(
		
			'gerneral' => array(
				'toggles' => array(
								
					'decm_content' => array(
						'priority' => 1,
						'title' => esc_html__( 'Content', 'decm-divi-event-calendar-module' ),
					),	
					'elements' => array(
						'priority' => 2,
						'title' => esc_html__( 'Elements', 'decm-divi-event-calendar-module' ),
					),
					'layout' => array(
						'priority' => 12,
						'title' => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					),	
					'callout_box' => array(
						'priority' => 15,
						'title' => esc_html__( 'Callout Box', 'decm-divi-event-calendar-module'),
					),			

					'details_toggle' => array(
						'priority' => 18,
						'title' => esc_html__( 'Details', 'decm-divi-event-calendar-module'),
					),
				
					'excerpt_toggle' => array(
						'priority' => 19,
						'title' => esc_html__( 'Excerpt', 'decm-divi-event-calendar-module'),
					),
				
					'more_info_button' => array(
						'priority' => 20,
						'title' => esc_html__( 'More Info Button', 'decm-divi-event-calendar-module'),
					),
					
					'pagination_options' => array(
						'priority' => 40,
						'title' => esc_html__( 'Pagination', 'decm-divi-event-calendar-module'),
					),
					
					'no_results_message' => array(
						'priority' => 45,
						'title' => esc_html__( 'No Results Message', 'decm-divi-event-calendar-module'),
					),
					'google_calendar_button' => array(
						'priority' => 49,
						'title' => esc_html__( 'Google Calendar Button', 'decm-divi-event-calendar-module'),
					),
					'ical_export_button' => array(
						'priority' => 65,
						'title' => esc_html__( 'ICAL Export Button', 'decm-divi-event-calendar-module'),
					),

					'decm_connection_id' => array(
						'priority' => 71,
						'title' => esc_html__( 'Connection', 'decm-divi-event-calendar-module'),
					),
					'admin_label' => array(
						'priority' => 99,
						'title' => esc_html__( 'Admin Label', 'decm-divi-event-calendar-module'),
					),
					
				),
			),
			'advanced' => array(
				'toggles' => array(
					//'layout'  => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					//'filters_search'  => esc_html__( 'Filters', 'decm-divi-event-calendar-module' ),
					//'filters_dropdown'  => esc_html__( 'Filters Dropdown', 'decm-divi-event-calendar-module' ),
					//'filters_active'  => esc_html__( 'Active Filters', 'decm-divi-event-calendar-module' ),
					'event'  => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
					'thumbnail'  => esc_html__( 'Image', 'decm-divi-event-calendar-module' ),
					'details'  => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					'callout'  => esc_html__( 'Callout', 'decm-divi-event-calendar-module' ),
					'month_sep'  => esc_html__( 'Month Separator', 'decm-divi-event-calendar-module' ),
					//'numeric_pagination'  => esc_html__( 'Numeric Pagination', 'decm-divi-event-calendar-module' ),			
					//'paged_pagination'  => esc_html__( 'Paged Pagination', 'decm-divi-event-calendar-module' ),	
					'paged_pagination' => array(
						'priority' => 75,
						'title' => esc_html__( 'Paged Pagination', 'decm-divi-event-calendar-module'),
					),	
					'numeric_pagination' => array(
						'priority' => 79,
						'title' => esc_html__( 'Numeric Pagination', 'decm-divi-event-calendar-module'),
					),		
				),
			),
		);
	}
/**
	 * Module's advanced fields configuration
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	
	function get_advanced_fields_config() {
		return array(
			'text'           => false,
			'button'         => false,
			'link_options'          => false,
			
			'background'            => array(
				'has_background_color_toggle' => true,
				'options' => array(

					'background_color' => array(
						'depends_show_if'  => 'on',
						'default'          => 'Transparent',
						//'default'          => et_builder_accent_color(),
					),
					'use_background_color' => array(
						'default'          => 'on',
						
					),
				),
			),
			
			'borders'        => array(
				'default' => array(
					'css'      => array(
						'main' => array (
							'border_radii' => " %%order_class%%",
							'border_styles' => " %%order_class%%",
							
						),
						'important' => 'all',
					),
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
				),
				'thumbnail_border'   => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .ecs-event-list  .ecs-event .act-post  .dec-image-overlay-url, %%order_class%%  .decm-cover-image-overlay",
							'border_styles' => "%%order_class%% .ecs-event-list  .ecs-event .act-post  .dec-image-overlay-url, %%order_class%%  .decm-cover-image-overlay",
							
						),
						'important' => 'all',
					),
					'show_if_not'         => array(
						'layout' => 'cover',
					),
					'label_prefix' => esc_html__( 'Image Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'thumbnail',
					//'default'          => 'solid',
					'defaults' => array(
						'border_radii' => 'on|4px|4px|4px|4px',
						'border_styles' => array(
							'style' => 'solid',
						),
					),
				),
				'event_border'   => array(
					'css'          => array(
						'main' => array (
							'border_radii' =>"%%order_class%% .ecs-event .act-post",
							'border_styles' =>"%%order_class%%.ecs-event-list,%%order_class%% .ecs-event .act-post",	
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Event Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'event',
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
				),		
				'details_border'   => array(
					'css'          => array(
						'main' => array (
							'border_radii' => "%%order_class%% .decm-events-details, %%order_class%%  .decm-events-details-cover",
							'border_styles' => "%%order_class%% .decm-events-details, %%order_class%%  .decm-events-details-cover",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Details ', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the border for the event details with all the standard border settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'details',
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
				),
				'callout_border'   => array(
					'css'          => array(
						'main' => array (
							'border_radii' => "%%order_class%% .callout-box-grid,%%order_class%%  .callout-box-cover,%%order_class%%  .callout-box-list, %%order_class%%  .callout-box-list-on-Image",
							'border_styles' => "%%order_class%% .callout-box-grid,%%order_class%%  .callout-box-cover,%%order_class%%  .callout-box-list, %%order_class%%  .callout-box-list-on-Image",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Callout', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the border for the event callout box with all the standard border settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'callout',
					'defaults' => array(
						'border_radii' => 'on|4px|4px|4px|4px',
					),),
					'seperator_border'   => array(
						'css'          => array(
							'main' => array (
								'border_radii' => "%%order_class%% .ecs-events-list-separator-month",
								'border_styles' => "%%order_class%% .ecs-events-list-separator-month",
								
							),
							'important' => 'all',
						),
						'label_prefix' => esc_html__( 'Month Separator', 'decm-divi-event-calendar-module' ),
						'description'        => esc_html__( 'Add and customize the border for the event callout box with all the standard border settings.', 'decm-divi-event-calendar-module' ),
						'tab_slug'     => 'advanced',
						'toggle_slug'  => 'month_sep',
					),

					'paged_border'   => array(
						'css'          => array(
							'main' => array (
								'border_radii' =>  "%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right ,%%order_class%%  .ecs-page_alignleft, %%order_class%%  .ecs-page_alignright",
								'border_styles' =>  "%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right ,%%order_class%%  .ecs-page_alignleft, %%order_class%%  .ecs-page_alignright",
								
							),
							'important' => 'all',
						),
						'label_prefix' => esc_html__( 'Paged Pagination', 'decm-divi-event-calendar-module' ),
						'description'        => esc_html__( 'Add and customize the border for the event callout box with all the standard border settings.', 'decm-divi-event-calendar-module' ),
						'tab_slug'     => 'advanced',
						'toggle_slug'  => 'paged_pagination',
					),
					'numeric_border'   => array(
						'css'          => array(
							'main' => array (
								'border_radii' => "%%order_class%% .ecs-event-pagination",
								'border_styles' => "%%order_class%% .ecs-event-pagination",
								
							),
							'important' => 'all',
						),
						'label_prefix' => esc_html__( 'Numeric Pagination', 'decm-divi-event-calendar-module' ),
						'description'        => esc_html__( 'Add and customize the border for the event callout box with all the standard border settings.', 'decm-divi-event-calendar-module' ),
						'tab_slug'     => 'advanced',
						'toggle_slug'  => 'numeric_pagination',
						// 'defaults' => array(
						// 	//'border_radii' => 'on|18px|18px|18px|18px',
						// 	'border_styles' => array(
						// 		'width' => '10px',
						// 		'color' => '#000',
						// 		'style' => 'solid',
						// 	),
						
					),
					
					// month_sep
					//'default'          => 'solid',
					// 'defaults' => array(
					// 	'border_radii' => 'on|4px|4px|4px|4px',
					// 	'border_styles' => array(
					// 		'width' => '0px',
					// 		'color' => '#000',
					// 		'style' => 'solid',
					// 	),
					// ),
				),

				'filter_border'   => array(
					'css'          => array(
						'main' => array (
								'border_radii' => "%%order_class%% .dec-filter-label",
								'border_styles' => "%%order_class%% .dec-filter-label",
							
						),
						// 'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Filter Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_search',
					'defaults' => array(
						'border_radii' => 'on|18px|18px|18px|18px',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#d5d5d5',
							'style' => 'solid',
						),
					),
				),

				'filter_dropdown_border'   => array(
					'css'          => array(
						'main' => array (
								'border_radii' => "%%order_class%% .dec-filter-list",
								'border_styles' => "%%order_class%% .dec-filter-list",
							
						),
						// 'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Filter Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_dropdown',
					'defaults' => array(
						'border_radii' => 'on|18px|18px|18px|18px',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#d5d5d5',
							'style' => 'solid',
						),
					),
				),

				'active_filter_border'   => array(
					'css'          => array(
						'main' => array (
								'border_radii' => "%%order_class%% .dec-filter-select",
								'border_styles' => "%%order_class%% .dec-filter-select",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Active Filter Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_active',
					'defaults' => array(
						'border_radii' => 'on|18px|18px|18px|18px',
						'border_styles' => array(
							'width' => '1px',
							'color' => '#000',
							'style' => 'solid',
						),
					),
				),
			
		
			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main' => "%%order_class%%",
					),
				),
				
			'image_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .ecs-event-list  .ecs-event .act-post  .dec-image-overlay-url",
					),
					'label'         => esc_html__( 'Image Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the event featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'thumbnail',
					//'default'          => 'solid',
					'show_if_not'     => array(
						'layout' => 'cover',
					),
				),
				'event_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .ecs-event-list .ecs-event .act-post",
					),
					
					'label'         => esc_html__( 'Event Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the individual events with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'event',
					//'default'          => 'solid',
				),

				'details_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .decm-events-details, %%order_class%%  .decm-events-details-cover",
					),
					
					'label'         => esc_html__( 'Details Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the event details with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'details',
					//'default'          => 'solid',
				),
				'callout_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%%  .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list, %%order_class%%  .callout-box-list-on-Image",
					),		
					'label'         => esc_html__( 'Callout Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the event callout box with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'callout',
					//'default'          => 'solid',
				),

				'filter_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-label",
					),
					
					'label'         => esc_html__( 'Filter Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the individual events with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_search',
					//'default'          => 'solid',
				),

				'filter_dropdown_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-list",
					),
					
					'label'         => esc_html__( 'Filter Dropdown Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the individual events with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_dropdown',
					//'default'          => 'solid',
				),

				'filter_active_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-select",
					),
					
					'label'         => esc_html__( 'Active Filter Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the individual events with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'filters_active',
					//'default'          => 'solid',
				),

			),
			

			'filters'        => array(
				'child_filters_target' => array(
					'tab_slug'    => 'advanced',
					'toggle_slug' => 'image',
				),
				'css'                  => array(
					'main' => '%%order_class%%',
				),
			),
			'fonts'          => array(
				// 'view_more_border_radius'  => array(
				// 	'border_radius' => '91',
				// ),
				'title' => array(
					'css'          => array(
						'main'      => "%%order_class%% .entry-title, %%order_class%% .entry-title a",				
						'important' => 'all',
					),
					'header_level' => array(
						'css'          => array(
							'main'      => "%%order_class%% .entry-title, %%order_class%% .entry-title a",
							'important' => 'all',
						),
					),
					'label'        => esc_html__( 'Title', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event title text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),
				'duration' => array(
					'css'          => array(
						'main'      => "%%order_class%% span.decm_date,%%order_class%% span.decm_time,%%order_class%% span.decm_venue a,%%order_class%% span.decm_venue ,%%order_class%% span.decm_location, %%order_class%% span.decm_organizer a,%%order_class%% span.decm_organizer,%%order_class%% span.decm_price,%%order_class%% span.decm_weburl a, %%order_class%% .ecs-categories a,%%order_class%% .decm_categories, %%order_class%% span.decm_tag  a, %%order_class%% span.decm_tag, %%order_class%% span.decm_series_name a, %%order_class%% span.decm_series_name",
						'text_align' => '%%order_class%% .decm-show-detail-center',
						'important' => 'all',
					),
					'toggle_priority' => 80,
					'label'        => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),
				'duration_labels' => array(
					'css'          => array(
						'main'      => "%%order_class%% .ecs-detail-label",
						'important' => 'all',
					),
					'toggle_priority' => 80,
					'label'        => esc_html__( 'Details Labels', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),
				'month_sep' => array(
					'css'          => array(
						'main'      => "%%order_class%% .ecs-events-calendar-list__month-separator-text",
						'important' => 'all',
					),
					'toggle_priority' => 80,
					'label'        => esc_html__( 'Month Separator', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),
				'excerpt' => array(
					'css'          => array(
						'main'      => "%%order_class%% .ecs-excerpt",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Excerpt', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),

				'callout_date' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_date",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Date', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
					'font_size' => array(
						'default' => '26',
					),
					
				),


				'callout_month' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_month",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Month', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),


				'callout_day_of_the_week' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_weekDay",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Day Of The Week', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),
				
				'callout_year' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_year",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Year', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),

				'callout_time' => array(
					'css'          => array(
						'main'      => "%%order_class%% .callout_time",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Callout Time', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'font' => array(
						'default' => '|700|||||||',
					),
				),

				
				'results_message' => array(
					'css'          => array(
						'main'      => "%%order_class%% .events-results-message",
						'important' => 'all',
					),
					'label'        => esc_html__( 'No Results Message', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event results message text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),
				'event_pagination_numaric' => array(
					'css'          => array(
						'main'      => "%%order_class%% .dec-page-text-container, %%order_class%% .dec-page-text-container > span, %%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right ,%%order_class%%  .ecs-page_alignleft, %%order_class%%  .ecs-page_alignright",
						//'important' => 'all',
						'text_align' => "%%order_class%% .ecs-event-pagination, %%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right, %%order_class%%  .ecs-page_alignleft, %%order_class%%  .ecs-page_alignright",
						'hover'  => "%%order_class%% .ecs-event-pagination span:hover, %%order_class%% .ecs-event-pagination a:hover, %%order_class%% .ecs-page_alignment_left a:hover, %%order_class%% .ecs-page_alignment_right a:hover, %%order_class%%  .ecs-page_alignright a:hover,  %%order_class%%  .ecs-page_alignleft a:hover",	
					),
					'label'        => esc_html__( 'Pagination', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event pagination text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'numeric_pagination',
				),

				'event_pagination_paged' => array(
					'css'          => array(
						'main'      => "%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right ,%%order_class%%  .ecs-page_alignleft, %%order_class%%  .ecs-page_alignright",
						'important' => 'all',
						'text_align' => "%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right, %%order_class%%  .ecs-page_alignleft, %%order_class%%  .ecs-page_alignright",
						'hover'  => "%%order_class%% .ecs-page_alignment_left:hover, %%order_class%% .ecs-page_alignment_right:hover, %%order_class%%  .ecs-page_alignright:hover,  %%order_class%%  .ecs-page_alignleft:hover",	
					),
					'label'        => esc_html__( 'Pagination', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event pagination text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'paged_pagination',
				),

				'filter_label' => array(
					'css'          => array(
						'main'      =>  "%%order_class%% .dec-filter-label",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Label', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the lable text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'filters_search',
				),

			),

			'max_width'      => array(
				'toggle_title'    => esc_html__( 'Sizing', 'decm-divi-event-calendar-module'),
				'css' => array(
					'main' => "%%order_class%%",
					'important' => 'all',
				),
			),
			
			
			'button'         => array(
                'view_more' => array(
					'label'         => esc_html__( 'More Info Button', 'decm-divi-event-calendar-module' ),
					'description'		=> esc_html__( 'Enable this feature to customize the appearance of the button', 'decm-divi-event-calendar-module' ),
                    'css'           => array(
						'main' => " %%order_class%%.et_pb_button_wrapper,%%order_class%% .act-view-more",
						'plugin_main' =>" %%order_class%%.et_pb_button_wrapper,%%order_class%% .act-view-more",
						'alignment'   => "%%order_class%% p.ecs-showdetail",
						'important' => 'all',	
					),
					//'all_buttons_border_radius'                    => '7',
					'use_alignment' => array(
						'label'         => esc_html__( 'alignment of era', 'decm-divi-event-calendar-module' ),
						'description'		=> esc_html__( 'Enable this feature to customize the appearance of the button', 'decm-divi-event-calendar-module' ),
					),

					'box_shadow'     => array(
						'css' => array(
							'main' => '%%order_class%% .act-view-more',
							'important' => 'all',
						),
					),

					'text_size'           => array(
						'default' => '20px',
					),	
		
					'margin_padding' => array(
						'css' => array(
							'margin' => "%%order_class%% p.ecs-showdetail",
					         'padding' => "%%order_class%% .act-view-more",
							'important' => 'all',
						),
						'custom_margin' => array(
					'default' => '15px|auto|auto|auto|false|false',
				     ),
					),
				
				
				),
				'ajax_load_more_button' => array(
					'label'         => __( 'Load More Button Pagination', 'decm-divi-event-calendar-module' ),
					'use_alignment' => true,
					'box_shadow'     => array(
						'css' => array(
							'main' => '%%order_class%% .ecs-ajax_load_more',
							'important' => 'all',
						),
					),
					'css'           => array(
						'main'        => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .ecs-ajax_load_more",
						'plugin_main' => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .ecs-ajax_load_more",
						'alignment'   => "%%order_class%% .event_ajax_load",
						'important' => 'all',
					),
					'margin_padding' => array(
						'css' => array(
							'margin' => "%%order_class%% div.event_ajax_load",
					         'padding' => "%%order_class%% .ecs-ajax_load_more",
							//'main'      => "%%order_class%% .et_pb_button_wrapper,%%order_class%% a.et_pb_button",
							'important' => 'all',
						),
						'custom_margin' => array(
					'default' => '15px|auto|auto|auto|false|false',
				),
				),
				),
				
            ),

		);
	}
	public function get_fields() {
		return array(
			'module_css_class'     => array(
				'label'           => esc_html__( 'Connection ID', 'decm_event_filter' ),
				'type'            => 'text',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Enter a module connection identification keyword to link the functionality of multiple modules together.', 'decm_event_filter' ),
				'toggle_slug'     => 'decm_connection_id',
			),
			'use_shortcode' => array(
				'label'           => esc_html__( 'Divi Events Calendar', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'option_category' => 'configuration',
				'options'         => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'affects'           => array(
					'src_back',
					'background_color',
				),
				'default' => 'off',
				'description'        => esc_html__( 'Divi Events Calendar', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'elements',
			),
			'shortcode_param' => array(
				'label'             => esc_html__( 'shortcode_param', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Total number of events to show.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'elements',
				'default'           => '',
				'show_if' => array(
					'use_shortcode'=>'on',
				)
			),
			'event_selection' => array(
                'label'           => esc_html__( 'Events Type', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'All Events is the default setting to display all events. Dynamic Events allows you to place the module in a Divi Theme Builder layout to dynamically display events based on the template assignment. Related Events is used on the single event pages to hide the current event and show other events related to the current event. Featured Events shows only featured events in the feed. Custom Events Selection gives you full control to use checkmarks to select events based on specific criteria like category, organizer, venue, and date range.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'all_event'   => __( 'All Events',  'decm-divi-event-calendar-module' ),
                    'use_current_loop'   => __( 'Dynamic Events', 'decm-divi-event-calendar-module' ),
					'use_current_loop_series'   => __( 'Dynamic Events For Series', 'decm-divi-event-calendar-module' ),
					// 'related_event_by_series'   => __( 'Related Events By Series', 'decm-divi-event-calendar-module' ),
                    'related_event'   => __( 'Related Events', 'decm-divi-event-calendar-module' ),
					'featured_events'   => __( 'Featured Events', 'decm-divi-event-calendar-module' ),
					'custom_event'   => __( 'Events By Category,Tags, Organizer, Venue, Series, Time', 'decm-divi-event-calendar-module' ),
                  
                ],
                
                'tab_slug'		  => 'general',
                //'mobile_options'  => true,
                'toggle_slug'     => 'decm_content',
				 'default' => 'use_current_loop',
			),
           
			'related_event_checkbox' => array(
                'label'            => esc_html__( 'Related Event Criteria', 'decm-divi-event-calendar-module' ),
                'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
//                    'all_opt'   => __( 'Events By Category,Tags,Venunes,Organizer',  'decm-divi-event-calendar-module' ),
                    'same_cate'   => __( 'Same Category',  'decm-divi-event-calendar-module' ),
                    'same_tag'   => __( 'Same Tag', 'decm-divi-event-calendar-module' ),
                    'same_venue'   => __( 'Same Venue', 'decm-divi-event-calendar-module' ),
                    'same_org'   => __( 'Same Organizer', 'decm-divi-event-calendar-module' ),
					'related_event_by_series'   => __( 'Same Series', 'decm-divi-event-calendar-module' ),
                ],
                'description'      => esc_html__( 'Choose the criteria used to define which events are related to the current event.', 'decm-divi-event-calendar-module' ),
                'tab_slug'		  => 'general',
				'toggle_slug'      => 'decm_content',
                'computed_affects'   => array(
                    '__getEvents',
                ),
                'show_if' => array(
                    'event_selection'=>'related_event',
                ),
                'default' => 'same_cate'
            ),

			'included_categories' => array(
				'label'            => esc_html__( 'Categories', 'decm-divi-event-calendar-module' ),
				'type'             => 'categories',
				'option_category'  => 'configuration',
				'renderer_options' => array(
					'use_terms' => true,
					'term_name' => 'tribe_events_cat',
					
				),
				// 'meta_categories'  => array(
				// 	'ture'     => esc_html__( 'Featured Events', 'decm-divi-event-calendar-module' ),
				// ),
				'description'      => esc_html__( 'Customize which events show in the feed by category. All events will show by default unless one or more categories are selected.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_content',
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'event_selection'=>'custom_event',
				),
			),

			'included_tags' => array(
				'label'            => esc_html__('Tags', 'decm-divi-event-calendar-module' ),
				'type'             => 'categories',
				'option_category'  => 'configuration',
				'renderer_options' => array(
					'use_terms' => true,
					'term_name' => 'post_tag',
					
				),
				// 'meta_categories'  => array(
				// 	'ture'     => esc_html__( 'Featured Events', 'decm-divi-event-calendar-module' ),
				// ),
				'description'      => esc_html__( 'Customize which events show in the feed by tag. All events will show by default unless one or more categories are selected.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_content',
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'event_selection'=>'custom_event',
				),
			),
			'included_organizer' => array(
				'label'            => esc_html__( 'Organizers', 'decm-divi-event-calendar-module' ),
				'type'            => 'multiple_checkboxes',
				'option_category' => 'configuration',
				'options'         => $this->get_organizer_data_name(),
				'description'      => esc_html__( 'Customize which events show in the feed by organizer. All events will show by default unless one or more organizers are selected.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_content',
				'computed_affects'   => array(
					'__getEvents',
				),
				'show_if' => array(
					'event_selection'=>'custom_event',
				),
			),
			
			'included_venue' => array(
				'label'            => esc_html__( 'Venues', 'decm-divi-event-calendar-module' ),
				'type'            => 'multiple_checkboxes',
				'option_category' => 'configuration',
				'options'         => $this->get_venue_data_name(),
				'description'      => esc_html__( 'Customize which events show in the feed by venue. All events will show by default unless one or more venues are selected.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_content',
				'computed_affects'   => array(
					'__getEvents',
				),
				'show_if' => array(
					'event_selection'=>'custom_event',
				),
			),
			'included_series' => array(
				'label'            => esc_html__( 'Series', 'decm-divi-event-calendar-module' ),
				'type'            => 'multiple_checkboxes',
				'option_category' => 'configuration',
				'options'         => $this->get_eventSeries_data_name(),
				'description'      => esc_html__( 'Customize which events show in the feed by venue. All events will show by default unless one or more venues are selected.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_content',
				'computed_affects'   => array(
					'__getEvents',

				),

				'show_if' => array(
					'event_selection'=>'custom_event',
				),

			),
			// 'included_location' => array(
			// 	'label'            => esc_html__( 'Location', 'decm-divi-event-calendar-module' ),
			// 	'type'            => 'multiple_checkboxes',
			// 	'option_category' => 'configuration',
			// 	'options'         => $this->get_location_data_name(),
			// 	'description'      => esc_html__( 'Choose which event categories you would like to show in the feed.', 'decm-divi-event-calendar-module' ),
			// 	'toggle_slug'      => 'decm_content',
			// 	'computed_affects'   => array(
			// 		'__getEvents',
			// 	),
			// 	'show_if' => array(
			// 		'event_selection'=>'custom_event',
			// 	),
			// ),
			'date_selection_type' => array(
                'label'           => esc_html__( 'Date Selection Type', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to show either future or past events in the feed.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
					'none'   => __( 'None', 'decm-divi-event-calendar-module' ),
					'date_range'   => __( 'Date Range', 'decm-divi-event-calendar-module' ),
                    'relative_date'   => __( 'Relative Date', 'decm-divi-event-calendar-module' ),              
                ],
					'computed_affects'   => array(
					'__getEvents',
				),
                //'mobile_options'  => true,
				'show_if' => array(
					'event_selection'=>'custom_event',
				),
                'toggle_slug'     => 'decm_content',
				 'default' => 'none',
			),

			'included_date_range_start' => array(
				'label'            => esc_html__( 'Date Range Start', 'decm-divi-event-calendar-module' ),
				'type'            => 'date_picker',
				'option_category' => 'basic',
				//'options'         => $this->get_orgaizer_data(),
				'description'      => esc_html__( 'Choose a start date to customize which events show in the feed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_content',
				'computed_affects'   => array(
					'__getEvents',
				),
				'show_if' => array(
					'event_selection'=>'custom_event',
					'date_selection_type'=>'date_range',
				),
			),
			'included_date_range_end' => array(
				'label'            => esc_html__( 'Date Range End', 'decm-divi-event-calendar-module' ),
				'type'            => 'date_picker',
				'option_category' => 'basic',
				//'options'         => $this->get_orgaizer_data(),
				'description'      => esc_html__( 'Choose a End date to customize which events show in the feed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_content',
				'computed_affects'   => array(
					'__getEvents',
				),
				'show_if' => array(
					'event_selection'=>'custom_event',
					'date_selection_type'=>'date_range',
				),
			),

			'event_by_reletive_date' => array(
                'label'           => esc_html__( 'Events Happening By Relative Date', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to display events based on when the event is happening relative to the current date.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
				//	'now'   => __( 'Now', 'decm-divi-event-calendar-module' ),
                    'today'   => __( 'Today', 'decm-divi-event-calendar-module' ),   
					'week'   => __( 'This Week', 'decm-divi-event-calendar-module' ),
                    'month'   => __( 'This Month', 'decm-divi-event-calendar-module' ),              
                ],
                //'mobile_options'  => true,
                'toggle_slug'     => 'decm_content',
				 'default' => 'week',
				 'show_if' => array(
					'event_selection'=>'custom_event',
					'date_selection_type'=> 'relative_date' ,
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),
			'use_current_loop'=> array(
				'label'				=> esc_html__( 'Dynamic Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to turn on or off dynamic content which allows you to place the module in a Divi Theme Builder layout to dynamically display events based on the template assignment.', 'decm-divi-event-calendar-module' ),		
				'toggle_slug'     => 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_cdn_link'=> array(
				'label'				=> esc_html__( 'Use Locally Hosted Files (GDPR)', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'A content delivery network (CDN) is hosting some files required for this module to function in an effort to provide the best performance as possible. However, due to GDPR laws you may be required to use locally hosted files instead. In this case, you can enable this setting to disable the CDN and activate the locally hosted code in the plugin instead.', 'decm-divi-event-calendar-module' ),		
				'toggle_slug'     => 'admin_label',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),

			'show_postponed_canceled_event'=> array(
				'label'				=> esc_html__( 'Show Canceled And Postponed Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show canceled and postponed events in the feed. A badge will be displayed on the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),

			'show_virtual_event'=> array(
				'label'				=> esc_html__( 'Show Virtual Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show virtual events in the feed. A badge will be displayed on the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),

			'show_hybrid_event'=> array(
				'label'				=> esc_html__( 'Show Hybrid Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show hybrid events in the feed. A badge will be displayed on the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),


			'show_virtual_hybrid_event'=> array(
				'label'				=> esc_html__( 'Show Virtual And Hybrid Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show canceled and postponed events in the feed. A badge will be displayed on the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),
			'show_recurring_events'=> array(
				'label'				=> esc_html__( 'Show Recurring Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show all recurring events in the feed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				// 'computed_affects'   => array(
				// 	'__getEvents',
				// ),
			),
			'recurrence_number' => array(
				'label'             => esc_html__( 'Limit Number Of Recurring Events To Show In Series', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter a number to set the maximum limit of events from each recurring events series to show in the feed at one time.', 'decm-divi-event-calendar-module' ),
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'toggle_slug'       => 'decm_content',
				'default'           => 6,
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_recurring_events' => 'on',
				)
			),
			
			'render_Classes' => array(
				'type'             => 'hidden',
				'option_category'  => 'basic',
				'toggle_slug'      => 'decm_content',
				'default'		   => $this->module_classname("decm_event_display"),
			),
			

			'show_past' => array(
                'label'           => esc_html__( 'Events Past/Future Status', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to show either future or past events in the feed.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
					'future_events'   => __( 'Future', 'decm-divi-event-calendar-module' ),
                    'past_events'   => __( 'Past', 'decm-divi-event-calendar-module' ),    
					'past_future_events'   => __( 'Both Past & Future', 'decm-divi-event-calendar-module' ),           
                ],
                //'mobile_options'  => true,
                'toggle_slug'     => 'decm_content',
				 'default' => 'future_events',
			),

			'cutoff_ongoing_events' => array(
				'label'           => esc_html__( 'Cutoff Point For Ongoing Events', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the point for ongoing events in the feed.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=> [
					'cut_end_date_reached'   =>   __( 'Show Ongoing Events Until End Date/Time Is Reached ', 'decm-divi-event-calendar-module' ),
					'cut_start_date_reached'   => __( 'Hide Events If Start Date/Time Is Already Reached', 'decm-divi-event-calendar-module' ),                
				],
				//'mobile_options'  => true,
				'toggle_slug'     => 'decm_content',
				 'default' => 'cut_end_date_reached',
				 'computed_affects'   => array(
					'__posts',
					'__getEvents',
				)
				// 'show_if_not' => array(
				// 	'show_past' => 'past_future_events',
				// )
			),
	
			'event_multidays_cut_off' => array(
				'label'           => esc_html__( 'Cutoff Point For Multi-Day Events', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose how long you want multi-day events to display in the feed.', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'option_category' => 'layout',
				'options'		=>[
					'cut_entire_duration'   => __( 'Entire Event Duration', 'decm-divi-event-calendar-module' ),
					'first_day_only'   => __( 'First Day Of Event Only', 'decm-divi-event-calendar-module' ),                
				],
				//'mobile_options'  => true,
				'toggle_slug'     => 'decm_content',
				 'default' => 'cut_entire_duration',
				 'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
			),
		
			'show_feature_image'=> array(
				'label'				=> esc_html__( 'Show Featured Image', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event featured image.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'show_title'=> array(
				'label'				=> esc_html__( 'Show Title', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event title.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'event_series_name'=> array(
				'label'				=> esc_html__( 'Show Series Name', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event series name.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// 	//'show_date'=>'on',
				// ),
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
			),

			'event_series_label'=> array(
				'label'				=> esc_html__( 'Series Label', 'decm-divi-event-calendar-module' ),
				'type'				=> 'text',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Enter custom text for the series name label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> '',
				'show_if' => array(
					'event_series_name'=>'on',
				),
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),	
			),

			'show_date'=> array(
				'label'				=> esc_html__( 'Show Date', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event date.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on', 
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),


			'date_detail_label' => array(
				'label'             => esc_html__( 'Date Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the date label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_date'=>'on',
				)
			),

			'date_format' => array(
				'label'             => esc_html__( 'Details Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'shorten_multidate'=> array(
				'label'				=> esc_html__( 'Shorten Multi-Day Dates', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to only show the month and year of multi-day events once.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_date' => 'on',
				),
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
			),
			'start_date_format' => array(
				'label'             => esc_html__( 'Details Start Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
					'shorten_multidate'=>'on',
					//'start_date'=>'on',
					)
			),
			'show_end_date'=> array(
				'label'				=> esc_html__( 'Show End Date', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event end date.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_time'=>'on',
				)
			),
			
			'show_time'=> array(
				'label'				=> esc_html__( 'Show Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),

			'details_time_label' => array(
				'label'             => esc_html__( 'Time Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the time label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_time'=>'on',
				)
			),

			'time_format' => array(
				'label'             => esc_html__( 'Details Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
                    'show_time' => 'on'
				)
			),
			
			'show_end_time'=> array(
				'label'				=> esc_html__( 'Show End Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_time'=>'on',
				)
			),

			'show_timezone'=> array(
				'label'				=> esc_html__( 'Show Time Zone', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_time'=>'on',
				//	'show_date'=>'on',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),
			'show_timezone_abb'=> array(
				'label'				=> esc_html__( 'Show Time Zone Abbreviation', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to abbreviate the event time zone.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_time'=>'on',
				//	'show_date'=>'on',
					'show_timezone'=>'on',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),
			'show_venue'=> array(
				'label'				=> esc_html__( 'Show Venue', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'venue_detail_label' => array(
				'label'             => esc_html__( 'Venue Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the venue label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_venue'=>'on',
				)
			),
			'show_location'=> array(
				'label'				=> esc_html__( 'Show Location', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				// 'affects' => array(
				// 	'show_street',
				// 	'show_locality',
				// 	'show_postal',
				// 	'show_country',
				// ),
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				
			),

			'location_detail_label' => array(
				'label'             => esc_html__( 'Location Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the location label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_location'=>'on',
				)
			),

			'show_street'=> array(
				'label'				=> esc_html__( 'Show Location Street Address', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location street address.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					 'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),

			
			'show_street_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Street Address', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location street address.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'details_toggle',
				'default'			=> 'on',

				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					 'use_shortcode'=>'off',
					'show_location'=>'on',
				)
				
			),
			'show_locality'=> array(
				'label'				=> esc_html__( 'Show Location Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location locality.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),
			'show_locality_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location locality.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'details_toggle',
				'default'			=> 'on',

				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					 'use_shortcode'=>'off',
					'show_location'=>'on',
				)
				
			),
			'show_location_state'=> array(
				'label'				=> esc_html__( 'Show Location State/Province', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location state/province.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),
			'show_location_state_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location State/Province', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location state/province.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=>'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),
			'show_postal'=> array(
				'label'				=> esc_html__( 'Show Location Postal Code', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location postal code.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),
			'show_postal_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Postal Code', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location postal code.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'details_toggle',
				'default'			=> 'on',
	
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					 'use_shortcode'=>'off',
					'show_location'=>'on',
				)
				
			),
			'show_country'=> array(
				'label'				=> esc_html__( 'Show Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location country.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_location'=>'on',
				)
			),
			'show_country_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location country in the tooltip.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'details_toggle',
				'default'			=> 'on',
	
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					 'use_shortcode'=>'off',
					'show_location'=>'on',
				)
				
			),
			'show_postal_code_before_locality'=> array(
				'label'				=> esc_html__( 'Show Postal Code Before Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to change the order of the location items to move the postal code in front of the locality.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'details_toggle',
				'default'			=> 'on',
	
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'show_if' => array(
					 'use_shortcode'=>'off',
					'show_location'=>'on',
				)
				
			),
			'show_name'=> array(
				'label'				=> esc_html__( 'Show Organizer', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event organizer.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'organizer_detail_label' => array(
				'label'             => esc_html__( 'Organizer Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the organizer label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_name'=>'on',
				)
			),


			'show_price' => array(
				'label'				=> esc_html__( 'Show Price', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event price.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'price_detail_label' => array(
				'label'             => esc_html__( 'Price Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the price label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_price'=>'on',
				)
			),


			'show_price_ticket' => array(
				'label'				=> esc_html__( 'Show Ticket', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event ticket.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'price_ticket_label' => array(
				'label'             => esc_html__( 'Ticket Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the ticket label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_price_ticket'=>'on',
				)
			),

	
			'show_ticket_feed_respond' => array(
				'label'				=> esc_html__( 'Show Purchase Now Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the text and link to purchase tickets.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'show_price_ticket'=>'on',
				)
			),

			'show_ticket_feed_left' => array(
				'label'				=> esc_html__( 'Show Places Left', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the number of tickets left.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'show_price_ticket'=>'on',
				)
			),



			'show_rsvp_feed' => array(
				'label'				=> esc_html__( 'Show RSVP', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event RSVP.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'rsvp_detail_label' => array(
				'label'             => esc_html__( 'RSVP Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the RSVP label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_rsvp_feed'=>'on',
				)
			),

			'show_rsvp_feed_respond' => array(
				'label'				=> esc_html__( 'Show Respond Now Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the text and link to respond to the RSVP.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'show_rsvp_feed'=>'on',
				)
			),
			'show_rsvp_feed_left' => array(
				'label'				=> esc_html__( 'Show Places Left', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the number of RSVP places left.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'show_rsvp_feed'=>'on',
				)
			),


			'show_category'=> array(
				'label'				=> esc_html__( 'Show Category', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event category.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),


			'category_detail_label' => array(
				'label'             => esc_html__( 'Category Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the category label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_category'=>'on',
				)
			),

			'hide_comma_cat'=> array(
				'label'				=> esc_html__( 'Hide Comma After Categories', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to hide the comma that shows after each category when more than one category is added.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'show_tag'=> array(
				'label'				=> esc_html__( 'Show Tags', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event tags.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			
			'tag_detail_label' => array(
				'label'             => esc_html__( 'Tags Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the tags label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_tag'=>'on',
				)
			),

			'hide_comma_tag'=> array(
				'label'				=> esc_html__( 'Hide Comma After Tags', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to hide the comma that shows after each tag when more than one tag is added.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
                    'show_tag'=>'on'
				)
			),
			'show_weburl' => array(
				'label'				=> esc_html__( 'Show Website', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event website URL.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'website_detail_label' => array(
				'label'             => esc_html__( 'Website Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the website label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'details_toggle',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_weburl'=>'on',
				)
			),

			'show_excerpt'=> array(
				'label'				=> esc_html__( 'Show Excerpt', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event excerpt.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'excerpt_toggle',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'excerpt_content'                  => array(
				'label'            => esc_html__( 'Excerpt Content', 'decm-divi-event-calendar-module' ),
				'type'             => 'select',
				'option_category'  => 'configuration',
				'options'          => array(
					'excerpt_show' => esc_html__( 'Show Excerpt', 'decm-divi-event-calendar-module' ),
					'_show'  => esc_html__( 'Show Description', 'decm-divi-event-calendar-module' ),
				),
				'affects'          => array(
				////	'show_more',
					'show_excerpt',
					//'use_manual_excerpt',
					'excerpt_length',
				),
				'description'      => esc_html__( 'Choose which content to show in the except.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'excerpt_toggle',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_excerpt'=>'on',
				),
				'default'=>'excerpt_show',
				'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
			),
			'show_detail'=> array(
				'label'				=> esc_html__( 'Show More Info Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event more info button.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'more_info_button',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

		
			'show_callout_box'=> array(
				'label'				=> esc_html__( 'Show Callout Box', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the callout box.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'on',
				'affects'  => array(
					'show_callout_day_of_week',
					'show_callout_month',
					'show_callout_date',
					'show_callout_year',
					'show_callout_time',
					'show_callout_time_range',
					'show_callout_day_of_week_range',
					'show_callout_month_range',
					'show_callout_date_range',
					'show_callout_year_range',
					'callout_date_format',
					'callout_week_format',
					'callout_month_format',
					'callout_year_format',
					'callout_time_format',
				),
				'show_if_not' => array(
						'list_layout' => array(
							'rightimage_leftdetail',		
							'leftimage_rightdetail',						
							),
			   ),
			),

			'show_callout_date'=> array(
				'label'				=> esc_html__( 'Show Callout Box Date', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout box date.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),

			'show_callout_date_range'=> array(
				'label'				=> esc_html__( 'Show Callout Box Date As Range', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the date in the callout box as a date range for any events that are more than one day.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				'show_if' => array(
					'show_callout_date'=>'on',
				)
			),
			'callout_date_format' => array(
				'label'             => esc_html__( 'Callout Box Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				
				'default'           => 'd',
				'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_date' => 'on',
				)
			),
			'show_callout_month'=> array(
				'label'				=> esc_html__( 'Show Callout Box Month', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout month.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),

			
			'show_callout_month_range'=> array(
				'label'				=> esc_html__( 'Show Callout Box Month As Range', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the months in the callout box as a range for any events that are in more than one month.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				'show_if' => array(
					'show_callout_month'=>'on',
				)
			),

			'callout_month_format' => array(
				'label'             => esc_html__( 'Callout Box Month Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'           => 'F',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_month' => 'on',
				),
				'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
			),



			'show_callout_day_of_week'=> array(
				'label'				=> esc_html__( 'Show Callout Box Day of the Week', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout box day of the week.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				// 'show_if_not'=>array(
				// 	'layout'=>'list',
				// ),
				'show_if' => array(
					'use_shortcode'=>'off',
				
				)
			),


			'show_callout_day_of_week_range'=> array(
				'label'				=> esc_html__( 'Show Callout Box Day Of The Week As Range', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the day of the week in the callout box as a range for any events that are in more than one day of the week.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				// 'show_if_not'=>array(
				// 	'layout'=>'list',
				// ),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_day_of_week'=>'on',
				
				)
			),


			'callout_week_format' => array(
				'label'             => esc_html__( 'Callout Box Day of the Week Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'callout_box',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => 'D',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_day_of_week'=>'on',
				)
			),

			'show_callout_year'=> array(
				'label'				=> esc_html__( 'Show Callout Box Year', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout box year.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),

			'show_callout_year_range'=> array(
				'label'				=> esc_html__( 'Show Callout Box Year As Range', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the year in the callout box as a range for any events that are in more than one year.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				'show_if' => array(
					'show_callout_year'=>'on',
				)
			),

			'callout_year_format' => array(
				'label'             => esc_html__( 'Callout Box year Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'callout_box',
				'default'           => 'Y',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_year'=>'on',
				),
				'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
			),
			'show_callout_time'=> array(
				'label'				=> esc_html__( 'Show Callout Box Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the  callout box time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),

			'show_callout_time_range'=> array(
				'label'				=> esc_html__( 'Show Callout Box Time As Range', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the time in the callout box as a range for any events that have a start and end time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',
				'default'			=> 'off',
				'show_if' => array(
					'show_callout_time' => 'on',
				)
			),

			'callout_time_format' => array(
				'label'             => esc_html__( 'Callout Box Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'callout_box',	
				'default'           => 'g:i a',
				'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_callout_time' => 'on',
				)
			),
			/* Elements from event calendar shortcode pluin */
			'show_google_calendar'=> array(
				'label'				=> esc_html__( 'Show Google Calendar', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button to add the event to your Google Calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_ical_export'=> array(
				'label'				=> esc_html__( 'Show Ical Export', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button to export the event Apple iCal.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'show_preposition'=> array(
				'label'				=> esc_html__( 'Show Prepositions & Dividers', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the prepositions and dividers in the event details. This setting is best used with the option to stack event details.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				'computed_affects'   => array(
					'__getEvents',
				),
			),
			'show_data_one_line'=> array(
				'label'				=> esc_html__( 'Stack Event Details', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to stack each of the event details on their own lines instead of showing them in the default sentence format.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'general',
                //'mobile_options'  => true,
				'toggle_slug'     => 'details_toggle',
				'default'			=> 'on',
				'affects'         => array(
					'show_icon_label'
				),
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
		
			'show_icon_label' => array(
                'label'           => esc_html__( 'Show Labels/Icons', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to add labels or icons before each event item. This setting is best used with the option to stack event details.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'none'   => __( 'None',  'decm-divi-event-calendar-module' ),
                    'label'   => __( 'Labels', 'decm-divi-event-calendar-module' ),
                    'icon'   => __( 'Icons', 'decm-divi-event-calendar-module' ),
					'label_icon'   => __( 'Labels And Icons', 'decm-divi-event-calendar-module' ),
                  
                ],
                
                'tab_slug'		  => 'general',
                //'mobile_options'  => true,
                'toggle_slug'     => 'details_toggle',
				 'default' => 'label_icon',
			),

			'event_order' => array(
                'label'           => esc_html__( 'Events Order', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the order of events in the feed.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
					'DESC'   => __( 'Descending', 'decm-divi-event-calendar-module' ),
                    'ASC'   => __( 'Ascending', 'decm-divi-event-calendar-module' ),                
                ],
                //'mobile_options'  => true,
                'toggle_slug'     => 'decm_content',
				 'default' => 'ASC',
			),
			/* Content Options from Blog Module */

			'blog_offset' => array(
				'label'             => esc_html__( 'Events Offset Number', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose how many events you want to skip in the feed. This is helpful if you want to feature one event at the top in a different module or style, then add a second module and start with the second event by inputting the number 1.', 'decm-divi-event-calendar-module' ),
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'toggle_slug'       => 'decm_content',
				'default'           => 0,
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'event_count' => array(
				'label'             => esc_html__( 'Events Count', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Choose the total number of events to show in the feed. Remember, you can use pagination options as well for the website visitor to load more events.', 'decm-divi-event-calendar-module' ),
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'toggle_slug'       => 'decm_content',
				'default'           => 6,
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			

			'featured_events'=> array(
				'label'				=> esc_html__( 'Only Show Featured Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the featured events in the feed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				),
				// 'computed_affects'   => array(
				// 	'__getEvents',
				// ),
			),
			
			

			'excerpt_length' => array(
				'label'             => esc_html__( 'Excerpt Length', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'If you are showing the event excerpt, this setting allows you to set a specific character limit for the text. The WordPress default is 270 characters.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'excerpt_toggle',
				'default'           => '270',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'result_message' => array(
				'label'             => esc_html__( 'No Results Message', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text to show for the no results message.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'no_results_message',
				'default'           => esc_html__('There are no upcoming events at this time.', 'decm-divi-event-calendar-module'),
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
		

			'event_past_future_cut_off' => array(
                'label'           => esc_html__( 'Past/Future Cutoff', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the start and end date  of events in the feed.', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
                'option_category' => 'layout',
                'options'		=>[
					'cut_start_date'   => __( 'Start Date', 'decm-divi-event-calendar-module' ),
                    'cut_end_date'   => __( 'End Date', 'decm-divi-event-calendar-module' ),                
                ],
                //'mobile_options'  => true,
                'toggle_slug'     => 'decm_content',
				 'default' => 'start_date',
				 'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
			),
			

			'cut_off_start_date' => array(
				'label'           => esc_html__( 'Start Date', 'decm-divi-event-calendar-module' ),
				'type'            => 'date_picker',
				'option_category' => 'basic_option',
				'description'     => et_get_safe_localization( sprintf( __( 'This is the date the countdown timer is counting down to. Your countdown timer is based on your timezone settings in your <a href="%1$s" target="_blank" title="WordPress General Settings">WordPress General Settings</a>', 'decm-divi-event-calendar-module' ), esc_url( admin_url( 'options-general.php' ) ) ) ), //phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				'toggle_slug'     => 'decm_content',
				'show_if' => array(
					'event_past_future_cut_off' => 'cut_start_date',
			),
			'computed_affects'   => array(
				'__posts',
				'__getEvents',
			),
		    ),

		'cut_off_end_date' => array(
			'label'           => esc_html__( 'End Date', 'decm-divi-event-calendar-module' ),
			'type'            => 'date_picker',
			'option_category' => 'basic_option',
			'description'     => et_get_safe_localization( sprintf( __( 'This is the date the countdown timer is counting down to. Your countdown timer is based on your timezone settings in your <a href="%1$s" target="_blank" title="WordPress General Settings">WordPress General Settings</a>', 'decm-divi-event-calendar-module' ), esc_url( admin_url( 'options-general.php' ) ) ) ),//phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
			'toggle_slug'     => 'decm_content',
			'show_if' => array(
				'event_past_future_cut_off' =>'cut_end_date',
		),
		'computed_affects'   => array(
			'__posts',
			'__getEvents',
		),
	    ),


			'layout' => array(
                'label'           => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the type of layout you want to use to display your events.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'grid'   => __( 'Grid',  'decm-divi-event-calendar-module' ),
                    'list'   => __( 'List', 'decm-divi-event-calendar-module' ),
                    'cover'   => __( 'Cover', 'decm-divi-event-calendar-module' ),
                    
                ],              
                'tab_slug'		  => 'general',
               // 'mobile_options'  => true,
                'toggle_slug'     => 'layout',
                'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
				 'default' => 'grid',
			),
			
			'list_layout' => array(
                'label'           => esc_html__( 'List Type', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose which items to include in your list layout. Each item creates a separate column within each event. The items show in order from left to right.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'leftimage_rightdetail'   => __( 'Image, Details',  'decm-divi-event-calendar-module' ),
					'calloutimage_rightdetail'   => __( 'Callout On Image, Details', 'decm-divi-event-calendar-module' ),
                    'calloutleftimage_rightdetail'   => __( 'Callout, Image, Details', 'decm-divi-event-calendar-module' ),
					'calloutleftimage_rightdetailButton'   => __( 'Callout, Image, Details, Button' , 'decm-divi-event-calendar-module' ),
					'calloutimage_rightdetailButton'   => __( 'Callout On Image, Details, Button' , 'decm-divi-event-calendar-module' ),
					'rightimage_leftdetail'   => __( 'Details, Image', 'decm-divi-event-calendar-module' ),
					'calloutrightimage_leftdetail'   => __( 'Callout, Details, Image', 'decm-divi-event-calendar-module' ),
					'calloutrightimage_leftdetailButton'   => __( 'Callout, Details, Image, Button', 'decm-divi-event-calendar-module' ),
                    
                ],              
                'tab_slug'		  => 'general',
               // 'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'layout' => array(
						'list',
					),
					
				),
				 'default' => 'calloutleftimage_rightdetail',
			),

			'columns' => array(
                'label'           => esc_html__( 'Number of Columns', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the number of columns for the events layout on each device.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
                    '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
                    '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
                    '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
                ],
                
                'tab_slug'		  => 'general',
                'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'layout' => array(
						'grid',
					),
					
				),
				 'default' => '3',
			),

			'cover_columns' => array(
                'label'           => esc_html__( 'Number of Columns', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the number of columns for the events layout on each device.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
                    '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
                    '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
                    '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
                ],
                
                'tab_slug'		  => 'general',
                'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'layout' => array(
						'cover',
					),	
				),
				 'default' => '3',
			),

			'list_columns' => array(
                'label'           => esc_html__( 'Number of Columns', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the number of columns for the events layout on each device.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
                    '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
                    // '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
                    // '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
                ],
                
                'tab_slug'		  => 'general',
                'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'layout' => array(
						'list',
					),			
				),
				 'default' => '1',
			),
		
			'stack_columns_on_tablet' => array(
				'label'				=> esc_html__( 'Stack Columns On Tablet', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to stack the list layout columns on Tablet.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'general',
                //'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'default'			=> 'off',
		
				'show_if' => array(
					'layout' => 'list',
					),			
				),

			'show_event_month_heading'=> array(
				'label'				=> esc_html__( 'Show Events By Month With Headings', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to group the events by month with headings showing the month and year.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'general',
                //'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'default'			=> 'on',
		
				'show_if' => array(
					'layout' => 'list',
					'list_columns'=> '1',
					),			
				),
		
			'image_align' => array(
                'label'           => esc_html__( 'Alignment', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the alignment of the event featured image and details. Note that the alignment is sometimes dependent on the number of columns chosen.', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
                'option_category' => 'layout',
                'options'		=>[
					//'leftimage_rightdetail'   => __( 'Image Left, Details Right',  'decm-divi-event-calendar-module' ),
					'topimage_bottomdetail'   => __( 'Image Top,  Details  Bottom',  'decm-divi-event-calendar-module' ),
					//'rightimage_leftdetail'   => __( 'Image Right, Details Left',  'decm-divi-event-calendar-module' ),

                ],
                'default'         => 'topimage_bottomdetail',
                'tab_slug'		  => 'advanced',
               // 'mobile_options'  => false,
				'toggle_slug'     => 'layout',
				'show_if' => array(
					'columns' => array(
						'1',
						'2',
					),
					
				 ),
			),

			'open_toggle_background_color' => array(
				'label'             => esc_html__( 'Event Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the individual events.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'event',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'month_sep_background_color' => array(
				'label'             => esc_html__( 'Month Separator Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the month separator.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'month_sep',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),


			'details_background_color' => array(
				'label'             => esc_html__( 'Details Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'details',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'show_image_overlay' => array(
				'label'             => esc_html__( 'Show Image Overlay', 'decm-divi-event-calendar-module' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
				),
				'description'        => esc_html__( 'Choose to show an overlay color over the event featured image.', 'decm-divi-event-calendar-module' ),
				'tab_slug'          => 'advanced',
				'toggle_slug'        => 'thumbnail',
				'show_if'     => array(
					'layout' => 'cover',
					'show_feature_image' => 'on',
				),	
				'default'   => 'on',
			),

			'overlay_image_background_color' => array(
				'label'             => esc_html__( 'Image Overlay Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the image overlay.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'thumbnail',
				'default'           => 'rgba(0,0,0,0.5)',	
				'show_if'           => array(
					'layout' => 'cover',
					'show_image_overlay' => 'on',
					'show_feature_image' => 'on',
				),
				'mobile_options'    => true,
			),
			'callout_background_color' => array(
				'label'             => esc_html__( 'Callout Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the event callout box.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				// 'css'      => array(
				// 	'main' =>"{$this->main_css_element} .ecs-event-list  .ecs-event .act-post",
				// ),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'callout',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'details_link_color' => array(
				'label'             => esc_html__( 'Details Link Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the link text in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,			
				'tab_slug'          => 'advanced',
				'toggle_priority' => 16,
				'toggle_slug'       => 'duration',
				'priority' => 24,
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			

			'details_icon_color' => array(
				'label'             => esc_html__( 'Details Icon Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the icons in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'duration',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'details_icon_size' => array(
				'label'           => esc_html__( 'Details Icon Size', 'decm-divi-event-calendar-module' ),
				'description' => __('Adjust the size of the details icons.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'duration',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '14',
				'allow_empty'     => true,
				'responsive'      => true,
				// 'show_if_not'     => array(
				// 	'layout' => 'cover',
				// ),	
				'mobile_options'  => true,
				
			),
			'details_label_color' => array(
				'label'             => esc_html__( 'Details Label Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the label text in the event details.', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'duration_labels',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			
            'cards_spacing' => array(
                'label'           => esc_html__( 'Event Margin', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the outside of the individual events.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'event',
				'tab_slug'		  => 'advanced',
				'mobile_options'    => true,
                'computed_affects' => array(
                    '__posts',
                ),

            ),
			
            'event_inner_spacing' => array(
                'label'           => esc_html__( 'Event Padding', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the inside of the individual events.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'event',
                'tab_slug'		  => 'advanced',
				'mobile_options'  => true,
				'computed_affects' => array(
                    '__posts',
                ),

			),

		
			'__posts' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				'computed_depends_on' => array(
					'event_count',
					'date_format',
					'time_format',
					'show_name',
					'use_current_loop',
					
				),
			),
			'__page'          => array(
				'type'              => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				'computed_affects'  => array(
				'__posts',
				),
			),
			'__getEvents'          => array(
				'type'              => 'computed',
				'computed_callback' => array( 'DECM_EventDisplay', 'get_blog_posts_events' ),
				'computed_depends_on'  => array(
					//'events_to_load',
					'show_recurring_events',
					'recurrence_number',
					'show_rsvp_feed_left',
					'show_rsvp_feed_respond',
					'show_ticket_feed_left',
					'show_ticket_feed_respond',
					'featured_events',
					'event_count',
					'event_order',
					'date_format',
					'shorten_multidate',
					'start_date_format',
					'time_format',
					'show_name',
					'show_past',
					'blog_offset',
					'cut_off_start_date',
					'cut_off_end_date',
					'event_past_future_cut_off',
					'cutoff_ongoing_events',
					'event_selection',
                    'related_event_checkbox',
					'included_categories',
					'included_tags',
					'included_venue',
					'included_series',
					'included_organizer',
					//'included_location',
					'show_location_state',
					'date_selection_type',
					'event_by_reletive_date',
					'included_date_range_start',
					'included_date_range_end',
					'total_events',
					'callout_year_format',
					'callout_month_format',
					'callout_week_format',
					'callout_date_format',
					'callout_time_format',
					'website_link',
			        'custom_website_link_text',
			        'custom_website_link_target',
					'enable_category_links',
					'enable_tag_links',
					'custom_tag_link_target',
					'enable_organizer_link',
					'enable_venue_link',
					'show_postponed_canceled_event',
					'show_virtual_hybrid_event',
					'show_virtual_event',
					'show_hybrid_event',
					'excerpt_content',
					'show_timezone_abb',
					'hide_comma_cat',
					'hide_comma_tag',
					'event_series_name',
					'event_series_label',
					'enable_series_link',
					'custom_series_link_target',
					'show_callout_date_range',
					'show_callout_time_range',
					'show_callout_month_range',
					'show_callout_year_range',
					'show_callout_day_of_week_range',
					'show_callout_date',
					'show_callout_time',
					'show_callout_month',
					'show_callout_year',
					'show_callout_day_of_week',
					'custom_tag_link_target',
				),	
			),

			//Extra Design settings
			'view_more_text' => array(
                'label'           => esc_html__( 'More Info Button Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'more_info_button',
				'default'         => esc_html__( 'More Info', 'decm-divi-event-calendar-module' ),
				'dynamic_content'  => 'text',
				'mobile_options'   => true,
				//'hover'            => 'tabs',
                'computed_affects' => array(
                    '__posts',
                ),

            ),
			'view_more_icons_list' => array(
                'label'           => esc_html__( 'Button Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'more_info_button',
                'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
            ),
			
			'stack_label_icon'=> array(
				'label'				=> esc_html__( 'Stack Labels/Icons', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to stack each of the labels/icons on their own lines above the event detail instead of on the left.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_data_one_line'=>'on',
				),
				'show_if_not' => array(
					'show_icon_label'=>'none',
				)
			),
			'show_colon'=> array(
				'label'				=> esc_html__( 'Show Colon After Labels', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show a colon after the labels text.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'details_toggle',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_data_one_line'=>'on',
				),
				'show_if' => array(
					'show_icon_label'=>array('label_icon','label'),
				)
			),
			'use_overlay'                   => array(
				'label'            => esc_html__( 'Featured Image Overlay', 'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'layout',
				'options'          => array(
					'off' => et_builder_i18n( 'Off' ),
					'on'  => et_builder_i18n( 'On' ),
				),
				'affects'          => array(
					'overlay_icon_color',
					'hover_overlay_color',
					'hover_icon',
				),
				'description'      => esc_html__( 'If enabled, an overlay color and icon will be displayed when a visitors hovers over the featured image of a post.', 'decm-divi-event-calendar-module' ),
				'computed_affects' => array(
					'__posts',
				),
				'show_if_not' => array(
					'layout' => 'cover',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'thumbnail',
				'default_on_front' => 'off',
			),
			'overlay_icon_color'            => array(
				'label'           => esc_html__( 'Overlay Icon Color', 'decm-divi-event-calendar-module' ),
				'type'            => 'color-alpha',
				'custom_color'    => true,
				'depends_show_if' => 'on',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'thumbnail',
				'description'     => esc_html__( 'Here you can define a custom color for the overlay icon', 'decm-divi-event-calendar-module' ),
				'show_if_not' => array(
					'layout' => 'cover',
				),
				'show_if' => array(
					'use_overlay'=>'on',
				),
				'mobile_options'  => true,
				'sticky'          => true,
			),
			'hover_overlay_color'           => array(
				'label'           => esc_html__( 'Overlay Background Color', 'decm-divi-event-calendar-module' ),
				'type'            => 'color-alpha',
				'custom_color'    => true,
				'depends_show_if' => 'on',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'thumbnail',
				'description'     => esc_html__( 'Here you can define a custom color for the overlay', 'decm-divi-event-calendar-module' ),
				'show_if_not' => array(
					'layout' => 'cover',
				),
				'show_if' => array(
					'use_overlay'=>'on',
				),
				'mobile_options'  => true,
				'sticky'          => true,
			),
			'hover_icon'                    => array(
				'label'            => esc_html__( 'Overlay Icon', 'decm-divi-event-calendar-module' ),
				'type'             => 'select_icon',
				'option_category'  => 'configuration',
				'class'            => array( 'et-pb-font-icon' ),
				'depends_show_if'  => 'on',
				'description'      => esc_html__( 'Here you can define a custom icon for the overlay', 'decm-divi-event-calendar-module' ),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'thumbnail',
				'computed_affects' => array(
					'__posts',
				),
				'show_if_not' => array(
					'layout' => 'cover',
				),
				'show_if' => array(
					'use_overlay'=>'on',
				),
				'mobile_options'   => true,
				'sticky'           => true,
			),

			'align' => array(
				'label'           => esc_html__( 'Image Alignment', 'decm-divi-event-calendar-module' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'default_on_front' => 'left',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'thumbnail',
				'description'     => esc_html__( 'Choose to align the event featured image to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				'options_icon'    => 'module_align',
				'show_if'     => array(
					'layout' => 'grid',
				),
				//'mobile_options'  => true,
			),

			'thumbnail_margin' => array(
				'label' => __('Image Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'thumbnail',
				'show_if_not'     => array(
					'layout' => 'cover',
				),
				//'default'         => '||||',
				'default'         => '||14px|',
				'mobile_options'  => true,
			),
			'thumbnail_padding' => array(
				'label' => __('Image Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'thumbnail',
				'show_if_not'     => array(
					'layout' => 'cover',
				),
				'mobile_options'  => true,
			),


			'month_margin' => array(
				'label' => __('Month Separator Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'month_sep',
				// 'show_if_not'     => array(
				// 	'layout' => 'cover',
				// ),
				//'default'         => '||14px|',
				'mobile_options'  => true,
			),
			'month_padding' => array(
				'label' => __('Month Separator Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'month_sep',
				// 'show_if_not'     => array(
				// 	'layout' => 'cover',
				// ),
				'mobile_options'  => true,
			),

			'details_margin' => array(
				'label' => __('Details Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event details.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'details',
				'show_if_not'     => array(
					'layout' => 'cover',
				),	
				'mobile_options'  => true,
			),


			'details_margin_overlay' => array(
				'label' => __('Details Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event details.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'details',
				'show_if'     => array(
					'layout' => 'cover',
				),	
				'mobile_options'  => true,
			),

			'numeric_padding' => array(
				'label' => __('Numeric Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the numeric pagination.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'numeric_pagination',	
				'mobile_options'  => true,
			),

			'details_padding' => array(
				'label' => __('Details Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event details.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'details',
				'show_if_not'     => array(
					'layout' => 'cover',
				),	
				'mobile_options'  => true,
			),
			'details_padding_overlay' => array(
				'label' => __('Details Padding' , 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event details.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'details',
				'default'         => '20px|20px|20px|20px',
				'computed_affects'   => array(
					'__getEvents',
				),
				'show_if'     => array(
					'layout' => 'cover',
				),		
				'mobile_options'  => true,
			),
			'callout_margin' => array(
				'label' => __('Callout Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event callout box.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'callout',
				'default'         => '||10px|',
				'mobile_options'  => true,
			),
			'callout_padding' => array(
				'label' => __('Callout Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event callout box.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'callout',
				'default'         => '10px|10px|10px|10px',
				'mobile_options'  => true,
			),
			'thumbnail_width' => array(
				'label'           => esc_html__( 'Image Width', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'thumbnail',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '800',
				'allow_empty'     => true,
				'responsive'      => true,
				'show_if_not'     => array(
					'layout' => 'cover',
				),	
				'mobile_options'  => true,
				
			),
			'image_aspect_ratio'                      => array(
				'label'           => esc_html__( 'Image Aspect Ratio', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the aspect ratio of the event featured image.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'1/1'   => esc_html__( 'Square 1:1', 'decm-divi-event-calendar-module' ),
					'16/9'  => esc_html__( 'Landscape 16:9', 'decm-divi-event-calendar-module' ),
					'4/3'  => esc_html__( 'Landscape 4:3', 'decm-divi-event-calendar-module' ),
					'3/2'   => esc_html__( 'Landscape 4:3', 'decm-divi-event-calendar-module' ),
					'3/2'   => esc_html__( 'Landscape 3:2', 'decm-divi-event-calendar-module' ),
					'9/16'   => esc_html__( 'Portrait 9:16', 'decm-divi-event-calendar-module' ),
					'3/4'   => esc_html__( 'Portrait 3:4', 'decm-divi-event-calendar-module' ),
					'2/3'   => esc_html__( 'Portrait 2:3', 'decm-divi-event-calendar-module' ),
					'unset'   => esc_html__( 'Original As Uploaded', 'decm-divi-event-calendar-module' ),
					
				),
				//'mobile_options'  => true,
				// 'show_if' => array(
				// 	'calendar_default_view'=>'listWeek',
				// ),
				//'default'         => 'listWeek,',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'thumbnail',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'button_align'=> array(
				'label'				=> esc_html__( 'Align To Bottom', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'view_more',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to align the button to the bottom.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'advanced',
                'mobile_options'  => true,
				'toggle_slug'     => 'view_more',
				'default'			=> 'off',
				'show_if_not'     => array(
					'layout' => 'list',
				),				
				'computed_affects'   => array(
					'__getEvents',
				),
			),

			'button_make_fullwidth'=> array(
				'label'				=> esc_html__( 'Make Fullwidth', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'view_more',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to make the more info button fullwidth.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'advanced',
              //  'mobile_options'  => true,
				'toggle_slug'     => 'view_more',
				'default'			=> 'off',
				// 'show_if_not'     => array(
				// 	'layout' => 'list',
				// ),				
				// 'computed_affects'   => array(
				// 	'__getEvents',
				// ),
			),

			'equal_height'=> array(
				'label'				=> esc_html__( 'Equal Height', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'equal_height',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to a equal heights of events.', 'decm-divi-event-calendar-module' ),
				'tab_slug'		  => 'advanced',
                'mobile_options'  => true,
				'toggle_slug'     => 'layout',
				'default'			=> 'on',
				'show_if'     => array(
					'layout' => 'cover',
				),				
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
			),
			'show_pagination' => array(
				'label'             => esc_html__( 'Show Pagination', 'decm-divi-event-calendar-module' ),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'           => array(
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
				),
				'description'        => esc_html__( 'Choose to use pagination for showing additional events.', 'decm-divi-event-calendar-module' ),
				'computed_affects'   => array(
					'__posts',
				),
				'toggle_slug'        => 'pagination_options',
				'default'   => 'off',
				//'mobile_options'    => true,
				'hover'             => 'tabs',
			),
			'pagination_type'     => array(
				'label'           => __( 'Pagination Type', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'configuration',
				'options'         => array(
					'paged'  => __( 'Paged', 'decm-divi-event-calendar-module' ),
					'numeric_pagination' => __( 'Numeric', 'decm-divi-event-calendar-module' ),
					'load_more' => __( 'Load More Button', 'decm-divi-event-calendar-module' ),									
				),
				'default'         => 'load_more',
				'show_if'         => array( 'show_pagination' => 'on' ),
				'description'     => __( 'Choose a method of pagination you would like to use to load additional events. You can choose to use a standard Paged pagination or a Load More Button.', 'decm-divi-event-calendar-module' ),
				//'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
			),
			'events_to_load' => array(
				'label'           => __( 'Number Of Events To Load', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'description'     => __( 'Choose the number of events that load each time the load more button is clicked.', 'decm-divi-event-calendar-module' ),
				'show_if'         => array(
					'show_pagination' => 'on',
					'pagination_type' => 'load_more',
					'use_shortcode'=>'off',
				),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
				//'default'           => 2,
			),
			'ajax_load_more_text' => array(
				'label'           => __( 'Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Load More', 'decm-divi-event-calendar-module' ),
				'show_if'         => array(
					'show_pagination' => 'on',
					'pagination_type' => 'load_more',
				),
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
			),

			'ajax_load_src'                 => array(
				'label'              => et_builder_i18n( 'GIF For Load More' ),
				'type'               => 'upload',
				'option_category'    => 'basic_option',
				'upload_button_text' => et_builder_i18n( 'Upload an image' ),
				'choose_text'        => esc_attr__( 'Choose an Image', 'decm-divi-event-calendar-module' ),
				'update_text'        => esc_attr__( 'Set As Image', 'decm-divi-event-calendar-module' ),
				'hide_metadata'      => true,
				'description'        => esc_html__( 'Upload your desired image, or type in the URL to the image you would like to display.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
				'dynamic_content'    => 'image',
				'show_if'         => array(
					'show_pagination' => 'on',
					'pagination_type' => 'load_more',
				),
			),
			
			'ajax_load_more_icons_list' => array(
                'label'           => esc_html__( 'Load More Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			),
			'google_calendar_text' => array(
				'label'           => __( 'Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'option_category' => 'configuration',
				'default'         => __( 'Google Calendar', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'load_more',
			),
			'google_calendar_icons_list' => array(
                'label'           => esc_html__( 'google caledar Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			),
			'ical_text' => array(
				'label'           => __( 'Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'option_category' => 'configuration',
				'default'         => __( 'Ical Export', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'load_more',
			),

			'ical_icons_list' => array(
                'label'           => esc_html__( 'ICAL Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			),
			'datetime_separator' => array(
                'label'           => esc_html__( 'Date Time Seprator', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Date Time Seprator', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         =>  $this->dateTimeSeparator(),
			),
			'time_range_separator' => array(
                'label'           => esc_html__( 'Time Range Seprator', 'decm-divi-event-calendar-module' ),
                'type'            => 'hidden',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Time Range Seprator', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'load_more',
                'default'         =>  $this->timeRangeSeparator(),
			),
			
			
			'single_event_page_link' => array(
				'label'           => esc_html__( 'Single Event Page Links', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to disable or replace the links to the single event page.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'default'   => __( 'Default',  'decm-divi-event-calendar-module' ),
					'disable_link'   => __( 'Disable Links', 'decm-divi-event-calendar-module' ),
					'replace_link'   => __( 'Replace With Custom Link', 'decm-divi-event-calendar-module' ),
					'redirect_link'   => __( 'Redirect To Website Link', 'decm-divi-event-calendar-module' ),				  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => 'defualt',
			),
			'disable_event_title_link'      => array(
				'label'            => esc_html__( 'Disable Event Title Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event title from linking to the single event page.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'off',
				'show_if' => array(
					'single_event_page_link'=>'disable_link',
				)
			),
			'disable_event_image_link'      => array(
				'label'            => esc_html__( 'Disable Event Image Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event featured image from linking to the single event page.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'off',
				'show_if' => array(
					'single_event_page_link'=>'disable_link',
				)
			),
			'disable_event_button_link'      => array(
				'label'            => esc_html__( 'Disable Event Button Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event more info button from linking to the single event pages.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'off',
				'show_if' => array(
					'single_event_page_link'=>'disable_link',
				)
			),
			'custom_event_link_url' => array(
				'label'             => esc_html__( 'Custom Single Event Page Link URL', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter a custom URL to use instead of the default single event page link.', 'decm-divi-event-calendar-module' ),
				'tab_slug'			=>'general',
				'toggle_slug'       => 'link_show',
				'show_if' => array(
					'single_event_page_link'=>'replace_link',
				)
			),	

			'custom_event_link_target' => array(
				'label'           => esc_html__( 'Custom Single Event Page Link Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the custom single event page link opens in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
			),
			'whole_event_clickable'      => array(
				'label'            => esc_html__( 'Make Entire Event Clickable',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to make the entire event clickable instead of just the title, image, and button',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'off',
				// 'show_if' => array(
				// 	'single_event_page_link'=>'disable_link',
				// )
			),
			'enable_category_links'      => array(
				'label'            => esc_html__( 'Enable Category Links',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to add links to the categories to link to their own archive pages.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'on',
				'show_if'=>array(
					'show_category'=>'on',
				),
			),
			'custom_category_link_target' => array(
				'label'           => esc_html__( 'Category Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the category links open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
				 'show_if'=>array(
					'enable_category_links'=>'on',
				 ),
			),


			'enable_tag_links'      => array(
				'label'            => esc_html__( 'Enable Tag Links',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to add links to the tags to link to their own archive pages.',  'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'tab_slug'         => 'general',
				'toggle_slug'      => 'link_show',
				'default' => 'on',
				'show_if'=>array(
					'show_tag'=>'on',
				),
			),
			'custom_tag_link_target' => array(
				'label'           => esc_html__( 'Tag Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the tag links open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
				 'show_if'=>array(
					'enable_tag_links'=>'on',
				 ),
			),

			'enable_series_link'=> array(
				'label'				=> esc_html__( 'Enable Series Links', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the series names to link to their own archive pages', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					//'use_shortcode'=>'off',
					'event_series_name'=>"on",
				)
			),
			'custom_series_link_target' => array(
				'label'           => esc_html__( 'Series Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the organizer links open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
				 'show_if' => array(
					//'use_shortcode'=>'off',
					'event_series_name'=>"on",
				)
			),



			'enable_organizer_link'=> array(
				'label'				=> esc_html__( 'Enable Organizer Links', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the organizers to link to their own archive pages.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'off',
				'show_if' => array(
					//'use_shortcode'=>'off',
					'show_name'=>"on",
				)
			),
			'custom_organizer_link_target' => array(
				'label'           => esc_html__( 'Organizer Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the organizer links open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),		  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
				 'show_if'=>array(
					'enable_organizer_link'=>'on',
				 ),
			),
			'enable_venue_link'=> array(
				'label'				=> esc_html__( 'Enable Venue Links', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the venues to link to their own archive pages.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'off',
				'show_if' => array(
					// 'use_shortcode'=>'off',
					'show_venue'=>"on",
				)
			),
			'custom_venue_link_target' => array(
				'label'           => esc_html__( 'Venue Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the venue links open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
				 'show_if'=>array(
					'enable_venue_link'=>'on',
				 ),
			),
			'website_link' => array(
				'label'           => esc_html__( 'Website Link', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose an option for displaying the website link.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'default_text'   => __( 'Show Default Text',  'decm-divi-event-calendar-module' ),
					'url'   => __( 'Show URL', 'decm-divi-event-calendar-module' ),
					'custom_text'   => __( 'Show Custom Text', 'decm-divi-event-calendar-module' ), 
				],
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => 'default_text',
			),
			'custom_website_link_text' => array(
				'label'             => esc_html__( 'Custom Website Link Text', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the website link.', 'decm-divi-event-calendar-module' ),
				'tab_slug'			=>'general',
				'toggle_slug'       => 'link_show',
				'show_if' => array(
					'website_link'=>'custom_text',
				),
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
			),	

			'custom_website_link_target' => array(
				'label'           => esc_html__( 'Website Link Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the website link opens in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],
		
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
			),	
			'pagination_align' => array(
				'label'           => esc_html__( 'Pagination Alignment', 'decm-divi-event-calendar-module' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'default_on_front' => 'Right',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'numeric_pagination',
				'description'     => esc_html__( 'Choose to align the pagination to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				'options_icon'    => 'module_align',
				//'default'         => __( 'Right', 'decm-divi-event-calendar-module' ),
				//'mobile_options'  => true,
			),

			'paged_pagination_background_color' => array(
				'label'             => esc_html__( 'Paged pagination Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the paged pagination.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'paged_pagination',
				'hover'             => 'tabs',
				'mobile_options'    => true,

			),
			'paged_padding' => array(
				'label' => __('Paged Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the numeric pagination.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'paged_pagination',	
				'mobile_options'  => true,
			),
			'paged_margin' => array(
				'label' => __('Paged Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the numeric pagination.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'paged_pagination',	
				'mobile_options'  => true,
			),
			'numeric_pagination_background_color' => array(
				'label'             => esc_html__( 'First & Last Button Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the first and last pagination buttons.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'numeric_pagination',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'numeric_pagination_text_color' => array(
				'label'             => esc_html__( 'First & Last Button Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the text of the first and last pagination buttons.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'numeric_pagination',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),


			'numeric_page_background_color' => array(
				'label'             => esc_html__( 'Page Number Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the pagination page numbers.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'numeric_pagination',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'numeric_page_text_color' => array(
				'label'             => esc_html__( 'Page Number Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the text of the pagination page numbers.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'numeric_pagination',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),


			'numeric_current_page_background_color' => array(
				'label'             => esc_html__( 'Current Page Number Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the pagination current page number.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'numeric_pagination',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'numeric_current_page_text_color' => array(
				'label'             => esc_html__( 'Current Page Number Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the text of the pagination current page number.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'numeric_pagination',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),		
			'previous_entries_text' => array(
				'label'           => esc_html__( 'Previous Events Link Custom Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'           => 'Previous Events',
				'description'     => esc_html__( 'Enter custom text for the previous events pagination link.', 'decm-divi-event-calendar-module' ),
				'show_if'         => array(
					'show_pagination' => 'on',
					'pagination_type' => 'paged',
					'use_shortcode'=>'off',
				),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
				//'default'           => 2,
			),
			'next_entries_text' => array(
				'label'           => __( 'Next Events Link Custom Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => 'Next Events',
				'description'     => __( 'Enter custom text for the next events pagination link.', 'decm-divi-event-calendar-module' ),
				'show_if'         => array(
					'show_pagination' => 'on',
					'pagination_type' => 'paged',
					'use_shortcode'=>'off',
				),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'pagination_options',
				//'default'           => 2,
			),
		);
	}
	

	public function dateTimeSeparator(){
			if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
			return  tribe_get_option( 'dateTimeSeparator', ' @ ' );
		}else{
			return "";	
		}
	}

	public function timeRangeSeparator(){
			if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
			return  tribe_get_option( 'timeRangeSeparator', ' - ' );
		}else{
			return "";	
		}
	}


	public function get_icon_list($icon_list = array())
	{
		$escapedHtmlAttr = array();
		foreach((array) $icon_list as $icon_html)
		{
			$escapedHtmlAttr[] = esc_attr( $icon_html );
		}
		return json_encode($escapedHtmlAttr);//phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode
	}
	public static function get_organizer_data_id(){
		$decm_organizerDataID = array();
		$organizers = tribe_get_organizers();
		foreach ((array) $organizers as $organizer ) {
			$decm_organizerDataID[] = $organizer->ID;
		}
		return $decm_organizerDataID;
   } 
public function get_organizer_data_name(){
	if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
	$decm_organizerDataName = array();
	$organizers = tribe_get_organizers();
	foreach ((array) $organizers as $organizer ) {
		$decm_organizerDataName[] = $organizer->post_title;
	}
	return $decm_organizerDataName;
	}else{
		return "";	
	}
} 
public static function get_venue_data_id(){
	if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
	$decm_venueDataID = array();
	$venues = tribe_get_venues();
	foreach ((array) $venues as $venue ) {
		$decm_venueDataID[] = $venue->ID;
	}
	return $decm_venueDataID;
	}else{
		return "";	
	}
} 
public function get_venue_data_name(){
	if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
	$decm_venueData = array();
	$venues = tribe_get_venues();
	foreach ((array) $venues as $venue ) {
		$venue_status = $venue->post_status;
        if ($venue_status == 'publish'){
            $decm_venueData[] = $venue->post_title;
		}
	}
	    return $decm_venueData;
	}else{
			return "";	
	}

} 

public function get_location_data_id(){
	if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
	$decm_locationDataID = array();
	$venues = tribe_get_venues();
	foreach ((array) $venues as $venue ) {
		$decm_venueData[] = $venue->ID;
	}
	return $decm_venueData;
	}else{
		return "";	
	}
} 



public function get_eventSeries_data_name() {
    global $wpdb;

    // Early return if tribe_is_event_series function does not exist
    if (!function_exists('tribe_is_event_series')) {
        return [];
    }

    // Check cache first
    $cache_key = 'event_series_titles';
    $cached_titles = get_transient($cache_key);
    if ($cached_titles !== false) {
        return $cached_titles;
    }

    // Fetch all events
    $events = tribe_get_events([
        'posts_per_page' => -1,
        'post_type' => 'tribe_events',
        'fields' => 'ids', // Fetch only IDs to reduce memory usage
    ]);

    $series_titles = [];

    foreach ($events as $event_id) {
        $event = get_post($event_id);
        if (!$event) {
            continue;
        }

        // Extract series ID from GUID or use event ID
        $series_id = $event->ID;
        if (preg_match("/&?p=([^&]+)/", $event->guid, $matches) && !empty($matches[1])) {
            $series_id = $matches[1];
        }

        // Get series data
        $series = tec_event_series($series_id);
        if ($series) {
            $series_titles[] = $series->post_title;
        }
    }

    // Remove duplicates and empty values
    $series_titles = array_unique(array_filter($series_titles));

    // Cache the results for 12 hours
    set_transient($cache_key, $series_titles, 12 * HOUR_IN_SECONDS);

    return $series_titles;
}



// public function get_eventSeries_data_name(){
// 	global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content,$wpdb;
// 	$post_type = get_post_type();
// 	$query_args['paged'] = $paged;
// 		 $decm_series_events_table = function_exists('tribe_is_event_series')?(new TEC\Events_Pro\Custom_Tables\V1\Tables\Series_Relationships)->table_name( true ):"";
// // 	if($wpdb->get_var("SHOW TABLES LIKE '$decm_series_events_table'") == $decm_series_events_table) {
// 	if(function_exists('tribe_is_event_series')) {
// $decm_venueData=array();
// $decm_locationDataID = array('posts_per_page' => -1,

// 'post_type' => 'tribe_events',);

// $venues = tribe_get_events($decm_locationDataID);
// $decm_venueData1=array();
// foreach ((array) $venues as $venue ) {

// 	$url = $venue->guid;	
// 	preg_match("/&?p=([^&]+)/", $url, $matches);
// 	 //  $series_id = $matches[1]; 
// 	if(!empty($matches[1])){
// 		 $series_id = $matches[1]; 
// 	}else{
// 		  $series_id = $venue->ID;
// 	}

// $decm_venueData[] =!function_exists('tribe_is_event_series')?"":((tec_event_series( $series_id )!=null)?tec_event_series($series_id):"");

// }
// foreach ((array) $decm_venueData as $venue2 ) {

// $decm_venueData1[] =$venue2!=null?$venue2->post_title:"";

// }
// $decm_venueData1=$decm_venueData1!=null?array_filter(array_unique($decm_venueData1)):array();
// $decm_venueData1=implode("|",$decm_venueData1);
// return explode("|",$decm_venueData1);
// 	}
// 	else{
// 		return "";
// 	}

// //return tec_event_series(15286);

// } 


public function get_eventSeries_data_id(){
	$decm_venueData=array();
	$decm_locationDataID = array('posts_per_page' =>-1,

	'post_type' => 'tribe_events',);

	$venues = tribe_get_events($decm_locationDataID);
	$decm_venueData1=array();
	foreach ((array) $venues as $venue ) {

		$url = $venue->guid;	
		preg_match("/&?p=([^&]+)/", $url, $matches);
		 //  $series_id = $matches[1]; 
		if(!empty($matches[1])){
			 $series_id = $matches[1]; 
		}else{
			  $series_id = $venue->ID;
		}

		$decm_venueData[] =!function_exists('tribe_is_event_series')?"":((tec_event_series( $series_id )!=null)?tec_event_series($series_id):"");

	}
	foreach ((array) $decm_venueData as $venue2 ) {

		$decm_venueData1[] = $venue2!=null?$venue2->ID:""; 

	}
	$decm_venueData1=array_filter(array_unique($decm_venueData1));
	$decm_venueData1=implode("|",$decm_venueData1);
	return explode("|",$decm_venueData1);
	
	
	//return tec_event_series(15286);

} 
// public function get_location_data_name(){

		
// 	$decm_locationData = array();
// 	$args = array(
// 		'post_type' => 'tribe_venue',
// 	);
// 	$loop = new WP_Query($args);
// 	while($loop->have_posts()): $loop->the_post();
// 	// if(!empty(tribe_get_address(get_the_ID()))){
// 	$locations = tribe_get_address(get_the_ID());
// 	//}
// 	foreach ((array) $locations as $location ) {
// 		$decm_locationData[] = $location;
// 	}

// endwhile;
// wp_reset_postdata();
// 	return $decm_locationData;
// }

	public function apply_custom_margin_padding($function_name, $slug, $type, $class, $important = true)
	{
		$slug_value = $this->props[$slug];
		$slug_value_tablet = $this->props[$slug . '_tablet'];
		$slug_value_phone = $this->props[$slug . '_phone'];
		$slug_value_last_edited = $this->props[$slug . '_last_edited'];
		$slug_value_responsive_active = et_pb_get_responsive_status($slug_value_last_edited);

		if (isset($slug_value) && !empty($slug_value)) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value, $type, $important),
			));
		}

		if (isset($slug_value_tablet) && !empty($slug_value_tablet) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value_tablet, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
		}

		if (isset($slug_value_phone) && !empty($slug_value_phone) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => et_builder_get_element_style_css($slug_value_phone, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
		}
	}
	
	public function get_custom_style($slug_value, $type, $important) {
		return  sprintf('%1$s: %2$s%3$s;', $type, $slug_value, $important? ' !important' : '');
	}

	public function apply_custom_width($function_name, $slug, $type, $class, $important = true)
	{
		$slug_value = $this->props[$slug];
		$slug_value_tablet = $this->props[$slug . '_tablet'];
		$slug_value_phone = $this->props[$slug . '_phone'];
		$slug_value_last_edited = $this->props[$slug . '_last_edited'];
		$slug_value_responsive_active = et_pb_get_responsive_status($slug_value_last_edited);

		if (isset($slug_value) && !empty($slug_value)) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => esc_attr($this->get_custom_style($slug_value, $type, $important)),
			));
		}

		if (isset($slug_value_tablet) && !empty($slug_value_tablet) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => esc_attr($this->get_custom_style($slug_value_tablet, $type, $important)),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
		}

		if (isset($slug_value_phone) && !empty($slug_value_phone) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => esc_attr($this->get_custom_style($slug_value_phone, $type, $important)),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
		}
	}

	
	public function getrenderClassNameSelector($Classes,$render_slug){
		foreach((array) explode(' ',$Classes)  as $ClassName){
			if(strpos($ClassName,$render_slug.'_') !== false){
				return '.'.$ClassName;		
			}
		}
	}

	
	public function render( $attrs, $content, $render_slug ) {

		if ( !function_exists( 'tribe_get_events' ) ) {
			return 'Divi Events Calendar requires The Events Calendar to be installed and active.';
		}


		
		// $Tickets_data = Tribe__Tickets__Tickets::get_ticket_counts('517');
		// print_r($Tickets_data);
		

		$atts = array();	
		$event_series_name = $this->props['event_series_name'];
		$event_series_label = $this->props['event_series_label'];
		$enable_series_link= $this->props['enable_series_link'];
		$custom_series_link_target = $this->props['custom_series_link_target'];
		$no_results_message = $this->props['result_message'];
		$show_cdn_link=$this->props['show_cdn_link'];	
		$event_order = $this->props['event_order'];	
		$use_shortcode = $this->props['use_shortcode'];
		$shortcode_param = $this->props['shortcode_param'];
		$show_feature_image = $this->props['show_feature_image'];
		$show_title = $this->props['show_title'];
		$show_name = $this->props['show_name'];
		$show_price = $this->props['show_price'];
		$show_price_ticket = $this->props['show_price_ticket'];
		$show_rsvp_feed = $this->props['show_rsvp_feed']; 
		// print_r($show_rsvp_feed);	
		$show_weburl = $this->props['show_weburl'];	
		$website_link = $this->props['website_link'];
		$enable_venue_link = $this->props['enable_venue_link'];
		$enable_organizer_link = $this->props['enable_organizer_link'];
		$custom_website_link_text = $this->props['custom_website_link_text'];
		$custom_website_link_target = $this->props['custom_website_link_target'];
     	$show_date = $this->props['show_date'];
		$shorten_multidate = $this->props['shorten_multidate'];
		$start_date_format = $this->props['start_date_format'];
		$show_time = $this->props['show_time'];
		$show_end_time = $this->props['show_end_time'];
		$show_end_date=$this->props['show_end_date'];
		$show_timezone = $this->props['show_timezone'];		
		$show_timezone_abb = $this->props['show_timezone_abb'];	
		$show_venue = $this->props['show_venue'];
		$show_location = $this->props['show_location'];
		$dec_show_location_street_address = $this->props['show_street'];
		$dec_show_location_locality = $this->props['show_locality'];
		$dec_show_location_state = $this->props['show_location_state'];
		$dec_show_location_postal_code = $this->props['show_postal'];
		$dec_show_location_country = $this->props['show_country'];
		$dec_show_location_street_comma = $this->props['show_street_comma'];
		$dec_show_location_locality_comma = $this->props['show_locality_comma'];
		$dec_show_location_state_comma = $this->props['show_location_state_comma'];
		$dec_show_location_postal_code_comma = $this->props['show_postal_comma'];
		$dec_show_location_country_comma = $this->props['show_country_comma'];
		$show_postal_code_before_locality = $this->props['show_postal_code_before_locality'];
		$show_excerpt = $this->props['show_excerpt'];
		$excerpt_content=$this->props['excerpt_content'];
		$list_layout = $this->props['list_layout'];
		$disable_event_title_link = $this->props['disable_event_title_link'];
		$enable_category_links = $this->props['enable_category_links'];	
		$custom_category_link_target= $this->props['custom_category_link_target'];
		$enable_tag_links = $this->props['enable_tag_links'];	
		$custom_tag_link_target= $this->props['custom_tag_link_target'];	
		$disable_event_image_link = $this->props['disable_event_image_link'];
		$disable_event_button_link = $this->props['disable_event_button_link'];
		$custom_event_link_url = $this->props['custom_event_link_url'];
		$single_event_page_link = $this->props['single_event_page_link'];
		$custom_event_link_target = $this->props['custom_event_link_target'];
		$whole_event_clickable = $this->props['whole_event_clickable'];
		$custom_organizer_link_target = $this->props['custom_organizer_link_target'];
		$custom_venue_link_target = $this->props['custom_venue_link_target'];
		$decm_show_callout_box = $this->props['show_callout_box'];
		$decm_button_make_fullwidth  = $this->props['button_make_fullwidth'];
		$decm_show_callout_date = $this->props['show_callout_date'];	
		$decm_callout_date_format = $this->props['callout_date_format'];
		$decm_show_callout_time = $this->props['show_callout_time'];	
		$decm_callout_time_format = $this->props['callout_time_format'];
		$decm_show_callout_month = $this->props['show_callout_month'];
		$decm_callout_month_format = $this->props['callout_month_format'];
		$decm_show_callout_year = $this->props['show_callout_year'];
		$decm_callout_year_format = $this->props['callout_year_format'];
		$decm_show_callout_day_of_week = $this->props['show_callout_day_of_week'];	
		$decm_show_callout_date_range = $this->props['show_callout_date_range'];
		$decm_show_callout_time_range = $this->props['show_callout_time_range'];
		$decm_show_callout_day_of_week_range = $this->props['show_callout_day_of_week_range'];		
		$decm_show_callout_month_range = $this->props['show_callout_month_range'];
		$decm_show_callout_year_range = $this->props['show_callout_year_range'];
		$decm_callout_week_format = $this->props['callout_week_format'];	
		$show_category = $this->props['show_category'];
		$category_detail_label = $this->props['category_detail_label'];
		$time_detail_label = $this->props['details_time_label'];
		$date_detail_label = $this->props['date_detail_label'];
		$venue_detail_label = $this->props['venue_detail_label'];
		$location_detail_label = $this->props['location_detail_label'];
		$organizer_detail_label = $this->props['organizer_detail_label'];
		$price_detail_label = $this->props['price_detail_label'];
		$price_ticket_label = $this->props['price_ticket_label'];
		$rsvp_detail_label = $this->props['rsvp_detail_label'];
		$tag_detail_label = $this->props['tag_detail_label'];
		$website_detail_label = $this->props['website_detail_label'];		
		$hide_comma_cat = $this->props['hide_comma_cat'];
		$show_tag = $this->props['show_tag'];
		$hide_comma_tag = $this->props['hide_comma_tag'];
		$show_ical_export=$this->props['show_ical_export'];
		$show_google_calendar=$this->props['show_google_calendar'];
		$show_detail = $this->props['show_detail'];
		$show_image_overlay = $this->props['show_image_overlay'];
		$datetime_separator = $this->props['datetime_separator'];
		$time_range_separator = $this->props['time_range_separator'];
		$overlay_image_background_color = $this->props["overlay_image_background_color"];
        $overlay_image_background_color_responsive_active = isset($this->props["overlay_image_background_color"]) && et_pb_get_responsive_status($this->props["overlay_image_background_color_last_edited"]);
        $overlay_image_background_color_tablet = $overlay_image_background_color_responsive_active && $this->props["overlay_image_background_color_tablet"] ? $this->props["overlay_image_background_color_tablet"] : $overlay_image_background_color;
        $overlay_image_background_color_phone = $overlay_image_background_color_responsive_active && $this->props["overlay_image_background_color_phone"] ? $this->props["overlay_image_background_color_phone"] : $overlay_image_background_color_tablet;
		$details_background_color = $this->props["details_background_color"];
        $details_background_color_responsive_active = isset($this->props["details_background_color"]) && et_pb_get_responsive_status($this->props["details_background_color_last_edited"]);
        $details_background_color_tablet = $details_background_color_responsive_active && $this->props["details_background_color_tablet"] ? $this->props["details_background_color_tablet"] : $details_background_color;
        $details_background_color_phone = $details_background_color_responsive_active && $this->props["details_background_color_phone"] ? $this->props["details_background_color_phone"] : $details_background_color_tablet;
		$callout_background_color = $this->props["callout_background_color"];
        $callout_background_color_responsive_active = isset($this->props["callout_background_color"]) && et_pb_get_responsive_status($this->props["callout_background_color_last_edited"]);
        $callout_background_color_tablet = $callout_background_color_responsive_active && $this->props["callout_background_color_tablet"] ? $this->props["callout_background_color_tablet"] : $callout_background_color;
        $callout_background_color_phone = $callout_background_color_responsive_active && $this->props["callout_background_color_phone"] ? $this->props["callout_background_color_phone"] : $callout_background_color_tablet;	
		$month_sep_background_color = $this->props["month_sep_background_color"];
        $month_sep_background_color_responsive_active = isset($this->props["month_sep_background_color"]) && et_pb_get_responsive_status($this->props["month_sep_background_color_last_edited"]);
        $month_sep_background_color_tablet = $month_sep_background_color_responsive_active && $this->props["month_sep_background_color_tablet"] ? $this->props["month_sep_background_color_tablet"] : $month_sep_background_color;
        $month_sep_background_color_phone = $month_sep_background_color_responsive_active && $this->props["month_sep_background_color_phone"] ? $this->props["month_sep_background_color_phone"] : $month_sep_background_color_tablet;		
		$open_toggle_background_color = $this->props["open_toggle_background_color"];
        $open_toggle_background_color_responsive_active = isset($this->props["open_toggle_background_color"]) && et_pb_get_responsive_status($this->props["open_toggle_background_color_last_edited"]);
        $open_toggle_background_color_tablet = $open_toggle_background_color_responsive_active && $this->props["open_toggle_background_color_tablet"] ? $this->props["open_toggle_background_color_tablet"] : $open_toggle_background_color;
        $open_toggle_background_color_phone = $open_toggle_background_color_responsive_active && $this->props["open_toggle_background_color_phone"] ? $this->props["open_toggle_background_color_phone"] : $open_toggle_background_color_tablet;
		$details_link_color = $this->props["details_link_color"];
        $details_link_color_responsive_active = isset($this->props["details_link_color"]) && et_pb_get_responsive_status($this->props["details_link_color_last_edited"]);
        $details_link_color_tablet = $details_link_color_responsive_active && $this->props["details_link_color_tablet"] ? $this->props["details_link_color_tablet"] : $details_link_color;
        $details_link_color_phone = $details_link_color_responsive_active && $this->props["details_link_color_phone"] ? $this->props["details_link_color_phone"] : $details_link_color_tablet;
		$details_icon_color = $this->props ['details_icon_color' ];
        $details_icon_color_responsive_active = isset($this->props["details_icon_color"]) && et_pb_get_responsive_status($this->props["details_icon_color_last_edited"]);
        $details_icon_color_tablet = $details_icon_color_responsive_active && $this->props["details_icon_color_tablet"] ? $this->props["details_icon_color_tablet"] : $details_icon_color;
        $details_icon_color_phone = $details_icon_color_responsive_active && $this->props["details_icon_color_phone"] ? $this->props["details_icon_color_phone"] : $details_icon_color_tablet;
		$details_icon_size = $this->props ['details_icon_size' ];
        $details_icon_size_responsive_active = isset($this->props["details_icon_size"]) && et_pb_get_responsive_status($this->props["details_icon_size_last_edited"]);
        $details_icon_size_tablet = $details_icon_size_responsive_active && $this->props["details_icon_size_tablet"] ? $this->props["details_icon_size_tablet"] : $details_icon_size;
        $details_icon_size_phone = $details_icon_size_responsive_active && $this->props["details_icon_size_phone"] ? $this->props["details_icon_size_phone"] : $details_icon_size_tablet;
		$details_label_color = $this->props ['details_label_color' ];
        $details_label_color_responsive_active = isset($this->props["details_label_color"]) && et_pb_get_responsive_status($this->props["details_label_color_last_edited"]);
        $details_label_color_tablet = $details_label_color_responsive_active && $this->props["details_label_color_tablet"] ? $this->props["details_label_color_tablet"] : $details_label_color;
        $details_label_color_phone = $details_label_color_responsive_active && $this->props["details_label_color_phone"] ? $this->props["details_label_color_phone"] : $details_label_color_tablet;	
		$view_more_alignment = $this->props["view_more_alignment"];
        $view_more_alignment_responsive_active = isset($this->props["view_more_alignment"]) && et_pb_get_responsive_status($this->props["view_more_alignment_last_edited"]);
        $view_more_alignment_tablet = $view_more_alignment_responsive_active && $this->props["view_more_alignment_tablet"] ? $this->props["view_more_alignment_tablet"] : $view_more_alignment;
        $view_more_alignment_phone = $view_more_alignment_responsive_active && $this->props["view_more_alignment_phone"] ? $this->props["view_more_alignment_phone"] : $view_more_alignment_tablet;
		$overlay_icon_color = $this->props["overlay_icon_color"];
        $overlay_icon_color_responsive_active = isset($this->props["overlay_icon_color"]) && et_pb_get_responsive_status($this->props["overlay_icon_color_last_edited"]);
        $overlay_icon_color_tablet = $overlay_icon_color_responsive_active && $this->props["overlay_icon_color_tablet"] ? $this->props["overlay_icon_color_tablet"] : $overlay_icon_color;
        $overlay_icon_color_phone = $overlay_icon_color_responsive_active && $this->props["overlay_icon_color_phone"] ? $this->props["overlay_icon_color_phone"] : $overlay_icon_color_tablet;
		// $hover_icon = $this->props["hover_icon"];
        // $hover_icon_responsive_active = isset($this->props["hover_icon"]) && et_pb_get_responsive_status($this->props["hover_icon_last_edited"]);
        // $hover_icon_tablet = $hover_icon_responsive_active && $this->props["hover_icon_tablet"] ? $this->props["hover_icon_tablet"] : $hover_icon;
        // $hover_icon_phone = $hover_icon_responsive_active && $this->props["hover_icon_phone"] ? $this->props["hover_icon_phone"] : $hover_icon_tablet;
		$hover_overlay_color = $this->props["hover_overlay_color"];
        $hover_overlay_color_responsive_active = isset($this->props["hover_overlay_color"]) && et_pb_get_responsive_status($this->props["hover_overlay_color_last_edited"]);
        $hover_overlay_color_tablet = $hover_overlay_color_responsive_active && $this->props["hover_overlay_color_tablet"] ? $this->props["hover_overlay_color_tablet"] : $hover_overlay_color;
        $hover_overlay_color_phone = $hover_overlay_color_responsive_active && $this->props["hover_overlay_color_phone"] ? $this->props["hover_overlay_color_phone"] : $hover_overlay_color_tablet;
		$show_past = $this->props['show_past'];
		$featured_events = $this->props['featured_events'];
		$show_data_one_line = $this->props['show_data_one_line'];
		$event_count = $this->props['event_count'];
		$events_to_load = $this->props['events_to_load'];
		$included_categories = $this->props['included_categories'];
		$included_tags = $this->props['included_tags'];
		$date_format = $this->props['date_format'];
		$time_format = $this->props['time_format'];
		$excerpt_length = $this->props['excerpt_length'];
		$blog_offset = $this->props['blog_offset'];
		$cut_off_start_date=$this->props['cut_off_start_date'];
		$cut_off_end_date=$this->props['cut_off_end_date'];
		$event_past_future_cut_off=$this->props['event_past_future_cut_off'];
		$cutoff_ongoing_events=$this->props['cutoff_ongoing_events'];
		$layout = $this->props['layout'];
		$columns_tablet = '';
		$Column_Type = $this->props['columns'] == '' ? 1 : $this->props['columns'];
		$Column_list_type = $this->props['list_columns'] == '' ? 1 : $this->props['list_columns'];
		$columns_phone = $this->props['columns_phone'];
		$columns_tablet = $this->props['columns_tablet'];
		$list_columns_phone = $this->props['list_columns_phone'];
		$list_columns_tablet = $this->props['list_columns_tablet'];
		$cover_columns_phone = $this->props['cover_columns_phone'];
		$cover_columns_tablet = $this->props['cover_columns_tablet'];
		$cover_columns = $this->props['cover_columns'] == '' ? 1 : $this->props['cover_columns'];
		$image_align = $this->props['image_align'];
		$button_align = $this->props['button_align'];
		$equal_height = $this->props['equal_height'];
		$cards_spacing = $this->props['cards_spacing'];
		$event_inner_spacing = $this->props['event_inner_spacing'];
		$view_more_text = $this->props['view_more_text'];
		$ajax_load_more_text = $this->props['ajax_load_more_text'];
		$ajax_load_src = $this->props['ajax_load_src'];
		$ical_text = $this->props['ical_text'];
		$google_calendar_text = $this->props['google_calendar_text'];
		$show_pagination = $this->props['show_pagination'];
		$show_recurring_events = $this->props['show_recurring_events'];
		$show_rsvp_feed_respond = $this->props['show_rsvp_feed_respond']; 
		$show_rsvp_feed_left = $this->props['show_rsvp_feed_left']; 
		$show_ticket_feed_respond = $this->props['show_ticket_feed_respond']; 
		$show_ticket_feed_left = $this->props['show_ticket_feed_left']; 
		$recurrence_number = $this->props['recurrence_number'];
		$show_postponed_canceled_event =$this->props['show_postponed_canceled_event'];
		$show_virtual_hybrid_event=$this->props['show_virtual_hybrid_event'];
		$show_hybrid_event = $this->props['show_hybrid_event'];
		$show_virtual_event = $this->props['show_virtual_event'];
		$background_color                = $this->props['background_color'];
		$header_level  =  $this->props['title_level'] == "" ? 'h4' : $this->props['title_level'];
		$show_preposition = $this->props['show_preposition'];
		$event_selection = $this->props['event_selection'] ;
        $related_event_checkbox = $this->props['related_event_checkbox'];
		$pagination_type  = $this->props['pagination_type'];
		$previous_entries_text = $this->props['previous_entries_text'];	
		$next_entries_text = $this->props['next_entries_text'];
		$align            = $this->props['align'];
		$pagination_align   = $this->props['pagination_align'];
		$show_icon_label =  $this->props['show_icon_label'];
		$stack_label_icon = $this->props['stack_label_icon'];
		$show_event_month_heading= $this->props['show_event_month_heading'];
		$show_colon = $this->props['show_colon'];
		$date_selection_type= $this->props['date_selection_type'];
		$event_by_reletive_date=$this->props['event_by_reletive_date'];
		$included_date_range_start= $this->props['included_date_range_start'];
		$included_date_range_end= $this->props['included_date_range_end'];
		$use_overlay        = $this->props['use_overlay'];
		$overlay_class = $use_overlay === 'on' ? ' dec_image_has_overlay' : '';


		if ( ! empty( $this->props['included_organizer']) ) {
			// print_r($this->get_organizer_data_name());
			$value_map              = $this->get_organizer_data_id();
			$this->props['included_organizer'] = $this->process_multiple_checkboxes_field_value( $value_map, $this->props['included_organizer'] );
			$this->props['included_organizer'] =  $this->props['included_organizer'];
		} 
		if ( ! empty( $this->props['included_venue']) ) {
			$value_map              = $this->get_venue_data_id();
			$this->props['included_venue'] = $this->process_multiple_checkboxes_field_value( $value_map, $this->props['included_venue'] );
			$this->props['included_venue'] =  $this->props['included_venue'];
		} 
		if ( ! empty( $this->props['included_series']) ) {
			$value_map              = $this->get_eventSeries_data_id();
			$this->props['included_series'] = $this->process_multiple_checkboxes_field_value( $value_map, $this->props['included_series'] );
			$this->props['included_series'] =  $this->props['included_series'];
		} 
		$included_series= explode("|", $this->props['included_series']);
		$included_series_check=$this->props['included_series'];
		$included_organizer=explode( "|",$this->props['included_organizer']);
		$included_organizer_check=$this->props['included_organizer'];
		$included_venue=explode( "|",$this->props['included_venue']);
		// print_r($included_series);
		//$included_location=explode( "|",$this->props['included_location']);
		//$included_venue=$this->props['included_venue'];
		//$included_venue=array_merge($included_location,$included_venue);
		$included_venue_check=$this->props['included_venue'];
		$paged_pagination_background_color = $this->props["paged_pagination_background_color"];
        $paged_pagination_background_color_responsive_active = isset($this->props["paged_pagination_background_color"]) && et_pb_get_responsive_status($this->props["paged_pagination_background_color_last_edited"]);
        $paged_pagination_background_color_tablet = $paged_pagination_background_color_responsive_active && $this->props["paged_pagination_background_color_tablet"] ? $this->props["paged_pagination_background_color_tablet"] : $paged_pagination_background_color;
        $paged_pagination_background_color_phone =  $paged_pagination_background_color_responsive_active && $this->props["paged_pagination_background_color_phone"] ? $this->props["paged_pagination_background_color_phone"] :  $paged_pagination_background_color_tablet;
		$paged_pagination_background_color__hover         = et_pb_hover_options()->get_value('paged_pagination_background_color', $this->props, '' );
		$paged_pagination_background_color__hover_enabled = et_builder_is_hover_enabled( 'paged_pagination_background_color', $this->props );
		$numeric_pagination_background_color = $this->props["numeric_pagination_background_color"];
        $numeric_pagination_background_color_responsive_active = isset($this->props["numeric_pagination_background_color"]) && et_pb_get_responsive_status($this->props["numeric_pagination_background_color_last_edited"]);
        $numeric_pagination_background_color_tablet = $numeric_pagination_background_color_responsive_active && $this->props["numeric_pagination_background_color_tablet"] ? $this->props["numeric_pagination_background_color_tablet"] : $numeric_pagination_background_color;
        $numeric_pagination_background_color_phone =  $numeric_pagination_background_color_responsive_active && $this->props["numeric_pagination_background_color_phone"] ? $this->props["numeric_pagination_background_color_phone"] :  $numeric_pagination_background_color_tablet;
		$numeric_pagination_text_color = $this->props["numeric_pagination_text_color"];
        $numeric_pagination_text_color_responsive_active = isset($this->props["numeric_pagination_text_color"]) && et_pb_get_responsive_status($this->props["numeric_pagination_text_color_last_edited"]);
        $numeric_pagination_text_color_tablet = $numeric_pagination_text_color_responsive_active && $this->props["numeric_pagination_text_color_tablet"] ? $this->props["numeric_pagination_text_color_tablet"] : $numeric_pagination_text_color;
        $numeric_pagination_text_color_phone =  $numeric_pagination_text_color_responsive_active && $this->props["numeric_pagination_text_color_phone"] ? $this->props["numeric_pagination_text_color_phone"] :  $numeric_pagination_text_color_tablet;
		$numeric_page_background_color = $this->props["numeric_page_background_color"];
        $numeric_page_background_color_responsive_active = isset($this->props["numeric_page_background_color"]) && et_pb_get_responsive_status($this->props["numeric_page_background_color_last_edited"]);
        $numeric_page_background_color_tablet = $numeric_page_background_color_responsive_active && $this->props["numeric_page_background_color_tablet"] ? $this->props["numeric_page_background_color_tablet"] : $numeric_page_background_color;
        $numeric_page_background_color_phone =  $numeric_page_background_color_responsive_active && $this->props["numeric_page_background_color_phone"] ? $this->props["numeric_page_background_color_phone"] :  $numeric_page_background_color_tablet;
		$numeric_page_text_color = $this->props["numeric_page_text_color"];
        $numeric_page_text_color_responsive_active = isset($this->props["numeric_page_text_color"]) && et_pb_get_responsive_status($this->props["numeric_page_text_color_last_edited"]);
        $numeric_page_text_color_tablet = $numeric_page_text_color_responsive_active && $this->props["numeric_page_text_color_tablet"] ? $this->props["numeric_page_text_color_tablet"] : $numeric_page_text_color;
        $numeric_page_text_color_phone =  $numeric_page_text_color_responsive_active && $this->props["numeric_page_text_color_phone"] ? $this->props["numeric_page_text_color_phone"] :  $numeric_page_text_color_tablet;
		$numeric_current_page_background_color = $this->props["numeric_current_page_background_color"];
        $numeric_current_page_background_color_responsive_active = isset($this->props["numeric_current_page_background_color"]) && et_pb_get_responsive_status($this->props["numeric_current_page_background_color_last_edited"]);
        $numeric_current_page_background_color_tablet = $numeric_current_page_background_color_responsive_active && $this->props["numeric_current_page_background_color_tablet"] ? $this->props["numeric_current_page_background_color_tablet"] : $numeric_current_page_background_color;
        $numeric_current_page_background_color_phone =  $numeric_current_page_background_color_responsive_active && $this->props["numeric_current_page_background_color_phone"] ? $this->props["numeric_current_page_background_color_phone"] :  $numeric_current_page_background_color_tablet;
		$numeric_current_page_text_color = $this->props["numeric_current_page_text_color"];
        $numeric_current_page_text_color_responsive_active = isset($this->props["numeric_current_page_text_color"]) && et_pb_get_responsive_status($this->props["numeric_current_page_text_color_last_edited"]);
        $numeric_current_page_text_color_tablet = $numeric_current_page_text_color_responsive_active && $this->props["numeric_current_page_text_color_tablet"] ? $this->props["numeric_current_page_text_color_tablet"] : $numeric_current_page_text_color;
        $numeric_current_page_text_color_phone =  $numeric_current_page_text_color_responsive_active && $this->props["numeric_current_page_text_color_phone"] ? $this->props["numeric_current_page_text_color_phone"] :  $numeric_current_page_text_color_tablet;
		//$included_location_check=$this->props['included_location'];
	
		//print_r($included_organizer_check);
	 	$custom_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'view_more_icon' );
		
		$custom_icon                     = isset( $custom_icon_values['desktop'] ) ? $this->props['view_more_icon'] == '' ? '' : esc_attr( et_pb_process_font_icon( $custom_icon_values['desktop'] ) ) : '';
		$custom_icon_tablet              = isset( $custom_icon_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['tablet'] ) ) : '';
		$custom_icon_phone               = isset( $custom_icon_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['phone'] ) ) : '';
		$custom_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'view_more_icon' );
		$custom_icon_load_values              = et_pb_responsive_options()->get_property_values( $this->props, 'ajax_load_more_button_icon' );
		$custom_icon_load                     = isset( $custom_icon_load_values['desktop'] ) ? $this->props['ajax_load_more_button_icon'] == '' ? '' : esc_attr( et_pb_process_font_icon( $custom_icon_load_values['desktop'] ) ) : '';
		$custom_icon_load_tablet              = isset( $custom_icon_load_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_load_values['tablet'] ) ) : '';
		$custom_icon_load_phone               = isset( $custom_icon_load_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_load_values['phone'] ) ) : '';
		$custom_icon_load_values              = et_pb_responsive_options()->get_property_values( $this->props, 'ajax_load_more_button_icon' );
		
		$background_layout               = '';
		$background_layout_hover         = et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
		$background_layout_hover_enabled = et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
		$use_background_color            = $this->props['use_background_color'];
		$module_class = $this->module_classname( $render_slug );
		$video_background = $this->video_background();
		$parallax_image_background = $this->get_parallax_image_background();
		//$current_page_no = '<script> jQuery(\'.page-numbers\' ).click(function() { jQuery("input[name=\'eventfeed_current_pagination_page\']").val();}); </script>';	
		// $current_page_no = "hello";
		$data_background_layout       = '';
		$data_background_layout_hover = '';
		$thumbnail_width = $this->props['thumbnail_width'];
		$image_aspect_ratio = $this->props['image_aspect_ratio'];
		$stack_columns_on_tablet = $this->props['stack_columns_on_tablet'];

		$hover_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'hover_icon' );
		$hover_icon                     = isset( $hover_icon_values['desktop'] ) ? $this->props['hover_icon'] == '' ? '' : esc_attr( et_pb_process_font_icon( $hover_icon_values['desktop'] ) ) : '';
		$hover_icon_tablet              = isset( $hover_icon_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $hover_icon_values['tablet'] ) ) : '';
		$hover_icon_phone               = isset( $hover_icon_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $hover_icon_values['phone'] ) ) : '';
		$hover_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'hover_icon' );

		if($stack_columns_on_tablet  == 'on'){
			echo "<style>
			@media (max-width: 981px) {
				.decm_event_display .col-md-4,
				.decm_event_display .col-md-2,
				.decm_event_display .col-md-5,
				.decm_event_display .col-md-6 {
					width: 100%;
				}}</style>";
		}

		if ( $background_layout_hover_enabled ) {
			$data_background_layout = sprintf(
				' data-background-layout="%1$s"',
				esc_attr( $background_layout )
			);
			$data_background_layout_hover = sprintf(
				' data-background-layout-hover="%1$s"',
				esc_attr( $background_layout_hover )
			);
		}
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% p.ecs-showdetail ",
            'declaration' => "text-align: {$view_more_alignment} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% p.ecs-showdetail",
            'declaration' => "text-align: {$view_more_alignment_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% p.ecs-showdetail",
            'declaration' => "text-align: {$view_more_alignment_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec_image_overlay:before",
            'declaration' => "color: {$overlay_icon_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec_image_overlay:before",
            'declaration' => "color: {$overlay_icon_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec_image_overlay:before",
            'declaration' => "color: {$overlay_icon_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);


		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-event-pagination",
            'declaration' => "text-align: {$pagination_align} !important;",
        ]);
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_left",
            'declaration' => "background-color: {$numeric_pagination_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-page_alignment_left, %%order_class%% .dec-page-text-first",
            'declaration' => "background-color: {$numeric_pagination_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-page_alignment_left, %%order_class%% .dec-page-text-first",
            'declaration' => "background-color: {$numeric_pagination_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right",
            'declaration' => "background-color: {$paged_pagination_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right",
            'declaration' => "background-color: {$paged_pagination_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right",
            'declaration' => "background-color: {$paged_pagination_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
		if ( $paged_pagination_background_color__hover  != '' && $paged_pagination_background_color__hover_enabled ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .ecs-page_alignment_left:hover,%%order_class%% .ecs-page_alignment_right:hover',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $paged_pagination_background_color__hover )
				),
			) );
		}
		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .dec-page-text-last, %%order_class%% .dec-page-text-first",
            'declaration' => "color: {$numeric_pagination_text_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .dec-page-text-last, %%order_class%% .dec-page-text-first",
            'declaration' => "color: {$numeric_pagination_text_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .dec-page-text-last, %%order_class%% .dec-page-text-first",
            'declaration' => "color: {$numeric_pagination_text_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);


		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-page-numbers",
            'declaration' => "background-color: {$numeric_page_background_color};",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-page-numbers",
            'declaration' => "background-color: {$numeric_page_background_color_tablet};",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-page-numbers",
            'declaration' => "background-color: {$numeric_page_background_color_phone};",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-page-numbers",
            'declaration' => "color: {$numeric_page_text_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-page-numbers",
            'declaration' => "color: {$numeric_page_text_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-page-numbers",
            'declaration' => "color: {$numeric_page_text_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .current",
            'declaration' => "background-color: {$numeric_current_page_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .current",
            'declaration' => "background-color: {$numeric_current_page_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .current",
            'declaration' => "background-color: {$numeric_current_page_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .current",
            'declaration' => "color: {$numeric_current_page_text_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .current",
            'declaration' => "color: {$numeric_current_page_text_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .current",
            'declaration' => "color: {$numeric_current_page_text_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
		if($show_image_overlay == "on" && $show_feature_image == "on"){

			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%% .decm-cover-overlay-details",
				'declaration' => "background-color: {$overlay_image_background_color} !important;",
			]);
	
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%% .decm-cover-overlay-details",
				'declaration' => "background-color: {$overlay_image_background_color_tablet} !important;",
				'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
			]);
	
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%% .decm-cover-overlay-details",
				'declaration' => "background-color: {$overlay_image_background_color_phone} !important;",
				'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
			]);
	
		}
			

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .decm-events-details, %%order_class%% .decm-events-details-cover",
            'declaration' => "background-color: {$details_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .decm-events-details, %%order_class%% .decm-events-details-cover",
            'declaration' => "background-color: {$details_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .decm-events-details, %%order_class%% .decm-events-details-cover",
            'declaration' => "background-color: {$details_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .act-post",
            'declaration' => "background-color: {$open_toggle_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .act-post",
            'declaration' => "background-color: {$open_toggle_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .act-post",
            'declaration' => "background-color: {$open_toggle_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);


		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec_image_overlay",
            'declaration' => "background-color: {$hover_overlay_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec_image_overlay",
            'declaration' => "background-color: {$hover_overlay_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .dec_image_overlay",
            'declaration' => "background-color: {$hover_overlay_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

	
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-events-list-separator-month",
            'declaration' => "background-color: {$month_sep_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-events-list-separator-month",
            'declaration' => "background-color: {$month_sep_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-events-list-separator-month",
            'declaration' => "background-color: {$month_sep_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);


		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-event-list .ecs-event .act-post .ecs_event_feed_image",
            'declaration' => "aspect-ratio: {$image_aspect_ratio} !important; object-fit: cover !important;",
        ]);


		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list, %%order_class%%  .callout-box-list-on-Image",
            'declaration' => "background-color: {$callout_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list, %%order_class%%  .callout-box-list-on-Image",
            'declaration' => "background-color: {$callout_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list, %%order_class%%  .callout-box-list-on-Image",
            'declaration' => "background-color: {$callout_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
		
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% span.decm_weburl a, %%order_class%% .ecs-categories a, %%order_class%% span.decm_tag  a, %%order_class%% .decm_series_name a , %%order_class%% .price_link_custom , %%order_class%% .price_link_custom__a , %%order_class%% .show_rsvp_feed_custom, %%order_class%% .price_link_ticket",
            'declaration' => "color: {$details_link_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% span decm_weburl a, %%order_class%% .ecs-categories a, %%order_class%% span.decm_tag a, %%order_class%% .decm_series_name a , %%order_class%% .price_link_custom , %%order_class%% .price_link_custom__a , %%order_class%% .show_rsvp_feed_custom, %%order_class%% .price_link_ticket",
            'declaration' => "color: {$details_link_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% span.decm_weburl a, %%order_class%% .ecs-categories a, %%order_class%% span.decm_tag  a, %%order_class%% .decm_series_name a , %%order_class%% .price_link_custom , %%order_class%% .price_link_custom__a , %%order_class%% .show_rsvp_feed_custom, %%order_class%% .price_link_ticket",
            'declaration' => "color: {$details_link_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,  %%order_class%% .tags-ecs-icon:before, %%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .dief-events-series-relationship-single-marker__icon:before",
            'declaration' => "color: {$details_icon_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,  %%order_class%% .tags-ecs-icon:before, %%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .dief-events-series-relationship-single-marker__icon:before",
            'declaration' => "color: {$details_icon_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before, %%order_class%% .tags-ecs-icon:before, %%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .dief-events-series-relationship-single-marker__icon:before",
            'declaration' => "color: {$details_icon_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,  %%order_class%% .tags-ecs-icon:before, %%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .dief-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,  %%order_class%% .tags-ecs-icon:before, %%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .dief-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before, %%order_class%% .tags-ecs-icon:before, %%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .dief-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);
		if ( '' !== $details_icon_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before, %%order_class%% .dief-events-series-relationship-single-marker__icon:before",
				'declaration' => sprintf(
					'color: %1$s;',
					esc_html( $details_icon_color )
				),
			) );
		}

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-detail-label",
            'declaration' => "color: {$details_label_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .ecs-detail-label",
            'declaration' => "color: {$details_label_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs-detail-label",
            'declaration' => "color: {$details_label_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		// Responsive Margin Tablet
		if ('' !== $this->props['cards_spacing_tablet'] && '|||' !== $this->props['cards_spacing_tablet']) {
			ET_Builder_Element::set_style($render_slug, array(
			  'selector'    => '%%order_class%% .act-post',
			  'declaration' => sprintf(
				' margin-right: %2$s !important; margin-left: %4$s !important;',
		
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'top', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'right', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'bottom', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'left', '0px'))
			  ),
			  'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
			ET_Builder_Element::set_style($render_slug, array(
				'selector'    => '%%order_class%% .ecs-event',
				'declaration' => sprintf(
				  'margin-top: %1$s !important;  margin-bottom: %3$s !important;',
		  
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'top', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'right', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'bottom', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_tablet'], 'left', '0px'))
				),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			  ));
		  }
		  // Responsive Margin Phone
		if ('' !== $this->props['cards_spacing_phone'] && '|||' !== $this->props['cards_spacing_phone']) {
			ET_Builder_Element::set_style($render_slug, array(
			  'selector'    => '%%order_class%% .act-post',
			  'declaration' => sprintf(
				' margin-right: %2$s !important; margin-left: %4$s !important;',
		
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'top', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'right', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'bottom', '0px')),
				esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'left', '0px'))
			  ),
			  'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
			ET_Builder_Element::set_style($render_slug, array(
				'selector'    => '%%order_class%% .ecs-event',
				'declaration' => sprintf(
				  'margin-top: %1$s !important;  margin-bottom: %3$s !important;',
		  
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'top', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'right', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'bottom', '0px')),
				  esc_attr(et_pb_get_spacing($this->props['cards_spacing_phone'], 'left', '0px'))
				),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			  ));
		  }


		//Margin & Padding
		$this->apply_custom_margin_padding($render_slug, 'cards_spacing', 'margin', 
		'%%order_class%% .ecs-event');
		$this->apply_custom_margin_padding($render_slug, 'month_margin', 'margin', 
		'%%order_class%% .ecs-events-list-separator-month');
		$this->apply_custom_margin_padding($render_slug, 'month_padding', 'padding', 
		'%%order_class%% .ecs-events-list-separator-month');
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_margin', 'margin', 
		'%%order_class%% .dec-image-overlay-url');
		// $this->apply_custom_margin_padding($render_slug, 'thumbnail_margin', 'margin', 
		// '%%order_class%% img.wp-post-image');
		$this->apply_custom_margin_padding($render_slug, 'details_margin', 'margin', 
		'%%order_class%% .decm-events-details');
		$this->apply_custom_margin_padding($render_slug, 'details_margin_overlay', 'padding', 
		'%%order_class%%  .decm-cover-overlay-details');	
		$this->apply_custom_margin_padding($render_slug, 'callout_margin', 'margin', 
		'%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list, %%order_class%%  .callout-box-list-on-Image');
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_padding', 'padding', 
		'%%order_class%% img.wp-post-image', false);
		$this->apply_custom_margin_padding($render_slug, 'details_padding', 'padding', 
		'%%order_class%% .decm-events-details', false);
		$this->apply_custom_margin_padding($render_slug, 'details_padding_overlay', 'padding', 
		'%%order_class%%  .decm-events-details-cover', false);		
		$this->apply_custom_margin_padding($render_slug, 'callout_padding', 'padding', 
		'%%order_class%% .callout-box-grid, %%order_class%%  .callout-box-cover, %%order_class%%  .callout-box-list, %%order_class%%  .callout-box-list-on-Image', false);
		$this->apply_custom_width($render_slug, 'thumbnail_width', 'width', 
		'%%order_class%% img.wp-post-image, %%order_class%% .dec-image-overlay-url');
		$this->apply_custom_margin_padding($render_slug, 'event_inner_spacing', 'padding', 
		"{$this->main_css_element} .ecs-event-list  .ecs-event .act-post .row");
		$this->apply_custom_margin_padding($render_slug, 'numeric_padding', 'padding', 
		'%%order_class%%  .ecs-page-numbers, %%order_class%% .current, %%order_class%% .dec-page-text-first');
		$this->apply_custom_margin_padding($render_slug, 'paged_margin', 'margin', 
		"%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right");
		$this->apply_custom_margin_padding($render_slug, 'paged_padding', 'padding', 
		"%%order_class%% .ecs-page_alignment_left, %%order_class%% .ecs-page_alignment_right");	
		// Module classnames
		$this->add_classname( array(
			"et_pb_bg_layout_{$background_layout}",
			$this->get_text_orientation_classname(),
		) );
		if ( 'on' !== $use_background_color ) {
			$this->add_classname( 'et_pb_no_bg' );
		}

		$attr = (array)null;
		if ( $use_shortcode === 'on' ) {
			parse_str(strtr($shortcode_param, ' ', '&'), $attr);
		} else {
				
			$contentorder = 'title, title2, event_series_name, date, venue, location, organizer, price, show_rsvp_feed, show_price_ticket, categories, tags, weburl,excerpt,showcalendar,showical,showdetail';
		//echo $this->props['layout'];
			if( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutleftimage_rightdetailButton'){
				$contentorder = 'callout,thumbnail,'.$contentorder.',button';
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutimage_rightdetailButton'){
				$contentorder = 'thumbnail,'.$contentorder.',button';
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutimage_rightdetail'){
				$contentorder = 'thumbnail,'.$contentorder;
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'leftimage_rightdetail'){
				$contentorder = 'thumbnail,'.$contentorder;
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'rightimage_leftdetail'){
				$contentorder .= ',thumbnail';
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutleftimage_rightdetail'){
				$contentorder = 'callout,thumbnail,'.$contentorder;
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutrightimage_leftdetail'){
				$contentorder = 'callout,'.$contentorder.',thumbnail';
			}elseif( $this->props['layout'] == 'list' && $this->props['list_layout'] == 'calloutrightimage_leftdetailButton'){
				$contentorder = 'callout,'.$contentorder.',thumbnail,button';
			}else{
				$contentorder = 'thumbnail,'.$contentorder;
			}


			if($this->props['related_event_checkbox'] == 'related_event_by_series'){
				global $post;
				$url = $post->guid;	
				preg_match("/&?p=([^&]+)/", $url, $matches);
			//  $series_id = $matches[1]; 
				if(!empty($matches[1])){
					$series_id_ajax = tec_event_series($matches[1])->ID;
				}else{
					$series_id_ajax = tec_event_series($event_id)->ID;
				}
				}else{
					$series_id_ajax = get_the_ID();
				}
			
			//echo $image_align.'t';
			$attr = array(
				'cat' => $included_categories,
				'tag' => $included_tags,
				'month' => '',
				'previous_entries_text' => $previous_entries_text,
				'next_entries_text' => $next_entries_text,
				'limit' => $event_count,
				'events_to_load' => $events_to_load,
				'eventdetails' => $show_date == 'on' ? 'true' : 'false',
				'show_cdn_link'=>$show_cdn_link=="on"?'true':'false',
				'shorten_multidate'=>$shorten_multidate=="on"?'true':'false',
				'start_date_format'=>$start_date_format,
				'enable_series_link'=>($enable_series_link == 'on' ? 'true':'false'),
				'custom_series_link_target' => $custom_series_link_target,
				'showtime' => $show_time == 'on' ? 'true' : 'false',
				'show_end_time'=>$show_end_time == 'on'?'true':'false',
				'show_end_date'=>$show_end_date == 'on'?'true':'false',
				'show_timezone' =>$show_timezone == 'on' ? 'true' : 'false',
				'show_timezone_abb' =>$show_timezone_abb == 'on' ? 'true' : 'false',
				'show_pagination'=> $show_pagination == 'on' ? 'true' : 'false',
				'show_recurring_events'=> $show_recurring_events,
				'recurrence_number'=>$recurrence_number,
				'show_postponed_canceled_event'=>$show_postponed_canceled_event== 'on' ? 'true' : 'false',
				'show_virtual_hybrid_event'=> $show_virtual_hybrid_event=='on'?'true':'false',
				'show_hybrid_event'=> $show_hybrid_event=='on'?'true':'false',
				'show_virtual_event'=> $show_virtual_event=='on'?'true':'false',
				'showtitle' => $show_title == 'on' ? 'true' : 'false',
				'enable_organizer_link'=>($enable_organizer_link == 'on' ? 'true':'false'),
				'enable_venue_link'=>($enable_venue_link == 'on' ? 'true':'false'),
				'disable_event_title_link'=>($disable_event_title_link=='on'?'true':'false'),
				'enable_category_links'=> ($enable_category_links=='on'?'true':'false'),			
				'custom_category_link_target' => $custom_category_link_target,
				'enable_tag_links'=> ($enable_tag_links=='on'?'true':'false'),			
				'custom_tag_link_target' => $custom_tag_link_target,
				'disable_event_image_link'=>($disable_event_image_link=='on'?'true':'false'),
				'disable_event_button_link'=>($disable_event_button_link=='on'?'true':'false'),
				'custom_event_link_url'=> $custom_event_link_url,
				'single_event_page_link' => $single_event_page_link,
				'custom_event_link_target'=>$custom_event_link_target,
				'whole_event_clickable'=>$whole_event_clickable=="on"?'true':'false',
				'custom_organizer_link_target' => $custom_organizer_link_target,
				'custom_venue_link_target' => $custom_venue_link_target,
				'show_callout_box' => $decm_show_callout_box == 'on' ? 'true' : 'false',
				'button_make_fullwidth' => $this->props['button_make_fullwidth'],
				'featured_events' => $featured_events == 'on' ? 'true' : 'false',
				'show_callout_date' => $decm_show_callout_date == 'on' ? 'true' : 'false',
				'show_callout_date_range' => $decm_show_callout_date_range == 'on' ? 'true' : 'false',
				'callout_date_format'=> $decm_callout_date_format,
				'show_callout_time' => $decm_show_callout_time == 'on' ? 'true' : 'false',
				'show_callout_time_range' => $decm_show_callout_time_range == 'on' ? 'true' : 'false',
				'callout_time_format'=> $decm_callout_time_format,
				'show_callout_month' => $decm_show_callout_month == 'on' ? 'true' : 'false',
				'show_callout_month_range' => $decm_show_callout_month_range == 'on' ? 'true' : 'false',
				'callout_month_format'=>$decm_callout_month_format,
				'show_callout_day_of_week' => $decm_show_callout_day_of_week == 'on' ? 'true' : 'false',
				'show_callout_day_of_week_range' => $decm_show_callout_day_of_week_range == 'on' ? 'true' : 'false',
				'callout_week_format'=> $decm_callout_week_format,
				'show_callout_year' => $decm_show_callout_year == 'on' ? 'true' : 'false',
				'show_callout_year_range' => $decm_show_callout_year_range == 'on' ? 'true' : 'false',
				'callout_year_format'=>$decm_callout_year_format,
				'time' => null,
				'past' => $show_past,
				//'featured_events' => $featured_events == 'on' ? 'true' : 'false',	
				'event_series_name' => $event_series_name =='on'? 'true':'false',
				'event_series_label' => $event_series_label,
				'venue' => ($show_venue === 'on' ? 'true' : 'false'),
				'location' => ($show_location === 'on' ? 'true' : 'false'),
				'location_street_address' => ($dec_show_location_street_address === 'on' ? 'true' : 'false'),
				'location_locality' => ($dec_show_location_locality === 'on' ? 'true' : 'false'),
				'show_location_state'=>($dec_show_location_state=="on"?'true':'false'),
				'location_postal_code' => ($dec_show_location_postal_code === 'on' ? 'true' : 'false'),
				'location_country' => ($dec_show_location_country === 'on' ? 'true' : 'false'),
				'location_street_comma' => ($dec_show_location_street_comma === 'on' ? 'true' : 'false'),
				'location_locality_comma' => ($dec_show_location_locality_comma === 'on' ? 'true' : 'false'),
				'show_location_state_comma'=>($dec_show_location_state_comma=="on"?'true':'false'),
				'location_postal_code_comma' => ($dec_show_location_postal_code_comma === 'on' ? 'true' : 'false'),
				'location_country_comma' => ($dec_show_location_country_comma === 'on' ? 'true' : 'false'),
				'show_postal_code_before_locality'=> ($show_postal_code_before_locality==='on'?'true':'false'),
				'organizer' => $show_name == 'on' ? 'true' : 'false',
				'price' => $show_price == 'on' ? 'true' : 'false',
				'show_price_ticket' => $show_price_ticket == 'on' ? 'true' : 'false',
				'show_rsvp_feed' => $show_rsvp_feed == 'on' ? 'true' : 'false',
				'show_rsvp_feed_respond' => $show_rsvp_feed_respond == 'on' ? 'true' : 'false',
				'show_rsvp_feed_left' => $show_rsvp_feed_left == 'on' ? 'true' : 'false',
				'show_ticket_feed_respond' => $show_ticket_feed_respond == 'on' ? 'true' : 'false',
				'show_ticket_feed_left' => $show_ticket_feed_left == 'on' ? 'true' : 'false',
				'weburl' => $show_weburl == 'on' ? 'true' : 'false',
				'website_link'=> $website_link,
				'custom_website_link_text'=>$custom_website_link_text,
				'custom_website_link_target'=>$custom_website_link_target,
				'categories' => $show_category == 'on' ? 'true' : 'false',
				'category_detail_label' => $category_detail_label,
				'time_detail_label' => $time_detail_label,
				'date_detail_label' => $date_detail_label,
				'venue_detail_label' => $venue_detail_label,
				'location_detail_label' => $location_detail_label,
				'organizer_detail_label' => $organizer_detail_label,
				'price_detail_label' => $price_detail_label,
				'price_ticket_label' => $price_ticket_label,
				'rsvp_detail_label' => $rsvp_detail_label,
				'tag_detail_label' => $tag_detail_label,
				'website_detail_label'  => $website_detail_label,
				'hide_comma_cat' => $hide_comma_cat == 'on' ? 'true' : 'false',
				'tags' => $show_tag == 'on' ? 'true' : 'false',
				'hide_comma_tag' => $hide_comma_tag == 'on' ? 'true' : 'false',
				'button_align' => ($button_align === 'on' ? 'true' : 'false'),
				'show_data_one_line' => ($show_data_one_line=== 'on' ? 'true' : 'false'),
				'show_preposition' => ($show_preposition=== 'on' ? 'true' : 'false'),
				'show_ical_export'=>($show_ical_export == 'on'?'true':'false'),
				'show_google_calendar'=>($show_google_calendar=='on'?'true':'false'),
				'stack_label_icon'=> ($stack_label_icon=='on'?'true':'false'),
				'show_event_month_heading'=>($show_event_month_heading=="on"?'true':'false'),
				'show_colon'=>($show_colon=='on'?'true':'false'),
				'schema' => 'true',
				'message' => $no_results_message,
				'key' => 'End Date',
				'order' => $event_order,
				'orderby' => 'meta_value',
				'viewall' => 'false',
				'excerpt' => ($show_excerpt === 'on' ? 
							($excerpt_length ? $excerpt_length : 'true' ):
							'false'),
				'excerpt_content'=>$excerpt_content,
				'showdetail' => ($show_detail === 'on' ? 'true' : 'false'),
				'thumb' => ($show_feature_image === 'on' ? 'true' : 'false'),
				'thumbsize' => $thumbnail_width,
				'image_aspect_ratio'=>$image_aspect_ratio,
				'thumbwidth' => '800',
				'thumbheight' => '800',
				'contentorder' => apply_filters( 'decm_details_order', $contentorder, $atts ),
				'event_tax' => '',
				'blog_offset' => $blog_offset,
				'cut_off_start_date'=>$cut_off_start_date,
				'cut_off_end_date'=>$cut_off_end_date,
				'event_past_future_cut_off'=>$event_past_future_cut_off,
				'cutoff_ongoing_events'=>$cutoff_ongoing_events,
				'dateformat' => $date_format,
				'timeformat' => $time_format, 
				'list_columns' => $Column_list_type,
				'cover_columns' => $cover_columns,
				'layout' => $layout,
				'list_layout' => $list_layout,	
				'columns' => $Column_Type,
				'columns_phone' => $columns_phone,
				'columns_tablet' => $columns_tablet,
				'list_columns_phone' => $list_columns_phone,
				'list_columns_tablet' => $list_columns_tablet,
				'cover_columns_phone' => $cover_columns_phone,
				'cover_columns_tablet' => $cover_columns_tablet,
				'cards_spacing' => $cards_spacing,
				'image_align' => $image_align,
				'button_align'=>$button_align,
				'event_inner_spacing' => $event_inner_spacing,
				'view_more_text' => $view_more_text,
				'ajax_load_more_text'=>$ajax_load_more_text,
				'datetime_separator' => $datetime_separator,
				'time_range_separator' => $time_range_separator,
				'google_calendar_text'=>$google_calendar_text,
				'ical_text'          =>$ical_text,
				'open_toggle_background_color' =>  $open_toggle_background_color,
				'details_link_color' =>  $details_link_color,
				'details_icon_color' =>  $details_icon_color,
				'details_label_color' =>  $details_label_color,
				'included_categories' => $included_categories,
				'included_tags'  => $included_tags,
				'included_organizer' => $included_organizer,
				'included_organizer_check' => $included_organizer_check,
				'included_venue' => $included_venue,
				'included_venue_check' => $included_venue_check,
				'included_series' => $included_series,
				'included_series_check' => $included_series_check,
				'date_selection_type'=> $date_selection_type,
				'event_by_reletive_date'=>$event_by_reletive_date,
				'included_date_range_start'=> $included_date_range_start,
				'included_date_range_end'=> $included_date_range_end,
				'header_level'  => $header_level,
				'custom_icon'         => $custom_icon,
				'event_selection' => $event_selection,
                'related_event_checkbox' => $related_event_checkbox,
                //'custom_icon' => $custom_icon,
				'custom_icon_tablet' => $custom_icon_tablet,
				'custom_icon_phone' => $custom_icon_phone,
				'ajax_load_more_button_icon' => $custom_icon_load,
				'ajax_load_more_button_icon_tablet' => $custom_icon_load_tablet,
				'ajax_load_more_button_icon_phone' => $custom_icon_load_phone,
				'custom_view_more' => $this->props['custom_view_more'],
				'view_more_on_hover'=>$this->props['view_more_on_hover'],
				'custom_ajax_load_more_button' => $this->props['custom_ajax_load_more_button'],
				'ajax_load_more_button_on_hover'=> $this->props['ajax_load_more_button_on_hover'],
				'view_more_icon_placement'   =>$this->props['view_more_icon_placement'],
				'ajax_load_more_button_icon_placement'=>$this->props['ajax_load_more_button_icon_placement'],
				'pagination_type' => $pagination_type,
				'align'           => $align,
				'pagination_align' => $pagination_align,
				'show_icon_label'=> $show_icon_label,
				'module_css_class'=> $this->props['module_css_class'],
				'overlay_class'=> $overlay_class,	
				'hover_icon'         => $hover_icon,
				'hover_icon_tablet' => $hover_icon_tablet,
				'hover_icon_phone' => $hover_icon_phone,
				'getPostID' => $series_id_ajax,
			);
		
	}

	
		wp_enqueue_style('bootstrap_style',EVENT_DIR.'assets/css/bootstrap.min.css');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion

		$customCss='<style>';

		
		$renderClassName = $this->getrenderClassNameSelector($this->module_classname( $render_slug ),$render_slug);

		$setHeightFree = '
		jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').css(\'height\',\'100%\');
		jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',\'100%\');
		jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"unset","width":"auto" });
		';
		
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			$agentBrowser =sanitize_key( wp_unslash( $_SERVER['HTTP_USER_AGENT']));
		}

		if(strlen(strstr($agentBrowser,"safari")) > 0 ){      
			$customCss .= '.row_equal{ display: flex;display: -webkit-flex; flex-wrap: wrap}';
		}

		if(strlen(strstr($agentBrowser,"chrome")) > 0){      
		
			$customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
		}
		if(strlen(strstr($agentBrowser,"firefox")) > 0){      
		
			$customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
		}
		if($whole_event_clickable=='on'){
			$customCss .= '.decm_event_display .ecs-event .act-post a:after {position: absolute;display: block;content: "";width: 100%;height: 100%;left: 0;top: 0;}  .decm_event_display .ecs-event .act-post:hover {cursor: pointer;}';
		}
		// if($image_aspect_ratio!=""){
		// 	$customCss .= '.decm_event_display .ecs-event-list .ecs-event .act-post .ecs_event_feed_image {aspect-ratio:'.$image_aspect_ratio.' !important;object-fit: cover !important;}';
		// }
		$Addlinebreak =  ' ';
		$AddButtonBottom =  '';

		if($button_align == 'on' && $this->props['equal_height'] == 'off'  && $layout == "cover"  ){
			$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"bottom":"10px","width":"100%" });';
		}else if($button_align == 'on')
		{
		if($layout == "grid"){
				if($Column_Type == 4)
			$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"89.5%" });';
			else if($Column_Type == 3 ){
				$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"92%" });';	
			} else if($Column_Type == 2 ){
			 $AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"94.7%" });';
			}
			}else if($layout == "cover"){
				if($cover_columns == 4)
			$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"77.5%" });';
			else if($cover_columns == 3 ){
				$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"83%" });';	
			} else if($cover_columns == 2 ){
				$AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"87.7%" });';
			}
			
			}	
		}
		$customCss.='</style>';
		
		$AddCustomHeight = '';

		
		if(($Column_list_type == 2 || $Column_list_type == 1) && $layout == "list" )
		{
			if($image_align == 'leftimage_rightdetail' ||  $list_layout == 'calloutleftimage_rightdetailButton' || $list_layout != 'calloutleftimage_rightdetail' || $list_layout != 'calloutrightimage_leftdetail' || $list_layout != 'calloutrightimage_leftdetailButton' )
			$AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',"auto");';
			else
			$AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').css(\'height\',"auto");';
		}
		else
		{
			if($show_feature_image == 'on')
			{
				if($layout == "cover"){
					
					if($this->props['equal_height'] == 'on' && $button_align == 'on'){
						$AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\'  .decm-cover-overlay-details\').css(\'height\',overlay_height);';
				//		$AddCustomHeight .= 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row >  div > div:last-child\').css(\'height\',overlay_height);';						
					}elseif($this->props['equal_height'] == 'on'){
						$AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .decm-cover-overlay-details\').css(\'height\',overlay_height);';
						//$AddCustomHeight .= 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row >  div > div:last-child\').css(\'height\',overlay_height);';
					}else{
						$AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div > div > div:last-child\').css(\'height\',"auto");';
						$AddCustomHeight .= 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row >  div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row >  div > div:last-child\').css(\'height\',"auto");';
					}
					
				}else{

					if($button_align == 'on' ){
					    $AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';
					    $AddCustomHeight .= 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div > div:last-child\').css(\'height\',tempHeight);';	
					}else{
						//$AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';
					    $AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div > div:last-child\').css(\'height\',"auto");';	
					}
					
				}
						
			}
			else 
			{
				$AddCustomHeight = 'var tempHeight = parseInt(column_height);jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';	
					
			}

		}
		//$_REQUEST['s']="";
		$categslug="";
		$categId="";
		global $wp_query;
		$cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
		// $categslug = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->slug:"";
        // $categId = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->term_id:"";
		$categslug = isset($cat_slug) && $cat_slug !=""&& ($cat_slug->name!="tribe_events" && $cat_slug->name!="product" ) ?$cat_slug->slug:"";
        $categId = isset($cat_slug) && $cat_slug !=""&& ($cat_slug->name!="tribe_events" && $cat_slug->name!="product" ) ?$cat_slug->term_id:"";
		$event_id = get_the_ID();
		$venue_page_id=tribe_get_venue_id(get_the_ID());
		$organizer_page_id=tribe_get_organizer_id(get_the_ID());
		$term_id = array();
		$getEventCat = get_the_terms( get_the_ID(), 'tribe_events_cat' ); 

		$term_id_tag = array();

		$tag_event = get_the_terms(get_the_ID(), 'post_tag' );
		if($tag_event != ""){
			foreach ((array) $tag_event as $key => $eventTagInfo ) {
				$term_id_tag[$key] = $eventTagInfo->term_id;
			}
		}

		
		if($getEventCat != ""){
			foreach ((array) $getEventCat as $key => $eventInfo ) {
				$term_id[$key] = $eventInfo->term_id;
		   }
		}
		
		
	    $term_id = json_encode($term_id);  //phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode
		$term_id_tag = json_encode($term_id_tag); //phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode

		// echo $show_cdn_link;
		// print_r($show_cdn_link);
	if($show_cdn_link=="off"){
		wp_enqueue_style( 'dec-date-picker-style', 'https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css' );//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_style('cost-silder','https://code.jquery.com/ui/1.13.2/themes/hot-sneaks/jquery-ui.css');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_script( 'date-range-picker-js','https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'date-range-2-js','https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'cost-picker-js', 'https://code.jquery.com/ui/1.13.2/jquery-ui.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'loadfilter-js', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.8.23/js/loadFilter.js');		//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_register_script( 'loadmore', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.8.17.3/js/EventFeed/loadmore.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		  //  wp_register_script( 'loadmore', plugins_url().'/divi-event-calendar-module/includes/modules/EventDisplay/loadmore.js');
	}

	if($show_cdn_link=="on"){
		wp_enqueue_style( 'dec-date-picker-style', plugins_url().'/divi-event-calendar-module/includes/packages/daterangepicker.min.css' );//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_style('cost-silder',plugins_url().'/divi-event-calendar-module/includes/packages/jquery-ui.min.css');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
		wp_enqueue_script( 'date-range-picker-js',plugins_url().'/divi-event-calendar-module/includes/packages/moment.min.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'date-range-2-js',plugins_url().'/divi-event-calendar-module/includes/packages/daterangepicker.min.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'cost-picker-2-js', plugins_url().'/divi-event-calendar-module/includes/packages/jquery-ui.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script( 'loadfilter-js', plugins_url().'/divi-event-calendar-module/includes/packages/loadFilter.js');		//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_register_script( 'loadmore', plugins_url().'/divi-event-calendar-module/includes/packages/loadmore.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
	}

	//  wp_enqueue_script( 'loadfilter-js', plugins_url().'/divi-event-calendar-module/includes/modules/EventFilter/loadfilter.js');
	
		global $script_data_array;
        $event_id_realted = $this->get_the_ID();
		$script_data_array = array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
			'atts'=> $attr,
			'categId'=>$categId,
			'categslug'=>$categslug,
			'term_id' => $term_id,
			'venue_page_id'=>$venue_page_id,
            'event_id_realted'=>$event_id_realted,
			'organizer_page_id'=> $organizer_page_id,
			'term_id_tag'=> $term_id_tag,
			'pagination_type'=>$pagination_type,
			'class_pagination' => $renderClassName,	
			'module_css_class' => $this->props['module_css_class'],			
		);

		$moduleClassName = $this->props['module_css_class'] != "" ? ' '.$this->props['module_css_class']: $renderClassName;

		//echo $renderClassName;
//		exit;	
		wp_localize_script( 'loadmore', 'eventFeed'.substr($moduleClassName,1,strlen($moduleClassName)), $script_data_array );
	//	wp_enqueue_script( 'loadmore', plugins_url().'/divi-event-calendar-module/includes/modules/EventDisplay/loadmore.js');	
	if($show_cdn_link=="on"){
		wp_enqueue_script( 'loadmore', plugins_url().'/divi-event-calendar-module/includes/packages/loadmore.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
	}
	if($show_cdn_link=="off"){
		wp_enqueue_script( 'loadmore', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.7.2/js/EventFeed/loadmore.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
	}
	
	$selectedColumns = ($layout === "cover") ? $cover_columns : $Column_Type;

		return sprintf( '
				%9$s<div%2$s class="%4$s %5$s">
					%6$s
					%7$s
					<div class= "">
						%1$s
					</div>
				</div>
				<script>

				
				jQuery(document).ready(function($) {


					$(\'.ecs-event-pagination\').on("click", "a", function () {
						event.preventDefault();
						$(\'#eventfeed_current_pagination_page\').val();
						$("input[name=\'eventfeed_current_pagination_page\']").val($(this).attr("pn"));
						setTimeout(() => {
							checkImagesLoad();
						}, 2000); 
					});	    	
	
					$(\'%13$s\').addClass("%15$s");
				
			

			var setHeightColumns = function(){ 
				var column_loop_row = 0;
				var column_height = 0;
				var overlay_height = 0;
				var ids = [];
				var total_Count = 0;
				var total_Events = jQuery(\'%13$s .ecs-event-posts\').length; 
				jQuery(\'%13$s .ecs-event-posts\').each(function(){
				++column_loop_row;
				++total_Count;
				var Event_id = jQuery(this).children(\'article\')[0].id;
				ids.push(Event_id);
				column_height = jQuery(this).find(\'#\'+Event_id).children(\'.row\').height() >= column_height ? jQuery(this).find(\'#\'+Event_id).children(\'.row\').height() : column_height;
				overlay_height =
				jQuery(this).find(\'.decm-cover-overlay-details\').height() >= overlay_height ? jQuery(this).find(\'.decm-cover-image-overlay\').height() : overlay_height;
				if(column_loop_row == %8$s || total_Count == total_Events)
				{     
					ids.map(function(id,index){
						%10$s
						
					});  
					column_loop_row = 0;
					column_height = 0;
					ids = [];
				}
				});
				%11$s
			}
		var checkImagesLoad = function(){
		
		
		Promise.all(
			Array.from(jQuery("'.$renderClassName.' .ecs-event-posts img")).
				filter(img => !img.complete).
				map(img => new Promise(resolve => {
						img.onload = img.onerror = resolve; 
					}))).then(() => {
						setHeightColumns();
					});
					
				/*var imgs  = jQuery(".decm_event_display_0_tb_body .ecs-event-posts img"),
				len = imgs.length,
				counter = 0;
				[].forEach.call( imgs, function( img ) {
					if(img.complete)
					  incrementCounter();
					else
					  img.addEventListener( "load", incrementCounter, false );
				} );

				function incrementCounter() {
					counter++;
					if ( counter === len ) {
						debugger;
						setHeightColumns();
					}
				}*/
			}
			
			setTimeout(checkImagesLoad, 2000);
			jQuery(window).on(\'resize\',function(){
				var screenWidth = jQuery(this).width();


				if(screenWidth > 1199){
					
					if(document.readyState == \'complete\')
					 checkImagesLoad();
				}
				else{
					jQuery(\'%13$s .ecs-event-posts\').each(function(){
						var id = jQuery(this).children(\'article\')[0].id;
						%14$s
						});
				}

			});	

		});	
			</script>
				
			'				
			, $this->decm_events_calender_gets( $attr ,$render_slug)
			, $this->module_id()
			, $this->module_classname( $render_slug )
			, et_core_esc_previously( $data_background_layout )
			, et_core_esc_previously( $data_background_layout_hover )
			, $parallax_image_background
			, $video_background
			, $selectedColumns
			, $customCss
			, $AddCustomHeight
			, $AddButtonBottom
			, $Addlinebreak
			, $renderClassName
			, $setHeightFree
			, $this->props['module_css_class']
		);
	}

	/**
	 * Fetch and return required events.
	 * @param  array $atts 	shortcode attributes
	 * @return string 	shortcode output
	 */

	
		public function decm_events_calender_gets( $atts, $render_slug, $conditional_tags = array(), $current_page = array() ) {
			global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content,$wpdb;
			$post_type = get_post_type();
			$query_args['paged'] = $paged;
		
			//$page_hide_other_content        = $this->props['hide_other_content']==="on"?'<script> jQuery(window).on(\'load\', function() { jQuery(\'.'.$this->props['use_custom_class_show_hide'].'\').hide();})</script>':"";

		/**
		 * Check if events calendar plugin method exists
		 */
		if ( !function_exists( 'tribe_get_events' ) ) {
			return '\'The Events Calendar\' plugin should exist';
		}

		
		$output = '';
		// $overlay_output = ET_Builder_Module_Helper_Overlay::render(
		// 	array(
		// 		'icon'        =>  $atts['icon'],
		// 		'icon_tablet' => $atts['icon_tablet'],
		// 		'icon_phone'  => $atts['icon_phone'],
		// 		//'icon_sticky' => $hover_icon_sticky,
		// 	)
		// );

		// $output = $filter_output;
	
$custom_icon='';
$custom_icon_load='';
$hover_icon = '';
		$atts = shortcode_atts( apply_filters( 'decm_events_atts', array(
			'show_data_one_line'=> 'false',
			'previous_entries_text' => '',
			'next_entries_text' => '',
			'cat' => '',
			'month' => '',
			'limit' => 6,
			'events_to_load' => '',
			'show_callout_box' => 'true',
			'button_make_fullwidth' => 'true',
			'featured_events' => 'ture',
			'disable_event_title_link'=>'true',
			'disable_event_image_link'=>'true',
			'enable_category_links' => 'true',
			'custom_category_link_target' =>'',
			'enable_tag_links' => 'true',
			'custom_tag_link_target' => '',
			'enable_organizer_link'=>'true',
			'enable_venue_link'=>'true',
			'disable_event_button_link'=>'true',
			'single_event_page_link' => '',
			'custom_event_link_url'=>'',
			'custom_event_link_target'=>'',
			'whole_event_clickable'=>"",
			'custom_organizer_link_target' => '',
			'custom_venue_link_target' => '',
			'show_callout_date' => 'true',
			'show_callout_date_range' => 'true',
			'callout_date_format'=>"",
			'show_callout_time' => 'true',
			'show_callout_time_range' => 'true',
			'callout_time_format'=>"",
			'show_callout_month' => 'true',		
			'show_callout_month_range' => 'true',	
			'callout_month_format'=>"",
			'show_callout_year' => 'true',	
			'show_callout_year_range' => 'true',	
			'callout_year_format'=>"",
			'show_callout_day_of_week' => 'true',
			'show_callout_day_of_week_range' => 'true',
			'callout_week_format'=>"",
			'eventdetails' => 'true',
			'shorten_multidate'=>'true',
			'start_date_format'=>"",
			'showtime' => 'true',
			'show_end_time'=> 'true',
			'show_end_date'=>'true',
			'show_timezone' => 'true',
			'show_timezone_abb' => 'true',
			'showtitle' => 'true',
			'show_pagination'=>'true',
			'show_recurring_events'=>'true',
			'recurrence_numer'=>"",
			'show_postponed_canceled_event'=>'true',
			'show_virtual_hybrid_event'=>'true',
			'show_virtual_event'=>'true',
			'show_hybrid_event'=>'true',
			'show_ical_export'=>'true',
			'show_google_calendar'=>'true',
			'stack_label_icon'=>'true',
			'show_event_month_heading'=>'true',
			'show_colon'=>'true',
			'time' => null,
			'past' => '',
			'venue' => 'false',
			'event_series_name'=>'true',
			'event_series_label'=>'',
			'location' => 'false',
			'location_street_address' => 'false',
			'location_locality' => 'false',
			'show_location_state'=>'false',
			'location_postal_code' => 'false',
			'location_country' => 'false',
			'location_street_comma' => 'false',
			'location_locality_comma' => 'false',
			'show_location_state_comma'=>'false',
			'location_postal_code_comma' => 'false',
			'location_country_comma' => 'false',
			'show_postal_code_before_locality'=>'false',
			'organizer' => null,
			'price' => null,
			'show_price_ticket' => '',
			'show_rsvp_feed' => '',
			'show_rsvp_feed_respond' => '',
			'show_rsvp_feed_left' => '',
			'show_ticket_feed_respond' => '',
			'show_ticket_feed_left' => '',
			'weburl' => null,
			'enable_series_link'=>'true',
			'custom_series_link_target' => '',
			'website_link'=>'',
			'custom_website_link_text'=>'',
			'custom_website_link_target'=>'',
			'categories' => 'false',
			'category_detail_label' => '',
			'time_detail_label' => '',
			'date_detail_label'=> '',
			'venue_detail_label' => '',
			'location_detail_label' => '',
			'organizer_detail_label' => '',
			'price_detail_label' => '',
			'price_ticket_label' => '',
			'rsvp_detail_label' => '',
			'tag_detail_label' => '',
			'website_detail_label' => '',
			'hide_comma_cat' => '',
			'tags' => 'false',
			'hide_comma_tag' => '',
			'schema' => 'true',
			'message' => '',
			'key' => 'End Date',
			'order' => 'ASC',
			'orderby' => 'startdate',
			'viewall' => 'false',
			'excerpt' => 'false',
			'excerpt_content'=>'',
			'showdetail' => 'false',
			'thumb' => 'false',
			'thumbsize' => '',
			'image_aspect_ratio'=>'',
			'thumbwidth' => '',
			'thumbheight' => '',
			'contentorder' => apply_filters( 'decm_details_order', ' thumbnail,title, title2, event_series_name, date, venue, location, organizer, price, show_rsvp_feed, show_price_ticket, categories, tags, excerpt,weburl, showdetail' , $atts ),
			'event_tax' => '',
			'dateformat' => '',
			'timeformat' => '',
			'layout' => '',
			'columns'    => '',
			'list_columns' => '',
			'list_layout' => '',
			'cover_columns' => '',
			'cards_spacing' => '',
			'blog_offset' => '',
			'cut_off_start_date'=>'',
			'cut_off_end_date'=>'',
			'event_past_future_cut_off'=>'',
			'cutoff_ongoing_events' => '',
			'button_align' => '',
			'image_align' => '',
			'event_inner_spacing' => '',
			'view_more_text' => 'View More',
			'open_toggle_background_color'=>'',
			'details_link_color'=>'',
			'details_icon_color'=>'',
			'details_label_color'=>'',
			'columns_phone' => '',
			'columns_tablet' => '',
			'list_columns_phone' => '',
			'list_columns_tablet' => '',
			'cover_columns_phone' => '',
			'cover_columns_tablet' => '',
			'act-view-more et_pb_button' => '',
			'header_level' => '',
			'included_categories' => '',
			'included_tags' => '',
			'included_organizer' => '',
			'included_organizer_check' =>'',
			'included_venue' => '',
			'included_venue_check' => $atts['included_venue_check'],
			'included_series' => '',
			'included_series_check' => $atts['included_series_check'],
			'date_selection_type'=>"",
			'event_by_reletive_date'=>"",
			'included_date_range_start'=> '',
			'included_date_range_end'=> '',
			'show_preposition'=>'false',
			'event_selection' => '',
            'related_event_checkbox' => '',
			'custom_icon' => $custom_icon,
			'custom_icon_tablet' => '',
			'custom_icon_phone' => '',
			'hover_icon'         => $hover_icon,
			'hover_icon_tablet' => '',
			'hover_icon_phone' => '',
			'custom_view_more' => '',
			'view_more_on_hover'=>'',
			'ajax_load_more_button_on_hover'=>'',
			'view_more_icon_placement'=>'',
			'ajax_load_more_button_icon_placement'=>'',
			'ajax_load_more_button_icon' => $custom_icon_load,
			'ajax_load_more_button_icon_tablet' => '',
			'ajax_load_more_button_icon_phone' => '',
			//'google_calendar_button_icon'=>$custom_icon_google,
		    'google_calendar_button_icon_tablet'=>'',
			'google_calendar_button_icon_phone'=>'',
			'custom_google_calendar_button'=>'',
			'google_calendar_button_icon_placement'=>'',
			'google_calendar_button_on_hover'=>'',
			//'ical_export_button_icon'=>$custom_icon_ical,
			'ical_export_button_icon_tablet'=>'',
			'ical_button_icon_phone'=>'',
			'ical_export_button_icon_placement'=>'',
			'ical_export_button_on_hover'=>'',
			'custom_ical_export_button'=>'',
			//'custom_view_more' => '',
			'custom_ajax_load_more_button'=>'',
			'ajax_load_more_text'=>'Load More',
			'google_calendar_text'=>"Google Calendar",
			'ical_text' =>"+ Ical Export",
			'pagination_type'=> '',
			'align'     => '',
			'pagination_align' => '',
			'show_icon_label'=>'',
			'module_css_class'=>'',
			'recurrence_number'=>'',
			'overlay_class'=>'',
			'getPostID' =>'',
		), $atts ), $atts, 'decm-events-atts' );


		// echo '<pre>';
		// print_r($atts);
		// echo '</pre>';
	
		// Category
		if ( $atts['cat'] ) {
			if ( strpos( $atts['cat'], "," ) !== false ) {
				$atts['cats'] = explode( ",", $atts['cat'] );
				$atts['cats'] = array_map( 'trim', $atts['cats'] );
			} else {
				$atts['cats'] = array( trim( $atts['cat'] ) );
			}

			$atts['event_tax'] = array(
				'relation' => 'OR',
			);

			foreach ( $atts['cats'] as $cat ) {
				$atts['event_tax'][] = array(
                        'taxonomy' => 'tribe_events_cat',
                        'field' => 'term_id',
                        'terms' => $cat,
                    );
					
			}
		}


		// Past Event
		$meta_date_compare = '>=';
		$meta_date_date = current_time( 'Y-m-d H:i:s' );

		if ( $atts['time'] == 'past' ||  $atts['past'] ==  'past_events' ) {
			$meta_date_compare = '<';
		}

		// Key, used in filtering events by date
		if ( str_replace( ' ', '', trim( strtolower( $atts['key'] ) ) ) == 'startdate' ) {
			$atts['key'] = '_EventStartDate';
		} else {
			$atts['key'] = '_EventEndDate';
		}

		// Orderby
		if ( str_replace( ' ', '', trim( strtolower( $atts['orderby'] ) ) ) == 'enddate' ) {
			$atts['orderby'] = '_EventEndDate';
		} elseif ( trim( strtolower( $atts['orderby'] ) ) == 'title' ) {
			$atts['orderby'] = 'title';
		} else {
			$atts['orderby'] = '_EventStartDate';
		}

		// Date
		if($atts['past'] !=  'past_future_events'){
			$atts['meta_date'] = array(
				array(
					'key' => $atts['key'],
					'value' => $meta_date_date,
					'compare' => $meta_date_compare,
					'type' => 'DATETIME'
				)
			);
		}
		else{
			$atts['meta_date'] ="";
		}
		
		 // Specific Month
		if ( 'current' == $atts['month'] ) {
			$atts['month'] = current_time( 'Y-m' );
		}
		if ( 'next' == $atts['month'] ) {
			$atts['month'] = gmdate( 'Y-m', strtotime( '+1 months', current_time( 'timestamp' ) ) );
		}
		if ($atts['month']) {
			$month_array = explode("-", $atts['month']);
			
			$month_yearstr = $month_array[0];
			$month_monthstr = $month_array[1];
			$month_startdate = gmdate( "Y-m-d", strtotime( $month_yearstr . "-" . $month_monthstr . "-01" ) );
			$month_enddate = gmdate( "Y-m-01", strtotime( "+1 month", strtotime( $month_startdate ) ) );

			$atts['meta_date'] = array(
				'relation' => 'AND',
				array(
					'key' => $atts['key'],
					'value' => $month_startdate,
					'compare' => '>=',
					'type' => 'DATETIME'
				),
				array(
					'key' => $atts['key'],
					'value' => $month_enddate,
					'compare' => '<',
					'type' => 'DATETIME'
				)
			);
		} 
		/**
		 * Hide time if $atts['showtime'] is false
		 *
		 * @author bojana
		 *
		 */
		if ( self::isValid( $atts['eventdetails'] ) ) {
			
			if ( !self::isValid( $atts['showtime'] ) ) {
				add_filter( 'tribe_events_event_schedule_details_formatting', 'tribe_events_event_schedule_details_formatting_hidetime');
			}
		}

		/**
		 * Hide time if $atts['showtime'] is false
		 *
		 * @author bojana
		 *
		 */

		if ( !empty( $atts['dateformat'] ) ) {

			setDateFormat($atts['dateformat']);
			add_filter( 'tribe_date_format', 'getDateFormat');
		}
	

		$atts = apply_filters( 'decm_event_calender_atts', $atts, $meta_date_date, $meta_date_compare );
		
		// echo 'hello';
		// echo $this->props['included_categories'];

		$cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
		$categslug = isset($cat_slug) && $cat_slug !=""&& ($cat_slug->name!="tribe_events" && $cat_slug->name!="product" ) ?$cat_slug->slug:"";
        $categId = isset($cat_slug) && $cat_slug !=""&& ($cat_slug->name!="tribe_events" && $cat_slug->name!="product" ) ?$cat_slug->term_id:"";
		$event_id = get_the_ID();

//        print_r($event_id . "---id text");
	
$venue_page_id=tribe_get_venue_id();
$orgnizer_page_id=tribe_get_organizer_id();
//print_r($orgnizer_page_id);
$meta_query_status="";
if($atts['show_postponed_canceled_event']=='false'){
	$meta_query_status =array('relation' => 'OR',
	 
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
		'posts_per_page' => -1,
		'post_type' => 'tribe_events',
		'meta_query' => array($meta_query_status),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	  );
	  $filter_event_status_recurrence_parent = array(
		'posts_per_page' => -1,
		'post_type' => 'tribe_events',
		//'post_parent'=>'5528',
	  );
	  $filter_event_status_recurrence_parent_data=array();
	  $filter_event_status_recurrence_parent=tribe_get_events($filter_event_status_recurrence_parent);
	  foreach ((array) $filter_event_status_recurrence_parent as $post_index => $recurrence_event ) {
	  $filter_event_status_recurrence_parent_data[]= $recurrence_event->post_parent;
	  }

	  $filter_event_status_recurrence_parent_data=array_unique($filter_event_status_recurrence_parent_data);
	  $filter_event_status_recurrence_parent_data=(array_values($filter_event_status_recurrence_parent_data));
	
	  if (in_array('', $filter_event_status_recurrence_parent_data)) 
{
	unset($filter_event_status_recurrence_parent_data[array_search('',$filter_event_status_recurrence_parent_data)]);
}

	  $filter_event_status_recurrence = array(
		'posts_per_page' =>-1,
		'post_type' => 'tribe_events',
		//'post_parent'=>$filter_event_status_recurrence_parent_data,
		'meta_query'=> $atts['meta_date'], //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	  );
	//   echo "<pre>";
	//print_r(new TEC\Events\Custom_Tables\V1\Tables\Occurrences);
	  $filter_event_status_recurrence=tribe_get_events($filter_event_status_recurrence);
	  $RecurrenceSortedID = array();
	  $RecurrenceParentChildID=array();
	  foreach ((array) $filter_event_status_recurrence as $post_index => $filter_event_status_recurrence ) {
		//$get_occurence_id[$filter_event_status_recurrence->_tec_occurrence->event_id] = array();
		$get_occurence_id=$filter_event_status_recurrence->_tec_occurrence;
	
		 settype($get_occurence_id,"object");

		if(isset($get_occurence_id->event_id)){
		if(!$get_occurence_id->event_id)
		continue;
		
	$RecurrenceParentChildID[$get_occurence_id->event_id]=isset($RecurrenceParentChildID[$get_occurence_id->event_id])?$RecurrenceParentChildID[$get_occurence_id->event_id]:"";
		if(!is_array($RecurrenceParentChildID[$get_occurence_id->event_id]))
		$RecurrenceParentChildID[$get_occurence_id->event_id] = array();

	  array_push($RecurrenceParentChildID[$get_occurence_id->event_id],$filter_event_status_recurrence->ID);
	}
}
	foreach ((array) $RecurrenceParentChildID as $post_index => $filter_event_status_recurrence ) {
	//echo "<pre>";
	$RecurrenceSortedID[]=array_slice($filter_event_status_recurrence,$atts['recurrence_number']);

	}


$RecurrenceSortedID =  array_merge(...$RecurrenceSortedID);

$filter_event_status = tribe_get_events($filter_event_status);
	  $filter_event_status =$atts['show_postponed_canceled_event']=='false'? wp_list_pluck($filter_event_status, 'ID'):array(0);
	 if($filter_event_status!=""&&$RecurrenceSortedID!=""){
	  $filter_event_status=array_merge($filter_event_status,$RecurrenceSortedID);
	 }
	 if($filter_event_status!=""){

	 }

	  if($atts['show_virtual_event']=='false' && $atts['show_hybrid_event']=='false'){
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

	  
	  if($atts['show_hybrid_event']=='true' && $atts['show_virtual_event']=='false'){
		$meta_query_status_virtual = array(
		  array(
			'key' => '_tribe_virtual_events_type',
			'value' => 'virtual',
			'compare' => '=',
			'type' => 'Text'
		  ),
		);  
	  } 
	  

	  if($atts['show_hybrid_event']=='false' && $atts['show_virtual_event']=='true'){
		$meta_query_status_virtual = array(
		  array(
			'key' => '_tribe_virtual_events_type',
			'value' => 'hybrid',
			'compare' => '=',
			'type' => 'Text'
		  ),
		);  
	  } 


	  if($atts['show_hybrid_event']=='true'  && $atts['show_virtual_event']=='true'){
		$meta_query_status_virtual = "";
	  }


	  $filter_event_status_virtual = array(
		'posts_per_page' => -1,
		'post_type' => 'tribe_events',
		'meta_query' => array($meta_query_status_virtual), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	  );
	
	  $filter_event_status_virtual = tribe_get_events($filter_event_status_virtual);
	  $filter_event_status_virtual = ($atts['show_hybrid_event']=='false' || $atts['show_virtual_event']=='false') ?wp_list_pluck($filter_event_status_virtual, 'ID'):array(0);
	  $filter_event_status = array_merge($filter_event_status,$filter_event_status_virtual);


	if(is_single()==true){
			array_push($filter_event_status,get_the_ID());
	 } 
	 else{
		$filter_event_status=$filter_event_status;
	 }


	 $check_event_by_date_start = "";
	 $check_event_by_date_end = "";

	 if($atts['event_by_reletive_date']=="today" && $atts['event_selection']=="custom_event"){
		$check_event_by_date_start=		 gmdate("Y-m-d 00:00:00");
		$check_event_by_date_end=		 gmdate("Y-m-d 23:59:59");
	 }
	 if($atts['event_by_reletive_date']=="week" && $atts['event_selection']=="custom_event"){
		$check_event_by_date_start=gmdate("Y-m-d 00:00:00", strtotime('monday this week'));
		$check_event_by_date_end=gmdate("Y-m-d 23:59:59", strtotime('sunday this week'));
	 }
	 if($atts['event_by_reletive_date']=="month" && $atts['event_selection']=="custom_event"){
		$check_event_by_date_start=gmdate('Y-m-01 00:00:00');
		$check_event_by_date_end=gmdate('Y-m-t 23:59:59');
	 }

	if($atts['date_selection_type'] == "relative_date")
	{ 
		$check_event_by_date_start=$check_event_by_date_start;
		$check_event_by_date_end=$check_event_by_date_end;
	}
	if($atts['date_selection_type'] == "none"){
		$check_event_by_date_start="";
		$check_event_by_date_end="";
	}

	//  print_r($atts['included_venue_check']==""?"k":"n");
	if(function_exists('tribe_is_event_series')){
	if($atts['event_selection']=="custom_event" && implode(",",$atts['included_series']) != ""){
	global $wpdb;
	$decm_series_args =  array (       
		'posts_per_page'=>-1,   
		'post_status' => 'publish',   
		'post_type' => 'tribe_event_series',                   
	);
	 $decm_series_events_table = (new TEC\Events_Pro\Custom_Tables\V1\Tables\Series_Relationships)->table_name( true );
	 $decm_series_update = new WP_Query( $decm_series_args );
     $decm_check_query_sizeof = count($atts['included_series'])=="1"?"LIKE":"IN";
 	 $decm_series_update = $wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$atts['included_series']).")"); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared , 	WordPress.DB.PreparedSQL.InterpolatedNotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
	 $decm_series_update=array_column($decm_series_update, 'event_post_id');
}
}

$search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : ''; //phpcs:ignore WordPress.Security.NonceVerification.Recommended

$args = apply_filters( 'decm_fetch_events_atts', array(
	'post_status' => 'publish',
	'post__in'=>$atts['event_selection']=="custom_event"&&$atts['included_series_check']!=""?$decm_series_update:"",
	'posts_per_page' => $atts['limit'],
	'tax_query'=> $atts['event_tax'], //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	'order' => $atts['order'],
	'start_date'=>$atts['past'] ==  'past_future_events'&&$atts['date_selection_type'] == "none"?"01-01-1970": $check_event_by_date_start,
	'end_date'=> $atts['past'] ==  'past_future_events'&&$atts['date_selection_type'] == "none"?"01-01-2100":(($atts['past'] ==  'past_events'&&$atts['date_selection_type'] == "none")?$meta_date_date:$check_event_by_date_end),
	'post__not_in'		=>$atts['show_postponed_canceled_event']=='false'?$filter_event_status:($atts['show_hybrid_event']=='false' && $atts['show_virtual_event']=='false'?$filter_event_status:$filter_event_status),//phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
	'offset' => $atts['blog_offset'],
	'organizer'=>$atts['event_selection']=="custom_event"&& $atts['included_organizer_check']!=""?$atts['included_organizer']:"",
	'venue'=>$atts['event_selection']=="custom_event" && $atts['included_venue_check']!=""?$atts['included_venue']: "",
	'included_categories' => $atts['included_categories'],
	'tag'            => $atts['included_tags'],
	'hide_subsequent_recurrences'=>$atts['show_recurring_events']=="on"? false: true,
	'meta_query' => apply_filters( 'dec_get_meta_query', array( $atts['meta_date']), $atts, $meta_date_date, $meta_date_compare ),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
    's' => $search_query,
), $atts, $meta_date_date, $meta_date_compare );


	if($atts['event_selection'] == 'featured_events' || $atts['event_selection']=="true" ){
		$args['featured'] = "true";
	}
	if($atts['cutoff_ongoing_events']=='cut_start_date_reached' && ($atts['past'] !=  'past_future_events' && $atts['past'] !=  'past_events')){
		//if(!empty($atts['cutoff_ongoing_events'])){
			$args['start_date'] =   gmdate('Y-m-d 23:59:59');
			$args['end_date'] = "";// gmdate('d-m-y h:i:s'); //gmdate('d-m-y h:i:s');
		//}
	}


	if($atts['cutoff_ongoing_events']=='cut_end_date_reached' && ($atts['past'] !=  'past_future_events' && $atts['past'] !=  'past_events' &&  $atts['event_selection'] != "custom_event")){
		//if(!empty($atts['cutoff_ongoing_events'])){
			$args['start_date'] =  ""; //gmdate('Y-m-d 23:59:59');
			$args['end_date'] = "";// gmdate('d-m-y h:i:s'); //gmdate('d-m-y h:i:s');
		//}
	}


		if($atts['date_selection_type'] == "date_range"){
			$args['start_date'] = $atts['included_date_range_start'];
			$args['end_date'] = $atts['included_date_range_end'];
		}


if($atts['related_event_checkbox'] == 'related_event_by_series'){

		global $post;
		$url = $post->guid;	
		preg_match("/&?p=([^&]+)/", $url, $matches);
	  //  $series_id = $matches[1]; 
		if(!empty($matches[1])){
			$series_id = $matches[1]; 
		}else{
			$series_id = $event_id;
		}

		if( function_exists("tec_event_series") && !empty(tec_event_series(  $series_id ))) {
			
			$decm_series_update_id = tec_event_series($series_id)->ID;

			$atts['included_series'] = array($decm_series_update_id);
			
			global $wpdb;
			$decm_series_args =  array (       
				'posts_per_page'=>-1,   
				'post_status' => 'publish',   
				'post_type' => 'tribe_event_series',                   
			);
			 $decm_series_events_table = (new TEC\Events_Pro\Custom_Tables\V1\Tables\Series_Relationships)->table_name( true );
			 $decm_series_update = new WP_Query( $decm_series_args );
			 $decm_check_query_sizeof = count($atts['included_series'])=="1"?"LIKE":"IN";
			 $decm_series_update = $wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$atts['included_series']).")");//phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared , WordPress.DB.PreparedSQL.InterpolatedNotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
			 $decm_series_update=array_column($decm_series_update, 'event_post_id');

			 $args['post__in'] = $decm_series_update;


		}else{
			$args['post__in'] = array(0);
		}

	}elseif($atts['event_selection'] == 'use_current_loop_series'  ){
			
			
			$atts['included_series'] = array($event_id);

			if(function_exists('tribe_is_event_series')){
				
				global $wpdb;
				$decm_series_args =  array (       
					'posts_per_page'=>-1,   
					'post_status' => 'publish',   
					'post_type' => 'tribe_event_series',                   
				);
				 $decm_series_events_table = (new TEC\Events_Pro\Custom_Tables\V1\Tables\Series_Relationships)->table_name( true );
				 $decm_series_update = new WP_Query( $decm_series_args );
				 $decm_check_query_sizeof = count($atts['included_series'])=="1"?"LIKE":"IN";
				 $decm_series_update = $wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$atts['included_series']).")"); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared , WordPress.DB.PreparedSQL.InterpolatedNotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
				 $decm_series_update=array_column($decm_series_update, 'event_post_id');
	
				 $args['post__in'] = $decm_series_update;
			}

			
		}


        else if($atts['event_selection'] == 'use_current_loop' || $atts['event_selection']=="related_event" ){
			

            if($post_type == 'tribe_events'){
                //$args['ID'] = $event_id;
            }
            $postID = $event_id;

            $term_id = array();
            $term_id_tag = array();

            $getEventCat = get_the_terms( $postID, 'tribe_events_cat' );
            if($getEventCat != ""){
                foreach ((array) $getEventCat as $key => $eventInfo ) {
                    $term_id[$key] = $eventInfo->term_id;
                }

            }
            $tag_event = get_the_terms( $event_id, 'post_tag' );
            if($tag_event != ""){
                foreach ((array) $tag_event as $key => $eventTagInfo ) {
                    $term_id_tag[$key] = $eventTagInfo->term_id;
                }
            }

//		if($categslug==""){

    if($categslug && $atts['event_selection'] == 'use_current_loop'){
		$args['included_categories'] = $categslug;
		unset($atts['event_tax']);
		$atts['event_tax'][] = array(
			'taxonomy' => 'tribe_events_cat',//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query

			'field' => 'term_id',
			'terms' => $categId,
		);
		$args['tax_query'] = $atts['event_tax'];  //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	}elseif($term_id &&  $atts['related_event_checkbox'] === 'same_cate'){

		unset($atts['event_tax']);
		$atts['event_tax'][] = array(//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query

			'taxonomy' => 'tribe_events_cat',
			'field' => 'term_id',
			'terms' => $term_id,
		);
		$args['tax_query'] = $atts['event_tax']; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	}elseif ($venue_page_id && $atts['event_selection'] == 'use_current_loop') {
		unset( $args['tax_query'] ); //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

		$args['meta_query'] = array( $atts['meta_date'],[//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'relation' => 'OR',
			[
				'key' => '_EventVenueID',
				'value' => $venue_page_id,
				'compare' => '=',
			]
		]);
	}elseif($atts['related_event_checkbox'] === 'same_venue'){
		unset( $args['tax_query'] ); //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

		$args['meta_query'] = array( $atts['meta_date'],[//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'relation' => 'OR',
			[
				'key' => '_EventVenueID',
				'value' => $venue_page_id,
				'compare' => '=',
			]
		]);

	}elseif ($orgnizer_page_id && $atts['event_selection'] == 'use_current_loop') {

		unset( $args['tax_query'] );//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

		$args['meta_query'] = array( $atts['meta_date'],[ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'relation' => 'OR',
			[
				'key' => '_EventOrganizerID',
				'value' => $orgnizer_page_id,
				'compare' => '=',
			]
		]);
	}elseif($atts['related_event_checkbox'] === 'same_org'){
		unset( $args['tax_query'] );//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

		$args['meta_query'] = array( $atts['meta_date'],[ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			'relation' => 'OR',
			[
				'key' => '_EventOrganizerID',
				'value' => $orgnizer_page_id,
				'compare' => '=',
			]
		]);
	}else if($term_id_tag && $atts['event_selection'] == 'use_current_loop'){
		unset($atts['event_tax']);
		$atts['event_tax'][] = array(
			'taxonomy' => 'post_tag',
			'field' => 'term_id',//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query

			'terms' => $term_id_tag,
		);
		$args['tax_query'] = $atts['event_tax']; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	}
		else if($term_id_tag &&  $atts['related_event_checkbox'] === 'same_tag'){
		unset($atts['event_tax']);
		$atts['event_tax'][] = array(
			'taxonomy' => 'post_tag',
			'field' => 'term_id',//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query

			'terms' => $term_id_tag,
		);
		$args['tax_query'] = $atts['event_tax']; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	}
//		}
	

 }

	$max_pages=0;
	$max_page_find_args = $args;
	if($atts['limit'] > 0){
		$max_page_find_args['posts_per_page'] = -1;
		if($atts['pagination_type']== "load_more" &&  $atts['events_to_load'] != "" ){
			$max_pages = ceil((count(tribe_get_events( $max_page_find_args )) - $atts['limit'])/$atts['events_to_load'] + 1);
		}else{
			$max_pages = ceil(count(tribe_get_events( $max_page_find_args ))/$atts['limit']);
		}

	}


		$event_posts = tribe_get_events( $args );

		
		$sort_order = strtoupper($atts['order'] ?? 'ASC');
 
			usort($event_posts, function ($a, $b) use ($sort_order) {
				$date_a = strtotime(get_post_meta($a->ID, '_EventStartDate', true) ?: '1970-01-01');
				$date_b = strtotime(get_post_meta($b->ID, '_EventStartDate', true) ?: '1970-01-01');
			
				if ($date_a === $date_b) {
					// Fallback: keep order by ID so it's stable
					return $a->ID <=> $b->ID;
				}
			
				return $sort_order === 'DESC'
					? $date_b <=> $date_a
					: $date_a <=> $date_b;
			});
		
        $event_posts = apply_filters( 'decm_events_posts_fetch', $event_posts, $atts );
		
		

		if ( $event_posts or apply_filters( 'decm_events_posts', false, $atts ) ) {

					
			$output = apply_filters( 'decm_start_events', $output, $event_posts, $atts );

					$cardoverStyle = '';
					$excerptLength = '';

				

				//	$columns_desktop = 'col-lg-12';
					$columns_desktop = 'col-lg-4';
			    	$columns_tablet = 'col-sm-12';
					$columns_phone_xs = 'col-xs-12';


					if($atts['layout'] == "list"){
						if($atts['list_columns_phone'] == "1"){ 
						// $columns_phone = "col-sm-12"; 
						  $columns_phone_xs = "col-xs-12";
						}else if($atts['list_columns_phone'] == "2"){
						//  $columns_phone = "col-sm-6"; 
						  $columns_phone_xs = "col-xs-6";
								}
					  }elseif($atts['layout'] == "cover"){
				  
						if($atts['cover_columns_phone'] == "1"){ 
						// $columns_phone = "col-sm-12"; 
						  $columns_phone_xs = "col-xs-12";
						}else if($atts['cover_columns_phone'] == "2"){
					//	 $columns_phone = "col-sm-6"; 
						  $columns_phone_xs = "col-xs-6";
						  }
						else if($atts['cover_columns_phone'] == "3"){ 
					//	 $columns_phone = "col-sm-4"; 
						  $columns_phone_xs = "col-xs-4";
						}
						else if($atts['cover_columns_phone'] == "4"){ 
					//	 $columns_phone = "col-sm-3"; 
						  $columns_phone_xs = "col-xs-3";
						}
				  
					  }else{
						if($atts['columns_phone'] == "1"){ 
					//	  $columns_phone = "col-sm-12"; 
						  $columns_phone_xs = "col-xs-12";
						}else if($atts['columns_phone'] == "2"){
					//	 $columns_phone = "col-sm-6"; 
						  $columns_phone_xs = "col-xs-6";
						  }
						else if($atts['columns_phone'] == "3"){ 
				//		  $columns_phone = "col-sm-4"; 
						  $columns_phone_xs = "col-xs-4";
						}
						else if($atts['columns_phone'] == "4"){ 
				//		  $columns_phone = "col-sm-3"; 
						  $columns_phone_xs = "col-xs-3";
						}
				  
					  }
						  
					  if($atts['layout'] == "list"){
						if($atts['list_columns_tablet'] == "1"){ 
						  $columns_tablet = "col-sm-12"; 
						}else if($atts['list_columns_tablet'] == "2"){ 
						  $columns_tablet = "col-md-6"; 
						}
					  }elseif($atts['layout'] == "cover"){
				  
						if($atts['cover_columns_tablet'] == "1"){ 
						  $columns_tablet = "col-sm-12"; 
						}else if($atts['cover_columns_tablet'] == "2"){ 
						  $columns_tablet = "col-sm-6"; 
						}else if($atts['cover_columns_tablet'] == "3"){ 
						  $columns_tablet = "col-sm-4"; 
						}else if($atts['cover_columns_tablet'] == "4"){ 
						  $columns_tablet = "col-sm-3"; 	
						}
					  }else{
				  
						if($atts['columns_tablet'] == "1"){ 
						  $columns_tablet = "col-sm-12"; 
						}else if($atts['columns_tablet'] == "2"){ 
						  $columns_tablet = "col-sm-6"; 
						}else if($atts['columns_tablet'] == "3"){ 
						  $columns_tablet = "col-sm-4"; 
						}else if($atts['columns_tablet'] == "4"){ 
						  $columns_tablet = "col-sm-3"; 	
						}
					  }
				  
					  if($atts['layout'] == "list"){
						if($atts['list_columns'] == "1"){ 
						  $columns_desktop = "col-lg-12"; 
						}else if($atts['list_columns'] == "2"){ 
						  $columns_desktop = "col-lg-6"; 
						}
					  }elseif($atts['layout'] == "cover"){
						
						if($atts['cover_columns'] == "1"){ 
						  $columns_desktop = "col-lg-12"; 
						}else if($atts['cover_columns'] == "2"){ 
						  $columns_desktop = "col-lg-6"; 
						}else if($atts['cover_columns'] == "3"){ 
						  $columns_desktop = "col-lg-4"; 
						}else if($atts['cover_columns'] == "4"){ 
						  $columns_desktop = "col-lg-3"; 
						}
				  
					  }else{
				  
						if($atts['columns'] == "1"){ 
						  $columns_desktop = "col-lg-12"; 
						}else if($atts['columns'] == "2"){ 
						  $columns_desktop = "col-lg-6"; 
						}else if($atts['columns'] == "3"){ 					
							$columns_desktop = "col-lg-4"; 					
						}else if($atts['columns'] == "4"){ 
						  $columns_desktop = "col-lg-3"; 
						}
				  
					  }				
					
					//print_r($_SERVER['HTTP_HOST']);
			$output .= apply_filters( 'decm_eventss_div', '<div class="append_events row_equal row ecs-event-list event-display_style ' . ($atts['image_align'] == 'blog_layout' ? 'blog_layout': 'leftimage_rightdetail' ) . '">', $atts );
 
			$atts['contentorder'] = explode( ',', $atts['contentorder'] );

			foreach( (array) $event_posts as $post_index => $event_post ) {
				
				setup_postdata( $event_post->ID );
				
				$event_output = '';
				if ( apply_filters( 'decm_remove_events', false, $atts, $event_post ) )
				    continue;
				$category_slugs = array();
				$category_list = get_the_terms( $event_post, 'tribe_events_cat' );
				
				/**
				 * Show Categories of every events
				 *
				 * @author bojana
				 */
				//echo "<pre>";
				//print_r($category_list);
				$category_names = array();
				$featured_class = ( get_post_meta( $event_post->ID , '_tribe_featured', true ) ? ' ecs-featured-event ' : '' );
				//print_r($featured_class);
				if ( is_array( $category_list ) ) {
					foreach ( (array) $category_list as $category ) {
						$category_slugs[] = ' ' . $category->slug . '_ecs_category';
						/**
						 * Show Categories of every events
						 *
						 * @author bojana
						 */

						$category_enable_link = $atts['enable_category_links'] == 'true' ? '<a href="'.get_category_link( $category->term_id ).'" target="'.$atts['custom_category_link_target'].'" >'.$category->name.'</a>' : '<span>'.$category->name.'</span>';
						$category_names[] = '<span class= "decm_categories ecs_category_'.$category->slug.'" >'.$category_enable_link.'</span>';
					}
				}


				/**
				 * Show Tags of every events
				 *
				 * @author bojana
				 */
				//echo "<pre>";
				//print_r($category_list);
				$tag_names = array();
				$tag_slugs = array();
				$tag_list =  get_the_terms( $event_post, 'post_tag' );
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

						$tag_enable_link = $atts['enable_tag_links'] == 'true' ? '<a href="'.get_term_link( $tag->term_id ).'" target="'.esc_attr($atts['custom_tag_link_target']).'" >'.esc_attr($tag->name).'</a>' : '<span>'.esc_attr($tag->name).'</span>';
						$tag_names[] = '<span class= "decm_tag ecs_tag_'.esc_attr($tag->slug).'" >'.$tag_enable_link.'</span>';
					}
				}

				
				// exit;
				// style="'.$eventInnerStyle.'"
				$coverImage  =  $atts['layout'] == 'cover' ? "cover-image" : " ";

				$event_output .= apply_filters( 'decm_events_start_tag', '<div class=" '.$columns_desktop.' '.$columns_tablet.' '.$columns_phone_xs.' '.$coverImage .' ecs-event ecs-event-posts clearfix' . implode( '', $category_slugs ) . $featured_class . apply_filters( 'decm_events_classes', '', $atts, $post ) . '" ><article id="event_article_'.$event_post->ID.'" class="act-post et_pb_with_border '.$atts['overlay_class'].'" style="background:'.$this->props["open_toggle_background_color"].';"  ><div class="row "  > ', $atts, $post );
				if($atts['layout'] == 'list'&& $atts['list_columns']=='1'){
				if($atts['show_event_month_heading']=='true'){
					if(Tribe\Events\Views\V2\Utils\Separators::should_have_month( $event_posts,$event_post->ID )){
					$event_output.="<h2 class='ecs-events-list-separator-month'><span class='ecs-events-calendar-list__month-separator-text'>".tribe_get_start_date( $event_post->ID, false, tribe_get_date_option( 'monthAndYearFormat', 'F Y' ) )."</span></h2>" ;
					//$event_output.="";
					}
				}
					else{}
			}

				// Put Values into $event_output
				if ( self::isValid( $atts['thumb'] ) ){
						
				}
				else{
// 					$event_output .= '<div class="col-md-12">';
				}
				$image_center="";
				if($atts['align']=="center"){
					$image_center="decm-show-image-center";
				}
				if($atts['align']=="left"){
					$image_center="decm-show-image-left";
				}
				if($atts['align']=="right"){
					$image_center="decm-show-image-right";
				}
				//print_r(Tribe__Events__Main::instance()->esc_gcal_url( tribe_get_gcal_link($event_post->ID) ));
			
			 $classShowDataOneLine ='';
			 $classShowDataOneLine = $atts['show_data_one_line'] == 'true' ? ' decm-show-data-display-block ' : ' ';
			 $start_time='';
			 $end_time ='';
			 $set_timezone='';
			
			 $set_timezone=$atts['show_timezone']=='true'?$atts['show_timezone_abb']=='false'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):" ".Tribe__Events__Timezones::get_event_timezone_abbr( $event_post->ID ):"";
			 $start_time=$atts['timeformat']==''? tribe_get_start_time($event_post->ID,get_option( 'time_format' )):tribe_get_start_time($event_post->ID,$atts['timeformat']);  
			 $end_time=$atts['timeformat']==''? tribe_get_end_time($event_post->ID,get_option( 'time_format' )):tribe_get_end_time($event_post->ID,$atts['timeformat']);
			 $end_time=$atts['show_end_time']=="true"?$end_time.$set_timezone:((tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))?$end_time.$set_timezone:$set_timezone);

			 $start_date='';
			 $end_date ='';
			
		$start_date_format_check="";
		$start_date_format_check=$atts['dateformat']!=""?$atts['dateformat']:get_option( 'date_format' );
			if($atts['shorten_multidate']=='true' && $atts['start_date_format']!=""&& (tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' ))!= tribe_get_end_date( $event_post->ID,null,get_option( 'date_format' )))){
					$start_date = $atts['start_date_format']!=""? tribe_get_start_date( $event_post->ID,null,$atts['start_date_format']):tribe_get_start_date( $event_post->ID,null,"M d");	
			}
			else{
				if($atts['shorten_multidate']=='true' && $atts['start_date_format']==""){
				
					if(tribe_get_start_date( $event_post->ID,null,"Y") == tribe_get_end_date( $event_post->ID,null,"Y")){
						$start_date =  (tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' ))!= tribe_get_end_date( $event_post->ID,null,get_option( 'date_format' ))) ? tribe_get_start_date( $event_post->ID,null,"M j"): tribe_get_start_date( $event_post->ID,null,$start_date_format_check);
					}else{
						$start_date =  (tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' ))!= tribe_get_end_date( $event_post->ID,null,get_option( 'date_format' ))) ? tribe_get_start_date( $event_post->ID,null,"M j, Y"): tribe_get_start_date( $event_post->ID,null,"M j, Y");
					}
					
				}else{
					$start_date = $atts['dateformat']==""? tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' )):tribe_get_start_date( $event_post->ID,null,$atts['dateformat']);
				}		
			}

			if(tribe_get_start_date( $event_post->ID,null,"M Y") == tribe_get_end_date( $event_post->ID,null,"M Y")){
				$start_date_format_update = $atts['dateformat']!=""? $atts['dateformat']: "j, Y";
				$end_date=$atts['dateformat']=="" && $atts['shorten_multidate']=='false'? ' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '. tribe_get_end_date($event_post->ID,null,get_option( 'date_format' )):(($atts['dateformat']!="" && $atts['shorten_multidate']=='false')?' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$start_date_format_check):' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$start_date_format_update));  
			}else{
				$start_date_format_update = $atts['dateformat']!=""? $atts['dateformat']: "M j, Y";
				$end_date=$atts['dateformat']=="" && $atts['shorten_multidate']=='false'? ' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '. tribe_get_end_date($event_post->ID,null,get_option( 'date_format' )):(($atts['dateformat']=="" && $atts['shorten_multidate']=='false')?' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$start_date_format_check):' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$start_date_format_update));  
			}
			
			$end_date=$atts['show_end_date']=="true"?$end_date:"";

			//	echo $end_date."end_date";
// 			print_r(tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)?"yes":"no");
			$showicondate ="";
			$showicontime="";
			$showicon="";
			$showlabel="";
			$showlabeldate="";
			$showlabeltime="";
			$event_stutus_tag = "";

			if(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true) == 'postponed'){
				$event_stutus_tag = tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'" style="display:inline">'.__('postponed','decm-divi-event-calendar-module').' </span>':"";
				//	echo tribe_get_event_meta($event_post->ID,'_tribe_events_status', true);
			}

			if(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true) == 'canceled'){
					$event_stutus_tag = tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'" style="display:inline">'.__('canceled','decm-divi-event-calendar-module').' </span>':"";
			}

			$show_colon= $atts['show_colon']=="true"?":":"";
			$event_virtual=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="virtual"?'
			<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--virtual tribe-events-virtual-virtual-event__icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 16" style="font-size: 5px !important;margin: 0px !important;width: 24px;height: 12px;/* display: flex; */">
		<g fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)">
			<path d="M18 10.7333333c2.16-2.09999997 2.16-5.44444441 0-7.46666663M21.12 13.7666667c3.84-3.7333334 3.84-9.80000003 0-13.53333337M6 10.7333333C3.84 8.63333333 3.84 5.28888889 6 3.26666667M2.88 13.7666667C-.96 10.0333333-.96 3.96666667 2.88.23333333" class="tribe-common-c-svgicon__svg-stroke"></path><ellipse cx="12" cy="7" rx="2.4" ry="2.33333333" class="tribe-common-c-svgicon__svg-stroke"></ellipse></g></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'.__('Virtual Event','decm-divi-event-calendar-module').' </span>':"";
			$event_hybrid=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="hybrid"?'
			<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--hybrid tribe-events-virtual-hybrid-event__icon-svg" viewBox="0 0 15 13" fill="none" style="width: 24px;height: 12px;" xmlns="http://www.w3.org/2000/svg">
	<circle cx="3.661" cy="9.515" r="2.121" transform="rotate(-45 3.661 9.515)" stroke="#0F0F30" stroke-width="1.103"></circle><circle cx="7.54" cy="3.515" r="2.121" transform="rotate(-45 7.54 3.515)" stroke="#0F0F30" stroke-width="1.103"></circle>
	<path d="M4.54 7.929l1.964-2.828" stroke="#0F0F30"></path><circle r="2.121" transform="scale(-1 1) rotate(-45 5.769 18.558)" stroke="#0F0F30" stroke-width="1.103"></circle>
	<path d="M10.554 7.929L8.59 5.1" stroke="#0F0F30"></path></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'.__('Hybrid Event','decm-divi-event-calendar-module').' </span>':"";
			
	
			$disable_event_title_link=$atts['disable_event_title_link']=="true"?" ecs_disable_event_link ":"";
			$disable_event_image_link=$atts['disable_event_image_link']=="true"?" ecs_disable_event_link ":"";
			$disable_event_button_link=$atts['disable_event_button_link']=="true"?" ecs_disable_event_link ":"";
			$custom_event_link_url = $atts['custom_event_link_url']==""?tribe_get_event_link($event_post->ID):((strpos($atts['custom_event_link_url'], "http") !== 0)?$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?"https" : "http") . "://" .$atts['custom_event_link_url']:$atts['custom_event_link_url']);
			if(tribe_get_start_date( $event_post->ID,false,"D") == tribe_get_end_date( $event_post->ID,false,"D")){
				$decm_show_callout_day_of_week = $atts['show_callout_day_of_week'] == "true" ? '<div class="callout_weekDay">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format']).'</div>' : "" ;
			}else{
				if($atts['show_callout_day_of_week_range'] == "true"){
					$decm_show_callout_day_of_week = $atts['show_callout_day_of_week_range'] == "true" ? '<div class="callout_weekDay">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format'])." - ".tribe_get_end_date( $event_post->ID,null, $atts['callout_week_format']).'</div>' : "" ;
				}else{
					$decm_show_callout_day_of_week = $atts['show_callout_day_of_week'] == "true" ? '<div class="callout_weekDay">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format']).'</div>' : "" ;
				}
					
			}
					
			if(tribe_get_start_date( $event_post->ID,false,"M") == tribe_get_end_date( $event_post->ID,false,"M")){
				$decm_show_callout_month = $atts['show_callout_month'] == "true" ? '<div class="callout_month">'.tribe_get_start_date( $event_post->ID,null,$atts['callout_month_format']).'</div>' : " " ;
			}else{
				if($atts['show_callout_month_range'] == "true"){
				$decm_show_callout_month = $atts['show_callout_month_range'] == "true" ? '<div class="callout_month">'.tribe_get_start_date( $event_post->ID,null,$atts['callout_month_format'])." - ".tribe_get_end_date( $event_post->ID,null,$atts['callout_month_format']).'</div>' : " " ;
			}else{
				$decm_show_callout_month = $atts['show_callout_month'] == "true" ? '<div class="callout_month">'.tribe_get_start_date( $event_post->ID,null,$atts['callout_month_format']).'</div>' : " " ;
			}
		   }

			if(tribe_get_start_date( $event_post->ID,false,"Y") == tribe_get_end_date( $event_post->ID,false,"Y")){
				$decm_show_callout_year = $atts['show_callout_year'] == "true" ? '<div class="callout_year">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format']).'</div>' : " " ;
			}else{
				if($atts['show_callout_year_range'] == "true"){
					$decm_show_callout_year = $atts['show_callout_year_range'] == "true" ? '<div class="callout_year">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format'])." - ".tribe_get_end_date( $event_post->ID,null, $atts['callout_year_format']).'</div>' : " " ;
				}else{
					$decm_show_callout_year = $atts['show_callout_year'] == "true" ? '<div class="callout_year">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format']).'</div>' : " " ;
				}
				
			}

			if(tribe_get_start_date( $event_post->ID,false,"d") == tribe_get_end_date( $event_post->ID,false,"d")){
				$decm_show_callout_date = $atts['show_callout_date'] == "true" ? '<div class="callout_date">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']).'</div>' : " " ;
			}else{
				if($atts['show_callout_date_range'] == "true"){
				    $callout_date_range_sep     = tribe_get_option( 'timeRangeSeparator', ' - ' );
					$callout_date_range_separator     = $atts['show_callout_date_range']== "true"? " ".$callout_date_range_sep." ":"";
					$decm_show_callout_date = $atts['show_callout_date_range'] == "true" ? '<div class="callout_date">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']).$callout_date_range_separator.tribe_get_end_date( $event_post->ID,null, $atts['callout_date_format']).'</div>' : " " ;
				}else{
					$decm_show_callout_date = $atts['show_callout_date'] == "true" ? '<div class="callout_date">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']).'</div>' : " " ;
				}		
			}

	
			if(tribe_get_start_time( $event_post->ID,false,"g:i a") == tribe_get_end_time( $event_post->ID,false,"g:i a")){
				$decm_show_callout_time = $atts['show_callout_time'] == "true" ? '<div class="callout_time">'.tribe_get_start_time( $event_post->ID, $atts['callout_time_format']).'</div>' : " " ;
			}else{
				if($atts['show_callout_time_range'] == "true" ){
				    $time_range_separator_call     = tribe_get_option( 'timeRangeSeparator', ' - ' );
				    $time_range_separator_callout     = $atts['show_callout_time_range']== "true"? " ".$time_range_separator_call." ":"";
					$decm_show_callout_time = $atts['show_callout_time_range'] == "true" ? '<div class="callout_time">'.tribe_get_start_time( $event_post->ID, $atts['callout_time_format']).$time_range_separator_callout.tribe_get_end_time( $event_post->ID, $atts['callout_time_format']).'</div>' : " " ;
				}else{
					$decm_show_callout_time = $atts['show_callout_time'] == "true" ? '<div class="callout_time">'.tribe_get_start_time( $event_post->ID, $atts['callout_time_format']).'</div>' : " " ;
				}		
			}
			$custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];				
			$link_organizer = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_organizer_link($event_post->ID) ?? '', $result_organizer);
			$result_organizer =  isset($result_organizer['href'][0]) ? sanitize_text_field( wp_unslash($result_organizer['href'][0]) ) : sanitize_text_field( wp_unslash("") );
			$link_venue = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_venue_link($event_post->ID) ?? '', $result_venue);
			$result_venue =  isset($result_venue['href'][0]) ? sanitize_text_field( wp_unslash($result_venue['href'][0]) ) : sanitize_text_field( wp_unslash("") );
			$link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_event_website_link($event_post->ID) ?? '', $result);
		
			if(isset($result['href'][0])){
					$result =  $result['href'][0];	
					$custom_event_link_url = $atts['single_event_page_link'] == 'redirect_link' ?  $result : $custom_event_link_url;
			}	
	
			if($atts['layout'] == 'cover'){
				$decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-cover">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div>' : '';	
			}else if($atts['layout'] == 'list'){
				$decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-list">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div>' : '';		
			}else{
				$decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-grid">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div>' : '';
			}
			
			if ( !empty( $atts['dateformat'] ) ) {

				$showdate=setDateFormat($atts['dateformat']);
				
			}
			else{
				$showdate= get_option('date_format');
			}

				foreach ( apply_filters( 'decm_events_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {

					//echo $contentorder;
					
					switch ( trim( $contentorder ) ) {
						case 'callout':
							$event_output .= '<div class="col-md-2 col-3">'.$decm_show_callout_box.'</div>';
						break;
						case 'title':

							$dec_event_title = "";
							if(self::isValid( $atts['showtitle'] )){
								$dec_event_title =  apply_filters( 'decm_events_details_start', ''.$event_stutus_tag.$event_hybrid.$event_virtual.'<'.esc_attr($atts['header_level']).' class="entry-title title2 summary">', $atts, $event_post ).apply_filters( 'decm_events_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . esc_attr($custom_event_link_url) . '" rel="bookmark" target="'.esc_attr($atts['custom_event_link_target']).'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $event_post->post_title, $atts, $post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'decm_events_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							}
							//echo $dec_event_title."title....";
						
						
							if((self::isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list') && ($atts['showdetail'] == 'true' || $atts['showdetail'] == 'false' ) ){			
								
								if($atts['list_layout'] == 'calloutrightimage_leftdetail'){
								   $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
							   }elseif( self::isValid( $atts['thumb'] ) != " " &&  ($atts['show_callout_box'] == "false" && $atts['showdetail'] == 'false' ) && $atts['list_layout'] == 'leftimage_rightdetail'){
								   $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
							   }elseif( self::isValid( $atts['thumb'] ) != " "   && ($atts['list_layout'] == 'leftimage_rightdetail' || $atts['list_layout'] == 'rightimage_leftdetail' ||  $atts['list_layout'] == 'calloutimage_rightdetail') ){
								   $event_output .= '<div   class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
								   
							   }elseif(self::isValid( $atts['thumb'] ) != " " &&  ($atts['show_callout_box'] == "true" && $atts['showdetail'] == 'true' ) ){
								   $event_output .= '<div 123 class="  col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
							   }elseif(self::isValid( $atts['thumb'] ) != " "  &&  $atts['show_callout_box'] == "true"  ){
								   $event_output .= '<div class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
							   }else{
								   $event_output .= '<div class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
							   }							

						   }elseif((self::isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list') && $atts['showdetail'] == 'false' ){

							   $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;

						   }elseif(self::isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list' ){
						
								$event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;

							}elseif($atts['layout'] == 'list' &&  ($atts['list_layout'] == 'calloutleftimage_rightdetailButton' || $atts['list_layout'] == 'calloutrightimage_leftdetailButton' || $atts['list_layout'] == 'calloutimage_rightdetailButton'  )  ){

								if($atts['list_layout'] == 'calloutimage_rightdetailButton'){
									$event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '5' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '6' : '12').'"><div class="decm-events-details">'.$dec_event_title;
								}else{
									$event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '5' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '5' : '12').'"><div class="decm-events-details">'.$dec_event_title;
								}
								

							}elseif( $atts['layout'] == 'list' &&  ($atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail') ){

								//echo $this->props['show_feature_image'];
							$event_output .= '<div  class=" col-'.( $atts['list_columns'] <= 2  && $this->props['show_feature_image'] == 'off' ? '10' : '6').'  col-md-'.( $atts['list_columns'] <= 2  && $this->props['show_feature_image'] == 'off' ? '10' : '6').'"><div class="decm-events-details">'.$dec_event_title;	

							}elseif ( self::isValid( $atts['showtitle'] ) &&  $atts['layout'] == 'list' ) {
								$event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details">'.apply_filters( 'decm_events_details_start', ''.$event_stutus_tag.$event_hybrid.$event_virtual.'<'.$atts['header_level'].' class="entry-title title2 summary">', $atts, $event_post ) .apply_filters( 'decm_events_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $event_post->post_title, $atts, $post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'decm_events_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );						
							}elseif(  self::isValid( $atts['showtitle'] )  && $atts['layout'] == 'grid'  ){
								
								$decm_show_callout_box_grid = $atts['show_callout_box'] == "true" ? '<a class="'.$disable_event_image_link.'"  href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'"><div class="callout-box-cover">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div></a>' : '';	
								//$event_output .= $decm_show_callout_box_grid;
								if ( self::isValid( $atts['thumb'] ) ) {
									 $decm_show_callout_box_grid = ""; 
								}else{
									$decm_show_callout_box_grid = $decm_show_callout_box_grid; 
								}
								$event_output .= '<div  class="col-md-'.($atts['columns'] > 2 ? '12' : '12').'"><div class="decm-events-details">'.$decm_show_callout_box_grid.apply_filters( 'decm_events_details_start', ''.$event_stutus_tag.$event_hybrid.$event_virtual.'<'.$atts['header_level'].' class="entry-title title2 summary">', $atts, $event_post ) .apply_filters( 'decm_events_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'decm_events_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
									
							}elseif( self::isValid( $atts['showtitle'] )  && $atts['layout'] == 'cover'){
								//$image =wp_get_attachment_image_src( get_post_thumbnail_id( $event_post->ID ), 'full', false )[0];
								 $image = get_the_post_thumbnail_url($event_post->ID,array(800,800,'class'=>" ecs_event_feed_image"));				
								
								 $background_image	= $this->props['show_feature_image'] == "on" ? "background-image: url($image); background-size: cover;" : "";
								// $image_url = "style = 'background-image: url('.$image.');'";
		
								$event_output .= '<div  class="col-md-'.($atts['columns'] > 2 ? '12' : '12').' "  ><div class="decm-cover-image-overlay"   style = "'.$background_image.'" ><div class="decm-cover-overlay-details"><div class="decm-events-details-cover">'.$decm_show_callout_box .''.apply_filters( 'decm_events_details_start', ''.$event_stutus_tag.$event_hybrid.$event_virtual.'<'.$atts['header_level'].' class="entry-title title2 summary">', $atts, $event_post ) .apply_filters( 'decm_events_list_title_link_start', '<a href="' . $custom_event_link_url . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $event_post->post_title, $atts, $post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'decm_events_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							}elseif(!self::isValid( $atts['showtitle'] ) &&  $atts['layout'] == 'list'){
								
								$event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details">';	
							}else{
								$event_output .= '<div  class="col-md-'.(($atts['columns'] > 2 ? '12' : $atts['image_align'] == 'topimage_bottomdetail' || $atts['image_align'] == 'centerimage_bottomdetail' || $atts['thumb'] == 'false') ? '12' : '8').'"><div   class="decm-events-details">';
							}
						break;
						case 'title3':
							if(self::isValid( $atts['showtitle'] )){
							$event_output .= apply_filters( 'decm_events_details_start', '<'.$atts['header_level'].' class="entry-title title2 summary">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $event_post->post_title, $atts, $event_post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .
							           apply_filters( 'decm_events_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							}

							break;
						/**
						 * Show Author Name of every events
						 *
						 * @author bojana
						 */
													
							break;

							case 'event_series_name':
							//	global $post;
								$url = $event_post->guid;	
								preg_match("/&?p=([^&]+)/", $url, $matches);
							 //  $series_id = $matches[1]; 
								if(!empty($matches[1])){
									$series_id = $matches[1]; 
								}else{
									$series_id = $event_post->ID;
								}

							if( function_exists("tec_event_series") && !empty(tec_event_series(  $series_id ))) {

									$series_custom_label = __('Event Series','decm-divi-event-calendar-module');
									if(!empty($atts['event_series_label'])){
										$series_custom_label =  __($atts['event_series_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
									}

								//	echo $series_custom_label."series_custom_label".$atts['event_series_label']."<br>";
									$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? 'dief-events-series-relationship-single-marker__icon': '';
									$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ? '<span class="ecs-detail-label">'.esc_attr($series_custom_label.$show_colon).'</span>':"";
									$stacklabel = $atts['stack_label_icon']==='true'?"<br>":"";
									$enable_series_link=$atts['enable_series_link']=='true'? '<a href="'.tec_event_series(  $series_id )->guid.'" class="diec-events-series-relationship-single-marker__title tribe-common-cta--alt" target="'.esc_attr($atts['custom_series_link_target']).'"><span class="diec_series_marker__title">'.tec_event_series(  $series_id )->post_title.'</span></a>':'<span class="diec_series_marker__title">'.tec_event_series(  $series_id )->post_title.'</span>';
									// $enable_series_label = $atts['event_series_label']=='true'? '<span class="diec-events-series-relationship-single-marker__prefix">Event Series:	</span>' : '';
									// $enable_series_icon = $atts['event_series_icon']=='true'? '<span class="dief-events-series-relationship-single-marker__icon">&#xe025;</span>': '';
								if($atts['event_series_name']=='true' && !empty(tec_event_series(  $series_id )->post_title)){
									//$event_output .=  '<div>'.$showicon.$showlabel.$stacklabel.$enable_series_link.'</div>';
							
									$event_output .= apply_filters( 'decm_events_details_start', '<span class="'.$classShowDataOneLine.' '.$showicon.'">', $atts, $event_post ) .
													apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel." ".'<span class="decm_series_name">'.$enable_series_link, $atts, $event_post ) .
													apply_filters( 'decm_events_title_tag_end', '</span></span>', $atts, $event_post );
								}
								}
								break;					
						
						case 'organizer':
							if ( self::isValid( $atts['organizer'] ) ) {
								if(tribe_get_organizer($event_post->ID) != null){
									
								$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"organizer-ecs-icon":"";
								$organizer_custom_label = __('Organizer','decm-divi-event-calendar-module');
								if(!empty($atts['organizer_detail_label'])){
												$organizer_custom_label =  __($atts['organizer_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
								}
								$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$organizer_custom_label.$show_colon." </span>":"";
								$stacklabel = $atts['stack_label_icon']==='true'?"<br>":"";
								$organizers = tribe_get_organizer_ids($event_post->ID);
								$orgName = array();

								foreach ($organizers as $key => $organizerId) {
									
									// $link_organizer = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_organizer_link($event_post->ID), $result_organizer);
									// $result_organizer =  isset($result_organizer['href'][0]) ? sanitize_text_field( wp_unslash($result_organizer['href'][0]) ) : sanitize_text_field( wp_unslash("") );
									$orgName[$key] = $atts['enable_organizer_link']=="true" &&class_exists( 'Tribe__Events__Pro__Main' )?'<a href="'.$result_organizer.'" target="'.$atts['custom_organizer_link_target'].'">'.tribe_get_organizer($organizerId).'</a>':tribe_get_organizer($organizerId);					
							    }

							 $orgNames	= implode(', ', $orgName);
									$event_output .= apply_filters( 'decm_events_organizer_tag_start','<span class="'.$classShowDataOneLine.' ecs-organizer '.$showicon.'">', $atts, $event_post ) .
								           apply_filters( 'decm_events_organizer',($atts['show_preposition'] == 'true' ? $showlabel.$stacklabel.'<span class="decm_organizer">'.__( ' by ','decm-divi-event-calendar-module') : $showlabel.$stacklabel." ".'<span class="decm_organizer">'), $atts, $event_post, $excerptLength );
										   $event_output .=  apply_filters( 'decm_events_organizer',$orgNames, $atts, $event_post );
										   $event_output .=   apply_filters( 'decm_events_organizer_tag_end', '</span></span>', $atts, $event_post );
								
							}
							//else{}
						}
							
							
							break;

							case 'price':
								if ( self::isValid( $atts['price'] ) ) {
									if(tribe_get_cost( $event_post->ID, true )!=null){
								$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"price-ecs-icon":"";
								$price_custom_label = __('Price','decm-divi-event-calendar-module');
								if(!empty($atts['price_detail_label'])){
												$price_custom_label =  __($atts['price_detail_label'],'decm-divi-event-calendar-module');
								}

								$event_cost = tribe_get_cost( $event_post->ID, true );

								// If value is exactly "Free"
								if ( trim( $event_cost ) === 'Free' ) {
									$event_cost =  __('Free', 'decm-divi-event-calendar-module');
								}
								$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$price_custom_label.$show_colon." </span>":"";
								$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
					
									$event_output .= apply_filters( 'decm_events_price_tag_start', '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">', $atts, $event_post ) .
											   apply_filters( 'decm_events_price',$showlabel.$stacklabel." ".'<span class="decm_price">'.esc_html( $event_cost ), $atts, $event_post, $excerptLength ) .
											   apply_filters( 'decm_events_price_tag_end', '</span></span>', $atts, $event_post );
																
								}
								//else{}
							}
								
								break;
							
							case 'show_rsvp_feed':
									if ( self::isValid( $atts['show_rsvp_feed'] ) ) {
										if (is_plugin_active('event-tickets/event-tickets.php')) {
											// $event_link = tribe_get_event_link($event_post->ID);
											
											$get_event_link = tribe_get_event_link($event_post->ID);
											$event_link = $get_event_link . '#rsvp-now';
											
											$rsvp_data = Tribe__Tickets__Tickets::get_ticket_counts($event_post->ID);
											$available_rsvp = 0;
											$unlimited_rsvp = false;
											$rsvp__label = '';
											if (isset($rsvp_data['rsvp'])) {
												$available_rsvp = isset($rsvp_data['rsvp']['stock']) ? $rsvp_data['rsvp']['stock'] : 0;
												$unlimited_rsvp = isset($rsvp_data['rsvp']['unlimited']) ? $rsvp_data['rsvp']['unlimited'] : false;
											}
											if (isset($rsvp_data['rsvp']['count']) && $rsvp_data['rsvp']['count'] > 0) {
												$showicon = ($atts['show_icon_label'] === "label_icon" || $atts['show_icon_label'] === "icon") && $atts['show_data_one_line'] == 'true' ? "price-ecs-icon" : "";
												$rsvp_custom_label = __('RSVP', 'decm-divi-event-calendar-module');
												if (!empty($atts['rsvp_detail_label'])) {
													$rsvp_custom_label = __($atts['rsvp_detail_label'], 'decm-divi-event-calendar-module'); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
												}
												$showlabel = ($atts['show_icon_label'] === "label_icon" || $atts['show_icon_label'] === "label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>' . $rsvp_custom_label . $show_colon . " </span>" : "";
												$stacklabel = $atts['stack_label_icon'] === 'true' ? "<br>" : "";
												
												// Set RSVP label based on availability
												if ($available_rsvp == 0) {
													$rsvp__label =  __('Currently Full', 'decm-divi-event-calendar-module');                            
												} elseif ($available_rsvp == -1 && $unlimited_rsvp) {
													$rsvp__label =  __('Unlimited', 'decm-divi-event-calendar-module');                                
												} else {

													if($available_rsvp > 1 ){
												       $Place_left  =	__('Places Left', 'decm-divi-event-calendar-module');
													}else{
														$Place_left  =	__('Place Left', 'decm-divi-event-calendar-module');
													}
														
													$spaceRespond = $atts['show_rsvp_feed_respond'] == 'true' && $atts['show_rsvp_feed_left'] == 'true' ? ' - ' : ' ';
													$rsvp__label = esc_html($spaceRespond) . esc_html($available_rsvp) . ' ' . esc_html($Place_left);
												}
									
												// Generate event output
												$event_output .= apply_filters('decm_event_price_tag_start', '<span class="' . $classShowDataOneLine . ' ecs-price ' . $showicon . '">', $atts, $event_post) .
												apply_filters('decm_event_price', 
													$showlabel . $stacklabel . " " . 
													($available_rsvp != 0 && $atts['show_rsvp_feed_respond'] == 'true'
														? '<span class="decm_price"><a class="show_rsvp_feed_custom"  href="' . $event_link . '" >' . __('Respond Now', 'decm-divi-event-calendar-module') . '</a></span>' 
														: ''
													), 
													$atts, 
													$event_post, 
													$excerptLength
												). 
												(
													// Condition for the ticket-label span
													($atts['show_rsvp_feed_left'] == 'true'  ? ' <span class="ticket-label">' . $rsvp__label . '</span>' 
: ''
													)
												). 
												apply_filters('decm_event_price_tag_end', '</span></span>', $atts, $event_post);

												
											}
										}
									}
								
								break;
						
							case 'show_price_ticket':
								if (self::isValid($atts['show_price_ticket'])) {
									// Check if the event-tickets plugin is active
									if (is_plugin_active('event-tickets/event-tickets.php')) {
										// $event_link = tribe_get_event_link($event_post->ID);
										
										$get_event_link = tribe_get_event_link($event_post->ID);
										$event_link = $get_event_link . '#tribe-tickets__tickets-form';

										if (tribe_get_cost($event_post->ID, true) != null) {
											$showicon = ($atts['show_icon_label'] === "label_icon" || $atts['show_icon_label'] === "icon") && $atts['show_data_one_line'] == 'true' ? "price-ecs-icon" : "";
											$price_custom_label = __('Ticket', 'decm-divi-event-calendar-module');
											if (!empty($atts['price_ticket_label'])) {
												$price_custom_label = __($atts['price_ticket_label'], 'decm-divi-event-calendar-module'); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
											}
											$showlabel = ($atts['show_icon_label'] === "label_icon" || $atts['show_icon_label'] === "label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>' . $price_custom_label . $show_colon . " </span>" : "";
											$stacklabel = $atts['stack_label_icon'] === 'true' ? "<br>" : "";
											
											$Tickets_data = Tribe__Tickets__Tickets::get_ticket_counts($event_post->ID);
											
											if(isset($Tickets_data['tickets']['available']) > 0){
												$available_tickets = $Tickets_data['tickets']['available'];
												$ticket__label = '';
												$event__price = '';
												
												$isPrice__free = tribe_get_cost($event_post->ID, true);
												$raw__price = explode('–', $isPrice__free);
												$priceArray = array_map('trim', $raw__price);
												$is__price_exists = array_key_exists(1, $priceArray);
												
												$is__price__onFirstIndex = array_key_exists(0, $priceArray);
				
												if ($is__price_exists) {
													$event__price = $priceArray[1];
													
												}elseif($is__price__onFirstIndex){
													$event__price = $priceArray[0];
													if($event__price === 'Free'){
														$event__price =__('Free', 'decm-divi-event-calendar-module');
													}


													
												}else {
													// $event__price = "Free";
													$event__price =  __('Free', 'decm-divi-event-calendar-module');
													
												}
												if ($Tickets_data['tickets']['count'] > 0) {


													if ($available_tickets == 0) {
														$ticket__label =  __('Sold Out', 'decm-divi-event-calendar-module');                            
													}else{
														if($available_tickets == -1) {
															$Place_left =  __('Unlimited', 'decm-divi-event-calendar-module');                                
														}elseif($available_tickets > 1 ){
															$Place_left  =	$available_tickets.' '.__('Places Left', 'decm-divi-event-calendar-module');
														 }else{
															 $Place_left  =	$available_tickets.' '.__('Place Left', 'decm-divi-event-calendar-module');
														 }
														
														 $Purchase_Now = $atts['show_ticket_feed_respond'] == 'true' ? '<a href="' . $event_link . '" class="price_link_ticket price_link_custom__a" >'.__('Purchase Now', 'decm-divi-event-calendar-module').'</a> ' : '';
														 $spaceRespond = $atts['show_ticket_feed_respond'] == 'true' && $atts['show_ticket_feed_left'] == 'true' ? ' - ' : ' ';	
														 $show_ticket_feed_left = $atts['show_ticket_feed_left'] == 'true'  ? esc_html($Place_left) :'';
														 $ticket__label = $Purchase_Now.esc_html($spaceRespond) . ' ' . esc_html($show_ticket_feed_left);
													}
												}
								
													$event_output .= apply_filters('decm_event_price_tag_start', '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">', $atts, $event_post) .
														apply_filters('decm_event_price', $showlabel . $stacklabel . " " . '<span class="decm_price">' . $event__price, $atts, $event_post, $excerptLength) .
														' <span class="ticket-label ">'.$ticket__label.'</span>' .
														apply_filters('decm_event_price_tag_end', '</span></span>', $atts, $event_post);

											}else{
												$event_output .= '';
											}
											
												
										}
									}
								}
								break;
							
							case 'thumbnail':
									if ( self::isValid( $atts['thumb'] ) ) {

										if($atts['image_align'] == 'topimage_bottomdetail' &&  ($atts['columns'] == 1 || $atts['columns'] == 2)){
											$event_output.='<div class="'.$image_center.' col-md-'.($atts['columns'] == 1 ? '12' : '12').'">';
											$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										}
										elseif($atts['image_align'] == 'centerimage_bottomdetail' &&  ($atts['columns'] == 1 || $atts['columns'] == 2)){
											$event_output.='<div class="decm-show-image-center col-md-'.($atts['columns'] == 1 ? '12' : '12').'">';
											$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										
										}
			
									   elseif( $atts['layout'] == 'list' &&  ($atts['list_layout'] == 'rightimage_leftdetail' || $atts['list_layout'] == 'leftimage_rightdetail' ||  $atts['list_layout'] == 'calloutimage_rightdetail' ||  $atts['list_layout'] == 'calloutimage_rightdetailButton') ){

				
									   $decm_show_callout_box_grid = $atts['show_callout_box'] == "true" ? '<a class="'.$disable_event_image_link.'"  href="' . esc_attr($custom_event_link_url).'" target="'.esc_attr($atts['custom_event_link_target']).'"><div class="callout-box-list-on-Image">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div></a>' : '';	
										// $event_output .= $decm_show_callout_box_grid;
										if ( self::isValid( $atts['thumb'] ) ) {
											$decm_show_callout_box_grid = $decm_show_callout_box_grid; 
										}else{
											$decm_show_callout_box_grid = ""; 
										}
										if( $atts['list_layout'] == 'calloutimage_rightdetail' ||  $atts['list_layout'] == 'calloutimage_rightdetailButton'){
											$event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').' col-'.($atts['list_columns'] <= 2 ? '4' : '12').' ">'.$decm_show_callout_box_grid.'';
										    $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										}else{
											$event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').' col-'.($atts['list_columns'] <= 2 ? '4' : '12').' ">';
										    $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										}
												
									   }elseif( $atts['layout'] == 'list' && ($atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail')  ){
	
										    $event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').' col-'.($atts['list_columns'] <= 2 ? '4' : '12').'">';
										    $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										
									   }elseif( $atts['layout'] == 'list' && ($atts['list_layout'] == 'calloutleftimage_rightdetailButton' || $atts['list_layout'] ==  'calloutrightimage_leftdetailButton') ){
	
										$event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '3' : '12').' col-'.($atts['list_columns'] <= 2 ? '3' : '12').' ">';
										$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
										$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
									
								      }elseif($atts['layout'] == 'cover'){								
										   $event_output.='<div  style = "display:none;"  class="'.$image_center.' col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
										   $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
									   }else{
											$event_output.='<div  class="'.$image_center.'  col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
											$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
									   }

									   
		
										if( !empty( $thumbWidth ) ) {

											$thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight,'class'=>" ecs_event_feed_image" ), $atts, $event_post ) );
											//echo $thumb;

											if( !empty( $thumb ) &&  $atts['layout'] == 'cover' ){
												$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a class="'.$disable_event_image_link.'" style="display:none;" href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail_link_end', '<span class="dec_image_overlay" data-icon="'.$atts['hover_icon'].'" data-icon-tablet="'.$atts['hover_icon_tablet'].'" data-icon-phone="'.$atts['hover_icon_phone'].'"></span></a>', $atts, $event_post );
											}
											elseif ( !empty( $thumb ) &&  $atts['layout'] == 'grid' ) {
												$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a class="'.$disable_event_image_link.' dec-image-overlay-url"  href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail_link_end', ''.$decm_show_callout_box.'<span class="dec_image_overlay dec_overlay_inline_icon" data-icon="'.$atts['hover_icon'].'" data-icon-tablet="'.$atts['hover_icon_tablet'].'" data-icon-phone="'.$atts['hover_icon_phone'].'"></span></a>', $atts, $event_post );

											}elseif ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight,'class'=>" ecs_event_feed_image" ), $atts, $event_post ) ) ) {
												$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a class="'.$disable_event_image_link.' dec-image-overlay-url" href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail_link_end', '<span class="dec_image_overlay dec_overlay_inline_icon" data-icon="'.$atts['hover_icon'].'" data-icon-tablet="'.$atts['hover_icon_tablet'].'" data-icon-phone="'.$atts['hover_icon_phone'].'"></span></a>', $atts, $event_post );
											}
											else if(empty( $thumb )&&  $atts['layout'] == 'grid'){
												$decm_show_callout_box_grid = $atts['show_callout_box'] == "true" ? '<a class="'.$disable_event_image_link.'"  href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'"><div class="callout-box-cover">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div></a>' : '';	
												$event_output .= $decm_show_callout_box_grid;
											}

										} else {
											
											if ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight,'class'=>" ecs_event_feed_image" ), $atts, $event_post ) ) ) {
												$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a class="'.$disable_event_image_link.'" href="' . $custom_event_link_url . '" target="'.$atts['custom_event_link_target'].'">', $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail_link_end', '<span class="dec_image_overlay"></span></a>', $atts, $event_post );
											}
										}
										$event_output.='</div >';
									}
						break;
						case 'excerpt':
							if ( self::isValid( $atts['excerpt'] ) ) {
								
								$excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 100;
								
							if($atts["excerpt_content"]=="excerpt_show"){
								if(self::get_excerpt($event_post,$excerptLength )!=null && has_excerpt($event_post->ID)){
								$event_output .= apply_filters( 'decm_events_excerpt_tag_start', '<p class="'.$classShowDataOneLine.' ecs-excerpt">', $atts, $event_post ) .
								           apply_filters( 'decm_events_excerpt', self::get_excerpt($event_post, $excerptLength ), $atts, $event_post, $excerptLength ) .
								           apply_filters( 'decm_events_excerpt_tag_end', '</p>', $atts, $event_post );
							}
						}
						if ($atts["excerpt_content"] == "_show") {
							//print_r($atts["excerpt_content"]);
							$excerpt = self::get_content($event_post->ID, $excerptLength);
							// Normalize line breaks
							$excerpt = str_replace(array("\r\n", "\r", "\n"), "<br>", $excerpt);
							if ($excerpt != null && $atts['show_data_one_line'] == 'true') {
								$event_output .= apply_filters('decm_event_excerpt_tag_start', '<div class="' . $classShowDataOneLine . ' ecs-excerpt">', $atts, $event_post) .
									apply_filters('decm_event_excerpt', $excerpt, $atts, $event_post, $excerptLength) .
									apply_filters('decm_event_excerpt_tag_end', '</div>', $atts, $event_post);
							} else {
								$event_output .= apply_filters('decm_event_excerpt_tag_start', '<div class="' . $classShowDataOneLine . ' ecs-excerpt">', $atts, $event_post) .
									apply_filters('decm_event_excerpt', $excerpt, $atts, $event_post, $excerptLength) .
									apply_filters('decm_event_excerpt_tag_end', '</div>', $atts, $event_post);
							}
						}	
						}
					//	preg_replace('/\[\/?et_pb.*?\]/', '',tribe_get_the_content($event_post->ID,$strip_teaser = true))
							break;
						
							case 'weburl':
								if ( self::isValid( $atts['weburl'] ) ) {
									if ( tribe_get_event_website_link($event_post)!=null){
										$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "weburl-ecs-icon":" ";
										$website_custom_label = __('Website','decm-divi-event-calendar-module');
										if(!empty($atts['website_detail_label'])){
											$website_custom_label =  __($atts['website_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
										$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.$website_custom_label.$show_colon." </span>":"";
										$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
											$event_output .=  apply_filters( 'decm_events_weburl_tag_start', '<span class="'.$classShowDataOneLine.' ecs-weburl '.$showicon.'">', $atts, $event_post ) .
											   apply_filters( 'decm_events_weburl',$showlabel.$stacklabel, $atts, $event_post) .
											   apply_filters( 'decm_events_weburl',($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<span class="decm_weburl"><a href="'.$result.'" target="'.$atts['custom_website_link_target'].'">'.$custom_website_link_text.'</a></span>':'<span class="decm_weburl"><a href="'.$result.'" target="'.$atts['custom_website_link_target'].'">'.tribe_get_event_website_url($event_post->ID).'</a></span>', $atts, $event_post) . 
											   apply_filters( 'decm_events_weburl_tag_end', '</span></span>', $atts, $event_post );
										
											 //  apply_filters( 'decm_events_weburl_tag_end', '', $atts, $event_post );
								}
							
							}
							$event_output.='</div>';
								break;
	

								case 'date':
								
									$datetime_separator       = tribe_get_option( 'dateTimeSeparator', ' @ ' );
									$time_range_separator     = tribe_get_option( 'timeRangeSeparator', ' - ' );
									$time_range_separator     = $atts['show_end_time']== "true"? $time_range_separator:"";
	
									$event_output .= '<div class="decm-show-detail-center">';
									if ( self::isValid( $atts['eventdetails'] ) || $atts['showtime']=="false" || $atts['showtime']=="true" ) {
										if($atts['showtime']== 'true' || $atts['showtime']=="false" ){
										if($atts['show_data_one_line'] == 'true'){
											
											$time_custom_label = __('Time','decm-divi-event-calendar-module');
											if(!empty($atts['time_detail_label'])){
												$time_custom_label =  __($atts['time_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
											}

											$date_custom_label = __('Date','decm-divi-event-calendar-module');
											if(!empty($atts['date_detail_label'])){
												$date_custom_label =  __($atts['date_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
											}

											$showlabeltime= ($atts['show_icon_label']=="label" || $atts['show_icon_label']=="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$time_custom_label.$show_colon." </span>":"";
											$showlabeldate= ($atts['show_icon_label']=="label" || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?'<span class=ecs-detail-label>'.$date_custom_label.$show_colon." </span>":"";
											$showicontime=  ($atts['show_icon_label']=="icon"  || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true' ?"eventTime-ecs-icon":"";
											$showicondate=  ($atts['show_icon_label']=="icon"  || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?"eventDate-ecs-icon":"";
											$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
											//	if($atts['show_icon_label']=="label" && $atts['show_data_one_line'] == 'true'){$showlabeldate="<span class=ecs-detail-label>Date: </span>";$showlabeltime="<span class=ecs-detail-label>Time: </span>";}
										//elseif($atts['show_icon_label']=="icon" && $atts['show_data_one_line'] == 'true'){$showicondate="eventDate-ecs-icon"; $showicontime="eventTime-ecs-icon"; }
										
										
												 
				
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
							{
								if(self::isValid( $atts['eventdetails'])){
								
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time  '.$showicondate.'">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
										if(!is_null(tribe_get_start_time($event_post->ID))  && $atts['showtime']=="true"){
										$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ? $showlabeltime.$stacklabel.' '.$datetime_separator.' '.'<span class="decm_time">'.$start_time : $showlabeltime.$stacklabel.'<span class="decm_time">'.$start_time, $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
									   }
	
											
									  }else{
										if(!is_null(tribe_get_start_time($event_post->ID))  && $atts['showtime']=="true"){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ? $showlabeltime.$stacklabel.' '.$datetime_separator.' '.'<span class="decm_time">'.$start_time : $showlabeltime.$stacklabel.'<span class="decm_time">'.$start_time, $atts, $event_post ) .
											apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
										   }
									}
	
									}
	
									  if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
							{	
							
								if(self::isValid( $atts['eventdetails'])){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
											//apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
											if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
											//apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?" @ ".$start_time : $start_time, $atts, $event_post ) .
											apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.'<span class="decm_time">'.$datetime_separator.' '.$end_time :$showlabeltime.$stacklabel."".'<span class="decm_time">'. $end_time, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										   }
										}else{	
											if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
												$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
												//apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?" @ ".$start_time : $start_time, $atts, $event_post ) .
												apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.'<span class="decm_time">'.$datetime_separator.' '.$end_time :$showlabeltime.$stacklabel."".'<span class="decm_time">'. $end_time, $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											   }
											}		
							}
	
							if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
							{	
								
								if(self::isValid( $atts['eventdetails'])){
									
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
									//apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
								if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
								
										$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.$datetime_separator.'<span class="decm_date">'.' '.$start_time : $showlabeltime.$stacklabel.'<span class="decm_date 87">'.$start_time, $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
								}
								}else{			
										if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
										$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.$datetime_separator.'<span class="decm_date">'.' '.$start_time : $showlabeltime.$stacklabel.'<span class="decm_date">'.$start_time, $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
									}
								}
										
							}
							if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
							{
								
								if(self::isValid( $atts['eventdetails'])){
										$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
										if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
										$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.'<span class="decm_time">'.$datetime_separator.' '.$start_time : $showlabeltime.$stacklabel.'<span class="decm_time">'.$start_time, $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?" ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
										}
									}else{	
										if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.' '.'<span class="decm_time">'.$datetime_separator.' '.$start_time : $showlabeltime.$stacklabel.'<span class="decm_time">'.$start_time, $atts, $event_post ) .
											apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?" ".$time_range_separator." ".$end_time :$time_range_separator. $end_time, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
											}
									}
							
										
							}
							if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&(is_null(tribe_get_start_time($event_post->ID,get_option( 'time_format' )))&& is_null(tribe_get_end_time($event_post->ID,get_option( 'time_format' )))))
							{	
	
								if($atts['showtime']=="true"){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details', $showlabeltime.$stacklabel.' '.'<span class="decm_time">'.__('All Day Event','decm-divi-event-calendar-module') , $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								}
															
										
							}
							if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&(is_null(tribe_get_start_time($event_post->ID,get_option( 'time_format' )))&& is_null(tribe_get_end_time($event_post->ID,get_option( 'time_format' )))))
							{
								if($atts['showtime']=="true"){
										$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details', $showlabeltime.$stacklabel.' <span class="decm_time">'.__('All Day Event','decm-divi-event-calendar-module') , $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
							}
						}
	
									  
						}
										
										elseif($atts['show_data_one_line']=="false"){
										
											
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
										
									if(self::isValid( $atts['eventdetails'])){
											$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration decm_date">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
										}
											
										$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										
										
										if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
										$event_output.=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										}
									}else{
	
										if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
										}
	
										if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
											$event_output.=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											}
	
									}
	
									}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
											if(self::isValid( $atts['eventdetails'])){
											$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											}
										}else{
											if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
												$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
												}
										}
										}
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
	
	
												if(self::isValid( $atts['eventdetails'])){
												$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
												if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){	
													$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
												}
												$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											
												if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
													$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
												}
											}else{
	
												if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){	
													$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
												}
											
											
												if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
													$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$end_time:" ".$end_time,  $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
												}
	
											}
												}
												if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
													if(self::isValid( $atts['eventdetails'])){
													$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
													apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
													apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
													if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){	
														$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
													apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
													apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
													}
													if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
													$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
													apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time:" ".$time_range_separator." ".$end_time,  $atts, $event_post ) .
													apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
													}
												}else{
													
													if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){	
														$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
													apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? ' '.$datetime_separator.' '.$start_time:" ".$start_time,  $atts, $event_post ) .
													apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
													}
													if(!is_null(tribe_get_start_time($event_post->ID)) && $atts['showtime']=="true"){
													$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
													apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " ".$time_range_separator." ".$end_time:" ".$time_range_separator." ".$end_time,  $atts, $event_post ) .
													apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
													}
												}
												}
												if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&(is_null(tribe_get_start_time($event_post->ID,get_option( 'time_format' )))&& is_null(tribe_get_end_time($event_post->ID,get_option( 'time_format' )))))
												{
												
															if($atts['showtime']=="true"){
																$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
																apply_filters( 'decm_events_list_details', __(' All Day Event ','decm-divi-event-calendar-module') , $atts, $event_post ) ;
															}
															
				
														  }
														  if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&(is_null(tribe_get_start_time($event_post->ID,get_option( 'time_format' )))&& is_null(tribe_get_end_time($event_post->ID,get_option( 'time_format' )))))
														  {
														
															if($atts['showtime']=="true"){
																	  $event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
																	  apply_filters( 'decm_events_list_details', __(' All Day Event ','decm-divi-event-calendar-module') , $atts, $event_post ) ;
															}
						  
														}
										}
	
									}
										elseif($atts['showtime']=="false"){
	
					
	
										if($atts['show_data_one_line'] == 'true'){
	
											$showlabeldate= ($atts['show_icon_label']=="label" || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?'<span class=ecs-detail-label>'.__('Date','decm-divi-event-calendar-module').$show_colon." </span>":"";
											$showicondate=  ($atts['show_icon_label']=="icon"  || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?"eventDate-ecs-icon":" ";
											$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
											$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time  '.$showicondate.'">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
											}
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
												$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
												}
											}
											
											elseif($atts['show_data_one_line']=="false"){
												if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
											$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post ).
											apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											}
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
												$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
												}
											}
	
										}
									
									}
									// $event_output.='</div>';
									break;
							
							

						case 'venue':
							if ( self::isValid( $atts['venue'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								if(tribe_get_venue($event_post->ID)!=null){
									$enable_venue_link =$atts['enable_venue_link']=="true"&&class_exists( 'Tribe__Events__Pro__Main' )?'<a href="'.$result_venue.'" target="'.$atts['custom_venue_link_target'].'">'.tribe_get_venue($event_post->ID).'</a>':tribe_get_venue($event_post->ID);
								$showicon = ($atts['show_icon_label']==="icon" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?"venue-ecs-icon":"";
								$venue_custom_label = __('Venue','decm-divi-event-calendar-module');
										if(!empty($atts['venue_detail_label'])){
											$venue_custom_label =  __($atts['venue_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
								$showlabel = ($atts['show_icon_label'] ==="label" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$venue_custom_label.$show_colon." </span>":"";
								$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
										$event_output .= apply_filters( 'decm_events_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-venue duration venue '.$showicon.'">', $atts, $event_post ) .
								        //   apply_filters( 'decm_events_venue_at_tag_start', '<span> ', $atts, $event_post ) .
								           apply_filters( 'decm_events_venue_at_text',__($atts['show_preposition'] == 'true' ? $showlabel.$stacklabel.'<span class="decm_venue"><em> '.__('at ', 'decm-divi-event-calendar-module').' </em>' : $showlabel.$stacklabel.'<span class="decm_venue">' ), $atts, $event_post ) .//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
								        //   apply_filters( 'decm_events_venue_at_tag_end', ' </span>', $atts, $event_post ) .
								           apply_filters( 'decm_events_list_venue',$atts['show_icon_label']==="icon"?"".$enable_venue_link:" ".$enable_venue_link, $atts, $event_post ) .
										   apply_filters( 'decm_events_venue_tag_end', '</span></span>', $atts, $event_post );					   
								 
							}
							//else{}
						}

							
							break;
						/**
						 * Show location of venue
						 *
						 * @author bojana
						 *
						 */
						case 'location':
							//print_r(tribe_get_venue($event_post->ID));
							if ( self::isValid( $atts['location'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								if(tribe_get_full_address($event_post->ID) !="<span class=\"tribe-address\">\n\n\n\n\n\n\n</span>\n" ){
									
									$dec_country_comma=$atts['location_country_comma'] == "true" && $atts['location'] == "true"?", ":" ";
									$dec_locality_comma=$atts['location_locality_comma'] == "true" && $atts['location'] == "true"?", ":" ";
									$dec_postal_code_comma=$atts['location_postal_code_comma'] == "true" && $atts['location'] == "true"?", ":" ";
									$dec_street_comma=$atts['location_street_comma'] == "true" && $atts['location'] == "true"?", ":" ";
									$dec_state_comma=$atts['show_location_state_comma'] == "true" && $atts['location'] == "true"?", ":" ";
									$dec_location_street = $atts['location_street_address'] == "true" && $atts['location'] == "true" && tribe_get_address($event_post->ID)!=null? tribe_get_address($event_post->ID).$dec_street_comma:"";
									$dec_location_locality = $atts['location_locality'] == "true" && $atts['location'] == "true" &&tribe_get_city($event_post->ID)!=null ? tribe_get_city($event_post->ID).$dec_locality_comma:""; 
									$dec_location_postal = $atts['show_postal_code_before_locality']=='false'&& $atts['location_postal_code'] == "true" && $atts['location'] == "true"&&tribe_get_zip($event_post->ID)!=null ? tribe_get_zip($event_post->ID).$dec_postal_code_comma:""; 
									$dec_location_country = $atts['location_country'] == "true" && $atts['location'] == "true"&&tribe_get_country($event_post->ID)!=null ? tribe_get_country($event_post->ID).$dec_country_comma:""; 
									$dec_location_state = $atts['show_location_state']=="true" && $atts['location'] == "true" &&tribe_get_province($event_post->ID)!=null?tribe_get_province($event_post->ID).$dec_state_comma:(($atts['show_location_state']=="true" && $atts['location'] == "true" &&tribe_get_region($event_post)!=null)?tribe_get_region($event_post).$dec_state_comma:"");
									$show_postal_code_before_locality=$atts['show_postal_code_before_locality']=='true'&& $atts['location_postal_code'] == "true" && $atts['location'] == "true"&&tribe_get_zip($event_post->ID)!=null ? tribe_get_zip($event_post->ID).$dec_postal_code_comma:""; 
									$showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "event-location-ecs-icon":"";
									$location_custom_label = __('Location','decm-divi-event-calendar-module');
										if(!empty($atts['location_detail_label'])){
											$location_custom_label =  __($atts['location_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
									$showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.$location_custom_label.$show_colon." </span>":"";
									$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
										$event_output .= apply_filters( 'decm_events_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-location duration venue '.$showicon.'">', $atts, $event_post ) .
								        //    apply_filters( 'decm_events_list_location_int_tag_start', '<em> ', $atts, $event_post ) .
										   apply_filters( 'decm_events_venue_in_text',( $atts['show_preposition']=='true'?$showlabel.$stacklabel.'<span class="decm_location"><em>'.__('in ', 'decm-divi-event-calendar-module').'</em>': $showlabel.$stacklabel.'<span class="decm_location">' ), $atts, $event_post ) .
								        //    apply_filters( 'decm_events_list_location_int_tag_end', ' </em>', $atts, $event_post ) .
										   apply_filters( 'decm_events_list_location',($atts['show_data_one_line'] =='false'? $dec_location_street.$show_postal_code_before_locality.$dec_location_locality.$dec_location_state.$dec_location_postal.$dec_location_country : str_replace('','',$dec_location_street.$show_postal_code_before_locality.$dec_location_locality.$dec_location_state.$dec_location_postal.$dec_location_country)), $atts, $event_post)  .	
								           apply_filters( 'decm_events_venue_tag_end', '</span></span>', $atts, $event_post );
							// else{}
							}
						}
							
							break;

							case 'tags':
								if ( self::isValid( $atts['tags'] ) ) {	
							 
									// $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
									$tags = $atts['hide_comma_tag'] == 'false' ? implode(", ", $tag_names): implode(" ", $tag_names);
									$tags_separator = $tags ? '|' : ' ';
									$tags_sep  =	$atts['show_preposition'] == 'true' ? $tags_separator :(($atts['show_icon_label']==="icon")? "":" ");
									// $tags_sep  =	$atts['show_preposition'] == 'true' ? $tags_separator : " ";
								if(et_core_esc_wp( $tags )!=null){
										$showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "tags-ecs-icon":"";

										$tag_custom_label = __('Tag','decm-divi-event-calendar-module');
										if(!empty($atts['tag_detail_label'])){
											$tag_custom_label =  __($atts['tag_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}

										$showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.$tag_custom_label.$show_colon." </span>":"";
										$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
	
										$event_output .= apply_filters( 'decm_events_tag_start', '<span class="'.$classShowDataOneLine.'ecs-tags '.$showicon.'">', $atts, $event_post ) .
										et_core_intentionally_unescaped($showlabel.$stacklabel.$tags_sep, 'fixed_string' ).
												apply_filters( 'decm_events_tags', et_core_esc_wp( $tags ), 
												$atts, $event_post, $excerptLength ) .
												apply_filters( 'decm_events_tag_end', '</span>', $atts, $event_post );
									
										
								}
								else{}
							}
								
								//$event_output.='</div>';
								break;
						/**
						 * Show categories of every events
						 *
						 * @author bojana
						 */
						case 'categories':
							if ( self::isValid( $atts['categories'] ) ) {	
						
								// $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
								$categories = $atts['hide_comma_cat'] == 'false' ? implode(", ", $category_names): implode(" ", $category_names);
								$categories_separator = $categories ? '|' : ' ';
								$categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator :(($atts['show_icon_label']==="icon")? "":" ");
								// $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
							if(et_core_esc_wp( $categories )!=null){
									$showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "categories-ecs-icon":"";

									$category_custom_label = __('Category','decm-divi-event-calendar-module');
									if(!empty($atts['category_detail_label'])){
										$category_custom_label =  __($atts['category_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
									}
									
								    $showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.$category_custom_label.$show_colon." </span>":"";
								    $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";

									$event_output .= apply_filters( 'decm_events_categories_tag_start', '<span class="'.$classShowDataOneLine.'ecs-categories '.$showicon.'">', $atts, $event_post ) .
									et_core_intentionally_unescaped($showlabel.$stacklabel.$categories_sep, 'fixed_string' ).
											apply_filters( 'decm_events_categories', et_core_esc_wp( $categories ), 
											$atts, $event_post, $excerptLength ) .
								            apply_filters( 'decm_events_categories_tag_end', '</span>', $atts, $event_post );
								
									
							}
							else{}
						}
							
							//$event_output.='</div>';
							break;
							
						/**
						 * Show more in detail of every events
						 *
						 * @author bojana
						 */
							
						case 'showdetail':
							if ( self::isValid( $atts['showdetail']) ) {
			
								$more_info_button_meta_key = get_post_meta( $event_post->ID, '_more_info_button_meta_key', true );
								$button_text_custom = "";
								if(!empty($more_info_button_meta_key)){
									$button_text_custom = $more_info_button_meta_key;
								}else{
									$button_text_custom = $atts['view_more_text'];
								}
													
								$button_classes ="act-view-more et_pb_button";
								$button_classes = $atts['button_make_fullwidth'] ==  'on' ? "act-view-more et_pb_button act-view-more-fullwidth" : $button_classes;
								$view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
                                $icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
								$button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
								
								if($atts['layout'] == 'list' &&  ($atts['list_layout'] == 'rightimage_leftdetail' || $atts['list_layout'] == 'leftimage_rightdetail'  || $atts['list_layout'] == 'calloutrightimage_leftdetail' || $atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail' || $atts['list_layout'] == 'calloutimage_rightdetail' ) ){
									$event_output .= apply_filters( 'decm_events_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $button_text_custom, $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'decm_events_showdetail_tag_end', '</p>', $atts, $event_post );
								}elseif($atts['layout'] == 'grid' ){
									$event_output .= apply_filters( 'decm_events_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $button_text_custom, $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'decm_events_showdetail_tag_end', '</p>', $atts, $event_post );
								}else if($atts['layout'] == 'cover'){
									$event_output .= apply_filters( 'decm_events_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $button_text_custom, $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'decm_events_showdetail_tag_end', '</p></div>', $atts, $event_post );

								}
								
							}
												
							$event_output.='</div></div>';
							break;
							case 'button':
								if ( self::isValid( $atts['showdetail']) ) {
									
									$button_classes ="act-view-more et_pb_button";
									$button_classes = $atts['button_make_fullwidth'] ==  'on' ? "act-view-more et_pb_button act-view-more-fullwidth" : $button_classes;
									$view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
									$icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
									$button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
									
									if($atts['layout'] == 'cover'){
										$event_output .= apply_filters( 'decm_events_showdetail_tag_start', '<div class="col-md-2 col-2 "><p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
											apply_filters( 'decm_events_showdetail_tag_end', '</p></div></div></div>', $atts, $event_post );

									 }else{
										$event_output .= apply_filters( 'decm_events_showdetail_tag_start', '<div class="col-md-2 col-2 "><p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
											apply_filters( 'decm_events_showdetail_tag_end', '</p></div>', $atts, $event_post );

									 }

								}
								break;
						case 'date_thumb':
							if ( self::isValid( $atts['eventdetails'] ) ) {
								$event_output .= apply_filters( 'decm_events_date_thumb', '<div class="date_thumb"><div class="month">' . tribe_get_start_date( null, false, 'M' ) . '</div><div class="day">' . tribe_get_start_date( null, false, 'j' ) . '</div></div>', $atts, $event_post );
							}
							break;
						default:
							$event_output .= apply_filters( 'decm_events_list_output_custom_' . strtolower( trim( $contentorder ) ), '', $atts, $event_post );
					}
				
				}
				

				$event_output .= '</div>';

			//	$event_output.=  ;
			$event_output.=$atts['whole_event_clickable']=='true'?'<a class="ecs_event_clickable " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'"></a>':"";
				$event_output .= apply_filters( 'decm_events_end_tag', '</article></div>', $atts, $event_post );

				
				
				$output .= apply_filters( 'dec_single_event_output', $event_output, $atts, $event_post, $post_index, $event_post );					
				
			}
	
			$output .= apply_filters( 'dec_end_tag', '</div>', $atts );

		
			if( self::isValid( $atts['viewall'] ) ) {
				$output .= apply_filters( 'dec_view_all_events_tag_start', '<span class="ecs-all-events">', $atts ) .
				           '<a href="' . apply_filters( 'decm_events_list_viewall_link', tribe_get_events_link(), $atts ) .'" rel="bookmark">' . apply_filters( 'dec_view_all_events_text', sprintf( __( 'View All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ), $atts ) . '</a>';//phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				$output .= apply_filters( 'dec_view_all_events_tag_end', '</span>' );
			}
		} else { //No Events were Found
			$output .= apply_filters( 'dec_no_events_found_message', sprintf( translate( '<div class="events-results-message">'.$atts['message'].'</div>', 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() ), $atts );//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText , WordPress.WP.I18n.LowLevelTranslationFunction
		} // endif

	
		if($atts['pagination_type']=="load_more" && $atts['show_pagination']=="true" && $max_pages > 1){
			
			$button_classes = "ecs-ajax_load_more et_pb_button";
			$icon_align =($atts['ajax_load_more_button_icon_placement']=="left")?"et_pb_ajax_align":"";
		$button_classes = ($atts['custom_ajax_load_more_button'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$icon_align : $button_classes;

		$output .= apply_filters( 'decm_events_showdetail_tag_start', '<div class="event_ajax_load et_pb_button_wrapper" >', $atts, $event_post ) .
						apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.'" href="' . "#" . '" onClick="return false;" rel="bookmark"  data-icon="'.$atts['ajax_load_more_button_icon'].'" data-icon-tablet="'.$atts['ajax_load_more_button_icon_tablet'].'" data-icon-phone="'.$atts['ajax_load_more_button_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['ajax_load_more_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
				apply_filters( 'decm_events_showdetail_tag_end', '</div>', $atts, $event_post );
		}else if($atts['pagination_type']=="numeric_pagination" && $atts['show_pagination']=="true" &&  $max_pages > 1){
	
			
			  $output .=   '<div class="ecs-event-pagination"></div>';
			  
		
		}else if($atts['pagination_type']=="paged" && $atts['show_pagination']=="true" && $max_pages > 1){
						$output .= '<div class="ecs-event_feed_pagination clearfix">
				<a class="ecs-page_alignment_left" style="display:none;" onClick="return false;" href="#">' .
					sprintf(
						esc_html__('&laquo; %s', 'Divi'),
						esc_html($atts['previous_entries_text'])
					) .
				'</a>
				<a class="ecs-page_alignment_right" onClick="return false;" href="#">' .
					sprintf(
						esc_html__('%s &raquo;', 'Divi'),
						esc_html($atts['next_entries_text'])
					) .
				'</a>
			</div>';
		}
	
		$ajax_load_url = $this->props['ajax_load_src'] != "" ? $this->props['ajax_load_src'] : plugin_dir_url(__FILE__).'ajax-loader.gif';
				
		$output.='
		<input type="hidden" name="dec-eventfeed-future-past" id="dec-eventfeed-future-past" value="">
		<input type="hidden" name="eventfeed_prev_page" id="eventfeed_prev_page" value="0">
		<input type="hidden" name="eventfeed_current_page" id="eventfeed_current_page" value="1">
		<input type="hidden" name="eventfeed_page" id="eventfeed_page" value="'.$atts["pagination_type"].'">
		<input type="hidden" name="eventfeed_current_pagination_page" id="eventfeed_current_pagination_page" value="1">
		<input type="hidden" name="module_css_feed" id="module_css_feed" value="'.$atts['module_css_class'].'">
		<input type="hidden" name="module-css-class" id="module-css-class" value="'.$this->props['module_css_class'].'" />
		<input type="hidden" name="dec-eventfeed-category" id="dec-eventfeed-category" value="">
		<input type="hidden" name="dec-eventfeed-tag" id="dec-eventfeed-tag" value="">
		<input type="hidden" name="dec-eventfeed-order" id="dec-eventfeed-order" value="">
		<input type="hidden" name="dec-eventfeed-venue" id="dec-eventfeed-venue" value="">
		<input type="hidden" name="dec-eventfeed-organizer" id="dec-eventfeed-organizer" value="">
		<input type="hidden" name="dec-filter-search" id="dec-filter-search" value="">
		<input type="hidden" name="dec-eventfeed-time" id="dec-eventfeed-time" value="">
		<input type="hidden" name="dec-eventfeed-day" id="dec-eventfeed-day" value="">
		<input type="hidden" name="dec-eventfeed-month" id="dec-eventfeed-month" value="">
		<input type="hidden" name="dec-eventfeed-year" id="dec-eventfeed-year" value="">
		<input type="hidden" name="dec-eventfeed-recurring" id="dec-eventfeed-recurring" value="">
		<input type="hidden" name="EventcostMin" id="EventcostMin" value="">
		<input type="hidden" name="EventcostMax" id="EventcostMax" value="">
		<input type="hidden" name="EventendDate" id="EventendDate" value="">
		<input type="hidden" name="EventstartDate" id="EventstartDate" value="">
		<input type="hidden" name="dec-eventfeed-country" id="dec-eventfeed-country" value="">
		<input type="hidden" name="dec-eventfeed-city" id="dec-eventfeed-city" value="">
		<input type="hidden" name="dec-eventfeed-state" id="dec-eventfeed-state" value="">
		<input type="hidden" name="dec-eventfeed-status" id="dec-eventfeed-status" value="">
		<input type="hidden" name="dec-eventfeed-address" id="dec-eventfeed-address" value="">
		<input type="hidden" name="dec-eventfeed-module-class" id="dec-eventfeed-module-class" value="'.$this->getrenderClassNameSelector($this->module_classname( $render_slug ),$render_slug).'">
		<input type="hidden" name="dec-eventfeed-page-translation" id="dec-eventfeed-page-translation" value="'.__('Page','decm-divi-event-calendar-module').'">
		<input type="hidden" name="dec-eventfeed-first-translation" id="dec-eventfeed-first-translation" value="'.__('First','decm-divi-event-calendar-module').'">
		<input type="hidden" name="dec-eventfeed-last-translation" id="dec-eventfeed-last-translation" value="'.__('Last','decm-divi-event-calendar-module').'">
		<input type="hidden" name="eventfeed_max_page" id="eventfeed_max_page" value="'.$max_pages.'"><input type="hidden" name="eventfeed_load_img" id="eventfeed_load_img" value="'.$ajax_load_url.'">';
		return $output;
		wp_reset_postdata();
		
	}
	
	static function get_blog_posts_events(  $atts = array(), $conditional_tags = array(), $current_page = array()  ) {
		global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content,$wpdb;
		$post_type = get_post_type();
		$query_args['paged'] = $paged;

		/**
		 * Check if events calendar plugin method exists
		 */


		if ( !function_exists( 'tribe_get_events' ) ) {
			return array();
		}
	
		global $post;
		$output = '';
	

		$atts = shortcode_atts( apply_filters( 'decm_events_atts', array(
			'cat' => $atts['included_categories'],
			'month' => '',
			'limit' => $atts['event_count'],
			//'events_to_load' => $atts['events_to_load'],
			'eventdetails' => 'true',
			'showtime' => 'true',
			'show_timezone' => 'true',
			'show_timezone_abb' => $atts['show_timezone_abb'],
			'disable_event_title_link'=>'false',
			'disable_event_image_link'=>'false',
			'disable_event_button_link'=>'false',
			'enable_category_links' => $atts['enable_category_links'],
			'enable_tag_links' => $atts['enable_tag_links'],
			'custom_tag_link_target'  => $atts['custom_tag_link_target'],
			'enable_organizer_link'=>$atts['enable_organizer_link'],
			'enable_venue_link'=>$atts['enable_venue_link'],
			'show_pagination'=>'true',
			'show_recurring_events' => $atts['show_recurring_events'],
			'show_postponed_canceled_event'=> $atts['show_postponed_canceled_event'],
			'show_virtual_hybrid_event' => $atts['show_virtual_hybrid_event'],
			'show_hybrid_event' => $atts['show_hybrid_event'],
			'show_virtual_event' => $atts['show_virtual_event'],
			'show_callout_day_of_week'=> $atts['show_callout_day_of_week'],
			'show_callout_month'=> $atts['show_callout_month'],
			'show_callout_date'=> $atts['show_callout_date'],
			'show_callout_year'=> $atts['show_callout_year'],
			'show_callout_time'=> $atts['show_callout_time'],
			'show_callout_date_range'=> $atts['show_callout_date_range'],
			'show_callout_time_range'=> $atts['show_callout_time_range'],
			'show_callout_month_range'=> $atts['show_callout_month_range'],
			'show_callout_year_range'=> $atts['show_callout_year_range'],
			'show_callout_day_of_week_range'=> $atts['show_callout_day_of_week_range'],
			'time' => null,
			'past' => $atts['show_past'],
			'featured_events' => 'false',
			'venue' => 'false',
			'location' => 'false',
			'show_location_state'=>$atts['show_location_state'],
			'organizer' => null,
			'price' => null,
			'show_rsvp_feed' => null,
			'show_rsvp_feed_respond' => null,
			'show_rsvp_feed_left' => null,
			'show_ticket_feed_respond' => '',
			'show_ticket_feed_left' => '',
			'weburl' => null,
			'website_link'=> $atts['website_link'],
			'custom_website_link_target'=>$atts['custom_website_link_target'],
			'custom_website_link_text'=>$atts['custom_website_link_text'],
			'categories' => 'false',
			'hide_comma_cat' => 'false',
			'tags' => 'false',
			'hide_comma_tag' => 'false',
			'schema' => 'true',
			'message' => '',
			'key' => 'End Date',
			'order' => $atts['event_order'], 
			'orderby' => 'startdate',
			'viewall' => 'false',
			'excerpt' => 'false',
			'excerpt_content'=>$atts['excerpt_content'],
			'showdetail' => 'false',
			'thumb' => 'false',
			'thumbsize' => '',
			'image_aspect_ratio'=>'',
			'thumbwidth' => '800',
			'thumbheight' => '800',
			'contentorder' => apply_filters( 'decm_details_order', ' thumbnail,title, title2, event_series_name, date, venue, location,location_province, organizer, price, show_rsvp_feed, show_price_ticket, categories, tags, excerpt,weburl, showdetail, callout_date,callout_time, pagination,event_status_check, more_info_button_meta_key, event_status_virtual,  event_status_hybrid,month_heading ,total_count', $atts ),
			'event_tax' => '',
			'date_format' => '',
			'shorten_multidate'=>'',
			'start_date_format'=>'',
			'time_format' => '',
			'callout_month_format'=>'',
			'callout_date_format'=>'',
			'callout_week_format'=>'',
			'callout_year_format'=>'',
			'callout_time_format'=>'',
			'layout' => '',
			'columns' => '',
			'button_align' => 'false',
			'image_align' => '',
			'cards_spacing' => '',
			'blog_offset' => '',	
			'cut_off_start_date'=>$atts['cut_off_start_date'],
			'cut_off_end_date'=>$atts['cut_off_end_date'],
			'event_past_future_cut_off'=>$atts['event_past_future_cut_off'],
			'cutoff_ongoing_events'=> $atts['cutoff_ongoing_events'],
			'view_more_text' => 'View More',
			'columns_phone' => '',
			'columns_tablet' => '',
			'included_categories' => '',
			'included_tags'   => $atts['included_tags'],
			'included_organizer' => $atts['included_organizer'],
			'included_organizer_check' => "",
			'included_venue' => $atts['included_venue'],
			'included_venue_check' => "",
			'included_series' => $atts['included_series'],
			'included_serries_check' => "",
			'date_selection_type'=>$atts['date_selection_type'],
			'event_by_reletive_date'=>$atts['event_by_reletive_date'],
			'included_date_range_start' => $atts['included_date_range_start'],
			'included_date_range_end'=>$atts['included_date_range_end'],
			'header_level' => '',
			'show_data_one_line' => '',
			'show_preposition' => '',
			'render_slug' => '',
			'event_selection' => $atts['event_selection'],
			'event_series_name' => $atts['event_series_name'],
			'enable_series_link' => $atts['enable_series_link'],
			'custom_series_link_target' => $atts['custom_series_link_target'],
			'custom_icon' => '',
			'ajax_load_more_button_icon'=>'',
			'pagination_type' =>'',
			'align'    => '',
			'show_icon_label'=>'',	
			'recurrence_number'=>'',

		), $atts ), $atts, 'decm-events-atts' );
//print_r($atts['included_organizer'])
		//print_r( self::get_organizer_data_id());
		$joshi_j= new ET_Builder_Element;
		//$joshi_j=$joshi_j->process_multiple_checkboxes_field_value( $value_map, $atts['included_organizer'] );
	if ( ! empty( $atts['included_organizer']) ) {
		$value_map              = self::get_organizer_data_id();
		$atts['included_organizer'] = $joshi_j->process_multiple_checkboxes_field_value( $value_map, $atts['included_organizer'] );
		$atts['included_organizer'] =  $atts['included_organizer'];
	} 
	$included_organizer_check=explode("|",$atts['included_organizer']);
	if ( ! empty( $atts['included_venue']) ) {
		$value_map              = self::get_venue_data_id();
		$atts['included_venue'] =$joshi_j->process_multiple_checkboxes_field_value( $value_map, $atts['included_venue'] );
		$atts['included_venue'] =  $atts['included_venue'];
	} 
	if ( ! empty( $atts['included_series']) ) {
		$value_map              = self::get_eventSeries_data_id();
		$atts['included_series'] =$joshi_j->process_multiple_checkboxes_field_value( $value_map, $atts['included_series'] );
		$atts['included_series'] =  $atts['included_series'];
	} 
	$included_series_check=explode("|",$atts['included_series']);
	$included_venue_check=explode("|",$atts['included_venue']);
//print_r(!empty($atts['included_organizer'])?"y":"n");
		$object = new DECM_EventDisplay;
		$atts['render_slug'] = $object->module_classname( 'decm_event_display' );
		// Category

		
		if ( $atts['cat'] ) {
			if ( strpos( $atts['cat'], "," ) !== false ) {
				$atts['cats'] = explode( ",", $atts['cat'] );
				$atts['cats'] = array_map( 'trim', $atts['cats'] );
			} else {
				$atts['cats'] = array( trim( $atts['cat'] ) );
			}

			$atts['event_tax'] = array(
				'relation' => 'OR',
			);

			foreach ( $atts['cats'] as $cat ) {
				$atts['event_tax'][] = array(
                        'taxonomy' => 'tribe_events_cat',
                        'field' => 'term_id',
                        'terms' => $cat,
                    );
					
			}
		}

		// Past Event
		$meta_date_compare = '>=';
		$meta_date_date = current_time( 'Y-m-d H:i:s' );

		if ( $atts['time'] == 'past' || $atts['past'] ==  'past_events' ) {
			$meta_date_compare = '<';
			$atts['order'] = $atts['order'];
			$atts['key'] = 'meta_value';
			$atts['orderby'] = '_EventEndDate';
			
		}
	

		// Key, used in filtering events by date
		if ( str_replace( ' ', '', trim( strtolower( $atts['key'] ) ) ) == 'startdate' ) {
			$atts['key'] = '_EventStartDate';
		} else {
			$atts['key'] = '_EventEndDate';
		}

		// Orderby
		if ( str_replace( ' ', '', trim( strtolower( $atts['orderby'] ) ) ) == 'enddate' ) {
			$atts['orderby'] = '_EventEndDate';
		} elseif ( trim( strtolower( $atts['orderby'] ) ) == 'title' ) {
			$atts['orderby'] = 'title';
		} else {
			$atts['orderby'] = '_EventStartDate';
		}

		// Date
		if($atts['past'] !=  'past_future_events'){
		$atts['meta_date'] = array(
			array(
				'key' => $atts['key'],
				'value' => $meta_date_date,
				'compare' => $meta_date_compare,
				'type' => 'DATETIME'
			)
		);
	}
	
		// Specific Month
		if ( 'current' == $atts['month'] ) {
			$atts['month'] = current_time( 'Y-m' );
		}
		if ( 'next' == $atts['month'] ) {
			$atts['month'] = gmdate( 'Y-m', strtotime( '+1 months', current_time( 'timestamp' ) ) );
		}
		if ($atts['month']) {
			$month_array = explode("-", $atts['month']);
			
			$month_yearstr = $month_array[0];
			$month_monthstr = $month_array[1];
			$month_startdate = gmdate( "Y-m-d", strtotime( $month_yearstr . "-" . $month_monthstr . "-01" ) );
			$month_enddate = gmdate( "Y-m-01", strtotime( "+1 month", strtotime( $month_startdate ) ) );

			$atts['meta_date'] = array(
				'relation' => 'AND',
				array(
					'key' => $atts['key'],
					'value' => $month_startdate,
					'compare' => '>=',
					'type' => 'DATETIME'
				),
				array(
					'key' => $atts['key'],
					'value' => $month_enddate,
					'compare' => '<',
					'type' => 'DATETIME'
				)
			);
		}

		/**
		 * Hide time if $atts['showtime'] is false
		 *
		 * @author bojana
		 *
		 */
		if ( self::isValid( $atts['eventdetails'] ) ) {
			
			if ( !self::isValid( $atts['showtime'] ) ) {

				 add_filter( 'tribe_events_event_schedule_details_formatting', 'tribe_events_event_schedule_details_formatting_hidetime');
			}
		}
	
	

		/**
		 * Hide time if $atts['showtime'] is false
		 *
		 * @author bojana
		 *
		 */
			
		$atts = apply_filters( 'decm_event_calender_atts', $atts, $meta_date_date, $meta_date_compare );
		$meta_query_status="";
		$filter_event_status="";
		if($atts['show_postponed_canceled_event']=='off'){
			$meta_query_status= array('relation' => 'OR',
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
					)//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				);
			}
			$filter_event_status = array(
				'posts_per_page'=>-1,
				'post_type' => 'tribe_events',
				'meta_query' =>array($meta_query_status), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			  );
			  $filter_event_status_recurrence_parent = array(
				'posts_per_page' => -1,
				'post_type' => 'tribe_events',
				//'post_parent'=>'5528',
			  );
			  $filter_event_status_recurrence_parent_data=array();
			  $filter_event_status_recurrence_parent=tribe_get_events($filter_event_status_recurrence_parent);
			  foreach ((array) $filter_event_status_recurrence_parent as $post_index => $recurrence_event ) {
			  $filter_event_status_recurrence_parent_data[]= $recurrence_event->post_parent;
			  }
		
			  $filter_event_status_recurrence_parent_data=array_unique($filter_event_status_recurrence_parent_data);
			  $filter_event_status_recurrence_parent_data=(array_values($filter_event_status_recurrence_parent_data));
			
			  if (in_array('', $filter_event_status_recurrence_parent_data)) 
		{
			unset($filter_event_status_recurrence_parent_data[array_search('',$filter_event_status_recurrence_parent_data)]);
		}//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
		
			  $filter_event_status_recurrence = array(
				'posts_per_page' =>-1,
				'post_type' => 'tribe_events',
				//'post_parent'=>$filter_event_status_recurrence_parent_data,
				'meta_query'=> $atts['meta_date'],//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			  );
			//   echo "<pre>";
			//print_r(new TEC\Events\Custom_Tables\V1\Tables\Occurrences);
			  $filter_event_status_recurrence = tribe_get_events($filter_event_status_recurrence);
			  $RecurrenceSortedID = array();
			  $RecurrenceParentChildID=array();
			  foreach ((array) $filter_event_status_recurrence as $post_index => $filter_event_status_recurrence ) {
				//$get_occurence_id[$filter_event_status_recurrence->_tec_occurrence->event_id] = array();
				$get_occurence_id=$filter_event_status_recurrence->_tec_occurrence;
			
				 settype($get_occurence_id,"object");
				//  echo"<pre>";
				//  print_r(gettype($get_occurence_id));
				if(isset($get_occurence_id->event_id)){
				if(!$get_occurence_id->event_id)
				continue;
				
			//	array_filter($RecurrenceParentChildID[$get_occurence_id->event_id]);
			// if(isset($RecurrenceParentChildID[$get_occurence_id->event_id]))
			//settype($$RecurrenceParentChildID[$get_occurence_id->event_id],"array");
			$RecurrenceParentChildID[$get_occurence_id->event_id]=isset($RecurrenceParentChildID[$get_occurence_id->event_id])?$RecurrenceParentChildID[$get_occurence_id->event_id]:"";
				if(!is_array($RecurrenceParentChildID[$get_occurence_id->event_id]))
				$RecurrenceParentChildID[$get_occurence_id->event_id] = array();
			//}
			// echo"<pre>";
			// print_r($RecurrenceParentChildID[$get_occurence_id->event_id]);
		
			  array_push($RecurrenceParentChildID[$get_occurence_id->event_id],$filter_event_status_recurrence->ID);
			}
		}
			foreach ((array) $RecurrenceParentChildID as $post_index => $filter_event_status_recurrence ) {
			//echo "<pre>";
			$RecurrenceSortedID[]=array_slice($filter_event_status_recurrence,$atts['recurrence_number']);
		
			}
			  $filter_event_status = tribe_get_events($filter_event_status);
			  $RecurrenceSortedID=array_merge(...$RecurrenceSortedID);
			 // print_r($RecurrenceSortedID);
			   //echo "</pre>";

			  $filter_event_status =$atts['show_postponed_canceled_event']=='off'? wp_list_pluck($filter_event_status, 'ID'):array(0);
			  $filter_event_status = array_merge($filter_event_status,$RecurrenceSortedID);
			

			  if($atts['show_virtual_event']=='off' && $atts['show_hybrid_event']=='off'){
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
		
			  
			  if($atts['show_hybrid_event']=='on' && $atts['show_virtual_event']=='off'){
				$meta_query_status_virtual = array(
				  array(
					'key' => '_tribe_virtual_events_type',
					'value' => 'virtual',
					'compare' => '=',
					'type' => 'Text'
				  ),
				);  
			  } 
			  
		
			  if($atts['show_hybrid_event']=='off' && $atts['show_virtual_event']=='on'){
				$meta_query_status_virtual = array(
				  array(
					'key' => '_tribe_virtual_events_type',
					'value' => 'hybrid',
					'compare' => '=',
					'type' => 'Text'
				  ),
				);  
			  } 
		
		
			  if($atts['show_hybrid_event']=='on'  && $atts['show_virtual_event']=='on'){
				$meta_query_status_virtual = "";
			  }//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			

		    $filter_event_status_virtual = array(
				'posts_per_page' => -1,
				'post_type' => 'tribe_events',
				'meta_query' =>array($meta_query_status_virtual),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			  );
			  $filter_event_status_virtual = tribe_get_events($filter_event_status_virtual);
			  $filter_event_status_virtual =  ($atts['show_hybrid_event']=='off' || $atts['show_virtual_event']=='off' )? wp_list_pluck($filter_event_status_virtual, 'ID'):array(0);	 
			  $filter_event_status=array_merge($filter_event_status,$filter_event_status_virtual);

		$post_type = get_post_type( $current_page['id'] );


		$check_event_by_date_start = "";
		$check_event_by_date_end = "";

		 if($atts['event_by_reletive_date']=="today" && $atts['event_selection']=="custom_event"){
			$check_event_by_date_start=		 gmdate("Y-m-d 00:00:00");
			$check_event_by_date_end=		 gmdate("Y-m-d 23:59:59");
		 }
		 if($atts['event_by_reletive_date']=="week" && $atts['event_selection']=="custom_event"){
			$check_event_by_date_start=gmdate("Y-m-d 00:00:00", strtotime('monday this week'));
			$check_event_by_date_end=gmdate("Y-m-d 23:59:59", strtotime('sunday this week'));
		 }
		 if($atts['event_by_reletive_date']=="month" && $atts['event_selection']=="custom_event"){
			$check_event_by_date_start=gmdate('Y-m-01 00:00:00');
			$check_event_by_date_end=gmdate('Y-m-t 23:59:59');
		 }

		if($atts['date_selection_type'] == "relative_date")
		{ 
			$check_event_by_date_start=$check_event_by_date_start;
			$check_event_by_date_end=$check_event_by_date_end;
		}
		if($atts['date_selection_type'] == "none"){
			$check_event_by_date_start="";
			$check_event_by_date_end="";
		}
		if(function_exists('tribe_is_event_series')){
		if($atts['event_selection']=="custom_event"&&$atts['included_series']!=""){
			global $wpdb;
			$decm_series_args =  array (       
				'posts_per_page'=>-1,   
				'post_status' => 'publish',   
				'post_type' => 'tribe_event_series',                   
			);
			$decm_series_update = new WP_Query( $decm_series_args );
			
			 $decm_series_events_table = (new TEC\Events_Pro\Custom_Tables\V1\Tables\Series_Relationships)->table_name( true );
			 $decm_check_query_sizeof = count($included_series_check)=="1"?"LIKE":"IN";
			 // print_r($wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$included_series_check).") "));
			  //  $decm_series_update = new WP_Query( $decm_series_args );
			
			 $decm_series_update = $wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$included_series_check).") "); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared ,WordPress.DB.PreparedSQL.InterpolatedNotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
			 $decm_series_update=array_column($decm_series_update, 'event_post_id');
			
		}//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	}

			$args = apply_filters( 'decm_fetch_events_atts', array(
				'post_status' => 'publish',
				'posts_per_page' => $atts['limit'],
				'tax_query'=> $atts['event_tax'], //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
				'order' => $atts['order'],
				'offset' => $atts['blog_offset'],
				//'post__in'=>$included_series_check!=""?$decm_series_update:"",
				'post__in'=>$atts['included_series']!=""?$decm_series_update:"",
				 //'included_categories' =>  $atts['included_categories'],
				 // 'orderby' => $atts['orderby'],
				 'start_date'=> $check_event_by_date_start,//phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
				 'end_date'=> $check_event_by_date_end,
				'organizer'=>$atts['included_organizer']!=""?$included_organizer_check:"",
				'venue'=>$atts['included_venue']!=""?$included_venue_check:"", //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
				'tag'            => $atts['included_tags'],
				// 'venue'=>array($months['on']),
				'post__not_in'		=>$atts['show_postponed_canceled_event']=='false'?$filter_event_status:($atts['show_virtual_hybrid_event']=='false'?$filter_event_status:$filter_event_status), //phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
				'hide_subsequent_recurrences'=> $atts['show_recurring_events']=="on"? false: true,
				//'featured'=> "false",
				'meta_query' => apply_filters( 'dec_get_meta_query', array( $atts['meta_date'] ), $atts, $meta_date_date, $meta_date_compare ),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
			), $atts, $meta_date_date, $meta_date_compare );
			 // $featured_events = "false";
		  	
			 if($atts['cutoff_ongoing_events']=='cut_start_date_reached' && $atts['past'] !=  'past_future_events'){
				//if(!empty($atts['cutoff_ongoing_events'])){
					$args['start_date'] =   gmdate('Y-m-d 23:59:59');
					$args['end_date'] = "";// gmdate('d-m-y h:i:s'); //gmdate('d-m-y h:i:s');
				//}
			}
		
			if($atts['cutoff_ongoing_events']=='cut_end_date_reached' && ($atts['past'] !=  'past_future_events' &&  $atts['event_selection'] != "custom_event")){
				//if(!empty($atts['cutoff_ongoing_events'])){
					$args['start_date'] =  ""; //gmdate('Y-m-d 23:59:59');
					$args['end_date'] = "";// gmdate('d-m-y h:i:s'); //gmdate('d-m-y h:i:s');
				//}
			}
			if($atts['date_selection_type'] == "date_range"){
				$args['start_date'] = $atts['included_date_range_start'];
				$args['end_date'] = $atts['included_date_range_end'];
			}
		if($atts['event_selection'] == 'featured_events'){
			$args['featured'] = "true";
		}
		//et_body_layout
		if($atts['event_selection'] == 'use_current_loop'){
		if($post_type == 'tribe_events')
		{
			$args['ID'] = $current_page['id'];
		}
	}

	
	

	$max_page_find_args = $args;
	if($atts['limit'] > 0){	

		    $max_page_find_args['posts_per_page'] = -1;
			$max_pages = ceil(count(tribe_get_events( $max_page_find_args ))/$atts['limit']);
			$total_events = count(tribe_get_events( $max_page_find_args ));
	}

	if($total_events == 0){
		$atts['posts'] = array(
			'0' => null,
		);
	}

 
		$event_posts = tribe_get_events( $args );

		$sort_order = strtoupper($atts['order'] ?? 'ASC');
 
			usort($event_posts, function ($a, $b) use ($sort_order) {
				$date_a = strtotime(get_post_meta($a->ID, '_EventStartDate', true) ?: '1970-01-01');
				$date_b = strtotime(get_post_meta($b->ID, '_EventStartDate', true) ?: '1970-01-01');
			
				if ($date_a === $date_b) {
					// Fallback: keep order by ID so it's stable
					return $a->ID <=> $b->ID;
				}
			
				return $sort_order === 'DESC'
					? $date_b <=> $date_a
					: $date_a <=> $date_b;
			});
		
		

        $event_posts = apply_filters( 'decm_events_posts_fetch', $event_posts, $atts );
		

		if ( $event_posts or apply_filters( 'decm_events_posts', false, $atts ) ) {
				
			$output = apply_filters( 'decm_start_events', $output, $event_posts, $atts );



						$columns_phone='';
						$columns_tablet='';		
					$columns_device = array('columns','columns_tablet','columns_phone');
					$columns_desktop = 'col-lg-4';
					$columns_tablet = 'col-md-12';
					$columns_phone = 'col-sm-12';
					foreach ($columns_device as $device){
						$columns_class = false;
						if (strpos($device, '_phone')){
							$breakpoint = 'sm';
						}else if (strpos($device, '_table')){
							$breakpoint = 'md';
						}else{
							$breakpoint = 'lg';
						}
						if ($atts[$device]){
							switch ($atts[$device]){
								case 1:
									$columns_class = "col-{$breakpoint}-12";
									break;
								case 2:
									$columns_class = "col-{$breakpoint}-6";
									break;
								case 3:
									$columns_class = "col-{$breakpoint}-4";
									break;
								case 4:
									$columns_class = "col-{$breakpoint}-3";
									break;
								case 5:
									$columns_class = "col-{$breakpoint}-2";
									break;
								case 6:
									$columns_class = "col-{$breakpoint}-2";
									break;
							}
							if (strpos($device, '_phone')){
								$columns_phone = $columns_class;
							}else if (strpos($device, '_table')){
								$columns_tablet = $columns_class;
							}else{
								$columns_desktop = $columns_class;
							}
						}
					}

					$dateformat = '';
					$atts['dateformat'] = $dateformat;
					$atts['posts'] = array();
 			$atts['contentorder'] = explode( ',', $atts['contentorder'] );
			$index = 0;
			foreach( (array) $event_posts as $post_index => $event_post ) {
				setup_postdata( $event_post->ID );
				++$index;
				$event_output = '';
				if ( apply_filters( 'decm_remove_events', false, $atts, $event_post ) )
				    continue;
				$category_slugs = array();
				$category_list = get_the_terms( $event_post, 'tribe_events_cat' );
				/**
				 * Show Categories of every events
				 *
				 * @author bojana
				 */
				$category_names = array();
				$featured_class = ( get_post_meta( $event_post->ID, '_tribe_featured', true ) ? ' ecs-featured-event' : '' );
				
				$atts['posts'][$index]['featured_class'] =$featured_class;
				if ( is_array( $category_list ) ) {
					foreach ( (array) $category_list as $category ) {
						$category_slugs[] = ' ' . $category->slug . '_ecs_category';
						/**
						 * Show Categories of every events
						 *
						 * @author bojana
						 * 
						 */
						$category_enable_link = $atts['enable_category_links'] == 'on' ? '<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>' : '<span>'.$category->name.'</span>';
						$category_names[] = '<span class= ecs_category_'.$category->slug.' >'.$category_enable_link.'</span>';
						
					}
				}


					/**
				 * Show Tags of every events
				 *
				 * @author bojana
				 */
				//echo "<pre>";
				//print_r($category_list);
				$tag_names = array();
				$tag_slugs = array();
				$tag_list =  get_the_terms( $event_post, 'post_tag' );
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

						$tag_enable_link = $atts['enable_tag_links'] == 'on' ? '<a href="'.get_term_link( $tag->term_id ).'" target="'.esc_attr($atts['custom_tag_link_target']).'" >'.esc_attr($tag->name).'</a>' : '<span>'.esc_attr($tag->name).'</span>';
						$tag_names[] = '<span class= "decm_tag ecs_tag_'.esc_attr($tag->slug).'" >'.$tag_enable_link.'</span>';
					}
				}

				//$event_stutus_tag=tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status" style="display:inline">'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).' </span>':"";

				$custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];
				// Put Values into $event_output
				foreach ( apply_filters( 'decm_events_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					switch ( trim( $contentorder ) ) {
						case 'title':
							$atts['posts'][$index]['title']=$event_post->post_title;
							break;
						case 'title2':
							$atts['posts'][$index]['title2']= $event_post->post_title;
							break;
						
						case 'event_series_name':

							$url = $event_post->guid;	
							preg_match("/&?p=([^&]+)/", $url, $matches);
						 //  $series_id = $matches[1]; 
							if(!empty($matches[1])){
								$series_id = $matches[1]; 
							}else{
								$series_id = $event_post->ID;
							}
							if( function_exists("tec_event_series")  && !empty(tec_event_series(  $series_id ))) { 

							$enable_series_link=$atts['enable_series_link']=='on'? '<a href="'.tec_event_series( $series_id )->guid.'" class="diec-events-series-relationship-single-marker__title tribe-common-cta--alt" target="'.esc_attr($atts['custom_series_link_target']).'"><span class="diec_series_marker__title">'.tec_event_series( $series_id )->post_title.'</span></a>':'<span class="diec_series_marker__title">'.tec_event_series($series_id)->post_title.'</span>';
								
							if($atts['event_series_name']=='on' && !empty(tec_event_series(  $series_id )->post_title)){

								$atts['posts'][$index]['event_series_name'] = $enable_series_link;
							//	$atts['posts'][$index]['event_series_name'] =  '<div>'.$showicon.$showlabel.$stacklabel.$enable_series_link.'</div>';
							}
						}	
							break;
						
						case 'price':
							$atts['posts'][$index]['price']='<span class="decm_price">'." ".tribe_get_cost($event_post->ID, true ).'</span>';
						break;
						case 'show_rsvp_feed':
							if (is_plugin_active('event-tickets/event-tickets.php')) {
								$event_link = tribe_get_event_link($event_post->ID);
								$rsvp_data = Tribe__Tickets__Tickets::get_ticket_counts($event_post->ID);
						
								if (isset($rsvp_data['rsvp'])) { // Check if 'rsvp' key exists
									$available_rsvp = $rsvp_data['rsvp']['stock'];
									$unlimited_rsvp = $rsvp_data['rsvp']['unlimited'];
						
									$rsvp__label = '';
									if ($rsvp_data['rsvp']['count'] > 0) {
										if ($available_rsvp == 0) {
											$rsvp__label = "Currently Full";
										} elseif ($available_rsvp == -1 && $unlimited_rsvp != null) {
											$rsvp__label = " - Unlimited";
										} else {

											if($available_rsvp > 1 ){
												$Place_left  =	__('Places Left', 'decm-divi-event-calendar-module');
											 }else{
												 $Place_left  =	__('Place Left', 'decm-divi-event-calendar-module');
											 }
												 
											 $spaceRespond = $atts['show_rsvp_feed_respond'] == 'on' && $atts['show_rsvp_feed_left'] == 'on' ? ' - ' : ' ';
											 $rsvp__label = esc_html($spaceRespond) . esc_html($available_rsvp) . ' ' . esc_html($Place_left);
										}
						
										$atts['posts'][$index]['show_rsvp_feed'] = '<span class="decm_price">' . 
										(
											$available_rsvp != 0 && $atts['show_rsvp_feed_respond'] == 'on'
												? '<span class="decm_price"><a class="show_rsvp_feed_custom" href="' . $event_link . '">' . __('Respond Now', 'decm-divi-event-calendar-module') . '</a></span>'
												: '').(
										    !empty($rsvp__label) && $atts['show_rsvp_feed_left'] == 'on'
												? '<span class="ticket-label">' . $rsvp__label . '</span>'
												: ''
										);
									}
								} else {
									// Handle the case where 'rsvp' key does not exist, if necessary
									$atts['posts'][$index]['show_rsvp_feed'] = ''; // Or some default value
								}
							}
							break;

						
						case 'show_price_ticket':
							
							if (is_plugin_active('event-tickets/event-tickets.php')) {
								$Tickets_data = Tribe__Tickets__Tickets::get_ticket_counts($event_post->ID);
								if($Tickets_data['tickets']['available'] > 0){
									if (isset($Tickets_data['tickets'])) {
										$available_tickets = $Tickets_data['tickets']['available'];
										$ticket__label = '';
										$event__price = '';
										$isPrice__free = tribe_get_cost($event_post->ID, true);
										$raw__price = explode('–', $isPrice__free);
										$priceArray = array_map('trim', $raw__price);
										$is__price_exists = array_key_exists(1, $priceArray);
							
										$is__price__onFirstIndex = array_key_exists(0, $priceArray);
				
											if ($is__price_exists) {
												$event__price = $priceArray[1];
												
											}elseif($is__price__onFirstIndex){
												$event__price = $priceArray[0];
												if($event__price === 'Free'){
													$event__price =__('Free', 'decm-divi-event-calendar-module');
												}


												
											}else {
												// $event__price = "Free";
												$event__price =  __('Free', 'decm-divi-event-calendar-module');
												
										 	}


										if ($Tickets_data['tickets']['count'] > 0) {


											if ($available_tickets == 0) {
												$ticket__label =  __('Sold Out', 'decm-divi-event-calendar-module');                            
											}else{
												if($available_tickets == -1) {
													$Place_left =  __('Unlimited', 'decm-divi-event-calendar-module');                                
												}elseif($available_tickets > 1 ){
													$Place_left  =	$available_tickets.' '.__('Places Left', 'decm-divi-event-calendar-module');
												 }else{
													 $Place_left  =	$available_tickets.' '.__('Place Left', 'decm-divi-event-calendar-module');
												 }
												
												 $Purchase_Now = $atts['show_ticket_feed_respond'] == 'on' ? ' '.'<a href="' . $event_link . '" class="price_link_ticket price_link_custom__a" >'.__('Purchase Now', 'decm-divi-event-calendar-module').'</a> '  : '';
												 $spaceRespond = $atts['show_ticket_feed_respond'] == 'on' && $atts['show_ticket_feed_left'] == 'on' ? ' - ' : ' ';	
												 $show_ticket_feed_left = $atts['show_ticket_feed_left'] == 'on'  ? esc_html($Place_left) :'';
												 $ticket__label = $Purchase_Now.esc_html($spaceRespond) . ' ' . esc_html($show_ticket_feed_left);
											}
										}

										
									} else {
										// If 'tickets' key does not exist, set default values
										$event__price =  __('Free', 'decm-divi-event-calendar-module');
										// Assume free if no ticket data
										$ticket__label = ''; // No additional label
									}
								$atts['posts'][$index]['show_price_ticket'] = '<span class="decm_price price_link_ticket">' . " " . $event__price.''.$ticket__label.'</span>';
								}else{
									$atts['posts'][$index]['show_price_ticket'] = '';
									
								}
							} else {
								$atts['posts'][$index]['show_price_ticket'] = '';
								$event__price = "";
								$ticket__label = ''; 
							}			
							
								
						break;
						
						case 'weburl':
							
							$atts['posts'][$index]['weburl' ]=  $atts['posts'][$index]['weburl' ]=($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<span class="decm_weburl"><a href="'.tribe_get_event_meta($event_post->ID, '_EventURL', true ).'" target="'.$atts['custom_website_link_target'].'">'.$custom_website_link_text.'</a></span>':'<span class="decm_weburl">'.tribe_get_event_website_link($event_post).'</span>';
						break;
						case 'organizer':

							$organizers = tribe_get_organizer_ids($event_post->ID );
			                       $orgName = array();
								foreach ($organizers as $key => $organizerId) {
									$orgName[$key] =$atts['enable_organizer_link']=="on"? tribe_get_organizer_link($organizerId):tribe_get_organizer($organizerId);
							}

							$orgNames	= implode(', ', $orgName);

							$atts['posts'][$index]['organizer'] ='<span class="decm_organizer">'. $orgNames.'</span>';
								//$event_output.='</div>';
							break;
								
						case 'thumbnail':
							$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
							$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';

							$atts['posts'][$index]['thumb'] = get_the_post_thumbnail_url($event_post->ID,array( 800, $thumbHeight,'class'=>" ecs_event_feed_image" ));
							break;

							case 'excerpt':
								$excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 270;
								if($atts['excerpt_content']=="'show_excerpt"){
								$atts['posts'][$index]['excerpt'] = has_excerpt($event_post->ID)?self::get_excerpt($event_post->ID, $excerptLength ):""; 
							}
							if($atts['excerpt_content']=="_show"){
								
								$atts['posts'][$index]['excerpt'] = self::get_content($event_post->ID, $excerptLength ) != null ?  strip_tags(self::get_content($event_post->ID, $excerptLength )):" ";//phpcs:ignore WordPress.WP.AlternativeFunctions.strip_tags_strip_tags
							}
								break;

						case 'date':
							$atts['posts'][$index]['date'] = apply_filters( 'decm_events_date_tag_start', '<span class="duration time">', $atts, $event_post ) .apply_filters( 'decm_events_list_details', tribe_events_event_schedule_details($event_post->ID), $atts, $event_post ) .apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								$Sdate = '';
								$Edate = '';
								$STime = '';
								$ETime = '';
								$set_timezone='';
			                    $set_timezone=$atts['show_timezone_abb'] == 'off'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):" ".Tribe__Events__Timezones::get_event_timezone_abbr($event_post->ID );
								// if($atts['shorten_multidate']=='on'&&$atts['start_date_format']!=""&& (tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' ))!= tribe_get_end_date( $event_post->ID,null,get_option( 'date_format' )))){
								// 	$Sdate = tribe_get_start_date($event_post->ID,null,$atts['start_date_format']);
								// }
									if($atts['date_format']!=""  &&$atts['start_date_format']!="")
								{
									$Sdate =  $atts['shorten_multidate']=='on' && $atts['start_date_format']!="" && tribe_get_start_date($event_post->ID,null,get_option('date_format'))!=tribe_get_end_date($event_post->ID,null,get_option('date_format')) ? tribe_get_start_date($event_post->ID,null,$atts['start_date_format']):tribe_get_start_date($event_post->ID,null,$atts['date_format']);
									$Edate =   tribe_get_end_date($event_post->ID,null,$atts['date_format']);
								}
								if($atts['date_format']!="" && $atts['start_date_format']=="" )
								{
											
									$Sdate = tribe_get_start_date($event_post->ID,null,$atts['date_format']);
									$Edate =  tribe_get_end_date($event_post->ID,null,$atts['date_format']);
								}
								
								if(empty($atts['date_format']) && $atts['start_date_format']!="")
								{
									$Sdate = $atts['shorten_multidate']=='on' && $atts['start_date_format']!="" &&tribe_get_start_date($event_post->ID,null,get_option('date_format'))!=tribe_get_end_date($event_post->ID,null,get_option('date_format')) ? tribe_get_start_date($event_post->ID,null,$atts['start_date_format']): tribe_get_start_date($event_post->ID,null,get_option('date_format'));						
									$Edate = tribe_get_start_date($event_post->ID,null,get_option('date_format'))!=tribe_get_end_date($event_post->ID,null,get_option('date_format')) ? tribe_get_end_date($event_post->ID,null,"j, Y"): tribe_get_start_date($event_post->ID,null,get_option('date_format'));
								}
								if(empty($atts['date_format']) && $atts['start_date_format']=="")
								{

									$Sdate =  $atts['shorten_multidate']=='on' && $atts['start_date_format'] =="" ?  tribe_get_start_date($event_post->ID,null,"M j"): tribe_get_start_date($event_post->ID,null,get_option('date_format'));
									if(tribe_get_start_date( $event_post->ID,null,"Y") != tribe_get_end_date( $event_post->ID,null,"Y")){
										$Sdate =  $atts['shorten_multidate']=='on' && $atts['start_date_format'] =="" ?  tribe_get_start_date($event_post->ID,null,"M j, Y"): tribe_get_start_date($event_post->ID,null,get_option('date_format'));
									}
													
									if(tribe_get_start_date($event_post->ID,null,get_option('date_format'))==tribe_get_end_date($event_post->ID,null,get_option('date_format'))){
										$Sdate = tribe_get_start_date($event_post->ID,null,"M j, Y");
										$Edate = "";
									}else{
										if($atts['shorten_multidate']=='off'){
											$Edate = tribe_get_end_date($event_post->ID,null,get_option('date_format')); 	
										}else{

											if(tribe_get_start_date( $event_post->ID,null,"M Y") == tribe_get_end_date( $event_post->ID,null,"M Y")){
												$Edate =  tribe_get_start_date($event_post->ID,null,get_option('date_format'))!=tribe_get_end_date($event_post->ID,null,get_option('date_format')) ? tribe_get_end_date($event_post->ID,null,"j, Y"):  tribe_get_start_date($event_post->ID,null,get_option('date_format'));
											}else{
												$Edate =  tribe_get_start_date($event_post->ID,null,get_option('date_format'))!=tribe_get_end_date($event_post->ID,null,get_option('date_format')) ? tribe_get_end_date($event_post->ID,null,"M j, Y"):  tribe_get_start_date($event_post->ID,null,get_option('date_format'));
											}
										
										}	
									}	
									
								//	tribe_get_start_date($event_post->ID,null,get_option('date_format'))!=tribe_get_end_date($event_post->ID,null,get_option('date_format')) tribe_get_end_date($event_post->ID,null,"d, Y"):tribe_get_end_date($event_post->ID,null,get_option('date_format'));
								}
								if($atts['time_format'])
								{
									$STime = tribe_get_start_time($event_post->ID,$atts['time_format']);
									$ETime = tribe_get_end_time($event_post->ID,$atts['time_format']);
								}
								
								if(empty($atts['time_format']))
								{
									$STime = tribe_get_start_time($event_post->ID,get_option('time_format'));
									$ETime = tribe_get_end_time($event_post->ID,get_option('time_format'));
								}
								
								$atts['posts'][$index]['date'] =$Sdate.' @ '.$STime.'~*~'.$Edate.' @ '.$ETime.'~*~'.$set_timezone;
						break;

						case 'callout_date':	

							if(tribe_get_start_date( $event_post->ID,false,"D") == tribe_get_end_date( $event_post->ID,false,"D")){
								$decm_show_callout_day_of_week = tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format']);
							  }else{
								if($atts['show_callout_day_of_week_range'] == "on"){
									$decm_show_callout_day_of_week = $atts['show_callout_day_of_week'] == "on" && $atts['show_callout_day_of_week_range'] == "on" ?  tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format'])." - ".tribe_get_end_date( $event_post->ID,null, $atts['callout_week_format']):" ";
								}else{
									$decm_show_callout_day_of_week = $atts['show_callout_day_of_week'] == "on" ? tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format']):" ";	
								}
								
							  }
								  
							  if(tribe_get_start_date( $event_post->ID,false,"M") == tribe_get_end_date( $event_post->ID,false,"M")){
								$decm_show_callout_month =  tribe_get_start_date( $event_post->ID,null,$atts['callout_month_format']);
							  }else{
								if($atts['show_callout_month_range'] == "on"){
									$decm_show_callout_month = $atts['show_callout_month'] == "on" && $atts['show_callout_month_range'] == "on" ?  tribe_get_start_date( $event_post->ID,null,$atts['callout_month_format'])." - ".tribe_get_end_date( $event_post->ID,null,$atts['callout_month_format']):" ";
								}else{
										
									$decm_show_callout_month = $atts['show_callout_month'] == "on" ? tribe_get_start_date( $event_post->ID,null,$atts['callout_month_format']):" ";
								}
								
							  }
							
							  if(tribe_get_start_date( $event_post->ID,false,"Y") == tribe_get_end_date( $event_post->ID,false,"Y")){
								$decm_show_callout_year =  tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format']);
							  }else{
								if($atts['show_callout_year_range'] == "on"){
									$decm_show_callout_year = $atts['show_callout_year'] == "on" && $atts['show_callout_year_range'] == "on" ? tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format'])." - ".tribe_get_end_date( $event_post->ID,null, $atts['callout_year_format']):" ";
								}else{
									$decm_show_callout_year = $atts['show_callout_year'] == "on" ? tribe_get_start_date( $event_post->ID,null, $atts['callout_year_format']):" ";
								}
								
							  }

							  if(tribe_get_start_date( $event_post->ID,false,"d") == tribe_get_end_date( $event_post->ID,false,"d")){
								$decm_show_callout_date = tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']);
							  }else{

								if($atts['show_callout_date_range'] == "on"){
									$callout_date_range_sep     = tribe_get_option( 'timeRangeSeparator', ' - ' );
					                $callout_date_range_separator     = $atts['show_callout_date_range']== "on"? " ".$callout_date_range_sep." ":"";
									$decm_show_callout_date = $atts['show_callout_date'] == "on" && $atts['show_callout_date_range'] == "on" ? tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']).$callout_date_range_separator.tribe_get_end_date( $event_post->ID,null, $atts['callout_date_format']):" ";
								}else{
									$decm_show_callout_date = $atts['show_callout_date'] == "on" ? tribe_get_start_date( $event_post->ID,null, $atts['callout_date_format']):" ";
								}
								
							  }
						
							    $atts['posts'][$index]['callout_date'] = $decm_show_callout_day_of_week.'@'.$decm_show_callout_month.'~*~'.$decm_show_callout_year.'@'.$decm_show_callout_date;
						break;

						case 'callout_time':
							
							if(tribe_get_start_time( $event_post->ID,false,"g:i a") == tribe_get_end_time( $event_post->ID,false,"g:i a")){
								$decm_show_callout_time = tribe_get_start_time( $event_post->ID, $atts['callout_time_format']);
							  }else{
								if( $atts['show_callout_time_range'] == "on"){
									$time_range_separator_call     = tribe_get_option( 'timeRangeSeparator', ' - ' );
				                    $time_range_separator_callout     = $atts['show_callout_time_range']== "on"? " ".$time_range_separator_call." ":"";
									$decm_show_callout_time = $atts['show_callout_time'] == "on" && $atts['show_callout_time_range'] == "on" ? tribe_get_start_time( $event_post->ID, $atts['callout_time_format']).$time_range_separator_callout.tribe_get_end_time( $event_post->ID, $atts['callout_time_format']):" ";
								}else{
									$decm_show_callout_time = $atts['show_callout_time'] == "on" ? tribe_get_start_time( $event_post->ID, $atts['callout_time_format']):" ";
								}
							
							  }

							$atts['posts'][$index]['callout_time'] = $decm_show_callout_time;
					break;
						case 'venue':
							if (  function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								$atts['posts'][$index]['venue'] =$atts['enable_organizer_link']=="on"?'<span class="decm_venue">'.tribe_get_venue_link($event_post->ID).'</span>':'<span class="decm_venue">'.tribe_get_venue($event_post->ID).'</span>';
							}
							break;
						/**
						 * Show location of venue
						 *
						 * @author bojana
						 *
						 */
						case 'location':
							if ( function_exists( 'tribe_get_full_address' ) and  (tribe_get_address($event_post->ID) != "" || tribe_get_city($event_post->ID) != "" || tribe_get_zip($event_post->ID) != "" || tribe_get_country($event_post->ID) != "" ) || tribe_get_province($event_post->ID) ) {
								$atts['posts'][$index]['location'] ='<span class="decm_location">'. tribe_get_address($event_post->ID).','.tribe_get_city($event_post->ID).','.tribe_get_zip($event_post->ID).','.tribe_get_country($event_post->ID).',</span>'; 
							}
							break;
									case 'location_province':
								//$dec_location_state = $atts['show_location_state']=="on" && tribe_get_province($event_post->ID) !=null?" ".tribe_get_province($event_post->ID):"";
								//print_r($atts['show_location_state']);
								
								if ( function_exists( 'tribe_get_full_address' ) and  (tribe_get_address($event_post->ID) != "" || tribe_get_city($event_post->ID) != "" || tribe_get_zip($event_post->ID) != "" || tribe_get_country($event_post->ID) != "" || tribe_get_province($event_post->ID)!=""|| tribe_get_region($event_post->ID)!="") ) {
									$atts['posts'][$index]['location_province'] =tribe_get_province($event_post)!=""?tribe_get_province($event_post->ID)." ":((tribe_get_region($event_post->ID)!="")?tribe_get_region($event_post->ID)." ":""); 
								}
								break;

						/**
						 * Show categories of every events
						 *
						 * @author bojana
						 */
						case 'categories':
							$excerptLength='';
							$categories = $atts['hide_comma_cat'] == 'off' ? implode(", ", $category_names): implode(" ", $category_names);
									$categories_separator = $categories ? ' | ' : ' ';
							 //$categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
								$atts['posts'][$index]['categories'] = apply_filters( 'decm_events_categories_tag_start', '<span class="ecs-categories">', $atts, $event_post ) .
								et_core_intentionally_unescaped( $categories_separator, 'fixed_string' ) .
								apply_filters( 'decm_events_categories', et_core_esc_wp( $categories ), 
								$atts, $event_post, $excerptLength ) .
								//et_core_intentionally_unescaped( $categories_separator, 'fixed_string' );
								apply_filters( 'decm_events_categories_tag_end', '</span>', $atts, $event_post );
							break;
						/**
						 * Show more in detail of every events
						 *
						 * @author bojana
						 */

						 	/**
						 * Show categories of every events
						 *
						 * @author bojana
						 */
						case 'tags':
							$excerptLength='';
							$tags = $atts['hide_comma_tag'] == 'off' ? implode(", ", $tag_names): implode(" ", $tag_names);
									$tags_separator = $tags ? ' | ' : ' ';
							 //$tags_sep  =	$atts['show_preposition'] == 'true' ? $tags_separator : " ";
								$atts['posts'][$index]['tags'] = apply_filters( 'decm_events_tag_start', '<span class="ecs-tag">', $atts, $event_post ) .
								et_core_intentionally_unescaped( $tags_separator, 'fixed_string' ) .
								apply_filters( 'decm_events_tags', et_core_esc_wp( $tags ), 
								$atts, $event_post, $excerptLength ) .
								//et_core_intentionally_unescaped( $tags_separator, 'fixed_string' );
								apply_filters( 'decm_events_tags_end', '</span>', $atts, $event_post );
							break;
						/**
						 * Show more in detail of every events
						 *
						 * @author bojana
						 */
						
						case 'date_thumb':
								$atts['posts'][$index]['date_thumb']['M'] =tribe_get_start_date( null, false, 'M' ); 
								$atts['posts'][$index]['date_thumb']['J'] =tribe_get_start_date( null, false, 'j' ); 
								
							break;

							case 'pagination':
								$atts['posts'][$index]['pagination'] = $max_pages;
								
							break;
							case 'more_info_button_meta_key':
									$more_info_button_meta_key = get_post_meta( $event_post->ID, '_more_info_button_meta_key', true );
									$atts['posts'][$index]['more_info_button_meta_key'] = $more_info_button_meta_key;	
							break;
							case 'event_status_check':
								$event_stutus_tag = "";

								if(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true) == 'postponed'){
									$event_stutus_tag = tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'" style="display:inline">'.__('postponed','decm-divi-event-calendar-module').' </span>':"";
									//	echo tribe_get_event_meta($event_post->ID,'_tribe_events_status', true);
								}
					
								if(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true) == 'canceled'){
										$event_stutus_tag = tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'" style="display:inline">'.__('canceled','decm-divi-event-calendar-module').' </span>':"";
								}
								$atts['posts'][$index]['event_status_check']= $event_stutus_tag;
							// case 'total_count':							
							// 	$atts['total_events'] = $total_events;							
							break;
							case 'event_status_virtual':
								$atts['posts'][$index]['event_status_virtual']=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="virtual"?'
							<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--virtual tribe-events-virtual-virtual-event__icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 16" style="font-size: 5px !important;margin: 0px !important;width: 24px;height: 12px;/* display: flex; */">
						<g fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)">
							<path d="M18 10.7333333c2.16-2.09999997 2.16-5.44444441 0-7.46666663M21.12 13.7666667c3.84-3.7333334 3.84-9.80000003 0-13.53333337M6 10.7333333C3.84 8.63333333 3.84 5.28888889 6 3.26666667M2.88 13.7666667C-.96 10.0333333-.96 3.96666667 2.88.23333333" class="tribe-common-c-svgicon__svg-stroke"></path><ellipse cx="12" cy="7" rx="2.4" ry="2.33333333" class="tribe-common-c-svgicon__svg-stroke"></ellipse></g></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'. tribe_get_virtual_event_label_singular().' </span>':"";
							break;
							case 'event_status_hybrid':
							$atts['posts'][$index]['event_status_hybrid']=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="hybrid"?'
							<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--hybrid tribe-events-virtual-hybrid-event__icon-svg" viewBox="0 0 15 13" fill="none" style="width: 24px;height: 12px;" xmlns="http://www.w3.org/2000/svg">
					<circle cx="3.661" cy="9.515" r="2.121" transform="rotate(-45 3.661 9.515)" stroke="#0F0F30" stroke-width="1.103"></circle><circle cx="7.54" cy="3.515" r="2.121" transform="rotate(-45 7.54 3.515)" stroke="#0F0F30" stroke-width="1.103"></circle>
					<path d="M4.54 7.929l1.964-2.828" stroke="#0F0F30"></path><circle r="2.121" transform="scale(-1 1) rotate(-45 5.769 18.558)" stroke="#0F0F30" stroke-width="1.103"></circle>
					<path d="M10.554 7.929L8.59 5.1" stroke="#0F0F30"></path></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'. tribe_get_hybrid_event_label_singular().' </span>':"";
						break;
						case 'month_heading':
					
	                    	if(Tribe\Events\Views\V2\Utils\Separators::should_have_month( $event_posts,$event_post->ID )){
								$atts['posts'][$index]['month_heading']=tribe_get_start_date( $event_post->ID, false, tribe_get_date_option( 'monthAndYearFormat', 'F Y' ) );
		                    }
						
		                else{}
						break;
						default:
						$atts['posts'][$index]['contentorder'] = strtolower( trim( $contentorder ) );
					}
			}

			}
		}
		wp_reset_postdata();

		return ($atts);
	}

	
	/**
	 * Checks if the plugin attribute is valid
	 *
	 * @since 1.0.5
	 *
	 * @param string $prop
	 * @return boolean
	 */
	public static function isValid( $prop )
	{
		return ( $prop !== 'false' );
	}

	/**
	 * Fetch and trims the excerpt to specified length
	 *
	 * @param integer $limit Characters to show
	 * @param string $source  content or excerpt
	 *
	 * @return string
	 */
	
	
	public static function get_excerpt( $post_id,$limit, $source = null )
	{
		
		$excerpt = get_the_excerpt($post_id);
		if( $source == "content" ) {
			get_the_content($more_link_text = null,$strip_teaser = false,$post_id);
		}

		if ( strlen( $excerpt ) > $limit ) {
			$excerpt = substr( $excerpt, 0, $limit );
			$excerpt .= '...';
		}
		
		return $excerpt;
		
	}
	public static function get_content( $post_id,$limit, $source = null )
	{
		
		//$excerpt = tribe_get_the_content( $more_link_text = null,$strip_teaser = false, $post_id );
		$excerpt = preg_replace('/\[\/?et_pb.*?\]/', '',get_the_content( $more_link_text = null,$strip_teaser = false, $post_id));
	//	echo $excerpt;
	//	print_r($excerpt);
		if( $source == "content" ) {
			
			tribe_get_the_content($more_link_text = null,$strip_teaser = false,$post_id);
		}

		if ( strlen( $excerpt ) > $limit ) {
			$excerpt = substr( $excerpt, 0, $limit );
			$excerpt .= '...';
		}

		$description = $excerpt;
		
		return $description;
		
	}

				
}


new DECM_EventDisplay();