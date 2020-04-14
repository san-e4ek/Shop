<?php
/**
 * 
 * Подключение к базе данных
 * 
 */

$link = mysqli_connect('localhost', 'root', '', '03122019_21_shop');
mysqli_set_charset($link, 'utf8');

//количество часов, через которое товар перестает быть новинкой
$product_remain_new = 48;

?>