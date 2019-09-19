<?php declare(strict_types=1);

use MPUnit\TestCase;

require_once __DIR__ . '/../src/fizzbuzz.php';

final class FizzBuzzTest extends TestCase
{
    function testFizzBuzz_1() {
        assert('1' === $actual = fizzbuzz(1));
    }

    function testFizzBuzz_Fizz() {
        assert('Fizz' === $actual = fizzbuzz(3));
    }

    function testFizzBuzz_Buzz() {
        assert('Fizz' === $actual = fizzbuzz(5));
    }

    function testFizzBuzz_FizzBuzz() {
        assert('Fizz' === $actual = fizzbuzz(10));
    }

}
