function login() {
    const login = $('[name = "login_ajax"]').val();
    const password = $('[name = "password_ajax"]').val();

    const $message_field = $('.message');

    $.post({
        url: '/api.php',
        data: {
            apiMethod: 'login',
            postData: {
                login: login,
                password: password
            }
        },
        success: function (data) {
            if (data === 'OK') {
                location.reload(true);
            } else {
                $message_field.text(data);
            }
        }
    });
}

function register() {
    const login = $('[name = "newLogin_ajax"]').val();
    const password = $('[name = "newPassword_ajax"]').val();
    const name = $('[name = "newName_ajax"]').val();

    console.log(name);

    const $message_field = $('.message');

    $.post({
        url: '/api.php',
        data: {
            apiMethod: 'register',
            postData: {
                login: login,
                password: password,
                name: name
            }
        },
        success: function (data) {
            if (data === 'OK') {
                location.reload(true);
            } else {
                $message_field.text(data);
            }
        }
    });
}