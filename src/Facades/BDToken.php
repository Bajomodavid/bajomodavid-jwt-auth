<?php

namespace BajomoDavid\JWTAuth\Facades;

use BajomoDavid\JWTAuth\Providers\Token;

use Illuminate\Support\Facades\Facade;

class BDToken extends Facade{

    protected static function getFacadeAccessor(){

        // return Token::class;
        return 'Token';
    }
}
