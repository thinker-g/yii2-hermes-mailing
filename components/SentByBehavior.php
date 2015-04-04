<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author thinker_g
 */

namespace thinker_g\HermesMailing\components;

use yii\base\Behavior;
use yii\db\BaseActiveRecord;
use yii\base\Event;
use Yii;

class SentByBehavior extends Behavior
{

    public $sentByAttr = 'sent_by';
    
    /**
     * @overriding
     * @see \yii\base\Behavior::events()
     */
    public function events()
    {
        return [
            BaseActiveRecord::EVENT_BEFORE_UPDATE => 'recordSentServer'
        ];
        
    }
    
    public function recordSentServer(Event $e)
    {
        if (isset(Yii::$app->controller->serverID)) {
            $this->owner->{$this->sentByAttr} = Yii::$app->controller->serverID;
        }
    }

}

?>