<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarContrato */

$this->title = 'Create Cuentas Cobrar Contrato';
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobrar Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobrar-contrato-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
