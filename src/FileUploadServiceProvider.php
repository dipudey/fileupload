<?php

namespace Dipudey\Fileupload;

use Illuminate\Support\ServiceProvider;

class FileUploadServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/fileupload.php' => config_path('fileupload.php'),
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/fileupload.php',
            'fileupload'
        );

        $this->app->config['filesystems.disks.fileupload'] = config('fileupload.disk');

        $this->app->bind('fileupload', function () {
            return new FileUpload();
        });
    }
}
