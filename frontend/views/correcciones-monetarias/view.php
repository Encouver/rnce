<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\CorreccionesMonetarias */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Correcciones Monetarias'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="correcciones-monetarias-view">

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
            'fecha_aumento',
            'valor_accion',
            'variacion_valor',
            'total_accion',
            'monto_capital_legal',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'contratista_id',
            'documento_registrado_id',
            'certificacion_aporte_id',
            'fecha_informe',
            'valor_accion_comun',
            'variacion_valor_comun',
            'total_accion_comun',
        ],
    ]) ?>

</div>
