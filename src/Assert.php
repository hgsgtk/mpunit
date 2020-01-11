<?php declare(strict_types=1);

namespace MPUnit;

trait Assert
{
    /**
     * @param $assertion
     * @param string $message
     */
    protected function assertThat($assertion, string $message = ''): void
    {
        assert($assertion, $message);
    }

    /**
     * @param $expected
     * @param $actual
     */
    protected function assertSame($expected, $actual): void
    {
        $this->assertThat($expected === $actual, "actual: {$actual}, expected: {$expected}");
    }
}
