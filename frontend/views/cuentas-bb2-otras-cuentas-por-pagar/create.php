<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasBb2OtrasCuentasPorPagar */

$this->title = Yii::t('app', 'Create Cuentas Bb2 Otras Cuentas Por Pagar');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas Bb2 Otras Cuentas Por Pagars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-bb2-otras-cuentas-por-pagar-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
