<?php /**
 * Plugin Name: Приклади роботи хуків
 * Description: Декілька прикладів роботи хуків
 * Plugin URI: http://m662449k.beget.tech/
 * Author: Тарас
 * Author URI: http://m662449k.beget.tech/
 * Version: 1.0.0
 */

 //example 1: "post number two"  in "Post Number Two" 
 //(также для кирилицы)
  add_filter('the_title', 'wfm_title');

function wfm_title($title) {
	if(is_admin()) return $title;
      return mb_convert_case($title, MB_CASE_TITLE, "UTF-8");
}


 //example 2, функция без доп. параметров, только для латиницы
//add_filter( 'the_title', 'ucwords');


//example 3, работа с контентом
/*add_filter('the_content',  'wfm_content');

 function wfm_content($content) {
 	if(is_user_logged_in()) return $content;
 	if(is_page) return $content;
   return '<div class ="wfm-access">
   <a href="'. home_url() .'/wp-login.php">Авторизуйтесь для просмотра контента</a></div>';
 }*/


//example 4: комментарий сохранен - отправляем письмо
 /*add_action( 'comment_post', 'wfm_comment_post' );

 function wfm_comment_post() {
 	wp_mail(get_bloginfo('admin_email'), 'Новый комментарий на сайте', 'На сайте появился новый комментарий!');
 }*/