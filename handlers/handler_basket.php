<?php
  include($_SERVER['DOCUMENT_ROOT'].'/parts/header_conf.php');

$action = $_GET['action'];
$id = $_GET['id'];
$size = $_GET['size'];
$sizeAmount = $_GET['sizeAmount'];


if ($action == 'remove') {
    for ($i=1 ; $i <= $sizeAmount ; $i++) {
      $key = array_search ($size , $_SESSION['basket'][$id]);
      unset($_SESSION['basket'][$id][$key]);
    }
    echo 'Удаление успешно!';

} elseif ($action == 'plus') {
    $_SESSION['basket'][$id][] = $size;
    echo 'Добавление успешно!';

} elseif ($action == 'minus') {
    $key = array_search ($size , $_SESSION['basket'][$id]);
    unset($_SESSION['basket'][$id][$key]);
    echo 'Удаление одного элемента успешно!';

} else {
    echo 'Запрос некорректен!';
}

