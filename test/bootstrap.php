<?php
define('__VERSION__', '1.0');
define('__ROOT__', __DIR__);

date_default_timezone_set('UTC');
setlocale(LC_ALL, 'en_US.UTF8');
mb_http_output('UTF-8');
mb_internal_encoding('UTF-8');

require_once __DIR__ . '/../vendor/autoload.php';