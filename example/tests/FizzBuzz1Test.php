<?php declare(strict_types=1);

use MPUnit\TestCase;

require_once __DIR__ . '/../src/fizzbuzz.php';

final class FizzBuzz1Test extends TestCase
{
    public function testFizzBuzz_FizzBuzz()
    {
        $actual = fizzbuzz(10);
        $this->assertSame('FizzBuzz', $actual);
    }

    public function testFizzBuzz_FizzBuzz_15()
    {
        $actual = fizzbuzz(15);
        $this->assertSame('Buzz', $actual);
    }
}
