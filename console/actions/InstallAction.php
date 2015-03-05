<?php
namespace thinkerg\HermesMailing\console\actions;

use yii\base\Action;
use yii\helpers\Console;
use Yii;

class InstallAction extends Action
{
    public function run()
    {
        $this->checkGii();
        $migration = $this->controller->getMigration();
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
            Yii::$app->runAction("/{$this->controller->giiID}/model", $params);
        
            $this->controller->stdout("Install complete!\n", Console::FG_GREEN);
        }
    }
    
    protected function getModelClassName($tableName)
    {
        $db = Yii::$app->getDb();
        $className = preg_replace(
            ["/(?:^{$db->tablePrefix}|$db->tablePrefix$)/", '/_/'],
            [null, ' '],
            $tableName
        );
        return str_replace(' ', null, ucwords($className));
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