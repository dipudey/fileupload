# Fileupload Package

Laravel file uploader package

###### Installation

> composer require dipudey/fileupload


###### Usage

```
use Dipudey\Fileupload\FileUpload;

$path = (new FileUpload)
        ->file($request->file) // Normal file request store
        ->base64File($request->file) // or base64 file request store
        ->directory('dipudey') // file store directory
        ->fileName('dipu.png') // file name set
        ->deletePreviousFile($previousPath) // Delete old file->
        ->save();
```

or 

```
use Dipudey\Fileupload\Facade\FileUpload;

$path = FileUpload::file($request->file) // Normal file request store
        ->base64File($request->file) // or base64 file request store
        ->directory('dipudey') // file store directory
        ->fileName('dipu.png') // file name set
        ->deletePreviousFile($previousPath) // Delete old file->
        ->save();
```

###### Security
If you find any security related issues, please email dipuchundradey@gmail.com instead of using the issue tracker.
