<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CuentasCobrarContrato */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Cuentas Cobrar Contratos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-cobrar-contrato-view">

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
            'condiciones',
            'num_contrato',
            'porcentaje_avance',
            'plazo_contrato',
            'saldo_cont_corriente',
            'saldo_cont_ncorriente',
            'contratista_id',
            'ano',
            'cliente_id',
            'contrato:boolean',
        ],
    ]) ?>

</div>
