<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HermesMailSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hermes-mail-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'from') ?>

    <?= $form->field($model, 'to') ?>

    <?= $form->field($model, 'cc') ?>

    <?= $form->field($model, 'bcc') ?>

    <?php // echo $form->field($model, 'reply_to') ?>

    <?php // echo $form->field($model, 'from_name') ?>

    <?php // echo $form->field($model, 'subject') ?>

    <?php // echo $form->field($model, 'body') ?>

    <?php // echo $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'last_sent') ?>

    <?php // echo $form->field($model, 'retry_times') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'assigned_to_svr') ?>

    <?php // echo $form->field($model, 'sent_by') ?>

    <?php // echo $form->field($model, 'signature') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
