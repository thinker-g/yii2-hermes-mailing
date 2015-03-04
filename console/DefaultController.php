<?php
namespace thinkerg\HermesMailing\console;

use Yii;
use yii\console\Controller;
use yii\db\Exception as DbException;

/**
 * 
 * @author tlsadmin
 *
 * @property $module \thinkerg\HermesMailing\Module
 */
class DefaultController extends Controller
{
    
    public $migration = 'thinkerg\HermesMailing\components\Migration';
    
    public function actionIndex()
    {
        $this->stdout("Aha!\n");
    }
    
    public function actionInstall() {
        $installStat = [];
        
        $migration = $this->getMigration();
        if (false) {
            $migration->up();
        }
        
        // Generate AR
        if (true) {
            
        }
        
    }
    
    public function actionUninstall() {
        $this->getMigration(false);
    }
    
    /**
     * 
     * @return \thinkerg\HermesMailing\components\Migration
     */
    protected function getMigration()
    {
        return Yii::createObject($this->migration);
    }
}

?>