<?php
/**
 * @link https://github.com/thinker-g/yii2-hermes-mailing
 * @copyright Copyright (c) thinkergpsr4 (Jiyan.guo@gmail.com)
 * @license MIT
 * @version v1.0.0
 * @author thinkergpsr4
 */

namespace thinkergpsr4\HermesMailing\controllers;

use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}
