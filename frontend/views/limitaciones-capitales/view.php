<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\p\LimitacionesCapitales */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Limitaciones Capitales'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="limitaciones-capitales-view">

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
            'afecta:boolean',
            'fecha_cierre',
            'capital_social',
            'total_patrimonio',
            'porcentaje_descapitalizacion',
            'supuesto:boolean',
            'monto_perdida',
            'fecha_limitacion',
            'capital_social_actualizado',
            'certificacion_aporte_id',
            'reintegro:boolean',
            'capital_legal',
            'saldo_perdida',
            'creado_por',
            'actualizado_por',
            'sys_status:boolean',
            'sys_creado_el',
            'sys_actualizado_el',
            'sys_finalizado_el',
            'fecha_informe',
            'contratista_id',
            'documento_registrado_id',
            'actual:boolean',
            'valor_accion',
            'valor_accion_comun',
            'total_accion',
            'total_accion_comun',
            'valor_accion_actual',
            'valor_accion_comun_actual',
            'capital_legal_actual',
            'total_capital',
        ],
    ]) ?>

</div>
