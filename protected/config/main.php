<?php
/**
 * Основной конфиг веб-аппликухи
 * Date:      04.07.14
 * Time:      13:06
 * @author    Fukalov Sem <yapendalff@gmail.com>
 * @copyright <Trioris> ltd
 */
return ConfigHelper::merge(array(
    array(
        'basePath'   => YII_BASE_PATH . '/..',
        'name'       => 'Stat3 Application',
        'aliases' => array(
            'app' => 'application',
            'vendor' => YII_BASE_PATH . '/vendor',
            'bootstrap' => 'vendor.crisu83.yiistrap',
        ),
        // components to preload
        'preload' => array('log'),
        // paths to import
        'import' => array(
            'application.helpers.*',
            'application.components.*'
        ),
        // application behaviors
        'behaviors' => array(
            'maintain' => array(
                'class' => 'ext.yii-consoletools.behaviors.MaintainApplicationBehavior',
                'maintainFile' => YII_BASE_PATH . '/runtime/maintain',
            ),
        ),
        // controllers mappings
        'controllerMap' => array(
        ),
        // application modules
        'modules' => array(

        ),
        // application components
        'components' => array(
            'bootstrap' => array(
                'class' => 'bootstrap.components.TbApi',
            ),
            'urlManager' => array(
                'urlFormat' => 'path',
                'showScriptName' => false,
                'rules' => array(
                    '<controller:\w+>/<id:\d+>' => '<controller>/view',
                    '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                    '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ),
            ),
            'user' => array(
                'class'=>'app.components.WebUser',
                'allowAutoLogin' => true,
            ),
            'errorHandler' => array(
                'errorAction' => 'site/error',
            ),
        ),
    ),
    __DIR__ . '/_parts/db.php',
    __DIR__ . '/_parts/logs.php',
    __DIR__ . '/_parts/main-environment.php',
    __DIR__ . '/_parts/params.php',
));