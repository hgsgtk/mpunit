<?php declare(strict_types=1);

require_once __DIR__ . "/../src/fizzbuzz.php";

assert('1' === $actual = fizzbuzz(1), 'テスト失敗');
assert('Fizz' === $actual = fizzbuzz(3));
assert('Buzz' === $actual = fizzbuzz(5));
assert('FizzBuzz' === $actual = fizzbuzz(10));
