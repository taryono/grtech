<?php

namespace Lib; 

/**
 * ServiceProvider
 *
 * The service provider for the modules. After being registered
 * it will make sure that each of the modules are properly loaded
 * i.e. with their routes, views etc.
 *
 * @author Kamran Ahmed <kamranahmed.se@gmail.com>
 * @package App\Modules
 */
class LibServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function boot()
    { 
        setlocale(LC_TIME, 'id');
    }

    public function register()
    {
    }
}
