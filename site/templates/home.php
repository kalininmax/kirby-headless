<?php

/* INTRO */
$intro = [
  'title' => $page->introTitle()->typograf(),
  'text'  => $page->introText()->kt()->typograf(),
];

$data = [
  'template' => $page->intendedTemplate()->name(),
  'slug'     => $page->isHomePage() ? '' : $page->slug(),
  'title'    => $page->title()->value(),
  'metadata' => $page->metadata(),
  'content'  => [
    'intro' => $intro,
  ],
];

echo json_encode($data, JSON_UNESCAPED_UNICODE);
