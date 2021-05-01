<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
//define( 'WP_DEBUG', true );

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define('DB_NAME', 'mntdepqh_drobotkot');

/** Имя пользователя MySQL */
define('DB_USER', 'root');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', '');

/** Имя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '6-Po1aohWdm?^:}4%7s~#F.EVT}1Z!B85m_uMTifv]_sJ58+<C1(E_3O2rN|_!|n');
define('SECURE_AUTH_KEY',  'bs,NxszXL)OFwpV.jHzs/VWe0Qn]K,yL58,efRa*NC-otchY-vpJz?%WWWFC)de[');
define('LOGGED_IN_KEY',    'b7}%:M~{$[mm(XN:|>acSZF-]%9x&|z W}i,+{ wp^lxZ]V.D~>YkRcmB<Cm-RFp');
define('NONCE_KEY',        '}k!su*>3cWB!mEI)1;<XDWLa2x8J[reQ1yv|Jw~Sp82T_y=:lP*#bt(Gf!:)F(lE');
define('AUTH_SALT',        '16s-2p+F4L^[9)+>}x]Qh6.naJZ}oi?@7Xk(%~5O,F}pEjWn !>Y;Lb<DkqCA5Lg');
define('SECURE_AUTH_SALT', 'b#f9*qPfyokfId:)rfY%cI?Jr]CqzFP4o9M`AWmm?;KN]92jvemy3<l[oN7uXd9Z');
define('LOGGED_IN_SALT',   '?eHIjn:IiXM(};Khl|R:g~186f#8$_Cio>{e5|i0^5/:*s*T1&,aDUWf$mI[x{!]');
define('NONCE_SALT',       '2n`!W:7B3:L+ToLJRW,Nw[5#@85(nY83$KV~(y,M?nPtEJk>,Z4wMEA6h}J<7O`;');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'bd1wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Инициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');
