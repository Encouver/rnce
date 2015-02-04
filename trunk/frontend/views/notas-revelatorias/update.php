<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\NotasRevelatorias */

$this->title = 'Update Notas Revelatorias: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Notas Revelatorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="notas-revelatorias-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
