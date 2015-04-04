<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\HermesMail */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Hermes Mails');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Hermes Mailing'), 'url'=>['/' . $this->context->module->uniqueID]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hermes-mail-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Hermes Mail'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'from',
            'to',
            // 'cc',
            // 'bcc',
            // 'reply_to',
            // 'from_name',
            'subject',
            // 'body:ntext',
            // 'created',
            'last_sent',
            'retry_times',
            'status',
            // 'assigned_to_svr',
            // 'sent_by',
            // 'signature',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
