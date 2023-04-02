<?php

namespace App\Contracts;

use App\Contracts\HTTPRequestInterface;
use App\Contracts\HTTPResponseInterface;

interface HTTPRouterInterface
{
    public function dispatch(HTTPRequestInterface $request): HTTPResponseInterface;
}
