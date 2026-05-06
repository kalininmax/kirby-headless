<?php

require 'kirby/bootstrap.php';

require __DIR__ . '/site/config/env.php';

echo (new Kirby)->render();
