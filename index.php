<?php
require "vendor/autoload.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


$order = new makeOrder();
$order->attachObserver(new ZeroObserver());
$order->attachObserver(new FiveObserver());
$order->attachObserver(new TwentyObserver());

$order->createOrder(100);
$order->createOrder(500);