<?php /*
 Plugin Name: Первый виджет
 Description:  Простейший текстовый виджет
 Plugin URI: http://m662449k.beget.tech/
 Author: Дроботько Тарас
 Author URI: http://m662449k.beget.tech/
 Version: 1.0.0
 */

add_action('widgets_init', 'wfm_first_widget');

function wfm_first_widget() {
	register_widget( 'WFM_Widget' );	
}

class WFM_Widget extends WP_Widget {
	function __construct() {
	/*parent::__construct(
     //ID, name, args(description) 
		'wfm_fw',
		'Мой первый виджет',
		array('description' => 'Описание виджета')
	);*/
	$args = array(
    'name' => 'Мой первый виджет 2',
    'description' => 'Описание виджета 2',
    'classname' => 'wfm-test'
	);
	parent::__construct('wfm_fw', '', $args);
}

  function widget($args, $instance) {
     extract($args);
     extract($instance);

  $title = apply_filters( 'widget_title', $title );
  $text = apply_filters( 'widget_text', $text );

  echo $before_widget;
  echo $before_title . $title . $after_title;
  echo $text;
  echo $after_widget;
  }
  
  function form($instance) {
  	extract($instance);
  	
?>
   <p>
   	<label for="<?php echo $this->get_field_id('title'); ?>">Заголовок:</label>
   	<input type="text" name="<?php echo $this->get_field_name('title'); ?>" id="<?php echo $this->get_field_id('title'); ?>" value="<?php if(isset($title)) echo esc_attr($title); ?>" class="widefat">
   </p>

   <p>
   	<label for="<?php echo $this->get_field_id('text'); ?>">Текст:</label>
    <textarea class="widefat" name="<?php echo $this->get_field_name('text'); ?>" id="<?php echo $this->get_field_id('text'); ?>" cols="20" rows="5"><?php if(isset($text)) echo esc_attr($text); ?></textarea>

   </p>
<?php
  }

  function update($old_instance, $new_instance) {
  $new_instance['title'] = !empty($new_instance['title']) ? strip_tags($new_instance['title']) : '';
   $new_instance['text'] = str_replace('<p>', '', $new_instance['text']);
   $new_instance['text'] = str_replace('</p>', '<br>', $new_instance['text']);
   return $new_instance;
  }
}
