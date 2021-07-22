<?php
    require_once 'Good.php';
    require_once 'Shop.php';
    require_once '../libs/FileLogger.php';

    $logger = new FileLogger('inventory', 'inventory.log');
    $shop = new Shop('Sasha', 10);
    $milk = new Good('Milk', 80, 0.1);
    $meat = new Good("Meat", 560, 1);
    $shop->add($milk, 6);
    $shop->add($meat, 2);
    $shop->remove('Milk');
    print_r($shop->showInventory());
    print_r($shop->getTotalPrice());
    file_put_contents('log.json', $shop->getJSON());
