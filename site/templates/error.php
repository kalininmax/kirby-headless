<?php

$isActualError = kirby()->request()->path()->toString() !== $page->id();

if ($isActualError) {
  http_response_code(404);

  $data = [
    'status' => 'error',
    'code' => 404,
    'message' => 'Page not found',
  ];

  die(json_encode($data, JSON_UNESCAPED_UNICODE));
}

$data = [
  'template' => $page->intendedTemplate()->name(),
  'slug' => $page->isHomePage() ? '' : $page->slug(),
  'title' => $page->title()->value(),
  'metadata' => $page->metadata(),
  'content' => [
    'title' => $page->contentTitle()->typograf(),
    'text' => $page->contentText()->kt()->typograf(),
  ],
];

echo json_encode($data, JSON_UNESCAPED_UNICODE);
