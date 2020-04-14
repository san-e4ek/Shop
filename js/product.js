//работаем с popup
const $popupSuccess = document.querySelector('.popup-success');
const $popupError = document.querySelector('.popup-error');

function popupHide() {
    let $popup = this.parentNode.parentNode;
    $popup.classList.add('hide');
    setTimeout(() => { $popup.style.zIndex = '-1' }, 500)
}
function popupShow() {
    this.classList.remove('hide');
    this.style.zIndex = '1';
}

document.querySelectorAll('.alert-box__close').forEach($item => {
    $item.addEventListener('click', popupHide)
})
document.querySelector('.alert-box__button--error').addEventListener('click', popupHide)

$popupSuccess.querySelector('.alert-box__button').addEventListener('click', () => {
    window.location.href = "/catalog.php"
})
$popupSuccess.querySelector('.alert-box__button--orange').addEventListener('click', () => {
    window.location.href = "/basket.php"
})


//добавляем товар в корзину
const $addToBasket = document.forms.addToBasket;

$addToBasket.addEventListener('submit', function (e) {
    e.preventDefault();

    const productId = this.submit.dataset.productId;
    let productSizes = [];

    document.querySelectorAll('input[type="checkbox"]').forEach(item => {
        if (item.checked) {
            productSizes.push(+item.value)
        }
    })

    if (productSizes.length == 0) {
        $popupError.querySelector('.alert-box__title').innerHTML = 'Пожалуйста выберите размеры товара <br>(можно выбирать сразу несколько).';
        popupShow.call($popupError);
    } else {

        let newProduct = {
            productId,
            productSizes
        }

        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/handlers/handler_product.php');

        xhr.setRequestHeader('Content-type', 'application/json; charset=utf-8');

        xhr.addEventListener('error', () => {
            $popupError.querySelector('.alert-box__title').innerHTML = 'К сожалению сервер не отвечает на запрос.<br> Пожалуйста попробуйте позднее.';
            popupShow.call($popupError);
        })

        xhr.addEventListener('load', function () {
            if (xhr.status != 200) {
                $popupError.querySelector('.alert-box__title').innerHTML = 'К сожалению в данный момент запрос не может быть выполнен по техническим причинам.<br> Пожалуйста попробуйте позднее.';
                popupShow.call($popupError);
            } else {
                popupShow.call($popupSuccess);
            }
            ;
        });

        let json = JSON.stringify(newProduct);

        xhr.send(json);
    }
});