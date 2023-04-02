<?php

namespace App\Http;

use App\Contracts\HTTPRouterInterface;
use App\Contracts\HTTPRequestInterface;
use App\Contracts\HTTPResponseInterface;
use Exception;

class HTTPKernel
{
    private HTTPRequestInterface $request;
    private HTTPResponseInterface $response;
    private HTTPRouterInterface $router;

    public function __construct(
        HTTPRequestInterface $request,
        HTTPResponseInterface $response,
        HTTPRouterInterface $router
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->router = $router;
    }

    /**
     * @return Response
     */
    public function handle(): Response
    {
        $this->response = $this->router->dispatch($this->request);

        return $this->response;
    }
}
