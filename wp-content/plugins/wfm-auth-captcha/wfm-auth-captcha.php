<?php /**
 * Plugin Name: Simple captcha for authorization form
 * Description: The plugin adds a simple check on humanity to the authorization form
 * Plugin URI: http://m662449k.beget.tech/
 * Author: Taras
 * Author URI: http://m662449k.beget.tech/
 * Version: 1.0.0
 */

// Change login error
// add_filter('login_errors', 'my_login_errors');

// function my_login_errors() {
//      return 'Ошибка авторизации';
// }

//Variant 1: add checkbox with error
add_action('login_form', 'wfm_captcha_login');
add_action('wp_authenticate', 'wfm_authenticate', 10, 2);

function wfm_captcha_login() {
    
echo '<p><label for="check"><input type="checkbox" name="check" id="check" value="check" checked> Uncheck </label></p>';
}

function wfm_authenticate($username, $password) {
if( isset($_POST['check']) && $_POST['check'] == 'check' ) {
//wp_die( ' Error </ b>: you didn’t pass the human test!' );
add_filter('login_errors', 'my_login_errors');
$username = null; 
}

}

function my_login_errors() {
return 'Error: you didn’t pass the human test!';
}



/* add_action('login_form', 'wfm_captcha_login');
add_filter('authenticate', 'wp_auth_signon', 30, 3);

function wp_auth_signon($user, $username, $password)
{
    if (isset($_POST['check']) && $_POST['check'] == 'check') {
        $user = new WP_Error('broke', '<b>Ошибка</b>: Вы бот?');
    }
    if (isset($user->errors['invalid_username']) || isset($user->errors['incorrect_password'])) {
        return new WP_Error('broke', '<b>Ошибка</b>: неверный логин/пароль');
    }
    return $user;
}

function wfm_captcha_login()
{
    echo '<p><label for="check"><input type="checkbox" name="check" id="check" value="check" checked> Снимите галочку </label></p>';
}
 */