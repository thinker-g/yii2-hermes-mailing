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
    
    private $_migration;

    public function actionIndex()
    {

        $this->run("/help", [$this->id]);
        return 0;
    }

    
    /* (non-PHPdoc)
     * @see \yii\base\Controller::actions()
     */
    public function actions()
    {
        $actions= [];
        
        if ($this->getMigration()->isTableExists()) {
            $actions['uninstall'] = 'thinkerg\HermesMailing\console\actions\UninstallAction';
        } else {
            $actions['install'] = 'thinkerg\HermesMailing\console\actions\InstallAction';
        }
        
        return $actions;
    }

    /**
     *
     * @return \thinkerg\HermesMailing\components\Migration
     */
    public function getMigration()
    {
        if (empty($this->_migration)) {
            $this->_migration = Yii::createObject($this->migration);
        }
        return $this->_migration;
    }


    public function userCancel()
    {
        $this->stdout("User canceled.\n", Console::FG_YELLOW);
        Yii::$app->end();
    }

    public function checkGii()
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
