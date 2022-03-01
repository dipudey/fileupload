<?php

namespace Dipudey\Fileupload;

use Dipudey\Fileupload\Exception\FileNotFoundException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class FileUpload
{
    protected $dir = null;
    protected $base64 = null;
    protected $file = null;
    protected $fileName = null;
    protected $previousPath = null;

    public function base64File($base64)
    {
        $this->base64 = $base64;
        return $this;
    }

    public function file($file)
    {
        $this->file = $file;
        return $this;
    }

    public function directory($dir)
    {
        $this->dir = $dir;
        return $this;
    }

    public function fileName($fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function deletePreviousFile($path)
    {
        $this->previousPath = $path;
        return $this;
    }

    protected function getUploadDirectory()
    {
        $uploadDirectoryName = config("fileupload.upload_directory") . "/" . $this->dir . "/" . date("Y") . "/" . date("m") . "/" . date("d");
        return Str::replace("//", '/', $uploadDirectoryName);
    }

    public function save()
    {
        $path = $this->getUploadDirectory();

        if (!$this->file && !$this->base64) {
            throw new FileNotFoundException("Not found any file");
        }

        if ($this->previousPath && Storage::disk('fileupload')->exists($this->previousPath)) {
            Storage::disk('fileupload')->delete($this->previousPath);
        }

        if ($this->file) {
            return Storage::disk('fileupload')->put($path, $this->file);
        }

        if ($this->base64) {
            Storage::disk('fileupload')->put($this->decodeBase64(), base64_decode(str_replace(' ', '+', str_replace(substr($this->base64, 0, strpos($this->base64, ',') + 1), '', $this->base64))));
            return $this->decodeBase64();
        }
    }

    private function decodeBase64()
    {
        if ($this->fileName) {
            return $this->getUploadDirectory() . "/" . $this->fileName;
        }
        return $this->getUploadDirectory() . "/" . uniqid() . "." . explode('/', explode(':', substr($this->base64, 0, strpos($this->base64, ';')))[1])[1];;
    }
}
