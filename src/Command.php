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
            /** @var Test $testCase */
            $testCase = new $testClassName();
            $testResult = $testCase->run($testResult);
        }

        echo PHP_EOL . PHP_EOL;
        return $testResult->endTest();
    }
}
