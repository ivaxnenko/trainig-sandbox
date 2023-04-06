<?php

namespace App\Components;

use App\Http\ResponseTypes\JsonResponse;
use App\Contracts\HTTPRouterInterface;
use App\Contracts\HTTPRequestInterface;
use App\Contracts\HTTPResponseInterface;

class Router implements HTTPRouterInterface
{
    /**
     * @param  HTTPRequestInterface  $request
     * @return HTTPResponseInterface
     */
    public function dispatch(HTTPRequestInterface $request): HTTPResponseInterface
    {
        if ($request->isGet()) {
            $response = new JsonResponse();
            $response->data['body'] = $request->get();
            return $response;
        }
    }

    public function getController()
    {

    }

    public function getRoute()
    {

    }
}
