<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) Thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author Thinker_g
 */

namespace thinkerg\HermesMailing\installer\actions;

use yii\base\Action;
use Yii;

class InstallerAction extends Action
{
    public $migration = 'thinkerg\HermesMailing\installer\Migration';
    public $giiID = 'gii';

    public function init()
    {
        parent::init();
        $this->migration = Yii::createObject($this->migration);
    }

    /**
     * Check whether Gii module is loaded.
     */
    public function checkGii()
    {
        if (!isset(Yii::$app->controllerMap[$this->giiID])) {
            $msg = "Command \"{$this->giiID}\" is not available.\n";
            $msg .= "Please check to ensure the module is mounted and added to bootstrap phase.\n";
            $this->controller->stderr($msg, Console::FG_RED);
            Yii::$app->end(1);
        }
    }


    protected function getModelClassName($tableName)
    {
        $db = $this->migration->db;
        $className = preg_replace(
            ["/(?:^{$db->tablePrefix}|$db->tablePrefix$)/", '/_/'],
            [null, ' '],
            $tableName
        );
        return str_replace(' ', null, ucwords($className));
    }
}

?>