<?php


class DCET_EventTicket extends ET_Builder_Module {

	public $slug       = 'dcet_event_ticket';
	public $vb_support = 'on';

	protected $module_credits = array(
		'module_uri' => '',
		'author'     => '',
		'author_uri' => '',
	);

	public function init() {
		$this->name = esc_html__( 'Events Ticket', 'decm-divi-event-calendar-module' );
	}

  /**
	   * Module's advanced fields configuration
	   *
	   * @since 1.0.0
	   *
	   * @return array
	   * @var array $event_ids
	   */
	  
	  function get_advanced_fields_config() {
		  return array(
			  'text'           => false,
			  'button'         => false,
			  
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


			  'show_event_tickets' => array(
				'label'				=> esc_html__( 'Show Event Tickets', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Display the event tickets information.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
			  //   'computed_affects'   => array(
			  // 	  '__posts',
			  // 	  '__getEvents',
			  //   ),
				'default'			=> 'on',
			  //   'show_if' => array(
			  // 	  'use_shortcode'=>'off',
			  //   )
			),
			

			  'show_event_rsvp' => array(
				'label'				=> esc_html__( 'Show Event RSVP', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Display the event RSVP information.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
			  //   'computed_affects'   => array(
			  // 	  '__posts',
			  // 	  '__getEvents',
			  //   ),
				'default'			=> 'on',
			  //   'show_if' => array(
			  // 	  'use_shortcode'=>'off',
			  //   )
			),


			'show_event_confirmations' => array(
				'label'				=> esc_html__( 'Show User Confirmations', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to display a list of events to which a specific user has confirmed attendance.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
			  //   'computed_affects'   => array(
			  // 	  '__posts',
			  // 	  '__getEvents',
			  //   ),
				'default'			=> 'off',
			  //   'show_if' => array(
			  // 	  'use_shortcode'=>'off',
			  //   )
			),


			'show_event_checkout' => array(
				'label'				=> esc_html__( 'Show The Checkout', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to display the checkout experience.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
			  //   'computed_affects'   => array(
			  // 	  '__posts',
			  // 	  '__getEvents',
			  //   ),
				'default'			=> 'off',
			  //   'show_if' => array(
			  // 	  'use_shortcode'=>'off',
			  //   )
			),

			'show_success_message' => array(
				'label'				=> esc_html__( 'Show Success Message', 'decm-divi-event-calendar-module' ),
				'type'				=> 'yes_no_button',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the success message after successful checkout.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
			  //   'computed_affects'   => array(
			  // 	  '__posts',
			  // 	  '__getEvents',
			  //   ),
				'default'			=> 'off',
			  //   'show_if' => array(
			  // 	  'use_shortcode'=>'off',
			  //   )
			),


			'show_attendees' => array(
				'label'				=> esc_html__( 'Show Attendees', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show a list of all confirmed event attendees.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
			  //   'computed_affects'   => array(
			  // 	  '__posts',
			  // 	  '__getEvents',
			  //   ),
				'default'			=> 'on',
			  //   'show_if' => array(
			  // 	  'use_shortcode'=>'off',
			  //   )
			),

			 

			'show_protected_content' => array(
				'label'				=> esc_html__( 'Show Protected Content', 'decm-divi-event-calendar-module' ),
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show protected content only to registered event attendees.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
			  //   'computed_affects'   => array(
			  // 	  '__posts',
			  // 	  '__getEvents',
			  //   ),
				'default'			=> 'on',
			  //   'show_if' => array(
			  // 	  'use_shortcode'=>'off',
			  //   )
			),

			'show_attendee_registration' => array(
				'label'				=> esc_html__( 'Show Attendee Registration', 'decm-divi-event-calendar-module' ),
		
				'type'				=> 'hidden',
				'option_category'	=> 'configuration',
				'options'			 => array(
					'off' => esc_html__( 'No', 'decm-divi-event-calendar-module' ),
					'on'  => esc_html__( 'Yes', 'decm-divi-event-calendar-module' ),
				),
				'description'		=> esc_html__( 'Choose to show the attendee registration.', 'decm-divi-event-calendar-module' ),
				'toggle_slug'		=> 'elements',
			  //   'computed_affects'   => array(
			  // 	  '__posts',
			  // 	  '__getEvents',
			  //   ),
				'default'			=> 'on',
			  //   'show_if' => array(
			  // 	  'use_shortcode'=>'off',
			  //   )
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
			  '__getEvents'          => array(
				  'type'              => 'computed',
				  'computed_callback' => array( 'DCET_EventTicket', 'get_blog_posts_events' ),
				  'computed_depends_on'  => array(
                     '',					  
  
				  ),
			  ),

		  );
	  }
	

	  public function render( $attrs, $content, $render_slug ) {

		if ( !function_exists( 'tribe_get_events' ) ) {
			return 'Divi Events Calendar requires The Events Calendar to be installed and active.';
		}
		//   echo '<pre>';
		//   print_r($this->props);
		//   exit;
		  $atts = array();
		  $use_shortcode = $this->props['use_shortcode'];
		  $shortcode_param = $this->props['shortcode_param'];
	      $tec_show_event_tickets = $this->props['show_event_tickets'];
		  $tec_show_event_rsvp = $this->props['show_event_rsvp'];
		  $tec_show_event_checkout = $this->props['show_event_checkout'];
		  $tec_show_success_message = $this->props['show_success_message'];
		  $tec_show_event_confirmations = $this->props['show_event_confirmations'];
		  
		  $attr = (array)null;
		  if ( $use_shortcode === 'on' ) {
			  parse_str(strtr($shortcode_param, ' ', '&'), $attr);
		  } else {
			  		  
	  	    $contentorder = 'event_rsvp, event_tickets, event_checkout, success_message, event_confirmations';
			  
			  $attr = array(
				  'event_tickets' => $tec_show_event_tickets == 'on' ? 'true' : 'false',
				  'event_rsvp' => $tec_show_event_rsvp == 'on' ? 'true' : 'false',
				  'event_checkout' => $tec_show_event_checkout == 'on' ? 'true' : 'false',
				  'success_message'  => $tec_show_success_message == 'on' ? 'true' : 'false',
				  'event_confirmations'  => $tec_show_event_confirmations == 'on' ? 'true' : 'false',
				  'schema' => 'true',
				  'key' => 'End Date',
				  'order' => 'ASC',
				  'orderby' => 'meta_value',
				  'viewall' => 'false',
				  'contentorder' => apply_filters( 'decm_details_order', $contentorder, $atts ),
				  'event_tax' => '',
			  );
		  
	  }
	  
	  wp_enqueue_style('bootstrap_style','https://cdn.jsdelivr.net/gh/peeayecreative/dec-cdn@2.1/css/bootstrap.min.css');//phpcs:ignore WordPress.WP.EnqueuedResourceParameters.MissingVersion
	  
		  return sprintf( '%1$s'
			  	  
			  , $this->decm_events_calender_gets( $attr)
			  , $this->module_id()
			   , $this->module_classname( $render_slug )
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

		  if (! class_exists( 'Tribe__Tickets__Main' ) ) {
			return "";
		}
		  $output = '';
	  
		  $atts = shortcode_atts( apply_filters( 'decm_events_atts', array(
			  'limit' => 5,
			  'event_tickets' => 'true',
			  'event_rsvp' => 'true',
			  'event_checkout' => 'true',
			  'success_message' => 'true',
			  'event_confirmations' => 'true',
			  'schema' => 'true',
			  'message' => 'There are no upcoming %s at this time.',
			  'key' => 'End Date',
			  'order' => 'ASC',
			  'orderby' => 'startdate',
			  'viewall' => 'false',
			  'contentorder' => apply_filters( 'decm_details_order', 'event_rsvp, event_tickets, success_message, event_checkout, event_confirmations', $atts ),
			  'use_current_loop' => 'false',
			  
  
		  ), $atts ), $atts, 'decm-events-atts' );
  
  
		  $atts = apply_filters( 'decm_event_calender_atts', $atts );
		    
  
		  $event_id = get_the_ID();
  
		  $args = apply_filters( 'decm_fetch_events_atts', array(
			  'post_status' => array('publish','draft', 'private'),
			  'posts_per_page' => 1,
			  'start_date'   => '1900-10-01 00:01',
			  'end_date'     => '3030-10-31 23:59',
			  
		  ), $atts );
		  	
  
		  if($post_type == 'tribe_events'){
			  $args['ID'] = $event_id;
		  }


		  $event_posts = tribe_get_events( $args );
		  $event_posts = apply_filters( 'decm_events_posts_fetch', $event_posts, $atts );
  
	// 	  echo "<pre>";
	//    print_r(print_r(tribe_get_event_meta($event_post->ID,'_EventCost',true)));
  
		  if ( $event_posts or apply_filters( 'decm_events_posts', false, $atts ) ) {
				  
			  $output = apply_filters( 'decm_start_events', $output, $event_posts, $atts );
  
					  $cardoverStyle = '';
					  $excerptLength = '';
		  
			  $output .= apply_filters( 'decm_eventss_div', '<div class="row tec-event-tickets-list">', $atts );
			  $atts['contentorder'] = explode( ',', $atts['contentorder'] );

			  foreach( (array) $event_posts as $post_index => $event_post ) {
				  
				  setup_postdata( $event_post->ID );
				  
				  $event_output = '';
				  if ( apply_filters( 'decm_remove_events', false, $atts, $event_post ) )
					  continue;

				  $event_output .= apply_filters( 'decm_events_start_tag', '<div class=""> ', $atts, $post );		  

				  foreach ( apply_filters( 'decm_events_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					  
					  switch ( trim( $contentorder ) ) {
	  
							case 'event_rsvp':
								if ( self::isValid( $atts['event_rsvp'] ) ) {
	
									$event_output .= (new Tribe__Tickets__Tickets_View)->get_rsvp_block( $event_post->ID,$echo = false);
								}
									break;
							case 'event_tickets':
								  if ( self::isValid( $atts['event_tickets'] ) ) {
									   if(tribe_get_cost( $event_post->ID, true )!=null){
									    $event_output.=	(new Tribe__Tickets__Tickets_View)->get_tickets_block( $event_post->ID,$echo = false);
								    }
							    }							  
								        break;
							case 'event_checkout':
									if ( self::isValid( $atts['event_checkout'] ) &&tribe_events_has_tickets( $event_post->ID )==true ) {
										if(tribe_get_event_meta($event_post->ID,'_EventCost',true)!=0 ||tribe_get_event_meta($event_post->ID,'_EventCost',true)!="free"){
										
											$event_output .=    (new TEC\Tickets\Commerce\Shortcodes\Checkout_Shortcode)->get_html();		
										//$event_output .= (new Tribe__Tickets__Ticket_Object)->get_post_meta( $event_post->ID, '_ticket_start_date', true );			 
							     	
									}}		
								     break;
							case 'success_message':
								if ( self::isValid( $atts['success_message'] ) && tec_tickets_commerce_is_enabled()==1 ) {
									if(tribe_events_has_tickets( $event_post->ID )==true)	{		 
										 $event_output .= (new TEC\Tickets\Commerce\Shortcodes\Success_Shortcode)->get_html();
									}
									}
										
								    break;	
							case 'event_confirmations':
								if ( self::isValid( $atts['event_confirmations'] ) &&tribe_events_has_tickets( $event_post->ID )==true ) {
								 $event_output .= (new Tribe__Tickets__Shortcodes__User_Event_Confirmation_List)->generate($event_post->ID);
								}
								  break;
		
						  default:
							  $event_output .= apply_filters( 'decm_events_list_output_custom_' . strtolower( trim( $contentorder ) ), '', $atts, $event_post );
					  }
				  
				  }
				  $event_output .= '</div>';
				  $output .= apply_filters( 'dec_single_event_output', $event_output, $atts, $event_post, $post_index, $event_post );
				  	  
			  }
			  $output .= apply_filters( 'dec_end_tag', '</div>', $atts );

			  
		  } else { //No Events were Found
			if(get_post_status( $event_post->ID)=="private"){}
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

	    $tec_gateways_active_check =  (new TEC\Tickets\Commerce\Shortcodes\Checkout_Shortcode)->get_gateways_active();	
	    $check_event_ticket=!class_exists( 'Tribe__Tickets__Main')?true:false;
		$atts = shortcode_atts( apply_filters( 'decm_events_atts', array(
			'cat' =>"",
			'month' => '',
			'limit' => "",
			'event_tickets' => 'true',
			'event_rsvp' => 'true',
			'event_checkout' => 'true',
			'success_message' => 'true',
			'event_confirmations' => 'true',
			'price' => null,
			'weburl' => null,
			'categories' => 'false',
			'event_tag' =>'false',

			'contentorder' => apply_filters( 'decm_details_order',  'event_rsvp, event_tickets, success_message, event_checkout, event_confirmations', $atts ),
			'event_tax' => '',
			'date_format' => '',
			'time_format' => '',
			
			'header_level' => '',
			'show_data_one_line' => '',
			'show_preposition' => '',
			'render_slug' => '',
			'use_current_loop' => 'false',
			'google_api_key_customize'=>'',
			'add_url'=> $check_event_ticket,
			'gateways_active'=> $tec_gateways_active_check,
			 
		), $atts ), $atts, 'decm-events-atts' );


		$atts = apply_filters( 'decm_event_calender_atts', $atts );
		

		$post_type = get_post_type( $current_page['id'] );
		
		$args = apply_filters( 'decm_fetch_events_atts', array(
			'post_status' => array('publish','draft', 'private'),
			'posts_per_page' => 1,
			'meta_query' => apply_filters( 'dec_get_meta_query', array( $atts['meta_date'] ), $atts ), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

        ), $atts );
		//et_body_layout
		if($atts['use_current_loop'] == "false"){
		if($post_type == 'tribe_events')
		{
			$args['ID'] = $current_page['id'];
		}
	}

		$event_posts = tribe_get_events( $args );
		
		$event_posts = apply_filters( 'decm_events_posts_fetch', $event_posts, $atts );
		

		if ( $event_posts or apply_filters( 'decm_events_posts', false, $atts ) ) {
				
			$output = apply_filters( 'decm_start_events', $output, $event_posts, $atts );
	  
			$atts['posts'] = array();
			$atts['contentorder'] = explode( ',', $atts['contentorder'] );

			$index = 0;
			foreach( (array) $event_posts as $post_index => $event_post ) {
				setup_postdata( $event_post->ID );
				++$index;
				$event_output = '';

				if ( apply_filters( 'decm_remove_events', false, $atts, $event_post ) )
					continue;

				$featured_class = ( get_post_meta( $event_post->ID, '_tribe_featured', true ) ? ' ecs-featured-event' : '' );
				
				$atts['posts'][$index]['featured_class'] = $featured_class;
			
			
				foreach ( apply_filters( 'decm_events_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {
					switch ( trim( $contentorder ) ) {
						case 'event_rsvp':
						//	$event_shortcode =  (new TEC\Tickets\Commerce\Shortcodes\Checkout_Shortcode)->get_html();
							 $atts['posts'][$index]['eventRsvp']= ""; // $event_shortcode;
						break;
						case 'event_tickets':		
							$atts['posts'][$index]['eventTickets']= (new Tribe__Tickets__Tickets_View)->get_tickets_block( $event_post->ID,$echo = false);
						break;
					
						case 'success_message':
							// if (  function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
							// 	$atts['posts'][$index]['venue'] =tribe_get_venue($event_post->ID);
							// }
							break;
						case 'event_checkout':		
							// $tec_gateways_active =  (new TEC\Tickets\Commerce\Shortcodes\Checkout_Shortcode)->get_gateways_active();	
							// $atts['posts'][$index]['gateways_active'] = $tec_gateways_active;
							break;
						case 'event_confirmations':		
									//	$atts['posts'][$index]['weburl' ]=" ".tribe_get_event_website_link($event_post);
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

}

new DCET_EventTicket;
