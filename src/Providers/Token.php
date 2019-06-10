<?php

namespace BajomoDavid\JWTAuth\Providers;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;
use Lcobucci\JWT\ValidationData;
use Lcobucci\JWT\Parser;
use Illuminate\Http\Request;

Class Token {

    public function __construct()
    {
        $this->signer = new Sha256();
        $this->time = time();
        $this->key = env('APP_KEY');

    }

    public function make($user, $time = 1)
    {
        $time = 3600 * 24 * $time;

        $token = (new Builder())->setIssuedAt(time())
                        ->setExpiration($this->time + $time) // maximum: 600s
                        ->setIssuer(env('APP_NAME')) // App ID
                        ->set('payload', $user)
                        ->sign($this->signer, $this->key)
                        ->getToken();
                        $token->getHeaders();
                        $token->getClaims();

        return (string) $token;
    }

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

    public function user()
    {
        if(!request()->user) return null;
        return request()->user;
    }
}
