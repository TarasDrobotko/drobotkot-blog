<div class="footer-info-wrapper">
    <div class="footer-info-main">
        <?php if (!dynamic_sidebar('footer')) : ?>

        <?php endif; ?>

    </div>
</div>

<div class="footer-copy">
    <p class="copy">Copyright © <?php echo date('Y'); ?> Всі права захищені</p>
    <p class="by-st">Дизайн: Дроботько Тарас&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <span id="wp-support"><?php if (get_theme_mod('hide_text') == '') echo get_theme_mod('example_textbox', 'За підтримки <a href="https://wordpress.org/">Wordpress</a>'); ?></span></p>
</div>

<script src="https://kit.fontawesome.com/220fa9c6a3.js" crossorigin="anonymous"></script>

<?php wp_footer(); ?>
</body>

</html>