<?php
    include('parts/header.php'); 
    d($_POST);
    // Если не передан параметр id делаем редирект на страницу с товарами
    if (!isset($_GET['id']) || (isset($_GET['id']) && empty($_GET['id']))) {
        header('Location: /admin/products.php');
    }

    // Сохранение банных в базе
    if (isset($_POST['edit'])) {
        $sql_update = "UPDATE products SET 
            img_url = '{$_POST['img_url']}',
            name = '{$_POST['name']}',
            description = '{$_POST['description']}',
            price = {$_POST['price']}
            WHERE id='{$_POST['id']}'";
        $result_update = mysqli_query($link, $sql_update);

        //конвертируем массив размеров товара в строку для отправки в базу
        $size_string = '['.implode(",", $_POST['size']).']';
        //отправляем категории в базу данных
        $sql_category_delete = "DELETE FROM product_category WHERE product_id='{$_POST['id']}'";
        mysqli_query($link, $sql_category_delete);
        foreach ($_POST['category'] as $key => $on) {
            $sql_add_category = "INSERT INTO product_category VALUES (null, '{$_POST['id']}', $key)";
            mysqli_query($link, $sql_add_category);
        }


        //отправляем размеры в базу
        $sql_size_update = "UPDATE product_sizes SET product_sizes = '{$size_string}' WHERE product_id='{$_POST['id']}'";
        $result_size_update = mysqli_query($link, $sql_size_update);

        if ($result_update && $result_size_update) {
            echo '<div class="alert alert-success" role="alert">
                    Ваши изменения сохранены!
                </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                    Не удалось сохранить изменения!
                </div>';
        }
    }

    $sql = "SELECT * from products WHERE id='{$_GET['id']}'";
    $result = mysqli_query($link, $sql);
    $data = mysqli_fetch_assoc($result);

    //запрос в базу по категориям товара
    $sql_categories = "SELECT * FROM categories WHERE NOT id = 4";
    $result_categories = mysqli_query($link, $sql_categories);

    //запрос в базу по категориям товара
    $sql_product_category = "SELECT * FROM product_category WHERE product_id = '{$data['id']}'";
    $result_product_category = mysqli_query($link, $sql_product_category);
    $product_category = [];
    while ($row_product_category = mysqli_fetch_assoc($result_product_category)) {
        $product_category[] = $row_product_category['category_id'];
    }
    $product_category_str = implode ( ',' , $product_category );

    //запрос в базу по размерам товара
    $query_size = "SELECT * FROM product_sizes WHERE product_id = '{$data['id']}'";
    $result_size = mysqli_query($link, $query_size);
    $row_size = mysqli_fetch_assoc($result_size);

    $arr_size = explode(",", preg_replace('%[^0-9 | ,]%', '', $row_size['product_sizes']));
?>

<h1>
    Редактирование товара "<?= $data['name']; ?>"
</h1>

<div class="card" style="width: 18rem;">
  <img src="<?= $data['img_url'] ?>" class="card-img-top" alt="Здесь подгрузится изображение">
</div>
<br>

<form method="POST" name="edit">
    <input type="hidden" name="edit" value="edit">

    <div class="form-group">
        <input type="text" class="form-control" placeholder="ID" name="id" value="<?= $data['id']; ?>" readonly>
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Путь до картинки" name="img_url" value="<?= $data['img_url']; ?>">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Название" name="name" value="<?= $data['name']; ?>">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Описание" name="description" value="<?= $data['description']; ?>">
    </div>

    <div class="form-group">
        <input type="text" class="form-control" placeholder="Цена" name="price" value="<?= $data['price']; ?>">
    </div>

    <p class="product_category" data-product-category = "<?= $product_category_str ?>">Выберите категории товара:</p>
    <?php while($row = mysqli_fetch_assoc($result_categories)) : ?>
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" name="category[<?= $row['id'] ?>]" data-category="<?= $row['id'] ?>" id="customCheck<?= $row['id'] ?>">
        <label class="custom-control-label" for="customCheck<?= $row['id'] ?>"><?= $row['name'] ?></label>
    </div>
    <?php endwhile ; ?>
    <br>

    <label class="mr-sm-2" for="inlineFormCustomSelect">Тип товара:</label>
    <select class="custom-select mr-sm-2" id="inlineFormCustomSelect" name="type" data-type="<?= $data['type']; ?>">
        <option value="Верхняя одежда">Верхняя одежда</option>
        <option value="Обувь">Обувь</option>
        <option value="Джинсы">Джинсы</option>
    </select>
    <br><br>

    <p>Выберите имеющиеся размеры:</p>
    <?php for($size = 30; $size <=60; $size++) : ?>

        <?php
            $checked = '';
            if (in_array($size , $arr_size)) {
                $checked = 'checked';
            }
        ?>
    <div class="form-check form-check-inline">
        <input class="form-check-input" type="checkbox" name="size[]" id="<?= $size ?>" value="<?= $size ?>" <?= $checked  ?>>
        <label class="form-check-label" for="<?= $size ?>"><?= $size ?></label>
    </div>

    <?php endfor ; ?>

    <br><br>
    <button type="submit" class="btn btn-primary">Сохранить</button>
</form>
<script src="js/product_edit.js"></script>

<?php include('parts/footer.php'); ?>