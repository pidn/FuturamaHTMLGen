<?php
namespace FuturamaHTMLGen\App;

class Logger 
{
    public function __construct(){
        define( "LOGGER", true );
    }

    public static function dump( $msg, $label=null ) 
    {
        ob_start();
        echo "<pre>";
        if( $label ) {
            echo "### ".$label." ###"; 
        }
        var_dump( $msg );
        echo"</pre>";
        $output = ob_get_contents();
        ob_end_clean();
        echo $output;
    }

}