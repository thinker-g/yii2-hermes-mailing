<?php
namespace thinkerg\HermesMailing\installer\actions;

use yii\base\Action;
use yii\helpers\Console;

class UninstallAction extends Action
{
    public function run() {
        $migration = $this->controller->getMigration();
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
    
    /**
     * Check whether Gii module is loaded.
     */
    public function checkGii()
    {
        if (!isset(Yii::$app->controllerMap['gii'])) {
            $msg = "Command \"{$this->giiID}\" is not available.\n";
            $msg .= "Please check to ensure the module is mounted and added to bootstrap phase.\n";
            $this->controller->stderr($msg, Console::FG_RED);
            Yii::$app->end(1);
        }
    }
}

?>