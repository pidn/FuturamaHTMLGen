<?php
namespace FuturamaHTMLGen\App;
use FuturamaHTMLGen\App\Logger;

class FileHandler
{
    public function __construct( $dir ) 
    {
        $this->readDir( $dir );
    }

    protected $files = null;

    public function getFiles() 
    {
        return $this->files;
    }

    protected function readDir( $dir ) {
        $files = scandir( $dir );
        $files = array_splice( $files, 2 );
        $this->files = $files;
    }
}