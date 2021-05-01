<?php /**
 * Plugin Name: Number of article views
 * Description: The plugin counts and shows the number of views of articles. Also the plugin creates table for the number of views in database.
 * Author: Drobotko Taras
 * Author URI: http://m662449k.beget.tech/
 * Version: 1.2.0
 */

include dirname(__FILE__) . '/wfm-check.php';

register_activation_hook(__FILE__, 'wfm_create_table');
add_filter('the_content', 'wfm_post_views');
add_action('wp_head', 'wfm_add_view');

function wfm_create_table()
{
    global $wpdb;
    if (!wfm_check_table('wfm_views')) {

        $query = "CREATE TABLE wfm_views (
	ID INT AUTO_INCREMENT NOT NULL,
	count_views INT NOT NULL DEFAULT '0', post_id INT NOT NULL, PRIMARY KEY(id)
)";
        $wpdb->query($query);
        $query1 = 'CREATE INDEX IDX_C27C9369667D1AF ON wfm_views (post_id)';
        $wpdb->query($query1);

        $query2 = 'ALTER TABLE wfm_views ADD CONSTRAINT FK_C27C9369667D1AF FOREIGN KEY (post_id) REFERENCES wp_posts (id)';
        $wpdb->query($query2);

        $query3 = "INSERT INTO wfm_views(post_id) SELECT ID FROM $wpdb->posts";
        $wpdb->query($query3);
    }
}

function wfm_add_view()
{
    if (!is_single()) {
        return;
    }

    global $post, $wpdb;

    $wfm_id = $post->ID;
    $view = $wpdb->get_results("SELECT count_views FROM wfm_views WHERE post_id = $post->ID", ARRAY_A);
   
    if(empty($view)) {
        $query4 = "INSERT INTO wfm_views(post_id) SELECT ID FROM $wpdb->posts WHERE ID = $post->ID";
        $wpdb->query($query4);

        $view = $wpdb->get_results("SELECT count_views FROM wfm_views WHERE post_id = $post->ID", ARRAY_A);
    } 

    $views = $view[0]['count_views'] + 1;
  
    $wpdb->update(
        'wfm_views',
        array('count_views' => $views),
        array('post_id' => $wfm_id)
    );
}

function wfm_post_views($content)
{
    if (is_page()) {
        return $content;
    }

    global $post, $wpdb;

    $view = $wpdb->get_results("SELECT count_views FROM wfm_views WHERE post_id = $post->ID", ARRAY_A);
    $views = $view[0]['count_views'];
    return $content . "<b>Кол-во просмотров:</b> " . $views;

}

