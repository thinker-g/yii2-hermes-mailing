<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) Thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author Thinker_g
 */
namespace thinkerg\HermesMailing;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{

    const EVENT_UNKNOWN_APP = 'hermesUnknownApp';

    /**
     *
     * @inheritdoc
     */
    public $controllerNamespace = 'thinkerg\HermesMailing\controllers';
    
    /**
     * @override
     * @param \yii\base\Application $app
     */
    public function bootstrap($app)
    {
        
        if ($app instanceof \yii\web\Application) {

        } elseif ($app instanceof \yii\base\Application) {
            
        } else {
            $this->trigger(static::EVENT_UNKNOWN_APP);
        }
    }



     
}

?>
