<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Components\DIContainer;
use App\Contracts\HTTPRequestInterface;
use App\Http\HTTPKernel;
use App\Http\Request;

$request = new Request(microtime());

$container = DIContainer::getInstance(require_once __DIR__ . '/../config/di-container.php');

$container->register(HTTPRequestInterface::class, $request);

$kernel = $container->build(HTTPKernel::class);

$response = $kernel->handle();

$response->send();
