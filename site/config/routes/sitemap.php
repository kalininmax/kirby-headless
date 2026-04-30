<?php

use Kirby\Http\Response;

return [
  'pattern' => '/sitemap',
  'method'  => 'GET',
  'action'  => function () {
    $site = site();
    $list = [];

    foreach ($site->children()->listed() as $page) {
      if ($page->uri() === 'home') {
        continue;
      }

      $list[] = [
        'href' => '/' . $page->uri(),
      ];

      if ($page->children()->listed()->count() > 0) {
        foreach ($page->children()->listed() as $child) {
          $list[] = [
            'href' => '/' . $child->uri(),
          ];
        }
      }
    }

    return Response::json($list);
  }
];
