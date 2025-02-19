<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DISK', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "sftp", "s3"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
            'throw' => true,
        ],

        'image-uploads' => [
            'driver' => 'local',
            'root' => storage_path('app/image-uploads'),
            'url' => env('APP_URL').'/image-uploads',
            'visibility' => 'public',
            'throw' => true,
        ],

        'sliders' => [
            'driver' => 'local',
            'root' => storage_path('app/sliders'),
            'url' => env('APP_URL').'/sliders',
            'visibility' => 'public',
        ],

        'featured-images' => [
            'driver' => 'local',
            'root' => storage_path('app/featured-images'),
            'url' => env('APP_URL').'/featured-images',
            'visibility' => 'public',
        ],

        'announcement-files' => [
            'driver' => 'local',
            'root' => storage_path('app/announcement-files'),
            'url' => env('APP_URL').'/announcement-files',
            'visibility' => 'public',
        ],

        'event-images' => [
            'driver' => 'local',
            'root' => storage_path('app/event-images'),
            'url' => env('APP_URL').'/event-images',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
            'endpoint' => env('AWS_ENDPOINT'),
        ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Symbolic Links
    |--------------------------------------------------------------------------
    |
    | Here you may configure the symbolic links that will be created when the
    | `storage:link` Artisan command is executed. The array keys should be
    | the locations of the links and the values should be their targets.
    |
    */

    'links' => [
        public_path('storage') => storage_path('app/public'),
        public_path('image-uploads') => storage_path('app/image-uploads'),
        public_path('sliders') => storage_path('app/sliders'),
        public_path('featured-images') => storage_path('app/featured-images'),
        public_path('announcement-files') => storage_path('app/announcement-files'),
        public_path('event-images') => storage_path('app/event-images'),
    ],

];
