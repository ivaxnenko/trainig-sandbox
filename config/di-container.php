<?php

use App\Components\Router;
use App\Http\Request;
use App\Http\Response;
use App\Contracts\HTTPRequestInterface;
use App\Contracts\HTTPResponseInterface;
use App\Contracts\HTTPRouterInterface;

return [
    HTTPRequestInterface::class => Request::class,
    HTTPResponseInterface::class => Response::class,
    HTTPRouterInterface::class => Router::class,
];
