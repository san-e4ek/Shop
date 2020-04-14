<?php

/**
 *
 * Главная страница
 *
 */

$header_config = [
    'title' => 'Главная страница',
    'style' => 'index.css'
];

include('parts/header.php');
?>

    <div class="offer">
        <h1 class="offer__title">Новые поступления весны</h1>
        <p class="offer__text">Мы подготовили для Вас лучшие новинки сезона</p>
        <a href="catalog.php?category_id=4" class="offer__button centre">Посмотреть новинки</a>
        <div class="offer__grid-container">
            <div class="item fromLeft">
                <h4 class="item-title">Джинсовые куртки</h4>
                <h5 class="item-new">New arrival</h5>
            </div>
            <div class="item centre">
                <div class="item-alert"></div>
                <p class="item-text">
                    Каждый сезон мы подготавливаем для Вас исключительно лучшую
                    модную одежду. Следите за нашими новинками!
                </p>
            </div>
            <div class="item centre"></div>
            <div class="item fromRight">
                <div class="item-arrow">&larr;</div>
                <h4 class="item-title">Элегантная обувь</h4>
                <h5 class="item-new">Ботинки, кроссовки</h5>
            </div>
            <div class="item centre">
                <h4 class="item-title">Джинсы</h4>
                <p class="item-price">от 3200 руб.</p>
            </div>
            <div class="item centre">
                <div class="item-alert"></div>
                <p class="item-text">
                    Самые низкие цены в Москве. <br>
                    Нашли дешевле? Вернем разницу.
                </p>
            </div>
            <div class="item fromRight">
                <h4 class="item-title">Детская одежда</h4>
                <h5 class="item-new">New arrival</h5>
            </div>
            <div class="item fromLeft"></div>
            <div class="item centre">
                <div class="item-arrow">&larr;</div>
                <h4 class="item-title">Аксессуары</h4>
            </div>
            <div class="item centre">
                <h4 class="item-title">Спортивная одежда</h4>
                <p class="item-price">от 590 руб.</p>
            </div>
        </div>
    </div>

    <div class="subscribe">
        <h2 class="subscribe__title">
            Будь всегда в курсе выгодных предложений
        </h2>
        <p class="subscribe__text">
            Подписывайся и следи за новинками и выгодными предложениями
        </p>
        <form method="GET" class="subscribe__form"
              onkeyup="return checkKeyupFormSubscribe(this.elements)">
<!--              onsubmit="return checkFormSubscribe(this.elements)"-->

            <input type="email" name="subscriber" placeholder="e-mail" class="input-email">
            <input type="submit" value="записаться" class="input-submit">
        </form>
        <p class="subscribe__error">Некорректный e-mail. Попробуйте еще раз.</p>
    </div>

<?php

$footer_config = [
    'script' => 'index.js'
];

include('parts/footer.php');
?>