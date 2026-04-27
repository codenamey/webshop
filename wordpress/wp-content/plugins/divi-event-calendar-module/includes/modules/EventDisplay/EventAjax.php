<?php
  // Exit if accessed directly
  if ( !defined( 'ABSPATH' ) ) exit;

  function event_attr_isValid( $prop )
  {
    return ( $prop !== 'false' );
  }

  function event_attr_get_excerpt( $post_id,$limit, $source = null )
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
    function event_attr_get_content( $post_id,$limit, $source = null )
    {

      $excerpt = preg_replace('/\[\/?et_pb.*?\]/', '',get_the_content( $more_link_text = null,$strip_teaser = false, $post_id));
      
    //	$excerpt =tribe_get_the_content( $more_link_text = null,$strip_teaser = false, $post_id );
      if( $source == "content" ) {
        
        tribe_get_the_content($more_link_text = null,$strip_teaser = false,$post_id);
      }

      if ( strlen( $excerpt ) > $limit ) {
        $excerpt = substr( $excerpt, 0, $limit );
        $excerpt .= '...';
      }
      
      return $excerpt;
      
    }
  // function test(){
  //   echo 'test';
  // }



  function decm_dateRange($begin, $end, $interval = null)
  {
      $begin = new DateTime($begin);
      $end = new DateTime($end);
      // Because DatePeriod does not include the last date specified.
      $end = $end->modify('+1 day');
      $interval = new DateInterval($interval ? $interval : 'P1D');

      return iterator_to_array(new DatePeriod($begin, $interval, $end));
  }



  function decm_dateFilter(array $daysOfTheWeek)
  {
      return function ($date) use ($daysOfTheWeek) {
          return in_array($date->format('l'), $daysOfTheWeek);
      };
  }

  function decm_years_Filter(array $years)
  {
      return function ($date) use ($years) {
          return in_array($date->format('Y'), $years);
      };
  }

  function decm_months_Filter(array $months)
  {
      return function ($date) use ($months) {
          return in_array($date->format('m'), $months);
      };
  }


  function decm_timeFilter($start_time, $end_time, $time) {

  $start_range_time = strtotime($start_time);

  //  print_r($time);

      if(in_array("morning", $time)){ 
        if($start_range_time  >= strtotime('6:00 am') && strtotime('11:59 am') >= $start_range_time ){      
      //  echo 'test value';
          return 'morning';
        }  
      }else if(in_array("afternoon", $time)){
        if($start_range_time  >= strtotime('12:00 pm') && strtotime('4:59 pm') >= $start_range_time ){
          return 'afternoon';
        }  
      }else if(in_array("evening", $time)){
        if($start_range_time  >= strtotime('5:00 pm') && strtotime('8:59 pm') >= $start_range_time ){
          return 'evening';
        } 
      }else if(in_array("night", $time)){
        if(($start_range_time  >= strtotime('9:00 pm') && strtotime('11:59 pm')  >= $start_range_time) ||
          ($start_range_time  >= strtotime('12:00 am') && strtotime('5:59 am') >= $start_range_time) 
        ){
          return 'night';
        } 
      }else{
          return 'allDays';
    }

  }

  //function display($date) { echo $date->format("Y-m-d H:i")."<br>"; }


  function eventfeed_ajax_fetch_events( $atts, $eventfeed_current_pagination_page, $current_page, $categId,$categslug,$venue_page_id, $event_id_realted , $organizer_page_id,$term_id_tag, $term_id, $filter_category, $filter_organizer, $filter_tag ,$filter_venue, $filter_search, $filter_time,$filter_day,$filter_month,$filter_year,$maxCost,$minCost,$event_startDate,$event_endDate, $event_filter_country,
  $event_filter_city,$event_filter_state, $event_filter_address,$event_filter_order,$event_filter_status,$module_class_check,$event_filter_recurring,$search_search_criteria,$event_filter_future_past) {
    global $paged, $post, $wp_query, $et_fb_processing_shortcode_object, $et_pb_rendering_column_content,$wpdb;
    $post_type = get_post_type();
    $query_args['paged'] = $paged;
    $organizer_page_id=tribe_get_organizer_id(get_the_ID());

  /**
   * Check if events calendar plugin method exists
   */
  if ( !function_exists( 'tribe_get_events' ) ) {
    return '\'The Events Calendar\' plugin should exist';
  }

  $output = '';

  $custom_icon='';
  $custom_icon_load='';
  $hover_icon='';
  $atts = shortcode_atts( apply_filters( 'decm_events_atts', array(
    'show_data_one_line'=> 'false',
    'cat' => '',
    'month' => '',
    'limit' => 6,
    'website_link'=> "",
    'hide_comma_cat' => '',
    'category_detail_label' => '',
    'time_detail_label' => '',
    'date_detail_label'=> '',
    'venue_detail_label' => '',
    'location_detail_label' => '',
    'organizer_detail_label' => '',
    'price_detail_label' => '',
    'rsvp_detail_label' => '',
    'tag_detail_label' => '',
    'website_detail_label' => '',
    'tags' => 'false',
    'related_event_checkbox'  => '',
    'hide_comma_tag' => '',
    'enable_tag_links' => "",
    'custom_website_link_target'=>"",
    'whole_event_clickable'=>"",
    'custom_website_link_text'=>"",
    'custom_event_link_target'=>"",
    'custom_organizer_link_target' => '',
    'custom_venue_link_target' => '',
    'custom_tag_link_target' => '',
    'disable_event_title_link'=>"",
    'disable_event_image_link'=>"",
    'disable_event_button_link'=>"",
    'single_event_page_link'=>"",
    'custom_event_link_url'=>'',
    'events_to_load' => 2,
    'show_callout_box' => 'true',
    'button_make_fullwidth'=> '',
    'featured_events' => 'false',
    'show_callout_date' => 'true',
    'show_callout_date_range' => 'true',
    'show_end_time' => 'true',
    'callout_date_format'=>"",
    'show_callout_month' => 'true',
    'show_callout_month_range' => 'true',
    'show_callout_time' => 'true',
    'show_callout_time_range' => 'true',
    'callout_month_format'=>"",		
    'callout_time_format'=>"",
    'show_callout_year' => 'true',
    'show_callout_year_range' => 'true',
    'enable_category_links' => 'true',
    'enable_organizer_link'=>'true',
    'enable_venue_link'=>'true',
    'callout_year_format'=>"",	
    'show_callout_day_of_week' => 'true', 
    'show_callout_day_of_week_range' => 'true', 
    'callout_week_format'=>"",
    'show_recurring_events'=> '',
    'show_postponed_canceled_event'=>'',
    'show_virtual_hybrid_event'=>'',
    'show_hybrid_event'=>'',
    'show_end_date' => '',
    'show_virtual_event'=>'',
    'stack_label_icon'=>'true',
    'show_colon'=>'true',
    'eventdetails' => 'true',
    'showtime' => 'true',
    'show_timezone' => 'true',
    'show_timezone_abb' => 'true',
    'showtitle' => 'true',
    'show_pagination'=>'true',
    'show_ical_export'=>'true',
    'show_google_calendar'=>'true',
    'time' => null,
    'past' => '',
    'venue' => 'false',
    'enable_series_link'=>'true',
    'custom_series_link_target' => '',
    'event_series_name'=>'true',
    'event_series_label'=>'true',
    'location' => 'false',
    'location_street_address' => 'true',
    'location_locality' => 'true',
    'show_location_state'=>'true',
    'location_postal_code' => 'true',
    'location_country' => 'true',
    'location_street_comma' => 'true',
    'location_locality_comma' => 'trur',
    'show_location_state_comma'=>'true',
    'location_postal_code_comma' => 'true',
    'location_country_comma' => 'true',
    'show_postal_code_before_locality'=>'true',
    'organizer' => null,
    'price' => null,
    'show_rsvp_feed' => null,
    'show_rsvp_feed_respond' => '',
    'show_ticket_feed_respond' => '',
    'show_ticket_feed_left' => '',
    'show_rsvp_feed_left' => '',
    'weburl' => null,
    'categories' => 'false',
    'price_ticket_label' => '',
    'show_price_ticket'  => '',
    'schema' => 'true',
    'message' => 'There are no upcoming %s at this time.',
    'key' => 'End Date',
    'order' => 'ASC',
    'orderby' => 'startdate',
    'viewall' => 'false',
    'excerpt' => 'false',
    'excerpt_content'=>'',
    'showdetail' => 'false',
    'thumb' => 'false',
    'thumbsize' => '',
    'thumbwidth' => '800',
    'thumbheight' => '800',
    'contentorder' => apply_filters( 'decm_details_order', ' thumbnail,title, title2, event_series_name, date, venue, location, organizer, price, show_rsvp_feed, show_price_ticket, categories, tags, excerpt,weburl, showdetail', $atts ),
    'event_tax' => '',
    'dateformat' => '',
    'start_date_format'=>'',
    'timeformat' => '',
    'layout' => '',
    'columns' => '',
    'list_columns' => '',
    'list_layout' => '',
    'cover_columns' => '',
    'cards_spacing' => '',
    'blog_offset' => '',
    'button_align' => '',
    'image_align' => '',
    'event_inner_spacing' => '',
    'view_more_text' => 'View More',
    'open_toggle_background_color'=>'',
    'details_link_color'=>'',
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
    'included_organizer'=>'',
    'included_organizer_check'=>'',
    'included_venue'=>'',
    'included_venue_check'=>'',
    'included_series'=>'',
    'included_series_check'=>'',
    'show_preposition'=>'false',
    'event_selection'=>'',
    'use_current_loop' => 'false',
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
    //'custom_view_more' => '',
    'custom_ajax_load_more_button'=>'',
    'ajax_load_more_text'=>'Load More',
    'google_calendar_text'=>"Google Calendar",
    'ical_text' =>"+ Ical Export",
    'pagination_type'=> '',
    'align'     => '',
    'show_icon_label'=>'',
    'show_callout_date'=>'',
    'event_past_future_cut_off'=>'',
    'cutoff_ongoing_events'=>'',
    'cut_off_end_date'=>'',
    'date_selection_type'=>'',
    'event_by_reletive_date'=>'',
    'included_date_range_start'=>'',
    'included_date_range_end'=>'',
    'shorten_multidate'=>'',
    'show_event_month_heading'=>'true',
    'overlay_class'=>'',
    'getPostID' =>'',
  ), $atts ), $atts, 'decm-events-atts' );


  // foreeach loop test .... start

  // print_r($search_search_criteria);
  $event_fount = array();

  if($filter_day != "" || $filter_year != "" ||  $filter_month != "" || $filter_time != ""){

  $event_posts =  tribe_get_events( [
    'posts_per_page' => -1,
  ] );

  $event_not_found = true;


  foreach( (array) $event_posts as $post_index => $event_post ) {
    setup_postdata( $event_post->ID );

  //   $custom_duration_meta_key = get_post_meta($event_post->ID, '_EventDuration',true);

    $events_custom_start_time   = tribe_get_start_time($event_post->ID);
    $events_custom_end_time   = tribe_get_end_time($event_post->ID);

    $filter_months_array = explode(',', $filter_time);

    $custom_time_range = decm_timeFilter($events_custom_start_time,$events_custom_end_time, $filter_months_array);

  // echo $custom_time_range;

    $events_custom_start  =  tribe_get_start_date( $event_post->ID,null, 'Y-m-d');
    $events_custom_end  = tribe_get_end_date( $event_post->ID,null, 'Y-m-d');

    $decm_dates = decm_dateRange($events_custom_start, $events_custom_end);

    $filter_day_array = explode(',', $filter_day);

    $filter_years_array = explode(',', $filter_year);

    $filter_months_array = explode(',', $filter_month);

    $date_custom_range  = array_filter($decm_dates, decm_dateFilter($filter_day_array));

    $date_custom_year  = array_filter($decm_dates, decm_years_Filter($filter_years_array));

    $decm_months_Filter  = array_filter($decm_dates, decm_months_Filter($filter_months_array));

    
    $foundDates = array_reduce($date_custom_range, function ($carry, $date) {
      $carry = $date->format('Y-m-d');
      return $carry;
    }, []);

    $foundyears = array_reduce($date_custom_year, function ($carry, $date) {
      $carry = $date->format('Y');
      return $carry;
    }, []);

    $foundMonths = array_reduce($decm_months_Filter, function ($carry, $date) {
      $carry = $date->format('m');
      return $carry;
    }, []);

  if(!empty($foundDates) || $filter_day == ""){

    if(!empty($foundyears) || $filter_year == ""){
    
    if(!empty($foundMonths) || $filter_month == ""){
    
    if(!empty($custom_time_range) || $filter_time == ""){
    
    
        $event_not_found = false;

        $event_fount[] = $event_post->ID; 

    }
    }
    }
    }
  }

  }

      // echo '<pre>';
      // print_r($event_fount); 
      // // echo '<pre>'; 

  // Past Event
  $meta_date_compare = '>=';
  $meta_date_date = current_time( 'Y-m-d H:i:s' );


  if ( $atts['time'] == 'past' || $atts['past'] == 'past_events' ) {
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

  $atts['meta_date'] = "";
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
  if($event_filter_future_past=='Upcoming,Past'){

    $atts['meta_date'] = "";

  }

  if($event_filter_future_past ==  'Upcoming'){

  $atts['meta_date'] = array(

    array(

      'key' => $atts['key'],

      'value' => $meta_date_date,

      'compare' => '>=',

      'type' => 'DATETIME'

    )

  );

  }


  if($event_filter_future_past ==  'Past'){

    $atts['meta_date'] = array(
    
      array(
    
        'key' => $atts['key'],
    
        'value' => $meta_date_date,
    
        'compare' => '<',
    
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


  /**
   * Hide time if $atts['showtime'] is false
   *
   * @author bojana
   *
   */



  $atts = apply_filters( 'decm_event_calender_atts', $atts, $meta_date_date, $meta_date_compare );

  if( $atts['featured_events'] == "ture" || $atts['event_selection'] == 'featured_events'){
    $args['featured'] = "ture";
  }

  //$event_id = get_the_ID();
  //print_r($event_id , "---id");


  $atts['meta_key'] = ""; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key


  if(!empty($minCost) || !empty($maxCost)){

    $atts['meta_key'] = array( //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
      array(
        'key' => '_EventCost',
        'value' => [$minCost, $maxCost],
        'compare' => 'BETWEEN',
        'type'   => 'numeric',
      )
    );

  }

      $meta_query = array();

      $meta_query[]['relation']  = 'AND';

      
    if(!empty($event_filter_city)){
      $meta_query[] = array(
                  'key'     => '_VenueCity',
                  'value' => array($event_filter_city),
                  'compare' => 'IN'
      );

    }

    if(!empty($event_filter_state)){
      $meta_query[] = array(
        'key'     => '_VenueStateProvince',
        'value' => array($event_filter_state),
        'compare' => 'IN'
      
    );

    }

    
    if(!empty($event_filter_country)){
      $meta_query[] = array(
                'key'     => '_VenueCountry',
                'value' => array($event_filter_country),
                'compare' => 'IN'
      );

    }

    // if(!empty($event_filter_address)){
    //   $meta_query[] = array(
    //             'key'     => '_VenueAddress',
    //             'value' => array($event_filter_address),
    //             'compare' => 'IN'
    //   );

    // }


    if(!empty($event_filter_country) || !empty($event_filter_city) || !empty($event_filter_state) ){

      $args = array(
        'numberposts' => -1,
        'post_status' => 'publish', 
        'post_type' => 'tribe_venue',
        'meta_query' => $meta_query,//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
      );

      $venues = get_posts($args);

    // $venues = tribe_get_events($args);

      $venue_ids = wp_list_pluck($venues, 'ID');

      if(empty($venue_ids)){
        $atts['meta_key'] = array(//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
          array(
            'key' => '_EventVenueID',
            'value' => array(0),
            'compare' => 'IN',
          )
      );
    }else{
        $atts['meta_key'] = array(//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
          array(
            'key' => '_EventVenueID',
            'value' => $venue_ids,
            'compare' => 'IN',
          ));
          }
      }


      if(!empty($event_filter_order)){     
        $atts['order'] = $event_filter_order;  
      }

    
      if(!empty($filter_time)){

        if($filter_time == 'allDays'){
          $atts['meta_date'] = array(
            array(
              'key' => '_EventAllDay',
              'value' => 'yes',
              //  'compare' => $meta_date_compare,
              'type' => 'DATETIME'
            )
          );

        }
        
      }

      if($filter_organizer){
        $filter_organizer_arr  = explode(",",$filter_organizer);
      }else{
        $filter_organizer_arr  = "";
      }

      if($filter_venue){
        $filter_venue_arr  = explode(",",$filter_venue);
      }else{
        $filter_venue_arr  = "";
      }

      // $test = array();
      //print_r($venue_id);
      if($event_startDate){
        $event_startDate_start =  $event_startDate." 00:00:00";
        $event_startDate_end =  $event_endDate." 23:59:59";
      }else{
        $event_startDate_start =  $event_startDate;
        $event_startDate_end =  $event_endDate;
      }
    //  print_r($event_filter_status);
    $filter_event_status_filter="";
      if($atts['show_postponed_canceled_event']=='false'){
        $meta_query_status =array('relation' => 'AND',
        
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

      if($event_filter_status=='canceled,postponed'){
        $meta_query_status_filter =array('relation' => 'AND',
        
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

      if($event_filter_status=='canceled'){
        $meta_query_status_filter =   
            array(
              'key' => '_tribe_events_status',
              'value' => 'canceled',
              'compare' => '=',
              'type' => 'Text'
            );
      } 
      if($event_filter_status=='postponed'){
        $meta_query_status_filter =   
            array(
              'key' => '_tribe_events_status',
              'value' => 'postponed',
              'compare' => '=',
              'type' => 'Text'
            );
      } 
      if($event_filter_status=='scheduled'){
        $meta_query_status_filter =   
            array(
              'key' => '_tribe_events_status',
            // 'value' => 'postponed',
            'compare' => 'NOT EXISTS' 
              //'type' => 'Text'
            );
      }
      if($event_filter_status=='scheduled,canceled'){
        $meta_query_status_filter =array('relation' => 'AND',
        
        array(
          'key' => '_tribe_events_status',
          
          'compare' => 'NOT EXISTS',
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
      if($event_filter_status=='scheduled,postponed'){
        $meta_query_status_filter =array('relation' => 'AND',
        
        array(
          'key' => '_tribe_events_status',
          'compare' => 'NOT EXISTS',
          'type' => 'Text'
        ),
    
          array(
            'key' => '_tribe_events_status',
            'value' => 'postponed',
            'compare' => '=',
            'type' => 'Text'
          )
        );
      }
      
      $filter_event_status="";
      if($event_filter_status=='canceled,postponed')
      {       
      $filter_event_status_filter = array(
        'posts_per_page' => -1,
              'post_type' => 'tribe_events',
              'meta_query' =>array($meta_query_status_filter),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
              );
              $filter_event_status_filter = tribe_get_events($filter_event_status_filter);
      
      
              $filter_event_status_filter =$event_filter_status!=""? wp_list_pluck($filter_event_status_filter, 'ID'):"";
            }
            if($event_filter_status=='scheduled,postponed')
            {       
            $filter_event_status_filter = array(
              'posts_per_page' => -1,
                    'post_type' => 'tribe_events',
                    'meta_query' =>array($meta_query_status_filter),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                    );
                    $filter_event_status_filter = tribe_get_events($filter_event_status_filter);
            
            
                    $filter_event_status_filter =$event_filter_status!=""? wp_list_pluck($filter_event_status_filter, 'ID'):"";
                  }
            if($event_filter_status=='scheduled,canceled')
      {       
      $filter_event_status_filter = array(
        'posts_per_page' => -1,
              'post_type' => 'tribe_events',
              'meta_query' =>array($meta_query_status_filter),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
              );
              $filter_event_status_filter = tribe_get_events($filter_event_status_filter);
      
      
              $filter_event_status_filter =$event_filter_status!=""? wp_list_pluck($filter_event_status_filter, 'ID'):"";
            }
            if($event_filter_status=='scheduled')
            {       
            $filter_event_status_filter = array(
              'posts_per_page' => -1,
                    'post_type' => 'tribe_events',
                    'meta_query' =>array($meta_query_status_filter),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                    );
                    $filter_event_status_filter = tribe_get_events($filter_event_status_filter);
            
            
                    $filter_event_status_filter =$event_filter_status!=""? wp_list_pluck($filter_event_status_filter, 'ID'):"";
                  }
                  

            if($event_filter_status=='canceled')
            {       
            $filter_event_status_filter = array(
              'posts_per_page' => -1,
                    'post_type' => 'tribe_events',
                    'meta_query' =>array($meta_query_status_filter),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                    );
                    $filter_event_status_filter = tribe_get_events($filter_event_status_filter);
            
            
                    $filter_event_status_filter =$event_filter_status!=""? wp_list_pluck($filter_event_status_filter, 'ID'):"";
                  }
                  if($event_filter_status=='postponed')
                  {       
                  $filter_event_status_filter = array(
                    'post_per_page'=>-1,
                          'post_type' => 'tribe_events',
                          'meta_query' =>array($meta_query_status_filter),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                          );
                          $filter_event_status_filter = tribe_get_events($filter_event_status_filter);
                  
                  
                          $filter_event_status_filter =$event_filter_status!=""? wp_list_pluck($filter_event_status_filter, 'ID'):"";
                        }

  if($atts['show_postponed_canceled_event']=="false")
  {       
  $filter_event_status = array(
    'posts_per_page' => -1,
          'post_type' => 'tribe_events',
          'meta_query' => array($meta_query_status),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
          );
          $filter_event_status = tribe_get_events($filter_event_status);
      
      
          $filter_event_status =$atts['show_postponed_canceled_event']=='false'? wp_list_pluck($filter_event_status, 'ID'):"";
        }
        
  //echo $atts['show_virtual_hybrid_event'];

        $filter_event_status_filter_virtual="";
      
  //  print_r($event_filter_address);
        if($event_filter_address=='Virtual,Hybrid'){
          $meta_query_status_filter_virtual =array('relation' => 'AND',
          
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
    
        if($event_filter_address=='Virtual'){
          $meta_query_status_filter_virtual =   
              array(
                'key' => '_tribe_virtual_events_type',
                'value' => 'virtual',
                'compare' => '=',
                'type' => 'Text'
              );
        } 
        if($event_filter_address=='Hybrid'){
          $meta_query_status_filter_virtual =   
              array(
                'key' => '_tribe_virtual_events_type',
                'value' => 'hybrid',
                'compare' => '=',
                'type' => 'Text'
              );
        } 
        if($event_filter_address=='Physical'){
          $meta_query_status_filter_virtual =   
              array(
                'key' => '_tribe_virtual_events_type',
              // 'value' => 'postponed',
              'compare' => 'NOT EXISTS' 
                //'type' => 'Text'
              );
        }
        if($event_filter_address=='Physical,Virtual'){
          $meta_query_status_filter_virtual =array('relation' => 'AND',
          
          array(
            'key' => '_tribe_virtual_events_type',
            
            'compare' => 'NOT EXISTS',
            'type' => 'Text'
          ),
      
            array(
              'key' => '_tribe_virtual_events_type',
              'value' => 'virtual',
              'compare' => '=',
              'type' => 'Text'
            )
          );
        }
        if($event_filter_address=='Physical,Hybrid'){
          $meta_query_status_filter_virtual =array('relation' => 'AND',
          
          array(
            'key' => '_tribe_virtual_events_type',
            
            'compare' => 'NOT EXISTS',
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
        
        $filter_event_status_virtual="";
        if($event_filter_address=='Virtual,Hybrid')
        {       
        $filter_event_status_filter_virtual = array(
          'posts_per_page' => -1,
                'post_type' => 'tribe_events',
                'meta_query' =>array($meta_query_status_filter_virtual),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                );
                $filter_event_status_filter_virtual = tribe_get_events($filter_event_status_filter_virtual);
        
        
                $filter_event_status_filter_virtual =$event_filter_address!=""?wp_list_pluck($filter_event_status_filter_virtual, 'ID'):array(0);
              }
              if($event_filter_address=='Physical,Virtual')
              {       
              $filter_event_status_filter_virtual = array(
                'posts_per_page' => -1,
                      'post_type' => 'tribe_events',
                      'meta_query' =>array($meta_query_status_filter_virtual),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                      );
                      $filter_event_status_filter_virtual = tribe_get_events($filter_event_status_filter_virtual);
              
              
                      $filter_event_status_filter_virtual =$event_filter_address!=""?wp_list_pluck($filter_event_status_filter_virtual, 'ID'):array(0);
                    }
              if($event_filter_address=='Physical,Hybrid')
        {       
        $filter_event_status_filter_virtual = array(
          'posts_per_page' => -1,
                'post_type' => 'tribe_events',
                'meta_query' =>array($meta_query_status_filter_virtual),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                );
                $filter_event_status_filter_virtual = tribe_get_events($filter_event_status_filter_virtual);
        
        
                $filter_event_status_filter_virtual =$event_filter_address!=""?wp_list_pluck($filter_event_status_filter_virtual, 'ID'):array(0);
              }
              if($event_filter_address=='Physical')
              {       
              $filter_event_status_filter_virtual = array(
                'posts_per_page' => -1,
                      'post_type' => 'tribe_events',
                      'meta_query' =>array($meta_query_status_filter_virtual),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                      );
                      $filter_event_status_filter_virtual = tribe_get_events($filter_event_status_filter_virtual);
              
              
                      $filter_event_status_filter_virtual =$event_filter_address!=""?wp_list_pluck($filter_event_status_filter_virtual, 'ID'):array(0);
                    }
                    
    
              if($event_filter_address=='Virtual')
              {       
              $filter_event_status_filter_virtual = array(
                'posts_per_page' => -1,
                      'post_type' => 'tribe_events',
                      'meta_query' =>array($meta_query_status_filter_virtual),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                      );
                      $filter_event_status_filter_virtual = tribe_get_events($filter_event_status_filter_virtual);
              
              
                      $filter_event_status_filter_virtual =$event_filter_address!=""?wp_list_pluck($filter_event_status_filter_virtual, 'ID'):array(0);
                    }
                    if($event_filter_address=='Hybrid')
                    {       
                    $filter_event_status_filter_virtual = array(
                      'post_per_page'=>-1,
                            'post_type' => 'tribe_events',
                            'meta_query' =>array($meta_query_status_filter_virtual),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
                            );
                            $filter_event_status_filter_virtual = tribe_get_events($filter_event_status_filter_virtual);
                    
                    
                            $filter_event_status_filter_virtual =$event_filter_address!=""?wp_list_pluck($filter_event_status_filter_virtual, 'ID'):array(0);
                          }

                          if($atts['show_virtual_event']=='false' && $atts['show_hybrid_event']=='false'){
                            $meta_query_status_virtual = array(
                              'relation' => 'AND',
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
    
                      // echo $atts['show_hybrid_event'];
                      // echo  $atts['show_virtual_event'];
    // if($atts['show_virtual_event']=='true' && $atts['show_hybrid_event']=='true')
    // {    
      $filter_event_status_virtual = array(
        'posts_per_page' => -1,
        'post_type' => 'tribe_events',
        'meta_query' => array($meta_query_status_virtual),//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query

      );
      //   echo "<pre>";
      //   print_r( $filter_event_status_virtual);
      //   echo "</pre>";
        $filter_event_status_virtual = tribe_get_events($filter_event_status_virtual);
        $filter_event_status_virtual = ($atts['show_hybrid_event']=='false' || $atts['show_virtual_event']=='false') ?wp_list_pluck($filter_event_status_virtual, 'ID'):array(0);
      
        if(empty($filter_event_status)){
          $filter_event_status = $filter_event_status_virtual;
        }
          $filter_event_status = array_merge($filter_event_status,$filter_event_status_virtual);
  // }

        //  $filter_event_status=array_merge($filter_event_status,$filter_event_status_virtual);

      //print_r($filter_event_status_filter_virtual);
          if(is_single()==true){
          array_push($filter_event_status,get_the_ID());
        } 
        else{
          $filter_event_status=$filter_event_status;
        }

    ///    print_r($filter_event_status_filter,); 
        //  print_r($event_fount);
        // $event_fount=array_merge($event_fount,$filter_event_status);
  if($filter_event_status_filter!=""&&$filter_event_status_filter_virtual=="" ){
  //print_r($filter_event_status_filter_virtual);
      $event_filter_array = array_merge( $filter_event_status_filter,$event_fount);
  }
  elseif($filter_event_status_filter_virtual!=""&&$filter_event_status_filter=="" ){
    //print_r($filter_event_status_filter_virtual);
        $event_filter_array = array_merge( $event_fount,$filter_event_status_filter_virtual);
    }
    elseif($filter_event_status_filter_virtual!=""&&$filter_event_status_filter!="" ){
    // print_r($filter_event_status_filter);
          $event_filter_array = array_merge( $event_fount,$filter_event_status_filter_virtual,$filter_event_status_filter);
      }
      
  else{
    $event_filter_array =$event_fount;
  }
  
  //   $unique_filters  = array_unique($event_filter_array);

  $array_unique = array_unique( array_diff_assoc( $event_filter_array, array_unique( $event_filter_array ) ) );

    // print_r($array_unique); 

      if(!empty($array_unique)){

        $event_filter_mrge =  $array_unique;

      }else{

        $event_filter_mrge = $event_filter_array;
      }

    //  $event_filter_array =  array_merge($filter_event_status_filter, $event_fount);

  // Convert every value to uppercase, and remove duplicate values
  //$withoutDuplicates = array_unique(array_map("strtoupper", $event_filter_array));

  // The difference in the original array, and the $withoutDuplicates array
  // will be the duplicate values
  // $duplicates = array_diff($event_filter_array, $event_fount);

    //  print_r($unique);

    // print_r($unique_filters);  

    
  // print_r($filter_search);

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
    if($atts['date_selection_type'] == "date_range"){
      $check_event_by_date_start=$atts['included_date_range_start'];
      $check_event_by_date_end=$atts['included_date_range_end'];
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
    if($filter_search!=""){

      if($search_search_criteria=='search_title' || $search_search_criteria=='search_content_title'){
    
      $finalArgs =  array (       
    
        'posts_per_page'=> -1,   
    
        'post_status' => 'publish',   
    
        'post_type' => 'tribe_events',                   
    
    );
    
    $searchSchools = new WP_Query( $finalArgs );
    
    
    if($search_search_criteria=='search_content_title'){
    
      $q1 = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '%".$filter_search."%' "); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
    
      $q4 = $wpdb->get_col("select ID from $wpdb->posts where post_excerpt  LIKE  '%".$filter_search."%'"); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching

      $q5 = $wpdb->get_col("select ID from $wpdb->posts where post_content LIKE  '%".$filter_search."%'"); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching

      $VenueGeoAddress_ids = $wpdb->get_col("Select y_posts.ID From $wpdb->posts As y_posts Inner Join $wpdb->postmeta As y_meta On y_posts.ID = y_meta.post_id Where y_posts.post_type = 'tribe_venue' And y_posts.post_status = 'publish' And ( (y_meta.meta_key = '_VenueGeoAddress' And y_meta.meta_value Like '%".$filter_search."%') )"); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching

      $term_ids=array(); 
      $cat_Args="SELECT * FROM $wpdb->terms WHERE name LIKE '%".$filter_search."%' ";
      $cats = $wpdb->get_results($cat_Args, OBJECT);//phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
    
    // array_push($term_ids,$cats->term_id);  
    
        foreach ($cats as  $cat ) {
            $term_ids[] = $cat->term_id; 
        }
    
    
      $q2 = get_posts(array(
        'fields' => 'ids',
        'post_type' => 'tribe_events',
        'post_status' => 'publish',
        'posts_per_page' => -1,
      // 'category' => array($term_ids),
        'tax_query' => array( //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
          array(
              'taxonomy' => 'tribe_events_cat',
              'field'    => 'term_id',
              'terms'    => $term_ids
          )
        )
      )
      
      );
    
    
      $q3 = get_posts(array(
        'fields' => 'ids',
        'post_type' => 'tribe_events',
        'post_status' => 'publish',
        'posts_per_page' => -1,
      // 'category' => array($term_ids),
        'tax_query' => array( //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
          array(
              'taxonomy' => 'post_tag',
              'field'    => 'term_id',
              'terms'    => $term_ids
          )
        )
      )
      
      );



    if(empty($VenueGeoAddress_ids)){
      $key['meta_key'] = array( //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
        array(
          'key' => '_EventVenueID',
          'value' => array(0),
          'compare' => 'IN',
        )
    );
  }else{
      $key['meta_key'] = array(//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
        array(
          'key' => '_EventVenueID',
          'value' => $VenueGeoAddress_ids,
          'compare' => 'IN',
        ));
      }

      if(empty($q1)){
      $key_Organizer['meta_key'] = array(//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
        array(
          'key' => '_EventOrganizerID',
          'value' => array(0),
          'compare' => 'IN',
        ));
      }else{
        $key_Organizer['meta_key'] = array(//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key
          array(
            'key' => '_EventOrganizerID',
            'value' => $q1,
            'compare' => 'IN',
          ));
        }

        $args_org = array(
          'post_per_page'=> -1,
          'post_type' => 'tribe_events',//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
          'meta_query' => $key_Organizer,  //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
        );
      
        $org_id = get_posts($args_org);
      
        $org_ids = wp_list_pluck($org_id, 'ID');
      

    $args = array(
      'post_per_page'=> -1,
      'post_type' => 'tribe_events',//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
      'meta_query' => $key,//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key ,WordPress.DB.SlowDBQuery.slow_db_query_meta_query
    );

    $venues_location = get_posts($args);


    $location_ids = wp_list_pluck($venues_location, 'ID');
    

    $mypostids = array_unique( array_merge( $q1, $q2, $q3, $q4, $q5, $location_ids, $org_ids) );
      
    
    
    }else{
    
      $mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '%".$filter_search."%' "); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery,WordPress.DB.DirectDatabaseQuery.NoCaching
      
    }
    
    //  $mypostids = $wpdb->get_col(" SELECT ID FROM `wp_postmeta` WHERE `wp_postmeta`.`meta_value` LIKE '%".$filter_search."%'");
    
      
    
      $mypostids=$mypostids==array()?array('00900'):$mypostids;
    
      if($mypostids==array()|| $event_filter_mrge==array()){
    
        $event_filter_mrge=array_merge($event_filter_mrge,$mypostids);
    
      }
    
      if($mypostids!=array()&& $event_filter_mrge!=array()){
    
        $event_filter_mrge=array_intersect($event_filter_mrge,$mypostids);
    
      }
    
      if($mypostids==array('00900')&& $event_filter_mrge!=array()){
    
        $event_filter_mrge=array_intersect($event_filter_mrge,$mypostids);
    
      }
    
    
      //if($mypostids){
    
        if($event_filter_mrge)
    
      $event_filter_mrge=array_merge($event_filter_mrge,$mypostids);
    
      }
    
      }else{
    
        $event_filter_mrge=$event_filter_mrge;
    
      }
  // }
  // else{
  //   $event_filter_mrge=$event_filter_mrge;
  // }
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
    $decm_series_update = $wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$atts['included_series']).") ");  //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared , WordPress.DB.PreparedSQL.InterpolatedNotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
    $decm_series_update=array_column($decm_series_update, 'event_post_id');
    $event_filter_mrge=array_merge($decm_series_update,$event_filter_mrge);
  }
  }
  else{$event_filter_mrge=$event_filter_mrge;}
  if($atts['pagination_type'] == "load_more" ){
    $args = apply_filters( 'decm_fetch_events_atts', array(
      'post_status' => 'publish',  
      'start_date'=> $check_event_by_date_start,
      'end_date'=> $check_event_by_date_end,
      // 'start_date'   =>   $event_startDate_start,
      // 'end_date'     =>    $event_startDate_end,
      'post__in'            => array_unique($event_filter_mrge),
      // 'post__not_in'		=> $atts['show_postponed_canceled_event']=='false'?$filter_event_status:"",
      'post__not_in'		=> $atts['show_postponed_canceled_event']=='false'?$filter_event_status:($atts['show_hybrid_event']=='false' && $atts['show_virtual_event']=='false'?$filter_event_status:$filter_event_status),//phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
      // 's' => $filter_search,
      //'title'=>$mypostids,
      'organizer'=> $filter_organizer_arr,
      'venue'=> $filter_venue_arr,
      'tag'  => $atts['included_tags'],
      //'tag' => $filter_tag,   
      //  // 'inclusive' => 'true',
      // ),
    //'orderby'=> 'month', 
      'tax_query'=> $atts['event_tax'], //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
      'order' => $atts['order'],
    // 'offset' => ( ($current_page * $atts['events_to_load']) + $atts['limit']- $atts['events_to_load']) + $atts['blog_offset'],
      'included_categories' => $atts['included_categories'],
    'hide_subsequent_recurrences'=> $atts['show_recurring_events']=="on"? false: true,
      //'featured' => "ture",
    // 'date_query' =>  $date_query,
      'meta_query' => apply_filters( 'dec_get_meta_query', array( $atts['meta_date'] , $atts['meta_key']), $atts, $meta_date_date, $meta_date_compare ), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
  ), $atts, $meta_date_date, $meta_date_compare );

  }else{
    $args = apply_filters( 'decm_fetch_events_atts', array(
      'post_status' => 'publish',
      'start_date'=> $check_event_by_date_start,
      'end_date'=> $check_event_by_date_end,
      'post__in'            => array_unique($event_filter_mrge),
      // 's' => $filter_search,
      //'title'=>$mypostids,
      'organizer'=> $filter_organizer_arr,
      'venue'=> $filter_venue_arr,
      'tax_query'=> $atts['event_tax'], //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
      'order' => $atts['order'],
    // 'post__not_in'		=> $atts['show_postponed_canceled_event']=='false'?$filter_event_status:"",
      'post__not_in'		=>$atts['show_postponed_canceled_event']=='false'?$filter_event_status:($atts['show_hybrid_event']=='false' && $atts['show_virtual_event']=='false'?$filter_event_status:$filter_event_status), //phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in
    // 'offset' => ( ( $eventfeed_current_pagination_page * $atts['limit']) - $atts['limit']) + $atts['blog_offset'],
      'included_categories' => $atts['included_categories'],
      'tag'  => $atts['included_tags'],
      'hide_subsequent_recurrences'=> $atts['show_recurring_events']=="on"? false: true,
    // 'date_query' =>  $date_query,
      'meta_query' => apply_filters( 'dec_get_meta_query', array( $atts['meta_date'] , $atts['meta_key']), $atts, $meta_date_date, $meta_date_compare ), //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
    ), $atts, $meta_date_date, $meta_date_compare );

  }
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
  if(!empty($event_startDate_start) && !empty($event_startDate_end)){
    $args['start_date'] = $event_startDate_start;
    $args['end_date'] = $event_startDate_end;
  }
  if(!empty($event_filter_recurring)){
    $args['hide_subsequent_recurrences'] = $event_filter_recurring=="false"? false: true;
  }
  if($atts['event_selection']=="custom_event"&& $atts['included_organizer_check']!="")
  {$args['organizer']=$atts['included_organizer'];
  }
  if($atts['event_selection']=="custom_event" && $atts['included_venue_check']!=""){$args['venue']=$atts['included_venue'];}
  // if($filter_tag){
  //   $args['tag'] = $filter_tag;
  // }

  // $args['venue'] = $filter_tag;
  // 'venue'=> 132,

  if($atts['pagination_type'] == "paged" && $module_class_check == "filters-event-module"){
    $args['posts_per_page'] = $atts['limit'];
  }else if($atts['pagination_type'] == "load_more" && $module_class_check == "filters-event-module"){
    $args['posts_per_page'] = $atts['limit'];
  }else if($atts['pagination_type'] == "load_more" && $atts['events_to_load'] != ""){
    $args['posts_per_page'] = $atts['events_to_load'];
    $args['offset'] = ( ($current_page * $atts['events_to_load']) + $atts['limit'] - $atts['events_to_load']) + $atts['blog_offset'];
  }else if($atts['pagination_type'] == "numeric_pagination" && $module_class_check == "filters-event-module"){
    $args['posts_per_page'] = $atts['limit'];
  //  $args['offset'] = (( $eventfeed_current_pagination_page * $atts['limit']) + $atts['blog_offset']); 
  }else if($atts['pagination_type'] == "numeric_pagination"){
    $args['posts_per_page'] = $atts['limit'];
    $args['offset'] = ( ( $eventfeed_current_pagination_page * $atts['limit']) - $atts['limit']) + $atts['blog_offset']; 
  }else{
    $args['posts_per_page'] = $atts['limit'];
    $args['offset'] = (( $current_page * $atts['limit']) + $atts['blog_offset']); 
  // echo 'test';
  }
  
  // if($module_class_check != "filters-event-module")

  if($atts['featured_events'] == 'true' | $atts['event_selection'] == 'featured_events'){
    $args['featured'] = "true";
  }

  // if($filter_tag){
  //   $filter_tag_arr = explode(",",$filter_tag);
  // }else{
  //   $filter_tag_arr = "";
  // }


  if ( $atts['cat'] ) {
    if ( strpos( $atts['cat'], "," ) !== false ) {
      $atts['cats'] = explode( ",", $atts['cat'] );
      $atts['cats'] = array_map( 'trim', $atts['cats'] );
    } else {
      $atts['cats'] = array( trim( $atts['cat'] ) );
    }

    if($atts['event_selection'] == 'custom_event'){
      $atts['event_tax'] = array(
        'relation' => 'OR',
      );
    }else{ $atts['event_tax'] = array(
      'relation' => 'AND',
    );
  }
   

    foreach ( $atts['cats'] as $cat ) {
      $atts['event_tax'][] = array(
                      'taxonomy' => 'tribe_events_cat',
                      'field' => 'term_id',
                      'terms' => $cat,
                  );
        
    }
    $args['tax_query'] = $atts['event_tax'];//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
  }

  if($filter_tag){
    // echo "filter tag run ...";
    if($atts['cat']){
  
    }else{
      unset($atts['event_tax']);
    }
  
    $atts['event_tax'] = array(
      'relation' => 'AND',
    );
    
    $atts['event_tax'][] = array(
      'taxonomy' => 'post_tag',
      'field' => 'term_id',
      'terms' => explode(",",$filter_tag),
    ); 
    $args['tax_query'] = $atts['event_tax'];//phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
  }
  
  if($filter_category){
    // echo "category  run ...";
    if(empty($filter_tag)){
    unset($atts['event_tax']);
    }
    
      $atts['event_tax'][] = array(
        'taxonomy' => 'tribe_events_cat',
        'field' => 'term_id',
        'terms' => explode(",",$filter_category),
      ); 
      $args['tax_query'] = $atts['event_tax']; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
  }

  //$event_posts = tribe_get_events( $post_venue );

  // exit;
  // $the_query = new WP_Query( $post_venue );

  // print_r($event_posts );

  // if($filter_category){

  //   $args['tag'] = "Organizers";

  // }

  //print_r($args);

  //echo $atts['use_current_loop'];
  // if($atts['event_past_future_cut_off']=='cut_start_date'){
  //   if(!empty($atts['cut_off_start_date'])){
  //     $args['start_date'] = $atts['cut_off_start_date'];
  //     $args['end_date'] = "";
  //   }
  //   }
  //   if($atts['event_past_future_cut_off']=='cut_end_date'){
  //   if(!empty($atts['cut_off_end_date'])){
  //     $args['start_date'] = gmdate('d-m-y h:i:s');
  //     $args['end_date'] = $atts['cut_off_end_date'];
  //   }
  //   }

  if($atts['related_event_checkbox'] == 'related_event_by_series'){

    $series_id = $atts['getPostID'];

 // if( function_exists("tec_event_series") && !empty(tec_event_series(  $series_id ))) {
    
  //  $decm_series_update_id = tec_event_series($series_id)->ID;
    $atts['included_series'] = array($series_id);
    
    global $wpdb;
    $decm_series_args =  array (       
      'posts_per_page'=>-1,   
      'post_status' => 'publish',   
      'post_type' => 'tribe_event_series',                   
    );
    $decm_series_events_table = (new TEC\Events_Pro\Custom_Tables\V1\Tables\Series_Relationships)->table_name( true );
    $decm_series_update = new WP_Query( $decm_series_args );
    $decm_check_query_sizeof = count($atts['included_series'])=="1"?"LIKE":"IN";
    $decm_series_update = $wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$atts['included_series']).")"); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared ,  WordPress.DB.PreparedSQL.InterpolatedNotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
    $decm_series_update=array_column($decm_series_update, 'event_post_id');

    $args['post__in'] = $decm_series_update;

  // }else{
  //   $args['post__in'] = array(0);
  // }

  }elseif($atts['event_selection'] == 'use_current_loop_series'){
          
    $atts['included_series'] = array($atts['getPostID']);

    if(function_exists('tribe_is_event_series')){
      
      global $wpdb;
      $decm_series_args =  array (       
        'posts_per_page'=>-1,   
        'post_status' => 'publish',   
        'post_type' => 'tribe_event_series',                   
      );
      $decm_series_events_table = (new TEC\Events_Pro\Custom_Tables\V1\Tables\Series_Relationships)->table_name( true );
      $decm_series_update = new WP_Query( $decm_series_args );//phpcs:ignore WordPress.DB.PreparedSQL.InterpolatedNotPrepared
      $decm_check_query_sizeof = count($atts['included_series'])=="1"?"LIKE":"IN";
      $decm_series_update = $wpdb->get_results("select event_post_id from $decm_series_events_table where series_post_id ".$decm_check_query_sizeof." (".implode(",",$atts['included_series']).")"); //phpcs:ignore WordPress.DB.PreparedSQL.NotPrepared , WordPress.DB.PreparedSQL.InterpolatedNotPrepared ,WordPress.DB.DirectDatabaseQuery.DirectQuery ,WordPress.DB.DirectDatabaseQuery.NoCaching
      $decm_series_update=array_column($decm_series_update, 'event_post_id');

      $args['post__in'] = $decm_series_update;
    }

    
  }


  if($atts['event_selection'] == "use_current_loop" || $atts["event_selection"]=="related_event"){	

  if($post_type == 'tribe_events'){
  // $args['ID'] = $event_id;
  }
      if (!isset($atts['event_tax']) || !is_array($atts['event_tax'])) {
          $atts['event_tax'] = array();
      }

  //print_r($event_id , "--passed by the file");
  $term_id = json_decode($term_id);
  $term_id_tag = json_decode($term_id_tag);
  //if($categslug==""){
  if($categslug && $atts['event_selection'] == "use_current_loop"){
          unset( $args['tax_query'] );
          $atts['event_tax'][] = array(
            'taxonomy' => 'tribe_events_cat',
            'field' => 'term_id',
            'terms' => $categId,
          );
  
          $args['tax_query'] = $atts['event_tax']; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
        }
        else if($term_id && $atts['related_event_checkbox'] === 'same_cate'){
              unset($atts['event_tax']);
              $atts['event_tax'][] = array(
                'taxonomy' => 'tribe_events_cat',
                'field' => 'term_id',
                'terms' => $term_id,
              );
              $args['tax_query'] = $atts['event_tax']; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
    }else if ($venue_page_id && $atts['event_selection'] == "use_current_loop") {
      unset( $args['tax_query'] );
      $args['meta_query'] = array( $atts['meta_date'],$atts['meta_key'],[ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
        'relation' => 'AND',
        [
          'key' => '_EventVenueID',
          'value' => $venue_page_id,
          'compare' => '=',
        ]
        ]); 
      }elseif($atts['related_event_checkbox'] === 'same_venue'){
      unset( $args['tax_query'] );
      $args['meta_query'] = array( $atts['meta_date'],$atts['meta_key'],[ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
        'relation' => 'AND',
        [
          'key' => '_EventVenueID',
          'value' => $venue_page_id,
          'compare' => '=',
        ]
        ]); 
    }
      if ( $organizer_page_id && $atts['event_selection'] == "use_current_loop") {
        unset( $args['tax_query'] );
      $args['meta_query'] = array( $atts['meta_date'],$atts['meta_key'],[ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
        'relation' => 'AND',
        [
        'key' => '_EventOrganizerID',
        'value' => $organizer_page_id,
        'compare' => '=',
        ]
      ]); 
      }elseif($atts['related_event_checkbox'] === 'same_org'){
      unset( $args['tax_query'] );
      $args['meta_query'] = array( $atts['meta_date'],$atts['meta_key'],[ //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_query
        'relation' => 'AND',
        [
        'key' => '_EventOrganizerID',
        'value' => $organizer_page_id,
        'compare' => '=',
        ]
      ]); 
    }else if($term_id_tag && $atts['related_event_checkbox'] === 'same_tag'){
        unset( $args['tax_query'] );
        $atts['event_tax'][] = array(
            'taxonomy' => 'post_tag',
            'field' => 'term_id',
            'terms' => $term_id_tag,
        );
        $args['tax_query'] = $atts['event_tax']; //phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_tax_query
    }
    }
  // if($categslug){
  //   $args['included_categories'] = $categslug;
  //   unset($atts['event_tax']);
  //   $atts['event_tax'][] = array(
  //     'taxonomy' => 'tribe_events_cat',
  //     'field' => 'term_id',
  //     'terms' => $categId,
  //   );

  //   $args['tax_query'] = $atts['event_tax'];
  // }
  // else if($term_id){
  //       unset($atts['event_tax']);
  //       $atts['event_tax'][] = array(
  //         'taxonomy' => 'tribe_events_cat',
  //         'field' => 'term_id',
  //         'terms' => $term_id,
  //       );
  //       $args['tax_query'] = $atts['event_tax'];	
  //     }
  // }
  // if($atts['included_categories']){

    
  //   // $args['included_categories'] = $categslug;
  //   //unset($atts['event_tax']);
  //   $atts['event_tax'][] = array(
  //     'taxonomy' => 'tribe_events_cat',
  //     'field' => 'term_id',
  //     'terms' => $atts['included_categories'],
  //   );

  //   // $atts['event_tax'] = array(
  //   //   'relation' => 'AND',
  //   // );

  //   $args['tax_query'] = $atts['event_tax'];
  // }

  //    echo "<pre>";
  //      print_r($args);
  //    echo "</pre>";

  $args['post__not_in'] = array($event_id_realted);//phpcs:ignore WordPressVIPMinimum.Performance.WPQueryParams.PostNotIn_post__not_in


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
      
    $output =
    
    apply_filters( 'decm_start_events', $output, $event_posts, $atts );

        $cardoverStyle = '';
        $excerptLength = '';

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

        // $columns_device = array('columns','columns_tablet','columns_phone');
        // $columns_desktop = 'col-lg-4';
        // $columns_tablet = 'col-md-12';
        // $columns_phone = 'col-sm-12';
        // foreach ($columns_device as $device){
        //   $columns_class = false;
        //   if (strpos($device, '_phone')){
        //     $breakpoint = 'sm';
        //   }else if (strpos($device, '_table')){
        //     $breakpoint = 'md';
        //   }else{
        //     $breakpoint = 'lg';
        //   }
        //   if ($atts[$device]){
        //     switch ($atts[$device]){
        //       case 1:
        //         $columns_class = "col-{$breakpoint}-12";
        //         break;
        //       case 2:
        //         $columns_class = "col-{$breakpoint}-6";
        //         break;
        //       case 3:
        //         $columns_class = "col-{$breakpoint}-4";
        //         break;
        //       case 4:
        //         $columns_class = "col-{$breakpoint}-3";
        //         break;
        //       case 5:
        //         $columns_class = "col-{$breakpoint}-2";
        //         break;
        //       case 6:
        //         $columns_class = "col-{$breakpoint}-2";
        //         break;
        //     }
        //     if (strpos($device, '_phone')){
        //       $columns_phone = $columns_class;
        //     }else if (strpos($device, '_table')){
        //       $columns_tablet = $columns_class;
        //     }else{
        //       $columns_desktop = $columns_class;
        //     }
        //   }
        // }

    $atts['contentorder'] = explode( ',', $atts['contentorder'] );
    $Event_Inner_Margin = explode('|', str_replace(array('false'), array('') ,$atts['event_inner_spacing']));
    $Card_Outer_Margin_top = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
    $Card_Outer_Margin_bottom = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
    $Card_Outer_Margin_left = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
    $Card_Outer_Margin_right = explode('|', str_replace(array('false'), array('') ,$atts['cards_spacing']));
    $marginArr = array('margin-right','margin-left');
    $marginArrtop = array('margin-top','margin-bottom');
    $eventInnerPadding = array('padding-top','padding-right','padding-bottom','padding-left');
    $Card_Outer_Margin_top = array_slice($Card_Outer_Margin_top,0,1);
    $Card_Outer_Margin_bottomA = array_slice($Card_Outer_Margin_bottom,2,2);
    $Card_Outer_Margin_bottomB = array_slice($Card_Outer_Margin_bottomA,0,1);

    $Card_Outer_Margin_Topbottom = array_merge($Card_Outer_Margin_top,$Card_Outer_Margin_bottomB);
    $Card_Outer_Margin_left = array_slice($Card_Outer_Margin_left,1,1);
    $Card_Outer_Margin_right = array_slice($Card_Outer_Margin_right,3,1);
  
    $Card_Outer_Margin_Leftright = array_merge($Card_Outer_Margin_left,$Card_Outer_Margin_right);

    for($i=0;$i<4;$i++)
    {

      $Event_Inner_Margin_style[$eventInnerPadding[$i]] = @ $Event_Inner_Margin[$i] == '' ? '' : $Event_Inner_Margin[$i]; 

    }

    for($i=0;$i<2;$i++){
      $Card_Outer_Margin_style[$marginArr[$i]] = @ $Card_Outer_Margin_Leftright[$i] == '' ? '' : $Card_Outer_Margin_Leftright[$i];
      $Card_Outer_Margin_style_top[$marginArrtop[$i]] = @ $Card_Outer_Margin_Topbottom[$i] == '' ? '' : $Card_Outer_Margin_Topbottom[$i];
    }

    $eventInnerStyle = implode('; ', array_map(
      function ($v, $k) { return sprintf("%s:%s", $k, $v); },
      $Event_Inner_Margin_style,
      array_keys($Event_Inner_Margin_style)
    ));
    $cardInnerStyle = implode('; ', array_map(
      function ($v, $k) { return sprintf("%s:%s", $k, $v); },
      $Card_Outer_Margin_style,
      array_keys($Card_Outer_Margin_style)
    ));
    $cardInnerStyletop = implode('; ', array_map(
      function ($v, $k) { return sprintf("%s:%s", $k, $v); },
      $Card_Outer_Margin_style_top,
      array_keys($Card_Outer_Margin_style_top)
    ));
    $cardoverStyle .= ';background:'.$atts['open_toggle_background_color'].';';

    $event_not_found = true;

    foreach( (array) $event_posts as $post_index => $event_post ) {
      setup_postdata( $event_post->ID );

  //   $custom_duration_meta_key = get_post_meta($event_post->ID, '_EventDuration',true);

      $events_custom_start_time   = tribe_get_start_time($event_post->ID);
      $events_custom_end_time   = tribe_get_end_time($event_post->ID);

      $filter_months_array = explode(',', $filter_time);

      $custom_time_range = decm_timeFilter($events_custom_start_time,$events_custom_end_time, $filter_months_array);

    // echo $custom_time_range;

      $events_custom_start  =  tribe_get_start_date( $event_post->ID,null, 'Y-m-d');
      $events_custom_end  = tribe_get_end_date( $event_post->ID,null, 'Y-m-d');
    
      $decm_dates = decm_dateRange($events_custom_start, $events_custom_end);

      $filter_day_array = explode(',', $filter_day);

      $filter_years_array = explode(',', $filter_year);

      $filter_months_array = explode(',', $filter_month);

      $date_custom_range  = array_filter($decm_dates, decm_dateFilter($filter_day_array));

      $date_custom_year  = array_filter($decm_dates, decm_years_Filter($filter_years_array));

      $decm_months_Filter  = array_filter($decm_dates, decm_months_Filter($filter_months_array));

      
      $foundDates = array_reduce($date_custom_range, function ($carry, $date) {
        $carry = $date->format('Y-m-d');
        return $carry;
      }, []);

      $foundyears = array_reduce($date_custom_year, function ($carry, $date) {
        $carry = $date->format('Y');
        return $carry;
      }, []);

      $foundMonths = array_reduce($decm_months_Filter, function ($carry, $date) {
        $carry = $date->format('m');
        return $carry;
      }, []);

      
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
              $category_enable_link = $atts['enable_category_links'] == 'true' ? '<a href="'.get_category_link( $category->term_id ).'" >'.$category->name.'</a>' : '<span>'.$category->name.'</span>';
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

              $tag_enable_link = $atts['enable_tag_links'] == 'true' ? '<a href="'.get_term_link( $tag->term_id ).'" target="'.$atts['custom_tag_link_target'].'" >'.$tag->name.'</a>' : '<span>'.$tag->name.'</span>';
              $tag_names[] = '<span class= "decm_tag ecs_tag_'.$tag->slug.'" >'.$tag_enable_link.'</span>';
            }
          }




  if(!empty($foundDates) || $filter_day == ""){

  if(!empty($foundyears) || $filter_year == ""){

  if(!empty($foundMonths) || $filter_month == ""){

  if(!empty($custom_time_range) || $filter_time == ""){


      $event_not_found = false;
      $event_output .= apply_filters( 'decm_events_start_tag', '<div class=" '.$columns_desktop.' '.$columns_tablet.' '.$columns_phone_xs.' ecs-event ecs-event-posts clearfix' . implode( '', $category_slugs ) . $featured_class . apply_filters( 'decm_events_classes', '', $atts, $post ) . '" style="'.$cardInnerStyletop.'" "><article id="event_article_'.$event_post->ID.'" class="act-post et_pb_with_border '.$atts['overlay_class'].'"  style="'.$cardoverStyle.''.$cardInnerStyle.'" " ><div class="row" style="" > ', $atts, $post );
      if($atts['layout'] == 'list'&& $atts['list_columns']=='1'){
      if($atts['show_event_month_heading']=='true'){
        if(Tribe\Events\Views\V2\Utils\Separators::should_have_month( $event_posts,$event_post->ID )){
        $event_output.="<h2 class='ecs-events-list-separator-month'><span class='ecs-events-calendar-list__month-separator-text'>".tribe_get_start_date( $event_post->ID, false, tribe_get_date_option( 'monthAndYearFormat', 'F Y' ) )."</span></h2>" ;
        //$event_output.="";
        }
      }
      }
        else{}
      // Put Values into $event_output
      if ( event_attr_isValid( $atts['thumb'] ) ){
          
      }
      else{
  // 					$event_output .= '<div class="col-md-12">';
      }
      $custom_website_link_text="";
      $custom_event_link_url="";
      $custom_event_link_url = $atts['custom_event_link_url']==""?tribe_get_event_link($event_post->ID):((strpos($atts['custom_event_link_url'], "http") !== 0)?$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ?"https" : "http") . "://" .$atts['custom_event_link_url']:$atts['custom_event_link_url']);
      // $custom_website_link_text=($atts['website_link']=='custom_text'&& $atts['custom_website_link_text']=="") || $atts['website_link']=='default_text'?"View Events Website":$atts['custom_website_link_text'];				
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
      $classShowDataOneLine ='';
      $classShowDataOneLine = $atts['show_data_one_line'] == 'true' ? ' decm-show-data-display-block ' : ' ';
    $start_time='';
    $end_time ='';
    $set_timezone='';
    $image_center='';
    $set_timezone=$atts['show_timezone']=='true'?$atts['show_timezone_abb']=='false'?" ".Tribe__Events__Timezones::get_event_timezone_string($event_post->ID ):" ".Tribe__Events__Timezones::get_event_timezone_abbr( $event_post->ID ):"";
    $start_time=$atts['timeformat']==''? tribe_get_start_time($event_post->ID,get_option( 'time_format' )):tribe_get_start_time($event_post->ID,$atts['timeformat']);  
    $end_time=$atts['timeformat']==''? tribe_get_end_time($event_post->ID,get_option( 'time_format' )):tribe_get_end_time($event_post->ID,$atts['timeformat']);
    $end_time=$atts['show_end_time']=="true"?$end_time.$set_timezone:((tribe_get_start_time($event_post->ID,get_option( 'time_format' ))== tribe_get_end_time($event_post->ID,get_option( 'time_format' )))?$end_time.$set_timezone:$set_timezone);
    
    $event_stutus_tag = '';

    if(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true) == 'postponed'){
      $event_stutus_tag = tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'" style="display:inline">'.__('postponed','decm-divi-event-calendar-module').' </span>':"";
      //	echo tribe_get_event_meta($event_post->ID,'_tribe_events_status', true);
    }

    if(tribe_get_event_meta($event_post->ID,'_tribe_events_status', true) == 'canceled'){
        $event_stutus_tag = tribe_get_event_meta($event_post->ID,'_tribe_events_status', true)?'<span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_events_status', true).'" style="display:inline">'.__('canceled','decm-divi-event-calendar-module').' </span>':"";
    }

    //print_r(tribe_get_event_meta($event_post->ID));
    $start_date='';
    $end_date ='';
    $showicondate ="";
    $showicontime="";
    $showicon="";
    $showlabel="";
    $show_colon= $atts['show_colon']=="true"?":":"";
    $showlabeldate="";
    $showlabeltime="";
    $disable_event_button_link="";
    $disable_event_image_link="";
    $disable_event_title_link="";
    $disable_event_title_link=$atts['disable_event_title_link']=="true"?" ecs_disable_event_link ":"";
    $disable_event_image_link=$atts['disable_event_image_link']=="true"?" ecs_disable_event_link ":"";
    $disable_event_button_link=$atts['disable_event_button_link']=="true"?" ecs_disable_event_link ":"";
  // $start_date = $atts['dateformat']==''? tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' )):tribe_get_start_date( $event_post->ID,null,$atts['dateformat']);
      $start_date_format_check="";
      $start_date_format_check=$atts['dateformat']!=""?$atts['dateformat']:get_option( 'date_format' );
        if($atts['shorten_multidate']=='true' && $atts['start_date_format']!=""&& (tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' ))!= tribe_get_end_date( $event_post->ID,null,get_option( 'date_format' )))){
            $start_date = $atts['start_date_format']!=""? tribe_get_start_date( $event_post->ID,null,$atts['start_date_format']):tribe_get_start_date( $event_post->ID,null,"M d");		
        }
        else{
          if($atts['shorten_multidate']=='true' && $atts['start_date_format']==""){
          
            if(tribe_get_start_date( $event_post->ID,"Y") == tribe_get_end_date( $event_post->ID,"Y")){
              $start_date =  (tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' ))!= tribe_get_end_date( $event_post->ID,null,get_option( 'date_format' ))) ? tribe_get_start_date( $event_post->ID,null,"M j"): tribe_get_start_date( $event_post->ID,null,$start_date_format_check);
            }else{
              $start_date =  (tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' ))!= tribe_get_end_date( $event_post->ID,null,get_option( 'date_format' ))) ? tribe_get_start_date( $event_post->ID,null,"M j, Y"): ($atts['dateformat']==''?tribe_get_start_date( $event_post->ID,null,"M j, Y") : tribe_get_start_date( $event_post->ID,null,$atts['dateformat']));
            }
            
          }else{
            $start_date = $atts['dateformat']==""? tribe_get_start_date( $event_post->ID,null,get_option( 'date_format' )):tribe_get_start_date( $event_post->ID,null,$atts['dateformat']);
          }		
        }

        if(tribe_get_start_date( $event_post->ID,"M Y") == tribe_get_end_date( $event_post->ID,"M Y")){
          $start_date_format_update = $atts['dateformat']!=""? $atts['dateformat']: "j, Y";
          $end_date=$atts['dateformat']=="" && $atts['shorten_multidate']=='false'? ' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '. tribe_get_end_date($event_post->ID,null,get_option( 'date_format' )):(($atts['dateformat']!="" && $atts['shorten_multidate']=='false')?' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$start_date_format_check):' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$start_date_format_update));  
        }else{
          $start_date_format_update = $atts['dateformat']!=""? $atts['dateformat']: "M j, Y";
          $end_date=$atts['dateformat']=="" && $atts['shorten_multidate']=='false'? ' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '. tribe_get_end_date($event_post->ID,null,get_option( 'date_format' )):(($atts['dateformat']=="" && $atts['shorten_multidate']=='false')?' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$start_date_format_check):' '.tribe_get_option( 'timeRangeSeparator', ' - ' ).' '.tribe_get_end_date( $event_post->ID,null,$start_date_format_update));  
        }

        $end_date=$atts['show_end_date']=="true"?$end_date:"";
    
    
    $event_hybrid="";
    $event_virtual="";
    if(tribe_get_start_date( $event_post->ID,false,"D") == tribe_get_end_date( $event_post->ID,false,"D")){
      $decm_show_callout_day_of_week = $atts['show_callout_day_of_week'] == "true" ? '<div class="callout_weekDay">'.tribe_get_start_date( $event_post->ID,null, $atts['callout_week_format']).'</div>' : "" ;
    }else{
      if($atts['show_callout_day_of_week_range'] == "true" && (tribe_get_start_date( $event_post->ID,false,"D") != tribe_get_end_date( $event_post->ID,false,"D"))){
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
    $event_virtual=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="virtual"?'
    <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--virtual tribe-events-virtual-virtual-event__icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 16" style="font-size: 5px !important;margin: 0px !important;width: 24px;height: 12px;/* display: flex; */">
  <g fill-rule="evenodd" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" transform="translate(1 1)">
    <path d="M18 10.7333333c2.16-2.09999997 2.16-5.44444441 0-7.46666663M21.12 13.7666667c3.84-3.7333334 3.84-9.80000003 0-13.53333337M6 10.7333333C3.84 8.63333333 3.84 5.28888889 6 3.26666667M2.88 13.7666667C-.96 10.0333333-.96 3.96666667 2.88.23333333" class="tribe-common-c-svgicon__svg-stroke"></path><ellipse cx="12" cy="7" rx="2.4" ry="2.33333333" class="tribe-common-c-svgicon__svg-stroke"></ellipse></g></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'.__('Virtual Event','decm-divi-event-calendar-module').' </span>':"";
    $event_hybrid=tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type',true)=="hybrid"?'
    <svg class="tribe-common-c-svgicon tribe-common-c-svgicon--hybrid tribe-events-virtual-hybrid-event__icon-svg" viewBox="0 0 15 13" fill="none" style="width: 24px;height: 12px;" xmlns="http://www.w3.org/2000/svg">
  <circle cx="3.661" cy="9.515" r="2.121" transform="rotate(-45 3.661 9.515)" stroke="#0F0F30" stroke-width="1.103"></circle><circle cx="7.54" cy="3.515" r="2.121" transform="rotate(-45 7.54 3.515)" stroke="#0F0F30" stroke-width="1.103"></circle>
  <path d="M4.54 7.929l1.964-2.828" stroke="#0F0F30"></path><circle r="2.121" transform="scale(-1 1) rotate(-45 5.769 18.558)" stroke="#0F0F30" stroke-width="1.103"></circle>
  <path d="M10.554 7.929L8.59 5.1" stroke="#0F0F30"></path></svg> <span  class="ecs_event_status_'.tribe_get_event_meta($event_post->ID,'_tribe_virtual_events_type', true).'" style="display:inline">'.__('Hybrid Event','decm-divi-event-calendar-module').' </span>':"";
    //print_r(tribe_events_month_has_events_filtered($event_post->ID))
    if($atts['layout'] == 'cover'){
      $decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-cover">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div>' : '';	
    }else if($atts['layout'] == 'list'){
      $decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-list">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div>' : '';		
    }else{
      $decm_show_callout_box = $atts['show_callout_box'] == "true" ? '<div class="callout-box-grid">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div>' : '';
    }
        

    if($atts['align']=="center"){
      $image_center="decm-show-image-center";
    }
    if($atts['align']=="left"){
      $image_center="decm-show-image-left";
    }
    if($atts['align']=="right"){
      $image_center="decm-show-image-right";
    }


      foreach ( apply_filters( 'decm_events_contentorder', $atts['contentorder'], $atts, $event_post ) as $contentorder ) {

        switch ( trim( $contentorder ) ) {
          
          case  'callout':
            $event_output .= '<div class="col-md-2 col-3">'.$decm_show_callout_box.'</div>';
          break;
          case 'title':

            $dec_event_title = "";
                if(event_attr_isValid( $atts['showtitle'] )){
                  $dec_event_title =  apply_filters( 'decm_events_details_start', ''.$event_stutus_tag.$event_virtual.$event_hybrid.'<'.esc_attr($atts['header_level']).' class="entry-title title1 summary">', $atts, $event_post ).apply_filters( 'decm_events_list_title_link_start', '<a class="'.$disable_event_title_link.'" href="' .esc_attr( $custom_event_link_url ). '" rel="bookmark" target="'.esc_attr($atts['custom_event_link_target']).'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'decm_events_title_tag_end', '</'.esc_attr($atts['header_level']).'>', $atts, $event_post );
            }


          if((event_attr_isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list') && ($atts['showdetail'] == 'true' || $atts['showdetail'] == 'false' ) ){					
            if($atts['list_layout'] == 'calloutrightimage_leftdetail'){
            $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
          }elseif( event_attr_isValid( $atts['thumb'] ) != " " &&  ($atts['show_callout_box'] == "false" && $atts['showdetail'] == 'false' ) && $atts['list_layout'] == 'leftimage_rightdetail'){
            $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
          }elseif( event_attr_isValid( $atts['thumb'] ) != " "   && ($atts['list_layout'] == 'leftimage_rightdetail' || $atts['list_layout'] == 'rightimage_leftdetail') ){
            $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
          }elseif( event_attr_isValid( $atts['thumb'] ) != " " &&  ($atts['show_callout_box'] == "true" && $atts['showdetail'] == 'true' ) ){
            $event_output .= '<div class="  col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
          }elseif( event_attr_isValid( $atts['thumb'] ) != " "  &&  $atts['show_callout_box'] == "true"  ){
            $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
          }else{
            $event_output .= '<div class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details ">'.$dec_event_title;
          }							

        }elseif((event_attr_isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list') && $atts['showdetail'] == 'false' ){

          $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '10' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '10' : '12').'"><div class="decm-events-details ">'.$dec_event_title;

        }elseif(event_attr_isValid( $atts['thumb'] ) != " " &&  $atts['layout'] == 'list' ){

              $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '12' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '12' : '12').'"><div class="decm-events-details ">'.$dec_event_title;

            }elseif($atts['layout'] == 'list' &&  ($atts['list_layout'] == 'calloutleftimage_rightdetailButton' || $atts['list_layout'] == 'calloutrightimage_leftdetailButton' || $atts['list_layout'] == 'calloutimage_rightdetailButton'  )  ){
              if($atts['list_layout'] == 'calloutimage_rightdetailButton'){
              $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '5' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '6' : '12').'"><div class="decm-events-details">'.$dec_event_title;
              }else{
              $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '5' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '5' : '12').'"><div class="decm-events-details">'.$dec_event_title;
              }

            }elseif( $atts['layout'] == 'list' &&  ($atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail') ){

            $event_output .= '<div  class=" col-'.( $atts['list_columns'] <= 2  && $atts['thumb'] == 'false' ? '10' : '6').'  col-md-'.( $atts['list_columns'] <= 2  && $atts['thumb'] == 'false' ? '10' : '6').'"><div class="decm-events-details">'.$dec_event_title;	

            }elseif ( event_attr_isValid( $atts['showtitle'] ) &&  $atts['layout'] == 'list' ) {

              $event_output .= '<div  class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details">'.$dec_event_title;						
            }	
            elseif(  event_attr_isValid( $atts['showtitle'] )  && $atts['layout'] == 'grid'  ){
              
              $decm_show_callout_box_grid = $atts['show_callout_box'] == "true" ? '<a class="'.$disable_event_image_link.'"  href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'"><div class="callout-box-cover">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div></a>' : '';	
                  //$event_output .= $decm_show_callout_box_grid;
                  if ( event_attr_isValid( $atts['thumb'] ) ) {
                    $decm_show_callout_box_grid = ""; 
                  }else{
                    $decm_show_callout_box_grid = $decm_show_callout_box_grid; 
                  }
              
              $event_output .= '<div  class="col-md-'.($atts['columns'] > 2 ? '12' : '12').'"><div class="decm-events-details">'.$decm_show_callout_box_grid.$dec_event_title;
                
            }elseif(event_attr_isValid( $atts['showtitle'] )  && $atts['layout'] == 'cover'){

              $image = get_the_post_thumbnail_url($event_post->ID,array(800,800,'class'=>" ecs_event_feed_image"));	
              
              $background_image	= $atts['thumb'] == "true" ? "background-image: url($image); background-size: cover;" : "";   
              $event_output .= '<div  class="col-md-'.($atts['columns'] > 2 ? '12' : '12').' "  ><div class="decm-cover-image-overlay"   style = "'.$background_image.'" ><div class="decm-cover-overlay-details"><div  class="decm-events-details-cover">'.$decm_show_callout_box .''.apply_filters( 'decm_events_details_start', '<'.$atts['header_level'].' class="entry-title title1 summary">', $atts, $event_post ) .apply_filters( 'decm_events_list_title_link_start', '<a href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', get_the_title($event_post->ID), $atts, $post ) . apply_filters( 'decm_events_list_title_link_end', '</a>', $atts, $event_post ) .apply_filters( 'decm_events_title_tag_end', '</'.$atts['header_level'].'>', $atts, $event_post );
            }elseif(!event_attr_isValid( $atts['showtitle'] ) &&  $atts['layout'] == 'list'){
                  
              $event_output .= '<div check class=" col-'.($atts['list_columns'] <= 2 ? '8' : '12').'  col-md-'.($atts['list_columns'] <= 2 ? '8' : '12').'"><div class="decm-events-details">';	
            }else{
              
              $event_output .= '<div  class="col-md-'.(($atts['columns'] > 2 ? '12' : $atts['image_align'] == 'topimage_bottomdetail' || $atts['image_align'] == 'centerimage_bottomdetail' || $atts['thumb'] == 'false') ? '12' : '8').'"><div   class="decm-events-details">';
            }
          break;
          case 'title2':
            $event_output .= '<'.$atts['header_level'].' class="entry-title title2 summary">
                    <a class="'.$disable_event_title_link.'" href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark">'.get_the_title($event_post->ID).'</a>
                      </'.$atts['header_level'].'>';
            break;
          /**
           * Show Author Name of every events
           *
           * @author bojana
           */

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
                $showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? 'dief-events-series-relationship-single-marker__icon': '';
                $showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ? '<span class="ecs-detail-label">'.esc_attr($series_custom_label.$show_colon).'</span>':"";
                $stacklabel = $atts['stack_label_icon']==='true'?"<br>":"";
                $enable_series_link=$atts['enable_series_link']=='true'? '<a href="'.tec_event_series(  $series_id )->guid.'" class="diec-events-series-relationship-single-marker__title tribe-common-cta--alt" target="'.esc_attr($atts['custom_series_link_target']).'"><span class="diec_series_marker__title">'.tec_event_series(  $series_id )->post_title.'</span></a>':'<span class="diec_series_marker__title">'.tec_event_series(  $series_id )->post_title.'</span>';
                // $enable_series_label = $atts['event_series_label']=='true'? '<span class="diec-events-series-relationship-single-marker__prefix">Event Series:	</span>' : '';
                // $enable_series_icon = $atts['event_series_icon']=='true'? '<span class="dief-events-series-relationship-single-marker__icon">&#xe025;</span>': '';
              if($atts['event_series_name']=='true' && !empty(tec_event_series(  $series_id )->post_title)){
                //$event_output .=  '<div>'.$showicon.$showlabel.$stacklabel.$enable_series_link.'</div>';
                $event_output .= '<span class="'.$classShowDataOneLine.' '.$showicon.'">'.$showlabel.$stacklabel." ".'<span class="decm_series_name">'.$enable_series_link.'</span></span>';
              }
              }
              break;	
          
          case 'organizer':
            if ( event_attr_isValid( $atts['organizer'] ) ) {
              if(tribe_get_organizer($event_post->ID) != null){
                $showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"organizer-ecs-icon":"";
                $organizer_custom_label = __('Organizer','decm-divi-event-calendar-module');
                  if(!empty($atts['organizer_detail_label'])){
                          $organizer_custom_label =  __($atts['organizer_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
                  }
                $showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label'] ==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$organizer_custom_label.$show_colon." </span>":"";
                $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";

                $organizers = tribe_get_organizer_ids($event_post->ID);
                $orgName = array();
                foreach ($organizers as $key => $organizerId) {
                  $orgName[$key] = $orgName[$key] = $atts['enable_organizer_link']=="true" &&class_exists( 'Tribe__Events__Pro__Main' )?'<a href="'.$result_organizer.'" target="'.$atts['custom_organizer_link_target'].'">'.tribe_get_organizer($organizerId).'</a>':tribe_get_organizer($organizerId);
                } 

                $orgNames	= implode(', ', $orgName);
                  $event_output .= '<span class="'.$classShowDataOneLine.' ecs-organizer '.$showicon.'">'
                  .($atts['show_preposition'] == 'true' ? $showlabel.$stacklabel.'<span class="decm_organizer">'.__(' by ','decm-divi-event-calendar-module') : $showlabel.$stacklabel." ".'<span class="decm_organizer">');      
                    $event_output .=  $orgNames;   
                  $event_output .= '</span></span>';           
            }
        
          }
            
            
            break;
            case 'show_rsvp_feed':
              if ( event_attr_isValid( $atts['show_rsvp_feed'] ) ) {
                if (is_plugin_active('event-tickets/event-tickets.php')) {
                  $event_link = tribe_get_event_link($event_post->ID);
                  
                  // Get RSVP data
                  $rsvp_data = Tribe__Tickets__Tickets::get_ticket_counts($event_post->ID);
                  // print_r($rsvp_data);
                  
                  // Initialize RSVP-related variables
                  $available_rsvp = 0;
                  $unlimited_rsvp = false;
                  $rsvp__label = '';
              
                  // Check if RSVP data is available and has the necessary keys
                  if (isset($rsvp_data['rsvp'])) {
                    $available_rsvp = isset($rsvp_data['rsvp']['stock']) ? $rsvp_data['rsvp']['stock'] : 0;
                    $unlimited_rsvp = isset($rsvp_data['rsvp']['unlimited']) ? $rsvp_data['rsvp']['unlimited'] : false;
                  }
              
                  // Proceed if RSVP data is available
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
                      $rsvp__label = "Currently Full";                                
                    } elseif ($available_rsvp == -1 && $unlimited_rsvp) {
                      $rsvp__label = "Unlimited";                                
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
                if ( event_attr_isValid( $atts['price'] ) ) {
                  if(tribe_get_cost( $event_post->ID, true )!=null){
                    $showicon= ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ?"price-ecs-icon":"";
                    $price_custom_label = __('Price','decm-divi-event-calendar-module');
                    if(!empty($atts['price_detail_label'])){
                            $price_custom_label =  __($atts['price_detail_label'],'decm-divi-event-calendar-module');
                    }
                    $showlabel = ($atts['show_icon_label']==="label_icon" || $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$price_custom_label.$show_colon." </span>":"";
                    $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                      $event_output .= '<span class=" '.$classShowDataOneLine.' ecs-price '.$showicon.'">' .
                          "".$showlabel.$stacklabel." ".'<span class="decm_price">'.tribe_get_cost( $event_post->ID, true ).
                         '</span></span>';
                      
                }
             
              }
                
                break;	

            case 'show_price_ticket':
              if ( event_attr_isValid( $atts['show_price_ticket'] ) ) {

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
            if ( event_attr_isValid( $atts['thumb'] ) ) {

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
                $decm_show_callout_box_grid = $atts['show_callout_box'] == "true" ? '<a class="'.$disable_event_image_link.'"  href="' .esc_attr($custom_event_link_url).'" target="'.esc_attr($atts['custom_event_link_target']).'"><div class="callout-box-list-on-Image">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div></a>' : '';	
                // $event_output .= $decm_show_callout_box_grid;
                if (event_attr_isValid( $atts['thumb'] ) ) {
                  $decm_show_callout_box_grid = $decm_show_callout_box_grid; 
                }else{
                  $decm_show_callout_box_grid = ""; 
                }
                if( $atts['list_layout'] == 'calloutimage_rightdetail' ||  $atts['list_layout'] == 'calloutimage_rightdetailButton'){
              $event_output.='<div  class="'.$image_center.' col-md-'.(esc_attr($atts['list_columns']) <= 2 ? '4' : '12').' col-'.(esc_attr($atts['list_columns']) <= 2 ? '4' : '12').' ">'.$decm_show_callout_box_grid.'';
                  $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
                $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
                }else{
                  $event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').' col-'.($atts['list_columns'] <= 2 ? '4' : '12').' ">';
                  $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
                $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
                }
              
              }elseif( $atts['layout'] == 'list' && ($atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail')  ){

                  $event_output.='<div class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '4' : '12').' col-'.($atts['list_columns'] <= 2 ? '4' : '12').'">';
                  $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
                $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
              
              }elseif( $atts['layout'] == 'list' && ($atts['list_layout'] == 'calloutleftimage_rightdetailButton' || $atts['list_layout'] ==  'calloutrightimage_leftdetailButton') ){

              $event_output.='<div  class="'.$image_center.' col-md-'.($atts['list_columns'] <= 2 ? '3' : '12').' col-'.($atts['list_columns'] <= 2 ? '3' : '12').' ">';
              $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
              $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
            
                }elseif($atts['layout'] == 'cover'){
                  $event_output.='<div  style = "display:none;" class="'.$image_center.' col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
                  $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
                $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';

                }else{								
                $event_output.='<div  class="'.$image_center.' col-md-'.($atts['columns'] > 2 ? '12' : '4').'">';
                $thumbWidth = is_numeric($atts['thumbwidth']) ? $atts['thumbwidth'] : substr($atts['thumbwidth'],0,strlen($atts['thumbwidth']) - 2);
                $thumbHeight = is_numeric($atts['thumbheight']) ? $atts['thumbheight'] : '';
              }

              if( !empty( $thumbWidth ) ) {
                $thumb = get_the_post_thumbnail( $event_post->ID,array( $thumbWidth, $thumbHeight,'class'=>" ecs_event_feed_image" ) );
                if( !empty( $thumb ) &&  $atts['layout'] == 'cover' ){
                  $event_output .='<a class="'.$disable_event_image_link.'" style="display:none;" href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">';
                  $event_output .= $thumb;
                  $event_output .= '</a>';
                }
                elseif ( !empty( $thumb ) &&  $atts['layout'] == 'grid' ) {

                  $event_output .='<a class="'.$disable_event_image_link.' dec-image-overlay-url" href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">';
                  $event_output .= $thumb;
                  $event_output .= ''.$decm_show_callout_box.'<span class="dec_image_overlay dec_overlay_inline_icon" data-icon="'.$atts['hover_icon'].'" data-icon-tablet="'.$atts['hover_icon_tablet'].'" data-icon-phone="'.$atts['hover_icon_phone'].'"></span></a>';

                }elseif ( $thumb = get_the_post_thumbnail( $event_post->ID, apply_filters( 'decm_events_thumbnail_size', array( $thumbWidth, $thumbHeight,'class'=>" ecs_event_feed_image" ), $atts, $event_post ) ) ) {
                  $event_output .='<a class="'.$disable_event_image_link.' dec-image-overlay-url" href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">';
                  $event_output .= $thumb;
                  $event_output .= '<span class="dec_image_overlay dec_overlay_inline_icon" data-icon="'.$atts['hover_icon'].'" data-icon-tablet="'.$atts['hover_icon_tablet'].'" data-icon-phone="'.$atts['hover_icon_phone'].'"></span></a>';
                }
                else if(empty( $thumb )&&  $atts['layout'] == 'grid'){
                  $decm_show_callout_box_grid = $atts['show_callout_box'] == "true" ? '<a class="'.$disable_event_image_link.'"  href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'"><div class="callout-box-cover">'.$decm_show_callout_date.' '.$decm_show_callout_month.' '.$decm_show_callout_day_of_week.' '.$decm_show_callout_year.$decm_show_callout_time.'</div></a>' : '';	
                  $event_output .= $decm_show_callout_box_grid;
                }
              
              } else {

                if ( $thumb = get_the_post_thumbnail( $event_post->ID ,array( $thumbWidth, $thumbHeight,'class'=>" ecs_event_feed_image" ) ) ) {
                  $event_output .= '<a class="'.$disable_event_image_link.'" href="' . $custom_event_link_url.'" target="'.$atts['custom_event_link_target'].'">';
                  $event_output .= $thumb;
                  $event_output .= '</a>';
                }
              }


              $event_output.='</div>';
            }
            break;

            case 'excerpt':
              if ( event_attr_isValid( $atts['excerpt'] ) ) {
                
                $excerptLength = is_numeric( $atts['excerpt'] ) ? intval( $atts['excerpt'] ) : 100;
                if($atts["excerpt_content"]=="excerpt_show"){
                if(event_attr_get_excerpt($event_post,$excerptLength )!=null && has_excerpt($event_post->ID)){
                $event_output .='<p class="'.$classShowDataOneLine.' ecs-excerpt">'
                          .event_attr_get_excerpt($event_post, $excerptLength ).
                          '</p>';
              }}
              if($atts["excerpt_content"]=="_show"){
                //print_r($atts["excerpt_content"]);
                if(event_attr_get_content($event_post,$excerptLength )!=null ){
                  
                  $event_output .='<p class="'.$classShowDataOneLine.' ecs-excerpt">'.
                  event_attr_get_content($event_post,$excerptLength ).
                            '</p>';
                }
              }
              
            }
              
            break;
          
              
            case 'weburl':
              if ( event_attr_isValid( $atts['weburl'] ) ) {
                if ( tribe_get_event_website_link($event_post)!=null){
                  // print_r(tribe_get_event_website_link($event_post->ID));
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
            //$event_output.='</div></br>';
            break;
            case 'date':
                  
              $datetime_separator       = tribe_get_option( 'dateTimeSeparator', ' @ ' );
                        $time_range_separator     = tribe_get_option( 'timeRangeSeparator', ' - ' );
              $time_range_separator     = $atts['show_end_time']== "true"? $time_range_separator:"";

              $event_output .= '<div class="decm-show-detail-center">';
              if ( event_attr_isValid( $atts['eventdetails'] ) || $atts['showtime']=="false" || $atts['showtime']=="true" ) {
                if($atts['showtime']== 'true' || $atts['showtime']=="false" ){
                if($atts['show_data_one_line'] == 'true'){

                  $time_custom_label = __('Time','decm-divi-event-calendar-module');
                  if(!empty($atts['time_detail_label'])){
                    $time_custom_label =  __($atts['time_detail_label'],'decm-divi-event-calendar-module'); //phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
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
            if(event_attr_isValid( $atts['eventdetails'])){
            
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
          
            if(event_attr_isValid( $atts['eventdetails'])){
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
            
            if(event_attr_isValid( $atts['eventdetails'])){
              
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
            
            if(event_attr_isValid( $atts['eventdetails'])){
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
                
              if(event_attr_isValid( $atts['eventdetails'])){
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
                  if(event_attr_isValid( $atts['eventdetails'])){
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


                    if(event_attr_isValid( $atts['eventdetails'])){
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
                      if(event_attr_isValid( $atts['eventdetails'])){
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
              /**
               * Show location of venue
               *
               * @author bojana
               *
               */
              case 'venue':
                if ( event_attr_isValid( $atts['venue'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
                  if(tribe_get_venue($event_post->ID)!=null){
                    $showicon = ($atts['show_icon_label']==="icon" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?"venue-ecs-icon":"";
                    $venue_custom_label = __('Venue','decm-divi-event-calendar-module');
                      if(!empty($atts['venue_detail_label'])){
                        $venue_custom_label =  __($atts['venue_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
                      }
                    $showlabel = ($atts['show_icon_label'] ==="label" || $atts['show_icon_label']==="label_icon" ) && $atts['show_data_one_line'] == 'true' ?'<span class=ecs-detail-label>'.$venue_custom_label.$show_colon." </span>":"";
                    $enable_venue_link =$atts['enable_venue_link']=="true"&&class_exists( 'Tribe__Events__Pro__Main' )?'<a href="'.$result_venue.'" target="'.$atts['custom_venue_link_target'].'">'.tribe_get_venue($event_post->ID).'</a>':tribe_get_venue($event_post->ID);
                    $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                        $event_output .= '<span class="'.$classShowDataOneLine.'ecs-venue duration venue '.$showicon.'">'
                        .__($atts['show_preposition'] == 'true' ?$showlabel.$stacklabel. '<span class="decm_venue"><em>'.__( 'at ','decm-divi-event-calendar-module').'</em>' : $showlabel.$stacklabel." ".'<span class="decm_venue">', 'decm-divi-event-calendar-module' ).//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
                        $enable_venue_link.
                    '</span></span>';
                                    
                }
                //else{}
              }
      
      
                
                break;
              case 'location':
                
                if ( event_attr_isValid( $atts['location'] ) and function_exists( 'tribe_has_venue' ) and tribe_has_venue($event_post->ID) ) {
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
                  if(tribe_get_full_address($event_post->ID) !="<span class=\"tribe-address\">\n\n\n\n\n\n\n</span>\n" ){
                    $showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "event-location-ecs-icon":"";
                    $showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.__('Location','decm-divi-event-calendar-module').$show_colon." </span>":"";
                    $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                    $event_output .= '<span class="'.$classShowDataOneLine.'ecs-location duration venue '.$showicon.'">'.
                    __( $atts['show_preposition']=='true'?  $showlabel.$stacklabel.'<span class="decm_location"><em>'.__( 'in','decm-divi-event-calendar-module').'</em>': $showlabel.$stacklabel.'<span class="decm_location">').//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
                    ($atts['show_data_one_line'] =='false'? $dec_location_street.$show_postal_code_before_locality.$dec_location_locality.$dec_location_state.$dec_location_postal.$dec_location_country : str_replace('<br>','',$dec_location_street.$show_postal_code_before_locality.$dec_location_locality.$dec_location_state.$dec_location_postal.$dec_location_country)).	
                    '</span></span>';     
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
                if ( event_attr_isValid( $atts['categories'] ) ) {

                  
                  // $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
                //  $categories = implode(", ", $category_names);
                  $categories = $atts['hide_comma_cat'] == 'false' ? implode(", ", $category_names): implode(" ", $category_names);
                  $categories_separator = $categories ? ' | ' : ' ';
                  $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
                  if(et_core_esc_wp( $categories )!=null){
                    $showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "categories-ecs-icon":"";
                    $category_custom_label = __('Category','decm-divi-event-calendar-module');
                    if(!empty($atts['category_detail_label'])){
                      $category_custom_label =  __($atts['category_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
                    }
                    
                    $showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.$category_custom_label.$show_colon." </span>":"";
                    $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                      $event_output .= '<span class="'.$classShowDataOneLine.'ecs-categories '.$showicon.'">'
                              .et_core_intentionally_unescaped($showlabel.$stacklabel.$categories_sep, 'fixed_string' ) .
                          et_core_esc_wp( $categories ).
                                '</span>';
                    
                    
                  }
                  else{}
                }
                
              //  $event_output.='</div>';
                break;



                case 'tags':
                  if ( event_attr_isValid( $atts['tags'] ) ) {
    
                    
                    // $categories_sep  =	$atts['show_preposition'] == 'true' ? $categories_separator : " ";
                    $tag = implode(", ", $tag_names);
                    $tag_separator = $tag ? ' | ' : ' ';
                    $tag_sep  =	$atts['show_preposition'] == 'true' ? $tag_separator : " ";
                    if(et_core_esc_wp( $tag )!=null){
                      $showicon= ($atts['show_icon_label'] ==="label_icon" || $atts['show_icon_label']==="icon") && $atts['show_data_one_line'] == 'true' ? "tags-ecs-icon":"";
                      $tag_custom_label = __('Tag','decm-divi-event-calendar-module');
                      if(!empty($atts['tag_detail_label'])){
                        $tag_custom_label =  __($atts['tag_detail_label'],'decm-divi-event-calendar-module');//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText
                      }
                      $showlabel = ($atts['show_icon_label']==="label_icon" ||  $atts['show_icon_label']==="label") && $atts['show_data_one_line'] == 'true' ? '<span class=ecs-detail-label>'.$tag_custom_label.$show_colon." </span>":"";
                      $stacklabel= $atts['stack_label_icon']==='true'?"<br>":"";
                        $event_output .= '<span class="'.$classShowDataOneLine.'ecs-tag '.$showicon.'">'
                                .et_core_intentionally_unescaped($showlabel.$stacklabel.$tag_sep, 'fixed_string' ) .
                            et_core_esc_wp( $tag ).
                                  '</span>';
                      
                      
                    }
                    else{}
                  }
                  
                //  $event_output.='</div>';
                  break;
                
              /**
               * Show more in detail of every events
               *
               * @author bojana
               */
            
                break;
              case 'showdetail':
                if ( event_attr_isValid( $atts['showdetail']) ) {
                  $button_classes = "act-view-more et_pb_button";
                  $button_classes = $atts['button_make_fullwidth'] ==  'on' ? "act-view-more et_pb_button act-view-more-fullwidth" : $button_classes;
                  $view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
                  $icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";      
                  $button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
      
                  if($atts['layout'] == 'list' &&  ($atts['list_layout'] == 'rightimage_leftdetail' || $atts['list_layout'] == 'leftimage_rightdetail' || $atts['list_layout'] == 'calloutleftimage_rightdetail' || $atts['list_layout'] == 'calloutrightimage_leftdetail' || $atts['list_layout'] == 'calloutimage_rightdetail' ) ){
                    $event_output .= '<p class="ecs-showdetail et_pb_button_wrapper '.(( event_attr_isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >'.
                    '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'] .'</a>
                      </p>';
                  }elseif($atts['layout'] == 'grid' || $atts['layout'] == 'cover' ){
                    $event_output .= '<p class="ecs-showdetail et_pb_button_wrapper '.(( event_attr_isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >'.
                    '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'] .'</a>
                      </p>';
                  }
      
                  // $event_output .= '<p class="ecs-showdetail et_pb_button_wrapper '.(( event_attr_isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >'.
                  //         '<a class="'.$button_classes.'" href="' . tribe_get_event_link($event_post->ID) . '" rel="bookmark"  data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'] .'</a>
                  //     </p>';
                }
                $event_output.='</div></div>';
                break;
                case 'button':
                  if ( event_attr_isValid( $atts['showdetail']) ) {
                    $button_classes ="act-view-more et_pb_button";
                    $button_classes = $atts['button_make_fullwidth'] ==  'on' ? "act-view-more et_pb_button act-view-more-fullwidth" : $button_classes;
                    $view_icon=($atts['view_more_on_hover']=="off")?"et_pb_button_no_hover":"";
                    $icon_align =($atts['view_more_icon_placement']=="left")?"et_pb_button_icon_align":"";
                    $button_classes = ($atts['custom_view_more'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$view_icon." ".$icon_align : $button_classes;
      
                    $event_output .= '<div class="col-md-2 col-2 "><p class="ecs-showdetail et_pb_button_wrapper '.(( event_attr_isValid( $atts['excerpt'] ) ) ? 'mb-2' : 'mt-3 mb-2').'" >'.
                    '<a class="'.$button_classes.$disable_event_button_link.' " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'" data-icon="'.$atts['custom_icon'].'" data-icon-tablet="'.$atts['custom_icon_tablet'].'" data-icon-phone="'.$atts['custom_icon_phone'].'">' .$atts['view_more_text'] .'</a>
                    </p></div></div></div>';
      
                  }
                  break;
              case 'date_thumb':
                if ( event_attr_isValid( $atts['eventdetails'] ) ) {
                  $event_output .= '<div class="date_thumb"><div class="month">' . tribe_get_start_date( null, false, 'M' ) . '</div><div class="day">' . tribe_get_start_date( null, false, 'j' ) . '</div></div>';
                }
                break;
              default:
                $event_output .= apply_filters( 'decm_events_list_output_custom_' . strtolower( trim( $contentorder ) ), '', $atts, $event_post );
            }
          
          }
      
          $event_output .= '</div>';
          $event_output.=$atts['whole_event_clickable']=='true'?'<a class="ecs_event_clickable " href="' . $custom_event_link_url . '" rel="bookmark" target="'.$atts['custom_event_link_target'].'"></a>':"";
      
          $event_output .= '</article></div><input type="hidden" class="max_page" id="page_max" value="'.$max_pages.'">';
  
                // continue;
          // exit; 

          $output .= apply_filters( 'dec_single_event_output', $event_output, $atts, $event_post, $post_index, $event_post );
        }
      
      }
    }
        }
  }

  if( $event_not_found == true){
    $output .= sprintf( translate( '<div class="events-results-message decm-event-results-message">'.esc_attr($atts['message']).'</div>', 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() );//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText ,WordPress.WP.I18n.LowLevelTranslationFunction
  }

  
  if( event_attr_isValid( $atts['viewall'] ) ) {
    $output .= '<span class="ecs-all-events">'.
                '<a href="' .tribe_get_events_link().'" rel="bookmark">' .sprintf( __( 'View All %s', 'the-events-calendar' ), tribe_get_event_label_plural() ). '</a>';//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText ,WordPress.WP.I18n.MissingTranslatorsComment
    $output .= '</span>';
  }


    $output .= '<input type="hidden" class="max_page" id="page_max" value="'.$max_pages.'">
    <input type="hidden" name="current_page" id="current_page" value="1">';      // <input type="hidden" name="eventfeed_prev_page" id="eventfeed_prev_page" value="12">
  // <input type="hidden" name="eventfeed_current_page" id="eventfeed_current_page" value="12">
  // <input type="hidden" name="eventfeed_page" id="eventfeed_page" value="'.$atts["pagination_type"].'">
  // <input type="hidden" name="eventfeed_current_pagination_page" id="eventfeed_current_pagination_page" value="1">
  // <input type="hidden" name="module_css_feed" id="module_css_feed" value="'.$atts['module_css_class'].'">
  // <input type="hidden" name="module-css-class" id="module-css-class" value="" />
  // <input type="hidden" name="eventfeed_max_page" id="eventfeed_max_page" value=""><input type="hidden" name="eventfeed_load_img" id="eventfeed_load_img" value="'.plugin_dir_url(__FILE__).'ajax-loader.gif">';
  // $output .='</div>';

  } else { //No Events were Found

  $output .= sprintf( translate( '<div class="events-results-message decm-event-results-message">'.esc_attr($atts['message']).'</div>', 'the-events-calendar' ), tribe_get_event_label_plural_lowercase() );//phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText , WordPress.WP.I18n.LowLevelTranslationFunction

  $output .= '<input type="hidden" class="max_page" id="page_max" value="1">
  <input type="hidden" name="current_page" id="current_page" value="1">'; 


  } // endif

  // if($max_pages > 1){
  //   $button_classes = "ecs-ajax_load_more et_pb_button";
  // 	$icon_align =($atts['ajax_load_more_button_icon_placement']=="left")?"et_pb_ajax_align":"";
  // $button_classes = ($atts['custom_ajax_load_more_button'] == 'on') ? $button_classes." et_pb_custom_button_icon ".$icon_align : $button_classes;

  // $output .= apply_filters( 'decm_events_showdetail_tag_start', '<div class="event_ajax_load et_pb_button_wrapper" >', $atts, $event_post ) .
  // 				apply_filters( 'decm_events_list_showdetail_link_start', '<a class="'.$button_classes.'" href="' . "#" . '" onClick="return false;" rel="bookmark"  data-icon="'.$atts['ajax_load_more_button_icon'].'" data-icon-tablet="'.$atts['ajax_load_more_button_icon_tablet'].'" data-icon-phone="'.$atts['ajax_load_more_button_icon_phone'].'">', $atts, $event_post ) . apply_filters( 'decm_events_list_title', $atts['ajax_load_more_text'], $atts, $event_post ) . apply_filters( 'decm_events_list_showdetail_link_end', '</a>', $atts, $event_post ) .
  // 		     apply_filters( 'decm_events_showdetail_tag_end', '</div>', $atts, $event_post );
  // }

  return $output;

  wp_reset_postdata();

  }