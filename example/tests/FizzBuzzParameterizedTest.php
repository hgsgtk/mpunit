<?php declare(strict_types=1);

use MPUnit\TestCase;

require_once __DIR__ . '/../src/fizzbuzz.php';

final class FizzBuzzParameterizedTest extends TestCase
{
    /**
     * @dataProvider providerFizzBuzz
     */
    public function testFizzBuzz()
    {
        $num = 10;
        $expected = 'FizzBuzz';
        $actual = fizzbuzz($num);

        $this->assertSame($expected, $actual);
    }

    public function providerFizzBuzz(): array
    {
        return [
            [10, 'FizzBuzz'],
            [15, 'Buzz'],
        ];
    }
}
