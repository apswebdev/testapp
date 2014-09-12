<?php

/* 
 * This is a simple DB Class
 */

class db{
    
    /**
     * DB Credentials
     * 
     * @param none
     * @return   
     */
    protected static $host = "localhost";
    protected static $user = "test";
    protected static $pass = "test";
    protected static $db = "testapp";
    protected static $admin_email = "anwar_saludsong@yahoo.com";

    /**
     * Connect to database
     * 
     * @param none
     * @return mixed db conn 
     */
    public static function connect() {

       mb_internal_encoding( 'UTF-8' );
       mb_regex_encoding( 'UTF-8' );
       $connection = new mysqli( self::$host, self::$user, self::$pass, self::$db );

       if (!$connection){
                self::log_db_errors( "Connect failed", $connection->error);
                exit;        
       } 
       
       return $connection;

    }
    
    /**
     * Email log errors upon connection
     * 
     * @param string error name
     * @param string error data
     * @return mixed email errors
     */
     protected static function log_db_errors( $error, $query ){
        
        define(ADMIN_EMAIL,self::$admin_email); 
        $message = '<p>Error at '. date('Y-m-d H:i:s').':</p>';
        $message .= '<p>Query: '. htmlentities( $query ).'<br />';
        $message .= 'Error: ' . $error;
        $message .= '</p>';
        
        if( self::$admin_email != "" ){
            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'To: Admin <'.ADMIN_EMAIL.'>' . "\r\n";
            $headers .= 'From: TESTAPP <system@'.$_SERVER['SERVER_NAME'].'.com>' . "\r\n";
            mail( ADMIN_EMAIL, 'Database Error', $message, $headers );
        
            
        } else {
            trigger_error( $message );
        }

    }

    
    /**
     * Set array as reference
     * 
     * @param array bind fields
     * @return array reference array
     */    
    protected static function set_reference($args=null){
        
        if(is_array($args)){
            $refs = array();
            foreach($args as $key =>$value)
                    $refs[$key] = &$args[$key];
            return $refs;
        } else {
            $refs = array();
            $refs[$args] = &$args;
            return $refs;
        }

    }
    

    /**
     * Execute binding mysql querries
     * 
     * @param array array of querries and fields
     * @param boolean if needed to return data
     * @return mixed if return is true, array of data wull be returned
     */
     public static function execute_query( $q = NULL, $return = false ){
        
        $connection = self::connect();
         
        if(empty($q)) return false;
        
        $query = mysqli_prepare($connection,$q["stmt"]);
        
        // another way to bind param but will use the other one instead.
        // call_user_func_array(array($query,'bind_param'), self::set_reference($q["fields"])); 
        // only bind if there is a binding string
        if(!empty($q["bind"])){
            call_user_func_array('mysqli_stmt_bind_param', array_merge (array($query, $q["bind"]), self::set_reference($q["fields"]))); 
        }
        
        if(mysqli_stmt_execute($query)){
            
            // if this query is to be executed only
            if($return === false){
                mysqli_close($connection); 
                return true;
            }
            
            //if this query will return an array of values
            else{
                $result = array();    
                $meta = $query->result_metadata();
                while ($field = $meta->fetch_field()) {
                                $params[] = &$row[$field->name];
                }
                call_user_func_array(array($query, 'bind_result'), $params);
                while ($query->fetch()) {
                                $temp = array();
                                foreach($row as $key => $val) {
                                                $temp[$key] = $val;
                                } 
                                $result[] = $temp;
                }

                $meta->free();
                $query->close(); 
                return $result;                
            }

        } else {
            mysqli_close($connection); 
            return false;
        }

    }
 
}




?>

