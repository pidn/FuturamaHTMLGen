<?php
/**
 * Plugin Name: P-Seminar HTML Generator für Sticks
 * Version: 0.0.1
 * Author: Peter Schöpp & Martina Herzog
 * Author URI: https://www.pswebstuff.de
 * GPL2
 */

namespace FuturamaHTMLGen;
use FuturamaHTMLGen\App\Logger;
use FuturamaHTMLGen\App\Frontend;
use FuturamaHTMLGen\App\RunControl;

if ( ! class_exists( 'FuturamaHTMLGen' ) ) :

	define( "plugin-file", __FILE__, true );
	define( "plugin-dir", __DIR__, true );
	error_reporting(E_ALL);
	ini_set('display_errors', 1);
	

	class FuturamaHTMLGen
  {

		public function __construct() 
		{
			spl_autoload_register(array($this, 'loadClass'));
			$run = new RunControl;			
		}

		public function loadClass( $className ) 
		{
			if ( false !== strpos( $className, 'FuturamaHTMLGen' ) ) {
				$class = str_replace( '\\', '/', $className ) . '.php';
				$class = str_replace( 'FuturamaHTMLGen/', '', $class );
				require_once $class;
			}
		}

	}
	
	new FuturamaHTMLGen();

endif;









