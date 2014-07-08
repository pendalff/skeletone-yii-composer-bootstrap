<?php
/**
 * Created by PhpStorm.
 * Date:      04.07.14
 * Time:      10:53
 * @author    Fukalov Sem <yapendalff@gmail.com>
 * @copyright <Trioris> ltd
 */
return array(
    'params' => array(
        //Define composer hooks by the following name schema: <vendor>/<packageName>-<action>
        'composer.callbacks' => array(
            // command and args for Yii command runner
            'post-install' => array(
                //create base webapp struct with interactive mode
                array(
                    'yiic',
                    'webapp',
                    YII_BASE_PATH.'/../',
                    'git',
                    '--interactive=1'
                ),
                //set env to dev
                array(
                    'yiic',
                    'environment',
                    'dev'
                ),
                //run migrations (init)
                array('yiic', 'migrate', '--interactive=1'),
            ),
            'post-update' => array(
                array('yiic', 'migrate', '--interactive=1')
            ),
        ),
    )
);