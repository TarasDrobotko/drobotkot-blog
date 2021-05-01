<?php /*
 Plugin Name: Google-карты для сайта
 Description: Для вывода карты используйте шорткод вида: [map center="город, область, страна" width="600" height="300" zoom="13"]Описание карты[/map]
 Plugin URI: http://m662449k.beget.tech/
 Author: Дроботько Тарас
 Author URI: http://m662449k.beget.tech/
 Version: 1.0.0
 */

 /*add_shortcode( 'test', 'wfm_test' );

 function wfm_test($atts, $content) {*/
 	   // $content= !empty($content) ? $content : 'Tестовые данные:';
     // $user = isset($atts['user']) ? $atts['user'] : 'Name';
 	//return "<h3>$content</h3><p>Привет, {$user}!</p>";
 	  /*  $atts = shortcode_atts( 
             array(
               'user' => 'Name',
               'login' => 'taras',
               'content' => !empty($content) ? $content : 'Tестовые данные:'
             ), $atts
 	    );
 	    extract($atts);
 	    //return "<h3>{$atts['content']}</h3><p>Привет, {$atts['user']}!</p>";
      return "<h3>{$content}</h3><p>Привет, {$user}!</p>";*/
 //}
add_shortcode( 'map', 'wfm_map' );

function wfm_map($atts, $content) {
     $atts = shortcode_atts( 
             array(
               'center' => 'Киев, город Киев, Украина',
               'width' => 600,
               'height' => 300,
               'zoom' => 13,
               'content' => !empty($content) ? "<h2>$content</h2>" : "<h2>Карта от Гугла</h2>"
             ), $atts
 	    );
     $atts['size'] = $atts['width'] .'x'. $atts['height'];
     $atts['center'] = str_replace(' ', '+', $atts['center']);
     extract($atts);

 	    $map = $content;
 	    $map .= '<img src="https://maps.googleapis.com/maps/api/staticmap?center=' . $center . '&zoom='. $zoom .'&size='. $size .'&key=" alt="">';
      return $map;
}
