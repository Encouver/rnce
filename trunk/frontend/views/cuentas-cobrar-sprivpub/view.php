<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarSprivpub */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobrar Sprivpubs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobrar-sprivpub-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'venta:boolean',
            'servicio:boolean',
            'obras:boolean',
            'num_contrato_factura',
            'monto_contrato_f',
            'procentaje_a',
            'plazo_contrato',
            'contatista_id',
            'ano',
            'tipo_cuenta',
        ],
    ]) ?>

</div>
