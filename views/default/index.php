<?php
use yii\helpers\Html;

/* @var $this yii\web\View */

$this->title = Yii::t('app', 'Hermes Mailing');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="hermes-default-index">
    <h1><?= $this->title ?></h1>
    <p>This is a web module provides a human-friendly management inteface for Hermes Mailing Command.</p>
    <div><?= Html::a(Yii::t('app', 'Go manage emails'), ['mail/index'], ['class' => 'btn btn-primary']);?></div>
</div>
