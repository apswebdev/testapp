<?php

/* 
 * This is the main driving file
 * This will instantiate everything
 */
require_once 'includes.php';

/*
 * start processing, just check if ie lower than 7
 */
if(preg_match('/(?i)msie [1-7]/',$_SERVER['HTTP_USER_AGENT'])){
    echo "<h3 style='color:white; font-family:arial; float:left; margin:20px'>Sorry for the inconvinience but it is highly recommended to use IE 8 and up for viewing this site.<br>Your current browser does not support the latest standards in IE.<br>Please upgrade your IE or use this suggested browsers:<br>Firefox, Chrome, Opera, and Safari.<br>Thank You and God Bless.<br><br> - Anwar ( website owner and creator )</h3>";    
} else {
    display_screen::start();
}
?>
