<?php


class ZeroObserver implements ObserverTaxRate
{
    private $tax = 0;
    public function getTotalAmount(float $amount)
    {
        return $amount * (1+ $this->tax / 100);
    }

    public function update(float $amount)
    {
        $total = $this->getTotalAmount($amount);
        echo "Заказ на сумму: $amount,  налог: " . $this->tax . " итого: " . $total . "</br>" ;
    }
}