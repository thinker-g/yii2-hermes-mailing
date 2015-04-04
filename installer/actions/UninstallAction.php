<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author thinker_g
 */
namespace thinker_g\HermesMailing\installer\actions;

use yii\helpers\Console;
use Yii;

class UninstallAction extends InstallerAction
{
    public function run() {
        $migration = $this->migration;
        $warning = "ATTENTION!!!\n";
        $this->controller->stdout($warning, Console::FG_RED, Console::BOLD);
        $filename = Yii::getAlias('@' . str_replace('\\', '/', $this->controller->modelClass)) . '.php';

        $warning = "You are about to uninstall the Hermes Mailing extension. " . PHP_EOL;
        $warning .= "This will drop database table {$migration->tableName}. " . PHP_EOL;
        file_exists($filename) && ($warning .= "And delete model file {$filename} " . PHP_EOL);
        $warning .= PHP_EOL;
        $warning .= "All data will be erased, please be sure that you are aware of the consequence!" . PHP_EOL;
        $warning .= "Enter [yes] to continue: ";
        $this->controller->stdout($warning, Console::FG_RED);
        if (!$this->controller->confirm(null)) {
            $this->controller->userCancel();
        } else {
            if (file_exists($filename)) {
                $this->controller->stdout("Deleting model file: \n" . $filename . PHP_EOL);
                unlink($filename);
            }
            $migration->down();
            $msg = "Uninstall complete!" . PHP_EOL;
            $msg .= "Table in database removed. " . PHP_EOL;
            $this->controller->stdout($msg, Console::FG_GREEN);
            return 0;
        }

    }
}

?>