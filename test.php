<?php

interface TaxRate
{
    public function getTotalAmount(float $amount);
}

class Zero implements SplObserver
{
    private $tax = 0;
    public function getTotalAmount(float $amount)
    {
        echo "Заказ на сумму: $amount,  налог: " . $this->tax . " итого: " . $amount . "</br>" ;
    }
}

class Five implements TaxRate
{
    private $tax = 5;
    public function getTotalAmount(float $amount)
    {
        echo "Заказ на сумму: $amount,  налог: " . $this->tax . " итого: " . ($amount * (1+ $this->tax / 100)) . "</br>" ;
    }
}

class Twenty implements TaxRate
{
    private $tax = 20;
    public function getTotalAmount(float $amount)
    {
        echo "Заказ на сумму: $amount,  налог: " . $this->tax . " итого: " . ($amount * (1 + $this->tax / 100)) . "</br>" ;
    }
}

class makeOrder
{
    public function proceedPayment(TaxRate $taxRate, float $amount)
    {
        $taxRate->getTotalAmount($amount);
    }
}

$order1 = new makeOrder();
$order1->proceedPayment(new Zero(), 100);
$order1->proceedPayment(new Five(), 100);
$order1->proceedPayment(new Twenty(), 100);

$order2 = new makeOrder();
$order2->proceedPayment(new Zero(), 500);
$order2->proceedPayment(new Five(), 500);
$order2->proceedPayment(new Twenty(), 500);


