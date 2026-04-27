<?php

    class WOO_SLT_DEC_CodeAutoUpdate
         {
             # URL to check for updates, this is where the index.php script goes
             public $api_url;
             
             private $slug;
             public $plugin;

             
             public function __construct($api_url, $slug, $plugin)
                 {
                     $this->api_url = $api_url;
                     
                     $this->slug    = $slug;
                     $this->plugin  = $plugin;
                 
                 }
             
             
             public function check_for_plugin_update($checked_data)
                 {
                     if ( !is_object( $checked_data ) ||  ! isset ( $checked_data->response ) )
                        return $checked_data;
                     
                     $request_string = $this->prepare_request('plugin_update');
                     if($request_string === FALSE)
                        return $checked_data;
                     
                     // Start checking for an update
                     $request_uri = $this->api_url . '?' . http_build_query( $request_string , '', '&');
                     
                     //check if cached
                     $data  =   get_site_transient( 'slt_dec_license_check_for_plugin_update_' . md5( $request_uri ) );

                     if ( isset ( $_GET['force-check'] ) && $_GET['force-check']    ==  '1' )
                     $data   =   FALSE;

                     if  ( $data    === FALSE )
                         {
                             $data        = wp_remote_get( $request_uri );
                             
                             if(is_wp_error( $data ) || $data['response']['code'] != 200)
                                return $checked_data;
                                
                             set_site_transient( 'slt_dec_license_check_for_plugin_update_' . md5( $request_uri ), $data, 60 * 60 * 12 );
                         }
                     
                     $response_block = json_decode($data['body']);
                      
                     if(!is_array($response_block) || count($response_block) < 1)
                        return $checked_data;
                     
                     //retrieve the last message within the $response_block
                     $response_block = $response_block[count($response_block) - 1];
                     $response = isset($response_block->message) ? $response_block->message : '';
                     
                     if (is_object($response) && !empty($response)) // Feed the update data into WP updater
                         {
                             $response  =   $this->postprocess_response( $response );
                             
                             $checked_data->response[$this->plugin] = $response;
                         }

                     return $checked_data;
                 }
             
             
             public function plugins_api_call($def, $action, $args)
                 {
                     if (!is_object($args) || !isset($args->slug) || $args->slug != $this->slug)
                        return $def;
                         
                     $request_string = $this->prepare_request($action, $args);
                     if($request_string === FALSE)
                        return new WP_Error('plugins_api_failed', __('An error occour when try to identify the pluguin.' , 'wooslt') . '&lt;/p> &lt;p>&lt;a href=&quot;?&quot; onclick=&quot;document.location.reload(); return false;&quot;>'. __( 'Try again', 'wooslt' ) .'&lt;/a>');;
                     
                     $request_uri = $this->api_url . '?' . http_build_query( $request_string , '', '&');
                     
                     //check if cached
                     $data  =   get_site_transient( 'slt_dec_license_check_for_plugin_update_' . md5( $request_uri ) );
                    
                     if ( isset ( $_GET['force-check'] ) && $_GET['force-check']    ==  '1' )
                        $data   =   FALSE;

                     if  ( $data    === FALSE )
                        {
                            $data        = wp_remote_get( $request_uri );

                            if ( is_wp_error( $data ) || $data['response']['code'] != 200 ) {
                                return new WP_Error( 'plugins_api_failed', __( 'An Unexpected HTTP Error occurred during the API request.', 'wooslt' ) . '&lt;/p> &lt;p>&lt;a href=&quot;?&quot; onclick=&quot;document.location.reload(); return false;&quot;>' . __( 'Try again', 'wooslt' ) . '&lt;/a>', $data->get_error_message() );
                            }   
                            set_site_transient( 'slt_dec_license_check_for_plugin_update_' . md5( $request_uri ), $data, 60 * 60 * 12 );
                        }
                     
                     $response_block = json_decode($data['body']);
                     //retrieve the last message within the $response_block
                     $response_block = $response_block[count($response_block) - 1];
                     $response = $response_block->message;
                     
                     if (is_object($response) && !empty($response)) // Feed the update data into WP updater
                         {
                             //include slug and plugin data
                             $response  =   $this->postprocess_response( $response );
                             
                             return $response;
                         }
                 }
             
             public function prepare_request($action, $args = array())
                 {
                     global $wp_version;
                     
                     $license_data = get_site_option('slt_dec_license'); 
                     if(!is_array($license_data) || empty($license_data) )
                        return FALSE;
                     
                     return array(
                                     'woo_sl_action'        => $action,
                                     'version'              => WOO_SLT_DEC_VERSION_DEC,
                                     'product_unique_id'    => WOO_SLT_DEC_PRODUCT_ID_DEC,
                                     'licence_key'          => $license_data['key'],
                                     'domain'               => WOO_SLT_DEC_INSTANCE_DEC,
                                     
                                     'wp-version'           => $wp_version,
                                     'api_version'          => '1.1'
                                     
                     );
                 }
                 
             
             private function postprocess_response( $response )
                 {
                     //include slug and plugin data
                     $response->slug    =   $this->slug;
                     $response->plugin  =   $this->plugin;
                     
                     //if sections are being set
                     if ( isset ( $response->sections ) )
                        $response->sections = (array)$response->sections;
                     
                     //if banners are being set
                     if ( isset ( $response->banners ) )
                        $response->banners = (array)$response->banners;
                       
                     //if icons being set, convert to array
                     if ( isset ( $response->icons ) )
                        $response->icons    =   (array)$response->icons;
                     
                     return $response;
                     
                 }
                 
             function in_plugin_update_message( $plugin_data, $response  )
                {
                    
                    if  ( empty ( $response->upgrade_notice ))
                        return;
                        
                    echo ' ' .  $response->upgrade_notice;
                    
                }
         }
         
         
    function WOO_SLT_DEC_run_updater()
         {
         
             $wp_plugin_auto_update = new WOO_SLT_DEC_CodeAutoUpdate(WOO_SLT_DEC_APP_API_URL_DEC, 'divi-event-calendar-module', 'divi-event-calendar-module/divi-event-calendar-module.php');
            // print the update_plugins site transient 
           
             // Take over the update check
             add_filter('site_transient_update_plugins',                                        array($wp_plugin_auto_update, 'check_for_plugin_update'));
          
          
             // Take over the Plugin info screen
             add_filter('plugins_api',                                                          array($wp_plugin_auto_update, 'plugins_api_call'), 10, 3);
             
             add_action('in_plugin_update_message-wp-hide-security-enhancer-pro/wp-hide.php',   array($wp_plugin_auto_update, 'in_plugin_update_message'), 10, 2);
         
         }

    add_action( 'after_setup_theme', 'WOO_SLT_DEC_run_updater' );



?>