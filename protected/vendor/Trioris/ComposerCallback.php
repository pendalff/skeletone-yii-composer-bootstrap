<?php
/**
 * Composer callbacks for yii app
 * @author Tobias Munk <schmunk@usrbin.de>
 * @author Fukalov Sem <yapendalff@gmail.com>
 * Date: 03.07.14
 * Time: 14:37
 */
namespace Trioris;
use Composer\Script\Event;

include_once(__DIR__ . "/../../bootstrap.php");

defined('CONSOLE_CONFIG') or define('CONSOLE_CONFIG', YII_CONFIG.'/install.php');

// we don't check YII_PATH, since it will be downloaded with composer
if (!is_file(CONSOLE_CONFIG)) {
    throw new \Exception("File '".CONSOLE_CONFIG."' from CONSOLE_CONFIG not found!");
}

/**
 * provides composer hooks
 *
 * This setup class triggers `./yiic migrate` at post-install and post-update.
 * For a package the class triggers `./yiic <vendor/<packageName>-<action>` at post-package-install and
 * post-package-update.
 * See composer manual (http://getcomposer.org/doc/articles/scripts.md)
 *
 * Usage example
 * * config.php
 *     'params' => array(
            'composer.callbacks' => array(
            'post-update' => array('yiic', 'migrate'),
            'post-install' => array('yiic', 'migrate'),
            'yiisoft/yii-install' => array('yiic', 'webapp', realpath(dirname(__FILE__))),
            ),
            )
        );

 * composer.json
 *   "scripts": {
 *      "pre-install-cmd": "config\\ComposerCallback::preInstall",
        "post-install-cmd": "config\\ComposerCallback::postInstall",
        "pre-update-cmd": "config\\ComposerCallback::preUpdate",
        "post-update-cmd": "config\\ComposerCallback::postUpdate",
        "post-package-install": [
        "config\\ComposerCallback::postPackageInstall"
        ],
        "post-package-update": [
        "config\\ComposerCallback::postPackageUpdate"
        ]
 */

/**
 * Class ComposerCallback
 * @package Trioris
 */
class ComposerCallback
{
    /**
     * Displays welcome message
     * @static
     * @param \Composer\Script\Event $event
     */
    public static function preInstall(Event $event)
    {
        $composer = $event->getComposer();
        echo self::companyAscii();
        echo "Syncing packages with lock-file...\n\n";

        self::runHook('pre-install');
    }

    /**
     * Executes ./yiic migrate
     * @static
     * @param \Composer\Script\Event $event
     */
    public static function postInstall(Event $event)
    {
        self::runHook('post-install');
    }

    /**
     * Displays welcome message
     *
     * @static
     * @param \Composer\Script\Event $event
     */
    public static function preUpdate(Event $event)
    {
        echo self::companyAscii();
        echo "Upgrading packages...\n\n";
        self::runHook('pre-update');
    }

    /**
     * Executes ./yiic migrate
     *
     * @static
     * @param \Composer\Script\Event $event
     */
    public static function postUpdate(Event $event)
    {
        self::runHook('post-update');
        echo "\n";
    }

    /**
     * Executes ./yiic <vendor/<packageName>-<action>
     *
     * @static
     * @param \Composer\Script\Event $event
     */
    public static function postPackageInstall(Event $event)
    {
        $installedPackage = $event->getOperation()->getPackage();
        $hookName = $installedPackage->getPrettyName().'-install';
        self::runHook($hookName);
    }

    /**
     * Executes ./yiic <vendor/<packageName>-<action>
     *
     * @static
     * @param \Composer\Script\Event $event
     */
    public static function postPackageUpdate(Event $event)
    {
        $installedPackage = $event->getOperation()->getTargetPackage();
        $hookName = $installedPackage->getPrettyName().'-update';
        self::runHook($hookName);
    }

    /**
     * Asks user to confirm by typing y or n.
     *
     * Credits to Yii CConsoleCommand
     *
     * @param string $message to echo out before waiting for user input
     * @return bool if user confirmed
     */
    public static function confirm($message)
    {
        echo $message . ' [yes|no] ';
        return !strncasecmp(trim(fgets(STDIN)), 'y', 1);
    }

    /**
     * Runs Yii command, if available (defined in config/console.php)
     */
    private static function runHook($name){
        $app = self::getYiiApplication();

        if ($app === null) return;

        if (isset($app->params['composer.callbacks'][$name])) {
            echo "composer.callback: " . $name . "\n\n";
            $cmd = $app->params['composer.callbacks'][$name];

            // check for multiple commands
            if (is_array($cmd[0])) {
                foreach ($cmd AS $args) {
                    $app->commandRunner->addCommands(\Yii::getPathOfAlias('system.cli.commands'));
                    $app->commandRunner->run($args);
                }
            } else {
                $args = $cmd;
                $app->commandRunner->addCommands(\Yii::getPathOfAlias('system.cli.commands'));
                $app->commandRunner->run($args);
            }
        }
    }

    /**
     * Creates console application, if Yii is available
     * @throws \Exception
     * @return \CConsoleApplication
     */
    private static function getYiiApplication()
    {
        if (!is_file(YII_PATH.'/yii.php'))
        {
            return null;
        }

        require_once(YII_PATH . '/yii.php');
        spl_autoload_register(array('YiiBase', 'autoload'));

        if (\Yii::app() === null) {
            if (is_file(CONSOLE_CONFIG)) {
                $app = \Yii::createConsoleApplication(CONSOLE_CONFIG);
            } else {
                throw new \Exception("File from CONSOLE_CONFIG not found");
            }
        } else {
            $app = \Yii::app();
        }
        return $app;
    }

    private static function companyAscii(){
        $return = <<<TXT
       _____  _______      _______  ____
      / ____||__   __| /\ |__   __||___ \
     | (___     | |   /  \   | |     __) |
      \___ \    | |  / /\ \  | |    |__ <
      ____) |   | | / ____ \ | |    ___) |
     |_____/    |_|/_/    \_\|_|   |____/
  ________
 |__   __|   (_)             (_)       | || |     | |
    | | _ __  _   ___   _ __  _  ___   | || |_  __| |
    | || '__|| | / _ \ | '__|| |/ __|  | || __|/ _` |
    | || |   | || (_) || |   | |\__ \  | || |_| (_| |
    |_||_|   |_| \___/ |_|   |_||___/  |_| \__|\__,_|

TXT;

        $return .= "\n";
        return $return;
    }

}
