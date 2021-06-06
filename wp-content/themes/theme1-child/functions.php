<?php
//Remove "Remember Me" Checkbox from WordPress Login Page
add_action('login_head', 'remove_remember_me');
function remove_remember_me()
{
    echo '<style type="text/css">.forgetmenot { display:none; }</style>' . "\n";
}

include('customizer.php');

// function get_theme_logo()
// {
//     if (substr_count(get_theme_mod('logo', "/images/logo-3.png"), 'http') == 1) {
//         echo get_theme_mod('logo', "/images/logo-3.png");
//     } else {
//         bloginfo('template_url');
//         echo get_theme_mod('logo', "/images/logo-3.png");
//     }
// }
