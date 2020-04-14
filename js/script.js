// Окно уведомлений -----------------------

const $notice = document.querySelector('.notice-popup');

function notice(response) {
    $notice.classList.add('noticeAni');
    $notice.innerHTML = `<p>${response}</p>`;

    setTimeout(() => {
        $notice.classList.remove('noticeAni');
        $notice.innerHTML = '';
    }, 3000);
}

//-----------------------------------------


document.querySelector('.navbar-toggle').addEventListener('click', function () {
    let navbarMenu = document.querySelector('.navbar-menu');
    navbarMenu.classList.toggle('open');
});


// Клики на меню ---------------------------

const $navItems = document.querySelectorAll('.menu-item');

$navItems.forEach(function (item) {
    if (location.href === item.href) {
        item.classList.add('active');
    }
});

//------------------------------------------

// Popup-login и валидация -----------------

const $logIn = document.querySelector('.user-box__login');
const $logClose = document.querySelector('.popup-log__close');
const $popupLog = document.querySelector('.popup-log');
const $logForm = document.querySelector('.popup-log__form');
const $logSubmit = document.querySelector('.popup-log__form [type="submit"]');

// Toggle авторизации
$logIn.addEventListener('click', function () {
    if ($popupLog.classList.contains('open')) {
        $popupLog.classList.remove('open');
        $popupLog.style.opacity = 0;
        $popupLog.style.display = 'none';

        $logSubmit.disabled = true;
        $logForm.reset();

    } else {
        $popupLog.classList.add('open');
        $popupLog.style.display = 'block';

        setTimeout(function () {
            $popupLog.style.opacity = 1;
        }, 10);
    }

    // Кнопка Close
    $logClose.addEventListener('click', () => {
        if ($popupLog.classList.contains('open')) {
            $popupLog.classList.remove('open');
            $popupLog.style.opacity = 0;
            $popupLog.style.display = 'none';

            $logSubmit.disabled = true;
            $logForm.reset();
        }

    });
});

//Валидация и авторизация -------------------

$logForm.addEventListener('submit', function (e) {
    e.preventDefault();

    const xhr = new XMLHttpRequest();

    xhr.open('GET', `/handlers/handler_auth.php?email=${this.elements['email'].value}&password=${this.elements['password'].value}`);
    xhr.send();

    xhr.addEventListener('load', () => {
        const response = xhr.response;

        notice(response);
        this.reset();
        if (response != "Неверный логин или пароль") {
            setTimeout(() => {
                location.href = "/";
            }, 1000)
        }

    });

});


function checkFormLog(form) {
    let errorsCounter = 0;

    for (let i = 0; i < form.length - 1; i++) {

        if (!form[i].value.replace(/^\s+|\s+$/g, '')) {
            errorsCounter++;
        }
    }

    if (!errorsCounter > 0) {
        form[form.length - 1].disabled = false;
    } else {
        form[form.length - 1].disabled = true;
    }
};

//------------------------------------------

// Функции close/open popup ----------------

const $body = document.body;

function openPopup(popup) {
    $regBack.classList.add('openReg');
    popup.style.display = 'block';
    $body.style.overflow = 'hidden';
    setTimeout(() => {
        popup.style.opacity = 1;
    }, 500);
}

function closePopup(popup) {
    $regBack.classList.remove('openReg');
    popup.style.display = '';
    popup.style.opacity = 0;
    $body.style.overflow = '';
    popup.reset();
}

// Попап регистрации нового пользователя ---

const $regHref = document.querySelector('.reg-href');
const $regBack = document.querySelector('.registration');
const $regPopup = document.querySelector('.registration__popup');
const $regClose = document.querySelector('.registration__close');
const $errorReg = document.querySelector('.registration__error');

// Ссылка на регистрацию
$regHref.addEventListener('click', function () {
    openPopup($regPopup);
});

// Кнопка Close
$regClose.addEventListener('click', function () {
    closePopup($regPopup);
});


// Валидация submit


$regPopup.addEventListener('submit', function (e) {
    e.preventDefault();

    let errorCount = 0;

    let message = '';

    for (let i = 0; i < this.elements.length - 1; i++) {
        if (!this.elements[i].value.replace(/^\s+|\s+$/g, '')) {
            this.elements[i].style.borderLeft = '2px solid red';
            $errorReg.style.opacity = 1;
            errorCount++;
        }
    }

    if (errorCount == 0) {

        if (this.elements['password'].value !== this.elements['password-check'].value) {
            message = 'Пароли не совпадают';
            notice(message);
        } else if (!this.elements['agree'].checked) {
            message = 'Либо за меня выходи, либо закрой страницу! xD';
            notice(message);
        } else {

            let params = '';

            for (let i = 0; i < this.elements.length - 1; i++) {
                params += `${this.elements[i].name}=${this.elements[i].value}&`;
            }

            const xhr = new XMLHttpRequest();

            xhr.open('GET', `/handlers/handler_reg.php?${params}`);
            xhr.send();

            xhr.addEventListener('load', () => {
                const response = xhr.response;

                notice(response);
                this.reset();

                if (response != "Увы! :( супруга с таким email у меня уже есть") {
                    setTimeout(() => {
                        closePopup(this)
                    }, 1000)
                }
            });
        }
    }
});

// Валидация keyup
function checkKeyupFormReg(form) {
    for (let i = 0; i < form.length - 1; i++) {
        if (form[i].value.replace(/^\s+|\s+$/g, '')) {
            form[i].style.borderLeft = '';
            $errorReg.style.opacity = 0;
        }
    }
}


//------------------------------------------


// Форма забытого пароля -------------------

const $forgotHref = document.querySelector('.forgot-href');
const $forgotPopup = document.querySelector('.forgot-popup');
const $forgotClose = document.querySelector('.forgot-popup__close');
const $forgotError = document.querySelector('.forgot-popup__error');


$forgotHref.addEventListener('click', function () {
    openPopup($forgotPopup);
});

$forgotClose.addEventListener('click', function () {
    closePopup($forgotPopup);
});

$forgotPopup.addEventListener('submit', function (e) {
    e.preventDefault();

    if (!this.elements[0].value.replace(/^\s+|\s+$/g, '')) {
        $forgotError.style.opacity = 1;
    } else {

        const xhr = new XMLHttpRequest();

        xhr.open('GET', '/handlers/handler_main.php?email=' + this.elements[0].value);
        xhr.send();

        xhr.addEventListener('load', () => {
            const response = xhr.response;

            notice(response);
            this.reset();

            if (response != "К сожалению, пользователь с таким email не найден :(") {
                setTimeout(() => {
                    closePopup(this)
                }, 1000)
            }
        });
    }
});

function checkKeyupFormForgot(form) {
    if (form[0].value.replace(/^\s+|\s+$/g, '')) {
        $forgotError.style.opacity = 0;
    }
}

//------------------------------------------