<?php // DO NOT DELETE THESE LINES
if (post_password_required()) {
    echo '<p class="nocomments">Эта запись защищена паролем. Введите пароль чтобы увидеть комментарии.</p>';
    return;
}
$oddcomment = "graybox";
?>
<?php if ($comments) : ?>

    <?php $post_id = get_the_ID();
    if (wp_count_comments($post_id)->approved) : ?>
        <h4 class="comments"><?php comments_number('Коментарі  %'); ?></h4>
    <?php endif; ?>
    <?php $args = array(
        'avatar_size'       => 70,
        'reply_text'       => __('Відповісти', 'theme1'),
        'callback'          => 'mytheme_comment',
    );
    ?>

    <ul class="comments-list"><?php wp_list_comments($args); ?></ul>
    <div id="comment-nav-above">
        <?php paginate_comments_links() ?>
    </div>
<?php else : ?>
    <?php if (comments_open()) : ?>
    <?php elseif (!is_page()) : // COMMENTS ARE CLOSED 
    ?>
        <h4>Комментарі заборонені.</h4>
    <?php endif; ?>
<?php endif; ?>
<?php if (comments_open()) : ?>
    <?php $comments_args = array(

        'comment_notes_after' => '',

    ); ?>


    <?php
    //structure of comments
    $args = array(
        'comment_notes_before' => '<p class="comment-notes"><a id="reg" href="/wp-login.php">' . __('Ввійдіть', 'theme1') . '</a>' . __(' чи заповніть поля нижче. Ваш e-mail не буде опублікований. Обов\'язкові поля відмічені *', 'theme1') . '</p>',
        'comment_field'        => '<p class="comment-form-comment "><label for="comment" >' . __('Ваш коментар', 'theme1') . '</label><br /> <textarea id="comment" name="comment" rows="8"  aria-required="true"></textarea></p>',
        'comment_notes_after'  => '',
        'id_submit'            => '',
        'label_submit'         => __('Відправити', 'theme1'),
    );
    comment_form($args);
    ?>
<?php endif; ?>