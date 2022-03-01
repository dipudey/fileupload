<?php

namespace Dipudey\Fileupload\Facade;

use Illuminate\Support\Facades\Facade;

class FileUpload extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'fileupload';
    }
}
