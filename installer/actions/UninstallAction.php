<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) Thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author Thinker_g
 */
namespace thinkerg\HermesMailing\installer\actions;

use yii\helpers\Console;
use Yii;

class UninstallAction extends InstallerAction
{
    public function run() {
        $migration = $this->migration;
        $warning = "ATTENTION!!!\n";
        $this->controller->stdout($warning, Console::FG_RED, Console::BOLD);

        $warning = "You are about to uninstall the Hermes Mailing extension. ";
        $warning .= "This will delete table {$migration->tableName}. ";
        $warning .= "All data will be erased, please be sure that you are aware of the consequence!\n";
        $warning .= "Enter [yes] to continue: ";
        $this->controller->stdout($warning, Console::FG_RED);
        if (!$this->controller->confirm(null)) {
            $this->controller->userCancel();
        } else {
            $migration->down();
            $msg = "Uninstall complete!\n";
            $msg .= "Table in database removed. ";
            $msg .= "You may need to manually remove the corresponding AR model.\n";
            $this->controller->stdout($msg, Console::FG_GREEN);
            return 0;
        }

    }
}

?>