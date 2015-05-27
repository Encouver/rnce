<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB1CuentasPorCobrarComerciales */

$this->title = Yii::t('app', 'Create Cuentas B1 Cuentas Por Cobrar Comerciales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas B1 Cuentas Por Cobrar Comerciales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-b1-cuentas-por-cobrar-comerciales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
