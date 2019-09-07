<?php declare(strict_types=1);

require_once __DIR__ . '/define.php';
require_once __DIR__ . '/Testing.php';

// https://www.php.net/manual/ja/function.ini-set.php
ini_set('zend.assertions', '1');
ini_set('assert.exception', '0');

// https://www.php.net/manual/ja/function.assert-options.php
assert_options(ASSERT_ACTIVE, '1');
assert_options(ASSERT_BAIL, '0');
assert_options(ASSERT_QUIET_EVAL, '0');
assert_options(ASSERT_WARNING, '0');

$testing = new Testing([]);
// When assertion is failed, Testing::handler will be called.
assert_options(ASSERT_CALLBACK, [$testing, 'handler']);
return $testing;
