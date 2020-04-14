<?php
if (!isset($_POST['success']) || empty($_POST['success'])) {
  header('Location: /');
}
/**
 * 
 * Карточка оплаты заказа
 * 
 */
$header_config = [
  'title' => 'Оплата товара',
  // 'style' => 'product.css'
];

include('parts/header.php');

?>
<h1>Спасибо за Ваш заказ.</h1>
<h2>Меденжер свяжется с Вами в ближайшее время!</h2>
<h3>Вернуться на <a href="/">главную страницу</a></h3>

<?php

//добавляемся в таблицу orders_list
$query_orders_list = "INSERT INTO orders_list VALUES (null, '{$_POST['name']}', '{$_POST['surname']}', {$_POST['phone']}, '{$_POST['email']}', '{$_POST['adress']}', '{$_POST['city']}', {$_POST['index']}, '{$_POST['payment']}', {$_POST['price']}, {$_POST['service']}, {$_POST['full-price']})";

$result_orders_list = mysqli_query($link, $query_orders_list);
$order_id = mysqli_insert_id($link);

$arr = [];

foreach ($_SESSION['basket'] as $id) {
  $arr[] = array_count_values($id);
}

//добавляемся в таблицу orders_detail
foreach ($arr as $id => $sizes) {
  foreach ($sizes as $size => $amount) {
    $query_orders_detail = "INSERT INTO orders_detail VALUES (null, $order_id, $id, $size, $amount)";
    $result_orders_detail = mysqli_query($link, $query_orders_detail);
  }
}
?>


<?php

include('parts/footer.php');
?>