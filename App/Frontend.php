<?php
namespace FuturamaHTMLGen\App;
use FuturamaHTMLGen\App\Logger;

class Frontend
{
    public function __construct() 
    {   
        
    }

    //header HTML
    public $header = "
    <!doctype html>

    <html lang='de'>

    <head>
    <meta charset='utf-8'>

    <title>P-Seminar Futurama</title>
    <meta name='description' content='P-Seminar Futurama'>
    <meta name='author' content='Marty + Piet'>

    <link rel='stylesheet' href='Assets/css/styles.css'>
    <link rel='stylesheet' href='Assets/css/bootstrap.min.css'></div>
    <script type='text/javascript' src='Assets/js/jquery_latest.min.js'></script>
    <script type='text/javascript' src='Assets/js/isotope.min.js'></script>
    <script src='Assets/js/scripts.js'></script>

    </head>
    <body>";

    //footer HTML
    public $footer = "
    </body>
    </html>";

    public function getHeader()
    {
        return $this->header;
    }

    public function getFooter()
    {
        return $this->footer;
    }

    //inhalt
    public $content = null;

    public function setContent( $content ) 
    {
        $this->content = $content;
    }

    public function render() {
        echo $this->header;
        echo $this->content;
        echo $this->footer;
    }

}