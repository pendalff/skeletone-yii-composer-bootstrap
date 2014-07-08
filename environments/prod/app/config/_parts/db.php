<?php
/**
 * Database cfg
 * Date:      04.07.14
 * Time:      10:26
 * @author    Fukalov Sem <yapendalff@gmail.com>
 * @copyright <Trioris> ltd
 */
return array(
    'components' => array(
        'db' => array(
            'connectionString' => 'mysql:host=localhost;dbname=stat3',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'enableProfiling' => YII_DEBUG && YII_PROFILE,
            'enableParamLogging' => YII_DEBUG && YII_PROFILE,
        ),
    ),
);