<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <?php wp_head(); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        #wp-support {
            color: <?php echo get_theme_mod('theme_slug_customizer_color'); ?>
        }
    </style>
</head>

<body>
    <div class="head-wrapper">
        <div class="head">
            <div class="head-logo">
                <?php if (is_front_page()) : ?>
                    <img src="<?php get_theme_logo(); ?>" alt="Logo" title="Логотип блогу" />
            </div>
        <?php else : ?>
            <a href="/"><img src="<?php get_theme_logo(); ?>" alt="Logo" title="Логотип блогу" /></a>
        </div>
    <?php endif; ?>
    <div class="head-name"><?php $banner = new WP_Query(array('post_type' => 'banner', 'posts_per_page' => 1)); ?>
        <?php if ($banner->have_posts()) : while ($banner->have_posts()) : $banner->the_post(); ?>
                <?php the_post_thumbnail('full'); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <p>Місце для банера 708х90</p>
        <?php endif; ?>
    </div>
    </div>
    </div>
    <div class="menu-wrapper">
        <div class="nav-toggle"><span></span></div>
        <div class="menu-main">

            <?php
            $args = array(
                'theme_location' => 'top',
                'menu' => 'Меню в шапці',
                'echo'  => 0
            );
            $menu = wp_nav_menu($args);

            $main_page = __('Головна', 'theme1');
            if (!is_front_page()) {
                $menu = preg_replace('~<li~', '<li><a href="' . home_url() . '" >' . $main_page . '</a></li><li', $menu, 1);
            }
            echo $menu;
            ?>
        </div>
    </div>