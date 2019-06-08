<?php

namespace BajomoDavid\JWTAuth;

use Illuminate\Support\ServiceProvider;

class JWTAuthServiceProvider extends ServiceProvider {
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        $this->publishes([
            // Config
            __DIR__.'/../config/BdJwt.php' => config_path('BdJwt.php'),
        ], 'bajomodavid/jwt-auth');
    }
    public function register()
    {

    }
}
