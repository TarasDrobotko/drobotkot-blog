<?php
/*
Plugin Name: Options && Settings Api 2
Description: Learn API options and settings
Plugin URI:  http://webformyself.com
Author: Taras
Author URI:  http://m662449k.beget.tech
 */

add_action('admin_init', 'wfm_theme_options');
add_action('wp_enqueue_scripts', 'wfm_scripts_styles');
register_deactivation_hook(__FILE__, 'wfm_delete_options');

function wfm_delete_options() {
    delete_option('wfm_theme_options');
}

function wfm_scripts_styles() {
   $wfm_theme_options = get_option('wfm_theme_options');
   wp_register_script('wfm-options2', plugins_url('wfm-options2.js', __FILE__), array('jquery') ); 
   wp_enqueue_script('wfm-options2');
   wp_localize_script('wfm-options2', 'wfmObj', $wfm_theme_options);
}

function wfm_theme_options()
{
    register_setting(
        'general', //the page of the menu Settings for which the option is registered
        'wfm_theme_options' // name of the option
    );

    add_settings_section(
        'wfm_theme_section_id', // section ID
        'Theme options', // title
        'wfm_theme_options_section_html', // callback for generation the html code
        'general' // for which page
    );

    add_settings_field(
        'wfm_theme_options_body', 
        'The background color',
        'wfm_theme_body_html',
        'general', 
        'wfm_theme_section_id'
    );

    add_settings_field(
        'wfm_theme_options_header', 
        'Color of header',
        'wfm_theme_header_html',
        'general', 
        'wfm_theme_section_id'
    );
}

function wfm_theme_options_section_html()
{
    echo '<p>Section for choose the color of background or header.</p>';

}

function wfm_theme_body_html() 
{
    $options = get_option('wfm_theme_options');
    ?>

    <input type="text" name="wfm_theme_options[wfm_theme_options_body]" class="regular-text" id="wfm_theme_options_body" 
    value="<?php echo esc_attr($options['wfm_theme_options_body']); ?>">
        <?php
}

function wfm_theme_header_html() {
    $options = get_option('wfm_theme_options');
    ?>

    <input type="text" name="wfm_theme_options[wfm_theme_options_header]" class="regular-text" id="wfm_theme_options_header" 
    value="<?php echo esc_attr($options['wfm_theme_options_header']); ?>">
        <?php
}
