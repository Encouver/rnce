<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\RepsLegales */

$this->title = 'Update Reps Legales: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Reps Legales', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reps-legales-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
