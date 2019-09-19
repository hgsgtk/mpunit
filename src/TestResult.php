<?php declare(strict_types=1);

namespace MPUnit;

final class TestResult
{
    /** @var array testing result */
    private $failures = [];

    /** @var int testing assertions */
    private $countAssertions = 0;

    /**
     * addSuccess add success result, but temporary just increment test counter.
     */
    public function addSuccess(): void
    {
        $this->countAssertions++;
    }

    /**
     * addFailure by capturing assertion failure
     *
     * @param $file
     * @param $class
     * @param $function
     * @param $line
     * @param null $desc
     */
    public function addFailure($file, $class, $function, $line, $desc = null): void
    {
        $this->failures[] = [$file, $class, $function, $line, $desc];
        $this->countAssertions++;
    }

    /**
     * @return int exit code
     */
    public function endTest(): int
    {
        if (!$this->failures) {
            // TODO test class and test case
            echo sprintf(
                'OK (%d assertions)',
                    $this->getAssertionCount(),
                    ) . PHP_EOL;
            return 0;
        }

        foreach ($this->failures as [$file, $class, $function, $line, $desc]) {
            $code = trim(file($file)[$line - 1]);
            echo 'FAILED' . PHP_EOL;
            echo "FILE: {$file} ({$line})" . PHP_EOL;
            echo "CLASS: $class" . PHP_EOL;
            echo "FUNCTION: $function" . PHP_EOL;
            echo "CODE: {$code}" . PHP_EOL;
            echo "DESC: {$desc}" . PHP_EOL;
            echo PHP_EOL;
        }

        echo 'FAILURE!' . PHP_EOL;
        echo sprintf(
            'Assertions: %d, Failures: %d',
            $this->getAssertionCount(),
            count($this->failures)
        ) . PHP_EOL;

        return 1;
    }

    private function getAssertionCount(): int
    {
        return $this->countAssertions;
    }
}
