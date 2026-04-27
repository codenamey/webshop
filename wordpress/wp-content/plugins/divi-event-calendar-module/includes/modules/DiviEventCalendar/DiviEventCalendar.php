<?php

class DECM_DiviEventCalendar extends ET_Builder_Module {

	public $slug       = 'decm_divi_event_calendar';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Calendar',  'decm-divi-event-calendar-module');
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
		'borders'               => array(
			'default' => array(
				'css'   => array(
				  'main' => array (
						  'border_radii' => '%%order_class%%',
						  'border_styles' => '%%order_class%%',  
					 ),
				   ),
				   
			  ), 
			'upcoming_events_border'   => array(
				'css'          => array(
					'main' => array(
						'border_radii'  => '%%order_class%% a.fc-event',
						'border_styles' => '%%order_class%% a.fc-event',
					),
					'important' => 'all',
				),			
				'label_prefix' => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Add and customize the border for the upcoming events with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'upcoming_event',
				'defaults' => array(
					'border_radii' => 'on|4px|4px|4px|4px',
				),
				
			),
			'navigation_border'   => array(
				'css'          => array(
					'main' => array(
						'border_radii'  => '%%order_class%% .fc-today-button,%%order_class%% .fc-prev-button,%%order_class%% .fc-next-button',
						'border_styles' => '%%order_class%% .fc-today-button,%%order_class%% .fc-prev-button,%%order_class%% .fc-next-button',
					
					),
					'important' => 'all',
				),			
				'label_prefix' => esc_html__( 'Navigation Buttons', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Add and customize the border for the calendar month navigation with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'navigation',
				'defaults' => array(
					'border_radii' => 'on|4px|4px|4px|4px',
				),
			),
			'view_button_border'   => array(
				'css'          => array(
					'main' => array(
						'border_radii'  => '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button,.fc-listMonth-button,.fc-listYear-button',
						'border_styles' => '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button,.fc-listMonth-button,.fc-listYear-button',	
					),
					'important' => 'all',
				),			
				'label_prefix' => esc_html__( 'View Buttons', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Add and customize the border for the calendar month navigation with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'view_button',
				'defaults' => array(
					'border_radii' => 'on|4px|4px|4px|4px',
				),
			),
			'tooltip_border'   => array(
				'css'          => array(
					'main' => array(
						'border_radii'  => '.dec-tooltip,.decm__react_component_tooltip',
						'border_styles' => '.dec-tooltip,.decm__react_component_tooltip',
					),
					'important' => 'all',
				),
		
							
				'label_prefix' => esc_html__( 'Tooltip', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Add and customize the border for the calendar month navigation with all the standard border settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'tooltip_style',
				'defaults' => array(
					'border_radii' => 'on|6px|6px|6px|6px',
				),
			),
		  'tooltip_image_border'   => array(
			  'css'          => array(
				  'main' => array(
					'border_radii'  => '.tooltip_main .feature_img .wp-post-image',
					'border_styles' => '.tooltip_main .feature_img .wp-post-image',
				  ),
				  'important' => 'all',
			  ),
			  'label_prefix' => esc_html__( 'Details Image', 'decm-divi-event-calendar-module' ),
			  'description'		=> esc_html__( 'Add and customize the border for the Details image with all the standard border settings.', 'decm-divi-event-calendar-module' ),
			  'tab_slug'     => 'advanced',
			  'toggle_slug'  => 'tooltip_image',
			  'defaults' => array(
				'border_radii' => 'on|4px|4px|4px|4px',
			),
		  
		  ),
		  'calendar_image_border'   => array(
			'css'          => array(
				'main' => array(
				  'border_radii'  => "%%order_class%% .ecs_calendar_thumbnail .ecs_calendar_thumbnail_inner",
				  'border_styles' => "%%order_class%% .ecs_calendar_thumbnail .ecs_calendar_thumbnail_inner",
				),
				'important' => 'all',
			),
			'label_prefix' => esc_html__( 'Calendar Thumbnail', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Add and customize the border for the Details image with all the standard border settings.', 'decm-divi-event-calendar-module' ),
			'tab_slug'     => 'advanced',
			'toggle_slug'  => 'calendar_image',
			//'defaults' => array(
			 // 'border_radii' => 'on|4px|4px|4px|4px',
		 // ),
		
		),
		),

		    'fonts'          => array(
				
				'month' => array(
				'css'          => array(
					'main'      => "%%order_class%% .fc-center h2",
					'important' => 'all',
				),
				'label'        => esc_html__( 'Heading', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Customize and style the calendar Heading text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				'font_size'   => array(
					'default' => et_get_option( 'body_font_size', '2000' )  . 'px !iportant',
				),
				'show_if'      => array( 'show_feature_image'=>"on"),
				'tab_slug'     => 'advanced',
					'toggle_slug'  => 'month_text_style',
				//'disable_toggle' => false,
			),
			'view_button' => array(
				'css'          => array(
					'main'      => '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button,.fc-listMonth-button,.fc-listYear-button',
					'important' => 'all',
				),
				
				'label'        => esc_html__( 'View Button', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'view_button',
				'disable_toggle' => false,
		),
		'navigation_button' => array(
			'css'          => array(
				'main' => '%%order_class%% .fc-today-button,.fc-prev-button,.fc-next-button',
				'important' => 'all',
			),
			
			'label'        => esc_html__( 'Navigation Button', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
			'toggle_slug'  => 'navigation',
			'disable_toggle' => false,
	),
			'days' => array(
				'css'          => array(
					'main'      => "%%order_class%% th.fc-day-header span,%%order_class%% th.fc-day-header",
					'important' => 'all',
				),
				'label'        => esc_html__( 'Days of the Week', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Customize and style the days of the week text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'day_text_style',
				'disable_toggle' => false,
			),
			'cal_days' => array(
				'css'          => array(
					'main'      => "%%order_class%% .fc-day-number,.fc-day-top,%%order_class%% td.fc-day",
					'important' => 'all',
				),
				'label'        => esc_html__( 'Calendar Days', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Customize and style the days on the calendar number text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'calendar_days',
				'disable_toggle' => false,
		  ),
		  'up_events' => array(
			'css'          => array(
				'main'      => "%%order_class%% .fc-event,%%order_class%% .fc-calendar-title a",
				'important' => 'all',
			),
			'label'        => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Customize and style the upcoming events text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
			'toggle_slug'  => 'upcoming_event',
			'disable_toggle' => false,
			),
		
			'_title' => array(
				'css'          => array(
					'main'      => ".tooltip_main .event_detail_style, .event_title_style, .title_text",
					'important' => 'all',
				),
				
				'label'        => esc_html__( 'Details Title', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Customize and style the Details title text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'tooltip_title',
				'disable_toggle' => false,
				'show_if_not' => array(
					'show_feature_image' => 'on',
				),
				
		  ),

			'tooltip_detail' => array(
				'css'          => array(
					'main'      => ".tooltip_main .event_detail_style .event_price_style,.tooltip_main .event_detail_style .ecs_tooltip_date,.tooltip_main .event_detail_style .ecs_tooltip_time,.tooltip_main .event_detail_style .tooltip_event_time,.tooltip_main .event_detail_style .event_category_style,.tooltip_main .event_detail_style .event_website_url_style,.tooltip_main .event_detail_style .event_venue_style,.tooltip_main .event_detail_style .event_organizer_style,.tooltip_main .event_detail_style .event_address_style",
					'important' => 'all',
				),
				
				'label'        => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'tooltip_detail',
				'disable_toggle' => false,
		),
			'tooltip_excerpt' => array(
				'css'          => array(
					'main'      => ".tooltip_main .event_detail_style .event_excerpt_style",
					'important' => 'all',
				),
				
				'label'        => esc_html__( 'Details Excerpt', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'  => 'tooltip_excerpt',
				'disable_toggle' => false,
		),

		'tooltip_title_labels' => array(
			'css'          => array(
				'main'      => ".tooltip_main .decm-detail-label, .ecs-detail-label",
				'important' => 'all',
			),
			
			'label'        => esc_html__( 'Details Labels', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
			'toggle_slug'  => 'tooltip_title_labels',
			'disable_toggle' => false,
	),
	
		
		),
		'box_shadow'     => array(
			'default' => array(
				'css' => array(
					'main' => "%%order_class%%",
				),
			),
			
		 'navigation_box_shadow'     => array(
				'css' => array(
					'main' => '%%order_class%% .fc-today-button,.fc-prev-button,.fc-next-button',
				),
				'label'         => esc_html__( 'Navigation Button Box Shadow Settings', 'decm-divi-event-calendar-module' ),
				'description'        => esc_html__( 'Add and customize the box shadow for the event featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'navigation',
				//'default'          => 'solid',
				// 'show_if_not'     => array(
				// 	'layout' => 'cover',
				// ),
			),
			'view_box_shadow'     => array(
				'css' => array(
					'main' =>  '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button,.fc-listMonth-button,.fc-listYear-button',
				),
				'label'         => esc_html__( 'View Buttons Box Shadow Settings', 'decm-divi-event-calendar-module' ),
				'description'        => esc_html__( 'Add and customize the box shadow for the event featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'view_button',
				//'default'          => 'solid',
				// 'show_if_not'     => array(
				// 	'layout' => 'cover',
				// ),
			),
		),

		
		);
		
		
	}

	public function get_settings_modal_toggles() {
		return array(
			
			'gerneral' => array(
				'toggles' => array(		
					'decm_contents' => array(
						'priority' => 1,
						'title' => esc_html__( 'Content', 'decm-divi-event-calendar-module' ),
					),
					'calendar_views' => array(
						'priority' => 2,
						'title' => esc_html__( 'Views', 'decm-divi-event-calendar-module' ),
					),
					'element' => array(
						'priority' => 3,
						'title' => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					),
					// 'more_info_button' => array(
					// 	'priority' => 20,
					// 	'title' => esc_html__( 'More Info Button', 'decm-divi-event-calendar-module'),
					// ),
					'link_show' => array(
						'priority' => 65,
						'title' => esc_html__( 'Links', 'decm-divi-event-calendar-module'),
					),
				),
			),
			
			  'advanced' => array(
				'toggles' => array(
					'month_text_style'  => esc_html__( 'Heading Text', 'decm-divi-event-calendar-module' ),
					'day_text_style'  => esc_html__( 'Days of the Week', 'decm-divi-event-calendar-module' ),
					'calendar_days'  => esc_html__( 'Calendar Days', 'decm-divi-event-calendar-module' ),
					'upcoming_event'  => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
					'calendar_image'  => esc_html__( 'Thumbnails In Calendar Days', 'decm-divi-event-calendar-module' ),
					'navigation'  => esc_html__( 'Navigation Buttons', 'decm-divi-event-calendar-module' ),
					'view_button'  => esc_html__( 'View Buttons', 'decm-divi-event-calendar-module' ),
					'tooltip_style'  => esc_html__( 'Tooltip', 'decm-divi-event-calendar-module' ),
					'tooltip_image'  => esc_html__( 'Details Image', 'decm-divi-event-calendar-module' ),
					'tooltip_title_labels'  => esc_html__( 'Details Labels Text', 'decm-divi-event-calendar-module' ),
					'tooltip_title'  => esc_html__( 'Details Title Text', 'decm-divi-event-calendar-module' ),
					'tooltip_detail'  => esc_html__( 'Details Text', 'decm-divi-event-calendar-module' ),
					'tooltip_excerpt'  => esc_html__( 'Details Excerpt Text', 'decm-divi-event-calendar-module' ),
					'admin_label' => array(
						'priority' => 99,
						'title' => esc_html__( 'Admin Label', 'decm-divi-event-calendar-module'),
					),

					
				),
			),
			 
		  );
	  }

	public function get_fields() {
		return array(
			'link'           => false,

			'event_calendar_lang' => array(
				
				'type'              => 'hidden',
				'option_category' => 'basic_option',
				'toggle_slug'       => 'decm_contents',
				'default'           => explode("_",get_locale())[0],
				
			),
			'show_dynamic_content'=> array(
				'label'				=> esc_html__( 'Dynamic Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to turn on or off dynamic content for the module, which allows you to place the module in a Divi Theme Builder layout to dynamically display events for the current category or page.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'off',
				// 'affects'           => array(
				// 	'included_categories',
				// ),
				// 	'show_if' => array(
				// 	//'use_shortcode'=>'off',
				// 	'show_dynamic_content'=>'on',
				// ),
				
			),
			

			'calendar_default_view'                      => array(
				'label'           => esc_html__( 'Default View', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose which view is set by default.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'dayGridMonth'         => esc_html__( 'Month View', 'decm-divi-event-calendar-module' ),
					'timeGridWeek'             => esc_html__( 'Week View', 'decm-divi-event-calendar-module' ),
					'timeGridDay' => esc_html__( 'Days View', 'decm-divi-event-calendar-module' ),
					'listWeek' => esc_html__( 'List View', 'decm-divi-event-calendar-module' ),
				),
				'mobile_options'  => true,
				'default'         => 'dayGridMonth',
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_views',
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),
			'calendar_list_view_option'                      => array(
				'label'           => esc_html__( 'List View Range', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose the default time range per page for showing events in the list view.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'listWeek,'   => esc_html__( 'Week', 'decm-divi-event-calendar-module' ),
					'listMonth,'  => esc_html__( 'Month', 'decm-divi-event-calendar-module' ),
					'listYear,'   => esc_html__( 'Year', 'decm-divi-event-calendar-module' ),
					
				),
				//'mobile_options'  => true,
				// 'show_if' => array(
				// 	'calendar_default_view'=>'listWeek',
				// ),
				'default'         => 'listWeek,',
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_views',
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),
			'show_calendar_thumbnail'=> array(
				'label'				=> esc_html__( 'Show Thumbnails In Calendar', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event image thumbnails in the month view of the calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_views',
				'default'			=> 'off',
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),


			'show_month_view_button'=> array(
				'label'				=> esc_html__( 'Show Month View Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button that toggles the month view.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),
			'show_week_view_button'=> array(
				'label'				=> esc_html__( 'Show Week View Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button that toggles the week view.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),	
			'show_day_view_button'=> array(
				'label'				=> esc_html__( 'Show Day View Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button that toggles the day view.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),

			'show_list_view_button'=> array(
				'label'				=> esc_html__( 'Show List View Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the button that toggles the list view.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),
			'calendar_eventorder'                      => array(
				'label'           => esc_html__( 'Same Day Event Order', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose the criteria for showing the order of events in a single day grid from top to bottom. ', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'start'         => esc_html__( 'Start Time', 'decm-divi-event-calendar-module' ),
					'-duration'             => esc_html__( 'Duration', 'decm-divi-event-calendar-module' ),
					'allDay' => esc_html__( 'All Day', 'decm-divi-event-calendar-module' ),
					'title' => esc_html__( 'Title', 'decm-divi-event-calendar-module' ),
				),
				'default'         => 'start',
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_views',
			),
			'event_time_format' => array(
				'label'             => esc_html__( 'Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_views',
				'computed_affects'  => array(
					'event_calendar_view',
				),
					'default'           => get_option('time_format'),
				
			),
			'show_calendar_event_date'=> array(
				'label'				=> esc_html__( 'Show Event Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the upcoming event time above the title.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'calender_end_time'=> array(
				'label'				=> esc_html__( 'Show End Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event end time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_views',
				'default'			=> 'on',
				'show_if' => array(
					'show_calendar_event_date'=>'on',
					//'show_date'=>'on',
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),

			'show_time_zone_on_calendar'=> array(
				'label'				=> esc_html__( 'Show Time Zone On Calendar', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'off',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'show_time_zone_abb_on_calender'=> array(
				'label'				=> esc_html__( 'Show Time Zone Abbrivation', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				'show_if' => array(
				
					'show_time_zone_on_calendar'=>'on',
					
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),


			'hide_calendar_event_all_day'=> array(
				'label'				=> esc_html__( 'Hide Time For All Day Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to hide the time for all day events.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'hide_calendar_event_multi_days'=> array(
				'label'				=> esc_html__( 'Hide Time For Multi-Day Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to hide the time for events that span more than one day.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),



			'show_event_venue'=> array(
				'label'				=> esc_html__( 'Show Event Venue', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the event venue name below the event title.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'off',
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),

			'limit_event_title_length'=> array(
				'label'				=> esc_html__( 'Limit Event Title Length', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to limit the length of the event title that shows in the calendar days.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'off',
				'computed_affects'  => array(
					'event_calendar_view',
				),			
			),
			

			'event_title_length' => array(
				'label'             => esc_html__( 'Event Title Length', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Set the number of characters for the event title length.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'calendar_views',
				'default'           => '100',
				'show_if' => array(
					'limit_event_title_length'=> 'on',
				),
			),

			'hide_pre_nxt_event'=> array(
				'label'				=> esc_html__( 'Hide Events From Previous And Next Months In Current Month View', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to hide any events from the previous month and next month from appearing in the current month view.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'calendar_views',
				'default'			=> 'off',
				'computed_affects'  => array(
					'event_calendar_view',
				),
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
			'show_tooltip'=> array(
				'label'				=> esc_html__( 'Show Tooltip', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the entire tooltip.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'mobile_options'  => true,
				'affects'         => array(
					'show_feature_image',
					'show_tooltip_title',
					'show_tooltip_date',
					'show_tooltip_time',
					'show_time_zone',
					'show_tooltip_excerpt',
					'show_tooltip_price',
					'show_tooltip_category',
				),
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
				
			),
			'show_feature_image'=> array(
				'label'				=> esc_html__( 'Show Image', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event featured image.', 'decm-divi-event-calendar-module' ),
				
                'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_title'=> array(
				'label'				=> esc_html__( 'Show Title', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event title.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
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
				'toggle_slug'		=> 'element',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// 	//'show_date'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
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
				'toggle_slug'		=> 'element',
				'default'			=> '',
				'show_if' => array(
					'event_series_name'=>'on',
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),	
			),

			'show_tooltip_date'=> array(
				'label'				=> esc_html__( 'Show Date', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event date.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),	

			'date_detail_label' => array(
				'label'             => esc_html__( 'Date Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the date label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_date'=>'on',
				)
			),

			'date_format' => array(
				'label'             => esc_html__( 'Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				'computed_affects'  => array(
					'event_calendar_view',
				),
					//'default'           => get_option('date_format'),
				
			),
		
			'show_tooltip_time'=> array(
				'label'				=> esc_html__( 'Show Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	//'use_shortcode'=>'off',
				// 	'show_tooltip_date'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'details_time_label' => array(
				'label'             => esc_html__( 'Time Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the time label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_time'=>'on',
				)
			),


			'time_format' => array(
				'label'             => esc_html__( 'Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				'computed_affects'  => array(
					'event_calendar_view',
				),
					//'default'           => get_option('date_format'),
				
			),
			'show_end_time'=> array(
				'label'				=> esc_html__( 'Show End Time', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event end time.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// 	//'show_date'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),
			
			'show_time_zone'=> array(
				'label'				=> esc_html__( 'Show Time Zone', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_time_zone_abb'=> array(
				'label'				=> esc_html__( 'Show Time Zone Abbrivation', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event time zone.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'show_if' => array(
				
					'show_time_zone'=>'on',
					
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_venue'=> array(
				'label'				=> esc_html__( 'Show Venue', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'venue_detail_label' => array(
				'label'             => esc_html__( 'Venue Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the venue label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_venue'=>'on',
				)
			),

			'show_tooltip_location'=> array(
				'label'				=> esc_html__( 'Show Location', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location.', 'decm-divi-event-calendar-module' ),
				'affects'         => array(
					'show_tooltip_street',
					'show_tooltip_locality',
					'show_tooltip_postal',
					'show_tooltip_country',
					'show_tooltip_state',
					'show_tooltip_street_comma',
					'show_tooltip_locality_comma',
					'show_tooltip_postal_comma',
					'show_tooltip_country_comma',
					'show_tooltip_state_comma',
					'show_postal_code_before_locality',
				),
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),


			'location_detail_label' => array(
				'label'             => esc_html__( 'Location Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the location label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_location'=>'on',
				)
			),


			'show_tooltip_street'=> array(
				'label'				=> esc_html__( 'Show Location Street Address', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location street address.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),	
			'show_tooltip_street_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Street Address', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location street address.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'element',
				'default'			=> 'on',

				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),			
				'show_tooltip_locality'=> array(
				'label'				=> esc_html__( 'Show Location Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location locality.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_locality_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location locality.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'element',
				'default'			=> 'on',

				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_state'=> array(
				'label'				=> esc_html__( 'Show Location State', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location State.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),		
			'show_tooltip_state_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location State/Province', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location state/province.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=>'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),	
				'show_tooltip_postal'=> array(
				'label'				=> esc_html__( 'Show Location Postal Code', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location postal code.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_postal_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Postal Code', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location postal code.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'element',
				'default'			=> 'on',
	
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_country'=> array(
				'label'				=> esc_html__( 'Show Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location country.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_country_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location country.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'element',
				'default'			=> 'on',
	
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
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
				
				'toggle_slug'     => 'element',
				'default'			=> 'off',
	
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_tooltip_organizer'=> array(
				'label'				=> esc_html__( 'Show Organizer', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event Organizer.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				
				// 	'show_tooltip_date'=>'on',
				// 	'show_tooltip_time'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'organizer_detail_label' => array(
				'label'             => esc_html__( 'Organizer Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the organizer label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_organizer'=>'on',
				)
			),


			'show_tooltip_price'=> array(
				'label'				=> esc_html__( 'Show Price', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event price.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'price_detail_label' => array(
				'label'             => esc_html__( 'Price Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the price label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_price'=>'on',
				)
			),

			'show_tooltip_ticket'=> array(
				'label'				=> esc_html__( 'Show Ticket', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event price.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'price_ticket_label' => array(
				'label'             => esc_html__( 'Ticket Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the price label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_ticket'=>'on',
				)
			),

			'show_ticket_feed_respond'=> array(
				'label'				=> esc_html__( 'Show Purchase Now Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the text and link to purchase tickets.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'show_if' => array(
					'show_tooltip_ticket'=>'on',
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'show_ticket_feed_left'=> array(
				'label'				=> esc_html__( 'Show Places Left', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the number of tickets left.', 'decm-divi-event-calendar-module' ),
				
               // 'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'show_if' => array(
					'show_tooltip_ticket'=>'on',
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
		

			'show_rsvp'=> array(
				'label'				=> esc_html__( 'Show RSVP', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the event RSVP link to the single event page if the event has a RSVP associated with it.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),
			'rsvp_detail_label' => array(
				'label'             => esc_html__( 'RSVP Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the rsvp label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_rsvp'=>'on',
				)
			),

			'show_rsvp_feed_respond'=> array(
				'label'				=> esc_html__( 'Show Respond Now Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'show_if' => array(
							'show_rsvp'=>'on',
				),
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the text and link to respond to the RSVP.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),
			'show_rsvp_feed_left'=> array(
				'label'				=> esc_html__( 'Show Places Left', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the number of RSVP places left.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'show_if' => array(
							'show_rsvp'=>'on',
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),
			),

			'show_tooltip_category'=> array(
				'label'				=> esc_html__( 'Show Category', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event excerpt.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),


			'category_detail_label' => array(
				'label'             => esc_html__( 'Category Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the category label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_category'=>'on',
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
				'toggle_slug'		=> 'element',
				'default'			=> 'off',
				'show_if' => array(
					'show_tooltip_category'=>'on',
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
				'toggle_slug'		=> 'element',
				'default'			=> 'on',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// )
			),

			
			'tag_detail_label' => array(
				'label'             => esc_html__( 'Tags Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the tags label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
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
				'toggle_slug'		=> 'element',
				'default'			=> 'off',
				'show_if' => array(
					'show_tag'=>'on',
				)
			),
			
			'show_tooltip_weburl'=> array(
				'label'				=> esc_html__( 'Show Website', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event website URL.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'website_detail_label' => array(
				'label'             => esc_html__( 'Website Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the website label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'element',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => '',
				'show_if' => array(
					'show_tooltip_weburl'=>'on',
				)
			),
			'show_tooltip_excerpt'=> array(
				'label'				=> esc_html__( 'Show Excerpt', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event excerpt.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'element',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			// 'show_detail'=> array(
			// 	'label'				=> esc_html__( 'Show More Info Button', 'decm-divi-event-calendar-module' ),
			// 	'type'				=> 'hidden',
			// 	'option_category'	=> 'configuration',
			// 	'options'			 => array(
			// 		'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
			// 		'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
			// 	),
			// 	'description'		=> esc_html__( 'Choose to show or hide the event more info button.', 'decm-divi-event-calendar-module' ),
			// 	'toggle_slug'		=> 'more_info_button',
			// 	'default'			=> 'on',
				
			// ),
			// 'view_more_text' => array(
            //     'label'           => esc_html__( 'More Info Button Text', 'decm-divi-event-calendar-module' ),
            //     'type'            => 'hidden',
            //     'option_category' => 'basic_option',
            //     'description'     => esc_html__( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
            //     'toggle_slug'     => 'more_info_button',
			// 	'default'         => esc_html__( 'More Info', 'decm-divi-event-calendar-module' ),
			// 	'dynamic_content'  => 'text',
			// 	'mobile_options'   => true,
			// 	//'hover'            => 'tabs',
			// 	'computed_affects'  => array(
			// 		'event_calendar_view',
			// 	),

            // ),
			// 'view_more_icons_list' => array(
            //     'label'           => esc_html__( 'Button Text', 'decm-divi-event-calendar-module' ),
            //     'type'            => 'hidden',
            //     'option_category' => 'basic_option',
            //     'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
            //     'toggle_slug'     => 'more_info_button',
            //     'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
            // ),
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
				'toggle_slug'     => 'element',
				 'default' => 'label_icon',
				 'computed_affects'  => array(
					'event_calendar_view',
				),
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
				'toggle_slug'     => 'element',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_data_one_line'=>'on',
				),
				// 'show_if_not' => array(
				// 	'show_icon_label'=>'none',
				// )
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
				'toggle_slug'     => 'element',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	'use_shortcode'=>'off',
				// 	'show_data_one_line'=>'on',
				// ),
				// 'show_if' => array(
				// 	'show_icon_label'=>array('label_icon','label'),
				// )
			),
			'event_selection' => array(
                'label'           => esc_html__( 'Event Selection', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'All Events is the default setting to display all events. Dynamic Events allows you to place the module in a Divi Theme Builder layout to dynamically display events based on the template assignment. Related Events is used on the single event pages to hide the current event and show other events related to the current event. Featured Events shows only featured events in the feed. Custom Events Selection gives you full control to use checkmarks to select events based on specific criteria like category, organizer, venue, and date range.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'all_event'   => __( 'All Events',  'decm-divi-event-calendar-module' ),
                    'show_dynamic_content'   => __( 'Dynamic Events', 'decm-divi-event-calendar-module' ),
                    //'related_event'   => __( 'Related Events', 'decm-divi-event-calendar-module' ),
					'featured_events'   => __( 'Featured Events', 'decm-divi-event-calendar-module' ),
					'custom_event'   => __( 'Custom Events Selection', 'decm-divi-event-calendar-module' ),
                  
                ],
                
                'tab_slug'		  => 'general',
                //'mobile_options'  => true,
				'toggle_slug'      => 'decm_contents',
				 'default' => 'all_event',
				 'computed_affects'  => array(
					'event_calendar_view',
				),
			),
			
			'included_categories' => array(
				'label'            => esc_html__( 'Categories', 'decm-divi-event-calendar-module' ),
				'type'             => 'categories',
// 				'meta_categories'  => array(
// 					'all'     => esc_html__( 'All Categories', 'decm-divi-event-calendar-module' ),
// // 					'current' => esc_html__( 'Current Category', 'decm-divi-event-calendar-module' ),
// 				),
				'option_category'  => 'configuration',
				'renderer_options' => array(
					'use_terms' => true,
					'term_name' => 'tribe_events_cat',
					
				),
				'description'      => esc_html__( 'Customize which events show in the feed by category. All events will show by default unless one or more categories are selected.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_contents',
				'computed_affects'  => array(
					'event_calendar_view',
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
				'description'      => esc_html__( 'Customize which events show in the feed by category. All events will show by default unless one or more organizer are selected.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_contents',
				'computed_affects'   => array(
					'event_calendar_view',
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
				'description'      => esc_html__( 'Customize which events show in the feed by category. All events will show by default unless one or more veneues are selected.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'decm_contents',
				'computed_affects'   => array(
					'event_calendar_view',
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
				'toggle_slug'      => 'decm_contents',
				'computed_affects'   => array(
					'event_calendar_view',
				),

				'show_if' => array(
					'event_selection'=>'custom_event',
				),

			),
			'number_event_day' => array(
				'label'             => esc_html__( 'Number Of Events Per Day', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'default'   => __( 'Default',  'decm-divi-event-calendar-module' ),
					'1'   => __( '1', 'decm-divi-event-calendar-module' ),
					'2'   => __( '2', 'decm-divi-event-calendar-module' ),
					'3'   => __( '3', 'decm-divi-event-calendar-module' ),
					'4'   => __( '4', 'decm-divi-event-calendar-module' ),
					'5'   => __( '5', 'decm-divi-event-calendar-module' ),
					'6'   => __( '6', 'decm-divi-event-calendar-module' ),
					'7'   => __( '7', 'decm-divi-event-calendar-module' ),
					'8'   => __( '8', 'decm-divi-event-calendar-module' ),
					'9'   => __( '9', 'decm-divi-event-calendar-module' ),
					'10'   => __( '10', 'decm-divi-event-calendar-module' ),
				],
				'description'       => esc_html__( 'Set the maximum number of events that show each day in the month calendar view.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_contents',
		         'default'           => 'default',
				'computed_affects'   => array(
					'event_calendar_view',
				),
			),
			'limit_event'=> array(
				'label'				=> esc_html__( 'Limit Loading Of Past/Future Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to limit how far in the past and future events should load in the calendar.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'on',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				'affects' => array(
									'event_start_date',
									'event_end_date',
				),
				
			),
			'hide_past_event'=> array(
				'label'				=> esc_html__( 'Hide Past Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to hide past events from showing in the calendar.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	//'use_shortcode'=>'off',
				// 	'show_tooltip_date'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'event_start_date' => array(
				'label'             => esc_html__( 'Number Of Past Months To Load', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter a number of months to set the limit on how far in the past events should load and show in the calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'decm_contents',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
					'default'           => 1,
					'show_if'=>array(
						'limit_event'=>'on',
					),				
			),

			'event_end_date' => array(
				'label'             => esc_html__( 'Number Of Future Months To Load', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter a number of months to set the limit on how far in the future events should load and show in the calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'decm_contents',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
					'default'           => 6,
				'show_if'=>array(
					'limit_event'=>'on',
				),

			),
		
			'hide_month_range'                      => array(
				'label'           => esc_html__( 'Limit Navigation Range', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose to prevent the user from navigating or viewing months beyond the selected number of past or future months limit.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'disable' => esc_html__( 'Disable Navigation', 'decm-divi-event-calendar-module' ),
					'hide' => esc_html__( 'Hide Months Beyond Range', 'decm-divi-event-calendar-module' ),
				),
				'default'         => 'disable',
				'tab_slug'          => 'general',
				'toggle_slug'     => 'decm_contents',
				'mobile_options'    => true,
				'show_if'=>array(
					'limit_event'=>'on'
				),
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'hide_past_event'=> array(
				'label'				=> esc_html__( 'Hide Past Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to hide past events from showing in the calendar.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'off',
				// 'show_if' => array(
				// 	//'use_shortcode'=>'off',
				// 	'show_tooltip_date'=>'on',
				// ),
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'show_feature_event'=> array(
				'label'				=> esc_html__( 'Only Show Featured Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to only show featured events in the calendar.', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'off',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),
			'day_of_the_week_name'                      => array(
				'label'           => esc_html__( 'Day of the Week Name', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose whether the days of the week should be abbreviated to show the full name.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'short' => esc_html__( 'Abbreviated', 'decm-divi-event-calendar-module' ),
					'long' => esc_html__( 'Full Name', 'decm-divi-event-calendar-module' ),
				),
				'default'         => 'short',
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'day_text_style',
				'mobile_options'    => true,
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'week_background_color' => array(
				'label'             => esc_html__( 'Days of Week Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Add a background color to the days of the week.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
			
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'day_text_style',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'days_background_color' => array(
				'label'             => esc_html__( 'Calendars Days Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Add a background color to the days on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'current_days_background_color' => array(
				'label'             => esc_html__( 'Current Calendar Day Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the current day on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'current_day_text_color' => array(
				'label'             => esc_html__( 'Current Calendar Day Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the current day on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'past_days_background_color' => array(
				'label'             => esc_html__( 'Past Calendar Days Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the past days on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'past_days_text_color' => array(
				'label'             => esc_html__( 'Past Calendar Days Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the past days on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'month_days_text_opacity'       => array(
				'label'           => esc_html__( 'Other Month Days Text Opacity', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Set the text opacity for the other month days on the calendar.', 'decm-divi-event-calendar-module' ),
			    'type'            => 'range',
				'default'         => '0.3',
				'unitless'        => true,
				'range_settings'  => array(
					'min'  => '0.1',
					'max'  => '1',
					'step' => '0.1',
				),
				//'option_category' => 'basic_option',
				'tab_slug'          => 'advanced',
				'priority'   =>         10,
				'toggle_slug'     => 'calendar_days',
			),
			'events_background_color' => array(
				'label'             => esc_html__( 'Events Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the upcoming events.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'upcoming_event',
				 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'navigate_background_color' => array(
				'label'             => esc_html__( 'Navigation Button Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the calendar navigation.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'navigation',
				'hover'           => 'tabs',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'navigate_text_color' => array(
				'label'             => esc_html__( 'Navigation Button Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the calendar navigation.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'navigation',
				'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			

			'view_background_color' => array(
				'label'             => esc_html__( 'View Buttons Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the view buttons.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'view_button',
				'hover'           => 'tabs',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'view_text_color' => array(
				'label'             => esc_html__( 'View Buttons Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the view buttons.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'view_button',
				'hover'             => 'tabs',
		
				
				//'mobile_options'    => true,
			),
			'view_current_tab_color' => array(
				'label'             => esc_html__( 'Current View Button Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the current view button.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'view_button',
				
				//'hover'           => 'tabs',
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
		

			'view_current_tab_text_color' => array(
				'label'             => esc_html__( 'Current View Button Text Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the text color for the current view button.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'view_button',
				//'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'tooltip_background_color' => array(
				'label'             => esc_html__( 'Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the background color for the calendar Details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'tooltip_style',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'tooltip_detail_link_color' => array(
				'label'             => esc_html__( 'Details Link Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the link text in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'tooltip_detail',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'details_icon_color' => array(
				'label'             => esc_html__( 'Details Icon Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the icons in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'tooltip_detail',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),


			'details_icon_size' => array(
				'label'           => esc_html__( 'Details Icon Size', 'decm-divi-event-calendar-module' ),
				'description' => __('Adjust the size of the details icons.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'tooltip_detail',
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
			'upcoming_margin' => array(
				'label' => __('Events Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the upcoming events.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'upcoming_event',
				'mobile_options'  => true,
					'default' => '4px|auto|auto|auto|false|false',
			),
			'upcoming_padding' => array(
				'label' => __('Events Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the upcoming events.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'upcoming_event',
				'default' => '4px|6px|4px|6px|false|false',
				'mobile_options'  => true,
			),

			'days_padding' => array(
				'label' => __('Days of the Week Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the days of the week', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'day_text_style',
				//'default' => '4px|6px|4px|6px|false|false',
				'mobile_options'  => true,
			),

			'calendar_days_padding' => array(
				'label' => __('Calendar Days Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the days of the week.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'calendar_days',
				//'default' => '4px|6px|4px|6px|false|false',
				'mobile_options'  => true,
			),
			'navigation_margin' => array(
				'label' => __('Navigation Buttons Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the navigation buttons.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'navigation' ,
				'mobile_options'  => true,
					//'default' => 'auto|auto|auto|auto|false|false',
			),
			'navigation_padding' => array(
				'label' => __('Navigation Buttons Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the navigation buttons.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'navigation' ,
				//'default' => '4px|6px|4px|6px|false|false',
				'mobile_options'  => true,
			),
			'view_button_margin' => array(
				'label' => __('View Buttons Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the View buttons.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'view_button' ,
				'mobile_options'  => true,
					//'default' => 'auto|auto|auto|auto|false|false',
			),
			'view_button_padding' => array(
				'label' => __('View Buttons Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the View buttons.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'view_button' ,
				//'default' => '4px|6px|4px|6px|false|false',
				'mobile_options'  => true,
			),
			'calendar_border_width' => array(
				'label' => __('Calendar Days Border Width', 'decm-divi-event-calendar-module'),
				'type' => 'range',
				'description' => __('Set the border width for the days on the calendar.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'calendar_days',
				'default'    => '1px',
				'default_unit'    => 'px',
				'mobile_options'  => true,
			),
			'calendar_border_color' => array(
				'label'             => esc_html__( 'Calendar Days Border Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a border color for the days on the calendar.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'calendar_days',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'week_days_border_width' => array(
				'label' => __('Days of Week Border Width', 'decm-divi-event-calendar-module'),
				'type' => 'range',
				'description' => __('Set the border width for the days of the week.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'day_text_style',
				'default'     => '1px',
				'default_unit'    => 'px',
				'mobile_options'  => true,
			),
			'week_days_border_color' => array(
				'label'             => esc_html__( 'Days of Week Border Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a border color for the days of the week.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'day_text_style',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'hidden_day' => array(
				'label'            => esc_html__( 'Disable Days Of The Week', 'decm-divi-event-calendar-module' ),
				'type'            => 'multiple_checkboxes',
				'option_category' => 'configuration',
				'options'		=>[
					'0'   => __( 'Sunday',  'decm-divi-event-calendar-module' ),
					'1'   => __( 'Monday', 'decm-divi-event-calendar-module' ),
					'2'   => __( 'Tuesday', 'decm-divi-event-calendar-module' ),
					'3'   => __( 'Wednesday', 'decm-divi-event-calendar-module' ),
					'4'   => __( 'Thursday', 'decm-divi-event-calendar-module' ),
					'5'   => __( 'Friday', 'decm-divi-event-calendar-module' ),
					'6'   => __( 'Saturday', 'decm-divi-event-calendar-module' ),
				],
				'description'      => esc_html__( 'Choose which days of the week to show or hide in the calendar. All days show by default. Selecting a day will disable it from showing in the calendar.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'calendar_views',
				'computed_affects'   => array(
					'event_calendar_view',
				),
				'default'    => " ",
				// 'show_if' => array(
				// 	'event_selection'=>'custom_event',
				// ),
			),
			
			'week_start_on' => array(
				'label'             => esc_html__( 'Week Starts On', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'0'   => __( 'Sunday',  'decm-divi-event-calendar-module' ),
					'1'   => __( 'Monday', 'decm-divi-event-calendar-module' ),
					'2'   => __( 'Tuesday', 'decm-divi-event-calendar-module' ),
					'3'   => __( 'Wednesday', 'decm-divi-event-calendar-module' ),
					'4'   => __( 'Thursday', 'decm-divi-event-calendar-module' ),
					'5'   => __( 'Friday', 'decm-divi-event-calendar-module' ),
					'6'   => __( 'Saturday', 'decm-divi-event-calendar-module' ),
				],
				'description'       => esc_html__( 'Choose which day of the week should be the first day in the calendar view.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'calendar_views',
		        'default'           => '0',
				'computed_affects'   => array(
					'event_calendar_view',
				),
				
			),

			'hide_time_range_in_week_day'=> array(
				'label'				=> esc_html__( 'Hide Time Range In Week and Day Views', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to hide the hour intervals in the Week and Day views by time range.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_views',
				'default'			=> 'off',
			),

			'starting_point' => array(
                'label'             => esc_html__( 'Start Time For Hidden Time Range', 'decm-divi-event-calendar-module' ),
                'type'              => 'text',
                'option_category'   => 'configuration',
                'description'       => esc_html__( 'Enter the start time to hide hour intervals in the Week and Day view. The time must include AM or PM units. NOTE: This will hide all hour intervals in the Week and Day views, regardless if any events are within those times or not.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'calendar_views',
                'default'           => '12AM/PM',
				'show_if' => array(
					'hide_time_range_in_week_day'=>'on',
				),

            ),
            'ending_point' => array(
                'label'             => esc_html__( 'End Time For Hidden Time Range', 'decm-divi-event-calendar-module' ),
                'type'              => 'text',
                'option_category'   => 'configuration',
                'description'       => esc_html__( 'Enter the end time to hide hour intervals in the Week and Day view. The time must include AM or PM units. NOTE: This will hide all hour intervals in the Week and Day views, regardless if any events are within those times or not.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'calendar_views',
                'default'           => '12AM/PM',
				'show_if' => array(
					'hide_time_range_in_week_day'=>'on',
				),

            ),

			'show_specific_month'=> array(
				'label'				=> esc_html__( 'Show Specific Month By Default', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose a specific month as the first month a visitor will see in the calendar when they view the page. If you only want to show this specific month without viewing others, you can disable the navigation buttons.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_views',
				'default'			=> 'off',
			),

			'specific_month_start' => array(
				'label'             => esc_html__( 'Choose Month', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'0'  =>  esc_html__('January','decm-divi-event-calendar-module'),
					'1'  =>  esc_html__('February','decm-divi-event-calendar-module'), 
					'2'  =>  esc_html__('March','decm-divi-event-calendar-module'),
					'3'  =>  esc_html__('April','decm-divi-event-calendar-module'), 
					'4'  =>  esc_html__('May','decm-divi-event-calendar-module'), 
					'5'  =>  esc_html__('June','decm-divi-event-calendar-module'),
					'6'  =>  esc_html__('July','decm-divi-event-calendar-module'),
					'7'  =>  esc_html__('August','decm-divi-event-calendar-module'),
					'8'  =>  esc_html__('September','decm-divi-event-calendar-module'), 
					'9'  =>  esc_html__('October','decm-divi-event-calendar-module'),
					'10'  => esc_html__('November','decm-divi-event-calendar-module'),
					'11'  => esc_html__('December','decm-divi-event-calendar-module'), 
				],
				'description'       => esc_html__( 'Choose which specific month you want to show.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'calendar_views',
		        'default'           => '0',
				'computed_affects'   => array(
					'show_specific_month',
				),
				'show_if' => array(
					'show_specific_month'=>'on',
				),	
			),

			'specific_years_start' => array(
				'label'             => esc_html__( 'Choose Year', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'2023'  =>  esc_html__('2023','decm-divi-event-calendar-module'),
					'2024'  =>  esc_html__('2024','decm-divi-event-calendar-module'), 
					'2025'  =>  esc_html__('2025','decm-divi-event-calendar-module'),
					'2026'  =>  esc_html__('2026','decm-divi-event-calendar-module'), 
					'2027'  =>  esc_html__('2027','decm-divi-event-calendar-module'), 
					'2028'  =>  esc_html__('2028','decm-divi-event-calendar-module'),
					'2029'  =>  esc_html__('2029','decm-divi-event-calendar-module'),
					'2030'  =>  esc_html__('2030','decm-divi-event-calendar-module'),
					'2031'  =>  esc_html__('2031','decm-divi-event-calendar-module'), 
					'2032'  =>  esc_html__('2032','decm-divi-event-calendar-module'),
					'2033'  =>  esc_html__('2033','decm-divi-event-calendar-module'),
				],
				'description'       => esc_html__( 'Choose which specific year you want to show.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'calendar_views',
		        'default'           => '2024',
				'computed_affects'   => array(
					'show_specific_month',
				),
				'show_if' => array(
					'show_specific_month'=>'on',
				),	
			),

			'show_postponed_canceled_event'=> array(
				'label'				=> esc_html__( 'Show Canceled And Postponed Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show canceled and postponed events in the calendar. A badge will be displayed on the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_contents',
				'default'			=> 'on',
				
				'computed_affects'   => array(
					'event_calendar_view',
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
				'description'		=> esc_html__( 'Choose to show virtual events in the calendar. A badge will be displayed on the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_contents',
				'default'			=> 'off',
				'computed_affects'   => array(
					'event_calendar_view',
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
				'description'		=> esc_html__( 'Choose to show hybrid events in the calendar. A badge will be displayed on the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_contents',
				'default'			=> 'off',
				'computed_affects'   => array(
					'event_calendar_view',
				),
			),
			'show_recurring_event'=> array(
				'label'				=> esc_html__( 'Show Recurring Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show all recurring events in the calendar. ', 'decm-divi-event-calendar-module' ),
				
                //'mobile_options'  => true,
				'toggle_slug'     => 'decm_contents',
				'default'			=> 'off',
				'computed_affects'  => array(
					'event_calendar_view',
				),
				
			),

			'detail_below_calander'=> array(
                'label'				=> esc_html__( 'Show Details Below Calendar On Phone', 'decm-divi-event-calendar-module' ),
                'type'				=> 'hidden',
                'option_category'	=> 'configuration',
                'options'			 => array(
                    'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
                    'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
                ),
                'description'		=> esc_html__( 'Choose to show the event details below the calendar on Phone sizes instead of in the tooltip.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'		=> 'decm_contents',
                'default'			=> 'off',

                'computed_affects'   => array(
                    'event_calendar_view',
                ),
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
				'computed_affects'  => array(
					'event_calendar_view',
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => 'default',
			),
			'disable_event_calendar_title_link'      => array(
				'label'            => esc_html__( 'Disable Event Calendar Title Link',  'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Choose to disable the event calendar title from linking to the single event page.',  'decm-divi-event-calendar-module' ),
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
				),
				'computed_affects'  => array(
					'event_calendar_view',
				),
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
			'enable_category_link'=> array(
				'label'				=> esc_html__( 'Enable Category Links', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the categories to link to their own archive pages.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'event_calendar_view',
				),
				'default'			=> 'on',
				'show_if' => array(
					'show_tooltip_category'=>"on",
				)
			),
			'custom_category_link_target' => array(
				'label'           => esc_html__( 'Category Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the category page links open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],
				'computed_affects'   => array(
					'event_calendar_view',
				),
				'show_if' => array(
					'enable_category_link'=>"on",
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
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
			
				'default'			=> 'off',
				'computed_affects'   => array(
					'event_calendar_view',
				),
				'show_if' => array(
					//'use_shortcode'=>'off',
					'show_tooltip_organizer'=>"on",
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
					'event_calendar_view',
				),
				'default'			=> 'off',
				'show_if' => array(
					// 'use_shortcode'=>'off',
					'show_tooltip_venue'=>"on",
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
					'event_calendar_view',
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
					'event_calendar_view',
				),
			),	

			'custom_website_link_target' => array(
				'label'           => esc_html__( 'Website Link Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the custom single event page link opens in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],
				// 'show_if' => array(
				// 	'website_link'=>'custom_text',
				// ),
				'computed_affects' => array(
					'event_calendar_view',
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
			),
			'tooltip_image_aspect_ratio'                      => array(
				'label'           => esc_html__( 'Image Aspect Ratio', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the aspect ratio of the event featured image.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'1/1'   => esc_html__( 'Square 1:1', 'decm-divi-event-calendar-module' ),
					'16/9'  => esc_html__( 'Landscape 16:9', 'decm-divi-event-calendar-module' ),
					'4/3'   => esc_html__( 'Landscape 4:3', 'decm-divi-event-calendar-module' ),
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
				'toggle_slug'     => 'tooltip_image',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'tooltip_image_align' => array(
				'label'           => esc_html__( 'Tooltip Image Alignment', 'decm-divi-event-calendar-module' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'default_on_front' => 'left',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'tooltip_image',
				'description'     => esc_html__( 'Choose to align the event featured image to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				'options_icon'    => 'module_align',
				//'mobile_options'  => true,
			),
			'calendar_image_aspect_ratio'                      => array(
				'label'           => esc_html__( 'Image Aspect Ratio', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set the aspect ratio of the event featured image.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'         => array(
					'1/1'   => esc_html__( 'Square 1:1', 'decm-divi-event-calendar-module' ),
					'16/9'  => esc_html__( 'Landscape 16:9', 'decm-divi-event-calendar-module' ),
					'4/3'   => esc_html__( 'Landscape 4:3', 'decm-divi-event-calendar-module' ),
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
				'toggle_slug'     => 'calendar_image',
				// 'computed_affects'  => array(
				// 	'event_calendar_view',
				// ),
			),
			'calendar_image_align' => array(
				'label'           => esc_html__( 'Calendar Thumbnail Alignment', 'decm-divi-event-calendar-module' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'default_on_front' => 'left',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'calendar_image',
				'description'     => esc_html__( 'Choose to align the event featured image to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				'options_icon'    => 'module_align',
				//'mobile_options'  => true,
			),
			
			'thumbnail_width' => array(
				'label'           => esc_html__( 'Image Width', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'tooltip_image',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '400',
				'allow_empty'     => true,
				'responsive'      => true,
				'mobile_options'  => true,
				
			),
			'thumbnail_height' => array(
				'label'           => esc_html__( 'Image Height', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'tooltip_image',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '400',
				'allow_empty'     => true,
				'responsive'      => true,	
				'mobile_options'  => true,
				
			),
			'calendar_thumbnail_width' => array(
				'label'           => esc_html__( 'Calendar Thumbnail Width', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'calendar_image',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '300',
				'allow_empty'     => true,
				'responsive'      => true,

				//'mobile_options'  => true,
				
			),
			'calendar_thumbnail_height' => array(
				'label'           => esc_html__( 'Calendar Thumbnail Height', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'calendar_image',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '200',
				'allow_empty'     => true,
				'responsive'      => true,
	
				//'mobile_options'  => true,
				
			),

			'tooltip_width' => array(
				'label' => esc_html__('Tooltip Width', 'decm-divi-event-calendar-module'),
				'type' => 'range',
				'description' => esc_html__('Set the width of the tooltip.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'tooltip_style',
				'default'   => '20%',
				'default_tablet' => '30%',
				//'default_on_tablet' => '30%',
				'default_phone'  => '50%',
				'default_unit'    => '%',
				'allowed_values' => et_builder_get_acceptable_css_string_values( 'max-width' ),
				'mobile_options'  => true,
				//'allow_empty'     => true,
				//'responsive'      => true,
			   // 'default_on_child' => true,
			),
			
			'event_calendar_view'         => array(
				'type'              => 'computed',
				'computed_callback' => array( 'DECM_DiviEventCalendar', 'get_events' ),
				'computed_depends_on'  => array(		
                    'show_feature_image',
					'show_tooltip_excerpt',
					'show_icon_label',
					'stack_label_icon',
					'show_colon',
                    'show_tooltip_price',
					'show_tooltip_ticket',
					'show_tooltip_title',
                    'show_tooltip_date',
					'event_series_label',
					'event_series_name',
					'custom_series_link_target',
					'enable_series_link',
					'show_tooltip_time',
					'date_format',
					'time_format',
					'event_time_format',
					'show_time_zone',
					'show_time_zone_on_calendar',
					'show_event_venue',
					'limit_event_title_length',
					'event_title_length',
					'hide_pre_nxt_event',
					'show_rsvp',
					'show_time_zone_abb',
					'show_time_zone_abb_on_calender',
					'show_tooltip_venue',
					'show_tooltip_location',
					'show_tooltip_locality',
					'show_tooltip_state',
					'show_tooltip_street',
					'show_tooltip_city',
					'show_tooltip_postal',
					'show_tooltip_country',
					'show_tooltip_street_comma',
					'show_tooltip_locality_comma',
					'show_tooltip_postal_comma',
					'show_tooltip_country_comma',
					'show_tooltip_state_comma',
					'show_postal_code_before_locality',
					'show_tooltip_organizer',
					'show_tooltip_category',
					'show_rsvp_feed_left',
					'show_rsvp_feed_respond',
					'show_ticket_feed_left',
					'show_ticket_feed_respond',
					'hide_comma_cat',
					'show_tooltip_weburl',
					'tooltip_background_color',
					'included_categories' ,
					'included_organizer',
					'included_series',
					'included_venue',
					'show_feature_event',
					'show_calendar_event_date',
					'calender_end_time',
					'calendar_default_view',
					'show_recurring_event',
					'hide_past_event',
					'show_end_time',
					'single_event_page_link',
					'custom_event_link_url',
					'enable_category_link',
					'custom_tag_link_target',
					'enable_tag_links',
					'custom_category_link_target',
					'enable_organizer_link',
					'enable_venue_link',
					'website_link',
					'custom_website_link_text',
					'custom_website_link_target',
					'day_of_the_week_name',
					'event_selection',
					'week_start_on',
					'show_postponed_canceled_event',
					'show_virtual_event',
				//	'show_virtual_event_s',
					'show_hybrid_event',
				//	'view_more_text',
					'hidden_day',
					'calendar_list_view_option',
					'hide_calendar_event_all_day',
					'hide_calendar_event_multi_days',
					'hide_comma_tag',
					'show_tag',
					'show_calendar_thumbnail',
					'category_detail_label',
					'details_time_label',
					'date_detail_label',
					'venue_detail_label',
					'location_detail_label',
					'organizer_detail_label',
					'price_detail_label',
					'price_ticket_label',
					'rsvp_detail_label',
					'tag_detail_label',
					'website_detail_label'
				),
			),

		);
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
		//plugin is activated
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
static function get_events($atts = array(), $conditional_tags = array(), $current_page = array())
{
	
			$atts['event_tax']='';
if ( $atts['included_categories'] ) {
	if ( strpos( $atts['included_categories'] , "," ) !== false ) {
		$atts['included_categories']  = explode( ",", $atts['included_categories'] );
		$atts['included_categories']  = array_map( 'trim', $atts['included_categories'] );
	} else {
		$atts['included_categories']  = array( trim( $atts['included_categories'] ) );
	}

	$atts['event_tax'] = array(
		'relation' => 'OR',
	);

	foreach ( $atts['included_categories']  as $cat ) {
		$atts['event_tax'][] = array(
				'taxonomy' => 'tribe_events_cat',
				'field' => 'term_id',
				'terms' => $cat,
			);
			
	}
}
$meta_query_status="";
$filter_event_status="";
if($atts['show_postponed_canceled_event']=='off'){
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
		'meta_query' =>array($meta_query_status), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	  );
	  $filter_event_status = tribe_get_events($filter_event_status);


	  $filter_event_status =$atts['show_postponed_canceled_event']=='off'? wp_list_pluck($filter_event_status, 'ID'):array(0);
	

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
		$meta_query_status_virtual =
		 
		  array(
			'key' => '_tribe_virtual_events_type',
			'value' => 'virtual',
			'compare' => '=',
			'type' => 'Text'
		
	  
		  );
	  }
	  if($atts['show_hybrid_event']=='off' && $atts['show_virtual_event']=='on'){
		$meta_query_status_virtual =
		
			array(
			  'key' => '_tribe_virtual_events_type',
			  'value' => 'hybrid',
			  'compare' => '=',
			  'type' => 'Text'
	
			
		  );
	  } 

	  if($atts['show_hybrid_event']=='on'  && $atts['show_virtual_event']=='on'){
		$meta_query_status_virtual = "";
	  }
	//   if($atts['show_virtual_event']=='on'){
	// 	$meta_query_status_virtual ="";
	//   }   
	  $filter_event_status_virtual = array(
		'posts_per_page' => -1,
		'post_type' => 'tribe_events',
		'meta_query' =>array($meta_query_status_virtual), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	  );
	  $filter_event_status_virtual = tribe_get_events($filter_event_status_virtual);
	  $filter_event_status_virtual =  ($atts['show_hybrid_event']=='off' || $atts['show_virtual_event']=='off' )? wp_list_pluck($filter_event_status_virtual, 'ID'):array(0);	
	  $filter_event_status=array_merge($filter_event_status,$filter_event_status_virtual);
	  $builder_class_object= new ET_Builder_Element;

	
	  //$joshi_j=$joshi_j->process_multiple_checkboxes_field_value( $value_map, $atts['included_organizer'] );
  if ( ! empty( $atts['included_organizer']) ) {
	  $value_map              = self::get_organizer_data_id();
	  $atts['included_organizer'] =$builder_class_object->process_multiple_checkboxes_field_value( $value_map, $atts['included_organizer'] );
	  $atts['included_organizer'] =  $atts['included_organizer'];
  } 
  $included_organizer_check=explode("|",$atts['included_organizer']);
  if ( ! empty( $atts['included_venue']) ) {
	  $value_map              = self::get_venue_data_id();
	  $atts['included_venue'] =$builder_class_object->process_multiple_checkboxes_field_value( $value_map, $atts['included_venue'] );
	  $atts['included_venue'] =  $atts['included_venue'];
  } 

  if ( ! empty( $atts['included_series']) ) {
	$value_map              = self::get_eventSeries_data_id();
	$atts['included_series'] =$joshi_j->process_multiple_checkboxes_field_value( $value_map, $atts['included_series'] );
	$atts['included_series'] =  $atts['included_series'];
} 
$included_series_check=explode("|",$atts['included_series']);

  $included_venue_check=explode("|",$atts['included_venue']);
	// print_r($start_date);
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
		
		 $decm_series_update = $wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$included_series_check).") "); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared , 	WordPress.DB.PreparedSQL.NotPrepared ,WordPress.DB.PreparedSQL.InterpolatedNotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery , WordPress.DB.DirectDatabaseQuery.NoCaching
		 $decm_series_update=array_column($decm_series_update, 'event_post_id');
		
	}
}


	$args = array(  
	'posts_per_page' => -1,
	'tax_query'=> $atts['event_tax'], //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	'post__in'=>$atts['included_series']!=""?$decm_series_update:"",
	'post__not_in'		=> $atts['show_postponed_canceled_event']=='off'?$filter_event_status:($atts['show_hybrid_event']=='off' &&  $atts['show_virtual_event']=='off'?$filter_event_status:$filter_event_status),//phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
	'included_categories' => $atts['event_selection']=="custom_event"?$atts['included_categories']:"",
	'hide_subsequent_recurrences'=>$atts['show_recurring_event']=="on"?false:true,
	'organizer'=>$atts['included_organizer']!="" && $atts['event_selection']=="custom_event"?$included_organizer_check:"",
	'venue'=>$atts['included_venue']!="" && $atts['event_selection']=="custom_event"?$included_venue_check: "",
);
	if($atts['event_selection']=="featured_event"){
		$args['featured']="true";
	
	}
	else{}
	if($atts['hide_past_event']=="on"){
		$args['meta_query']=array($meta_date); //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	}
	else{}
	$events=tribe_get_events($args);

$show_colon= $atts['show_colon']=="on"?":":"";

		$time_custom_label = __('Time','decm-divi-event-calendar-module');
		if(!empty($atts['details_time_label'])){
			$time_custom_label =  __($atts['details_time_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
		}

		$date_custom_label = __('Date','decm-divi-event-calendar-module');
		if(!empty($atts['date_detail_label'])){
			$date_custom_label =  __($atts['date_detail_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
		}

      $venue_custom_label = __('Venue','decm-divi-event-calendar-module');
		if(!empty($atts['venue_detail_label'])){
			$venue_custom_label =  __($atts['venue_detail_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
		}

	$tag_custom_label = __('Tag','decm-divi-event-calendar-module');
	if(!empty($atts['tag_detail_label'])){
		$tag_custom_label =  __($atts['tag_detail_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
	}

	$category_custom_label = __('Category','decm-divi-event-calendar-module');
		if(!empty($atts['category_detail_label'])){
				$category_custom_label =  __($atts['category_detail_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
	}

	$ticket_custom_label = __('Ticket','decm-divi-event-calendar-module');
			if(!empty($atts['price_ticket_label'])){
					$ticket_custom_label =  __($atts['price_ticket_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
			}

	$price_custom_label = __('Price','decm-divi-event-calendar-module');
			if(!empty($atts['price_detail_label'])){
					$price_custom_label =  __($atts['price_detail_label'],'decm-divi-event-calendar-module');
			}
			

	$rsvp_custom_label = __('RSVP','decm-divi-event-calendar-module');
			if(!empty($atts['rsvp_detail_label'])){
					$rsvp_custom_label =  __($atts['rsvp_detail_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
			}
	
	$organizer_custom_label = __('Organizer','decm-divi-event-calendar-module');
		if(!empty($atts['organizer_detail_label'])){
				$organizer_custom_label =  __($atts['organizer_detail_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
		}

	$location_custom_label = __('Location','decm-divi-event-calendar-module');
		if(!empty($atts['location_detail_label'])){
			$location_custom_label =  __($atts['location_detail_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
	    }

	$series_custom_label = __('Event Series','decm-divi-event-calendar-module');
		if(!empty($atts['event_series_label'])){
		   $series_custom_label =  __($atts['event_series_label'],'decm-divi-event-calendar-module');  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
		}


$dec_country_comma=$atts['show_tooltip_country_comma'] == "on" && $atts['show_tooltip_location'] == "on"?", ":" ";
$dec_locality_comma=$atts['show_tooltip_locality_comma'] == "on" && $atts['show_tooltip_location'] == "on"?", ":" ";
$dec_postal_code_comma=$atts['show_tooltip_postal_comma'] == "on" && $atts['show_tooltip_location'] == "on"?", ":" ";
$dec_street_comma=$atts['show_tooltip_street_comma'] == "on" && $atts['show_tooltip_location'] == "on"?", ":" ";
$dec_state_comma=$atts['show_tooltip_state_comma'] == "on" && $atts['show_tooltip_location'] == "on"?", ":" ";
$showicon_organizer= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_tooltip_organizer']=="on"?"organizer-decm-icon":"";
$showlabel_organizer = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label")&&$atts['show_tooltip_organizer']=="on" ?'<span class=decm-detail-label>'.esc_attr($organizer_custom_label.$show_colon)." </span>":"";
$showicon_venue= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_tooltip_venue']=="on" ?"venue-decm-icon":"";
$showlabel_venue = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label")&&$atts['show_tooltip_organizer']=="on" ?'<span class=decm-detail-label>'.esc_attr($venue_custom_label.$show_colon)." </span>":"";
$showicon_location= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon")&& $atts['show_tooltip_location']=="on" ?"event-location-decm-icon":"";
$showlabel_location = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_tooltip_location']=="on" ?'<span class=decm-detail-label>'.esc_attr($location_custom_label.$show_colon)." </span>":"";
$showicon_category= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_tooltip_category']=="on" ?"categories-decm-icon":"";
$showlabel_category = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_tooltip_category']=="on" ?'<span class=decm-detail-label>'.esc_attr($category_custom_label.$show_colon)." </span>":"";
$showicon_tag = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_tag']=="on" ?"categories-decm-icon":"";
$showlabel_tag = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_tag']=="on" ?'<span class=decm-detail-label>'.esc_attr($tag_custom_label.$show_colon)." </span>":"";
$showicon_price= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_tooltip_price']=="on" ?"price-decm-icon":"";
$showlabel_price = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_tooltip_price']=="on" ?'<span class=ecs-detail-label>'.esc_attr($price_custom_label.$show_colon)." </span>":"";
$showicon_rsvp= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_rsvp']=="on" ?"price-decm-icon":"";
$showlabel_rsvp = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_rsvp']=="on" ?'<span class=ecs-detail-label>'.esc_attr($rsvp_custom_label.$show_colon)." </span>":"";
$showicon_series = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['event_series_name'] == "on" ? 'diem-events-series-relationship-single-marker__icon':"";
$showlabel_series = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['event_series_name'] == "on" ? '<span class=decm-detail-label>'.esc_attr($series_custom_label.$show_colon)."</span>":"";
$showicon_ticket= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_tooltip_ticket']=="on" ?"price-decm-icon":"";
$showlabel_ticket = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_tooltip_ticket']=="on" ?'<span class=ecs-detail-label>'.esc_attr($ticket_custom_label.$show_colon)." </span>":"";
foreach ( $events as $event ) {
	
	$category_names = array();
	$category_list = get_the_terms( $event->ID, 'tribe_events_cat' );
	if ( is_array( $category_list ) ) {
		foreach ( (array) $category_list as $category ) {
			/**
			 * Show Categories of every events
			 *
			 * @author bojana
			 */
			$categories_link = $atts['show_tooltip_category']=="on"? $atts['enable_category_link']=="on" ?'<a href="'.esc_attr(get_category_link( $category->term_id )).'" target="'.esc_attr($atts['custom_category_link_target']).'" >'.esc_attr($category->name).'</a>' : esc_attr($category->name):"";
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

						$tag_enable_link = $atts['enable_tag_links'] == 'on' ? '<a href="'.esc_attr(get_term_link( $tag->term_id )).'" target="'.esc_attr($atts['custom_tag_link_target']).'" >'.esc_attr($tag->name).'</a>' : '<span>'.esc_attr($tag->name).'</span>';
						$tag_names[] = '<span class= "decm_tag ecs_tag_'.esc_attr($tag->slug).'" >'.$tag_enable_link.'</span>';
					}
	}

			global $post;
		$url = $event->guid;	
		preg_match("/&?p=([^&]+)/", $url, $matches);
		//  $series_id = $matches[1]; 
		if(!empty($matches[1])){
			$series_id = $matches[1]; 
		}else{
			$series_id = $event->ID;
		}
 
  $e = array();
  
  if( function_exists("tec_event_series") && !empty(tec_event_series(  $series_id ))) {
	$enable_series_link=$atts['enable_series_link']=='on'? '<a href="'.tec_event_series(  $series_id )->guid.'" class="diec-events-series-relationship-single-marker__title tribe-common-cta--alt" target="'.esc_attr($atts['custom_series_link_target']).'"><span class="diec_series_marker__title">'.tec_event_series(  $series_id )->post_title.'</span></a>':'<span class="diec_series_marker__title">'.tec_event_series(  $series_id )->post_title.'</span>';
	$e['show_calendar_series_name'] =  $atts['event_series_name']=='on'?  '<div class="tooltip_event_series"><span class="'.$showicon_series.'"><span class="decm_series_name">'.$showlabel_series." ".$enable_series_link.'</span></span></div>':"";
   }else{
	$e['show_calendar_series_name'] = "";
   }
//   $has_tickets = tribe_events_has_tickets($event->ID);


  $e['calender_end_time']=$atts['calender_end_time'];
  $e['show_calendar_event_date']=$atts['show_calendar_event_date'];
  $e['hide_calendar_event_all_day']=$atts['hide_calendar_event_all_day'];
  $e['hide_calendar_event_multi_days']=$atts['hide_calendar_event_multi_days'];
  $e['show_calendar_thumbnail']=$atts['show_calendar_thumbnail'];
  $e['custom_event_link_url']=$atts['single_event_page_link']=="default" || ($atts['single_event_page_link']=="replace_link" &&$atts['custom_event_link_url']=="")?tribe_get_event_link($event->ID):(($atts['single_event_page_link']=="redirect_link")?$result: $atts['custom_event_link_url']);
  $e['custom_website_link_text']=$atts['custom_website_link_text']==""?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];
  $e["show_time_zone_on_calendar"] = $atts['show_time_zone_on_calendar']=='on' ? $atts['show_time_zone_abb_on_calender']=='off' ? " ".Tribe__Events__Timezones::get_event_timezone_string($event->ID ):" ".Tribe__Events__Timezones::get_event_timezone_abbr( $event->ID ):" ";
  $e["show_event_venue"]= $atts['show_event_venue'] == 'on' ? tribe_get_venue($event->ID) : "";
  $e["hide_pre_nxt_event"]= $atts['hide_pre_nxt_event'] == 'on' ? true : false;
  
//   $e["show_rsvp"] = ($atts['show_rsvp'] == 'on' && $has_tickets) ? '<a href="'. tribe_get_event_link($event->ID).'">RSVP</a>': "file";
  
  $limit_event = $atts['limit_event_title_length'] == 'on'  ? wp_html_excerpt($event->post_title, $atts['event_title_length'],' ...' ) : $event->post_title;
  $e["title"]='<a href="'.get_permalink($event->ID,$leavename = false).'">'.$limit_event.'</a>';
  $e["tooltip_title"]=$atts['show_tooltip_title']=="on"?$event->post_title:"" ;
  $e["start"] =tribe_get_start_time( $event->ID,"H:i")!=""? tribe_get_start_date($event->ID,false,'Y-m-d')."T".tribe_get_start_time( $event->ID,"H:i"):tribe_get_start_date($event->ID,false,'Y-m-d');
  $e["end"] = tribe_get_end_time( $event->ID,"H:i")!=""?tribe_get_end_date( $event->ID,false,'Y-m-d')."T".tribe_get_end_time( $event->ID,"H:i"):gmdate('Y-m-d', strtotime( tribe_get_end_date($event->ID,false,'Y-m-d') . " +1 days"));
  $e["cost"] =$atts['show_tooltip_price']=="on"? tribe_get_cost($event->ID,null, true):"" ;
  $e["category_data"] =get_the_terms($event->ID,'tribe_events_cat');
 // $e["view_more_button"]='<p class="ecs-showdetail et_pb_button_wrapper "><a class="'.$button_classes.' " href="' . $atts['custom_event_link_url'] . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'].'</a></p>';
 
  $cats_comma_hide = $atts["hide_comma_cat"] == 'off' ? implode(", ", $category_names): implode(" ", $category_names);
  $e["tooltip_category"] = $atts["show_tooltip_category"] == 'on' ? '<div class ="event_category_style '.$showicon_category.'">'.$showlabel_category.$cats_comma_hide.'</div>':'';
  $tags_comma_hide = $atts["hide_comma_tag"] == 'off' ? implode(", ", $tag_names): implode(" ", $tag_names);
  $e["show_tag"]  = $atts['show_tag'] == 'on' ? '<div class ="event_category_style '.$showicon_tag.'">'.$showlabel_tag.$tags_comma_hide.'</div>':'';
  $e["event_start_date"]= tribe_get_start_date( $event->ID,null,get_option('date_format'));
  $e["event_end_date"]=tribe_get_start_date($event->ID,null,get_option( 'date_format' ))!= tribe_get_end_date($event->ID,null,get_option( 'date_format' ))?"-".tribe_get_end_date( $event->ID,null,get_option('date_format')):"" ;
  $e["event_start_time"]=tribe_get_start_time( $event->ID,$atts['event_time_format']);
  $e["event_end_time"]=tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' ))?"-".tribe_get_end_time( $event->ID,$atts['event_time_format']):"" ;
  $e["post_event_excerpt"] =$atts['show_tooltip_excerpt']=="on"? $event->post_excerpt:"";
  $e['featured_class'] = ( get_post_meta( $event->ID , '_tribe_featured', true ) ? ' decm-featured-event ' : '' );
  $e['dateTimeSeparator']=tribe_get_option( 'dateTimeSeparator', ' @ ' );
  $e['timeRangeSeparatorEnd']=$atts['show_end_time']=="on"&&(tribe_get_start_time( $event->ID,"H:i")!=tribe_get_end_time( $event->ID,"H:i"))?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";
  $e['timeRangeSeparator']=tribe_get_option( 'timeRangeSeparator', ' - ' );(tribe_get_start_date($event->ID,null,get_option( 'date_format' ))!= tribe_get_end_date($event->ID,null,get_option( 'date_format' )))&&$atts['show_tooltip_date']!="on"?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";
  $e['show_calendar_event_date']= $atts['show_calendar_event_date'];
  $e['event_stutus_tag'] = "";

 if(tribe_get_event_meta($event->ID,'_tribe_events_status', true) == 'postponed'){
	$e['event_stutus_tag']=tribe_get_event_meta($event->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event->ID,'_tribe_events_status', true).'" style="display:inline">'.__('postponed','decm-divi-event-calendar-module').' </span>':"";
  }

  if(tribe_get_event_meta($event->ID,'_tribe_events_status', true) == 'canceled'){
	  $e['event_stutus_tag']=tribe_get_event_meta($event->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event->ID,'_tribe_events_status', true).'" style="display:inline">'.__('canceled','decm-divi-event-calendar-module').' </span>':"";
  }

 $e['event_virtual'] =  tribe_get_event_meta($event->ID,'_tribe_virtual_events_type',true)=="virtual"?'<div class="ecs_event_type_virtual">
<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--virtual tribe-events-virtual-virtual-event__icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 16" style="font-size: 5px !important;margin: 0px !important;width: 24px;height: 12px;/* display: flex; */">
<g fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)">
<path d="M18 10.7333333c2.16-2.09999997 2.16-5.44444441 0-7.46666663M21.12 13.7666667c3.84-3.7333334 3.84-9.80000003 0-13.53333337M6 10.7333333C3.84 8.63333333 3.84 5.28888889 6 3.26666667M2.88 13.7666667C-.96 10.0333333-.96 3.96666667 2.88.23333333" class="tribe-common-c-svgicon__svg-stroke"></path><ellipse cx="12" cy="7" rx="2.4" ry="2.33333333" class="tribe-common-c-svgicon__svg-stroke"></ellipse></g></svg> <span  class="ecs_event_type_'.tribe_get_event_meta($event->ID,'_tribe_virtual_events_type', true).'" style="display:inline;font-size:15px">'.__('Virtual Event','decm-divi-event-calendar-module').' </span></div>':"";
$e['event_hybrid'] = tribe_get_event_meta($event->ID,'_tribe_virtual_events_type',true)=="hybrid"?'<div class="ecs_event_type_hybrid">
<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--hybrid tribe-events-virtual-hybrid-event__icon-svg" viewBox="0 0 15 13" fill="none" style="width: 24px;height: 12px;" xmlns="http://www.w3.org/2000/svg">
<circle cx="3.661" cy="9.515" r="2.121" transform="rotate(-45 3.661 9.515)" stroke="#0F0F30" stroke-width="1.103"></circle><circle cx="7.54" cy="3.515" r="2.121" transform="rotate(-45 7.54 3.515)" stroke="#0F0F30" stroke-width="1.103"></circle>
<path d="M4.54 7.929l1.964-2.828" stroke="#0F0F30"></path><circle r="2.121" transform="scale(-1 1) rotate(-45 5.769 18.558)" stroke="#0F0F30" stroke-width="1.103"></circle>
<path d="M10.554 7.929L8.59 5.1" stroke="#0F0F30"></path></svg> <span  class="ecs_event_type_'.tribe_get_event_meta($event->ID,'_tribe_virtual_events_type', true).'" style="display:inline;font-size:15px">'.__('Hybrid Event','decm-divi-event-calendar-module').' </span></div>':"";
 $e["venue"]=$atts['show_tooltip_venue']=="on" && tribe_get_venue($event->ID)!=null ?$atts['enable_venue_link']=="on"?'<div class="event_venue_style '.$showicon_venue.'">'.$showlabel_venue.'<span> '.tribe_get_venue_link($event->ID).' </span></div>':'<div class="event_venue_style '.$showicon_venue.'">'.$showlabel_venue.'<span> '.tribe_get_venue($event->ID).' </span></div>':"";
  $e["street"]=$atts['show_tooltip_street']=="on" && $atts['show_tooltip_location']=="on" && tribe_get_address($event->ID)!=null?tribe_get_address($event->ID).$dec_street_comma:"";
  $e["locality"]=$atts['show_tooltip_locality']=="on" && $atts['show_tooltip_location']=="on" && tribe_get_city($event->ID)!=null?" ".tribe_get_city($event->ID).$dec_locality_comma:""; 

  $e["state"]=$atts['show_tooltip_state']=="on" && $atts['show_tooltip_location']=="on" &&tribe_get_province($event->ID)!=null?tribe_get_province($event->ID).$dec_state_comma:(($atts['show_tooltip_state']=="on" && $atts['show_tooltip_location'] == "on" &&tribe_get_region($event->ID)!=null)?tribe_get_region($event->ID).$dec_state_comma:""); 
  $e["postal"]=$atts['show_postal_code_before_locality']=='off'&&$atts['show_tooltip_postal']=="on"&& $atts['show_tooltip_location']=="on" &&  tribe_get_zip($event->ID)!=null?" ".tribe_get_zip($event->ID).$dec_postal_code_comma:""; 
  $e["postal_before"]=$atts['show_postal_code_before_locality']=='on'&&$atts['show_tooltip_postal']=="on"&& $atts['show_tooltip_location']=="on" &&  tribe_get_zip($event->ID)!=null?" ".tribe_get_zip($event->ID).$dec_postal_code_comma:""; 
   
  $e["country"]=$atts['show_tooltip_country']=="on" && $atts['show_tooltip_location']=="on" && tribe_get_country($event->ID)!=null?" ".tribe_get_country($event->ID).$dec_country_comma:""; 
  $e['showicon_location']= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon")&&tribe_get_address($event->ID)!=null ?"event-location-decm-icon":"";
  $e['showlabel_location'] = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") &&tribe_get_address($event->ID)!=null ?'<span class=decm-detail-label>'.esc_attr($location_custom_label.$show_colon)." </span>":"";
  $e["organizer"]=$atts['show_tooltip_organizer']=="on" && tribe_get_organizer($event->ID)!=null?$atts['enable_organizer_link']=='on'?'<div class="event_organizer_style '.$showicon_organizer.'">'.$showlabel_organizer.'<span> '.tribe_get_organizer_link($event->ID).' </span></div>':'<div class="event_organizer_style '.$showicon_organizer.'">'.$showlabel_organizer.'<span> '.tribe_get_organizer($event->ID).' </span></div>':""; 

  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' )))
  { 
  $e["start_date"]=$atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$atts['date_format']):"";
  $e["end_date"]= $atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_end_date( $event->ID,null,get_option('date_format')):tribe_get_end_date( $event->ID,null,$atts['date_format']):"";
  $e["start_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"? $atts['time_format'] == ""?" ".tribe_get_start_time( $event->ID,get_option('time_format')) :" ".tribe_get_start_time($event->ID,$atts['time_format']):""):"";
  $e["end_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?" ". tribe_get_end_time( $event->ID,get_option('time_format')):" ".tribe_get_end_time($event->ID,$atts['time_format']):""):"All Day Event" ;
  $e["time_zone"]=$atts['show_time_zone'] == 'off'|| tribe_event_is_all_day($event->ID)?"":(($atts['show_time_zone_abb'] == 'off')?Tribe__Events__Timezones::get_event_timezone_string($event->ID ):Tribe__Events__Timezones::get_event_timezone_abbr($event->ID )); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
  }
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))== tribe_get_end_time($event->ID,get_option( 'time_format' )))
  {
	$e["start_date"]=$atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$atts['date_format']):"";
	$e["end_date"]= "";
	$e["start_time"]= "";
	$e["end_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?" ". tribe_get_end_time( $event->ID,get_option('time_format')):tribe_get_end_time($event->ID,$atts['time_format']):""):"All Day Event" ;
	$e["time_zone"]=$atts['show_time_zone'] == 'off'|| tribe_event_is_all_day($event->ID)?"":(($atts['show_time_zone_abb'] == 'off')?Tribe__Events__Timezones::get_event_timezone_string($event->ID ):Tribe__Events__Timezones::get_event_timezone_abbr($event->ID )); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
  }
  if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))!= tribe_get_end_time($event->ID,get_option( 'time_format' )))
{
	$e["start_date"]=$atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$atts['date_format']):"";
	$e["end_date"]="";
	$e["start_time"]=!tribe_event_is_all_day($event->ID)? ($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?" ".tribe_get_start_time( $event->ID,get_option('time_format')) :tribe_get_start_time($event->ID,$atts['time_format']):""):"";
	$e["end_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?" ". tribe_get_end_time( $event->ID,get_option('time_format')):tribe_get_end_time($event->ID,$atts['time_format']):""):"All Day Event" ;
	$e["time_zone"]=$atts['show_time_zone'] == 'off'|| tribe_event_is_all_day($event->ID)?"":(($atts['show_time_zone_abb'] == 'off')?Tribe__Events__Timezones::get_event_timezone_string($event->ID ):Tribe__Events__Timezones::get_event_timezone_abbr($event->ID )); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
	}
	if(tribe_get_start_date( $event->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event->ID,get_option( 'time_format' ))== tribe_get_end_time($event->ID,get_option( 'time_format' )))
	{
		$e["start_date"]=$atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_start_date( $event->ID,null,get_option('date_format')):tribe_get_start_date( $event->ID,null,$atts['date_format']):"";
		$e["end_date"]= $atts['show_tooltip_date']=="on"?$atts['date_format']  == ""? tribe_get_end_date( $event->ID,null,get_option('date_format')):tribe_get_end_date( $event->ID,null,$atts['date_format']):"";
		$e["start_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"? $atts['time_format'] == ""?" ".tribe_get_start_time( $event->ID,get_option('time_format')) :tribe_get_start_time($event->ID,$atts['time_format']):""):"";
		$e["end_time"]=!tribe_event_is_all_day($event->ID)?($atts['show_tooltip_time']=="on"?$atts['time_format'] == ""?" ". tribe_get_end_time( $event->ID,get_option('time_format')):tribe_get_end_time($event->ID,$atts['time_format']):""):"All Day Event" ;
		$e["time_zone"]=$atts['show_time_zone'] == 'off'|| tribe_event_is_all_day($event->ID)?"":(($atts['show_time_zone_abb'] == 'off')?Tribe__Events__Timezones::get_event_timezone_string($event->ID ):Tribe__Events__Timezones::get_event_timezone_abbr($event->ID )); //phpcs:ignore WordPress.CSRF.NonceVerification.NoNonceVerification
		}
		$e['showicon_date'] = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon")&&$e["start_date"]!=""?" eventDate-decm-icon ":"";
		$e['showlabel_date'] = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label")&&$e["start_date"]!="" ?'<span class=decm-detail-label>'.esc_attr($date_custom_label.$show_colon)." </span>":"";
		$e['showicon_time'] = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon")&&(tribe_get_start_time($event->ID)!=""||tribe_event_is_all_day($event->ID)) ?"eventTime-decm-icon":"";
		$e['showlabel_time'] = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label")&&(tribe_get_start_time($event->ID)!=""||tribe_event_is_all_day($event->ID)) ?'<span class=decm-detail-label>'.esc_attr($time_custom_label.$show_colon)." </span>":""; 
  
  $e['tooltip_weburl']=$atts['show_tooltip_weburl']=="on" && tribe_get_event_website_link($event->ID)!=null?($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<a href="'.tribe_get_event_meta($event->ID, '_EventURL', true ).'" target="'.esc_attr($atts['custom_website_link_target']).'">'.esc_attr($e['custom_website_link_text']).'</a>':'<a href="'.tribe_get_event_meta($event->ID, '_EventURL', true ).'" target="'.esc_attr($atts['custom_website_link_target']).'">'.tribe_get_event_website_url($event->ID).'</a>':""; 
  $e['showicon_weburl']= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $e['tooltip_weburl']!=""?"weburl-decm-icon":"";
  $e['showlabel_weburl'] = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $e['tooltip_weburl']!=""?'<span class=decm-detail-label>'.__('Website','decm-divi-event-calendar-module').$show_colon." </span>":"";  
  $e["feature_image"]=$atts['show_feature_image']=="on"?get_the_post_thumbnail($event->ID):"";
  $e['feature_image_calendar']='<div class="ecs_calendar_thumbnail">'.get_the_post_thumbnail( $event->ID,array(125,250, 'class' => ' ecs_calendar_thumbnail_inner')).'<div>'; 
  $e["post_event_permalink"] = tribe_get_event_link($event->ID);
  
 
 
  $ticket__label = '';
  $event__price = '';
  $e["show_ticket"] = '';
  if (is_plugin_active('event-tickets/event-tickets.php')) {
		// $get_event_link = tribe_get_event_link($event->ID);
		// 	$event_link = $get_event_link . '#tribe-tribe-tickets__tickets-form-target';
	  $event_link = tribe_get_event_link($event->ID);
	  if (tribe_get_cost($event->ID, true) != null) {
		  
		  $Tickets_data = Tribe__Tickets__Tickets::get_ticket_counts($event->ID);
		  
		  $available_tickets = $Tickets_data['tickets']['available'];
		  
		  if($Tickets_data['tickets']['available'] > 0){
			$isPrice__free = tribe_get_cost($event->ID, true);
			$raw__price = explode('–', $isPrice__free);
			$priceArray = array_map('trim', $raw__price);
			$is__price_exists = array_key_exists(1, $priceArray);
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
					$ticket__label =  __('Sold Out', 'decm-divi-event-calendar-module');                            
				}else{
					if($available_tickets == -1) {
						$Place_left =  __('Unlimited', 'decm-divi-event-calendar-module');                                
					}elseif($available_tickets > 1 ){
						$Place_left  =	$available_tickets.' '.__('Places Left', 'decm-divi-event-calendar-module');
					 }else{
						 $Place_left  =	$available_tickets.' '.__('Place Left', 'decm-divi-event-calendar-module');
					 }
					
					 $Purchase_Now = $atts['show_ticket_feed_respond'] == 'on' ? '<a href="' . $event_link . '" class="price_link_ticket price_link_custom__a" >'.__('Purchase Now', 'decm-divi-event-calendar-module').'</a> '  : '';
					 $spaceRespond = $atts['show_ticket_feed_respond'] == 'on' && $atts['show_ticket_feed_left'] == 'on' ? ' - ' : ' ';	
					 $show_ticket_feed_left = $atts['show_ticket_feed_left'] == 'on'  ? esc_html($Place_left) :'';
					 $ticket__label = $Purchase_Now.esc_html($spaceRespond) . ' ' . esc_html($show_ticket_feed_left);
				}
			}


			$e["show_ticket"]=$atts['show_tooltip_ticket']=="on"  ? 

			'<div class="event_price_style '.$showicon_ticket.'">'.$showlabel_ticket.'<span>'. $event__price . ' ' . $ticket__label.'</span></div>'  :"";

			//   '<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,null,false). ' - ' .$ticket__label.'</span></div>'
			//   :
		}else{
			$e["show_ticket"] = '';
		}
		 
	  }else{
		$e["show_ticket"] = '';
	  }
  }

 
  $available_rsvp = 0;
  $unlimited_rsvp = false;
  $rsvp__label = '';
  $respond_now_label ='';
  $e["show_rsvp"] = '';

  if (is_plugin_active('event-tickets/event-tickets.php')) {
	$event_link = tribe_get_event_link($event->ID);
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
				
			$spaceRespond = $atts['show_rsvp_feed_respond'] == 'on' && $atts['show_rsvp_feed_left'] == 'on' ? ' - ' : ' ';
			$Purchase_Now = $atts['show_rsvp_feed_respond'] == 'on' ? '<a class="show_rsvp_feed_custom"  href="' . $event_link . '" >' . __('Respond Now', 'decm-divi-event-calendar-module') . '</a>' : '';
			$show_rsvp_feed_left = $atts['show_rsvp_feed_left'] == 'on'  ? esc_html($Place_left) :'';
			$rsvp__label =  $Purchase_Now.esc_html($spaceRespond).esc_html($show_rsvp_feed_left);
		}

		$e["show_rsvp"]= $atts['show_rsvp'] == "on" ?'<div class="event_price_style event_rsvp_style '.$showicon_rsvp.'">'.$showlabel_rsvp.'<span>' . $rsvp__label . ' </span></div>': "";

		}
		
		
	}else{
		$e["show_rsvp"] = '';
	}

$e["currency"] = $atts['show_tooltip_price']=="on" && tribe_get_cost($event->ID,null,false)!=null ?tribe_get_cost($event->ID,null,false)=="Free"?'<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,null,false).'</span></div>':'<div class="event_price_style '.$showicon_price.'">'.$showlabel_price.'<span>'.tribe_get_cost($event->ID,true).'</span></div>':"";
$e["html"] = '<div class="tooltip_main" ><div class="feature_img">'.$e["feature_image"].'</div><div class="event_detail_style" ><div class="event_title_style"><h3 class="title_text"> <a href="'.$e["post_event_permalink"].'">'.$e['event_stutus_tag'].$e['event_virtual'].$e['event_hybrid'].$e["tooltip_title"].'</a></h3></div>'.$e['show_calendar_series_name'].'<div class="tooltip_event_time"><div class="ecs_tooltip_date'.$e['showicon_date'].' ">'.$e['showlabel_date'].'<span>'.$e["start_date"].$e['timeRangeSeparator'].' '.$e["end_date"].' </span></div><div class="ecs_tooltip_time '.$e['showicon_time'].'">'.$e['showlabel_time'].'<span>' .$e["start_time"].$e['timeRangeSeparatorEnd'].' '.$e["end_time"].' '.esc_attr($e['time_zone']).'</span></div></div>'.$e["venue"].'<div class="event_address_style '.$e['showicon_location'].'">'.$e['showlabel_location'].'<span>'.$e["street"].$e["postal_before"].$e["locality"].$e["state"].$e["postal"].$e["country"].'</span></div>'.$e["organizer"].'<div class="event_price_style"><span>'.$e["currency"].
'<div class="event_price_style"><span>'.$e["show_ticket"].'</span></div>'.
'<div class="rsvp"><span>'.$e["show_rsvp"].'</span></div>'.
trim($e["tooltip_category"], ":").
trim($e["show_tag"], ":").
'<div class="event_website_url_style '.$e['showicon_weburl'].'">'.
    $e['showlabel_weburl'].
    $e['tooltip_weburl'].
'</div>'.
'<div class="event_excerpt_style" style="width:100%">'.
    '<span>'.
        $e["post_event_excerpt"].
    '</span>'.
'</div>'.
'</div>'.
'</div>'.
'</div>';

  array_push($event_data, $e);
}


return json_encode($event_data); //phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode

}

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
				'declaration' => $this->get_custom_style($slug_value, $type, $important),
			));
		}

		if (isset($slug_value_tablet) && !empty($slug_value_tablet) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value_tablet, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_980'),
			));
		}

		if (isset($slug_value_phone) && !empty($slug_value_phone) && $slug_value_responsive_active) {
			ET_Builder_Element::set_style($function_name, array(
				'selector' => $class,
				'declaration' => $this->get_custom_style($slug_value_phone, $type, $important),
				'media_query' => ET_Builder_Element::get_media_query('max_width_767'),
			));
		}
	}

	public function render( $attrs, $content , $render_slug ) {


		if ( !function_exists( 'tribe_get_events' ) ) {
			return 'Divi Events Calendar requires The Events Calendar to be installed and active.';
		}
		
		$atts = array();
		$date_format                            = $this->props['date_format'];
		$time_format                            = $this->props['time_format'];
		$show_time_zone                         = $this->props['show_time_zone'];
		$show_time_zone_on_calendar             = $this->props['show_time_zone_on_calendar'];
		$show_time_zone_abb_on_calender			= $this->props['show_time_zone_abb_on_calender'];
		$show_rsvp                              = $this->props['show_rsvp'];
		$show_event_venue          				= $this->props['show_event_venue'];
		$limit_event_title_length          		= $this->props['limit_event_title_length'];
		$event_title_length          		    = $this->props['event_title_length'];
		$hide_pre_nxt_event          			= $this->props['hide_pre_nxt_event'];
		$included_categories                    = $this->props['included_categories'];
		$show_feature_event						= $this->props['show_feature_event'];
		$week_background_color                  = $this->props['week_background_color'];
		$days_background_color                  = $this->props['days_background_color'];
		$current_days_background_color			= $this->props['current_days_background_color'];
		$current_day_text_color					= $this->props['current_day_text_color'];
		$past_days_background_color				= $this->props['past_days_background_color'];
		$past_days_text_color					= $this->props['past_days_text_color'];
		$month_days_text_opacity                = $this->props['month_days_text_opacity'];
		$events_background_color = $this->props["events_background_color"];
		$single_event_page_link = $this->props['single_event_page_link'];
		$disable_event_title_link = $this->props['disable_event_title_link'];
		$disable_event_image_link = $this->props['disable_event_image_link'];
		//$disable_event_button_link = $this->props['disable_event_button_link'];
		$custom_event_link_url = $this->props['custom_event_link_url'];
		$custom_event_link_target = $this->props['custom_event_link_target'];
        $events_background_color_responsive_active = isset($this->props["events_background_color"]) && et_pb_get_responsive_status($this->props["events_background_color_last_edited"]);
        $events_background_color_tablet = $events_background_color_responsive_active && $this->props["events_background_color_tablet"] ? $this->props["events_background_color_tablet"] : $events_background_color;
        $events_background_color_phone = $events_background_color_responsive_active && $this->props["events_background_color_phone"] ? $this->props["events_background_color_phone"] : $events_background_color_tablet;
		$events_background_color__hover         = et_pb_hover_options()->get_value('events_background_color', $this->props, '' );
		$events_background_color__hover_enabled = et_builder_is_hover_enabled( 'events_background_color', $this->props );
		$navigate_background_color				= $this->props['navigate_background_color'];
		$navigate_background_color__hover       = et_pb_hover_options()->get_value('navigate_background_color', $this->props, '' );
		$navigate_background_color__hover_hover_enabled = et_builder_is_hover_enabled( 'navigate_background_color', $this->props );
		$navigate_text_color__hover         	= et_pb_hover_options()->get_value('navigate_text_color', $this->props, '' );
		$navigate_text_color__hover_hover_enabled = et_builder_is_hover_enabled( 'navigate_text_color', $this->props );
		$navigate_text_color					= $this->props['navigate_text_color'];
		$view_background_color				    = $this->props['view_background_color'];
		$view_background_color__hover           = et_pb_hover_options()->get_value('view_background_color', $this->props, '' );
		$view_background_color__hover_enabled   = et_builder_is_hover_enabled( 'view_background_color', $this->props );
		$view_current_tab_color				    = $this->props['view_current_tab_color'];
		$view_text_color						= $this->props['view_text_color'];
		$view_text_color__hover        			= et_pb_hover_options()->get_value('view_text_color', $this->props, '' );
		$view_text_color__hover_enabled 		= et_builder_is_hover_enabled( 'view_text_color', $this->props );

		$view_current_tab_text_color            = $this->props['view_current_tab_text_color'];
		$view__current_text_color__hover       	= et_pb_hover_options()->get_value('view_current_tab_text_color', $this->props, '' );
		$view_current_text_color__hover_enabled = et_builder_is_hover_enabled( 'view_current_tab_text_color', $this->props );
		$tooltip_background_color				= $this->props['tooltip_background_color'];
		$tooltip_detail_link_color				= $this->props['tooltip_detail_link_color'];
		$details_icon_color = $this->props ['details_icon_color' ];
        $details_icon_color_responsive_active = isset($this->props["details_icon_color"]) && et_pb_get_responsive_status($this->props["details_icon_color_last_edited"]);
        $details_icon_color_tablet = $details_icon_color_responsive_active && $this->props["details_icon_color_tablet"] ? $this->props["details_icon_color_tablet"] : $details_icon_color;
        $details_icon_color_phone = $details_icon_color_responsive_active && $this->props["details_icon_color_phone"] ? $this->props["details_icon_color_phone"] : $details_icon_color_tablet;
		$details_icon_size = $this->props ['details_icon_size' ];
        $details_icon_size_responsive_active = isset($this->props["details_icon_size"]) && et_pb_get_responsive_status($this->props["details_icon_size_last_edited"]);
        $details_icon_size_tablet = $details_icon_size_responsive_active && $this->props["details_icon_size_tablet"] ? $this->props["details_icon_size_tablet"] : $details_icon_size;
        $details_icon_size_phone = $details_icon_size_responsive_active && $this->props["details_icon_size_phone"] ? $this->props["details_icon_size_phone"] : $details_icon_size_tablet;
    	$upcoming_padding						= $this->props['upcoming_padding']; 
		$upcoming_margin						= $this->props['upcoming_margin']; 
		$calendar_border_width 					= $this->props ['calendar_border_width' ];
        $calendar_border_width_responsive_active= isset($this->props["calendar_border_width"]) && et_pb_get_responsive_status($this->props["calendar_border_width_last_edited"]);
        $calendar_border_width_tablet 			= $calendar_border_width_responsive_active && $this->props["calendar_border_width_tablet"] ? $this->props["calendar_border_width_tablet"] : $calendar_border_width;
        $calendar_border_width_phone 			= $calendar_border_width_responsive_active && $this->props["calendar_border_width_phone"] ? $this->props["calendar_border_width_phone"] : $calendar_border_width_tablet;
		$calendar_border_color 					= $this->props ['calendar_border_color' ];
        $calendar_border_color_responsive_active= isset($this->props["calendar_border_color"]) && et_pb_get_responsive_status($this->props["calendar_border_color_last_edited"]);
        $calendar_border_color_tablet 			= $calendar_border_color_responsive_active && $this->props["calendar_border_color_tablet"] ? $this->props["calendar_border_color_tablet"] : $calendar_border_color;
        $calendar_border_color_phone 			= $calendar_border_color_responsive_active && $this->props["calendar_border_color_phone"] ? $this->props["calendar_border_color_phone"] : $calendar_border_color_tablet;
		$week_days_border_width 				= $this->props ['week_days_border_width' ];
        $week_days_border_width_responsive_active = isset($this->props["week_days_border_width"]) && et_pb_get_responsive_status($this->props["week_days_border_width_last_edited"]);
        $week_days_border_width_tablet 			= $week_days_border_width_responsive_active && $this->props["week_days_border_width_tablet"] ? $this->props["week_days_border_width_tablet"] : $week_days_border_width;
        $week_days_border_width_phone 			= $week_days_border_width_responsive_active && $this->props["week_days_border_width_phone"] ? $this->props["week_days_border_width_phone"] : $week_days_border_width_tablet;
	
		$week_days_border_color 				= $this->props ['week_days_border_color' ];
        $week_days_border_color_responsive_active = isset($this->props["week_days_border_color"]) && et_pb_get_responsive_status($this->props["week_days_border_color_last_edited"]);
        $week_days_border_color_tablet 			= $week_days_border_color_responsive_active && $this->props["week_days_border_color_tablet"] ? $this->props["week_days_border_color_tablet"] : $week_days_border_color;
        $week_days_border_color_phone 			= $week_days_border_color_responsive_active && $this->props["week_days_border_color_phone"] ? $this->props["week_days_border_color_phone"] : $week_days_border_color_tablet;
		//$tooltip_title_font                     = $this->props['tooltip_title_font'];
		$show_tooltip                           = $this->props['show_tooltip'];
		$show_feature_image                     = $this->props['show_feature_image'];
		$show_tooltip_excerpt                   = $this->props['show_tooltip_excerpt'];
		$show_tooltip_price                   	= $this->props['show_tooltip_price'];
		$show_tooltip_title                   	= $this->props['show_tooltip_title'];
		$show_tooltip_date                   	= $this->props['show_tooltip_date'];
		$event_series_label                     = $this->props['event_series_label'];
		$event_series_name                      = $this->props['event_series_name'];
		$show_tooltlip_time                   	= $this->props['show_tooltip_time'];
		$thumbnail_height				        = $this->props['thumbnail_height'];
		$tooltip_image_align					= $this->props['tooltip_image_align'];
		$tooltip_image_aspect_ratio				= $this->props['tooltip_image_aspect_ratio'];
		$calendar_image_aspect_ratio				= $this->props['calendar_image_aspect_ratio'];
		$calendar_image_align					= $this->props['calendar_image_align'];
		$thumbnail_height_tablet				= $this->props['thumbnail_height_tablet'];
		$thumbnail_height_phone				= $this->props['thumbnail_height_phone'];
		$thumbnail_width				= $this->props['thumbnail_width'];
		$thumbnail_width_tablet				= $this->props['thumbnail_width_tablet'];
		$thumbnail_width_phone				= $this->props['thumbnail_width_phone'];
		$calendar_thumbnail_height				= $this->props['calendar_thumbnail_height'];
		$calendar_thumbnail_height_tablet				= $this->props['calendar_thumbnail_height_tablet'];
		$calendar_thumbnail_height_phone				= $this->props['calendar_thumbnail_height_phone'];
		$calendar_thumbnail_width				= $this->props['calendar_thumbnail_width'];
		$calendar_thumbnail_width_tablet				= $this->props['calendar_thumbnail_width_tablet'];
		$calendar_thumbnail_width_phone				= $this->props['calendar_thumbnail_width_phone'];
	
		$tooltip_width 				= $this->props['tooltip_width' ];
        $tooltip_width_responsive_active = isset($this->props["tooltip_width"]) && et_pb_get_responsive_status($this->props["tooltip_width_last_edited"]);
        $tooltip_width_tablet 			= $tooltip_width_responsive_active && $this->props["tooltip_width_tablet"] ? $this->props["tooltip_width_tablet"] : '30%';
        $tooltip_width_phone 			= $tooltip_width_responsive_active && $this->props["tooltip_width_phone"] ? $this->props["tooltip_width_phone"] : '50%';	
		$date_format   = $this->props['detail_below_calander'];
        $start_point   = $this->props['starting_point'];
        $end_point   =  $this->props['ending_point'];
        $hide_time_range_in_week_day   = $this->props['hide_time_range_in_week_day'];
		$show_specific_month   = $this->props['show_specific_month'];	
		$specific_month_start  = $this->props['specific_month_start'];	
		
		if ( ! empty( $this->props['included_organizer']) ) {
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
			$value_map              = $this->get_EventSeries_data_id();
			$this->props['included_series'] = $this->process_multiple_checkboxes_field_value( $value_map, $this->props['included_series'] );
			$this->props['included_series'] =  $this->props['included_series'];
		} 
		if ( ! empty( $this->props['hidden_day']) ) {
			$value_map              = array(0,1,2,3,4,5,6);
			$this->props['hidden_day'] =$this->process_multiple_checkboxes_field_value( $value_map, $this->props['hidden_day'] );
			$this->props['hidden_day'] =  $this->props['hidden_day'];
		} 

		$hidden_day=$this->props['hidden_day']!=null?array_map('intval',explode("|",$this->props['hidden_day'])):"";
		$included_organizer=explode( "|",$this->props['included_organizer']);
		$included_organizer_check=$this->props['included_organizer'];
		$included_venue=explode( "|",$this->props['included_venue']);
		$included_series=explode( "|",$this->props['included_series']);
		$included_venue_check=$this->props['included_venue'];
		$included_series_check=$this->props['included_series'];
	
		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => " .categories-decm-icon:before,  .tags-decm-icon:before, .eventTime-decm-icon:before, .eventDate-decm-icon:before, .weburl-decm-icon:before, .price-decm-icon:before, .event-location-decm-icon:before, .venue-decm-icon:before, .organizer-decm-icon:before, .diem-events-series-relationship-single-marker__icon:before",
            'declaration' => "color: {$details_icon_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => " .categories-decm-icon:before,  .tags-decm-icon:before, .eventTime-decm-icon:before, .eventDate-decm-icon:before, .weburl-decm-icon:before, .price-decm-icon:before, .event-location-decm-icon:before, .venue-decm-icon:before, .organizer-decm-icon:before, .diem-events-series-relationship-single-marker__icon:before",
            'declaration' => "color: {$details_icon_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => " .categories-decm-icon:before,  .tags-decm-icon:before, .eventTime-decm-icon:before, .eventDate-decm-icon:before, .weburl-decm-icon:before, .price-decm-icon:before, .event-location-decm-icon:before, .venue-decm-icon:before, .organizer-decm-icon:before, .diem-events-series-relationship-single-marker__icon:before",
            'declaration' => "color: {$details_icon_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

			\ET_Builder_Element::set_style($render_slug, [
            'selector'    => " .categories-decm-icon:before,  .tags-decm-icon:before, .eventTime-decm-icon:before, .eventDate-decm-icon:before, .weburl-decm-icon:before, .price-decm-icon:before, .event-location-decm-icon:before, .venue-decm-icon:before, .organizer-decm-icon:before, .diem-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => " .categories-decm-icon:before,  .tags-decm-icon:before, .eventTime-decm-icon:before, .eventDate-decm-icon:before, .weburl-decm-icon:before, .price-decm-icon:before, .event-location-decm-icon:before, .venue-decm-icon:before, .organizer-decm-icon:before, .diem-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => " .categories-decm-icon:before,  .tags-decm-icon:before, .eventTime-decm-icon:before, .eventDate-decm-icon:before, .weburl-decm-icon:before, .price-decm-icon:before, .event-location-decm-icon:before, .venue-decm-icon:before, .organizer-decm-icon:before, .diem-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		if ( '' !== $week_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-day-header',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $week_background_color )
				),
			) );
		}
		if ( '' !== $days_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-day.fc-past,.fc-day.fc-future',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $days_background_color )
				),
			) );
		}
		if ( '' !== $current_days_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-day.fc-today',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $current_days_background_color )
				),
			) );
		}
		if ( '' !== $current_day_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-today .fc-day-number',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $current_day_text_color )
				),
			) );
		}
		if ( '' !== $past_days_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-day.fc-past',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $past_days_background_color )
				),
			) );
		}
		if ( '' !== $past_days_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-past .fc-day-number',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $past_days_text_color )
				),
			) );
		}

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    =>  '%%order_class%% .fc-other-month',
            'declaration' => "opacity: {$month_days_text_opacity} !important;",
        ]);

		
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    =>  '%%order_class%% .fc-event,.fc-event-dot',
            'declaration' => "background-color: {$events_background_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    =>  '%%order_class%% .fc-event,.fc-event-dot',
            'declaration' => "background-color: {$events_background_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    =>  '%%order_class%% .fc-event,.fc-event-dot',
            'declaration' => "background-color: {$events_background_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
		
		if ( '' !== $events_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-event,.fc-event-dot',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $events_background_color )
				),
			) );
		}
		
		if ( $events_background_color__hover  != '' && $events_background_color__hover_enabled ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-event:hover',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $events_background_color__hover )
				),
			) );
		}
		
		
		if ( '' !== $navigate_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  "%%order_class%% .fc-today-button,.fc-prev-button,.fc-next-button",
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $navigate_background_color )
				),
			) );
		}

		if ( '' !== $navigate_background_color__hover ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .fc-today-button:hover,.fc-prev-button:hover,.fc-next-button:hover",
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $navigate_background_color__hover)
				),
			) );
		}

		
		if ( '' !== $navigate_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  "%%order_class%% .fc-today-button,.fc-prev-button,.fc-next-button",
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $navigate_text_color )
				),
			) );
		}
		if ( '' !== $navigate_text_color__hover ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .fc-today-button:hover,.fc-prev-button:hover,.fc-next-button:hover",
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $navigate_text_color__hover )
				),
			) );
		}
		if ( '' !== $tooltip_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '.dec-tooltip',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $tooltip_background_color )
				),
			) );
		}
		if ( '' !== $tooltip_detail_link_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '.tooltip_main .event_category_style a ,.event_website_url_style a, .decm_series_name a , .price_link_ticket, .show_rsvp_feed_custom',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $tooltip_detail_link_color )
				),
			) );
		}

		if ( '' !== $view_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button,.fc-listMonth-button,.fc-listYear-button',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $view_background_color )
				),
			) );
		}
		if ( '' !== $view_background_color__hover ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  '%%order_class%% .fc-dayGridMonth-button:hover,.fc-timeGridWeek-button:hover,.fc-timeGridDay-button:hover,.fc-listWeek-button:hover,.fc-listMonth-button:hover,.fc-listYear-button:hover',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html($view_background_color__hover)
				),
			) );
		}
		if ( '' !== $view_current_tab_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-button-active',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $view_current_tab_color )
				),
			) );
		}
		if ( '' !== $view_current_tab_text_color  ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% .fc-button-active',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $view_current_tab_text_color )
				),
			) );
		}
		if ( '' !== $tooltip_image_align  ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '.tooltip_main .feature_img',
				'declaration' => sprintf(
					'text-align: %1$s !important;',
					esc_html( $tooltip_image_align )
				),
			) );
		}
		if ( '' !== $tooltip_image_aspect_ratio  ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '.tooltip_main .feature_img .wp-post-image',
				'declaration' => sprintf(
					'aspect-ratio: %1$s !important;object-fit:cover !important;',
					esc_html( $tooltip_image_aspect_ratio )
				),
			) );
		}
		if ( '' !== $calendar_image_aspect_ratio  ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .ecs_calendar_thumbnail .ecs_calendar_thumbnail_inner",
				'declaration' => sprintf(
					'aspect-ratio: %1$s !important; object-fit:cover !important;',
					esc_html( $calendar_image_aspect_ratio )
				),
			) );
		}
		
		if ( '' !== $calendar_image_align  ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .ecs_calendar_thumbnail",
				'declaration' => sprintf(
					'text-align: %1$s !important;',
					esc_html( $calendar_image_align )
				),
			) );
		}

		
		
		if ( '' !== $view_text_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  '%%order_class%% .fc-dayGridMonth-button,.fc-timeGridWeek-button,.fc-timeGridDay-button,.fc-listWeek-button,.fc-listMonth-button,.fc-listYear-button',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $view_text_color )
				),
			) );
		}
		if ( '' !== $view_text_color__hover ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    =>  '%%order_class%% .fc-dayGridMonth-button:hover,.fc-timeGridWeek-button:hover,.fc-timeGridDay-button:hover,.fc-listWeek-button:hover,.fc-listMonth-button:hover,.fc-listYear-button:hover',
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $view_text_color__hover )
				),
			) );
		}
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day',
            'declaration' => "border-width: {$calendar_border_width} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day',
            'declaration' => "border-width: {$calendar_border_width_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day',
            'declaration' => "border-width: {$calendar_border_width_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-week,%%order_class%% .fc-day',
            'declaration' => "border-color: {$calendar_border_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-week,%%order_class%% .fc-day',
            'declaration' => "border-color: {$calendar_border_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-week,%%order_class%% .fc-day',
            'declaration' => "border-color: {$calendar_border_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-width: {$week_days_border_width} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-width: {$week_days_border_width_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-width: {$week_days_border_width_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-color: {$week_days_border_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-color: {$week_days_border_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '%%order_class%% .fc-day-header',
            'declaration' => "border-color: {$week_days_border_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);


		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '.dec-tooltip',
            'declaration' => "width: {$tooltip_width} !important;",
        ]);

		if(empty($tooltip_width_tablet) ||  $tooltip_width_tablet == $tooltip_width){
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => '.dec-tooltip',
				'declaration' => "width: 30% !important;",
				'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
			]);
		}else{
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => '.dec-tooltip',
				'declaration' => "width: {$tooltip_width_tablet} !important;",
				'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
			]);
		}

		if(empty($tooltip_width_phone) ||  $tooltip_width_phone == $tooltip_width){
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => '.dec-tooltip',
				'declaration' => "width: 50% !important;",
				'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
			]);
		}else{
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => '.dec-tooltip',
				'declaration' => "width: {$tooltip_width_phone} !important;",
				'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
			]);
		}
       
		$this->apply_custom_margin_padding($render_slug, 'upcoming_margin', 'margin', 
		'%%order_class%% .fc-not-end,.fc-end');
		$this->apply_custom_margin_padding($render_slug, 'upcoming_padding', 'padding', 
		'%%order_class%% a.fc-day-grid-event');
		$this->apply_custom_margin_padding($render_slug, 'calendar_days_padding', 'padding', 
		"%%order_class%% .fc .fc-row .fc-content-skeleton td");
		$this->apply_custom_margin_padding($render_slug, 'days_padding', 'padding', 
		'%%order_class%% .fc-day-header');
		$this->apply_custom_margin_padding($render_slug, 'navigation_margin', 'margin', 
		'%%order_class%% .fc-today-button,%%order_class%% .fc-prev-button,%%order_class%% .fc-next-button');
		$this->apply_custom_margin_padding($render_slug, 'navigation_padding', 'padding', 
		'%%order_class%% .fc-today-button,%%order_class%% .fc-prev-button,%%order_class%% .fc-next-button');
		$this->apply_custom_margin_padding($render_slug, 'view_button_margin', 'margin', 
		'%%order_class%% .fc-dayGridMonth-button,%%order_class%% .fc-timeGridWeek-button,%%order_class%% .fc-timeGridDay-button,%%order_class%% .fc-listWeek-button,%%order_class%% .fc-listMonth-button,%%order_class%% .fc-listYear-button');
		$this->apply_custom_margin_padding($render_slug, 'view_button_padding', 'padding', 
		'%%order_class%% .fc-dayGridMonth-button,%%order_class%% .fc-timeGridWeek-button,%%order_class%% .fc-timeGridDay-button,%%order_class%% .fc-listWeek-button,%%order_class%% .fc-listMonth-button,%%order_class%% .fc-listYear-button');

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '.tooltip_main .feature_img .wp-post-image',
            'declaration' => "width: {$thumbnail_width} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '.tooltip_main .feature_img .wp-post-image',
            'declaration' => "width: {$thumbnail_width_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '.tooltip_main .feature_img .wp-post-image',
            'declaration' => "width: {$thumbnail_width_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);	
	
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => '.tooltip_main .feature_img .wp-post-image',
            'declaration' => "height: {$thumbnail_height} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '.tooltip_main .feature_img .wp-post-image',
            'declaration' => "height: {$thumbnail_height_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => '.tooltip_main .feature_img .wp-post-image',
            'declaration' => "height: {$thumbnail_height_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs_calendar_thumbnail .ecs_calendar_thumbnail_inner",
            'declaration' => "height: {$calendar_thumbnail_height} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs_calendar_thumbnail .ecs_calendar_thumbnail_inner",
            'declaration' => "height: {$calendar_thumbnail_height_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs_calendar_thumbnail ecs_calendar_thumbnail_inner",
            'declaration' => "height: {$calendar_thumbnail_height_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs_calendar_thumbnail .ecs_calendar_thumbnail_inner",
            'declaration' => "width: {$calendar_thumbnail_width} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs_calendar_thumbnail .ecs_calendar_thumbnail_inner",
            'declaration' => "width: {$calendar_thumbnail_width_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .ecs_calendar_thumbnail ecs_calendar_thumbnail_inner",
            'declaration' => "width: {$calendar_thumbnail_width_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		]);
	
 $attrs = array(
		'date_format'                            => $date_format,
		'time_format'                            => $time_format,
		'show_time_zone'                         => $show_time_zone,
		'show_time_zone_on_calendar'             => $show_time_zone_on_calendar,
		'show_time_zone_abb_on_calender'		 => $show_time_zone_abb_on_calender,
		'show_rsvp'             => $show_rsvp,
		'show_event_venue'          			 => $show_event_venue,
		'hide_pre_nxt_event'          			 => $hide_pre_nxt_event,
	    'included_categories'                    => $included_categories,
	    'week_background_color'                  => $week_background_color,
		'days_background_color '                 => $days_background_color,
		'events_background_color '               => $events_background_color,
		'navigate_background_color '             => $navigate_background_color,
		'navigate_text_color'                    => $navigate_text_color,
		'upcoming_padding'                       => $upcoming_padding, 
		'upcoming_margin'                        => $upcoming_margin,
		'calendar_border_width '                 => $calendar_border_width,
		'calendar_border_color'                  => $calendar_border_color ,
		'event_tax'                              => '',
);

$categslug="";
$categId="";
global $wp_query;
$disable_event_title_link = $this->props['disable_event_title_link']=="on"?" decm_disable_event_link ":"";
$disable_event_image_link = $this->props['disable_event_image_link']=="on"?" decm_disable_event_link ":"";
$disable_event_calendar_title_link = $this->props['disable_event_calendar_title_link']=="on"?" decm_disable_event_link ":"";
$cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
$categslug = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->slug:"";
$categId = isset($cat_slug) && $cat_slug !=""&& $cat_slug->name!="tribe_events"?$cat_slug->term_id:"";
if($this->props['show_cdn_link']=="off"){
//wp_register_script("calendar_show",'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.8.17.1/js/EventCalendar/calender_show.js'); //phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
wp_register_script("calendar_show",'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.8.24/js/EventCalendar/calender_show.js'); //phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
wp_enqueue_script('main_1', 'https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.3.1/main.min.js', array(), null, false); //phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
wp_enqueue_script('main_2', 'https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.3.0/main.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
wp_enqueue_script('main_3', 'https://unpkg.com/@fullcalendar/timegrid@4.3.0/main.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
wp_enqueue_script('main_4', 'https://cdn.jsdelivr.net/npm/@fullcalendar/list@4.3.0/main.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
wp_enqueue_script('main_6', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.5.3/js/EventCalendar/main_6.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
wp_enqueue_script('main_7', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.5.3/js/EventCalendar/main_7.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
if(get_locale()!="en_US"){
	wp_enqueue_script('main_8', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.5.9/js/EventCalendar/locales-all.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
}
}

if($this->props['show_cdn_link']=="on"){
	wp_register_script("calendar_show", plugins_url().'/divi-event-calendar-module/includes/packages/calender_show.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
	wp_enqueue_script('main_1', plugins_url().'/divi-event-calendar-module/includes/packages/core/main.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_script('main_2', plugins_url().'/divi-event-calendar-module/includes/packages/daygrid/main.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_script('main_3', plugins_url().'/divi-event-calendar-module/includes/packages/timegrid/main.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_script('main_4', plugins_url().'/divi-event-calendar-module/includes/packages/list/main.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_script('main_6', plugins_url().'/divi-event-calendar-module/includes/packages/main_6.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_script('main_7', plugins_url().'/divi-event-calendar-module/includes/packages/main_7.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	if(get_locale()!="en_US"){
		wp_enqueue_script('main_8', plugins_url().'/divi-event-calendar-module/includes/packages/core/locales-all.min.js', array(), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	}
	}

		$venue_id = tribe_get_venue_id(get_the_id());
		$organizer_id = tribe_get_organizer_id(get_the_id());
		$multiDayCutoff = tribe_get_option( 'multiDayCutoff', '12:00 am' );


wp_localize_script( 'calendar_show', 'myAjax', 
array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
'date_format'=>$this->props['date_format'],
'time_format' => $this->props['time_format'],
'category_detail_label' => $this->props['category_detail_label'],
'time_detail_label' => $this->props['details_time_label'],
'date_detail_label' => $this->props['date_detail_label'],
'venue_detail_label' => $this->props['venue_detail_label'],
'location_detail_label' => $this->props['location_detail_label'],
'organizer_detail_label' => $this->props['organizer_detail_label'],
'price_detail_label' => $this->props['price_detail_label'],
'price_ticket_label' => $this->props['price_ticket_label'],
'rsvp_detail_label' => $this->props['rsvp_detail_label'],
'tag_detail_label' => $this->props['tag_detail_label'],
'website_detail_label' => $this->props['website_detail_label'],
'show_time_zone'=> $this->props['show_time_zone'],
'show_time_zone_abb'=>$this->props['show_time_zone_abb'],
'show_time_zone_on_calendar'=>$this->props['show_time_zone_on_calendar'],
'show_time_zone_abb_on_calender'=>$this->props['show_time_zone_abb_on_calender'],
'show_rsvp'=>$this->props['show_rsvp'],
'show_event_venue'=> $this->props['show_event_venue'],
'limit_event_title_length' => $this->props['limit_event_title_length'],
'event_title_length'=> $this->props['event_title_length'],
'hide_pre_nxt_event'=>$this->props['hide_pre_nxt_event'],
'included_categories'=>$this->props['included_categories'],
'included_organizer'=>$included_organizer,
'included_organizer_check'=>$included_organizer_check,
'included_venue'=>$included_venue,
'included_venue_check'=>$included_venue_check,
'included_series'=>$included_series,
'included_series_check'=>$included_series_check,
'show_tooltip'  =>$this->props['show_tooltip'],
'show_rsvp_feed_respond' => $this->props['show_rsvp_feed_respond'], 
'show_rsvp_feed_left' => $this->props['show_rsvp_feed_left'],
'show_ticket_feed_respond' => $this->props['show_ticket_feed_respond'],
'show_ticket_feed_left' => $this->props['show_ticket_feed_left'],
'show_tooltip_ticket'  => $this->props['show_tooltip_ticket'],
'show_tooltip_tablet'  => $this->props['show_tooltip_tablet'],
'show_tooltip_phone'  => $this->props['show_tooltip_phone'],
'show_image'=>$this->props['show_feature_image'],
'show_image_tablet'=>$this->props['show_feature_image_tablet'],
'show_image_phone'=>$this->props['show_feature_image_phone'],
'show_excerpt'=>$this->props['show_tooltip_excerpt'],
'show_price' =>$this->props['show_tooltip_price'],
'show_title' =>$this->props['show_tooltip_title'],
'show_date'  =>$this->props['show_tooltip_date'],
'event_series_label' => $this->props['event_series_label'],
'event_series_name' => $this->props['event_series_name'],
'custom_series_link_target' =>$this->props['custom_series_link_target'],
'enable_series_link' =>$this->props['enable_series_link'],
'show_time'  =>$this->props['show_tooltip_time'],
'show_venue'=>$this->props['show_tooltip_venue'],
'show_location'=>$this->props['show_tooltip_location'],
'show_address'=>$this->props['show_tooltip_street'],
'show_locality'=>$this->props['show_tooltip_locality'],
'show_state'=>$this->props['show_tooltip_state'],
'show_postal'=>$this->props['show_tooltip_postal'],
'show_country'=>$this->props['show_tooltip_country'],
'show_address_comma'=>$this->props['show_tooltip_street_comma'],
'show_locality_comma'=>$this->props['show_tooltip_locality_comma'],
'show_state_comma'=>$this->props['show_tooltip_state_comma'],
'show_postal_comma'=>$this->props['show_tooltip_postal_comma'],
'show_country_comma'=>$this->props['show_tooltip_country_comma'],
'show_postal_code_before_locality'=> $this->props['show_postal_code_before_locality'],
'show_organizer'=>$this->props['show_tooltip_organizer'],
'show_icon_label' =>  $this->props['show_icon_label'],
'stack_label_icon'=> $this->props['stack_label_icon'],
'show_colon'=> $this->props['show_colon'],
'calendar_eventorder' => $this->props['calendar_eventorder'],
'calendar_list_view_option'=> $this->props['calendar_list_view_option'],
'show_calendar_thumbnail' => $this->props['show_calendar_thumbnail'],
'detail_below_calander' => $this->props['detail_below_calander'],
'start_point'   => $this->props['starting_point'],
'end_point'   =>  $this->props['ending_point'],
'hide_time_range_in_week_day'   => $this->props['hide_time_range_in_week_day'],
'show_specific_month'  => $this->props['show_specific_month'],
'specific_month_start'  => $this->props['specific_month_start'],
'specific_years_start' =>  $this->props['specific_years_start'],
'calendar_default_view'=> $this->props['calendar_default_view']=="listWeek"?str_replace(",","",$this->props['calendar_list_view_option']):$this->props['calendar_default_view'],
'calendar_default_view_tablet'=> $this->props['calendar_default_view_tablet']=="listWeek"?str_replace(",","",$this->props['calendar_list_view_option']):$this->props['calendar_default_view_tablet'],
'calendar_default_view_phone'=> $this->props['calendar_default_view_phone']=="listWeek"?str_replace(",","",$this->props['calendar_list_view_option']):$this->props['calendar_default_view_phone'],
'venue_id' => $venue_id,
'organizer_id' => $organizer_id,
'show_month_view_button' => $this->props['show_month_view_button'],
'show_month_view_button_tablet' => $this->props['show_month_view_button_tablet'],
'show_month_view_button_phone' => $this->props['show_month_view_button_phone'],
'show_list_view_button' => $this->props['show_list_view_button'],
'show_list_view_button_tablet' => $this->props['show_list_view_button_tablet'],
'show_list_view_button_phone' => $this->props['show_list_view_button_phone'],
'show_week_view_button' => $this->props['show_week_view_button'],
'show_week_view_button_tablet' => $this->props['show_week_view_button_tablet'],
'show_week_view_button_phone' => $this->props['show_week_view_button_phone'],
'show_day_view_button' => $this->props['show_day_view_button'],
'show_day_view_button_tablet' => $this->props['show_day_view_button_tablet'],
'show_day_view_button_phone' => $this->props['show_day_view_button_phone'],
'categslug'     => $categslug,
'categId'     => $categId,
'event_selection'=> $this->props['event_selection'],
'show_tooltip_category' =>$this->props['show_tooltip_category'],
'hide_comma_cat'  =>$this->props['hide_comma_cat'],
'custom_category_link_target'=>$this->props['custom_category_link_target'],
'enable_organizer_link'=>$this->props['enable_organizer_link'],
'custom_organizer_link_target'=>$this->props['custom_organizer_link_target'],
'enable_venue_link'=>$this->props['enable_venue_link'],
'custom_venue_link_target'=>$this->props['custom_venue_link_target'],
'show_tooltip_weburl'=> $this->props['show_tooltip_weburl'],
'show_tag' => $this->props['show_tag'],
'hide_comma_tag' => $this->props['hide_comma_tag'],
'hidden_day'=> $hidden_day,
'week_start_on'			=>$this->props['week_start_on'],
'show_calendar_event_date'=> $this->props['show_calendar_event_date'],
'timeRangeSeparator'=>  tribe_get_option( 'timeRangeSeparator', ' - ' ),
'calender_end_time'=> $this->props['calender_end_time'],
'show_postponed_canceled_event'=> $this->props['show_postponed_canceled_event'],
'show_virtual_event'=>$this->props['show_virtual_event'],
'show_hybrid_event'=>$this->props['show_hybrid_event'],
'show_recurring_event' => $this->props['show_recurring_event'],
'hide_past_event'=>$this->props['hide_past_event'],
'number_event_day'=>$this->props['number_event_day'],
'limit_event'=> $this->props['limit_event'],
'hide_month_range'=>$this->props['hide_month_range'],
'event_start_date'   =>$this->props['event_start_date'],
'event_end_date'   => $this->props['event_end_date'],
'day_of_the_week_name' => $this->props['day_of_the_week_name'],
'day_of_the_week_name_tablet' => $this->props['day_of_the_week_name_tablet'],
'day_of_the_week_name_phone' => $this->props['day_of_the_week_name_phone'],
'events_background_color' => $this->props["events_background_color"],
'single_event_page_link' => $this->props['single_event_page_link'],
'disable_event_title_link' => $disable_event_title_link,
'disable_event_image_link' => $disable_event_image_link,
'disable_event_calendar_title_link' => $disable_event_calendar_title_link,
'custom_event_link_url' => $this->props['custom_event_link_url'],
'custom_event_link_target' => $this->props['custom_event_link_target'],
'show_end_time'=> $this->props['show_end_time'],
'enable_category_link'=> $this->props['enable_category_link'],
'custom_tag_link_target'=> $this->props['custom_tag_link_target'],
'enable_tag_links'=> $this->props['enable_tag_links'],
'website_link'=> $this->props['website_link'],
'custom_website_link_text'=> $this->props['custom_website_link_text'],
'custom_website_link_target'=>$this->props['custom_website_link_target'],
'disable_event_button_link' => $this->props['disable_event_button_link'],
'event_time_format'=> $this->props['event_time_format'],
'hide_calendar_event_multi_days'=>$this->props['hide_calendar_event_multi_days'],
'hide_calendar_event_all_day'=>$this->props['hide_calendar_event_all_day'],
'tooltip_image_align'=>$this->props['tooltip_image_align'],
'multidaycutoff'=> $multiDayCutoff,
'module_class' => $this->module_classname( $render_slug ),
));        
if($this->props['show_cdn_link']=="on"){

	 wp_enqueue_script("calendar_show", plugins_url().'/divi-event-calendar-module/includes/packages/calender_show.js', array('main_7'), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	 		
}
if($this->props['show_cdn_link']=="off"){

	// wp_enqueue_script("calendar_show",  'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.8.17.1/js/EventCalendar/calender_show.js', array('main_7'), null, false);//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	wp_enqueue_script("calendar_show",  'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.8.24/js/EventCalendar/calender_show.js', array('main_7'), null, false); //phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
}		

wp_localize_script('calendar_show', 'calendar_show_url', array(
			'pluginsUrl' => plugin_dir_url( __FILE__ ),
			'WpworpdressUrl' => get_home_path().'wp-load.php',
		));
		return sprintf("<div id='calendar'></div> 
			");
		
	}
	
	
}

new DECM_DiviEventCalendar;
