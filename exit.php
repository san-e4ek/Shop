<?php

include('parts/header_conf.php');

if (isset($_SESSION['is_auth']) && $_SESSION['is_auth']) {
    unset($_SESSION['is_auth']);

    if (isset($_SESSION['is_admin']) && $_SESSION['is_admin']) {
        unset($_SESSION['is_admin']);
    }
}

header('Location: /');