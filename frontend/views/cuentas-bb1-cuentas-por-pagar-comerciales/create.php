<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasBb1CuentasPorPagarComerciales */

$this->title = Yii::t('app', 'Create Cuentas Bb1 Cuentas Por Pagar Comerciales');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Bb1 Cuentas Por Pagar Comerciales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-bb1-cuentas-por-pagar-comerciales-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
