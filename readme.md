## elFinder Package for Laravel 4

### Installation

This project is a fork of: https://github.com/barryvdh/elfinder-bundle

Add this package to your composer.json and run composer update.
Add the ServiceProvider to the providers array in app/config/app.php

    'TSF\ElfinderLaravel\ElfinderServiceProvider'

You need to copy the assets to the public folder, using the following artisan command:

    php artisan asset:publish tsf/elfinder-laravel

You can now add the routes for elFinder to your routes.php

    Route::group(array('before' => 'auth'), function()
        {
            \Route::get('elfinder', 'TSF\ElfinderLaravel\ElfinderController@showIndex');
            \Route::any('elfinder/connector', 'TSF\ElfinderLaravel\ElfinderController@showConnector');
        });

Offcourse you can define your own filters/routes if you want.

### Configuration

The default configuration requires a directory called 'files' in the public folder. You can change this by publishing the config file.

    php artisan config:publish tsf/elfinder-laravel

In your app/config/packages/tsf/elfinder-laravel, you can change the default folder, the access callback or define your own roots.

### CKEditor

You can add CKEditor integration by adding the following route:

    \Route::get('elfinder/ckeditor', 'TSF\ElfinderLaravel\ElfinderController@showCKEditor');