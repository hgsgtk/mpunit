<?php
declare(strict_types=1);

namespace MPUnit\Example;

final class Order
{
    private array $orderItemAmount;

    private int $shippingFee;

    /**
     * Order constructor.
     * @param $orderItemAmount
     * @param $shippingFee
     */
    public function __construct($orderItemAmount, $shippingFee)
    {
        $this->orderItemAmount = $orderItemAmount;
        $this->shippingFee = $shippingFee;
    }

    /**
     * @return int
     */
    public function getTotalAmount(): int
    {
        return array_sum($this->orderItemAmount) + $this->shippingFee;
    }
}
