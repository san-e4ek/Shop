<?php
    include('parts/header.php');

    $sql_get_categories = "SELECT * FROM categories";
    $result_get_categories = mysqli_query($link, $sql_get_categories);

    for ($i = 0; $i < 3; $i++) {
        $row[$i] = mysqli_fetch_assoc($result_get_categories);
    }

    // Сделать добавление товара в базу
    if (isset($_POST['add'])) {
        // Добавляем товар в базу
        $sql_add_product = "INSERT INTO products (id, img_url, name, description, type, price) 
                VALUES (null, '{$_POST['img_url']}', '{$_POST['name']}', '{$_POST['description']}', '{$_POST['type']}','{$_POST['price']}')";
        $result_add_product = mysqli_query($link, $sql_add_product);
        $id = mysqli_insert_id($link);

        // Привязываем товар к категории

        for ($count = 0; $count < count($_POST['category']); $count++) {
            $sql_set_category = "INSERT INTO product_category VALUES (null, $id, '{$_POST['category'][$count]}')";
            $result_set_category = mysqli_query($link, $sql_set_category);
        }

        // Добавляем размеры в таблицу размеров
        //конвертируем массив размеров товара в строку для отправки в базу
        $size_string = '['.implode(",", $_POST['size']).']';
        //отправляем размеры в базу
        $sql_set_sizes = "INSERT INTO product_sizes VALUES (null, $id, '{$size_string}')";
        $result_set_sizes = mysqli_query($link, $sql_set_sizes);

        if ($result_add_product && $result_set_category && $result_set_sizes) {
            echo "<div class='alert alert-success' role='alert'>
                    Товар успешно добавлен! (<a href='/admin/product_edit.php?id={$id}'>Редактировать</a>)
                </div>";
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Не удалось добавить новый товар!
                </div>';
        }
    }
?>

<h1>
    Добавление нового товара
</h1>
<div class="card" style="width: 18rem;">
  <img src="" class="card-img-top" alt="Здесь подгрузится изображение">
</div>
<br>

<form name="add" method="POST">
    <input type="hidden" name="add" value="add">

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Путь до картинки" name="img_url">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Название" name="name">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Описание" name="description">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Цена" name="price">
    </div>

    <div class="form-group">
        <select multiple class="form-control" placeholder="Категория" name="category[]">
            <?php for($count = 0; $count < count($row); $count++) : ?>
            <option value="<?= $row[$count]['id']; ?>"><?= $row[$count]['name']; ?></option>
            <?php endfor; ?>
        </select>
    </div>


    <label class="mr-sm-2" for="inlineFormCustomSelect">Тип товара:</label>
    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="type">
        <option selected>Выберите тип товара</option>
        <option value="Верхняя одежда">Верхняя одежда</option>
        <option value="Обувь">Обувь</option>
        <option value="Джинсы">Джинсы</option>
    </select>
    <br><br>

    <p>Размеры товара:</p>
    <?php for($size = 30; $size <=60; $size++) : ?>

    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="size[]" id="<?= $size ?>" value="<?= $size ?>">
        <label class="form-check-label" for="<?= $size ?>"><?= $size ?></label>
    </div>

    <?php endfor ; ?>

    <br><br>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>

<script src="js/product_add.js"></script>

<?php include('parts/footer.php'); ?>