<?php

class DECM_EventDisplayChild extends ET_Builder_Module {

	public $slug                     = 'decm_event_filter_child';
	public $type                     = 'child';
	public $child_title_var          = 'events_filter';
	public $vb_support = 'on';

	function init() {

		$this->name             = esc_html__( 'Filter', 'decm-divi-event-calendar-module' );
		$this->advanced_setting_title_text = esc_html__( 'Add Filter','decm-divi-event-calendar-module'  );

		// Module item's modal title
		$this->settings_text = esc_html__( 'Filter Settings', 'decm-divi-event-calendar-module' );
		$this->main_css_element = '.dec-filter-bar %%order_class%%';

		// Toggle settings
		$this->settings_modal_toggles  = array(
			'general'  => array(
				'toggles' => array(
					'main_content' => esc_html__( 'Filter', 'decm-divi-event-calendar-module' ),
					// 'custom_label' => esc_html__( 'Label', 'decm-divi-event-calendar-module' ),
					// 'filters_selection' => esc_html__( 'Selection', 'decm-divi-event-calendar-module' ),
				),
			),
			'advanced' => array(
				'toggles' => array(
					'filter_layout'  => esc_html__( 'Layout', 'decm-divi-event-calendar-module' ),
					'filter_text'  => esc_html__( 'Filter Text', 'decm-divi-event-calendar-module' ),	
				//	'spacing_child'  => esc_html__( 'Spacing', 'decm-divi-event-calendar-module' ),				
				),
			),
		);
	}

	/**
	 * Module's specific fields
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function get_fields() {
		return array(

		'events_filter' => array(
			'label'           => esc_html__( 'Filter', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Here you can choose to add any of the available filters and rearrange them as needed.', 'decm-divi-event-calendar-module' ),
			'type'            => 'select',
			'options'		=>[
				'Search'   => esc_html__( 'Search', 'decm-divi-event-calendar-module' ),
				'Recurring'   => esc_html__( 'Recurring', 'decm-divi-event-calendar-module' ),  
				'Category'   => esc_html__( 'Category', 'decm-divi-event-calendar-module' ),    
				'Tag'   => esc_html__( 'Tag ', 'decm-divi-event-calendar-module' ),
				'Organizer'   => esc_html__( 'Organizer', 'decm-divi-event-calendar-module' ),  
				'Venue'   => esc_html__( 'Venue ', 'decm-divi-event-calendar-module' ),
				'City'   => esc_html__( 'City ', 'decm-divi-event-calendar-module' ),
				'Country'   => esc_html__( 'Country ', 'decm-divi-event-calendar-module' ),
				'State'   => esc_html__( 'State/Province', 'decm-divi-event-calendar-module' ),
				'Location'   => esc_html__( 'Format ', 'decm-divi-event-calendar-module' ),  
				'Cost'   => esc_html__( 'Cost ', 'decm-divi-event-calendar-module' ),
				'Year'   => esc_html__( 'Year ', 'decm-divi-event-calendar-module' ),  
				'Month '   => esc_html__( 'Month', 'decm-divi-event-calendar-module' ),
				'Day'   => esc_html__( 'Day ', 'decm-divi-event-calendar-module' ),  
				'Status' => esc_html__( 'Status ', 'decm-divi-event-calendar-module' ),
				'Time'   => esc_html__( 'Time ', 'decm-divi-event-calendar-module' ),
				'Date Range'   => esc_html__( 'Date Range ', 'decm-divi-event-calendar-module' ),  
				'Order By'   => esc_html__( 'Order By', 'decm-divi-event-calendar-module' ),
				'Future'   => esc_html__( 'Future/Past', 'decm-divi-event-calendar-module' ),             
			],
			'default' => 'Search',
			'option_category' => 'basic_option',
			'tab_slug' => 'general',
			'toggle_slug'     => 'main_content',	
		),

		'custom_label_text' => array(
			'label'           => esc_html__( 'Label', 'decm-divi-event-calendar-module' ),
			'type'            => 'text',
			'option_category'   => 'configuration',
			'description'     => esc_html__( 'Enter custom text for the filter name that displays on the frontend.', 'decm-divi-event-calendar-module' ),
			'toggle_slug'     => 'main_content',
			'default'           => '',
		),

		'show_alphabetical_order'=> array(
			'label'				=> esc_html__( 'Show Dropdown Options In Alphabetical Order', 'decm-divi-event-calendar-module' ),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'view_more',
			'options'			 => array(
				'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
			),
			'description'		=> esc_html__( 'Choose to show the filter dropdown options in alphabetical order.', 'decm-divi-event-calendar-module' ),
			'tab_slug'		  => 'general',
		//	'mobile_options'  => true,
			'toggle_slug'     => 'main_content',
			'default'			=> 'off',
			'default_on_phone' => 'on',
			'show_if_not'     => array(
				'events_filter' => [
					'Search',
					'Order By',
					'Date Range',
					'Time',
					'Cost',
					'Recurring',
					'Year',
					'Month',
					'Day',
					'Status',
			],
			),				
			// 'computed_affects'   => array(
			// 	'events_filter',
			// ),
		),

		'filter_multiple_select' => array(
			'label'           => esc_html__( 'Selection Method', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Choose to allow filtering by selecting only single items or by selecting multiple items with checkboxes.', 'decm-divi-event-calendar-module' ),
			'type'            => 'select',	
			//'type'            => 'select',
			'option_category' => 'layout',
			'options'		=>[
				'single'   => __( 'Single', 'decm-divi-event-calendar-module' ),
				'multi'   => __(  'Multi', 'decm-divi-event-calendar-module' ),               
			],
			//'mobile_options'  => true,
			'tab_slug'		  => 'general',
			'toggle_slug'     => 'main_content',
			'show_if_not'     => array(
				'events_filter' => [
					'Search',
					'Order By',
					'Date Range',
					'Time',
					'Cost',
					'Recurring',
			],
			),

			'default' => 'single',
		),


		'date_range_format' => array(
			'label'           => esc_html__( 'Date Format', 'decm-divi-event-calendar-module' ),
			'type'            => 'text',
			'option_category'   => 'configuration',
			'description'     => esc_html__( '', 'decm-divi-event-calendar-module' ), //phpcs:ignore WordPress.WP.I18n.NoEmptyStrings
			'toggle_slug'     => 'main_content',
			'show_if'     => array(
				'events_filter' => 
					'Date Range',
			),
			'default'           => 'MMMM D, YYYY',
		),



		'filter_fullwidth'=> array(
			'label'				=> esc_html__( 'Make Fullwidth', 'decm-divi-event-calendar-module' ),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'view_more',
			'options'			 => array(
				'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
			),
			'description'		=> esc_html__( 'Choose to show the filter item as 100% width of the content area. Otherwise, it will show inline.', 'decm-divi-event-calendar-module' ),
			'tab_slug'		  => 'advanced',
		//	'mobile_options'  => true,
			'toggle_slug'     => 'filter_layout',
			'default'			=> 'off',
			'default_on_phone' => 'on',
			'show_if_not'     => array(
				'events_filter' => 'Search',
			),				
			'computed_affects'   => array(
				'events_filter',
			),
		),
		'filter_option_show' => array(
			'label'           => esc_html__( 'Which Options To Show', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Choose to allow filtering by selecting only single items or by selecting multiple items with checkboxes.', 'decm-divi-event-calendar-module' ),
			'type'            => 'select',	
			//'type'            => 'select',
			'option_category' => 'layout',
			'options'		=>[
				'future_data'   => __( 'Relevent Future Data', 'decm-divi-event-calendar-module' ),
				'past_data'   => __(  'Relevent Past Data', 'decm-divi-event-calendar-module' ), 
				'past_future_data'   => __(  'Relevent Past/Future Data', 'decm-divi-event-calendar-module' ),               
			],
			//'mobile_options'  => true,
			'tab_slug'		  => 'general',
			'toggle_slug'     => 'main_content',
			'default' => 'future_data',
		),

		'show_display_inline'=> array(
			'label'				=> esc_html__( 'Show Category Filter Inline', 'decm-divi-event-calendar-module' ),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'view_more',
			'options'			 => array(
				'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
			),
			'description'		=> esc_html__( 'Choose to show the event category filter options inline horizontally as buttons instead of a dropdown.', 'decm-divi-event-calendar-module' ),
			'tab_slug'		  => 'general',
		//	'mobile_options'  => true,
			'toggle_slug'     => 'main_content',
			'default'			=> 'off',
			'default_on_phone' => 'on',
			'show_if'     => array(
				'events_filter' => [
					'Category',
			],
			),				
			'computed_affects'   => array(
				'events_filter',
			),
		),


		'show_dropdown_icon'=> array(
			'label'				=> esc_html__( 'Show Dropdown Icon', 'decm-divi-event-calendar-module' ),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'view_more',
			'options'			 => array(
				'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
			),
			'description'		=> esc_html__( 'Choose to show a dropdown icon on the filter item.', 'decm-divi-event-calendar-module' ),
			'tab_slug'		  => 'general',
		//	'mobile_options'  => true,
			'toggle_slug'     => 'main_content',
			'default'			=> 'off',
		),


		'custom_filter_font_icon'      => array(
			'label'           => esc_html__( 'Icon', 'decm-divi-event-calendar-module' ),
			'type'            => 'select_icon',
			'option_category' => 'basic_option',
			//'default'         => '&#x21;||divi',
			'class'           => array( 'et-pb-font-icon' ),
			'tab_slug'		  => 'general',
			'toggle_slug'     => 'main_content',
			'description'     => esc_html__( 'Choose an icon to display in event filters.', 'decm-divi-event-calendar-module' ),
			'mobile_options'  => true,
			'show_if'     => array(
				'show_dropdown_icon' => [
					'on', 
			],
			),	
			//'hover'           => 'tabs',
		),
		'search_search_criteria' => array(
			'label'           => esc_html__( 'Search Criteria', 'decm-divi-event-calendar-module' ),
			'description'		=> esc_html__( 'Choose to search keywords by the event title only, or by any keywords in both the event title and event content.', 'decm-divi-event-calendar-module' ),
			'type'            => 'select',
			'option_category' => 'layout',
			'options'		=>[
				'search_title'   => __( 'Title Only', 'decm-divi-event-calendar-module' ),
				'search_content_title'   => __( 'Both Title & Content', 'decm-divi-event-calendar-module' ),			  
			],
			'default'			=>'search_title',
			'tab_slug'		  => 'general',
			'toggle_slug'     => 'main_content',
			'show_if'     => array(
				'events_filter' => 'Search',
			),
			
		),

		'filter_fullwidth_search'=> array(
			'label'				=> esc_html__( 'Make Fullwidth', 'decm-divi-event-calendar-module' ),
			'type'				=> 'yes_no_button',
			'option_category'	=> 'view_more',
			'options'			 => array(
				'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
			),
			'description'		=> esc_html__( 'Choose to show the filter item as 100% width of the content area. Otherwise, it will show inline.', 'decm-divi-event-calendar-module' ),
			'tab_slug'		  => 'advanced',
			//'mobile_options'  => true,
			'toggle_slug'     => 'filter_layout',
			'default'			=> 'on',
			'show_if'     => array(
				'events_filter' => 'Search',
			),				
			'computed_affects'   => array(
				'events_filter',
			),
		),
	
		'get_filters_data' => array(
			'type' => 'computed',
			'computed_callback' => array( 'DECM_EventDisplayChild', 'get_filter_data' ),
			'computed_depends_on' => array(
				'filter_option_show',
			),
		),
		
	
	   );
	}

	function get_advanced_fields_config() {
		return array(
			'text'           => false,
			'button'         => false,	
			'filters'        => false,	
			'link_options'   => false,
			'transform'      => false,
		
			'margin_padding' => array(
				'draggable_margin'  => false,
				'draggable_padding' => false,
				'css'               => array(
					'margin'  => "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-event-category-inline",
					'padding' => "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-event-category-inline",
					'important' => 'all',
				),
			),

			'background'            => array(
				'has_background_color_toggle' => true,
				'css'                  => array(
					'main' =>  "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-select > button, %%order_class%% .dec-filter-event-category-inline",
					'important' => 'all',
				),
				'options' => array(
					'background_color' => array(
						'depends_show_if'  => 'on',
						'default'          => 'Transparent',
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
							'border_radii' => "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-event-category-inline",
							'border_styles' => "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-event-category-inline",	
						),
						'important' => 'all',
					),
					'defaults' => array(
						'border_radii' => 'on|0px|0px|0px|0px',
					),
			),

			),

			'box_shadow'     => array(
				'default' => array(
					'css' => array(
						'main' => "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-event-category-inline",
						'important' => 'all',
					),
				),

			),

			'fonts'     => array(
				'label' => array(
					'css'          => array(
						'main'      =>  "%%order_class%% .dec-filter-label, %%order_class%% .dec-filter-label > span, %%order_class%%  .dec-filter-container > ::placeholder, %%order_class%% .dec-filter-event-category-inline",
						'important' => 'all',
					),
					'label'        => esc_html__( 'Filter', 'decm_event_filter' ),
					'description'     => esc_html__( 'Customize and style the lable text with all the standard font and text settings.', 'decm-divi-event-calendar-module' ),
					'disable_toggle' => false,
					'tab_slug'     => 'advanced',
				    'toggle_slug'  => 'filter_text',
				),	
			),
					
		);
	}

	/**
	 * Render module output
	 *
	 * @since 1.0.0
	 *
	 * @param array  $attrs       List of unprocessed attributes
	 * @param string $content     Content being processed
	 * @param string $render_slug Slug of module that is used for rendering output
	 *
	 * @return string module's rendered output
	 */

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

	// public function get_specific_data($atts = array(), $conditional_tags = array(), $current_page = array()) {
	// 	$atts=array(
	// 		'filter_option_show'=>"",
	// 	);
	// 	$args =  array(
	// 		'post_type' => 'tribe_events',
	// 		'post_status' => 'publish',
	// 		'posts_per_page'=>-1,
	// 		//'orderby' => $atts['orderby'],
	// 		'start_date'=>current_time( 'Y-m-d H:i:s' ),
	// 		'end_date'=> "",
	// 		//'featured'=> "false",
			
	// 	 );
	// 	 $filter_organizer_id=array();
	// 	 $filter_organizer_name=array();
	// 	 $filter_venue_id=array();
	// 	 $filter_venue_name=array();
	// 	 $filter_city_name=array();
	// 	 $filter_location_name=array();
	// 	 $filter_country_name=array();
	// 	 $filter_category_id=array();
	// 	 $filter_category_name=array();
	// 	 $filter_province_name=array();
	// 	 $term_ids=array();
	// 	 $singleArray=array();
	// 	 $singleArraytag=array();
		 
	// 	 $event_post=tribe_get_events($args);

	// 	 //	 if ( is_array( $category_list ) ) {
	// 	//}
	// 	// $category_list = get_the_terms( $event_post, 'tribe_events_cat' );
	// 	 foreach ((array) $event_post as $post_index => $event ) {
			
	// 		$filter_organizer_id[] =  tribe_get_organizer_id($event);
	// 		$filter_organizer_name[] =  tribe_get_organizer($event);
	// 		$filter_venue_id[]=tribe_get_venue_id($event);
	// 		$filter_venue_name[]=tribe_get_venue($event);
	// 		$filter_city_name[]=tribe_get_city($event);
	// 		$filter_location_name[]=tribe_get_address($event);
	// 		$filter_province_name[]=tribe_get_province($event);
	// 		$filter_country_name[]=tribe_get_country($event);
	// 		$filter_category_name[]=get_the_terms( $event, 'tribe_events_cat' );
	// 		$filter_tag_name[]=get_the_terms( $event, 'post_tag' );
	// 			//$pageNos5[]=tribe_get_city($event);
	// 		}
	// 		foreach ($filter_category_name as $childArray)
	// 		{
	// 		 foreach ($childArray as $value)
	// 		{
				
	// 		 $singleArray[] = $value;
	// 		 }
	// 		}
	// 		foreach ($filter_tag_name as $childArraytag)
	// 		{
	// 		 foreach ($childArraytag as $value)
	// 		{
				
	// 		 $singleArraytag[] = $value;
	// 		 }
	// 		}
	// 		$category_slug=wp_list_pluck($singleArray,'name');
	// 		$category_term_id=wp_list_pluck($singleArray,'term_id');
	// 		$tag_slug=wp_list_pluck($singleArraytag,'name');
	// 		$tag_term_id=wp_list_pluck($singleArraytag,'term_id');
	// 		$filter_organizer_data=array_combine($filter_organizer_id,$filter_organizer_name);
	// 		$filter_venue_data=array_combine($filter_venue_id,$filter_venue_name);
	// 		$filter_city_data=array_combine($filter_venue_id,$filter_city_name);
	// 		$filter_location_data=array_combine($filter_venue_id,$filter_location_name);
	// 		$filter_province_data=array_combine($filter_venue_id,$filter_province_name);
	// 		$filter_country_data=array_combine($filter_venue_id,$filter_country_name);
	// 		$filter_category_data=array_combine($category_term_id,$category_slug);
	// 		$filter_tag_data=array_combine($tag_term_id,$tag_slug);
	// 		$filter_data_combine=array($filter_organizer_data,$filter_venue_data,$filter_city_data,$filter_location_data,$filter_country_data,$filter_category_data,$filter_tag_data);
	// 		// if( $filter_category_name != ""){
	// 		// 	foreach ((array) $filter_category_name as $key => $eventInfo ) {
	// 		// 		$term_id[$key] = $eventInfo->term_id;
	// 		//    }
	// 		// }

	// 	//	echo"<pre>";
	// 		print_r($atts['filter_option_show']);
	// 		return $filter_data_combine;
	// }
    public function render( $attrs, $content , $render_slug ) {

		if ( !function_exists( 'tribe_get_events' ) ) {
			return 'Divi Events Calendar requires The Events Calendar to be installed and active.';
		}

		$attr = array(
			'filter_option_show'
		);
		$filter_select =  $this->props['filter_multiple_select'];
		$custom_label =  $this->props['custom_label_text'];
	    $filter_titles	= $this->props['events_filter'];
		$dec_filter_fullwidth	= $this->props['filter_fullwidth'];
		$dec_filter_fullwidth_search	= $this->props['filter_fullwidth_search'];
		$show_alphabetical_order	= $this->props['show_alphabetical_order'];
		$show_display_inline	= $this->props['show_display_inline'];
		$search_search_criteria	= $this->props['search_search_criteria'];
		

		if($this->props['show_dropdown_icon'] == 'on'){
		$custom_icon_values              = et_pb_responsive_options()->get_property_values( $this->props, 'custom_filter_font_icon' );
		$custom_icon                     = isset( $custom_icon_values['desktop'] ) ? $this->props['custom_filter_font_icon'] == " " ? " " : esc_attr( et_pb_process_font_icon( $custom_icon_values['desktop'] ) ) : " ";
		$custom_icon_tablet              = isset( $custom_icon_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['tablet'] ) ) : " ";
		$custom_icon_phone               = isset( $custom_icon_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['phone'] ) ) : " ";

		}else{
			$custom_icon_values = "";
			$custom_icon = "";
			$custom_icon_tablet = "";
			$custom_icon_phone = "";
		}

		

		// \ET_Builder_Element::set_style($render_slug, [
		// 	'selector'    => "%%order_class%% .dec-filter-label:after",
		// 	'declaration' => "font-family: ETModules; content:'$custom_icon'; ",
		// ]);

        // $filter_fullwidth_responsive_active = isset($this->props["filter_fullwidth"]) && et_pb_get_responsive_status($this->props["filter_fullwidth_last_edited"]);
        // $filter_fullwidth_tablet = $filter_fullwidth_responsive_active && $this->props["filter_fullwidth_tablet"] ? $this->props["filter_fullwidth_tablet"] : $filter_fullwidth;
        // $filter_fullwidth_phone = $filter_fullwidth_responsive_active && $this->props["filter_fullwidth_phone"] ? $this->props["filter_fullwidth_phone"] : $filter_fullwidth_tablet;	

		if($dec_filter_fullwidth_search == "off"){
			\ET_Builder_Element::set_style($render_slug, [
				'selector'    => "%%order_class%%",
				'declaration' => "display:inline-block !important;",
			]);
		}

		

		// if($filter_fullwidth_phone == "on"){
		// 	\ET_Builder_Element::set_style($render_slug, [
		// 		'selector'    => "%%order_class%%",
		// 		'declaration' => "display:block !important;",
		// 		'media_query' => \ET_Builder_Element::get_media_query('max_width_767'),
		// 	]);
		// }

		if($dec_filter_fullwidth == "on"){
		\ET_Builder_Element::set_style($render_slug, [
            'selector'    => "%%order_class%%",
			'declaration' => "display:block !important;",
        ]);

		
	    }
		$args =  array(
			'post_type' => 'tribe_events',
			'post_status' => 'publish',
			'posts_per_page'=>-1,
			//'orderby' => $atts['orderby'],
			'start_date'=>$this->props['filter_option_show']=="future_data"?current_time( 'Y-m-d H:i:s' ):(($this->props['filter_option_show']=='past_future_data')?"":""),
			'end_date'=> $this->props['filter_option_show']=="past_data"?current_time( 'Y-m-d H:i:s' ):(($this->props['filter_option_show']=='past_future_data')?"":""),
			//'featured'=> "false",
			
		 );
		 $filter_organizer_id=array();
		 $filter_organizer_name=array();
		 $filter_venue_id=array();
		 $filter_venue_name=array();
		 $filter_city_name=array();
		 $filter_location_name=array();
		 $filter_country_name=array();
		 $filter_category_id=array();
		 $filter_category_name=array();
		 $filter_province_name=array();
		 $term_ids=array();
		 $singleArray=array();
		 $singleArraytag=array();
		 $filter_tag_name = array();
		 $filter_start_name = array();
		 $filter_end_name = array();
		 
		 
		 if ( is_plugin_active( 'the-events-calendar/the-events-calendar.php' ) ) {
		    $event_post=tribe_get_events($args);
		 }else{
			$event_post = array();
		 }

		 //	 if ( is_array( $category_list ) ) {
		//}
		// $category_list = get_the_terms( $event_post, 'tribe_events_cat' );
		 foreach ((array) $event_post as $post_index => $event ) {
			$filter_start_name[] =	tribe_get_start_date($event->ID,null,"Y"); 
			$filter_end_name[] = tribe_get_end_date($event->ID,null,"Y");
			$filter_organizer_id[] =  tribe_get_organizer_ids($event);
			$filter_organizer_name[] =  $this->getOrganizerDataById($filter_organizer_id);
			//$filter_organizer_name[] =  tribe_get_organizer($event);
			$filter_venue_id[]=tribe_get_venue_id($event);
			$filter_venue_name[]=tribe_get_venue($event);
			$filter_city_name[]=tribe_get_city($event);
			$filter_location_name[]=tribe_get_address($event);
			$filter_country_name[]=tribe_get_country($event);
			$filter_province_name[]=tribe_get_province($event)!=null?tribe_get_province($event):tribe_get_region($event);
			$filter_category_name[]=get_the_terms( $event, 'tribe_events_cat' );
			$filter_tag_name[]=get_the_terms( $event, 'post_tag' );
				//$pageNos5[]=tribe_get_city($event);
			}
			if (is_array($filter_category_name) || is_object($filter_category_name)){
				foreach ($filter_category_name as $childArray)
				{
					if (is_array($childArray) || is_object($childArray)){
		
					foreach ($childArray as $value)
				{
					
				 $singleArray[] = $value;
				 }
				}
				}
				}
				if (is_array($filter_tag_name) || is_object($filter_tag_name)){
				foreach ($filter_tag_name as $childArraytag)
				{
					if (is_array($childArraytag) || is_object($childArraytag)){
				 foreach ($childArraytag as $value)
				{
					
				 $singleArraytag[] = $value;
				 }
				}
			}
			}
			$category_slug=wp_list_pluck($singleArray,'name');
			$category_term_id=wp_list_pluck($singleArray,'term_id');
			$tag_slug=wp_list_pluck($singleArraytag,'name');
			$tag_term_id=wp_list_pluck($singleArraytag,'term_id');
			$filter_organizer_data = $filter_organizer_name;
			$filter_venue_data=array_combine($filter_venue_id,$filter_venue_name);
			$filter_city_data=array_combine($filter_venue_id,$filter_city_name);
			$filter_location_data=array_combine($filter_venue_id,$filter_location_name);
			$filter_country_data=array_combine($filter_venue_id,$filter_country_name);
			$filter_category_data=array_combine($category_term_id,$category_slug);
			$filter_province_data=array_combine($filter_venue_id,$filter_province_name);
			$filter_tag_data=array_combine($tag_term_id,$tag_slug);
			$filter_data_combine = array($filter_organizer_data,$filter_venue_data,$filter_city_data,$filter_location_data,$filter_country_data,$filter_category_data,$filter_tag_data,$filter_province_data);
			$filter_start_date = array_combine($filter_start_name, $filter_start_name);
			$filter_end_date = array_combine($filter_end_name, $filter_end_name);	
			$decm_filters_years = $filter_start_date + $filter_end_date;
		
	//  exit;
			$filter_output = '';
	//	$keyword=__('Keyword','decm-divi-event-calendar-module');
		$search=__('Search','decm-divi-event-calendar-module');

		$dec_filter_label = __('Keyword','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
		   switch ($filter_titles){
			case 'Search':
				$filter_output .= "<div class='dec-filter-header'>
					<div class='dec-filter-container'>		
					<input class='dec-filter-search__input dec-filter-label' name='dec-filter-search__input'required  type='text' id='dec-filter-search__input'  placeholder='".$dec_filter_label."' /><button class='close-icon' type='reset' onclick=\"document.getElementById('dec-filter-search__input').value = ''\"></button></div>
							<button type='submit' id='dec-find-events' class='dec-search-filter-button'>".$search."</button>
							<input type='hidden' name='search_search_criteria' id='search_search_criteria' value='".$search_search_criteria."' />		
					</div>";
				break;
			case 'Venue':
		
				if($show_alphabetical_order == "on"){
					asort($filter_data_combine[1]);
				 }
				$dec_filter_label = __('Venue','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				
				if($filter_select == 'multi'){
						$output = "<ul>";
						foreach($filter_data_combine[1] as $key => $value) {
							if(tribe_get_venue($key)!="" ){	
						$output .= '<li class="dec-venue-checkbox"><label for='.$key.' >
						<input type=\'checkbox\' name=\'dec_filter_venue\' id='.$key.' value='.$value.'  /> '.$value.'</label></li>';
							}}
						$output .= "</ul>";	
				}else{
						$output = "<ul>";
						foreach($filter_data_combine[1] as $key => $value) {
							if(tribe_get_venue($key)!="" ){	
								// foreach ($array_duplicates_removed as &$value) {
									
						$output .= '<li class="dec-venue-list" data-id='.$key.'>'.$value.'</li>';
						}}
						$output .= "</ul>";
				}

				$filter_output .= "<div class='dec-filter-bar dec-venue-filter'>
				<div class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' >
				<span>".$dec_filter_label."</span><span id='dec-venue-current-select'></span>
				<button type='button' class ='dec-venue-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-venue-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
				
			break;
			case 'Cost':
			
				$dec_filter_label = __('Cost','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				
				$maximum_cost = tribe_get_maximum_cost();
				$EventCurrencySymbol = tribe_get_option( 'defaultCurrencySymbol', '$' );
				$filter_output .=   "
				<div class='dec-filter-bar dec-filter-cost'>
						<div class='dec-filter-label'  data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' >
							<span >".$dec_filter_label."</span><span id='dec-price-current-select'></span>
							<button type='button' class ='dec-price-remove'>×</button>
						</div>      
				</div>";
				$filter_output .= "<div class='dec-price-filter-list dec-filter-list'>
                            <input type='text' id='Eventprice' style='border:0; font-weight:bold;' readonly >
							<input type='hidden' id='EventcostValue' name='EventcostValue' value=".$maximum_cost.">
							<input type='hidden' id='EventCurrencySymbol' name='EventCurrencySymbol' value=".$EventCurrencySymbol.">
							<div id='eventCostslider'></div>";
				$filter_output .= '</div>';

			break;
			case 'Order By':
				$dec_filter_label = __('Order By','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}

				$filter_output .=   "
				<div class='dec-filter-bar dec-filter-order-by'>
						<div class='dec-filter-label'  data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' >
							<span >".$dec_filter_label."</span><span id='dec-order-current-select'></span>
							<button type='button' class ='dec-order-remove'>×</button>
			     		</div> ";

				$filter_output .= "<div class='dec-order-filter-list dec-filter-list'>";
			
				if($filter_select == 'multi'){
					$filter_output .= "<ul><li><input type='checkbox' class ='order' name='order' id='DESC' value='Descending'  />
					<label for='DESC'>'".__('Descending','decm-divi-event-calendar-module')."</label><br></li>
					<li><input type='checkbox' name='order' class ='order' id='ASC' value='Ascending'  />
					<label for='ASC'>'".__('Ascending','decm-divi-event-calendar-module')."</label><br></li> 
					</ul>";
				}else{
					$filter_output .= "<ul><li class='dec-order-list' data-id='ASC'>Descending</li>
				    <li  class='dec-order-list' data-id='DESC'>Ascending</li></ul>";
				}
				
				$filter_output .= '</div></div>';
			break;
			case 'Location':

			 if($show_alphabetical_order == "on"){
				asort($filter_data_combine[3]);
			 }

				$dec_filter_label = __('Format','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				$args = array(
					'post_type' => 'tribe_venue',
				);
				$loop = new WP_Query($args);

				if($filter_select == 'multi'){
					        $output = "<ul>";
						// 	foreach($filter_data_combine[3] as $key => $value) {
						// 		if(tribe_get_venue($key)!="" ){	
						// 	$output .= '<li class="dec-location-checkbox"><label for='.$key.'_1'.' >
						// 	<input type=\'checkbox\' name=\'dec_filter_location\' id='.$key.'_1'.'  value="'.$value.'" /> '.$value.'</label></li>';
						// 	}
						// }
						$output .= '<li class="dec-location-checkbox"><label for="physical" >
						<input type=\'checkbox\' name=\'dec_filter_location\' id="physical"  value="physical" />'.__('Physical','decm-divi-event-calendar-module').'</label></li>	
						<li class="dec-location-checkbox"><label for="virtual" >
						<input type=\'checkbox\' name=\'dec_filter_location\' id="virtual"  value="virtual"/>'.__('Virtual','decm-divi-event-calendar-module').'</label></li>
						<li class="dec-location-checkbox"><label for="hybrid" >
						<input type=\'checkbox\' name=\'dec_filter_location\' id="hybrid"  value="hybrid"/>'.__('Hybrid','decm-divi-event-calendar-module').'</label></li>';
						//	wp_reset_postdata();
							$output .= "</ul>";		
			        }else{
						// 	$output = "<ul>";
						// 	foreach($filter_data_combine[3] as $key => $value) {
						// 		if(tribe_get_venue($key)!="" ){	
						// 	$output .= '<li class="dec-location-list" data-id='.$key.'>'.$value.'</li>';
						// 	}
						// }
						// 	$output .= "</ul>";
							$output = "<ul>";	
							$output .= '<li class="dec-location-list" data-id="physical">'.__('Physical','decm-divi-event-calendar-module').'</li>';
							$output .= '<li class="dec-location-list" data-id="virtual">'.__('Virtual','decm-divi-event-calendar-module').'</li>';
							$output .= '<li class="dec-location-list" data-id="hybrid">'.__('Hybrid','decm-divi-event-calendar-module').'</li>';
							$output .= "</ul>";

			    }
				$filter_output .= "
				<div class='dec-filter-bar dec-filter-location'>
						<div class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' >
							<span >".$dec_filter_label."</span><span id='dec-location-current-select'></span>
							<button type='button' class ='dec-location-remove'>×</button>
						</div>";

				$filter_output .= "<div class='dec-location-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
			break;
			case 'Date Range':
				$dec_filter_label = __('Date Range','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				$filter_output .= "
				<div class='dec-filter-bar dec-filter-date-range'>
						<div class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' id='reportrange'>
								<span id='dec-date-current-select'>".$dec_filter_label."</span>
								<button type='button' class ='dec-date-range-remove'>×</button>
								<input type='hidden' name='dec-date-range-text' id='dec-date-range-text' value='".$dec_filter_label."' />
								<input type='hidden' name='dec-date-range-format' id='dec-date-range-format' value='".$this->props['date_range_format']."' />				
						</div>    
				</div>";
			break;
			case 'Future':
				$dec_filter_label = __('Future/Past','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}


				$filter_output .=   "
				<div class='dec-filter-bar dec-filter-future-past-by'>
						<div class='dec-filter-label'  data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' >
							<span >".$dec_filter_label."</span><span id='dec-future-past-current-select'></span>
							<button type='button' class ='dec-future-past-remove'>×</button>
			     		</div> ";

				$filter_output .= "<div class='dec-future-past-filter-list dec-filter-list'>";
			
				if($filter_select == 'multi'){
					$filter_output .= "<ul><li class='dec-future-past-checkbox'><label for='Upcoming'><input type='checkbox' name='dec_filter_future_past' id='Upcoming' value='Upcoming' />".__("Upcoming",'decm-divi-event-calendar-module')."</label></li>
					 <li class='dec-future-past-checkbox'><label for='Past'><input type='checkbox' name='dec_filter_future_past' id='Past' value='Past' />".__("Past",'decm-divi-event-calendar-module')."</label></li> 
					</ul>";
				}else{
					$filter_output .= "<ul><li class='dec-future-past-list' data-id='Upcoming'>".__('Upcoming','decm-divi-event-calendar-module')."</li>
				    <li  class='dec-future-past-list' data-id='Past'>".__('Past','decm-divi-event-calendar-module')."</li></ul>";
				}
				
				$filter_output .= '</div></div>';
			break;
			case 'City':
				$dec_filter_label = __('City','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				$args = array(
					'post_type' => 'tribe_venue',
				);
				$loop = new WP_Query($args);

				if($show_alphabetical_order == "on"){
					asort($filter_data_combine[2]);
				 }

				if($filter_select == 'multi'){
							$output = "<ul>";
							foreach(array_filter(array_unique($filter_data_combine[2])) as $key => $value) {
								if(tribe_get_venue($key)!=""  ){	
							$output .= '<li class="dec-city-checkbox"><label for='.$key.'_2'.' >
							<input type=\'checkbox\' name=\'dec_filter_city\' id='.$key.'_2'.'  value="'.$value.'" /> '.$value.'</label></li>';
							}}
						
							$output .= "</ul>";	
					}else{

							$output = "<ul>";
						
							foreach(array_filter(array_unique($filter_data_combine[2])) as $key => $value) {
								if(tribe_get_venue($key)!=""){	
							$output .= '<li class="dec-city-list" data-id='.$key.'>'.$value.'</li>';
								}}
							
							$output .= "</ul>";

			    }

				$filter_output .= "<div class='dec-filter-bar dec-city-filter'>
				<div class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' >
				<span>".$dec_filter_label."</span><span id='dec-city-current-select'>
				</span>
				<button type='button' class ='dec-city-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-city-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
			break;
			case 'Country':
			
				$dec_filter_label = __('Country','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}

				if($show_alphabetical_order == "on"){
					asort($filter_data_combine[4]);
				 }

			if($filter_select == 'multi'){
					$output = "<ul>";
					foreach(array_filter(array_unique($filter_data_combine[4])) as $key => $value) {
						if(tribe_get_country($key)!="" ){	
						$output .= '<li  class="dec-country-checkbox"><label for='.$key.'_3'.' >
						<input type=\'checkbox\' name=\'dec_filter_country\' id='.$key.'_3'.'  value="'.$value.'" /> '.$value.'</label></li>';
					  }	}
					$output .= "</ul>";	
			}else{
				$output = "<ul>";
				foreach(array_filter(array_unique($filter_data_combine[4])) as $key => $value) {
					if(tribe_get_country($key)!="" ){	
				   $output .= '<li  class="dec-country-list" data-id='.$key.'>'.$value.'</li>';
				}}
				$output .= "</ul>";
			}

				$filter_output .= "<div class='dec-filter-bar dec-country-filter'>
				<div class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' >
				<span>".$dec_filter_label."</span><span id='dec-country-current-select'></span>
				<button type='button' class ='dec-country-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-country-filter-list dec-filter-list'>
				<span class='dec-country-filter-selection-list'></span>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
			break;
			case 'State':
				$dec_filter_label = __('State/Province','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}

				if($show_alphabetical_order == "on"){
					asort($filter_data_combine[7]);
				 }

				 if($filter_select == 'multi'){
					$output = "<ul>";
			//print_r($filter_data_combine[7]);
					foreach(array_filter(array_unique($filter_data_combine[7])) as $key => $value) {
						//print_r(tribe_get_province($key));
						//if(tribe_get_region($key)!="" &&tribe_get_province($key)!="" ){
						$output .= '<li  class="dec-state-checkbox"><label for='.$key.'_4'.' >
					<input type=\'checkbox\' name=\'dec_filter_state\' id='.$key.'_4'.'  value="'.$value.'" /> '.$value.'</label></li>';
					//}
				}
				//	endwhile;
				//	wp_reset_postdata();
					$output .= "</ul>";		
		}else{
					$output = "<ul>";
					foreach(array_filter(array_unique($filter_data_combine[7])) as $key => $value) {
						if(tribe_get_province($key)!="" ||tribe_get_region($key)!="" ){
						$output .= '<li  class="dec-state-list" data-id='.$key.'>'.$value.'</li>';
					}
				}
					//endwhile;
				//	wp_reset_postdata();
					$output .= "</ul>";

		 }

				$filter_output .= "<div class='dec-filter-bar dec-state-filter'>
				<div class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' ><span>".$dec_filter_label."</span><span id='dec-state-current-select'></span>
				<button type='button' class ='dec-state-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-state-filter-list dec-filter-list'>
				<span class='dec-state-filter-selection-list'></span>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
			break;
			case 'Year':
				$dec_filter_label = __('Year','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
			
				$filter_output .= "<div class='dec-filter-bar dec-filter-year'>
				<div  class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."'>
				<span >".$dec_filter_label."</span><span id='dec-year-current-select'></span>
				<button type='button' class ='dec-year-remove'>×</button>
				 </div>";				
				$filter_output .= "<div class='dec-year-filter-list dec-filter-list'>";
				if($filter_select == 'multi'){
    				foreach((array) $decm_filters_years as $index => $value) {
						$filter_output .=  "<li class='dec-years-checkbox' ><label for=".$index." >
						<input type='checkbox' name='dec_filter_years' id=".$index." value=".$index."  /> ".$value."</label></li>";
					  }	
				}else{
					foreach((array) $decm_filters_years as $index => $value) {
						$filter_output .=  "<li class='dec-years-list'  data-id=".$index.">". $value."</li>";
					  }			
				}	
				$filter_output .= '</div></div>';
			break;
			case 'Month ':
				$dec_filter_label = __('Month','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				$decm_filters_months = array(
				  '01'  => __('January','decm-divi-event-calendar-module'),
				  '02'  =>__('February','decm-divi-event-calendar-module'), 
				  '03'  =>__('March','decm-divi-event-calendar-module'),
				  '04'  =>__('April','decm-divi-event-calendar-module'), 
				  '05'  =>__('May','decm-divi-event-calendar-module'), 
				  '06'  => __('June','decm-divi-event-calendar-module'),
				  '07'  => __('July','decm-divi-event-calendar-module'),
				  '08'  => __('August','decm-divi-event-calendar-module'),
				  '09'  =>__('September','decm-divi-event-calendar-module'), 
				  '10'  => __('October','decm-divi-event-calendar-module'),
				  '11'  => __('November','decm-divi-event-calendar-module'),
				  '12'  =>__('December','decm-divi-event-calendar-module'), 
				);
				$filter_output .= "<div class='dec-filter-bar dec-filter-month'>
				<div  class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."'>
				<span >".$dec_filter_label."</span><span id='dec-month-current-select'></span>
				<button type='button' class ='dec-month-remove'>×</button>
				 </div>";

				$filter_output .= "<div class='dec-month-filter-list dec-filter-list'>";

				if($filter_select == 'multi'){
    				foreach((array) $decm_filters_months as $index => $value) {
						$filter_output .=  "<li  class='dec-months-checkbox'><label for=".$index." >
						<input type='checkbox' name='dec_filter_months' id=".$index." value=".$value."  /> ".$value."</label></li>";
					  }	
				}else{
					foreach((array) $decm_filters_months as $index => $value) {
						$filter_output .=  "<li  class='dec-months-list' data-id=".$index.">". $value."</li>";
					  }	
					
				}

				$filter_output .= '</div></div>';

			break;
			case 'Organizer':

				$filter_data_combines = $this->getUniqueOrganizers($filter_data_combine);
			
				$dec_filter_label = __('Organizer', 'decm-divi-event-calendar-module');
				if (!empty($custom_label)) {
					$dec_filter_label = __($custom_label, 'decm-divi-event-calendar-module'); // phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
			
				if ($show_alphabetical_order == "on") {
					asort($filter_data_combines); 
				}
			
				$output = "<ul>";
			
				if ($filter_select == 'multi') {
					foreach ($filter_data_combines as $key => $value) {
						if (!empty($value) && tribe_get_organizers($key) != "") {
							$output .= '<li class="dec-organizer-checkbox"><label for='.$key.' >
								<input type=\'checkbox\' name=\'dec_filter_organizer\' id='.$key.'  value="'.$value.'" /> '.$value.'</label></li>';
						}
					}
				} else {
					foreach ($filter_data_combines as $key => $value) {
						if (tribe_get_organizer($key) != "") {
							$output .= '<li class="dec-organizer-list" data-id='. $key.'>'. $value.'</li>';
						}
					}
				}
			
				$output .= "</ul>";
			
				$filter_output .= "<div class='dec-filter-bar dec-organizer-filter'>
				<div class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."'>
				<span>".$dec_filter_label."</span><span id='dec-organizer-current-select'></span>
				<button type='button' class = 'dec-organizer-remove'>×</button></div>";
				
				$filter_output .= "<div class='dec-organizer-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';			
				break;
			case 'Category':

				$dec_filter_label = __('Category','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}

				$categories = get_categories( array(
					'taxonomy' => 'tribe_events_cat',
					
				) );

				if($show_alphabetical_order == "on"){
					asort($filter_data_combine[5]);
				 }


				 if($show_display_inline == "on"){
					if($filter_select == 'multi'){
						$filter_output .= "<div class='dec-filter-event-inline custom__ul_boxes'>";
								foreach ($filter_data_combine[5] as $key => $value) {
									$filter_output .= '
									<div class="custom__li_filter dec-filter-bar dec-filter-event-category-inline" data-id="'.$key.'">
										<label for="'.$key.'" class="lbl-checkbox" style="display: inline-block; cursor:pointer; border-radius:50px;">
												<input  style="display:none;" type="checkbox"  aria-label="an appropriate label" class="custom__input" name="dec_filter_category" id="'.$key.'" value="'.$value.'" /> '.$value.'
										</label>
									</div>';
								}
							$filter_output .= "</div>";
					}else{
						$filter_output .= "<div class='dec-filter-event-inline'>";
							foreach($filter_data_combine[5] as $key => $value) {
							//	if(tribe_get_organizer($key)!=""){
							//	$output .= '<li class ="decm-filter-catrgory-list" data-id='.$key.'>'.$value.'</li>';
							$filter_output .= "<li class=' dec-filter-bar dec-filter-event-category-inline' data-id=".$key.">".$value."</li>";		
							// $filter_output .= "".$value."";
							// $filter_output .= "</div>";
							}

						$filter_output .= "</div>";

					}


				 }else{
					if($filter_select == 'multi'){
						$output = "<ul>";
						foreach ($filter_data_combine[5] as $key => $value ) {
								$output .= '<li class="decm-filter-catrgory-checkbox"><label for='.$key.' >
								<input type=\'checkbox\' name=\'dec_filter_category\' id='.$key.'  value="'.$value.'" /> '.$value.'</label></li>';
								}
						$output .= "</ul>";		
					}else{
	
						$output = "<ul>";
						foreach($filter_data_combine[5] as $key => $value) {
						//	if(tribe_get_organizer($key)!=""){
							$output .= '<li class ="decm-filter-catrgory-list" tabindex=\'0\' data-id='.$key.'>'.$value.'</li>';
						}
						$output .= "</ul>";
	
					}

					$filter_output .= "<div class=' dec-filter-bar dec-filter-event-category'>
				<div  class=' dec-filter-label' tabindex='0'  data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."' ><span>".esc_attr($dec_filter_label)."</span><span id='dec-event-current-select'></span>
				<button type='button' class = 'dec-category-remove'>×</button>
				</div>";
				
				$filter_output .= "<div class='dec-event-category-filter-list dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';	
				 }
		

			break;

			case 'Tag':
				$dec_filter_label = __('Tag','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				$tags = get_categories( array(
					'taxonomy' => 'post_tag',
				) );

				if($show_alphabetical_order == "on"){
					asort($filter_data_combine[6]);
				 }
//print_r(get_terms( Tribe__Events__Main::TAXONOMY, array( 'orderby' => 'name', 'order' => 'ASC' ) ));
				if($filter_select == 'multi'){
					$output = "<ul>";
					foreach ($filter_data_combine[6] as $key => $value ) {
							$output .= '<li class ="dec-tag-checkbox"><label for='.$key.' >
							<input type=\'checkbox\' name=\'dec_filter_tag\' id='.$key.'  value="'.$value.'" /> '.$value.'</label></li>';
							}
					$output .= "</ul>";		
				}else{

					$output = "<ul>";
					foreach ($filter_data_combine[6] as $key => $value ) {
						$output .= '<li class ="dec-tag-list" data-id='.$key.'>'.$value.'</li>';
					}
					$output .= "</ul>";
				}


				$filter_output .= "<div class='dec-filter-bar dec-filter-tag'>
				<div  class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."'>
				<span >".$dec_filter_label."</span><span id='dec-tag-current-select'></span>
				<button type='button' class = 'dec-tag-remove'>×</button>
				 </div>";
				
				$filter_output .= "<div class='dec-tag-filter-list  dec-filter-list'>";
				$filter_output .= $output;
				$filter_output .= '</div></div>';
			break;	
			case 'Day':
				$dec_filter_label = __('Day','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				$decm_filters_days = array(
					'Sunday'    => __('Sunday', 'decm-divi-event-calendar-module'),
					'Monday'    => __('Monday', 'decm-divi-event-calendar-module'),
					'Tuesday'   => __('Tuesday', 'decm-divi-event-calendar-module'),
					'Wednesday' => __('Wednesday', 'decm-divi-event-calendar-module'),
					'Thursday'  => __('Thursday', 'decm-divi-event-calendar-module'),
					'Friday'    => __('Friday', 'decm-divi-event-calendar-module'),
					'Saturday'  => __('Saturday', 'decm-divi-event-calendar-module'),
				);
				
				// Create an ordered array of day names based on the WordPress "start of the week" setting
				$startOfWeek = (int) get_option('start_of_week', 1); // Default to 1 (Monday)
				$allDays = array_keys($decm_filters_days); // Static keys remain unchanged
				$orderedKeys = array_merge(
					array_slice($allDays, $startOfWeek),
					array_slice($allDays, 0, $startOfWeek)
				);
				
				// Prepare days for the past 7 days
				$goBackDays = 7;
				$today = new DateTime();
				$daysSorted = [];
				
				// Loop through the last 7 days
				for ($i = 0; $i < $goBackDays; $i++) {
					$dayOfWeek = $today->format('l'); // Get the full name of the day
					$daysSorted[$dayOfWeek] = $decm_filters_days[$dayOfWeek]; // Translate value, keep key
					$today->modify('-1 day');
				}
				
				// Reorder `$daysSorted` based on `$orderedKeys`
				uksort($daysSorted, function ($a, $b) use ($orderedKeys) {
					return array_search($a, $orderedKeys) - array_search($b, $orderedKeys);
				});
				
				
				$filter_output .= "<div class='dec-filter-bar dec-filter-day'>
				<div  class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."'>
				<span >".$dec_filter_label."</span><span id='dec-day-current-select'></span>
				<button type='button' class = 'dec-day-remove'>×</button>
				 </div>";

				$filter_output .= "<div class='dec-day-filter-list dec-filter-list'>";
				 if($filter_select == 'multi'){
    				foreach((array) $daysSorted as $index => $value) {
						$filter_output .=  "<li class ='dec-days-checkbox'><label for=".$index." >
						<input type='checkbox' name='dec_filter_days' id=".$index." value=".$value."  /> ".$value."</label></li>";
					  }	
				}else{
					foreach((array) $daysSorted as $index => $value) {
						$filter_output .=  "<li class ='dec-days-list'  data-id=".$index.">". $value."</li>";
					  }	
				}	
				$filter_output .= '</div></div>';

			break;	
			case 'Time':
				$dec_filter_label = __('Time','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =  __($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				$decm_filters_Days = array(
					'allDays'  =>__('All Day','decm-divi-event-calendar-module'),
					'morning'  => __('Morning','decm-divi-event-calendar-module'),
					'afternoon'  =>__('Afternoon','decm-divi-event-calendar-module'),
					'evening'  => __('Evening','decm-divi-event-calendar-module'),
					'night'  =>__('Night','decm-divi-event-calendar-module') ,	
				  );

				$filter_output .= "<div class='dec-filter-bar dec-filter-time'>
				<div  class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."'>
				<span >".$dec_filter_label."</span><span id='dec-time-current-select'></span>
				<button type='button' class = 'dec-time-remove'>×</button>
				 </div>";
				 $filter_output .= "<div class='dec-time-filter-list dec-filter-list'><ul>";

				  foreach((array) $decm_filters_Days as $index => $value) {
						$filter_output .=  "<li class='dec-time-list' data-id=".$index.">". $value."</li>";
				  }				
				//}

				$filter_output .= '</div></div>';
			break;
			case 'Status':
				$decm_filters_status = array(
					'scheduled'  => __('Scheduled','decm-divi-event-calendar-module'),
					'canceled'  =>  __('Canceled','decm-divi-event-calendar-module'),
					'postponed'  => __('Postponed','decm-divi-event-calendar-module'),
				);
				$dec_filter_label =  __('Status','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =	__($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				$filter_output .= "<div class='dec-filter-bar dec-filter-status'>
				<div  class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."'>
				<span >".$dec_filter_label."</span><span id='dec-status-current-select'></span>
				<button type='button' class = 'dec-status-remove'>×</button>
				 </div>";
				 $filter_output .= "<div class='dec-status-filter-list dec-filter-list'><ul>";
				 if($filter_select == 'multi'){
    				foreach((array) $decm_filters_status as $index => $value) {
						$filter_output .=  "<li class ='dec-status-checkbox'><label for=".$index." >
						<input type='checkbox' name='dec_filter_status' id=".$index." value=".$value."  /> ".$value."</label></li>";
					  }	
				}else{
				  foreach((array) $decm_filters_status as $index => $value) {
						$filter_output .=  "<li class='dec-status-list' data-id=".$index.">". $value."</li>";
				  }	
				}			
				$filter_output .= '</div></div>';
			break;

			case 'Recurring':
				$decm_filters_recurring = array(
					'false'  => __('Yes','decm-divi-event-calendar-module'),
					'true'  => __('No','decm-divi-event-calendar-module'),
				);
				
				$dec_filter_label =  __('Recurring','decm-divi-event-calendar-module');
				if(!empty($custom_label)){
					$dec_filter_label =	__($custom_label,'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
				}
				
				$filter_output .= "<div class='dec-filter-bar dec-filter-recurring'>
				<div  class='dec-filter-label' data-icon='".$custom_icon."' data-icon-tablet = '".$custom_icon_tablet."' data-icon-phone = '".$custom_icon_phone."'>
				<span>".$dec_filter_label."</span><span id='dec-recurring-current-select'></span>
				<button type='button' class = 'dec-recurring-remove'>×</button>
				 </div>";
				 $filter_output .= "<div class='dec-recurring-filter-list dec-filter-list'><ul>";
				 if($filter_select == 'multi'){
    				foreach((array) $decm_filters_recurring as $index => $value) {
						$filter_output .=  "<li class ='dec-recurring-checkbox'><label for=".$index." >
						<input type='checkbox' name='dec_filter_recurring' id=".$index." value=".$value."  /> ".$value."</label></li>";
					  }	
				}else{
				  foreach((array) $decm_filters_recurring as $index => $value) {
						$filter_output .=  "<li class='dec-recurring-list' data-id=".$index.">". $value."</li>";
				  }	
				}			
				$filter_output .= '</div></div>';
			break;


		}

		return sprintf('%s', $filter_output);		 
		//$filter_titles_html .=  $filter_output;		
		 //  return  $this->_render_module_wrapper( $filter_output, $render_slug );		 
		}



		/**
 * get organizro by ids
 * 
 * created y wbbgs
 */


public function getOrganizerDataById($organizer_ids) {
    // Flatten the multidimensional organizer ID array
    $flattened_ids = [];
    foreach ($organizer_ids as $subArray) {
        $flattened_ids = array_merge($flattened_ids, $subArray);
    }

    $organizer_data = [];

    // Loop through each ID and fetch the title (name)
    foreach ($flattened_ids as $id) {
        $name = get_the_title($id); // Fetch the title using WordPress function
        if ($name) {
            $organizer_data[$id] = $name;
        } else {
            $organizer_data[$id] = "Unknown Organizer"; // Handle missing titles
        }
    }

    return $organizer_data;
}

/**
 * Function to adjust the array to get the unique array of organizer
 * 
 * created by wbbgs
 */

public function getUniqueOrganizers($inputArray) {
    $uniqueOrganizers = [];

    // Check if the first index of the input array exists and is an array
    if (isset($inputArray[0]) && is_array($inputArray[0])) {
        foreach ($inputArray[0] as $subArray) {
            if (is_array($subArray)) {
                foreach ($subArray as $key => $value) {
                    // Collect unique organizers
                    if (!isset($uniqueOrganizers[$key])) {
                        $uniqueOrganizers[$key] = $value;
                    }
                }
            }
        }
    }

    return $uniqueOrganizers;
}

		static function get_filter_data($decm_filterData = array()){

			$decm_tag_array = array();
			$decm_event_category = array();
			$decm_venue = array();
			$decm_venueCity = array();
			$decm_venueCountry = array();
			$decm_venueState = array();
			$decm_venueAddress = array();
			$decm_organizerData = array();
			$maximum_cost = tribe_get_maximum_cost();


			$tags = get_categories( array(
				'taxonomy' => 'post_tag',
			) );
			
			foreach ((array)  $tags as $tag ) {
				$decm_tag_array[] = $tag->name;
			}

			$categories = get_categories( array(
				'taxonomy' => 'tribe_events_cat',
			) );
		
			foreach ((array)  $categories as $category ) {
				$decm_event_category[] = $category->name;
			}

			$args = array(
				'post_type' => 'tribe_venue',
			);
			$loop = new WP_Query($args);
			while($loop->have_posts()): $loop->the_post();	
					$decm_venue[] = get_the_title();
					$decm_venueCity[] =  tribe_get_city(get_the_ID());
					$decm_venueCountry[] =  tribe_get_country(get_the_ID());
					$decm_venueState[] =  tribe_get_province(get_the_ID());
					$decm_venueAddress[] =  tribe_get_address(get_the_ID());
			endwhile;

			$organizers = tribe_get_organizers();
		
			foreach ((array) $organizers as $organizer ) {
				$decm_organizerData[] = $organizer->post_title;
			}
			
			$decm_filterData = array(
				'tag' => $decm_tag_array, 
				'category' => $decm_event_category,
				'venue' => $decm_venue,
				'city' => $decm_venueCity,
				'country' => $decm_venueCountry,
				'state' => $decm_venueState,
				'address' => $decm_venueAddress,
				'organizer' => $decm_organizerData,
				'maxCost' => $maximum_cost,
			);
			return $decm_filterData;
	}
	
}

new DECM_EventDisplayChild;
