<?php
/**
 * Bootstrap file define some need constants and set inital settings
 * Date:      04.07.14
 * Time:      10:28
 * @author    Fukalov Sem <yapendalff@gmail.com>
 * @copyright <Trioris> ltd
 */
defined('DS') or define('DS', DIRECTORY_SEPARATOR);

defined('YII_BASE_PATH') or define('YII_BASE_PATH', __DIR__);
defined('YII_PATH') or define('YII_PATH', YII_BASE_PATH.'/../yii/framework');
defined('YII_CONFIG') or define('YII_CONFIG', YII_BASE_PATH.'/config');

defined('YII_PROFILE') or define('YII_PROFILE', true);

//Here two constants setted in Debugger yii ext. Disable here in production (via enviroments )
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);
defined('YII_DEBUG') or define('YII_DEBUG', true);

/**
 * Set the default time zone.
 * @see  http://php.net/timezones
 */
date_default_timezone_set('Europe/Moscow');

/**
 * Set the default locale.
 * @see  http://php.net/setlocale
 */
setlocale(LC_ALL, 'ru_RU.utf-8');

/** Include Composer autoloader */
if( is_file(YII_BASE_PATH.'/vendor/autoload.php') ) {
    require_once(YII_BASE_PATH.'/vendor/autoload.php');
}

/** include Debugger if exists */
if (class_exists('Debugger')) {
    Debugger::init( YII_BASE_PATH . '/runtime/debug');
}

require(YII_BASE_PATH . '/helpers/global.php');