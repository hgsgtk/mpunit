<?php declare(strict_types=1);

require __DIR__ . '../vendor/autoload.php';

// https://www.php.net/manual/ja/function.include.php
$testing = include __DIR__ . '/bootstrap.php';
// https://www.php.net/manual/ja/function.chdir.php
chdir(__DIR__);

// https://www.php.net/manual/ja/function.glob.php
foreach (glob('*_test.php') as $file) {
    try {
        include $file;
    } catch (\Throwable $e) {
        var_dump($e);
    }
}
$testing->finalize();
