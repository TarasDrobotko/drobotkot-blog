<?php
/*
Plugin Name: Options && Settings Api
Description: Learn API options and settings
Plugin URI:  http://webformyself.com
Author: Taras
Author URI:  http://m662449k.beget.tech
*/

//add_option('wfm_test', 111);

add_action('admin_init', 'wfm_first_option');

function wfm_first_option() {
    register_setting(
        'general', //the page of the menu Settings for which the option is registered
        'wfm-first-option' // name of the option
    );

    add_settings_field(
    'wfm-first-option', // ID of the option (use for ID of the form field)
    'First option', // title of the option
    'wfm_option_html', // callback for the html code of the form field
    'general' //the page of the menu Settings for which the option is registered
    );
}

function wfm_option_html() {
    ?>

<input type="text" name="wfm-first-option" class="regular-text" id="wfm-first-option" 
value="<?php echo esc_attr(get_option('wfm-first-option')); ?>">
    <?php
}

//delete_option('wfm-first-option');




