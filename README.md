﻿# bajomodavid-jwt-auth

A simple jwt-auth package for laravel

install package composer require bajomodavid/jwt-auth

Then add middleware 'bd.auth' => \BajomoDavid\JWTAuth\Middleware\CheckToken::class, under the protected $routeMiddleware in your App\Http\Kernel.php file, and then use the middleware in any routes you would like to protect with jwt
