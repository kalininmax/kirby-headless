<?php

use Kirby\Cms\Url;

Kirby::plugin('sp/custom-methods', [
  'fieldMethods' => [
    'typograf' => function ($field) {
      $t = new \Akh\Typograf\Typograf();
      return $t->apply($field->value);
    },
  ],

  'fileMethods' => [
    'getImageData' => function () {
      if ($this->type() !== 'image') {
        return null;
      }

      return [
        'src' => $this->url(),
        'width' => $this->width(),
        'height' => $this->height(),
        'alt' => $this->alt()->value(),
      ];
    }
  ],

  'pageMethods' => [
    'metadata' => function () {
      $page = $this;
      $site = site();

      $title = $page->metaTitle()->or($page->title())->value();

      $description = $page->metaDescription()->or($site->metaDescription())->value();

      $keywords = $page->metaKeywords()->or($site->metaKeywords())->value();

      $image = $page->metaOgImage()->toFile()?->getImageData();

      if (!$image) {
        $image = $site->metaOgImage()->toFile()?->getImageData();
      }

      return [
        'title' => $title,
        'description'=> $description,
        'keywords' => $keywords,
        'image' => $image
      ];
    },
  ],
]);
