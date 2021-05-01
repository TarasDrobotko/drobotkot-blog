<?php
function wfm_check_table($table)
{
    global $wpdb;

    $table = $wpdb->esc_like($table);
    $link = esc_sql($table);
    $link = '%' . $link . '%';

    if ($wpdb->query("SHOW TABLES LIKE  '" . $link . "' ") == 1) {
        return true;
    } else {
        return false;
    }
}
