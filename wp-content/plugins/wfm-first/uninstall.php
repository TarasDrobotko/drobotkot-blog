<?php 
//2-й способ удаления плагина
//константа WP_UNINSTALL_PLUGIN определяется только после того, как был найден файл uninstall.php в папке плагина
if(!defined('WP_UNINSTALL_PLUGIN')) 
   exit;

wp_mail(get_bloginfo('admin_email'), 'Плагин удален 2', 'Произошло успешное удаление плагина 2');
