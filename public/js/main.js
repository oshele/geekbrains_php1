// $.post({
// 	url: '/action.php?id=1',
// 	data: {a: 1}
// });


function login() {
	const $login_input = $('[name="login"]');
	const $password_input = $('[name="password"]');

	const login = $login_input.val();
	const password = $password_input.val();

	const $error_field = $('.errors');

	console.log($error_field);

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
			data = JSON.parse(data);

			if(data.error.length) {
				$error_field.text(data.error);
			} else {
				location.reload();
			}
		}
	});
}