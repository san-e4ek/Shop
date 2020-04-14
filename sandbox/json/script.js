const xhr = new XMLHttpRequest();
xhr.open('GET', '/sandbox/json/handler.php');
xhr.send();

xhr.addEventListener('load', function () {
    // JSON.parse() - принимает json и возвращает объект
    const response = JSON.parse(xhr.response);
    
    console.log(response);

    response.forEach((item) => {
        console.log(item.name, item.price);
    });
});
