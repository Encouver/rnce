<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\OtrasCuentasCobrar */

$this->title = 'Update Otras Cuentas Cobrar: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Otras Cuentas Cobrars', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="otras-cuentas-cobrar-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
