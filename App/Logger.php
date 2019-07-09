<?php
namespace FuturamaHTMLGen\App;
class Logger
{
    private function __construct()
    {
        if( !defined( "ABSPATH" ) )
        {
            wp_die( "Direct Access to this file Is prohibited" );
        }
    }
    private function __clone()
    {
    }
      
    private function __wakeup()
    {
    }
    public static function log($msg, $lbl=null)
    {
        ob_start();
        echo "### ".$lbl." ###".PHP_EOL;
        var_dump($msg);
        $output = ob_get_contents();
        ob_end_clean();
        error_log($output);
    }
    public static function dump($msg, $lbl=null)
    {
        ob_start();
        echo "<pre>";
        echo "### ".$lbl." ###".PHP_EOL;
        var_dump($msg);
        echo "</pre>";
        $output = ob_get_contents();
        ob_end_clean();
        echo($output);
    }
}