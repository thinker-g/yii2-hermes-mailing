<?php
namespace thinkerg\HermesMailing\commands;

use Yii;
use yii\console\Controller;
use yii\db\Exception as DbException;

class EmailController extends Controller
{
    public function actionIndex()
    {
        echo 'aha!';
    }
    
    public function actionInstall() {
        $dbSchema = Yii::$app->getDb()->getSchema();
        $tableName = $dbSchema->getRawTableName('{{%test}}');
        if (!in_array($tableName, $dbSchema->tableNames)) {
            if ($this->confirm('Migration')) {
                $this->migrateDb();
            }
        } else {
            throw new DbException("Table `{$tableName}` already exists.");
        }
        
    }
    
    public function actionUninstall() {
        $this->migrateDb(false);
    }
    
    protected function migrateDb($isUp = true)
    {
        $migration = Yii::createObject('\thinkerg\HermesMailing\components\Migration');
        $migration->{$isUp ? 'up' : 'down'}();
    }
}

?>