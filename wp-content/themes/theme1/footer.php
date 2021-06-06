<div class="footer-info-wrapper">
    <div class="footer-info-main">
        <?php if (!dynamic_sidebar('footer')) : ?>

        <?php endif; ?>

    </div>
</div>

<div class="footer-copy">
    <p class="copy">Copyright © <?php echo date('Y');
                                _e(' Всі права захищені', 'theme1'); ?></p>
    <p class="by-st"><?php _e('Дизайн: Дроботько Тарас', 'theme1'); ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php $support = __('За підтримки ', 'theme1'); ?>
        <span id="wp-support"><?php if (get_theme_mod('hide_text') == '') echo get_theme_mod('example_textbox', $support . '<a href="https://wordpress.org/">Wordpress</a>'); ?></span>
    </p>
</div>
<script src="https://kit.fontawesome.com/220fa9c6a3.js" crossorigin="anonymous"></script>

<?php wp_footer(); ?>
</body>

</html>