<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\HermesMail */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="hermes-mail-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'from')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'to')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cc')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'bcc')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'reply_to')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'from_name')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'subject')->textInput(['maxlength' => 100]) ?>

    <?= $form->field($model, 'body')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'assigned_to_svr')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
