<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarContrato */

$this->title = 'Update Cuentas Cobrar Contrato: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobrar Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuentas-cobrar-contrato-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
