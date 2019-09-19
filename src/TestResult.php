<?php declare(strict_types=1);

namespace MPUnit;

/**
 * Class TestResult
 * @package MPUnit
 */
final class TestResult
{
    /** @var Failure[] $failures testing result */
    private $failures = [];

    /** @var Pass[] $passed */
    private $passes = [];

    /** @var int $countTests */
    private $countTests = 0;

    /** @var int testing assertions */
    private $countAssertions = 0;

    /**
     * Increment TestsCount.
     */
    public function incrementTestsCount(): void
    {
        $this->countTests++;
    }

    /**
     * addPass add success result.
     * @param Pass $pass
     */
    public function addPass(Pass $pass): void
    {
        $this->passes[] = $pass;
    }

    /**
     * addFailure by capturing assertion failure
     *
     * @param Failure $failure
     */
    public function addFailure(Failure $failure): void
    {
        $this->failures[] = $failure;
    }

    /**
     * @return int exit code
     */
    public function endTest(): int
    {
        if (!$this->failures) {
            echo sprintf(
                    'OK (%d tests %d assertions)',
                    $this->getTestCount(),
                    $this->getAssertionCount(),
                    ) . PHP_EOL;
            return 0;
        }

        foreach ($this->failures as $failure) {
            echo $failure->errMessage();
            echo PHP_EOL;
        }

        echo 'FAILURE!' . PHP_EOL;
        echo sprintf(
                'Tests: %d Assertions: %d, Failures: %d',
                $this->getTestCount(),
                $this->getAssertionCount(),
                count($this->failures)
            ) . PHP_EOL;

        return 1;
    }

    private function getAssertionCount(): int
    {
        return count($this->passes) + count($this->failures);
    }

    private function getTestCount(): int
    {
        return $this->countTests;
    }
}
