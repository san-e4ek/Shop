<?php

include($_SERVER['DOCUMENT_ROOT'] . '/parts/header_conf.php');

// Авторизация -------

$isset_required_fields = isset($_GET['email']) && isset($_GET['password']);
$not_empty_required_fields = !empty($_GET['email']) && !empty($_GET['password']);


if ($isset_required_fields && $not_empty_required_fields) {
    $password = crypt($_GET['password'], $salt);

    $sql_get_user = "SELECT * FROM users WHERE email='{$_GET['email']}' AND password='{$password}'";
    $result_get_user = mysqli_query($link, $sql_get_user);

    $user = mysqli_fetch_assoc($result_get_user);

    if ($user) {
        $_SESSION['is_auth'] = true;
        $_SESSION['user_name'] = $user['first_name'];

        if ($user['is_admin'] == 1) {
            $_SESSION['is_admin'] = true;
            echo "Привет, админ ", $user['first_name'], " :)";
        } else {
            echo "Успешная авторизация! Добро пожаловать, ", $user['first_name'], "! :)";
        }

    } else {
        echo "Неверный логин или пароль";
    }
}