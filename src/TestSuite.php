<?php
declare(strict_types=1);

namespace MPUnit;

class TestSuite implements Test
{
    /**
     * @var TestCase[]
     */
    private array $tests;

    /**
     * @param Test $test
     */
    public function addTest(Test $test)
    {
        $this->tests[] = $test;
    }

    public function count()
    {
        return count($this->tests);
    }

    public function run(TestResult $result): TestResult
    {
        foreach ($this->tests as $test) {
            $result = $test->run($result);
        }
        return $result;
    }
}
