<?php declare(strict_types=1);


namespace mpunit;

/**
 * Class Command
 * @package mpunit
 */
final class Command
{
    /**
     * @return int
     */
    public static function main(): int
    {
        return (new static)->run();
    }

    /**
     * @return int
     */
    public function run(): int
    {
        return 0;
    }
}
