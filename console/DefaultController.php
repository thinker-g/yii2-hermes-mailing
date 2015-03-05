<?php
namespace thinkerg\HermesMailing\console;

use Yii;
use yii\console\Controller;
use yii\helpers\Console;

/**
 *
 * @author tlsadmin
 *
 * @property $module \thinkerg\HermesMailing\Module
 */
class DefaultController extends Controller
{

    public $migration = 'thinkerg\HermesMailing\components\Migration';

    public $giiID = 'gii';

    public function actionIndex()
    {

        $this->run("/help", [$this->id]);
        return 0;
    }

    public function actionInstall()
    {
        $this->checkGii();
        $migration = $this->getMigration();
        if (!$this->confirm("Create table {$migration->tableName}?")) {
            $this->userCancel();
        }

        $this->stdout("Migrating database...\n");
        $migrated = $migration->up();

        // Generate AR
        if (!$migrated) {
            $this->stderr('Database migration failed!', Console::FG_RED);
        } else {
            $params = [
                'tableName' => $migration->tableName,
                'modelClass' => $this->getModelClassName($migration->tableName)
            ];
            Yii::$app->runAction("/{$this->giiID}/model", $params);

            $this->stdout("Install complete!\n", Console::FG_GREEN);
        }

    }

    public function actionUninstall() {
        $migration = $this->getMigration();
        $warning = "ATTENTION!\n";
        $this->stdout($warning, Console::FG_RED, Console::BOLD);

        $warning = "You are about to uninstall the Hermes Mailing extension. ";
        $warning .= "This will delete table {$migration->tableName}. ";
        $warning .= "All data will be erased, please be sure that you are aware of the consequence!\n";
        $warning .= "Enter [yes] to continue: ";
        $this->stdout($warning, Console::FG_RED);
        if (!$this->confirm(null)) {
            $this->userCancel();
        } else {
            $migration->down();
            $msg = "Uninstall complete!\n";
            $msg .= "Table in database removed. ";
            $msg .= "You may need to manually remove the corresponding AR model.\n";
            $this->stdout($msg, Console::FG_GREEN);
            return 0;
        }

    }

    /**
     *
     * @return \thinkerg\HermesMailing\components\Migration
     */
    protected function getMigration()
    {
        return Yii::createObject($this->migration);
    }

    protected static function getModelClassName($tableName)
    {
        $db = Yii::$app->getDb();
        $className = preg_replace(
            ["/(?:^{$db->tablePrefix}|$db->tablePrefix$)/", '/_/'],
            [null, ' '],
            $tableName
        );
        return str_replace(' ', null, ucwords($className));
    }

    protected function userCancel()
    {
        $this->stdout("User canceled.\n", Console::FG_YELLOW);
        Yii::$app->end();
    }

    protected function checkGii()
    {
        if (!isset(Yii::$app->controllerMap['gii'])) {
            $msg = "Command \"{$this->giiID}\" is not available.\n";
            $msg .= "Please check to ensure the module is mounted and added to bootstrap phase.\n";
            $this->stderr($msg, Console::FG_RED);
            Yii::$app->end(1);
        }
    }
}

?>
