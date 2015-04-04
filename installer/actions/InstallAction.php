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
use yii\db\Exception as DbException;
use Yii;

/**
 * @author thinker_g
 *
 * @property \thinker_g\HermesMailing\console\DefaultController $controller
 */
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
        try {
            $migrated = $migration->up();
        } catch (DbException $e) {
            $err = "\nError({$e->getCode()}): Database migration failed!" . PHP_EOL;
            $err .= $e->getMessage() . PHP_EOL;
            $this->controller->stderr($err, Console::FG_RED);
            $this->controller->stderr("Installion aborted!" . PHP_EOL, Console::FG_YELLOW);
            return 1;
        }

        $fqn = explode('\\', $this->controller->modelClass);
        $modelClass = array_pop($fqn);
        $ns = implode('\\', $fqn);

        $params = [
            'tableName' => $migration->tableName,
            'modelClass' => $modelClass,
            'ns' => $ns,
            'useTablePrefix' => true
        ];
        Yii::$app->set('db', $migration->db);
        Yii::$app->runAction("/{$this->giiID}/model", $params);

        $this->controller->stdout("Install complete!\n", Console::FG_GREEN);

    }

}

?>