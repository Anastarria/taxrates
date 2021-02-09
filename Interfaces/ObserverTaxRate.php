<?php

interface ObserverTaxRate
{
    public function getTotalAmount(float $amount);
    public function getTax();

}