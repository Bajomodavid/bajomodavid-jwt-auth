<?php

namespace BajomoDavid\JWTAuth\Validators;

use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;
use Lcobucci\JWT\Signer\Hmac\Sha256;

class Authenticate {

    public static function check($token)
    {
        $signer = new Sha256();
        $time = time();
        $key = env('APP_KEY');

        $token = (new Parser())->parse((string) $token); // Parses from a string
        $data = new ValidationData(); // It will use the current time to validate (iat, nbf and exp)
        $data->setIssuer(env('APP_NAME'));

        return $token->validate($data);
    }

    public static function getUser($token)
    {
        $token = (new Parser())->parse((string) $token); // Parses from a string

        if(Authenticate::check($token) == true) return $token->getClaim('payload');

        return null;
    }
}
