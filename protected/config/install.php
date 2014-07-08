<?php
/**
 * Minimalistic config for yii app, used for \\Trioris\ComposerCallback
 * @author Fukalov Sem <yapendalff@gmail.com>
 * Date: 03.07.14
 * Time: 17:34
 */
include_once (__DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'bootstrap.php' );

include_once(YII_BASE_PATH . "/helpers/ConfigHelper.php");

return ConfigHelper::merge(array(
    array(
        'basePath'   => YII_BASE_PATH,
        'name'       => 'Install Skeletone Application',
        'aliases' => array(
            'app' => 'application',
            'vendor' => YII_BASE_PATH . '/vendor',
        ),
        // paths to import
        'import' => array(
            'app.helpers.*',
            'ext.yii-consoletools.commands.*'
        ),
    ),
    __DIR__ . '/_parts/db.php',
    __DIR__ . '/_parts/commandMap.php',
    __DIR__ . '/_parts/params.php',
));

