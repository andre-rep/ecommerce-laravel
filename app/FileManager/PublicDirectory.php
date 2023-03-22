<?php

namespace App\FileManager;

use Illuminate\Http\Request;

class PublicDirectory
{
    private $folder;

    public function __construct($folder)
    {
        $this->folder = $folder;
    }

    public function fileUpload($file = '')
    {   
        $file->move($this->folder, $file->getClientOriginalName());
        return $this->folder . $file->getClientOriginalName();
    }
}