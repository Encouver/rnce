<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\DecretosDivExcedentes */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Decretos Div Excedentes',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Decretos Div Excedentes'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="decretos-div-excedentes-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
