<?php

use Lcobucci\JWT\Builder;

Class Token {

    public function makeToken($user)
    {
        $time = time();
        $token = (new Builder())->issuedBy(env('APP_URL')) // Configures the issuer (iss claim)
                        ->permittedFor(env('APP_URL')) // Configures the audience (aud claim)
                        ->identifiedBy('4f1g23a12aa', true) // Configures the id (jti claim), replicating as a header item
                        ->issuedAt($time) // Configures the time that the token was issue (iat claim)
                        ->canOnlyBeUsedAfter($time + 60) // Configures the time that the token can be used (nbf claim)
                        ->expiresAt($time + 3600) // Configures the expiration time of the token (exp claim)
                        ->withClaim('uid', 1) // Configures a new claim, called "uid"
                        ->getToken(); // Retrieves the generated token
        return $token;
    }
}
