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
        foreach ($this->observers as $observer){
            $observer->update($amount);
        }
    }

    public function createOrder(float $amount)
    {
        $this->notify($amount);
    }
}