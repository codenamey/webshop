<?php

class DIEC_EventCarousel extends ET_Builder_Module {

	public $slug       = 'diec_event_carousel';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Carousel', 'decm-divi-event-calendar-module');
	}
	
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
					  'carousel_option' => array(
						  'priority' => 20,
						  'title' => esc_html__( 'Carousel Options', 'decm-divi-event-calendar-module'),
					  ),
					  'more_info_button' => array(
						'priority' => 40,
						'title' => esc_html__( 'More Info Button', 'decm-divi-event-calendar-module'),
					),					
					'no_results_message' => array(
						'priority' => 45,
						'title' => esc_html__( 'No Results Message', 'decm-divi-event-calendar-module'),
					),
					'admin_label' => array(
						'priority' => 99,
						'title' => esc_html__( 'Admin Label', 'decm-divi-event-calendar-module'),
					),
					  
				  ),
			  ),
			  'advanced' => array(
				  'toggles' => array(
					  'layout'  => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					  'event'  => esc_html__( 'Events', 'decm-divi-event-calendar-module' ),
					  'thumbnail'  => esc_html__( 'Image', 'decm-divi-event-calendar-module' ),
					  'carousel' =>esc_html__('Carousel','decm-divi-event-calendar-module'),
				  ),
			  ),
		  );
	  }
	  function get_advanced_fields_config() {
		return array(
			'text'           => false,
			'button'         =>false,
			
			'background'            => array(
				'has_background_color_toggle' => true,
				'css' => array(
					'main' => "%%order_class%%",
				),
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
							'border_radii'  => "%%order_class%%",
							'border_styles'  => "%%order_class%%",
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
							'border_radii'  => "%%order_class%% .ecs-event-list .ecs-event .act-post .wp-post-image",
							'border_styles' => "%%order_class%% .ecs-event-list .ecs-event .act-post .wp-post-image",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Image Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'thumbnail',
					'defaults' => array(
						'border_radii' => 'on|4px|4px|4px|4px',
						'border_styles' => array(
							'style' => 'solid',
						),
					),
				),
				'navigation_border'   => array(
					'css'          => array(
						'main' => array(
							'border_radii'  => "%%order_class%% .owl-prev:before,%%order_class%% .owl-next:before",
							'border_styles' => "%%order_class%% .owl-prev:before,%%order_class%% .owl-next:before",
							
						),
						'important' => 'all',
					),
					'label_prefix' => esc_html__( 'Navigation Border', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'carousel',
					//'default'          => 'solid',
				),
				'event_border'   => array(
					'css'          => array(
						'main' => array (
							'border_radii' =>"%%order_class%% .ecs-event .act-post",
							'border_styles' =>"%%order_class%% .ecs-event .act-post",
							
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
			),
		
			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main' => "%%order_class%%",
					),
				),
				
			'image_box_shadow'     => array(
					'css' => array(
						'main' => "%%order_class%% .ecs-event-list  .ecs-event .act-post  .wp-post-image",
					),
					'label'         => esc_html__( 'Image Box Shadow Settings', 'decm-divi-event-calendar-module' ),
					'description'        => esc_html__( 'Add and customize the box shadow for the event featured image with all the standard box shadow settings.', 'decm-divi-event-calendar-module' ),
					'tab_slug'     => 'advanced',
					'toggle_slug'  => 'thumbnail',
					//'default'          => 'solid',
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
				'title' => array(
					'css'          => array(
						'main'      => "%%order_class%% .entry-title, %%order_class%% .entry-title a",
						//'font' => "%%order_class%% .entry-title , %%order_class%% .entry-title a",
						'important' => 'all',
					),
					'header_level' => array(
						'css'          => array(
							'main'      => "%%order_class%% .entry-title, %%order_class%% .entry-title a",
							'important' => 'all',
						),
						// 'default' => 'h2',
						// 'computed_affects' => array(
						// 	'__posts',
						// 	'__getEvents',
						// ),
					),
					'label'        => esc_html__( 'Title', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event title text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),
				'duration' => array(
					'css'          => array(
						'main'      => "%%order_class%% div.decm-show-detail-center,%%order_class%% span.duration,%%order_class%% span.ecs-venue,%%order_class%% span.location, %%order_class%% span.ecs-organizer,%%order_class%% span.ecs-price,%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a",
						'important' => 'all',
					),
					'toggle_priority' => 80,
					'label'        => esc_html__( 'Details', 'decm-divi-event-calendar-module' ),
					//'description'     => esc_html__( 'Customize and style the event details text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
				),

				'excerpt' => array(
					'css'          => array(
						'main'      => "%%order_class%% p.ecs-excerpt",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Excerpt', 'decm-divi-event-calendar-module' ),
					'description'     => esc_html__( 'Customize and style the event excerpt text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
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
					'box_shadow'     => array(
						'css' => array(
							'main' => '%%order_class%% .act-view-more',
							'important' => 'all',
						),
					),
					
					'use_alignment' => true,
					//'box_shadow'    => true,
					'use_alignment'=>array(
					'alignment'=>array(
						//'label'            => esc_html__( 'Button Alignment', 'decm-divi-event-calendar-module' ),
						'description' => esc_html__( 'Rows can be aligned to the left, right or center. By default, rows are centered within their parent section.', 'decm-divi-event-calendar-module' ),		
					),),
					'custom_view_more'=>array(
						//'label'            => esc_html__( 'Button Alignment', 'decm-divi-event-calendar-module' ),
						'description' => esc_html__( 'Rows can be aligned to the left, right or center. By default, rows are centered within their parent section.', 'decm-divi-event-calendar-module' ),		
					),
					'margin_padding' => array(
						'css' => array(
							'margin' => "%%order_class%% p.ecs-showdetail",
					         'padding' => "%%order_class%% .act-view-more",
							//'main'      => "%%order_class%% .et_pb_button_wrapper,%%order_class%% a.et_pb_button",
							'important' => 'all',
						),
						'custom_margin' => array(
							//'description' => esc_html__( 'Rows can be aligned to the left, right or center. By default, rows are centered within their parent section.', 'decm-divi-event-calendar-module' ),	
					'default' => '15px|auto|15px|auto|false|false',
				),
					),
					
				),
				
            ),

		);
	}
	public function get_fields() {
		return array(

		
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
	

			'use_current_loop'=> array(
				'label'				=> esc_html__( 'Dynamic Event Content', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'layout',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to turn on or off dynamic content for the module, which allows you to place the module in a Divi Theme Builder layout to dynamically display event categories for the current category or page. This will also work on the single event pages and for the Theme Builder search results page!', 'decm-divi-event-calendar-module' ),
				
				'toggle_slug'     => 'decm_content',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
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
			'show_date'=> array(
				'label'				=> esc_html__( 'Show Date', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the event date.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_date'=>'on',
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
				'toggle_slug'		=> 'elements',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
					'show_time'=>'on',
					'show_date'=>'on',
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
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'elements',
				'default'			=> 'off',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'elements',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'elements',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'elements',
				'computed_affects'   => array(
					'__posts',
					'__getEvents',
				),
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
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
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
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
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			/* Elements from event calendar shortcode pluin */
		
			'show_preposition'=> array(
				'label'				=> esc_html__( 'Show Prepositions & Dividers', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show or hide the prepositions and dividers in the event details. This setting is best used with the option to stack event details.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
				'default'			=> 'on',
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
				'toggle_slug'     => 'elements',
				'default'			=> 'off',
				'affects'         => array(
					'show_icon_label'
				),
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
		
			'show_icon_label' => array(
                'label'           => esc_html__( 'Show Labels Or Icons', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose to add labels or icons before each event item. This setting is best used with the option to stack event details.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    'none'   => __( 'None',  'decm-divi-event-calendar-module' ),
                    'label'   => __( 'Labels', 'decm-divi-event-calendar-module' ),
                    'icon'   => __( 'Icons', 'decm-divi-event-calendar-module' ),
                  
                ],
                
                'tab_slug'		  => 'general',
                //'mobile_options'  => true,
                'toggle_slug'     => 'elements',
				 'default' => 'none',
			),
		

			/* Content Options from Blog Module */
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
				'default'           => 5,
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
			'included_categories' => array(
				'label'            => esc_html__( 'Included Categories', 'decm-divi-event-calendar-module' ),
				'type'             => 'categories',
				// 'meta_categories'  => array(
				// 	'all'     => esc_html__( 'All Categories', 'decm-divi-event-calendar-module' ),
				// 'current' => esc_html__( 'Current Category', 'decm-divi-event-calendar-module' ),
				// ),
				
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
				'default'		   => $this->module_classname( 'diec_event_carousel' ),
			),
			'date_format' => array(
				'label'             => esc_html__( 'Date Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same date format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP date format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_content',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),

			'time_format' => array(
				'label'             => esc_html__( 'Time Format', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'By default, the module will use the the same time format that you have set in WordPress Settings>General. However, if you would like to override those, you can input the appropriate PHP time format here.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_content',
				'computed_affects'  => array(
					'__posts',
					'__getEvents',
				),
				//'default'           => 'M j, Y',
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),


			'excerpt_length' => array(
				'label'             => esc_html__( 'Excerpt Length', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'If you are showing the event excerpt, this setting allows you to set a specific character limit for the text. The WordPress default is 270 characters.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'       => 'decm_content',
				'default'           => '270',
				'computed_affects'  => array(
					//'__posts',
					'__getEvents',
				),
				'show_if' => array(
					'use_shortcode'=>'off',
				)
			),
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
			'show_past'=> array(
				'label'				=> esc_html__( 'Only Show Past Events', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
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
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
                    '1'   => __( '1 Column',  'decm-divi-event-calendar-module' ),
                    '2'   => __( '2 Columns', 'decm-divi-event-calendar-module' ),
                    '3'   => __( '3 Columns', 'decm-divi-event-calendar-module' ),
                    '4'   => __( '4 Columns', 'decm-divi-event-calendar-module' ),
                ],
                'affects'         => array(
					'iamge_align',
					//'autoplay_hoverpause'
				),
                'tab_slug'		  => 'advanced',
                //'mobile_options'  => true,
                'toggle_slug'     => 'layout',
                'computed_affects' => array(
                    '__posts',
					'__getEvents',
				),
				 'default' => '1',
			),
			
			'image_align' => array(
                'label'           => esc_html__( 'Alignment', 'decm-divi-event-calendar-module' ),
				'description'		=> esc_html__( 'Choose the alignment of the event featured image and details. Note that the alignment is sometimes dependent on the number of columns chosen.', 'decm-divi-event-calendar-module' ),
				'type'            => 'select',
                'option_category' => 'layout',
                'options'		=>[
					'leftimage_rightdetail'   => __( 'Image Left, Details Right',  'decm-divi-event-calendar-module' ),
					'topimage_bottomdetail'   => __( 'Image Top,  Details  Bottom',  'decm-divi-event-calendar-module' ),
					'rightimage_leftdetail'   => __( 'Image Right, Details Left',  'decm-divi-event-calendar-module' ),
					//'centerimage_bottomdetail'   => __( 'Image Top Center, Details Bottom',  'decm-divi-event-calendar-module' ),

                    // 'blog_layout'   => __( 'Like blog posts', 'decm-divi-event-calendar-module' ),
                ],
                'default'         => 'leftimage_rightdetail',
                'tab_slug'		  => 'advanced',
               // 'mobile_options'  => false,
				'toggle_slug'     => 'layout',
				// 'computed_affects' => array(
                //     '__posts',
				// 	'__getEvents',
				// ),
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
				// 'css'      => array(
				// 	'main' =>"{$this->main_css_element} .ecs-event-list  .ecs-event .act-post",
				// ),
				'tab_slug'          => 'advanced',
				'toggle_slug'       => 'event',
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'details_link_color' => array(
				'label'             => esc_html__( 'Details Link Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'You can pick unique background colors for Events.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				'toggle_priority' => 12,
				'toggle_slug'       => 'duration',
				'priority' => 20,
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'details_icon_color' => array(
				'label'             => esc_html__( 'Icon Color Picker', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the link text in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'duration',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'details_label_color' => array(
				'label'             => esc_html__( 'Label Color Picker', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'Choose a color for the link text in the event details.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				
				'toggle_slug'       => 'duration',
				
				// 'hover'             => 'tabs',
				'mobile_options'    => true,
			),
			'arrow_backgound_color' => array(
				'label'             => esc_html__( 'Navigation Background Color', 'decm-divi-event-calendar-module' ),
				'description'       => esc_html__( 'You can pick unique background colors for Event Carousel Arrows.', 'decm-divi-event-calendar-module' ),
				'type'              => 'color-alpha',
				'custom_color'      => true,
				
				'tab_slug'          => 'advanced',
				'toggle_priority' => 12,
				'toggle_slug'       => 'carousel',
				'priority' => 20,
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
					//'image_align',
					'columns',
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
				'computed_callback' => array( 'DIEC_EventCarousel', 'get_blog_posts_events' ),
				'computed_depends_on'  => array(
					'event_count',
					'date_format',
					'time_format',
					'show_name',
					'show_past',
					'blog_offset',
					'included_categories',
					//'image_align',
					'excerpt_length',
					'button_align',
					//'header_level',
					

				),
			),

			//Extra Design settings
			'view_more_text' => array(
                'label'           => esc_html__( 'More Info Button Text', 'decm-divi-event-calendar-module' ),
                'type'            => 'text',
                'option_category' => 'basic_option',
                'description'     => esc_html__( 'Enter custom text for the button.', 'decm-divi-event-calendar-module' ),
                'toggle_slug'     => 'more_info_button',
                'default'         => 'More Info',
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
				//'mobile_options'  => true,
			),
			'thumbnail_margin' => array(
				'label' => __('Image Margin', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the outside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'thumbnail',
				'mobile_options'  => true,
			),
			'thumbnail_padding' => array(
				'label' => __('Image Padding', 'decm-divi-event-calendar-module'),
				'type' => 'custom_margin',
				'description' => __('Adjust the spacing around the inside of the event featured image.', 'decm-divi-event-calendar-module'),
				'tab_slug'        => 'advanced',
				'toggle_slug' => 'thumbnail',
				'mobile_options'  => true,
			),
			'thumbnail_width' => array(
				'label'           => esc_html__( 'Image Width', 'decm-divi-event-calendar-module' ),
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
				'mobile_options'  => true,
				
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
				
				'computed_affects'   => array(
					'__getEvents',
				),
			),

			
			'show_arrows'         => array(
				'label'           => esc_html__( 'Show Navigation Arrows', 'decm-divi-event-calendar-module' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'     => 'carousel_option',
				'description'     => esc_html__( 'Choose to show or hide the carousel next and previous navigation arrows.', 'decm-divi-event-calendar-module' ),
				'mobile_options'   => true,
				//'hover'            => 'tabs',
			),
			'show_control' => array(
				'label'             => esc_html__( 'Show Navigation Dots', 'decm-divi-event-calendar-module'),
				'type'              => 'yes_no_button',
				'option_category'   => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'default_on_front' => 'on',
				'toggle_slug'       => 'carousel_option',
				'description'       => esc_html__( 'Choose to show or hide the carousel navigation dots.', 'decm-divi-event-calendar-module' ),
				'mobile_options'   => true,
				//'hover'            => 'tabs',
			),
			'mouse_drag'      => array(
				'label'           => esc_html__( 'Mouse Drag', 'decm-divi-event-calendar-module' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'default_on_front' => 'on',
				//'tab_slug'        => 'general',
				'toggle_slug'     => 'carousel_option',
				'description'     => esc_html__( 'Enable the ability to drag the carousel slides using a mouse.', 'decm-divi-event-calendar-module' ),
			),
			'touch_drag'      => array(
				'label'           => esc_html__( 'Touch Drag', 'decm-divi-event-calendar-module' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'default_on_front' => 'on',
				//'tab_slug'        => 'general',
				'toggle_slug'     => 'carousel_option',
				'description'     => esc_html__( 'Enable the ability to drag the carousel slides on touch screens.', 'decm-divi-event-calendar-module' ),
			),
			'nav_font' => array(
				'label'           => esc_html__( 'Navigation Font size', 'decm-divi-event-calendar-module' ),
				'description' => __('Manually set the font size for navigation link.', 'decm-divi-event-calendar-module'),
				'type'            => 'range',
				'option_category' => 'layout',
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'carousel',
				'validate_unit'   => true,
				//'depends_show_if' => 'off',
				'default_unit'    => 'px',
				'default'         => '70',
				'allow_empty'     => true,
				'responsive'      => true,
				//'mobile_options'  => true,
				
			),
			'arrows_custom_color' => array(
				'label'        => esc_html__( 'Navigation Arrow Color', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Set a color for the carousel next and previous navigation arrows.', 'decm-divi-event-calendar-module' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'carousel',
			),
			'dot_nav_custom_color' => array(
				'label'        => esc_html__( 'Dot Navigation Color', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Set a color for the carousel navigation dots.', 'decm-divi-event-calendar-module' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'carousel',
			),
			'dot_nav_active' => array(
				'label'        => esc_html__( 'Active Dot Navigation Color', 'decm-divi-event-calendar-module' ),
				'description'     => esc_html__( 'Set a color for the carousel navigation active dot.', 'decm-divi-event-calendar-module' ),
				'type'         => 'color-alpha',
				'custom_color' => true,
				'tab_slug'     => 'advanced',
				'toggle_slug'  => 'carousel',
			),
			'autoplay'      => array(
				'label'           => esc_html__( 'Autoplay', 'decm-divi-event-calendar-module' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
				),
				'default_on_front' => 'on',
				'affects'         => array(
					'autoplay_speed',
					'autoplay_hoverpause'
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'carousel',
				'description'     => esc_html__( 'When enabled, carousel will start rotating automatically without the visitor needing to click the next and previous arrows.', 'decm-divi-event-calendar-module' ),
			),
			'autoplay_speed' => array(
				'label'             => esc_html__( 'Autoplay Speed', 'decm-divi-event-calendar-module' ),
				'type'              => 'range',
				'range_settings'    =>  array(
					'min' => '1000',
					'max' => '10000',
					'step' => '500'
				),
				'default' => '5000',
				//'validate_unit' => true,
				'unitless'        => true,
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Set the speed for the carousel automatic rotation in milliseconds. The higher the number the longer the pause between rotations.', 'decm-divi-event-calendar-module' ),
				'tab_slug'        => 'advanced',
				'toggle_slug'       => 'carousel',
				'computed_affects'  => array(
					'__fhcallback',
				),
			),
			'autoplay_hoverpause'      => array(
				'label'           => esc_html__( 'Continue Autoplay On Hover', 'decm-divi-event-calendar-module' ),
				'type'            => 'yes_no_button',
				'option_category' => 'configuration',
				'options'         => array(
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
				),
				'default_on_front' => 'off',
				'affects'         => array(
					'autoplay_time',
				),
				'tab_slug'        => 'advanced',
				'toggle_slug'     => 'carousel',
				'description'     => esc_html__( 'Choose to contine the carousel rotation even on mouse hover.', 'decm-divi-event-calendar-module' ),
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
	
	
    // {
    //     deactivate_plugins(plugin_basename(__FILE__));
    // }

	
	public function getrenderClassNameSelector($Classes,$render_slug){
		foreach((array) explode(' ',$Classes)  as $ClassName){
			if(strpos($ClassName,$render_slug.'_') !== false){
				return '.'.$ClassName;		
			}
		}
	}
	public function render( $attrs, $content, $render_slug) {
		// echo '<pre>';
		// print_r($this->props);
		// exit;
		$atts = array();
		$no_results_message = $this->props['result_message'];
		$use_shortcode = $this->props['use_shortcode'];
		$shortcode_param = $this->props['shortcode_param'];
		$show_feature_image = $this->props['show_feature_image'];
		$show_title = $this->props['show_title'];
		$show_name = $this->props['show_name'];
		$show_price = $this->props['show_price'];
		$show_weburl = $this->props['show_weburl'];	
     	$show_date = $this->props['show_date'];
		$show_time = $this->props['show_time'];
		$show_timezone = $this->props['show_timezone'];	
		$show_venue = $this->props['show_venue'];
		$show_location = $this->props['show_location'];
		$show_excerpt = $this->props['show_excerpt'];
		$show_category = $this->props['show_category'];
		$show_detail = $this->props['show_detail'];
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
		$details_label_color = $this->props ['details_label_color' ];
        $details_label_color_responsive_active = isset($this->props["details_label_color"]) && et_pb_get_responsive_status($this->props["details_label_color_last_edited"]);
        $details_label_color_tablet = $details_label_color_responsive_active && $this->props["details_label_color_tablet"] ? $this->props["details_label_color_tablet"] : $details_label_color;
        $details_label_color_phone = $details_label_color_responsive_active && $this->props["details_label_color_phone"] ? $this->props["details_label_color_phone"] : $details_label_color_tablet;
		$show_past = $this->props['show_past'];
		$show_data_one_line = $this->props['show_data_one_line'];
		
		$event_count = $this->props['event_count'];
		$included_categories = $this->props['included_categories'];
		$date_format = $this->props['date_format'];
		$time_format = $this->props['time_format'];
		//'time_format',
		$show_icon_label = $this->props['show_icon_label'];
		$excerpt_length = $this->props['excerpt_length'];
		$blog_offset = $this->props['blog_offset'];
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
		$view_more_alignment = $this->props["view_more_alignment"];
        $view_more_alignment_responsive_active = isset($this->props["view_more_alignment"]) && et_pb_get_responsive_status($this->props["view_more_alignment_last_edited"]);
        $view_more_alignment_tablet = $view_more_alignment_responsive_active && $this->props["view_more_alignment_tablet"] ? $this->props["view_more_alignment_tablet"] : $view_more_alignment;
        $view_more_alignment_phone = $view_more_alignment_responsive_active && $this->props["view_more_alignment_phone"] ? $this->props["view_more_alignment_phone"] : $view_more_alignment_tablet;
		$background_color       = $this->props['background_color'];
		$header_level           =  $this->props['title_level'] == "" ? 'h4' : $this->props['title_level'];
		$show_preposition       = $this->props['show_preposition'];
		$use_current_loop       = $this->props['use_current_loop'] ;
	
		$autoplay               = $this->props['autoplay'];
		$show_arrows            = $this->props['show_arrows'];
		$show_arrows_phone     = $this->props['show_arrows_phone'];
		$show_arrows_tablet     = $this->props['show_arrows_tablet'];
		$show_control           = $this->props['show_control'];
		$mouse_drag             = $this->props['mouse_drag'];
		$touch_drag             = $this->props['touch_drag'];
		$dot_nav_custom_color   = $this->props['dot_nav_custom_color'];
		$dot_nav_active         = $this->props['dot_nav_active'];
		$arrows_custom_color    = $this->props['arrows_custom_color'];
		$align                  = $this->props['align'];
		$autoplay_hoverpause    = $this->props['autoplay_hoverpause'];
		$autoplay_speed         = $this->props['autoplay_speed'];
		$nav_font               = $this->props['nav_font'];
		$arrow_backgound_color  = $this->props['arrow_backgound_color'];
		$custom_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'view_more_icon' );
		
		$custom_icon                     = isset( $custom_icon_values['desktop'] ) ? $this->props['view_more_icon'] == '' ? '' : esc_attr( et_pb_process_font_icon( $custom_icon_values['desktop'] ) ) : '';
		$custom_icon_tablet              = isset( $custom_icon_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['tablet'] ) ) : '';
		$custom_icon_phone               = isset( $custom_icon_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['phone'] ) ) : '';
		$custom_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'view_more_icon' );
		//$custom_icon_font_weight = explode("|",$custom_icon_values['desktop']);
	//	echo $custom_icon_font_weight[4];
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
            'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a",
            'declaration' => "color: {$details_link_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a",
            'declaration' => "color: {$details_link_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% p.ecs-weburl a, %%order_class%% .ecs-categories a",
            'declaration' => "color: {$details_link_color_phone} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
        ]);

		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before",
            'declaration' => "color: {$details_icon_color} !important;",
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before",
            'declaration' => "color: {$details_icon_color_tablet} !important;",
            'media_query' => \ET_Builder_Element::get_media_query('max_width_980'),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%% .categories-ecs-icon:before,%%order_class%% .eventTime-ecs-icon:before,%%order_class%% .eventDate-ecs-icon:before,%%order_class%% .weburl-ecs-icon:before,%%order_class%% .price-ecs-icon:before,%%order_class%% .event-location-ecs-icon:before,%%order_class%% .venue-ecs-icon:before,%%order_class%% .organizer-ecs-icon:before",
            'declaration' => "color: {$details_icon_color_phone} !important;",
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
		if ( '' !== $dot_nav_custom_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .owl-carousel .owl-dots .owl-dot",
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $dot_nav_custom_color )
				),
			) );
		}
		if ( '' !== $dot_nav_active ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .owl-carousel .owl-dots .active",
				'declaration' => sprintf(
					'background-color: %1$s;',
					esc_html( $dot_nav_active )
				),
			) );
		}
		if ( '' !== $arrows_custom_color ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .owl-prev:before,.owl-next:before",
				'declaration' => sprintf(
					'color: %1$s !important;',
					esc_html( $arrows_custom_color )
				),
			) );
		}
		if ( '' !== $nav_font ) {
			ET_Builder_Element::set_style( $render_slug, array(
				'selector'    => "%%order_class%% .owl-prev:before,.owl-next:before",
				'declaration' => sprintf(
					'font-size: %1$s !important;',
					esc_html( $nav_font )
				),
			) );
		}
			if ( '' !== $arrow_backgound_color ) {
				ET_Builder_Element::set_style( $render_slug, array(
					'selector'    => "%%order_class%% .owl-prev:before,.owl-next:before",
					'declaration' => sprintf(
						'background-color: %1$s !important;',
						esc_html( $arrow_backgound_color )
					),
				) );
			
		}
		


		//Margin & Padding
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_margin', 'margin', 
		'%%order_class%% img.wp-post-image');
		$this->apply_custom_margin_padding($render_slug, 'thumbnail_padding', 'padding', 
		'%%order_class%% img.wp-post-image', false);
		$this->apply_custom_width($render_slug, 'thumbnail_width', 'width', 
		'%%order_class%% img.wp-post-image');
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
			
			
			$contentorder = 'title, title2, date, venue, location, organizer, price,categories, excerpt,weburl, showdetail';
			if($image_align == 'rightimage_leftdetail')
			$contentorder .= ',thumbnail';
			else
			$contentorder = 'thumbnail,'.$contentorder;
			
			$attr = array(
				'cat' => $included_categories,
				'month' => '',
				'limit' => $event_count,
				'eventdetails' => $show_date == 'on' ? 'true' : 'false',
				'showtime' => $show_time == 'on' ? 'true' : 'false',
				'show_timezone' =>$show_timezone == 'on' ? 'true' : 'false',
				//'show_pagination'=>$show_pagination == 'on' ? 'true' : 'false',
				'showtitle' => $show_title == 'on' ? 'true' : 'false',
				'time' => null,
				'past' => ($show_past === 'on' ? 'yes' : ''),
				'venue' => ($show_venue === 'on' ? 'true' : 'false'),
				'location' => ($show_location === 'on' ? 'true' : 'false'),
				'organizer' => $show_name == 'on' ? 'true' : 'false',
				'price' => $show_price == 'on' ? 'true' : 'false',
				'weburl' => $show_weburl == 'on' ? 'true' : 'false',
				'categories' => $show_category == 'on' ? 'true' : 'false',
				'button_align' => ($button_align === 'on' ? 'true' : 'false'),
				'show_data_one_line' => ($show_data_one_line=== 'on' ? 'true' : 'false'),
				'show_preposition' => ($show_preposition=== 'on' ? 'true' : 'false'),
				'schema' => 'true',
				'message' => $no_results_message,
				'key' => 'End Date',
				'order' => 'ASC',
				'orderby' => 'meta_value',
				'viewall' => 'false',
				'excerpt' => ($show_excerpt === 'on' ? 
							($excerpt_length ? $excerpt_length : 'true' ):
							'false'),
				'showdetail' => ($show_detail === 'on' ? 'true' : 'false'),
				'thumb' => ($show_feature_image === 'on' ? 'true' : 'false'),
				'thumbsize' => $thumbnail_width,
				'thumbwidth' => '800',
				'thumbheight' => '800',
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
				'open_toggle_background_color' =>  $open_toggle_background_color,
				'details_link_color' =>  $details_link_color,
				'details_icon_color' =>  $details_icon_color,
				'details_label_color' =>  $details_label_color,
				'included_categories' => $included_categories,
				'header_level'  => $header_level,
				'custom_icon'         => $custom_icon,
				'use_current_loop' => ($use_current_loop === 'on' ? 'true' : 'false'),
				//'custom_icon' => $custom_icon,
				'custom_icon_tablet' => $custom_icon_tablet,
				'custom_icon_phone' => $custom_icon_phone,
				// 'custom_icon_font_weight' => $custom_icon_font_weight[4],
				'custom_view_more' => $this->props['custom_view_more'],
				'view_more_on_hover'=>$this->props['view_more_on_hover'],
				'autoplay'  => ($autoplay === 'on' ? 'true' : 'false'),
				'align'           => $align,
				'show_icon_label'=>$show_icon_label,
				'autoplay_hoverpause'=>$autoplay_hoverpause,
				'autoplay_Speed'   =>$autoplay_speed,
			);
		
	}
	if($this->props['show_cdn_link']=="on"){
	    wp_enqueue_script('owl_show', plugins_url().'/divi-event-calendar-module/includes/packages/EventEc-carousel.min.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script('carousel_show', plugins_url().'/divi-event-calendar-module/includes/packages/EventCarousel.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		if ( ! wp_script_is( 'jquery', 'enqueued' )) {
			wp_enqueue_script('carousel_show_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
			}
	}
	if($this->props['show_cdn_link']=="off"){
	    wp_enqueue_script('owl_show', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.5/js/EventCarousel/EventEc.carousel.min.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		wp_enqueue_script('carousel_show', 'https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.8.18/js/EventCarousel.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		if ( ! wp_script_is( 'jquery', 'enqueued' )) {
		wp_enqueue_script('carousel_show_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion ,WordPress.WP.EnqueuedResourceParameters.NotInFooter
		}
	}
		wp_enqueue_style('bootstrap_style', EVENT_DIR.'assets/css/bootstrap.min.css');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	
		$customCss='<style>';
		$renderClassName = $this->getrenderClassNameSelector($this->module_classname( $render_slug ),$render_slug);
		$setHeightFree = '
		jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').css(\'height\',\'100%\');
		jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',\'100%\');
		jQuery(\''.$renderClassName.' p.ecs-showdetail\').css({"position":"unset","width":"auto" });
		';
		$agentBrowser = '';
		if(isset($_SERVER['HTTP_USER_AGENT'])){
			$agentBrowser =sanitize_key( wp_unslash( $_SERVER['HTTP_USER_AGENT']));
		}
//  print_r($agentBrowser);
// exit;
			if(strlen(strstr($agentBrowser,"safari")) ==5||strlen(strstr($agentBrowser,"safari"))==3||strlen(strstr($agentBrowser,"safari"))==7||strlen(strstr($agentBrowser,"safari"))==3 || strlen(strstr($agentBrowser,"safari"))==6 ){      
				$customCss .= '.row_equal{display:flexbox}';
			}

			if(strlen(strstr($agentBrowser,"chrome")) > 0){      

				$customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
			}
			if(strlen(strstr($agentBrowser,"firefox")) > 0){      

				$customCss .= '.row_equal{display: flex;display: -webkit-flex;flex-wrap: wrap;}';
			}
			// print_r($agentBrowser);
			$Addlinebreak =  ' ';
			$AddButtonBottom =  '';

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
				$AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:last-child\').css(\'height\',column_height);';
				else
				$AddCustomHeight = 'jQuery(\''.$renderClassName.' #\'+id+\' .row > div:first-child\').css(\'height\',column_height);';
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

			// print_r($categslug);
			// exit;

			return sprintf( '
					%9$s<div%2$s class="%4$s %5$s">
						%6$s
						%7$s
						<div >
							%1$s
						</div>
					</div>
					<script>

						
					jQuery(document).ready(function(){
					//setTimeout(setHeightColumns, 1000);
					jQuery(window).on(\'resize\',function(){
						var screenWidth = jQuery(this).width();
						if(screenWidth > 1199){
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
		'eventdetails' => 'true',
		'showtime' => 'true',
		'show_timezone' => 'true',
		'showtitle' => 'true',
		'show_pagination'=>'true',
		'time' => null,
		'past' => '',
		'venue' => 'false',
		'location' => 'false',
		'organizer' => null,
		'price' => null,
		'weburl' => null,
		'categories' => 'false',
		'schema' => 'true',
		'message' => '',
		'key' => 'End Date',
		'order' => 'ASC',
		'orderby' => 'startdate',
		'viewall' => 'false',
		'excerpt' => 'false',
		'showdetail' => 'false',
		'thumb' => 'false',
		'thumbsize' => '',
		'thumbwidth' => '',
		'thumbheight' => '',
		'contentorder' => apply_filters( 'decm_details_order', ' thumbnail,title, title2, date, venue, location, organizer, price, categories, excerpt,weburl, showdetail', $atts ),
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
		// 'custom_icon_font_weight' => '',
		'custom_view_more' => '',
		'view_more_on_hover'=>'',
		'ajax_load_more_button_on_hover'=>'',
		'view_more_icon_placement'=>'',
		'ajax_load_more_button_icon_placement'=>'',
		'ajax_load_more_button_icon' => $custom_icon_load,
		'ajax_load_more_button_icon_tablet' => '',
		'ajax_load_more_button_icon_phone' => '',
		//'custom_view_more' => '',
		'custom_ajax_load_more_button'=>'',
		'ajax_load_more_text'=>'Load More',
		'pagination_type'=> '',
		'autoplay'        =>'true',
		'align'           => '',
		'show_icon_label'=>'',
		
		

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

	// echo '<pre>';
	//  print_r($atts['event_tax']);
	//  exit;

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
// print_r($atts['past']);
	$atts = apply_filters( 'decm_event_calender_atts', $atts, $meta_date_date, $meta_date_compare );
	

	$cat_slug = $wp_query->get_queried_object(['tribe_events_cat']);
	$categslug = isset($cat_slug) && $cat_slug !="" ? $cat_slug->slug:"";
    $categId = isset($cat_slug) && $cat_slug !="" ? $cat_slug->term_id:"";
	// $categslug =$cat_slug->slug;
	// $categId = $cat_slug->term_id;

	$event_id = get_the_ID();

	$args = apply_filters( 'decm_fetch_events_atts', array(
		'post_status' => 'publish',
		'posts_per_page' => $atts['limit'],
		'tax_query'=> $atts['event_tax'], //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		'order' => $atts['order'],
		//'orderby' => $atts['orderby'],
		'offset' => $atts['blog_offset'],
		'included_categories' => $atts['included_categories'],
		'meta_query' => apply_filters( 'dec_get_meta_query', array( $atts['meta_date'] ), $atts, $meta_date_date, $meta_date_compare ), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	), $atts, $meta_date_date, $meta_date_compare );
	
//print_r($args['publish']);

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
	
		$args['tax_query'] = $atts['event_tax']; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
	}
}
// 	echo '<pre>';
//  print_r($args);
//  exit;
$max_page_find_args = $args;
if($atts['limit'] > 0){
	$max_page_find_args['posts_per_page'] = -1;
	$max_pages = ceil(count(tribe_get_events( $max_page_find_args ))/$atts['limit']);
}




 
	$event_posts = tribe_get_events( $args );
	

	$event_posts = apply_filters( 'decm_events_posts_fetch', $event_posts, $atts );



	if ( $event_posts or apply_filters( 'decm_events_posts', false, $atts ) ) {
			
		$output = apply_filters( 'decm_start_events', $output, $event_posts, $atts );

				$cardoverStyle = '';
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
$items="";
         if($this->props['columns']=="1" ){
             $items="1";
         }
         if($this->props['columns']=="2"){
            $items="2";
        }
        if($this->props['columns']=="3"){
            $items="3";
        }
        if($this->props['columns']=="4"){
            $items="4";
		}
		$loopStatus="";
		if($this->props['columns']=="1" && $this->props['event_count'] > 1){
			$loopStatus="1";
		}
		if($this->props['columns']=="2" && $this->props['event_count'] > 2){
			$loopStatus="1";
		}
		if($this->props['columns']=="3" && $this->props['event_count'] > 3){
			$loopStatus="1";
		}
		if($this->props['columns']=="4" && $this->props['event_count'] > 4){
			$loopStatus="1";
		}
		
		
 
				
		$output .= apply_filters( 'decm_eventss_div', '<div class="owl-carousel diec_event_carousel_style_class  append_events row_equal row ecs-event-list event-display_style"' . 
				($atts['image_align'] == 'blog_layout' ? 'blog_layout': 'leftimage_rightdetail' ) . '" data-autoplay="'.$this->props['autoplay'].'" show_arrows="'.$this->props['show_arrows'].'" show_arrows_tablet="'.$this->props['show_arrows_tablet'].'" show_arrows_phone="'.$this->props['show_arrows_phone'].'"show_control="'.$this->props['show_control'].'" show_control_tablet="'.$this->props['show_control_tablet'].'" show_control_phone="'.$this->props['show_control_phone'].'" data-mouse-drag="'.$this->props['mouse_drag'].'" data-touch-drag="'.$this->props['touch_drag'].'"data-autoplaytimeout="'.$this->props['autoplay_speed'].'" data-hoverpause="'.$this->props['autoplay_hoverpause'].'" columns_type="'.$this->props['columns'].'" data="'.$items.'" image_align="'.$this->props['image_align'] .'" loopstatus="'.$loopStatus.'">', $atts );
		$atts['contentorder'] = explode( ',', $atts['contentorder'] );

		foreach( (array) $event_posts as $post_index => $event_post ) {
			
	//		setup_postdata( $event_post->ID );
			
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
					$category_names[] = '<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>';
				}
			}
			// style="'.$eventInnerStyle.'"

			$event_output .= apply_filters( 'decm_events_start_tag', '<div class="  '.$columns_tablet.' '.$columns_phone.' ecs-event ecs-event-posts clearfix' . implode( '', $category_slugs ) . $featured_class . apply_filters( 'decm_events_classes', '', $atts, $post ) . '" ><article id="event_article_'.$event_post->ID.'" class="act-post et_pb_with_border" ><div class="row" style="" > ', $atts, $post );
			
			// Put Values into $event_output
			if ( self::isValid( $atts['thumb'] ) ){
					
			}
			else{
// 					$event_output .= '<div class="col-md-12">';
			}
			
		   $classShowDataOneLine ='';
		   $classShowDataOneLine = $atts['show_data_one_line'] == 'true' ? ' decm-show-data-display-block ' : ' ';
		 $start_time='';
		 $end_time ='';
		 $set_timezone='';
		 $set_timezone=$atts['show_timezone']=='true'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):"";
		 $start_time=$atts['timeformat']==''? tribe_get_start_time($event_post->ID,get_option( 'time_format' )):tribe_get_start_time($event_post->ID,$atts['timeformat']);  
		 $end_time=$atts['timeformat']==''? tribe_get_end_time($event_post->ID,get_option( 'time_format' )).$set_timezone:tribe_get_end_time($event_post->ID,$atts['timeformat']).$set_timezone;
		 $start_date='';
		 $end_date ='';
		 $showicondate ="";
		 $showicontime="";
		 $showicon="";
		 $showlabel="";
		 $showlabeldate="";
		 $showlabeltime="";
		$start_date= $atts['dateformat']==""? tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' )):tribe_get_start_date( $event_post->ID,null,$atts['dateformat']);
		$end_date=$atts['dateformat']==""?" - ". tribe_get_end_date($event_post->ID,null, get_option( 'date_format' )):" - ".tribe_get_end_date( $event_post->ID,null,$atts['dateformat']);  
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
					/**
					 * Show Author Name of every events
					 *
					 * @author bojana
					 */
					
					case 'organizer':
						if ( self::isValid( $atts['organizer'] ) ) {
							if(tribe_get_organizer($event_post->ID) != null){
								$showicon=($atts['show_icon_label']==="icon" && $atts['show_data_one_line'] == 'true')?"organizer-ecs-icon":"";
								$showlabel =($atts['show_icon_label'] ==="label" && $atts['show_data_one_line'] == 'true') ?'<span class=ecs-detail-label>'.__('Organizer','decm-divi-event-calendar-module')." </span>":"";
		
							$event_output .= apply_filters( 'decm_events_organizer_tag_start', '<span class="'.$classShowDataOneLine.' ecs-organizer '.$showicon.'">', $atts, $event_post ) .
									   apply_filters( 'decm_events_organizer',__($atts['show_preposition'] == 'true' ?$showlabel.__( ' by ','decm-divi-event-calendar-module') : " ".$showlabel ). tribe_get_organizer($event_post->ID), $atts, $event_post, $excerptLength ) . //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
									   apply_filters( 'decm_events_organizer_tag_end', '</span>', $atts, $event_post );
						}
						//else{}
					}
						
						
						break;
						case 'price':
							if ( self::isValid( $atts['price'] ) ) {
								if(tribe_get_cost( $event_post->ID, true )!=null){
									$showicon=($atts['show_icon_label']==="icon" && $atts['show_data_one_line'] == 'true')?"price-ecs-icon":"";
								$showlabel =($atts['show_icon_label'] ==="label" && $atts['show_data_one_line'] == 'true') ?'<span class=ecs-detail-label>'.__('Price','decm-divi-event-calendar-module')." </span>":"";
								$event_output .= apply_filters( 'decm_events_price_tag_start', '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">', $atts, $event_post ) .
										   apply_filters( 'decm_events_price', " ".$showlabel . tribe_get_cost( $event_post->ID, true ), $atts, $event_post, $excerptLength ) .
										   apply_filters( 'decm_events_price_tag_end', '</span>', $atts, $event_post );
							}
							//else{}
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
									$event_output .= apply_filters( 'decm_events_thumbnail_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '">', $atts, $event_post );
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
									$showicon=($atts['show_icon_label']==="icon" && $atts['show_data_one_line'] == 'true')?"weburl-ecs-icon":"";
									$showlabel =($atts['show_icon_label'] ==="label" && $atts['show_data_one_line'] == 'true') ?'<span class=ecs-detail-label>'.__('Website','decm-divi-event-calendar-module')." </span>":"";
								$event_output .='<div class="decm-show-detail-center">'. apply_filters( 'decm_events_weburl_tag_start', '<p class="'.$classShowDataOneLine.' ecs-weburl '.$showicon.'">', $atts, $event_post ) .
								           apply_filters( 'decm_events_weburl',$showlabel.tribe_get_event_website_link($event_post), $atts, $event_post) .
										   apply_filters( 'decm_events_weburl_tag_end', '</p>', $atts, $event_post ).
										   apply_filters( 'decm_events_weburl_tag_end', '</div>', $atts, $event_post );
							}
							//else{}
						}
						
						//$event_output.='</div></br>';
						break;

						case 'date':
							$event_output .= '<div class="decm-show-detail-center">';
							if ( self::isValid( $atts['eventdetails'] ) ) {
								if($atts['showtime']== 'true'){
								if($atts['show_data_one_line'] == 'true'){
									$showlabeltime=$atts['show_icon_label']=="label" && $atts['show_data_one_line'] == 'true' && !is_null(tribe_get_start_time($event_post->ID))?'<span class=ecs-detail-label>'.__('Time','decm-divi-event-calendar-module')." </span>":"";
									$showlabeldate=$atts['show_icon_label']=="label" && $atts['show_data_one_line'] == 'true'?'<span class=ecs-detail-label>'.__('Date','decm-divi-event-calendar-module')." </span>":"";
									$showicontime=$atts['show_icon_label']=="icon" && $atts['show_data_one_line'] == 'true' && !is_null(tribe_get_start_time($event_post->ID))?"eventTime-ecs-icon":"";
									$showicondate=$atts['show_icon_label']=="icon" && $atts['show_data_one_line'] == 'true'?"eventDate-ecs-icon":"";
									//	if($atts['show_icon_label']=="label" && $atts['show_data_one_line'] == 'true'){$showlabeldate="<span class=ecs-detail-label>Date: </span>";$showlabeltime="<span class=ecs-detail-label>Time: </span>";}
								//elseif($atts['show_icon_label']=="icon" && $atts['show_data_one_line'] == 'true'){$showicondate="eventDate-ecs-icon"; $showicontime="eventTime-ecs-icon"; }
								if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
					{
								$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',$showlabeldate.$start_date, $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								if(!is_null(tribe_get_start_time($event_post->ID))){
								$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime." @ ".$start_time : $showlabeltime.$start_time, $atts, $event_post ) .
								apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?"- @ ".$end_time :" - ". $end_time, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );}
					}
					if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
					{
								$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',$showlabeldate.$start_date, $atts, $event_post ) .
								//apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								if(!is_null(tribe_get_start_time($event_post->ID))){
								$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
								//apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?" @ ".$start_time : $start_time, $atts, $event_post ) .
								apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime." @ ".$end_time :$showlabeltime."". $end_time, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								}
					}
					if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
					{
								$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',$showlabeldate.$start_date, $atts, $event_post ) .
								//apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								if(!is_null(tribe_get_start_time($event_post->ID))){
								$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime." @ ".$start_time : $showlabeltime.$start_time, $atts, $event_post ) .
								apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?"- @ ".$end_time :"-". $end_time, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
							}
					}
					if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))
					{
								$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time '.$showicondate.'">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',$showlabeldate.$start_date, $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								if(!is_null(tribe_get_start_time($event_post->ID))){
								$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time '.$showicontime.'">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?$showlabeltime." @ ".$start_time : $showlabeltime.$start_time, $atts, $event_post ) .
								apply_filters( 'decm_events_list_details', ($atts['show_preposition'] == 'true') ?"- @ ".$end_time :" - ". $end_time, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								}
					}
				}
								
								elseif($atts['show_data_one_line']=="false"){
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
								$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " @ ".$start_time:" ".$start_time,  $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
								}
							
								$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								if(!is_null(tribe_get_start_time($event_post->ID))){
								$event_output.=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
								apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " @ ".$end_time:" ".$end_time,  $atts, $event_post ) .
								apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
								}
							}
								if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
									$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
									if(!is_null(tribe_get_start_time($event_post->ID))){
									$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " @ ".$end_time:" ".$end_time,  $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
									}
								}
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
										$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										if(!is_null(tribe_get_start_time($event_post->ID))){	
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " @ ".$start_time:" ".$start_time,  $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
										}
										$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
									
										if(!is_null(tribe_get_start_time($event_post->ID))){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " @ ".$end_time:" ".$end_time,  $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										}
										}
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))&&tribe_get_start_time($event_post->ID,get_option( 'time_format' ))!= tribe_get_end_time($event_post->ID,get_option( 'time_format' ))){
											$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											if(!is_null(tribe_get_start_time($event_post->ID))){	
												$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " @ ".$start_time:" ".$start_time,  $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );	
											}
											if(!is_null(tribe_get_start_time($event_post->ID))){
											$event_output .=apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventTime duration time">', $atts, $event_post ) .
											apply_filters( 'decm_events_list_details',($atts['show_preposition'] == 'true') ? " - ".$end_time:" - ".$end_time,  $atts, $event_post ) .
											apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
											}
										}
								}
							}
								elseif($atts['showtime']=="false"){
								if($atts['show_data_one_line'] == 'true'){
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
									$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
									}
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
										$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
										apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
										apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
										}
									}
									
									elseif($atts['show_data_one_line']=="false"){
										if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) != tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
									$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$start_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post ).
									apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
									apply_filters( 'decm_events_list_details',$end_date, $atts, $event_post ) .
									apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
									}
									if(tribe_get_start_date( $event_post->ID,null,  get_option( 'date_format' )) == tribe_get_end_date( $event_post->ID,null,  get_option( 'date_format' ))){
										$event_output .= apply_filters( 'decm_events_date_tag_start', '<span class="'.$classShowDataOneLine.'ecs-eventDate duration time">', $atts, $event_post ) .
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
										$showicon=($atts['show_icon_label']==="icon" && $atts['show_data_one_line'] == 'true')?"venue-ecs-icon":"";
										$showlabel =($atts['show_icon_label'] ==="label" && $atts['show_data_one_line'] == 'true') ?'<span class=ecs-detail-label>'.__('Venue','decm-divi-event-calendar-module')." </span>":"";
									$event_output .= apply_filters( 'decm_events_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-venue duration venue '.$showicon.'">', $atts, $event_post ) .
											   apply_filters( 'decm_events_venue_at_tag_start', '<em> ', $atts, $event_post ) .
											   apply_filters( 'decm_events_venue_at_text',($atts['show_preposition'] == 'true' ? $showlabel.__('at','decm-divi-event-calendar-module'): " ".$showlabel), $atts, $event_post ) .
											   apply_filters( 'decm_events_venue_at_tag_end', ' </em>', $atts, $event_post ) .
											   apply_filters( 'decm_events_list_venue', tribe_get_venue($event_post->ID), $atts, $event_post ) .
											   apply_filters( 'decm_events_venue_tag_end', '</span>', $atts, $event_post );		   
									 
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
							
						if ( self::isValid( $atts['location'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
							if(tribe_get_full_address($event_post->ID) !="<span class=\"tribe-address\">\n\n\n\n\n\n\n</span>\n" ){
								$showicon=($atts['show_icon_label']==="icon" && $atts['show_data_one_line'] == 'true')?"event-location-ecs-icon":"";
								$showlabel =($atts['show_icon_label'] ==="label" && $atts['show_data_one_line'] == 'true') ?'<span class=ecs-detail-label>'.__('Location','decm-divi-event-calendar-module')." </span>":"";
							$event_output .= apply_filters( 'decm_events_venue_tag_start', '<span class="'.$classShowDataOneLine.'ecs-location duration venue '.$showicon.'">', $atts, $event_post ) .
									   apply_filters( 'decm_events_list_location_int_tag_start', '<em> ', $atts, $event_post ) .
									   apply_filters( 'decm_events_venue_in_text',( $atts['show_preposition']=='true'?$showlabel.__('in','decm-divi-event-calendar-module'):''.$showlabel ), $atts, $event_post ) .
									   apply_filters( 'decm_events_list_location_int_tag_end', ' </em>', $atts, $event_post ) .
									   apply_filters( 'decm_events_list_location',($atts['show_data_one_line'] =='false'? tribe_get_full_address($event_post->ID) : str_replace('<br>','',tribe_get_full_address($event_post->ID))), $atts, $event_post)  .	
									   apply_filters( 'decm_events_venue_tag_end', '</span>', $atts, $event_post );
						}
						// else{}
						}
						
						break;
					/**
					 * Show categories of every events
					 *
					 * @author bojana
					 */
					case 'categories':
						if ( self::isValid( $atts['categories'] ) ) {
							$categories = implode(', ', $category_names);
							$categories_separator = $categories ? ' | ' : '';
						if(et_core_esc_wp( $categories )!=null){
								$showicon=($atts['show_icon_label']==="icon" && $atts['show_data_one_line'] == 'true')?"categories-ecs-icon":"";
										$showlabel =($atts['show_icon_label'] ==="label" && $atts['show_data_one_line'] == 'true') ?'<span class=ecs-detail-label>'.__('Category','decm-divi-event-calendar-module')." </span>":"";
							$event_output .= apply_filters( 'decm_events_categories_tag_start', '<span class="'.$classShowDataOneLine.'ecs-categories '.$showicon.'">', $atts, $event_post ) .
										et_core_intentionally_unescaped($showlabel. ($atts['show_preposition'] == 'true' ? $categories_separator  : " "), 'fixed_string' ) .
										apply_filters( 'decm_events_categories', et_core_esc_wp( $categories ), 
										$atts, $event_post, $excerptLength ) .
										apply_filters( 'decm_events_categories_tag_end', '</span>', $atts, $event_post );
						}
						else{}
					}
						
						$event_output.='</div>';
						break;
						
					/**
					 * Show more in detail of every events
					 *
					 * @author bojana
					 */
					case 'showdetail':
						if ( self::isValid( $atts['showdetail']) ) {
							$button_classes ="act-view-more et_pb_button";
							$view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
							$icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
							$button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;

							$event_output .= apply_filters( 'decm_events_showdetail_tag_start', '<p class="ecs-showdetail et_pb_button_wrapper '.(( self::isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >', $atts, $event_post ) .
											apply_filters( 'decm_events_list_showdetail_link_start', '<a  class="'.$button_classes.' " href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['view_more_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
									apply_filters( 'decm_events_showdetail_tag_end', '</p>', $atts, $event_post );
						}
						$event_output.='</div>';
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
			
			
			$event_output .= apply_filters( 'decm_events_end_tag', '</article></div>', $atts, $event_post );

			$output .= apply_filters( 'dec_single_event_output', $event_output, $atts, $event_post, $post_index, $event_post );
			
							

			
		}
		
		$output .= apply_filters( 'dec_end_tag', '</div>', $atts );
		
		if( self::isValid( $atts['viewall'] ) ) {
			$output .= apply_filters( 'dec_view_all_events_tag_start', '<span class="ecs-all-events">', $atts ) .
					   '<a href="' . apply_filters( 'decm_events_list_viewall_link', tribe_get_events_link(), $atts ) .'" rel="bookmark">' . apply_filters( 'dec_view_all_events_text', sprintf( __( 'View All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ), $atts ) . '</a>';  //phpcs:ignore WordPress.WP.I18n.MissingTranslatorsComment
			$output .= apply_filters( 'dec_view_all_events_tag_end', '</span>' );
		}
	} else { //No Events were Found
		$output .= apply_filters( 'dec_no_events_found_message', sprintf( translate( $atts['message'], 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() ), $atts );  //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText , WordPress.WP.I18n.LowLevelTranslationFunction
	} // endif



	if($atts['pagination_type']=="load_more" && $atts['show_pagination']=="true"){
		$button_classes = "ajax_load_more et_pb_button";
		$icon_align =($atts['ajax_load_more_button_icon_placement']=="left")?"et_pb_ajax_align":"";
	//$icon_hover=($atts['ajax_load_more_button_on_hover']=="off")?"et_pb_button_no_hover et_pb_button_no_hover:before et_pb_button_no_hover:after":"";
	$button_classes = ($atts['custom_ajax_load_more_button'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$icon_align : $button_classes;

	$output .= apply_filters( 'decm_events_showdetail_tag_start', '<div class="event_ajax_load et_pb_button_wrapper" >', $atts, $event_post ) .
					apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.'" href="' . "#" . '" onClick="return false;" rel="bookmark"  data-icon="'.$atts['ajax_load_more_button_icon'].'" data-icon-tablet="'.$atts['ajax_load_more_button_icon_tablet'].'" data-icon-phone="'.$atts['ajax_load_more_button_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['ajax_load_more_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
			apply_filters( 'decm_events_showdetail_tag_end', '</div>', $atts, $event_post );
	}
	if($atts['pagination_type']=="paged" && $atts['show_pagination']=="true"){
	$output .=  '<div class="pagination clearfix" >
	 <a class="alignment_left" style="display:none;" onClick="return false;" href="#">'.esc_html__('&laquo; Older Entries','Divi').
  '</a>
 <a class="alignment_right" onClick="return false;" href="#">'.esc_html__('Next Entries &raquo;','Divi').
  '</a>
 </div>';

	}
	//$atts['get_event_html'].=
	$output.='
	<input type="hidden" name="eventfeed_prev_page" id="eventfeed_prev_page" value="0">
	<input type="hidden" name="eventfeed_current_page" id="eventfeed_current_page" value="1">
	<input type="hidden" name="eventfeed_page" id="eventfeed_page" value="'.$atts["pagination_type"].'">
	<input type="hidden" name="eventfeed_max_page" id="eventfeed_max_page" value="'.$max_pages.'"><input type="hidden" name="eventfeed_load_img" id="eventfeed_load_img" value="'.plugin_dir_url(__FILE__).'ajax-loader.gif">';
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


	$atts = shortcode_atts( apply_filters( 'decm_events_atts', array(
		'cat' => $atts['included_categories'],
		'month' => '',
		'limit' => $atts['event_count'],
		'eventdetails' => 'true',
		'showtime' => 'true',
		'show_timezone' => 'true',
		'show_pagination'=>'true',
		'time' => null,
		'past' => ($atts['show_past'] === 'on' ? 'yes' : ''),
		'venue' => 'false',
		'location' => 'false',
		'organizer' => null,
		'price' => null,
		'weburl' => null,
		'categories' => 'false',
		'schema' => 'true',
		'message' => '',
		'key' => 'End Date',
		'order' => 'ASC',
		'orderby' => 'startdate',
		'viewall' => 'false',
		'excerpt' => 'false',
		'showdetail' => 'false',
		'thumb' => 'false',
		'thumbsize' => '',
		'thumbwidth' => '',
		'thumbheight' => '',
		'contentorder' => apply_filters( 'decm_details_order', ' thumbnail,title, title2, date, venue, location, organizer, price, categories, excerpt,weburl, showdetail', $atts ),
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
		'ajax_load_more_button_icon'=>'',
		'pagination_type' =>'',
		'align'           => '',
		'show_icon_label'=>'',
		

	), $atts ), $atts, 'decm-events-atts' );


	// $object = new DECM_EventDisplay;
	// $atts['render_slug'] = $object->module_classname( 'decm_event_display' );
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
		'tax_query'=> $atts['event_tax'], //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
		 'order' => $atts['order'],

		'offset' => $atts['blog_offset'],
		'included_categories' =>  $atts['included_categories'],
		'meta_query' => apply_filters( 'dec_get_meta_query', array( $atts['meta_date'] ), $atts, $meta_date_date, $meta_date_compare ), //phpcs:ignore 	WordPress.DB.SlowDBQuery.slow_db_query_meta_query
	), $atts, $meta_date_date, $meta_date_compare );
	//et_body_layout
	if($atts['use_current_loop'] == "true"){
	if($post_type == 'tribe_events')
	{
		$args['ID'] = $current_page['id'];
	}
}

	$event_posts = tribe_get_events( $args );
	
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
					$category_names[] = '<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>';
					
				}
			}

			// Put Values into $event_output
			foreach ( apply_filters( 'decm_events_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
				switch ( trim( $contentorder ) ) {
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
					case 'price':
						$atts['posts'][$index]['price']=  " ".tribe_get_cost($event_post->ID, true );
					break;
					case 'weburl':
						
						$atts['posts'][$index]['weburl' ]=  tribe_get_event_website_link($event_post);
					break;
					case 'organizer':
							$atts['posts'][$index]['organizer']=  " by ".tribe_get_organizer($event_post->ID);
						break;
							
					case 'thumbnail':
						$thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
						$thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';

						$atts['posts'][$index]['thumb'] = get_the_post_thumbnail_url($event_post->ID,array( 800, $thumbHeight ));
						break;

					case 'excerpt':
							$excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 270;
							$atts['posts'][$index]['excerpt'] =self::get_excerpt($event_post->ID, $excerptLength ); 
						break;



					case 'date':
						$atts['posts'][$index]['date'] = apply_filters( 'decm_events_date_tag_start', '<span class="duration time">', $atts, $event_post ) .apply_filters( 'decm_events_list_details', tribe_events_event_schedule_details($event_post->ID), $atts, $event_post ) .apply_filters( 'decm_events_date_tag_end', '</span>', $atts, $event_post );
							$Sdate = '';
							$Edate = '';
							$STime = '';
							$ETime = '';
							$set_timezone='';
							$set_timezone=" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID );
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
							
							$atts['posts'][$index]['date'] =$Sdate.' @ '.$STime.'~*~'.$Edate.' @ '.$ETime.'~*~'.$set_timezone;
				
					break;

					case 'venue':
						if (  function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
							$atts['posts'][$index]['venue'] =tribe_get_venue($event_post->ID);
						}
						break;
					/**
					 * Show location of venue
					 *
					 * @author bojana
					 *
					 */
					case 'location':
						if ( function_exists( 'tribe_get_full_address' ) and tribe_get_full_address($event_post->ID)) {
							$atts['posts'][$index]['location'] = tribe_get_full_address($event_post->ID); 
						}
						break;
					/**
					 * Show categories of every events
					 *
					 * @author bojana
					 */
					case 'categories':
						$excerptLength='';
							$categories = implode(', ', $category_names);
							$categories_separator = $categories ? ' | ' : '';
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
					
					case 'date_thumb':
							$atts['posts'][$index]['date_thumb']['M'] =tribe_get_start_date( null, false, 'M' ); 
							$atts['posts'][$index]['date_thumb']['J'] =tribe_get_start_date( null, false, 'j' ); 
							
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
}

new DIEC_EventCarousel;
