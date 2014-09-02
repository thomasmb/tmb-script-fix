<?php
/*
Plugin Name: TMB Script Fix
Plugin URI: http://www.bensmann.no
Description: Remove script type and add async
Version: 0.1
Author: Thomas Bensmann
Author URI: http://www.bensmann.no
*/

if( !class_exists('TMB_JS_TYPE_FIX') ){

	class TMB_JS_TYPE_FIX{
	
		function __construct(){
			add_action( 'wp_footer', array( __CLASS__, 'setup_ob_change' ), 11 );
		}
	
		public static function remove_js_type( $a ){
			$a = preg_replace('/\stype=(\"|\')text\/javascript(\"|\')/', '', $a);
			return str_replace('></script>', apply_filters( "tmb_js_replace", "async></script>", $a ), $a);
		}
		
		public static function setup_ob_change(){
			ob_start( array( __CLASS__, 'remove_js_type' ) );
		}
	
	}
	
	new TMB_JS_TYPE_FIX;

}