<?php
$header_config = [
    'title' => 'Корзина',
    'style' => 'basket.css'
];

include('parts/header.php');

if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])) {
    $productArr = [];
    $sum = 0;

    foreach ($_SESSION['basket'] as $key => $value) {
        $qr = "SELECT * FROM products WHERE id=$key";
        $result = mysqli_query($link, $qr);
        $row = mysqli_fetch_assoc($result);
        $productArr[] = $row;
    }
}
?>


<?php if (isset($_SESSION['basket']) && !empty($_SESSION['basket'])) : ?>
    <div class="basket-top">
        <h1 class="big-title">Ваша корзина</h1>
        <h3 class="min-title">Товары резервируются на ограниченное время</h3>
    </div>

    <div class="basket-order">
        <div class="head">
            <h4>Фото</h4>
            <h4>Наименование</h4>
            <h4 class="centre">Размер</h4>
            <h4 class="centre">Количество</h4>
            <h4 class="centre">Стоимость</h4>
            <h4 class="centre">Удалить</h4>
        </div>

        <?php foreach ($productArr as $productItem) : ?>
            <?php
            //считаем количество уникальных размеров
            $sizesArr = array_count_values($_SESSION['basket']["{$productItem['id']}"]);
            ?>
            <?php foreach ($sizesArr as $size => $sizeAmount) : ?>
                <div class="item" data-product-id="<?= $productItem['id'] ?>" data-product-size="<?= $size ?>" data-product-size-amount="<?= $sizeAmount ?>">
                    <div class="image centre">
                        <img src="<?= $productItem['img_url'] ?>" alt="<?= $productItem['name'] ?>">
                    </div>

                    <div class="name">
                        <p><?= $productItem['name'] ?></p>
                        <p>арт. <?= $productItem['id'] ?></p>
                    </div>

                    <div class="size centre"><?= $size ?></div>

                    <div class="count centre">
                        <span><?= $sizeAmount ?></span>
                        <img class="btn-plus" src="/images/basket/plus.jpg" alt="">
                        <img class="btn-minus" src="/images/basket/minus.jpg" alt="">
                    </div>

                    <div class="price centre"><?= $productItem['price'] * $sizeAmount ?> руб.</div>
                    <div class="basket-x"></div>
                </div>
                <?php $sum += $productItem['price'] * $sizeAmount ?>
            <?php endforeach; ?>
        <?php endforeach; ?>

        <div class="result">
            <span class="centre">Итог:</span>
            <span class="centre orange"><?= $sum ?> руб.</span>
        </div>



        <div class="symbol">
            <div class="symbol-el"></div>
            <div class="symbol-el"></div>
            <div class="symbol-el"></div>
        </div>


        <div class="basket-form">
            <h2 class="big-title">Адрес доставки</h2>
            <h3 class="min-title">Все поля обязательны для заполнения</h3>

            <form action="/order.php" method="POST" class="popup" name="payment">
                <div class="popup__box box_full">
                    <p>Выберите вариант доставки</p>
                    <select name="service">
                        <?php
                        $service_self = 0;
                        $service_courier = 500;
                        $service_mail = 300;
                        ?>
                        <option value="<?= $service_self ?>">Самовывоз - бесплатно!</option>
                        <option value="<?= $service_courier ?>" selected>Курьерская служба - <?= $service_courier ?>р.</option>
                        <option value="<?= $service_mail ?>">Почта России - <?= $service_mail ?>р.</option>
                    </select>
                </div>

                <div title="Имя" class="popup__box">
                    <p>Имя</p>
                    <input data-rule="name" type="text" name="name">
                </div>

                <div title="Фамилия" class="popup__box">
                    <p>Фамилия</p>
                    <input data-rule="name" type="text" name="surname">
                </div>

                <div title="Адрес" class="popup__box box_full">
                    <p>Адрес</p>
                    <input data-rule="text" type="text" name="adress">
                </div>

                <div title="Город" class="popup__box">
                    <p>Город</p>
                    <input data-rule="text" type="text" name="city">
                </div>

                <div title="Индекс" class="popup__box">
                    <p>Индекс</p>
                    <input data-rule="index" type="text" name="index">
                </div>

                <div title="Телефон" class="popup__box">
                    <p>Телефон</p>
                    <input data-rule="phone" type="tel" name="phone">
                </div>

                <div title="E-mail" class="popup__box">
                    <p>E-mail</p>
                    <input data-rule="email" type="email" name="email">
                </div>

                <div title="Выберите способ оплаты" class="popup__box box_full" id="payment">
                    <p>Выберите способ оплаты</p>
                    <select name="payment">
                        <option value="card">Банковская карта</option>
                        <option value="cash">Наличными при получении</option>
                    </select>
                    <img src="/images/basket/cards.jpg" alt="">
                </div>

                <input type="hidden" name="price" value="<?= $sum ?>">
                <input type="hidden" name="full-price" value="<?= $sum + $service_courier ?>">
                <input type="hidden" name="success" value="success">
                <div class="popup__box box_full" id="btn">
                    <input type="submit" value="заказать">
                </div>
            </form>
        </div>


        <div class="symbol">
            <div class="symbol-el"></div>
            <div class="symbol-el"></div>
            <div class="symbol-el"></div>
        </div>


        <div class="basket-form basket_payment">
            <h2 class="big-title">Варианты оплаты</h2>
            <h3 class="min-title">Все поля обязательны для заполнения</h3>

            <div class="payment-list">
                <li class="list-item">Стоимость:</li>
                <li class="list-item price"><?= $sum ?> руб.</li>
                <li class="list-item">Доставка:</li>
                <li class="list-item service"><?= $service_courier ?> руб.</li>
                <li class="list-item orange">Итого:</li>
                <li class="list-item final-price orange"><?= $sum + $service_courier ?> руб.</li>
            </div>
        </div>
    </div>

<?php else : ?>

    <div class="basket-top">
        <h1 class="big-title">Ваша корзина</h1>
        <h3 class="min-title">
            В вашей корзине товаров нет. Вы можете <a href="/catalog.php">исправить это!</a>
        </h3>
    </div>

<?php endif; ?>


<?php
$footer_config = [
    'script' => 'basket.js'
];

include('parts/footer.php');
?>