<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasIi1GastosOperacionales */

$this->title = Yii::t('app', 'Create Cuentas Ii1 Gastos Operacionales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Ii1 Gastos Operacionales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-ii1-gastos-operacionales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
