<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit08e564f527c214c2faae2741ec76b8ad
{
    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'FiveObserver' => __DIR__ . '/../..' . '/Observers/FiveObserver.php',
        'ObservableOrders' => __DIR__ . '/../..' . '/Interfaces/ObservableOrders.php',
        'ObserverTaxRate' => __DIR__ . '/../..' . '/Interfaces/ObserverTaxRate.php',
        'TwentyObserver' => __DIR__ . '/../..' . '/Observers/TwentyObserver.php',
        'ZeroObserver' => __DIR__ . '/../..' . '/Observers/ZeroObserver.php',
        'makeOrder' => __DIR__ . '/../..' . '/ObservableClasses/makeOrder.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit08e564f527c214c2faae2741ec76b8ad::$classMap;

        }, null, ClassLoader::class);
    }
}