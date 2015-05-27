<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB2OtrasCuentasPorCobrarE */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cuentas B2 Otras Cuentas Por Cobrar E',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas B2 Otras Cuentas Por Cobrar Es'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cuentas-b2-otras-cuentas-por-cobrar-e-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
