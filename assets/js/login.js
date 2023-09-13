window.addEventListener("load", ev => {
    let login_button = document.getElementById('wp-submit');
    let login_username_field = document.getElementById('user_login');
    let login_password_field = document.getElementById('user_pass');
    let login_logo = document.getElementById('login').getElementsByTagName('h1')[0].getElementsByTagName('a')[0];

    login_logo.href = "https://mekatronik.ir/";
    login_logo.target = '_blank';
    login_logo.innerHTML = "mekatronik.ir";

    login_button.disabled = true;

    let password_valid = false, username_valid = false;
    login_username_field.addEventListener('input', function () {
        username_valid = this.value.length >= 1;
        login_button.disabled = !(password_valid && username_valid);
    });
    login_password_field.addEventListener('input', function () {
        password_valid = this.value.length >= 1;
        login_button.disabled = !(password_valid && username_valid);
    });

});