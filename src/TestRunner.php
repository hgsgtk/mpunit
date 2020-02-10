<?php
declare(strict_types=1);

namespace MPUnit;

use ReflectionClass;

/**
 * Class TestRunner
 *
 * TestRunner is a component of xUnit. It has following responsibilities.
 *
 * 1. Instantiate testSuite object
 * 2. Execute all TestCase object
 * 3. Keep track of and reporting
 *  - how many tests run
 *  - how many tests had failed
 *  - how many tests raise error or exception
 *
 * @package MPUnit
 */
final class TestRunner
{
    /**
     * @return int exit code
     * @throws \ReflectionException
     */
    public function doRun(): int
    {
        // Initialize test suite
        $suite = new TestSuite();
        foreach (get_declared_classes() as $get_declared_class) {
            $classRef = new ReflectionClass($get_declared_class);
            if (!$classRef->isUserDefined()) {
                continue;
            }
            if (!$classRef->isSubclassOf('MPUnit\TestCase')) {
                continue;
            }
            $suite->addTest(
                new $get_declared_class()
            );
        }

        // Execute all TestCase object
        $testResult = new TestResult();
        $testResult = $suite->run($testResult);

        // Reporting
        echo PHP_EOL . PHP_EOL;
        return $testResult->endTest();
    }
}
