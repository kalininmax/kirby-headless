<?php

http_response_code(404);

$data = [
  'status'  => 'error',
  'code'    => 404,
  'message' => 'Page not found',
];

die(json_encode($data, JSON_UNESCAPED_UNICODE));
