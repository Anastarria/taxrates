<?php


error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


spl_autoload_register(function ($class){
    $folder = "Helpers";
    if (strpos($class, "Model") !== false) {
        $folder = "Models";
    } else if (strpos($class, "Controller") !== false) {
        $folder = "Controllers";
    }
    $filePath = "$folder/$class.php";
    if (!file_exists($filePath)) {
        die("404 Not Found");
    }

    require_once $filePath;
});


$requestURI = ltrim($_SERVER['REQUEST_URI']);
$parts = explode('/', $requestURI);
array_shift($parts);

$class = empty($parts[0]) ? 'user' : $parts[0];
$method = $parts[1] ?? 'index';
$parameter = $parts[2] ?? null;

$controller = ucfirst($class) . 'Controller';
$object = new $controller();
if(method_exists($object, $method)){
    echo $object->$method();
} else {
    die("Not found");
}

$order = new makeOrder();
$order->attachObserver(new ZeroObserver());
$order->attachObserver(new Five());
$order->attachObserver(new TwentyObserver());

$order->createOrder(100);
$order->createOrder(500);