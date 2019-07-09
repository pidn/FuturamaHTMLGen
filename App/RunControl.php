<?php
namespace FuturamaHTMLGen\App;
use FuturamaHTMLGen\App\Logger;
use FuturamaHTMLGen\App\Frontend;
use FuturamaHTMLGen\App\FileHandler;


class RunControl
{
    public function __construct() 
    {   
        $this->getFileList( $this->directory );
        $this->generateOutput();
        $this->display();
    }

    protected $directory = "FuturamaHTMLGen/Assets/mp4";
    protected $frontend;
    protected $output;
    protected $fileHandler;
    
    protected function getFileList( $dir ) 
    {
        $this->fileHandler = new FileHandler( $dir );
    }

    protected function display() 
    {
        $this->frontend = new Frontend();
        $this->frontend->setContent( $this->output );
        $this->frontend->render();    
    }

    protected function generateOutput()
    {
        $this->output = null;

        $this->output .= "
                            <div class='headline'>
                            <h4>P-Seminar Futurama</h4>
                            </div>";

        $this->output .= "
        <p>Font Test 1</p>
        <div class='font_test_1'>ABCEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz</div>";


        foreach( $this->fileHandler->getFiles() as $file ) {
            $themen[] = $file;
        }

        $this->output .= $this->generateMenu( $themen );        
    }

    public function generateMenu( $themen ) {
        $output = null;

        foreach( $themen as $thema ) {
            $output .= "
            <a class='video_link'><button class='futurama_btn' data-thema='".$thema."'>".$thema."</button></a>";
        }
        
        return $output;

    }

    

    

}