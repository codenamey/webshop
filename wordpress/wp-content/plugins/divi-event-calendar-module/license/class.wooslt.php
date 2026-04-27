<?php
    
    if ( ! defined( 'ABSPATH' ) ) { exit;}
    
    class WOO_SLT_DEC
        {
            var $licence;
            
            var $interface;
            
            /**
            * 
            * Run on class construct
            * 
            */
            function __construct( ) 
                {
                    $this->licence              =   new WOO_SLT_DEC_licence(); 

                    $this->interface            =   new WOO_SLT_DEC_options_interface();
                     
                }
                
              
        } 
    
    
    
?>