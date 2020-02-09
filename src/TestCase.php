<?php declare(strict_types=1);


namespace MPUnit;

/**
 * Class TestCase
 *
 * @package MPUnit
 */
abstract class TestCase
{
    use Assert;

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
}
