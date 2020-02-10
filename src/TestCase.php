<?php declare(strict_types=1);


namespace MPUnit;

use ReflectionClass;
use ReflectionMethod;

/**
 * Class TestCase
 *
 * @package MPUnit
 */
abstract class TestCase implements Test
{
    use Assert;

    private const REGEX_DATA_PROVIDER = '/@dataProvider\s+([a-zA-Z0-9._:-\\\\x7f-\xff]+)/';

    /**
     * @param TestResult $result
     * @return TestResult
     * @throws \ReflectionException
     */
    public function run(TestResult $result): TestResult
    {
        $class = get_called_class();
        $classRef = new ReflectionClass($class);
        $testMethods = array_filter(
            array_column($classRef->getMethods(ReflectionMethod::IS_PUBLIC), 'name'),
            function ($methodName) {
                return 'test' === substr($methodName, 0, 4);
            }
        );

        foreach ($testMethods as $testMethod) {
            // Fixme support provider function in other classes
            $methodRef = $classRef->getMethod($testMethod);
            $methodDoc = $methodRef->getDocComment();
            if ($methodDoc &&
                preg_match_all(self::REGEX_DATA_PROVIDER, $methodDoc, $matches)
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
                $providedArgs = $this->$providerFunc();
            } else {
                $providedArgs = [[]]; // one element
            }

            foreach ($providedArgs as $args) {
                $result = $this->doRunTest($testMethod, $args, $result);
            }
        }

        return $result;
    }

    /**
     * TestCase object count
     *
     * @return int
     */
    public function count()
    {
        return 1;
    }

    /**
     * @fixme make protected
     */
    public function setUp(): void
    {
        // Implement if you needed
    }

    /**
     * @fixme make protected
     */
    public function tearDown(): void
    {
        // Implement if you needed
    }

    /**
     * @param $testClassName
     * @param $testMethod
     * @param $args
     * @param TestResult $testResult
     * @return TestResult
     */
    private function doRunTest($testMethod, $args, TestResult $testResult): TestResult
    {
        $testResult->incrementTestsCount();

        $className = get_called_class();
        try {
            /** @var TestCase $testClass */
            $testClass = new $className();
            $testClass->setUp();

            $testClass->$testMethod(...$args);

            $testResult->addPass(new Pass());
            // Fixme print stdout outside TestCase
            echo '.';
        } catch (\AssertionError $e) {
            $testResult->addFailure(
                new Failure(
                    $className,
                    $testMethod,
                    $e->getMessage(),
                    $e->getTraceAsString()
                )
            );
            // Fixme print stdout outside TestCase
            echo 'F';
        } catch (\Throwable $e) {
            $testResult->addError(
                new Error(
                    $className,
                    $testMethod,
                    $e->getMessage(),
                    $e->getTraceAsString(),
                )
            );
            echo 'E';
        } finally {
            $testClass->tearDown();
        }
        return $testResult;
    }
}
