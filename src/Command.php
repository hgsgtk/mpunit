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
    private const REGEX_DATA_PROVIDER = '/@dataProvider\s+([a-zA-Z0-9._:-\\\\x7f-\xff]+)/';

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
                if ($ref->isSubclassOf('MPUnit\TestCase')) {
                    return true;
                }
                return false;
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
                    // Search doc comment and provider
                    $refTestMethod = $testClassRef->getMethod($testMethod);
                    $docComment = $refTestMethod->getDocComment();
                if ($docComment &&
                        preg_match_all(self::REGEX_DATA_PROVIDER, $docComment, $matches)
                        /**
                         * ..array(2) {
                         *   [0]=>
                         *   array(1) {
                         *     [0]=>
                         *     string(30) "@dataProvider providerFizzBuzz"
                         *   }
                         *   [1]=>
                         *     array(1) {
                         *     [0]=>
                         *     string(16) "providerFizzBuzz"
                         *   }
                         * }
                         * ....
                         */
                    ) {
                    $providerFunc = $matches[1][0];
                    $providedArgs = (new $testClassName())->$providerFunc();
                } else {
                    $providedArgs = [];
                }

                if (count($providedArgs) !== 0) {
                    foreach ($providedArgs as $args) {
                        $testResult = $this->doRunTest($testClassName, $testMethod, $args, $testResult);
                    }
                } else {
                    $testResult = $this->doRunTest($testClassName, $testMethod, $providedArgs, $testResult);
                }
            }
        }

        echo PHP_EOL . PHP_EOL;
        return $testResult->endTest();
    }

    /**
     * @param $testClassName
     * @param $testMethod
     * @param $args
     * @param TestResult $testResult
     * @return TestResult
     */
    private function doRunTest($testClassName, $testMethod, $args, TestResult $testResult): TestResult
    {
        try {
            /** @var TestCase $sut */
            $sut = new $testClassName();
            $sut->setUp();
            $sut->$testMethod(...$args);
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
        return $testResult;
    }
}
