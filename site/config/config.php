<?php

return [
  'debug'    => env('KIRBY_DEBUG', false),
  'headless' => [
    'globalRoutes' => true,
    'token'        => env('KIRBY_API_TOKEN', 'fallback-token'),
    'panel'        => [
      'redirect'    => true,
      'frontendUrl' => env('FRONTEND_URL', 'https://example.com'),
    ]
  ],
  'panel' => [
    'install'      => env('ALLOW_INSTALL', false),
    'vue.compiler' => false,
    'css'          => 'assets/css/custom-panel.css',
  ],
  'routes' => [
    require __DIR__ . '/routes/globals.php',
    require __DIR__ . '/routes/sitemap.php',
  ],
];
