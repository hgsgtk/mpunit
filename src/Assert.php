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
     * @param string $message
     */
    protected function assertSame($expected, $actual, string $message = ''): void
    {
        $this->assertThat($expected === $actual, $message);
    }
}
