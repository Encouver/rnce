<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\OrigenesCapitales */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Origenes Capitales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="origenes-capitales-view">

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
            'bien_id',
            'banco_contratista_id',
            'monto',
            'fecha',
            'saldo_cierre_anterior',
            'saldo_corte',
            'fecha_corte',
            'monto_aumento',
            'saldo_aumento',
            'numero_accion',
            'valor_acciones',
            'saldo_cierre_ajustado',
            'fecha_aumento',
            'contratista_id',
            'documento_registrado_id',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'numero_transaccion',
            'efectivo:boolean',
            'banco:boolean',
            'bien:boolean',
            'cuenta_pagar:boolean',
            'decreto:boolean',
        ],
    ]) ?>

</div>
