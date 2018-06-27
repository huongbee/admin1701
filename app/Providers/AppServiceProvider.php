<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layout',function($view){
            
            $menu = \DB::select("SELECT url.url, menu.name,             menu.icon,  GROUP_CONCAT(sub.name, '::' ,sub.url ) as submenu 
                FROM (
                    SELECT * FROM `categories` WHERE id_parent IS NULL
                ) menu 
                LEFT JOIN ( 
                    SELECT c.*, url.url 
                    FROM `categories` c 
                    INNER JOIN page_url url ON url.id = c.id_url 
                    WHERE c.id_parent IS NOT NULL 
                ) sub 
                ON menu.id = sub.id_parent 
                INNER JOIN page_url url 
                ON url.id = menu.id_url 
                GROUP BY menu.name,url.url
                ORDER BY submenu DESC");

            $view->with('menu',$menu);
        }) ;
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
