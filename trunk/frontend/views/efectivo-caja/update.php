<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\EfectivoCaja */

$this->title = 'Update Efectivo Caja: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Efectivo Cajas', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="efectivo-caja-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
