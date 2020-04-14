<?php

/**
 * 
 * Карточка товара
 * 
 */

if (empty($_GET['id'])) {
    header('Location: /catalog.php');
}

$header_config = [
    'title' => 'Карточка товара',
    'style' => 'product.css'
];

include('parts/header.php');

$template = [
    'id' => '',
    'img_url' => '',
    'name' => '',
    'description' => '',
    'price' => '',
    'sizes' => []
];

// Сходить в базу данных
// Получить информацию о продукте
// Сохранить информацию в $template
// Отрисовать $template
$sql = "SELECT * FROM products WHERE id='{$_GET['id']}'";
$result = mysqli_query($link, $sql);
$template = mysqli_fetch_assoc($result);

$sql_sizes = "SELECT product_sizes FROM product_sizes WHERE product_id='{$_GET['id']}'";
$result_sizes = mysqli_query($link, $sql_sizes);
$row = mysqli_fetch_assoc($result_sizes);
$template['sizes'] = json_decode($row['product_sizes']);

?>

<form name="addToBasket" action="#" class="product">
    <div class="product-img" style="background-image: url(<?= $template['img_url'] ?>)"></div>
    <div class="product-name"><?= $template['name'] ?></div>
    <div class="product-article">артикул <?= $template['id'] ?></div>
    <div class="product-price"><?= $template['price'] ?> руб.</div>
    <div class="product-description"><?= $template['description'] ?></div>

    <div class="product-size">
        <?php while (count($template['sizes']) > 0) : ?>
            <?php $current_size = array_shift($template['sizes']) ?>
            <input id="<?= 'size' . $current_size ?>" type="checkbox" class="product-size__checkbox" value="<?= $current_size ?>">
            <label for="<?= 'size' . $current_size ?>"><?= $current_size ?></label>
        <?php endwhile; ?>
    </div>

    <input name="submit" type="submit" class="product-btn" value="Добавить в корзину" data-product-id="<?= $template['id'] ?>">
</form>

<div class="popup popup-success hide">
    <div class="alert-box">
        <div class="alert-box__close"></div>
        <h3 class="alert-box__title">Товар добавлен в корзину. Вы можете:</h3>
        <div class="alert-box__button">Продолжить покупки</div>
        <div class="alert-box__button alert-box__button--orange">Перейти к корзине</div>
    </div>
</div>
<div class="popup popup-error hide">
    <div class="alert-box">
        <div class="alert-box__close"></div>
        <h3 class="alert-box__title"></h3>
        <div class="alert-box__button alert-box__button--error">Хорошо</div>
    </div>
</div>

<?php
$footer_config = [
    'script' => 'product.js'
];

include('parts/footer.php');
?>