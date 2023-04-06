<?php

namespace App\Http;

use App\Contracts\HTTPRequestInterface;
use Exception;

class Request implements HTTPRequestInterface
{
    private array $getAttributes;
    private array $postAttributes;
    private array $serverAttributes;
    public string $time;

    public function __construct(string $microtime)
    {
        $this->getAttributes = filter_input_array(INPUT_GET) ?? [];
        $this->postAttributes = filter_input_array(INPUT_POST) ?? [];
        $this->serverAttributes = filter_input_array(INPUT_SERVER) ?? [];

        $this->time = $microtime;
    }

    public function get(): array
    {
        return $this->getAttributes;
    }

    public function post(): array
    {
        return $this->postAttributes;
    }

    public function server(): array
    {
        return $this->serverAttributes;
    }

    public function isGet(): bool
    {
        return $this->server()['REQUEST_METHOD'] === 'GET';
    }

    public function isPost(): bool
    {
        return $this->server()['REQUEST_METHOD'] === 'POST';
    }

    public function getMethod(): string
    {
        return $this->server()['REQUEST_METHOD'];
    }

    public function getUri(): string
    {
        return $this->server()['REQUEST_URI'];
    }

    public function resolve()
    {

        throw new Exception('Route not found');
    }
}
