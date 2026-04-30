<?php

use Kirby\Http\Response;

return [
  'pattern' => ['globals', '(:any)/globals'],
  'method'  => 'GET',
  'action'  => function ($languageCode = null) {
    $kirby = kirby();
    $site  = site();

    if ($languageCode) {
      $kirby->setCurrentLanguage($languageCode);
    }

    $data = [
      'metadata' => $site->metadata(),
      'socials'  => $site->socials()->toStructure()->map(fn($social) => [
        'id'   => (int)$social->id(),
        'name' => $social->name()->value(),
        'url' => $social->url()->value(),
      ])->values(),
    ];

    return Response::json($data);
  }
];
