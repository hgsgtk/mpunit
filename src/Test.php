<?php
declare(strict_types=1);

namespace MPUnit;

use Countable;

/**
 * Interface Test
 *
 * As a xUnit family, this "standard test interface" should provide a method to count tests.
 * @package MPUnit
 */
interface Test extends Countable
{
    /**
     * Runs method provides interfaces to run test methods.
     *
     * @param TestResult $result
     * @return TestResult
     */
    public function run(TestResult $result): TestResult;
}
