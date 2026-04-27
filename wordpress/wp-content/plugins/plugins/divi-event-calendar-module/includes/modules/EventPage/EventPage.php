<?php

class DIEC_EventPage extends ET_Builder_Module {

	public $slug       = 'diec_event_page';
	public $vb_support = 'on';
	

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Page', 'decm-divi-event-calendar-module' );
		// $this->main_class = '%%order_class%%';

	}

	public function get_settings_modal_toggles() {
		return array(
		  
			  'gerneral' => array(
				  'toggles' => array(
					  'decm_notice' => array(
						  'priority' => 1,
						  'title' => esc_html__( 'Notices', 'decm-divi-event-calendar-module' ),
					  ),

					//   'decm_virtual_hybrid_notice' => array(
					// 	'priority' => 1,
					// 	'title' => esc_html__( 'Virtual/Hybrid Event Notice', 'decm-divi-event-calendar-module' ),
					// ),

					  'decm_content' => array(
						'priority' => 1,
						'title' => esc_html__( 'Content', 'decm-divi-event-calendar-module' ),
					),	
					  'decm_details' => array(
						  'priority' => 2,
						  'title' => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					  ),
					  'link_show' => array(
						'priority' => 22,
						'title' => esc_html__( 'Links', 'decm-divi-event-calendar-module'),
					),
					'virtual_event' => array(
						'priority' => 49,
						'title' => esc_html__( 'Virtual Events', 'decm-divi-event-calendar-module' ),
					),
					  'google_maps' => array(
						'priority' => 49,
						'title' => esc_html__( 'Google Maps', 'decm-divi-event-calendar-module' ),
					),
					  'calendar_link' => array(
						  'priority' => 65,
						  'title' => esc_html__( 'Add To Calendar Buttons', 'decm-divi-event-calendar-module'),
					  ),	  
				  ),
			  ),
			  'advanced' => array(
				  'toggles' => array(
					'past_event_message'=>esc_html__('Past Event Notice','decm-divi-event-calendar-module'), 
					'event_status_notice'=>esc_html__('Event Status Notice','decm-divi-event-calendar-module'), 
				//	'thumbnail'  => esc_html__( 'Image', 'decm-divi-event-calendar-module' ),
					'organizer_thumbnail'  => esc_html__( 'Organizer Featured Image', 'decm-divi-event-calendar-module' ),
					'venue_thumbnail'  => esc_html__( 'Venue Featured Image', 'decm-divi-event-calendar-module' ),
					//'event_description'  => esc_html__( 'Description Text', 'decm-divi-event-calendar-module' ),
					'description_header_text' => array(
						'title'             => esc_html__( 'Description Heading Text', 'decm-divi-event-calendar-module' ),
						//'priority'          => 49,
						'tabbed_subtoggles' => true,
						'sub_toggles'       => array(
							'h1' => array(
								'name' => 'H1',
								'icon' => 'text-h1',
							),
							'h2' => array(
								'name' => 'H2',
								'icon' => 'text-h2',
							),
							'h3' => array(
								'name' => 'H3',
								'icon' => 'text-h3',
							),
							'h4' => array(
								'name' => 'H4',
								'icon' => 'text-h4',
							),
							'h5' => array(
								'name' => 'H5',
								'icon' => 'text-h5',
							),
							'h6' => array(
								'name' => 'H6',
								'icon' => 'text-h6',
							),
						),
					),
					'event_description'   => array(
						'title'             => esc_html__( 'Description Text', 'decm-divi-event-calendar-module' ),
					//	'priority'          => 45,
						'tabbed_subtoggles' => true,
						'bb_icons_support'  => true,
						'sub_toggles'       => array(
							'p'     => array(
								'name' => 'P',
								'icon' => 'text-left',
							),
							'a'     => array(
								'name' => 'A',
								'icon' => 'text-link',
							),
							'ul'    => array(
								'name' => 'UL',
								'icon' => 'list',
							),
							'ol'    => array(
								'name' => 'OL',
								'icon' => 'numbered-list',
							),
							'quote' => array(
								'name' => 'QUOTE',
								'icon' => 'text-quote',
							),
						),
					),
					  'event'  => esc_html__( 'Details Text', 'decm-divi-event-calendar-module' ),
					  'detail_label'  => esc_html__( 'Details Labels Text', 'decm-divi-event-calendar-module' ),	  
					  'child_filters_map'  => esc_html__( 'Map', 'decm-divi-event-calendar-module' ),
					  'add_to_calendar_button'=>esc_html__( 'Add To Calendar Button', 'decm-divi-event-calendar-module' ),
					  'add_to_calendar_link'=>esc_html__( 'Add To Calendar Links', 'decm-divi-event-calendar-module' ),
					  'virtual_event_button'=>esc_html__( 'Virtual Event Button', 'decm-divi-event-calendar-module' ),
					  
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
			  'button'         =>false,
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
				  'map_border'   => array(
					  'css'          => array(
						  'main' => array(
							  'border_radii'  => "%%order_class%% .ecs_google_map iframe",
							  'border_styles' => "%%order_class%% .ecs_google_map iframe",
							  
						  ),
						  'important' => 'all',
					  ),
					  'label_prefix' => esc_html__( 'Map Border', 'decm-divi-event-calendar-module' ),
					  'description'        => esc_html__( 'Add and customize the box shadow for the event location map with all the standard box border settings.', 'decm-divi-event-calendar-module' ),
					  'tab_slug'     => 'advanced',
					  'toggle_slug'  => 'child_filters_map',
					 
				  ),
				  'pass_event_border'   => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% div.tribe-events-notices",
							'border_styles' =>"%%order_class%% div.tribe-events-notices",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Pasts Events Notice', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the border for the past events notice with all the standard border settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'past_event_message',
				   
				),
				'event_status_border'   => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% div.event_status_notice",
							'border_styles' =>"%%order_class%% div.event_status_notice",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Event Status Notice', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the border for the past events message with all the standard border settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'event_status_notice',
				   
				),

				'organizer_thumbnail_border'   => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .wp-feature-organizer-image",
							'border_styles' => "%%order_class%% .wp-feature-organizer-image",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Image Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'organizer_thumbnail',
					//'default'          => 'solid',
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
						'border_styles' => array(
							'style' => 'solid',
						),
					),
				),
				'venue_thumbnail_border'   => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .wp-feature-venue-image",
							'border_styles' => "%%order_class%% .wp-feature-venue-image",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Image Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'venue_thumbnail',
					//'default'          => 'solid',
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
						'border_styles' => array(
							'style' => 'solid',
						),
					),
				),

			  ),

		  
			  'box_shadow'     => array(
				  'default' => array(
					  'css' => array(
						  'main' => "%%order_class%%",
					  ),
				  ),
				  
			  'map_box_shadow'     => array(
					  'css' => array(
						  'main' => "%%order_class%% .ecs_google_map iframe",
					  ),
					  'label'         => esc_html__( 'Map Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					  'description'        => esc_html__( 'Add and customize the box shadow for the event location map with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					  'tab_slug'     => 'advanced',
					  'toggle_slug'  => 'child_filters_map',
					  //'default'          => 'solid',
				  ),
				  'pass_event_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% div.tribe-events-notices",
					),
					'label'         => esc_html__( 'Past Events Notice Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the past events notice with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'past_event_message',
					//'default'          => 'solid',
				),

				'orgainzer_image_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .wp-feature-organizer-image",
					),
					'label'         => esc_html__( 'Image Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the organizer featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'organizer_thumbnail',
					//'default'          => 'solid',
					// 'show_if_not'     => array(
					// 	'layout' => 'cover',
					// ),
				),

				'venue_image_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .wp-feature-venue-image",
					),
					'label'         => esc_html__( 'Image Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the venue featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'venue_thumbnail',
					//'default'          => 'solid',
					// 'show_if_not'     => array(
					// 	'layout' => 'cover',
					// ),
				),

			  ),

			'filters'        => array(
				'css' => array(
					'main' =>'%%order_class%%',
				),
			),

			  'fonts'          => array(

				'text'     => array(
					'label'           => et_builder_i18n( 'Description' ),
					'css'             => array(
						'line_height' => "%%order_class%% div.ecs-event-description p",
						'color'       => "%%order_class%% div.ecs-event-description p",
					),
					'line_height'     => array(
						'default' => floatval( et_get_option( 'body_font_height', '1.7' ) ) . 'em',
					),
					'font_size'       => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug'     => 'event_description',
					'sub_toggle'      => 'p',
					'hide_text_align' => true,
				),
				'link'     => array(
					'label'       => et_builder_i18n( 'Link' ),
					'css'         => array(
						'main'  => "%%order_class%% div.ecs-event-description p a",
						'color' => "%%order_class%% div.ecs-event-description p a",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_font_size', '14' ) ) . 'px',
					),
					'toggle_slug' => 'event_description',
					'sub_toggle'  => 'a',
				),
				'ul'       => array(
					'label'       => esc_html__( 'Unordered List', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main'        => "%%order_class%% div.ecs-event-description ul li",
						'color'       => "%%order_class%% div.ecs-event-description ul li, %%order_class%% div.ecs-event-description p ol li > ul li",
						'line_height' => "%%order_class%% div.ecs-event-description ul li",
						'item_indent' => "%%order_class%% div.ecs-event-description ul",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => '14px',
					),
					'toggle_slug' => 'event_description',
					'sub_toggle'  => 'ul',
				),
				'ol'       => array(
					'label'       => esc_html__( 'Ordered List', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main'        => "%%order_class%% div.ecs-event-description ol li",
						'color'       => "%%order_class%% div.ecs-event-description ol li",
						'line_height' => "%%order_class%% div.ecs-event-description ol li",
						'item_indent' => "%%order_class%% div.ecs-event-description ol",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => '14px',
					),
					'toggle_slug' => 'event_description',
					'sub_toggle'  => 'ol',
				),
				'quote'    => array(
					'label'       => esc_html__( 'Blockquote', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main'  => "%%order_class%% div.ecs-event-description blockquote",
						'color' => "%%order_class%% div.ecs-event-description blockquote",
					),
					'line_height' => array(
						'default' => '1em',
					),
					'font_size'   => array(
						'default' => '14px',
					),
					'toggle_slug' => 'event_description',
					'sub_toggle'  => 'quote',
				),

				'header'   => array(
					'label'       => esc_html__( 'Heading', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main' => "%%order_class%% div.ecs-event-description h1",
					),
					'font_size'   => array(
						'default' => absint( et_get_option( 'body_header_size', '30' ) ) . 'px',
					),
					'toggle_slug' => 'description_header_text',
					'sub_toggle'  => 'h1',
				),
				'header_2' => array(
					'label'       => esc_html__( 'Heading 2', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main' => "%%order_class%% div.ecs-event-description h2",
					),
					'font_size'   => array(
						'default' => '26px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'description_header_text',
					'sub_toggle'  => 'h2',
				),
				'header_3' => array(
					'label'       => esc_html__( 'Heading 3', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main' => "%%order_class%% div.ecs-event-description h3",
					),
					'font_size'   => array(
						'default' => '22px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'description_header_text',
					'sub_toggle'  => 'h3',
				),
				'header_4' => array(
					'label'       => esc_html__( 'Heading 4', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main' => "%%order_class%% div.ecs-event-description h4",
					),
					'font_size'   => array(
						'default' => '18px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'description_header_text',
					'sub_toggle'  => 'h4',
				),
				'header_5' => array(
					'label'       => esc_html__( 'Heading 5', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main' => "%%order_class%% div.ecs-event-description h5",
					),
					'font_size'   => array(
						'default' => '16px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'description_header_text',
					'sub_toggle'  => 'h5',
				),
				'header_6' => array(
					'label'       => esc_html__( 'Heading 6', 'decm-divi-event-calendar-module' ),
					'css'         => array(
						'main' => "%%order_class%% div.ecs-event-description h6",
					),
					'font_size'   => array(
						'default' => '14px',
					),
					'line_height' => array(
						'default' => '1em',
					),
					'toggle_slug' => 'description_header_text',
					'sub_toggle'  => 'h6',
				),

				'pass_event' => array(
					'css'          => array(
						'main'      => "%%order_class%% div.tribe-events-notices",
						'important' => 'all',
					),
					
					'label'        => esc_html__( 'Past Events Notice', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'past_event_message',

				),
				'event_status_font' => array(
					'css'          => array(
						'main'      => "%%order_class%% div.ecs_event_status_postponed,%%order_class%% div.ecs_event_status_canceled,%%order_class%% div.ecs_event_status_reason",
						'important' => 'all',
					),
					
					'label'        => esc_html__( 'Event Status Notice', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'event_status_notice',

				),
				'details_labels' => array(
					'css'          => array(
						'main'      => "%%order_class%% .ecs-detail-label",
						'important' => 'all',
					),
					
					'label'        => esc_html__( 'Details Label', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'detail_label',

				),

				  'duration' => array(
					  'css'          => array(
						'main'      => "%%order_class%% span.decm_date,%%order_class%% span.decm_time,%%order_class%% span.ecs-eventTime,%%order_class%% span.decm_venue,%%order_class%% span.decm_location, %%order_class%% span.decm_location a, %%order_class%% span.decm_organizer,%%order_class%% span.decm_price,%%order_class%% span.decm_weburl a, %%order_class%% .ecs-categories a,%%order_class%% span.decm_orgaizer_email,%%order_class%% span.decm_weburl,%%order_class%% span.decm_venue_phone,%%order_class%% span.decm_venue_google_link a,%%order_class%% span.decm_venue_weburl a,%%order_class%% span.decm_organizer_email,%%order_class%% span.decm_organizer_email a,%%order_class%% span.decm_organizer_weburl,%%order_class%% span.decm_organizer_weburl a,%%order_class%% .ecs-weburl a,%%order_class%% .decm_organizer_phone,%%order_class%% span.decm_organizer,%%order_class%% .ecs-event-tag a,%%order_class%% span.decm_categories,%%order_class%% span.decm_series_name a,%%order_class%% span.decm_series_name",
						'text_align' => '%%order_class%% .decm-show-detail-center',
					'important' => 'all',
					  ),
					  'toggle_priority' => 80,
					  'label'        => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					  //'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					  'disable_toggle' => false,
					  'tab_slug'     => 'advanced',
					  'toggle_slug'  => 'event',
					  'add_to_calendar_link'
				  ),
				  'calendar_link' => array(
					'css'          => array(
						'main'      => "%%order_class%% p.ecs-show_calendar a,%%order_class%% p.ecs-showical-export a,%%order_class%% p.ecs-export-ics a,%%order_class%% p.ecs-showoutlook-link a,%%order_class%% .ecs-calendar_link_align",
						'important' => 'all',
					),
					'toggle_priority' => 80,
					'label'        => esc_html__( 'Add To Calendar Link', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'add_to_calendar_link',
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
				'add_to_calendar_button' => array(
					'label'         => __( 'Add To Calendar Button', 'decm-divi-event-calendar-module' ),
					'use_alignment' => true,
					'box_shadow'    => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'add_to_calendar_button',
					'css'           => array(
						'main'        => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .act-add_to_calendar",
						'plugin_main' => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .act-add_to_calendar",
						'alignment'   => "%%order_class%% .diec_add_to_calendar",
						'important' => 'all',
					),
					'margin_padding' => array(
						'css' => array(
							'margin' => "%%order_class%% p.diec_add_to_calendar",
							 'padding' => "%%order_class%% .act-add_to_calendar",
							'important' => 'all',
						),
						'custom_margin' => array(
					'default' => '15px|auto|15px|auto|false|false',
				),
					),
				),					
				  
				'virtual_event_button' => array(
					'label'         => __( 'Zoom Button', 'decm-divi-event-calendar-module' ),
					'use_alignment' => true,
					'box_shadow'    => false,
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'virtual_event_button',
					'css'           => array(
						'main'        => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .ecs-events-virtual-link-button",
						'plugin_main' => "%%order_class%%.et_pb_button_wrapper,%%order_class%% .ecs-events-virtual-link-button",
						'alignment'   => "%%order_class%% .ecs-events-virtual-single-button-details-link-button",
						'important' => 'all',
					),
					'margin_padding' => array(
						'css' => array(
							'margin' => "%%order_class%% div.ecs-events-virtual-single-button-details-link-button",
							 'padding' => "%%order_class%% .ecs-events-virtual-link-button",
							'important' => 'all',
						),
						'custom_margin' => array(
					'default' => '15px|auto|15px|auto|false|false',
				),
					),
				),					
				  
  
			  
			  ),

  
		  );
	  }
	  public function get_fields() {
		  return array(
  
			'link'           => false,
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
				  'description'        => esc_html__( 'Divi Events Calendar ', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'     => 'decm_details',
			  ),
			  'shortcode_param' => array(
				  'label'             => esc_html__( 'shortcode_param', 'decm-divi-event-calendar-module' ),
				  'type'              => 'text',
				  'option_category'   => 'configuration',
				  'description'       => esc_html__( 'Total number of events to show.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'       => 'decm_details',
				  'default'           => '',
				  'show_if' => array(
					  'use_shortcode'=>'on',
				  )
			  ),
			  'use_current_loop'=> array(
				  'label'				=> esc_html__( 'Dynamic Event Content', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'layout',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to turn on or off dynamic content for the module, which allows you to place the module in a Divi Theme Builder layout to dynamically display event categories for the current category or page. This will also work on the single event pages and for the Theme Builder search results page!', 'decm-divi-event-calendar-module' ),
				  
				  'toggle_slug'     => 'decm_content',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),

			  'passed_event_notice'=> array(
				'label'				=> esc_html__( 'Show Past Event Notice', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the past event notice. If enabled, the notice will show in this module when the event has passed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_notice',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),
			'event_status_notice'=> array(
				'label'				=> esc_html__( 'Show Event Status Notice', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the event status as a notice if it is canceled or postponed.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_notice',
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

			'event_status_reason'=> array(
				'label'				=> esc_html__( 'Show Event Status Reason', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the reason for the canceled or postponed event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_notice',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				),
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
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
				'toggle_slug'		=> 'decm_details',
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
				'label'				=> esc_html__( 'Show Label', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event series label.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'off',
				'show_if' => array(
					'event_series_name'=>'on',
				),
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),	
			),


			'event_series_custom_label'=> array(
				'label'				=> esc_html__( 'Series Label', 'decm-divi-event-calendar-module' ),
				'type'				=> 'text',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Enter custom text for the series name label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> '',
				'show_if' => array(
					'event_series_name'=>'on',
				),
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),	
			),


			'event_series_icon'=> array(
				'label'				=> esc_html__( 'Show Icon', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event series icon.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'off',
				'show_if' => array(
					'event_series_name'=>'on',
				),
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
			),
			

			'event_virtual_hybrid_notice'=> array(
				'label'				=> esc_html__( 'Show Virtual/Hybrid Event Notice', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show a notice if the event is marked as a virtual and/or hybrid event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_notice',
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



  			'description'=> array(
				'label'				=> esc_html__( 'Show Event Description', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event description. The event description is the text written within the backend text editor of the single event pages using the classic WordPress editor. This Show Event Description setting is intended for simple text descriptions and is not recommended in most cases. Instead, you should use the Divi Post Content module, which is much more suited for showing content from pages build with Gutenberg or the Divi Builder.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),

			'Show_description_placeholder'=> array(
				'label'				=> esc_html__( 'Show Event Description', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				// 'options'			 => array(
				// 	'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
				// 	'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				// ),
				'description'		=> esc_html__( 'Choose to show or hide the description of the event.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_content',
				'default'			=> "Your dynamic event description will display here. ",
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),
			  'show_feature_image'=> array(
				  'label'				=> esc_html__( 'Show Featured Image', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event featured image.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
  
			  'show_title'=> array(
				  'label'				=> esc_html__( 'Show Title', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event title.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
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
				  'toggle_slug'		=> 'decm_details',
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
				'toggle_slug'       => 'decm_details',
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
				'label'             => esc_html__( 'Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'decm_details',
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
				  'toggle_slug'		=> 'decm_details',
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
				'toggle_slug'       => 'decm_details',
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
				'label'             => esc_html__( 'Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_time'=> 'on',
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
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
					  'show_time'=>'on',
					  //'show_date'=>'on',
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
				'toggle_slug'		=> 'decm_details',
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
			 
			  'show_location'=> array(
				  'label'				=> esc_html__( 'Show Location', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'yes_no_button',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event location.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  ),
				  'affects' => array(
					'show_street',
					'show_locality',
					'show_postal',
					'show_location_state',
					'show_country',
					'show_street_comma',
					'show_locality_comma',
					'show_postal_comma',
					'show_location_state_comma',
					'show_country_comma',
					'show_postal_code_before_locality',
				),
			  ),


			  'location_detail_label' => array(
				'label'             => esc_html__( 'Location Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the location label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
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
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location street address in the tooltip.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',

				
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
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',

	
				
			),		
				'show_locality'=> array(
				'label'				=> esc_html__( 'Show Location Locality', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location locality in the tooltip.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',

				
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
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',
				
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
				'toggle_slug'		=>'decm_details',
				'default'			=> 'on',
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
				'toggle_slug'		=>'decm_details',
				'default'			=> 'on',
			),		
				'show_postal'=> array(
				'label'				=> esc_html__( 'Show Location Postal Code', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location postal code in the tooltip.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',
				
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
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',
				
			),
			'show_country'=> array(
				'label'				=> esc_html__( 'Show Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location country in the tooltip.', 'decm-divi-event-calendar-module' ),			
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',			
			),
			'show_country_comma'=> array(
				'label'				=> esc_html__( 'Show Comma After Location Country', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the comma after the location country.', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'on',
				
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
				
				'toggle_slug'     => 'decm_details',
				'default'			=> 'off',
				
			),
			  'google_link'=> array(
				'label'				=> esc_html__( 'Show Google Map Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location Google Map link.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'google_maps',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),


			'venue_google_map_label' => array(
				'label'             => esc_html__( 'Venue Google Map Link Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the venue google map link label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'google_maps',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'google_link'=>'on',
				)
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
				'toggle_slug'		=> 'decm_details',
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
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_venue'=>'on',
				)
			),

			'show_venue_feature_image'=> array(
				'label'				=> esc_html__( 'Show Venue Featured image', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the venue featured image.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			
			'venue_phone'=> array(
				'label'				=> esc_html__( 'Show Venue Phone', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue phone number.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'venue_phone_label' => array(
				'label'             => esc_html__( 'Venue Phone Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the venue phone label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_venue'=>'on',
				)
			),
			
			'venue_weburl'=> array(
				'label'				=> esc_html__( 'Show Venue Website', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event venue Website.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'venue_website_label' => array(
				'label'             => esc_html__( 'Venue Website Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the venue website label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_venue'=>'on',
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
				  'toggle_slug'		=> 'decm_details',
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
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'show_name'=>'on',
				)
			),

			'show_organizer_feature_image'=> array(
				'label'				=> esc_html__( 'Show Organizer Featured image', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the organizer featured image.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			 
			  'organizer_phone'=> array(
				'label'				=> esc_html__( 'Show Organizer Phone', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event organizer phone number.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'organizer_phone_label' => array(
				'label'             => esc_html__( 'Organizer Phone Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the organizer phone label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'organizer_phone'=>'on',
				)
			),

			'organizer_email'=> array(
				'label'				=> esc_html__( 'Show Organizer Email', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event organizer email address.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),


			'organizer_email_label' => array(
				'label'             => esc_html__( 'Organizer Email Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the organizer email label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'organizer_email'=>'on',
				)
			),

			'organizer_weburl'=> array(
				'label'				=> esc_html__( 'Show Organizer Website', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event organizer website.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'organizer_website_label' => array(
				'label'             => esc_html__( 'Organizer Website Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the organizer website label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'organizer_weburl'=>'on',
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
				'toggle_slug'		=> 'decm_details',
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
			  'toggle_slug'       => 'decm_details',
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
				  'toggle_slug'		=> 'decm_details',
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
				'toggle_slug'       => 'decm_details',
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
				'toggle_slug'		=> 'decm_details',
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
				'toggle_slug'		=> 'decm_details',
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
				  'toggle_slug'		=> 'decm_details',
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
				'description'       => esc_html__( 'Enter custom text for the rsvp label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
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
				'toggle_slug'		=> 'decm_details',
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
					'toggle_slug'		=> 'decm_details',
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
				  'toggle_slug'		=> 'decm_details',
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
				'toggle_slug'       => 'decm_details',
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
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			  'event_tag' => array(
				'label'				=> esc_html__( 'Show Tags', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event tags.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'decm_details',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),


			'tag_detail_label' => array(
				'label'             => esc_html__( 'Tags Label', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter custom text for the tags label that displays on the frontend.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_details',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => '',
				'show_if' => array(
					'event_tag'=>'on',
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
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'on',
				'show_if' => array(
					'event_tag'=>'on',
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
				  'toggle_slug'		=> 'decm_details',
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
				'toggle_slug'       => 'decm_details',
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
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event excerpt.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
			  
			  'show_detail'=> array(
				  'label'				=> esc_html__( 'Show More Info Button', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to show or hide the event more info button.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_details',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
			  'show_add_calendar_button'=> array(
				'label'				=> esc_html__( 'Show Add To Calendar Button', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the add to calendar button and links.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_link',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',

				),
						'affects'         => array(
							'show_google_calendar',
							'show_outlook_link',
							'show_ical_export'
						),
						'display'=> array(
							'show_google_calendar'=>'on'
						)
			),
			  /* Elements from event calendar shortcode pluin */
			  'show_google_calendar'=> array(
				  'label'				=> esc_html__( 'Show Google Calendar Link', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'yes_no_button',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( "Choose to show or hide the link for adding the event to the the visitor's Google Calendar.", 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'calendar_link',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
					  'show_add_calendar_button'=>'on'
					  )
			  ),
			  'show_ical_export'=> array(
				  'label'				=> esc_html__( 'Show Apple Calendar Link', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'yes_no_button',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( "Choose to show or hide the link for adding the event to the the visitor's Apple Calendar.", 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'calendar_link',
				  'default'			=> 'on',
				  'show_if' => array(
					  'use_shortcode'=>'off',
					  'show_add_calendar_button'=>'on'
				  )
			  ),

			  'show_outlook_360'=> array(
				'label'				=> esc_html__( 'Show Outlook 360 Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( "Choose to show or hide the link for adding the event to the the visitor's Outlook calendar.", 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_link',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_add_calendar_button'=>'on'
				)
			),

			  'show_outlook_link'=> array(
				'label'				=> esc_html__( 'Show Outlook Live Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( "Choose to show or hide the link for adding the event to the the visitor's Outlook calendar.", 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_link',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_add_calendar_button'=>'on'
				)
			),

			'show_export_link'=> array(
				'label'				=> esc_html__( 'Show Export .ics Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( "Choose to show or hide the link for adding the event to the the export .ics calendar.", 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'calendar_link',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_add_calendar_button'=>'on'
				)
			),
			'googlemap'=> array(
				'label'				=> esc_html__( 'Show Google Map', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event location map. Remember to have an active Google Maps API key entered in the Divi Theme Options.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'google_maps',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),
			'zoom_link'=> array(
				'label'				=> esc_html__( 'Show Zoom Meeting', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the Zoom meeting video.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'virtual_event',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),
			'webex_link'=> array(
				'label'				=> esc_html__( 'Show Webex Meeting', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the Webex meeting video.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'virtual_event',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),
			'facebook_link'=> array(
				'label'				=> esc_html__( 'Show Facebook Live Video', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the Facebook Live video.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'virtual_event',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				)
			),
			'youtube_link'=> array(
				'label'				=> esc_html__( 'Show YouTube Live Video', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the YouTube live video.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'virtual_event',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
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
				  'toggle_slug'		=> 'decm_details',
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
				  'toggle_slug'     => 'decm_details',
				  'default'			=> 'on',
				  'affects'         => array(
					  'show_icon_label',
					  'stack_label_icon',
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
				  'toggle_slug'     => 'decm_details',
				   'default' => 'none',
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
				'toggle_slug'		=> 'decm_details',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'show_date'=>'on',
				),
				'show_if_not' => array(
					'show_icon_label'=>'none',
					'show_data_one_line'=>'off',
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
				'toggle_slug'		=>  'decm_details',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_data_one_line'=>'on',
				),
				'show_if' => array(
					'show_icon_label'=>array('label_icon','label'),
				)
			),

			  /* Content Options from Blog Module */
			  'event_count' => array(
				  'label'             => esc_html__( 'Events Count', 'decm-divi-event-calendar-module' ),
				  'type'              => 'hidden',
				  'option_category'   => 'configuration',
				  'description'       => esc_html__( 'Choose the total number of events to show in the feed. Remember, you can use pagination options as well for the website visitor to load more events.', 'decm-divi-event-calendar-module' ),
				  'computed_affects'   => array(
					  '__posts',
					  '__getEvents',
				  ),
				  'toggle_slug'       => 'decm_content',
				  'default'           => 1,
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),

			  'included_categories' => array(
				  'label'            => esc_html__( 'Included Categories', 'decm-divi-event-calendar-module' ),
				  'type'             => 'hidden',
				  'meta_categories'  => array(
					  'all'     => esc_html__( 'All Categories', 'decm-divi-event-calendar-module' ),
				  'current' => esc_html__( 'Current Category', 'decm-divi-event-calendar-module' ),
				  ),
				  
				  'option_category'  => 'configuration',
				  'renderer_options' => array(
					  'use_terms' => true,
					  'term_name' => 'tribe_events_cat',
				  ),
				  'description'      => esc_html__( 'Choose which event categories you would like to show in the feed.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'      => 'decm_content',
				  'computed_affects' => array(
					  '__posts',
					  '__getEvents',
  
				  ),
				  'show_if' => array(
					  'use_current_loop'=>'off',
				  )
			  ),

			  'render_Classes' => array(
				  'type'             => 'hidden',
				  'option_category'  => 'configuration',
				  'toggle_slug'      => 'decm_content',
				  'default'		   =>  $this->module_classname( 'decm_event_display' ),
			  ),
			 
			 
			  'google_api_key_customize' => array(
				'label'             => esc_html__( 'Google Maps API Key', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Enter your Google Maps API key. Please note that this is not necessary if you are using the default API key provided in The Events Calendar settings.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'google_maps',
				// 'computed_affects'  => array(
				// 	'__posts',
				// 	'__getEvents',
				// ),
				'default'           => 'AIzaSyDNsicAsP6-VuGtAb1O9riI3oc_NOb7IOU',	
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
	
			'add_url' => array(
				'label'             => esc_html__( 'Add Custom Api key', 'decm-divi-event-calendar-module' ),
				'type'              => 'hidden',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_content',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				'default'           => 'https://www.google.com/maps/embed/v1/place?key=',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
  
			  'excerpt_length' => array(
				  'label'             => esc_html__( 'Excerpt Length', 'decm-divi-event-calendar-module' ),
				  'type'              => 'hidden',
				  'option_category'   => 'configuration',
				  'description'       => esc_html__( 'If you are showing the event excerpt, this setting allows you to set a specific character limit for the text. The WordPress default is 270 characters.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'       => 'decm_content',
				  'default'           => '270',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  )
			  ),
			  'blog_offset' => array(
				  'label'             => esc_html__( 'Events Offset Number', 'decm-divi-event-calendar-module' ),
				  'type'              => 'hidden',
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
			  'show_past'=> array(
				  'label'				=> esc_html__( 'Only Show Past Events', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'configuration',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to use the module to show an archive of past events instead of upcoming events.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'		=> 'decm_content',
				  'default'			=> 'off',
				  'show_if' => array(
					  'use_shortcode'=>'off',
				  ),
				  'computed_affects'   => array(
					  '__getEvents',
				  ),
			  ),

			  'columns' => array(
				  'label'           => esc_html__( 'Columns', 'decm-divi-event-calendar-module' ),
				  'description'		=> esc_html__( 'Choose the number of columns you want to use to display your events. Note that the number of columns is sometimes dependent on the alignment options chosen.', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'layout',
				  'options'		=>[
					  '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
					  '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
					  '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
					  '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
				  ],
				  
				  'tab_slug'		  => 'advanced',
				  //'mobile_options'  => true,
				  'toggle_slug'     => 'event',
				  'computed_affects' => array(
					  '__posts',
					  '__getEvents',
				  ),
				   'default' => '1',
			  ),
			  
			  'image_align' => array(
				  'label'           => esc_html__( 'Alignment', 'decm-divi-event-calendar-module' ),
				  'description'		=> esc_html__( 'Choose the alignment of the event featured image and details. Note that the alignment is sometimes dependent on the number of columns chosen.', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'layout',
				  'options'		=>[
					  'leftimage_rightdetail'   => __( 'Image Left, Details Right',  'decm-divi-event-calendar-module' ),
					  'topimage_bottomdetail'   => __( 'Image Top,  Details  Bottom',  'decm-divi-event-calendar-module' ),
					  'rightimage_leftdetail'   => __( 'Image Right, Details Left',  'decm-divi-event-calendar-module' ),
					  //'centerimage_bottomdetail'   => __( 'Image Top Center, Details Bottom',  'decm-divi-event-calendar-module' ),

				  ],
				  'default'         => 'leftimage_rightdetail',
				  'tab_slug'		  => 'advanced',
				 // 'mobile_options'  => false,
				  'toggle_slug'     => 'event',
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
				  'type'              => 'hidden',
				  'custom_color'      => true,
				  'tab_slug'          => 'advanced',
				  'toggle_slug'       => 'event',
				  // 'hover'             => 'tabs',
				  'mobile_options'    => true,
			  ),
		
			  'details_link_color' => array(
				  'label'             => esc_html__( 'Details Link Color', 'decm-divi-event-calendar-module' ),
				  'description'       => esc_html__( 'Choose a color for the link text in the event details.', 'decm-divi-event-calendar-module' ),
				  'type'              => 'color-alpha',
				  'custom_color'      => true,
				  
				  'tab_slug'          => 'advanced',
				  'toggle_priority' => 12,
				  'toggle_slug'       => 'event',
				  'priority' => 20,
				  // 'hover'             => 'tabs',
				  'mobile_options'    => true,
			  ),
			  'past_event_message_background_color' => array(
				'label'             => esc_html__( 'Past Events Notice Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the past events Notice.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'past_event_message',
				
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
			'event_status_background_color' => array(
				'label'             => esc_html__( 'Event Status Notice Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Set a color for the background of the past events Notice.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'event_status_notice',
				
				// 'hover'             => 'tabs',
				//'mobile_options'    => true,
			),
		
			  'details_icon_color' => array(
				'label'             => esc_html__( 'Details Icon Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the icons in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'event',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),

			'details_icon_size' => array(
				'label'           => esc_html__( 'Details Icon Size', 'decm-divi-event-calendar-module' ),
				'description' => __('Adjust the size of the details icons.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'event',
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
				
				'toggle_slug'       => 'detail_label',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			  
			  
			  'cards_spacing' => array(
				  'label'           => esc_html__( 'Event Margin', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
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
				  'type'            => 'hidden',
				  'option_category' => 'basic_option',
				  'description'     => esc_html__( 'Adjust the spacing around the inside of the individual events.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'     => 'event',
				  'tab_slug'		  => 'advanced',
				  'mobile_options'  => true,
				  'computed_affects' => array(
					  '__posts',
				  ),
  
			  ),
			  
			  'pass_event_message_margin' => array(
                'label'           => esc_html__( 'Past Events Message Margin', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the outside of the past events message.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'past_event_message',
				'tab_slug'		  => 'advanced',
				'mobile_options'    => true,
                'computed_affects' => array(
                    '__posts',
                ),

            ),
			
            'pass_event_message_padding' => array(
                'label'           => esc_html__( 'Past Events Message Padding', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the inside of the past events message.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'past_event_message',
                'tab_slug'		  => 'advanced',
				'mobile_options'  => true,
				'computed_affects' => array(
                    '__posts',
                ),

			),
			'event_status_margin' => array(
                'label'           => esc_html__( 'Event Status Notice Margin', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the outside of the past events message.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'event_status_notice',
				'tab_slug'		  => 'advanced',
				'mobile_options'    => true,
                'computed_affects' => array(
                    '__posts',
                ),

            ),
			'event_status_padding' => array(
                'label'           => esc_html__( 'Event Status Notice Padding', 'decm-divi-event-calendar-module' ),
                'type'            => 'custom_margin',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Adjust the spacing around the outside of the past events message.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'event_status_notice',
				'tab_slug'		  => 'advanced',
				'mobile_options'    => true,
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
				  'computed_callback' => array( 'DIEC_EventPage', 'get_blog_posts_events' ),
				  'computed_depends_on'  => array(
					  'show_rsvp_feed_respond',
					  'show_rsvp_feed_left',
					  'show_ticket_feed_respond',
					  'show_ticket_feed_left',
					  'event_count',
					  'date_format',
					  'time_format',
					  'show_name',
					  'enable_organizer_link',
					  'enable_series_link',
					  'custom_series_link_target',
					  'category_links_target' ,
					  'enable_tag_links',	
		              'custom_tag_link_target',
					  'venue_website_link_target',
					  'organizer_website_link_target',
					  'enable_organizer_website_linkable',
					  'enable_venue_website_link',
					  'hide_comma_tag',
					  'hide_comma_cat',
					  'enable_venue_link',
					  'show_past',
					  'blog_offset',
					  'included_categories',
					  'organizer_email_linkable',
					  'website_link',
					  'custom_website_link_text',
					  'custom_website_link_target',
					  'enable_category_link',
					  'event_status_notice',
					  'event_virtual_hybrid_notice',
					  'event_status_reason',
					  'event_series_name',
					  'event_series_label',
					  'event_series_icon',
					  'enable_location_link',
					  'custom_location_link_target',
					  'map_height',
			          'map_width',
				  ),
			  ),
  
			  //Extra Design settings
			  'view_more_text' => array(
				  'label'           => esc_html__( 'More Info Button Text', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'basic_option',
				  'description'     => esc_html__( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'     => 'decm_details',
				  'default'         => 'More Info',
				  'dynamic_content'  => 'text',
				  'mobile_options'   => true,
				  'hover'            => 'tabs',
				  'computed_affects' => array(
					  '__posts',
				  ),
  
			  ),
			  'view_more_icons_list' => array(
				  'label'           => esc_html__( 'Button Text', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'basic_option',
				  'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
				  'toggle_slug'     => 'decm_details',
				  'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			  ),
			  'align' => array(
				  'label'           => esc_html__( 'Image Alignment', 'decm-divi-event-calendar-module' ),
				  'type'            => 'hidden',
				  'option_category' => 'layout',
				  'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				  'default_on_front' => 'left',
				  'tab_slug'        => 'advanced',
				  'toggle_slug'     => 'event',
				  'description'     => esc_html__( 'Choose to align the event featured image to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				  'options_icon'    => 'module_align',
				  //'mobile_options'  => true,
			  ),
			  'thumbnail_margin' => array(
				  'label' => __('Image Margin', 'decm-divi-event-calendar-module'),
				  'type' => 'hidden',
				  'description' => __('Adjust the spacing around the outside of the event featured image.', 'decm-divi-event-calendar-module'),
				  'tab_slug'        => 'advanced',
				  'toggle_slug' => 'event',
				  'mobile_options'  => true,
			  ),
			  'thumbnail_padding' => array(
				  'label' => __('Image Padding', 'decm-divi-event-calendar-module'),
				  'type' => 'hidden',
				  'description' => __('Adjust the spacing around the inside of the event featured image.', 'decm-divi-event-calendar-module'),
				  'tab_slug'        => 'advanced',
				  'toggle_slug' => 'event',
				  'mobile_options'  => true,
			  ),
			  'thumbnail_width' => array(
				  'label'           => esc_html__( 'Image Width', 'decm-divi-event-calendar-module' ),
				  'description' => __('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				  'type'            => 'hidden',
				  'option_category' => 'layout',
				  'tab_slug'        => 'advanced',
				  'toggle_slug'     => 'event',
				  'validate_unit'   => true,
				  'depends_show_if' => 'off',
				  'default_unit'    => 'px',
				  'default'         => '800',
				  'allow_empty'     => true,
				  'responsive'      => true,
				  'mobile_options'  => true,
				  
			  ),


			  'organizer_align' => array(
				'label'           => esc_html__( 'Image Alignment', 'decm-divi-event-calendar-module' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'default_on_front' => 'left',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'organizer_thumbnail',
				'description'     => esc_html__( 'Choose to align the event featured image to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				'options_icon'    => 'module_align',
				//'mobile_options'  => true,
			),
			'organizer_thumbnail_margin' => array(
				'label' => esc_html__('Image Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => esc_html__('Adjust the spacing around the outside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'organizer_thumbnail',
				'mobile_options'  => true,
			),
			'organizer_thumbnail_padding' => array(
				'label' => esc_html__('Image Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => esc_html__('Adjust the spacing around the inside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'organizer_thumbnail',
				'mobile_options'  => true,
			),
			'organizer_thumbnail_width'  => array(
				'label'           => esc_html__( 'Image Width', 'decm-divi-event-calendar-module' ),
				'description' => esc_html__('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'organizer_thumbnail',
				//'mobile_options'  => true,
				'validate_unit'   => true,
				//'allowed_values'  => et_builder_get_acceptable_css_string_values( 'width' ),
				'default'         => '400px',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '1000',
					'step' => '1',
				),
				'allow_empty'     => true,
				'responsive'      => true,
				'mobile_options'  => true,
			),


			'venue_align' => array(
				'label'           => esc_html__( 'Image Alignment', 'decm-divi-event-calendar-module' ),
				'type'            => 'text_align',
				'option_category' => 'layout',
				'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
				'default_on_front' => 'left',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'venue_thumbnail',
				'description'     => esc_html__( 'Choose to align the event featured image to the left, center, or right.', 'decm-divi-event-calendar-module' ),
				'options_icon'    => 'module_align',
				//'mobile_options'  => true,
			),
			'venue_thumbnail_margin' => array(
				'label' => esc_html__('Image Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => esc_html__('Adjust the spacing around the outside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'venue_thumbnail',
				'mobile_options'  => true,
			),
			'venue_thumbnail_padding' => array(
				'label' => esc_html__('Image Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => esc_html__('Adjust the spacing around the inside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'venue_thumbnail',
				'mobile_options'  => true,
			),
			

			'venue_thumbnail_width'  => array(
				'label'           => esc_html__( 'Image Width', 'decm-divi-event-calendar-module' ),
				'description' => esc_html__('Manually set a fixed width for the event featured image.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'venue_thumbnail',
				//'mobile_options'  => true,
				'validate_unit'   => true,
				//'allowed_values'  => et_builder_get_acceptable_css_string_values( 'width' ),
				'default'         => '400px',
				'default_unit'    => 'px',
				'range_settings'  => array(
					'min'  => '0',
					'max'  => '1000',
					'step' => '1',
				),
				'allow_empty'     => true,
				'responsive'      => true,
				'mobile_options'  => true,
			),

			  'button_align'=> array(
				  'label'				=> esc_html__( 'Align To Bottom', 'decm-divi-event-calendar-module' ),
				  'type'				=> 'hidden',
				  'option_category'	=> 'view_more',
				  'options'			 => array(
					  'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					  'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				  ),
				  'description'		=> esc_html__( 'Choose to align the button to the bottom.', 'decm-divi-event-calendar-module' ),
				  'tab_slug'		  => 'advanced',
				 // 'mobile_options'  => true,
				  'toggle_slug'     => 'event',
				  'default'			=> 'off',
				  
				  'computed_affects'   => array(
					  '__getEvents',
				  ),
			  ),

			//   ),
			  'add_to_calendar_text' => array(
				'label'           => __( 'Add To Calendar Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Add To Calendar', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_link',
			),
			'virtual_event_button_text' => array(
				'label'           => __( 'Virtual Event Button Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Watch Now', 'decm-divi-event-calendar-module' ),	
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'virtual_event',
			),
			'add_to_calendar_icons_list' => array(
				'label'           => esc_html__( 'Add To Calendar Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'hidden',
				'option_category' => 'basic_option',
				'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'     => 'calendar_link',
				'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
			),
			  'google_calendar_text' => array(
				  'label'           => __( 'Google Calendar Link Text', 'decm-divi-event-calendar-module' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'default'         => __( 'Google Calendar', 'decm-divi-event-calendar-module' ),
			  
				  'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				  'tab_slug'        => 'general',
				  'toggle_slug'     => 'calendar_link',
			  ),
			  'ical_text' => array(
				  'label'           => __( 'Apple Calendar Link Text', 'decm-divi-event-calendar-module' ),
				  'type'            => 'text',
				  'option_category' => 'configuration',
				  'default'         => __( 'Apple Calendar', 'decm-divi-event-calendar-module' ),
			  
				  'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				  'tab_slug'        => 'general',
				  'toggle_slug'     => 'calendar_link',
			  ),
			  'outlook_office_text' => array(
				'label'           => __( 'Outlook 360 Calendar Link Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Outlook 360', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_link',
			),

			'outlook_link_text' => array(
				'label'           => __( 'Outlook Live Calendar Link Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Outlook Live', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_link',
			),

			'export_link_text' => array(
				'label'           => __( 'Export .ics file Text', 'decm-divi-event-calendar-module' ),
				'type'            => 'text',
				'option_category' => 'configuration',
				'default'         => __( 'Export .ics file', 'decm-divi-event-calendar-module' ),
			
				'description'     => __( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'general',
				'toggle_slug'     => 'calendar_link',
			),

			'use_grayscale_filter'      => array(
				'label'            => esc_html__( 'Use Grayscale Filter', 'decm-divi-event-calendar-module' ),
				'description'      => esc_html__( 'Apply a grayscale filter to change the event location map to black and white.', 'decm-divi-event-calendar-module' ),
				'type'             => 'yes_no_button',
				'option_category'  => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'affects'          => array(
					'grayscale_filter_amount',
				),
				'tab_slug'         => 'advanced',
				'toggle_slug'      => 'child_filters_map',
				'default_on_front' => 'off',
			),
			'grayscale_filter_amount'   => array(
				'label'           => esc_html__( 'Grayscale Filter Amount (%)', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Adjust the grayscale filter to change the color saturation of the event location map.', 'decm-divi-event-calendar-module' ),
				'type'            => 'range',
				'default'         => '0',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'child_filters_map',
				'depends_show_if' => 'on',
				'unitless'        => false,
				//'mobile_options'  => true,
			),

			'map_width'   => array(
				'label'           => esc_html__( 'Map Width', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Adjust the width of the event map.', 'decm-divi-event-calendar-module' ),
				'type'            => 'range',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 100,
					'step' => 1,
				),
				'default'         => '100%',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				//'default_unit'    => 'px',
				'allow_empty'     => true,
				'responsive'      => true,
				'mobile_options'  => true,
				'default_unit'    => '%',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'child_filters_map',
				//'depends_show_if' => 'on',
				'unitless'        => false,
				//'mobile_options'  => true,
			),

			'map_height'   => array(
				'label'           => esc_html__( 'Map Height', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Adjust the height of the event map.', 'decm-divi-event-calendar-module' ),
				'type'            => 'range',
				'input_attrs' => array(
					'min'  => 0,
					'max'  => 350,
					'step' => 1,
				),
				'default'         => '350px',
				'validate_unit'   => true,
				'depends_show_if' => 'off',
				//'default_unit'    => 'px',
				'allow_empty'     => true,
				'responsive'      => true,
				'mobile_options'  => true,
				'default_unit'    => 'px',
				'option_category' => 'configuration',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'child_filters_map',
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
				'description'		=> esc_html__( 'Choose whether the custom single event page link opens in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => __( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => __( 'In A New Tab', 'decm-divi-event-calendar-module' ),
				],
				'computed_affects' => array(
					'__posts',
					'__getEvents',
				),
				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
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
				'default'			=> 'on',
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
			),

			// today add settings

			'organizer_email_linkable'=> array(
				'label'				=> esc_html__( 'Enable Organizer Email Address Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the organizer email addresses to link to their mailto URL.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'organizer_email'=>'on',
				)
			),

			'enable_organizer_website_linkable'=> array(
				'label'				=> esc_html__( 'Enable Organizer Website Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add a link to the organizer website.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					//'organizer_email'=>'on',
				)
			),

	
			'organizer_website_link_target' => array(
				'label'           => esc_html__( 'Organizer Website Link Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the organizer website link opens in the same window or a new tab.', 'decm-divi-event-calendar-module' ),
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


			'enable_venue_website_link'=> array(
				'label'				=> esc_html__( 'Enable Venue Website Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add a link to the venue website.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					// 'use_shortcode'=>'off',
					//'show_venue'=>"on",
				)
			),


			'venue_website_link_target' => array(
				'label'           => esc_html__( 'Venue Website Link Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the venue website link opens in the same window or a new tab.', 'decm-divi-event-calendar-module' ),
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
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
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
			),

		
			'enable_location_link'=> array(
				'label'				=> esc_html__( 'Enable Location Address Link', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to add links to the location venue address link.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'link_show',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					// 'use_shortcode'=>'off',
					'show_location'=>"on",
				)
			),
			'custom_location_link_target' => array(
				'label'           => esc_html__( 'Location Address Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the location venue address link open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
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
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_category'=>"on",
				)
			),


			'category_links_target' => array(
				'label'           => esc_html__( 'Category Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the category links open in the same window or a new tab.', 'decm-divi-event-calendar-module' ),
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
					'event_tag'=>'on',
				),
			),
			'custom_tag_link_target' => array(
				'label'           => esc_html__( 'Tag Links Target', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose whether the tag links open in the same window or new tab.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
				'option_category' => 'layout',
				'options'		=>[
					'_self'   => esc_html__( 'In The Same Window', 'decm-divi-event-calendar-module' ),
					'_blank'   => esc_html__( 'In A New Tab', 'decm-divi-event-calendar-module' ),
					
				  
				],

				'tab_slug'		  => 'general',
				//'mobile_options'  => true,
				'toggle_slug'     => 'link_show',
				 'default' => '_self',
				 'show_if'=> array(
					'enable_tag_links'=>'on',
					'event_tag'=>'on',
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
		  return json_encode($escapedHtmlAttr); //phpcs:ignore WordPress.WP.AlternativeFunctions.json_encode_json_encode
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
	  
	  public function render( $attrs, $content , $render_slug ) {
		//   echo '<pre>';
		//   print_r($this->props);
		//   echo '</pre>';
		//  exit;
		  $atts = array();
		  $use_shortcode = $this->props['use_shortcode'];
		  $shortcode_param = $this->props['shortcode_param'];
		  $show_feature_image = $this->props['show_feature_image'];
		  $show_title = $this->props['show_title'];
		  $show_name = $this->props['show_name'];
		  $enable_organizer_link = $this->props['enable_organizer_link'];
		  $enable_series_link= $this->props['enable_series_link'];
		  $custom_series_link_target = $this->props['custom_series_link_target'];
		  $enable_organizer_website_linkable = $this->props['enable_organizer_website_linkable'];
		  $custom_organizer_link_target = $this->props['custom_organizer_link_target'];
		  $show_price = $this->props['show_price'];
		  $show_price_ticket = $this->props['show_price_ticket'];  
		  $show_rsvp_feed = $this->props['show_rsvp_feed'];
		  $show_weburl = $this->props['show_weburl'];	
		  $show_date = $this->props['show_date'];
          $show_organizer_feature_image = $this->props['show_organizer_feature_image'];
		  $show_venue_feature_image = $this->props['show_venue_feature_image'];
		  $show_time = $this->props['show_time'];
		  $show_end_date = $this->props['show_end_date'];	  
		  $show_end_time = $this->props['show_end_time'];
		  $show_timezone = $this->props['show_timezone'];
		  $show_timezone_abb = $this->props['show_timezone_abb'];
		  $googlemap      = $this->props['googlemap'];
		  $zoom_link      = $this->props['zoom_link'];
		  $webex_link	 = $this->props['webex_link'];
		  $facebook_link=$this->props['facebook_link'];
		  $youtube_link=$this->props['youtube_link'];
		  $description    = $this->props['description'];
		  $show_venue = $this->props['show_venue'];
		  $enable_venue_link = $this->props['enable_venue_link'];
		  $enable_venue_website_link = $this->props['enable_venue_website_link'];	  
		  $custom_venue_link_target = $this->props['custom_venue_link_target'];
		  $enable_location_link = $this->props['enable_location_link'];
		  $custom_location_link_target = $this->props['custom_location_link_target'];	
		 // today add settings 
		  $enable_tag_links = $this->props['enable_tag_links'];	
		  $custom_tag_link_target= $this->props['custom_tag_link_target'];
		  $category_link_target = $this->props['category_links_target'];
		  $venue_website_link_target = $this->props['venue_website_link_target'];
		  $organizer_website_link_target = $this->props['organizer_website_link_target'];

		  $google_link = $this->props['google_link'];
		  $venue_phone = $this->props['venue_phone'];
		  $venue_weburl = $this->props['venue_weburl'];
		  $show_location = $this->props['show_location'];

		  $show_street = $this->props['show_street'];
		  $show_locality = $this->props['show_locality'];
		  $show_location_state = $this->props['show_location_state'];
		  $show_postal = $this->props['show_postal'];
		  $show_country = $this->props['show_country'];
		  $show_street_comma = $this->props['show_street_comma'];
		  $show_locality_comma = $this->props['show_locality_comma'];
		  $show_location_state_comma = $this->props['show_location_state_comma'];
		  $show_postal_comma = $this->props['show_postal_comma'];
		  $show_country_comma = $this->props['show_country_comma'];
		  $show_postal_code_before_locality= $this->props['show_postal_code_before_locality'];
		  $organizer_phone = $this->props['organizer_phone'];
		  $organizer_email = $this->props['organizer_email'];
		  $organizer_email_linkable = $this->props['organizer_email_linkable'];
		  $organizer_weburl = $this->props['organizer_weburl'];
		  $show_excerpt = $this->props['show_excerpt'];
		  $show_category = $this->props['show_category'];
		  $category_detail_label = $this->props['category_detail_label'];
		  $time_detail_label = $this->props['details_time_label'];
		  $date_detail_label = $this->props['date_detail_label'];
		  $venue_detail_label = $this->props['venue_detail_label'];
		  $venue_google_map_label = $this->props['venue_google_map_label'];
		  $venue_phone_label = $this->props['venue_phone_label'];
		  $venue_website_label = $this->props['venue_website_label'];
		  $location_detail_label = $this->props['location_detail_label'];
	      $organizer_detail_label = $this->props['organizer_detail_label'];
		  $organizer_phone_label = $this->props['organizer_phone_label'];
		  $organizer_email_label = $this->props['organizer_email_label'];
		  $organizer_website_label = $this->props['organizer_website_label'];
		  $price_detail_label = $this->props['price_detail_label'];
		  $price_ticket_label = $this->props['price_ticket_label'];
		  $rsvp_detail_label = $this->props['rsvp_detail_label'];
		  $show_rsvp_feed_respond = $this->props['show_rsvp_feed_respond'];
		  $show_rsvp_feed_left = $this->props['show_rsvp_feed_left'];
		  $show_ticket_feed_respond = $this->props['show_ticket_feed_respond'];
		  $show_ticket_feed_left = $this->props['show_ticket_feed_left'];	  
		  $tag_detail_label = $this->props['tag_detail_label'];
		  $hide_comma_tag = $this->props['hide_comma_tag'];
		  $hide_comma_cat = $this->props['hide_comma_cat'];
	      $website_detail_label = $this->props['website_detail_label'];
		  $event_series_custom_label = $this->props['event_series_custom_label'];	  
		  $enable_category_link= $this->props['enable_category_link'];
		  $event_tag = $this->props['event_tag'];
		  $show_add_calendar_button = $this->props['show_add_calendar_button'];
		  $show_ical_export=$this->props['show_ical_export'];
		  $show_google_calendar=$this->props['show_google_calendar'];
		  $show_outlook_link= $this->props['show_outlook_link'];
		  $show_export_link = $this->props['show_export_link'];
		  $show_outlook_360= $this->props['show_outlook_360'];
		  $show_detail = $this->props['show_detail'];
		  $google_api_key_customize = $this->props['google_api_key_customize'];
		  $add_url =$this->props['add_url'];
		  $website_link = $this->props['website_link'];
		  $custom_website_link_text = $this->props['custom_website_link_text'];
		  $custom_website_link_target = $this->props['custom_website_link_target'];
		  $past_event_message_background_color=$this->props['past_event_message_background_color'];
		  $event_status_background_color= $this->props['event_status_background_color'];
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
		  $show_past = $this->props['show_past'];
		  $show_data_one_line = $this->props['show_data_one_line'];
		  $show_colon = $this->props['show_colon'];
		  $event_count = $this->props['event_count'];
		  $included_categories = $this->props['included_categories'];
		  $date_format = $this->props['date_format'];
		  $time_format = $this->props['time_format'];
		  //'time_format',
		  $excerpt_length = $this->props['excerpt_length'];
		  $blog_offset = $this->props['blog_offset'];
		  $event_status_notice=$this->props['event_status_notice'];
		  $event_virtual_hybrid_notice=$this->props['event_virtual_hybrid_notice'];
		  $event_status_reason=$this->props['event_status_reason'];
		  $event_series_name = $this->props['event_series_name'];
		  $event_series_label = $this->props['event_series_label'];
		  $event_series_icon = $this->props['event_series_icon'];
		  // $layout = $this->props['layout'];
		  $layout = '';
		  //$columns_phone = $this->props['columns_phone'];
		  $columns_tablet = '';
		  $Column_Type = $this->props['columns'] == '' ? 1 : $this->props['columns'];
		  $image_align = $this->props['image_align'];
		  $button_align = $this->props['button_align'];
		  $cards_spacing = $this->props['cards_spacing'];
		  $event_inner_spacing = $this->props['event_inner_spacing'];
		  $view_more_text = $this->props['view_more_text'];
		 // $ajax_load_more_text = $this->props['ajax_load_more_text'];
		  $add_to_calendar_text =$this->props['add_to_calendar_text'];
		  $virtual_event_button_text=$this->props['virtual_event_button_text'];
		  $ical_text = $this->props['ical_text'];
		  $export_link_text  = $this->props['export_link_text'];
		  $google_calendar_text = $this->props['google_calendar_text'];
		  $outlook_link_text= $this->props['outlook_link_text'];
		  $outlook_office_text= $this->props['outlook_office_text'];
		 // $show_pagination = $this->props['show_pagination'];
		  $background_color                = $this->props['background_color'];
		  $show_preposition = $this->props['show_preposition'];
		  $use_current_loop = $this->props['use_current_loop'] ;
		//  $pagination_type  = $this->props['pagination_type'];
		  $align            = $this->props['align'];
		  $organizer_align  = $this->props['organizer_align'];
		  $venue_align  = $this->props['venue_align'];
		  $show_icon_label = $this->props['show_icon_label'];
		  $stack_label_icon = $this->props[ 'stack_label_icon'];
		  $use_grayscale_filter = $this->props['use_grayscale_filter'];
		  $grayscale_filter_amount= $this->props['grayscale_filter_amount'];
		  $map_width= $this->props['map_width'];
		  $map_height= $this->props['map_height'];

		  
		  $Show_description_placeholder = $this->props['Show_description_placeholder'];
	
		//  $custom_icon_add_calendar_values              = et_pb_responsive_options()->get_property_values( $this->props, 'add_to_calendar_button_icon' );
		  $custom_icon_add_calendar_array  =  $this->props['add_to_calendar_button_icon'] != "" ? $this->props['add_to_calendar_button_icon'] : '';
		  $custom_icon_add_calendar_phone_array  =  $this->props['add_to_calendar_button_icon_phone'] != "" ? $this->props['add_to_calendar_button_icon_phone'] : '';
		  $custom_icon_add_calendar_tablet_array  =  $this->props['add_to_calendar_button_icon_tablet'] != "" ? $this->props['add_to_calendar_button_icon_tablet'] : '';
		  $custom_icon_add_calendar = explode("|",$custom_icon_add_calendar_array);
		  $custom_icon_add_calendar_phone = explode("|",$custom_icon_add_calendar_phone_array);
		  $custom_icon_add_calendar_tablet = explode("|",$custom_icon_add_calendar_tablet_array);

		  $custom_icon_virtual_event_array  =  $this->props['virtual_event_button_icon'] != "" ? $this->props['virtual_event_button_icon'] : '';
		  $custom_icon_virtual_event_phone_array  =  $this->props['virtual_event_button_icon_phone'] != "" ? $this->props['virtual_event_button_icon_phone'] : '';
		  $custom_icon_virtual_event_tablet_array  =  $this->props['virtual_event_button_icon_tablet'] != "" ? $this->props['virtual_event_button_icon_tablet'] : '';
		  $custom_icon_virtual_event = explode("|",$custom_icon_virtual_event_array);
		  $custom_icon_virtual_event_phone = explode("|",$custom_icon_virtual_event_phone_array);
		  $custom_icon_virtual_event_tablet = explode("|",$custom_icon_virtual_event_tablet_array);
		//   $custom_icon_add_calendar_tablet              = isset( $custom_icon_add_calendar_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_add_calendar_values['tablet'] ) ) : '';
		//   $custom_icon_add_calendar_phone               = isset( $custom_icon_add_calendar_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_add_calendar_values['phone'] ) ) : '';
		//   $custom_icon_add_calendar_values              = et_pb_responsive_options()->get_property_values( $this->props, 'add_to_calendar_button_icon' );
  
		  $background_layout               = '';
		  $background_layout_hover         = et_pb_hover_options()->get_value( 'background_layout', $this->props, 'light' );
		  $background_layout_hover_enabled = et_pb_hover_options()->is_enabled( 'background_layout', $this->props );
		  $use_background_color            = $this->props['use_background_color'];
		  $module_class = $this->module_classname( $render_slug );
		  $video_background = $this->video_background();
		  $parallax_image_background = $this->get_parallax_image_background();
		  
		  $data_background_layout       = '';
		  $data_background_layout_hover = '';
		  $thumbnail_width = $this->props['thumbnail_width'];
		  $organizer_thumbnail_width = $this->props['organizer_thumbnail_width'];
		  $venue_thumbnail_width = $this->props['venue_thumbnail_width'];
		  
		 
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
            'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a,%%order_class%% .ecs-venue-google-link a,%%order_class%% .ecs-organizer-weburl a,%%order_class%% .ecs-event-tag a,%%order_class%% .ecs-venue-weburl a,%%order_class%% .ecs-organizer-email a,%%order_class%% .ecs-venue a,%%order_class%% .ecs-organizer a,%%order_class%% span.decm_venue a,%%order_class%% span.decm_series_name a, %%order_class%% span.decm_location a, %%order_class%% span.decm_organizer_weburl a, %%order_class%% span.decm_venue_weburl a, %%order_class%% span.decm_organizer_email a, %%order_class%% span.decm_venue_google_link a , %%order_class%% .price_link_ticket, %%order_class%% .show_rsvp_feed_custom",
            'declaration' => "color: {$details_link_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a,%%order_class%% .ecs-venue-google-link a,%%order_class%% .ecs-organizer-weburl a,%%order_class%% .ecs-event-tag a,%%order_class%% .ecs-venue-weburl a,%%order_class%% .ecs-organizer-email a,%%order_class%% .ecs-venue a,%%order_class%% .ecs-organizer a,%%order_class%% span.decm_venue a,%%order_class%% span.decm_series_name a, %%order_class%% span.decm_location a, %%order_class%% span.decm_organizer_weburl a, %%order_class%% span.decm_venue_weburl a, %%order_class%% span.decm_organizer_email a, %%order_class%% span.decm_venue_google_link a , %%order_class%% .price_link_ticket, %%order_class%% .show_rsvp_feed_custom",
            'declaration' => "color: {$details_link_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a,%%order_class%% .ecs-venue-google-link a,%%order_class%% .ecs-organizer-weburl a,%%order_class%% .ecs-event-tag a,%%order_class%% .ecs-venue-weburl a,%%order_class%% .ecs-organizer-email a,%%order_class%% .ecs-venue a,%%order_class%% .ecs-organizer a,%%order_class%% span.decm_venue a,%%order_class%% span.decm_series_name a, %%order_class%% span.decm_location a, %%order_class%% span.decm_organizer_weburl a, %%order_class%% span.decm_venue_weburl a, %%order_class%% span.decm_organizer_email a, %%order_class%% span.decm_venue_google_link a , %%order_class%% .price_link_ticket, %%order_class%% .show_rsvp_feed_custom",
            'declaration' => "color: {$details_link_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before,%%order_class%% .diec-events-series-relationship-single-marker__icon:before, %%order_class%% .tags-ecs-icon::before",
            'declaration' => "color: {$details_icon_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before,%%order_class%% .diec-events-series-relationship-single-marker__icon:before, %%order_class%% .tags-ecs-icon::before",
            'declaration' => "color: {$details_icon_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before,%%order_class%% .diec-events-series-relationship-single-marker__icon:before, %%order_class%% .tags-ecs-icon::before",
            'declaration' => "color: {$details_icon_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		\ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before,%%order_class%% .diec-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before,%%order_class%% .diec-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
			'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before,%%order_class%% .organizer-email-ecs-icon:before,%%order_class%% .organizer-phone-ecs-icon:before,%%order_class%% .organizer-weburl-ecs-icon:before,%%order_class%% .venue-phone-ecs-icon:before,%%order_class%% .venue-weburl-ecs-icon:before,%%order_class%% .event-tag-ecs-icon:before,%%order_class%% .google-link-ecs-icon:before,%%order_class%% .diec-events-series-relationship-single-marker__icon:before",
            'declaration' => "font-size: {$details_icon_size_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);


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
		  if ( 'on' === $use_grayscale_filter ) {
		  if ( '' !== $grayscale_filter_amount ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .ecs_google_map",
				'declaration' =>'filter: grayscale('.$grayscale_filter_amount.'%);',
					
			) );
		}}
		if ( '' !== $past_event_message_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% div.tribe-events-notices',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $past_event_message_background_color)
				),
			) );
		}
		if ( '' !== $event_status_background_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => '%%order_class%% div.event_status_notice,%%order_class%% div.ecs_event_status_canceled,%%order_class%% div.ecs_event_status_postponed',
				'declaration' => sprintf(
					'background-color: %1$s !important;',
					esc_html( $event_status_background_color)
				),
			) );
		}
  
	
		  //Margin & Padding
		$this->apply_custom_margin_padding($render_slug, 'pass_event_message_margin', 'margin', 
		"%%order_class%% div.event_passed_notice");
		$this->apply_custom_margin_padding($render_slug, 'pass_event_message_padding', 'padding', 
		"%%order_class%% div.tribe-events-notices");
		$this->apply_custom_margin_padding($render_slug, 'event_status_margin', 'margin', 
		"%%order_class%% div.event_status_notice");
		$this->apply_custom_margin_padding($render_slug, 'event_status_padding', 'padding', 
		"%%order_class%% div.event_status_notice");
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_margin', 'margin', 
		'%%order_class%% img.wp-post-image');
		$this->apply_custom_margin_padding($render_slug, 'organizer_thumbnail_margin', 'margin', 
		'%%order_class%% img.wp-feature-organizer-image');
		$this->apply_custom_margin_padding($render_slug, 'organizer_thumbnail_padding', 'padding', 
		'%%order_class%% img.wp-feature-organizer-image ', false);
		$this->apply_custom_margin_padding($render_slug, 'venue_thumbnail_margin', 'margin', 
		'%%order_class%% img.wp-feature-venue-image');
		$this->apply_custom_margin_padding($render_slug, 'venue_thumbnail_padding', 'padding', 
		'%%order_class%% img.wp-feature-venue-image', false);
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_padding', 'padding', 
		'%%order_class%% img.wp-post-image', false);
		$this->apply_custom_width($render_slug, 'thumbnail_width', 'width', 
		'%%order_class%% img.wp-post-image');
		$this->apply_custom_width($render_slug, 'organizer_thumbnail_width', 'width', 
		'%%order_class%% img.wp-feature-organizer-image');
		$this->apply_custom_width($render_slug, 'venue_thumbnail_width', 'width', 
		'%%order_class%% img.wp-feature-venue-image');
		$this->apply_custom_margin_padding($render_slug, 'event_inner_spacing', 'padding', 
		" {$this->main_css_element} .ecs-event-list  .ecs-event .act-post .row");
  
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
			  	  
			  $contentorder = 'organizer_thumbnail, venue_thumbnail, title, title2, event_series_name, show_past_notification,description, date, venue, location, google_link, venue_phone, venue_weburl, organizer, organizer_phone, organizer_email, organizer_weburl, price, show_rsvp_feed , show_price_ticket,  categories,  event_tag, excerpt,weburl,addcalendarbutton,showcalendar,showical,showexport,showoutlook,zoom_link,youtube_link,facebook_link,googlemap,,showdetail';
			  if($image_align == 'rightimage_leftdetail')
			  $contentorder .= ',thumbnail';
			  else
			  $contentorder = 'thumbnail,'.$contentorder;
			  
			  $attr = array(
				  'cat' => $included_categories,
				  'month' => '',
				  'limit' => $event_count,
				  'zoom_link'=>$zoom_link=='on'?'true':'false',
				  'webex_link'=>$webex_link=='on'?'true':'false',
				  'facebook_link'=>$facebook_link=="on"?'true':'false',
				  'youtube_link'=>$youtube_link =="on"?'true':'false',
				  'eventdetails' => $show_date == 'on' ? 'true' : 'false',
				 // 'show_organizer_feature_image' => $show_organizer_feature_image == 'on' ? 'true' : 'false',
				//  'show_venue_feature_image'  => $show_venue_feature_image == 'on' ? 'true' : 'false',
				  'showtime' => $show_time == 'on' ? 'true' : 'false',
				  'show_end_date'=>$show_end_date == 'on'?'true':'false', 
				  'show_end_time'=>$show_end_time == 'on'?'true':'false',
				  'show_timezone' =>$show_timezone == 'on' ? 'true' : 'false',
				  'show_timezone_abb'=>$show_timezone_abb == 'on' ? 'true' : 'false',
				  'showtitle' => $show_title == 'on' ? 'true' : 'false',
				  'googlemap' => ($googlemap == 'on' ? 'true' : 'false'),
				  'description' => ($description == 'on' ? 'true' : 'false'),
				  'time' => null,
				  'event_status_notice' => $event_status_notice == 'on' ? 'true' : 'false',
				  'event_virtual_hybrid_notice' => $event_virtual_hybrid_notice == 'on' ? 'true' : 'false',
				  'event_status_reason' => $event_status_reason == 'on' ? 'true' : 'false', 
				  'event_series_name' => $event_series_name =='on'? 'true':'false',
				  'event_series_label' => $event_series_label =='on'? 'true':'false',
				  'event_series_icon' => $event_series_icon =='on'? 'true':'false',
				  'past' => ($show_past === 'on' ? 'yes' : ''),
				  'venue' => ($show_venue === 'on' ? 'true' : 'false'),
				  'enable_venue_link'=>($enable_venue_link == 'on' ? 'true':'false'),
				  'enable_venue_website_link' => ($enable_venue_website_link == 'on' ? 'true':'false'),
				  'custom_venue_link_target' => $custom_venue_link_target,
				  'enable_tag_links'=> ($enable_tag_links=='on'?'true':'false'),			
				  'custom_tag_link_target' => $custom_tag_link_target,
					// Today add settings
				  'category_link_target' => $category_link_target,
				  'venue_website_link_target' => $venue_website_link_target,
				  'organizer_website_link_target' => $organizer_website_link_target,
				  'enable_location_link'=> ($enable_location_link == 'on' ? 'true':'false'),
				  'custom_location_link_target'  => $custom_location_link_target,
				  'google_link'=> ($google_link === 'on' ? 'true' : 'false'),
				  'venue_phone'=> ($venue_phone === 'on' ? 'true' : 'false'),
				  'venue_weburl'=> ($venue_weburl === 'on' ? 'true' : 'false'),
				  'location' => ($show_location === 'on' ? 'true' : 'false'),
				  'street' => ($show_street === 'on' ? 'true' : 'false'),
				  'locality' => ($show_locality === 'on' ? 'true' : 'false'),
				  'state'=>($show_location_state=="on"?'true':'false'), 
				  'postal' => ($show_postal === 'on' ? 'true' : 'false'),
				  'country' => ($show_country === 'on' ? 'true' : 'false'),
				  'street_comma' => ($show_street_comma === 'on' ? 'true' : 'false'),
				  'locality_comma' => ($show_locality_comma === 'on' ? 'true' : 'false'),
				  'state_comma'=>($show_location_state_comma=="on"?'true':'false'), 
				  'postal_comma' => ($show_postal_comma === 'on' ? 'true' : 'false'),
				  'country_comma' => ($show_country_comma === 'on' ? 'true' : 'false'),
				  'show_postal_code_before_locality'=>($show_postal_code_before_locality==="on"?'true':"false"),
				  'organizer' => $show_name == 'on' ? 'true' : 'false',
				  'enable_series_link'=>($enable_series_link == 'on' ? 'true':'false'),
				  'custom_series_link_target' => $custom_series_link_target,
				  'enable_organizer_link'=>($enable_organizer_link == 'on' ? 'true':'false'),
				  'enable_organizer_website_linkable' => ($enable_organizer_website_linkable == 'on' ? 'true':'false'),
				  'custom_organizer_link_target' => $custom_organizer_link_target,
				  'organizer_phone'=> ($organizer_phone === 'on' ? 'true' : 'false'),
				  'organizer_email'=> ($organizer_email === 'on' ? 'true' : 'false'),
				  'organizer_email_linkable'=>($organizer_email_linkable === 'on'? 'true':'false'),
				  'organizer_weburl'=> ($organizer_weburl === 'on' ? 'true' : 'false'),
				  'price' => $show_price == 'on' ? 'true' : 'false',
				  'show_price_ticket' => $show_price_ticket == 'on' ? 'true' : 'false',
				  'show_rsvp_feed' => $show_rsvp_feed == 'on' ? 'true' : 'false',
				  'weburl' => $show_weburl == 'on' ? 'true' : 'false',
				  'website_link'=> $website_link,
				  'custom_website_link_text'=>$custom_website_link_text,
				  'custom_website_link_target'=>$custom_website_link_target,
				  'categories' => $show_category == 'on' ? 'true' : 'false',
				  'category_detail_label' => $category_detail_label,
				  'time_detail_label' => $time_detail_label,
				  'date_detail_label' => $date_detail_label,
				  'venue_detail_label' => $venue_detail_label,
				  'venue_google_map_label' => $venue_google_map_label,
				  'venue_phone_label' => $venue_phone_label,
				  'venue_website_label' => $venue_website_label,
				  'location_detail_label' => $location_detail_label,
			      'organizer_detail_label' => $organizer_detail_label,
				  'organizer_phone_label' => $organizer_phone_label,
				  'organizer_email_label' => $organizer_email_label,
				  'organizer_website_label' => $organizer_website_label,
				  'price_detail_label' => $price_detail_label,
				  'price_ticket_label' => $price_ticket_label,
				  'rsvp_detail_label' => $rsvp_detail_label,
				  'show_rsvp_feed_respond' => $show_rsvp_feed_respond == 'on' ? 'true' : 'false',
				  'show_rsvp_feed_left' => $show_rsvp_feed_left == 'on' ? 'true' : 'false',
				  'show_ticket_feed_respond' => $show_ticket_feed_respond == 'on' ? 'true' : 'false',
				  'show_ticket_feed_left' => $show_ticket_feed_left == 'on' ? 'true' : 'false',
				  'tag_detail_label' => $tag_detail_label,
				  'hide_comma_tag' => ($hide_comma_tag  === 'on' ? 'true' : 'false'),
				  'hide_comma_cat' => ($hide_comma_cat  === 'on' ? 'true' : 'false'),
				  'website_detail_label'  => $website_detail_label,
				  'event_series_custom_label' => $event_series_custom_label,
				  'enable_category_link'=>($enable_category_link=="on"?'true':'false'),
				  'event_tag' =>($event_tag === 'on' ? 'true' : 'false'),
				  'button_align' => ($button_align === 'on' ? 'true' : 'false'),
				  'show_data_one_line' => ($show_data_one_line== 'on' ? 'true' : 'false'),
				  'stack_label_icon' => ($stack_label_icon=='on'? 'true':'false'), 
				  'show_colon'=>($show_colon=='on'?'true':'false'),
				  'show_preposition' => ($show_preposition== 'on' ? 'true' : 'false'),
				  'show_add_calendar_button' =>($show_add_calendar_button== 'on'?'true':'false'),
				  'show_ical_export'=>($show_ical_export == 'on'?'true':'false'),
				  'show_google_calendar'=>($show_google_calendar=='on'?'true':'false'),
				  'show_outlook_link'=>($show_outlook_link=='on'?'true':'false'),
				  'show_export_link'=>($show_export_link=='on'?'true':'false'),
				  'show_outlook_360'=>($show_outlook_360=='on'?'true':'false'),
				  'schema' => 'true',
				  'message' => 'This event has passed.',
				  'key' => 'End Date',
				  'order' => 'ASC',
				  'orderby' => 'meta_value',
				  'viewall' => 'false',
				  'excerpt' => ($show_excerpt === 'on' ? 
							  ($excerpt_length ? $excerpt_length : 'true' ):
							  'false'),
				  'showdetail' => ($show_detail === 'on' ? 'true' : 'false'),
				  'thumb' => ($show_feature_image === 'on' ? 'true' : 'false'),
				  'organizer_thumb' => ($show_organizer_feature_image === 'on' ? 'true' : 'false'),
				  'venue_thumb' => ($show_venue_feature_image === 'on' ? 'true' : 'false'),
				  'thumbsize' => $thumbnail_width,
				  'thumbsizeOrg' => $organizer_thumbnail_width,
				  'thumbsizeVenue' => $organizer_thumbnail_width,
				  'thumbwidth' => '400',
				  'thumbheight' => '400',
				  'contentorder' => apply_filters( 'decm_details_order', $contentorder, $atts ),
				  'event_tax' => '',
				  'blog_offset' => $blog_offset,
				  'dateformat' => $date_format,
				  'timeformat' => $time_format, 
				  'layout' => $layout,
				  'columns' => $Column_Type,
				  'cards_spacing' => $cards_spacing,
				  'image_align' => $image_align,
				  'button_align'=>$button_align,
				  'event_inner_spacing' => $event_inner_spacing,
				  'view_more_text' => $view_more_text,
				 // 'ajax_load_more_text'=>$ajax_load_more_text,
				  'add_to_calendar_text'=> $add_to_calendar_text,
				  'virtual_event_button_text'=> $virtual_event_button_text,
				  'google_calendar_text'=>$google_calendar_text,
				  'ical_text'          =>$ical_text,
				  'export_link_text'  => $export_link_text,
				  'outlook_link_text' => $outlook_link_text,
				  'outlook_office_text' => $outlook_office_text,
				  'open_toggle_background_color' => $open_toggle_background_color,
				  'details_link_color' =>  $details_link_color,
				  'details_icon_color' =>  $details_icon_color,
				  'details_label_color' =>  $details_label_color,
				  'grayscale_filter_amount' =>$grayscale_filter_amount,
				  'use_grayscale_filter'=>($use_grayscale_filter=='on'?'true':'false'),
				  'included_categories' => $included_categories,
				  'use_current_loop' => ($use_current_loop === 'on' ? 'true' : 'false'),
				  //'custom_icon' => $custom_icon,
				  'add_to_calendar_button_icon'=>$custom_icon_add_calendar[0],
				  'add_to_calendar_button_icon_tablet'=>$custom_icon_add_calendar_tablet[0],
				  'add_to_calendar_button_icon_phone'=>$custom_icon_add_calendar_phone[0],
				  'virtual_event_button_icon'=>$custom_icon_virtual_event[0],
				  'virtual_event_button_icon_tablet'=>$custom_icon_virtual_event_tablet[0],
				  'virtual_event_button_icon_phone'=>$custom_icon_virtual_event_phone[0],
				 // 'add_to_calendar_button_icon_font_weight'=>$custom_icon_add_calendar[4],
				  'custom_add_to_calendar_button' => $this->props['custom_add_to_calendar_button'],
				   'custom_virtual_event_button' => $this->props['custom_virtual_event_button'],
				   'align'           =>  $align,
				   'organizer_align'  =>  $organizer_align, 
				  'venue_align'     =>  $venue_align, 
				  'map_height' => $map_height,
				  'map_width' => $map_width,
				  'show_icon_label'=>$show_icon_label,
				  'google_api_key_customize' =>$google_api_key_customize,
				  'add_url' => $add_url,

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
  // print_r($agentBrowser);
  // exit;
		  if(strlen(strstr($agentBrowser,"safari")) > 0 ){      
			  $customCss .= '.row_equal{display:flexbox}';
		  }
  
		  if(strlen(strstr($agentBrowser,"chrome")) > 0){      
		  
			  $customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
		  }
		  if(strlen(strstr($agentBrowser,"firefox")) > 0){      
		  
			  $customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
		  }
		  $discard_passed_notice ='';
		  $discard_passed_notice='jQuery(\'.event_passed_notice:not(:first)\').remove()';
		  $Addlinebreak =  ' ';
		  $AddButtonBottom =  '';
		  //jQuery('.oneofthetwodivs').eq(1).remove();
		  if($button_align == 'on')
		  {
			  if($Column_Type == 4)
			  $AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"89.5%" });';
			  else if($Column_Type == 3)
			  $AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"92%" });';
			  else
			  $AddButtonBottom = 'jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"absolute","bottom":"10px","width":"94.7%" });';
		  }
		  $customCss.='</style>';
		  $AddCustomHeight = '';
		  if(($Column_Type == '2' || $Column_Type == 1) &&  $image_align != 'topimage_bottomdetail' && $image_align != 'centerimage_bottomdetail')
		  {
			  if($image_align == 'leftimage_rightdetail')
			  $AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',"100%");';
			  else
			  $AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').css(\'height\',"100%");';
		  }
		  else
		  {
			  if($show_feature_image == 'on')
			  {
				  $AddCustomHeight = 'var tempHeight = parseInt(column_height) - parseInt(jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').height());jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';		
			  }
			  else 
			  {
				  $AddCustomHeight = 'var tempHeight = parseInt(column_height);jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',tempHeight);';		
			  }
		  }
  
		  // print_r($pagination_type);
		  // exit;
  
			

		  return sprintf( '
				  %9$s<div%2$s class="%4$s %5$s">
					  %6$s
					  %7$s
					  <div class= "">
						  %1$s
					  </div>
					  </div>
					 
				  <script>
				  jQuery(document).ready(function(){
				  jQuery(\''.$renderClassName.' .diec_add_to_calendar\').click(function() { 
					event.preventDefault();
					jQuery(\''.$renderClassName.' .ecs-show_calendar\').css("display","inline");
					jQuery(\''.$renderClassName.' .ecs-showical-export\').css("display","inline");
					jQuery(\''.$renderClassName.' .ecs-export-ics\').css("display","inline");
					jQuery(\''.$renderClassName.' .ecs-showoutlook-link\').css("display","inline");
				});
				  '.$discard_passed_notice.'	  
				  var setHeightColumns = function(){ 
					var column_loop_row = 0;
					var column_height = 0;
					var ids = [];
					var total_Count = 0;
					var total_Events = jQuery(\'%13$s .ecs-event-posts\').length; 
					jQuery(\'%13$s .ecs-event-posts\').each(function(){
					++column_loop_row;
					++total_Count;
					var Event_id = jQuery(this).children(\'article\')[0].id;
					ids.push(Event_id);
					column_height = jQuery(this).find(\'#\'+Event_id).children(\'.row\').height() >= column_height ? jQuery(this).find(\'#\'+Event_id).children(\'.row\').height() : column_height;

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
				setTimeout(5000);
				jQuery(window).on(\'resize\',function(){
					var screenWidth = jQuery(this).width();
					if(screenWidth > 1199){
						
						if(document.readyState == \'complete\')
						setHeightColumns();
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
			  
			  
			  
			  , $this->decm_events_calender_gets( $attr)
			  , $this->module_id()
			  , $this->module_classname( $render_slug )
			  , et_core_esc_previously( $data_background_layout )
			  , et_core_esc_previously( $data_background_layout_hover )
			  , $parallax_image_background
			  , $video_background
			  , $Column_Type
			  , $customCss
			  , $AddCustomHeight
			  , $AddButtonBottom
			  , $Addlinebreak
			  , $renderClassName
			  , $setHeightFree
			  , $discard_passed_notice
		  );
	  }
  
  
  
	  /**
	   * Fetch and return required events.
	   * @param  array $atts 	shortcode attributes
	   * @return string 	shortcode output
	   */
  
	  
		  public function decm_events_calender_gets( $atts, $conditional_tags = array(), $current_page = array() ) {
			  global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
			  $post_type = get_post_type();

		  /**
		   * Check if events calendar plugin method exists
		   */
		  if ( !function_exists( 'tribe_get_events' ) ) {
			return 'Divi Events Calendar requires The Events Calendar to be installed and active.';
		}
  
		  $output = '';
	  
  $custom_icon='';
  $custom_icon_load='';
		  $atts = shortcode_atts( apply_filters( 'decm_events_atts', array(
			  'show_data_one_line'=> 'false',
			  'cat' => '',
			  'month' => '',
			  'limit' => 5,
			  'zoom_link'=>'',
			  'webex_link'=>'',
			  'facebook_link'=>'',
			  'youtube_link'=>'',
			  'stack_label_icon' => 'true',
			  'show_colon'=>'true',
			  'eventdetails' => 'true',
			  'venue_thumb' => 'true',
			  'organizer_thumb' => 'true',
			  'showtime' => 'true',
			  'show_end_time'=> 'true',
			  'show_end_date'=> 'true',
			  'show_timezone' => 'true',
			  'showtitle' => 'true',
			  'show_timezone_abb'=>'true',
			  'show_add_calendar_button'=>'true',
			  'show_ical_export'=>'true',
			  'show_google_calendar'=>'true',
			  'show_outlook_link'=>'true',
			  'show_export_link'=>'true',
			  'show_outlook_360' => 'true',
			  'googlemap'=>'true',
			  'zoom_link'=>'true',
			  'description'=>'true',
			  'time' => null,
			  'past' => '',
			  'event_status_notice'=>'true',
			  'event_virtual_hybrid_notice' => 'true',
			  'event_status_reason'=>'true',
			  'event_series_name'=>'true',
			  'event_series_label'=>'true',
			  'event_series_icon'=>'true',
			  'venue' => 'false',
			  'enable_venue_link'=>'true',
			  'enable_venue_website_link'=> 'true',
			  'enable_location_link' => 'true',
			  'custom_location_link_target' => '',
			  'custom_venue_link_target' => '',
			  'category_link_target' => '',
			  'venue_website_link_target' => '',
			  'enable_tag_links'=> '',			
			  'custom_tag_link_target' => '',
			  'organizer_website_link_target' => '',
			  'google_link'=>'false',
			  'venue_phone'=>'false',
			  'venue_weburl'=>'false',
			  'location' => 'false',
			  'street' => 'false',
			  'locality' => 'false',
			  'postal' => 'false',
			  'state'=>'flase',
			  'country' => 'false',
			  'street_comma' => 'false',
			  'locality_comma' => 'false',
			  'postal_comma' => 'false',
			  'state_comma'=>'false',
			  'country_comma' => 'false',
			  'show_postal_code_before_locality'=>'false',
			  'organizer' => null,
			  'enable_series_link'=>'true',
			  'custom_series_link_target' => '',
			  'enable_organizer_link'=>'true',
			  'enable_organizer_website_linkable'=>'true',
			  'custom_organizer_link_target' => '', 
			  'organizer_phone'=>'false',
			  'organizer_email'=>'false',
			  'organizer_email_linkable'=>'false',
			  'organizer_weburl'=>'false',
			  'price' => null,
			  'show_price_ticket' => null,
			  'show_rsvp_feed' => null,
			  'show_rsvp_feed_respond' => '',
			  'show_rsvp_feed_left' => '',
			  'show_ticket_feed_respond'  => '',
			  'show_ticket_feed_left'  => '',
			  'weburl' => null,
			  'website_link'=>'',
			  'custom_website_link_text'=>'',
			  'custom_website_link_target'=>'',
			  'categories' => 'false',
			  'category_detail_label' => '',
			  'time_detail_label' => '',
			  'date_detail_label'=> '',
			  'venue_detail_label' => '',
			  'venue_google_map_label' => '',
		      'venue_phone_label' => '',
			  'venue_website_label' => '',
			  'location_detail_label' => '',
			  'organizer_detail_label' => '',
		      'organizer_phone_label' => '',
			  'organizer_email_label' => '',
			  'organizer_website_label' => '',
			  'price_detail_label' => '',
			  'price_ticket_label'  => '',
			  'rsvp_detail_label' => '',
			  'tag_detail_label' => '',
			  'hide_comma_tag' => 'false',
			  'hide_comma_cat' => 'false',
			  'website_detail_label' => '',
			  'event_series_custom_label'  => '',
			  'enable_category_link'=>'true',
			  'event_tag' =>'false',
			  'schema' => 'true',
			  'message' => 'There are no upcoming %s at this time.',
			  'key' => 'End Date',
			  'order' => 'ASC',
			  'orderby' => 'startdate',
			  'viewall' => 'false',
			  'excerpt' => 'false',
			  'showdetail' => 'false',
			  'thumb' => 'false',
			  'thumbsize' => '',
			  'thumbsizeOrg' => '',
			  'thumbsizeVenue' => '',
			  'thumbwidth' => '400',
			  'thumbheight' => '400',
			  'contentorder' => apply_filters( 'decm_details_order', 'organizer_thumbnail, venue_thumbnail,thumbnail,title, title2, show_past_notification,description, event_series_name, date, venue, location, google_link, venue_phone, venue_weburl, organizer, organizer_phone, organizer_email, organizer_weburl,  categories, event_tag,  price , show_rsvp_feed , show_price_ticket, excerpt,weburl,googlemap,zoom_link, showdetail', $atts ),
			  'event_tax' => '',
			  'dateformat' => '',
			  'timeformat' => '',
			  'layout' => '',
			  'columns' => '',
			  'cards_spacing' => '',
			  'blog_offset' => '',
			  'button_align' => '',
			  'image_align' => '',
			  'event_inner_spacing' => '',
			  'view_more_text' => 'View More',
			  'open_toggle_background_color'=>'',
			  'details_link_color'=>'',
			  'details_icon_color'=>'',
			  'details_label_color'=>'',
			  'grayscale_filter_amount'=>'',
			  'use_grayscale_filter'=>'true',
			  'columns_phone' => '',
			  'columns_tablet' => '',
			  'act-view-more et_pb_button' => '',
			  'header_level' => '',
			  'included_categories' => '',
			  'show_preposition'=>'false',
			  'use_current_loop' => 'false',
			  'custom_icon' => $custom_icon,
			  'custom_icon_tablet' => '',
			  'custom_icon_phone' => '',
			  'custom_view_more' => '',
			  'view_more_on_hover'=>'',
			  'ajax_load_more_button_on_hover'=>'',
			  'view_more_icon_placement'=>'',
			  'ajax_load_more_button_icon_placement'=>'',
			  'ajax_load_more_button_icon' => $custom_icon_load,
			  'ajax_load_more_button_icon_tablet' => '',
			  'ajax_load_more_button_icon_phone' => '',
			  'add_to_calendar_button_icon'=>'',
			  'add_to_calendar_button_icon_tablet'=>'',
			  'add_to_calendar_button_icon_phone'=>'',
			  'add_to_calendar_button_icon_font_weight'=>'',
			  'custom_add_to_calendar_button'=>'',
			  'virtual_event_button_icon'=>'',
			  'virtual_event_button_icon_tablet'=>'',
			  'virtual_event_button_icon_phone'=>'',
			  'custom_virtual_event_button' => '',
			  'add_to_calendar_text'=>"Add To Calendar",
			  'virtual_event_button_text'=>"Watch",
			  'google_calendar_text'=>"Google Calendar",
			  'ical_text' =>"+ Ical Export",
			  'export_link_text' => "Export .ics file",
			  'outlook_link_text'=>" Outlook",
			  'outlook_office_text' =>" Outlook 360",
			//  'pagination_type'=> '',
			  'align'     => '',
			  'organizer_align'  =>  '', 
			  'venue_align'     =>  '',
			  'map_height'  => '',
			  'map_width'  => '',
			  'show_icon_label'=>'',
			  'google_api_key_customize'=>'',
			  'add_url'=>'',
			  
  
		  ), $atts ), $atts, 'decm-events-atts' );
  
	  
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
  
		  if ( $atts['time'] == 'past' || !empty( $atts['past'] ) ) {
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
		  $atts['meta_date'] = array(
			  array(
				  'key' => $atts['key'],
				  'value' => $meta_date_date,
				  'compare' => $meta_date_compare,
				  'type' => 'DATETIME'
			  )
		  );
		  
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
  
  
  
		  if($atts['past']== 'yes'){
			  $atts['order']="DESC";
		  }
		  else{
			  $atts['order']="ASC";
		  }
  
		  $atts = apply_filters( 'decm_event_calender_atts', $atts );
		  
  
		//   $cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
		//   $categslug = $cat_slug->slug;
		//   $categId = $cat_slug->term_id;


		  $categslug = '';
		  $categId = '';
		   $cat_slug = get_queried_object();
		   if ($cat_slug instanceof WP_Term && isset($cat_slug->slug) && isset($cat_slug->term_id)) {
			   $categslug = $cat_slug->slug;
			   $categId = $cat_slug->term_id;
		   }
  
  
		  $event_id = get_the_ID();
  
		  $args = apply_filters( 'decm_fetch_events_atts', array(
			//   'post_status' => 'publish',
			'post_status' => is_user_logged_in()?array( 'publish', 'private','draft'):'publish',
			  'posts_per_page' => $atts['limit'],
			  'tax_query'=> $atts['event_tax'],//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			  'order' => $atts['order'],
			  'offset' => $atts['blog_offset'],
			  'start_date'   => '1900-10-01 00:01',
			  'end_date'     => '3030-10-31 23:59',
			  'included_categories' => $atts['included_categories'],
			  
		  ), $atts );
		  

  
		  if($atts['use_current_loop'] == "true"){	
  
		  if($post_type == 'tribe_events'){
			  $args['ID'] = $event_id;
		  }
		  if($categslug){
			  $args['included_categories'] = $categslug;
			  unset($atts['event_tax']);
			  $atts['event_tax'][] = array(
				  'taxonomy' => 'tribe_events_cat',
				  'field' => 'term_id',
				  'terms' => $categId,
			  );
		  
			  $args['tax_query'] = $atts['event_tax'];//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		  }
	  }
	
	//    exit;
	  $max_page_find_args = $args;
	  if($atts['limit'] > 0){
		  $max_page_find_args['posts_per_page'] = -1;
		  $max_pages = ceil(count(tribe_get_events( $max_page_find_args ))/$atts['limit']);
	  }

		 $event_posts = tribe_get_events( $args );
		 $event_posts = apply_filters( 'decm_events_posts_fetch', $event_posts, $atts );
  
		  if ( $event_posts or apply_filters( 'decm_events_posts', false, $atts ) ) {
				  
			  $output = apply_filters( 'decm_start_events', $output, $event_posts, $atts );
  
					  $excerptLength = '';
					  
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
  

					  
			  $output .= apply_filters( 'decm_eventss_div', '<div class=" append_events row_equal row ecs-event-list"' . 
					  ($atts['image_align'] == 'blog_layout' ? 'blog_layout': 'leftimage_rightdetail' ) . '">', $atts );
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
				  $category_names = array();
				  $featured_class = ( get_post_meta( $event_post->ID , '_tribe_featured', true ) ? ' ecs-featured-event' : '' );
				  if ( is_array( $category_list ) ) {
					  foreach ( (array) $category_list as $category ) {
						  $category_slugs[] = ' ' . $category->slug . '_ecs_category';
						  /**
						   * Show Categories of every events
						   *
						   * @author bojana
						   */
						  $category_names[] = $atts['enable_category_link']=="true"?'<a href="'.get_category_link( $category->term_id ).'" target="'.$atts['category_link_target'].'">'.$category->name.'</a>':$category->name;

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
				  
				  // style="'.$eventInnerStyle.'"
				  $unique_module_id = uniqid();
                  $id_event = 'event_article_' . $unique_module_id . '_' . $event_post->ID;
				  $event_output .= apply_filters( 'decm_events_start_tag', '<div class=" '.$columns_desktop.' '.$columns_tablet.' '.$columns_phone.' ecs-event ecs-event-posts clearfix' . implode( '', $category_slugs ) . $featured_class . apply_filters( 'decm_events_classes', '', $atts, $post ) . '" ><article id="event_article_'.$id_event.'" class="act-post et_pb_with_border"  ><div class="row"  > ', $atts, $post );
				//  $event_output .= apply_filters( 'decm_events_start_tag', '<div class=" '.$columns_desktop.' '.$columns_tablet.' '.$columns_phone.' ecs-event ecs-event-posts clearfix' . implode( '', $category_slugs ) . $featured_class . apply_filters( 'decm_events_classes', '', $atts, $post ) . '" ><article id="event_article_'.$event_post->ID.'" class="act-post et_pb_with_border"  ><div class="row"  > ', $atts, $post );
				  
				  // Put Values into $event_output
				  if ( self::isValid( $atts['thumb'] ) ){
						  
				  }
				  else{
  // 					$event_output .= '<div class="col-md-12">';
				  }
				  $image_center="";
				  if($atts['align']=="center"){
					  $image_center="decm-show-image-center";
				  }else if($atts['align']=="left"){
					  $image_center="decm-show-image-left";
				  }else if($atts['align']=="right"){
					  $image_center="decm-show-image-right";
				  }

				  $image_center_organizer="";
				  if($atts['organizer_align']=="center"){
					  $image_center_organizer="decm-show-image-center";
				  }else if($atts['organizer_align']=="left"){
					  $image_center_organizer="decm-show-image-left";
				  }else if($atts['organizer_align']=="right"){
					  $image_center_organizer="decm-show-image-right";
				  }

				  $image_center_venue="";
				  if($atts['venue_align']=="center"){
					  $image_center_venue="decm-show-image-center";
				  }else if($atts['venue_align']=="left"){
					  $image_center_venue="decm-show-image-left";
				  }else if($atts['venue_align']=="right"){
					  $image_center_venue="decm-show-image-right";
				  }


				 $classShowDataOneLine ='';
				 $classShowDataOneLine = $atts['show_data_one_line'] == 'true' ? ' decm-show-data-display-block ' : ' ';
				 $dateTimeSeparator=tribe_get_option( 'dateTimeSeparator', ' @ ' );
				 $timeRangeSeparator=tribe_get_option( 'timeRangeSeparator', ' - ' );
				 $timeRangeSeparatorEnd=$atts['show_end_time']=="true"?tribe_get_option( 'timeRangeSeparator', ' - ' ):"";	
				//  echo "<pre>";
				//  print_r((new Tribe\Events\Virtual\Event_Meta)->wp_oembed_get());
				 $virtual_event_object=	tribe_get_event($event_post->ID);
				// echo "<pre>";
				//  print_r( tribe_get_embedded_map($event_post->ID));
				//  print_r(get_post_meta( $event_post->ID));
				//  echo "</pre>";
				 $start_time='';
			   $end_time ='';
			   $set_timezone='';
			   $set_timezone=$atts['show_timezone']=='true'?$atts['show_timezone_abb']=='false'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):" ".Tribe__Events__Timezones::get_event_timezone_abbr( $event_post->ID ):"";
			   $start_time=$atts['timeformat']==''? tribe_get_start_time($event_post->ID,get_option( 'time_format' )):tribe_get_start_time($event_post->ID,$atts['timeformat']);  
			   $end_time=$atts['timeformat']==''? tribe_get_end_time($event_post->ID,get_option( 'time_format' )):tribe_get_end_time($event_post->ID,$atts['timeformat']);
			   $end_time=$atts['show_end_time']=="true"?$end_time.$set_timezone:((tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))?$end_time.$set_timezone:$set_timezone);

			   $start_date='';
			   $end_date ='';
			   $show_colon= $atts['show_colon']=="true"?":":"";
			  $start_date= $atts['dateformat']==""? tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' )):tribe_get_start_date( $event_post->ID,null,$atts['dateformat']);
			  $end_date=$atts['dateformat']==""?$timeRangeSeparator. tribe_get_end_date($event_post->ID,null, get_option( 'date_format' )):$timeRangeSeparator.tribe_get_end_date( $event_post->ID,null,$atts['dateformat']);  
			  $end_date=$atts['show_end_date']=="true"?$end_date:"";
			  $showicondate ="";
			  $showicontime="";
			  $showicon="";
			  $showlabel="";
			  $showlabeldate="";
			  $showlabeltime="";
			  $event_stutus_tag='';
			  //print_r(tribe_get_zip($event_post->ID)==null?"kk":"ll");
			  $dec_country_comma=$atts['country_comma'] == "true" && $atts['location'] == "true"?", ":" ";
			  $dec_locality_comma=$atts['locality_comma'] == "true" && $atts['location'] == "true"?", ":" ";
			  $dec_postal_code_comma=$atts['postal_comma'] == "true" && $atts['location'] == "true"?", ":" ";
			  $dec_street_comma=$atts['street_comma'] == "true" && $atts['location'] == "true"?", ":" ";
			  $dec_state_comma=$atts['state_comma'] == "true" && $atts['location'] == "true"?", ":" ";
			  $street=$atts['street']=="true" && $atts['location']=="true" && tribe_get_address($event_post->ID)!=null?tribe_get_address($event_post->ID).$dec_street_comma:"";
			  $locality=$atts['locality']=="true" && $atts['location']=="true" && tribe_get_city($event_post->ID)!=null?" ".tribe_get_city($event_post->ID).$dec_locality_comma:""; 
			  $postal=$atts['postal']=="true"&& $atts['location']=="true"&&$atts['show_postal_code_before_locality']=='false' &&  tribe_get_zip($event_post->ID)!=null?" ".tribe_get_zip($event_post->ID).$dec_postal_code_comma:""; 
			  $country=$atts['country']=="true" && $atts['location']=="true" && tribe_get_country($event_post->ID)!=null?" ".tribe_get_country($event_post->ID).$dec_country_comma:""; 
			  $state = $atts['state']=="true" && $atts['location'] == "true" &&tribe_get_province($event_post->ID)!=null?tribe_get_province($event_post->ID).$dec_state_comma:(($atts['state']=="true" && $atts['location'] == "true" &&tribe_get_region($event_post)!=null)?tribe_get_region($event_post).$dec_state_comma:"");
            //  $state=$atts['state']=='true'&&$atts['location']=='true'&&tribe_get_province($event_post->ID)!==null?" ".tribe_get_province($event_post->Id):"";
		      $show_postal_code_before_locality=$atts['show_postal_code_before_locality']=='true'&& $atts['postal'] == "true" && $atts['location'] == "true"&&tribe_get_zip($event_post->ID)!=null ? tribe_get_zip($event_post->ID).$dec_postal_code_comma:"";   
			  $time_custom_label = __('Time','decm-divi-event-calendar-module');
						if(!empty($atts['time_detail_label'])){
								$time_custom_label =  __($atts['time_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
						}

						$date_custom_label = __('Date','decm-divi-event-calendar-module');
						if(!empty($atts['date_detail_label'])){
								$date_custom_label =  __($atts['date_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
						}

			  $showlabeltime= ($atts['show_icon_label']=="label" || $atts['show_icon_label']=="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$time_custom_label.$show_colon." </span>":"";
			  $showlabeldate= ($atts['show_icon_label']=="label" || $atts['show_icon_label']=="label_icon") && $atts['show_data_one_line'] == 'true'?'<span class=ecs-detail-label>'.$date_custom_label.$show_colon." </span>":"";
			  $showicontime=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']=="icon") && $atts['show_data_one_line'] == 'true' ?"eventTime-ecs-icon":"";
			  $showicondate=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']=="icon") && $atts['show_data_one_line'] == 'true'?"eventDate-ecs-icon":"";
			  $stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
			  $custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];
			  $link_venue = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_venue_link($event_post->ID) ? tribe_get_venue_link($event_post->ID) : '', $result_venue);
			  $result_venue =  isset($result_venue['href'][0]) ? sanitize_text_field( wp_unslash($result_venue['href'][0]) ) : sanitize_text_field( wp_unslash("") );
			
			  $link_location = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_map_link_html($event_post->ID) ? tribe_get_map_link_html($event_post->ID) : '', $result_location);
			  $result_location =  isset($result_location['href'][0]) ? sanitize_text_field( wp_unslash($result_location['href'][0]) ) : sanitize_text_field( wp_unslash("") );
			  $link_venue_website = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_venue_website_link($event_post->ID) ? tribe_get_venue_website_link($event_post->ID) : '', $result_venue_website);
			  $result_venue_website =  isset($result_venue_website['href'][0]) ? sanitize_text_field( wp_unslash($result_venue_website['href'][0]) ) : sanitize_text_field( wp_unslash("") );
			  $organizer_website_link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_organizer_website_link($event_post->ID) ? tribe_get_organizer_website_link($event_post->ID) : '', $result_organizer_website_link);
			  $result_organizer_website_link =  isset($result_organizer_website_link['href'][0]) ? sanitize_text_field( wp_unslash($result_organizer_website_link['href'][0]) ) : sanitize_text_field( wp_unslash("") );

			 

			  $link_category = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_map_link_html($event_post->ID) ? tribe_get_map_link_html($event_post->ID) : '', $link_category);
			  $result_category_target =  isset($link_category['href'][0]) ? sanitize_text_field( wp_unslash($link_category['href'][0]) ) : sanitize_text_field( wp_unslash("") );

			  $link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_event_website_link($event_post->ID) ? tribe_get_event_website_link($event_post->ID) : '', $result);
			  $result =  isset($result['href'][0]) ? sanitize_text_field( wp_unslash($result['href'][0]) ) : sanitize_text_field( wp_unslash("") );
			  $organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;
//  print_r($atts['website_link']);
 //exit;
$get_end_time_offset=Tribe__Events__Timezones::event_end_timestamp( $event_post->ID);

$get_current_time_offset=strtotime( gmdate('Y-m-d H:i:s')) + get_option( 'gmt_offset' ) * 3600 ;

// echo '<pre>';
// print_r(tribe_get_full_address($event_post->ID));
if($get_end_time_offset < $get_current_time_offset) {
	?>
	<script>
	document.addEventListener("DOMContentLoaded", function(){
		jQuery(".append_events").addClass("ecs-is_past_event"); 
});
	</script>
	<?php

if($this->props['passed_event_notice'] == 'on'){
	$event_output .= apply_filters( 'dec_no_events_found_message','<div class="event_passed_notice"><div class="tribe-events-notices">'.sprintf(esc_html__('This event has passed.' , 'decm-divi-event-calendar-module' ).'</div></div>'), $atts );
}

}
// print_r(tec_event_series( $event_post->ID )->guid);


$event_virtual=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="virtual"?'
<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--virtual tribe-events-virtual-virtual-event__icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 16" style="font-size: 5px !important;margin: 0px !important;width: 24px;height: 12px;/* display: flex; */">
<g fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)">
<path d="M18 10.7333333c2.16-2.09999997 2.16-5.44444441 0-7.46666663M21.12 13.7666667c3.84-3.7333334 3.84-9.80000003 0-13.53333337M6 10.7333333C3.84 8.63333333 3.84 5.28888889 6 3.26666667M2.88 13.7666667C-.96 10.0333333-.96 3.96666667 2.88.23333333" class="tribe-common-c-svgicon__svg-stroke"></path><ellipse cx="12" cy="7" rx="2.4" ry="2.33333333" class="tribe-common-c-svgicon__svg-stroke"></ellipse></g></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'.__('Virtual Event','decm-divi-event-calendar-module').' </span>':"";
$event_hybrid=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="hybrid"?'
<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--hybrid tribe-events-virtual-hybrid-event__icon-svg" viewBox="0 0 15 13" fill="none" style="width: 24px;height: 12px;" xmlns="http://www.w3.org/2000/svg">
<circle cx="3.661" cy="9.515" r="2.121" transform="rotate(-45 3.661 9.515)" stroke="#0F0F30" stroke-width="1.103"></circle><circle cx="7.54" cy="3.515" r="2.121" transform="rotate(-45 7.54 3.515)" stroke="#0F0F30" stroke-width="1.103"></circle>
<path d="M4.54 7.929l1.964-2.828" stroke="#0F0F30"></path><circle r="2.121" transform="scale(-1 1) rotate(-45 5.769 18.558)" stroke="#0F0F30" stroke-width="1.103"></circle>
<path d="M10.554 7.929L8.59 5.1" stroke="#0F0F30"></path></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'.__(' Hybrid Event','decm-divi-event-calendar-module').' </span>':"";


$event_virtual_hybrid_notice_tag = $atts['event_virtual_hybrid_notice']=='true' && tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true) ?'<div  class="ecs_event_status_virtual_hybrid">'.$event_virtual.$event_hybrid.' </div>':"";
//echo $event_virtual_hybrid_notice_tag;

//print_r($atts['event_status_notice']);
//$event_stutus_tag = $atts['event_status_notice']=='true' && tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<div  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'">'.__(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true),'decm-divi-event-calendar-module').' </div>':"";
    if(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)=="canceled" && $atts['event_status_notice']=='true'){
	    $event_stutus_tag = $atts['event_status_notice']=='true' && tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<div  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'">'.__('canceled','decm-divi-event-calendar-module').' </div>':"";
	}
	
	if(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)=="postponed" && $atts['event_status_notice']=='true'){
		$event_stutus_tag = $atts['event_status_notice']=='true' && tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<div  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'">'.__('postponed','decm-divi-event-calendar-module').' </div>':"";
    }

$event_status_reason=$atts['event_status_reason']=='true' && tribe_get_event_meta($event_post->ID,'_tribe_events_status_reason', true)?'<div  class="ecs_event_status_reason">'.tribe_get_event_meta($event_post->ID,'_tribe_events_status_reason', true).' </div>':"";
if($atts['event_status_notice']=='true' || $atts['event_status_reason']=='true'|| tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)){
	$event_output .= apply_filters( 'decm_eventss_status','<div class="event_status_notices">'.$event_stutus_tag.$event_status_reason.$event_virtual_hybrid_notice_tag.'</div>', $atts );
//	$event_output .= apply_filters( 'decm_events_status_reason','<div class="event_passed_notice">'.$event_stutus_tag.'</div>', $atts );
}

// print_r(tribe_get_object($event_post->ID));
//echo $event_stutus_tag;

			  if ( !empty( $atts['dateformat'] ) ) {
  
				  $showdate=setDateFormat($atts['dateformat']);
				  
			  }
			  else{
				  $showdate = get_option('date_format');
			  }
				  foreach ( apply_filters( 'decm_events_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					  
					  switch ( trim( $contentorder ) ) {
						  
						  case 'title':
							  if ( self::isValid( $atts['showtitle'] ) ) {
							  $event_output .= '<div class="col-md-'.(($atts['columns'] > 2 ? '12' : $atts['image_align'] == 'topimage_bottomdetail' || $atts['image_align'] == 'centerimage_bottomdetail' || $atts['thumb'] == 'false') ? '12' : '8').'">'.apply_filters( 'decm_events_details_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'decm_events_list_title_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'decm_events_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
							  }	
							  else{
								  $event_output .= '<div class="col-md-'.(($atts['columns'] > 2 ? '12' : $atts['image_align'] == 'topimage_bottomdetail' || $atts['image_align'] == 'centerimage_bottomdetail' || $atts['thumb'] == 'false') ? '12' : '8').'">';
							  }
						  break;
						  
						  case 'title2':
							  $event_output .= apply_filters( 'decm_events_details_start', '<h4 class="entry-title title2 summary">', $atts, $event_post ) .
											  apply_filters( 'decm_events_list_title_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', get_the_title($event_post->ID), $atts, $event_post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .
										 apply_filters( 'decm_events_title_tag_end', '</h4>', $atts, $event_post );
							  break;

							  case 'description':
								$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['description'])) {
								$event_output .= apply_filters( 'decm_events_details_start', '<div class="ecs-event-description">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_title_link_start',preg_replace('/\[\/?et_pb.*?\]/', '',tribe_get_the_content($event_post->ID,$strip_teaser = true)), $atts, $event_post ) .
										   apply_filters( 'decm_events_title_tag_end', '</div>', $atts, $event_post );
								}
								
								break;

								case 'event_series_name':
									global $post;
									$url = $post->guid;	
									preg_match("/&?p=([^&]+)/", $url, $matches);
								  //  $series_id = $matches[1]; 
									if(!empty($matches[1])){
										$series_id = $matches[1]; 
									}else{
										$series_id = $event_post->ID;
									}
								    if( function_exists("tec_event_series") && !empty(tec_event_series(  $series_id ))) {

										$series_custom_label = __('Event Series','decm-divi-event-calendar-module');
										if(!empty($atts['event_series_custom_label'])){
											$series_custom_label =  __($atts['event_series_custom_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
										$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? 'diec-events-series-relationship-single-marker__icon': '';
										$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ? '<span class="ecs-detail-label">'.$series_custom_label.$show_colon.'</span>':"";
										$stacklabel = $atts['stack_label_icon']==='true'?"<br>":"";
										$enable_series_link=$atts['enable_series_link']=='true'? '<a href="'.tec_event_series(  $series_id )->guid.'" class="diec-events-series-relationship-single-marker__title tribe-common-cta--alt" target="'.$atts['custom_series_link_target'].'"><span class="diec_series_marker__title">'.tec_event_series(  $series_id )->post_title.'</span></a>':'<span class="diec_series_marker__title">'.tec_event_series(  $series_id )->post_title.'</span>';
										// $enable_series_label = $atts['event_series_label']=='true'? '<span class="diec-events-series-relationship-single-marker__prefix">Event Series:	</span>' : '';
										// $enable_series_icon = $atts['event_series_icon']=='true'? '<span class="diec-events-series-relationship-single-marker__icon">&#xe025;</span>': '';
									if($atts['event_series_name']=='true' && !empty(tec_event_series(  $series_id )->post_title)){
										//$event_output .=  '<div>'.$showicon.$showlabel.$stacklabel.$enable_series_link.'</div>';
								
										$event_output .= apply_filters( 'decm_events_details_start', '<span class="'.$classShowDataOneLine.' '.$showicon.'">', $atts, $event_post ) .
														apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel." ".'<span class="decm_series_name">'.$enable_series_link, $atts, $event_post ) .
														apply_filters( 'decm_events_title_tag_end', '</span></span>', $atts, $event_post );
									// $event_output .='<div class="diec-events-series-relationship-single-marker tribe-common"><em class="diec-events-series-relationship-single-marker__icon" aria-label="Event Series:" title="Event Series:">	
									// <svg class="diec-common-c-svgicon tribe-common-c-svgicon--series tribe-events-series-relationship-single-marker__icon-svg" width="14" height="12" viewBox="0 0 14 12" fill="none" xmlns="http://www.w3.org/2000/svg">
									// 	<title>Event Series</title><rect x="0.5" y="4.5" width="9" height="7"></rect><path d="M2 2.5H11.5V10"></path><path d="M4 0.5H13.5V8"></path></svg></em><span class="diec-events-series-relationship-single-marker__prefix">Event Series:	</span>
									// '.$enable_series_link.'</div>';
									}
									}
									break;
								
						  /**
						   * Show Author Name of every events
						   *
						   * @author bojana
						   */

						   case 'organizer':
							if ( self::isValid( $atts['organizer'] ) ) {
								if(tribe_get_organizer($event_post->ID) != null){
									
								$showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"organizer-ecs-icon":"";
								$organizer_custom_label = __('Organizer','decm-divi-event-calendar-module');
								if(!empty($atts['organizer_detail_label'])){
												$organizer_custom_label =  __($atts['organizer_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
								}
								$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$organizer_custom_label.$show_colon." </span>":"";
								$stacklabel = $atts['stack_label_icon']==='true'?"<br>":"";
								$organizers = tribe_get_organizer_ids($event_post->ID);
								$orgName = array();

								foreach ($organizers as $key => $organizerId) {
									
									$link_organizer = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_organizer_link($organizerId), $result_organizer);
									$result_organizer =  isset($result_organizer['href'][0]) ? sanitize_text_field( wp_unslash($result_organizer['href'][0]) ) : sanitize_text_field( wp_unslash("") );
									$orgName[$key] = $atts['enable_organizer_link']=="true"?'<a href="'.$result_organizer.'" target="'.$atts['custom_organizer_link_target'].'">'.tribe_get_organizer($organizerId).'</a>':tribe_get_organizer($organizerId);					
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
							  case 'organizer_phone':
								//$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['organizer_phone'])) {
									if(tribe_get_organizer_phone($event_post->ID)!=null){
											//	do_action( 'tribe_events_single_meta_organizer_section_start' );
			  
												// foreach ( $organizer_ids as $organizer ) {
												// 	if ( ! $organizer ) {
												// 		continue;
												// 	}
										$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"organizer-phone-ecs-icon":"";

										$organizer__phone_custom_label = __('Organizer Phone','decm-divi-event-calendar-module');
								if(!empty($atts['organizer_phone_label'])){
												$organizer__phone_custom_label =  __($atts['organizer_phone_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
								}
								$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$organizer__phone_custom_label.$show_colon." </span>":"";

										$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
										
								// $event_output .= apply_filters( 'decm_events_details_start', '<span class="'.$classShowDataOneLine.'ecs-organizer-phone '.$showicon.'">', $atts, $event_post ) .
								// 				apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel.'<span class="decm_organizer_phone">'. " ".tribe_get_organizer_phone($event_post->ID), $atts, $event_post ) .
								// 		   apply_filters( 'decm_events_title_tag_end', '</span></span>', $atts, $event_post );
							
								$phone_number = tribe_get_organizer_phone($event_post->ID);

								$event_output .= apply_filters('decm_events_title_details', '<span class="'.$classShowDataOneLine.' ecs-organizer-phone '.$showicon.'">', $atts, $event_post) .
									apply_filters('decm_organizer_phone_start', 
										$showlabel . $stacklabel . 
										'<span class="decm_organizer_phone">
											<span class="phone-number-desktop">' . $phone_number . '</span>
											<span class="phone-number-mobile"><a href="tel:' . $phone_number . '">' . $phone_number . '</a></span>
										</span>', 
										$atts, $event_post) .
									apply_filters('decm_organizer_phone_end', '</span></span>', $atts, $event_post);
								
							
							
							
										   //	}
							  //	if ( ! $multiple ) { 
							  //	}/
							}
							}
								break;
								case 'organizer_email':
									//$event_output .= '<div class="decm-show-detail-center">';
									if ( self::isValid( $atts['organizer_email'])) {
										if(tribe_get_organizer_email($event_post->ID)!=null){
											$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"organizer-email-ecs-icon":"";
											$organizer__email_custom_label = __('Organizer Email','decm-divi-event-calendar-module');
								if(!empty($atts['organizer_email_label'])){
												$organizer__email_custom_label =  __($atts['organizer_email_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
								}
								$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$organizer__email_custom_label.$show_colon." </span>":"";
											$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$event_output .= apply_filters( 'decm_events_details_start', '<span class="'.$classShowDataOneLine.'ecs-organizer-email '.$showicon.'">', $atts, $event_post ) .
													apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel. " ", $atts, $event_post ) .
													apply_filters( 'decm_events_list_title_link_start',$atts['organizer_email_linkable']=="true"?'<span class="decm_organizer_email"><a href="mailto:'.tribe_get_organizer_email($event_post->ID).'">'.tribe_get_organizer_email($event_post->ID).'</a>':'<span class="decm_organizer_email">'.tribe_get_organizer_email($event_post->ID), $atts, $event_post ) .
													apply_filters( 'decm_events_title_tag_end', '</span></span>', $atts, $event_post );
									}}
									break;
									case 'organizer_weburl':
										//$event_output .= '<div class="decm-show-detail-center">';
										if ( self::isValid( $atts['organizer_weburl'])) {
											if(tribe_get_organizer_website_link($event_post->ID)!=null){
												$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"organizer-weburl-ecs-icon":"";
												$organizer__website_custom_label = __('Organizer Website','decm-divi-event-calendar-module');
								               if(!empty($atts['organizer_website_label'])){
										       		$organizer__website_custom_label =  __($atts['organizer_website_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
								                }
							                 	$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$organizer__website_custom_label.$show_colon." </span>":"";
												$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
												$organizer_website = $atts['enable_organizer_website_linkable']=="true"?'<a href="'.$result_organizer_website_link.'" target="'.$atts['organizer_website_link_target'].'">'.__('View Organizer Website','decm-divi-event-calendar-module').'</a>':'<a>'.__('View Organizer Website','decm-divi-event-calendar-module').'</a>';					
												$event_output .= apply_filters( 'decm_events_details_start', '<span class="'.$classShowDataOneLine.'ecs-organizer-weburl '.$showicon.'">', $atts, $event_post ) .
														apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel. " ".'<span class="decm_organizer_weburl">'.$organizer_website, $atts, $event_post ) .
												   apply_filters( 'decm_events_title_tag_end', '</span></span>', $atts, $event_post );
										}}
										break;
										case 'categories':
											if ( self::isValid( $atts['categories'] ) ) {
											//	$categories = implode(', ', $category_names);
												$categories = $atts['hide_comma_cat'] == 'false' ? implode(", ", $category_names): implode(" ", $category_names);
												$categories_separator = $categories ? ' | ' : '';
											if(et_core_esc_wp( $categories )!=null){
												$category_custom_label = __('Category','decm-divi-event-calendar-module');
												if(!empty($atts['category_detail_label'])){
													$category_custom_label =  __($atts['category_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
												}
											  $showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"categories-ecs-icon":"";
											  $showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$category_custom_label.$show_colon." </span>":"";
											  $stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
												$event_output .= apply_filters( 'decm_events_categories_tag_start', '<span class="'.$classShowDataOneLine.'ecs-categories '.$showicon.'">', $atts, $event_post ) .
															et_core_intentionally_unescaped($showlabel.$stacklabel. ($atts['show_preposition'] == 'true' ? $categories_separator  : " "), 'fixed_string' ) .
															apply_filters( 'decm_events_categories', et_core_esc_wp( $categories ), 
															$atts, $event_post, $excerptLength ) .
															apply_filters( 'decm_events_categories_tag_end', '</span>', $atts, $event_post );
											}
											else{}
										}
											
											$event_output.='</div>';
											break;
										case 'event_tag':
											//$event_output .= '<div class="decm-show-detail-center">';
											if ( self::isValid( $atts['event_tag'])) {

										// $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
										$tags = $atts['hide_comma_tag'] == 'false' ? implode(", ", $tag_names): implode(" ", $tag_names);
										$tags_separator = $tags ? '|' : ' ';
										$tags_sep  =	$atts['show_preposition'] == 'true' ? $tags_separator :(($atts['show_icon_label']==="icon")? "":" ");
										// $tags_sep  =	$atts['show_preposition'] == 'true' ? $tags_separator : " ";
										if(et_core_esc_wp( $tags )!=null){
											$showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "tags-ecs-icon":"";

											$tag_custom_label = esc_html__('Tags','decm-divi-event-calendar-module');
											if(!empty($atts['tag_detail_label'])){
												$tag_custom_label =  esc_html__($atts['tag_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
											}

											$showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.esc_attr($tag_custom_label).$show_colon." </span>":"";
											$stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";

											$event_output .= apply_filters( 'decm_events_tag_start', '<span class="'.$classShowDataOneLine.'ecs-tags '.$showicon.'">', $atts, $event_post ) .
											et_core_intentionally_unescaped($showlabel.$stacklabel.$tags_sep, 'fixed_string' ).
													apply_filters( 'decm_events_tags', et_core_esc_wp( $tags ), 
													$atts, $event_post, $excerptLength ) .
													apply_filters( 'decm_events_tag_end', '</span>', $atts, $event_post );

											
										}
										else{}
										// second case 
											// 	if(get_the_term_list( $event_post->ID, 'post_tag',$before = '', $sep = ',', $after = '' )!=null){
											// 		$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"event-tag-ecs-icon":"";

											// 					$tag_custom_label = __('Tags','decm-divi-event-calendar-module');
											// if(!empty($atts['tag_detail_label'])){
											// 				$tag_custom_label =  __($atts['tag_detail_label'],'decm-divi-event-calendar-module');
											// }
								            // $showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$tag_custom_label.$show_colon." </span>":"";
											
											// $sep = $atts['hide_comma_tag'] == 'false' ? ', ': ' ';
											// 		$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
											// $event_output .= apply_filters( 'decm_events_details_start', '<span class="'.$classShowDataOneLine.'ecs-event-tag '.$showicon.'">', $atts, $event_post ) .
											// 				apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel. " ".get_the_term_list( $event_post->ID, 'post_tag',$before = '', $sep, $after = '' ), $atts, $event_post ) .
											// 		   apply_filters( 'decm_events_title_tag_end', '</span>', $atts, $event_post );
											// }
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
									

											case 'price':
												if ( self::isValid( $atts['price'] ) ) {
													if(tribe_get_cost( $event_post->ID, true )!=null){
													  $showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"price-ecs-icon":"";
													  $price_custom_label = __('Price','decm-divi-event-calendar-module');
											  if(!empty($atts['price_detail_label'])){
															  $price_custom_label =  __($atts['price_detail_label'],'decm-divi-event-calendar-module');
											  }
											  $showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$price_custom_label.$show_colon." </span>":"";
													  $stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
													  $event_output .= apply_filters( 'decm_events_price_tag_start', '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">', $atts, $event_post ) .
															   apply_filters( 'decm_events_price',$showlabel .$stacklabel. " ".'<span class="decm_price">'.tribe_get_cost( $event_post->ID, true ), $atts, $event_post, $excerptLength ) .
															   apply_filters( 'decm_events_price_tag_end', '</span></span>', $atts, $event_post );
												}
												//else{}
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
											
																				

												// Ensure $Tickets_data is an array and contains the 'tickets' key
												if (is_array($Tickets_data) && isset($Tickets_data['tickets'])) {
													if (isset($Tickets_data['tickets']['available'])) {
														$available_tickets = $Tickets_data['tickets']['available'];
													} else {
														$available_tickets = 0; // Default value if 'available' is not set
													}

													if (isset($Tickets_data['tickets']['count'])) {
														$total_tickets = $Tickets_data['tickets']['count'];
													} else {
														$total_tickets = 0; // Default value if 'count' is not set
													}
													
													// Process ticket data only if tickets exist
													if ($total_tickets > 0) {
														$ticket__label = '';
														$event__price = '';

														$isPrice__free = tribe_get_cost($event_post->ID, true);
														$raw__price = explode('–', $isPrice__free);
														$priceArray = array_map('trim', $raw__price);

														$is__price_exists = array_key_exists(1, $priceArray);
														$is__price__onFirstIndex = array_key_exists(0, $priceArray);

														if ($is__price_exists) {
															$event__price = $priceArray[1];
														} elseif ($is__price__onFirstIndex) {
															$event__price = $priceArray[0];

															if ($event__price === 'Free') {
																$event__price = __('Free', 'decm-divi-event-calendar-module');
															}
														} else {
															$event__price = __('Free', 'decm-divi-event-calendar-module');
														}

														if ($available_tickets == 0) {
															$ticket__label = __('Sold Out', 'decm-divi-event-calendar-module');
														} else {
															if ($available_tickets == -1) {
																$Place_left = __('Unlimited', 'decm-divi-event-calendar-module');
															} elseif ($available_tickets > 1) {
																$Place_left = $available_tickets . ' ' . __('Places Left', 'decm-divi-event-calendar-module');
															} else {
																$Place_left = $available_tickets . ' ' . __('Place Left', 'decm-divi-event-calendar-module');
															}

															$Purchase_Now = $atts['show_ticket_feed_respond'] == 'true'
																? '<a href="' . esc_url($event_link) . '" class="price_link_ticket price_link_custom__a" >' . __('Purchase Now', 'decm-divi-event-calendar-module') . '</a> '
																: '';
															
															$spaceRespond = $atts['show_ticket_feed_respond'] == 'true' && $atts['show_ticket_feed_left'] == 'true' ? ' - ' : ' ';
															$show_ticket_feed_left = $atts['show_ticket_feed_left'] == 'true' ? esc_html($Place_left) : '';

															$ticket__label = $Purchase_Now . esc_html($spaceRespond) . ' ' . esc_html($show_ticket_feed_left);
														}

														$event_output .= apply_filters('decm_event_price_tag_start', '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">', $atts, $event_post) .
															apply_filters('decm_event_price', $showlabel . $stacklabel . " " . '<span class="decm_price">' . $event__price, $atts, $event_post, $excerptLength) .
															' <span class="ticket-label ">'.$ticket__label.'</span>' .
															apply_filters('decm_event_price_tag_end', '</span></span>', $atts, $event_post);
													}
												}
												else{
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

								 else{
								  $event_output.='<div class="'.$image_center.' col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
								  $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
									  $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
								 }
								  
								  if( !empty( $thumbWidth ) ) {
									  if ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) ) ) {
										  $event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a href="' . tribe_get_event_link($event_post->ID).'">', $atts, $event_post );
										  $event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
										  $event_output .= apply_filters( 'decm_events_thumbnail_link_end', '</a>', $atts, $event_post );
									  }
								  } else {
							
									  if ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) ) ) {
										  $event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '">', $atts, $event_post );
										  $event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
										  $event_output .= apply_filters( 'decm_events_thumbnail_link_end', '</a>', $atts, $event_post );
									  }
								  }
								  $event_output.='</div>';
							  }
							  break;

							  case 'organizer_thumbnail':
								if ( self::isValid( $atts['organizer_thumb'] ) ) {
									    $organizer_id = tribe_get_organizer_id($event_post->ID);
										$event_output.='<div class="'.$image_center_organizer.' col-md-'.($atts['columns'] == 1 ? '12' : '12').'">';
										$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
										$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
										$thumb = get_the_post_thumbnail( $organizer_id, apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight), $atts, $event_post ), array( 'class'=>"wp-feature-organizer-image" ) );
									
									if( !empty( $thumbWidth ) && !empty($organizer_id) ) {
										if ( $thumb = get_the_post_thumbnail( $organizer_id , apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ), array( 'class'=>"wp-feature-organizer-image" ) ) ) {
											$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a href="' . tribe_get_event_link($organizer_id ).'">', $atts, $event_post );
											$event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
											$event_output .= apply_filters( 'decm_events_thumbnail_link_end', '</a>', $atts, $event_post );
										}
									} else {
							  
										if ( !empty($organizer_id) && $thumb = get_the_post_thumbnail( $organizer_id , apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ), array( 'class'=>"wp-feature-organizer-image" ) ) ) {
											$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a href="' . tribe_get_event_link($organizer_id) . '">', $atts, $event_post );
											$event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
											$event_output .= apply_filters( 'decm_events_thumbnail_link_end', '</a>', $atts, $event_post );
										}
									}
									$event_output.='</div>';
								}
								break;


								case 'venue_thumbnail':
									if ( self::isValid( $atts['venue_thumb'] ) ) {
											
											$venue_id = tribe_get_venue_id($event_post->ID);	
											$event_output.='<div class="'.$image_center_venue.' col-md-'.($atts['columns'] == 1 ? '12' : '12').'">';
											$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
											$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
											$thumb = get_the_post_thumbnail( $venue_id, apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight), $atts, $event_post ), array( 'class'=>"wp-feature-venue-image" )  );
										
										if( !empty( $thumbWidth ) ) {
											if ( $thumb = get_the_post_thumbnail( $venue_id , apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ) , array( 'class'=>"wp-feature-venue-image" )  ) ) {
												$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a href="' . tribe_get_event_link($venue_id ).'">', $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail_link_end', '</a>', $atts, $event_post );
											}
										} else {
								  
											if ( $thumb = get_the_post_thumbnail( $venue_id , apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight ), $atts, $event_post ), array( 'class'=>"wp-feature-venue-image" )  ) ) {
												$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a href="' . tribe_get_event_link($venue_id) . '">', $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail', $thumb, $atts, $event_post );
												$event_output .= apply_filters( 'decm_events_thumbnail_link_end', '</a>', $atts, $event_post );
											}
										}
										$event_output.='</div>';
									}
									break;
  
						  case 'excerpt':
							  if ( self::isValid( $atts['excerpt'] ) ) {
								  
								  $excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 100;
								  if(self::get_excerpt($event_post,$excerptLength )!=null){
								  $event_output .= apply_filters( 'decm_events_excerpt_tag_start', '<p class="'.$classShowDataOneLine.' ecs-excerpt">', $atts, $event_post ) .
											 apply_filters( 'decm_events_excerpt', self::get_excerpt($event_post, $excerptLength ), $atts, $event_post, $excerptLength ) .
											 apply_filters( 'decm_events_excerpt_tag_end', '</p>', $atts, $event_post );
							  }
							  //else{}
						  }
							  
							  break;
						  
						  case 'weburl':
							  if ( self::isValid( $atts['weburl'] ) ) {
								  if ( tribe_get_event_website_link($event_post)!=null){
									$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"weburl-ecs-icon":"";
									$website_custom_label = __('Website','decm-divi-event-calendar-module');
										if(!empty($atts['website_detail_label'])){
											$website_custom_label =  __($atts['website_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
										$showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.$website_custom_label.$show_colon." </span>":"";
									$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$event_output .='<div class="decm-show-detail-center">'. apply_filters( 'decm_events_weburl_tag_start', '<p class="'.$classShowDataOneLine.' ecs-weburl '.$showicon.'">', $atts, $event_post ) .
											 apply_filters( 'decm_events_weburl',$showlabel.$stacklabel." ", $atts, $event_post) .
											 apply_filters( 'decm_events_weburl',($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<a href="'.$result.'" target="'.$atts['custom_website_link_target'].'">'.$custom_website_link_text.'</a>':'<a href="'.$result.'" target="'.$atts['custom_website_link_target'].'">'.tribe_get_event_website_url($event_post->ID).'</a>', $atts, $event_post) .
											 apply_filters( 'decm_events_weburl_tag_end', '</p>', $atts, $event_post ).
											 apply_filters( 'decm_events_weburl_tag_end', '</div>', $atts, $event_post );
							  }
							  //else{}'custom_website_link_text'website_link
						  }
							  
							  //$event_output.='</div></br>';
							  break;
  
							  case 'date':
								$event_output .= '<div class="decm-show-detail-center">';
								//if ( self::isValid( $atts['eventdetails'] ) ) {
									$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									if($atts['showtime']== 'true'){
									
									if($atts['show_data_one_line'] == 'true'){	
										//	if($atts['show_icon_label']=="label" && $atts['show_data_one_line'] == 'true'){$showlabeldate="<span class=ecs-detail-label>Date: </span>";$showlabeltime="<span class=ecs-detail-label>Time: </span>";}
									//elseif($atts['show_icon_label']=="icon" && $atts['show_data_one_line'] == 'true'){$showicondate="eventDate-ecs-icon"; $showicontime="eventTime-ecs-icon"; }
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{       if($atts['eventdetails']== 'true'){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$showlabeldate.	$stacklabel.'<span class="decm_date">'." ".$start_date, $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
						}
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel." ". $dateTimeSeparator." ".'<span class="decm_time">'.$start_time : $showlabeltime.$stacklabel." ".'<span class="decm_time">'.$start_time, $atts, $event_post ) .
									apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$timeRangeSeparatorEnd.$end_time :$timeRangeSeparatorEnd. $end_time, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );}
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{           if($atts['eventdetails']== 'true'){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'." ".$start_date, $atts, $event_post ) .
									//apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
						}
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									//apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?" @ ".$start_time : $start_time, $atts, $event_post ) .
									apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel." ".'<span class="decm_time">'.$dateTimeSeparator.$end_time :$showlabeltime."".$stacklabel.'<span class="decm_time">'. $end_time, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
									}
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{ 
							if($atts['eventdetails']== 'true'){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'." ".$start_date, $atts, $event_post ) .
									//apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
						}
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel. $dateTimeSeparator .'<span class="decm_date">'." ".$start_time : $showlabeltime.$stacklabel." ".'<span class="decm_date">'.$start_time, $atts, $event_post ) .
									apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$timeRangeSeparatorEnd.$end_time :$timeRangeSeparatorEnd. $end_time, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
								}
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
						{
							if($atts['eventdetails']== 'true'){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$showlabeldate.$stacklabel.'<span class="decm_date">'.$start_date, $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
							}
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime.$stacklabel.'<span class="decm_time">'.$dateTimeSeparator.$start_time : $showlabeltime.$stacklabel.'<span class="decm_time">'.$start_time, $atts, $event_post ) .
									apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$timeRangeSeparatorEnd.$end_time :$timeRangeSeparatorEnd. $end_time, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );
									}
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&(is_null(tribe_get_start_time($event_post->ID,get_option( 'time_format' )))&& is_null(tribe_get_end_time($event_post->ID,get_option( 'time_format' )))))
						{	
										
						$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
						apply_filters( 'decm_events_list_details', $showlabeltime.$stacklabel.' '.'<span class="decm_time">'.__('All Day Event','decm-divi-event-calendar-module') , $atts, $event_post ) .
						apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );			
									
						}
						if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&(is_null(tribe_get_start_time($event_post->ID,get_option( 'time_format' )))&& is_null(tribe_get_end_time($event_post->ID,get_option( 'time_format' )))))
						{	
										
						$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
						apply_filters( 'decm_events_list_details', $showlabeltime.$stacklabel.' '.'<span class="decm_time">'.__('All Day Event','decm-divi-event-calendar-module') , $atts, $event_post ) .
						apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );				
						}

					}
									
									elseif($atts['show_data_one_line']=="false"){
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
											if($atts['eventdetails']== 'true'){
									$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											}
										$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? $dateTimeSeparator .$start_time:" ".$start_time,  $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
									if($atts['eventdetails']== 'true'){
									$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
									}
									$event_output.=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ?$dateTimeSeparator .$end_time:" ".$end_time,  $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
									}
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
										if($atts['eventdetails']== 'true'){
										$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										}
										$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? $dateTimeSeparator .$end_time:" ".$end_time,  $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
											if($atts['eventdetails']== 'true'){
											$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											}
												$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " $dateTimeSeparator ".$start_time:" ".$start_time,  $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
											if($atts['eventdetails']== 'true'){
											$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											}
											$event_output.=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ?  $dateTimeSeparator .$end_time:" ".$end_time,  $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											}
											if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
												if($atts['eventdetails']== 'true'){
												$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time decm_date">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
												}
													$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ?  $dateTimeSeparator .$start_time:" ".$start_time,  $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
				
												$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time decm_time">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ?  $timeRangeSeparatorEnd .$end_time:" $timeRangeSeparatorEnd ".$end_time,  $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
												}
												if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&(is_null(tribe_get_start_time($event_post->ID,get_option( 'time_format' )))&& is_null(tribe_get_end_time($event_post->ID,get_option( 'time_format' )))))
												{	
																
												$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details', $showlabeltime.$stacklabel.' '.'<span class="decm_time">'.__('All Day Event','decm-divi-event-calendar-module') , $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );			
															
												}
												if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&(is_null(tribe_get_start_time($event_post->ID,get_option( 'time_format' )))&& is_null(tribe_get_end_time($event_post->ID,get_option( 'time_format' )))))
												{	
																
												$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
												apply_filters( 'decm_events_list_details', $showlabeltime.$stacklabel.' '.'<span class="decm_time">'.__('All Day Event','decm-divi-event-calendar-module') , $atts, $event_post ) .
												apply_filters( 'decm_events_date_tag_end', '</span></span>', $atts, $event_post );				
												}
									}
								}
									elseif($atts['showtime']=="false"){
										if($atts['eventdetails']== 'true'){
									if($atts['show_data_one_line'] == 'true'){
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
										$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
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
								
								//}
								// $event_output.='</div>';
								break;
							  
  
						  case 'venue':
							  if ( self::isValid( $atts['venue'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								  if(tribe_get_venue($event_post->ID)!=null){
									$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"venue-ecs-icon":"";
									$venue_custom_label = __('Venue','decm-divi-event-calendar-module');
										if(!empty($atts['venue_detail_label'])){
											$venue_custom_label =  __($atts['venue_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
								$showlabel = ($atts['show_icon_label'] ==="label" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$venue_custom_label.$show_colon." </span>":"";
									$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";

									$enable_venue_link =$atts['enable_venue_link']=="true"?'<a href="'.$result_venue.'" target="'.$atts['custom_venue_link_target'].'">'.tribe_get_venue($event_post->ID).'</a>':tribe_get_venue($event_post->ID);
									$event_output .= apply_filters( 'decm_events_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-venue duration venue '.$showicon.'">', $atts, $event_post ) .

											 apply_filters( 'decm_events_venue_at_text',($atts['show_preposition'] == 'true' ? $showlabel.$stacklabel.'<span class="decm_venue"> <em>'.__('at','decm-divi-event-calendar-module').'</em>' :$showlabel.$stacklabel ), $atts, $event_post ) .

											 apply_filters( 'decm_events_list_venue',$atts['show_preposition'] == 'false' ?'<span class="decm_venue">' ." ". $enable_venue_link:" ". $enable_venue_link, $atts, $event_post ) .
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

						    //	$organizer_id = tribe_get_organizer_id($event_post->ID);

							// $organizer_id = tribe_get_organizer_id($event_post->ID);
							// $image_html = get_the_post_thumbnail( $organizer_id, 'medium' );
						
							// echo $image_html;
							  
							  if ( self::isValid( $atts['location'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								  if(tribe_get_full_address($event_post->ID) !="<span class=\"tribe-address\">\n\n\n\n\n\n\n</span>\n" ){

									
									$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"event-location-ecs-icon":"";
									$location_custom_label = __('Location','decm-divi-event-calendar-module');
										if(!empty($atts['location_detail_label'])){
											$location_custom_label =  __($atts['location_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
									$showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.$location_custom_label.$show_colon." </span>":"";
									$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$enable_location_link = $atts['enable_location_link']=="true" ?'<a href="'.$result_location.'" target="'.$atts['custom_location_link_target'].'">':" ";
									$enable_location_link_last = $atts['enable_location_link']=="true" ? '</a>': " ";

									$event_output .= apply_filters( 'decm_events_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-location duration venue '.$showicon.'">'.$showlabel.$stacklabel, $atts, $event_post ) .
											 apply_filters( 'decm_events_list_location_int_tag_start', '<span class="decm_location">'.$enable_location_link.'<em> ', $atts, $event_post ) .
											 apply_filters( 'decm_events_venue_in_text',( $atts['show_preposition']=='true'?__('in','decm-divi-event-calendar-module'):''), $atts, $event_post ) .
											 apply_filters( 'decm_events_list_location_int_tag_end', ' </em>', $atts, $event_post ) .
											 apply_filters( 'decm_events_list_location',($atts['show_data_one_line'] =='false'? $street.$show_postal_code_before_locality.$locality.$state.$postal.$country : str_replace('<br>','',$street.$show_postal_code_before_locality.$locality.$state.$postal.$country)), $atts, $event_post)  .	
											 apply_filters( 'decm_events_venue_tag_end', '</span>'.$enable_location_link_last.'</span>', $atts, $event_post );
							  }
							  // else{}
							  }
							  
							  break;
							  case 'google_link':
								//$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['google_link'])) {
									if(tribe_get_map_link_html($event_post->ID)!=null){
										$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"google-link-ecs-icon":"";
										$venue_google_map_label = __('Venue Google Map Link','decm-divi-event-calendar-module');
									if(!empty($atts['venue_google_map_label'])){
										$venue_google_map_label =  __($atts['venue_google_map_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
									}

										$showlabel =($atts['show_icon_label'] ==="label_icon" or $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$venue_google_map_label.$show_colon." </span>":"";
										$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
									$event_output .= apply_filters( 'decm_events_details_start',get_post_meta( $event_post->ID, '_EventShowMapLink', true )=="1"? '<span class="'.$classShowDataOneLine.'ecs-venue-google-link '.$showicon.'">':"", $atts, $event_post ) .
												apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel." ".'<span class="decm_venue_google_link">'.tribe_get_map_link_html( $event_post->ID ), $atts, $event_post ) .
										   apply_filters( 'decm_events_title_tag_end', '</span></span>', $atts, $event_post );
								}}
								break;
							  case 'venue_phone':
								//$event_output .= '<div class="decm-show-detail-center">';
								if ( self::isValid( $atts['venue_phone'])) {
									if(tribe_get_phone($event_post->ID)!=null){
										$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"venue-phone-ecs-icon":"";
										$venue_phone_label = __('Venue Phone','decm-divi-event-calendar-module');
										if(!empty($atts['venue_phone_label'])){
											$venue_phone_label =  __($atts['venue_phone_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
								$showlabel = ($atts['show_icon_label'] ==="label" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$venue_phone_label.$show_colon." </span>":"";
										$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";

								// $event_output .= apply_filters( 'decm_events_details_start', '<span class="'.$classShowDataOneLine.'ecs-venue-phone '.$showicon.'">', $atts, $event_post ) .
								// 				apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel." ".'<span class="decm_venue_phone">'.tribe_get_phone($event_post->ID), $atts, $event_post ) .
								// 		   apply_filters( 'decm_events_title_tag_end', '</span></span>', $atts, $event_post );


								$event_output .= apply_filters(
									'decm_events_title_details',
									'<span class="' . $classShowDataOneLine . ' ecs-venue-phone ' . $showicon . '">',
									$atts,
									$event_post
								) . apply_filters(
									'decm_organizer_phone_start',
									$showlabel . $stacklabel . " " . '<span class="decm_venue_phone">
										<span class="venue-phone-number-desktop">' . tribe_get_phone($event_post->ID) . '</span>
										<span class="venue-phone-number-mobile"><a href="tel:' . tribe_get_phone($event_post->ID) . '">' . tribe_get_phone($event_post->ID) . '</a></span>
									</span>',
									$atts,
									$event_post
								) . apply_filters(
									'decm_organizer_phone_end',
									'</span></span>',
									$atts,
									$event_post
								);
								
								
								}}
								break;
								case 'venue_weburl':
									//$event_output .= '<div class="decm-show-detail-center">';
									if ( self::isValid( $atts['venue_weburl'])) {
										if(tribe_get_venue_website_link($event_post->ID)!=null){
											$showicon=($atts['show_icon_label']==="label_icon" or $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true'?"venue-weburl-ecs-icon":"";
											$venue_website_label = __('Venue Website','decm-divi-event-calendar-module');
										if(!empty($atts['venue_website_label'])){
											$venue_website_label =  __($atts['venue_website_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
										}
								            $showlabel = ($atts['show_icon_label'] ==="label" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$venue_website_label.$show_colon." </span>":"";
											$stacklabel=$atts['stack_label_icon']==='true'?"<br>":"";
										//	$enable_venue_web_link = '<a href="'.$result_venue_website.'" target="'.$atts['venue_website_link_target'].'">'.__('View Venue Website','decm-divi-event-calendar-module').'</a>';
											$enable_venue_web_link =$atts['enable_venue_website_link']=="true"?'<a href="'.$result_venue_website.'" target="'.$atts['custom_venue_link_target'].'">'.__('View Venue Website','decm-divi-event-calendar-module').'</a>': '<a>'.__('View Venue Website','decm-divi-event-calendar-module').'</a>';
															
									$event_output .= apply_filters( 'decm_events_details_start', '<span class="'.$classShowDataOneLine.'ecs-venue-weburl '.$showicon.'">', $atts, $event_post ) .
													apply_filters( 'decm_events_list_title_link_start',$showlabel.$stacklabel." ".'<span class="decm_venue_weburl">'.$enable_venue_web_link, $atts, $event_post ) .
											   apply_filters( 'decm_events_title_tag_end', '</span></span>', $atts, $event_post );
									}}
									break;
						  /**
						   * Show categories of every events
						   *
						   * @author bojana
						   */
						 
							 case 'addcalendarbutton': 
								if ( self::isValid( $atts['show_add_calendar_button']) ) {
									if($atts['show_add_calendar_button']=='true'){
									$button_classes ="act-add_to_calendar et_pb_button";
									$button_classes = ($atts['custom_add_to_calendar_button'] == 'on') ? $button_classes." et_pb_custom_button_icon " : $button_classes;
									$show_left_right=$atts['columns']=="1" ?"col-md-6":"";
									$event_output .= apply_filters( 'decm_events_showcalendar_tag_start', '<p class="diec_add_to_calendar et_pb_button_wrapper  '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													apply_filters( 'decm_events_list_showcalendar_link_start', '<a  style="font-weight:'.$atts['add_to_calendar_button_icon_font_weight'].';" class="'.$button_classes.' " href=""  rel="bookmark"  data-icon="'.$atts['add_to_calendar_button_icon'].'" data-icon-tablet="'.$atts['add_to_calendar_button_icon_tablet'].'" data-icon-phone="'.$atts['add_to_calendar_button_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['add_to_calendar_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdcalendar_link_end', '</a>', $atts, $event_post ) .
											apply_filters( 'decm_events_showcalendar_tag_end', '</p>', $atts, $event_post );
								}}
								//$event_output.='</div>';
								break;
						  /**
						   * Show more in detail of every events
						   *
						   * @author bojana
						   */
						  case 'showcalendar':
							if( $atts['show_add_calendar_button']=='true'){
							$event_output .='<div class= "ecs-calendar_link_align">';
							}
							if ( self::isValid( $atts['show_google_calendar']) ) {
								if($atts['show_google_calendar']=='true' && $atts['show_add_calendar_button']=='true'){
									
								$button_classes ="act-google_calendar";
								$show_left_right=$atts['columns']=="1" ?"col-md-4":"";
								$event_output .= apply_filters( 'decm_events_showcalendar_tag_start', '<p class="ecs-show_calendar '.$show_left_right. '  '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'decm_events_list_showcalendar_link_start', '<a class="'.$button_classes.' " target="_blank" href="' . Tribe__Events__Main::instance()->esc_gcal_url( tribe_get_gcal_link($event_post->ID) ) . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['google_calendar_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdcalendar_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'decm_events_showcalendar_tag_end', '</p>', $atts, $event_post );
							}}
							//$event_output.='</div>';
							break;
							  case 'showical':
								  if ( self::isValid( $atts['show_ical_export']) ) {
									  if($atts['show_ical_export']=='true' && $atts['show_add_calendar_button']=='true'){
									  $button_classes ="act-ical-export";
									  $show_left_right=$atts['columns']=="1" ?"col-md-4":"";
									  $event_output .= apply_filters( 'decm_events_showical_tag_start', '<p class="ecs-showical-export '.$show_left_right.' '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													  apply_filters( 'decm_events_list_showical_link_start', '<a class="'.$button_classes.' " target="_blank"  href="'.str_replace( [ 'http://', 'https://' ], 'webcal://', tribe_get_single_ical_link($event_post->ID) ).'" rel="bookmark" >', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['ical_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showical_link_end', '</a>', $atts, $event_post ) .
											  apply_filters( 'decm_events_showical_tag_end', '</p>', $atts, $event_post );
								  }}
							  break;

							  case 'showexport':
								if ( self::isValid( $atts['show_export_link']) ) {
									if($atts['show_export_link']=='true' && $atts['show_add_calendar_button']=='true'){
									$button_classes ="act-export-ics";
									$show_left_right=$atts['columns']=="1" ?"col-md-4":"";
									$event_output .= apply_filters( 'decm_events_showexport_tag_start', '<p class="ecs-export-ics '.$show_left_right.' '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
													apply_filters( 'decm_events_list_showexport_link_start', '<a class="'.$button_classes.' " target="_blank"  href="'.tribe_get_event_link($event_post->ID).'?ical=1" rel="bookmark" >', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['export_link_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showexport_link_end', '</a>', $atts, $event_post ) .
											apply_filters( 'decm_events_showexport_tag_end', '</p>', $atts, $event_post );
								}}
							break;

						  case 'showoutlook':
							if ( self::isValid( $atts['show_outlook_link']) || self::isValid( $atts['show_outlook_360']) ) {
								if(($atts['show_outlook_link']=='true' ||  $atts['show_outlook_360'] == 'true' )&& $atts['show_add_calendar_button']=='true'){
									$addressOutlook=tribe_get_address($event_post->ID)!=""?"=".str_replace( [ ' '], '%20',tribe_get_address($event_post->ID)):"";
								//	$postContentOutlook=$event_post->post_content!=""?"=".strip_tags( $event_post->post_content, '<p>' ):"";
									$postContentOutlook=$event_post->post_content!=""?"=".urlencode(strip_tags( $event_post->post_content, '<p>' )):"";
									//print_r(preg_replace('/\[\/?et_pb.*?\]/',"",$event_post->post_content));
									$button_classes ="act-outlook_link";
								$show_left_right=$atts['columns']=="1" ?"col-md-4":"";
								if($atts['show_outlook_link']=='true'){
								$event_output .= apply_filters( 'decm_events_show_outlook_tag_start', '<p class="ecs-showoutlook-link '.$show_left_right.' '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												apply_filters( 'decm_events_list_outlook_link_start', '<a class="'.$button_classes.' " target="_blank"  href="https://outlook.live.com/owa/?path=/calendar/action/compose&amp;rrv=addevent&amp;startdt='.str_replace( [ ' '], 'T', tribe_get_start_date($event_post->ID,true,'Y-m-d H:i:s') ).'&amp;enddt='.str_replace( [ ' '], 'T', tribe_get_end_date($event_post->ID,true,'Y-m-d H:i:s')).'&amp;location'.$addressOutlook.'&subject='.$event_post->post_title.'&body'. substr( $postContentOutlook, 0, 900 ).'" rel="bookmark">', $atts, $event_post ) . apply_filters( 'decm_events_list_outlook_link', $atts['outlook_link_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_outlook_link_end', '</a>', $atts, $event_post ) .
										apply_filters( 'decm_events_show_outlook_tag_end', '</p>', $atts, $event_post );
								}
										if($atts['show_outlook_360']=='true'){
											$event_output .= apply_filters( 'decm_events_show_outlook_tag_start', '<p class="ecs-showoutlook-link '.$show_left_right.' '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
											apply_filters( 'decm_events_list_outlook_link_start', '<a class="'.$button_classes.' " target="_blank"  href="https://outlook.office.com/owa/?path=/calendar/action/compose&amp;rrv=addevent&amp;startdt='.str_replace( [ ' '], 'T', tribe_get_start_date($event_post->ID,true,'Y-m-d H:i:s') ).'&amp;enddt='.str_replace( [ ' '], 'T', tribe_get_end_date($event_post->ID,true,'Y-m-d H:i:s')).'&amp;location'.$addressOutlook.'&subject='.$event_post->post_title.'&body'. substr( $postContentOutlook, 0, 900 ).'" rel="bookmark">', $atts, $event_post ) . apply_filters( 'decm_events_list_outlook_link',$atts['outlook_office_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_outlook_link_end', '</a>', $atts, $event_post ) .
									      apply_filters( 'decm_events_show_outlook_tag_end', '</p>', $atts, $event_post );
										}						
							}}
							if( $atts['show_add_calendar_button']=='true'){
							$event_output.='</div>';
							}
							break;
						
							case 'showdetail':
							  if ( self::isValid( $atts['showdetail']) ) {
								  $button_classes ="act-view-more et_pb_button";
								  $view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
								  $icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
								  $button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
	
								  $event_output .= apply_filters( 'decm_events_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
												  apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.' " href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
										  apply_filters( 'decm_events_showdetail_tag_end', '</p>', $atts, $event_post );
							  }
							  
							  break;
							  case 'googlemap':
								if ( self::isValid( $atts['googlemap'])) {
									//$event_output .= apply_filters( 'decm_events_date_thumb', '<div class="ecs_google_map">'.tribe_get_embedded_map($event_post->ID).'</div>', $atts, $event_post );
									//$event_output .= apply_filters( 'decm_events_date_thumb',get_post_meta( $event_post->ID, '_EventShowMap', true )=="1"? '<div class="ecs_google_map"><iframe width="100%" height="350px" frameborder="0" style="border:0" src='.$atts['add_url'].$atts['google_api_key_customize'].'&q='.str_replace(' ','+',tribe_get_address( $event_post->ID)).'+'.str_replace(' ','+',tribe_get_city($event_post->ID)).'+'.str_replace(' ','+',tribe_get_region($event_post->ID)).'+'.str_replace(' ','+',tribe_get_zip($event_post->ID)).' allowfullscreen=""></iframe></div>':"", $atts, $event_post );
								$event_output .= apply_filters( 'decm_events_date_thumb',get_post_meta( $event_post->ID, '_EventShowMap', true )=="1"? '<div class="ecs_google_map">'.tribe_get_embedded_map($event_post->ID,$atts['map_width'], $atts['map_height']).'</div>':"", $atts, $event_post );
								}
								break;
								case 'zoom_link':
									if ( self::isValid( $atts['zoom_link'])) {
										//$event_output .= apply_filters( 'decm_events_date_thumb', '<div class="ecs_google_map">'.tribe_get_embedded_map($event_post->ID).'</div>', $atts, $event_post );
										$button_classes ="ecs-events-virtual-link-button et_pb_button";
									$button_classes = ($atts['custom_virtual_event_button'] == 'on') ? $button_classes." et_pb_custom_button_icon " : $button_classes;
										$event_output .= $virtual_event_object->virtual_video_source=="zoom"?apply_filters( 'decm_events_date_thumb','<div class="ecs-events-virtual-single-zoom-details  col-md-12">
										<div class="ecs-events-virtual-single-button-details-link-button col-md-6" style= "    padding: var(--tec-spacer-7) 0 var(--tec-spacer-3);
										margin: 20px 0;">
										<a href="'.$virtual_event_object->virtual_meeting_url.'" class="'.$button_classes.'" data-icon="'.$atts['virtual_event_button_icon'].'" data-icon-tablet="'.$atts['virtual_event_button_icon_tablet'].'" data-icon-phone="'.$atts['virtual_event_button_icon_phone'].'">'.$atts['virtual_event_button_text'].'</a></div>
										<div class="ecs-events-virtual-single-api-details col-md-6" style="display: flex; align-items: flex-start;     padding: var(--tec-spacer-7) 0 var(--tec-spacer-3);
										margin: 20px 0;">
										<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--video tribe-events-virtual-single-zoom-details__icon tribe-events-virtual-single-zoom-details__icon--video" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 12"><path d="M11 4V1c0-.6-.4-1-1-1H1C.4 0 0 .4 0 1v10c0 .6.4 1 1 1h9c.6 0 1-.4 1-1V8l5 2V2l-5 2z" fill-rule="nonzero" class="tribe-common-c-svgicon__svg-fill"></path></svg>
										<div class="ecs-events-virtual-single-api-details__meta-group-content col-md-2" style = "padding: 0px 0px 0px 20px;">
											<a href='.$virtual_event_object->virtual_meeting_url.' class="ecs-events-virtual-single-zoom-details__zoom-link" target="_blank" >
												us05web.zoom.us/j/'.$virtual_event_object->zoom_meeting_id.'</a><span class="ecs-events-virtual-single-zoom-details__zoom-id col-md-2">ID:'.$virtual_event_object->zoom_meeting_id.'</span></div></div>	</div>', $atts, $event_post ):"";
									}
									break;
									
									case 'youtube_link':
										//print_r($_SERVER['HTTP_REFERER']);
										if ( self::isValid( $atts['youtube_link'])) {
										$button_classes ="ecs-events-virtual-link-button et_pb_button";
									$button_classes = ($atts['custom_virtual_event_button'] == 'on') ? $button_classes." et_pb_custom_button_icon " : $button_classes;
										$event_output .=$virtual_event_object->virtual_video_source=="youtube"?'<div class="ecs-events-virtual-single-youtube__embed-wrap">
										<figure class="ecs-events-virtual-single-youtube__embed chat-enabled">
											<div class="ecs-events-virtual-single-youtube__wrapper">
												<iframe title="dsfs" width="1080" height="608" src="https://www.youtube.com/embed/'.$virtual_event_object->virtual_meeting_is_live.'?feature='.$virtual_event_object->virtual_autodetect_source.'&amp;autoplay='.$virtual_event_object->youtube_autoplay.'&amp;mute='.$virtual_event_object->youtube_mute_video.'&amp;modestbranding='.$virtual_event_object->youtube_modest_branding.'&amp;rel=1&amp;controls=1" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>		</div>
										</figure>
									
												<figure class="ecs-events-virtual-single-youtube__chat-wrap">
												<div class="ecs-events-virtual-single-youtube__wrapper">
													<iframe class="ecs-events-virtual-single-youtube__chat-embed" width="580" height="400" src="https://www.youtube.com/live_chat?v='.$virtual_event_object->virtual_meeting_is_live.'&amp;embed_domain='.isset($_SERVER['HTTP_HOST']).'" frameborder="0" scrolling="no"></iframe>			</div>
											</figure>
										</div><div class="ecs-events-virtual-single-button-details-link-button " style= "    padding: var(--tec-spacer-7) 0 var(--tec-spacer-3);
										margin: 20px 0;">
										<a href="https://www.youtube.com/channel/UCmqkk3Ti-YWQk1r76exJSxw/live'.$virtual_event_object->youtube_channel_id.'" class="'.$button_classes.'" data-icon="'.$atts['virtual_event_button_icon'].'" data-icon-tablet="'.$atts['virtual_event_button_icon_tablet'].'" data-icon-phone="'.$atts['virtual_event_button_icon_phone'].'">'.$atts['virtual_event_button_text'].'</a></div>
										':"";
													}
										break;
										case 'facebook_link':
										//	print_r($virtual_event_object->virtual_meeting_is_live);
										if ( self::isValid( $atts['facebook_link'])) {
										$button_classes ="ecs-events-virtual-link-button et_pb_button";
										$button_classes = ($atts['custom_add_to_calendar_button'] == 'on') ? $button_classes." et_pb_custom_button_icon " : $button_classes;
											$event_output .=$virtual_event_object->virtual_meeting_is_live=="LIVE" &&$virtual_event_object->virtual_meeting_is_live=="LIVE"?'<div class="ecs-events-virtual-single-facebook__embed-wrap">
												<div class="ecs-events-virtual-single-facebook__wrapper">
													'.$virtual_event_object->virtual_meeting_embed.'
											</div><div class="ecs-events-virtual-single-button-details-link-button " style= "    padding: var(--tec-spacer-7) 0 var(--tec-spacer-3);
											margin: 20px 0;">
											<a href='.$virtual_event_object->virtual_meeting_url.'" class="'.$button_classes.'" data-icon="'.$atts['virtual_event_button_icon'].'" data-icon-tablet="'.$atts['virtual_event_button_icon_tablet'].'" data-icon-phone="'.$atts['virtual_event_button_icon_phone'].'">'.$atts['virtual_event_button_text'].'</a></div>
											':"";
										}
											break;
											case 'webex_link':
												if ( self::isValid( $atts['webex_link'])) {

													$button_classes ="ecs-events-virtual-link-button et_pb_button";
												$button_classes = ($atts['custom_add_to_calendar_button'] == 'on') ? $button_classes." et_pb_custom_button_icon " : $button_classes;
													$event_output .= $virtual_event_object->virtual_video_source=="webex"?apply_filters( 'decm_events_date_thumb','<div class="ecs-events-virtual-single-webex-details tribe-events-event-meta col-md-12">
													<div class="ecs-events-virtual-single-button-details-link-button col-md-3" style= "    padding: var(--tec-spacer-7) 0 var(--tec-spacer-3);
													margin: 20px 0;">
													<a href="'.$virtual_event_object->virtual_meeting_url.'" class="'.$button_classes.'" data-icon="'.$atts['virtual_event_button_icon'].'" data-icon-tablet="'.$atts['virtual_event_button_icon_tablet'].'" data-icon-phone="'.$atts['virtual_event_button_icon_phone'].'">'.$atts['virtual_event_button_text'].'</a></div>
													<div class="ecs-events-virtual-single-api-details col-md-5" style="display: flex;    align-items: self-start;   padding: var(--tec-spacer-7) 0 var(--tec-spacer-3);
													margin: 20px 0;">
													<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--video tribe-events-virtual-single-zoom-details__icon tribe-events-virtual-single-zoom-details__icon--video" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 12"><path d="M11 4V1c0-.6-.4-1-1-1H1C.4 0 0 .4 0 1v10c0 .6.4 1 1 1h9c.6 0 1-.4 1-1V8l5 2V2l-5 2z" fill-rule="nonzero" class="tribe-common-c-svgicon__svg-fill"></path></svg>
													<div class="ecs-events-virtual-single-api-details__meta-group-content col-md-4" style = "padding: 0px 0px 0px 20px;">
														<a href='.$virtual_event_object->virtual_meeting_url.' class="ecs-events-virtual-single-webex-details__webex-link" target="_blank" >
													'.	substr($virtual_event_object->virtual_meeting_url, 0, strpos($virtual_event_object->virtual_meeting_url, "?")).'</a><span class="ecs-events-virtual-single-webex-details__webex-id" style="display: inline-block;">ID:'.$virtual_event_object->webex_meeting_id.'</span></div></div><div class=" ecs-events-virtual-single-webex-details_password col-md-4" style="display: flex; align-items: center;">
													<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--lock tec-events-virtual-single-api-details__icon tec-events-virtual-single-api-details__icon--lock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 330 330" xml:space="preserve">
										  <path d="M65 330h200c8.284 0 15-6.716 15-15V145c0-8.284-6.716-15-15-15h-15V85c0-46.869-38.131-85-85-85S80 38.131 80 85v45H65c-8.284 0-15 6.716-15 15v170c0 8.284 6.716 15 15 15zm115-95.014V255c0 8.284-6.716 15-15 15s-15-6.716-15-15v-20.014c-6.068-4.565-10-11.824-10-19.986 0-13.785 11.215-25 25-25s25 11.215 25 25c0 8.162-3.932 15.421-10 19.986zM110 85c0-30.327 24.673-55 55-55s55 24.673 55 55v45H110V85z"></path>
										</svg><div class="ecs-events-virtual-single-webex-details__meta-group-content">
														<span class=" ecs-events-virtual-single-api-details__webex-password">
															Password: bEycjPvp436</span>
													</div>
												</div>	</div>', $atts, $event_post ):"";
												}
												break;
							// 	case "show_past_notification":
							// 	if($get_end_time_offset < $get_current_time_offset) {
							// 		$event_output .= apply_filters( 'dec_no_events_found_message','<div class="tribe-events-notices"><ul><li>'.sprintf( translate( $atts['message'], 'the-events-calendar' ).'</li></ul></div>'), $atts );
							// 	}
							// break;
							  
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
				  
				  
							  
				  
				  // $event_output .= apply_filters( 'decm_events_end_tag', '</li>', $atts, $post );
				  $event_output .= apply_filters( 'decm_events_end_tag', '</article></div>', $atts, $event_post );
  
				  $output .= apply_filters( 'dec_single_event_output', $event_output, $atts, $event_post, $post_index, $event_post );
				  
				  
			  }
			  // $output .= apply_filters( 'dec_end_tag', '</ul>', $atts );
			  $output .= apply_filters( 'dec_end_tag', '</div>', $atts );
			  //$output = apply_filters( 'dec_ending_output', $output, $posts, $atts );
			  
			  if( self::isValid( $atts['viewall'] ) ) {
				  $output .= apply_filters( 'dec_view_all_events_tag_start', '<span class="ecs-all-events">', $atts ) .
							 '<a href="' . apply_filters( 'decm_events_list_viewall_link', tribe_get_events_link(), $atts ) .'" rel="bookmark">' . apply_filters( 'dec_view_all_events_text', sprintf( __( 'View All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ), $atts ) . '</a>';//phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
				  $output .= apply_filters( 'dec_view_all_events_tag_end', '</span>' );
			  }
		  } else { //No Events were Found
			if(get_post_status(get_the_ID())=="private" || get_post_status(get_the_ID())!="publish"){}
			else{
			  $output .= apply_filters( 'dec_no_events_found_message', sprintf( translate( $atts['message'], 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() ), $atts );//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText , WordPress.WP.I18n.LowLevelTranslationFunction
			}
			} // endif
  
		  return $output;
	  
		  wp_reset_postdata();
		  
	  }
	  
	  static function get_blog_posts_events(  $atts = array(), $conditional_tags = array(), $current_page = array()  ) {
		  global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content;
  
		  /**
		   * Check if events calendar plugin method exists
		   */
  
  
		  if ( !function_exists( 'tribe_get_events' ) ) {
			  return array();
		  }
  
	  //	$atts  = array();
  
  		  
		  global $post;
		  $output = '';
		//   if (!  class_exists( 'Tribe__Tickets__Main' ) ) {
		// 	return '\'Event Tickets\' plugin should exist';
		// }
		  $atts = shortcode_atts( apply_filters( 'decm_events_atts', array(
			  'cat' => $atts['included_categories'],
			  'month' => '',
			  'limit' => $atts['event_count'],
			  'map_height' => $atts['map_height'],
			  'map_width' => $atts['map_width'],
			  'eventdetails' => 'true',
			  'showtime' => 'true',
			  'show_timezone' => 'true',
			  'show_timezone_abb' => $atts['show_timezone_abb'],
			  'website_link'=> $atts['website_link'],
			  'organizer_email_linkable'=>$atts['organizer_email_linkable'],
			  'custom_website_link_text'=>$atts['custom_website_link_text'],
			  'custom_website_link_target'=>$atts['custom_website_link_target'],
			  'event_status_notice'=> $atts['event_status_notice'],
			  'event_virtual_hybrid_notice'=> $atts['event_virtual_hybrid_notice'],
			  'event_status_reason'=>$atts['event_status_reason'],
			  'time' => null,
			  'show_google_map'=>'true',
			  'past' => ($atts['show_past'] === 'on' ? 'yes' : ''),
			  'venue' => 'false',
			  'enable_venue_link'=>$atts['enable_venue_link'],
			  'google_link'=>'false',
			  'venue_phone'=>'false',
			  'venue_weburl'=>'false',
			  'location' => 'false',
			  'street' => 'false',
			  'locality'=>'false',
			  'postal'=>'false',
			  'country'=>'false',
			  'organizer' => null,
			  'show_rsvp_feed_respond' =>$atts['show_rsvp_feed_respond'],
			  'show_rsvp_feed_left' =>$atts['show_rsvp_feed_left'],
			  'show_ticket_feed_respond' =>$atts['show_ticket_feed_respond'],
			  'show_ticket_feed_left' =>$atts['show_ticket_feed_left'],
			  'enable_organizer_link'=>$atts['enable_organizer_link'],
			  'enable_series_link' => $atts['enable_series_link'],
			  'event_series_label' => $atts['event_series_label'],
			  'event_series_icon' => $atts['event_series_icon'],
			  'event_series_name' => $atts['event_series_name'],
			  'custom_series_link_target'=>$atts['custom_series_link_target'],
			  'organizer_phone'=>'false',
			  'organizer_email'=>'false',
			  'organizer_weburl'=>'false',
			  'price' => null,
			  'show_rsvp_feed' => null,
			  'weburl' => null,
			  'categories' => 'false',
			  'enable_category_link'=>$atts['enable_category_link'],
			  'enable_location_link'=>$atts['enable_location_link'],
			  'custom_location_link_target'=>$atts['custom_location_link_target'],
			  'category_link_target' => $atts['category_links_target'],
			  'venue_website_link_target' => $atts['venue_website_link_target'],
			  'organizer_website_link_target' => $atts['organizer_website_link_target'],
			  'enable_organizer_website_linkable' => $atts['enable_organizer_website_linkable'],
			  'enable_venue_website_link' => $atts['enable_venue_website_link'],
			  'event_tag' =>'false',
			  'hide_comma_tag' => $atts['hide_comma_tag'],
			  'hide_comma_cat' => $atts['hide_comma_cat'],
			  'enable_tag_links' => $atts['enable_tag_links'],
			  'schema' => 'true',
			  'message' => 'This event has passed.',
			  'key' => 'End Date',
			  'order' => 'ASC',
			  'orderby' => 'startdate',
			  'viewall' => 'false',
			  'excerpt' => 'false',
			  'showdetail' => 'false',
			  'thumb' => 'false',
			  'organizer_thumb' => 'false',
			  'venue_thumb' => 'false',
			  'thumbsize' => '',
			  'thumbsizeOrg' => '',
			  'thumbsizeVenue' => '',
			  'thumbwidth' => '800',
			  'thumbheight' => '800',
			  'contentorder' => apply_filters( 'decm_details_order', ' thumbnail, organizer_thumbnail, venue_thumbnail,pass_message,title, title2,description, date, venue, location, google_link,google_link_check, venue_phone, venue_weburl, organizer, organizer_phone, organizer_email, organizer_weburl, categories, event_tag, price, show_rsvp_feed , show_price_ticket,  excerpt,weburl,checkgooglemaplink,googlemap,dateTimeSeparator,timeRangeSeparator, event_series_name, showdetail, event_status_check', $atts ),
			  'event_tax' => '',
			  'date_format' => '',
			  'time_format' => '',
			  'layout' => '',
			  'columns' => '',
			  'button_align' => 'false',
			  'image_align' => '',
			  'cards_spacing' => '',
			  'blog_offset' => '',
			  'view_more_text' => 'View More',
			  'columns_phone' => '',
			  'columns_tablet' => '',
			  'included_categories' => '',
			  'header_level' => '',
			  'show_data_one_line' => '',
			  'show_preposition' => '',
			  'render_slug' => '',
			  'use_current_loop' => 'false',
			  'custom_icon' => '',
			  //'ajax_load_more_button_icon'=>'',
			  //'pagination_type' =>'',
			  'align'    => '',
			  'show_icon_label'=>'',
			  'google_api_key_customize'=>'',
			  'add_url'=>'',
			   
  
		  ), $atts ), $atts, 'decm-events-atts' );
  
	  
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
  
		  if ( $atts['time'] == 'past' || !empty( $atts['past'] ) ) {
			  $meta_date_compare = '<';
			  $atts['order'] = 'ASC';
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
		  $atts['meta_date'] = array(
			  array(
				  'key' => $atts['key'],
				  'value' => $meta_date_date,
				  'compare' => $meta_date_compare,
				  'type' => 'DATETIME'
			  )
		  );
		  
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
			  //$atts['past']='';
			  if($atts['past']=='yes'){
				  $atts['order']="DESC";
			  }
			  else{
				  $atts['order']='ASC';
			  }
  
		  $atts = apply_filters( 'decm_event_calender_atts', $atts, $meta_date_date, $meta_date_compare );
		  
	  
		  
  
		  $post_type = get_post_type( $current_page['id'] );
		  
		  $args = apply_filters( 'decm_fetch_events_atts', array(
			  'post_status' => 'publish',
			  'posts_per_page' => $atts['limit'],
			  'tax_query'=> $atts['event_tax'],//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
			 
			   'order' => $atts['order'],
			  'offset' => $atts['blog_offset'],
			  'included_categories' =>  $atts['included_categories'],
			  'meta_query' => apply_filters( 'dec_get_meta_query', array( $atts['meta_date'] ), $atts, $meta_date_date, $meta_date_compare ),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

          ), $atts, $meta_date_date, $meta_date_compare );
		  //et_body_layout
		  if($atts['use_current_loop'] == "false"){
		  if($post_type == 'tribe_events')
		  {
			  $args['ID'] = $current_page['id'];
		  }
	  }
		  $event_posts = tribe_get_events( $args );
		  $virtual_event_object = '';
		  if (isset($first_event_post->ID)) {
			$virtual_event_object = tribe_get_event($first_event_post->ID) ? tribe_get_event($first_event_post->ID) : '';
		} else {
			$virtual_event_object = '';
		}
		//   $virtual_event_object =	tribe_get_event($event_posts->ID) ? tribe_get_event($event_posts->ID) : '' ;
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
						   */
						  $category_names[] = $atts['enable_category_link']=="on"?'<a href="'.get_category_link( $category->term_id ).'" target="'.$atts['category_link_target'].'">'.$category->name.'</a>':$category->name;
						  
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
						$tag_enable_link = $atts['enable_tag_links'] == 'on' ? '<a href="'.get_term_link( $tag->term_id ).'" target="'.esc_attr($atts['custom_tag_link_target']).'" >'.esc_attr($tag->name).'</a>' : '<span>'.esc_attr($tag->name).'</span>';
						$tag_names[] = '<span class= "decm_tag ecs_tag_'.esc_attr($tag->slug).'" >'.$tag_enable_link.'</span>';
					}
				}
				  $get_end_time_offset=Tribe__Events__Timezones::event_end_timestamp( $event_post->ID);

				  $get_current_time_offset=strtotime( gmdate('Y-m-d H:i:s')) + get_option( 'gmt_offset' ) * 3600 ;
				 
				  $custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?__("View Events Website",'decm-divi-event-calendar-module'):$atts['custom_website_link_text'];


				  foreach ( apply_filters( 'decm_events_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					  switch ( trim( $contentorder ) ) {
						case'pass_message':
							// if($get_end_time_offset < $get_current_time_offset) {
								$atts['posts'][$index]['pass_message'] =$atts['message'];
							//}
							break;  
						case 'title':
							  $atts['posts'][$index]['title']= get_the_title($event_post->ID);
							  break;
						  case 'title2':
							  $atts['posts'][$index]['title2']= get_the_title($event_post->ID);
							  break;
						  /**
						   * Show Author Name of every events
						   *
						   * @author bojana
						   */

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
												? '<span class="decm_price"><a class="show_rsvp_feed_custom" href="' . $event_link . '">'.' '. __('Respond Now', 'decm-divi-event-calendar-module') . '</a></span>'
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
							//   $atts['posts'][$index]['price']= " ".tribe_get_cost($event_post->ID, true );
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
												
												 $Purchase_Now = $atts['show_ticket_feed_respond'] == 'on' ? '<a href="' . $event_link . '" class="price_link_ticket price_link_custom__a" >'.' '.__('Purchase Now', 'decm-divi-event-calendar-module').'</a> '  : '';
												 $spaceRespond = $atts['show_ticket_feed_respond'] == 'on' && $atts['show_ticket_feed_left'] == 'on' ? ' - ' : ' ';	
												 $show_ticket_feed_left = $atts['show_ticket_feed_left'] == 'on'  ? esc_html($Place_left) :'';
												 $ticket__label = $Purchase_Now.esc_html($spaceRespond) . ' ' . esc_html($show_ticket_feed_left);
											}
										}
									}else {
										// If 'tickets' key does not exist, set default values
										// $event__price = "Free"; // Assume free if no ticket data
										$event__price =  __('Free', 'decm-divi-event-calendar-module');
										$ticket__label = ''; // No additional label
									}
									$atts['posts'][$index]['show_price_ticket'] = '<span class="decm_price Tciket_Custom__a">' . " " . $event__price . $ticket__label . '</span>';
								}else{
									$atts['posts'][$index]['show_price_ticket'] = '';
								}	
							}		
						  break;

						  case 'price':
							$atts['posts'][$index]['price']= " ".tribe_get_cost($event_post->ID, true );
						break;

						  case 'weburl':
							  
							  $atts['posts'][$index]['weburl' ]=($atts['website_link']=='custom_text' || $atts['website_link']=='default_text') ?'<a href="'.tribe_get_event_meta($event_post->ID, '_EventURL', true ).'" target="'.$atts['custom_website_link_target'].'">'.$custom_website_link_text.'</a>':tribe_get_event_website_link($event_post);
						  break;

						//   case 'organizer':

						// 	$organizers = tribe_get_organizer_ids($event_post->ID );
			            //         $orgName = array();
						// 		foreach ($organizers as $key => $organizerId) {
						// 			$orgName[$key] =$atts['enable_organizer_link']=="on"? tribe_get_organizer_link($organizerId):tribe_get_organizer($organizerId);
						// 	}

						// //	$orgNames	= implode(', ', $orgName);

						// 	$atts['posts'][$index]['organizer'] ='<span class="decm_organizer">'. $orgName.'</span>';
						// 		//$event_output.='</div>';
						// 	break;
						
							case 'organizer':
								$organizers = tribe_get_organizer_ids($event_post->ID );
									$orgName = array();
									foreach ($organizers as $key => $organizerId) {
										$orgName[$key]=$atts['enable_organizer_link']=="on"?tribe_get_organizer($organizerId):tribe_get_organizer($organizerId);
								}
								$atts['posts'][$index]['organizer'] =  $orgName;
									//$event_output.='</div>';
								break;

							  case 'organizer_phone':
						
								  $atts['posts'][$index]['organizer_phone'] = " ".tribe_get_organizer_phone($event_post->ID)."</span>";
						
							  break;
						  case 'organizer_weburl':
							      $organizer_website_link = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_organizer_website_link($event_post->ID), $result_organizer_website_link);
			                      $result_organizer_website_link =  isset($result_organizer_website_link['href'][0]) ? sanitize_text_field( wp_unslash($result_organizer_website_link['href'][0]) ) : sanitize_text_field( wp_unslash("") );
							      $organizer_website = $atts['enable_organizer_website_linkable']=="on"?'<a href="'.$result_organizer_website_link.'" target="'.$atts['organizer_website_link_target'].'">'.__('View Organizer Website','decm-divi-event-calendar-module').'</a>':'<span>'.__('View Organizer Website','decm-divi-event-calendar-module').'</span>';
								  $atts['posts'][$index]['organizer_weburl'] = " ".$organizer_website;
						
							  break;
						  case 'organizer_email':
						
								  $atts['posts'][$index]['organizer_email'] = $atts['organizer_email_linkable']=="on"?'<a href="mailto:'.tribe_get_organizer_email($event_post->ID).'">'.tribe_get_organizer_email($event_post->ID).'</a>':tribe_get_organizer_email($event_post->ID);
						
							  break;
						  case 'event_tag':
							$excerptLength='';
							$tags = $atts['hide_comma_tag'] == 'off' ? implode(", ", $tag_names): implode(" ", $tag_names);
									$tags_separator = $tags ? ' | ' : ' ';
							    $tags_sep  =	$atts['show_preposition'] == 'true' ? $tags_separator : " ";
								$atts['posts'][$index]['event_tag'] = apply_filters( 'decm_events_tag_start', '<span class="ecs-tag">', $atts, $event_post ) .
								et_core_intentionally_unescaped( $tags_sep, 'fixed_string' ) .
								apply_filters( 'decm_events_tags', et_core_esc_wp( $tags ), 
								$atts, $event_post, $excerptLength ) .
								//et_core_intentionally_unescaped( $tags_separator, 'fixed_string' );
								apply_filters( 'decm_events_tags_end', '</span>', $atts, $event_post );
							  //    $sep =  $atts['hide_comma_tag'] == "off" ? ', ': ' ';
								//  $atts['posts'][$index]['event_tag'] =" ".get_the_term_list( $event_post->ID, 'post_tag',$before = '', $sep, $after = '' );
					  
							  break;	  
								  
						  case 'thumbnail':
							  $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
							  $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
  
							  $atts['posts'][$index]['thumb'] = get_the_post_thumbnail_url($event_post->ID,array( 800, $thumbHeight ));
							  break;

						   case 'organizer_thumbnail':
								$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
								$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
								$organizer_id = tribe_get_organizer_id($event_post->ID);
	
								$atts['posts'][$index]['organizer_thumb'] = get_the_post_thumbnail_url($organizer_id,array( 400, $thumbHeight ));
								break;
							case 'venue_thumbnail':
								$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
								$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
								$ven_id = tribe_get_venue_id($event_post->ID);
	
								$atts['posts'][$index]['venue_thumb'] = get_the_post_thumbnail_url($ven_id,array( 400, $thumbHeight ));
								break;
  
						  case 'excerpt':
								  $excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 270;
								  $atts['posts'][$index]['excerpt'] = self::get_excerpt($event_post->ID, $excerptLength ); 
							  break;
  
  
  
						  case 'date':
							  $atts['posts'][$index]['date'] = apply_filters( 'decm_events_date_tag_start', '<span class="duration time">', $atts, $event_post ) .apply_filters( 'decm_events_list_details', tribe_events_event_schedule_details($event_post->ID), $atts, $event_post ) .apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								  $Sdate = '';
								  $Edate = '';
								  $STime = '';
								  $ETime = '';
								  $set_timezone='';
								  $set_timezone = $atts['show_timezone_abb'] == 'off'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):" ".Tribe__Events__Timezones::get_event_timezone_abbr($event_post->ID );
								  if($atts['date_format'])
								  {
									  $Sdate = tribe_get_start_date($event_post->ID,null,$atts['date_format']);
									  $Edate = tribe_get_end_date($event_post->ID,null,$atts['date_format']);
								  }
								  
								  if(empty($atts['date_format']))
								  {
									  $Sdate = tribe_get_start_date($event_post->ID,null,get_option('date_format'));
									  $Edate = tribe_get_end_date($event_post->ID,null,get_option('date_format'));
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
								  
								  $atts['posts'][$index]['date'] =  $Sdate.' @ '.$STime.'~*~'.$Edate.' @ '.$ETime.'~*~'.$set_timezone;
					
						  break;
  
						  case 'venue':
							  if (  function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
								  $atts['posts'][$index]['venue'] =tribe_get_venue($event_post->ID);
							  }
							  break;
						  case 'venue_phone':
							 
							  $atts['posts'][$index]['venue_phone'] =" ".tribe_get_phone($event_post->ID);
							
							  break;
							case 'venue_weburl':

							   $link_venue_website = preg_match_all('/<a[^>]+href=([\'"])(?<href>.+?)\1[^>]*>/i', tribe_get_venue_website_link($event_post->ID), $result_venue_website);
								$result_venue_website =  isset($result_venue_website['href'][0]) ? sanitize_text_field( wp_unslash($result_venue_website['href'][0]) ) : sanitize_text_field( wp_unslash("") );
								$enable_venue_web_link = $atts['enable_venue_website_link']=="on"?'<a href="'.$result_venue_website.'" target="'.$atts['venue_website_link_target'].'">'.__('View Venue Website','decm-divi-event-calendar-module').'</a>':'<span>'.__('View Venue Website','decm-divi-event-calendar-module').'</span>';
							  
								  $atts['posts'][$index]['venue_weburl'] =" ".$enable_venue_web_link;
							  
							  break;
							case 'google_link':
							  
							  $atts['posts'][$index]['google_link'] =" ".tribe_get_map_link_html( $event_post->ID,$atts['map_width'],$atts['map_height']);
							
							  break;
							  case 'google_link_check':
							  
								$atts['posts'][$index]['google_link_check'] = get_post_meta( $event_post->ID, '_EventShowMapLink', true );
							  
								break;
							 
						  /**
						   * Show location of venue
						   *
						   * @author bojana
						   *
						   */
						  case 'location':
							  if ( function_exists( 'tribe_get_full_address' ) and tribe_get_full_address($event_post->ID)) {
								$atts['posts'][$index]['location'] = $atts['enable_location_link']=="on"? '<a href="#" target="'.$atts['custom_location_link_target'].'">'.tribe_get_address($event_post->ID).','.tribe_get_city($event_post->ID).','.tribe_get_zip($event_post->ID).','.tribe_get_country($event_post->ID).'</a>' : tribe_get_address($event_post->ID).','.tribe_get_city($event_post->ID).','.tribe_get_zip($event_post->ID).','.tribe_get_country($event_post->ID); 
							  }
							  break;
						case 'location_province':
								if ( function_exists( 'tribe_get_full_address' ) and  (tribe_get_address($event_post->ID) != "" || tribe_get_city($event_post->ID) != "" || tribe_get_zip($event_post->ID) != "" || tribe_get_country($event_post->ID) != "" || tribe_get_province($event_post->ID)!="") ) {
									$atts['posts'][$index]['location_province'] =tribe_get_province($event_post->ID)." "; 
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
								  $categories_separator = $categories ? '|' : '';
								  $atts['posts'][$index]['categories'] = apply_filters( 'decm_events_categories_tag_start', '<span class="ecs-categories">', $atts, $event_post ) .
								  et_core_intentionally_unescaped( $categories_separator, 'fixed_string' ) .
								  apply_filters( 'decm_events_categories', et_core_esc_wp( $categories ), 
								  $atts, $event_post, $excerptLength ) .
								  et_core_intentionally_unescaped( $categories_separator, 'fixed_string' );
								  apply_filters( 'decm_events_categories_tag_end', '</span>', $atts, $event_post );
							  break;
						  /**
						   * Show more in detail of every events
						   *
						   * @author bojana
						   */
							case 'checkgooglemaplink':
								$atts['posts'][$index]['checkgooglemaplink']=get_post_meta( $event_post->ID, '_EventShowMap', true );
								break;

						  case 'googlemap':
							$atts['posts'][$index]['googlemap']=get_post_meta( $event_post->ID, '_EventShowMap', true )=="1"? str_replace(' ','+',tribe_get_address( $event_post->ID)).'+'.str_replace(' ','+',tribe_get_city($event_post->ID)).'+'.str_replace(' ','+',tribe_get_region($event_post->ID)).'+'.str_replace(' ','+',tribe_get_zip($event_post->ID)):"";
							//$atts['posts'][$index]['googlemap'] =tribe_get_embedded_map($event_post->ID); 
							//$atts['posts'][$index]['googlemap'] ='<iframe width="100%" height="350px" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key='.$atts['google_api_key_customize'].'&q=Johar+town+lahore+punjab+5200+" allowfullscreen="">
							//	</iframe>'; 		
						break; 
						case 'dateTimeSeparator':
							$atts['posts'][$index]['dateTimeSeparator'] =tribe_get_option( 'dateTimeSeparator', ' @ ' );		
						break; 
						case 'timeRangeSeparator':
							$atts['posts'][$index]['timeRangeSeparator'] =tribe_get_option( 'timeRangeSeparator', ' - ' );		
						break; 
						case 'description':
							$atts['posts'][$index]['description'] = get_the_content($event_post->ID); 		
						break;  
						case 'date_thumb':
								  $atts['posts'][$index]['date_thumb']['M'] =tribe_get_start_date( null, false, 'M' ); 
								  $atts['posts'][$index]['date_thumb']['J'] =tribe_get_start_date( null, false, 'j' ); 
								  
							  break;
						case 'event_series_name';
							  if( function_exists("tec_event_series")) { 

							$enable_series_link=$atts['enable_series_link']=='on'? '<a href="'.tec_event_series( $event_post->ID )->guid.'" class="diec-events-series-relationship-single-marker__title tribe-common-cta--alt" target="'.$atts['custom_series_link_target'].'"><span class="diec_series_marker__title">'.tec_event_series( $event_post->ID )->post_title.'</span></a>':'<span class="diec_series_marker__title">'.tec_event_series( $event_post->ID )->post_title.'</span>';
								
							if($atts['event_series_name']=='on'){

								$atts['posts'][$index]['event_series_name'] = $enable_series_link;
							//	$atts['posts'][$index]['event_series_name'] =  '<div>'.$showicon.$showlabel.$stacklabel.$enable_series_link.'</div>';
							}
						}	
							break;
							  case 'event_status_check':
								$event_virtual=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="virtual"?'
								<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--virtual tribe-events-virtual-virtual-event__icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 16" style="font-size: 5px !important;margin: 0px !important;width: 24px;height: 12px;/* display: flex; */">
								<g fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)">
								<path d="M18 10.7333333c2.16-2.09999997 2.16-5.44444441 0-7.46666663M21.12 13.7666667c3.84-3.7333334 3.84-9.80000003 0-13.53333337M6 10.7333333C3.84 8.63333333 3.84 5.28888889 6 3.26666667M2.88 13.7666667C-.96 10.0333333-.96 3.96666667 2.88.23333333" class="tribe-common-c-svgicon__svg-stroke"></path><ellipse cx="12" cy="7" rx="2.4" ry="2.33333333" class="tribe-common-c-svgicon__svg-stroke"></ellipse></g></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'. tribe_get_virtual_event_label_singular().' </span>':"";
								$event_hybrid=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="hybrid"?'
								<svg class="tribe-common-c-svgicon tribe-common-c-svgicon--hybrid tribe-events-virtual-hybrid-event__icon-svg" viewBox="0 0 15 13" fill="none" style="width: 24px;height: 12px;" xmlns="http://www.w3.org/2000/svg">
								<circle cx="3.661" cy="9.515" r="2.121" transform="rotate(-45 3.661 9.515)" stroke="#0F0F30" stroke-width="1.103"></circle><circle cx="7.54" cy="3.515" r="2.121" transform="rotate(-45 7.54 3.515)" stroke="#0F0F30" stroke-width="1.103"></circle>
								<path d="M4.54 7.929l1.964-2.828" stroke="#0F0F30"></path><circle r="2.121" transform="scale(-1 1) rotate(-45 5.769 18.558)" stroke="#0F0F30" stroke-width="1.103"></circle>
								<path d="M10.554 7.929L8.59 5.1" stroke="#0F0F30"></path></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'. tribe_get_hybrid_event_label_singular().' </span>':"";
								
								$event_virtual_hybrid_notice_tag = $atts['event_virtual_hybrid_notice']=='on' && tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true) ?'<div  class="ecs_event_status_virtual_hybrid">'.$event_virtual.$event_hybrid.' </div>':"";
								$event_stutus_tag = $atts['event_status_notice']=='on' && tribe_get_event_meta($event_post->ID,'_tribe_events_status', true) ? '<div  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'">'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).' </div>': "";
                                $event_status_reason = $atts['event_status_reason']=='on' &&	tribe_get_event_meta($event_post->ID,'_tribe_events_status_reason', true)?'<div  class="ecs_event_status_reason">'.tribe_get_event_meta($event_post->ID,'_tribe_events_status_reason', true).' </div>':"";
								$atts['posts'][$index]['event_status_check']= $event_stutus_tag.$event_status_reason.$event_virtual_hybrid_notice_tag;
							// case 'total_count':							
							// 	$atts['total_events'] = $total_events;							
							break;
						  default:
						  $atts['posts'][$index]['contentorder'] = strtolower( trim( $contentorder ) );
					  }
				  }
			  }
			  

		  }  // endif

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
  
		  $excerpt = preg_replace( " (\[.*?\])", '', $excerpt );
		  $excerpt = wp_strip_all_tags( strip_shortcodes($excerpt) );
		  $excerpt = trim( preg_replace( '/\s+/', ' ', $excerpt ) );
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

new DIEC_EventPage;