<?php


class FiveObserver implements ObserverTaxRate
{
    private $tax = 5;
    public function getTotalAmount(float $amount)
    {
        return $amount * (1+ $this->tax / 100);
    }
    public function getTax()
    {
        $this->tax;
    }

}