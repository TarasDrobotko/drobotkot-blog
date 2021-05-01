<?php /**
 * Plugin Name: Простая капча для формы комментирования
 * Description: Плагин удаляет поле для сайта и добавляет чекбокс для проверки на человечность
 * Plugin URI: http://m662449k.beget.tech/
 * Author: Тарас
 * Author URI: http://m662449k.beget.tech/
 * Version: 1.0.0
 */

//add_filter('comment_form_default_fields','wfm_captcha');

//add_filter( 'preprocess_comment' , 'wfm_check_captcha' );
add_filter( 'preprocess_comment' , 'wfm_check_captcha' );
add_filter('comment_form_field_comment','wfm_captcha2');



function wfm_captcha($fields) {
	unset($fields['url']);
	$fields['captcha'] = '<p>
    <label for="captcha">Капча <span class="required">*</span></label>
    <input type="checkbox" name="captcha" id="captcha">
	</p>';
    return $fields;
    //var_dump($fields);
}

/*function wfm_check_captcha( $commentdata ) {
	if( is_user_logged_in()) return $commentdata;
	if(!isset($_POST['captcha'])) {
		wp_die( '<b>Ошибка</b>: вы не прошли проверку на человечность!');
	}
	return $commentdata;
}*/
function wfm_check_captcha( $commentdata ) {
	//print_r($commentdata);
	if( is_user_logged_in()) return $commentdata;

	//if(!isset($_POST['captcha'])) echo "Введите ответ";

	   if($_POST['captcha'] != $_SESSION['res']) {
		wp_die( '<b>Ошибка</b>: дан неверный ответ!');
	}
	return $commentdata;
}

function wfm_captcha2($comment_field) {
 	if( is_user_logged_in()) return $commentdata;
 	$a = rand(1,10);
     $b = rand(1,10);
     $_SESSION['res'] = $a + $b;
 	 	$comment_field .= '<p>
 	 	<label for="captcha">Капча <span class="required">*</span></label>'.  
      $a . ' + '. $b . ' = ? <br>' .
     'Введите ответ: <input type="number" name="captcha" id="captcha">'.
 	'</p>'; 
     return $comment_field;
 } 



// function wfm_captcha2($comment_field) {
// 	if( is_user_logged_in()) return $commentdata;
// 	$comment_field .= '<p>
//     <label for="captcha">Капча <span class="required">*</span></label>
//     <input type="checkbox" name="captcha" id="captcha">
// 	</p>';
//     return $comment_field;
// }

