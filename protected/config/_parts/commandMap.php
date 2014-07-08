<?php
/**
 * Created by PhpStorm.
 * Date:      04.07.14
 * Time:      9:33
 * @author    Fukalov Sem <yapendalff@gmail.com>
 * @copyright <Trioris> ltd
 */
return array(
    'commandMap' => array(
        'debug' => array(
            'class' => 'ext.yii-debug.DebugCommand',
            'runtimePath' => 'application.runtime', // the path to the application runtime folder
        ),
        'process' => array(
            'class' => 'ext.yii-consoletools.commands.ProcessCommand'
        ),
        'maintain' => array(
            'class' => 'ext.yii-consoletools.commands.MaintainCommand',
        ),
        'environment' => array(
            'class' => 'ext.yii-consoletools.commands.EnvironmentCommand',
            'basePath' => realpath(YII_BASE_PATH.'/..')
        ),
        'flush' => array(
            'class' => 'ext.yii-consoletools.commands.FlushCommand',
            'basePath' => realpath(YII_BASE_PATH.'/..')
        ),
        'permissions' => array(
            'class' => 'ext.yii-consoletools.commands.PermissionsCommand',
            'basePath' => realpath(YII_BASE_PATH.'/..')
        ),
        'mysqldump' => array(
            'class' => 'ext.yii-consoletools.commands.MysqldumpCommand'
        ),
        'database'      => array(
            'class' => 'ext.database-command.commands.EDatabaseCommand',
        ),
        //usage in cli and composer callback
        'migrate'       => array(
            // alias of the path where you extracted the zip file
            'class'                 => 'ext.migrate-command.EMigrateCommand',
            // this is the path where you want your core application migrations to be created
            'migrationPath'         => 'application.migrations',
            // the name of the table created in your database to save versioning information
            'migrationTable'        => 'migration',
            // the application migrations are in a pseudo-module called "core" by default
            'applicationModuleName' => 'core',
            // define all available modules (if you do not set this, modules will be set from yii app config)
            'modulePaths'           => array(
                'auth'                => 'modules.yii-auth',
            ),
            // you can customize the modules migrations subdirectory which is used when you are using yii module config
            'migrationSubPath'      => 'migrations',
            // here you can configure which modules should be active, you can disable a module by adding its name to this array
            'disabledModules'       => array(),
            // the name of the application component that should be used to connect to the database
            'connectionID'          => 'db',
            // alias of the template file used to create new migrations
            'templateFile' => 'system.cli.migration_template',
        ),
    )
);