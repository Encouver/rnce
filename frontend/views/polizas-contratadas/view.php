<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\PolizasContratadas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Polizas Contratadas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="polizas-contratadas-view">

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
            'numero_contrato',
            'fecha_suscripcion',
            'fecha_inicio',
            'fecha_finalizacion',
            'duracion',
            'tipo_poliza',
            'monto_asegurado',
            'monto_contrato',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'natural_juridica_id',
            'bien_id',
        ],
    ]) ?>

</div>
