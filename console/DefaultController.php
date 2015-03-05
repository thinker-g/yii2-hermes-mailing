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
    
    public $mailModel = 'app\models\EmailQueue';
    
    private $_migration;
    
    public function actionIndex()
    {

        $this->run("/help", [$this->id]);
        return 0;
    }
    
    public function actionAddTestEmail($from, $to)
    {
        $mail = Yii::createObject($this->mailModel);
        $mail->attributes = [
            'to' => $to,
            'from' => $from,
            'reply_to' => $from,
            'from_name' => $from,
            'subject' => 'Hello Hermes Mailing',
            'body' => 'Hey! Thank you for using Hermes Mailing application.'
        ];
        if ($mail->save()) {
            $this->stdout("An example email has been appended to the email queue. ID: {$mail->id}.");
            return 0;
        } else {
            $errors = [];
            foreach ($mail->errors as $attr => $err) {
                $errors[$attr] = implode("\n", $err);
            }
            $this->stderr("Some errors happened:\n" . implode("\n\n", $errors));
            return 1;
        }
        
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


    /**
     * Terminate application when user cancels operations or some error happens.
     */
    public function userCancel()
    {
        $this->stdout("User canceled.\n", Console::FG_YELLOW);
        Yii::$app->end();
    }

    /**
     * @inheritdoc
     * @see \yii\base\Controller::beforeAction()
     */
    public function beforeAction($action)
    {
        if (in_array($action->id, ['index', 'install', 'uninstall'])) {
            // [TODO] Check if Mail model exists.
        }
        return parent::beforeAction($action);
    }
    
}

?>
