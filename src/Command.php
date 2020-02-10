<?php declare(strict_types=1);


namespace MPUnit;

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

        $runner = new TestRunner();
        return $runner->doRun();
    }
}
