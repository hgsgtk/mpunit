<?php declare(strict_types=1);

const DEFAULT_MAP = [
    3 => 'Fizz',
    5 => 'Buzz',
    10 => 'FizzBuzz'
];

/**
 * @param int $num
 * @param array|null $map
 * @return Generator
 * @link https://www.php.net/manual/ja/language.generators.overview.php
 */
function fizzbuzz(int $num, array $map = null): \Generator
{
    foreach (range(1, $num) as $n) {
        yield to_fizzbuzz($s, $map);
    }
}

function to_fizzbuzz(int $n, array $map = null): string
{
    if ($map === null) $map = DEFAULT_MAP;

    $s = '';

    foreach ($map as $m => $word) {
        if ($n % $m ==0) $s = $word;
    }

    if ($s === '') $s = (string)$n;

    return $s;
}
