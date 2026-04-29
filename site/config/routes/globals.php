<?php

use Kirby\Http\Response;

return [
  'pattern' => '/globals',
  'method' => 'GET',
  'action' => function () {
    $data = [];

    return Response::json($data);
  }
];
