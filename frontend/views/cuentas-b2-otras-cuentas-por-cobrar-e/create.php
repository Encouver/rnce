<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB2OtrasCuentasPorCobrarE */

$this->title = Yii::t('app', 'Create Cuentas B2 Otras Cuentas Por Cobrar E');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas B2 Otras Cuentas Por Cobrar Es'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-b2-otras-cuentas-por-cobrar-e-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
