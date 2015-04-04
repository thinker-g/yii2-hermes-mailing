<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\HermesMail */

$this->title = Yii::t('app', 'Create Hermes Mail');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hermes Mailing'), 'url'=>['/' . $this->context->module->uniqueID]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hermes Mails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hermes-mail-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
