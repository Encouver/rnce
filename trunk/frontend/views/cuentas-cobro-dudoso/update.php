<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobroDudoso */

$this->title = 'Update Cuentas Cobro Dudoso: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobro Dudosos', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuentas-cobro-dudoso-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
