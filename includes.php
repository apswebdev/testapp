<?php

/*------------------------------------
 * define absolute path
 *------------------------------------*/
define('APATH', dirname('__FILE__'));

/*------------------------------------
 * Set path array
 *------------------------------------*/
$path = array(
            APATH . '/controller',
            APATH . '/objects',
            APATH . '/views',
            get_include_path()
        );

/*------------------------------------
 * include paths
 *------------------------------------*/
set_include_path(implode(PATH_SEPARATOR,$path));

/*------------------------------------
 * add required files here
 *------------------------------------*/
require_once 'object_country.php';
require_once 'object_utilities.php';
require_once 'object_db.php';
require_once 'control_viewer.php';

?>