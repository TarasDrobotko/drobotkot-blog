<?php
add_action('customize_register', function ($customizer) {

    $customizer->add_section(
        'example_section_one',
        array(
            'title' => 'Налаштування нижнього футера',
            'description' => '',
        )
    );

    $customizer->add_setting(
        'example_textbox',
        array('default' => 'За підтримки <a href="https://wordpress.org/">Wordpress</a>')
    );

    $customizer->add_control(
        'example_textbox',
        array(
            'label' => 'Налаштування тексту справа',
            'section' => 'example_section_one',
            'type' => 'text',
        )
    );

    $customizer->add_setting(
        'hide_text',
        array('default' => '')
    );

    $customizer->add_control(
        'hide_text',
        array(
            'type' => 'checkbox',
            'label' => 'Скрити текст',
            'section' => 'example_section_one',
        )
    );

    //add setting to your section
    $customizer->add_setting(
        'theme_slug_customizer_color',
        array(
            'default' => '#373737',
            'sanitize_callback' => 'sanitize_hex_color' //validates 3 or 6 digit HTML hex color code
        )
    );

    $customizer->add_control(
        new WP_Customize_Color_Control(
            $customizer,
            'theme_slug_customizer_color',
            array(
                'label'      => "Обрати колір для тексту",
                'section'    => 'example_section_one'
            )
        )
    );
});


function theme_slug_customizer($wp_customize)
{

    //your section
    $wp_customize->add_section(
        'theme_logo_section',
        array(
            'title' => 'Логотип сайту',
            'priority' => 11
        )
    );

    //file input sanitization function
    function theme_slug_sanitize_file($file, $setting)
    {

        //allowed file types
        $mimes = array(
            'jpg|jpeg|jpe' => 'image/jpeg',
            'gif'          => 'image/gif',
            'png'          => 'image/png'
        );

        //check file type from file name
        $file_ext = wp_check_filetype($file, $mimes);

        //if file has a valid mime type return it, otherwise return default
        return ($file_ext['ext'] ? $file : $setting->default);
    }


    //add select setting to your section
    $wp_customize->add_setting(
        'logo',
        array(
            'default' => '/images/logo-3.png',
            'sanitize_callback' => 'theme_slug_sanitize_file'
        )
    );


    $wp_customize->add_control(
        new WP_Customize_Upload_Control(
            $wp_customize,
            'logo',
            array(
                'label'    => 'Логотип',
                'section'  => 'theme_logo_section',
                'settings' => 'logo',
            )
        )
    );

    $wp_customize->selective_refresh->add_partial('logo', array(
        'selector' => '.head-logo',
        'render_callback' => function () {
            $img = get_theme_mod('logo');
            if (is_numeric($img)) :
?>
            <img src="<?php echo wp_get_attachment_url($img); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
<?php
            endif;
        },
    ));
}

add_action('customize_register', 'theme_slug_customizer');
