<?php

namespace App\Http\ResponseTypes;

use App\Http\Response;

class JsonResponse extends Response
{
    public array $data;
}
