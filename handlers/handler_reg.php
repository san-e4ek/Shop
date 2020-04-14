<?php

include($_SERVER['DOCUMENT_ROOT'] . '/parts/header_conf.php');

// Регистрация нового пользователя ----

if ((isset($_GET['email']) && !empty($_GET['email'])) && (isset($_GET['password']) && !empty($_GET['password']))) {
    $sql_get_userEmail = "SELECT * FROM users WHERE email='{$_GET['email']}'";
    $result_get_userEmail = mysqli_query($link, $sql_get_userEmail);

    $userEmail = mysqli_fetch_assoc($result_get_userEmail);

    if ($userEmail) {
        echo "Увы! :( супруга с таким email у меня уже есть";
    } else {
        $password = crypt($_GET['password'], $salt);

        $sql_newUser = "INSERT INTO users(`id`, `first_name`, `last_name`, `email`, `password`) 
                            VALUES (null, '{$_GET['first_name']}', '{$_GET['last_name']}', '{$_GET['email']}', '{$password}')";
        $result_newUser = mysqli_query($link, $sql_newUser);

        echo "Ура! Поздравляю с регистрацией брака! :D";
    }
}

//--------------------------------------