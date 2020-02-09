<?php declare(strict_types=1);


namespace MPUnit;

use ReflectionClass;

/**
 * Class Command
 *
 * @package MPUnit
 */
final class Command
{
    /**
     * @return int
     * @throws
     */
    public function run(): int
    {
        // Collect test files
        $testFiles = glob('*Test.php');
        foreach ($testFiles as $testFile) {
            // Fixme find ways not to need include files
            include_once $testFile;
        }

        // Collect test classes
        $testClassNames = array_filter(
            get_declared_classes(),
            function ($className) {
                $ref = new ReflectionClass($className);
                if (!$ref->isUserDefined()) {
                    return false;
                }
                $parent = $ref->getParentClass();
                if (!$parent) {
                    return false;
                }
                if ($parent->getName() !== 'MPUnit\TestCase') {
                    return false;
                }
                return true;
            }
        );

        $testResult = new TestResult();

        foreach ($testClassNames as $testClassName) {
            // Fixme count test case automatically
            $testResult->incrementTestsCount();

            // Collect test methods
            $testClassRef = new ReflectionClass($testClassName);
            $testMethods = array_filter(
                array_column($testClassRef->getMethods(\ReflectionMethod::IS_PUBLIC), 'name'),
                function ($methodName) {
                    return 'test' === substr($methodName, 0, 4);
                }
            );

            // Execute test methods
            foreach ($testMethods as $testMethod) {
                try {
                    $sut = new $testClassName();
                    $sut->setUp();
                    $sut->$testMethod();
                    $sut->tearDown();
                    $testResult->addPass(new Pass());
                    echo '.';
                } catch (\AssertionError $e) {
                    $testResult->addFailure(
                        new Failure(
                            $testClassName,
                            $testMethod,
                            $e->getMessage(),
                            $e->getTraceAsString()
                        )
                    );
                    echo 'F';
                }
            }
        }

        echo PHP_EOL . PHP_EOL;
        return $testResult->endTest();
    }
}
