<?php
    require_once 'Shop.php';
    require_once 'Good.php';
    $f = fopen('inventory.log', 'r');
    $obj = fread($f, filesize('inventory.log'));
    $new = unserialize($obj);
    $good = new Good("Jopa", 230, 1);
    $new->add($good, 2);
    print_r($new->showInventory());

