<?php 
if(!defined('WP_UNINSTALL_PLUGIN')) exit;

global $wpdb;

include dirname(__FILE__) . '/wfm-check.php';

if(wfm_check_table('wfm_views')) {
$query =  'DROP INDEX IDX_C27C9369667D1AF ON wfm_views ';
$wpdb->query($query);

$query1 = "ALTER TABLE wfm_views DROP FOREIGN KEY FK_C27C9369667D1AF ";
$wpdb->query($query1);
}

$query = "DROP TABLE IF EXISTS wfm_views";
$wpdb->query($query);
