<?php
    include($_SERVER['DOCUMENT_ROOT'].'/parts/header_conf.php');

    // преобразование POST запроса
    $postData = file_get_contents('php://input');
    $newProduct = json_decode($postData, true);

    if (!isset($_SESSION['basket'])) {
        $_SESSION['basket'] = [];
    } 

    if (!array_key_exists($newProduct['productId'], $_SESSION['basket'])) {
        $_SESSION['basket'][$newProduct['productId']] = $newProduct['productSizes'];
    } else {
        foreach($newProduct['productSizes'] as $value) {
            $_SESSION['basket'][$newProduct['productId']][] = $value;
        }
    }

?>