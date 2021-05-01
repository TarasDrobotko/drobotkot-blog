<?php /**
 * Plugin Name: Количество просмотров статей
 * Description: Плагин считает и виводит количество просмотров статей
 * Plugin URI: http://m662449k.beget.tech/
 * Author: Тарас
 * Author URI: http://m662449k.beget.tech/
 * Version: 1.1.0
 */

include dirname(__FILE__) . '/wfm-check.php';

register_activation_hook( __FILE__, 'wfm_create_table' );
add_filter('the_content', 'wfm_post_views');
add_action('wp_head', 'wfm_add_view');

function wfm_create_table() {
	global $wpdb;
	if(!wfm_check_table('wfm_views')) {
	$query = "CREATE TABLE wfm_views (
	ID INT PRIMARY KEY,
	wfm_views INT NOT NULL DEFAULT '0'
)";
	$wpdb->query($query);

	$query1 = "INSERT INTO wfm_views(ID) SELECT ID FROM $wpdb->posts";
     $wpdb->query($query1);
}
}

function wfm_post_views($content) {
	if( is_page() ) return $content;
	global $post, $wpdb;
	//print_r($wpdb);
	
    $view = $wpdb->get_results("SELECT wfm_views FROM wfm_views WHERE ID = $post->ID", ARRAY_A);
	$views = $view[0]['wfm_views']; 
	return $content . "<b>Кол-во просмотров:</b> " . $views;	
	
}

function wfm_add_view() {
	if(!is_single()) return;
	global $post, $wpdb;

	$wfm_id = $post->ID;
	$views = $wpdb->get_results("SELECT wfm_views FROM wfm_views WHERE ID = $post->ID", ARRAY_A);
	$views = $views[0]['wfm_views'] + 1;
    //print_r($views);
    $wpdb->update(
        'wfm_views',
        array('wfm_views' => $views),
        array('ID' => $wfm_id)
    );
}
//DROP TABLE IF EXISTS tbl_name
//CREATE TABLE IF NOT EXISTS tbl_name
