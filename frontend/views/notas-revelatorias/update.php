<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\p\NotasRevelatorias */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Notas Revelatorias',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notas Revelatorias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="notas-revelatorias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
