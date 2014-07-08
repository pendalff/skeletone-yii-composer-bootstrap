<?php
require_once( __DIR__ . '/protected/bootstrap.php');
require_once(YII_PATH . '/yiilite.php');

$config = CONFIG_PATH.'/main.php';
Yii::createWebApplication($config)->run();
