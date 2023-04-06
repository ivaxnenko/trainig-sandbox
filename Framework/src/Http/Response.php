<?php

namespace App\Http;

use App\Contracts\HTTPResponseInterface;

class Response implements HTTPResponseInterface
{
    private array $body;

    /**
     * @return Response
     */
    public function sendHeaders(): Response
    {
        if (headers_sent()) {
            return $this;
        }

        header('Content-Type: application/json; charset=utf-8');

        return $this;
    }

    /**
     * @return Response
     */
    public function sendContent(): Response
    {
        echo json_encode($this->body);

        return $this;
    }

    /**
     * @return Response
     */
    public function send(): Response
    {
        $this
            ->sendHeaders()
            ->sendContent();

        fastcgi_finish_request();

        return $this;
    }
}
