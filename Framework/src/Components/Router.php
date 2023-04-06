<?php

namespace App\Components;

use App\Contracts\HTTPRequestInterface;
use App\Contracts\HTTPResponseInterface;
use App\Contracts\HTTPRouterInterface;

class Router implements HTTPRouterInterface
{
    /**
     * @param  HTTPRequestInterface  $request
     * @return HTTPResponseInterface
     */
    public function dispatch(HTTPRequestInterface $request): HTTPResponseInterface
    {
        $request->getMethod();
        dd($request->getUri());
    }

    public function getController()
    {

    }

    public function getRoute()
    {

    }
}
