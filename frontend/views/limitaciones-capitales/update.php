<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\LimitacionesCapitales */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Limitaciones Capitales',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Limitaciones Capitales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="limitaciones-capitales-update">

   <?= Html::tag(h1, 'Update Lmitaciones Capitales') ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
