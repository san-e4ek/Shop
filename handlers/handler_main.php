<?php

include($_SERVER['DOCUMENT_ROOT'] . '/parts/header_conf.php');


// Подписота ---------------------------


if (isset($_GET['subscriber']) && !empty($_GET['subscriber'])) {

    $sql_get_sub = "SELECT * FROM subscribers WHERE subscriber='{$_GET['subscriber']}'";
    $result_get_sub = mysqli_query($link, $sql_get_sub);

    $subber = mysqli_fetch_assoc($result_get_sub);

    if ($subber) {
        echo "Ты уже подписан!";
    } else {
        $sql_subscriber = "INSERT INTO subscribers VALUES (null, '{$_GET['subscriber']}')";
        $result_sub = mysqli_query($link, $sql_subscriber);
        echo "Поздравляю тебя, подписота! :)";
    }

}

//-------------------------------------

// Восстановление пароля --------------

if (isset($_GET['email']) && !empty($_GET['email'])) {
    $sql_get_userEmail = "SELECT * FROM users WHERE email='{$_GET['email']}'";
    $result_get_userEmail = mysqli_query($link, $sql_get_userEmail);

    $userEmail = mysqli_fetch_assoc($result_get_userEmail);

    if ($userEmail) {
        echo "Отлично! Инструкция по восстанавлению пароля в твоей почте :)";
    } else {
        echo "К сожалению, пользователь с таким email не найден :(";
    }
}

//-------------------------------------
