<div class="registration">
    <form class="registration__popup" method="POST"
          onkeyup="return checkKeyupFormReg(this.elements)">
        <div class="registration__close"></div>
        <h2 class="registration__title">Регистрация</h2>
        <div class="flex-box">
            <input type="text" name="first_name" placeholder="Ваше имя">
            <input type="text" name="last_name" placeholder="Ваша фамилия">
        </div>

        <input type="email" name="email" placeholder="Ваш E-mail">

        <div class="registration__error">
            <img src="/images/icons/warning.png">
            <span>не все поля заполнены</span>
        </div>

        <input type="password" name="password" placeholder="Придумайте пароль">
        <input type="password" name="password-check" placeholder="Повторите пароль">
        <label>
            <input type="checkbox" name="agree" value="yes">
            <span>Вы согласны выйти за меня!? ;D</span>
        </label>
        <input type="submit" value="зарегистрироваться">
    </form>

    <form class="forgot-popup" method="GET"
    onkeyup="return checkKeyupFormForgot(this.elements)">
        <div class="forgot-popup__close"></div>
        <p class="forgot-popup__text">Укажите свою почту при регистрации и мы направим Вам инструкцию, как восстановить
            пароль от личного кабинета</p>
        <div class="flex-box">
            <input type="email" name="email" placeholder="e-mail">
            <input type="submit" value="-->">
        </div>
        <p class="forgot-popup__error">Некорректный e-mail. Попробуйте еще раз.</p>
    </form>
</div>
