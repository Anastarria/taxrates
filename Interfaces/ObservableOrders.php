<?php

interface ObservableOrders
{
    public function attachObserver(ObserverTaxRate $observer);
    public function detachObserver(ObserverTaxRate $observer);
    public function notify($amount);
}