<?php

class DECS_EventSubscriber extends ET_Builder_Module {

	public $slug       = 'decs_event_subscriber';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Subscribe', 'decm-divi-event-calendar-module' );
	}

	public function get_settings_modal_toggles() {
		return array(
			'advanced' => array(
				'toggles' => array(				
					'event_subscribe'  => esc_html__( 'Event Subscribe Button', 'decm-divi-event-calendar-module' ),

			),),
		);}
	function get_advanced_fields_config() {
		return array(
			'text'           => false,
			'button'         => false,
			'fonts'           => false,
			
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
			'margin_padding' => array(
				'css' => array(
					'important' => 'all',
				),
			),
			'button'         => array(
			  'event_subscribe' => array(
				  'label'         => esc_html__( 'Event Subscribe Button', 'decm-divi-event-calendar-module' ),
				  'description'		=> esc_html__( 'Enable this feature to customize the appearance of the button', 'decm-divi-event-calendar-module' ),
				  'css'           => array(
					  'main' => " %%order_class%%.et_pb_button_wrapper,%%order_class%% .dces-subscribe_button_text",
					  'plugin_main' =>" %%order_class%%.et_pb_button_wrapper,%%order_class%% .dces-subscribe_button_text",
					  'alignment'   => "%%order_class%%",
					  'important' => 'all',	
				  ),
				  //'all_buttons_border_radius'                    => '7',
				  'use_alignment' => array(
					  'label'         => esc_html__( 'alignment of era', 'decm-divi-event-calendar-module' ),
					  'description'		=> esc_html__( 'Enable this feature to customize the appearance of the button', 'decm-divi-event-calendar-module' ),
				  ),
				  'box_shadow'    => false,

				  'text_size'           => array(
					  'default' => '20px',
				  ),	
	  
				  'margin_padding' => array(
					  'css' => array(
						  'margin' => "%%order_class%% div.dces-subscribe_button",
						   'padding' => "%%order_class%% .dces-subscribe_button_text",
						  'important' => 'all',
					  ),
					  'custom_margin' => array(
				  'default' => 'auto|auto|auto|auto|false|false',
				   ),
				  ),
			  
			  
			  ),		  

		  ),);
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
				'toggle_slug'      => 'link_options',
			),
			'shortcode_param' => array(
				'label'             => esc_html__( 'shortcode_param', 'decm-divi-event-calendar-module' ),
				'type'              => 'text',
				'option_category'   => 'configuration',
				'description'       => esc_html__( 'Total number of events to show.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'      => 'link_options',
				'default'           => '',
				'show_if' => array(
					'use_shortcode'=>'on',
				)
			),


			'button_url'       => array(
			  'label'           => esc_html__( 'Button Link URL', 'decm-divi-event-calendar-module' ),
			  'type'            => 'hidden',
			  'option_category' => 'basic_option',
			  'description'     => esc_html__( 'Input the destination URL for your button.', 'decm-divi-event-calendar-module' ),
			  'toggle_slug'     => 'link_options',
			  'dynamic_content' => 'url',
		  ),
		  'url_new_window'   => array(
			  'label'            => esc_html__( 'Button Link Target', 'decm-divi-event-calendar-module' ),
			  'type'            => 'hidden',
			  'option_category'  => 'configuration',
			  'options'          => array(
				  'off' => esc_html__( 'In The Same Window', 'decm-divi-event-calendar-module' ),
				  'on'  => esc_html__( 'In The New Tab', 'decm-divi-event-calendar-module' ),
			  ),
			  'toggle_slug'      => 'link_options',
			  'description'      => esc_html__( 'Here you can choose whether or not your link opens in a new window', 'decm-divi-event-calendar-module' ),
			  'default_on_front' => 'off',
		  ),
		  'button_text'      => array(
			  'label'           =>  esc_html__( 'Button', 'decm-divi-event-calendar-module' ),
			  'type'            => 'hidden',
			  'option_category' => 'basic_option',
			  'description'     => esc_html__( 'Input your desired button text.', 'decm-divi-event-calendar-module' ),
			  'toggle_slug'      => 'link_options',
			  'default'=>"joshi",
			  'dynamic_content' => 'text',
			  'mobile_options'  => true,
			  'hover'           => 'tabs',
		  ),
		  'button_alignment' => array(
			  'label'           => esc_html__( 'Button Alignment', 'decm-divi-event-calendar-module' ),
			  'description'     => esc_html__( 'Align your button to the left, right or center of the module.', 'decm-divi-event-calendar-module' ),
			  'type'            => 'hidden',
			  'option_category' => 'configuration',
			  'options'         => et_builder_get_text_orientation_options( array( 'justified' ) ),
			  //'tab_slug'        => 'advanced',
			  'toggle_slug'     => 'link_options',
			  'description'     => esc_html__( 'Here you can define the alignment of Button', 'decm-divi-event-calendar-module' ),
			  'mobile_options'  => true,
		  ),
		  'event_subscribe_icons_list' => array(
			  'label'           => esc_html__( 'Button Text', 'decm-divi-event-calendar-module' ),
			  'type'            => 'hidden',
			  'option_category' => 'basic_option',
			  'description'     => esc_html__( 'Post button.', 'decm-divi-event-calendar-module' ),
			  'toggle_slug'      => 'link_options',
			  'default'         => $this->get_icon_list(et_pb_get_font_icon_symbols()),
		  ),
			'__posts' => array(
				'type' => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				'computed_depends_on' => array(
					''
				),
			),
			'__page'          => array(
				'type'              => 'computed',
				'computed_callback' => array( 'ET_Builder_Module_Blog', 'get_blog_posts' ),
				'computed_affects'  => array(
				'__posts',
				),
			),
		  //   '__getEvents'          => array(
		  // 	  'type'              => 'computed',
		  // 	  'computed_callback' => array( 'DCET_EventTicket', 'get_blog_posts_events' ),
		  // 	  'computed_depends_on'  => array(
		  //          '',					  

		  // 	  ),
	  //	  ),

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
	public function render( $attrs, $content, $render_slug ) {
	
		if ( !function_exists( 'tribe_get_events' ) ) {
			return 'Divi Events Calendar requires The Events Calendar to be installed and active.';
		}
	  //   $atts = array();
	  //   $use_shortcode = $this->props['use_shortcode'];
	  //   $shortcode_param = $this->props['shortcode_param'];
	  
	   // $multi_view     = et_pb_multi_view_options( $this );
		$button_url     = $this->props['button_url'];
		
		$button_text    = $this->_esc_attr( 'button_text', 'limited' );
		$url_new_window = $this->props['url_new_window'];
		//$button_custom  = $this->props['custom_button'];

		// $button_alignment              = $this->get_button_alignment();
		$is_button_aligment_responsive = et_pb_responsive_options()->is_responsive_enabled( $this->props, 'button_alignment' );
		$button_alignment_tablet       = $is_button_aligment_responsive ? $this->get_button_alignment( 'tablet' ) : '';
		$button_alignment_phone        = $is_button_aligment_responsive ? $this->get_button_alignment( 'phone' ) : '';

	  //    $custom_icon_values_subscribe              = et_pb_responsive_options()->get_property_values( $this->props, 'event_subscribe_icon' );
	  //   $custom_icon_subscribe                     = isset( $custom_icon_values['desktop'] ) ? $this->props['event_subscribe_icon'] == '' ? '' : esc_attr( et_pb_process_font_icon( $custom_icon_values['desktop'] ) ) : '';
	  //   $custom_icon_tablet_subscribe              = isset( $custom_icon_values['tablet'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['tablet'] ) ) : '';
	  //   $custom_icon_phone_subscribe              = isset( $custom_icon_values['phone'] ) ? esc_attr( et_pb_process_font_icon( $custom_icon_values['phone'] ) ) : '';
		$event_subscribe_icon_array  =  $this->props['event_subscribe_icon'] != "" ? $this->props['event_subscribe_icon'] : '';
		$event_subscribe_icon_phone_array  =  $this->props['event_subscribe_icon_phone'] != "" ? $this->props['event_subscribe_icon_phone'] : '';
		$event_subscribe_icon_tablet_array  = $this->props['event_subscribe_icon_tablet'] != "" ? $this->props['event_subscribe_icon_tablet'] : '';
		$event_subscribe_icon = explode("|",$event_subscribe_icon_array);
		$event_subscribe_icon_phone = explode("|",$event_subscribe_icon_phone_array);
		$event_subscribe_icon_tablet = explode("|",$event_subscribe_icon_tablet_array);
		// Button Alignment.
		$button_alignments = array();
		if ( ! empty( $button_alignment ) ) {
			array_push( $button_alignments, sprintf( 'et_pb_button_alignment_%1$s', esc_attr( $button_alignment ) ) );
		}

		if ( ! empty( $button_alignment_tablet ) ) {
			array_push( $button_alignments, sprintf( 'et_pb_button_alignment_tablet_%1$s', esc_attr( $button_alignment_tablet ) ) );
		}

		if ( ! empty( $button_alignment_phone ) ) {
			array_push( $button_alignments, sprintf( 'et_pb_button_alignment_phone_%1$s', esc_attr( $button_alignment_phone ) ) );
		}

		$button_alignment_classes = join( ' ', $button_alignments );

		// Nothing to output if neither Button Text nor Button URL defined
		$button_url = trim( $button_url );

		if ( '' === $button_text && '' === $button_url ) {
			return '';
		}

		// Background layout data attributes.
		$data_background_layout = et_pb_background_layout_options()->get_background_layout_attrs( $this->props );

		// Background layout class names.
		$background_layout_class_names = et_pb_background_layout_options()->get_background_layout_class( $this->props );
		$this->add_classname( $background_layout_class_names );

		// Module classnames
		$this->remove_classname( 'et_pb_module' );
// print_r(iCalendar_Handler::get_subscribe_links( $view = null ));
  
							  $view_icon=($this->props['event_subscribe_on_hover']=="off")?"et_pb_subscribe_hover":"";
							  $icon_align =($this->props['event_subscribe_icon_placement']=="left")?"et_pb_button_icon_align":"";
							  $button_classes = ($this->props['custom_event_subscribe'] == 'on') ? " dces_subscribe_button_icon  et_pb_custom_button_icon ".$view_icon." ".$icon_align : "";
						  
		// Render Button
		$button ='<div class="dces-subscribe_button et_pb_button_module_wrapper">
		<button onclick="myFunction()" class="dces-subscribe_button_text '.$button_classes.'" id="dces-subscribe_button_text_id" data-icon="'.$event_subscribe_icon[0].'" data-icon-tablet="'.$event_subscribe_icon_tablet[0].'" data-icon-phone="'.$event_subscribe_icon_phone[0].'">'.__('Subscribe To Calendar','decm-divi-event-calendar-module').'</button>
		<div id="dces-subscribe_dropdown-content_id" class="dces-subscribe_dropdown-content">
	  
	  <a href="https://www.google.com/calendar/render?cid=webcal%3A%2F%2F'.trim( str_replace( array( 'http://', 'https://' ), '', get_site_url() ), '/' ).'%2F%3Fpost_type%3Dtribe_events%26tribe-bar-date%3D'.gmdate('Y-m-d').'%26ical%3D1%26eventDisplay%3Dlist">'.__('Google Calendar','decm-divi-event-calendar-module').'</a>
  
		  <a href="webcal://'.trim( str_replace( array( 'http://', 'https://' ), '', get_site_url() ), '/' ).'/?post_type=tribe_events&tribe-bar-date='.gmdate('Y-m-d').'&ical=1&eventDisplay=list">'.__('iCalendar','decm-divi-event-calendar-module').'</a>
		  <a href="https://outlook.office.com/owa?path=%2Fcalendar%2Faction%2Fcompose&amp;rru=addsubscription&amp;url=webcal%253A%252F%252F'.trim( str_replace( array( 'http://', 'https://' ), '', get_site_url() ), '/' ).'%252F%253Fpost_type%253Dtribe_events%2526tribe-bar-date%253D'.gmdate('Y-m-d').'%2526eventDisplay%253Dlist%26ical%3D1&amp;name='.str_replace(' ', '+', get_bloginfo()).'+Events+%7C+'.str_replace(' ', '+', get_bloginfo()).'">
		  '.__(' Outlook 365','decm-divi-event-calendar-module').'</a>
		  <a href="https://outlook.live.com/owa?path=%2Fcalendar%2Faction%2Fcompose&amp;rru=addsubscription&amp;url=webcal%253A%252F%252F'.trim( str_replace( array( 'http://', 'https://' ), '', get_site_url() ), '/' ).'%252F%253Fpost_type%253Dtribe_events%2526tribe-bar-date%253D'.gmdate('Y-m-d').'%2526eventDisplay%253Dlist%26ical%3D1&amp;name='.str_replace(' ', '+', get_bloginfo()).'+Events+%7C+'.str_replace(' ', '+', get_bloginfo()).'" >
		  '.__(' Outlook Live','decm-divi-event-calendar-module').'</a>
		  <a href="'.tribe_get_events_link().'/list/?ical=1">'.__('Export .ics file','decm-divi-event-calendar-module').'</a>
		  <a href="'.tribe_get_events_link().'/list/?outlook-ical=1">'.__('Export Outlook .ics file','decm-divi-event-calendar-module').'</a>
		  
		</div>
	  </div>';
		// $this->render_button(
	  // 	  array(
	  // 		 // 'button_id'           => $this->module_id( false ),
	  // 		  'button_classname'    => explode( ' ', $this->module_classname( $render_slug ) ),
	  // 		  'button_custom'       => $button_custom,
	  // 		  'button_rel'          => $button_rel,
	  // 		  'button_text'         => $button_text,
	  // 		  'button_text_escaped' => true,
	  // 		  'button_url'          => $button_url,
	  // 		  'custom_icon'         => $custom_icon,
	  // 		  'custom_icon_tablet'  => $custom_icon_tablet,
	  // 		  'custom_icon_phone'   => $custom_icon_phone,
	  // 		  'has_wrapper'         => true,
	  // 		  'url_new_window'      => $url_new_window,
	  // 		//   'multi_view_data'     => $multi_view->render_attrs(
	  // 		// 	  array(
	  // 		// 		  'content'        => '{{button_text}}',
	  // 		// 		  'hover_selector' => '%%order_class%%.et_pb_button',
	  // 		// 		  'visibility'     => array(
	  // 		// 			  'button_text' => '__not_empty',
	  // 		// 		  ),
	  // 		// 	  )
	  // 		//   ),
	  // 	  )
	  //   );  
	  
	//  jQuery(\'.dces-subscribe_dropdown-content\').toggleClass("show");
	// document.getElementById("dces-subscribe_dropdown-content_id").classList.toggle("show");
	wp_enqueue_style('bootstrap_style','https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.1/css/bootstrap.min.css');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	
	$output = sprintf(
	  '
	  
	  %1$s
	  
	  <script>

function myFunction() {
jQuery(\'.dces-subscribe_dropdown-content\').toggleClass("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
if (!event.target.matches(".dces-subscribe_button_text")) {
  var dropdowns = document.getElementsByClassName("dces-subscribe_dropdown-content");
  var i;
  for (i = 0; i < dropdowns.length; i++) {
	var openDropdown = dropdowns[i];
	if (openDropdown.classList.contains("show")) {
	  openDropdown.classList.remove("show");
	}
  }
}
}
document.getElementById("dces-subscribe_button_text_id").addEventListener("click", function (e) {
  var target = e.target;

  target.classList.toggle("iconize");
  target.classList.toggle("iconize2");
}, false);
</script>
',
	  et_core_esc_previously( $button ),
	  esc_attr( $button_alignment_classes ),
	  esc_attr( ET_Builder_Element::get_module_order_class( $this->slug ) ),
	  et_core_esc_previously( $data_background_layout )
  );

  $transition_style = $this->get_transition_style( array( 'all' ) );
  self::set_style(
	  $render_slug,
	  array(
		  'selector'    => '%%order_class%%, %%order_class%%:after',
		  'declaration' => esc_html( $transition_style ),
	  )
  );

  // Tablet.
  $transition_style_tablet = $this->get_transition_style( array( 'all' ), 'tablet' );
  if ( $transition_style_tablet !== $transition_style ) {
	  self::set_style(
		  $render_slug,
		  array(
			  'selector'    => '%%order_class%%, %%order_class%%:after',
			  'declaration' => esc_html( $transition_style_tablet ),
			  'media_query' => ET_Builder_Element::get_media_query( 'max_width_980' ),
		  )
	  );
  }

  // Phone.
  $transition_style_phone = $this->get_transition_style( array( 'all' ), 'phone' );
  if ( $transition_style_phone !== $transition_style || $transition_style_phone !== $transition_style_tablet ) {
	  $el_style = array(
		  'selector'    => '%%order_class%%, %%order_class%%:after',
		  'declaration' => esc_html( $transition_style_phone ),
		  'media_query' => ET_Builder_Element::get_media_query( 'max_width_767' ),
	  );
	  self::set_style( $render_slug, $el_style );
  }

  return $output;
	}
}

new DECS_EventSubscriber;
