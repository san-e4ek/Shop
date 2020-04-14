<?php
/**
 *
 * Каталог товаров
 *
 */

$header_config = [
    'title' => 'Каталог товаров',
    'style' => 'catalog.css'
];

include('parts/header.php');

$category_id = 4;


if (!empty($_GET['category_id'])) {
    // (int) '10' - переведет из строки '10' в число 10
    $category_id = (int)$_GET['category_id'];
}

$sql_category = "SELECT * FROM categories WHERE id='{$category_id}'";
$result_category = mysqli_query($link, $sql_category);

$category = mysqli_fetch_assoc($result_category);

$sql_price_range = "SELECT * FROM price_range";
$result_price_range = mysqli_query($link, $sql_price_range);

?>

<div class="catalog" data-category-id="<?= $category['id'] ?>">
    <div class="catalog-header">
        <h1 class="catalog-title"><?= $category['name'] ?></h1>
        <div class="catalog-subtitle">Все товары</div>
    </div>

    <form name="filter" method="GET" class="label-wrap">
        <div class="form-group">
            <select class="label" name="type" value="Категория">
                <option>Категория</option>
                <option value="Верхняя одежда">Верхняя одежда</option>
                <option value="Обувь">Обувь</option>
                <option value="Джинсы">Джинсы</option>
            </select>
        </div>

        <div class="form-group">
            <select class="label" name="size">
                <option>Размер</option>
            </select>
        </div>

        <div class="form-group">
            <select class="label" name="price">
                <option>Стоимость</option>
                <?php while ($row = mysqli_fetch_assoc($result_price_range)) : ?>
                    <option class="price-range" value = "<?= $row['min'] ?>-<?= $row['max'] ?>"><?= $row['min'] ?>-<?= $row['max'] ?></option>
                <?php endwhile ; ?>
            </select>
        </div>
    </form>

    <div class="catalog-list"></div>

    <div class="loader">
        <span>Загрузка...</span>
        <div class="loader__coub"></div>
    </div>

    <div class="page-wrap"></div>
</div>

<?php
$footer_config = [
    'script' => 'catalog.js'
];

include('parts/footer.php');
?>
