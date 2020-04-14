<?php 
  //получение данных по количеству категорий и товаров в соответствующих категориях для дальнейшей отрисовки в футере
  $sql_category_list = "SELECT * FROM categories";
  $result_category_list = mysqli_query($link, $sql_category_list);

  while ($category = mysqli_fetch_assoc($result_category_list)) {

    if ($category['id'] != 4) {
      $sql_count = "SELECT COUNT(id) AS count FROM product_category WHERE category_id='{$category['id']}'";
      $result_count = mysqli_query($link, $sql_count);
      $count = mysqli_fetch_assoc($result_count)['count'];

      $categories[$category['id']] = ['name' => $category['name'], 'count' => $count];
    } else {
      $sql_count = "SELECT COUNT(id) AS count FROM products WHERE TIMESTAMPDIFF (HOUR, add_date, NOW()) < $product_remain_new";
      $result_count = mysqli_query($link, $sql_count);
      $count = mysqli_fetch_assoc($result_count)['count'];

      $categories[$category['id']] = ['name' => $category['name'], 'count' => $count];
    }


  }
?>


<footer class="footer">
  <div class="footer__container">
    <h3 class="title">Коллекции</h3>
    <?php foreach($categories as $id => $category) : ?>
      <a href="/catalog.php?category_id=<?= $id ?>" class="link"><?= $category['name'] ?> (<?= $category['count'] ?>)</a>
    <?php endforeach ; ?>
  </div>
  <div class="footer__container">
    <h3 class="title">Магазин</h3>
    <a href="#" class="link">О нас</a>
    <a href="#" class="link">Доставка</a>
    <a href="#" class="link">Работай с нами</a>
    <a href="#" class="link">Контакты</a>
  </div>
  <div class="footer__container">
    <h3 class="title">Мы в социальных сетях</h3>
    <p class="text">Сайт разработан в inordic.ru</p>
    <p class="text">2020 &copy; Все права защищены</p>
    <div class="social">
      <a class="fa fa-twitter" href="http://twitter.com" target="_blank"></a>
      <a class="fa fa-facebook" href="http://facebook.com" target="_blank"></a>
      <a class="fa fa-instagram" href="http://instagram.com" target="_blank"></a>
    </div>
  </div>
</footer>

</div>

<script src="/js/script.js"></script>
<script src="/js/<?= $footer_config['script'] ?>"></script>
</body>

</html>

<?php
mysqli_close($link);
?>