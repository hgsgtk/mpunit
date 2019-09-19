<?php declare(strict_types=1);

use MPUnit\TestCase;

require_once __DIR__ . '/../src/fizzbuzz.php';

final class FizzBuzzTest extends TestCase
{
    function testFizzBuzz_1()
    {
        $actual = fizzbuzz(1);
        $this->assertSame('1', $actual);
    }

    function testFizzBuzz_Fizz()
    {
        $actual = fizzbuzz(3);
        $this->assertSame('Fizz', $actual);
    }

    function testFizzBuzz_Buzz()
    {
        $actual = fizzbuzz(5);
        $this->assertSame('Buzz', $actual);
    }
}
