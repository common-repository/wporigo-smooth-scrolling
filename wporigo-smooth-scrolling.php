<?php 
/*
Plugin Name: WPOrigo Smooth Scrolling
Plugin URI: http://wporigo.com/wporigo-smooth-scrolling
Description: Smooth Scrolling plugin for Wordpress.
Author: Elod Horvath
Version: 1.0.3
Author URI: http://wporigo.com
License: http://www.gnu.org/licenses/gpl.html
Copyright &copy; 2014 Elod Horvath
*/

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) {
	exit;
}


define('WPORIGO_SSP_PATH', plugin_dir_path( __FILE__ ));
define('WPORIGO_SSP_URL', plugins_url() . '/wporigo-smooth-scrolling');

require( 'lib/actions.php' );

?>
