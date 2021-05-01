<?php 
if(!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;

include dirname(__FILE__) . '/wfm-check.php';
if(wfm_check_field('wfm_views')) {
$query = "ALTER TABLE $wpdb->posts DROP wfm_views";
	$wpdb->query($query);
}