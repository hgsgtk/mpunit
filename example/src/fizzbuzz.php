<?php declare(strict_types=1);

const FIZZ_BAZZ_MAP = [
    10 => 'FizzBuzz',
    5 => 'Buzz',
    3 => 'Fizz',
];

function fizzbuzz(int $n): string
{
    foreach (FIZZ_BAZZ_MAP as $num => $value) {
        if (($n % $num) === 0) {
            return $value;
        }
    }
    return (string)$n;
}
