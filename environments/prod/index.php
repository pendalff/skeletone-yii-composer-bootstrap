<?php
require_once( __DIR__ . '/protected/bootstrap.php');
require_once(YII_PATH . '/yiilite.php');

$config = YII_CONFIG.'/main.php';
Yii::createWebApplication($config)->run();
