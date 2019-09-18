<?php declare(strict_types=1);

namespace MPUnit;

final class TestResult
{
    /** @var array testing result */
    private $result = [];

    /**
     * addError by capturing assertion failure
     *
     * @param $file
     * @param $line
     * @param $code
     * @param null $desc
     */
    public function addError($file, $line, $code, $desc = null): void
    {
        $this->result[] = [$file, $line, $desc];
    }

    /**
     * @return int exit code
     */
    public function endTest(): int
    {
        if (!$this->result) {
            echo 'ALL TEST PASSED.' . PHP_EOL;
            return 0;
        }

        foreach ($this->result as [$file, $line, $desc]) {
            $code = trim(file($file)[$line - 1]);
            echo 'FAILED' . PHP_EOL;
            echo "FILE: {$file} ({$line})" . PHP_EOL;
            echo "CODE: {$code}" . PHP_EOL;
            echo "DESC: {$desc}" . PHP_EOL;
        }
        return 1;
    }
}
