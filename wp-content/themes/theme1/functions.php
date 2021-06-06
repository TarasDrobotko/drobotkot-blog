<?php

/*
 maintenance mode
*/
// function wp_maintenance_mode()
// {
// 	if (!current_user_can('edit_themes') || !is_user_logged_in()) {
// 		wp_die('<h1 style="color:red">Сайт знаходиться на технічному обслуговуванні. </h1><br />Як тільки роботи будуть завершені, ми з вами знову зустрінемося!');
// 	}
// }
// add_action('get_header', 'wp_maintenance_mode');


/*
    Downloadable scripts and styles
 */
function load_style_script()
{
	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
	wp_enqueue_script('my_jquery', get_template_directory_uri() . '/js/jquery-1.9.0.min.js',  array(), false, true);
	wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/custom_scripts.js', array('my_jquery'), false, true);
	wp_enqueue_script('like_post', get_template_directory_uri() . '/js/post-like.js', array('my_jquery'), '1.0', true);
	wp_localize_script('like_post', 'ajax_var', array(
		'url' => admin_url('admin-ajax.php'),
		'nonce' => wp_create_nonce('ajax-nonce')
	)); ?>

	<?php
	$translation_array = array(
		'placeholder' => __('Ваш e-mail', 'theme1'),
		'title' => __('Заповніть це поле, будь ласка', 'theme1'),
		'subscribe_heading' => __('Підписка на коментарі', 'theme1'),
		'text_before_visitor_rating' => __('Натисніть, щоб оцінити цей пост!', 'theme1'),
		'user_has_already_rated' => __('Ви вже оцінили цей пост', 'theme1'),
		'text_after_visitor_rating_1' => __('Всього голосів: ', 'theme1'),
		'text_after_visitor_rating_2' => __('Середня оцінка: ', 'theme1'),
		'show_social_icons' => __('Показати соціальні іконки', 'theme1'),
		'hide_social_icons' => __('Сховати соціальні іконки', 'theme1'),
		'title_arrow_up' => __('Наверх', 'theme1')
	);
	wp_localize_script('custom-scripts', 'langvars', $translation_array);

	wp_enqueue_style('default', get_template_directory_uri() . '/style.css');
}

/*
    Load scripts and styles
 */

add_action('wp_enqueue_scripts', 'load_style_script');

add_action('wp_ajax_nopriv_post-like', 'post_like');
add_action('wp_ajax_post-like', 'post_like');
/* count and write likes */
function post_like()
{
	$nonce = $_POST['nonce'];
	if (!wp_verify_nonce($nonce, 'ajax-nonce'))
		die('Busted!');
	if (isset($_POST['post_like'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
		$post_id = $_POST['post_id'];
		$meta_IP = get_post_meta($post_id, "voted_IP");
		$voted_IP = $meta_IP[0];
		if (!is_array($voted_IP))
			$voted_IP = array();
		$meta_count = get_post_meta($post_id, "votes_count", true);
		if (!hasAlreadyVoted($post_id)) {
			$voted_IP[$ip] = time();
			update_post_meta($post_id, "voted_IP", $voted_IP);
			update_post_meta($post_id, "votes_count", ++$meta_count);
			echo $meta_count;
		} else
			echo "already";
	}
	exit;
}

function hasAlreadyVoted($post_id)
{
	global $timebeforerevote;
	$timebeforerevote = 120;
	$meta_IP = get_post_meta($post_id, "voted_IP");
	$voted_IP = $meta_IP[0];
	if (!is_array($voted_IP))
		$voted_IP = array();
	$ip = $_SERVER['REMOTE_ADDR'];
	if (in_array($ip, array_keys($voted_IP))) {
		$time = $voted_IP[$ip];
		$now = time();
		if (round(($now - $time) / 60) > $timebeforerevote)
			return false;
		return true;
	}
	return false;
}

function getPostLikeLink($post_id)
{
	$vote_count = get_post_meta($post_id, "votes_count", true);
	$output = '';
	if (hasAlreadyVoted($post_id)) {
		$output .= '<div class="svg_bottom_ico"><div class="like_ico is-active">Подобається </div></div>';
		$output .= '<span class="likecount"> ' . $vote_count . '</span>';
	} else {
		$output .= '<div class="svg_bottom_ico"><div class="like_ico noactive_svg" data-post_id="' . $post_id . '">Подобається </div></div>';
		$output .= '<span class="likecount"> ' . $vote_count . '</span>';
	}
	return $output;
}

/*
    support of the miniatures
 */
add_theme_support('post-thumbnails');

//menu

add_theme_support('top');

add_shortcode('footag', 'footag_func');

/*
    added widgets
 */
register_sidebar(array(
	'name' => 'Меню',
	'id' => 'menu_header',
	'before_widget' => '',
	'after_widget' => '',
));

register_sidebar(array(
	'name' => 'Sidebar',
	'id' => 'sidebar',
	'before_widget' => '<div class="sidebar-widget %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));

register_sidebar(array(
	'name' => 'Footer',
	'id' => 'footer',
	'before_widget' => '<div class="footer-info %2$s">',
	'after_widget' => '</div>',
	'before_title' => '<h3>',
	'after_title' => '</h3>'
));


function adjust_single_breadcrumb($link_output)
{
	if (strpos($link_output, 'breadcrumb_last') !== false) {
		$link_output = '';
	}
	return $link_output;
}

add_filter('wpseo_breadcrumb_single_link', 'adjust_single_breadcrumb');
/*
    change the length of the announcement of the post
 */
add_filter('excerpt_length', function () {
	return 30;
});

function commentCount()
{
	global $wpdb;
	$count = $wpdb->get_var('SELECT COUNT(comment_ID) FROM ' . $wpdb->comments . ' WHERE comment_author_email = "' . get_comment_author_email() . '"');
	echo $count;
}

function delete_comment_link($id)
{
	if (current_user_can('edit_post')) {
		echo ' <a href="' . admin_url("comment.php?action=cdc&c=$id") . '">(Видалити)</a>';
		echo ' <a href="' . admin_url("comment.php?action=cdc&dt=spam&c=$id") . '">(Спам)</a>';
	}
}
//view of comment
function mytheme_comment($comment, $args, $depth)
{
	$GLOBALS['comment'] = $comment;
	switch ($comment->comment_type):
		case '':
	?>
			<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
				<div id="comment-<?php comment_ID(); ?>">
					<div id="comment_block">
						<div class="comment-author vcard">
							<?php echo get_avatar($comment->comment_author_email, $args['avatar_size']); ?>
							<?php printf(__('<cite class="fn">%s</cite> <span class="says"></span>'), get_comment_author_link()) ?>
							<div class="comment-meta commentmetadata">
								<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)) ?>"><?php printf(__('%1$s at %2$s'), get_comment_date(),  get_comment_time()) ?></a><?php edit_comment_link(__('Змінити '), '&nbsp;&nbsp;', '');
																																														delete_comment_link(get_comment_ID()); ?>
								<div class="coll_comm">Коментарів: <?php commentCount(); ?></div>
							</div>
						</div>
						<?php if ($comment->comment_approved == '0') : ?>
							<div class="comment-awaiting-verification"><?php _e('Ваш коментар чекає перевірки модератором.') ?></div>
							<br>
						<?php endif; ?><div class="comment_text">
							<?php if ($comment->comment_approved != '0') : ?>
								<?php comment_text() ?>
							<?php endif; ?>
						</div>
						<div class="reply">
							<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
						</div>
						<div class="clear"></div>
					</div>
				</div>

			<?php
			break;
		case 'pingback':
		case 'trackback':
			?>
			<li class="post pingback">
				<?php comment_author_link(); ?>
				<?php edit_comment_link(__('Редагувати'), ' '); ?>
				<?php
				break;
		endswitch;
	}

	/*
   banner
*/
	function banner_posts()
	{
		register_post_type('banner', array(
			'labels'             => array(
				'name'               => 'Банери',
				'singular_name'      => 'Банер',
				'add_new'            => 'Добавити новий',
				'add_new_item'       => 'Добавити новий банер',
				'edit_item'          => 'Редагувати банер',
				'new_item'           => 'Новий банер',
				'view_item'          => 'Переглянути банер',
				'search_items'       => 'Найти банер',
				'not_found'          =>  'Банерів не знайдено',
				'not_found_in_trash' => 'В кошику банерів не знайдено',
				'parent_item_colon'  => '',
				'menu_name'          => 'Банери'

			),
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => true,
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array('title', 'thumbnail')
		));
	}
	add_action('init', 'banner_posts');

	function plural_form($number, $after)
	{
		$cases = array(2, 0, 1, 1, 1, 2);
		echo $number . ' ' . $after[($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[min($number % 10, 5)]];
	}

	add_theme_support('title-tag');
	/**
	 * Modify the document title for the search page
	 */
	add_filter('pre_get_document_title', 'my_get_document_title', 999, 1);
	function my_get_document_title()
	{
		if (is_search()) {
			$title = sprintf(
				'Результати пошуку &#8220;%s&#8221;',
				get_search_query()
			);
			$title = $title + ' - ' + get_bloginfo('site');
		}

		return $title;
	};

	function estimated_reading_time()
	{
		$post = get_post();
		$postcnt = strip_tags($post->post_content);
		$words = count(preg_split('/\s+/', $postcnt));
		$minutes = floor($words / 120);
		$seconds = floor($words % 120 / (120 / 60));
		if (1 <= $minutes) {
			$min_text = __(' хв на читання', 'theme1');
			$estimated_time = $minutes . $min_text;
		} else {
			$sec_text = __(' сек на читання', 'theme1');
			$estimated_time = $seconds . $sec_text;
		}
		echo $estimated_time;
	}

	// views
	function getPostViews($postID)
	{
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
			return "0";
		}
		return $count;
	}

	function setPostViews($postID)
	{
		$count_key = 'post_views_count';
		$count = get_post_meta($postID, $count_key, true);
		if ($count == '') {
			$count = 0;
			delete_post_meta($postID, $count_key);
			add_post_meta($postID, $count_key, '0');
		} else {
			$count++;
			update_post_meta($postID, $count_key, $count);
		}
	}

	// recommend posts
	function recommend()
	{
		global $post;
		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
			$args = array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID),
				'showposts' => 5,
				'caller_get_posts' => 1
			);
			$my_query = new wp_query($args);
			if ($my_query->have_posts()) {
				echo '<h2>Подібні записи</h2><ul>';
				while ($my_query->have_posts()) {
					$my_query->the_post();
				?>
			<li class="recom-post">
				<ul>
					<li class="recom-post-image">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
					</li>
					<li><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></li>
				</ul>
			</li>
<?php
				}
				echo '</ul>';
			}
			wp_reset_query();
		}
	};

	function get_theme_logo()
	{
		if (substr_count(get_theme_mod('logo', "/images/logo-3.png"), 'http') == 1) {
			echo get_theme_mod('logo', "/images/logo-3.png");
		} else {
			bloginfo('template_url');
			echo get_theme_mod('logo', "/images/logo-3.png");
		}
	}

	add_action('after_setup_theme', 'my_theme_setup');
	function my_theme_setup()
	{
		load_theme_textdomain('theme1', get_template_directory() . '/');
	}

	add_action('after_setup_theme', 'theme_register_nav_menu');
	function theme_register_nav_menu()
	{
		register_nav_menu('top', 'Меню в шапці');
	}
