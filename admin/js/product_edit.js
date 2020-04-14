'use strict';

document.addEventListener("DOMContentLoaded", function (e) {

  document.forms.edit.img_url.addEventListener('change', function () {
    document.querySelector('.card-img-top').src = this.value;
  })

  //проверка наличия категорий
  let $productCategory = document.querySelector('.product_category');
  let productCategory = $productCategory.dataset.productCategory;
  let $inputProductCategory = document.querySelectorAll('.custom-control-input');

  if (!isNaN(productCategory)) {
    for (let $input of $inputProductCategory) {
      if ($input.dataset.category == productCategory) {
        $input.checked = true;
      }
    }
  } else {
    productCategory = productCategory.split(',');
    for (let $input of $inputProductCategory) {
      for (let item of productCategory) {
        if ($input.dataset.category == item) {
          $input.checked = true;
          break;
        }
      }
    }
  }

  //проверка типа товара
  const $select = document.getElementById('inlineFormCustomSelect');
  const $options = $select.getElementsByTagName('option');
  for (let i = 0; i < $options.length; i++) {
    if ($select.dataset.type === $options[i].value) {
      $options[i].selected = true;
    }
  }

})