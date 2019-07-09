<?php
namespace FuturamaHTMLGen\App;
use FuturamaHTMLGen\App\Logger;
use FuturamaHTMLGen\App\Frontend;
use FuturamaHTMLGen\App\FileHandler;


class RunControl
{
    public function __construct() 
    {   
        $this->getFileList();
        $this->generateOutput();
        $this->display();
    }

    protected $directory = "Assets/mp4";
    protected $frontend;
    protected $output;
    protected $fileHandler;
    protected $str_filter = array(
        ":",
        "/",
        " ",        
    );
    
    protected function getFileList() 
    {
        $this->fileHandler = new FileHandler();
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

        //loop through directory, build themen array 
        foreach( $this->fileHandler->getFiles( $this->directory ) as $file ) {
            $themen[] = $file;
        }

        //filter wrapper opening tag
        $this->output .= "<div class='filter_container'>";

        //generate filters from directory
        $this->output .= $this->generateFilters( $themen );

        //filter wrapper closing tag
        $this->output .= "</div>";

        //grid wrapper opening tag 
        $this->output .= "<div class='grid'>";
        
        //generate grid items
        $this->output .= $this->generateItems( $themen );   
        
        //grid wrapper closing tag 
        $this->output .= "</div>";
        
    }

    private function generateItems( $themen ) 
    {
        $output = null;
        foreach( $themen as $thema )
        {
            $dir = $this->directory."/".$thema;            
            $filter = strtolower( $this->formatStr( $thema ) );
            $files = $this->fileHandler->getFiles( $dir ) ;
            array_pop( $files );
            foreach( $files as $file )
            {
                $array = explode( "_", $file );
                $season = $array[1];
                $episode = $array[2]; 
                $fileName = explode( ".", $array[3] );  
                $txt = $fileName[0];
                $ext = $fileName[1];
                $src = "./Assets/mp4/".$thema."/".$file;                 
                $output .= "
                <div class='grid-item ".$filter."' data-txt='".$txt."' data-season='".$season."' data-episode='".$episode."'> 
                    <video class='fgen_video' height='150px' width='250px' src='".$src."' controls>Video</video>
                    <div class='info_container'>
                        <div class='fgen_season'>Staffel: ".$season."</div>
                        <div class='fgen_episode'>Episode: ".$episode."</div>
                        <div class='fgen_txt'>".$txt."</div>
                    </div>
                </div>";
            }
        }
        return $output;
    }

    private function formatStr( $string )
    {
        $result = strtolower(str_replace( $this->str_filter, "_", $string ));
        return $result;
    }

    private function generateFilters( $themen )
    {
        $result = null;
        foreach( $themen as $thema )
        {
            $class = ".".$this->formatStr( $thema );
            $result .= "
            <div class='filter_item ".$class."' data-filter='".$class."'>".$thema."</div>";  
        }
        return $result;
    }
}