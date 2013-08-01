<?php

namespace TSF\ElfinderLaravel;

class ElfinderController extends \BaseController {

    public function showIndex()
    {

        $dir = 'packages/tsf/elfinder-laravel';
        $locale = \Config::get('app.locale');

        if (!file_exists(public_path()."/$dir/js/i18n/elfinder.$locale.js"))
            $locale = false;

        return \View::make('elfinder-laravel::elfinder')->with(compact('dir', 'locale'));
    }

    public function showCKEditor()
    {

        $dir = 'packages/tsf/elfinder-laravel';
        $locale = \Config::get('app.locale');
        if(!file_exists(public_path()."/$dir/js/i18n/elfinder.$locale.js")){
            $locale = false;
        }
        return \View::make('elfinder-laravel::ckeditor')->with(compact('dir', 'locale'));
    }

    public function showConnector()
    {
        $dir = \Config::get('elfinder-laravel::dir');
        $roots = \Config::get('elfinder-laravel::roots');

        if(!$roots)
        {
            $roots = array(
                array(
                    'driver'        => 'LocalFileSystem',                       // driver for accessing file system (REQUIRED)
                    'path'          => public_path().DIRECTORY_SEPARATOR.$dir,  // path to files (REQUIRED)
                    'URL'           => asset($dir),                             // URL to files (REQUIRED)
                    'accessControl' => \Config::get('elfinder-laravel::access') // filter callback (OPTIONAL)
                )
            );
        }

        // Documentation for connector options:
        // https://github.com/Studio-42/elFinder/wiki/Connector-configuration-options
        $opts = array(
            'roots' => $roots
        );

        // run elFinder
        $connector = new \elFinderConnector(new \elFinder($opts));
        $connector->run();
    }
}
