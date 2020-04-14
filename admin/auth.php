<?php
//    $auth_page = true;
//    include('parts/header.php');
//
//    $isset_required_fields = isset($_POST['email']) && isset($_POST['password']);
//    $not_empty_required_fields = !empty($_POST['email']) && !empty($_POST['password']);
//
//    if ($isset_required_fields && $not_empty_required_fields) {
//        $password = crypt($_POST['password'], $salt);
//
//        $sql = "SELECT * FROM users WHERE email='{$_POST['email']}' AND password='{$password}'";
//        $result = mysqli_query($link, $sql);
//        $user = mysqli_fetch_assoc($result);
//
//        if ($user) {
//           if ($user['is_admin']) {
//                $_SESSION['is_auth'] = true;
//
//                header('Location: /admin');
//           } else {
//                echo '<div class="alert alert-warning" role="alert">
//                    К сожалению, у вас нет прав доступа в административную панель
//                </div>';
//           }
//        } else {
//            echo '<div class="alert alert-danger" role="alert">
//                    Неверный логин или пароль
//                </div>';
//        }
//    }
//
//?>
<!---->
<!--<h1>Авторизация</h1>-->
<!---->
<!--<form method="POST">-->
<!--    <div class="form-group">-->
<!--        <input type="email" class="form-control" placeholder="Почта" name="email">-->
<!--    </div>-->
<!---->
<!--    <div class="form-group">-->
<!--        <input type="password" class="form-control" placeholder="Пароль" name="password">-->
<!--    </div>-->
<!---->
<!--    <button type="submit" class="btn btn-primary">Войти</button>-->
<!--</form>-->
<!---->
<?php //include('parts/footer.php'); ?>