<?php declare(strict_types=1);

require_once __DIR__ . "/fizzbuzz.php";

assert('1' === $actual = fizzbuzz(2), 'hoge');
assert('Fizz' === $actual = fizzbuzz(3));
assert('Buzz' === $actual = fizzbuzz(5));
assert('FizzBuzz' === $actual = fizzbuzz(11));