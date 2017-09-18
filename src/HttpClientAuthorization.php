<?php

namespace Leocata\M1;

use Http\Message\Authentication\BasicAuth;
use Psr\Http\Message\RequestInterface;

class HttpClientAuthorization
{

    public function __construct($username, $password, RequestInterface $request)
    {
        $auth = new BasicAuth($username, $password);
        $auth->authenticate($request);

        return
    }
}