<?php


class TwentyObserver implements ObserverTaxRate
{
    private $tax = 20;
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