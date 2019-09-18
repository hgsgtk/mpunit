<?php declare(strict_types=1);

const FIZZ_BAZZ_MAP = [
    3 => 'Fizz',
    5 => 'Buzz',
    10 => 'FizzBuzz'
];

function fizzbuzz(int $n): string
{
    return FIZZ_BAZZ_MAP[$n] ?? (string)$n;
}
