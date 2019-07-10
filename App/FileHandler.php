<?php
namespace FuturamaHTMLGen\App;
use FuturamaHTMLGen\App\Logger;

class FileHandler
{
    public function __construct() 
    {

    }

    protected $files = null;

    public function getFiles( $dir ) 
    {
        $this->files = $this->readDir( $dir );
        return $this->files;
    }

    protected function readDir( $dir ) {
        $files = scandir( $dir );
        $files = array_splice( $files, 2 );
        $this->files = $files;
        return $this->files;
    }

    public function exportData( $data )
    {
        $handle = fopen( "Export/index.html", "w" );
        fwrite( $handle, $data );
        return;
    }
}