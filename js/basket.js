'use strict';

document.addEventListener("DOMContentLoaded", function (e) {
  //общая функция XML запросов
  function requestGet(action, id, size, sizeAmount) {
    let xhr = new XMLHttpRequest();
    xhr.open('GET', `/handlers/handler_basket.php?action=${action}&id=${id}&size=${size}&sizeAmount=${sizeAmount}`);
    // xhr.addEventListener('load', () => {
    //   console.log(xhr.response);
    // });
    xhr.addEventListener('error', () => { console.error('ошибка!') });
    xhr.send();
  }

  function changeFinalPrice(sum) {
    let service = +document.querySelector('.list-item.service').textContent.slice(0, -5);

    document.querySelector('.centre.orange').textContent = `${sum} руб.`;
    document.querySelector('.list-item.price').textContent = `${sum} руб.`;
    document.querySelector('.list-item.final-price').textContent = `${sum + service} руб.`;
    document.forms.payment.price.value = sum;
    document.forms.payment['full-price'].value = +sum + +document.forms.payment.service.value;
  }

  //программируем кнопку "удалить" у товара
  let $deleteButtons = document.querySelectorAll('.basket-x');

  $deleteButtons.forEach((item) => {
    item.addEventListener('click', function () {
      if (confirm('Вы действительно хотите удалить данный товар?')) {
        //корректируем цену за товар и финальную цену
        let sum = +document.querySelector('.centre.orange').textContent.slice(0, -5);
        let priceDeleted = +item.parentNode.querySelector('.price.centre').textContent.slice(0, -5);
        sum -= priceDeleted;
        document.querySelector('.list-item.price').textContent = `${sum} руб.`;

        document.querySelector('.centre.orange').textContent = `${sum} руб.`;

        changeFinalPrice(sum);

        //удаляем товар из $_SESSION
        requestGet('remove', item.parentNode.dataset.productId, item.parentNode.dataset.productSize, item.parentNode.dataset.productSizeAmount);

        //удаляем элемент со страницы
        item.parentNode.remove();
      }
    })
  })

  //программируем кнопку "плюс" у товара
  let $plusButtons = document.querySelectorAll('.btn-plus');

  $plusButtons.forEach((item) => {
    item.addEventListener('click', function () {
      let $item = item.parentNode.parentNode;

      //корректируем количество на странице +1
      $item.querySelector('.count.centre span').textContent -= -1;

      //корректируем цену за товар и финальную цену
      let finalSum = +document.querySelector('.centre.orange').textContent.slice(0, -5);
      let amount = $item.querySelector('.count.centre span').textContent - 1;
      let sum = $item.querySelector('.price.centre').textContent.slice(0, -5);
      let cost = sum / amount;

      finalSum += cost;
      sum = +sum + cost;

      $item.querySelector('.price.centre').textContent = `${sum} руб.`;

      changeFinalPrice(finalSum);

      //добавляем товар в $_SESSION
      requestGet('plus', $item.dataset.productId, $item.dataset.productSize, $item.dataset.productSizeAmount);
    })
  })

  //программируем кнопку "минус" у товара
  let $minusButtons = document.querySelectorAll('.btn-minus');

  $minusButtons.forEach((item) => {
    item.addEventListener('click', function () {
      let $item = item.parentNode.parentNode;

      //проверим, не является ли товар единственным
      if ($item.querySelector('.count.centre span').textContent == 1) {
        $item.querySelector('.basket-x').click();
      } else {
        //корректируем количество на странице +1
        $item.querySelector('.count.centre span').textContent -= 1;

        //корректируем финальную цену
        let finalSum = +document.querySelector('.centre.orange').textContent.slice(0, -5);
        let amount = +$item.querySelector('.count.centre span').textContent + 1;
        let sum = $item.querySelector('.price.centre').textContent.slice(0, -5);
        let cost = sum / amount;

        finalSum -= cost;
        sum -= cost;
        $item.querySelector('.price.centre').textContent = `${sum} руб.`;

        changeFinalPrice(finalSum);

        //добавляем товар в $_SESSION
        requestGet('minus', $item.dataset.productId, $item.dataset.productSize, $item.dataset.productSizeAmount);
      }
    })
  })

  //меняем финальную сумму при изменении способа доставки
  let $formSelectService = document.forms.payment.service;

  $formSelectService.addEventListener('change', function () {
    let service = +this.value;
    let currentSum = +document.querySelector('.list-item.price').textContent.slice(0, -5);

    document.querySelector('.list-item.service').textContent = `${service} руб.`;
    document.querySelector('.list-item.final-price').textContent = `${currentSum + service} руб.`;
    document.forms.payment['full-price'].value = +currentSum + +service;

  })


  //валидация данных формы при отправке
  let $formСheckout = document.forms.payment;
  let $formСheckoutInput = $formСheckout.querySelectorAll('input:not([type="submit"])');

  $formСheckout.addEventListener('submit', function (e) {
    let errCount = 0;
    $formСheckoutInput.forEach($input => {
      if ($input.value == '') {
        $input.classList.add('error');
        errCount++;
      }
    })

    if (errCount != 0) {
      e.preventDefault();
      console.log($formСheckout.getBoundingClientRect().top);
      scrollUpTo($formСheckout);
    } else {
      //валидация и трансформация данных перед отправкой
      for (let $input of $formСheckoutInput) {
        $input.value = checkOutData.call($input);
      }
    }
  })

  function scrollUpTo($item) {
    if ($item.getBoundingClientRect().top < 0) {
      window.scrollBy(0, -40);
      setTimeout(() => {
        scrollUpTo($item);
      }, 10)
    }
  }

  //валидация данных каждого input при изменении
  for (let $input of $formСheckoutInput) {
    $input.addEventListener('input', checkOutData);
  }

  //функция проверки данных, возвращающая изменное значение
  function checkOutData() {
    let value = this.value.trim();
    let rule = this.dataset.rule;
    let err;
    switch (rule) {
      case "name":
        value = value.replace(/\d/gu, '');
        if (value.length == 0) { err = true } else { err = false }
        break;
      case "index":
        value = value.replace(/\D/gu, '');
        if (value.length != 6) { err = true } else { err = false }
        break;
      case "phone":
        value = value.replace(/\D/gu, '');
        if (value[0] == "7") value = '8' + value.slice(1);
        if (value.length != 11) { err = true } else { err = false }
        break;
      case "email":
        err = !(/^\w+@\w+\.\w+$/g.test(value));
        break;
      default:
        break;
    }

    if (err) {
      this.classList.add('error');
    } else {
      this.classList.remove('error');
    }

    return value;
  }
});