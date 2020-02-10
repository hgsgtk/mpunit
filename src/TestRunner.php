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
     */
    public function doRun(): int
    {
        // Collect test classes
        $testClassNames = array_filter(
            get_declared_classes(),
            function ($className) {
                $ref = new ReflectionClass($className);
                if (!$ref->isUserDefined()) {
                    return false;
                }
                if ($ref->isSubclassOf('MPUnit\TestCase')) {
                    return true;
                }
                return false;
            }
        );

        $testResult = new TestResult();

        foreach ($testClassNames as $testClassName) {
            /** @var Test $testCase */
            $testCase = new $testClassName();
            $testResult = $testCase->run($testResult);
        }

        echo PHP_EOL . PHP_EOL;
        return $testResult->endTest();
    }
}
