<?php declare(strict_types=1);

require_once __DIR__ . "/fizzbuzz.php";

assert('1' === $actual = to_fizzbuzz(1), eval(collect_vars));
assert('Fizz' === $actual = to_fizzbuzz(3), eval(collect_vars));
assert('Buzz' === $actual = to_fizzbuzz(5), eval(collect_vars));
assert('FizzBuzz' === $actual = to_fizzbuzz(10), eval(collect_vars));

