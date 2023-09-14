window.addEventListener("load", ev => {
    let login_button = document.getElementById('wp-submit');
    let login_username_field = document.getElementById('user_login');
    let login_password_field = document.getElementById('user_pass');
    // let MEKATRON_USERNAME_MIN_CHAR = {
    //     'username_min_character' : 1,
    //     'password_min_character': 1
    // };

    login_button.disabled = true;

    let password_valid = false, username_valid = false;
    login_username_field.addEventListener('input', function () {
        // username_valid = this.value.length >= MEKATRON_USERNAME_MIN_CHAR['username_min_character'];
        username_valid = this.value.length >= MEKATRON_USERNAME_MIN_CHAR.username_min_character;
        login_button.disabled = !(password_valid && username_valid);
    });
    login_password_field.addEventListener('input', function () {
        // password_valid = this.value.length >= MEKATRON_USERNAME_MIN_CHAR['password_min_character'];
        password_valid = this.value.length >= MEKATRON_USERNAME_MIN_CHAR.password_min_character;
        login_button.disabled = !(password_valid && username_valid);
    });

});