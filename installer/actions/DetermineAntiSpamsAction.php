<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) thinker_g (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author thinker_g
 */

namespace thinker_g\HermesMailing\installer\actions;

use Yii;

class DetermineAntiSpamsAction extends InstallerAction
{
    private $_nextStop = [];

    /**
     * Run to see which anti-spamming configuration is faster based on current spam rules.
     *
     * @param $quantity int Quantity of mails to send in the simulation.
     * @return number
     */
    public function run($quantity = 1000)
    {
        $this->controller->consoleLog(
            "Testing CPU times spent on calcualting anti-spamming by running a $quantity mails delivery."
        );
        $this->controller->stdout("useLiteAntiSpams = false (default): \t");
        $start = microtime(true);
        for ($i = 0; $i < $quantity; $i++) {
            $this->controller->applySpamRules($i, true);
        }
        $stop = microtime(true);
        $tFull = $stop - $start;
        $this->controller->stdout($tFull . ' sec.' . PHP_EOL);

        $this->_nextStop = null;

        $this->controller->stdout("useLiteAntiSpams = true: \t\t");
        $start = microtime(true);
        for ($i = 0; $i < $quantity; $i++) {
            $this->controller->applySpamRulesLite($i, true);
        }
        $stop = microtime(true);
        $tLite = $stop - $start;
        $this->controller->stdout($tLite . ' sec.' . PHP_EOL);
        $setting = ($tLite < $tFull) ? "true" : "false";
        $recommand = "According to your current spam rules, ";
        $recommand .= "we recommand you to set your 'useLiteAntiSpams' to '{$setting}.'";
        $this->controller->consoleLog($recommand);

        return 0;

    }
}

?>