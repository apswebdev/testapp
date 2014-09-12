<?php

/* 
 * This is a simple DB Class
 */

class utility{
    
    
    /**
     * Email sender
     * 
     * @param string error name
     * @param string error data
     * @return mixed email errors
     */
    public static function email_data(){

        define(ADMIN_EMAIL,"anwar_saludsong@yahoo.com"); 
        $message = '<p>Error at '. date('Y-m-d H:i:s').':</p>';
        $message .= '<p>Query: '. htmlentities( $query ).'<br />';
        $message .= 'Error: ' . $error;
        $message .= '</p>';
        
        if( defined( 'SEND_ERRORS_TO' ) ){
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'To: Admin <'.ADMIN_EMAIL.'>' . "\r\n";
            $headers .= 'From: Yoursite <system@'.$_SERVER['SERVER_NAME'].'.com>' . "\r\n";
            mail( ADMIN_EMAIL, 'Database Error', $message, $headers );
        
            
        } else {
            trigger_error( $message );
        }
        
        if( !defined( 'DISPLAY_DEBUG' ) || ( defined( 'DISPLAY_DEBUG' ) && DISPLAY_DEBUG ) ) {
            echo $message;
        }
        
    }

    /**
     * Gets the base url of the website
     * 
     * @param none
     * @return string base url 
     */
    public static function get_base(){
        if(isset($_SERVER['HTTPS'])){
            $protocol = ($_SERVER['HTTPS'] && $_SERVER['HTTPS'] != "off") ? "https" : "http";
        }
        else{
            $protocol = 'http';
        }
        $host = $protocol . "://" . $_SERVER['HTTP_HOST'] ;
        
        $url = strtok($_SERVER["REQUEST_URI"],'?');
        $url = trim($url,"/");
        
        // lets parse again the url
        if(strpos($url,"/") > -1){
            $u = array("");
            $u = explode("/",$url);
            $base = $host ."/". $u[0]; 
        } else {
            $base = $host ."/". $url; 
        }
        
        return $base;
        
    }
 
}

?>

