<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\c\CuentasB2OtrasCuentasPorCobrar */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cuentas B2 Otras Cuentas Por Cobrars'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="cuentas-b2-otras-cuentas-por-cobrar-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'criterio',
            'origen',
            'fecha',
            'garantia',
            'corriente:boolean',
            'nocorriente:boolean',
            'plazo_contrato_c',
            'saldo_neto_c',
            'plazo_contrato_nc',
            'saldo_neto_nc',
            'criterio_id',
            'otro_nombre',
            'contratista_id',
            'anho',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
        ],
    ]) ?>

</div>
