<?php

interface ObservableOrders
{
    public function attachObserver(ObserverTaxRate $observer);
    public function detachObserver(ObserverTaxRate $observer);
    public function notify($amount);
}

interface ObserverTaxRate
{
    public function getTotalAmount(float $amount);
    public function update(float $amount);
}

class Zero implements ObserverTaxRate
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

class Five implements ObserverTaxRate
{
    private $tax = 5;
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

class Twenty implements ObserverTaxRate
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

class makeOrder implements ObservableOrders
{
    private $observers = [];


    public function __construct()
    {
    }

    public function attachObserver(ObserverTaxRate $observer)
    {
        $this->observers[] = $observer;
    }

    public function detachObserver(ObserverTaxRate $observer)
    {
        foreach ($this->observers as $key=>$obs) {
            if ($obs === $observer) {
                unset($this->observers[$key]);
                return;
            }
        }
    }

    public function notify($amount)
    {
        foreach ($this->observers as $observer){
            $observer->update($amount);
        }
    }

    public function createOrder(float $amount)
    {
        $this->notify($amount);
    }
}

$order = new makeOrder();
$order->attachObserver(new Zero());
$order->attachObserver(new Five());
$order->attachObserver(new Twenty());

$order->createOrder(100);
$order->createOrder(500);

