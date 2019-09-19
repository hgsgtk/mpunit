<?php declare(strict_types=1);


namespace MPUnit;


abstract class TestCase
{
    /**
     * Assertion
     *
     * @param $a
     * @param $b
     * @param string $message
     */
    protected function assertSame($a, $b, string $message = ''): void
    {
        assert($a === $b, $message);
    }
}
