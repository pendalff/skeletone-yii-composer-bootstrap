<?php
/**
 * Created by PhpStorm.
 * Date:      04.07.14
 * Time:      11:48
 * @author    Fukalov Sem <yapendalff@gmail.com>
 * @copyright <Trioris> ltd
 */
return array(
    'components' => array(
        'log' => array(
            'class' => 'CLogRouter',
            'routes' => array(
                array(
                    'class' => 'CFileLogRoute',
                    'levels' => 'error, warning',
                ),
            ),
        ),
    ),
);