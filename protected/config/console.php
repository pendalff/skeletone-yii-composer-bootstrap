<?php
/**
 * Containes predefined yiic console commands.
 * Define composer hooks by the following name schema: <vendor>/<packageName>-<action>
 * @author Fukalov Sem <yapendalff@gmail.com>
 * Date: 03.07.14
 * Time: 17:34
 */
return ConfigHelper::merge(array(
    array(
        'basePath'   => YII_BASE_PATH,
        'name'       => 'Stat3 Console Application',
        'aliases' => array(
            'app' => 'application',
            'vendor' => YII_BASE_PATH . '/vendor'
        ),
        // components to preload
        'preload' => array('log'),
        // paths to import
        'import' => array(
            'app.helpers.*',
            'app.components.*',
            'ext.yii-consoletools.commands.*'
        ),
    ),
    __DIR__ . '/_parts/db.php',
    __DIR__ . '/_parts/logs.php',
    __DIR__ . '/_parts/commandMap.php',
    __DIR__ . '/_parts/params.php',
));

