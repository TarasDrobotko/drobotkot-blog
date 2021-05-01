<?php /**
 * Plugin Name: Перший плагін
 * Description: Мій перший плагін
 * Plugin URI: http://m662449k.beget.tech/
 * Author: Тарас
 * Author URI: http://m662449k.beget.tech/
 * Version: 1.0.0
 */
include dirname(__FILE__) . '/deactivate.php';

register_activation_hook(__FILE__, 'wfm_activate');
register_deactivation_hook(__FILE__, 'wfm_deactivate');
//register_uninstall_hook( __FILE__, 'wfm_uninstall' );

//1-й способ удаления (через register_uninstall_hook())
function wfm_uninstall() {
	wp_mail(get_bloginfo('admin_email'), 'Плагин активирован', 'Произошло успешное удаление плагина');
}

//1-й способ деактивации (через register_deactivation_hook())
/* function wfm_deactivate() {
	$date = "[". date("Y-m-d H:i:s") . "]";
	error_log($date . " Плагин деактивирован\r\n", 3, dirname(__FILE__). '/wfm_errors_log.log');
} */

function wfm_activate() {
	wp_mail(get_bloginfo('admin_email'), 'Плагин активирован', 'Произошла успешная активация плагина');
}
// Часть 1, урок 3, процедурный подход
/*register_activation_hook(__FILE__, 'wfm_activate');
function wfm_activate() {
	if(version_compare(PHP_VERSION, '5.3.0', '<')) {
		exit('Для работы плагина нужна версия >=5.3.0');
	}
}*/



// подход ООП c конструктором
/*class WFMActivate {
	function __construct() {
		register_activation_hook(__FILE__, array($this, 'wfm_activate'));
	}

		function wfm_activate() {
			$date = "[". date("Y-m-d H:i:s") . "]";
			error_log($date . " Плагин активирован\r\n", 3, dirname(__FILE__). '/wfm_errors_log.log');
		}
	}

$wfm_activate = new WFMActivate;
*/


// подход ООП без конструктора
/*class WFMActivate {
	
		static function wfm_activate() {
			$date = "[". date("Y-m-d H:i:s") . "]";
			error_log($date . " Плагин активирован\r\n", 3, dirname(__FILE__). '/wfm_errors_log.log');
		}
	}

	register_activation_hook(__FILE__, array('WFMActivate', 'wfm_activate'));*/