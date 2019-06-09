<?php

namespace BajomoDavid\JWTAuth\Facades;

use Illuminate\Support\Facades\Facade;

class BDUser extends Facade{

    protected static function getFacadeAccessor(){

        return 'BDUser';
    }
}
