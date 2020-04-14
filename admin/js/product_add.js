'use strict';

document.addEventListener("DOMContentLoaded", function (e) {

  document.forms.add.img_url.addEventListener('change', function () {
    document.querySelector('.card-img-top').src = this.value;
  })

})