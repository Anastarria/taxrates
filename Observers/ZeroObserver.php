<?php

class ZeroObserver implements ObserverTaxRate
{
    private $tax = 0;
    public function getTotalAmount(float $amount)
    {
        return $amount * (1+ $this->tax / 100);
    }
    public function getTax()
    {
        $this->tax;
    }
}