<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\HermesMail */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hermes Mailing'), 'url'=>['/' . $this->context->module->uniqueID]];
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hermes Mails'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hermes-mail-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'from',
            'to',
            'cc',
            'bcc',
            'reply_to',
            'from_name',
            'subject',
            'body:ntext',
            'created',
            'last_sent',
            'retry_times:datetime',
            'status',
            'assigned_to_svr',
            'sent_by',
            'signature',
        ],
    ]) ?>

</div>
