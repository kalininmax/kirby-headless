<?php

$data = [
  'template' => $page->intendedTemplate()->name(),
  'slug' => $page->isHomePage() ? '' : $page->slug(),
  'title' => $page->title()->value(),
  'metadata' => $page->metadata(),
  'content' => [
    'title' => $page->title()->typograf(),
    'text' => $page->text()->kt()->typograf(),
  ],
];

echo json_encode($data, JSON_UNESCAPED_UNICODE);
