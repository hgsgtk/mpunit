<?php
declare(strict_types=1);


namespace MPUnit;

final class Error
{
    /**
     * @var string $testClass
     */
    private $testClass;

    /**
     * @var string $testMethod
     */
    private $testMethod;

    /**
     * @var string $message
     */
    private $message;

    /**
     * @var string $trace
     */
    private $trace;

    /**
     * Failure constructor.
     *
     * @param string $testClass
     * @param string $testMethod
     * @param string $message
     * @param string $trace
     */
    public function __construct(
        string $testClass,
        string $testMethod,
        string $message,
        string $trace
    ) {
        $this->testClass = $testClass;
        $this->testMethod = $testMethod;
        $this->message= $message;
        $this->trace = $trace;
    }

    /**
     * @return string
     */
    public function errMessage(): string
    {
        $fmt = <<<EOF
Error
Error occurs at %s::%s %s
%s
EOF;

        return sprintf(
            $fmt,
            $this->testClass,
            $this->testMethod,
            $this->message,
            $this->trace,
        ) . PHP_EOL;
    }
}
