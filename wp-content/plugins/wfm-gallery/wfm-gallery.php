<?php /*
 Plugin Name: Gallery
 Description: Use shortcode view: [gallery ids="1,2,3"], where in the ids attribute specify the ID of the pictures
 Author: Drobotko Taras
 Author URI: http://m662449k.beget.tech/
 Version: 1.1.0
 */

add_action( 'wp_enqueue_scripts', 'wfm_styles_scripts');
add_action('admin_init', 'wfm_gallery_options');
register_deactivation_hook(__FILE__, 'wfm_delete_options');

function wfm_delete_options() {
   delete_option('wfm_delete_options');
}

function wfm_gallery_options() {
    register_setting('general', 'wfm_gallery_options');

    add_settings_section('gallery_section_id', 'Gallery options', '', 'general');

    add_settings_field('gallery_option_title', 'The name of gallery', 'wfm_gallery_title', 'general', 'gallery_section_id');
    add_settings_field('gallery_option_text', 'Text in the absence of images', 'wfm_gallery_text', 'general', 'gallery_section_id');
}

function wfm_gallery_title() {
  $options = get_option('wfm_gallery_options');
  ?>

  <input type="text" name="wfm_gallery_options[gallery_option_title]" class="regular-text" id="gallery_option_title" 
  value="<?php echo esc_attr($options['gallery_option_title']); ?>">
      <?php
}

function wfm_gallery_text() {
  $options = get_option('wfm_gallery_options');
  ?>

  <input type="text" name="wfm_gallery_options[gallery_option_text]" class="regular-text" id="gallery_option_text" 
  value="<?php echo esc_attr($options['gallery_option_text']); ?>">
      <?php
}

function wfm_styles_scripts() {
	wp_register_script( 'wfm-lightbox-js',  plugins_url( 'js/lightbox.min.js', __FILE__), array('jquery') );
	wp_register_style( 'wfm-ligtbox', plugins_url( 'css/lightbox.css', __FILE__) );
	wp_register_style( 'wfm-ligtbox-style', plugins_url( 'css/lightbox-style.css', __FILE__) );

	wp_enqueue_script( 'wfm-lightbox-js' );
	wp_enqueue_style( 'wfm-ligtbox' );
	wp_enqueue_style( 'wfm-ligtbox-style' );
}

remove_shortcode( 'gallery');
 add_shortcode('gallery', 'wfm_gallery');

 function wfm_gallery($atts) {
  $options = get_option('wfm_gallery_options');

  $img_id = explode(',', $atts['ids']);
  if(!$img_id[0]) return '<div class="wfm-gallery"><h3>'. $options['gallery_option_title'] .'</h3>'. $options['gallery_option_text'] .'</div>';
  $html = '<div class="wfm-gallery"><h3>'. $options['gallery_option_title'] .'</h3>';

  foreach($img_id as $item) {
  	$img_data = get_posts(
    array(
    	'p' => $item,
    	'post_type' => 'attachment',
    ));

  $image_alt = get_post_meta($item, '_wp_attachment_image_alt', TRUE);
   
   $img_title = $img_data[0]->post_title;
   $img_thumb = wp_get_attachment_image_src( $item );
   $img_full = wp_get_attachment_image_src( $item, 'full');
   $html .= "<a href='{$img_full[0]}' data-lightbox='gallery' data-title='{$img_title}'><img src='{$img_thumb[0]}' width='{$img_thumb[1]}' height='{$img_thumb[2]}' alt='{$image_alt}'></a>";
  }
  $html .= '</div>';
 	return $html;

 }