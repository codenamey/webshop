<?php

    class WOO_SLT_DEC_options_interface // class name
        {
         
            var $licence;
         
            function __construct()
                {
                    
                    $this->licence          =   new WOO_SLT_DEC_licence(); // license class (changed as well in class.license.php
                    
                    if (isset($_GET['page']) && ($_GET['page'] == 'woo-ms-options-dec'  ||  $_GET['page'] == 'woo-options-dec')) 
                        {
                            add_action( 'init', array($this, 'options_update'), 1 );
                        }
                        
                    add_action( 'admin_menu', array($this, 'admin_menu') );
                    add_action( 'network_admin_menu', array($this, 'network_admin_menu') );
                                        
                    if(!$this->licence->licence_key_verify())
                        {
                            add_action('admin_notices', array($this, 'admin_no_key_notices'));
                            add_action('network_admin_notices', array($this, 'admin_no_key_notices'));
                        }
                    
                }
                
            function __destruct()
                {
                
                }
            
            function network_admin_menu()
                {
                    if(!$this->licence->licence_key_verify())
                        $hookID   = add_submenu_page('settings.php', 'Divi Events Calendar', 'Divi Events Calendar', 'manage_options', 'woo-ms-options-dec', array($this, 'licence_form')); 
                        else
                        $hookID   = add_submenu_page('settings.php', 'Divi Events Calendar', 'Divi Events Calendar', 'manage_options', 'woo-ms-options-dec', array($this, 'licence_deactivate_form')); 
                        
                    add_action('load-' . $hookID , array($this, 'load_dependencies'));
                    add_action('load-' . $hookID , array($this, 'admin_notices'));
                    
                    add_action('admin_print_styles-' . $hookID , array($this, 'admin_print_styles'));
                    add_action('admin_print_scripts-' . $hookID , array($this, 'admin_print_scripts'));
                }
                
            function admin_menu()
                {
                    if(!$this->licence->licence_key_verify())
                        $hookID   = add_options_page( 'Divi Events Calendar', 'Divi Events Calendar', 'manage_options', 'woo-options-dec', array($this, 'licence_form'));
                        else
                        $hookID   = add_options_page( 'Divi Events Calendar', 'Divi Events Calendar', 'manage_options', 'woo-options-dec', array($this, 'licence_deactivate_form'));
                        
                    add_action('load-' . $hookID , array($this, 'load_dependencies'));
                    add_action('load-' . $hookID , array($this, 'admin_notices'));
                    
                    add_action('admin_print_styles-' . $hookID , array($this, 'admin_print_styles'));
                    add_action('admin_print_scripts-' . $hookID , array($this, 'admin_print_scripts'));    
                    
                }
               
                
            function options_interface()
                {
                       
                     
                    if(!$this->licence->licence_key_verify() && !is_multisite())
                        {
                            $this->licence_form();
                            return;
                        }
                        
                    if(!$this->licence->licence_key_verify() && is_multisite())
                        {
                            $this->licence_multisite_require_nottice();
                            return;
                        }
          
                }
            
            function options_update()
                {
                    
                    if (isset($_POST['slt_licence_form_submit']))
                        {
                            $this->licence_form_submit();
                            return;
                        }
            
                }

            function load_dependencies()
                {

                }
                
            function admin_notices()
                {
                    global $slt_form_submit_messages;
            
                    if($slt_form_submit_messages == '')
                        return;
                    
                    $messages = $slt_form_submit_messages;
 
                          
                    if(count($messages) > 0)
                        {
                            echo "<div id='notice' class='updated fade'><p>". implode("</p><p>", $messages )  ."</p></div>";
                        }

                }
                  
            function admin_print_styles()
                {
                    wp_register_style( 'wooslt_admin', WOO_SLT_DEC_URL_DEC . '/license/css/admin.css' );
                    wp_enqueue_style( 'wooslt_admin' ); 
                }
                
            function admin_print_scripts()
                {

                }
            
            
            function admin_no_key_notices()
                {
                    if ( !current_user_can('manage_options'))
                        return;
                    
                    $screen = get_current_screen();
                        
                    if(is_multisite())
                        {
                            if(isset($screen->id) && $screen->id    ==  'settings_page_woo-ms-options-network-dec ') 
                                return;
                            ?><div class="updated fade"><p><?php _e( "The Divi Events Calendar license is inactive. Please ", 'wooslt' ) ?> <a href="<?php echo network_admin_url() ?>settings.php?page=woo-ms-options-dec"><?php _e( "enter your licence key", 'wooslt' ) ?></a>to receive updates and support.</p></div><?php
                        }
                        else
                        {
                            if(isset($screen->id) && $screen->id == 'settings_page_woo-options-dec')
                                return;
                            
                            ?><div class="updated fade"><p><?php _e( "The Divi Events Calendar license is inactive. Please ", 'wooslt' ) ?> <a href="options-general.php?page=woo-options-dec"><?php _e( "enter your licence key", 'wooslt' ) ?></a> to receive updates and support.</p></div><?php
                        }
                }

            function licence_form_submit()
                {
                    global $slt_form_submit_messages; 
                    
                    //check for de-activation
                    if (isset($_POST['slt_licence_form_submit']) && isset($_POST['slt_licence_deactivate']) && wp_verify_nonce($_POST['slt_dec_license_nonce'],'slt_dec_license')) // this var is set as well in form
                        {
                            global $slt_form_submit_messages;
                            
                            $license_data = get_site_option('slt_dec_license');                        
                            $license_key = $license_data['key'];

                            //build the request query
                            $args = array(
                                                'woo_sl_action'         => 'deactivate',
                                                'licence_key'           => $license_key,
                                                'product_unique_id'     => WOO_SLT_DEC_PRODUCT_ID_DEC,
                                                'domain'                => WOO_SLT_DEC_INSTANCE_DEC
                                            );
                            $request_uri    = WOO_SLT_DEC_APP_API_URL_DEC . '?' . http_build_query( $args , '', '&');
                            $data           = wp_remote_get( $request_uri );
                            
                            if(is_wp_error( $data ) || $data['response']['code'] != 200)
                                {
                                    $slt_form_submit_messages[] .= __('There was a problem connecting to ', 'wooslt') . WOO_SLT_DEC_APP_API_URL_DEC;
                                    return;  
                                }
                                
                            $response_block = json_decode($data['body']);
                            if(!is_array($response_block) || count($response_block) < 1){
                                $license_data = get_site_option('slt_dec_license'); 
                                            
                                //save the license
                                $license_data['key']          = '';
                                $license_data['last_check']   = time();
                                
                                update_site_option('slt_dec_license', $license_data);
                                $slt_form_submit_messages[] .= __('There was a problem connecting to ', 'wooslt') . WOO_SLT_DEC_APP_API_URL_DEC;
                                return;  
                            }
                            //retrieve the last message within the $response_block
                            $response_block = $response_block[count($response_block) - 1];
                            $response = $response_block->message;
                            
                            if(isset($response_block->status))
                                {
                                    if($response_block->status == 'success' && $response_block->status_code == 's201')
                                        {
                                            //the license is active and the software is active
                                            $slt_form_submit_messages[] = $response_block->message;
                                            
                                            $license_data = get_site_option('slt_dec_license');
                                            
                                            //save the license
                                            $license_data['key']          = '';
                                            $license_data['last_check']   = time();
                                            
                                            update_site_option('slt_dec_license', $license_data); 
                                        }
                                        
                                    else //if message code is e104  force de-activation
                                            if ($response_block->status_code == 'e002' || $response_block->status_code == 'e104')
                                                {
                                                    $license_data = get_site_option('slt_dec_license'); 
                                            
                                                    //save the license
                                                    $license_data['key']          = '';
                                                    $license_data['last_check']   = time();
                                                    
                                                    update_site_option('slt_dec_license', $license_data); 
                                                }
                                        else
                                        {
                                            $slt_form_submit_messages[] = __('There was a problem deactivating the license: ', 'wooslt') . $response_block->message;
                                     
                                            return;
                                        }   
                                }
                                else
                                {
                                    $slt_form_submit_messages[] = __('There was a problem with the data block received from ' . WOO_SLT_DEC_APP_API_URL_DEC, 'wooslt');
                                    return;
                                }
                                
                            //redirect
                            $current_url    =   'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            
                            wp_redirect($current_url);
                            die();
                            
                        }   
                    
                    
                    
                    if (isset($_POST['slt_licence_form_submit']) && wp_verify_nonce($_POST['slt_dec_license_nonce'],'slt_dec_license'))  
                        {
                            
                            $license_key = isset($_POST['license_key_dec'])? sanitize_key(trim($_POST['license_key_dec'])) : '';  

                            if($license_key == '')
                                {
                                    $slt_form_submit_messages[] = __("License Key can't be empty", 'wooslt');
                                    return;
                                }
                                
                            //build the request query
                            $args = array(
                                                'woo_sl_action'         => 'activate',
                                                'licence_key'       => $license_key,
                                                'product_unique_id'        => WOO_SLT_DEC_PRODUCT_ID_DEC,
                                                'domain'          => WOO_SLT_DEC_INSTANCE_DEC
                                            );
                            $request_uri    = WOO_SLT_DEC_APP_API_URL_DEC . '?' . http_build_query( $args , '', '&');
                            $data           = wp_remote_get( $request_uri );
                            
                            if(is_wp_error( $data ) || $data['response']['code'] != 200)
                                {
                                    $slt_form_submit_messages[] .= __('There was a problem connecting to ', 'wooslt') . WOO_SLT_DEC_APP_API_URL_DEC;
                                    return;  
                                }
                                
                            $response_block = json_decode($data['body']);

                            if(!is_array($response_block) || count($response_block) < 1){
                                $license_data = get_site_option('slt_dec_license'); 
                                            
                                //save the license
                                $license_data['key']          = '';
                                $license_data['last_check']   = time();
                                
                                update_site_option('slt_dec_license', $license_data);
                                $slt_form_submit_messages[] .= __('There was a problem connecting to ', 'wooslt') . WOO_SLT_DEC_APP_API_URL_DEC;
                                return;  
                            }
                            //retrieve the last message within the $response_block
                            $response_block = $response_block[count($response_block) - 1];
                            $response = $response_block->message;
                            
                            if(isset($response_block->status))
                                {
                                    if( $response_block->status == 'success' && ( $response_block->status_code == 's100' || $response_block->status_code == 's101' ) )
                                        {
                                            //the license is active and the software is active
                                            $slt_form_submit_messages[] = $response_block->message;
                                            
                                            $license_data = get_site_option('slt_dec_license');  
                                            
                                            //save the license
                                            $license_data['key']          = $license_key;
                                            $license_data['last_check']   = time();
                                            
                                            update_site_option('slt_dec_license', $license_data);  

                                        }
                                        else
                                        {
                                            $slt_form_submit_messages[] = __('There was a problem activating the license: ', 'wooslt') . $response_block->message;
                                            return;
                                        }   
                                }
                                else
                                {
                                    $slt_form_submit_messages[] = __('There was a problem with the data block received from ' . WOO_SLT_DEC_APP_API_URL_DEC, 'wooslt');
                                    return;
                                }
                                
                            //redirect
                            $current_url    =   'http' . (isset($_SERVER['HTTPS']) ? 's' : '') . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                            
                            wp_redirect($current_url);
                            die();
                        }   
                    
                }
                
            function licence_form()
                {
                    ?>
                        <div class="wrap"> 
                            <div id="icon-settings" class="icon32"></div>
                            <h2><?php _e( "Divi Events Calendar License", 'wooslt' ) ?><br />&nbsp;</h2>
                            
                            
                            <form id="form_data" name="form" method="post">
                                <div class="postbox">
                                    
                                        <?php wp_nonce_field('slt_dec_license','slt_dec_license_nonce');  // the nonce validated before updating ?>
                                        <input type="hidden" name="slt_licence_form_submit" value="true" />
                                           
                                        

                                         <div class="section section-text ">
                                            <h4 class="heading"><?php _e( "License Key", 'wooslt' ) ?></h4>
                                            <div class="option">
                                                <div class="controls">
                                                    <input type="text" value="" name="license_key_dec" class="text-input"> <!--the name attribute is appended a _dec-->
                                                </div>
                                                <div class="explain"><?php _e( "Enter the license key you received when purchased this product. You can access your license key any time by logging into your account on the Pee-Aye Creative website. You can learn more about this in our", 'wooslt' ) ?> <a href="https://www.peeayecreative.com/docs/product-license-key-management/" target="_blank"><?php _e( "License Key Management Guide", 'wooslt' ) ?></a>.<br />
                                                </div>
                                            </div> 
                                        </div>

                                    
                                </div>
                                
                                <p class="submit">
                                    <input type="submit" name="Submit" class="button-primary" value="<?php _e('Save', 'wooslt') ?>">
                                </p>
                            </form> 
                        </div> 
                    <?php  
     
                }
            
            function licence_deactivate_form()
                {
                    $license_data = get_site_option('slt_dec_license'); // the site option is set as well
                    
                    if(is_multisite())
                        {
                            ?>
                                <div class="wrap"> 
                                    <div id="icon-settings" class="icon32"></div>
                                    <h2><?php _e( "General Settings", 'wooslt' ) ?></h2>
                            <?php
                        }
                    
                    ?>
                        <div id="form_data">
                        <h2 class="subtitle"><?php _e( "Divi Events Calendar License", 'wooslt' ) ?></h2>
                        <div class="postbox">
                            <form id="form_data" name="form" method="post">    
                                <?php wp_nonce_field('slt_dec_license','slt_dec_license_nonce'); // the nonce field validated on submit ?>
                                <input type="hidden" name="slt_licence_form_submit" value="true" />
                                <input type="hidden" name="slt_licence_deactivate" value="true" />

                                 <div class="section section-text ">
                                    <h4 class="heading"><?php _e( "License Key", 'wooslt' ) ?></h4>
                                    <div class="option">
                                        <div class="controls">
                                            <?php  
                                                if($this->licence->is_local_instance())
                                                {
                                                ?>
                                                <p>Local instance, no key applied.</p>
                                                <?php   
                                                }
                                                else {
                                                ?>
                                            <p><b><?php echo substr($license_data['key'], 0, 20) ?>-xxxxxxxx-xxxxxxxx</b> &nbsp;&nbsp;&nbsp;<a class="button-secondary" title="Deactivate" href="javascript: void(0)" onclick="jQuery(this).closest('form').submit();">Deactivate</a></p>
                                            <?php } ?>
                                        </div>
                                                                            </div> 
                                </div>
                             </form>
                        </div>
                        </div> 
                    <?php  
     
                    if(is_multisite())
                        {
                            ?>
                                </div>
                            <?php
                        }
                }
                
            function licence_multisite_require_nottice()
                {
                    ?>
                        <div class="wrap"> 
                            <div id="icon-settings" class="icon32"></div>
                            <h2><?php _e( "General Settings", 'wooslt' ) ?></h2>

                            <h2 class="subtitle"><?php _e( "Divi Events Calendar License", 'wooslt' ) ?></h2>
                            <div id="form_data">
                                <div class="postbox">
                                    <div class="section section-text ">
                                        <h4 class="heading"><?php _e( "License Key Required", 'wooslt' ) ?>!</h4>
                                        <div class="option">
                                            <div class="explain"><?php _e( "Enter the license key you received when purchased this product. You can access your license key any time by logging into your account on the Pee-Aye Creative website. You can learn more about this in our", 'wooslt' ) ?> <a href="https://www.peeayecreative.com/docs/product-license-key-management/" target="_blank"><?php _e( "License Key Management Guide", 'wooslt' ) ?></a>.<br /> 
                                            </div>
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div> 
                    <?php
                
                }    

                
        }

                                   

?>