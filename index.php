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
    public function getTax();

}

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

class TwentyObserver implements ObserverTaxRate
{
    private $tax = 20;
    public function getTotalAmount(float $amount)
    {
        return $amount * (1+ $this->tax / 100);
    }
    public function getTax()
    {
        $this->tax;
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
        date_default_timezone_set('Europe/Kiev');
        $date = date('d-m-y h:i:s');
        foreach ($this->observers as $observer){
            $total = $observer->getTotalAmount($amount);
            echo "Заказ на сумму: $amount,  налог: " . $observer->getTax() . " итого: " . $total . "</br>" ;
            file_put_contents("orderslog.txt", "Заказ на сумму: $amount,  налог: " . $observer->getTax() . " итого: " . $total . ". Дата и время заказа: $date." . PHP_EOL, FILE_APPEND);
        }
    }

    public function createOrder(float $amount)
    {
        $this->notify($amount);
    }
}

$order = new makeOrder();
$order->attachObserver(new ZeroObserver());
$order->attachObserver(new FiveObserver());
$order->attachObserver(new TwentyObserver());

$order->createOrder(100);
$order->createOrder(500);
