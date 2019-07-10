<?php
namespace FuturamaHTMLGen\App;
use FuturamaHTMLGen\App\Logger;
use FuturamaHTMLGen\App\Frontend;
use FuturamaHTMLGen\App\FileHandler;


class RunControl
{
    public function __construct() 
    {   
        $this->frontend = new Frontend();
        $this->initFileH();
        $this->generateOutput();
        $this->generateForm();
        $this->display();
    }

    protected $directory = "Assets/mp4";
    protected $frontend;
    protected $output;
    protected $fileHandler;
    protected $exForm;
    protected $str_filter = array(
        ":",
        "/",
        " ",        
    );
    
    protected function initFileH() 
    {
        $this->fileHandler = new FileHandler();
    }

    protected function display()     {
        
        $this->frontend->setContent( $this->output );
        $this->frontend->render();    
    }

    protected function generateOutput()
    {
        $this->output = null;
        //<img class='fgen_top_bg' src='./Assets/img/logo2.png'>
        $this->output = "
        <div class='fgen_intro_container'>
        <video autoplay muted class='fgen_intro_video' src='./Assets/intro/Intro.mp4'>
        <source src='./Assets/intro/Intro.mp4' type='video/mp4'>
        Euer Browser ist Scheiße, bitte Chrome oder Firefox</video>
        </div>";

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
                        <div class='fgen_txt'>".htmlentities($txt).".</div>
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
            
            $active = $class == ".astrophysik" ? " active" : "";
            $result .= "
            <div class='filter_item ".$class.$active."' data-filter='".$class."'>".$thema."</div>";  
        }
        return $result;
    }

    private function generateForm()
    {
        if( !isset($_POST['fgen_hidden']) )
        {   
            Logger::dump( $_POST );
            $result = "
            <form name='fgen_export_form' method='post' >
            <input type='hidden' value='fgen_do_export' name='fgen_hidden'>
            <input type='submit' value='Export'>
            </form>";
            $this->exForm = $result;    
        } else {
            $header = $this->frontend->getHeader();
            $footer = $this->frontend->getFooter();
            $toExport = $header.$this->output.$footer;
            $this->fileHandler->exportData( $toExport );
            $result = "Daten exportiert";
            $this->exForm = $result;
        }
    }
}