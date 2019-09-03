<?php declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

assert(2 === 1 + 1);
assert(3 === 1.5 + 1.5);
assert('2112-09-13' === date('Y-m-d', 4503168000));

$a = [1, 2, 3];
assert(1 === array_shift($a));
