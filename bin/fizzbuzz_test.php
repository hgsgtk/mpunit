<?php declare(strict_types=1);

require_once __DIR__ . "/fizzbuzz.php";

assert('1' === $actual = fizzbuzz(1));
assert('Fizz' === $actual = fizzbuzz(3));
assert('Buzz' === $actual = fizzbuzz(5));
assert('FizzBuzz' === $actual = fizzbuzz(10));

