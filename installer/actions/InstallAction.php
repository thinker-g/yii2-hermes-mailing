<?php
namespace thinkerg\HermesMailing\installer\actions;

use yii\helpers\Console;
use Yii;

class InstallAction extends InstallerAction
{
    public function run()
    {
        $this->checkGii();
        $migration = $this->migration;
        if (!$this->controller->confirm("Create table {$migration->tableName}?")) {
            $this->controller->userCancel();
        }

        $this->controller->stdout("Migrating database...\n");
        $migrated = $migration->up();

        // Generate AR
        if (!$migrated) {
            $this->controller->stderr('Database migration failed!', Console::FG_RED);
        } else {
            $params = [
                'tableName' => $migration->tableName,
                'modelClass' => $this->getModelClassName($migration->tableName)
            ];
            Yii::$app->runAction("/{$this->giiID}/model", $params);

            $this->controller->stdout("Install complete!\n", Console::FG_GREEN);
        }
    }

}

?>