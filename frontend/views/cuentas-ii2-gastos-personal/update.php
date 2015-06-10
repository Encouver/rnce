<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasIi2GastosPersonal */

$this->title = Yii::t('app', 'Update {modelClass}: ', [
    'modelClass' => 'Cuentas Ii2 Gastos Personal',
]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Ii2 Gastos Personals'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="cuentas-ii2-gastos-personal-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
