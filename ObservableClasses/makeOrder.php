<?php

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