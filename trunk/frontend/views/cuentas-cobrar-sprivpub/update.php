<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarSprivpub */

$this->title = 'Update Cuentas Cobrar Sprivpub: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobrar Sprivpubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="cuentas-cobrar-sprivpub-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
