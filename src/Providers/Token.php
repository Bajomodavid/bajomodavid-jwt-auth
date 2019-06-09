<?php

namespace BajomoDavid\JWTAuth\Providers;

use Lcobucci\JWT\Builder;
use Lcobucci\JWT\Signer\Key;
use Lcobucci\JWT\Signer\Hmac\Sha256;

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
}
