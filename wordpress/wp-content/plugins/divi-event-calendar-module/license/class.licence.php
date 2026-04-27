<?php   
           
    class WOO_SLT_DEC_licence
        {
         
            function __construct()
                {
                    $last_checked = (int)get_site_option( 'slt_license_dec_last_checked' );
                    if( time() < ( $last_checked + (  86400 * 3  ) ))
                        return;
                                            
                    update_site_option( 'slt_license_dec_last_checked', time() );
                    
                    $this->licence_deactivation_check();   
                }
                
            /**
            * Retrieve licence details
            * 
            */
            public function get_licence_data()
                {
                    $licence_data = get_site_option('slt_dec_license');
                    
                    $default =   array(
                                            'key'               =>  '',
                                            'last_check'        =>  '',
                                            'licence_status'    =>  '',
                                            'licence_expire'    =>  ''
                                            );    
                    $licence_data           =   wp_parse_args( $licence_data, $default );
                    
                    return $licence_data;
                }
                
            /**
            * Set licence data
            *     
            * @param mixed $licence_data
            */
            public function update_licence_data( $licence_data )
                {
                    update_site_option('slt_dec_license', $licence_data);   
                }
                
                
            /**
            * Reset license data
            *     
            * @param mixed $licence_data
            */
            public function reset_licence_data( $licence_data )
                {
                    if  ( ! is_array( $licence_data ) ) 
                        $licence_data   =   array();
                        
                    $licence_data['key']                =   '';
                    $licence_data['last_check']         =   '';
                    $licence_data['licence_status']     =   '';
                    $licence_data['licence_expire']     =   '';
                    
                    return $licence_data;
                }
                
            public function licence_key_verify()
                {
                    
                    $license_data = $this->get_licence_data();
                    
                    if($this->is_local_instance())
                        return TRUE;
                             
                    if(!isset($license_data['key']) || $license_data['key'] == '')
                        return FALSE;
                        
                    return TRUE;
                }
                
            function is_local_instance()
                {
                                      
                    return FALSE;
                    
                }
                
                
            function licence_deactivation_check()
                {
                    if( ! $this->licence_key_verify() )
                        return;
                    
                    $license_data = $this->get_licence_data();
                    
                    $license_key = $license_data['key'];
                    if ( empty ( $license_key ) )
                        return;
                    
                    $args = array(
                                                'woo_sl_action'         => 'status-check',
                                                'licence_key'           => $license_key,
                                                'product_unique_id'     => WOO_SLT_DEC_PRODUCT_ID_DEC,
                                                'domain'                => WOO_SLT_DEC_INSTANCE_DEC
                                            );
                    $request_uri    = WOO_SLT_DEC_APP_API_URL_DEC . '?' . http_build_query( $args , '', '&');
                    $data           = wp_remote_get( $request_uri );
                    
                    if(is_wp_error( $data ) || $data['response']['code'] != 200)
                        {
                            $license_data['last_check']   = time();    
                            $this->update_licence_data ( $license_data );
                            return;   
                        }
                    
                    $response_block = json_decode($data['body']);
                    
                    if(!is_array($response_block) || count($response_block) < 1)
                        {
                            $license_data['last_check']   = time();    
                            $this->update_licence_data( $license_data );
                            return;
                        }   
                    
                    //retrieve the last message within the $response_block
                    $response_block = $response_block[count($response_block) - 1];
                    
                    if ( is_object ( $response_block ) )
                        {
                            if ( in_array ( $response_block->status_code, array ( 'e312', 's203', 'e204', 'e002', 'e003' ) ) )
                                {
                                    $license_data   =   $this->reset_licence_data( $license_data );
                                }
                                else
                                {
                                    $license_data['licence_status']         = isset( $response_block->licence_status ) ?    $response_block->licence_status :   ''  ;
                                    $license_data['licence_expire']         = isset( $response_block->licence_expire ) ?    $response_block->licence_expire :   ''  ;
                                }
                                
                            if($response_block->status == 'error')
                                {
                                    $license_data   =   $this->reset_licence_data( $license_data );
                                }  
                        }
                    
                    $license_data['last_check']   = time();    
                    $this->update_licence_data ( $license_data );
                    
                }
            
            
        }
            

        
    
?>