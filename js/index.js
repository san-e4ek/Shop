// Анимация для меню header.php ------------

const $navMenu = document.querySelectorAll('.menu-item');
const $navMenuLog = document.querySelector('.user-box__login');
const $navMenuBasket = document.querySelector('.user-box__basket');
let delay = 0;

$navMenu.forEach(function (item) {

    item.classList.add('menuAni');
    item.style.animationDelay = `${delay / 3}s`;
    delay++;

});

$navMenuLog.classList.add('centre');
$navMenuBasket.classList.add('centre');


//------------------------------------------

// Валидация для subscribe -----------------

const $subForm = document.querySelector('.subscribe__form');
const $subError = document.querySelector('.subscribe__error');

$subForm.addEventListener('submit', function (e) {
    e.preventDefault();


    if (!this.elements[0].value.replace(/^\s+|\s+$/g, '')) {
        $subError.style.opacity = 1;
    } else {

        const xhr = new XMLHttpRequest();

        xhr.open('GET', '/handlers/handler_main.php?subscriber=' + this.elements[0].value);
        xhr.send();

        xhr.addEventListener('load', () => {
            const response = xhr.response;

            notice(response);
            this.reset();
        });
    }
});

function checkKeyupFormSubscribe(form) {
    if (form[0].value.replace(/^\s+|\s+$/g, '')) {
        $subError.style.opacity = 0;
    }
}

//------------------------------------------

// Delay для offerItems --------------------

const $offerItems = document.querySelectorAll('.offer .item');
delay = 0;

$offerItems.forEach(function (item) {
    item.style.animationDelay = `${delay / 3}s`;
    delay++;
})

//------------------------------------------
