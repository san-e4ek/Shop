<?php
    session_start();

    if (empty($_SESSION['count'])) {
        $_SESSION['count'] = 1;
    }

    $_SESSION['count']++;

    print_r($_SESSION);
?>