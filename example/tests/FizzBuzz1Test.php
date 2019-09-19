<?php declare(strict_types=1);

use MPUnit\TestCase;

require_once __DIR__ . '/../src/fizzbuzz.php';

final class FizzBuzz1Test extends TestCase
{
    function testFizzBuzz_FizzBuzz()
    {
        $actual = fizzbuzz(10);
        $this->assertSame('FizzBuzz', $actual);
    }
}
