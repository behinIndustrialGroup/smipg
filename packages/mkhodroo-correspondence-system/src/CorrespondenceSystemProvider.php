<?php 

namespace Mkhodroo\CorrespondenceSystem;

use Illuminate\Support\ServiceProvider;

class CorrespondenceSystemProvider extends ServiceProvider
{
    public function register() {
        
    }

    public function boot() {
        $this->loadMigrationsFrom(__DIR__ . "/Migrations");
        $this->loadRoutesFrom(__DIR__. '/routes.php');;
        $this->loadViewsFrom(__DIR__. '/Views', 'CSViews');
    }
}