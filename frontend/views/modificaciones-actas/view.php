<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\ModificacionesActas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Modificaciones Actas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="modificaciones-actas-view">

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
            'contratista_id',
            'documento_registrado_id',
            'pago_capital:boolean',
            'aporte_capitalizar:boolean',
            'aumento_capital:boolean',
            'coreccion_monetaria:boolean',
            'disminucion_capital:boolean',
            'limitacion_capital:boolean',
            'limitacion_capital_afectado:boolean',
            'fondo_emergencia:boolean',
            'reintegro_perdida:boolean',
            'venta_accion:boolean',
            'fusion_empresarial:boolean',
            'decreto_div_excedente:boolean',
            'modificacion_balance:boolean',
            'razon_social:boolean',
            'denominacion_comercial:boolean',
            'domicilio_fiscal:boolean',
            'domicilio_principal:boolean',
            'objeto_social:boolean',
            'representante_legal:boolean',
            'junta_directiva:boolean',
            'duracion_empresa:boolean',
            'cierre_ejercicio:boolean',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
        ],
    ]) ?>

</div>
