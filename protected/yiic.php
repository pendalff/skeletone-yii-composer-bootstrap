<?php

require_once(__DIR__ . '/bootstrap.php');

defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('STDIN') or define('STDIN', fopen('php://stdin', 'r'));

require_once( YII_PATH. '/yii.php');
$config = include_once(YII_CONFIG . '/console.php');

if(isset($config))
{
    $app=Yii::createConsoleApplication($config);
    $app->commandRunner->addCommands(YII_PATH.'/cli/commands');
}
else
    $app=Yii::createConsoleApplication(array('basePath'=>dirname(__FILE__).'/cli'));

$env=@getenv('YII_CONSOLE_COMMANDS');
if(!empty($env))
    $app->commandRunner->addCommands($env);

$app->run();