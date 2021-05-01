<?php 
if(!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;


$query = "DROP TABLE IF EXISTS wfm_views";
	$wpdb->query($query);
