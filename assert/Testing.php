<?php declare(strict_types=1);

class Testing
{
    /** @var bool Whether test stop on failure */
    private $stopOnFailure = false;

    /** @var array testing result */
    private $result = [];

    /**
     * Testing constructor.
     * @param array $options
     */
    public function __construct(array $options)
    {
        $this->stopOnFailure = $options['stop_on_failure'] ?? false;
    }

    /**
     * Handling assertion failure
     * @param $file
     * @param $line
     * @param $code
     * @param null $desc
     */
    public function handler($file, $line, $code, $desc = null)
    {
        $this->result[] = [$file, $line, $desc];
        if ($this->stopOnFailure) $this->finalize();
    }

    /**
     * Output testing result.
     */
    public function finalize(): void
    {
        if ($this->result) {
            foreach ($this->result as [$file, $line, $desc]) {
                $this->output($file, $line, $desc);
            }
            exit(1);
        }

        $this->result = [];

        echo 'ok.' . PHP_EOL;
        exit(0);
    }

    private function output($file, $line, $desc): void
    {
        // https://www.php.net/manual/ja/function.trim.php
        // https://www.php.net/manual/ja/function.file.php
        $code = trim(file($file)[$line-1]);

        echo "FILE: {$file} ({$line})" . PHP_EOL;
        echo "CODE: {$code}" . PHP_EOL;
        echo "DESC: {$desc}" . PHP_EOL;
    }
}
